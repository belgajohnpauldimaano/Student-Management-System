<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Carbon\Carbon;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\TuitionFee;
use App\Models\ClassDetail;
use App\Models\DiscountFee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Traits\HasGradeLevel;
use App\Traits\HasSchoolYear;
use App\Models\DownpaymentFee;
use App\Models\IncomingStudent;
use App\Models\PaymentCategory;
use App\Traits\HasStudentDetails;
use App\Models\StudentInformation;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionDiscount;
use App\Models\TransactionOtherFee;
use App\Http\Controllers\Controller;
use App\Models\TransactionMonthPaid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Finance\NotifyAdminMail;
use App\Mail\Student\Finance\Payment\SendMail;

class EnrollmentController extends Controller
{
    use HasStudentDetails, HasSchoolYear, HasGradeLevel;

    private function alreadyEnrolled($StudentInformation, $SchoolYear)
    {
        $preSy = $this->prevYear($SchoolYear);

        try {
            $previousYear = $this->checkPrevYear($StudentInformation, $preSy);
        } catch (\Throwable $th) {
            $previousYear = null;
        }

        try {
            if($previousYear->status==0){
                $sy = $SchoolYear;
            }else{
                $sy = $preSy;
            }
        } catch (\Throwable $th) {
            $sy = $SchoolYear;
        }
        
        return  TransactionMonthPaid::whereStudentId($StudentInformation)
                    ->whereSchoolYearId($sy)
                    ->where('isSuccess', 1)
                    ->whereApproval('Approved')
                    ->orderBy('id', 'Desc')
                    ->first();
    }

    private function previousYear()
    {
        return Transaction::whereStudentId($StudentInformation->id)
                ->whereSchoolYearId($previousUserID)->first();
    }

    private function prevYear($SchoolYear)
    {
        try {
            $SchoolYearId = $SchoolYear->id;
        } catch (\Throwable $th) {
            $SchoolYearId = $SchoolYear;
        }
        
        return SchoolYear::where('id', '<', $SchoolYearId)->where('status',1)->max('id');
    }

    private function checkSchoolYear($StudentInformation, $SchoolYear)
    {
        return $this->gradeLevel()->whereStudentInformationId($StudentInformation->id)
                    ->select('enrollments.student_information_id', 'enrollments.class_details_id', 'enrollments.id')
                    ->whereHas('classDetail', function($query) use ($SchoolYear) {
                        $query->where('school_year_id', $SchoolYear);
                    })
                    ->first();
    }

    private function checkPrevYear($StudentInformation, $previousUserID)
    {
        return Transaction::whereStudentId($StudentInformation)
                ->whereSchoolYearId($previousUserID)->first();
    }

    public function index(Request $request)
    {    
        $StudentInformation = $this->student();
        $SchoolYear = $this->schoolYearActiveStatus();

        $findSchoolYear = ClassDetail::where('school_year_id' , $SchoolYear->id)->first();
        
        $previousUserID = $this->prevYear($SchoolYear);
        // return json_encode($previousUserID);
        
        try {
            $previousYear = $this->checkPrevYear($StudentInformation->id, $previousUserID); 
        } catch (\Throwable $th) {
            $previousYear = null;
        }
        // return json_encode($previousYear);
                
        // if($findSchoolYear){  
            $IncomingStudentCount = IncomingStudent::where('student_id', $StudentInformation->id)
                ->where('school_year_id', $SchoolYear->id)
                ->first();

            if($IncomingStudentCount){
                
                $isPaid = Transaction::where('student_id' , $StudentInformation->id)->where('status', 0)
                    ->whereSchoolYearId($SchoolYear->id)->first();
                  
                $AlreadyEnrolled = $this->alreadyEnrolled($StudentInformation->id, $SchoolYear->id);
                
                $Tuition = PaymentCategory::where('grade_level_id', $IncomingStudentCount->grade_level_id)->first();
                
                $PaymentCategory = PaymentCategory::with('misc_fee','tuition')
                    ->where('grade_level_id',  $IncomingStudentCount->grade_level_id)->first();
                    
                if($Tuition){
                    $hasOtherfee = PaymentCategory::where('grade_level_id',  $IncomingStudentCount->grade_level_id)->first();
                }
                $Downpayment = DownpaymentFee::where('status', 1)->where('grade_level_id', $IncomingStudentCount->grade_level_id)->get();
                $Profile = $this->student();                
                // discount
                $Discount = DiscountFee::where('status', 1)->where('current', 1)->where('apply_to', 1)->get();                
                $TransactionDiscount = TransactionDiscount::where('student_id', $StudentInformation->id)
                    ->where('school_year_id', $SchoolYear->id)
                    ->where('isSuccess', 1)->get();
                $TransactionDiscountTotal = TransactionDiscount::where('student_id', $StudentInformation->id)
                    ->where('school_year_id', $SchoolYear->id)
                    ->where('isSuccess', 1)
                    ->sum('discount_amt');
                
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
                $GradeSheet = 1;
                return view('control_panel_student.enrollment.index', 
                    compact('AlreadyEnrolled','grade_level', 'GradeSheet', 'ClassDetail','PaymentCategory','Downpayment','sum_total_item', 'hasOtherfee',
                    'Profile','StudentInformation','Tuition','Enrollment','User','SchoolYear','Discount', 'IncomingStudentCount','previousYear',
                    'TransactionDiscount','TransactionDiscountTotal','isPaid'));
                // return json_encode(['GradeSheetData' => $GradeSheetData,]);

            }else{

                if ($StudentInformation) 
                {
                    $isPaid = Transaction::where('student_id' , $StudentInformation->id)
                        ->whereSchoolYearId($SchoolYear->id)->where('status', 0)->first();
                    $GradeSheet = 1;
                    try {
                        $has_schoolyear = $this->checkSchoolYear($StudentInformation, $SchoolYear->id);
                        $grade_level_id = $has_schoolyear->classDetail->grade_level;
                    } catch (\Throwable $th) {
                        //throw $th;
                        $AlreadyEnrolled = $this->alreadyEnrolled($StudentInformation->id, $SchoolYear->id);
                        $has_schoolyear = $this->checkSchoolYear($StudentInformation, $previousUserID);

                        // return json_encode($AlreadyEnrolled);
                        if(!empty($AlreadyEnrolled->status))
                        {
                            $notPaid = 0;
                        }else{
                            $notPaid = 1;
                        }

                        $grade_level_id = ($has_schoolyear->classDetail->grade_level + $notPaid);
                    }
                    // return json_encode($grade_level_id);
                    
                    $AlreadyEnrolled = $this->alreadyEnrolled($StudentInformation->id, $SchoolYear->id);
                    // $grade_level_id = ($ClassDetail->grade_level + 1);
                    $Tuition = PaymentCategory::where('grade_level_id', $grade_level_id)->first();
                    $PaymentCategory = PaymentCategory::with('misc_fee','tuition')
                                    ->where('grade_level_id', $grade_level_id)->first();

                    if($Tuition){
                        $hasOtherfee = PaymentCategory::where('grade_level_id',  $grade_level_id)->first();
                    }
                    
                    $Downpayment = DownpaymentFee::where('status', 1)->where('grade_level_id', $grade_level_id)->get();
                    $Profile = $this->student();
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
                        compact('AlreadyEnrolled','grade_level','GradeSheet', 'grade_level_id','PaymentCategory','Downpayment','sum_total_item','hasOtherfee','isPaid','previousYear',
                        'Profile','StudentInformation','Tuition','Enrollment','User','SchoolYear','Discount', 'IncomingStudentCount','TransactionDiscount','TransactionDiscountTotal'));
                   
                }else{
                    echo "Invalid request";
                }
            }      
            
        // }
        // else{
        //     $GradeSheet = 0;
        //     return view('control_panel_student.enrollment.index', compact('GradeSheet'));
        // }
    }

    private $AlreadyEnrolled;
    private $SchoolYear;
    private $StudentInformation;
    private $hasBalance;
    private $Enrollment;
    
    private function transactionInfo()
    {
        $mytime = Carbon::now();
        $this->StudentInformation   = $this->student()->id;
        $SchoolYear                 = $this->schoolYearActiveStatus()->id;
        $this->AlreadyEnrolled      = $this->alreadyEnrolled($this->StudentInformation, $SchoolYear);
        $previousUserID             = $this->prevYear($SchoolYear);
        $previousYear               = $this->checkPrevYear($this->StudentInformation, $previousUserID);

        $this->hasBalance = null;
        try {
            if($previousYear->status == 1)
            {
                $this->hasBalance = 1;
                $this->SchoolYear = $previousUserID;
            }
        } catch (\Throwable $th) {
            $this->SchoolYear = $SchoolYear;
        }
        
    }
    
    public function save(Request $request)
    {
        $transaction_info = $this->transactionInfo();

        if(!$this->AlreadyEnrolled || !$this->hasBalance){
            $rules = [
                'bank_tution_amt'       =>  'required',
                'bank_phone'            =>  'required',
                'bank_email'            =>  'email|required',
                'bank'                  =>  'required',
                'bank_transaction_id'   =>  'required',
                'bank_pay_fee'          =>  'required',
                'bank_image'            =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ];
        }else{
            $rules = [                  
                'bank_phone'            =>  'required',
                'bank_email'            =>  'email|required',
                'bank'                  =>  'required',
                'bank_transaction_id'   =>  'required',
                'bank_pay_fee'          =>  'required',
                'bank_image'            =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ];
        }
        
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails())
        {   
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $validator->getMessageBag()]);
        }

        if($request->bank_balance){
            $total = $request->bank_balance;
        }else{
            $total = $request->bank_tution - $request->bank_pay_fee;
        }

        $tuition         = $request->bank_tution_amt;
        $phone           = $request->bank_phone;
        $email           = $request->bank_email;
        $category        = $request->bank;
        $transaction_id  = $request->bank_transaction_id;
        $pay_fee         = $request->bank_pay_fee;
        $image           = $request->bank_image;
        $other_id        = $request->other_id;
        $other_price     = $request->other_price;
        $other_name      = $request->other_name;
        $discount        = $request->discount_bank;
        $downpayment     = $request->downpayment;
        $student_id      = $this->StudentInformation;
        $school_year_id  = $this->SchoolYear;

        // return json_encode($this->StudentInformation);
        
        $save = $this->save_transaction(
            $tuition, $phone, $email, $category, $transaction_id, $pay_fee, $image, $total, 
            $student_id, $school_year_id, $other_id, $other_price, $other_name, $discount, $downpayment
        );

        return $save;
    }

    
    public function save_data(Request $request)
    {
        $transaction_info = $this->transactionInfo();

        // return json_encode($previousYear);
        if(!$this->AlreadyEnrolled || !$this->hasBalance){
            $rules = [
                'gcash_tution_amt'      =>  'required',
                'gcash_phone'           =>  'required',
                'gcash_email'           =>  'email|required',
                'Gcash'                 =>  'required',
                'gcash_transaction_id'  =>  'required',
                'gcash_pay_fee'         =>  'required',
                'gcash_image'           =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ];
        }else{
            $rules = [                  
                'gcash_phone'           =>  'required',
                'gcash_email'           =>  'email|required',
                'Gcash'                 =>  'required',
                'gcash_transaction_id'  =>  'required',
                'gcash_pay_fee'         =>  'required',
                'gcash_image'           =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ];
        }

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails())
        {   
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $validator->getMessageBag()]);
        }

        if($request->gcash_balance){
            $total = $request->gcash_balance;
        }else{
            $total = $request->gcash_tution_total - $request->gcash_pay_fee;
        }

        $tuition         = $request->gcash_tution_amt;
        $phone           = $request->gcash_phone;
        $email           = $request->gcash_email;
        $category        = $request->Gcash;
        $transaction_id  = $request->gcash_transaction_id;
        $pay_fee         = $request->gcash_pay_fee;
        $image           = $request->gcash_image;
        $other_id        = $request->other_id;
        $other_price     = $request->other_price;
        $other_name      = $request->other_name;
        $discount        = $request->discount_bank;
        $downpayment     = $request->downpayment;
        $student_id      = $this->StudentInformation;
        $school_year_id  = $this->SchoolYear;

        
        $save = $this->save_transaction(
            $tuition, $phone, $email, $category, $transaction_id, $pay_fee, $image, $total, 
            $student_id, $school_year_id, $other_id, $other_price, $other_name, $discount, $downpayment
        );

        return $save;
    }

    

    private function transactionMonthPayment(
        $transaction_id, $student_id, $pay_fee, $school_year_id, $total, $email, $phone, $category, $transaction, $image, $discount
        )
    {
            $this->Enrollment = new TransactionMonthPaid();
            $this->Enrollment->or_no          = $transaction_id;
            $this->Enrollment->student_id     = $student_id;
            $this->Enrollment->payment        = $pay_fee;
            $this->Enrollment->school_year_id = $school_year_id;
            $this->Enrollment->balance        = $total;
            $this->Enrollment->email          = $email;
            $this->Enrollment->number         = $phone;
            $this->Enrollment->payment_option = $category;
            $this->Enrollment->online_charges = 0.00;
            $this->Enrollment->isSuccess      = 1;
            $this->Enrollment->transaction_id = $transaction;            
            // image
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/img/receipt/'), $imageName);           
            //
            $this->Enrollment->receipt_img = $imageName;
            $this->Enrollment->save();

            if($discount != 0){
                foreach($discount as $get_data){
                    
                    $DiscountFee = DiscountFee::where('id', $get_data)
                        ->where('apply_to', 1)
                        ->where('current', 1)
                        ->where('status', 1)
                        ->first();
                        
                    $DiscountFeeSave = new TransactionDiscount();
                    $DiscountFeeSave->student_id                = $student_id;
                    $DiscountFeeSave->discount_amt              = $DiscountFee->disc_amt;
                    $DiscountFeeSave->discount_type             = $DiscountFee->disc_type;        
                    $DiscountFeeSave->transaction_month_paid_id = $this->Enrollment->id;                
                    $DiscountFeeSave->school_year_id            = $school_year_id;
                    $DiscountFeeSave->category                  = $DiscountFee->category;
                    $DiscountFeeSave->save();
                }    
            }

            return $this->Enrollment->save();
    }

    private function save_transaction(
        $tuition, $phone, $email, $category, $transaction_id, $pay_fee, $image, $total, 
        $student_id, $school_year_id, $other_id, $other_price, $other_name, $discount, $downpayment
    )
    {
        // $checkAccount = TransactionDiscount::where('school_year_id', $school_year_id)
        //     ->where('student_id', $student_id)
        //     ->first();
        
        $transaction = Transaction::where('school_year_id', $school_year_id)
            ->where('student_id', $student_id)
            ->first();

        // return json_encode($transaction);

        if($transaction){
            
            $transaction_paid = TransactionOtherFee::where('transaction_id', $transaction->id)
                ->where('student_id', $student_id)
                ->where('isSuccess', '')
                ->orderBY('id', 'DESC')
                ->first();

            if($transaction_paid){
                foreach($downpayment as $get_data){
                    $transaction_paid->others_fee_id = $get_data;
                }
                $transaction_paid->save();
            }

            $this->transactionMonthPayment(
                $transaction_id, $student_id, $pay_fee, $school_year_id, $total, $email, $phone, $category, $transaction->id, $image, $discount
            );

            // existing other fee not successful
            $transaction_paid = TransactionOtherFee::where('transaction_id', $transaction->id)
                ->where('student_id', $student_id)
                ->where('isSuccess', '')
                ->orderBY('id', 'DESC')
                ->first();

            if($transaction_paid){
                $transaction_paid->isSuccess = 1;
                $transaction_paid->save();
            }
            

        }else{

            $EnrollmentTransaction = new Transaction();
            $EnrollmentTransaction->payment_category_id = $tuition;
            $EnrollmentTransaction->student_id          = $student_id;
            $EnrollmentTransaction->school_year_id      = $school_year_id;
            
            foreach($downpayment as $get_data){
                $EnrollmentTransaction->downpayment_id = $get_data;  
            }
            
            $EnrollmentTransaction->save();

            $this->transactionMonthPayment(
                $transaction_id, $student_id, $pay_fee, $school_year_id, $total, $email, $phone, $category, $transaction->id, $image, $discount
            );
            
            if($other_id){
                $Other = new TransactionOtherFee();
                $Other->transaction_id  = $EnrollmentTransaction->id;
                $Other->student_id      = $student_id;
                $Other->others_fee_id   = $other_id;
                $Other->school_year_id  = $school_year_id;
                $Other->item_qty        = 1;
                $Other->item_price      = $other_price;
                $Other->other_name      = $other_name;
                $Other->isSuccess       = 1;
                $Other->save();
            }
        }   

        // return $this->Enrollment->transaction_id;
        // return $email;
        $payment = Transaction::find($this->Enrollment->transaction_id);
        try{
            // return json_encode([$payment->transactionDiscounts]);
            Mail::to($email)->send(new SendMail($payment));
            return response()->json([
                'res_code' => 0,
                'res_msg' =>
                'You have successfully accomplished the form. Check your email for review of Finance Dept. Thank you!'
            ]); 
            // Mail::to('inquiry@sja-bataan.com')->cc('finance@sja-bataan.com')->send(new NotifyAdminMail($payment));
            // Mail::to('inquiry@sja-bataan.com')->send(new NotifyAdminMail($payment));
        }catch(\Exception $e){
            $error = \Log::error($e->getMessage());
            
            return response()->json([
                'res_code'  => 1,
                'res_msg'   => $error
            ]); 
        }
            
       
    }

    

    public function modal_data(Request $request){
        
        // $previousUserID = $this->prevYear($request->school_year_id);
        $SchoolYear = $request->school_year_id;
        $StudentInformation = $request->id;
        $previousUserID = $this->alreadyEnrolled($StudentInformation, $SchoolYear);

        if($previousUserID){
            $sy = $previousUserID->school_year_id;
        }else{
            $sy = $SchoolYear;
        }
        

        $hasTransaction = TransactionMonthPaid::where('student_id', $StudentInformation)
            ->where('school_year_id', $sy)
            ->where('isSuccess', 1)
            ->orderBY('id', 'desc')
            ->first();        

        $Discount = TransactionDiscount::where('student_id', $StudentInformation)
            ->where('school_year_id', $sy)
            ->where('isSuccess', 1)
            ->sum('discount_amt');

        $payment = TransactionMonthPaid::where('student_id', $StudentInformation)
            ->where('school_year_id', $sy)
            ->where('isSuccess', 1)
            ->sum('payment');

        $Discount_amt = TransactionDiscount::where('student_id', $StudentInformation)
            ->where('school_year_id', $sy)->where('isSuccess', 1)
            ->get();

        $Transaction_history = NULL;

        if ($StudentInformation && $sy)
        {
            
            $Transaction_history = Transaction::where('student_id', $StudentInformation)
                ->where('school_year_id', $sy)
                ->orderBY('id', 'desc')
                ->get();

            $Transaction = TransactionMonthPaid::where('student_id', $StudentInformation)
                ->where('school_year_id', $sy)->where('isSuccess', 1)
                ->orderBY('id', 'desc')
                ->get();
            
            if($hasTransaction){
                
                $OtherFee = TransactionOtherFee::where('student_id', $StudentInformation)
                    ->where('school_year_id', $sy)->where('transaction_id', $Transaction_history[0]->id)
                    ->where('isSuccess', 1)
                    ->get();
                
                $Other_price = TransactionOtherFee::where('student_id', $StudentInformation)
                    ->where('school_year_id', $sy)->where('transaction_id', $Transaction_history[0]->id)
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
            compact('Discount_amt','Transaction_history','Transaction','Discount','tuition_misc_fee','hasTransaction','OtherFee','payment'))
            ->render();
    }
    
}