<?php

namespace App\Http\Controllers\Admission;

use App\SchoolYear;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\Traits\hasIncomingStudents;
use App\Http\Controllers\Controller;

class NotYetApprovedController extends Controller
{
    use hasIncomingStudents;
    
    public function index(Request $request){
        
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 
        
        $IncomingStudentCount = $this->IncomingStudentCount();

        if ($request->ajax())
        {
            $StudentInformation = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
                ->join('users', 'users.id', '=', 'student_informations.user_id')                                   
                ->selectRaw('
                    CONCAT(student_informations.last_name, ", ", student_informations.first_name, " " ,  student_informations.middle_name) AS student_name,
                    student_informations.id as student_id,
                    incoming_students.grade_level_id, 
                    incoming_students.student_type, 
                    incoming_students.approval,
                    users.username, 
                    users.status as user_status
                ')
                ->where(function ($query) use ($request) {
                    $query->where('student_informations.first_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('student_informations.middle_name', 'like', '%'.$request->search.'%');
                    $query->orWhere('student_informations.last_name', 'like', '%'.$request->search.'%');
                })
                ->where('incoming_students.approval', 'Not yet Approved')
                ->where('incoming_students.school_year_id', $SchoolYear->id)            
                ->where('users.status', 0)            
                ->paginate(10);
            
            return view('control_panel_admission.incoming_student_information.partials.data_list', compact('StudentInformation','IncomingStudentCount'))->render();
        }

        

        $StudentInformation = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
            ->join('users', 'users.id', '=', 'student_informations.user_id')                                   
            ->selectRaw('
                CONCAT(student_informations.last_name, ", ", student_informations.first_name, " " ,  student_informations.middle_name) AS student_name,
                student_informations.id as student_id,
                incoming_students.grade_level_id, 
                incoming_students.student_type, 
                incoming_students.approval,
                users.username, 
                users.status as user_status
            ')
            ->where('incoming_students.approval', 'Not yet Approved')
            ->where('incoming_students.school_year_id', $SchoolYear->id)            
            ->where('users.status', 0)            
            ->paginate(10);
        
        return view('control_panel_admission.incoming_student_information.index', compact('StudentInformation','IncomingStudentCount'));
    }
}
