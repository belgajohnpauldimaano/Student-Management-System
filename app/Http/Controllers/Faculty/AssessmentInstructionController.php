<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Assessment;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Models\ClassSubjectDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AssessmentInstructionController extends Controller
{
    
    public function edit(Request $request)
    {
        $tab = $request->tab;
        $id= Crypt::decrypt($request->class_subject_details_id);
        $instruction = Instruction::find($id);
        $Assessment = Assessment::whereId($instruction->instructionable_id)->first();
        $ClassSubjectDetail = ClassSubjectDetail::whereId($Assessment->class_subject_details_id)->first();
        // return json_encode($Assessment);
        return view('control_panel_faculty.assessment_per_subject._index', compact('Assessment','ClassSubjectDetail','instruction','tab'))->render();
    }
    
    public function saveInstruction(Request $request){
        $rules = [
            'instruction'           => 'required',
            'instructions_type'     => 'required',
            'part_number'           => 'required',
        ];
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        // try {

            if($request->instruction_id){
                $instruction = Instruction::whereId($request->id)->first();
            }
            else{
                $instruction = new Instruction();
            }
            $instruction->question_type         =   $request->instructions_type;
            $instruction->instructions          =   $request->instruction;
            $instruction->order_number          =   $request->part_number;
            $instruction->instructionable_id    =   $request->assessment_id;
            $instruction->instructionable_type  =   'App\Models\Assessment';
            $instruction->type                  =   'Assessment';
            $instruction->save();

        // } catch (\Throwable $th) {
        //     return response()->json([
        //             'res_code'  => 1,
        //             'res_msg'   => 'Something went wrong.',
        //     ]);
        // }

    }
}