<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Email;
use Dotenv\Validator;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Mail\InformationEmail;
use App\Models\IncomingStudent;
use App\Models\StudentEducation;
use App\Models\StudentInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyNewRegisterStudentMail;
use App\Mail\NotifyNewRegisterStudentAdminMail;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'lrn'               => 'required',
            'grade_level'       => 'required',
            'first_name'        => 'required',
            'middle_name'       => 'required',
            'last_name'         => 'required',
            'student_email'     => 'email|required',
            'phone'             => 'required',            
            'guardian'          => 'required',
            'address'           => 'required',
            'p_address'         => 'required',
            'birthdate'         => 'required',
            'gender'            => 'required',            
            'mother_name'       => 'required',
            'father_name'       => 'required',
            'student_img'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_esc'            => 'required',
            'religion'          => 'required',
            'citizenship'       => 'required',
            'fb_acct'           => 'required',
            'place_of_birth'    => 'required',
            'father_occupation' => 'required',
            'mother_occupation' => 'required',
            'no_siblings'       => 'required',
            'school_name'       => 'required',
            'school_type'       => 'required',
            'school_address'    => 'required',
            'last_sy_attended'  => 'required',
            'gwa'               => 'required',
        ];

        if($request->grade_level == 11)
        {
            $rules = [
                'strand' => 'required',
            ];
        }
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        

        // $again = 0;
        DB::beginTransaction();
        try{

                $SchoolYear = SchoolYear::where('current', 1)
                    ->where('status', 1)
                    ->orderBY('id', 'DESC')
                    ->first();

            // if($again == 0){
                $checkUser = User::where('username', $request->lrn)->first();
                if ($checkUser) 
                {
                    // DB::rollBack();
                    return response()->json([
                        'res_code' => 1,'res_msg' => 
                        'LRN already used. Please contact the administrator to confirm it. Thank you'
                        ]);
                }
            // }else{
           
                $User = new User();
                $User->username = $request->lrn;
                $User->password = bcrypt($request->first_name . '.' . $request->last_name);
                $User->role     = 5;
                $User->status = 0;
                $User->save();

                $StudentInformation                 = new StudentInformation();
                $StudentInformation->first_name     = $request->first_name;
                $StudentInformation->middle_name    = $request->middle_name;
                $StudentInformation->last_name      = $request->last_name;
                $StudentInformation->c_address      = $request->address;
                $StudentInformation->p_address      = $request->p_address;
                $StudentInformation->birthdate      = date('Y-m-d', strtotime($request->birthdate));
                $StudentInformation->gender         = $request->gender;
                $StudentInformation->guardian       = $request->guardian;
                $StudentInformation->mother_name    = $request->mother_name;
                $StudentInformation->father_name    = $request->father_name;            
                $StudentInformation->user_id        = $User->id;
                $StudentInformation->email          = $request->student_email;
                $StudentInformation->contact_number = $request->phone;
                $StudentInformation->religion       = $request->religion;
                $StudentInformation->citizenship    = $request->citizenship;
                $StudentInformation->fb_acct        = $request->fb_acct;
                $StudentInformation->father_occupation = $request->father_occupation;
                $StudentInformation->mother_occupation = $request->mother_occupation;
                $StudentInformation->father_fb_acct = $request->father_fb_acct;
                $StudentInformation->mother_fb_acct = $request->mother_fb_acct;
                $StudentInformation->place_of_birth = $request->place_of_birth;
                $StudentInformation->guardian_fb_acct = $request->guardian_fb_acct;
                $StudentInformation->no_siblings = $request->no_siblings;
                $StudentInformation->isEsc          = $request->is_esc;
                $imageName = time().'.'.$request->student_img->getClientOriginalExtension();
                $request->student_img->move(public_path('img/account/photo/'), $imageName);
                $StudentInformation->photo = $imageName;
                // $StudentInformation->status = 0;    
                $StudentInformation->save();

                $StudentEducation = new StudentEducation();
                $StudentEducation->student_information_id   = $StudentInformation->id;
                $StudentEducation->school_name              = $request->school_name;
                $StudentEducation->school_type              = $request->school_type;
                $StudentEducation->school_address           = $request->school_address;
                $StudentEducation->last_sy_attended         = $request->last_sy_attended;
                $StudentEducation->gw_average               = $request->gwa;
                // $StudentEducation->incoming_grade           = $request->grade_level;
                $StudentEducation->strand                   = $request->grade_level == 11 ? $request->strand : '0';
                $transfer = 1;
                if($request->grade_level == 7 || $request->grade_level == 11)
                {
                    $transfer = 2;
                }
                $StudentEducation->is_transferee           = $transfer;
                $StudentEducation->save();

                $Incoming_student = new IncomingStudent();
                $Incoming_student->student_id = $StudentInformation->id;
                $Incoming_student->school_year_id = $SchoolYear->id;
                $Incoming_student->grade_level_id = $request->grade_level;
                $Incoming_student->student_type = $transfer;
                $Incoming_student->save();

                // $StudentInformation = StudentInformation::find()
                
                DB::commit();
                
                // $NewStudent = IncomingStudent::find($Incoming_student->id);
                
                // dd($request->all());
                return response()->json(['res_code' => 0, 'res_msg' => 'You have successfuly registered!']);
            //  }
        }
        catch(\Exception $e){
            // do task when error
            // insert query
            DB::rollBack();
            Log::error($e->getMessage());
            
            // $again = 1;
            return response()->json(['res_code' => 1, 'res_msg' => 'Please check all fields and submit again.']);
        }
    }   
    
    public function send_email(Request $request)
    {
        $rules = [
            'name' => 'required',
            'subject' => 'required',
            'email' => 'email|required',
            'message' => 'required'
        ];        
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        try
        {  
            $email = new Email();
            $email->name = $request->name;
            $email->email = $request->email;
            $email->subject = $request->subject;
            $email->message = $request->message;   
                     
            try{
                $email->save();

                $email = Email::find($email->id);
                    Mail::to('info@sja-bataan.com')->from($request->email)->send(new InformationEmail($email));
                return response()->json(['res_code' => 0, 'res_msg' => 'You have successfuly send your email! Thank you']);

            }catch(\Exception $e){
                Log::error($e->getMessage());
                return response()->json(['res_code' => 1, 'res_msg' => $e->getMessage()]);
            }

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['res_code' => 1, 'res_msg' => $e->getMessage()]);
        }
    }
}