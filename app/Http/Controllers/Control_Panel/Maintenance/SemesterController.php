<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Control_Panel\Maintenance\SemesterController;

class SemesterController extends Controller
{
    //
    public function index (Request $request) 
    {
        if ($request->ajax())
        {
            $Semester = Semester::get();
            return view('control_panel.semester.index', compact('Semester'))->render();
        }
        
        $Semester = Semester::get();
        return view('control_panel.semester.index', compact('Semester'));
    }

    public function toggle_current_sy (Request $request)
    {
        $Semester = Semester::whereId($request->id)->first();
        if ($Semester) 
        {
            if($request->id == 1)
            {
                if ($Semester->current == 0) 
                {
                    Semester::where(['id'=> 2])->update(['current'=>0]);
    
                    $Semester->current = 1; 
                    $Semester->save(); 
                    return response()->json(['res_code' => 0, 'res_msg' => 'First Semester is now currently activated.']);
                }
                else 
                {
                    Semester::where(['id'=> 2])->update(['current'=>1]);
    
                    $Semester->current = 0; 
                    $Semester->save(); 
                    return response()->json(['res_code' => 0, 'res_msg' => 'First Semester is now currently de-activated.']);
                }
            }
            else 
            {
                if ($Semester->current == 0) 
                {
                    Semester::where(['id'=> 1])->update(['current'=>0]);
    
                    $Semester->current = 1; 
                    $Semester->save(); 
                    return response()->json(['res_code' => 0, 'res_msg' => 'Second Semester is now currently activated.']);
                }
                else 
                {
                    Semester::where(['id'=> 1])->update(['current'=>1]);
    
                    $Semester->current = 0; 
                    $Semester->save(); 
                    return response()->json(['res_code' => 0, 'res_msg' => 'Second Semester is now currently de-activated.']);
                }
            }
            
        }
    }

    public function set_sem (Request $request)
    {
        $Semester = Semester::where('id', $request->id)->first();
        
        if ($Semester) 
        {
            if ($Semester->current == 0) 
            {
                $Semester->current = 1; 
                $Semester->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'This Semester is now currently activated.']);
            }
            else 
            {
                $Semester->current = 0; 
                $Semester->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'This Semester is now currently de-activated.']);
            }
        }
    }
}