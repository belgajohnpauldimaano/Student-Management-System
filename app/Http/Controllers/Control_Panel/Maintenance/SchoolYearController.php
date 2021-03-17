<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\SchoolYearCategory;
use App\Http\Controllers\Controller;

class SchoolYearController extends Controller
{
    public function index (Request $request) 
    {
        if ($request->ajax())
        {
            $SchoolYear = SchoolYear::whereStatus(1)->where('school_year', 'like', '%'.$request->search.'%')->paginate(10);
            return view('control_panel.school_year.school_year.partials.data_list', compact('SchoolYear'))->render();            
        }
        $SchoolYear = SchoolYear::whereStatus(1)->paginate(10);

        $finance = SchoolYearCategory::whereStatus(1)->first();
        
        return view('control_panel.school_year.school_year.index', compact('SchoolYear'));
    }

    public function schoolYearSettings(Request $request)
    {
        if ($request->ajax())
        {
            $SchoolYear = SchoolYear::whereStatus(1)->paginate(10);

            $finance = SchoolYearCategory::whereStatus(1)->whereType(1)->first();
            $registrar = SchoolYearCategory::whereStatus(1)->whereType(2)->first();
            $student = SchoolYearCategory::whereStatus(1)->whereType(3)->first();
            $faculty = SchoolYearCategory::whereStatus(1)->whereType(4)->first();
            
            
            return view('control_panel.school_year.school_year_setting.partials.data_list', compact('SchoolYear','finance','student','registrar','faculty'));           
        }

        $SchoolYear = SchoolYear::whereStatus(1)->paginate(10);

        $finance = SchoolYearCategory::whereStatus(1)->whereType(1)->first();
        $registrar = SchoolYearCategory::whereStatus(1)->whereType(2)->first();
        $student = SchoolYearCategory::whereStatus(1)->whereType(3)->first();
        $faculty = SchoolYearCategory::whereStatus(1)->whereType(4)->first();
        
        
        return view('control_panel.school_year.school_year_setting.index', compact('SchoolYear','finance','student','registrar','faculty'));
    }

    public function saveSchoolYear(Request $request)
    {
        $rules = [
            'finance' => 'required',
            'registrar' => 'required',
            'student' => 'required',
            'faculty' => 'required',   
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }
        
       
        $finance = SchoolYearCategory::whereType(1)->first();
        $finance->school_year_id = $request->finance;
        $finance->save();          

        $registrar = SchoolYearCategory::whereType(2)->first();
        $registrar->school_year_id = $request->registrar;
        $registrar->save();
            
        $student = SchoolYearCategory::whereType(3)->first();
        $student->school_year_id = $request->student;
        $student->save();

        $student = SchoolYearCategory::whereType(4)->first();
        $student->school_year_id = $request->faculty;
        $student->save();
        
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        
    }

    
    public function modal_data (Request $request) 
    {
        $SchoolYear = NULL;
        if ($request->id)
        {
            $SchoolYear = SchoolYear::where('id', $request->id)->first();
        }
        return view('control_panel.school_year.school_year.partials.modal_data', compact('SchoolYear'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'school_year'   => 'required',
            // 'apply_to'      => 'required'
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        // foreach ($request->apply_to as $i => $d)
        // {
        //     $apply_name = ['Admin', 'Faculty', 'Finance' ,'Registration' ];
        //     $apply_to[$i] = $d;
        // }

        $apply_to = array(
            [
                "apply_name" => "admin",
                "is_apply"   => $request->apply_to_admin == 1 ? true : false,
            ],
            [
                "apply_name" => "faculty",
                "is_apply"   => $request->apply_to_faculty == 1 ? true : false,
            ],
            [
                "apply_name" => "finance",
                "is_apply"   => $request->apply_to_finance == 1 ? true : false,
            ],
            [
                "apply_name" => "registration",
                "is_apply"   => $request->apply_to_registration == 1 ? true : false,
            ]
        );

        // return json_encode($apply_to);
        if ($request->id){
            $SchoolYear = SchoolYear::where('id', $request->id)->first();
        }else{
            $SchoolYear = new SchoolYear();
        }
        $SchoolYear->school_year = $request->school_year;
        $SchoolYear->apply_to = json_encode($apply_to);
        $SchoolYear->current = $request->current_sy;
        $SchoolYear->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    
    
    public function toggle_current_sy (Request $request)
    {
        $SchoolYear = SchoolYear::where('id', $request->id)->first();
        if ($SchoolYear) 
        {
            if ($SchoolYear->current == 0) 
            {
                $SchoolYear->current = 1; 
                $SchoolYear->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully added to current active SY.']);
            }
            else 
            {
                $SchoolYear->current = 0; 
                $SchoolYear->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully removed from current active SY.']);
            }
        }
    }
    public function deactivate_data (Request $request) 
    {
        $SchoolYear = SchoolYear::where('id', $request->id)->first();

        if ($SchoolYear)
        {
            $SchoolYear->status = 0;
            $SchoolYear->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}