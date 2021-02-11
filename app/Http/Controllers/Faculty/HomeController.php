<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('control_panel_faculty.home.index',
            compact(
                'StudentInformation_tagged_student',
                'StudentInformation_tagged_student_male',
                'StudentInformation_tagged_student_female',
                'ClassSubjectDetail_count'
                )
        );
    }

    public function modal_data(Request $request){
        $type = $request->type;
        return view('control_panel_faculty.home.partials.modal_data', compact('type'))->render(); 
    }
}