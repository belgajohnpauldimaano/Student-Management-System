<?php

namespace App\Http\Controllers\Control_Panel;

use App\Models\User;
use App\Traits\HasUser;
use App\Models\DateRemark;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\StudentInformation;
use App\Traits\hasIncomingStudents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentEnrolledSubject;

class StudentController extends Controller
{
    use hasIncomingStudents, HasUser;
    
    public function index (Request $request) 
    {
        $IncomingStudentCount = $this->IncomingStudentCount();
        $isAdmin = $this->isAdmin();

        $StudentInformation = StudentInformation::with(['user', 'enrolled_class'])
            ->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%'.$request->search.'%');
                $query->orWhere('middle_name', 'like', '%'.$request->search.'%');
                $query->orWhere('last_name', 'like', '%'.$request->search.'%');
            })
            ->orderBY('last_name', 'ASC')
            ->paginate(10);

        if($request->ajax())
        {
            return view('control_panel.student_information.partials.data_list', compact('StudentInformation','isAdmin'))->render();
        }

        // return json_encode(['student_info' => $StudentInformation]);
        return view('control_panel.student_information.index', compact('StudentInformation','IncomingStudentCount','isAdmin'));
    }

    public function modal_data (Request $request) 
    {
        $StudentInformation = NULL;
        $Profile = StudentInformation::where('id', $request->id)->first(); 
        if ($request->id)
        {
            $StudentInformation = StudentInformation::with(['user'])->where('id', $request->id)->first();   
            // $Profile = StudentInformation::where('id', $request->id)->first();   
            // return view('control_panel.student_information.partials.modal_data', compact('StudentInformation','Profile'))->render(); 
            // return view('control_panel.student_information.partials.modal_data', compact('StudentInformation'))->render()        
        }

        return view('control_panel.student_information.partials.modal_data', compact('StudentInformation','Profile'))->render();  
    	// return view('profile', array('user' => Auth::user()) );
        
    }

 

    public function change_my_photo (Request $request)
    {
        $name = time().'.'.$request->user_photo->getClientOriginalExtension();
        $destinationPath = public_path('/img/account/photo/');
        $request->user_photo->move($destinationPath, $name);

    //    / $User = \Auth::user();
        if($request->id)
        {
            $Profile = StudentInformation::where('id', $request->id)->first();

            if ($Profile->photo) 
            {
                $delete_photo = public_path('/img/account/photo/'. $Profile->photo);
                if (\File::exists($delete_photo)) 
                {
                    \File::delete($delete_photo);
                }
            }
    
            $Profile->photo = $name;
    
            if ($Profile->save())
            {
                return response()->json(['res_code' => 0, 'res_msg' => 'User photo successfully updated.']);
            }
            else 
            {
                return response()->json(['res_code' => 1, 'res_msg' => 'Error in saving photo']);
            }
            
            return json_encode($request->all());
        }
        
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'username' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gender'    => 'required',
        ];
        
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        if ($request->id)
        {
            $StudentInformation = StudentInformation::where('id', $request->id)->first();
            
            $User = User::where('username', $request->username)->where('id', '!=', $StudentInformation->user_id)->first();
            if ($User) 
            {
                return response()->json(['res_code' => 1,'res_msg' => 'Username already used.']);
            }
            $User = User::where('id', $StudentInformation->user_id)->first();
            $User->username = $request->username;
            $User->save();

            $StudentInformation->first_name     = $request->first_name;
            $StudentInformation->middle_name    = $request->middle_name;
            $StudentInformation->last_name      = $request->last_name;
            $StudentInformation->c_address      = $request->address;
            $StudentInformation->age_june       = $request->age_june;
            $StudentInformation->age_may        = $request->age_may;
            $StudentInformation->birthdate      = $request->birthdate ? date('Y-m-d', strtotime($request->birthdate)) : NULL;
            $StudentInformation->gender         = $request->gender;
            $StudentInformation->guardian       = $request->guardian;
            $StudentInformation->email          = $request->email;
            $StudentInformation->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $User = User::where('username', $request->username)->first();
        if ($User) 
        {
            return response()->json(['res_code' => 1,'res_msg' => 'Username already used.']);
        }
        
        $User = new User();
        $User->username = $request->username;
        $User->password = bcrypt($request->first_name . '.' . $request->last_name);
        $User->role     = 5;
        $User->save();

        $StudentInformation                 = new StudentInformation();
        $StudentInformation->first_name     = $request->first_name;
        $StudentInformation->middle_name    = $request->middle_name;
        $StudentInformation->last_name      = $request->last_name;
        $StudentInformation->c_address      = $request->address;
        $StudentInformation->age_june       = $request->age_june;
        $StudentInformation->age_may        = $request->age_may;
        $StudentInformation->birthdate      = date('Y-m-d', strtotime($request->birthdate));
        $StudentInformation->gender         = $request->gender;
        $StudentInformation->guardian       = $request->guardian;
        $StudentInformation->email          = $request->email;
        $StudentInformation->user_id        = $User->id;
        $StudentInformation->save();
        
        
    }
    public function deactivate_data (Request $request) 
    {
        $StudentInformation = StudentInformation::where('id', $request->id)->first();

        if ($StudentInformation)
        {
            $StudentInformation->status = 0;
            $StudentInformation->save();

            $User = User::where('id', $StudentInformation->user_id)->first();
            if ($User)
            {
                $User->status = 0;
                $User->save();
            }
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function activate_data (Request $request) 
    {
        $StudentInformation = StudentInformation::where('id', $request->id)->first();

        if ($StudentInformation)
        {
            $StudentInformation->status = 1;
            $StudentInformation->save();

            $User = User::where('id', $StudentInformation->user_id)->first();
            if ($User)
            {
                $User->status = 1;
                $User->save();
            }
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully Activated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function print_student_grade_modal (Request $request) 
    {
        
        $Enrollment = Enrollment::where('student_information_id', $request->id)
            ->join('class_details','class_details.id', '=','enrollments.class_details_id')
            ->join('school_years','school_years.id', '=','class_details.school_year_id')
            ->selectRaw('
                enrollments.id AS e_id,
                class_details.id AS c_id,
                school_years.id AS sy_id,
                enrollments.student_information_id AS student_id,
                school_years.school_year AS sy
                ')
            ->get();
        $student_id = $request->id;        
        
        return view('control_panel.student_information.partials.print_individual_grade', compact('Enrollment', 'student_id'));
    }

    public function getSemester(Request $request)
    {
        try {
            $class_details_grade = ClassDetail::where('id', $request->print_sy)
                ->first();

            if($class_details_grade->grade_level > 10){
                
                $semester = '<label>Select Semester</label>';
                $semester .= '<select name="semester" id="semester" class="form-control">';
                $semester .='<option value="0">Select Semester</option>';
                $semester .= '<option value="1">First Semester</option>';
                $semester .= '<option value="2">Second Semester</option>';
                $semester .= '</select>';
                return $semester;
            }
            
        } catch (\Throwable $th) {
            return '<div class="box-body"><div class="row"><table class="table"><tbody><tr><th style="text-align:center"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.</th></tr></tbody></table></div></div>';
        }
        
    }
    
    public function print_student_grades (Request $request)
    {
        if (!$request->id || !$request->cid) 
        {
            return "Invalid request";
        }

        $semester = $request->semester;

        $StudentInformation = StudentInformation::with(['user'])->where('id', $request->id)->first();
        
        try {
            if ($StudentInformation) 
            {
                $ClassDetail = ClassDetail::with('section')->whereId($request->cid)->whereStatus(1)->first();
                 
                // return json_encode($ClassDetail->schoolYear->school_year);
                $DateRemarks = DateRemark::where('school_year_id', $ClassDetail->school_year_id)->first();
                
                $Signatory = ClassDetail::with('student_enrollment')
                    ->where('school_year_id', $ClassDetail->school_year_id)
                    ->whereHas('student_enrollment', function ($query) use ($StudentInformation) {
                        $query->where('student_information_id', $StudentInformation->id);
                    })
                    ->whereStatus(1)
                    ->first();

                // return json_encode($Signatory->adviser->e_signature);
                
                
                // $Enrollment = Enrollment::with('classDetail','faculty','section','subject')
                //     // ->whereHas('class_subjects', function ($query) use ($ClassDetail) {
                //     //     $query->where('school_year_id', $ClassDetail->school_year_id);
                //     // })                    
                //     ->where('student_information_id', $StudentInformation->id)
                //     ->whereStatus(1)
                //     ->get();

                // $Enrollment = ClassDetail::with('student_enrollment','class_subjects','faculty')
                //     ->where('school_year_id', $ClassDetail->school_year_id)
                //     ->whereHas('student_enrollment', function ($query) use ($StudentInformation) {
                //         $query->where('student_information_id', $StudentInformation->id);
                //     })
                //     ->whereStatus(1)
                //     ->first();

                // return json_encode($Enrollment);

                if($semester==1 || $semester==2) 
                {
                      $Enrollment = Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                        ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
                        ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
                        ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
                        ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                        ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
                        ->where('student_information_id', $StudentInformation->id)
                        ->where('class_subject_details.status', '!=', 0)
                        ->where('enrollments.status', 1)
                        ->where('class_details.status', 1)
                        ->where('class_details.school_year_id', $ClassDetail->school_year_id)
                        ->where('class_subject_details.sem', $semester)
                        ->select(\DB::raw("
                            enrollments.id as enrollment_id,
                            enrollments.j_lacking_unit,
                            enrollments.s1_lacking_unit,
                            enrollments.s2_lacking_unit,
                            enrollments.eligible_transfer,
                            enrollments.attendance,
                            enrollments.attendance_first,enrollments.attendance_second,
                            class_details.grade_level,
                            class_subject_details.id as class_subject_details_id,
                            class_subject_details.class_days,
                            class_subject_details.class_time_from,
                            class_subject_details.class_time_to,
                            class_subject_details.status as grade_status,
                            CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                            faculty_informations.e_signature,
                            subject_details.id AS subject_id,
                            subject_details.subject_code,
                            subject_details.subject,
                            rooms.room_code,
                            section_details.section,
                            class_details.school_year_id as school_year_id
                        "))
                        ->orderBy('class_subject_details.class_subject_order', 'ASC')
                        ->get();    
                        
                        // return json_encode($Enrollment);
                }
                else
                {
                    $Enrollment = Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                    ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
                    ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
                    ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
                    ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                    ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
                    ->where('student_information_id', $StudentInformation->id)
                    ->where('class_subject_details.status', '!=', 0)
                    ->where('enrollments.status', 1)
                    ->where('class_details.status', 1)
                    ->where('class_details.school_year_id', $ClassDetail->school_year_id)
                    ->select(\DB::raw("
                        enrollments.id as enrollment_id,
                        enrollments.j_lacking_unit,
                        enrollments.s1_lacking_unit,
                        enrollments.s2_lacking_unit,
                        enrollments.eligible_transfer,
                        enrollments.attendance,
                        enrollments.attendance_first,enrollments.attendance_second,
                        class_details.grade_level,
                        class_subject_details.id as class_subject_details_id,
                        class_subject_details.class_days,
                        class_subject_details.class_time_from,
                        class_subject_details.class_time_to,
                        class_subject_details.status as grade_status,
                        CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                        faculty_informations.e_signature,
                        subject_details.id AS subject_id,
                        subject_details.subject_code,
                        subject_details.subject,
                        rooms.room_code,
                        section_details.section,
                        class_details.school_year_id as school_year_id
                    "))
                    ->orderBy('class_subject_details.class_subject_order', 'ASC')
                    ->get();
                }

                $SchoolYear = SchoolYear::whereId($ClassDetail->school_year_id)
                    ->first();

                if('2020-2021' == $SchoolYear->school_year)
                {    
                    if($Enrollment[0]->grade_level > 10)
                    {     
                        if($semester == 1)
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
                        
                        if($semester == 2)
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
                                
                    if($Enrollment[0]->grade_level < 11)
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

                    if($Enrollment[0]->grade_level > 10)
                    {
                        
                        if($semester == 1)
                        {
                            $attendance_data = json_decode(json_encode([
                                'days_of_school' => [
                                    0, 0, 0, 0, 0, 
                                ],
                                'days_present' => [
                                    0, 0, 0, 0, 0,
                                ],
                                'days_absent' => [
                                    0, 0, 0, 0, 0,
                                ],
                                'times_tardy' => [
                                    0, 0, 0, 0, 0, 
                                ]
                            ]));
                        }

                        if($semester == 2)
                        {
                            $attendance_data = json_decode(json_encode([
                                'days_of_school' => [
                                    0, 0, 0, 0, 
                                ],
                                'days_present' => [
                                    0, 0, 0, 0, 
                                ],
                                'days_absent' => [
                                    0, 0, 0, 0, 
                                ],
                                'times_tardy' => [
                                    0, 0, 0, 0, 
                                ]
                            ]));
                        }
                    }

                    if($Enrollment[0]->grade_level < 11)
                    {
                        $attendance_data = json_decode(json_encode([
                            'days_of_school' => [
                                0, 0, 0, 0, 0, 0, 0, 0, 0,
                            ],
                            'days_present' => [
                                0, 0, 0, 0, 0, 0, 0, 0, 0,
                            ],
                            'days_absent' => [
                                0, 0, 0, 0, 0, 0, 0, 0, 0,
                            ],
                            'times_tardy' => [
                                0, 0, 0, 0, 0, 0, 0, 0, 0,
                            ]
                        ]));
                    }
                }
                else
                {   
                    if($SchoolYear->id == 9){                        
                        if($Enrollment[0]->grade_level > 10)
                        {
                            if($semester == 1)
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
                            
                            if($semester == 2)
                            {    
                                $table_header = [
                                    ['key' => 'Nov',],
                                    ['key' => 'Dec',],
                                    ['key' => 'Jan',],
                                    ['key' => 'Feb',],
                                    ['key' => 'Mar*',],
                                    ['key' => 'Apr*',],
                                    ['key' => 'total'],
                                ];
                            }      
                        }
                        
                        if($Enrollment[0]->grade_level < 11)
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
                                ['key' => 'Mar*',],
                                ['key' => 'Apr*',],
                                ['key' => 'total',],
                            ];
                        }
                    }else{

                        if($Enrollment[0]->grade_level > 10)
                        {
                            if($semester == 1)
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

                            if($semester == 2)
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
                        
                        if($Enrollment[0]->grade_level < 11)
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
                                ['key' => 'total',],
                            ];
                        }
                    }   
                    
                    if($Enrollment[0]->grade_level > 10)
                    {
                        
                        if($semester == 1)
                        {
                            $attendance_data = json_decode(json_encode([
                                'days_of_school' => [
                                    0, 0, 0, 0, 0, 0,  
                                ],
                                'days_present' => [
                                    0, 0, 0, 0, 0, 0, 
                                ],
                                'days_absent' => [
                                    0, 0, 0, 0, 0, 0, 
                                ],
                                'times_tardy' => [
                                    0, 0, 0, 0, 0, 0,
                                ]
                            ]));
                        }

                        if($semester == 2)
                        {
                            $attendance_data = json_decode(json_encode([
                                'days_of_school' => [
                                    0, 0, 0, 0, 0, 0, 0 
                                ],
                                'days_present' => [
                                    0, 0, 0, 0, 0, 0, 0
                                ],
                                'days_absent' => [
                                    0, 0, 0, 0, 0, 0, 0
                                ],
                                'times_tardy' => [
                                    0, 0, 0, 0, 0, 0, 0
                                ]
                            ]));
                        }
                    }

                    if($Enrollment[0]->grade_level < 11)
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
                }
                
                $GradeSheetData = [];
                $grade_level = 1;
                $sub_total = 0;
                $general_avg = 0;
                $subj_count = 0;
                $grade_status = $Enrollment[0]->grade_status;
                
                // return json_encode(['c' => count($Enrollment),'Enrollment' => $Enrollment,'StudentInformation' => $StudentInformation, ]);
                if ($StudentInformation && count($Enrollment)>0)
                {
                    $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                        ->get();

                    $grade_level = $Enrollment[0]->grade_level;
                    if ($Enrollment[0]->attendance) {
                        if($Enrollment[0]->grade_level > 10)
                        {
                            
                            if($semester == 1)
                            {
                                $attendance_data = json_decode($Enrollment[0]->attendance_first);
                            }

                            if($semester == 2)
                            {
                                $attendance_data = json_decode($Enrollment[0]->attendance_second);
                            }
                        }
                        if($Enrollment[0]->grade_level < 11)
                        { 
                            $attendance_data = json_decode($Enrollment[0]->attendance);
                        }
                    }
                    // return json_encode(['a' => $StudentEnrolledSubject->count(), 'b' => $Enrollment->count(), 'StudentEnrolledSubject'=> $StudentEnrolledSubject, 'Enrollment' => $Enrollment]);
                    $GradeSheetData = $Enrollment->map(function ($item, $key) use ($StudentEnrolledSubject, $grade_level, $grade_status, $semester) {
                        // $grade = $StudentEnrolledSubject->firstWhere('subject_id', $item->subject_id);
                        $grade = $StudentEnrolledSubject->firstWhere('class_subject_details_id', $item->class_subject_details_id);

                        $sum = 0;
                        $divisor = 0;

                        if($item->grade_level < 11)
                        {
                            
                            $first = $grade->fir_g > 0 ? $grade->fir_g : 0;
                            $second = $grade->sec_g > 0 ? $grade->sec_g : 0;
                            $third = $grade->thi_g > 0 ? $grade->thi_g : 0;
                            $fourth = $grade->fou_g > 0 ? $grade->fou_g : 0;
                            
                            $sum += $grade->fir_g > 0 ? $grade->fir_g : 0;
                            $sum += $grade->sec_g > 0 ? $grade->sec_g : 0;
                            $sum += $grade->thi_g > 0 ? $grade->thi_g : 0;
                            $sum += $grade->fou_g > 0 ? $grade->fou_g : 0;

                            
                            $divisor += $first > 0 ? 1 : 0;
                            $divisor += $second > 0 ? 1 : 0;
                            $divisor += $third > 0 ? 1 : 0;
                            $divisor += $fourth > 0 ? 1 : 0;

                            $lacking_unit = $item->j_lacking_unit;
                        }

                        if($item->grade_level > 10)
                        {
                            if($semester == 1)
                            {
                                $first = $grade->fir_g > 0 ? $grade->fir_g : 0;
                                $second = $grade->sec_g > 0 ? $grade->sec_g : 0;
                                $sum += $grade->fir_g > 0 ? $grade->fir_g : 0;
                                $sum += $grade->sec_g > 0 ? $grade->sec_g : 0;

                                $divisor += $first > 0 ? 1 : 0;
                                $divisor += $second > 0 ? 1 : 0;

                                $lacking_unit = $item->s1_lacking_unit;
                            }

                            if($semester == 2)
                            {
                                $third = $grade->thi_g > 0 ? $grade->thi_g : 0;
                                $fourth = $grade->fou_g > 0 ? $grade->fou_g : 0;
                                $sum += $grade->thi_g > 0 ? $grade->thi_g : 0;
                                $sum += $grade->fou_g > 0 ? $grade->fou_g : 0;

                                $divisor += $third > 0 ? 1 : 0;
                                $divisor += $fourth > 0 ? 1 : 0;

                                $lacking_unit = $item->s2_lacking_unit;
                            }
                        }

                        $final = 0;
                        if ($divisor != 0) 
                        {
                            $final = $sum / $divisor;
                        }
                        
                        $data = [
                            'enrollment_id'     =>  $item->enrollment_id,
                            'grade_level'       =>  $item->grade_level,
                            'class_days'        =>  $item->class_days,
                            'class_time_from'   =>  $item->class_time_from,
                            'class_time_to'     =>  $item->class_time_to,
                            'faculty_name'      =>  $item->faculty_name,
                            'subject_id'        =>  $item->subject_id,
                            'subject_code'      =>  $item->subject_code,
                            'subject'           =>  $item->subject,
                            'room_code'         =>  $item->room_code,
                            'section'           =>  $item->section,
                            'grade_id'          =>  $grade->id,
                            'fir_g'             =>  $grade->fir_g,
                            'sec_g'             =>  $grade->sec_g,
                            'thi_g'             =>  $grade->thi_g,
                            'fou_g'             =>  $grade->fou_g,
                            'final_g'           =>  round($final),
                            'grade_status'      =>  $grade_status,
                            'divisor'           =>  $divisor,
                            'eligible_transfer' =>  $item->eligible_transfer,
                            'lacking_unit'      =>  $lacking_unit,
                        ];
                        return $data;
                    });
                    for ($i=0; $i<count($GradeSheetData); $i++)
                    {
                        if ($GradeSheetData[$i]['final_g'] > 0) // && $GradeSheetData[$i]['grade_status'] == 2) 
                        {
                            $subj_count++;
                            $sub_total +=  $GradeSheetData[$i]['final_g'];
                        }
                    }
                    if ($subj_count > 0) 
                    {
                        $general_avg = $sub_total / $subj_count;
                    }
                }
                $GradeSheetData = json_decode(json_encode($GradeSheetData));
                
                $student_attendance = [
                    'attendance_data'   => $attendance_data,
                    'table_header'      => $table_header,
                    'days_of_school_total' => array_sum($attendance_data->days_of_school),
                    'days_present_total' => array_sum($attendance_data->days_present),
                    'days_absent_total' => array_sum($attendance_data->days_absent),
                    'times_tardy_total' => array_sum($attendance_data->times_tardy),
                ];
                // return json_encode(['a' => $GradeSheetData, 'subj_count' => $subj_count, 'general_avg' => $general_avg]);
                return view('control_panel_student.grade_sheet.partials.print',
                    compact('GradeSheetData', 'grade_level', 'StudentInformation', 'ClassDetail', 'general_avg', 'student_attendance', 'table_header',
                        'Signatory','DateRemarks','Enrollment','semester'));
                        
                $pdf = \PDF::loadView('control_panel_student.grade_sheet.partials.print',
                    compact('GradeSheetData', 'grade_level', 'StudentInformation', 'ClassDetail','Signatory','DateRemarks','Enrollment','semester'));
                return $pdf->stream();
                return view('control_panel_student.grade_sheet.index', compact('GradeSheetData'));
                return json_encode(['GradeSheetData' => $GradeSheetData,]);
            }
            else {
                return "Invalid request";
            }
        } catch (\Throwable $th) {
            return view('errors.404');
        }
        
    }
}