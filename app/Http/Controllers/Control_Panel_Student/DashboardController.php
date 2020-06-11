<?php

namespace App\Http\Controllers\Control_Panel_Student;

use App\SchoolYear;
use App\OnlineAppointment;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\StudentTimeAppointment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index (Request $request) 
    {
        $User = Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)
            ->first();

        // $SchoolYear = SchoolYear::where('status', 1)
        //     ->where('status', 1)
        //     ->first();

        if ($request->ajax())
        {
            $Appointed = StudentTimeAppointment::with('appointment')
                ->where('student_id', $StudentInformation->id)
                ->where('status', 1)
                ->get();

            $AppointedCount = StudentTimeAppointment::with('appointment')
                ->where('student_id', $StudentInformation->id)
                ->where('status', 1)
                ->count();

            $OnlineAppointment = OnlineAppointment::where('status', 1)
                ->get();

            $hasAppointment =  StudentTimeAppointment::with('appointment')
                ->where('student_id', $StudentInformation->id)
                ->where('status', 1)
                ->first();

            return view('control_panel_student.online_appointment.partials.data_list', 
                compact('OnlineAppointment', 'Appointed','StudentInformation','SchoolYear','hasAppointment','AppointedCount'))
                ->render();
        }

        $AppointedCount = StudentTimeAppointment::with('appointment')
                ->where('student_id', $StudentInformation->id)
                ->where('status', 1)
                ->count();

        $Appointed = StudentTimeAppointment::with('appointment')
            ->where('student_id', $StudentInformation->id)
            ->where('status', 1)
            ->get();
        
        $OnlineAppointment = OnlineAppointment::where('status', 1)
            ->get();

        $hasAppointment =  StudentTimeAppointment::with('appointment')
            ->where('student_id', $StudentInformation->id)
            ->where('status', 1)
            ->first();

        $StudentInformation = \App\StudentInformation::where('user_id', \Auth::user()->id)->first();
        return view('control_panel_student.dashboard.index',compact('StudentInformation','OnlineAppointment', 'Appointed','StudentInformation','SchoolYear', 'hasAppointment','AppointedCount'));
    }

    
}
