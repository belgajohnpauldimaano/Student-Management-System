<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'lrn' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'guardian' => 'required',
            'age_june' => 'required',
            'age_may' => 'required',            
            'address'   => 'required',
            'birthdate' => 'required',
            'gender'    => 'required',
        ];
        
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }
        
        dd($request->all());
        return response()->json(['res_code' => 0, 'res_msg' => 'You have successfuly tested!']);
    }    
}
