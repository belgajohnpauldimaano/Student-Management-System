<?php

namespace App\Http\Controllers\Registrar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentEnrolledListController extends Controller
{
    public function index(Request $request, $id)
    {
        return view('control_panel_registrar.student_enrolled.index');
    }
}