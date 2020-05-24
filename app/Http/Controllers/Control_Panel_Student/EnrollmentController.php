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
            $IncomingStudentCount = IncomingStudent::where('student_id', $StudentInformation->id)->where('school_year_id', $SchoolYear->id)->first();

            if($IncomingStudentCount){                

                $AlreadyEnrolled = TransactionMonthPaid::where('student_id', $StudentInformation->id)
                    ->where('school_year_id', $SchoolYear->id)->orderBy('id', 'Desc')->first();

                $Tuition = PaymentCategory::where('grade_level_id', $IncomingStudentCount->grade_level_id)->first();

                $PaymentCategory = PaymentCategory::with('misc_fee','tuition')
                                ->where('grade_level_id',  $IncomingStudentCount->grade_level_id)->first();
                                
                $Downpayment = DownpaymentFee::where('current', 1)->first();

                $Profile = StudentInformation::where('user_id', $User->id)->first();

                // discount
                $Discount = DiscountFee::where('status', 1)->where('current', 1)->where('disc_type', 'ESC')->first();                    

                return view('control_panel_student.enrollment.index', 
                    compact('AlreadyEnrolled','grade_level', 'ClassDetail','PaymentCategory','Downpayment',
                    'Profile','StudentInformation','Tuition','Enrollment','User','SchoolYear','Discount', 'IncomingStudentCount'));
                return json_encode(['GradeSheetData' => $GradeSheetData,]);

            }else{

                if ($StudentInformation) 
                {
                    
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
                        ->where('school_year_id', $SchoolYear->id)->orderBy('id', 'Desc')->first();

                    $grade_level_id = ($ClassDetail->grade_level + 1);

                    $Tuition = PaymentCategory::where('grade_level_id', $grade_level_id)->first();

                    $PaymentCategory = PaymentCategory::with('misc_fee','tuition')
                                    ->where('grade_level_id', $grade_level_id)->first();
                                    
                    $Downpayment = DownpaymentFee::where('current', 1)->first();

                    $Profile = StudentInformation::where('user_id', $User->id)->first();

                    // discount
                    $Discount = DiscountFee::where('status', 1)->where('current', 1)->where('disc_type', 'ESC')->first();                    

                    return view('control_panel_student.enrollment.index', 
                        compact('AlreadyEnrolled','grade_level', 'ClassDetail','PaymentCategory','Downpayment',
                        'Profile','StudentInformation','Tuition','Enrollment','User','SchoolYear','Discount', 'IncomingStudentCount'));
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
            'bank_email' => 'required',
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

        }else{
            
            $EnrollmentTransaction = new Transaction();
            $EnrollmentTransaction->payment_category_id = $request->bank_tution_amt;
            $EnrollmentTransaction->student_id = $StudentInformation->id;
            $EnrollmentTransaction->school_year_id = $SchoolYear->id;                                
            $EnrollmentTransaction->save();

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
            $Enrollment->transaction_id = $EnrollmentTransaction->id;            
            // image
            $imageName = time().'.'.$request->bank_image->getClientOriginalExtension();
            $request->bank_image->move(public_path('/img/receipt/'), $imageName);
            $Enrollment->receipt_img = $imageName;            
            
            if($Enrollment->save()){            
                if($request->bank_discount!=0){
                    $Discount = new TransactionDiscount();
                    $Discount->student_id =  $StudentInformation->id;
                    $Discount->school_year_id = $SchoolYear->id;
                    $Discount->discount_type = $request->bank_discount_type;
                    $Discount->discount_amt = $request->bank_discount;
                    $Discount->transaction_id = $EnrollmentTransaction->id;
                    $Discount->save();
                }            
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
            'gcash_email' => 'required',
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
            $Enrollment->receipt_img = $imageName;
            $Enrollment->save();

        }else{

            $EnrollmentTransaction = new Transaction();
            $EnrollmentTransaction->payment_category_id = $request->gcash_tution_amt;
            $EnrollmentTransaction->student_id = $StudentInformation->id;
            $EnrollmentTransaction->school_year_id = $SchoolYear->id;                                
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
            $Enrollment->isSuccess = 1;
            $Enrollment->transaction_id = $EnrollmentTransaction->id;            
            // image
            $imageName = time().'.'.$request->gcash_image->getClientOriginalExtension();
            $request->gcash_image->move(public_path('/img/receipt/'), $imageName);
            $Enrollment->receipt_img = $imageName;
            if($Enrollment->save()){
            
                if($request->gcash_discount!=0){
                    $Discount = new TransactionDiscount();
                    $Discount->student_id =  $StudentInformation->id;
                    $Discount->school_year_id = $SchoolYear->id;
                    $Discount->discount_type = $request->gcash_discount_type;
                    $Discount->discount_amt = $request->gcash_discount;
                    $Discount->transaction_id = $EnrollmentTransaction->id;
                    $Discount->save();
                }            
                
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
            ->orderBY('id', 'desc')
            ->first();

        $Discount = TransactionDiscount::where('student_id', $request->id)
            ->where('school_year_id', $request->school_year_id)
            ->first();

        $Transaction_history = NULL;
        if ($request->id && $request->school_year_id)
        {
            $Transaction_history = Transaction::where('student_id', $request->id)
                ->where('school_year_id', $request->school_year_id)
                ->orderBY('id', 'desc')
                ->get();

            $Transaction = TransactionMonthPaid::where('student_id', $request->id)
               ->where('school_year_id', $request->school_year_id)
               ->orderBY('id', 'desc')
                ->get();


            if($hasTransaction){
                if($Discount){
                    $tuition_misc_fee = ($Transaction_history[0]->payment_cat->tuition->tuition_amt + $Transaction_history[0]->payment_cat->misc_fee->misc_amt) - $Discount->discount_amt;
                }else{
                    $tuition_misc_fee = $Transaction_history[0]->payment_cat->tuition->tuition_amt + $Transaction_history[0]->payment_cat->misc_fee->misc_amt;
                }
            }
            
            
        }
        return view('control_panel_student.enrollment.partials.modal_data', compact('Transaction_history','Transaction','Discount','tuition_misc_fee','hasTransaction'))->render();
    }
    
}
