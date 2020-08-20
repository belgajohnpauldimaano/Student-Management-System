<?php

namespace App\Http\Controllers\Control_Panel_Student;

use App\Enrollment;
use App\SchoolYear;
use App\ClassDetail;
use App\StudentInformation;
use Illuminate\Http\Request;
use App\StudentEnrolledSubject;
use App\Http\Controllers\Controller;

class GradeSheetController extends Controller
{
    public function index (Request $request)
    {
        $StudentInformation = StudentInformation::where('user_id', \Auth::user()->id)->first();
        
        $School_years = SchoolYear::where('status', 1)->get();

        
        if($request->ajax())
        {
            
            $enrolled = 0;
            try{
                $has_schoolyear = ClassDetail::where('school_year_id' ,$request->school_year)
                    ->first()->id;
            }catch(\Exception $e){
                return '<div class="box-body"><div class="row"><table class="table"><tbody><tr><th style="text-align:center"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.</th></tr></tbody></table></div></div>';
            }
            

            if($has_schoolyear){        
                if ($StudentInformation) 
                {
                    try{
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
                            ->where('class_details.school_year_id', $request->school_year)
                            ->select(\DB::raw("
                                enrollments.id as enrollment_id,
                                enrollments.class_details_id as cid,
                                enrollments.attendance,
                                class_details.grade_level,
                                class_subject_details.id as class_subject_details_id,
                                class_subject_details.class_days,
                                class_subject_details.class_time_from,
                                class_subject_details.class_time_to,
                                class_subject_details.status as grade_status,
                                CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                                subject_details.id AS subject_id,
                                subject_details.subject_code,
                                subject_details.subject,
                                rooms.room_code,
                                section_details.section
                            "))
                            ->orderBy('class_subject_details.class_subject_order', 'ASC')
                            ->get();
        
                        $ClassDetail = [];
                        // if($Enrollment){
                        //     $GradeSheet = 0;
                        //     return view('control_panel_student.grade_sheet.index', compact('GradeSheet'));
                        // }   
                        if ($Enrollment)
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
                                ->where('class_details.id', $Enrollment[0]->cid)
                                ->first();
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
                                    'final_g'           =>  $final,
                                    'grade_status'      =>  $grade_status,
                                    'divisor' => $divisor,
                                    'class_subject_details_id' => $item->class_subject_details_id,
                                ];
                                return $data;
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
        
                        $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
                            ->where('sem', 1)
                            ->get();
        
                            $Enrollment_first_sem = \App\Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                                ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
                                ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
                                ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
                                ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                                ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')                                
                                ->select(\DB::raw("
                                    enrollments.id as enrollment_id,
                                    enrollments.class_details_id as cid,
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
                                    CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
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
                                ->where('class_subject_details.sem', 1)
                                ->where('class_details.school_year_id', $request->school_year)
                                ->orderBy('class_subject_details.class_subject_order', 'ASC')
                                ->get();
                            
                            
            
                            $Enrollment_secondsem = \App\Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                                ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
                                ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
                                ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
                                ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                                ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
                                ->where('student_information_id', $StudentInformation->id)
                                ->where('class_subject_details.status', '!=', 0)
                                ->where('class_subject_details.sem', 2)
                                ->where('enrollments.status', 1)
                                ->where('class_details.status', 1)                            
                                ->where('class_details.school_year_id', $request->school_year)
                                ->select(\DB::raw("
                                    enrollments.id as enrollment_id,
                                    enrollments.class_details_id as cid,
                                    enrollments.attendance_first,
                                    enrollments.attendance_second,
                                    enrollments.s2_lacking_unit,
                                    class_details.grade_level,
                                    class_subject_details.id as class_subject_details_id,
                                    class_subject_details.class_days,
                                    class_subject_details.class_time_from,
                                    class_subject_details.class_time_to,
                                    class_subject_details.status as grade_status,
                                    CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                                    subject_details.id AS subject_id,
                                    subject_details.subject_code,
                                    subject_details.subject,
                                    rooms.room_code,
                                    section_details.section
                                    
                                "))
                                ->orderBy('class_subject_details.class_subject_order', 'ASC')
                                ->get();
                        
                        $GradeSheet = 1;
        
                        $GradeSheetData = json_decode(json_encode($GradeSheetData));
                        return view('control_panel_student.grade_sheet.partials.data_list', 
                            compact('GradeSheetData', 'grade_level', 'StudentInformation', 'ClassDetail',
                            'general_avg','Enrollment','Enrollment_first_sem','Enrollment_secondsem','findSchoolYear',
                            'GradeSheet','School_years'));
                            return json_encode(['GradeSheetData' => $GradeSheetData,]);
                    }catch(\Exception $e){                
                        return '<div class="box-body"><div class="row"><table class="table"><tbody><tr><th style="text-align:center"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.</th></tr></tbody></table></div></div>';
                    }
                }else{
                    echo "Invalid request";
                }
                    
            }
            
        }
        
        $GradeSheet = 0;
        return view('control_panel_student.grade_sheet.index', compact('GradeSheet','School_years'));
        
    }

    
    public function print_grades (Request $request)
    {
        $StudentInformation = \App\StudentInformation::where('user_id', \Auth::user()->id)->first();
        $SchoolYear = \App\SchoolYear::where('current', 1)
        ->where('status', 1)
        ->first();
        
        if ($StudentInformation) 
        {
            $Enrollment = \App\Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
            // ->join('student_enrolled_subjects', 'student_enrolled_subjects.enrollments_id', '=', 'enrollments.id')
            ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
            ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
            ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->where('student_information_id', $StudentInformation->id)
            // ->where('class_subject_details.status', 1)
            ->where('class_subject_details.status', '!=', 0)
            ->where('enrollments.status', 1)
            ->where('class_details.status', 1)
            ->where('class_details.school_year_id', $request->school_year)
            ->select(\DB::raw("
                enrollments.id as enrollment_id,
                enrollments.class_details_id as cid,
                enrollments.j_lacking_unit,
                class_details.grade_level,
                class_subject_details.id as class_subject_details_id,
                class_subject_details.class_days,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.status as grade_status,
                CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                subject_details.id AS subject_id,
                subject_details.subject_code,
                subject_details.subject,
                rooms.room_code,
                section_details.section
            "))
            ->orderBy('class_subject_details.class_subject_order', 'ASC')
            ->get();
            $ClassDetail = [];
            if ($Enrollment)
            {
                
                $ClassDetail = \App\ClassDetail::join('section_details', 'section_details.id', '=' ,'class_details.section_id')
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
                // ->where('school_years.current', 1)
                ->where('class_details.id', $Enrollment[0]->cid)
                ->first();
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
                $StudentEnrolledSubject = \App\StudentEnrolledSubject::where('enrollments_id', $Enrollment[0]->enrollment_id)
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
                        'final_g'           =>  $final,
                        'grade_status'      =>  $grade_status,
                        'divisor' => $divisor
                    ];
                    return $data;
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
                compact('GradeSheetData', 'grade_level', 'StudentInformation', 'ClassDetail', 'general_avg','Enrollment'));
            // $pdf->setPaper('Letter', 'landscape');
            return $pdf->stream();
            return view('control_panel_student.grade_sheet.index', compact('GradeSheetData'));
            return json_encode(['GradeSheetData' => $GradeSheetData,]);
        }else{
            echo "Invalid request";
        }
    }
}
