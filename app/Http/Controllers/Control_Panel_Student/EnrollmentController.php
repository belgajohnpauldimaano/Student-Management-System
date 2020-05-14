<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Carbon\Carbon;
use App\Enrollment;
use App\SchoolYear;
use App\TuitionFee;
use App\ClassDetail;

use App\Transaction;
use App\Mail\SendMail;
use App\DownpaymentFee;
use App\PaymentCategory;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\Mail\NotifyAdminMail;
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
        
        // if($findSchoolYear){        
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

                $AlreadyEnrolled = Transaction::where('student_id', $StudentInformation->id)
                    ->where('school_year_id', $SchoolYear->id)->orderBy('id', 'Desc')->first();

                $grade_level_id = ($ClassDetail->grade_level + 1);

                $Tuition = PaymentCategory::where('grade_level_id', $grade_level_id)->first();

                $PaymentCategory = PaymentCategory::with('misc_fee','tuition')
                                ->where('grade_level_id', $grade_level_id)->first();
                                
                $Downpayment = DownpaymentFee::where('current', 1)->first();
                $Profile = StudentInformation::where('user_id', $User->id)->first();

                return view('control_panel_student.enrollment.index', 
                    compact('AlreadyEnrolled','grade_level', 'ClassDetail','PaymentCategory','Downpayment','Profile','StudentInformation','Tuition','Enrollment','User'));
                return json_encode(['GradeSheetData' => $GradeSheetData,]);
                    
            }else{
                echo "Invalid request";
            }
        // }
        // else{
        //     $GradeSheet = 0;
        //     return view('control_panel_student.enrollment.index', compact('GradeSheet'));
        // }
    }

    public function save(Request $request){
        $User = \Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)->first();
        $mytime = Carbon::now();

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->orderBY('id', 'DESC')
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
            $Enrollment_total = $request->bank_balance - $request->bank_pay_fee;
        }else{
            $Enrollment_total = $request->bank_tution - $request->bank_pay_fee;
        }
        

        $Enrollment = new Transaction();
        $Enrollment->or_number = $request->bank_transaction_id;
        $Enrollment->email = $request->bank_email;
        $Enrollment->number = $request->bank_phone;
        $Enrollment->payment_category_id = $request->bank_tution_amt;
        $Enrollment->student_id = $StudentInformation->id;
        $Enrollment->school_year_id = $SchoolYear->id;
        $Enrollment->downpayment = $request->bank_pay_fee;
        $Enrollment->payment_option = $request->bank;
        // $Enrollment->receipt_img = $request->bank_image;
        $Enrollment->isSuccess = 1;
        $Enrollment->balance = $Enrollment_total;

        // image
        $imageName = time().'.'.$request->bank_image->getClientOriginalExtension();
        $request->bank_image->move(public_path('/img/receipt/'), $imageName); 

        $Enrollment->receipt_img = $imageName; 
            
        $Enrollment->save();
        $admin_email = 'info@sja-bataan.com';

        $payment = Transaction::find($Enrollment->id);
            \Mail::to($request->bank_email)->send(new SendMail($payment));
            \Mail::to($admin_email)->send(new NotifyAdminMail($payment));

        return response()->json(['res_code' => 0, 'res_msg' => 'You have successfully accomplished the form. Check your email for review of Finance Dept. Thank you!']);
    }

    public function save_data(Request $request){
        $User = \Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)->first();
        $mytime = Carbon::now();

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->orderBY('id', 'DESC')
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
            $Enrollment_total = $request->gcash_balance - $request->gcash_pay_fee;
        }else{
            $Enrollment_total = $request->gcash_tution_total - $request->gcash_pay_fee;
        }
        

        $Enrollment = new Transaction();
        $Enrollment->or_number = $request->gcash_transaction_id;
        $Enrollment->email = $request->gcash_email;
        $Enrollment->number = $request->gcash_phone;
        $Enrollment->payment_category_id = $request->gcash_tution_amt;
        $Enrollment->student_id = $StudentInformation->id;
        $Enrollment->school_year_id = $SchoolYear->id;
        $Enrollment->downpayment = $request->gcash_pay_fee;
        $Enrollment->payment_option = $request->Gcash;
        // $Enrollment->receipt_img = $request->bank_image;
        $Enrollment->isSuccess = 1;
        $Enrollment->balance = $Enrollment_total;

        // image
        $imageName = time().'.'.$request->gcash_image->getClientOriginalExtension();
        $request->gcash_image->move(public_path('/img/receipt/'), $imageName); 

        $Enrollment->receipt_img = $imageName; 
            
        $Enrollment->save();

        $admin_email = 'info@sja-bataan.com';
        $payment = Transaction::find($Enrollment->id);
            \Mail::to($request->gcash_email)->send(new SendMail($payment));
            \Mail::to($admin_email)->send(new NotifyAdminMail($payment));

        return response()->json(['res_code' => 0,
         'res_msg' =>
          'You have successfully accomplished the form. Check your email for review of Finance Dept. Thank you!']);
    }

    
}
