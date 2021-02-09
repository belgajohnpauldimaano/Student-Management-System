<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Payroll;
use Illuminate\Http\Request;
use App\Models\FacultySeminar;
use App\Models\FacultyEducation;
use App\Models\FacultyInformation;
use Illuminate\Support\FacadesAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function view_my_profile (Request $request)
    {
        $User = Auth::user();
        $Profile = FacultyInformation::where('user_id', $User->id)->first();
        $FacultyInformation = collect(FacultyInformation::DEPARTMENTS);
        $payroll = Payroll::whereEmployeeId($Profile->id)->whereStatus(1)->orderBy('payroll_date','DESC')->get();
        return view('control_panel_faculty.user_profile.index', compact('User', 'Profile', 'FacultyInformation', 'payroll'));
    }
    public function fetch_profile (Request $request)
    {
        $User = Auth::user();
        $Profile = FacultyInformation::where('user_id', $User->id)->first();
        return response()->json(['res_code' => 0, 'res_msg' => '', 'Profile' => $Profile]);
    }
    public function update_profile (Request $request) 
    {
        $rules = [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
        ];
        
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails())
        {   
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $validator->getMessageBag()]);
        }
        $User = Auth::user();
        $Profile = FacultyInformation::where('user_id', $User->id)->first();

        $Profile->first_name = $request->first_name;
        $Profile->middle_name = $request->middle_name;
        $Profile->last_name = $request->last_name;
        $Profile->contact_number = $request->contact_number;
        $Profile->email = $request->email;
        $Profile->address = $request->address;
        $Profile->birthday = date('Y-m-d', strtotime($request->birthday));
                
        // echo date('Y-m-d', strtotime($request->birthday));
        // return;
        if ($Profile->save())
        {
            return response()->json(['res_code' => 0, 'res_msg' => 'User profile successfully updated.']);
        }
        else 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Unable to update profile.']);
        }
    }
    public function change_my_photo (Request $request)
    {
        $name = time().'.'.$request->user_photo->getClientOriginalExtension();
        $destinationPath = public_path('/img/account/photo/');
        $request->user_photo->move($destinationPath, $name);

        $User = Auth::user();
        $Profile = FacultyInformation::where('user_id', $User->id)->first();

        if ($Profile->photo) 
        {
            $delete_photo = public_path('/img/account/photo/'. $Profile->photo);
            if (\File::exists($delete_photo)) 
            {
                \File::delete($delete_photo);
            }
        }

        $Profile->photo = $name;

        if ($Profile->save())
        {
            return response()->json(['res_code' => 0, 'res_msg' => 'User photo successfully updated.']);
        }
        else 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Error in saving photo']);
        }

        return json_encode($request->all());
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
        // return json_encode(['aa' => Auth::user()->password]);
        if (\Hash::check($request->old_password, Auth::user()->password))
        {
            Auth::user()->password = bcrypt($request->password);
            Auth::user()->save();
            
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Password successfully changed.']);
        }
        else 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Incorrect old password.']);
        }
    }

    public function educational_attainment (Request $request) 
    {
        $User = Auth::user();
        $Profile = FacultyInformation::where('user_id', $User->id)->first();
        
        try {
            $FacultyEducation = FacultyEducation::where('faculty_id', $Profile->id)->get();

            $data = '';
            if (!$FacultyEducation->isEmpty()) 
            {
                foreach ($FacultyEducation as $educ) 
                {
                    $data .= '
                        <tr>
                            <td>'. $educ->course .'</td>
                            <td>'. $educ->school .'</td>
                            <td>'. $educ->from . ' / ' . $educ->to  .'</td>
                            <td>'. $educ->awards .'</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger">Action</button>
                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <a href="#" class="dropdown-item js-btn_educ_edit" data-id="'. $educ->id .'">Edit</a>
                                        <a href="#" class="dropdown-item js-btn_educ_delete" data-id="'. $educ->id .'">Delete</a>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    ';
                }
            } 
            else 
            {
                $data = '
                    <tr>
                        <th class="text-center" colspan="5">No record found</th>
                    </tr>
                ';
            }

            return $data;
        } catch (\Throwable $th) {
            $data = '
                <tr>
                    <th class="text-center" colspan="5">No record found</th>
                </tr>
            ';

            return $data;
        }
        
    }
    public function educational_attainment_save (Request $request) 
    {
        $rules = [
            'course'    => 'required',
            'school'    => 'required',
            'date_from' => 'nullable',
            'date_to'   => 'nullable',
            'awards'    => 'nullable',
        ];

        $validator = \Validator::make($request->all(), $rules);
        
        if ($validator->fails()) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill required fields', 'res_error_msg' => $validator->getMessageBag()]);
        }

        $User = Auth::user();
        $Profile = FacultyInformation::where('user_id', $User->id)->first();

        if ($request->educ_id) 
        {
            $FacultyEducation = FacultyEducation::where('id', $request->educ_id)->first();
            $FacultyEducation->course = $request->course;
            $FacultyEducation->school = $request->school;
            $FacultyEducation->from = $request->date_from ? date('Y-m-d', strtotime($request->date_from)) : NULL;
            $FacultyEducation->to = $request->date_to ? date('Y-m-d', strtotime($request->date_to)) : NULL;
            $FacultyEducation->awards = $request->awards;
            $FacultyEducation->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Educational attainment successfully added.']);
        }

        $FacultyEducation = new FacultyEducation();
        $FacultyEducation->course = $request->course;
        $FacultyEducation->school = $request->school;
        $FacultyEducation->from = $request->date_from ? date('Y-m-d', strtotime($request->date_from)) : NULL;
        $FacultyEducation->to = $request->date_to ? date('Y-m-d', strtotime($request->date_to)) : NULL;
        $FacultyEducation->awards = $request->awards;
        $FacultyEducation->faculty_id = $Profile->id;
        $FacultyEducation->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Educational attainment successfully added.']);
    }
    
    public function educational_attainment_fetch_by_id (Request $request)
    {
        if ($request->educ_id) {
            $FacultyEducation = FacultyEducation::where('id', $request->educ_id)->first();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data available.', 'FacultyEducation' => $FacultyEducation]);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Unable to fetch data']);
    }
    public function educational_attainment_delete_by_id (Request $request)
    {
        if ($request->educ_id) {
            $FacultyEducation = FacultyEducation::where('id', $request->educ_id)->first();
            $FacultyEducation->delete();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deleted.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Unable to fetch data']);
    }
    public function trainings_seminars (Request $request) 
    {   
        $User = Auth::user();
        $Profile = FacultyInformation::where('user_id', $User->id)->first();
        $FacultySeminar = FacultySeminar::where('faculty_id', $Profile->id)->get();

        try {
            //code...
            $seminars_trainings = '';
            if (!$FacultySeminar->isEmpty())
            {
                foreach ($FacultySeminar as $data) 
                {
                    $type = '';
                    if ($data->type == 1)
                    {
                        $type = 'Local';
                    }
                    else if ($data->type == 2)
                    {
                        $type = 'National';
                    }
                    else if ($data->type == 3)
                    {
                        $type = 'International';
                    }
                    $seminars_trainings .= '
                        <tr>
                            <td>'. $data->title .'</td>
                            <td>'. $data->date_from . ' / ' . $data->date_to  .'</td>
                            <td>'. $data->venue .'</td>
                            <td>'. $data->sponsor .'</td>
                            <td>'. $data->facilitator .'</td>
                            <td>' . $type .'</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger">Action</button>
                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <a href="#" class="dropdown-item btn-trainings_seminars" data-id="'. $data->id .'">Edit</a>
                                        <a href="#" class="dropdown-item btn-seminar_delete" data-id="'. base64_encode($data->id) .'">Delete</a>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    ';
                }
                
                return $seminars_trainings;
            }
            else 
            {
                $seminars_trainings = '
                <tr>
                    <th class="text-center" colspan="7">No record found</th>
                </tr>';
                return $seminars_trainings;
            }
        } catch (\Throwable $th) {
            $seminars_trainings = '
            <tr>
                <th class="text-center" colspan="7">No record found</th>
            </tr>';
            return $seminars_trainings;
        }
    }
    public function fetch_training_seminar_by_id (Request $request) 
    {
        if ($request->id) 
        {
            $FacultySeminar = FacultySeminar::where('id', $request->id)->first();
            if ($FacultySeminar) 
            {
                return response()->json(['res_code' => 0, 'res_msg' => '', 'FacultySeminar' => $FacultySeminar]);
            }
            else 
            {
                return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request']);
            }
        }
        else 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request']);
        }
    }
    public function save_training_seminar (Request $request) 
    {
        $rules = [
            'title'             => 'required',
            'seminar_date_from' => 'required',
            'seminar_date_to'   => 'required',
            'venue'             => 'required',
            'sponsor'           => 'required',
            'facilitator'       => 'required',
            'seminar_type'      => 'required|numeric|between:1,3',
        ];
        $messages = [
            'seminar_type.between' => 'Invalid seminart/training type'
        ];
        $validator = \Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid inputs', 'res_error_msg' => $validator->getMessageBag()]);
        }

        if ($request->seminar_id) 
        {
            $FacultySeminar = FacultySeminar::where('id', $request->seminar_id)->first();
            if ($FacultySeminar)
            {
                $FacultySeminar->title          = $request->title;
                $FacultySeminar->date_from      = $request->seminar_date_from ? date('Y-m-d', strtotime($request->seminar_date_from)) : NULL;
                $FacultySeminar->date_to        = $request->seminar_date_to ? date('Y-m-d', strtotime($request->seminar_date_to)) : NULL;
                $FacultySeminar->venue          = $request->venue;
                $FacultySeminar->sponsor        = $request->sponsor;
                $FacultySeminar->facilitator    = $request->facilitator;
                $FacultySeminar->type           = $request->seminar_type;
                $FacultySeminar->save();
                return response()->json(['res_code' => 0, 'res_msg' => 'Seminar/Training successfully updated']); 
            }
            else
            {
                return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request']); 
            }
        }
        else 
        {
            $User = Auth::user();
            $Profile = FacultyInformation::where('user_id', $User->id)->first();
            $FacultySeminar = new FacultySeminar();
            $FacultySeminar->title          = $request->title;
            $FacultySeminar->date_from      = $request->seminar_date_from ? date('Y-m-d', strtotime($request->seminar_date_from)) : NULL;
            $FacultySeminar->date_to        = $request->seminar_date_to ? date('Y-m-d', strtotime($request->seminar_date_to)) : NULL;
            $FacultySeminar->venue          = $request->venue;
            $FacultySeminar->sponsor        = $request->sponsor;
            $FacultySeminar->facilitator    = $request->facilitator;
            $FacultySeminar->type           = $request->seminar_type;
            $FacultySeminar->faculty_id     = $Profile->id;
            $FacultySeminar->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Seminar/Training successfully added']); 
        }
    }
    public function delete_training_seminar_by_id (Request $request) 
    {
        if ($request->id) 
        {
            $id = base64_decode($request->id);
            
            $FacultySeminar = FacultySeminar::where('id', $id)->first();
            if ($FacultySeminar) 
            {
                if ($FacultySeminar->delete()) 
                {
                    return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deleted.']);
                }
                else 
                {
                    return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request']);
                }
            }
            else 
            {
                return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request']);
            }
        }
        else 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request']);
        }
    }
}