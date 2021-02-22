<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Semester;
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

    private function semester(){
        return $semester = Semester::whereCurrent(1)->first()->id;
    }
    
    public function index(Request $request)
    {
        $id = Crypt::decrypt($request->class_subject_details_id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        $semester = $this->semester();
        $Assessment = Assessment::orderBY('id', 'desc')->paginate(10);
        
        if($request->ajax())
        {
            return view('control_panel_faculty.assessment_per_subject.partials.data_list', compact('ClassSubjectDetail','Assessment','semester'));
        }
        return view('control_panel_faculty.assessment_per_subject.index', compact('ClassSubjectDetail','Assessment','semester'));
    }

    public function modal(Request $request){

        $id = $request->class_subject_details_id;
        $ClassSubjectDetail = $this->subjectDetails($id);
        
        return view('control_panel_faculty.assessment_per_subject.partials.modal_data', compact('ClassSubjectDetail'))->render();
    }

    public function create(Request $request){

        $Assessment=null;
        $id = Crypt::decrypt($request->class_subject_details_id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        
        return view('control_panel_faculty.assessment_per_subject._index', compact('ClassSubjectDetail','Assessment'))->render();
    }

    public function edit(Request $request){

        $id = Crypt::decrypt($request->class_subject_details_id);
        $Assessment = Assessment::whereId($id)->first();
        // return json_encode($Assessment);
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);
        
        return view('control_panel_faculty.assessment_per_subject._index', compact('ClassSubjectDetail','Assessment'))->render();
    }
    
    public function save(Request $request){

        $rules = [
            'title'                 => 'required',
            'exam_period'           => 'required',
            'publish_date_time'     => 'required',
            'exp_date_time'         => 'required',
            'quarter_period'        => 'required',
            // 'instructions'          => 'required',
            'time_limit'            => 'required',
            'total_item'            => 'required',
        ];
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        $semester = $this->semester();
        // return json_encode($semester);
        $ClassSubjectDetail = $request->class_subject_details_id;

        try {
            //code...
            
            if ($request->id)
            {
                $Assessment = Assessment::whereId($request->id)->first();
                $Assessment->title                  = $request->title;
                // $Assessment->instructions           =  $request->instructions;
                $Assessment->period                 =  $request->exam_period;
                $Assessment->date_time_publish      =  $request->publish_date_time;
                $Assessment->date_time_expiration   =  $request->exp_date_time;
                $Assessment->semester               =  $request->semester_period ? $request->semester_period : $semester;
                $Assessment->quarter                =  $request->quarter_period;
                $Assessment->randomly_ordered       =  $request->randomly_ordered;
                $Assessment->time_limit             =  $request->time_limit;
                $Assessment->total_items            =  $request->total_item;
                $Assessment->student_view_result    =  $request->view_results;
                $Assessment->attempt_limit          =  $request->attempts;
                $Assessment->save();
                return response()->json(['res_code' => 0, 'res_msg' => 'Assessment successfully updated.']);
                
            }else{

                $Assessment = Assessment::create([
                    'class_subject_details_id'  =>  $ClassSubjectDetail,
                    'title'                     =>  $request->title,
                    // 'instructions'              =>  $request->instructions,
                    'period'                    =>  $request->exam_period,
                    'date_time_publish'         =>  $request->publish_date_time,
                    'date_time_expiration'      =>  $request->exp_date_time,
                    'semester'                  =>  $request->semester_period ? $request->semester_period : $semester,
                    'quarter'                   =>  $request->quarter_period,
                    'randomly_ordered'          =>  $request->randomly_ordered,
                    'time_limit'                =>  $request->time_limit,
                    'total_items'               =>  $request->total_item,
                    'student_view_result'       =>  $request->view_results,
                    'attempt_limit'             =>  $request->attempts,
                ]);
                
                return response()->json([
                    'res_code'  => 0,
                    'res_msg'   => 'Assessment successfully saved.',
                    'data'      => encrypt($Assessment->id)
                ],200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                    'res_code'  => 1,
                    'res_msg'   => 'Something went wrong.',
            ]);
        }

    }
}