<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Traits\HasGradeSheet;
use Illuminate\Support\Facades;
use App\Models\Grade_sheet_first;
use App\Traits\HasFacultyDetails;
use App\Models\ClassSubjectDetail;
use App\Models\FacultyInformation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\StudentEnrolledSubject;

class StudentGradeSheetController extends Controller
{
    use HasFacultyDetails;

    public function index (Request $request)
    {
        $FacultyInformation = $this->faculty();
        
        $SchoolYear  = SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'ASC')->orderBy('school_year', 'DESC')->get();
        $class_id = Crypt::decrypt($request->c);        
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
        $FacultyInformation = $this->faculty(); 
        
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
        $sy_id = Crypt::decrypt($request->search_sy != '' ? $request->search_sy : $request->search_school_year);
        $FacultyInformation = $this->faculty(); 
        $sem = $request->semester_grades;

        $class_detail = ClassDetail::with('section', 'classSubjectDetail')
            ->whereAdviserId($FacultyInformation->id)->whereStatus(1)
            ->whereSchoolYearId($sy_id)->first();
        // return json_encode($class_detail);
        
        $query = ClassSubjectDetail::query();

        if($sem == '1st' || $sem == '2nd')
        {
            if($sem == '1st')
            {
                $query->whereSem(1);   
            }

            if($sem == '2nd')
            {
                $query->whereSem(2);   
            }
                  
        }

        if($sem == '3rd')
        {
            $query->orderBy('sem', 'ASC')
                ->orderBy('class_subject_order', 'ASC');
        }

        $AdvisorySubject = $this->advisorySubject($query, $class_detail->id);
            // return json_encode($AdvisorySubject);

        $no_second_sem = '';
        if($AdvisorySubject->isEmpty())
        {
            $no_second_sem = 'No data found';
            // return json_encode($no_second_sem);
        }
        
        $Grade_sheet_males = $this->enrollment($class_detail->section->id, $sy_id)
            ->whereRaw('student_informations.gender = 1')
            ->get();

        // return json_encode($Grade_sheet_males);

        $Grade_sheet_females = $this->enrollment($class_detail->section->id, $sy_id)
            ->whereRaw('student_informations.gender = 2')
            ->get();

        $subject_grades = StudentEnrolledSubject::first();
        
        return view('control_panel_faculty.gradesheet.partials.data_list', 
            compact( 'subject_grades','AdvisorySubject','class_detail','Grade_sheet_males','Grade_sheet_females','quarter','sem','no_second_sem'))
            ->render();
    }

    public function print(Request $request)
    {
        // return json_encode($request->all());
        $sy_id = $request->sy;
        $class_id = $request->id;
        $adviser_id = $request->ad_id;
        $quarter = $request->quarter;
        $sem = $request->sem ? $request->sem : '';
        $category = $request->level;

        if($sy_id && $class_id && $adviser_id && $quarter)
        {
             $class_detail = ClassDetail::with('section', 'classSubjectDetail')->whereAdviserId($adviser_id)->whereStatus(1)
            ->whereSchoolYearId($sy_id)->first();
            // return json_encode($class_detail);
            // return json_encode($sem);
            
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

            $AdvisorySubject = $this->advisorySubject($query, $class_id);
            
            // return json_encode($AdvisorySubject);

            $no_second_sem = '';
            if($AdvisorySubject->isEmpty())
            {
                $no_second_sem = 'No data found';
                // return json_encode($no_second_sem);
            }

            $Grade_sheet_males = $this->enrollment($class_detail->section->id, $sy_id)->whereRaw('student_informations.gender = 1')
                ->get();
            // return json_encode($Grade_sheet_males);

            $Grade_sheet_females = $this->enrollment($class_detail->section->id, $sy_id)->whereRaw('student_informations.gender = 2')
                ->get();

            $subject_grades = StudentEnrolledSubject::first();
        
            return view('control_panel_faculty.gradesheet.print_data.print', 
                compact('subject_grades','AdvisorySubject','class_detail','Grade_sheet_males','Grade_sheet_females','quarter','no_second_sem','category','sem'))
                ->render();

            $pdf = \PDF::loadView('control_panel_faculty.gradesheet.print_data.print', 
                compact('subject_grades','AdvisorySubject','class_detail','Grade_sheet_males','Grade_sheet_females','quarter','category','no_second_sem','sem'));
            $pdf->setPaper('Legal', 'portrait');
                return $pdf->stream();
        }
    }

    private function advisorySubject($query, $class_detail_id)
    {
        return $query->with([
            'subject:id,subject_code,subject',
            'classDetail:id,school_year_id,grade_level,adviser_id',
            'faculty:id,first_name,middle_name,last_name'
            ])
            ->select('id','class_details_id','faculty_id','subject_id','sem')
            ->whereClassDetailsId($class_detail_id)
            ->whereStatus(1)
            ->orderBy('class_subject_order', 'ASC')
            ->get();
    }

    private function enrollment($id, $sy_id){
        return Enrollment::join('class_details','class_details.id','=','enrollments.class_details_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')  
            ->where('class_details.section_id', $id)
            ->where('class_details.school_year_id', $sy_id)
            ->where('enrollments.status', 1)
            ->selectRaw("                    
                    student_informations.last_name, 
                    student_informations.first_name, 
                    student_informations.middle_name
                    ,enrollments.id
            ")
            ->orderBY('last_name','ASC');
    }
}