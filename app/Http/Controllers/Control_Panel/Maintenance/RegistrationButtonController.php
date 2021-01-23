<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use Illuminate\Http\Request;
use App\Models\RegistrationButton;
use App\Http\Controllers\Controller;

class RegistrationButtonController extends Controller
{
    public function index (Request $request) 
    {
        if ($request->ajax())
        {
            $Registration = RegistrationButton::whereId(1)->first();
            return view('control_panel.registration_button.partials.data_list', compact('Registration'))->render();
        }
        
        $Registration = RegistrationButton::whereId(1)->first();
        return view('control_panel.registration_button.index', compact('Registration'));
    }

    public function update(Request $request)
    {
        $Registration = RegistrationButton::whereId(1)->first();

        // return $request->registration_button;
        $result;
        if($request->registration_button == 'enable'){
            $Registration->is_enabled = 1;
            $result='enabled!';
        }else{
            $Registration->is_enabled = 0;
            $result='disabled!';
        }
        $Registration->save();

        
        return response()->json(['res_code' => 0, 'res_msg' => 'Registration button is currently '.$result]);
    }
}