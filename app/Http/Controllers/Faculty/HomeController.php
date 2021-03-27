<?php

namespace App\Http\Controllers\Faculty;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Traits\HasFacultyDetails;
use App\Models\ClassSubjectDetail;
use App\Models\FacultyInformation;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    use HasFacultyDetails;
    public function index(){
        
        return view('control_panel_faculty.home.index');
    }

    public function modal_data(Request $request){
        $type = $request->type;
        return view('control_panel_faculty.home.partials.modal_data', compact('type'))->render(); 
    }

    private function schoolYear(){
        return $School_year_id = SchoolYear::whereStatus(1)->whereCurrent(1)->orderBy('school_year', 'DESC')->first()->id;
    }

    private function sectionList(Request $request){
        
        $faculty_id = $this->faculty()->id;
        $School_year_id = $this->schoolYear();

        return $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('faculty_id', $faculty_id)
            ->where('class_details.school_year_id', $School_year_id)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', 1)
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
    }

    public function createAssessment(Request $request)
    {
        $faculty_id = $this->faculty()->id;
        $School_year_id = $this->schoolYear();

        $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('faculty_id', $faculty_id)
            ->where('class_details.school_year_id', $School_year_id)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', 1)
            ->select(\DB::raw('  
                class_subject_details.id,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level
            '))
            ->get();

        return response()->json([
            'section' => $ClassSubjectDetail
        ],200);
    }
}