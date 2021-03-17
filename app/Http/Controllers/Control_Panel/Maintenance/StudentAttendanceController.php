<?php

namespace App\Http\Controllers\Control_Panel\Maintenance;

use App\Models\User;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\SectionDetail;
use App\Models\StudentAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendance = StudentAttendance::whereStatus(1)->paginate(5);

        $attendance_data = $attendance->map(function($item, $key) {

            $school_year = SchoolYear::whereId($item->school_year_id)->first();
            $attendance_data = json_decode($item->junior_attendance);
            $s1_attendance = json_decode($item->s1_attendance);
            $s2_attendance = json_decode($item->s2_attendance);

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
                       
            $data = [
                'attendance_data'   =>  $attendance_data,
                // 'table_header'      =>  $table_header,
                'school_year'       =>  $school_year->school_year,
                's1_attendance'     =>  $s1_attendance,
                's2_attendance'     =>  $s2_attendance,
                'status'            =>  $item->status,
                'id'                =>  $item->id,
                'is_applied'        =>  $item->is_applied,
                'school_year_id'    =>  $item->school_year_id,
            ];
            
            return $data;
        });
        // return json_encode($attendance_data);
        
        if($request->ajax()){            
            return view('control_panel.student_attendance.partials.data_list', compact('attendance','attendance_data'))->render();
        }
        return view('control_panel.student_attendance.index', compact('attendance','attendance_data'))->render();
    }

    public function modal_data (Request $request) 
    {

        $SchoolYear = SchoolYear::whereStatus(1)->orderBY('id', 'DESC')->get();

        $attendance = NULL;
        
        if ($request->id)
        {
            $attendance = StudentAttendance::where('id', $request->id)->first();         
        }            
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
                // ['key' => 'total',],
            ];
            $school_year = SchoolYear::where('current', 1)->where('status', 1)->first()->school_year;

            if('2020-2021' == $school_year)
            {
                $attendance_data = json_decode(json_encode([                    
                    'days_of_school' => [
                        0, 0, 0, 0, 0, 0, 0, 0, 0
                    ],
                    'days_present' => [
                        0, 0, 0, 0, 0, 0, 0, 0, 0
                    ],
                    'days_absent' => [
                        0, 0, 0, 0, 0, 0, 0, 0, 0
                    ],
                    'times_tardy' => [
                        0, 0, 0, 0, 0, 0, 0, 0, 0
                    ]
                ]));
            }
            else
            {
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
            }

            if($attendance)
            {
                $attendance_data = json_decode($attendance->junior_attendance);
            }            

            $student_attendance = [
                'attendance_data'   => $attendance_data,
                'table_header'      => $table_header,
            ];
        return view('control_panel.student_attendance.partials.modal_data', 
            compact('attendance','student_attendance','SchoolYear'))->render();
    }

    public function save_data(Request $request)
    {
            
        $rules = [
            'school_year' => 'required',
            'days_of_school' => 'required',
            'days_present' => 'required',
            'days_absent' => 'required',
            'times_tardy' => 'required'            
        ];

        $Validator = Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }
        try {            
            // $class_id = \Crypt::decrypt($request->c);
            // $enrollment_id = $request->enroll_id;
            foreach ($request->days_of_school as $i => $d)
            {
                $days_of_school[$i] = $d;
            }
            
            foreach ($request->days_present as $i => $d)
            {
                $days_present[$i] = $d;
            }

            foreach ($request->days_absent as $i => $d)
            {
                $days_absent[$i] = $d;
            }

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

            foreach ($request->days_of_school as $i => $d)
            {
                $days_of_school1[$i] = $d;
                if ($i == 4) {break;}
            }
            
            foreach ($request->days_present as $i => $d)
            {
                $days_present1[$i] = $d;
                if ($i == 4) {break;}
            }

            foreach ($request->days_absent as $i => $d)
            {
                $days_absent1[$i] = $d;
                if ($i == 4) {break;}
            }

            foreach ($request->times_tardy as $i => $d)
            {
                $times_tardy1[$i] = $d;
                if ($i == 4) {break;}
            }

            $s1_data = [
                'days_of_school' => $days_of_school1,
                'days_present'   => $days_present1,
                'days_absent'    => $days_absent1,
                'times_tardy'    => $times_tardy1
            ];

            foreach ($request->days_of_school as $i => $d)
            {
                if($i > 4){
                    $days_of_school2[$i] = $d;
                }
            }
           
            foreach ($request->days_present as $i => $d)
            {                
                if ($i > 4) {
                    $days_present2[$i] = $d;
                }
            }

            foreach ($request->days_absent as $i => $d)
            {
                if ($i > 4) {
                    $days_absent2[$i] = $d;
                }
            }

            foreach ($request->times_tardy as $i => $d)
            {
                if ($i > 4) {
                    $times_tardy2[$i] = $d;
                }
            }

            
            $s2_data = [
                'days_of_school' => $days_of_school2,
                'days_present'   => $days_present2,
                'days_absent'    => $days_absent2,
                'times_tardy'    => $times_tardy2
            ];
            

            if($request->id)
            {
                $student_attendance = StudentAttendance::whereId($request->id)->first();
            }
            else{
                $student_attendance = new StudentAttendance();
            }
            
            $student_attendance->junior_attendance = json_encode($attendance_data);
            $student_attendance->s1_attendance = json_encode($s1_data);
            $student_attendance->s2_attendance = json_encode($s2_data);
            $student_attendance->school_year_id = $request->school_year;
            $student_attendance->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Attendance successfully saved.',]);
            
        //    return json_encode([$request->all(), 'attendance_data' => json_encode($attendance_data), 'Enrollment' => $Enrollment]);
        }catch (Illuminate\Contracts\Encryption\DecryptException $e) {
            return "Invalid parameter";
        }
    }

    public function apply(Request $request)
    {
        $id = $request->id;
        $sy = $request->sy;

        $class_detail = ClassDetail::whereSchoolYearId($sy)->get();
        $attendance_data = StudentAttendance::where('id', $id)->first();
        $save_attendance = 0;
        try {
            foreach($class_detail as $data){
                $enrollment = Enrollment::whereClassDetailsId($data->id)->get();
                try {
                    foreach($enrollment as $data){
                        // echo $data->id.'<br/><br/>';
                        $setSchoolYear = Enrollment::find($data->id);
                        $setSchoolYear->attendance = $attendance_data->junior_attendance;
                        $setSchoolYear->attendance_first = $attendance_data->s1_attendance;
                        $setSchoolYear->attendance_second = $attendance_data->s2_attendance;
                        $setSchoolYear->save();
                    }
                } catch (\Throwable $th) {
                    return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.'.$th]);
                }
            }
                $attendance = StudentAttendance::whereId($request->id)->first();
                $attendance->is_applied = 1;
                $attendance->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully Applied. ']);
        } catch (\Throwable $th) {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.'.$th]);
        }
    }

    public function deactivate_data (Request $request) 
    {
        $SectionDetail = SectionDetail::where('id', $request->id)->first();

        if ($SectionDetail)
        {
            $SectionDetail->status = 0;
            $SectionDetail->current = 0;
            $SectionDetail->save();

            $User = User::where('id', $SectionDetail->user_id)->first();
            if ($User)
            {
                $User->status = 0;
                $User->save();
            }
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}