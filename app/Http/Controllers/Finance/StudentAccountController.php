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
use App\Mail\SendMail;
use App\DownpaymentFee;
use App\IncomingStudent;
use App\PaymentCategory;
use App\StudentCategory;
use App\FinanceInformation;
use App\StudentInformation;
use App\TransactionDiscount;
use App\TransactionOtherFee;
use Illuminate\Http\Request;
use App\Mail\NotifyAdminMail;
use App\TransactionMonthPaid;
use App\Traits\hasNotYetApproved;
use App\Mail\SendManualFinanceMail;
use App\Mail\sendManualStudentMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class StudentAccountController extends Controller
{
    use hasNotYetApproved;
    
    public function index(Request $request){
        $stud_id = Crypt::decrypt($request->c);
        $Profile = StudentInformation::where('id', $stud_id)->first(); 
        
        if(!$request->school_year)
        {
            $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first()->id; 
        }
        else
        {
            $School_year_id = $request->school_year;
        }                              

        $StudentInformation = NULL;
        
        $IncomingStudentCount = IncomingStudent::where('student_id', $stud_id)
            ->where('school_year_id', $School_year_id)
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
            // return $Enrollment->class_details_id;
            // if(!$request->class_details){
                $ClassDetail = ClassDetail::where('id', $Enrollment->class_details_id)
                    ->whereStatus(1)->whereCurrent(1)->latest()->first();
            // }else{
            //     $ClassDetail = ClassDetail::where('id', $request->class_details)
            //         ->whereStatus(1)->whereCurrent(1)->latest()->first();
            // }            

            $grade_level_id = ($ClassDetail->grade_level);
        }
        else
        {
            $ClassDetail = 0;
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
            ->where('school_year_id', $School_year_id)->first();

        $StudentInformation = StudentInformation::with(['user','transactions'])
            ->where('id', $stud_id)
            ->first();

        $Downpayment = DownpaymentFee::where('status', 1)
            ->where('grade_level_id', $grade_level_id)
            ->get();

        $student_payment_category = PaymentCategory::with('misc_fee','tuition')
            ->where('grade_level_id',  $grade_level_id)->first();
        
            $NotyetApprovedCount = $this->notYetApproved();

        if($Transaction){
        
            $Payment =  PaymentCategory::where('id', $Transaction->payment_category_id)->first();
            
            $MiscFee_payment =  MiscFee::where('id', $Payment->misc_fee_id)->first();
            $Tuitionfee_payment =  TuitionFee::where('id', $Payment->tuition_fee_id)->first();
            $Stud_cat_payment =  StudentCategory::where('id', $Payment->student_category_id)->first();

            $TransactionMonthPaid = TransactionMonthPaid::where('student_id', $stud_id)
                ->where('school_year_id', $School_year_id)
                ->where('isSuccess', 1)
                ->where('approval', 'Approved')
                ->orderBY('id', 'DESC')
                ->get();

            $AccountOthers = TransactionOtherFee::where('student_id', $stud_id)
                ->where('school_year_id', $School_year_id)->first();                                       
            
            $TransactionOR = TransactionOtherFee::where('student_id', $stud_id)
                ->where('school_year_id', $School_year_id)
                ->distinct()
                ->get(['or_no']);    
            
            try {
                $others = TransactionOtherFee::where('student_id', $stud_id)
                ->where('transaction_id', $Transaction->id)
                ->where('school_year_id', $School_year_id)
                ->where('isSuccess', 1)
                ->get();
            } catch (\Throwable $th) {
                $others = 0;
            }
            

            $HasTransactionDiscount = TransactionDiscount::where('student_id', $stud_id)
                ->where('school_year_id', $School_year_id)
                ->where('isSuccess', 1)
                ->first();

            $TransactionDiscount = TransactionDiscount::where('student_id', $stud_id)
                ->where('school_year_id', $School_year_id)
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
                    ,'Account','TransactionOR','AccountOthers','Downpayment','student_payment_category','grade_level_id', 'others','TransactionDiscount'
                    ,'NotyetApprovedCount','HasTransactionDiscount','ClassDetail'
                ));
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
            $Enrollment->payment_option = 'Walk-in';
            $Enrollment->transaction_id = $Transaction->id;
            $Enrollment->approval = 'Approved';    
            $Enrollment->isSuccess = 0;  
            
            if($request->date_created)
            {
                $Enrollment->created_at = date('Y-m-d', strtotime($request->date_created));
            }    

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
                    $DiscountFeeSave->category = $DiscountFee->category;
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
                $payment = Transaction::find($Transaction->id);
                try{
                    \Mail::to($request->email)->send(new sendManualStudentMail($payment));
                    \Mail::to('info@sja-bataan.com')->cc('finance@sja-bataan.com')->send(new SendManualFinanceMail($payment));
                    // echo 'send';
                }catch(\Exception $e){
                    \Log::error($e->getMessage());
                    // echo 'error';
                    return response()->json(['res_code' => 1, 'res_msg' => 'Error Email not sent.']);
                }
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
            $TransactionMonthsPaid->payment_option = 'Walk-in';
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
            
            if($total_disc)
            {
                $total_balance = ($recent_balance->balance - $total_disc);

                $Transaction_month_paid_balance = 
                    TransactionMonthPaid::where('id', $TransactionMonthsPaid->id)
                    ->first();
    
                if($Transaction_month_paid_balance ){
                    $Transaction_month_paid_balance->balance = $total_balance;
                    $Transaction_month_paid_balance->isSuccess = 1;
                    $Transaction_month_paid_balance->save();
                }
            }
            

            if($request->email)
            {
                $payment = Transaction::find($Transaction->id);
                try{
                    \Mail::to($request->email)->send(new sendManualStudentMail($payment));
                    \Mail::to('info@sja-bataan.com')->cc('finance@sja-bataan.com')->send(new SendManualFinanceMail($payment));
                    // echo 'send';
                }catch(\Exception $e){
                    \Log::error($e->getMessage());
                    // echo 'error';
                    return response()->json(['res_code' => 1, 'res_msg' => 'Error Email not sent.']);
                }
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
                    $TransactionOtherFee->isSuccess = 1;
                    $TransactionOtherFee->save();
                }
    
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
            }
        

        
    }

    public function save_discount(Request $request)
    {
        $School_year_id = SchoolYear::where('status', 1)
            ->where('current', 1)->first()->id;

        $stud_id = $request->student_id;

        $rules = [
            'discount' => 'required'                 
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

        if(!empty($request->discount)){
            foreach($request->discount as $get_data){
    
                $DiscountFee = DiscountFee::where('id', $get_data)
                    ->where('current', 1)
                    ->where('status', 1)
                    ->first();
    
                $DiscountFeeSave = new TransactionDiscount();
                $DiscountFeeSave->student_id = $stud_id;
                $DiscountFeeSave->discount_type = $DiscountFee->disc_type;
                $DiscountFeeSave->discount_amt = $DiscountFee->disc_amt;
                $DiscountFeeSave->transaction_month_paid_id = $request->transaction_month_paid_id;
                $DiscountFeeSave->school_year_id = $School_year_id;
                $DiscountFeeSave->category = $DiscountFee->category;
                $DiscountFeeSave->isSuccess = 1;
                $DiscountFeeSave->save();
            }
        }    
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        
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

            $TransactionDiscount = TransactionDiscount::where('student_id', $request->id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('isSuccess', 1)
                ->first();
            
        }

        
        //with existing account
        $Payment =  PaymentCategory::where('id', $Transaction->payment_category_id)->first();
        $MiscFee_payment =  MiscFee::where('id', $Payment->misc_fee_id)->first();
        $Tuitionfee_payment =  TuitionFee::where('id', $Payment->tuition_fee_id)->first();
        $Stud_cat_payment =  StudentCategory::where('id', $Payment->student_category_id)->first();

        $others = TransactionOtherFee::where('student_id', $request->id)
                ->where('transaction_id', $Transaction->id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('isSuccess', 1)
                ->get();

        $TransactionDiscount = TransactionDiscount::where('student_id', $request->id)
            ->where('school_year_id', $SchoolYear->id)
            ->where('isSuccess', 1)
            ->get();

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
                'Stud_cat_payment','Transaction_disc','TransactionMonthPaid','TransactionDiscount','others','TransactionDiscount'
                ))->render(); 
    
        
                // return view('profile', array('user' => Auth::user()) );        
    }

    public function modal_data_edit (Request $request) 
    {
        if ($request->id)
        {
            $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first();
            
            $TransactionMonthPaid = TransactionMonthPaid::where('id', $request->id)
                ->first();

        }
         
        return  view('control_panel_finance.student_payment_account.partials.student_with_account.modal_edit',
             compact('TransactionMonthPaid'))->render(); 
    }

    public function modal_data_others (Request $request) 
    {
        if ($request->id)
        {
            $School_year_id = SchoolYear::where('status', 1)
                ->where('current', 1)->first();
            
            $TransactionOthers = TransactionOtherFee::where('id', $request->id)
                ->first();

        }
         
        return  view('control_panel_finance.student_payment_account.partials.student_with_account.modal_others',
             compact('TransactionOthers'))->render(); 
    }
    
    public function modal_data_discount(Request $request)
    {
        if($request->id){

            $SchoolYear = SchoolYear::where('status', 1)
            ->where('current', 1)->first();
        
            $DiscountFee = DiscountFee::where('current', 1)->where('status', 1)->where('apply_to', 1)->get();

            $TransactionDiscount = TransactionDiscount::where('id', $request->id)->first();

        }

        return  view('control_panel_finance.student_payment_account.partials.student_with_account.modal_discount', 
                compact('TransactionDiscount','DiscountFee','SchoolYear'))->render();  
    }

    public function update_data_discount (Request $request) 
    {
        $rules = [
            'discount' => 'required'
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }   
        // update
        if ($request->id)
        {
            
            if(!empty($request->discount)){
                foreach($request->discount as $get_data){

                    $DiscountFee = DiscountFee::where('id', $get_data)
                        ->where('current', 1)
                        ->where('status', 1)
                        ->first();                    

                    $DiscountFeeUpdate = TransactionDiscount::where('id', $request->id)->first();
                    $DiscountFeeUpdate->discount_type = $DiscountFee->disc_type;
                    $DiscountFeeUpdate->discount_amt = $DiscountFee->disc_amt;
                    $DiscountFeeUpdate->save();
                }
            }    

            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
        
    }

    public function update_data_other (Request $request) 
    {
        $rules = [
            'other_name' => 'required',
            'item_qty' => 'required',
            'item_price' => 'required',
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }   
        // update
        if ($request->id)
        {
            $TransactionOtherFee = TransactionOtherFee::where('id', $request->id)->first();
            $TransactionOtherFee->or_no = $request->or_no;
            $TransactionOtherFee->other_name = $request->other_name;
            $TransactionOtherFee->item_qty = $request->item_qty;
            $TransactionOtherFee->item_price = $request->item_price;
            // $TransactionOtherFee->payment = $request->payment;
            $TransactionOtherFee->save();

            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
        
    }

    public function update_data (Request $request) 
    {
        $rules = [
            'balance' => 'required',
            'payment' => 'required',
            'or_number' => 'required'         
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }   
        // update
        if ($request->id)
        {
            $UpdateTransaction = TransactionMonthPaid::where('id', $request->id)->first();
            $UpdateTransaction->or_no = $request->or_number;
            $UpdateTransaction->balance = $request->balance;
            $UpdateTransaction->payment = $request->payment;
            $UpdateTransaction->created_at = $request->date_created ? date('Y-m-d', strtotime($request->date_created)) : NULL;
            $UpdateTransaction->save();

            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
        
    }

    
    
    public function print_enrollment_bill(Request $request){

        // $stud_stats = $request->stud_status;
        $StudentInformation = StudentInformation::with(['user'])->where('id', $request->studid)->first();
        $balance = $request->balance;
        

        // if($stud_stats == 0){

            if ($StudentInformation) 
            {  
                $Transaction = Transaction::join('student_informations', 'student_informations.id', '=' ,'transactions.student_id')
                        ->join('school_years', 'school_years.id', '=' ,'transactions.school_year_id')
                        ->join('payment_categories', 'payment_categories.id', 'transactions.payment_category_id')
                        ->join('transaction_month_paids', 'transaction_month_paids.transaction_id', 'transactions.id')
                        ->select(\DB::raw("
                            CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                            school_years.school_year,
                            transaction_month_paids.or_no,
                            transaction_month_paids.id as transaction_month_paid_id,
                            transaction_month_paids.payment,
                            transaction_month_paids.balance,
                            transactions.payment_category_id,
                            transaction_month_paids.updated_at,
                            transactions.id as transaction_id
                        "))
                        ->where('school_years.id', $request->syid)
                        ->where('student_informations.id', $request->studid)
                        ->where('transaction_month_paids.or_no', $request->or_num)
                        ->where('transaction_month_paids.isSuccess', 1)
                        ->first();

                $total  =   $Transaction->payment_cat->tuition->tuition_amt + 
                            $Transaction->payment_cat->misc_fee->misc_amt + 
                            $Transaction->payment_cat->other_fee->other_fee_amt;
                    
                if($Transaction){

                    $Transaction_disc = TransactionDiscount::with('discountFee')
                        ->where('transaction_month_paid_id', $Transaction->transaction_month_paid_id)
                        ->get(); 
                    
                    $hasDiscount = TransactionDiscount::where('transaction_month_paid_id', $Transaction->transaction_month_paid_id)
                        ->where('isSuccess', 1)
                        ->first(); 
                    
                    $total_discount = TransactionDiscount::where('transaction_month_paid_id', $Transaction->transaction_month_paid_id)
                        ->where('isSuccess', 1)
                        ->sum('discount_amt');

                    if($hasDiscount)
                    {
                        $total = $total - $total_discount;
                    }
                    
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

        return view('control_panel_finance.student_payment_account.partials.print_transaction',
                    compact('Transaction','PaymentCategory','Transaction_disc', 'stud_stats','TransactionMonthPaid','balance','total'));

        $pdf = \PDF::loadView('control_panel_finance.student_payment_account.partials.print_transaction', 
                compact('Transaction','PaymentCategory','Transaction_disc', 'stud_stats','TransactionMonthPaid','balance','total'));
        $pdf->setPaper('Letter', 'portrait');
        return $pdf->stream();
    }

    public function print_other(Request $request){

        if($request->or_num){
        
            $TransactionOther = TransactionOtherFee::join('student_informations', 'student_informations.id', '=' ,'transaction_other_fees.student_id')
                ->join('school_years', 'school_years.id', '=' ,'transaction_other_fees.school_year_id')
                ->select(\DB::raw("
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    school_years.school_year,
                    transaction_other_fees.or_no,
                    transaction_other_fees.id as transaction_other_fees_id,
                    transaction_other_fees.item_price,
                    transaction_other_fees.other_name,
                    transaction_other_fees.updated_at,
                    transaction_other_fees.item_qty,
                    transaction_other_fees.transaction_id               
                "))
                ->where('school_years.id', $request->syid)
                ->where('student_informations.id', $request->studid)
                ->where('transaction_other_fees.or_no', $request->or_num)
                ->where('transaction_other_fees.isSuccess', 1)
                ->get();

            $total_price = TransactionOtherFee::join('student_informations', 'student_informations.id', '=' ,'transaction_other_fees.student_id')
                ->join('school_years', 'school_years.id', '=' ,'transaction_other_fees.school_year_id')
                ->select(\DB::raw("
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    school_years.school_year,
                    transaction_other_fees.or_no,
                    transaction_other_fees.id as transaction_other_fees_id,
                    transaction_other_fees.item_price,
                    transaction_other_fees.other_name,
                    transaction_other_fees.updated_at,
                    transaction_other_fees.item_qty,
                    transaction_other_fees.transaction_id               
                "))
                ->where('school_years.id', $request->syid)
                ->where('student_informations.id', $request->studid)
                ->where('transaction_other_fees.or_no', $request->or_num)
                ->where('transaction_other_fees.isSuccess', 1)
                ->sum('transaction_other_fees.item_price');

           
        }else if($request->id){

            $TransactionOther = TransactionOtherFee::join('student_informations', 'student_informations.id', '=' ,'transaction_other_fees.student_id')
            ->join('school_years', 'school_years.id', '=' ,'transaction_other_fees.school_year_id')
            ->select(\DB::raw("
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                school_years.school_year,
                transaction_other_fees.or_no,
                transaction_other_fees.id as transaction_other_fees_id,
                transaction_other_fees.item_price,
                transaction_other_fees.other_name,
                transaction_other_fees.updated_at,
                transaction_other_fees.item_qty,
                transaction_other_fees.transaction_id               
            "))
            ->where('transaction_other_fees.id', $request->id)
            ->where('transaction_other_fees.isSuccess', 1)
            ->get();

            $total_price = TransactionOtherFee::join('student_informations', 'student_informations.id', '=' ,'transaction_other_fees.student_id')
                ->join('school_years', 'school_years.id', '=' ,'transaction_other_fees.school_year_id')
                ->select(\DB::raw("
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    school_years.school_year,
                    transaction_other_fees.or_no,
                    transaction_other_fees.id as transaction_other_fees_id,
                    transaction_other_fees.item_price,
                    transaction_other_fees.other_name,
                    transaction_other_fees.updated_at,
                    transaction_other_fees.item_qty,
                    transaction_other_fees.transaction_id               
                "))
                ->where('transaction_other_fees.id', $request->id)
                ->where('transaction_other_fees.isSuccess', 1)
                ->sum('transaction_other_fees.item_price');

        }else{
            return "Invalid request";
        }

        return view('control_panel_finance.student_payment_account.partials.print_other_fee', compact('TransactionOther','total_price'));

        $pdf = \PDF::loadView('control_panel_finance.student_payment_account.partials.print_other_fee', compact('TransactionOther','total_price'));
        $pdf->setPaper('Letter', 'portrait');
        return $pdf->stream(); 
    }

    public function print_all_transaction(Request $request)
    {
        if ($request->id)
        {
            
            $PreparedBy = FinanceInformation::where('user_id', Auth::user()->id)->first();
            $fullname = $PreparedBy->first_name.' '.$PreparedBy->last_name;

            $Modal_data = Transaction::where('id', $request->id)->first();
            
            $Discount = TransactionDiscount::where('student_id', $Modal_data->student_id)
                ->where('school_year_id', $Modal_data->school_year_id)
                ->where('isSuccess', 1)
                ->sum('discount_amt');

            $Discount_amt = TransactionDiscount::where('student_id', $Modal_data->student_id)
                ->where('school_year_id', $Modal_data->school_year_id)
                ->where('isSuccess', 1)
                ->get();

            
            $other_fee = Transaction::join('transaction_other_fees', 'transaction_other_fees.transaction_id','=', 'transactions.id')
                ->selectRaw('
                    transactions.student_id,
                    transactions.id as transactions_id,
                    transaction_other_fees.item_price, 
                    transaction_other_fees.other_name
                ')
                ->where('transactions.id', $request->id)
                ->where('transaction_other_fees.isSuccess', 1)
                ->first();
            
            $OtherFee = TransactionOtherFee::where('student_id', $Modal_data->student_id)
                ->where('school_year_id', $Modal_data->school_year_id)
                ->where('isSuccess', 1)
                ->get();

            $ItemPrice = TransactionOtherFee::where('student_id', $Modal_data->student_id)
                ->where('school_year_id', $Modal_data->school_year_id)
                ->where('isSuccess', 1)
                ->sum('item_price');
                
            $other = 0;
            if($other_fee){
                $other = $other_fee->item_price;
            }

            $Mo_history = TransactionMonthPaid::where('transaction_id', $request->id)->where('isSuccess', 1)->where('approval' ,'!=', 'Deleted')->get();

            $total = ($Modal_data->payment_cat->tuition->tuition_amt + $Modal_data->payment_cat->misc_fee->misc_amt + $ItemPrice) - $Discount;
        }
        else
        {
            return 'invalid data sorry';
        }

        return view('control_panel_finance.student_payment_account.partials.print_all_transaction', 
                        compact('Modal_data','Mo_history','other_fee','Discount','Discount_amt','total','other','fullname','ItemPrice','OtherFee'));

        $pdf = \PDF::loadView('control_panel_finance.student_payment_account.partials.print_all_transaction', 
                        compact('Modal_data','Mo_history','other_fee','Discount','Discount_amt','total','other','fullname','ItemPrice','OtherFee'));

        $pdf->setPaper('Letter', 'portrait');
        return $pdf->stream(); 
    }

    public function data_delete(Request $request){

        if($request->category=="other"){
            if ($request->id)
            {
                $DeleteTransactionOtherFee = TransactionOtherFee::where('id', $request->id)->first();
                $DeleteTransactionOtherFee->isSuccess = 0;
                $DeleteTransactionOtherFee->save();
    
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deleted.']);
            }
        }else{
            if ($request->id)
            {
                $TransactionDiscount = TransactionDiscount::where('id', $request->id)->first();
                $TransactionDiscount->isSuccess = 0;
                $TransactionDiscount->save();
    
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deleted.']);
            }
        }

        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function deleteTransaction(Request $request)
    {
        $Student_id = TransactionMonthPaid::where('id', $request->id)->first();
        $StudentInformation = StudentInformation::where('status', 1)
            ->where('id', $Student_id->student_id)->first();

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;
        $delete = TransactionMonthPaid::where('id', $request->id)->first();        
        
        if ($delete)
        {
            // $check_discount = TransactionDiscount::where('transaction_month_paid_id', $delete->id)->first();

            // if(!$check_discount){
            //     $discount = TransactionDiscount::where('transaction_month_paid_id', $delete->id)->get();

            //     foreach($discount as $data){
            //         $discount = TransactionDiscount::where('transaction_month_paid_id', $data->id)->first();
            //         $discount->isSuccess = 0;
            //         $discount->save();
            //     }
            // }
            
            $delete->approval = 'Deleted';
            $delete->save();

            return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' payment status successfully disapproved.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
     
    public function history(){
        $hello = 'this is history';
        return view('control_panel_finance.student_payment_account.partials.data_list', compact('hello'))->render();
    }

    public function deleteEntireTransaction(Request $request){
        // echo 'delete';

        if($request->id)
        {
            $transaction =Transaction::find($request->id);
            $transaction ->delete();     
            return response()->json(['res_code' => 0, 'res_msg' => 'The entire transaction is now deleted.']);     
        }        
        // return redirect()->route('finance.student_payment_account');
    }
    
}