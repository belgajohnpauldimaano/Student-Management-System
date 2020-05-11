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
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class EnrollmentController extends Controller
{

    public function index(Request $request)
    {    
        $User = \Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)->first();
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        $findSchoolYear = ClassDetail::where('school_year_id' , $SchoolYear->id)->first();
        
        if($findSchoolYear){        
            if ($StudentInformation) 
            {
                $Enrollment = Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                    ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
                    ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
                    ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
                    ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                    ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
                    ->where('student_information_id', $StudentInformation->id)
                    ->where('class_subject_details.status', '!=', 0)
                    ->where('enrollments.status', 1)
                    ->where('class_details.status', 1)
                    ->where('class_details.school_year_id', $SchoolYear->id)
                    ->select(\DB::raw("
                        enrollments.id as enrollment_id,
                        enrollments.class_details_id as cid,
                        enrollments.attendance,
                        class_details.grade_level,
                        class_subject_details.id as class_subject_details_id,
                        class_subject_details.class_days,
                        class_subject_details.class_time_from,
                        class_subject_details.class_time_to,
                        class_subject_details.status as grade_status,
                        CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                        subject_details.id AS subject_id,
                        subject_details.subject_code,
                        subject_details.subject,
                        rooms.room_code,
                        section_details.section
                    "))
                    ->orderBy('class_subject_details.class_subject_order', 'ASC')
                    ->get();

                $ClassDetail = [];
                
                if ($Enrollment)
                {                
                    $ClassDetail = ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
                    ->join('rooms', 'rooms.id', '=' ,'class_details.room_id')
                    ->join('school_years', 'school_years.id', '=' ,'class_details.school_year_id')
                    ->selectRaw('
                        class_details.id,
                        class_details.section_id,
                        class_details.room_id,
                        class_details.school_year_id,
                        class_details.grade_level,
                        class_details.current,
                        section_details.section,
                        section_details.grade_level as section_grade_level,
                        school_years.school_year,
                        rooms.room_code,
                        rooms.room_description
                    ')
                    ->where('section_details.status', 1)
                    ->where('class_details.id', $Enrollment[0]->cid)
                    ->first();
                }                


                $grade_level_id = ($ClassDetail->grade_level + 1);

                $Tuition = TuitionFee::where('id', $grade_level_id)->first();
                $PaymentCategory = PaymentCategory::with('misc_fee','tuition')
                                ->where('grade_level_id', $grade_level_id)->first();
                                
                $Downpayment = DownpaymentFee::where('current', 1)->first();
                $Profile = StudentInformation::where('user_id', $User->id)->first();

                return view('control_panel_student.enrollment.index', 
                    compact('grade_level', 'ClassDetail','PaymentCategory','Downpayment','Profile','StudentInformation','Tuition'));
                    return json_encode(['GradeSheetData' => $GradeSheetData,]);
                    
            }else{
                echo "Invalid request";
            }
        }
        else{
            $GradeSheet = 0;
            return view('control_panel_student.enrollment.index', compact('GradeSheet'));
        }
    }

    // public function save(Request $request){

    //     $User = \Auth::user();
    //     $StudentInformation = StudentInformation::where('user_id', $User->id)->first();
    //     $mytime = Carbon::now();

    //     $SchoolYear = SchoolYear::where('current', 1)
    //         ->where('status', 1)
    //         ->orderBY('id', 'DESC')
    //         ->first();

    //     $rules = [
    //         'tution_category' => 'required',
    //         'e_downpayment' => 'required',
    //         'pay_fee' => 'required',
    //         // 'phone' => 'required',
    //         'email'=>'required'
    //     ];
        
    //     $validator = \Validator::make($request->all(), $rules);

    //     if ($validator->fails())
    //     {   
    //         return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $validator->getMessageBag()]);
    //     }
      
    //     // $Enrollment = new App\Transaction();
    //     // $Enrollment->or_number = $StudentInformation->first_name.''.$mytime->toDateTimeString();
    //     // $Enrollment->payment_category_id = $request->tution_category;
    //     // $Enrollment->student_id = $StudentInformation->id;
    //     // $Enrollment->school_year_id = $SchoolYear->id;
    //     // $Enrollment->downpayment = $request->pay_fee;
    //     // $Enrollment->save();

    //     // $payment = App\Transaction::find($Enrollment->id);

    //     // \Mail::to($request->email)->send(new SendMail($payment));

    //     return response()->json(['res_code' => 0, 'res_msg' => 'You have successfuly enrolled.']);
    // }

    
}
