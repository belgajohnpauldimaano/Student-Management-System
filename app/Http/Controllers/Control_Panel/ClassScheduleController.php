<?php

namespace App\Http\Controllers\Control_Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassScheduleController extends Controller
{
    public function index (Request $request) 
    {
        $SchoolYear = \App\SchoolYear::where('current', 1)->first();
        $FacultyInformation = \App\FacultyInformation::where('status', 1)
        ->select(\DB::raw(
            "
                faculty_informations.id,
                CONCAT(last_name, ' ', first_name, ', ', middle_name) as fullname,
                department_id,
                (   SELECT 
                        COUNT(*) 
                    FROM 
                        class_subject_details 
                    WHERE  
                        class_subject_details.faculty_id = faculty_informations.id 
                    AND 
                        class_subject_details.status = 1 
                    AND class_details_id IN (SELECT id FROM class_details where school_year_id IN (SELECT id FROM school_years WHERE current = 1 and status = 1) AND status = 1)
                ) 
                    AS subjects_count
            "
        ))->orderByRaw('fullname ASC');
        if ($request->ajax()) 
        {
            $FacultyInformation = $FacultyInformation->where(function ($query) use ($request) {
                if ($request->search)
                {
                    $query->where('first_name', 'LIKE', '%'. $request->search . '%');
                }
            })
            ->paginate(10);
            
            return view('control_panel.faculty_schedule.partials.data_list', compact('FacultyInformation'))->render();
            return response()->json(['res_code' => 0, 'res_msg' => '', 'FacultyInformation' => $FacultyInformation]);
        }
        
        $FacultyInformation = $FacultyInformation->paginate(10);

        // return response()->json(['res_code' => 0, 'res_msg' => '', 'FacultyInformation' => $FacultyInformation]);
        return view('control_panel.faculty_schedule.index', compact('FacultyInformation'));
    }
    public function get_faculty_class_schedule (Request $request)
    {
        $SchoolYear = \App\SchoolYear::where('current', 1)->first();
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
        ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
        ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
        ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
        ->join('school_years', 'school_years.id', '=', 'class_details.school_year_id')
        ->where('faculty_id', $request->id)
        ->whereRaw('
            class_details_id IN ( SELECT id from class_details WHERE school_year_id IN ( SELECT id FROM school_years WHERE status = 1 AND current = 1 ) )
        ')
        ->where('class_subject_details.status', 1)
        ->get();
        // return response()->json(['res_code' => 0, 'res_msg' => '', 'FacultyInformation' => $ClassSubjectDetail]);
        return view('control_panel.faculty_schedule.partials.modal_data_class_schedule', compact('ClassSubjectDetail'))->render();
    }
}
