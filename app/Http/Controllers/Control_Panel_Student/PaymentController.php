<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Carbon\Carbon;
use App\SchoolYear;
use App\DiscountFee;

/** Paypal Details classes **/
use PayPal\Api\Item;
use PayPal\Api\Payer;
use App\Mail\SendMail;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use App\StudentInformation;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use App\TransactionDiscount;
use App\TransactionOtherFee;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use App\Mail\NotifyAdminMail;
use App\TransactionMonthPaid;
use PayPal\Api\PaymentExecution;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Validator;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $api_context;

    /** 
    ** We declare the Api context as above and initialize it in the contructor
    **/
    public function __construct()
    {
        $this->api_context = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'), 
                config('paypal.secret'))
        );
        $this->api_context->setConfig(config('paypal.settings'));
    }

    /**
    ** This method sets up the paypal payment.
    **/
    public function createPayment(Request $request)
    {
        $rules = [
            'tution_category' => 'required',
            'pay_fee' => 'required',
            'email'=>'email|required'
        ];
        
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails())
        {   
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $validator->getMessageBag()]);
        }

        $User = \Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)->first();
        $mytime = Carbon::now();
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->orderBY('id', 'DESC')
            ->first();

        // Amount received as request is validated here.
        // $request->validate(['amount' => 'required|numeric']);
        $pay_amount = $request->pay_fee;

        // We create the payer and set payment method, could be any of "credit_card", "bank", "paypal", "pay_upon_invoice", "carrier", "alternate_payment". 
        $payer = new Payer();
            $payer->setPaymentMethod('paypal');

        // Create and setup items being paid for.. Could multiple items like: 'item1, item2 etc'.
        $item = new Item();
        $item->setName('Tuition Fee (SJAI)')
            ->setCurrency('PHP')
            ->setQuantity(1)
            ->setPrice($pay_amount);

        // Create item list and set array of items for the item list.
        $itemList = new ItemList();
        $itemList->setItems(array($item));
        
        // Create and setup the total amount.
        $amount = new Amount();
        $amount->setCurrency('PHP')->setTotal($pay_amount);

        // Create a transaction and amount and description.
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($request->description_name);      
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('confirm-payment'))
            ->setCancelUrl('https://sja-bataan.com/enrollment/student/enrollment');
        
        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);

        // We set up the payment with the payer, urls and transactions.
        // Note: you can have different itemLists, then different transactions for it.
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        // Put the payment creation in try and catch in case of exceptions.
        try {
            $payment->create($this->api_context);
        } catch (PayPalConnectionException $ex){
            return back()->withError('Some error occur, sorry for inconvenient');
        } catch (Exception $ex) {
           return back()->withError('Some error occur, sorry for inconvenient');
        }

        // We get 'approval_url' a paypal url to go to for payments.
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // You can set a custom data in a session
        // $request->session()->put('key', 'value');;

        // We redirect to paypal tp make payment
        if(isset($redirect_url)) {

            $checkAccount = TransactionDiscount::where('school_year_id', $SchoolYear->id)
                ->where('student_id', $StudentInformation->id)
                ->first();

            $checkAccount1 = \App\Transaction::where('school_year_id', $SchoolYear->id)
                ->where('student_id', $StudentInformation->id)
                ->first();
            
            if($checkAccount1){
                $TransactionAccount = \App\Transaction::where('school_year_id', $SchoolYear->id)
                    ->where('student_id', $StudentInformation->id)
                    ->first();

                $Enrollment = new TransactionMonthPaid();
                $Enrollment->or_no = $StudentInformation->first_name.''.$mytime->toDateTimeString();
                $Enrollment->student_id = $StudentInformation->id;
                $Enrollment->payment = $request->pay_fee;
                $Enrollment->school_year_id = $SchoolYear->id;
                $Enrollment->balance = $request->result_current_bal;
                $Enrollment->email = $request->email;
                $Enrollment->number = $request->phone;
                $Enrollment->payment_option = 'Credit Card/Debit Card';
                $Enrollment->transaction_id = $TransactionAccount->id;               
                $Enrollment->save();
                
                if(!empty($request->discount)){
                    foreach($request->discount as $get_data){
                        $DiscountFee = DiscountFee::where('id', $get_data)
                            ->where('apply_to', 1)//finance|student
                            ->where('current', 1)
                            ->where('status', 1)->first();
                        
                        $DiscountFeeSave = new TransactionDiscount();
                        $DiscountFeeSave->student_id = $StudentInformation->id;
                        $DiscountFeeSave->discount_amt = $DiscountFee->disc_amt;
                        $DiscountFeeSave->discount_type = $DiscountFee->disc_type;        
                        $DiscountFeeSave->transaction_month_paid_id = $Enrollment->id;                
                        $DiscountFeeSave->school_year_id = $SchoolYear->id;
                        $DiscountFeeSave->save();                        
                    }
                }
                
            }else{
                
                $EnrollmentTransaction = new \App\Transaction();
                $EnrollmentTransaction->payment_category_id = $request->tution_category;
                $EnrollmentTransaction->student_id = $StudentInformation->id;
                $EnrollmentTransaction->school_year_id = $SchoolYear->id;     
                foreach($request->downpayment as $get_data){
                    $EnrollmentTransaction->downpayment_id = $get_data;  
                }                      
                $EnrollmentTransaction->save();

                $Enrollment = new TransactionMonthPaid();
                $Enrollment->or_no = $StudentInformation->first_name.''.$mytime->toDateTimeString();
                $Enrollment->student_id = $StudentInformation->id;
                $Enrollment->payment = $request->pay_fee;
                $Enrollment->school_year_id = $SchoolYear->id;
                $Enrollment->balance = $request->result_current_bal;
                $Enrollment->email = $request->email;
                $Enrollment->number = $request->phone;
                $Enrollment->payment_option = 'Credit Card/Debit Card';
                $Enrollment->transaction_id = $EnrollmentTransaction->id;
                $Enrollment->save();
                
                if($request->discount != 0){
                    foreach($request->discount as $get_data){
                        $DiscountFee = DiscountFee::where('id', $get_data)
                            ->where('apply_to', 1)//finance|student
                            ->where('current', 1)
                            ->where('status', 1)
                            ->first();

                        $DiscountFeeSave = new TransactionDiscount();
                        $DiscountFeeSave->student_id = $StudentInformation->id;
                        $DiscountFeeSave->discount_amt = $DiscountFee->disc_amt;
                        $DiscountFeeSave->discount_type = $DiscountFee->disc_type;        
                        $DiscountFeeSave->transaction_month_paid_id = $Enrollment->id;                
                        $DiscountFeeSave->school_year_id = $SchoolYear->id;
                        $DiscountFeeSave->save();
                    }    
                }                   
                
                if($request->other_id){
                    $Other = new TransactionOtherFee();
                    $Other->transaction_id = $EnrollmentTransaction->id;
                    $Other->student_id = $StudentInformation->id;
                    $Other->others_fee_id = $request->other_id;
                    $Other->school_year_id = $SchoolYear->id;
                    $Other->item_qty = 1;
                    $Other->item_price = $request->other_price;
                    $Other->other_name = $request->other_name;
                    $Other->save();
                }
                
                // return response()->json([$redirect_url]);
            }

            return response()->json([$redirect_url]);
        }

        // If we don't have redirect url, we have unknown error.
        return redirect()->back()->withError('Unknown error occurred');
        
    }

    /**
    ** This method confirms if payment with paypal was processed successful and then execute the payment, 
    ** we have 'paymentId, PayerID and token' in query string.
    **/
    public function confirmPayment(Request $request)
    {
        // If query data not available... no payments was made.
        if (empty($request->query('paymentId')) || empty($request->query('PayerID')) || empty($request->query('token'))){
            return redirect()->route('student.enrollment.index')->withError('Payment was not successful.');            
        }
            
        // We retrieve the payment from the paymentId.
        $payment = Payment::get($request->query('paymentId'), $this->api_context);

        // We create a payment execution with the PayerId
        $execution = new PaymentExecution();
        $execution->setPayerId($request->query('PayerID'));

        // Then we execute the payment.
        $result = $payment->execute($execution, $this->api_context);

        // Get value store in array and verified data integrity
        // $value = $request->session()->pull('key', 'default');
        // print_r($request->session()->pull('key', 'default'));

        // Check if payment is approved
        if ($result->getState() != 'approved'){
            return redirect()->route('student.enrollment.index')->withError('Payment was not successful.');
        }else{
            $User = \Auth::user();
            $StudentInformation = StudentInformation::where('user_id', $User->id)->first();

            $SchoolYear = SchoolYear::where('current', 1)
                ->where('status', 1)
                ->orderBY('id', 'DESC')
                ->first();

            $IsReceived = TransactionMonthPaid::where('student_id', $StudentInformation->id)
                ->where('school_year_id', $SchoolYear->id)->orderBy('id', 'Desc')->first();
            // $IsReceived->or_number =  $payment->paymentId;
            $IsReceived->isSuccess = 1;
            if($IsReceived->save()){

                $discountReceived = TransactionDiscount::where('transaction_month_paid_id', $IsReceived->id)->first();
                if($discountReceived ){
                    $discountReceived->isSuccess = 1;
                    $discountReceived->save();
                }                

                $otherReceived = TransactionOtherFee::where('transaction_id', $IsReceived->transaction_id)->first();
                if($otherReceived){
                    $otherReceived->isSuccess = 1;
                    $otherReceived->save();
                }
                
                $payment = \App\Transaction::find($IsReceived->transaction_id);
                    \Mail::to($IsReceived->email)->send(new SendMail($payment));
                    \Mail::to('info@sja-bataan.com')->send(new NotifyAdminMail($payment));

                return redirect()->route('student.enrollment.index')
                    ->withSuccess('You have successfully accomplished the form. Check your email for review of Finance Dept. Thank you!');
            }else{
                return redirect()->route('student.enrollment.index')
                    ->withError('Payment was not successful.');
            }   
            
        }
    }
    
   
}
