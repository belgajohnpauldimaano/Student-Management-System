<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class SchoolYearController extends Controller
{
    public function index (Request $request) 
    {
        if ($request->ajax())
        {
            $SchoolYear = \App\SchoolYear::where('status', 1)->where('school_year', 'like', '%'.$request->search.'%')->paginate(10);
            return view('control_panel.school_year.partials.data_list', compact('SchoolYear'))->render();
        }
        $SchoolYear = \App\SchoolYear::where('status', 1)->paginate(10);
        return view('control_panel.school_year.index', compact('SchoolYear'));
    }
    public function modal_data (Request $request) 
    {
        $SchoolYear = NULL;
        if ($request->id)
        {
            $SchoolYear = \App\SchoolYear::where('id', $request->id)->first();
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
            $SchoolYear = \App\SchoolYear::where('id', $request->id)->first();
            $SchoolYear->school_year = $request->school_year;
            $SchoolYear->current = $request->current_sy;
            $SchoolYear->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $SchoolYear = new \App\SchoolYear();
        $SchoolYear->school_year = $request->school_year;
        $SchoolYear->current = $request->current_sy;
        $SchoolYear->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function deactivate_data (Request $request) 
    {
        $SchoolYear = \App\SchoolYear::where('id', $request->id)->first();

        if ($SchoolYear)
        {
            $SchoolYear->status = 0;
            $SchoolYear->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}
