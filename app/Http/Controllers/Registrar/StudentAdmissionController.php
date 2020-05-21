<?php

namespace App\Http\Controllers\Registrar;

use App\Enrollment;
use App\GradeLevel;
use App\SchoolYear;
use App\ClassDetail;
use App\Transaction;
use App\Grade_sheet_first;
use App\Grade_sheet_third;
use App\Grade_sheet_second;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\Grade_sheet_firstsem;
use App\StudentEnrolledSubject;
use App\Grade_sheet_firstsemsecond;
use App\Http\Controllers\Controller;

class StudentAdmissionController extends Controller
{
    

    public function grade7(Request $request)
    {
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 

        $g_s_7_c =  ClassDetail::where('grade_level', 7)->where('school_year_id', $SchoolYear->id)->first();

        $g_s_7 =  ClassDetail::where('grade_level', 7)->where('school_year_id', $SchoolYear->id)->get();
        

        if($request->ajax()){
            $Grade7 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->selectRaw('
                    CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                    CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                    transaction_month_paids.approval,
                    student_informations.id as student_id,
                    transactions.isEnrolled                                 
                ')
                ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
                ->where('student_informations.status', 1)
                ->where('transaction_month_paids.isSuccess', 1)
                ->where('transaction_month_paids.approval', 'Approved')
                ->where('payment_categories.grade_level_id', 7)
                ->where('transactions.isEnrolled', 0)
                ->distinct()
                ->paginate(10, ['transaction_month_paids.id']);

            return view('control_panel_registrar.student_admission.Grade7.partials.data_list', 
                compact(
                    'Grade7','gradelevel','g_s_7','g_s_7_c'
                ));
        }

        $Grade7 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
            ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                transaction_month_paids.approval,
                student_informations.id as student_id,
                transactions.isEnrolled                                 
            ')
            ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->where('payment_categories.grade_level_id', 7)
            ->where('transactions.isEnrolled', 0)
            ->distinct()
            ->paginate(10, ['transaction_month_paids.id']);

        return view('control_panel_registrar.student_admission.Grade7.index', 
            compact(
                'Grade7','gradelevel','g_s_7','g_s_7_c'
            ));
    }

    public function grade8(Request $request)
    {
        
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 

        $g_s_8_c =  ClassDetail::where('grade_level', 8)->where('school_year_id', $SchoolYear->id)->first();
        $g_s_8 =  ClassDetail::where('grade_level', 8)->where('school_year_id', $SchoolYear->id)->get();
        
        if($request->ajax()){
            $Grade8 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->selectRaw('
                    CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                    CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                    transaction_month_paids.approval,
                    student_informations.id as student_id,
                    transactions.isEnrolled                                 
                ')
                ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
                ->where('student_informations.status', 1)
                ->where('transaction_month_paids.isSuccess', 1)
                ->where('transaction_month_paids.approval', 'Approved')
                ->where('payment_categories.grade_level_id', 8)
                ->where('transactions.isEnrolled', 0)
                ->distinct()
                ->paginate(10, ['transaction_month_paids.id']);

            return view('control_panel_registrar.student_admission.Grade8.partials.data_list', 
                compact(
                    'Grade8','gradelevel','g_s_8','g_s_8_c'
                ));
        }

        $Grade8 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
            ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                transaction_month_paids.approval,
                student_informations.id as student_id,
                transactions.isEnrolled                                 
            ')
            ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->where('payment_categories.grade_level_id', 8)
            ->where('transactions.isEnrolled', 0)
            ->distinct()
            ->paginate(10, ['transaction_month_paids.id']);

        return view('control_panel_registrar.student_admission.Grade8.index', 
            compact(
                'Grade8','gradelevel','g_s_8','g_s_8_c'
            ));
    }

    public function grade9(Request $request)
    {
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 

        $g_s_9_c =  ClassDetail::where('grade_level', 9)->where('school_year_id', $SchoolYear->id)->first();
        $g_s_9 =  ClassDetail::where('grade_level', 9)->where('school_year_id', $SchoolYear->id)->get();
        
        if($request->ajax()){
            $Grade9 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->selectRaw('
                    CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                    CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                    transaction_month_paids.approval,
                    student_informations.id as student_id,
                    transactions.isEnrolled                                 
                ')
                ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
                ->where('student_informations.status', 1)
                ->where('transaction_month_paids.isSuccess', 1)
                ->where('transaction_month_paids.approval', 'Approved')
                ->where('payment_categories.grade_level_id', 9)
                ->where('transactions.isEnrolled', 0)
                ->distinct()
                ->paginate(10, ['transaction_month_paids.id']);

            return view('control_panel_registrar.student_admission.Grade9.partials.data_list', 
                compact(
                    'Grade9','gradelevel','g_s_9','g_s_9_c'
                ));
        }

        $Grade9 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
            ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                transaction_month_paids.approval,
                student_informations.id as student_id,
                transactions.isEnrolled                                 
            ')
            ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->where('payment_categories.grade_level_id', 9)
            ->where('transactions.isEnrolled', 0)
            ->distinct()
            ->paginate(10, ['transaction_month_paids.id']);

        return view('control_panel_registrar.student_admission.Grade9.index', 
            compact(
                'Grade9','gradelevel','g_s_9','g_s_9_c'
            ));
    }

    public function grade10(Request $request)
    {
      
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 

        $g_s_10_c =  ClassDetail::where('grade_level', 10)->where('school_year_id', $SchoolYear->id)->first();
        $g_s_10 =  ClassDetail::where('grade_level', 10)->where('school_year_id', $SchoolYear->id)->get();
        
        if($request->ajax()){
            $Grade10 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->selectRaw('
                    CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                    CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                    transaction_month_paids.approval,
                    student_informations.id as student_id,
                    transactions.isEnrolled                                 
                ')
                ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
                ->where('student_informations.status', 1)
                ->where('transaction_month_paids.isSuccess', 1)
                ->where('transaction_month_paids.approval', 'Approved')
                ->where('payment_categories.grade_level_id', 10)
                ->where('transactions.isEnrolled', 0)
                ->distinct()
                ->paginate(10, ['transaction_month_paids.id']);

            return view('control_panel_registrar.student_admission.Grade10.partials.data_list', 
                compact(
                    'Grade10','gradelevel','g_s_10','g_s_10_c'
                ));
        }

        $Grade10 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
            ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                transaction_month_paids.approval,
                student_informations.id as student_id,
                transactions.isEnrolled                                 
            ')
            ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->where('payment_categories.grade_level_id', 10)
            ->where('transactions.isEnrolled', 0)
            ->distinct()
            ->paginate(10, ['transaction_month_paids.id']);

        return view('control_panel_registrar.student_admission.Grade10.index', 
            compact(
                'Grade10','gradelevel','g_s_10','g_s_10_c'
            ));
    }

    public function grade11(Request $request)
    {
        
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        $g_s_11_c =  ClassDetail::where('grade_level', 11)->where('school_year_id', $SchoolYear->id)->first();
        $g_s_11 =  ClassDetail::where('grade_level', 11)->where('school_year_id', $SchoolYear->id)->get();
        
        if($request->ajax()){
            $Grade11 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->selectRaw('
                    CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                    CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                    transaction_month_paids.approval,
                    student_informations.id as student_id,
                    transactions.isEnrolled                                 
                ')
                ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
                ->where('student_informations.status', 1)
                ->where('transaction_month_paids.isSuccess', 1)
                ->where('transaction_month_paids.approval', 'Approved')
                ->where('payment_categories.grade_level_id', 11)
                ->where('transactions.isEnrolled', 0)
                ->distinct()
                ->paginate(10, ['transaction_month_paids.id']);

            return view('control_panel_registrar.student_admission.Grade11.partials.data_list', 
                compact(
                    'Grade11','gradelevel','g_s_11','g_s_11_c'
                ));
        }

        $Grade11 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
            ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                transaction_month_paids.approval,
                student_informations.id as student_id,
                transactions.isEnrolled                                 
            ')
            ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->where('payment_categories.grade_level_id', 11)
            ->where('transactions.isEnrolled', 0)
            ->distinct()
            ->paginate(10, ['transaction_month_paids.id']);

        return view('control_panel_registrar.student_admission.Grade11.index', 
            compact(
                'Grade11','gradelevel','g_s_11','g_s_11_c'
            ));
    }

    public function grade12(Request $request)
    {
        

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 
        $g_s_12_c =  ClassDetail::where('grade_level', 12)->where('school_year_id', $SchoolYear->id)->first();
        $g_s_12 =  ClassDetail::where('grade_level', 12)->where('school_year_id', $SchoolYear->id)->get();
        
        if($request->ajax()){
            $Grade12 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
                ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
                ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
                ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
                ->selectRaw('
                    CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                    CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                    transaction_month_paids.approval,
                    student_informations.id as student_id,
                    transactions.isEnrolled                                 
                ')
                ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
                ->where('student_informations.status', 1)
                ->where('transaction_month_paids.isSuccess', 1)
                ->where('transaction_month_paids.approval', 'Approved')
                ->where('payment_categories.grade_level_id', 12)
                ->where('transactions.isEnrolled', 0)
                ->distinct()
                ->paginate(10, ['transaction_month_paids.id']);

            return view('control_panel_registrar.student_admission.Grade12.partials.data_list', 
                compact(
                    'Grade12','gradelevel','g_s_12','g_s_12_c'
                ));
        }

        $Grade12 = StudentInformation::join('transactions','transactions.student_id', '=' ,'student_informations.id')    
            ->join('transaction_month_paids', 'transaction_month_paids.student_id', '=', 'student_informations.id')                                   
            ->join('payment_categories', 'payment_categories.id', '=', 'transactions.payment_category_id')
            ->join('student_categories', 'student_categories.id', '=', 'payment_categories.student_category_id')
            ->selectRaw('
                CONCAT(student_informations.last_name, " ", student_informations.first_name, ", " ,  student_informations.middle_name) AS student_name,
                CONCAT(payment_categories.grade_level_id," - ", student_categories.student_category) AS student_level,                        
                transaction_month_paids.approval,
                student_informations.id as student_id,
                transactions.isEnrolled                                 
            ')
            ->where('transaction_month_paids.school_year_id', $SchoolYear->id)
            ->where('student_informations.status', 1)
            ->where('transaction_month_paids.isSuccess', 1)
            ->where('transaction_month_paids.approval', 'Approved')
            ->where('payment_categories.grade_level_id', 12)
            ->where('transactions.isEnrolled', 0)
            ->distinct()
            ->paginate(10, ['transaction_month_paids.id']);

        return view('control_panel_registrar.student_admission.Grade12.index', 
            compact(
                'Grade12','gradelevel','g_s_12','g_s_12_c'
            ));
    }

    public function enroll_student (Request $request) 
    {
        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->first();

        $StudentInformation = StudentInformation::where('id', $request->student_id)->first();

        $ClassDetail = ClassDetail::with('class_subjects')->where('id', $request->class_id)->first();

        
        $ClassDetail1 = ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
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
                school_years.id AS sy_id,
                school_years.school_year,
                rooms.room_code,
                rooms.room_description
            ')
            ->where('section_details.status', 1)
            ->where('school_years.current', 1)
            ->where('school_years.status', 1)
            ->where('class_details.id', $ClassDetail->id)
            ->first();

        

        $Enrollment = new Enrollment();
        $Enrollment->student_information_id = $StudentInformation->id;
        $Enrollment->class_details_id = $ClassDetail->id;

        $IsEnrolled = Transaction::where('student_id', $request->student_id)->where('school_year_id', $SchoolYear->id)->first();
        $IsEnrolled->IsEnrolled = 1;        
        
        if ($Enrollment->save() && $IsEnrolled->save())
        {
            if ($ClassDetail->class_subjects) 
            {
                foreach ($ClassDetail->class_subjects as $data) 
                {
                   

                    if($ClassDetail1->grade_level == 11 || $ClassDetail1->grade_level == 12)
                    {
                        $StudentEnrolledSubject = new StudentEnrolledSubject();
                        $StudentEnrolledSubject->subject_id = $data->subject_id;
                        $StudentEnrolledSubject->enrollments_id = $Enrollment->id;
                        $StudentEnrolledSubject->class_subject_details_id = $data->id;
                        // $StudentEnrolledSubject->student_information_id = $StudentInformation->id;
                        $StudentEnrolledSubject->save();
                        
                        $SaveSecondSem2 = new Grade_sheet_firstsem();
                        $SaveSecondSem2->enrollment_id = $Enrollment->id;
                        $SaveSecondSem2->school_year_id = $SchoolYear->id;
                        $SaveSecondSem2->section_details_id = $ClassDetail1->section_id;
                        $SaveSecondSem2->save();
    
                        $SaveSecondSem2 = new Grade_sheet_firstsemsecond();
                        $SaveSecondSem2->school_year_id = $SchoolYear->id;
                        $SaveSecondSem2->enrollment_id = $Enrollment->id;
                        $SaveSecondSem2->section_details_id = $ClassDetail1->section_id;
                        $SaveSecondSem2->save();  
                    }
                    else
                    {
                        $StudentEnrolledSubject = new StudentEnrolledSubject();
                        $StudentEnrolledSubject->subject_id = $data->subject_id;
                        $StudentEnrolledSubject->enrollments_id = $Enrollment->id;
                        $StudentEnrolledSubject->class_subject_details_id = $data->id;
                        // $StudentEnrolledSubject->student_information_id = $StudentInformation->id;
                        $StudentEnrolledSubject->save();

                        $SaveToGradeSheet1 = new Grade_sheet_first();
                        $SaveToGradeSheet1->enrollment_id = $Enrollment->id;
                        $SaveToGradeSheet1->school_year_id = $SchoolYear->id;
                        $SaveToGradeSheet1->section_details_id = $ClassDetail1->section_id;
                        $SaveToGradeSheet1->save();

                        $SaveToGradeSheet2 = new Grade_sheet_second();
                        $SaveToGradeSheet2->enrollment_id = $Enrollment->id;
                        $SaveToGradeSheet2->school_year_id = $SchoolYear->id;
                        $SaveToGradeSheet2->section_details_id = $ClassDetail1->section_id;
                        $SaveToGradeSheet2->save();

                        $SaveToGradeSheet3 = new Grade_sheet_third();
                        $SaveToGradeSheet3->enrollment_id = $Enrollment->id;
                        $SaveToGradeSheet3->school_year_id = $SchoolYear->id;
                        $SaveToGradeSheet3->section_details_id = $ClassDetail1->section_id;
                        $SaveToGradeSheet3->save();

                        $SaveToGradeSheet4 = new Grade_sheet_fourth();
                        $SaveToGradeSheet4->enrollment_id = $Enrollment->id;
                        $SaveToGradeSheet4->school_year_id = $SchoolYear->id;
                        $SaveToGradeSheet4->section_details_id = $ClassDetail1->section_id;
                        $SaveToGradeSheet4->save();
                    }                                   

                    
                }
                return response()->json(['res_code' => 0, 
                'res_msg' => 'Student successfully enrolled.'
                ]);
            }
            
        }
    
        return response()->json(['res_code' => 1, 'res_msg' => 'There is a problem in enrolling student.'.$request->class_id]);
    }
}
