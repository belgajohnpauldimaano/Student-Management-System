<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentInformation;
use App\GradeLevel;
use App\DiscountFee;
use App\OtherFee;
use App\SchoolYear;
use App\StudentCategory;
use App\PaymentCategory;
use App\Transaction;
use App\TransactionOtherFee;
use App\TransactionMonthPaid;
use App\TuitionFee;
use App\MiscFee;
use App\TransactionDiscount;

class StudentAccountController extends Controller
{
    public function index(Request $request){
        $stud_id = \Crypt::decrypt($request->c);
        $Profile = StudentInformation::where('id', $stud_id)->first(); 
        $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first();

        $StudentInformation = NULL;
        if($request->ajax()){
            $stud_id = \Crypt::decrypt($request->c);
            $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
            $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
            $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
            $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
            $StudentCategory = StudentCategory::where('status', 1)->get();        
            $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
                ->where('status', 1)->where('current', 1)->get();
            $Transaction = Transaction::with('payment_cat')->where('student_id', $stud_id)
                ->where('status', 1)->where('school_year_id', $SchoolYear->id )->first();
            $StudentInformation = StudentInformation::with(['user','transactions'])
                ->where('id', $stud_id)
                ->first();

            if($Transaction){
            
                $Payment =  PaymentCategory::where('id', $Transaction->payment_category_id)->first();
                $MiscFee_payment =  MiscFee::where('id', $Payment->misc_fee_id)->first();
                $Tuitionfee_payment =  TuitionFee::where('id', $Payment->tuition_fee_id)->first();
                $Stud_cat_payment =  StudentCategory::where('id', $Payment->student_category_id)->first();

                $TransactionMonthPaid = TransactionMonthPaid::where('student_id', $stud_id)
                                        ->where('school_year_id', $SchoolYear->id)->orderBY('id', 'DESC')->get();

                $TransactionOR = TransactionOtherFee::where('student_id', $stud_id)
                    ->where('school_year_id', $SchoolYear->id)->orderBY('id', 'DESC')
                    ->distinct()
                    ->get(['or_no']);   

                $AccountOthers = TransactionOtherFee::where('student_id', $stud_id)
                    ->where('school_year_id', $SchoolYear->id)->first();

                $Account = TransactionMonthPaid::where('student_id', $stud_id)
                    ->where('school_year_id', $SchoolYear->id)->first();
                
                if($Transaction){
                    $Transaction_disc = TransactionDiscount::with('discountFee')->where('or_no', $Transaction->or_number)
                    ->get(); 
                }else{
                    return "Save the transaction first!";
                }  
            }

            $StudentInformation = StudentInformation::with(['user'])
            ->where('id', $stud_id)
            ->first();

            return view('control_panel_finance.student_payment_account.partials.data_list', 
            compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory','Transaction'
                    ,'Stud_cat_payment','Payment','MiscFee_payment','Tuitionfee_payment','School_year_id','Transaction_disc','TransactionMonthPaid'
                    ,'Account','TransactionOR','AccountOthers'
                    ));
        }

        $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
        $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
        $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
        $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
        $StudentCategory = StudentCategory::where('status', 1)->get();        
        $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
            ->where('status', 1)->where('current', 1)->get();

        $Transaction = Transaction::with('payment_cat')
            ->where('student_id', $stud_id)
            ->where('status', 1)
            ->where('school_year_id', $SchoolYear->id)->first();

        $StudentInformation = StudentInformation::with(['user','transactions'])
            ->where('id', $stud_id)
            ->first();

        if($Transaction){
        
            $Payment =  PaymentCategory::where('id', $Transaction->payment_category_id)->first();
            $MiscFee_payment =  MiscFee::where('id', $Payment->misc_fee_id)->first();
            $Tuitionfee_payment =  TuitionFee::where('id', $Payment->tuition_fee_id)->first();
            $Stud_cat_payment =  StudentCategory::where('id', $Payment->student_category_id)->first();

            $TransactionMonthPaid = TransactionMonthPaid::where('student_id', $stud_id)
                                    ->where('school_year_id', $SchoolYear->id)
                                    ->where('isSuccess', 1)
                                    ->orderBY('id', 'DESC')->get();

            $AccountOthers = TransactionOtherFee::where('student_id', $stud_id)
                ->where('school_year_id', $SchoolYear->id)->first();                                       
            
            $TransactionOR = TransactionOtherFee::where('student_id', $stud_id)
                ->where('school_year_id', $SchoolYear->id)
                ->distinct()
                ->get(['or_no']);    
                
            
            
            $Account = TransactionMonthPaid::where('student_id', $stud_id)->first();   

            if($Transaction){
                $Transaction_disc = TransactionDiscount::with('discountFee')->where('or_no', $Transaction->or_number)
                ->get(); 
            }     
            else{
                return "Save the transaction first!";
            }  
        }
        // return json_encode(['student_info' => $StudentInformation]);
        return view('control_panel_finance.student_payment_account.index', 
            compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory','PaymentCategory','Transaction'
                    ,'Stud_cat_payment','Payment','MiscFee_payment','Tuitionfee_payment','School_year_id','Transaction_disc','TransactionMonthPaid'
                    ,'Account','TransactionOR','AccountOthers'));
    }


    public function save_data (Request $request) 
    {
        $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first();

        if($request->stud_status == 0){
        
            $rules = [
                'payment_category' => 'required',
                'or_number' => 'required',
                'downpayment' => 'required',     
            ];

            $Validator = \Validator($request->all(), $rules);

            if ($Validator->fails())
            {
                return response()->json(['res_code' => 1, 'res_msg' 
                    => 'Please fill all required fields.', 'res_error_msg' 
                    => $Validator->getMessageBag()]);
            }

            $Transaction = new Transaction();
            $Transaction->or_number = $request->or_number;
            $Transaction->payment_category_id = $request->payment_category;
            $Transaction->student_id = $request->id;
            $Transaction->school_year_id = $School_year_id->id;
            $Transaction->downpayment = $request->downpayment;
           
            $Transaction->no_month_paid = 1;

            $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
                ->where('id', $request->payment_category)
                ->where('status', 1)->first();
            
            $total_others = 0;
            if(!empty($request->others)){
                foreach($request->others as $get_data){
                    $OtherFee = OtherFee::where('id', $get_data)
                        ->where('current', 1)
                        ->where('status', 1)->first();

                    $total_others += $OtherFee->other_fee_amt;

                    $OtherFeeSave = new TransactionOtherFee();
                    $OtherFeeSave->or_no = $request->or_number;
                    $OtherFeeSave->student_id = $request->id;
                    $OtherFeeSave->others_fee_id = $get_data;
                    $OtherFeeSave->school_year_id = $School_year_id->id;
                    $OtherFeeSave->save();
                }
            }

            $total_disc = 0;
            if(!empty($request->discount)){
                foreach($request->discount as $get_data){
                    $DiscountFee = DiscountFee::where('id', $get_data)
                        ->where('current', 1)
                        ->where('status', 1)->first();

                    
                    $total_disc += $DiscountFee->disc_amt;

                    $DiscountFeeSave = new TransactionDiscount();
                    $DiscountFeeSave->or_no = $request->or_number;
                    $DiscountFeeSave->student_id = $request->id;
                    $DiscountFeeSave->discount_fee_id = $get_data;
                    $DiscountFeeSave->school_year_id = $School_year_id->id;
                    $DiscountFeeSave->save();
                }
            }
            
            // echo $total_others;

            $TutionFee = TuitionFee::where('id', $PaymentCategory->tuition_fee_id)->where('status', 1)->first();
            $MiscFee   = MiscFee::where('id', $PaymentCategory->misc_fee_id)->where('status', 1)->first();
            $Discount  = DiscountFee::where('id', $request->discount)->where('status', 1)->where('current', 1)->first();
            
            // tuition and misc
            $total_1 = $TutionFee->tuition_amt + $MiscFee->misc_amt;

            
            $total_2 = ($total_1 - $total_disc);
            $total_3 = ($total_2 - $request->downpayment);
            

            $totalmonths =  $PaymentCategory->months - 1;
            $monthlyfee = $total_2 / $PaymentCategory->months;
            // total months left
            $Transaction->total_no_month = $totalmonths;
            // monthly fee
            $Transaction->monthly_fee = $monthlyfee;
            $totalmonths = $PaymentCategory->months - 2;
            $last_fee = $totalmonths  * $monthlyfee;
            $total_lastfee = $total_3 - $last_fee  ;

            // lastfee 
            $Transaction->last_fee = $total_lastfee;
            $Transaction->balance = $total_3;
            $Transaction->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        else
        {
            $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first();

            $rules = [
                'months' => 'required',
                'or_number_payment' => 'required',
                'payment_bill' => 'required',      
            ];

            $Validator = \Validator($request->all(), $rules);

            if ($Validator->fails())
            {
                return response()->json(['res_code' => 1, 'res_msg' 
                    => 'Please fill all required fields.', 'res_error_msg' 
                    => $Validator->getMessageBag()]);
            }   

            
            $TransactionMonthsPaid = new TransactionMonthPaid();
            $TransactionMonthsPaid->or_no = $request->or_number_payment;
            $TransactionMonthsPaid->student_id = $request->id;
            $TransactionMonthsPaid->month_paid = $request->months;
            $TransactionMonthsPaid->school_year_id = $School_year_id->id; //not decided
            $TransactionMonthsPaid->payment = $request->payment_bill;
            $TransactionMonthsPaid->save();

            $Transaction = \App\Transaction::where('school_year_id', $School_year_id->id)
                    ->where('student_id', $request->id)->first();

            $current_bal = $request->js_current_balance;
            $total_current_bal = $current_bal - $request->payment;

            $Transaction->balance = $total_current_bal;
            $Transaction->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved monthly account.']);
        }
    }

    public function save_others(Request $request)
    {
        $School_year_id = SchoolYear::where('status', 1)
            ->where('current', 1)->first();

        $rules = [
            'or_number_others' => 'required'                 
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' 
                => 'Please fill all required fields.', 'res_error_msg' 
                => $Validator->getMessageBag()]);
        }   

        if(!empty($request->id_qty)){
            
            foreach($request->id_qty as $get_data){
                $data_description = explode(".", $get_data);
                
                $TransactionOtherFee = new TransactionOtherFee();               
                $TransactionOtherFee->student_id = $request->id;
                $TransactionOtherFee->or_no = $request->or_number_others;
                $TransactionOtherFee->others_fee_id = $data_description[0];
                $TransactionOtherFee->others_fee_qty = $data_description[1];
                $TransactionOtherFee->others_fee_price = $data_description[2];
                $TransactionOtherFee->school_year_id = $School_year_id->id;
                $TransactionOtherFee->save();
            }

            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        
    }

    public function modal_data (Request $request) 
    {
        $StudentInformation = NULL;
        $Gradelvl = NULL;
        $Profile = StudentInformation::where('id', $request->id)->first(); 
        
        if ($request->id)
        {
            $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first();
            $StudentInformation = StudentInformation::with(['user'])->where('id', $request->id)->first();
            $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
            $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
            $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
            $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
            $StudentCategory = StudentCategory::where('status', 1)->get();
            
            $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
                ->where('status', 1)->where('current', 1)->get();

            $Transaction = Transaction::with('payment_cat')->where('student_id', $request->id)
                ->where('status', 1)->first();
            
        }

        
        //with existing account
        $Payment =  \App\PaymentCategory::where('id', $Transaction->payment_category_id)->first();
        $MiscFee_payment =  \App\MiscFee::where('id', $Payment->misc_fee_id)->first();
        $Tuitionfee_payment =  \App\TuitionFee::where('id', $Payment->tuition_fee_id)->first();
        $Stud_cat_payment =  \App\StudentCategory::where('id', $Payment->student_category_id)->first();
        if($Transaction){
            $Transaction_disc = TransactionDiscount::with('discountFee')->where('or_no', $Transaction->or_number)
            ->get(); 
        }     
        else{
            return "Save the transaction first!";
        }  
        return view('control_panel_finance.student_payment_account.partials.student_with_account.modal_payment',
            compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory',
            'PaymentCategory','Transaction','School_year_id','Payment','MiscFee_payment','Tuitionfee_payment','Stud_cat_payment','Transaction_disc'))->render(); 
    
        
                // return view('profile', array('user' => Auth::user()) );        
    }

    // public function save_modal_account(Request $request){
    //     // return 'save';
    //     $rules = [
    //         'months' => 'required',
    //         'or_number' => 'required',
    //         'payment' => 'required',     
    //     ];

    //     $Validator = \Validator($request->all(), $rules);
    //     return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    // }
    
    public function print_enrollment_bill(Request $request){

        $stud_stats = $request->stud_status;
        $StudentInformation = StudentInformation::with(['user'])->where('id', $request->studid)->first();
        $balance = $request->balance;
        

        if($stud_stats == 0){

            if ($StudentInformation) 
            {  
                $Transaction = Transaction::join('student_informations', 'student_informations.id', '=' ,'transactions.student_id')
                        ->join('school_years', 'school_years.id', '=' ,'transactions.school_year_id')
                        ->join('payment_categories', 'payment_categories.id', 'transactions.payment_category_id')
                        ->select(\DB::raw("
                            CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                            school_years.school_year,
                            transactions.or_number,
                            transactions.downpayment,
                            transactions.monthly_fee,
                            transactions.balance,
                            transactions.payment_category_id,
                            transactions.created_at
                        "))
                        ->where('school_years.id', $request->syid)
                        ->where('student_informations.id', $request->studid)
                        ->where('transactions.or_number', $request->or_num)
                        ->where('transactions.status', 1)
                        ->first();
                    
                if($Transaction){
                    $Transaction_disc = TransactionDiscount::with('discountFee')->where('or_no', $Transaction->or_number)
                    ->get(); 
                }     
                else{
                    return "Save the transaction first!";
                }  

                $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
                    ->where('status', 1)
                    ->where('current', 1)
                    ->where('id', $Transaction->payment_category_id)
                    ->first();

            }
            else
            {
                return "Invalid request";
            }

            
        }else{

            if ($StudentInformation){   

                $TransactionMonthPaid = TransactionMonthPaid::join('student_informations', 'student_informations.id', '=' ,'transaction_month_paids.student_id')
                    ->join('school_years', 'school_years.id', '=' ,'transaction_month_paids.school_year_id')
                    ->join('transactions', 'transactions.student_id', 'transaction_month_paids.student_id' )
                    ->join('payment_categories', 'payment_categories.id', 'transactions.payment_category_id')                   
                    ->select(\DB::raw("
                        CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                        school_years.school_year,
                        transaction_month_paids.or_no,
                        transaction_month_paids.payment,
                        transaction_month_paids.month_paid,                          
                        transactions.balance,
                        transactions.monthly_fee,
                        transactions.payment_category_id,
                        transactions.created_at
                    "))
                    ->where('school_years.id', $request->syid)
                    ->where('student_informations.id', $request->studid)
                    ->where('transaction_month_paids.or_no', $request->or_num)
                    ->where('transactions.status', 1)
                    ->first();

                $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee')
                    ->where('status', 1)
                    ->where('current', 1)
                    ->where('id', $TransactionMonthPaid->payment_category_id)
                    ->first();
            }else{
                return "Invalid request";
            }
        }

        return view('control_panel_finance.student_information.partials.print_enrollment_bill',
                    compact('Transaction','PaymentCategory','Transaction_disc', 'stud_stats','TransactionMonthPaid','balance'));

            $pdf = \PDF::loadView('control_panel_finance.student_information.partials.print_enrollment_bill', 
                    compact('Transaction','PaymentCategory','Transaction_disc', 'stud_stats','TransactionMonthPaid','balance'));
            $pdf->setPaper('Letter', 'portrait');
            return $pdf->stream();
    }
     
    public function history(){
        $hello = 'this is history';
        return view('control_panel_finance.student_payment_account.partials.data_list', compact('hello'))->render();
    }
    
}
