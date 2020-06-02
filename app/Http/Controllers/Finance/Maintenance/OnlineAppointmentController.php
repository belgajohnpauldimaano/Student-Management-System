<?php

namespace App\Http\Controllers\finance\Maintenance;

use App\SchoolYear;
use App\OnlineAppointment;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\StudentTimeAppointment;
use App\Mail\OnlineAppointmentMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mail\OnlineAppointmentFinanceMail;

class OnlineAppointmentController extends Controller
{
    public function index(Request $request){

        if ($request->ajax())
        {
            $OnlineAppointment = OnlineAppointment::where('status', 1)
                ->where('date', 'like', '%'.$request->search.'%')
                ->paginate(10);

            return view('control_panel_finance.maintenance.online_appointment.partials.data_list', compact('OnlineAppointment'))->render();
        }
        
        $OnlineAppointment = OnlineAppointment::where('status', 1)
            ->paginate(10);

        return view('control_panel_finance.maintenance.online_appointment.index', compact('OnlineAppointment'));
    }

    public function modal_data (Request $request) 
    {
        $OnlineAppointment = NULL;
        if ($request->id)
        {
            $OnlineAppointment = OnlineAppointment::where('id', $request->id)
                ->first();
        }

        return view('control_panel_finance.maintenance.online_appointment.partials.modal_data', compact('OnlineAppointment'))->render();
    }

    public function save_data (Request $request) 
    {
        $rules = [
            'date' => 'required',
            'time' => 'required',
            'appointee' => 'required'     
        ];

        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }   
        
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();
        // update
        if ($request->id)
        {
            $OnlineAppointment = OnlineAppointment::where('id', $request->id)->first();
            $OnlineAppointment->school_year_id = $SchoolYear->id;
            $OnlineAppointment->date = $request->date;
            $OnlineAppointment->time = $request->time;
            $OnlineAppointment->available_students = $request->appointee;
            $OnlineAppointment->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
        }
        // save
        $OnlineAppointment = new OnlineAppointment();
        $OnlineAppointment->school_year_id = $SchoolYear->id;
        $OnlineAppointment->date = $request->date;
        $OnlineAppointment->time = $request->time;
        $OnlineAppointment->available_students = $request->appointee;
        $OnlineAppointment->save();
        return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully saved.']);
    }

    public function toggle_current_sy (Request $request)
    {
        $OnlineAppointment = OnlineAppointment::where('id', $request->id)->first();
        if ($OnlineAppointment) 
        {
            if ($OnlineAppointment->current == 0) 
            {
                $OnlineAppointment->current = 1; 
                $OnlineAppointment->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully added to current active Discount Fee.']);
            }
            else 
            {
                $OnlineAppointment->current = 0; 
                $OnlineAppointment->save(); 
                return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully removed from current active Discount Fee.']);
            }
        }
    }

    public function deactivate_data (Request $request) 
    {
        $OnlineAppointment = OnlineAppointment::where('id', $request->id)->first();

        if ($OnlineAppointment)
        {
            $OnlineAppointment->status = 0;
            $OnlineAppointment->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Data successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function appointment(Request $request){

        $User = Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)
            ->first();

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        if ($request->ajax())
        {
            $Appointed = StudentTimeAppointment::with('appointment')
                ->where('student_id', $StudentInformation->id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('current', 1)
                ->get();

            $OnlineAppointment = OnlineAppointment::where('status', 1)
                ->get();

            $hasAppointment =  StudentTimeAppointment::with('appointment')
                ->where('student_id', $StudentInformation->id)
                ->where('school_year_id', $SchoolYear->id)
                ->where('current', 1)
                ->first();

            return view('control_panel_student.online_appointment.partials.data_list', 
                compact('OnlineAppointment', 'Appointed','StudentInformation','SchoolYear','hasAppointment'))
                ->render();
        }


        $Appointed = StudentTimeAppointment::with('appointment')
            ->where('student_id', $StudentInformation->id)
            ->where('school_year_id', $SchoolYear->id)
            ->where('current', 1)
            ->get();
        
        $OnlineAppointment = OnlineAppointment::where('status', 1)
            ->get();

        $hasAppointment =  StudentTimeAppointment::with('appointment')
            ->where('student_id', $StudentInformation->id)
            ->where('school_year_id', $SchoolYear->id)
            ->where('current', 1)
            ->first();
        
        return view('control_panel_student.online_appointment.index', 
            compact('OnlineAppointment', 'Appointed','StudentInformation','SchoolYear', 'hasAppointment'))->render();
    }

    public function reserve(Request $request)
    {
        $User = Auth::user();
        $StudentInformation = StudentInformation::where('user_id', $User->id)
            ->first();

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();

        $Reserved = OnlineAppointment::where('id', $request->id)
            ->where('school_year_id', $SchoolYear->id)
            ->first();

        if ($Reserved)
        {
            $available_no = ($Reserved->available_students - 1);
            $Reserved->available_students = $available_no;            
            $Reserved->save();

            $StudentTimeAppointment = new StudentTimeAppointment();
            $StudentTimeAppointment->school_year_id = $SchoolYear->id;
            $StudentTimeAppointment->online_appointment_id = $request->id;
            $StudentTimeAppointment->student_id = $StudentInformation->id;            
                
            $hasNumber =  StudentTimeAppointment::where('online_appointment_id', $Reserved->id)->orderBY('queueing_number', 'DESC')->first();

            if($hasNumber)
            {
                $hasNumber->queueing_number;
                $StudentTimeAppointment->queueing_number = $hasNumber->queueing_number + 1;

            }else{
                $StudentTimeAppointment->queueing_number = 1;
            }
            

            if($StudentTimeAppointment->save()){
                $hasAppointment = StudentTimeAppointment::find($StudentTimeAppointment->id);
                \Mail::to($request->email)->send(new OnlineAppointmentMail($hasAppointment));
                \Mail::to('finance@sja-bataan.com')->send(new OnlineAppointmentFinanceMail($hasAppointment));
                return response()->json(['res_code' => 0, 'res_msg' => 'You have successfully reserve your appointment! Please check your email.']);
            }
            
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.'.$request->id]);
    }
    
    public function date_time(Request $request){
        
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();      

        $date_time = OnlineAppointment::where('status', 1)->where('school_year_id', $SchoolYear->id)
            ->get();

        return view('control_panel_finance.online_appointment.index', compact('date_time'))->render();
    }

    public function show(Request $request){
        
        if($request->js_date){
            $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();        

            $appointment = OnlineAppointment::join('student_time_appointments', 'student_time_appointments.online_appointment_id','=','online_appointments.id')
                ->join('student_informations', 'student_informations.id','=','student_time_appointments.student_id')
                ->select(\DB::raw("
                    student_time_appointments.id as student_time_appointment_id, 
                    CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    student_time_appointments.queueing_number,
                    student_time_appointments.status

                "))
                ->where('student_time_appointments.status', 1)
                ->where('online_appointments.status', 1)
                ->where('online_appointments.id', $request->js_date)
                ->where('online_appointments.school_year_id', $SchoolYear->id)
                ->orderBy('student_time_appointments.id', 'ASC')
                ->get();

            $hasAppointment =  OnlineAppointment::join('student_time_appointments', 'student_time_appointments.online_appointment_id','=','online_appointments.id')
                ->select(\DB::raw("
                    student_time_appointments.id as student_appointment_id
                "))
                ->where('student_time_appointments.status', 1)
                ->where('online_appointments.school_year_id', $SchoolYear->id)
                ->where('online_appointments.id', $request->js_date)
                ->first();

            $OnlineAppointment =  OnlineAppointment::where('school_year_id', $SchoolYear->id)
                ->where('id', $request->js_date)
                ->where('current', 1)
                ->first();

        }else{
            echo 'invalid';
        }       

        return view('control_panel_finance.online_appointment.partials.data_list', compact('appointment', 'hasAppointment', 'OnlineAppointment'))->render();
    }

    public function done (Request $request) 
    {
        $OnlineAppointment = StudentTimeAppointment::where('id', $request->id)
            ->first();

        if ($OnlineAppointment)
        {
            $OnlineAppointment->status = 0;
            $OnlineAppointment->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'This appointment successfully done.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }

    public function deactivate_date (Request $request) 
    {
        $OnlineAppointment = OnlineAppointment::where('id', $request->id)->first();

        if ($OnlineAppointment)
        {
            $OnlineAppointment->status = 0;
            $OnlineAppointment->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'This appointment successfully deactivated.']);
        }
        return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.']);
    }
}
