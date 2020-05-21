<?php

namespace App\Http\Controllers\Registrar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomingStudentController extends Controller
{
    public function index(){
        return view('control_panel_registrar.incoming_student.index');
    }
}
