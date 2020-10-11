<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use App\StudentAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentAttendanceController extends Controller
{
    public function index(){

        $attendance = StudentAttendance::whereStatus(1)->paginate(10);

        
        return view('control_panel.student_attendance.index', compact('attendance'));
    }

    public function modal_data (Request $request) 
    {
        $attendance = NULL;
        
        if ($request->id)
        {
            $attendance = StudentAttendance::where('id', $request->id)->first();         
        }

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

            // if ($Enrollment->attendance) {
            //     $attendance_data = json_decode($Enrollment->attendance);
            // }

            $student_attendance = [
                // 'student_name'      => $Enrollment->student_name,
                'attendance_data'   => $attendance_data,
                'table_header'      => $table_header,
                'days_of_school_total' => array_sum($attendance_data->days_of_school),
                'days_present_total' => array_sum($attendance_data->days_present),
                'days_absent_total' => array_sum($attendance_data->days_absent),
                'times_tardy_total' => array_sum($attendance_data->times_tardy),
            ];
        return view('control_panel.student_attendance.partials.modal_data', compact('attendance','student_attendance'))->render();
    }
}