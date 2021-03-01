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
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);
        $instructions = Instruction::orderBY('order_number', 'Asc')
            ->whereInstructionableId($Assessment->id)->where('status', 1)->get();
        
        return view('control_panel_faculty.assessment_per_subject._question', 
            compact('ClassSubjectDetail','Assessment','instructions'));
    }

    public function archiveIndex(Request $request){
        $id = Crypt::decrypt($request->class_subject_details_id);
        $Assessment = Assessment::whereId($id)->first();
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);
        
        $Question = Question::orderBY('id', 'ASC')
            ->whereAssessmentId($Assessment->id)->where('status', 2)->get();

        // return json_encode($Assessment->id);
        return  view('control_panel_faculty.assessment_per_subject._archive',
            compact('Question','Assessment','ClassSubjectDetail'));
    }

    public function edit(Request $request){
        $id = Crypt::decrypt($request->class_subject_details_id);
        $Question = Question::whereId($id)->first();
        $Assessment = Assessment::whereId($Question->assessment_id)->first();
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);
        
        return  view('control_panel_faculty.assessment_per_subject._edit_question',
            compact('Question','Assessment','ClassSubjectDetail'));
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

        $assessment_id = $request->id ? $request->id : $request->assessment_id;
        
        if($assessment_id)
        {
            $question_id = $request->question_id;
            $question_type = $request->js_question_type;

            $answer_options = [];
            if($question_type == 1){
                $options = $request->options;
                $correct_answer = $request->options_answer;
            }

            if($question_type == 2){
                $options = $request->true_or_false_options ? $request->true_or_false_options : $request->options;
                $correct_answer = $request->true_or_false_options_answer ? $request->true_or_false_options_answer : $request->options_answer;
            }
            
            DB::beginTransaction();
            try {

                if($question_id)
                {
                    $question = Question::find($question_id);
                    $question->question_type  = $question_type;
                    $question->question_title = $request->question;
                    $question->save();

                    foreach($request->options as $key => $data){
                        $Teacher_exists = AnswerOption::whereQuestionId($question_id)->whereOrderNumber($key+1)->update([
                            'option_title'    => $data,
                        ]);
                        
                    }

                    foreach($request->options_answer as $data){
                        if($data)
                        {
                            $questionAnswer = QuestionAnswer::find($request->answer_option_id);
                            $questionAnswer->correct_option_answer  =   $data;
                            $questionAnswer->points_per_question    =   $request->points_per_question;
                            $questionAnswer->save();
                        }
                    }

                    DB::commit();
                    return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully saved.']);
                }
                else
                {
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
                        ]);
                    }
                    AnswerOption::insert($answer_options);

                    $questionAnswer = new QuestionAnswer;
                    $questionAnswer->question_id            =   $question->id;
                    $questionAnswer->correct_option_answer  =   $correct_answer;
                    $questionAnswer->points_per_question    =   $request->points_per_question;
                    $questionAnswer->save();
                }

                DB::commit();
                return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully saved.']);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['res_code' => 1, 'res_msg' => 'Something went wrong.'], 402);
            }
        }
        
    }

    public function archive(Request $request)
    {
        try {
            $question = Question::find($request->id);
            $question->status = 2;
            $question->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully moved to archive.', 'data' => $question ]);
        } catch (\Throwable $th) {
            return response()->json(['res_code' => 1, 'res_msg' => 'This action something went wrong.' ], 402);
        }
        
    }

    public function softDelete(Request $request)
    {
        try {
            $question = Question::find($request->id);
            $question->status = 0;
            $question->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully deleted.', 'data' => $question ]);
        } catch (\Throwable $th) {
            return response()->json(['res_code' => 1, 'res_msg' => 'This action something went wrong.' ], 402);
        }
        
    }

    public function active(Request $request)
    {
        try {
            $question = Question::find($request->id);
            $question->status = 1;
            $question->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully activated.', 'data' => $question ]);
        } catch (\Throwable $th) {
            return response()->json(['res_code' => 1, 'res_msg' => 'This action something went wrong.' ], 402);
        }
        
    }

    
}