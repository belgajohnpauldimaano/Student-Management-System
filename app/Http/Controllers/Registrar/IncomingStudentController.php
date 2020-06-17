<?php

namespace App\Http\Controllers\Registrar;

use App\User;
use App\SchoolYear;
use App\IncomingStudent;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\Traits\hasIncomingStudents;
use App\Http\Controllers\Controller;
use App\Mail\NotifyApproveAdmission;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveStudentAccountMail;
use App\Mail\NotifyDisapproveAdmission;
use App\Mail\NotifyDisapproveStudentMail;

class IncomingStudentController extends Controller
{
    use hasIncomingStudents;
    
    public function index(Request $request){
        
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 

        if($request->ajax()){            
                $IncomingStudent = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
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
                
                $IncomingStudentCount = $this->IncomingStudentCount();
                
                return view('control_panel_registrar.incoming_student.partials.data_list',
                    compact('IncomingStudent','IncomingStudentCount'))->render();
        }
        
        $IncomingStudent = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
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

        $IncomingStudentCount = $this->IncomingStudentCount(); 

       
        return view('control_panel_registrar.incoming_student.index', 
            compact('IncomingStudent','IncomingStudentCount'));
    }

    public function Approved(Request $request)
    {
        $SchoolYear = SchoolYear::where('current', 1)
        ->where('status', 1)
        ->first(); 

        if($request->ajax()){            

                $IncomingStudentCount = $this->IncomingStudentCount();

                $IncomingStudentApproved = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
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
                    ->where('incoming_students.approval', 'Approved')
                    ->where('incoming_students.school_year_id', $SchoolYear->id)            
                    ->where('users.status', 1)            
                    ->paginate(10, ['transaction_month_paids.id']);

                return view('control_panel_registrar.incoming_student_approved.partials.data_list', compact('IncomingStudentApproved','IncomingStudentCount'));
        }        

        $IncomingStudentCount = $this->IncomingStudentCount(); 

        $IncomingStudentApproved = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
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
            ->where('incoming_students.approval', 'Approved')
            ->where('incoming_students.school_year_id', $SchoolYear->id)            
            ->where('users.status', 1)            
            ->paginate(10, ['transaction_month_paids.id']);

        return view('control_panel_registrar.incoming_student_approved.index', compact('IncomingStudentApproved','IncomingStudentCount'));
    }

    

    public function Disapproved(Request $request)
    {
        $SchoolYear = SchoolYear::where('current', 1)
        ->where('status', 1)
        ->first(); 

        if($request->ajax()){      

            $IncomingStudentCount = $this->IncomingStudentCount();               

            $Disapproved = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
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
                ->where('incoming_students.approval', 'Disapproved')
                ->where('incoming_students.school_year_id', $SchoolYear->id)            
                ->where('users.status', 0)            
                ->paginate(10, ['transaction_month_paids.id']);

            return view('control_panel_registrar.incoming_student_disapproved.partials.data_list', compact('IncomingStudentCount','Disapproved'));
        }
        

        $IncomingStudentCount = $this->IncomingStudentCount(); 


        $Disapproved = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
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
            ->where('incoming_students.approval', 'Disapproved')
            ->where('incoming_students.school_year_id', $SchoolYear->id)            
            ->where('users.status', 0)            
            ->paginate(10, ['transaction_month_paids.id']);

        return view('control_panel_registrar.incoming_student_disapproved.index', compact('IncomingStudentCount','Disapproved'));
    }

    public function modal_data(Request $request)
    {
        $SchoolYear = SchoolYear::where('current', 1)
        ->where('status', 1)
        ->first(); 

        $IncomingStudent = NULL;
        if ($request->id)
        {
            $IncomingStudent = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
                ->join('users', 'users.id', '=', 'student_informations.user_id')                                   
                ->selectRaw('
                    CONCAT(student_informations.last_name, ", ", student_informations.first_name, " " ,  student_informations.middle_name) AS student_name,
                    student_informations.birthdate,
                    student_informations.gender,
                    student_informations.photo,
                    student_informations.guardian,
                    student_informations.mother_name,
                    student_informations.father_name,
                    student_informations.email,
                    student_informations.contact_number,
                    student_informations.c_address,
                    student_informations.p_address,
                    student_informations.guardian,
                    student_informations.status as student_informations_status,
                    student_informations.id as student_id,
                    incoming_students.grade_level_id, 
                    incoming_students.student_type, 
                    incoming_students.approval,
                    users.username, 
                    users.status as user_status
                ')
                ->where('student_informations.id', $request->id)
                // ->where('student_informations.status', 0)
                ->where('incoming_students.school_year_id', $SchoolYear->id)            
                // ->where('users.status', 0)         
                ->first();
        }
        return view('control_panel_registrar.incoming_student.partials.modal_data', compact('IncomingStudent'))->render();
    }

    public function approve(Request $request)
    {
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 
        
        $StudentInformation = StudentInformation::where('status', 1)
             ->where('id', $request->id)->first();   

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;     

        $Approved = IncomingStudent::where('student_id', $request->id)
            ->where('school_year_id', $SchoolYear->id)
            ->first();
        if($Approved)
        {
            $Approved->approval = 'Approved';

            $User = User::where('id', $StudentInformation->user_id)->first();

            if ($User)
            {
                $User->status = 1;
                if($Approved->save() && $User->save())
                {
                    $student = StudentInformation::find($request->id);
                        Mail::to($StudentInformation->email)->send(new ApproveStudentAccountMail($student));
                        Mail::to('admission@sja-bataan.com')->send(new NotifyApproveAdmission($student));
                    return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' status successfully approved!.']);
                }else{
                    return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                }                
            }
        }      
                
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
        
    }


    public function disapprove(Request $request)
    {
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 
        
        $StudentInformation = StudentInformation::where('status', 1)
             ->where('id', $request->id)->first();   

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;  
        
        // $incoming_student = IncomingStudent::where('student_id', $request->id)->first();
        // $incoming_student->approval = 'Disapproved';
        // $incoming_student->saved();

        $Disapproved = IncomingStudent::where('student_id', $request->id)
            ->where('school_year_id', $SchoolYear->id)
            ->first();

        if($Disapproved)
        {
            $Disapproved->approval = 'Disapproved';

            $User = User::where('id', $StudentInformation->user_id)->first();

            if ($User)
            {
                $User->status = 0;
                if($Disapproved->save() && $User->save())
                {
                    $student = StudentInformation::find($request->id);
                        Mail::to($StudentInformation->email)->send(new NotifyDisapproveStudentMail($student));
                        Mail::to('admission@sja-bataan.com')->send(new NotifyDisapproveAdmission($student));                        
                   
                    return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' status successfully Disapproved!.']);
                }else{
                    return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                }                
            }
        }      
                
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}
