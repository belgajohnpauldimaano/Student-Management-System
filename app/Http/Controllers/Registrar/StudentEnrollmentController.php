<?php

namespace App\Http\Controllers\Registrar;

use App\User;
use App\Enrollment;
use App\SchoolYear;
use App\ClassDetail;
use App\Transaction;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\StudentEnrolledSubject;
use App\Http\Controllers\Controller;

class StudentEnrollmentController extends Controller
{
    public function index (Request $request, $id) 
    {
        // echo json_encode($request->user()->get_user_role('admin'), $request->user()->role);
        // return;
        if ($request->ajax())
        {
            if (!$request->search_fn &&
                !$request->search_mn &&
                !$request->search_ln &&
                !$request->search_student_id) 
            {
                $StudentInformation = [];
                return view('control_panel_registrar.student_enrollment.partials.data_list', compact('StudentInformation'))->render();
            }

            $StudentInformation = StudentInformation::with(['user'])
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            // ->leftJoin('enrollments', 'enrollments.student_information_id', '=', 'student_informations.id')
            // ->leftJoin('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            // ->leftJoin('school_years', 'school_years.id', '=', 'class_details.school_year_id')
            ->selectRaw("
                student_informations.id,
                users.username,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) AS fullname
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
            ->where(function ($query) use ($id) {
                // $query->whereRaw('enrollments.class_details_id IS NULL OR enrollments.class_details_id != '.$id);
                // $query->whereRaw('enrollments.class_details_id IS NULL AND enrollments.class_details_id != '.$id);
            })
            // ->where(function ($query) use ($id, $ClassDetail) {
            //     $query->whereRaw('
            //             enrollments.id IS NULL 
            //         OR 
            //             enrollments.class_details_id != '.$id
            //     );
            // })
            // ->where(function ($query) use ($id, $ClassDetail) {
            //     $query->whereRaw('
            //             (SELECT 
            //                 class_details_id 
            //             FROM
            //                 enrollments
            //             WHERE 
            //                 (
            //                     enrollments.student_information_id = student_informations.id
            //                 )
            //             ) = '. $id
            //     );
            // })
            ->orderByRaw('fullname')
            ->paginate(10);

            // return json_encode(['s' => $StudentInformation, 'req' => $request->all(), 'ClassDetail' => $id]);
            return view('control_panel_registrar.student_enrollment.partials.data_list', compact('StudentInformation'))->render();
        }
        // $StudentInformation = \App\StudentInformation::with(['user'])->where('status', 1)->paginate(10);
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
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) AS fullname,
                enrollments.id AS enrollment_id
            ")
            ->where('class_details_id', $id)
            ->orderByRaw('fullname')
            ->paginate(70);

        $Enrollment_ids = '';
        foreach($Enrollment as $data)
        {
            $Enrollment_ids .= $data->enrollment_id . '@';
        }
        return view('control_panel_registrar.student_enrollment.index', compact('StudentInformation', 'ClassDetail', 'id', 'Enrollment', 'Enrollment_ids'));
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
                    student_informations.id AS student_information_id,
                    users.username,
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ', ', student_informations.middle_name) AS fullname,
                    enrollments.id AS enrollment_id
                ")
                ->where('class_details_id', $id)
                ->orderByRaw('fullname')
                // ->orWhere('first_name', 'like', '%'.$request->search.'%')
                ->paginate(70); //

                // return json_encode($StudentInformation);
            return view('control_panel_registrar.student_enrollment.partials.data_list_enrolled', compact('Enrollment','ClassDetail'))->render();
            
        }
    }

    public function modal_data (Request $request) 
    {
        $StudentInformation = NULL;
        if ($request->id)
        {
            $StudentInformation = StudentInformation::with(['user'])->where('id', $request->id)->first();
        }
        return view('control_panel_registrar.student_enrollment.partials.modal_data', compact('StudentInformation'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'username' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
            'email' => 'required|unique:users,username',
        ];
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        if ($request->id)
        {
            $StudentInformation = StudentInformation::where('id', $request->id)->first();
            $StudentInformation->first_name = $request->first_name;
            $StudentInformation->middle_name = $request->middle_name;
            $StudentInformation->last_name = $request->last_name;
            $StudentInformation->department_id = $request->department;
            $StudentInformation->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }

        $User = new User();
        $User->username = $request->username;
        $User->password = bcrypt($request->first_name . '.' . $request->last_name);
        $User->role     = 4;
        $User->save();

        $StudentInformation = new StudentInformation();
        $StudentInformation->first_name = $request->first_name;
        $StudentInformation->middle_name = $request->middle_name;
        $StudentInformation->last_name = $request->last_name;
        $StudentInformation->department_id = $request->department;
        $StudentInformation->user_id = $User->id;
        $StudentInformation->save();
        
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
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

    public function enroll_student (Request $request, $id) 
    {
        $StudentInformation = StudentInformation::where('id', $request->student_id)->first();
        $ClassDetail = ClassDetail::with('class_subjects')->where('id', $id)->first();

        // $ClassDetail = \App\ClassDetail::with('class_subjects')->get();
        // return response()->json(['res_code' => 1, 'res_msg' => 'There is a problem in enrolling student.', 'ClassDetail' => $ClassDetail]);


        $Enrollment = new Enrollment();
        $Enrollment->student_information_id = $StudentInformation->id;
        $Enrollment->class_details_id = $ClassDetail->id;
        
        if ($Enrollment->save())
        {
            if ($ClassDetail->class_subjects) 
            {
                foreach ($ClassDetail->class_subjects as $data) 
                {
                    $StudentEnrolledSubject = new StudentEnrolledSubject();
                    $StudentEnrolledSubject->subject_id = $data->subject_id;
                    $StudentEnrolledSubject->enrollments_id = $Enrollment->id;
                    $StudentEnrolledSubject->class_subject_details_id = $data->id;
                    // $StudentEnrolledSubject->student_information_id = $StudentInformation->id;
                    $StudentEnrolledSubject->save();
                }
            }
            return response()->json(['res_code' => 0, 
                'res_msg' => 'Student successfully enrolled.', 
                'StudentInformation' => $StudentInformation, 
                'ClassDetail' => $ClassDetail,
                'Enrollment' => $Enrollment,
            ]);
        }

        return response()->json(['res_code' => 1, 'res_msg' => 'There is a problem in enrolling student.', 'Enrollment' => $Enrollment]);
    }

    public function re_enroll_student (Request $request, $id)
    {
        $ClassDetail = ClassDetail::with('class_subjects')->where('id', $id)->first();
        $StudentEnrolledSubject_list = [];
        if ($ClassDetail->class_subjects)
        {
            $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $request->enrollment_id)
                // ->where('subject_id', $class_subject->subject_id)
                ->get();
                
            // return json_encode(['ClassDetail' => $ClassDetail, 'StudentEnrolledSubject' => $StudentEnrolledSubject, 'class_subjects' => $ClassDetail->class_subjects]);
            foreach ($ClassDetail->class_subjects as $key => $class_subject)
            {
                
                $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $request->enrollment_id)
                ->where('class_subject_details_id', $class_subject->id)
                ->first();
                if ($StudentEnrolledSubject) {
                    $StudentEnrolledSubject_list[] = $StudentEnrolledSubject;
                } 
                else 
                {
                    $newStudentEnrolledSubject = new StudentEnrolledSubject();
                    $newStudentEnrolledSubject->class_subject_details_id = $class_subject->id;
                    $newStudentEnrolledSubject->subject_id = $class_subject->subject_id;
                    $newStudentEnrolledSubject->enrollments_id = $request->enrollment_id;
                    $newStudentEnrolledSubject->save();
                    $StudentEnrolledSubject_list[] = $newStudentEnrolledSubject;
                }
                // if ($StudentEnrolledSubject[$key]) 
                // {
                //     $StudentEnrolledSubject_tmp = $StudentEnrolledSubject[$key];
                //     $StudentEnrolledSubject_tmp->class_subject_details_id = $class_subject->id;
                //     $StudentEnrolledSubject_tmp->subject_id = $class_subject->subject_id;
                //     $StudentEnrolledSubject_tmp->save();
                //     $StudentEnrolledSubject_list[] = $StudentEnrolledSubject_tmp;
                // }

                // $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('enrollments_id', $request->enrollment_id)
                //     ->where('subject_id', $class_subject->subject_id)
                //     ->first();
                // $StudentEnrolledSubject->class_subject_details_id = $class_subject->id;
                // $StudentEnrolledSubject->save();
                // $StudentEnrolledSubject_list[] = $StudentEnrolledSubject;
            }
            
            // return json_encode(['ClassDetail' => $ClassDetail, 'StudentEnrolledSubject_list' => $StudentEnrolledSubject_list, 'StudentEnrolledSubject' => $StudentEnrolledSubject, 'class_subjects' => $ClassDetail->class_subjects]);
            return response()->json(['res_code' => 0, 'res_msg' => 'Successfully re-enrolled.']);
            
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Unable to perform action.']);

    }

    public function re_enroll_student_all (Request $request, $id)
    {
        $ClassDetail = ClassDetail::with('class_subjects')->where('id', $id)->first();
        $enrollment_ids = explode('@', $request->enrollment_ids);
        array_pop($enrollment_ids);

        $StudentEnrolledSubject_list = [];
        if ($ClassDetail->class_subjects)
        {
            foreach($enrollment_ids as $enrollment_id)
            {
                // $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('enrollments_id', $enrollment_id)->get();
                foreach ($ClassDetail->class_subjects as $key => $class_subject)
                {
                    $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $enrollment_id)
                    ->where('class_subject_details_id', $class_subject->id)
                    ->first();
                    
                    if ($StudentEnrolledSubject) {
                        $StudentEnrolledSubject_list[] = $StudentEnrolledSubject;
                    } 
                    else 
                    {
                        $newStudentEnrolledSubject = new StudentEnrolledSubject();
                        $newStudentEnrolledSubject->class_subject_details_id = $class_subject->id;
                        $newStudentEnrolledSubject->subject_id = $class_subject->subject_id;
                        $newStudentEnrolledSubject->enrollments_id = $enrollment_id;
                        $newStudentEnrolledSubject->save();
                        $StudentEnrolledSubject_list[] = $newStudentEnrolledSubject;
                    }
                    // if ($StudentEnrolledSubject[$key]) 
                    // {
                    //     $StudentEnrolledSubject_tmp = $StudentEnrolledSubject[$key];
                    //     $StudentEnrolledSubject_tmp->class_subject_details_id = $class_subject->id;
                    //     $StudentEnrolledSubject_tmp->subject_id = $class_subject->subject_id;
                    //     $StudentEnrolledSubject_tmp->save();
                    //     $StudentEnrolledSubject_list[] = $StudentEnrolledSubject_tmp;
                    // }
                }
            }
            return response()->json(['res_code' => 0, 'res_msg' => 'Successfully re-enrolled.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Unable to perform action.']);

        return json_encode(['ClassDetail' => $ClassDetail, 'StudentEnrolledSubject_list' => $StudentEnrolledSubject_list, 'StudentEnrolledSubject' => $StudentEnrolledSubject, 'class_subjects' => $ClassDetail->class_subjects]);
    }

    public function cancel_enroll_student (Request $request, $id) 
    {
        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->first();
        $Enrollment = Enrollment::where('id', $request->enrollment_id)->first();

        if ($Enrollment)
        {

            $IsEnrolled = Transaction::where('student_id', $request->student_id)->where('school_year_id', $SchoolYear->id)->first();
            $IsEnrolled->IsEnrolled = 0;
            // if($IsEnrolled->save() || $Enrollment->delete())
            if($IsEnrolled->save())
            {
                $Enrollment = Enrollment::where('id', $request->enrollment_id)->delete();
                // $studentEnrolled = StudentEnrolledSubject::where('enrollments_id', $Enrollment->id)->delete();
                return response()->json(['res_code' => 0, 'res_msg' => 'Student successfully canceled.']);
            }
            else{
                return response()->json(['res_code' => 1, 'res_msg' => 'There is a problem in enrolling student.']);   
            }
            return response()->json(['res_code' => 0, 'res_msg' => 'Student successfully canceled.'.$request->student_id]);
            
        }
        // return response()->json(['res_code' => 1, 'res_msg' => 'There is a problem in enrolling student.']);   
    }

    public function print_enrolled_students (Request $request, $id) 
    {
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
                school_years.school_year,
                rooms.room_code,
                rooms.room_description
            ')
            ->where('section_details.status', 1)
            ->where('school_years.current', 1)
            ->where('class_details.id', $request->id)
            ->first();

        $EnrollmentMale = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            // ->whereRaw('student_informations.id NOT IN ((SELECT  * from enrollments where enrollments.class_details_id = 3))')
            ->selectRaw("
                student_informations.id AS student_information_id,
                users.username,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) AS fullname,
                enrollments.id AS enrollment_id
            ")
            ->where('student_informations.gender', 1)
            ->where('class_details_id', $request->id)
            ->orderByRaw('fullname', 'ASC')
            // ->orWhere('first_name', 'like', '%'.$request->search.'%')
            ->get(); //

        $EnrollmentFemale = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->join('users', 'users.id', '=', 'student_informations.user_id')
            // ->whereRaw('student_informations.id NOT IN ((SELECT  * from enrollments where enrollments.class_details_id = 3))')
            ->selectRaw("
                student_informations.id AS student_information_id,
                users.username,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) AS fullname,
                enrollments.id AS enrollment_id
            ")
            ->where('student_informations.gender', 2)
            ->where('class_details_id', $request->id)
            ->orderByRaw('fullname', 'ASC')
            // ->orWhere('first_name', 'like', '%'.$request->search.'%')
            ->get(); //
        
        return view('control_panel_registrar.student_enrollment.partials.print',
            compact('EnrollmentMale', 'EnrollmentFemale', 'ClassDetail'));
        $pdf = \PDF::loadView('control_panel_registrar.student_enrollment.partials.print',
             compact('EnrollmentMale', 'EnrollmentFemale', 'ClassDetail'));
        return $pdf->stream();
     



        // return view('control_panel_finance.student_payment_account.partials.print_all_transaction', 
        // compact('Modal_data','Mo_history','other_fee','Discount','Discount_amt','total','other','fullname','ItemPrice','OtherFee'));

        // $pdf = \PDF::loadView('control_panel_finance.student_payment_account.partials.print_all_transaction', 
        //         compact('Modal_data','Mo_history','other_fee','Discount','Discount_amt','total','other','fullname','ItemPrice','OtherFee'));

        // $pdf->setPaper('Letter', 'portrait');
        // return $pdf->stream(); 
            }
}
