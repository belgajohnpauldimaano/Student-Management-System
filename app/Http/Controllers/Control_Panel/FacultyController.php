<?php

namespace App\Http\Controllers\Control_Panel;

use App\Models\User;
use App\Traits\HasUser;
use Illuminate\Http\Request;
use App\Models\FacultySeminar;
use App\Models\FacultyEducation;
use App\Models\FacultyInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\File;

class FacultyController extends Controller
{
    use HasUser;
    
    public function index (Request $request) 
    {
        $isAdmin = $this->isAdmin();
        if ($request->ajax())
        {
            $FacultyInformation = FacultyInformation::with(['user'])->where('status', 1)
            ->orderBY('last_name','ASC')
            ->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%'.$request->search.'%');
                $query->orWhere('middle_name', 'like', '%'.$request->search.'%');
                $query->orWhere('last_name', 'like', '%'.$request->search.'%');
            })
            // ->orWhere('first_name', 'like', '%'.$request->search.'%')
            ->paginate(10);
            
            return view('control_panel.faculty_information.partials.data_list', compact('FacultyInformation','isAdmin'))->render();
        }
        $FacultyInformation = FacultyInformation::with(['user'])->where('status', 1)->orderBY('last_name','ASC')->paginate(10);
        return view('control_panel.faculty_information.index', compact('FacultyInformation','isAdmin'));
    }
    public function modal_data (Request $request) 
    {
        $FacultyInformation = NULL;
        $Esignature = FacultyInformation::where('id', $request->id)->first(); 
        if ($request->id)
        {
            $FacultyInformation = FacultyInformation::with(['user'])->where('id', $request->id)->first();
            $Esignature = FacultyInformation::where('id', $request->id)->first();   
        }
        return view('control_panel.faculty_information.partials.modal_data', compact('FacultyInformation','Esignature'))->render();
    }

    public function change_esignature (Request $request)
    {
        
        $name = time().'.'.$request->user_photo->getClientOriginalExtension();
        $destinationPath = public_path('/img/signature/');
        $request->user_photo->move($destinationPath, $name);

    //    / $User = \Auth::user();
        if($request->id)
        {
            $Esignature = FacultyInformation::where('id', $request->id)->first();

            if ($Esignature->e_signature) 
            {
                $delete_photo = public_path('/img/signature/'. $Esignature->e_signature);
                if (\File::exists($delete_photo)) 
                {
                    \File::delete($delete_photo);
                }
            }
    
            $Esignature->e_signature = $name;
    
            if ($Esignature->save())
            {
                return response()->json(['res_code' => 0, 'res_msg' => 'User photo successfully updated.']);
            }
            else 
            {
                return response()->json(['res_code' => 1, 'res_msg' => 'Error in saving photo']);
            }
            
            return json_encode($request->all());
        }
        
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'username' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'department' => 'required',
        ];
        
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        if ($request->fid)
        {
         
            $FacultyInformation = FacultyInformation::where('id', $request->fid)->first();
               
            $User = User::where('username', $request->username)->where('id', '!=', $FacultyInformation->user_id)->first();
            if ($User) 
            {
                return response()->json(['res_code' => 1,'res_msg' => 'Username already used.']);
            }
            $User = User::where('id', $FacultyInformation->user_id)->first();
            $User->username = $request->username;
            $User->save();

            $FacultyInformation->first_name = $request->first_name;
            $FacultyInformation->middle_name = $request->middle_name;
            $FacultyInformation->last_name = $request->last_name;
            $FacultyInformation->department_id = $request->department;
            $FacultyInformation->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $User = User::where('username', $request->username)->first();
        if ($User) 
        {
            return response()->json(['res_code' => 1,'res_msg' => 'Username already used.']);
        }


        $User = new User();
        $User->username = $request->username;
        $User->password = bcrypt($request->first_name . '.' . $request->last_name);
        $User->role     = 4;
        $User->save();

        $FacultyInformation = new FacultyInformation();
        $FacultyInformation->first_name = $request->first_name;
        $FacultyInformation->middle_name = $request->middle_name;
        $FacultyInformation->last_name = $request->last_name;
        $FacultyInformation->department_id = $request->department;
        $FacultyInformation->user_id = $User->id;
        $FacultyInformation->save();
        
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }
    public function deactivate_data (Request $request) 
    {
        $FacultyInformation = FacultyInformation::where('id', $request->id)->first();

        if ($FacultyInformation)
        {
            $FacultyInformation->status = 0;
            $FacultyInformation->save();

            $User = User::where('id', $FacultyInformation->user_id)->first();
            if ($User)
            {
                $User->status = 0;
                $User->save();
            }
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
    public function additional_information (Request $request)
    {
        $FacultyInformation = FacultyInformation::where('id', $request->id)->first();
        $FacultyEducation = FacultyEducation::where('faculty_id', $request->id)->get();
        $FacultySeminar = FacultySeminar::where('faculty_id', $request->id)->get();
        return view('control_panel.faculty_information.partials.modal_additional_information', compact('FacultyEducation', 'FacultySeminar', 'FacultyInformation'))->render();
    }
}