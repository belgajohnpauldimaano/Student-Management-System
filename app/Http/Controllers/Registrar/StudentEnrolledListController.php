<?php

namespace App\Http\Controllers\Registrar;

use App\Models\Enrollment;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Models\StudentEnrolledSubject;
use App\Http\Controllers\Controller;

class StudentEnrolledListController extends Controller
{
    public function index(Request $request, $id)
    {
        $ClassDetail = ClassDetail::with(['section','schoolYear'])
            ->whereId($id)
            ->first();
        // return json_encode($ClassDetail);

        // $Enrollment = Enrollment::with(['student:first_name,middle_name,last_name,id,user_id','user'])
        //     ->whereHas('student', function($q) use ($request) {
        //         $q->where('first_name', 'like', '%'.$request->search_student.'%');
        //         $q->orWhere('middle_name', 'like', '%'.$request->search_student.'%');
        //         $q->orWhere('last_name', 'like', '%'.$request->search_student.'%');
        //     })
        //     ->select('enrollments.student_information_id', 'enrollments.status')
        //     ->whereClassDetailsId($id)
        //     ->where('status','!=',0)
        //     ->paginate(70);

        $Enrollment = Enrollment::join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                ->join('users', 'users.id', '=', 'student_informations.user_id')
                ->where(function ($q) use ($request) {
                    $q->where('first_name', 'like', '%'.$request->search_student.'%');
                    $q->orWhere('middle_name', 'like', '%'.$request->search_student.'%');
                    $q->orWhere('last_name', 'like', '%'.$request->search_student.'%');
                })
                ->selectRaw("
                    student_informations.id,
                    users.username,student_informations.user_id,
                    enrollments.id,enrollments.student_information_id,enrollments.status
                ")
                ->where('class_details_id', $id)
                ->orderByRaw('student_informations.last_name')
                ->where('enrollments.status', 1)
                ->paginate(70);

        // return json_encode($Enrollment);

        if($request->ajax()){
            
           return view('control_panel_registrar.student_enrolled.partials.data_list', compact('id','Enrollment','ClassDetail'));
        }

        return view('control_panel_registrar.student_enrolled.index', compact('id','Enrollment','ClassDetail'));
    }

    public function drop(Request $request)
    {
        $enrollment_id = $request->enrollment_id;
        $class_detail_id = $request->class_detail_id;
        $student_id = $request->student_id;
        $type = $request->type;
        
        try {
            if($enrollment_id && $class_detail_id && $student_id && $type)
            {
                $Enrollment = Enrollment::whereId($enrollment_id)->first();
                $Enrollment->status = ($type == 'drop' ? 2 : 1);
                $Enrollment->save();

                $student_enrolled_subject = StudentEnrolledSubject::whereEnrollmentsId($enrollment_id)->get();
                
                foreach ($student_enrolled_subject as $data) 
                {
                    $drop = StudentEnrolledSubject::find($data->id);
                    $drop->status = ($type == 'drop' ? 2 : 1);
                    $drop->save();
                    // echo $data->id.'<br/>';
                }
                return response()->json([
                    'res_code' => 0, 'res_msg' => 'Student successfully '.($type == 'drop' ? 'dropped!' : 'undropped!')
                    // .$enrollment_id.' '.$class_detail_id.' '.$student_id
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['res_code' => 1, 'res_msg' => 'There is a problem in dropping student.'], 401);  
        }
    }
}