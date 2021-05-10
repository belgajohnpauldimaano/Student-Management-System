<?php

namespace App\Http\Controllers\Control_Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExaminerController extends Controller
{
    public function index(Request $request){
        return view('control_panel.examiner');
    }
}