<?php

namespace App\Http\Controllers\Finance;

use App\Enrollment;
use App\SchoolYear;
use App\ClassDetail;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\Traits\hasNotYetApproved;
use App\Http\Controllers\Controller;

class StudentClassListController extends Controller
{
    use hasNotYetApproved;
    
    public function index (Request $request) 
    {

        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->first();

        $ClassDetail = ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
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
                school_years.id as schoolyearid,
                rooms.room_code,
                rooms.room_description,
                CONCAT(faculty_informations.last_name, ", ", faculty_informations.first_name, " " ,  faculty_informations.middle_name) AS adviser_name
            ')
            ->where('section_details.status', 1)
            ->where('class_details.current', 1)
            ->where('class_details.status', 1)
            ->where('school_year_id', $request->sy_search ? $request->sy_search : $SchoolYear->id)
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
            return view('control_panel_finance.class_details.partials.data_list', compact('ClassDetail'))->render();
        }

        $SchoolYear = SchoolYear::where('status', 1)->orderBy('school_year', 'DESC')->get();

        $ClassDetail = $ClassDetail->paginate(10);

        $NotyetApprovedCount = $this->notYetApproved();
        
        // return json_encode($ClassDetail);
        return view('control_panel_finance.class_details.index', compact('ClassDetail', 'SchoolYear','NotyetApprovedCount'));
    }

    public function studentList(Request $request, $id){

        if ($request->ajax())
        {
            if (!$request->search_fn &&
                !$request->search_mn &&
                !$request->search_ln &&
                !$request->search_student_id) 
            {
                $StudentInformation = [];
                return view('control_panel_finance.student_list.partials.data_list', compact('StudentInformation'))->render();
            }

            $StudentInformation = StudentInformation::with(['user','finance_transaction'])
                ->join('users', 'users.id', '=', 'student_informations.user_id')
                ->selectRaw("
                    student_informations.id,
                    users.username,
                    student_informations.last_name, student_informations.first_name, student_informations.middle_name
                ")
                ->where(function ($query) use ($request) {
                    if ($request->search_fn)
                    {
                        $query->where('first_name', 'like', '%'.$request->search_fn.'%');
                    }

                    if ($request->search_mn)
                    {
                        $query->where('middle_name', 'like', '%'.$request->search_mn.'%');
                    }

                    if ($request->search_ln)
                    {
                        $query->where('last_name', 'like', '%'.$request->search_ln.'%');
                    }

                    if ($request->search_student_id)
                    {
                        $query->where('users.username', 'like', '%'.$request->search_student_id.'%');
                    }
                })
                ->orderBy('student_informations.last_name')
                ->paginate(10);

            // return json_encode(['s' => $StudentInformation, 'req' => $request->all(), 'ClassDetail' => $id]);
            return view('control_panel_finance.student_list.partials.data_list', compact('StudentInformation'))->render();
        }

        $ClassDetail = ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
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
                school_years.id AS sy_id,
                school_years.school_year,
                rooms.room_code,
                rooms.room_description
            ')
            ->where('section_details.status', 1)
            // ->where('school_years.current', 1)
            ->where('class_details.id', $id)
            ->first();

        $StudentInformation = [];

        $Enrollment = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            ->where(function ($query) use ($request) {
                if ($request->search_fn)
                {
                    $query->where('student_informations.first_name', 'like', '%'.$request->search_fn.'%');
                }

                if ($request->search_mn)
                {
                    $query->where('student_informations.middle_name', 'like', '%'.$request->search_mn.'%');
                }

                if ($request->search_ln)
                {
                    $query->where('student_informations.last_name', 'like', '%'.$request->search_ln.'%');
                }

                if ($request->search_student_id)
                {
                    $query->where('users.username', 'like', '%'.$request->search_student_id.'%');
                }
            })
            ->selectRaw("
                student_informations.id AS student_information_id,
                users.username,
                student_informations.last_name, student_informations.first_name, student_informations.middle_name,
                enrollments.id AS enrollment_id
            ")
            ->where('class_details_id', $id)
            ->where('enrollments.status', 1)
            ->orderByRaw('student_informations.last_name')
            ->paginate(70);

        $Enrollment_ids = '';
        foreach($Enrollment as $data)
        {
            $Enrollment_ids .= $data->enrollment_id . '@';
        }

        $NotyetApprovedCount = $this->notYetApproved();

        return view('control_panel_finance.student_list.index', compact('StudentInformation', 'ClassDetail', 'id', 'Enrollment', 'Enrollment_ids','NotyetApprovedCount'));
    }


    public function fetch_enrolled_student (Request $request, $id)
    {        

        if($request->ajax()){
            $ClassDetail = ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
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
                    school_years.id AS sy_id,
                    school_years.school_year,
                    rooms.room_code,
                    rooms.room_description
                ')
                ->where('section_details.status', 1)
                // ->where('school_years.current', 1)
                ->where('class_details.id', $id)
                ->first();

            $Enrollment = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('users', 'users.id', '=', 'student_informations.user_id')
                ->where(function ($query) use ($request) {
                    if ($request->search_fn)
                    {
                        $query->where('student_informations.first_name', 'like', '%'.$request->search_fn.'%');
                    }

                    if ($request->search_mn)
                    {
                        $query->where('student_informations.middle_name', 'like', '%'.$request->search_mn.'%');
                    }

                    if ($request->search_ln)
                    {
                        $query->where('student_informations.last_name', 'like', '%'.$request->search_ln.'%');
                    }

                    if ($request->search_student_id)
                    {
                        $query->where('users.username', 'like', '%'.$request->search_student_id.'%');
                    }
                })
                // ->whereRaw('student_informations.id NOT IN ((SELECT  * from enrollments where enrollments.class_details_id = 3))')
                ->selectRaw("
                    student_informations.id AS student_id,
                    users.username,
                    student_informations.last_name, student_informations.first_name, student_informations.middle_name,
                    enrollments.id AS enrollment_id
                ")
                ->where('class_details_id', $id)
                ->orderByRaw('student_informations.last_name')
                ->where('enrollments.status', 1)
                // ->orWhere('first_name', 'like', '%'.$request->search.'%')
                ->paginate(70); //

                // return json_encode($StudentInformation);
            return view('control_panel_finance.student_list.partials.data_list_enrolled', 
                compact('Enrollment','ClassDetail'))->render();
            
        }
    }
}