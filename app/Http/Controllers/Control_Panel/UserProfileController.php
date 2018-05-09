<?php

namespace App\Http\Controllers\Control_Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function view_my_profile (Request $request)
    {
        $User = \Auth::user();
        $Profile = \App\FacultyInformation::where('user_id', $User->id)->first();
        $FacultyInformation = collect(\App\FacultyInformation::DEPARTMENTS);
        return view('control_panel.user_profile.index', compact('User', 'Profile', 'FacultyInformation'));
    }
    public function change_my_password_modal (Request $request)
    {

    }
    public function change_my_password (Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails())
        {   
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $validator->getMessageBag()]);
        }
        // return json_encode(['aa' => \Auth::user()->password]);
        if (\Hash::check($request->old_password, \Auth::user()->password))
        {
            \Auth::user()->password = bcrypt($request->password);
            \Auth::user()->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Password successfully changed.']);
        }
        else 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Incorrect old password.']);
        }
    }
}
