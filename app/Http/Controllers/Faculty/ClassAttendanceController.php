<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassAttendanceController extends Controller
{
    public function index (Request $request)
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();

        $EnrollmentMale = \App\Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            ->whereRaw('class_details.adviser_id = '. $FacultyInformation->id)
            // ->whereRaw('enrollments.class_details_id = '. $class_id)
            ->whereRaw('student_informations.gender = 1')       
            ->select(\DB::raw("
                enrollments.id as e_id,
                enrollments.attendance,
                student_informations.id,
                users.username,
                CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name
            "))
            ->orderBY('student_name', 'ASC')
            ->get();

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

            // foreach($EnrollmentMale as $attendance)
            // {
            //     $attendance_data = json_decode($attendance->attendance);
            // }  
           

                if ($EnrollmentMale[0]->attendance) {
                    $attendance_data = json_decode($EnrollmentMale[0]->attendance);
                }  

            foreach($EnrollmentMale[0] as $attendance)
            {
                $student_attendance = [
                    'student_name'      => $EnrollmentMale[0]->student_name,
                    'attendance_data'   => $attendance_data,
                    'table_header'      => $table_header,
                    'days_of_school_total' => array_sum($attendance_data->days_of_school),
                    'days_present_total' => array_sum($attendance_data->days_present),
                    'days_absent_total' => array_sum($attendance_data->days_absent),
                    'times_tardy_total' => array_sum($attendance_data->times_tardy),
                ];
            } 
            // return json_encode(['student_attendance' => $student_attendance,]);
        return view('control_panel_faculty.student_attendance.index',compact('EnrollmentMale','student_attendance'))->render();
    }
}
