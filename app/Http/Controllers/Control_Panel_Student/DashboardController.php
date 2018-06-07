<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index (Request $request) 
    {
        return view('control_panel_student.dashboard.index');
    }
}
