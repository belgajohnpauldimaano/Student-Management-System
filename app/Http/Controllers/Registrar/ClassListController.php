<?php

namespace App\Http\Controllers\Registrar;

use App\Models\Room;
use App\Models\Strand;
use App\Traits\HasUser;
use App\Models\GradeLevel;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\SectionDetail;
use App\Models\SubjectDetail;
use App\Models\FacultyInformation;
use App\Http\Controllers\Controller;

class ClassListController extends Controller
{    
    use HasUser;
    public function index (Request $request) 
    {
        $isAdmin = $this->isAdmin();

        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->first();

        $ClassDetail = ClassDetail::with(['section','room','schoolYear','adviserData'])
            ->whereCurrent(1)
            ->whereStatus(1)
            ->whereSchoolYearId($request->sy_search ? $request->sy_search : $SchoolYear->id)
            ->WhereHas('section', function($query) use ($request) {
                if ($request->search) 
                {
                    $query->where('section', 'like', '%' . $request->search . '%');
                }
            })
            ->paginate(10);

        if ($request->ajax())
        {            
            return view('control_panel_registrar.class_details.partials.data_list', compact('ClassDetail','isAdmin','SchoolYear'))->render();
        }

        $SchoolYear = SchoolYear::where('status', 1)->orderBy('school_year', 'DESC')->get();

        return view('control_panel_registrar.class_details.index', compact('ClassDetail', 'SchoolYear','isAdmin'));
    }
    
    public function modal_data (Request $request) 
    {
        $ClassDetail = NULL;
        $FacultyInformation = FacultyInformation::where('status', 1)->get();
        if ($request->id)
        {
            $ClassDetail = ClassDetail::where('id', $request->id)->first();
        }
        // $FacultyInformation = FacultyInformation::where('status', 1)->get();
        // $SubjectDetail = SubjectDetail::where('status', 1)->get();

        $SectionDetail = SectionDetail::where('status', 1)->orderBy('grade_level')->get();
        $SectionDetail_grade_levels = \DB::table('section_details')->select(\DB::raw('DISTINCT(grade_level) as grade_level'))->whereRaw('status = 1')->orderByRaw('grade_level ASC')->get();
        if ($ClassDetail) 
        {
            $SectionDetail = SectionDetail::where('status', 1)->where('grade_level', $ClassDetail->grade_level)->orderBy('grade_level')->get();
        }
        $GradeLevel = GradeLevel::where('status', 1)->get();
        $Room = Room::where('status', 1)->get();
        $SchoolYear = SchoolYear::where('status', 1)->get();

        $Strand = Strand::where('status', 1)->orderBy('strand')->get();
        // if ($ClassDetail) 
        // {
        //     $Strand = Strand::where('status', 1)->where('strand', $ClassDetail->strand)->orderBy('strand')->get();
        // }
        return view('control_panel_registrar.class_details.partials.modal_data', 
            compact('ClassDetail', 'SectionDetail', 'Room', 'SchoolYear', 'SectionDetail_grade_levels', 'GradeLevel', 'FacultyInformation','Strand'))->render();
    }

    public function modal_manage_subjects (Request $request) 
    {
        $ClassDetail = NULL;
        if ($request->id)
        {
            $ClassDetail = ClassDetail::where('id', $request->id)->first();
        }
        // return json_encode($ClassDetail);
        $FacultyInformation = FacultyInformation::where('status', 1)->get();
        $SubjectDetail = SubjectDetail::where('status', 1)->get();
        $SectionDetail = SectionDetail::where('status', 1)->get();
        $Room = Room::where('status', 1)->get();
        $SchoolYear = SchoolYear::where('status', 1)->get();
        return view('control_panel_registrar.class_details.partials.modal_manage_subjects', 
            compact('ClassDetail', 'FacultyInformation', 'SubjectDetail', 'SectionDetail', 'Room', 'SchoolYear'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'section'       => 'required',
            'room'          => 'required',
            'school_year'   => 'required',
            'grade_level'   => 'required',
            'adviser'       => 'required',
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        $sectionDetail = SectionDetail::where('id', $request->section)->first();

        if($request->grade_level > 10)
        {
            if ($request->id)
            {
                $ClassDetail = ClassDetail::where('id', $request->id)->first();
                $ClassDetail->section_id = $request->section;
                $ClassDetail->room_id	 = $request->room;
                $ClassDetail->school_year_id = $request->school_year;
                $ClassDetail->grade_level = $request->grade_level;
                $ClassDetail->adviser_id = $request->adviser;
                $ClassDetail->strand_id = $request->strand;
                $ClassDetail->save();
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
            }

            $ClassDetail = new ClassDetail();
            $ClassDetail->section_id	 = $request->section;
            $ClassDetail->room_id	 = $request->room;
            $ClassDetail->school_year_id = $request->school_year;
            $ClassDetail->grade_level = $request->grade_level;
            $ClassDetail->adviser_id = $request->adviser;
            $ClassDetail->strand_id = $request->strand;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        else if(($request->grade_level < 11))
        {
            if ($request->id)
            {
                $ClassDetail = ClassDetail::where('id', $request->id)->first();
                $ClassDetail->section_id = $request->section;
                $ClassDetail->room_id	 = $request->room;
                $ClassDetail->school_year_id = $request->school_year;
                $ClassDetail->grade_level = $request->grade_level;
                $ClassDetail->adviser_id = $request->adviser;
                $ClassDetail->strand_id = 0;
                $ClassDetail->save();
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
            }

            $ClassDetail = new ClassDetail();
            $ClassDetail->section_id = $request->section;
            $ClassDetail->room_id = $request->room;
            $ClassDetail->school_year_id = $request->school_year;
            $ClassDetail->grade_level = $request->grade_level;
            $ClassDetail->adviser_id = $request->adviser;
            $ClassDetail->strand_id = 0;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
    }

    public function deactivate_data (Request $request) 
    {
        $ClassDetail = ClassDetail::where('id', $request->id)->first();

        if ($ClassDetail)
        {
            $ClassDetail->current = 0;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
    public function delete_data (Request $request)
    {
        $ClassDetail = ClassDetail::where('id', $request->id)->first();

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
        $SectionDetail = SectionDetail::where('grade_level', $request->grade_level)->where('status', 1)->get();
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