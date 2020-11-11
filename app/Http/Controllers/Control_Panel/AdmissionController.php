<?php

namespace App\Http\Controllers\Control_Panel;

use App\User;
use App\Traits\HasUser;
use Illuminate\Http\Request;
use App\AdmissionInformation;
use App\Http\Controllers\Controller;

class AdmissionController extends Controller
{
    use HasUser;

    public function index (Request $request) 
    {
        $isAdmin = $this->isAdmin();
        if ($request->ajax())
        {
            $AdmissionInformation = AdmissionInformation::with(['user'])->where('status', 1)
            ->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%'.$request->search.'%');
                $query->orWhere('middle_name', 'like', '%'.$request->search.'%');
                $query->orWhere('last_name', 'like', '%'.$request->search.'%');
            })
            ->paginate(10);
            return view('control_panel.admission_information.partials.data_list', compact('AdmissionInformation','isAdmin'))->render();
        }
        $AdmissionInformation = AdmissionInformation::with(['user'])->where('status', 1)->paginate(10);
        return view('control_panel.admission_information.index', compact('AdmissionInformation','isAdmin'));
    }

    public function modal_data (Request $request) 
    {
        $AdmissionInformation = NULL;
        if ($request->id)
        {
            $AdmissionInformation = AdmissionInformation::with(['user'])->where('id', $request->id)->first();
        }
        return view('control_panel.admission_information.partials.modal_data', compact('AdmissionInformation'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'username' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
        ];        
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }
        
        if ($request->id)
        {
            $AdmissionInformation = AdmissionInformation::where('id', $request->id)->first();
            $User = User::where('username', $request->username)->where('id', '!=', $AdmissionInformation->user_id)->first();
            if ($User) 
            {
                return response()->json(['res_code' => 1,'res_msg' => 'Username already used.']);
            }
            $AdmissionInformation->first_name = $request->first_name;
            $AdmissionInformation->middle_name = $request->middle_name;
            $AdmissionInformation->last_name = $request->last_name;
            $AdmissionInformation->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $User = new User();
        $User->username = $request->username;
        $User->password = bcrypt($request->first_name . '.' . $request->last_name);
        $User->role     = 7;
        $User->save();

        $AdmissionInformation = new AdmissionInformation();
        $AdmissionInformation->first_name = $request->first_name;
        $AdmissionInformation->middle_name = $request->middle_name;
        $AdmissionInformation->last_name = $request->last_name;
        $AdmissionInformation->user_id = $User->id;
        $AdmissionInformation->save();
        
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function deactivate_data (Request $request) 
    {
        $AdmissionInformation = AdmissionInformation::where('id', $request->id)->first();

        if ($AdmissionInformation)
        {
            $AdmissionInformation->status = 0;
            $AdmissionInformation->save();

            $User = User::where('id', $AdmissionInformation->user_id)->first();
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