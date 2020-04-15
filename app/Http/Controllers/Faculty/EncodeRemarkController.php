<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EncodeRemarkController extends Controller
{
    public function index (Request $request)
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        $SchoolYear = \App\SchoolYear::where('current', 1)->where('status', 1)->first();
        $DateRemarks = \App\DateRemark::where('school_year_id', $SchoolYear->id)->first();


        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
            ->join('faculty_informations', 'faculty_informations.id','=','class_details.adviser_id')
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('school_years.current', '!=', 0)              
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
                school_years.school_year,

            '))
            ->orderBY('class_details.school_year_id','DESC')
            ->first();

        
            $EnrollmentMale = \App\Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
                ->join('users', 'users.id', '=', 'student_informations.user_id')
                ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
                ->whereRaw('student_informations.gender = 1')    
                ->where('school_years.current', '!=', 0)     
                ->select(\DB::raw("
                    enrollments.id as e_id,
                    enrollments.attendance,
                    enrollments.j_lacking_unit,
                    enrollments.s1_lacking_unit,
                    enrollments.s2_lacking_unit,
                    enrollments.eligible_transfer,
                    student_informations.id as student_information_id,
                    users.username,
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
                "))
                ->orderBY('student_name', 'ASC')
                ->get();

            $EnrollmentFemale = \App\Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
                ->join('users', 'users.id', '=', 'student_informations.user_id')
                ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
                ->where('school_years.current', '!=', 0)  
                ->whereRaw('student_informations.gender = 2')       
                ->select(\DB::raw("
                    enrollments.id as e_id,
                    enrollments.attendance,
                    enrollments.j_lacking_unit,
                        enrollments.s1_lacking_unit,
                        enrollments.s2_lacking_unit,
                    student_informations.id  as student_information_id,
                    users.username,
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
                "))
                ->orderBY('student_name', 'ASC')
                ->get();
                        

            return view('control_panel_faculty.encode_remarks.index',
                compact('EnrollmentMale','EnrollmentFemale','ClassSubjectDetail','SchoolYear','DateRemarks',
                'FacultyInformation','StudentEnrolledSubject1','StudentEnrolledSubject','totalsum','ClassDetail','Student_info',
                'Enrollment_female','StudentEnrolledSubject_female','StudentEnrolledSubject_fem','Semester'))->render();
    }

    public function save(Request $request)
    {
        $stud_id = $request->stud_id;
        $class_detail_id = \Crypt::decrypt($request->print_sy);
        $s_year = $request->s_year;
        

        try {
            
            $Student_info = \App\Enrollment::where('student_information_id', $stud_id)
                ->where('class_details_id', $class_detail_id)->first();

                if($request->level < 11)
                {             
                    $Student_info->j_lacking_unit = $request->jlacking_units;                    
                }                
                else if($request->level > 10)
                {
                    if($request->sem == 1)
                    {
                        $Student_info->s1_lacking_unit = $request->s1_lacking_units;
                    }else{
                        $Student_info->s2_lacking_unit = $request->s2_lacking_units;
                    }
                }
                $Student_info->save();         

            return response()->json(['res_code' => 0, 'res_msg' => 'Remarks successfully saved.',]);
            
        }catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return "Invalid parameter";
        }
       
    }

    
}
