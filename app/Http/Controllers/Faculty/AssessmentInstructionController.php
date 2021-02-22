<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentInstructionController extends Controller
{
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

            $instruction = new Instruction;
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