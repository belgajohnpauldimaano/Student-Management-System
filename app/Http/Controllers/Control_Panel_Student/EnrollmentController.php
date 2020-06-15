<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Carbon\Carbon;
use App\Enrollment;
use App\SchoolYear;
use App\TuitionFee;
use App\ClassDetail;

use App\DiscountFee;
use App\Transaction;
use App\Mail\SendMail;
use App\DownpaymentFee;
use App\IncomingStudent;
use App\PaymentCategory;
use App\StudentInformation;
use App\TransactionDiscount;
use App\TransactionOtherFee;
use Illuminate\Http\Request;
use App\Mail\NotifyAdminMail;
use App\TransactionMonthPaid;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EnrollmentController extends Controller
{

    public function index(Request $request)
    {    
        $User = \Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)
            ->first();
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        $findSchoolYear = ClassDetail::where('school_year_id' , $SchoolYear->id)->first();
       
        
        if($findSchoolYear){  
            $IncomingStudentCount = IncomingStudent::where('student_id', $StudentInformation->id)
                ->where('school_year_id', $SchoolYear->id)
                ->first();

            if($IncomingStudentCount){       
                
                $isPaid = Transaction::where('student_id' , $StudentInformation->id)->where('status', 0)->first();

                $AlreadyEnrolled = TransactionMonthPaid::where('student_id', $StudentInformation->id)
                    ->where('school_year_id', $SchoolYear->id)
                    ->where('isSuccess', 1)
                    // ->where('approval', 'Approved')
                    ->orderBy('id', 'Desc')
                    ->first();

                $Tuition = PaymentCategory::where('grade_level_id', $IncomingStudentCount->grade_level_id)->first();

                $PaymentCategory = PaymentCategory::with('misc_fee','tuition')
                    ->where('grade_level_id',  $IncomingStudentCount->grade_level_id)->first();

                if($Tuition){
                    $hasOtherfee = PaymentCategory::where('grade_level_id',  $IncomingStudentCount->grade_level_id)->first();
                }                

                $Downpayment = DownpaymentFee::where('status', 1)->where('grade_level_id', $IncomingStudentCount->grade_level_id)->get();

                $Profile = StudentInformation::where('user_id', $User->id)->first();
                
                // discount
                $Discount = DiscountFee::where('status', 1)->where('current', 1)->where('apply_to', 1)->get();
                
                $TransactionDiscount = TransactionDiscount::where('student_id', $StudentInformation->id)->where('school_year_id', $SchoolYear->id)->where('isSuccess', 1)->get();
                                  
                $TransactionDiscountTotal = TransactionDiscount::where('student_id', $StudentInformation->id)->where('school_year_id', $SchoolYear->id)->where('isSuccess', 1)->sum('discount_amt');

                
                if($Tuition){
                    $tuition_fee = $PaymentCategory->tuition->tuition_amt;
                    $misc_fee = $PaymentCategory->misc_fee->misc_amt;

                    if($hasOtherfee->other_fee_id != NULL){
                        $other_fee = $PaymentCategory->other_fee->other_fee_amt;
                    }
                    else{
                        $other_fee = 0;
                    }        
                    $discount_fee = $TransactionDiscountTotal;

                    if($Tuition){
                        $sum_total_item = ( $tuition_fee + $misc_fee + $other_fee) - $discount_fee;
                    }
                }

                return view('control_panel_student.enrollment.index', 
                    compact('AlreadyEnrolled','grade_level', 'ClassDetail','PaymentCategory','Downpayment','sum_total_item', 'hasOtherfee',
                    'Profile','StudentInformation','Tuition','Enrollment','User','SchoolYear','Discount', 'IncomingStudentCount',
                    'TransactionDiscount','TransactionDiscountTotal','isPaid'));
                return json_encode(['GradeSheetData' => $GradeSheetData,]);

            }else{

                if ($StudentInformation) 
                {
                    $isPaid = Transaction::where('student_id' , $StudentInformation->id)->where('status', 0)->first();

                    $Enrollment = Enrollment::where('student_information_id', $StudentInformation->id)
                        ->where('status', 1)
                        ->where('current', 1)
                        ->orderBy('id', 'DESC')
                        ->first();
                                    
                    $ClassDetail = ClassDetail::where('id', $Enrollment->class_details_id)
                            ->where('status', 1)->where('current', 1)->orderBY('grade_level', 'DESC')->first();

                    // $SchoolYear1 = SchoolYear::where('current', 1)
                    //     ->where('status', 1)->orderBy('id', 'Desc')->first();

                    $AlreadyEnrolled = TransactionMonthPaid::where('student_id', $StudentInformation->id)
                        ->where('school_year_id', $SchoolYear->id)
                        ->where('isSuccess', 1)->orderBy('id', 'Desc')->first();

                    $grade_level_id = ($ClassDetail->grade_level + 1);

                    $Tuition = PaymentCategory::where('grade_level_id', $grade_level_id)->first();

                    $PaymentCategory = PaymentCategory::with('misc_fee','tuition')
                                    ->where('grade_level_id', $grade_level_id)->first();

                    if($Tuition){
                        $hasOtherfee = PaymentCategory::where('grade_level_id',  $grade_level_id)->first();
                    } 

                                    
                    $Downpayment = DownpaymentFee::where('status', 1)->where('grade_level_id', $grade_level_id)->get();

                    $Profile = StudentInformation::where('user_id', $User->id)->first();

                    // discount
                    $Discount =  DiscountFee::where('status', 1)->where('current', 1)->where('apply_to', 1)->get();        

                    $TransactionDiscount = TransactionDiscount::where('student_id', $StudentInformation->id)->where('school_year_id', $SchoolYear->id)->where('isSuccess', 1)->get();

                    $TransactionDiscountTotal = TransactionDiscount::where('student_id', $StudentInformation->id)->where('school_year_id', $SchoolYear->id)->where('isSuccess', 1)->sum('discount_amt');

                    if($Tuition){                    
                        $tuition_fee = $PaymentCategory->tuition->tuition_amt;
                        $misc_fee = $PaymentCategory->misc_fee->misc_amt;

                        if($hasOtherfee->other_fee_id != NULL){
                            $other_fee = $PaymentCategory->other_fee->other_fee_amt;
                        }else{
                            $other_fee = 0;
                        }        
                        $discount_fee = $TransactionDiscountTotal;

                        if($Tuition){
                            $sum_total_item = ( $tuition_fee + $misc_fee + $other_fee) - $discount_fee;
                        }
                    }
                    
                    return view('control_panel_student.enrollment.index', 
                        compact('AlreadyEnrolled','grade_level', 'ClassDetail','PaymentCategory','Downpayment','sum_total_item','hasOtherfee','isPaid',
                        'Profile','StudentInformation','Tuition','Enrollment','User','SchoolYear','Discount', 'IncomingStudentCount','TransactionDiscount','TransactionDiscountTotal'));
                    return json_encode(['GradeSheetData' => $GradeSheetData,]);
                        
                }else{
                    echo "Invalid request";
                }
            }      
            
        }
        else{
            $GradeSheet = 0;
            return view('control_panel_student.enrollment.index', compact('GradeSheet'));
        }
    }


    
    public function save(Request $request){
        $User = \Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)->first();
        $mytime = Carbon::now();

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        $rules = [
            'bank_tution_amt' => 'required',
            'bank_phone' => 'required',
            'bank_email' => 'email|required',
            'bank'=>'required',
            'bank_transaction_id'=>'required',
            'bank_pay_fee' => 'required',
            'bank_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'bank_image' => 'required'
        ];
        
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails())
        {   
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $validator->getMessageBag()]);
        }
        
       if($request->bank_balance){
            $Enrollment_total = $request->bank_balance;
        }else{
            $Enrollment_total = $request->bank_tution - $request->bank_pay_fee;
        }

        $checkAccount = TransactionDiscount::where('school_year_id', $SchoolYear->id)
            ->where('student_id', $StudentInformation->id)
            ->first();

        $checkAccount1 = Transaction::where('school_year_id', $SchoolYear->id)
            ->where('student_id', $StudentInformation->id)
            ->first();

        if($checkAccount1){

            $TransactionAccount = Transaction::where('school_year_id', $SchoolYear->id)
                ->where('student_id', $StudentInformation->id)
                ->first();

            $Enrollment = new TransactionMonthPaid();
            $Enrollment->or_no = $request->bank_transaction_id;
            $Enrollment->student_id = $StudentInformation->id;
            $Enrollment->payment = $request->bank_pay_fee;
            $Enrollment->school_year_id = $SchoolYear->id;
            $Enrollment->balance = $Enrollment_total;
            $Enrollment->email = $request->bank_email;
            $Enrollment->number = $request->bank_phone;
            $Enrollment->payment_option = $request->bank;
            $Enrollment->isSuccess = 1;
            $Enrollment->transaction_id = $TransactionAccount->id;            
            // image
            $imageName = time().'.'.$request->bank_image->getClientOriginalExtension();
            $request->bank_image->move(public_path('/img/receipt/'), $imageName);
            $Enrollment->receipt_img = $imageName;
            $Enrollment->save();

            if($request->discount_bank != 0){
                foreach($request->discount_bank as $get_data){
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
                    $DiscountFeeSave->isSuccess = 1;
                    $DiscountFeeSave->save();
                }    
            }                 

        }else{
            
            $EnrollmentTransaction = new Transaction();
            $EnrollmentTransaction->payment_category_id = $request->bank_tution_amt;
            $EnrollmentTransaction->student_id = $StudentInformation->id;
            $EnrollmentTransaction->school_year_id = $SchoolYear->id; 
            foreach($request->downpayment as $get_data){
                $EnrollmentTransaction->downpayment_id = $get_data;  
            }         
            $EnrollmentTransaction->save();

            $Enrollment = new TransactionMonthPaid();
            $Enrollment->or_no = $request->bank_transaction_id;
            $Enrollment->student_id = $StudentInformation->id;
            $Enrollment->payment = $request->bank_pay_fee;
            $Enrollment->school_year_id = $SchoolYear->id;
            $Enrollment->balance = $Enrollment_total;
            $Enrollment->email = $request->bank_email;
            $Enrollment->number = $request->bank_phone;
            $Enrollment->online_charges = 0.00;
            $Enrollment->payment_option = $request->bank;
            $Enrollment->isSuccess = 1;
            $Enrollment->transaction_id = $EnrollmentTransaction->id;            
            // image
            $imageName = time().'.'.$request->bank_image->getClientOriginalExtension();
            $request->bank_image->move(public_path('/img/receipt/'), $imageName);
            $Enrollment->receipt_img = $imageName;            
            
            $Enrollment->save();          
                // if($request->bank_discount!=0){
                //     $Discount = new TransactionDiscount();
                //     $Discount->student_id =  $StudentInformation->id;
                //     $Discount->school_year_id = $SchoolYear->id;
                //     $Discount->discount_type = $request->bank_discount_type;
                //     $Discount->discount_amt = $request->bank_discount;
                //     $Discount->transaction_id = $EnrollmentTransaction->id;
                //     $Discount->save();
                // }            
            

            if($request->discount_bank != 0){
                foreach($request->discount_bank as $get_data){
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
                    $DiscountFeeSave->isSuccess = 1;
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
                $Other->isSuccess = 1;
                $Other->save();
            }
            
        }       
        
            $payment = Transaction::find($Enrollment->transaction_id);
            \Mail::to($request->bank_email)->send(new SendMail($payment));
            \Mail::to('info@sja-bataan.com')->send(new NotifyAdminMail($payment));

        return response()->json(['res_code' => 0, 'res_msg' => 'You have successfully accomplished the form. Check your email for review of Finance Dept. Thank you!']);
    }

    public function save_data(Request $request){
        $User = \Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)->first();
        $mytime = Carbon::now();

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        $rules = [
            'gcash_tution_amt' => 'required',
            'gcash_phone' => 'required',
            'gcash_email' => 'email|required',
            'Gcash'=>'required',
            'gcash_transaction_id'=>'required',
            'gcash_pay_fee' => 'required',
            'gcash_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'bank_image' => 'required'
        ];
        
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails())
        {   
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $validator->getMessageBag()]);
        }
      
        if($request->gcash_balance){
            $Enrollment_total = $request->gcash_balance;
        }else{
            $Enrollment_total = $request->gcash_tution_total - $request->gcash_pay_fee;
        }
        
        $checkAccount = TransactionDiscount::where('school_year_id', $SchoolYear->id)
            ->where('student_id', $StudentInformation->id)
            ->first();

        $checkAccount1 = Transaction::where('school_year_id', $SchoolYear->id)
            ->where('student_id', $StudentInformation->id)
            ->first();


        if($checkAccount1){
            $TransactionAccount = Transaction::where('school_year_id', $SchoolYear->id)
                ->where('student_id', $StudentInformation->id)
                ->first();

            $Enrollment = new TransactionMonthPaid();
            $Enrollment->or_no = $request->gcash_transaction_id;
            $Enrollment->student_id = $StudentInformation->id;
            $Enrollment->payment = $request->gcash_pay_fee;
            $Enrollment->school_year_id = $SchoolYear->id;
            $Enrollment->balance = $Enrollment_total;
            $Enrollment->email = $request->gcash_email;
            $Enrollment->number = $request->gcash_phone;
            $Enrollment->payment_option = $request->Gcash;
            $Enrollment->isSuccess = 1;
            $Enrollment->transaction_id = $TransactionAccount->id;            
            // image
                $imageName = time().'.'.$request->gcash_image->getClientOriginalExtension();
                $request->gcash_image->move(public_path('/img/receipt/'), $imageName);           
            //
            $Enrollment->receipt_img = $imageName;
            $Enrollment->save();

            if($request->discount_bank != 0){
                foreach($request->discount_bank as $get_data){
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

            $EnrollmentTransaction = new Transaction();
            $EnrollmentTransaction->payment_category_id = $request->gcash_tution_amt;
            $EnrollmentTransaction->student_id = $StudentInformation->id;
            $EnrollmentTransaction->school_year_id = $SchoolYear->id;    
            foreach($request->downpayment as $get_data){
                $EnrollmentTransaction->downpayment_id = $get_data;  
            }                          
            $EnrollmentTransaction->save();

            $Enrollment = new TransactionMonthPaid();
            $Enrollment->or_no = $request->gcash_transaction_id;
            $Enrollment->student_id = $StudentInformation->id;
            $Enrollment->payment = $request->gcash_pay_fee;
            $Enrollment->school_year_id = $SchoolYear->id;
            $Enrollment->balance = $Enrollment_total;
            $Enrollment->email = $request->gcash_email;
            $Enrollment->number = $request->gcash_phone;
            $Enrollment->payment_option = $request->Gcash;
            $Enrollment->online_charges = 0.00;
            $Enrollment->isSuccess = 1;
            $Enrollment->transaction_id = $EnrollmentTransaction->id;            
            // image
            $imageName = time().'.'.$request->gcash_image->getClientOriginalExtension();
            $request->gcash_image->move(public_path('/img/receipt/'), $imageName);
            $Enrollment->receipt_img = $imageName;
            $Enrollment->save();

            if($request->discount_bank != 0){
                foreach($request->discount_bank as $get_data){
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
            
            if($request->other_id){
                $Other = new TransactionOtherFee();
                $Other->transaction_id = $EnrollmentTransaction->id;
                $Other->student_id = $StudentInformation->id;
                $Other->others_fee_id = $request->other_id;
                $Other->school_year_id = $SchoolYear->id;
                $Other->item_qty = 1;
                $Other->item_price = $request->other_price;
                $Other->other_name = $request->other_name;
                $Other->isSuccess = 1;
                $Other->save();
            }
            
        }   

        $payment = Transaction::find($Enrollment->transaction_id);
            \Mail::to($request->gcash_email)->send(new SendMail($payment));
            \Mail::to('info@sja-bataan.com')->send(new NotifyAdminMail($payment));

        return response()->json(['res_code' => 0,
         'res_msg' =>
          'You have successfully accomplished the form. Check your email for review of Finance Dept. Thank you!']);        
        
    }

    public function modal_data(Request $request){

        $hasTransaction = TransactionMonthPaid::where('student_id', $request->id)
            ->where('school_year_id', $request->school_year_id)
            ->where('isSuccess', 1)
            ->orderBY('id', 'desc')
            ->first();

        $Discount = TransactionDiscount::where('student_id', $request->id)
            ->where('school_year_id', $request->school_year_id)->where('isSuccess', 1)
            ->sum('discount_amt');

        $Discount_amt = TransactionDiscount::where('student_id', $request->id)
            ->where('school_year_id', $request->school_year_id)->where('isSuccess', 1)
            ->get();

        $Transaction_history = NULL;

        if ($request->id && $request->school_year_id)
        {
            $Transaction_history = Transaction::where('student_id', $request->id)
                ->where('school_year_id', $request->school_year_id)
                ->orderBY('id', 'desc')
                ->get();

            $Transaction = TransactionMonthPaid::where('student_id', $request->id)
               ->where('school_year_id', $request->school_year_id)->where('isSuccess', 1)
               ->orderBY('id', 'desc')
                ->get();
            
            if($hasTransaction){
                
                $OtherFee = TransactionOtherFee::where('student_id', $request->id)
                    ->where('school_year_id', $request->school_year_id)->where('transaction_id', $Transaction_history[0]->id)
                    ->where('isSuccess', 1)
                    ->get();

                
                $Other_price = TransactionOtherFee::where('student_id', $request->id)
                    ->where('school_year_id', $request->school_year_id)->where('transaction_id', $Transaction_history[0]->id)
                    ->where('isSuccess', 1)
                    ->sum('item_price');

                if($Discount){
                    $tuition_misc_fee = ($Transaction_history[0]->payment_cat->tuition->tuition_amt + $Transaction_history[0]->payment_cat->misc_fee->misc_amt + $Other_price) - $Discount ;
                }else{
                    $tuition_misc_fee = $Transaction_history[0]->payment_cat->tuition->tuition_amt + $Transaction_history[0]->payment_cat->misc_fee->misc_amt + $Other_price;
                }
            }
            
            
        }
        return view('control_panel_student.enrollment.partials.modal_data',
            compact('Discount_amt','Transaction_history','Transaction','Discount','tuition_misc_fee','hasTransaction','OtherFee'))
            ->render();
    }
    
}
