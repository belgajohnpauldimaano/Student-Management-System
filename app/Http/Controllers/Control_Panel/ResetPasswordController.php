<?php

namespace App\Http\Controllers\Control_Panel;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FacultyInformation;
use App\Models\FinanceInformation;
use App\Models\StudentInformation;
use App\Http\Controllers\Controller;
use App\Models\AdmissionInformation;
use App\Models\RegistrarInformation;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $user_id = $request->id;
        $type = $request->type;

        if($user_id && $type)
        {
            if($type == 'student')
            {
                $user_id = StudentInformation::whereId($user_id)->first()->user_id;
            }

            if($type == 'finance')
            {
                $user_id = FinanceInformation::whereId($user_id)->first()->user_id;
            }

            if($type == 'faculty')
            {
                $user_id = FacultyInformation::whereId($user_id)->first()->user_id;
            }

            if($type == 'admission')
            {
                $user_id = AdmissionInformation::whereId($user_id)->first()->user_id;
            }

            if($type == 'registrar')
            {
                $user_id = RegistrarInformation::whereId($user_id)->first()->user_id;
            }

            try {
                $password = User::whereId($user_id)->first();
                $password->password = bcrypt('123456');
                $password->save();
                return response()->json(['res_code' => 0, 'res_msg' => 'Password successfully reset.']);
                
            } catch (\Throwable $th) {
                return response()->json(['res_code' => 1,'res_msg' => 'Sorry, Password unsuccessfully reset.']);
            }
            
        }
        // return  json_encode($type);
    }
}