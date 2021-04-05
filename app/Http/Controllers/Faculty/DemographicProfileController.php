<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Traits\HasFacultyDetails;
use App\Models\ClassSubjectDetail;
use App\Models\FacultyInformation;
use App\Models\StudentInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\FacadesAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DemographicProfileController extends Controller
{
    use HasFacultyDetails;

    public function index(Request $request)
    {
        $FacultyInformation = $this->faculty();
        
        $school_year_id = SchoolYear::where('current', 1)->where('status', 1)->first()->id;

        $ClassDetail = ClassDetail::with(['section','room','schoolYear','adviserData'])
            ->whereCurrent(1)
            ->whereStatus(1)
            ->whereSchoolYearId($school_year_id)
            ->whereAdviserId($FacultyInformation->id)
            ->first();
            // return json_encode($ClassDetail);
        
        $EnrollmentMale = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
            
            ->whereRaw('student_informations.gender = 1') 
            ->where('class_details.school_year_id', $school_year_id)
            ->where('class_details.current', '!=', 0)      
            ->select(\DB::raw("
                enrollments.id as e_id,
                enrollments.attendance,
                student_informations.id as student_information_id,
                users.username,
                CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_informations.age_june, student_informations.age_may, student_informations.c_address,
                student_informations.birthdate, student_informations.gender, student_informations.guardian
                , student_informations.father_name, student_informations.mother_name
            "))
            ->orderBY('student_name', 'ASC')
            ->get();

        $EnrollmentFemale = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
           
            ->whereRaw('student_informations.gender = 2')  
            ->where('class_details.school_year_id', $school_year_id)
            ->where('class_details.current', '!=', 0)       
            ->select(\DB::raw("
                enrollments.id as e_id,
                enrollments.attendance,
                student_informations.id  as student_information_id,
                users.username,
                CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_informations.age_june, student_informations.age_may, student_informations.c_address,
                student_informations.birthdate, student_informations.gender, student_informations.guardian
                , student_informations.father_name, student_informations.mother_name
            "))
            ->orderBY('student_name', 'ASC')
            ->get();

        return view('control_panel_faculty.demographic_profile.index', compact('EnrollmentMale','EnrollmentFemale','ClassDetail'))->render();
        
    }


    public function save(Request $request)
    {
        $stud_id = $request->stud_id;
        $data = $request->all();

        try {
           
            $Student_info = StudentInformation::whereRaw('student_informations.id = '. $stud_id)->first();
            $Student_info->birthdate = $request->birthdate ? date('Y-m-d', strtotime($request->birthdate)) : NULL;;
            $Student_info->age_june = $data['age_june'];
            $Student_info->age_may = $data['age_may'];
            $Student_info->c_address = $data['address'];
            $Student_info->guardian = $data['guardian'];
            $Student_info->save();

            return response()->json(['res_code' => 0, 'res_msg' => 'Demographic successfully saved.',]);

        }catch (\Exception $e) {
            return response()->json(['res_code' => 1, 'res_msg' => $e->getMessage()]);
        }
       
    }
}