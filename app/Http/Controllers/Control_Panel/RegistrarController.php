<?php

namespace App\Http\Controllers\Control_Panel;

use App\Models\User;
use App\Traits\HasUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistrarInformation;

class RegistrarController extends Controller
{
    use HasUser;
    public function index (Request $request) 
    {
        $isAdmin = $this->isAdmin();
        if ($request->ajax())
        {
            $RegistrarInformation = RegistrarInformation::with(['user'])->where('status', 1)
            ->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%'.$request->search.'%');
                $query->orWhere('middle_name', 'like', '%'.$request->search.'%');
                $query->orWhere('last_name', 'like', '%'.$request->search.'%');
            })
            // ->orWhere('first_name', 'like', '%'.$request->search.'%')
            ->paginate(10);
            return view('control_panel.registrar_information.partials.data_list', compact('RegistrarInformation','isAdmin'))->render();
        }
        $RegistrarInformation = RegistrarInformation::with(['user'])->where('status', 1)->paginate(10);
        return view('control_panel.registrar_information.index', compact('RegistrarInformation','isAdmin'));
    }
    public function modal_data (Request $request) 
    {
        $RegistrarInformation = NULL;
        if ($request->id)
        {
            $RegistrarInformation = RegistrarInformation::with(['user'])->where('id', $request->id)->first();
        }
        return view('control_panel.registrar_information.partials.modal_data', compact('RegistrarInformation'))->render();
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
            $RegistrarInformation = RegistrarInformation::where('id', $request->id)->first();
            $User = User::where('username', $request->username)->where('id', '!=', $RegistrarInformation->user_id)->first();
            if ($User) 
            {
                return response()->json(['res_code' => 1,'res_msg' => 'Username already used.']);
            }
            $RegistrarInformation->first_name = $request->first_name;
            $RegistrarInformation->middle_name = $request->middle_name;
            $RegistrarInformation->last_name = $request->last_name;
            $RegistrarInformation->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $User = new User();
        $User->username = $request->username;
        $User->password = bcrypt($request->first_name . '.' . $request->last_name);
        $User->role     = 3;
        $User->save();

        $RegistrarInformation = new RegistrarInformation();
        $RegistrarInformation->first_name = $request->first_name;
        $RegistrarInformation->middle_name = $request->middle_name;
        $RegistrarInformation->last_name = $request->last_name;
        $RegistrarInformation->user_id = $User->id;
        $RegistrarInformation->save();
        
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }
    public function deactivate_data (Request $request) 
    {
        $RegistrarInformation = RegistrarInformation::where('id', $request->id)->first();

        if ($RegistrarInformation)
        {
            $RegistrarInformation->status = 0;
            $RegistrarInformation->save();

            $User = User::where('id', $RegistrarInformation->user_id)->first();
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