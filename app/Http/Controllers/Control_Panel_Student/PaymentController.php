<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Carbon\Carbon;
use App\SchoolYear;
use PayPal\Api\Item;

/** Paypal Details classes **/
use PayPal\Api\Payer;
use App\Mail\SendMail;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use App\StudentInformation;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use App\Mail\NotifyAdminMail;
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
            new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret'))
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
            'e_downpayment' => 'required',
            'pay_fee' => 'required',
            // 'phone' => 'required',
            'email'=>'required'
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
        $item->setName('Tuition Fee (SJAI))')
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
        $transaction->setAmount($amount)->setItemList($itemList)
        ->setDescription($request->description_name);
        //You can set custom data with '->setCustom($data)' or put it in a session.

        // Create a redirect urls, cancel url brings us back to current page, return url takes us to confirm payment.
        // $baseUrl = getBaseUrl();
        // $redirectUrls = new RedirectUrls();
        // $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
        // ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('confirm-payment'))
            ->setCancelUrl(route('student.create-payment.paypal'));
        

        // We set up the payment with the payer, urls and transactions.
        // Note: you can have different itemLists, then different transactions for it.
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)
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
            
            $Enrollment = new \App\Transaction();
            $Enrollment->or_number = $StudentInformation->first_name.''.$mytime->toDateTimeString();
            $Enrollment->payment_category_id = $request->tution_category;
            $Enrollment->student_id = $StudentInformation->id;
            $Enrollment->school_year_id = $SchoolYear->id;
            $Enrollment->downpayment = $request->pay_fee;
            $Enrollment->number = $request->phone;
            $Enrollment->email = $request->email;
            $Enrollment->balance = $request->result_current_bal;
            $Enrollment->payment_option = 'Credit Card/Debit Card';   

            if($Enrollment->save()){
                return response()->json([$redirect_url]);
            }else{
                return redirect()->back()->withError('Unknown error occurred');
            }
            
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

            $IsReceived = \App\Transaction::where('student_id', $StudentInformation->id)
                ->where('school_year_id', $SchoolYear->id)->orderBy('id', 'Desc')->first();
            $IsReceived->or_number =  $payment->invoice_id;
            $IsReceived->isSuccess = 1;  
            $admin_email = 'info@sja-bataan.com';
            if($IsReceived->save()){
                $payment = \App\Transaction::find($IsReceived->id);
                    \Mail::to($IsReceived->email)->send(new SendMail($payment));
                    \Mail::to($admin_email)->send(new NotifyAdminMail($payment));

                return redirect()->route('student.enrollment.index')
                    ->withSuccess('You have successfully accomplished the form. Check your email for review of Finance Dept. Thank you!');
            }else{
                return redirect()->route('student.enrollment.index')
                    ->withError('Payment was not successful.');
            }   
            
        }
    }
    
    // start of function
    // this espects a post request from the paypal pay now form
    function paypalPdt(Request $r){

        // return redirect()->route('student.enrollment.index')->withSuccess('PDT made successfully.');
        // Change to www.sandbox.paypal.com for testing or www.paypal.com for live
        $pp_hostname = "https://www.sandbox.paypal.com/"; 

        // read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-synch';
        
        //transaction number
        $tx_token = $_GET['tx']; 

        // you'll get this in paypal pdt settings
        $auth_token = $tx_token;

        $req .= "&tx=$tx_token&at=$auth_token";
        
        // curl from paypal
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        //set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
        //if your server does not bundled with default verisign certificates.
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
        $res = curl_exec($ch);
        curl_close($ch);
        if(!$res){
            return "curl error";
        }else{
            // parse the data from the submitted paypal pay now form
            $lines = explode("\n", trim($res));
            $keyarray = array();
            // if payment status in paypal is success
            if (strcmp ($lines[0], "SUCCESS") == 0) {
                for ($i = 1; $i < count($lines); $i++) {
                    $temp = explode("=", $lines[$i],2);
                    $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
                }

            // assign data to variable
            $firstname = $keyarray['first_name'];
            $lastname = $keyarray['last_name'];
            $itemname = $keyarray['item_name'];
            $amount = $keyarray['mc_gross'];

            // these are custom aditional variable that is set in the paypal pay now form
            // I used this to Identify the referrer url and the id that points to the database row id 
            parse_str($keyarray['custom'],$_MYVAR);
            
            // here I assigned the referrer to a variable
            $referrer =  $_MYVAR['web'];
            // here I assigned the row id to a variable
            $referrer_trans_id = $_MYVAR['id'];
            
            // here I deal with the each referrer because I have 2 websites pap and papja using the same paypal account
            // papja payment referrer
            if($referrer == '0'){
                // update the database row as paid
                $User = \Auth::user();
                $StudentInformation = StudentInformation::where('user_id', $User->id)->first();

                $SchoolYear = SchoolYear::where('current', 1)
                    ->where('status', 1)
                    ->orderBY('id', 'DESC')
                    ->first();

                $IsReceived = \App\Transaction::where('student_id', $StudentInformation->id)->where('school_year_id', $SchoolYear->id)->orderBy('id', 'Desc')->first();
                $IsReceived->or_number =  $payment->invoice_id;
                $IsReceived->isSuccess = 1;  
                $IsReceived->save();

                $payment = \App\Transaction::find($IsReceived->id);

                    \Mail::to($IsReceived->email)->send(new SendMail($payment));
                // Ticket::where('id', $referrer_trans_id)->update([
                //     'status' => 1,
                //     'method' => 2,
                //     'reference' => $keyarray['txn_id']
                // ]);
                // User::where('ticket', $referrer_trans_id)->update([
                //     'status' => 1
                // ]);

                // // get the updated database row
                // $ticket = Ticket::find($referrer_trans_id);

                // queue email notification
                // \Mail::to($ticket->email)->send(new Activate($ticket));
                
                // redirect to thank you page 
                // return redirect('/paypal/status/' . 1);
                return redirect()->route('student.enrollment.index')->withSuccess('Payment made successfully.');
            }
            // for pap payment referrer
            elseif($referrer == '1'){

                    // update database row as paid
                    $registration = PapRegistration::find($referrer_trans_id);
                    PapRegistration::where('id', $referrer_trans_id)->update([
                        'status' => 1
                    ]);

                    // queue email notification
                    \Mail::to($registration->email)
                    ->send(new PapRenew($registration));
                    
                    // redirect to thank you page or home page
                    // temporary page
                    return redirect('https://www.pap.org.ph/');
                }
            }
            
            // if payment failed redirect to failed page
            else if (strcmp ($lines[0], "FAIL") == 0) {
                // redirect to failed page
                return redirect('/paypal/status/' . 0);
            }
        }
    }
}
