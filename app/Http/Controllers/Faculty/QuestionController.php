<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Question;
use App\Models\Assessment;
use App\Models\AnswerOption;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use App\Models\ClassSubjectDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class QuestionController extends Controller
{
    private function subjectDetails($id)
    {
        return $ClassSubjectDetail = ClassSubjectDetail::whereId($id)->first();
    }
    
    public function index(Request $request){
        $id = Crypt::decrypt($request->class_subject_details_id);
        $Assessment = Assessment::whereId($id)->first();
        $questions = Question::whereAssessmentId($Assessment->id)->get();
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);
        
        return view('control_panel_faculty.assessment_per_subject._question', compact('ClassSubjectDetail','Assessment','questions'));
    }

    public function save(Request $request){

        $rules = [
            'question' => 'required',
        ];
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        $assessment_id = $request->id;
        
        if($assessment_id)
        {
            $question = Question::create([
                'assessment_id'     => $assessment_id,
                'question_type'     => $request->js_question_type,
                'question_title'    => $request->question,
            ]);
            
            $answer_options = [];
            $options = $request->options;
            foreach($options as $key => $data){
                array_push($answer_options, [
                    'question_id'  => $question->id,
                    'option_title' => $data,
                    'order_number' => ($key + 1),
                ]);
            }
            AnswerOption::insert($answer_options);

            $questionAnswer = QuestionAnswer::create([
                'question_id'               => $question->id,
                'correct_option_answer'     => $request->options_answer
            ]);

            return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully saved.']);
        }
        
    }
}