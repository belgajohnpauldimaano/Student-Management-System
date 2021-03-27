<?php

namespace App\Http\Controllers\Admission;

use PDF;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Traits\HasSchoolYear;
use App\Models\IncomingStudent;
use App\Models\StudentInformation;
// use App\Traits\hasIncomingStudents;
use Illuminate\Support\Facades\DB;
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
    use HasSchoolYear, hasIncomingStudents;
    
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

            if($request->school_year)
            {
                $query->where('incoming_students.school_year_id', $request->school_year);
            }

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
            return view('control_panel_admission.incoming.partials.data_list', compact('IncomingStudent','tab','School_years','IncomingStudentCount'))->render();
        }
        
        return view('control_panel_admission.incoming.index', compact('tab','IncomingStudent','School_years','IncomingStudentCount'));
    }

    public function modal_data(Request $request)
    {
        $IncomingStudent = NULL;
        if ($request->id)
        {
            $IncomingStudent = $this->incomingStudent($request);
            // return json_encode($IncomingStudent);
        }
        return view('control_panel_admission.incoming.partials.modal_data', compact('IncomingStudent'))->render();
    }

    public function approve(Request $request)
    {
        $IncomingStudentCount = $this->IncomingStudentCount();

        $StudentInformation = StudentInformation::where('id', $request->id)->first();

        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;

        $Approved = IncomingStudent::where('student_id', $request->id)
            ->first();
            
        if($Approved)
        {
            $Approved->approval = 'Approved';

            $User = User::where('id', $StudentInformation->user_id)->first();
            $IncomingStudent = $this->incomingStudent($request);
            
            if ($User)
            {
                $User->status = 1;
                $StudentInformation->status = 1;
                // return $data;
                DB::beginTransaction();
                try{
                    if($Approved->save() && $User->save() && $StudentInformation->save())
                    {
                        $student = StudentInformation::find($request->id);
                        
                        $data = $this->studentData($IncomingStudent);
                        $pdf = PDF::loadView('control_panel_admission.incoming.partials.attach_email', $data);
                        $pdf->setPaper('Legal', 'portrait');

                        Mail::send('mails.student.admission.student_account_activation', $data, function($message)use( $data, $pdf) {
                            $message->to($data["email"], config('app.name'))
                            ->subject('Activation')
                            ->attachData($pdf->output(), "RegistrationForm.pdf");
                        });

                        DB::commit();
                        // Mail::to($StudentInformation->email)->send(new ApproveStudentAccountMail($student));
                        // Mail::to('admission@sja-bataan.com')->send(new NotifyApproveAdmission($student));
                        return response()->json([
                            'res_code'  => 0, 
                            'res_msg'   => 'Student '.$name.' status successfully approved!.',
                            'count'     => $IncomingStudentCount
                        ]);
                    }else{
                        DB::rollBack();
                        return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                    }
                }catch(\Exception $e){
                    DB::rollBack();
                    return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                }               
            }
        }      
                
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
        
    }


    public function disapprove(Request $request)
    {
        $IncomingStudentCount = $this->IncomingStudentCount();
        $StudentInformation = StudentInformation::where('id', $request->id)->first();
        $name = $StudentInformation->first_name.' '.$StudentInformation->last_name;  
        
        // $incoming_student = IncomingStudent::where('student_id', $request->id)->first();
        // $incoming_student->approval = 'Disapproved';
        // $incoming_student->saved();

        $Disapproved = IncomingStudent::where('student_id', $request->id)->first();

        if($Disapproved)
        {
            $Disapproved->approval = 'Disapproved';

            $User = User::where('id', $StudentInformation->user_id)->first();

            if ($User)
            {
                $User->status = 0;
                $StudentInformation->status = 0;
                DB::beginTransaction();
                try{
                    if($Disapproved->save() && $User->save() && $StudentInformation->save())
                    {
                        $student = StudentInformation::find($request->id);
                        Mail::to($StudentInformation->email)->send(new NotifyDisapproveStudentMail($student));
                        DB::commit();
                        // Mail::to('admission@sja-bataan.com')->send(new NotifyDisapproveAdmission($student));
                    
                        return response()->json([
                            'res_code' => 0, 
                            'res_msg' => 'Student '.$name.' status successfully Disapproved!.',
                            'count'     => $IncomingStudentCount
                        ]);
                    }else{
                        DB::rollBack();
                        return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                    }   
                }catch(\Exception $e){
                    DB::rollBack();
                    return response()->json(['res_code' => 1, 'res_msg' => 'Sorry approval has error.']);
                }                 
            }
        }      
                
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function print(Request $request)
    {
        if($request->id && $request->tab)
        {
            $IncomingStudent = $this->incomingStudent($request);
            $data = $this->studentData($IncomingStudent);
            // return json_encode($data);

            return view('control_panel_admission.incoming.partials.print', compact('data'));
            $pdf = PDF::loadView('control_panel_registrar.student_enrollment.partials.print', compact('data'));
            return $pdf->stream();
        }
    }

    private function incomingStudent($request)
    {
        return StudentInformation::with(['incomingStudent','user','studentEducation'])
                ->whereId($request->id)
                ->first();
    }

    private function studentData($IncomingStudent)
    {
        return  $data = array(
                    'email'             =>  $IncomingStudent->email,
                    'updated_at'        =>  $IncomingStudent->updated_at,
                    'full_name'         =>  $IncomingStudent->full_name,
                    'f_name'            =>  $IncomingStudent->first_name,
                    'm_name'            =>  $IncomingStudent->middle_name,
                    'l_name'            =>  $IncomingStudent->last_name,
                    'username'          =>  $IncomingStudent->user->username,
                    'password'          =>  $IncomingStudent->first_name.'.'.$IncomingStudent->last_name,
                    'p_address'         =>  $IncomingStudent->p_address,
                    'c_address'         =>  $IncomingStudent->c_address,
                    'birthdate'         =>  date_format(date_create($IncomingStudent->birthdate), 'F d, Y'),
                    'place_of_birth'    =>  $IncomingStudent->place_of_birth,
                    'age'               =>  $IncomingStudent->age,
                    'religion'          =>  $IncomingStudent->religion,
                    // 'catholic'          =>  $IncomingStudent->catholic,
                    'citizenship'       =>  $IncomingStudent->citizenship,
                    'fb_acct'           =>  $IncomingStudent->fb_acct,
                    'photo'             =>  $IncomingStudent->photo,
                    'contact_number'    =>  $IncomingStudent->contact_number,
                    'email'             =>  $IncomingStudent->email,
                    'father_name'       =>  $IncomingStudent->father_name,
                    'mother_name'       =>  $IncomingStudent->mother_name,
                    'father_occupation' =>  $IncomingStudent->father_occupation,
                    'father_fb_acct'    =>  $IncomingStudent->father_fb_acct,
                    'mother_occupation' =>  $IncomingStudent->mother_occupation,
                    'mother_fb_acct'    =>  $IncomingStudent->mother_fb_acct,
                    'guardian_fb_acct'  =>  $IncomingStudent->guardian_fb_acct,
                    'guardian'          =>  $IncomingStudent->guardian,
                    'no_siblings'       =>  $IncomingStudent->no_siblings,
                    'is_esc'            =>  $IncomingStudent->isEsc == 1 ? 'Yes' : 'No',
                    'gender'            =>  $IncomingStudent->gender == 1 ? 'Male' : 'Female',
                    'school_year'       =>  $IncomingStudent->admission_sy,
                    'grade_level'       =>  $IncomingStudent->incomingStudent->grade_level_id,
                    'student_type'      =>  $IncomingStudent->incomingStudent->student_type == 1 ? 'Transferee' : 'Freshman',
                    'school_name'       =>  $IncomingStudent->admission_school_name,
                    'school_type'       =>  $IncomingStudent->admission_school_type,
                    'school_address'    =>  $IncomingStudent->admission_school_address,
                    'last_sy_attended'  =>  $IncomingStudent->school_year,
                    'gw_average'        =>  $IncomingStudent->admission_gwa,
                    'strand'            =>  $IncomingStudent->admission_strand
                );
    }

    public function excel(Request $request)
    {
        return Excel::download(new IncomingStudentApprovedExport(), 'Incoming Student Approved.xlsx');
    }
}