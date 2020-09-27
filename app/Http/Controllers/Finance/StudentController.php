<?php

namespace App\Http\Controllers\Finance;

use App\MiscFee;
use App\OtherFee;
use App\GradeLevel;
use App\SchoolYear;
use App\TuitionFee;
use App\ClassDetail;
use App\DiscountFee;
use App\Transaction;
use App\PaymentCategory;
use App\StudentCategory;
use App\StudentInformation;
use App\TransactionDiscount;
use App\TransactionOtherFee;
use Illuminate\Http\Request;
use App\TransactionMonthPaid;
use App\Traits\hasNotYetApproved;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    use hasNotYetApproved;
    
    public function listSection(Request $request)
    {
        $class_details_section = ClassDetail::where('school_year_id', $request->school_year)
            ->orderBY('grade_level', 'ASC')->get();

        $class_list_section ="<option>Select Section</option>";

        foreach($class_details_section as $data)
        {
            $class_list_section .="<option value=".$data->id.">".$data->section->section." - Grade ".$data->grade_level."</option>";
        }

        return $class_list_section;
    }

    public function index (Request $request) 
    {
        $School_years = SchoolYear::where('status', 1)->orderBY('school_year', 'DESC')->get();       

        $School_year_id = SchoolYear::where('status', 1)
            ->where('current', 1)->first()->id;

        if ($request->ajax())
        {
            
                try{
                    $Transaction = Transaction::with('payment_cat')
                        ->where('school_year_id', $request->school_year)
                        ->where('student_id', $request->id)
                        ->where('status', 1)->first();
    
                    $query = StudentInformation::with(['user', 'enrolled_class', 'finance_transaction']);                        
                   

                        if($request->search)
                        {
                            $hasUser = '0';  

                            $query->where(function ($q) use ($request) {
                                $q->where('first_name', 'like', '%'.$request->search.'%');
                                $q->orWhere('middle_name', 'like', '%'.$request->search.'%');
                                $q->orWhere('last_name', 'like', '%'.$request->search.'%');
                                // $query->orWhere('enrollments.class_details_id', 'like', '%'.$request->section_list.'%'$request->section_list);
                            });

                            $StudentInformation = $query->where('status', 1)
                                ->orderBY('last_name', 'ASC')
                                ->paginate(10);
                        }
                        else
                        {
                            $hasUser = '0';  

                            $StudentInformation = $query->where('status', 1)
                                ->orderBY('last_name', 'ASC')
                                ->paginate(10);
                        }
                        
                        if($request->section_list || $request->school_year != 0)
                        {
                            $hasUser = '1';  

                            $query_join = StudentInformation::join('enrollments', 'enrollments.student_information_id', '=','student_informations.id')
                                ->join('users', 'users.id', '=', 'student_informations.user_id')          
                                ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                                ->selectRaw('
                                    student_informations.last_name,
                                    student_informations.first_name,  
                                    student_informations.middle_name,
                                    student_informations.gender,
                                    student_informations.status,
                                    student_informations.id,
                                    class_details.school_year_id,
                                    class_details.id as class_details_id,
                                    users.username                       
                                ');

                            $query_join->where(function ($q) use ($request) {
                                $q->where('first_name', 'like', '%'.$request->search.'%');
                                $q->orWhere('middle_name', 'like', '%'.$request->search.'%');
                                $q->orWhere('last_name', 'like', '%'.$request->search.'%');
                                // $query->orWhere('enrollments.class_details_id', 'like', '%'.$request->section_list.'%'$request->section_list);
                            });
                            
                            $query_join->where('enrollments.class_details_id', $request->section_list);  

                            $query_join->where('class_details.school_year_id', $request->school_year);

                            $StudentInformation = $query_join->where('student_informations.status', 1)
                                ->orderBY('student_informations.last_name', 'ASC')
                                ->distinct('student_informations.id')
                                ->paginate(10);
                        }   
                    
                    $NotyetApprovedCount = $this->notYetApproved();
    
                    // return json_encode(['student_info' => $StudentInformation]);
                    return view('control_panel_finance.student_information.partials.data_list', 
                        compact('StudentInformation','Transaction','School_year_id','hasUser', 'NotyetApprovedCount','School_years'))->render();

                }catch(\Exception $e){                
                    return '<div class="box-body"><div class="row"><table class="table"><tbody><tr><th style="text-align:center"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.</th></tr></tbody></table></div></div>';
                }
        }
        
        $StudentInformation = StudentInformation::with(['user', 'enrolled_class', 'finance_transaction'])
            ->where('status', 1)
            ->orderBY('last_name', 'ASC')
            ->paginate(10);
        
        $hasUser = '0';

        $Transaction = Transaction::with('payment_cat')
            ->where('school_year_id', $School_year_id)
            ->where('student_id', $request->id)
            ->where('status', 1)->first();

        $NotyetApprovedCount = $this->notYetApproved();
        // return json_encode(['student_info' => $StudentInformation]);
        return view('control_panel_finance.student_information.index', 
            compact('StudentInformation','Transaction','School_year_id','hasUser','NotyetApprovedCount','School_years'));
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

            $TransactionMonthPaid = TransactionMonthPaid::where('transaction_id', $Transaction->id)
                ->where('student_id', $request->id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('isSuccess', 1)
                ->where('approval', 'Approved')
                ->first();
            
            $TransactionDiscount = TransactionDiscount::where('student_id', $request->id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('isSuccess', 1)
                ->first();            
        }

        if(!$Transaction){
            return view('control_panel_finance.student_information.partials.modal_data', 
                compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory',
                        'PaymentCategory','Transaction','School_year_id','TransactionDiscount', 'TransactionMonthPaid'))->render();  
        }else{
            // existing account
            $Payment =  PaymentCategory::where('id', $Transaction->payment_category_id)->first();
            $MiscFee_payment =  MiscFee::where('id', $Payment->misc_fee_id)->first();
            $Tuitionfee_payment =  TuitionFee::where('id', $Payment->tuition_fee_id)->first();
            $Stud_cat_payment =  StudentCategory::where('id', $Payment->student_category_id)->first();
            if($Transaction){
                $Transaction_disc = TransactionDiscount::with('discountFee')->where('or_no', $Transaction->or_number)
                    ->get(); 
            }     
            else{
                return "Save the transaction first!";
            }  
            return view('control_panel_finance.student_information.partials.modal_account',
                compact('StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory',
                'PaymentCategory','Transaction','School_year_id','Payment','MiscFee_payment','Tuitionfee_payment','Stud_cat_payment','Transaction_disc'
                ,'TransactionDiscount','TransactionMonthPaid'))->render(); 
        }
        
                // return view('profile', array('user' => Auth::user()) );        
    }

    // public function data_student (Request $request)
    // {
    //     return view('control_panel_finance.student_information.index');
    // }

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
            $total_current_bal = $current_bal - $request->payment_bill;

            $Transaction->balance = $total_current_bal;
            $Transaction->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved monthly account.']);
        }
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

        // if (!$request->syid || !$request->studid || !$request->or_num || !$request->stud_status) 
        // {
        //     return "Invalid request";
        // }
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
    
}
