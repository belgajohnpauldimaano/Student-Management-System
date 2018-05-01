<?php

namespace App\Http\Controllers\Control_Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index (Request $request) 
    {
        if ($request->ajax())
        {
            $StudentInformation = \App\StudentInformation::with(['user'])->where('status', 1)
            ->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%'.$request->search.'%');
                $query->orWhere('middle_name', 'like', '%'.$request->search.'%');
                $query->orWhere('last_name', 'like', '%'.$request->search.'%');
            })
            // ->orWhere('first_name', 'like', '%'.$request->search.'%')
            ->paginate(10);
            return view('control_panel.student_information.partials.data_list', compact('StudentInformation'))->render();
        }
        $StudentInformation = \App\StudentInformation::with(['user'])->where('status', 1)->paginate(10);
        return view('control_panel.student_information.index', compact('StudentInformation'));
    }
    public function modal_data (Request $request) 
    {
        $StudentInformation = NULL;
        if ($request->id)
        {
            $StudentInformation = \App\StudentInformation::with(['user'])->where('id', $request->id)->first();
        }
        echo json_encode($StudentInformation);
        return view('control_panel.student_information.partials.modal_data', compact('StudentInformation'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'email' => 'required|unique:users,username',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'address'   => 'required',
            'birthdate' => 'required',
            'gender'    => 'required',
        ];
        
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        if ($request->id)
        {
            $StudentInformation                 = \App\StudentInformation::where('id', $request->id)->first();
            $StudentInformation->first_name     = $request->first_name;
            $StudentInformation->middle_name    = $request->middle_name;
            $StudentInformation->last_name      = $request->last_name;
            $StudentInformation->address        = $request->address;
            $StudentInformation->birthdate      = date('Y-m-d', strtotime($request->birthdate));
            $StudentInformation->gender         = $request->gender;
            $StudentInformation->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $User = new \App\User();
        $User->username = $request->username;
        $User->password = bcrypt($request->first_name . '.' . $request->last_name);
        $User->role     = 5;
        $User->save();

        $StudentInformation                 = new \App\StudentInformation();
        $StudentInformation->first_name     = $request->first_name;
        $StudentInformation->middle_name    = $request->middle_name;
        $StudentInformation->last_name      = $request->last_name;
        $StudentInformation->address        = $request->address;
        $StudentInformation->birthdate      = date('Y-m-d', strtotime($request->birthdate));
        $StudentInformation->gender         = $request->gender;
        $StudentInformation->user_id        = $User->id;
        $StudentInformation->save();
        
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }
    public function deactivate_data (Request $request) 
    {
        $StudentInformation = \App\StudentInformation::where('id', $request->id)->first();

        if ($StudentInformation)
        {
            $StudentInformation->status = 0;
            $StudentInformation->save();

            $User = \App\User::where('id', $StudentInformation->user_id)->first();
            if ($User)
            {
                $User->status = 0;
                $User->save();
            }
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}
