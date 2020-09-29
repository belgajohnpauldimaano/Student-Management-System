<?php

namespace App\Http\Controllers\Faculty;

use App\SchoolYear;
use App\ClassSubjectDetail;
use App\FacultyInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MyAdvisoryController extends Controller
{
    public function index (Request $request)
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();
        
        $SchoolYear  = SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'ASC')->orderBy('school_year', 'ASC')->get();
        $class_id = \Crypt::decrypt($request->c);

        $GradeLevel = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')            
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')            
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.id', $class_id)           
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();

        return view('control_panel_faculty.my_advisory_class.index', compact('SchoolYear','GradeLevel'));
            
    }
}
