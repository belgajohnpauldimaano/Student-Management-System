<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Assessment;
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

    public function create(Request $request){

        $id = Crypt::decrypt($request->class_subject_details_id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        
        return view('control_panel_faculty.assessment_per_subject.create_assessment', compact('ClassSubjectDetail'))->render();
    }
    
    public function save(Request $request){

        $rules = [
            'title'             => 'required',
            'exam_period'       => 'required',
            'publish_date_time' => 'required',
            'exp_date_time'     => 'required',
            'quarter_period'    => 'required',
            'instructions'      => 'required',
            'time_limit'        => 'required',
            'total_item'        => 'required'
        ];
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        $ClassSubjectDetail = $request->id;

        $Assessment = Assessment::create([
            'class_subject_details_id'  =>  $ClassSubjectDetail,
            'title'                     =>  $request->title,
            'instructions'              =>  $request->instructions,
            'period'                    =>  $request->exam_period,
            'date_time_publish'         =>  $request->publish_date_time,
            'date_time_expiration'      =>  $request->exp_date_time,
            'semester'                  =>  $request->semester_period,
            'quarter'                   =>  $request->quarter_period,
            'randomly_ordered'          =>  $request->randomly_ordered,
            'time_limit'                =>  $request->time_limit,
            'total_items'               =>  $request->total_item,
            'student_view_result'       =>  $request->view_results,
            'student_no_attempts'       =>  $request->attempts,
        ]);
        
        return response()->json(['res_code' => 0, 'res_msg' => 'Assessment successfully saved.']);
        
        return redirect()->route('control_panel_faculty.assessment_per_subject.index');

    }
}