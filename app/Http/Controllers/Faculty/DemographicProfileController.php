<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DemographicProfileController extends Controller
{
    public function index(Request $request)
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();

        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
            ->join('faculty_informations', 'faculty_informations.id','=','class_details.adviser_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                class_subject_details.sem,
                class_details.school_year_id,
                faculty_informations.first_name, faculty_informations.middle_name ,  faculty_informations.last_name,
                school_years.school_year
            '))
            ->orderBY('class_details.school_year_id','DESC')
            ->first();

        
            $EnrollmentMale = \App\Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
            // ->whereRaw('enrollments.class_details_id = '. $class_id)
            ->whereRaw('student_informations.gender = 1')       
            ->select(\DB::raw("
                enrollments.id as e_id,
                enrollments.attendance,
                student_informations.id,
                users.username,
                CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_informations.age_june, student_informations.age_may,
                student_informations.birthdate, student_informations.gender, student_informations.guardian
                , student_informations.father_name, student_informations.mother_name
            "))
            ->orderBY('student_name', 'ASC')
            ->get();

            $EnrollmentFemale = \App\Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
            // ->whereRaw('enrollments.class_details_id = '. $class_id)
            ->whereRaw('student_informations.gender = 2')       
            ->select(\DB::raw("
                enrollments.id as e_id,
                enrollments.attendance,
                student_informations.id,
                users.username,
                CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_informations.age_june, student_informations.age_may,
                student_informations.birthdate, student_informations.gender, student_informations.guardian
                , student_informations.father_name, student_informations.mother_name
            "))
            ->orderBY('student_name', 'ASC')
            ->get();

        return view('control_panel_faculty.demographic_profile.index', compact('EnrollmentMale','EnrollmentFemale','ClassSubjectDetail'))->render();
        
        
    //    return redirect()->back()
    }
}
