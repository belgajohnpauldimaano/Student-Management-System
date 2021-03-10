<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Semester;
use Barryvdh\DomPDF\PDF;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\ClassSubjectDetail;
use App\Models\FacultyInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\FacadesAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClassAttendanceController extends Controller
{
    public function index (Request $request)
    {
        $FacultyInformation = FacultyInformation::where('user_id', Auth::user()->id)->first();
        $school_year = SchoolYear::whereCurrent(1)->whereStatus(1)->first();
        $sem = Semester::whereCurrent(1)->first();

        $has_schoolyear = ClassDetail::whereStatus(1)
            ->whereAdviserId($FacultyInformation->id)
            ->whereSchoolYearId($school_year->id)
            ->first();
        // return json_encode($has_schoolyear);

        if(empty($has_schoolyear)){
            $hasData = 1;
            return view('control_panel_faculty.student_attendance.index', 
                compact('hasData'))->render();
        }
            
        $query = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $school_year->id)
            ->where('class_details.status', 1)
            ->select(\DB::raw('
                    section_details.section,
                    class_details.id,
                    class_details.section_id,
                    class_details.grade_level,
                    class_subject_details.status as grading_status,
                    class_subject_details.sem
            '));

        if($has_schoolyear->grade_level > 10)
        {
            $query->where('class_subject_details.sem', $sem->id);
        }
        
        $Semester = $query->first();

        // return json_encode($Semester);

        try {
            
            $class_id = ClassDetail::where('adviser_id', $FacultyInformation->id)
                ->where('school_year_id', $school_year->id)
                ->where('adviser_id', $FacultyInformation->id)
                ->whereStatus(1)
                ->whereCurrent(1)
                ->first()->id;

            
            $attendance_male = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                ->where('class_details_id', $class_id)
                ->where('class_details.school_year_id', $school_year->id)
                ->where('class_details.adviser_id', $FacultyInformation->id)
                ->whereRaw('student_informations.gender = 1')
                ->whereRaw('enrollments.status = 1')
                ->select(\DB::raw("
                        enrollments.id as e_id,
                        enrollments.attendance,
                        enrollments.attendance_first,
                        enrollments.attendance_second,
                        student_informations.id,
                        CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
                    "))
                ->orderBY('student_name', 'ASC')
                ->get();

            // return json_encode($attendance_male);
        
            $attendance_female = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                ->where('class_details_id', $class_id)
                ->where('class_details.school_year_id', $school_year->id)
                ->where('class_details.adviser_id', $FacultyInformation->id)
                ->whereRaw('student_informations.gender = 2')
                ->whereRaw('enrollments.status = 1')
                ->select(\DB::raw("
                        enrollments.id as e_id,
                        enrollments.attendance,
                        enrollments.attendance_first,
                        enrollments.attendance_second,
                        student_informations.id,
                        CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
                    "))
                ->orderBY('student_name', 'ASC')
                ->get();

            if('2020-2021' == $school_year->school_year)
            {
                    if($Semester->grade_level > 10)
                    {
                        if($Semester->sem == 1)
                        {
                            $table_header = [
                                ['key' => 'Aug',],
                                ['key' => 'Sep',],
                                ['key' => 'Oct',],
                                ['key' => 'Nov',],
                                ['key' => 'Dec',],
                                ['key' => 'total']
                            ];      
                        }

                        if($Semester->sem == 2)
                        {
                            $table_header = [
                                ['key' => 'Jan',],
                                ['key' => 'Feb',],
                                ['key' => 'Mar',],
                                ['key' => 'Apr',],
                                ['key' => 'total']
                            ];      
                        }

                    }
                    
                    if($Semester->grade_level < 11)
                    {
                        $table_header = [
                            ['key' => 'Aug',],
                            ['key' => 'Sep',],
                            ['key' => 'Oct',],
                            ['key' => 'Nov',],
                            ['key' => 'Dec',],
                            ['key' => 'Jan',],
                            ['key' => 'Feb',],
                            ['key' => 'Mar',],
                            ['key' => 'Apr',],
                            ['key' => 'total'],
                        ];      
                    }                    
                }
                else
                {
                    if($Semester->grade_level > 10)
                    {
                        if($Semester->sem == 1)
                        {
                            $table_header = [
                                ['key' => 'Jun',],
                                ['key' => 'Jul',],
                                ['key' => 'Aug',],
                                ['key' => 'Sep',],
                                ['key' => 'Oct',],
                                ['key' => 'total'],
                            ];      
                        }

                        if($Semester->sem == 2)
                        {
                            $table_header = [
                                ['key' => 'Nov',],
                                ['key' => 'Dec',],
                                ['key' => 'Jan',],
                                ['key' => 'Feb',],
                                ['key' => 'Mar',],
                                ['key' => 'Apr',],
                                ['key' => 'total'],
                            ];      
                        }

                    }

                    if($Semester->grade_level < 11)
                    {
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
                            ['key' => 'total'],
                        ];      
                    }
                    
            }
            
            $attendance_male = $attendance_male->map(function($item, $key) use ($table_header,$Semester){
                
                if($Semester->grade_level > 10)
                {
                    if($Semester->sem == 1)
                    {
                        $attendance_data = json_decode($item->attendance_first);
                    }

                    if($Semester->sem == 2)
                    {
                        $attendance_data = json_decode($item->attendance_second);
                    }

                }
                if($Semester->grade_level < 11)
                {
                    $attendance_data = json_decode($item->attendance);
                }

                $data = [
                    'table_header'          =>  $table_header,
                    'student_name'          =>  $item->student_name,
                    'attendance_data'       =>  $attendance_data,
                    'status'                =>  $item->status,
                    'id'                    =>  $item->id,
                    'days_of_school_total'  => array_sum($attendance_data->days_of_school),
                    'days_present_total'    => array_sum($attendance_data->days_present),
                    'days_absent_total'     => array_sum($attendance_data->days_absent),
                    'times_tardy_total'     => array_sum($attendance_data->times_tardy),
                    'e_id'                  => $item->e_id,
                ];
                
                return $data;
            });
            
            $attendance_female = $attendance_female->map(function($item, $key) use ($table_header,$Semester){
                
                if($Semester->grade_level > 10)
                {
                    if($Semester->sem == 1)
                    {
                        $attendance_data = json_decode($item->attendance_first);
                    }

                    if($Semester->sem == 2)
                    {
                        $attendance_data = json_decode($item->attendance_second);
                    }

                }
                if($Semester->grade_level < 11)
                {
                    $attendance_data = json_decode($item->attendance);
                }
                $data = [
                    'table_header'          =>  $table_header,
                    'student_name'          =>  $item->student_name,
                    'attendance_data'       =>  $attendance_data,
                    'status'                =>  $item->status,
                    'id'                    =>  $item->id,
                    'days_of_school_total'  => array_sum($attendance_data->days_of_school),
                    'days_present_total'    => array_sum($attendance_data->days_present),
                    'days_absent_total'     => array_sum($attendance_data->days_absent),
                    'times_tardy_total'     => array_sum($attendance_data->times_tardy),
                    'e_id'                  => $item->e_id,
                ];
                
                return $data;
            });

            $hasData = 0;
            // $attendance_male = json_decode(json_encode($attendance_male, true));
            return view('control_panel_faculty.student_attendance.index', 
                compact('attendance_male','attendance_female','Semester','class_id','hasData'))->render();
                
        } catch (\Throwable $th) {
            //throw $th;
            $hasData = 1;
            return view('control_panel_faculty.student_attendance.index', 
                compact('hasData'))->render();
        }
        
    }

    public function print_attendance(Request $request)
    {
        $FacultyInformation = FacultyInformation::where('user_id', Auth::user()->id)->first();
        $school_year = SchoolYear::whereCurrent(1)->whereStatus(1)->first();
        
        $Semester = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $school_year->id)
            ->where('class_details.status', 1)
            ->select(\DB::raw('
                    section_details.section,
                    class_details.id,
                    class_details.section_id,
                    class_details.grade_level,
                    class_subject_details.status as grading_status,
                    class_subject_details.sem
            '))
            ->first();

        $class_id = ClassDetail::where('adviser_id', $FacultyInformation->id)
            ->where('school_year_id', $school_year->id)
            ->where('adviser_id', $FacultyInformation->id)
            ->whereStatus(1)
            ->whereCurrent(1)
            ->first()->id;            

        
        $attendance_male = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->where('class_details_id', $class_id)
            ->where('class_details.school_year_id', $school_year->id)
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->whereRaw('student_informations.gender = 1')
            ->select(\DB::raw("
                    enrollments.id as e_id,
                    enrollments.attendance,
                    enrollments.attendance_first,
                    enrollments.attendance_second,
                    student_informations.id,
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
                "))
            ->orderBY('student_name', 'ASC')
            ->get();
    
        $attendance_female = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->where('class_details_id', $class_id)
            ->where('class_details.school_year_id', $school_year->id)
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->whereRaw('student_informations.gender = 2')
            ->select(\DB::raw("
                    enrollments.id as e_id,
                    enrollments.attendance,
                    enrollments.attendance_first,
                    enrollments.attendance_second,
                    student_informations.id,
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
                "))
            ->orderBY('student_name', 'ASC')
            ->get();

        if('2020-2021' == $school_year->school_year)
        {
                if($Semester->grade_level > 10)
                {
                    if($Semester->sem == 1)
                    {
                        $table_header = [
                            ['key' => 'Aug',],
                            ['key' => 'Sep',],
                            ['key' => 'Oct',],
                            ['key' => 'Nov',],
                            ['key' => 'Dec',],
                            ['key' => 'total']
                        ];      
                    }

                    if($Semester->sem == 2)
                    {
                        $table_header = [
                            ['key' => 'Jan',],
                            ['key' => 'Feb',],
                            ['key' => 'Mar',],
                            ['key' => 'Apr',],
                            ['key' => 'total']
                        ];      
                    }

                }
                
                if($Semester->grade_level < 11)
                {
                    $table_header = [
                        ['key' => 'Aug',],
                        ['key' => 'Sep',],
                        ['key' => 'Oct',],
                        ['key' => 'Nov',],
                        ['key' => 'Dec',],
                        ['key' => 'Jan',],
                        ['key' => 'Feb',],
                        ['key' => 'Mar',],
                        ['key' => 'Apr',],
                        ['key' => 'total'],
                    ];      
                }

                
            }
            else
            {
                if($Semester->grade_level > 10)
                {
                    if($Semester->sem == 1)
                    {
                        $table_header = [
                            ['key' => 'Jun',],
                            ['key' => 'Jul',],
                            ['key' => 'Aug',],
                            ['key' => 'Sep',],
                            ['key' => 'Oct',],
                            ['key' => 'total'],
                        ];      
                    }

                    if($Semester->sem == 2)
                    {
                        $table_header = [
                            ['key' => 'Nov',],
                            ['key' => 'Dec',],
                            ['key' => 'Jan',],
                            ['key' => 'Feb',],
                            ['key' => 'Mar',],
                            ['key' => 'Apr',],
                            ['key' => 'total'],
                        ];      
                    }

                }

                if($Semester->grade_level < 11)
                {
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
                        ['key' => 'total'],
                    ];      
                }
                
        }
        
        $attendance_male = $attendance_male->map(function($item, $key) use ($table_header,$Semester){
            
            if($Semester->grade_level > 10)
            {
                if($Semester->sem == 1)
                {
                    $attendance_data = json_decode($item->attendance_first);
                }

                if($Semester->sem == 2)
                {
                    $attendance_data = json_decode($item->attendance_second);
                }

            }
            if($Semester->grade_level < 11)
            {
                $attendance_data = json_decode($item->attendance);
            }

            $data = [
                'table_header'          =>  $table_header,
                'student_name'          =>  $item->student_name,
                'attendance_data'       =>  $attendance_data,
                'status'                =>  $item->status,
                'id'                    =>  $item->id,
                'days_of_school_total'  => array_sum($attendance_data->days_of_school),
                'days_present_total'    => array_sum($attendance_data->days_present),
                'days_absent_total'     => array_sum($attendance_data->days_absent),
                'times_tardy_total'     => array_sum($attendance_data->times_tardy),
                'e_id'                  => $item->e_id,
            ];
            
            return $data;
        });
        
        $attendance_female = $attendance_female->map(function($item, $key) use ($table_header,$Semester){
            
            if($Semester->grade_level > 10)
            {
                if($Semester->sem == 1)
                {
                    $attendance_data = json_decode($item->attendance_first);
                }

                if($Semester->sem == 2)
                {
                    $attendance_data = json_decode($item->attendance_second);
                }

            }
            if($Semester->grade_level < 11)
            {
                $attendance_data = json_decode($item->attendance);
            }
            $data = [
                'table_header'          =>  $table_header,
                'student_name'          =>  $item->student_name,
                'attendance_data'       =>  $attendance_data,
                'status'                =>  $item->status,
                'id'                    =>  $item->id,
                'days_of_school_total'  => array_sum($attendance_data->days_of_school),
                'days_present_total'    => array_sum($attendance_data->days_present),
                'days_absent_total'     => array_sum($attendance_data->days_absent),
                'times_tardy_total'     => array_sum($attendance_data->times_tardy),
                'e_id'                  => $item->e_id,
            ];
            
            return $data;
        });
        // $attendance_male = json_decode(json_encode($attendance_male, true));
        return view('control_panel_faculty.student_attendance.partials.print', 
            compact('attendance_male','attendance_female','Semester','class_id','school_year'))->render();

        $pdf = \PDF::loadView('control_panel_faculty.student_attendance.partials.print', 
            compact('attendance_male','attendance_female','Semester','class_id','school_year'));
            $pdf->setPaper('Legal', 'portrait');
            return $pdf->stream();
       
    }

    public function save_attendance(Request $request) 
    {
        $class_id = ClassDetail::whereId(Crypt::decrypt($request->class_id))->first();
        $school_year = SchoolYear::whereCurrent(1)->whereStatus(1)->first();
        $sem = Semester::whereCurrent(1)->first();
        $FacultyInformation = FacultyInformation::where('user_id', Auth::user()->id)->first();

        $Semester = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $class_id->school_year_id)
            ->where('class_details.status', 1)
            ->where('class_subject_details.sem', $sem->id)
            ->select(\DB::raw('
                    section_details.section,
                    class_details.id,
                    class_details.section_id,
                    class_details.grade_level,
                    class_subject_details.status as grading_status,
                    class_subject_details.sem
            '))
            ->first();
        // return json_encode($Semester);
        try {            
            if('2020-2021' == $school_year->school_year){
                if($class_id->grade_level > 10)
                {
                    if($Semester->sem == 1)
                    {
                        $days_of_school = [
                            0, 0, 0, 0, 0,
                        ];
                        foreach ($request->days_of_school as $i => $d)
                        {
                            $days_of_school[$i] = $d;
                        }
                        
                        $days_present = [
                            0, 0, 0, 0, 0,
                        ];
                        foreach ($request->days_present as $i => $d)
                        {
                            $days_present[$i] = $d;
                        }

                        $days_absent = [
                            0, 0, 0, 0, 0,
                        ];
                        foreach ($request->days_absent as $i => $d)
                        {
                            $days_absent[$i] = $d;
                        }

                        $times_tardy = [
                            0, 0, 0, 0, 0,
                        ];
                        foreach ($request->times_tardy as $i => $d)
                        {
                            $times_tardy[$i] = $d;
                        }
                    }

                    if($Semester->sem == 2)
                    {
                        $days_of_school = [
                            0, 0, 0, 0,
                        ];
                        foreach ($request->days_of_school as $i => $d)
                        {
                            $days_of_school[$i] = $d;
                        }
                        
                        $days_present = [
                            0, 0, 0, 0,
                        ];
                        foreach ($request->days_present as $i => $d)
                        {
                            $days_present[$i] = $d;
                        }

                        $days_absent = [
                            0, 0, 0, 0, 
                        ];
                        foreach ($request->days_absent as $i => $d)
                        {
                            $days_absent[$i] = $d;
                        }

                        $times_tardy = [
                            0, 0, 0, 0,
                        ];
                        foreach ($request->times_tardy as $i => $d)
                        {
                            $times_tardy[$i] = $d;
                        }
                    }
                }

                if($class_id->grade_level < 11)
                {
                    $days_of_school = [
                        0, 0, 0, 0, 0, 0, 0, 0, 0
                    ];
                    foreach ($request->days_of_school as $i => $d)
                    {
                        $days_of_school[$i] = $d;
                    }
                    
                    $days_present = [
                        0, 0, 0, 0, 0, 0, 0, 0, 0
                    ];
                    foreach ($request->days_present as $i => $d)
                    {
                        $days_present[$i] = $d;
                    }

                    $days_absent = [
                        0, 0, 0, 0, 0, 0, 0, 0, 0
                    ];
                    foreach ($request->days_absent as $i => $d)
                    {
                        $days_absent[$i] = $d;
                    }

                    $times_tardy = [
                        0, 0, 0, 0, 0, 0, 0, 0, 0
                    ];
                    foreach ($request->times_tardy as $i => $d)
                    {
                        $times_tardy[$i] = $d;
                    }

                }
                
            }else{

                if($class_id->grade_level > 10)
                {
                    if($Semester->sem == 1)
                    {
                        $days_of_school = [
                            0, 0, 0, 0, 0,
                        ];
                        foreach ($request->days_of_school as $i => $d)
                        {
                            $days_of_school[$i] = $d;
                        }
                        
                        $days_present = [
                            0, 0, 0, 0, 0,
                        ];
                        foreach ($request->days_present as $i => $d)
                        {
                            $days_present[$i] = $d;
                        }

                        $days_absent = [
                            0, 0, 0, 0, 0,
                        ];
                        foreach ($request->days_absent as $i => $d)
                        {
                            $days_absent[$i] = $d;
                        }

                        $times_tardy = [
                            0, 0, 0, 0, 0,
                        ];
                        foreach ($request->times_tardy as $i => $d)
                        {
                            $times_tardy[$i] = $d;
                        }
                    }

                    if($Semester->sem == 2)
                    {
                        $days_of_school = [
                            0, 0, 0, 0, 0, 0,
                        ];
                        foreach ($request->days_of_school as $i => $d)
                        {
                            $days_of_school[$i] = $d;
                        }
                        
                        $days_present = [
                            0, 0, 0, 0, 0, 0,
                        ];
                        foreach ($request->days_present as $i => $d)
                        {
                            $days_present[$i] = $d;
                        }

                        $days_absent = [
                            0, 0, 0, 0, 0, 0, 
                        ];
                        foreach ($request->days_absent as $i => $d)
                        {
                            $days_absent[$i] = $d;
                        }

                        $times_tardy = [
                            0, 0, 0, 0, 0, 0,
                        ];
                        foreach ($request->times_tardy as $i => $d)
                        {
                            $times_tardy[$i] = $d;
                        }
                    }
                }

                if($class_id->grade_level < 11)
                {
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

                }
            }

            $enrollment_id = $request->enroll_id;
            // return json_encode($enrollment_id);
            
            $attendance_data = [
                'days_of_school' => $days_of_school,
                'days_present' => $days_present,
                'days_absent' => $days_absent,
                'times_tardy' => $times_tardy
            ];

            // return json_encode($attendance_data);

            $Enrollment = Enrollment::whereId($enrollment_id)->first();

            // return json_encode($Enrollment);
            
            if($class_id->grade_level < 11)
            {
                $Enrollment->attendance = json_encode($attendance_data);
            }

            if($class_id->grade_level > 10)
            {
                if($Semester->sem == 1)
                {
                    $Enrollment->attendance_first = json_encode($attendance_data);
                }

                if($Semester->sem == 2)
                {
                    $Enrollment->attendance_second = json_encode($attendance_data);
                }
            }

            // return json_encode($Enrollment->attendance_first);

            $Enrollment->save();
            
            return response()->json(['res_code' => 0, 'res_msg' => 'Attendance successfully saved.',]);
            
        }
            catch (Illuminate\Contracts\Encryption\DecryptException $e) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Attendance has a problem.',]);
        }
    }

    
}