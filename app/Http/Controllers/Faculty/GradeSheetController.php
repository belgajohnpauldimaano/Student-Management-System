<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeSheetController extends Controller
{
    
    public function index (Request $request) 
    {
        // $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        // return json_encode(['FacultyInformation' => $FacultyInformation, 'Auth' => \Auth::user()]);
        $SchoolYear         = \App\SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'ASC')->orderBy('school_year', 'ASC')->get();
        return view('control_panel_faculty.student_grade_sheet.index', compact('SchoolYear'));
    }
    public function list_students_by_class (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();

        $Enrollment = \App\Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
                    ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
                    ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                    // ->join('student_enrolled_subjects', 'student_enrolled_subjects.subject_id', '=', 'class_subject_details.subject_id')
                    // ->join('student_enrolled_subjects', 'student_enrolled_subjects.subject_id', '=', 'class_subject_details.subject_id')
                    // ->join('student_enrolled_subjects', 'student_enrolled_subjects.enrollments_id', '=', 'enrollments.id')
                    ->join('student_enrolled_subjects', function ($join) {
                        $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id')
                        ->on('student_enrolled_subjects.subject_id', '=', 'class_subject_details.subject_id');
                    })
                    ->whereRaw('class_subject_details.faculty_id = '. $FacultyInformation->id)
                    ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
                    ->whereRaw('class_details.current = 1')
                    ->whereRaw('class_details.status != 0')
                    ->select(\DB::raw("
                        student_informations.id,
                        CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                        student_enrolled_subjects.id as student_enrolled_subject_id,
                        enrollments.id as enrollment_id,
                        student_enrolled_subjects.fir_g,
                        student_enrolled_subjects.fir_g_status,
                        student_enrolled_subjects.sec_g,
                        student_enrolled_subjects.sec_g_status,
                        student_enrolled_subjects.thi_g,
                        student_enrolled_subjects.thi_g_status,
                        student_enrolled_subjects.fou_g,
                        student_enrolled_subjects.fou_g_status,
                        student_enrolled_subjects.fin_g,
                        student_enrolled_subjects.fin_g_status,
                        class_subject_details.status as grading_status 
                    "))
                    ->orderBy('student_informations.last_name', 'ASC')
                    ->paginate(50);
        // $ClassSubjectDetail_status = \App\ClassSubjectDetail::where('id', $request->search_class_subject)->first();
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('class_subject_details.id', $request->search_class_subject)
            ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('
                class_subject_details.id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_faculty.student_grade_sheet.partials.data_list', compact('Enrollment', 'ClassSubjectDetail'))->render();
    }
    public function list_students_by_class_print (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();

        $Enrollment = \App\Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
                    ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
                    ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                    ->join('student_enrolled_subjects', function ($join) {
                        $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id')
                        ->on('student_enrolled_subjects.subject_id', '=', 'class_subject_details.subject_id');
                    })
                    ->whereRaw('class_subject_details.faculty_id = '. $FacultyInformation->id)
                    ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
                    ->whereRaw('class_subject_details.status = 2')
                    ->whereRaw('class_details.current = 1')
                    ->whereRaw('class_details.status = 1')
                    ->select(\DB::raw("
                        student_informations.id,
                        CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                        student_enrolled_subjects.id as student_enrolled_subject_id,
                        enrollments.id as enrollment_id,
                        student_enrolled_subjects.fir_g,
                        student_enrolled_subjects.fir_g_status,
                        student_enrolled_subjects.sec_g,
                        student_enrolled_subjects.sec_g_status,
                        student_enrolled_subjects.thi_g,
                        student_enrolled_subjects.thi_g_status,
                        student_enrolled_subjects.fou_g,
                        student_enrolled_subjects.fou_g_status,
                        student_enrolled_subjects.fin_g,
                        student_enrolled_subjects.fin_g_status,
                        class_subject_details.status as grading_status
                    "))
                    ->get();
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('class_subject_details.id', $request->search_class_subject)
            ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('class_subject_details.status', '=', 2)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('
                class_subject_details.id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();
        if (count($Enrollment) == 0) {
            return "invalid reques";
        }
        $pdf = \PDF::loadView('control_panel_faculty.student_grade_sheet.partials.print', compact('Enrollment', 'ClassSubjectDetail', 'FacultyInformation'));
        return $pdf->stream();
    }
    public function list_class_subject_details (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('  
                class_subject_details.id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level
            '))
            ->get();
        
        $class_details_elements = '<option value="">Select Class Subject</option>';
        if ($ClassSubjectDetail) 
        {
            foreach ($ClassSubjectDetail as $data) 
            {
                $class_details_elements .= '<option value="'. $data->id .'">'. $data->subject_code . ' ' . $data->subject . ' - Grade ' .  $data->grade_level . ' Section ' . $data->section .'</option>';
            }

            return $class_details_elements;
        }
        return $class_details_elements;
    }
    public function temporary_save_grade(Request $request)
    {
        if (!$request->student_enrolled_subject_id || !$request->enrollment_id || !$request->grading) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.',]);
        } 

        $validator = \Validator::make($request->all(), [
            'grade' => 'numeric|between:0,100.00'
        ], [
            'grade.between' => 'grade is invalid. 0 - 100.00'
        ]);
        if ($validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'grade is invalid. 0 - 100.00.', 'res_error_msg' => $validator->getMessageBag()]);
        }

        $student_enrolled_subject_id = base64_decode($request->student_enrolled_subject_id);
        $enrollment_id = base64_decode($request->enrollment_id);
        $grading = base64_decode($request->grading);
        $grade = $request->grade;

        $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('id', $student_enrolled_subject_id)->where('enrollments_id', $enrollment_id)->first();

        if (!$StudentEnrolledSubject)
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.',]);
        }

        if ($grading == 'first') 
        {
            $StudentEnrolledSubject->fir_g = $grade;
            // $StudentEnrolledSubject->fir_g_status = 1;
        } 
        else if ($grading == 'second') 
        {
            $StudentEnrolledSubject->sec_g = $grade;
            // $StudentEnrolledSubject->sec_g_status = 1;
        }
        else if ($grading == 'third') 
        {
            $StudentEnrolledSubject->thi_g = $grade;
            // $StudentEnrolledSubject->thi_g_status = 1;
        }
        else if ($grading == 'fourth') 
        {
            $StudentEnrolledSubject->fou_g = $grade;
            // $StudentEnrolledSubject->fou_g_status = 1;
        }
        $StudentEnrolledSubject->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved temporarily.', 'aa' => $student_enrolled_subject_id]);
    }
    public function save_grade (Request $request)
    {
        if (!$request->student_enrolled_subject_id || !$request->enrollment_id || !$request->grading || !$request->grade) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.',]);
        }

        $validator = \Validator::make($request->all(), [
            'grade' => 'numeric|between:65,100.00'
        ], [
            'grade.between' => 'grade is invalid. 65 - 100.00'
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'grade is invalid. 65 - 100.00.', 'res_error_msg' => $validator->getMessageBag()]);
        }


        $student_enrolled_subject_id = base64_decode($request->student_enrolled_subject_id);
        $enrollment_id = base64_decode($request->enrollment_id);
        $grading = base64_decode($request->grading);
        $grade = $request->grade;
        
        $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('id', $student_enrolled_subject_id)->where('enrollments_id', $enrollment_id)->first();
        // $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('id', $request->student_enrolled_subject_id)->where('enrollments_id', $request->enrollment_id)->first();

        if (!$StudentEnrolledSubject)
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.',]);
        }

        if ($request->grading == 'first') 
        {
            $StudentEnrolledSubject->fir_g = $request->grade;
            $StudentEnrolledSubject->fir_g_status = 1;
        } 
        else if ($request->grading == 'second') 
        {
            $StudentEnrolledSubject->sec_g = $request->grade;
            $StudentEnrolledSubject->sec_g_status = 1;
        }
        else if ($request->grading == 'third') 
        {
            $StudentEnrolledSubject->thi_g = $request->grade;
            $StudentEnrolledSubject->thi_g_status = 1;
        }
        else if ($request->grading == 'fourth') 
        {
            $StudentEnrolledSubject->fou_g = $request->grade;
            $StudentEnrolledSubject->fou_g_status = 1;
        }
        $StudentEnrolledSubject->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
    }
    public function finalize_grade (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        $ClassSubjectDetail = \App\ClassSubjectDetail::where('class_subject_details.id', $request->id)
            ->where('faculty_id', $FacultyInformation->id)
            ->first();
        if ($ClassSubjectDetail) 
        {
            $ClassSubjectDetail->status = 2;
            $ClassSubjectDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully finalized.',]);
        }
        else 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request',]); 
        }
    }
}
