<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectClassController extends Controller
{
    public function index (Request $request) 
    {
        $SchoolYear         = \App\SchoolYear::where('status', 1)->get();
        return view('control_panel_faculty.subject_class_details.index', compact('SchoolYear'));
    }
    public function list_students_by_class (Request $request) 
    {
        $Enrollment = \App\Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->where('class_details_id', $request->search_class_subject)
            ->select(\DB::raw("
                student_informations.id,
                CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
            "))
            ->paginate(50);
        return view('control_panel_faculty.subject_class_details.partials.data_list', compact('Enrollment'))->render();
    }
    public function list_class_subject_details (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('class_subject_details.status', 1)
            ->where('class_details.status', 1)
            ->select(\DB::raw('
                class_details.id,
                class_subject_details.class_time,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level
            '))
            ->get();
        
        $class_details_elements = '<option value="">Select Class Subject</option>';
        if ($ClassSubjectDetail) 
        {
            foreach ($ClassSubjectDetail as $data) 
            {
                $class_details_elements .= '<option value="'. $data->id .'">'. $data->subject_code . ' ' . $data->subject . ' - grade ' .  $data->grade_level . ' sec ' . $data->section   .'</option>';
            }

            return $class_details_elements;
        }
        return $class_details_elements;
    }
    public function modal_data (Request $request) 
    {
        $ClassDetail = NULL;
        if ($request->id)
        {
            $ClassDetail = \App\ClassDetail::where('id', $request->id)->first();
        }
        // return json_encode($ClassDetail);
        $FacultyInformation = \App\FacultyInformation::where('status', 1)->get();
        $SubjectDetail = \App\SubjectDetail::where('status', 1)->get();
        $SectionDetail = \App\SectionDetail::where('status', 1)->get();
        $Room = \App\Room::where('status', 1)->get();
        $SchoolYear = \App\SchoolYear::where('status', 1)->where('current', 1)->get();
        return view('control_panel_registrar.class_details.partials.modal_data', compact('ClassDetail', 'FacultyInformation', 'SubjectDetail', 'SectionDetail', 'Room', 'SchoolYear'))->render();
    }

    public function modal_manage_subjects (Request $request) 
    {
        $ClassDetail = NULL;
        if ($request->id)
        {
            $ClassDetail = \App\ClassDetail::where('id', $request->id)->first();
        }
        // return json_encode($ClassDetail);
        $FacultyInformation = \App\FacultyInformation::where('status', 1)->get();
        $SubjectDetail = \App\SubjectDetail::where('status', 1)->get();
        $SectionDetail = \App\SectionDetail::where('status', 1)->get();
        $Room = \App\Room::where('status', 1)->get();
        $SchoolYear = \App\SchoolYear::where('status', 1)->get();
        return view('control_panel_registrar.class_details.partials.modal_manage_subjects', compact('ClassDetail', 'FacultyInformation', 'SubjectDetail', 'SectionDetail', 'Room', 'SchoolYear'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'section'       => 'required',
            'room'          => 'required',
            'school_year'   => 'required'
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        $sectionDetail = \App\sectionDetail::where('id', $request->section)->first();

        if ($request->id)
        {
            $ClassDetail = \App\ClassDetail::where('id', $request->id)->first();
            $ClassDetail->section_id	 = $request->section;
            $ClassDetail->room_id	 = $request->room;
            $ClassDetail->school_year_id = $request->school_year;
            $ClassDetail->grade_level = $sectionDetail->grade_level;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $ClassDetail = new \App\ClassDetail();
        $ClassDetail->section_id	 = $request->section;
        $ClassDetail->room_id	 = $request->room;
        $ClassDetail->school_year_id = $request->school_year;
        $ClassDetail->grade_level = $sectionDetail->grade_level;
        $ClassDetail->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }
}
