<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Barryvdh\DomPDF\PDF;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use Illuminate\Http\Request;
use App\Traits\HasSchoolYear;
use App\Models\ClassSubjectDetail;
use App\Models\StudentInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\FacadesAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentEnrolledSubject;

class GradeSheetController extends Controller
{

    use HasSchoolYear;

    private function student()
    {
        return StudentInformation::where('user_id', Auth::user()->id)->first();
    }

    public function classDetail($Enrollment)
    {
        return  ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
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
                    ->where('class_details.id', $Enrollment[0]->cid)
                    ->first();
    }

    private function enrollment($request,$has_schoolyear,$sem){

        $StudentInformation = $this->student();

        $query = Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
            ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
            ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')                                
            ->select(\DB::raw("
                enrollments.id as enrollment_id,
                enrollments.class_details_id as cid,
                enrollments.attendance,
                enrollments.attendance_first,
                enrollments.attendance_second,
                enrollments.j_lacking_unit,
                enrollments.s1_lacking_unit,
                class_details.grade_level,
                class_subject_details.id as class_subject_details_id,
                class_subject_details.class_days,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.status as grade_status,
                class_subject_details.class_subject_order,
                class_subject_details.class_details_id,
                CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name) as faculty_name,
                subject_details.id AS subject_id,
                subject_details.subject_code,
                subject_details.subject,
                rooms.room_code,
                section_details.section
                
            "))
            ->where('enrollments.student_information_id', $StudentInformation->id)
            ->where('class_subject_details.status', '!=', 0)
            ->where('enrollments.status', 1)
            ->where('class_details.status', 1)
            ->where('class_subject_details.status', 1)
            // ->where('class_subject_details.sem', 1)
            ->where('class_details.school_year_id', $request->school_year)
            ->orderBy('class_subject_details.class_subject_order', 'ASC');

            // return json_encode($Enrollment);
            if($has_schoolyear->classDetail->grade_level > 10){
                $query->where('class_subject_details.sem', $sem);
            }
            return $query->get();
            // return $Enrollment = $query->orderBy('class_subject_details.class_subject_order', 'ASC')
            // ->get();
    }

    public function index (Request $request)
    {
        $StudentInformation = $this->student();        
        $School_years = $this->schoolYears();
        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();
        
        if($request->ajax())
        {
            
            $enrolled = 0;
            
            try{
                $has_schoolyear = Enrollment::with(['classDetail', 'faculty', 'section', 'subject'])
                    ->whereStatus(1)
                    ->whereHas('classDetail', function($query) use ($request) {
                        $query->where('school_year_id', $request->school_year);
                    })
                    ->whereStudentInformationId($StudentInformation->id)
                    ->first();
                // return json_encode($has_schoolyear->classDetail->grade_level);
            }catch(\Exception $e){
                return '<div class="box-body"><div class="row"><table class="table"><tbody><tr><th style="text-align:center"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.</th></tr></tbody></table></div></div>';
            }            

            try{
                if($has_schoolyear->id){        
                    if ($StudentInformation) 
                    {
                        try{
                            $school_year = SchoolYear::whereId($request->school_year)->first();

                            if('2020-2021' == $school_year->school_year)
                            {
                                
                                $table_header1 = [
                                    ['key' => 'Aug',],
                                    ['key' => 'Sep',],
                                    ['key' => 'Oct',],
                                    ['key' => 'Nov',],
                                    ['key' => 'Dec',],
                                    ['key' => 'total']
                                ];
                                
                                $table_header2 = [
                                    ['key' => 'Jan',],
                                    ['key' => 'Feb',],
                                    ['key' => 'Mar',],
                                    ['key' => 'Apr',],
                                    ['key' => 'total']
                                ]; 
                            
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
                            else
                            {
                                
                                $table_header1 = [
                                    ['key' => 'Jun',],
                                    ['key' => 'Jul',],
                                    ['key' => 'Aug',],
                                    ['key' => 'Sep',],
                                    ['key' => 'Oct',],
                                    ['key' => 'total'],
                                ];      
                                
                                $table_header2 = [
                                    ['key' => 'Nov',],
                                    ['key' => 'Dec',],
                                    ['key' => 'Jan',],
                                    ['key' => 'Feb',],
                                    ['key' => 'Mar',],
                                    ['key' => 'Apr',],
                                    ['key' => 'total'],
                                ];      
                                
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
                                
                            }

                            $ClassDetail = [];
                            if($has_schoolyear->classDetail->grade_level < 11)
                            {
                                $Enrollment = $this->enrollment($request, $has_schoolyear, $sem = null);
                                
                                // return json_encode($Enrollment);
                                if ($Enrollment)
                                {       
                                    $ClassDetail = $this->classDetail($Enrollment);
                                }
                                // return json_encode($Enrollment[0]->attendance);

                                try {
                                    if ($Enrollment[0]->attendance) {
                                        $attendance_data = json_decode($Enrollment[0]->attendance);
                                        $student_attendance = [
                                            'attendance_data'       => $attendance_data,
                                            'table_header'          => $table_header,
                                            'days_of_school_total'  => array_sum($attendance_data->days_of_school),
                                            'days_present_total'    => array_sum($attendance_data->days_present),
                                            'days_absent_total'     => array_sum($attendance_data->days_absent),
                                            'times_tardy_total'     => array_sum($attendance_data->times_tardy),
                                        ];
                                    }
                                } catch (\Throwable $th) {
                                    $student_attendance = '';
                                }

                                $grade_status = $Enrollment[0]->grade_status;
                            
                                $GradeSheetData = [];
                                $grade_level = 1;
                                $sub_total = 0;
                                $general_avg = 0;
                                $subj_count = 0;
                                
                                // return json_encode(['Enrollment' => $Enrollment,'StudentInformation' => $StudentInformation, 'SchoolYear' => $SchoolYear]);
                                if($StudentInformation && count($Enrollment)>0)
                                {
                                    if ($has_schoolyear->classDetail->grade_level < 11)
                                    {
                                        $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                                            ->get();
                                        $grade_level = $Enrollment[0]->grade_level;
                                        // return json_encode(['StudentEnrolledSubject'=> $StudentEnrolledSubject]);

                                            $GradeSheetData = $Enrollment->map(function ($item, $key) use ($StudentEnrolledSubject, $grade_level, $grade_status) {
                                                // $grade = $StudentEnrolledSubject->firstWhere('subject_id', $item->subject_id);
                                                $grade = $StudentEnrolledSubject->firstWhere('class_subject_details_id', $item->class_subject_details_id);
                                                $sum = 0;
                                                $first = $grade->fir_g > 0 ? $grade->fir_g : 0;
                                                $second = $grade->sec_g > 0 ? $grade->sec_g : 0;
                                                $third = $grade->thi_g > 0 ? $grade->thi_g : 0;
                                                $fourth = $grade->fou_g > 0 ? $grade->fou_g : 0;
                                                
                                                
                                                $sum += $grade->fir_g > 0 ? $grade->fir_g : 0;
                                                $sum += $grade->sec_g > 0 ? $grade->sec_g : 0;
                                                $sum += $grade->thi_g > 0 ? $grade->thi_g : 0;
                                                $sum += $grade->fou_g > 0 ? $grade->fou_g : 0;
                                                
                        
                                                $divisor = 0;
                                                $divisor += $first > 0 ? 1 : 0;
                                                $divisor += $second > 0 ? 1 : 0;
                                                $divisor += $third > 0 ? 1 : 0;
                                                $divisor += $fourth > 0 ? 1 : 0;
                        
                                                $final = 0;
                                                if ($divisor != 0) 
                                                {
                                                    $final = $sum / $divisor;
                                                }

                                                return $data = $this->returnData($item, $grade, $final, $grade_status, $divisor, $subject=null);
                                                
                                            });
                                            for ($i=0; $i<count($GradeSheetData); $i++)
                                            {
                                                if ($GradeSheetData[$i]['final_g'] > 0 && $GradeSheetData[$i]['grade_status'] == 2) 
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
                                }

                                $GradeSheetData = json_decode(json_encode($GradeSheetData));
                            }
                            
                            if($has_schoolyear->classDetail->grade_level > 10){
                                            
                                    // $Enrollment_first_sem = 
                                    $Enrollment_first_sem = $this->enrollment($request, $has_schoolyear, $sem = 1);

                                    if ($Enrollment_first_sem)
                                    {
                                        $Enrollment = $Enrollment_first_sem;
                                        $ClassDetail = $this->classDetail($Enrollment);
                                    }
                                    // return json_encode($Enrollment_first_sem);
                                    $grade_status = $Enrollment_first_sem[0]->grade_status;
                                    try {
                                        if($Enrollment_first_sem[0]){
                                            $attendance_data1 = json_decode($Enrollment_first_sem[0]->attendance_first);
                                            $student_attendance1 = [
                                                'attendance_data'   => $attendance_data1,
                                                'table_header'      => $table_header1,
                                                'days_of_school_total' => array_sum($attendance_data1->days_of_school),
                                                'days_present_total' => array_sum($attendance_data1->days_present),
                                                'days_absent_total' => array_sum($attendance_data1->days_absent),
                                                'times_tardy_total' => array_sum($attendance_data1->times_tardy),
                                            ];
                                        }else{
                                            $attendance_data1 = '';
                                        }
                                    } catch (\Throwable $th) {
                                        $attendance_data1 = '';
                                    }

                                    $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $Enrollment_first_sem[0]->enrollment_id)
                                        ->where('sem', 1)
                                        ->get();

                                    // return json_encode($StudentEnrolledSubject);
                                    

                                    $Enrollment_first_sem = $Enrollment_first_sem->map(function($item, $key) use ($StudentEnrolledSubject, $grade_status){
                    
                                        // $grade = $StudentEnrolledSubject->firstWhere('subject_id', $item->subject_id);
                                        $grade = $StudentEnrolledSubject->where('subject_id', $item->subject_id)->where('sem', 1)->first();
                                        
                                        // return json_encode($grade);
                                        $subject = ClassSubjectDetail::where('id', $grade->class_subject_details_id)                                        
                                            ->orderBY('class_subject_order', 'ASC')->first();
                                        $sum = 0;

                                        $first = $grade->fir_g > 0 ? $grade->fir_g : 0;
                                        $second = $grade->sec_g > 0 ? $grade->sec_g : 0;

                                        $sum += $grade->fir_g > 0 ? $grade->fir_g : 0;
                                        $sum += $grade->sec_g > 0 ? $grade->sec_g : 0;
                                    
                                        $divisor = 0;
                                        $divisor += $first > 0 ? 1 : 0;
                                        $divisor += $second > 0 ? 1 : 0;
                                        
                                        $final = 0;
                                        if ($divisor != 0) 
                                        {
                                            $final = $sum / $divisor;
                                        }
                                        
                                        return $data = $this->returnData($item, $grade, $final, $grade_status, $divisor, $subject);
                                    });

                                // return json_encode($Enrollment_first_sem);
                                
                                $Enrollment_secondsem = $this->enrollment($request, $has_schoolyear, $sem = 2);
                                

                                $grade_status = $Enrollment_secondsem[0]->grade_status;

                                try {
                                    if($Enrollment_secondsem[0]){
                                        $attendance_data2 = json_decode($Enrollment_secondsem[0]->attendance_second);
                                        $student_attendance2 = [
                                            'attendance_data'   => $attendance_data2,
                                            'table_header'      => $table_header2,
                                            'days_of_school_total' => array_sum($attendance_data2->days_of_school),
                                            'days_present_total' => array_sum($attendance_data2->days_present),
                                            'days_absent_total' => array_sum($attendance_data2->days_absent),
                                            'times_tardy_total' => array_sum($attendance_data2->times_tardy),
                                        ];
                                    }else{
                                        $attendance_data2 = '';
                                    }
                                } catch (\Throwable $th) {
                                    $attendance_data2 = '';
                                }

                                $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $Enrollment_secondsem[0]->enrollment_id)
                                    ->get();
                                        
                                // return json_encode($StudentEnrolledSubject->class_subject_details_id);

                                $Enrollment_secondsem = $Enrollment_secondsem->map(function($item, $key) use ($StudentEnrolledSubject, $grade_status){
                
                                    // $grade = $StudentEnrolledSubject->firstWhere('subject_id', $item->subject_id)
                                    // ->where('class_subject_details_id', $item->class_subject_details_id);
                                    $grade = $StudentEnrolledSubject->where('class_subject_details_id', $item->class_subject_details_id)->first();                              
                                    
                                    // return json_encode($grade['class_subject_details_id']);
                                    $subject = ClassSubjectDetail::where('id', $grade['class_subject_details_id'])                                        
                                        ->orderBY('class_subject_order', 'ASC')->first();                               
                                    // return $item->classSubject->subject;
                                    $sum = 0;

                                    $first = $grade['thi_g'] > 0 ? $grade['thi_g'] : 0;
                                    $second = $grade['fou_g'] > 0 ? $grade['fou_g'] : 0;

                                    $sum += $grade['thi_g'] > 0 ? $grade['thi_g'] : 0;
                                    $sum += $grade['fou_g'] > 0 ? $grade['fou_g'] : 0;
                                
                                    $divisor = 0;
                                    $divisor += $first > 0 ? 1 : 0;
                                    $divisor += $second > 0 ? 1 : 0;
                                    
                                    $final = 0;
                                    if ($divisor != 0) 
                                    {
                                        $final = $sum / $divisor;
                                    }
                                    
                                    return $data = $this->returnData($item, $grade, $final, $grade_status, $divisor, $subject = null);
                                });
                            }
                            // return json_encode($Enrollment_secondsem);
                            
                            $GradeSheet = 1;
                            
                            try {
                                return view('control_panel_student.grade_sheet.partials.data_list', 
                                compact(
                                        'GradeSheetData', 'grade_level', 'StudentInformation', 'ClassDetail',
                                        'general_avg','Enrollment','Enrollment_first_sem','Enrollment_secondsem',
                                        'GradeSheet','School_years','student_attendance1','student_attendance2',
                                        'student_attendance'
                                    ));
                            } catch (\Throwable $th) {
                                return view('control_panel_student.grade_sheet.partials.data_list', 
                                compact(
                                        'GradeSheetData', 'grade_level', 'StudentInformation', 'ClassDetail',
                                        'general_avg','Enrollment','Enrollment_first_sem','Enrollment_secondsem',
                                        'GradeSheet','School_years','student_attendance1',
                                        'student_attendance','SchoolYear'
                                    ));
                            }
                        
                            // return json_encode(['GradeSheetData' => $GradeSheetData,]);
                        }catch(\Exception $e){                
                            return '<div class="box-body"><div class="row"><table class="table"><tbody><tr><th style="text-align:center"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.</th></tr></tbody></table></div></div>';
                        }
                    }else{
                        echo "Invalid request";
                    }                    
                        
                }
            }catch(\Exception $e){
                return '<div class="box-body"><div class="row"><table class="table"><tbody><tr><th style="text-align:center"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.</th></tr></tbody></table></div></div>';
            }    
        }
        $GradeSheet = 0;
        return view('control_panel_student.grade_sheet.index', compact('GradeSheet','School_years','SchoolYear'));
        
    }

    private function returnData($item, $grade, $final, $grade_status, $divisor, $subject)
    {
        return $data = [
            'enrollment_id'             =>      $item->enrollment_id,
            'grade_level'               =>      $item->grade_level,
            'class_days'                =>      $item->class_days,
            'class_time_from'           =>      $item->class_time_from,
            'class_time_to'             =>      $item->class_time_to,
            'faculty_name'              =>      $item->faculty_name,
            'subject_id'                =>      $item->subject_id,
            'subject_code'              =>      $item->subject_code,
            'subject'                   =>      $subject ? $subject->subject : $item->classSubject->subject,
            'room_code'                 =>      $item->room_code,
            'section'                   =>      $item->section,
            'grade_id'                  =>      $grade->id,
            'fir_g'                     =>      $grade->fir_g,
            'sec_g'                     =>      $grade->sec_g,
            'thi_g'                     =>      $grade->thi_g,
            'fou_g'                     =>      $grade->fou_g,
            'final_g'                   =>      $final,
            'grade_status'              =>      $grade_status,
            'divisor'                   =>      $divisor,
            'class_subject_details_id'  =>      $item->class_subject_details_id,
        ];
    }

    
    public function print_grades (Request $request)
    {
        $StudentInformation = $this->student();

        $SchoolYear = SchoolYear::where('current', 1)
            ->where('status', 1)
            ->first();
        
        if ($StudentInformation) 
        {
            
            $Enrollment = $this->enrollment($request, $has_schoolyear = null , $sem = null);

            $ClassDetail = [];
            if ($Enrollment)
            {
                $ClassDetail = $this->classDetail($Enrollment);
            }


            $GradeSheetData = [];
            $grade_level = 1;
            $sub_total = 0;
            $general_avg = 0;
            $subj_count = 0;
            $grade_status = $Enrollment[0]->grade_status;
            // return json_encode(['Enrollment' => $Enrollment,'StudentInformation' => $StudentInformation, 'SchoolYear' => $SchoolYear]);
            if ($StudentInformation && count($Enrollment)>0)
            {
                $StudentEnrolledSubject = StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                ->get();
                $grade_level = $Enrollment[0]->grade_level;
                // return json_encode(['StudentEnrolledSubject'=> $StudentEnrolledSubject]);
                $GradeSheetData = $Enrollment->map(function ($item, $key) use ($StudentEnrolledSubject, $grade_level, $grade_status) {
                    // $grade = $StudentEnrolledSubject->firstWhere('subject_id', $item->subject_id);
                    $grade = $StudentEnrolledSubject->firstWhere('class_subject_details_id', $item->class_subject_details_id);
                    $sum = 0;
                    $first = $grade->fir_g > 0 ? $grade->fir_g : 0;
                    $second = $grade->sec_g > 0 ? $grade->sec_g : 0;
                    $third = $grade->thi_g > 0 ? $grade->thi_g : 0;
                    $fourth = $grade->fou_g > 0 ? $grade->fou_g : 0;
                    
                    
                    $sum += $grade->fir_g > 0 ? $grade->fir_g : 0;
                    $sum += $grade->sec_g > 0 ? $grade->sec_g : 0;
                    $sum += $grade->thi_g > 0 ? $grade->thi_g : 0;
                    $sum += $grade->fou_g > 0 ? $grade->fou_g : 0;
                    

                    $divisor = 0;
                    $divisor += $first > 0 ? 1 : 0;
                    $divisor += $second > 0 ? 1 : 0;
                    $divisor += $third > 0 ? 1 : 0;
                    $divisor += $fourth > 0 ? 1 : 0;

                    $final = 0;
                    if ($divisor != 0) 
                    {
                        $final = $sum / $divisor;
                    }
                    return $data = $this->returnData($item, $grade, $final, $grade_status, $divisor, $subject=null);
                });
                for ($i=0; $i<count($GradeSheetData); $i++)
                {
                    if ($GradeSheetData[$i]['final_g'] > 0 && $GradeSheetData[$i]['grade_status'] == 2) 
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
            $pdf = \PDF::loadView('control_panel_student.grade_sheet.partials.print', 
                compact('GradeSheetData', 'grade_level', 'StudentInformation', 'ClassDetail',
                     'general_avg','Enrollment'));
            // $pdf->setPaper('Letter', 'landscape');
            return $pdf->stream();
            return view('control_panel_student.grade_sheet.index', compact('GradeSheetData'));
            return json_encode(['GradeSheetData' => $GradeSheetData,]);
        }else{
            echo "Invalid request";
        }
    }
}