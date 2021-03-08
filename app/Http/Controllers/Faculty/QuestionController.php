<?php

namespace App\Http\Controllers\Faculty;

use Carbon\Carbon;
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

        if($request->js_question_type != 5){
            $rules = [
                'question'              => 'required',
                'points_per_question'   => 'required',
            ];
            
            $Validator = \Validator($request->all(), $rules);

            if ($Validator->fails())
            {
                return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
            }
        }

        $assessment_id = $request->id ? $request->id : $request->assessment_id;
        
        if($assessment_id)
        {
            $question_id = $request->question_id;
            $question_type = $request->js_question_type;

            $answer_options = [];
            if($question_type == 1){
                $options = $request->options;
                $correct_answer = $request->multiple_answer;
                
                if(!$question_id)
                {
                    $rules = [
                        'question'              => 'required',
                        'points_per_question'   => 'required',
                        'multiple_answer'         => 'required',
                    ];
                    
                    $Validator = \Validator($request->all(), $rules);

                    if ($Validator->fails())
                    {
                        return response()->json([
                            'res_code' => 1, 
                            'res_msg' => 'Please fill all required fields.', 
                            'res_error_msg' => $Validator->getMessageBag()
                        ]);
                    }
                }
                
            }

            // return json_encode($options);

            if($question_type == 2){
                $options = $request->true_or_false_options ? $request->true_or_false_options : $request->options;
                $correct_answer = $request->true_or_false_options_answer ? $request->true_or_false_options_answer : $request->options_answer;
            }

            $answer_for_matching = [];
            if($question_type == 3){
                $options = $request->matching_options ? $request->matching_options : $request->options;
                $correct_answer = $request->matching_answer ? $request->matching_answer : $request->options_answer;
            }

            if($question_type == 4){
                $options = $request->ordering_option ? $request->ordering_option : $request->options;
                $correct_answer = $request->ordering_option ? $request->ordering_option : $request->options;
            }

            if($question_type == 5){
                $rules = [
                    'question_identification' => 'required',
                    'identification_answer'   => 'required',
                    'points_per_question'     => 'required',
                ];
                
                $Validator = \Validator($request->all(), $rules);

                if ($Validator->fails())
                {
                    return response()->json([
                        'res_code' => 1, 
                        'res_msg' => 'Please fill all required fields.', 
                        'res_error_msg' => $Validator->getMessageBag()
                    ]);
                }


                $questions = $request->question_identification ? $request->question_identification : $request->options;
                $correct_answer = $request->identification_answer ? $request->identification_answer : $request->options;
                $points_per_question = $request->points_per_question;
            }
            
            DB::beginTransaction();
            // try {

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

                    // echo 'this';

                    if($question_type == 3 || $question_type == 4)
                    {
                        foreach($correct_answer as $key => $data){
                            if($data)
                            {
                                $questionAnswer = QuestionAnswer::whereQuestionId($question_id)->whereOrderNumber($key+1)->first();
                                $questionAnswer->correct_option_answer  =   $data;
                                $questionAnswer->points_per_question    =   $request->points_per_question;
                                if($question_type == 4)
                                {
                                    $questionAnswer->order_number    =   ($key+1);
                                }
                                $questionAnswer->save();
                            }
                        }
                    }
                    else
                    {
                        foreach($request->options_answer as $data){
                            if($data)
                            {
                                $questionAnswer = QuestionAnswer::find($request->answer_option_id);
                                $questionAnswer->correct_option_answer  =   $data;
                                $questionAnswer->points_per_question    =   $request->points_per_question;
                                $questionAnswer->save();
                            }
                        }
                    }
                    
                    DB::commit();
                    return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully saved.']);
                }
                else
                {
                    if($question_type == 5)
                    {
                        foreach($questions as $key => $q){
                            $question = Question::create([
                                'assessment_id'     => $assessment_id,
                                'question_type'     => $question_type,
                                'question_title'    => $q,
                            ]);
                        }

                        $question = Question::find($question->id - 1);
                        
                        $questionAnswerArray = [];
                        foreach ($correct_answer as $key => $value) {
                            $questionAnswerArray[$key]['question_id'] = ($question->id + $key);
                            $questionAnswerArray[$key]['correct_option_answer'] = $value;
                            $questionAnswerArray[$key]['points_per_question'] = $points_per_question[$key];
                            $questionAnswerArray[$key]['order_number'] = 1;
                            $questionAnswerArray[$key]['created_at'] = Carbon::now();
                            $questionAnswerArray[$key]['updated_at'] = Carbon::now();
                        }
                        QuestionAnswer::insert($questionAnswerArray);

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

                        if($question_type == 3 || $question_type == 4)
                        {
                            foreach($correct_answer as $key => $data){
                                array_push($answer_for_matching, [
                                    'question_id'           => $question->id,
                                    'correct_option_answer' => $data,
                                    'order_number'          => ($key + 1),
                                    'points_per_question'   => $request->points_per_question
                                ]);
                            }
                            QuestionAnswer::insert($answer_for_matching);
                        }
                        else
                        {
                            $questionAnswer = new QuestionAnswer;
                            $questionAnswer->question_id            =   $question->id;
                            $questionAnswer->correct_option_answer  =   $correct_answer;
                            $questionAnswer->points_per_question    =   $request->points_per_question;
                            $questionAnswer->save();
                        }
                    }
                    
                }

                DB::commit();
                return response()->json(['res_code' => 0, 'res_msg' => 'Question successfully saved.']);
            // } catch (\Throwable $th) {
            //     DB::rollBack();
            //     return response()->json(['res_code' => 1, 'res_msg' => 'Something went wrong.']);
            // }
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