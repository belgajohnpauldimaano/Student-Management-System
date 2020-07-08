<?php

namespace App\Http\Controllers\Control_Panel_Student;

use App\SchoolYear;
use App\OnlineAppointment;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\TransactionMonthPaid;
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

        $SchoolYear = SchoolYear::where('status', 1)
            ->where('status', 1)
            ->first();        


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
            

        $AlreadyEnrolled = TransactionMonthPaid::where('student_id', $StudentInformation->id)
                ->where('school_year_id', $SchoolYear->id)
                // ->where('isSuccess', 1)
                ->where('approval', 'Approved')
                ->orderBy('id', 'Desc')
                ->first();

        
        return view('control_panel_student.dashboard.index',
            compact('StudentInformation','OnlineAppointment', 'Appointed','StudentInformation', 
            'hasAppointment','AppointedCount','AlreadyEnrolled'));
    }

    
}
