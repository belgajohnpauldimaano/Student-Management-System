<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyAdvisoryClassController extends Controller
{
    public function index (Request $request) 
    {
        // $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        // return json_encode(['FacultyInformation' => $FacultyInformation, 'Auth' => \Auth::user()]);
        $SchoolYear         = \App\SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'ASC')->orderBy('school_year', 'ASC')->get();
        return view('control_panel_faculty.my_advisory_class.index', compact('SchoolYear'));
        // return view('control_panel_faculty.my_advisory_class.index');
    
    }

    public function list_students_by_class1 (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_details.id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();

            

            $EnrollmentMale = \App\Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
                    ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
                    ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                    
                    ->join('student_enrolled_subjects', function ($join) {
                        $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
                        // ->on('student_enrolled_subjects.subject_id', '=', 'class_subject_details.subject_id');
                    })
                    ->whereRaw('class_subject_details.faculty_id = '. $FacultyInformation->id)
                    ->whereRaw('class_details.school_year_id = '. $request->search_sy)
                    ->whereRaw('class_subject_details.class_details_id', $ClassSubjectDetail->id)
                    // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
                    // ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject)
                    // ->whereRaw('class_details.id = '. $search_class_subject[1])
                    ->whereRaw('class_details.current = 1')
                    ->whereRaw('class_details.status != 0')
                    ->whereRaw('student_informations.gender = 1')
                    ->select(\DB::raw("
                        student_informations.id,
                        class_details.id as class_details_id,
                        CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                        student_informations.gender,
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
                    ->paginate(100);
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','EnrollmentMale'))->render();
    }
}
