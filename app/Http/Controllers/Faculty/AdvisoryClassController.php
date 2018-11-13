<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvisoryClassController extends Controller
{
    public function index (Request $request) 
    {
        
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();

        $ClassDetail = \App\ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
            ->join('rooms', 'rooms.id', '=' ,'class_details.room_id')
            ->leftJoin('faculty_informations', 'faculty_informations.id', '=' ,'class_details.adviser_id')
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
                rooms.room_description,
                CONCAT(faculty_informations.last_name, " ", faculty_informations.first_name, ", " ,  faculty_informations.middle_name) AS adviser_name
            ')
            ->where('section_details.status', 1)
            ->where('class_details.current', 1)
            ->where('class_details.status', 1)
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where(function ($query) use($request) {
                if ($request->sy_search) 
                {
                    $query->where('school_years.id', $request->sy_search);
                }
                if ($request->search) 
                {
                    $query->orWhere('section_details.section', 'like', '%' . $request->search . '%');
                    $query->orWhere('rooms.room_code', 'like', '%' . $request->search . '%');
                }
            });
        if ($request->ajax())
        {            
            $ClassDetail = $ClassDetail->paginate(10);
            // return json_encode($ClassDetail);
            return view('control_panel_faculty.class_advisory.partials.data_list', compact('ClassDetail'))->render();
        }

        $SchoolYear = \App\SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'DESC')->get();

        $ClassDetail = $ClassDetail->paginate(10);
        
        // return json_encode($ClassDetail);
        return view('control_panel_faculty.class_advisory.index', compact('ClassDetail', 'SchoolYear'));
    }
    public function view_class_list (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        try {
            $class_id = \Crypt::decrypt($request->c);
            $Enrollment = \App\Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
            ->whereRaw('enrollments.class_details_id = '. $class_id)
            ->select(\DB::raw("
                enrollments.id as e_id,
                student_informations.id,
                users.username,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
            "))
            ->paginate(100);

            $ClassDetails = \App\ClassDetail::join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id', '=', 'class_details.school_year_id')
            ->where('class_details.id', $class_id)->first();
            
            return view('control_panel_faculty.class_advisory.index_view_class_list', compact('Enrollment', 'ClassDetails', 'class_id'))->render();
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return "Invalid parameter";
        }
    }    
    public function manage_attendance (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        try {
            $class_id = \Crypt::decrypt($request->c);
            $enrollment_id = \Crypt::decrypt($request->enr);
            $Enrollment = \App\Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            ->whereRaw('enrollments.class_details_id = '. $class_id)
            ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
            ->whereRaw('enrollments.id = '. $enrollment_id)
            ->select(\DB::raw("
                enrollments.id as e_id,
                student_informations.id,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                attendance
            "))
            ->first();

            $ClassDetails = \App\ClassDetail::join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id', '=', 'class_details.school_year_id')
            ->where('class_details.id', $class_id)->first();
            
            $attendance_data = ['jan' => '30'];
            $attendance_data_str = json_encode($attendance_data);
            $attendance_data_parsed = json_decode($attendance_data_str);
            // return compact('Enrollment', 'ClassDetails', 'attendance_data_str', 'attendance_data_parsed');
            $student_attendance = [];
            $table_header = [
                ['key' => 'Jun',],
                ['key' => 'Jul',],
                ['key' => 'Aug',],
                ['key' => 'Sep',],
                ['key' => 'Oct',],
                ['key' => 'Nov',],
                ['key' => 'Dec',],
                ['key' => 'Jan',],
                ['key' => 'Feb',],
                ['key' => 'Mar',],
                ['key' => 'Apr',],
                ['key' => 'total',],
            ];
            $attendance_data = json_decode(json_encode([
                'days_of_school' => [
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                ],
                'days_present' => [
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                ],
                'days_absent' => [
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                ],
                'times_tardy' => [
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                ]
            ]));

            if ($Enrollment->attendance) {
                $attendance_data = json_decode($Enrollment->attendance);
            }

            $student_attendance = [
                'student_name'      => $Enrollment->student_name,
                'attendance_data'   => $attendance_data,
                'table_header'      => $table_header,
                'days_of_school_total' => array_sum($attendance_data->days_of_school),
                'days_present_total' => array_sum($attendance_data->days_present),
                'days_absent_total' => array_sum($attendance_data->days_absent),
                'times_tardy_total' => array_sum($attendance_data->times_tardy),
            ];
            $e_id = $Enrollment->e_id;
            return view('control_panel_faculty.class_advisory.partials.modal_manage_attendance', compact('student_attendance', 'class_id', 'e_id'))->render();
        } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return "Invalid parameter";
        }
    }
    public function save_attendance (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        try {
            $class_id = \Crypt::decrypt($request->c);
            $enrollment_id = \Crypt::decrypt($request->enr);

            $days_of_school = [
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
            ];
            foreach ($request->days_of_school as $i => $d)
            {
                $days_of_school[$i] = $d;
            }
            
            $days_present = [
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
            ];
            foreach ($request->days_present as $i => $d)
            {
                $days_present[$i] = $d;
            }

            $days_absent = [
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
            ];
            foreach ($request->days_absent as $i => $d)
            {
                $days_absent[$i] = $d;
            }

            $times_tardy = [
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
            ];
            foreach ($request->times_tardy as $i => $d)
            {
                $times_tardy[$i] = $d;
            }

            $attendance_data = [
                'days_of_school' => $days_of_school,
                'days_present' => $days_present,
                'days_absent' => $days_absent,
                'times_tardy' => $times_tardy
            ];

            $Enrollment = \App\Enrollment::whereRaw('enrollments.id = '. $enrollment_id)->first();
            $Enrollment->attendance = json_encode($attendance_data);
            $Enrollment->save();
            return json_encode([$request->all(), 'attendance_data' => json_encode($attendance_data), 'Enrollment' => $Enrollment]);
        }catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return "Invalid parameter";
        }
    }
    public function modal_data (Request $request) 
    {
        $ClassDetail = NULL;
        $FacultyInformation = \App\FacultyInformation::where('status', 1)->get();
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
        $GradeLevel = \App\GradeLevel::where('status', 1)->get();
        $Room = \App\Room::where('status', 1)->get();
        $SchoolYear = \App\SchoolYear::where('status', 1)->where('current', 1)->get();
        return view('control_panel_faculty.class_advisory.partials.modal_data', compact('ClassDetail', 'SectionDetail', 'Room', 'SchoolYear', 'SectionDetail_grade_levels', 'GradeLevel', 'FacultyInformation'))->render();
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
        return view('control_panel_faculty.class_advisory.partials.modal_manage_subjects', compact('ClassDetail', 'FacultyInformation', 'SubjectDetail', 'SectionDetail', 'Room', 'SchoolYear'))->render();
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

        $sectionDetail = \App\SectionDetail::where('id', $request->section)->first();

        if ($request->id)
        {
            $ClassDetail = \App\ClassDetail::where('id', $request->id)->first();
            $ClassDetail->section_id	 = $request->section;
            $ClassDetail->room_id	 = $request->room;
            $ClassDetail->school_year_id = $request->school_year;
            $ClassDetail->grade_level = $request->grade_level;
            $ClassDetail->adviser_id = $request->adviser;
            $ClassDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $ClassDetail = new \App\ClassDetail();
        $ClassDetail->section_id	 = $request->section;
        $ClassDetail->room_id	 = $request->room;
        $ClassDetail->school_year_id = $request->school_year;
        $ClassDetail->grade_level = $request->grade_level;
        $ClassDetail->adviser_id = $request->adviser;
        $ClassDetail->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function deactivate_data (Request $request) 
    {
        $ClassDetail = \App\ClassDetail::where('id', $request->id)->first();

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
