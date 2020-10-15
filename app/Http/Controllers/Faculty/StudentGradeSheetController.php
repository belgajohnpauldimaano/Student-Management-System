<?php

namespace App\Http\Controllers\Faculty;

use App\Enrollment;
use App\SchoolYear;
use App\ClassDetail;
use App\Grade_sheet_first;
use App\ClassSubjectDetail;
use App\FacultyInformation;
use Illuminate\Http\Request;
use App\Traits\HasGradeSheet;
use App\StudentEnrolledSubject;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class StudentGradeSheetController extends Controller
{
    public function index (Request $request)
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();
        
        $SchoolYear  = SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'ASC')->orderBy('school_year', 'ASC')->get();
        $class_id = \Crypt::decrypt($request->c);        
        $GradeLevel = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')            
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')            
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.id', $class_id)           
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();            

        return view('control_panel_faculty.gradesheet.index', compact('SchoolYear','GradeLevel'));
            
    }

   public function listQuarterSem (Request $request)
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first(); 
        
        if($request->semester_grades == "3rd")
        {
            
            $class_details_elements = '<option value="1st-2nd">Sem-1 and 2 Average</option>';
        }

        if($request->semester_grades == "1st")
        {
            $class_details_elements = '<option value="">Select Class Quarter</option>';
            $class_details_elements .= '<option value="1st">First Quarter</option>';
            $class_details_elements .= '<option value="2nd">Second Quarter</option>';
        }

        if($request->semester_grades == "2nd")
        {
            $class_details_elements = '<option value="">Select Class Quarter</option>';
            $class_details_elements .= '<option value="3rd">First Quarter</option>';
            $class_details_elements .= '<option value="4th">Second Quarter</option>';
        }

        return $class_details_elements;
    }    


    public function gradeSheet(Request $request)
    {
        $quarter = $request->quarter_grades != '' ? $request->quarter_grades : $request->quarter;
        $sy_id = Crypt::decrypt($request->search_sy != ''? $request->search_sy : $request->search_school_year);
        $FacultyInformation = FacultyInformation::where('user_id', Auth::user()->id)->first(); 
        $sem = $request->semester_grades;

        $class_detail = ClassDetail::with('section', 'classSubjectDetail')->whereAdviserId($FacultyInformation->id)->whereStatus(1)
            ->whereSchoolYearId($sy_id)->first();

        $query = ClassSubjectDetail::query();
        if($sem == '1st' || $sem == '2nd')
        {
            $query->whereSem($sem);         
        }

        if($sem == '3rd')
        {
            $query->orderBy('sem', 'ASC')
                ->orderBy('class_subject_order', 'ASC');
        }

        $AdvisorySubject = $query->with(['subject','classDetail','faculty'])
            ->whereClassDetailsId($class_detail->id)
            ->whereStatus(1)
            ->orderBy('class_subject_order', 'ASC')
            ->get();
        // return json_encode($AdvisorySubject);
        
        $Grade_sheet_males = Enrollment::join('class_details','class_details.id','=','enrollments.class_details_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')  
            ->where('class_details.section_id', $class_detail->section->id)
            ->where('class_details.school_year_id', $sy_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    student_informations.last_name, 
                    student_informations.first_name, 
                    student_informations.middle_name
                    ,enrollments.id
            ")
            ->orderBY('last_name','ASC')
            ->get();

        // return json_encode($Grade_sheet_males);

        $Grade_sheet_females = Enrollment::join('class_details','class_details.id','=','enrollments.class_details_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')  
            ->where('class_details.section_id', $class_detail->section->id)
            ->where('class_details.school_year_id', $sy_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    student_informations.last_name, 
                    student_informations.first_name, 
                    student_informations.middle_name
                    ,enrollments.id
            ")
            ->orderBY('last_name','ASC')
            ->get();
        
        $subject_grades = StudentEnrolledSubject::first();        
        
        return view('control_panel_faculty.gradesheet.partials.data_list', 
            compact( 'subject_grades','class_detail','AdvisorySubject','Grade_sheet_males','Grade_sheet_females','quarter','sem'))
            ->render();
    }
}