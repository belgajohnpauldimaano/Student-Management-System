<?php

namespace App\Http\Controllers\Registrar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassListController extends Controller
{
    public function index (Request $request) 
    {
        $ClassDetail = \App\ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
            ->join('rooms', 'rooms.id', '=' ,'class_details.room_id')
            ->join('school_years', 'school_years.id', '=' ,'class_details.school_year_id')
            ->selectRaw('
                class_details.id,
                class_details.section_id,
                class_details.room_id,
                class_details.school_year_id,
                class_details.grade_level,
                class_details.current,
                section_details.section,
                section_details.grade_level as section_grade_level,
                school_years.school_year,
                rooms.room_code,
                rooms.room_description
            ')
            ->where('section_details.status', 1)
            ->where('class_details.current', 1);
        if ($request->ajax())
        {            
            $ClassDetail = $ClassDetail->paginate(10);
            // return json_encode($ClassDetail);
            return view('control_panel_registrar.class_details.partials.data_list', compact('ClassDetail'))->render();
        }
        $ClassDetail = $ClassDetail->paginate(10);
        
        // return json_encode($ClassDetail);
        return view('control_panel_registrar.class_details.index', compact('ClassDetail'));
    }
    public function modal_data (Request $request) 
    {
        $ClassDetail = NULL;
        if ($request->id)
        {
            $ClassDetail = \App\ClassDetail::where('id', $request->id)->first();
        }
        // $FacultyInformation = \App\FacultyInformation::where('status', 1)->get();
        // $SubjectDetail = \App\SubjectDetail::where('status', 1)->get();

        $SectionDetail = \App\SectionDetail::where('status', 1)->orderBy('grade_level')->get();
        $SectionDetail_grade_levels = \DB::table('section_details')->select(\DB::raw('DISTINCT(grade_level) as grade_level'))->whereRaw('status = 1')->orderByRaw('grade_level ASC')->get();
        if ($ClassDetail) 
        {
            $SectionDetail = \App\SectionDetail::where('status', 1)->where('grade_level', $ClassDetail->grade_level)->orderBy('grade_level')->get();
        }
        $Room = \App\Room::where('status', 1)->get();
        $SchoolYear = \App\SchoolYear::where('status', 1)->where('current', 1)->get();
        return view('control_panel_registrar.class_details.partials.modal_data', compact('ClassDetail', 'SectionDetail', 'Room', 'SchoolYear', 'SectionDetail_grade_levels'))->render();
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
            'school_year'   => 'required',
            'grade_level'   => 'required',
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
            $ClassDetail->grade_level = $request->grade_level;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $ClassDetail = new \App\ClassDetail();
        $ClassDetail->section_id	 = $request->section;
        $ClassDetail->room_id	 = $request->room;
        $ClassDetail->school_year_id = $request->school_year;
        $ClassDetail->grade_level = $request->grade_level;
        $ClassDetail->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function deactivate_data (Request $request) 
    {
        $ClassDetail = \App\ClassDetail::where('id', $request->id)->first();

        if ($ClassDetail)
        {
            $ClassDetail->status = 0;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function fetch_section_by_grade_level (Request $request)
    {
        $SectionDetail = \App\SectionDetail::where('grade_level', $request->grade_level)->where('status', 1)->get();
        if ($request->type == 'json') 
        {
            return response()->json(compact('SectionDetail'));
        }

        $section_details_elem = '<option value="">Select section</option>';
        foreach($SectionDetail as $data) 
        {
            $section_details_elem .= '<option value="'. $data->id .'">' . $data->section . '</option>';
        }
        return $section_details_elem;
    }
}