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

    public function list_quarter (Request $request)
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();  
        $class_details_elements = '<option value="">Select Class Quarter</option>';       
        $class_details_elements .= '<option value="1st">First Quarter</option>';
        $class_details_elements .= '<option value="2nd">Second Quarter</option>';
        $class_details_elements .= '<option value="3rd">Third Quarter</option>';
        $class_details_elements .= '<option value="4th">Fourth Quarter</option>';
        $class_details_elements .= '<option value="">-------------------------------AVERAGE--------------------------------</option>';
        $class_details_elements .= '<option value="1st-2nd">First - Second Quarter Average</option>';
        $class_details_elements .= '<option value="1st-3rd">First - Second - Third Quarter Average</option>';
        $class_details_elements .= '<option value="1st-4th">First - Second - Third - Fourth Quarter Average</option>';       
        return $class_details_elements;
    }

    public function list_quarter_sem (Request $request)
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first(); 
        
        if($request->semester_grades == "3rd")
        {
            
            $class_details_elements = '<option value="1st-2nd">Sem-1 and 2 Average</option>';
        }
        else
        {
            $class_details_elements = '<option value="">Select Class Quarter</option>';
            $class_details_elements .= '<option value="1st">First Quarter</option>';
            $class_details_elements .= '<option value="2nd">Second Quarter</option>';
        }
           
        return $class_details_elements;
    }

    public function firstquarter (Request $request) 
    {
        
        $FacultyInformation = FacultyInformation::where('user_id', Auth::user()->id)->first();   
        
        $class_detail = ClassSubjectDetail::with(['section','classDetail'])
            ->first();        

        $AdvisorySubject = ClassSubjectDetail::with(['subject','classDetail','faculty'])
            ->where('class_details_id', $class_detail->class_details_id)
            ->where('status', 1)
            ->orderBY('class_subject_order', 'ASC')
            ->get();

        
        $Grade_sheet_males = Enrollment::join('class_details','class_details.id','=','enrollments.class_details_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')  
            ->where('class_details.section_id', $class_detail->grade->section->id)
            ->where('class_details.school_year_id', \Crypt::decrypt($request->search_sy))
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    student_informations.last_name, 
                    student_informations.first_name, 
                    student_informations.middle_name
                    ,enrollments.id
            ")
            ->orderBY('last_name','ASC')
            ->get();

        $Grade_sheet_females = Enrollment::join('class_details','class_details.id','=','enrollments.class_details_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')  
            ->where('class_details.section_id', $class_detail->grade->section->id)
            ->where('class_details.school_year_id', \Crypt::decrypt($request->search_sy))
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
            compact( 'subject_grades','class_detail','AdvisorySubject','Grade_sheet_males','Grade_sheet_females'))
            ->render();
    }
}