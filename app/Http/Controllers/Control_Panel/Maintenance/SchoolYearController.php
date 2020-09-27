<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use App\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchoolYearController extends Controller
{
    public function index (Request $request) 
    {
        if ($request->ajax())
        {
            $SchoolYear = SchoolYear::where('status', 1)->where('school_year', 'like', '%'.$request->search.'%')->paginate(10);
            return view('control_panel.school_year.partials.data_list', compact('SchoolYear'))->render();            
        }
        $SchoolYear = SchoolYear::where('status', 1)->paginate(10);

        $finance = SchoolYearCategory::where('status', 1)->first();
        
        return view('control_panel.school_year.index', compact('SchoolYear'));
    }
    
    public function modal_data (Request $request) 
    {
        $SchoolYear = NULL;
        if ($request->id)
        {
            $SchoolYear = SchoolYear::where('id', $request->id)->first();
        }
        return view('control_panel.school_year.partials.modal_data', compact('SchoolYear'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'school_year' => 'required'
           
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        if ($request->id)
        {
            $SchoolYear = SchoolYear::where('id', $request->id)->first();
            $SchoolYear->school_year = $request->school_year;
            $SchoolYear->current = $request->current_sy;
            $SchoolYear->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $SchoolYear = new SchoolYear();
        $SchoolYear->school_year = $request->school_year;
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
