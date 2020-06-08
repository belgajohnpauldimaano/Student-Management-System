<?php

namespace App\Http\Controllers;

use App\User;
use App\SchoolYear;
use App\IncomingStudent;
use App\StudentInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'lrn' => 'required',
            'reg_type' => 'required',
            'grade_lvl' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'guardian' => 'required',
            'address'   => 'required',
            'p_address' => 'required',
            'birthdate' => 'required',
            'gender'    => 'required',
            'email' => 'required',
            'phone' => 'required',
            'mother_name' => 'required',
            'father_name' => 'required',
            'student_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        try{

            $SchoolYear = SchoolYear::where('current', 1)
                ->where('status', 1)
                ->orderBY('id', 'DESC')
                ->first();

            $User = User::find($request->lrn);
            $User = \App\User::where('username', $request->lrn)->first();
            if ($User) 
            {
                return response()->json(['res_code' => 1,'res_msg' => 'LRN already used. Please contact the administrator to confirm it. Thank you']);
            }           

            $User = new User();
            $User->username = $request->lrn;
            $User->password = bcrypt($request->first_name . '.' . $request->last_name);
            $User->role     = 5;
            $User->status = 0;
            $User->save();

            $StudentInformation                 = new StudentInformation();
            $StudentInformation->first_name     = $request->first_name;
            $StudentInformation->middle_name    = $request->middle_name;
            $StudentInformation->last_name      = $request->last_name;
            $StudentInformation->c_address      = $request->address;
            $StudentInformation->p_address      = $request->p_address;
            $StudentInformation->birthdate      = date('Y-m-d', strtotime($request->birthdate));
            $StudentInformation->gender         = $request->gender;
            $StudentInformation->guardian       = $request->guardian;
            $StudentInformation->mother_name    = $request->mother_name;
            $StudentInformation->father_name    = $request->father_name;            
            $StudentInformation->user_id        = $User->id;
            $StudentInformation->email          = $request->email;
            $StudentInformation->contact_number = $request->phone;
            $imageName = time().'.'.$request->student_img->getClientOriginalExtension();
            $request->student_img->move(public_path('img/account/photo/'), $imageName);
            $StudentInformation->photo = $imageName;   
            // $StudentInformation->status = 0;    
            $StudentInformation->save();

            $Incoming_student = new IncomingStudent();
            $Incoming_student->student_id = $StudentInformation->id;
            $Incoming_student->school_year_id = $SchoolYear->id;
            $Incoming_student->grade_level_id = $request->grade_lvl;
            $Incoming_student->student_type = $request->reg_type;
            $Incoming_student->save();

            // dd($request->all());
            return response()->json(['res_code' => 0, 'res_msg' => 'You have successfuly tested!']);
        }
        catch(\Exception $e){
            // do task when error
               // insert query
            return response()->json(['res_code' => 1, 'res_msg' => $e->getMessage()]);
        }
    }    
}
