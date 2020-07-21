<?php

namespace App\Http\Controllers\Finance;

use App\MiscFee;
use App\OtherFee;
use App\Enrollment;
use App\GradeLevel;
use App\SchoolYear;
use App\TuitionFee;
use App\ClassDetail;
use App\DiscountFee;
use App\Transaction;
use App\DownpaymentFee;
use App\IncomingStudent;
use App\PaymentCategory;
use App\StudentCategory;
use App\StudentInformation;
use App\TransactionDiscount;
use App\TransactionOtherFee;
use Illuminate\Http\Request;
use App\TransactionMonthPaid;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class StudentAccountController extends Controller
{
    public function index(Request $request){
        $stud_id = Crypt::decrypt($request->c);
        $Profile = StudentInformation::where('id', $stud_id)->first(); 
        $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first();                

        $StudentInformation = NULL;

        $IncomingStudentCount = IncomingStudent::where('student_id', $stud_id)
                ->where('school_year_id', $School_year_id->id)
                ->first();

        if($IncomingStudentCount){
            $grade_level_id = $IncomingStudentCount->grade_level_id;
        }

        if(!$IncomingStudentCount){
            $Enrollment = Enrollment::where('student_information_id', $stud_id)
                ->where('status', 1)
                ->where('current', 1)
                ->orderBy('id', 'DESC')
                ->first();
            
            $ClassDetail = ClassDetail::where('id', $Enrollment->class_details_id)
                ->where('status', 1)->where('current', 1)->orderBY('grade_level', 'DESC')->first();

            $grade_level_id = ($ClassDetail->grade_level + 1);
        }

        if($request->ajax()){
            $stud_id = Crypt::decrypt($request->c);
            $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
            $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
            $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
            $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
            $StudentCategory = StudentCategory::where('status', 1)->get();      

            $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee','other_fee')
                ->where('status', 1)
                ->where('current', 1)
                ->orderBY('grade_level_id', 'ASC')
                ->get();

            $Transaction = Transaction::with('payment_cat')->where('student_id', $stud_id)
                ->where('status', 1)->where('school_year_id', $SchoolYear->id )->first();

            $StudentInformation = StudentInformation::with(['user','transactions'])
                ->where('id', $stud_id)
                ->first();
            
            $Downpayment = DownpaymentFee::where('status', 1)
                ->where('grade_level_id', $grade_level_id)
                ->get();

            $student_payment_category = PaymentCategory::with('misc_fee','tuition')
                ->where('grade_level_id',  $grade_level_id)->first();

            if($Transaction){
            
                $Payment =  PaymentCategory::where('id', $Transaction->payment_category_id)->first();
                $MiscFee_payment =  MiscFee::where('id', $Payment->misc_fee_id)->first();
                $Tuitionfee_payment =  TuitionFee::where('id', $Payment->tuition_fee_id)->first();
                $Stud_cat_payment =  StudentCategory::where('id', $Payment->student_category_id)->first();

                $TransactionMonthPaid = TransactionMonthPaid::where('student_id', $stud_id)
                    ->where('school_year_id', $SchoolYear->id)
                    ->where('approval', 'Approved')
                    ->orderBY('id', 'DESC')->get();

                $TransactionOR = TransactionOtherFee::where('student_id', $stud_id)
                    ->where('school_year_id', $SchoolYear->id)->orderBY('id', 'DESC')
                    ->distinct()
                    ->get(['or_no']);

                $TransactionDiscount = TransactionDiscount::where('student_id', $stud_id)
                    ->where('school_year_id', $SchoolYear->id)
                    ->where('isSuccess', 1)
                    ->get();

                $AccountOthers = TransactionOtherFee::where('student_id', $stud_id)
                    ->where('school_year_id', $SchoolYear->id)->first();

                $Account = TransactionMonthPaid::where('student_id', $stud_id)
                    ->where('school_year_id', $SchoolYear->id)->first();

                $others = TransactionOtherFee::where('student_id', $stud_id)
                    ->where('transaction_id', $Transaction->id)
                    ->where('school_year_id', $SchoolYear->id)
                    ->where('isSuccess', 1)
                    ->get();
                
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
                    ,'Account','TransactionOR','AccountOthers','student_payment_category','Downpayment','grade_level_id', 'others','TransactionDiscount'
                    ));
        }

        $Gradelvl = GradeLevel::where('current', 1)->where('status', 1)->get();
        $Discount = DiscountFee::where('current', 1)->where('status', 1)->get();
        $OtherFee = OtherFee::where('current', 1)->where('status', 1)->get();  
        $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();
        $StudentCategory = StudentCategory::where('status', 1)->get();  

        $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee','other_fee')
            ->where('status', 1)
            ->where('current', 1)
            ->orderBY('grade_level_id', 'ASC')
            ->get();

        $Transaction = Transaction::with('payment_cat')
            ->where('student_id', $stud_id)
            ->where('status', 1)
            ->where('school_year_id', $SchoolYear->id)->first();

        $StudentInformation = StudentInformation::with(['user','transactions'])
            ->where('id', $stud_id)
            ->first();

        $Downpayment = DownpaymentFee::where('status', 1)
            ->where('grade_level_id', $grade_level_id)
            ->get();

        $student_payment_category = PaymentCategory::with('misc_fee','tuition')
            ->where('grade_level_id',  $grade_level_id)->first();

        if($Transaction){
        
            $Payment =  PaymentCategory::where('id', $Transaction->payment_category_id)->first();
            
            $MiscFee_payment =  MiscFee::where('id', $Payment->misc_fee_id)->first();
            $Tuitionfee_payment =  TuitionFee::where('id', $Payment->tuition_fee_id)->first();
            $Stud_cat_payment =  StudentCategory::where('id', $Payment->student_category_id)->first();

            $TransactionMonthPaid = TransactionMonthPaid::where('student_id', $stud_id)
                                    ->where('school_year_id', $SchoolYear->id)
                                    ->where('isSuccess', 1)
                                    ->where('approval', 'Approved')
                                    ->orderBY('id', 'DESC')
                                    ->get();

            $AccountOthers = TransactionOtherFee::where('student_id', $stud_id)
                ->where('school_year_id', $SchoolYear->id)->first();                                       
            
            $TransactionOR = TransactionOtherFee::where('student_id', $stud_id)
                ->where('school_year_id', $SchoolYear->id)
                ->distinct()
                ->get(['or_no']);    
                
            $others = TransactionOtherFee::where('student_id', $stud_id)
                ->where('transaction_id', $Transaction->id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('isSuccess', 1)
                ->get();

            $TransactionDiscount = TransactionDiscount::where('student_id', $stud_id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('isSuccess', 1)
                ->get();

            
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
                    ,'Account','TransactionOR','AccountOthers','Downpayment','student_payment_category','grade_level_id', 'others','TransactionDiscount'));
    }


    public function save_data (Request $request)
    {
        $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first()->id;

        if($request->stud_status == 0){
            
            $rules = [
                'payment_category' => 'required',
                'or_number' => 'required',
                'payment' => 'required',
            ];

            $Validator = \Validator($request->all(), $rules);

            if ($Validator->fails())
            {
                return response()->json(['res_code' => 1, 'res_msg' 
                    => 'Please fill all required fields.', 'res_error_msg' 
                    => $Validator->getMessageBag()]);
            }

            $Transaction = new Transaction();
            $Transaction->payment_category_id = $request->payment_category;
            $Transaction->student_id = $request->id;
            $Transaction->school_year_id = $School_year_id;

            if(!empty($request->downpayment1)){
                foreach($request->downpayment1 as $downpayment_id){
                    $Transaction->downpayment_id = $downpayment_id;
                }
            }            
            
            $Transaction->save();

            $Enrollment = new TransactionMonthPaid();
            $Enrollment->or_no = $request->or_number;
            $Enrollment->student_id = $request->id;
            $Enrollment->payment = $request->payment;
            $Enrollment->school_year_id = $School_year_id;
            $Enrollment->balance = 0;

            if($request->email){
                $Enrollment->email = $request->email; 
            }else{
                $Enrollment->email = 'none';
            }
           
            $Enrollment->number = 'na';
            $Enrollment->payment_option = 'Appointment';
            $Enrollment->transaction_id = $Transaction->id;
            $Enrollment->approval = 'Approved';    
            $Enrollment->isSuccess = 0;    
            $Enrollment->save();    

            $PaymentCategory = PaymentCategory::with('stud_category','tuition','misc_fee','other_fee')
                ->where('id', $request->payment_category)
                ->where('status', 1)->first();
            
            $total_disc = 0;
            if(!empty($request->discount)){
                foreach($request->discount as $get_data){
                    $DiscountFee = DiscountFee::where('id', $get_data)
                        ->where('current', 1)
                        ->where('status', 1)
                        ->first();
                    
                    $total_disc += $DiscountFee->disc_amt;

                    $DiscountFeeSave = new TransactionDiscount();
                    $DiscountFeeSave->student_id = $request->id;
                    $DiscountFeeSave->discount_type = $DiscountFee->disc_type;
                    $DiscountFeeSave->discount_amt = $DiscountFee->disc_amt;
                    $DiscountFeeSave->transaction_month_paid_id = $Enrollment->id;
                    $DiscountFeeSave->school_year_id = $School_year_id;
                    $DiscountFeeSave->isSuccess = 1;
                    $DiscountFeeSave->save();
                }
            }            
            // echo $total_others;

            $TutionFee = TuitionFee::where('id', $PaymentCategory->tuition_fee_id)->where('status', 1)->first();
            $MiscFee   = MiscFee::where('id', $PaymentCategory->misc_fee_id)->where('status', 1)->first();
            $Discount  = DiscountFee::where('id', $request->discount)->where('status', 1)->where('current', 1)->first();
            $OtherFee  = OtherFee::where('id', $PaymentCategory->other_fee_id)->where('status', 1)->where('current', 1)->first();
            

            // other will save here
            $of = new TransactionOtherFee();
            $of->transaction_id = $Transaction->id;
            $of->student_id = $request->id;
            $of->others_fee_id = $OtherFee->id;
            $of->school_year_id = $School_year_id;
            $of->other_name = $OtherFee->other_fee_name;
            $of->item_qty = 1;
            $of->item_price = $OtherFee->other_fee_amt;
            $of->isSuccess = 1;
            $of->save();
            

            // tuition and misc
            $total_1 = $TutionFee->tuition_amt + $MiscFee->misc_amt + $OtherFee->other_fee_amt;
            
            $total_2 = ($total_1 - $total_disc);
            $total_balance = ($total_2 - $request->payment);

            $Transaction_month_paid_balance = 
                TransactionMonthPaid::where('id', $Enrollment->id)
                ->first();

            if($Transaction_month_paid_balance ){
                $Transaction_month_paid_balance->balance = $total_balance;
                $Transaction_month_paid_balance->isSuccess = 1;
                $Transaction_month_paid_balance->save();
            }

            if($request->email)
            {
                // this transaction will send to the customer
            }
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        else
        {
            $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first()->id;

            $rules = [
                // 'months' => 'required',
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
            
           
            $Transaction = Transaction::where('school_year_id', $School_year_id)
                ->where('student_id', $request->id)->first();

            $recent_balance =  TransactionMonthPaid::where('school_year_id', $School_year_id)
                ->where('transaction_id', $Transaction->id)
                ->orderBY('id', 'DESC')
                ->where('approval', 'Approved')
                ->where('isSuccess', 1)
                ->first();

            $total_bal = $recent_balance->balance - $request->payment_bill;
            
            $TransactionMonthsPaid = new TransactionMonthPaid();
            $TransactionMonthsPaid->or_no = $request->or_number_payment; //ok
            $TransactionMonthsPaid->transaction_id = $Transaction->id; //ok
            $TransactionMonthsPaid->student_id = $request->id;//ok
            $TransactionMonthsPaid->school_year_id = $School_year_id;//ok 
            $TransactionMonthsPaid->payment = $request->payment_bill;//ok
            $TransactionMonthsPaid->email = $request->email ? $request->email : '';
            $TransactionMonthsPaid->balance = $total_bal;
            $TransactionMonthsPaid->number = 'NA';
            $TransactionMonthsPaid->payment_option = 'Appointment';
            $TransactionMonthsPaid->approval = 'Approved';
            $TransactionMonthsPaid->isSuccess = 1;
            $TransactionMonthsPaid->save();


            $total_disc = 0;
            if(!empty($request->_discount)){
                foreach($request->_discount as $get_data){

                    $DiscountFee = DiscountFee::where('id', $get_data)
                        ->where('current', 1)
                        ->where('status', 1)
                        ->first();
                    
                    $total_disc += $DiscountFee->disc_amt;

                    $DiscountFeeSave = new TransactionDiscount();
                    $DiscountFeeSave->student_id = $request->id;
                    $DiscountFeeSave->discount_type = $DiscountFee->disc_type;
                    $DiscountFeeSave->discount_amt = $DiscountFee->disc_amt;
                    $DiscountFeeSave->transaction_month_paid_id = $TransactionMonthsPaid->id;
                    $DiscountFeeSave->school_year_id = $School_year_id;
                    $DiscountFeeSave->isSuccess = 1;
                    $DiscountFeeSave->save();
                }
            }    
            
            $total_balance = ($recent_balance->balance - $total_disc);

            $Transaction_month_paid_balance = 
                TransactionMonthPaid::where('id', $TransactionMonthsPaid->id)
                ->first();

            if($Transaction_month_paid_balance ){
                $Transaction_month_paid_balance->balance = $total_balance;
                $Transaction_month_paid_balance->isSuccess = 1;
                $Transaction_month_paid_balance->save();
            }

            if($request->email)
            {
                // if meron
            }
            
            return response()->json([
                'res_code' => 0, 
                'res_msg' => 'Data successfully saved monthly account.'
            ]);
        }
    }

    public function save_others(Request $request)
    {
        $School_year_id = SchoolYear::where('status', 1)
            ->where('current', 1)->first()->id;

        $stud_id = $request->id;

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

        $Transaction = Transaction::where('school_year_id', $School_year_id)
            ->where('student_id', $stud_id)->first();

        if(!empty($request->id_qty)){
            
            foreach($request->id_qty as $get_data){
                $data_description = explode(".", $get_data);      

                $TransactionOtherFee = new TransactionOtherFee();               
                $TransactionOtherFee->student_id = $stud_id;//ok
                $TransactionOtherFee->transaction_id = $Transaction->id;
                $TransactionOtherFee->or_no = $request->or_number_others;//ok
                $TransactionOtherFee->others_fee_id = $data_description[0];//ok
                $TransactionOtherFee->item_qty = $data_description[1];//ok
                $TransactionOtherFee->item_price = $data_description[2];
                $TransactionOtherFee->other_name = $data_description[3];//ok
                $TransactionOtherFee->school_year_id = $School_year_id;
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

            $Transaction = Transaction::with('payment_cat')
                ->where('student_id', $request->id)
                ->where('status', 1)->first();

            $TransactionMonthPaid = TransactionMonthPaid::where('student_id', $request->id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('approval', 'Approved')
                ->orderBY('id', 'DESC')->get();
            
        }

        
        //with existing account
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
        return 
            view('control_panel_finance.student_payment_account.partials.student_with_account.modal_payment',
            compact(
                'StudentInformation','Profile','Gradelvl','Discount','OtherFee','SchoolYear','StudentCategory',
                'PaymentCategory','Transaction','School_year_id','Payment','MiscFee_payment','Tuitionfee_payment',
                'Stud_cat_payment','Transaction_disc','TransactionMonthPaid'
                ))->render(); 
    
        
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
