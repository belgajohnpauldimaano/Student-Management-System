<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Models\ClassSubjectDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AssessmentSubjectController extends Controller
{
    private function subjectDetails($id)
    {
        return $ClassSubjectDetail = ClassSubjectDetail::whereId($id)->first();
    }
    
    public function index(Request $request)
    {
        $id = Crypt::decrypt($request->class_subject_details_id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        if($request->ajax())
        {
            return view('control_panel_faculty.assessment_per_subject.partials.data_list', compact('ClassSubjectDetail'));
        }
        return view('control_panel_faculty.assessment_per_subject.index', compact('ClassSubjectDetail'));
    }

    public function modal(Request $request){

        $id = $request->class_subject_details_id;
        $ClassSubjectDetail = $this->subjectDetails($id);
        
        return view('control_panel_faculty.assessment_per_subject.partials.modal_data', compact('ClassSubjectDetail'))->render();
    }
    
    public function save(Request $request){
        
    }
}