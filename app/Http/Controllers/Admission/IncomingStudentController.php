<?php

namespace App\Http\Controllers\Admission;

use PDF;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Traits\HasSchoolYear;
use App\Models\IncomingStudent;
use App\Models\StudentInformation;
use App\Traits\hasIncomingStudents;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IncomingStudentApprovedExport;
use App\Mail\Admission\NotifyApproveAdmission;
use App\Mail\Student\Admission\ApproveStudentAccountMail;
use App\Mail\Student\Admission\NotifyDisapproveAdmission;
use App\Mail\Student\Admission\NotifyDisapproveStudentMail;

class IncomingStudentController extends Controller
{
    use hasIncomingStudents, HasSchoolYear;
    
    public function index(Request $request)
    {
        $IncomingStudentCount = $this->IncomingStudentCount(); 
        $School_years = $this->schoolYears();
        $tab = $request->tab;
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first(); 

            $query = StudentInformation::join('incoming_students','incoming_students.student_id', '=' ,'student_informations.id')    
                ->join('users', 'users.id', '=', 'student_informations.user_id')                                   
                ->selectRaw('
                    CONCAT(student_informations.last_name, ", ", student_informations.first_name, " " ,  student_informations.middle_name) AS student_name,
                    student_informations.id as student_id,
                    student_informations.status,
                    incoming_students.grade_level_id, 
                    incoming_students.student_type, 
                    incoming_students.approval,
                    incoming_students.id,
                    users.username, 
                    users.status as user_status
                ')
                ->where(function ($query) use ($request) {
                        $query->where('student_informations.first_name', 'like', '%'.$request->search.'%');
                        $query->orWhere('student_informations.middle_name', 'like', '%'.$request->search.'%');
                        $query->orWhere('student_informations.last_name', 'like', '%'.$request->search.'%');
                    });
                // ->where('incoming_students.school_year_id', $SchoolYear->id);

            if($tab == 'not-yet-approved'){
                $query->where('incoming_students.approval','=','Not yet Approved');
                        $query->where('users.status', 0);
                        $query->where('student_informations.status', 0);
                $tab = 'not-yet-approved';
            }

            else if($tab == 'approved'){
                $query->where('incoming_students.approval','=','Approved')->where('users.status', 1);
                $tab = 'approved';
            }

            else if($tab == 'disapproved'){
                $query->where('incoming_students.approval','=','Disapproved')->where('users.status', 0);
                $tab = 'disapproved';
            }

        $IncomingStudent = $query->orderBY('incoming_students.id', 'desc')->paginate(10);

        if($request->ajax()){
            return view('control_panel_admission.incoming.partials.data_list', compact('IncomingStudent','IncomingStudentCount','tab','School_years'))->render();
        }
        
        return view('control_panel_admission.incoming.index', compact('IncomingStudentCount','tab','IncomingStudent','School_years'));
    }

    public function modal_data(Request $request)
    {
        // $SchoolYear = SchoolYear::where('current', 1)
        // ->where('status', 1)
        // ->first(); 

        $IncomingStudent = NULL;
        if ($request->id)
        {
            $IncomingStudent = StudentInformation::with(['incomingStudent','user','studentEducation'])
                // ->whereHas('incomingStudent', function($q) use ($SchoolYear) {
                //     $q->where('school_year_id', $SchoolYear->id);
                // })
                ->whereId($request->id)
                // ->where('status','!=',0)
                ->first();

            // return json_encode($IncomingStudent);
        }
        return view('control_panel_admission.incoming.partials.modal_data', compact('IncomingStudent'))->render();
    }

    public function approve(Request $request)
    {
        // $SchoolYear = SchoolYear::where('current', 1)
        //     ->where('status', 1)
        //     ->first(); 
        
        $StudentInformation = StudentInformation::where('id', $request->id)->first();

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;

        $Approved = IncomingStudent::where('student_id', $request->id)
            // ->where('school_year_id', $SchoolYear->id)
            ->first();
            
        if($Approved)
        {
            $Approved->approval = 'Approved';

            $User = User::where('id', $StudentInformation->user_id)->first();

            
            if ($User)
            {
                $User->status = 1;
                $StudentInformation->status = 1;
                $data = array(
                    'email'         =>  $StudentInformation->email,
                    'updated_at'    =>  $StudentInformation->updated_at,
                    'full_name'     =>  $StudentInformation->full_name,
                    'username'      =>  $StudentInformation->user->username,
                    'password'      =>  $StudentInformation->first_name.'.'.$StudentInformation->last_name
                );

                try{
                    if($Approved->save() && $User->save() && $StudentInformation->save())
                    {
                        $student = StudentInformation::find($request->id);
                        
                        $pdf = PDF::loadView('control_panel_admission.incoming.partials.print', $data);

                        Mail::send('mails.student.admission.student_account_activation', $data, function($message)use( $data, $pdf) {
                            $message->to($data["email"], 'sjai')
                            ->subject('Activation')
                            ->attachData($pdf->output(), "RegistrationForm.pdf");
                        });
                        
                        // Mail::to($StudentInformation->email)->send(new ApproveStudentAccountMail($student));
                        // Mail::to('admission@sja-bataan.com')->send(new NotifyApproveAdmission($student));
                        
                        return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' status successfully approved!.']);
                    }else{
                        return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                    }
                }catch(\Exception $e){
                    return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                }               
            }
        }      
                
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
        
    }


    public function disapprove(Request $request)
    {
        // $SchoolYear = SchoolYear::where('current', 1)
        //     ->where('status', 1)
        //     ->first(); 
        
        $StudentInformation = StudentInformation::where('id', $request->id)->first();

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;  
        
        // $incoming_student = IncomingStudent::where('student_id', $request->id)->first();
        // $incoming_student->approval = 'Disapproved';
        // $incoming_student->saved();

        $Disapproved = IncomingStudent::where('student_id', $request->id)
            // ->where('school_year_id', $SchoolYear->id)
            ->first();

        if($Disapproved)
        {
            $Disapproved->approval = 'Disapproved';

            $User = User::where('id', $StudentInformation->user_id)->first();

            if ($User)
            {
                $User->status = 0;
                $StudentInformation->status = 0;
                try{
                    if($Disapproved->save() && $User->save() && $StudentInformation->save())
                    {
                        $student = StudentInformation::find($request->id);
                        Mail::to($StudentInformation->email)->send(new NotifyDisapproveStudentMail($student));
                        // Mail::to('admission@sja-bataan.com')->send(new NotifyDisapproveAdmission($student));
                    
                        return response()->json(['res_code' => 0, 'res_msg' => 'Student '.$name.' status successfully Disapproved!.']);
                    }else{
                        return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                    }   
                }catch(\Exception $e){
                    return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                }                 
            }
        }      
                
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function excel(Request $request)
    {
        return Excel::download(new IncomingStudentApprovedExport(), 'Incoming Student Approved.xlsx');
    }
}