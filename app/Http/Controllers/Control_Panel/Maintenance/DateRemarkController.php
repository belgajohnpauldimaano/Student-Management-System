<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use App\Models\DateRemark;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DateRemarkController extends Controller
{
    public function index (Request $request)
    {
        $SchoolYear = DateRemark::join('school_years', 'school_years.id', '=', 'date_remarks.school_year_id')
            ->select(DB::raw("
                date_remarks.id,
                school_years.school_year,
                date_remarks.j_date,
                date_remarks.s_date1,
                date_remarks.s_date2,
                date_remarks.status
            "))
            ->where('date_remarks.status', 1)
            // ->where('school_years.school_year', 'like', '%'.$request->search.'%')            
            ->paginate(10);

        if ($request->ajax())
        {
            return view('control_panel.date_remarks.partials.data_list', compact('SchoolYear'))->render();
        }     
       
        return view('control_panel.date_remarks.index', compact('SchoolYear'));
        // return view('control_panel.date_remarks.index');
    }

    public function modal_data (Request $request) 
    {
        $SchoolYear = NULL;        
        if ($request->id)
        {
            $SchoolYear = DateRemark::where('id', $request->id)->first();         
        }
        $getSchoolYear = SchoolYear::get();       
        return view('control_panel.date_remarks.partials.modal_data', compact('SchoolYear','getSchoolYear'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'school_year_id' => 'required',
            'jdate' => 'required',
            'sdate1' => 'required',
            'sdate2' => 'required'
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        try {
            if ($request->id)
            {
                $SchoolYear = DateRemark::find($request->id);
                $SchoolYear->school_year_id = $request->school_year_id;
                $SchoolYear->j_date  = $request->jdate ? date('Y-m-d', strtotime($request->jdate)) : NULL;
                $SchoolYear->s_date1 = $request->sdate1 ? date('Y-m-d', strtotime($request->sdate1)) : NULL;
                $SchoolYear->s_date2 = $request->sdate2 ? date('Y-m-d', strtotime($request->sdate2)) : NULL;
                $SchoolYear->save();
                // return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
            }else{
                $SchoolYearDate = new DateRemark();
                $SchoolYearDate->school_year_id = $request->school_year_id;
                $SchoolYearDate->j_date  = $request->jdate ? date('Y-m-d', strtotime($request->jdate)) : NULL;
                $SchoolYearDate->s_date1 = $request->sdate1 ? date('Y-m-d', strtotime($request->sdate1)) : NULL;
                $SchoolYearDate->s_date2 = $request->sdate2 ? date('Y-m-d', strtotime($request->sdate2)) : NULL;
                // $SchoolYear->current = $request->current_sy;
                $SchoolYearDate->save();
            }
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        } catch (\Throwable $th) {
            return response()->json(['res_code' => 1, 'res_msg' => 'Sorry, Data not save!.']);
        }
    }

}