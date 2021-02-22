<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Question;
use App\Models\Assessment;
use App\Models\Instruction;
use App\Models\AnswerOption;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use App\Models\ClassSubjectDetail;
use Illuminate\Support\Facades\DB;
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
        // $questions = Question::whereAssessmentId($Assessment->id)->get();
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);
        $instructions = Instruction::orderBY('order_number', 'Asc')->whereInstructionableId($Assessment->id)->get();
        
        return view('control_panel_faculty.assessment_per_subject._question', compact('ClassSubjectDetail','Assessment','instructions'));
    }

    public function save(Request $request){

        $rules = [
            'question'              => 'required',
            'points_per_question'   => 'required',
            // 'question_type'         => 'required',
        ];
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        $assessment_id = $request->id;
        
        if($assessment_id)
        {
            $question_type = $request->js_question_type;

            $answer_options = [];
            if($question_type == 1){
                $options = $request->options;
                $correct_answer = $request->options_answer;
            }

            if($question_type == 2){
                $options = $request->true_or_false_options;
                $correct_answer = $request->true_or_false_options_answer;
            }
            
           
            DB::beginTransaction();
            try {
                
                $question = Question::create([
                    'assessment_id'     => $assessment_id,
                    'question_type'     => $question_type,
                    'question_title'    => $request->question,
                ]);
                
                foreach($options as $key => $data){
                    array_push($answer_options, [
                        'question_id'  => $question->id,
                        'option_title' => $data,
                        'order_number' => ($key + 1),
                    ])
                    ;
                }
                AnswerOption::insert($answer_options);

                $questionAnswer = new QuestionAnswer;
                $questionAnswer->question_id            =   $question->id;
                $questionAnswer->correct_option_answer  =   $correct_answer;
                $questionAnswer->points_per_question    =   $request->points_per_question;
                $questionAnswer->save();

                DB::commit();
                return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully saved.']);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['res_code' => 1, 'res_msg' => 'Something went wrong.']);
            }
        }
        
    }
}