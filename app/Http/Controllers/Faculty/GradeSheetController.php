<?php

namespace App\Http\Controllers\Faculty;

use PDF;
use App\Models\Enrollment;
use App\Models\SchoolYear;
use App\Models\ClassDetail;
use App\Models\SectionDetail;
use App\Models\SubjectDetail;
use App\Models\TeacherSubject;
use App\Models\Grade_sheet_first;
use App\Models\Grade_sheet_third;
use App\Models\ClassSubjectDetail;
use App\Models\FacultyInformation;
use App\Models\Grade11_Second_Sem;
use App\Models\Grade_sheet_fourth;
use App\Models\Grade_sheet_second;
use Illuminate\Http\Request;
use App\Models\Grade_sheet_firstsem;
use App\Models\StudentEnrolledSubject;
use Illuminate\Support\Facades\DB;
use App\Models\Grade_sheet_firstsemsecond;
use App\Models\Grade_sheet_secondsemsecond;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class GradeSheetController extends Controller
{    
    public function index (Request $request) 
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();
        // return json_encode(['FacultyInformation' => $FacultyInformation, 'Auth' => \Auth::user()]);
        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'ASC')->orderBy('school_year', 'DESC')->get();


        $faculty_id = TeacherSubject::join('class_subject_details','class_subject_details.id', '=', 'teacher_subjects.class_subject_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->select(\DB::raw('  
                class_subject_details.id,
                class_subject_details.class_details_id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                class_subject_details.sem,
                teacher_subjects.faculty_id
            '))
            ->where('teacher_subjects.faculty_id', $FacultyInformation->id)
            // ->where('class_details.school_year_id', $request->search_sy)
            ->where('teacher_subjects.status', 1)
            ->first();

        // return $faculty_id->faculty_id;
        try {
            if($faculty_id->faculty_id)
            {
                $faculty = 'teacher_subjects.faculty_id';
            }
            else
            {
                $faculty = 'class_subject_details.faculty_id';
            }
        } catch (\Throwable $th) {
            $faculty = 'class_subject_details.faculty_id';
        }
        
        $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            
            ->where($faculty, $FacultyInformation->id)
            // ->where('class_details.school_year_id', $SchoolYear->id)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('
                class_subject_details.id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                class_subject_details.sem
            '))
            ->first();
        
        return view('control_panel_faculty.student_grade_sheet.index', compact('SchoolYear','ClassSubjectDetail'));
    }

    public function list_students_by_class (Request $request)
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();

        $faculty_id = TeacherSubject::join('class_subject_details','class_subject_details.id', '=', 'teacher_subjects.class_subject_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->select(\DB::raw('  
                class_subject_details.id,
                class_subject_details.class_details_id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                class_subject_details.sem,
                teacher_subjects.faculty_id
            '))
            ->where('teacher_subjects.faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('teacher_subjects.status', 1)
            ->first();

        // return $faculty_id->faculty_id;
        try {
            if($faculty_id->faculty_id)
            {
                $faculty = 'teacher_subjects.faculty_id';
            }
            else
            {
                $faculty = 'class_subject_details.faculty_id';
            }
        } catch (\Throwable $th) {
            $faculty = 'class_subject_details.faculty_id';
        }
        
        $EnrollmentMale = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->join('student_enrolled_subjects', function ($join) {
                $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
            })
            ->where($faculty, $FacultyInformation->id)
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject)
            ->whereRaw('class_details.current = 1')
            ->whereRaw('class_details.status != 0')
            ->whereRaw('student_informations.gender = 1')
            ->where('enrollments.status',1)
            ->select(\DB::raw("
                student_informations.id,
                class_details.id as class_details_id,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_informations.gender,
                student_enrolled_subjects.id as student_enrolled_subject_id,
                enrollments.id as enrollment_id,
                student_enrolled_subjects.fir_g,
                student_enrolled_subjects.fir_g_status,
                student_enrolled_subjects.sec_g,
                student_enrolled_subjects.sec_g_status,
                student_enrolled_subjects.thi_g,
                student_enrolled_subjects.thi_g_status,
                student_enrolled_subjects.fou_g,
                student_enrolled_subjects.fou_g_status,
                student_enrolled_subjects.fin_g,
                student_enrolled_subjects.fin_g_status,
                class_subject_details.status as grading_status,
                class_subject_details.sem
            "))
            ->orderBy('student_name',  'ASC')
            ->paginate(100);
                    
                    
        $EnrollmentFemale = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->join('student_enrolled_subjects', function ($join) {
                $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
            })
            ->where($faculty, $FacultyInformation->id)
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject)
            ->whereRaw('class_details.current = 1')
            ->whereRaw('class_details.status != 0')
            ->whereRaw('student_informations.gender = 2')
            ->where('enrollments.status',1)
            ->select(\DB::raw("
                student_informations.id,
                class_details.id as class_details_id,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_informations.gender,
                student_enrolled_subjects.id as student_enrolled_subject_id,
                enrollments.id as enrollment_id,
                student_enrolled_subjects.fir_g,
                student_enrolled_subjects.fir_g_status,
                student_enrolled_subjects.sec_g,
                student_enrolled_subjects.sec_g_status,
                student_enrolled_subjects.thi_g,
                student_enrolled_subjects.thi_g_status,
                student_enrolled_subjects.fou_g,
                student_enrolled_subjects.fou_g_status,
                student_enrolled_subjects.fin_g,
                student_enrolled_subjects.fin_g_status,
                class_subject_details.status as grading_status,
                class_subject_details.sem
            "))
            ->orderBy('student_name', 'ASC')
            ->paginate(100);
        // return json_encode($Enrollment);
        // $ClassSubjectDetail_status = ClassSubjectDetail::where('id', $request->search_class_subject)->first();
        $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            ->where($faculty, $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('
                class_subject_details.id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                class_subject_details.sem
            '))
            ->first();
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_faculty.student_grade_sheet.partials.data_list', compact('EnrollmentFemale', 'EnrollmentMale', 'ClassSubjectDetail'))->render();
    }

    public function list_students_by_class_print (Request $request) 
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();
        // return json_encode(['FacultyInformation' => $FacultyInformation, 'req' => $request->all()]);

        // $faculty_id = TeacherSubject::join('class_subject_details','class_subject_details.id', '=', 'teacher_subjects.class_subject_details_id')
        //     ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
        //     ->select(\DB::raw('  
        //         class_subject_details.id,
        //         class_subject_details.class_details_id,
        //         class_subject_details.class_schedule,
        //         class_subject_details.class_time_from,
        //         class_subject_details.class_time_to,
        //         class_subject_details.class_days,
        //         class_subject_details.sem,
        //         teacher_subjects.faculty_id
        //     '))
        //     ->where('teacher_subjects.faculty_id', $FacultyInformation->id)
        //     ->where('class_details.school_year_id', $request->search_sy)
        //     ->where('teacher_subjects.status', 1)
        //     ->first();

        // return $faculty_id->faculty_id;
        try {
            if($faculty_id->faculty_id)
            {
                $faculty = 'teacher_subjects.faculty_id';
            }
            else
            {
                $faculty = 'class_subject_details.faculty_id';
            }
        } catch (\Throwable $th) {
            $faculty = 'class_subject_details.faculty_id';
        }

        $EnrollmentMale = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
                    ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
                    ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                    ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
                    ->join('student_enrolled_subjects', function ($join) {
                        $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
                    })
                    ->where($faculty, $FacultyInformation->id)
                    ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
                    ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject)
                    ->whereRaw('class_details.current = 1')
                    ->whereRaw('class_details.status != 0')
                    ->whereRaw('student_informations.gender = 1')
                    ->where('enrollments.status',1)
                    ->select(\DB::raw("
                        student_informations.id,
                        class_details.id as class_details_id,
                        CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                        student_enrolled_subjects.id as student_enrolled_subject_id,
                        enrollments.id as enrollment_id,
                        student_enrolled_subjects.fir_g,
                        student_enrolled_subjects.fir_g_status,
                        student_enrolled_subjects.sec_g,
                        student_enrolled_subjects.sec_g_status,
                        student_enrolled_subjects.thi_g,
                        student_enrolled_subjects.thi_g_status,
                        student_enrolled_subjects.fou_g,
                        student_enrolled_subjects.fou_g_status,
                        student_enrolled_subjects.fin_g,
                        student_enrolled_subjects.fin_g_status,
                        class_subject_details.status as grading_status 
                    "))
                    ->orderBy('student_informations.gender', 'ASC')
                    ->orderBy('student_name', 'ASC')
                    ->get();

        $EnrollmentFemale = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
                    ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
                    ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
                    ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
                    ->join('student_enrolled_subjects', function ($join) {
                        $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
                    })
                    ->where($faculty, $FacultyInformation->id)
                    ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
                    ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject)                    
                    ->whereRaw('class_details.current = 1')
                    ->whereRaw('class_details.status != 0')
                    ->whereRaw('student_informations.gender = 2')
                    ->where('enrollments.status',1)
                    ->select(\DB::raw("
                        student_informations.id,
                        class_details.id as class_details_id,
                        CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                        student_enrolled_subjects.id as student_enrolled_subject_id,
                        enrollments.id as enrollment_id,
                        student_enrolled_subjects.fir_g,
                        student_enrolled_subjects.fir_g_status,
                        student_enrolled_subjects.sec_g,
                        student_enrolled_subjects.sec_g_status,
                        student_enrolled_subjects.thi_g,
                        student_enrolled_subjects.thi_g_status,
                        student_enrolled_subjects.fou_g,
                        student_enrolled_subjects.fou_g_status,
                        student_enrolled_subjects.fin_g,
                        student_enrolled_subjects.fin_g_status,
                        class_subject_details.status as grading_status 
                    "))
                    ->orderBy('student_informations.gender', 'ASC')
                    ->orderBy('student_name', 'ASC')
                    ->get();
                    
        $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id', '=' ,'class_details.school_year_id')
            ->where($faculty, $FacultyInformation->id)
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('
                class_subject_details.id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                school_years.school_year
            '))
            ->first();
        if (count($EnrollmentFemale) == 0 || count($EnrollmentMale) == 0) {
            return "invalid request";
        }
        return view('control_panel_faculty.student_grade_sheet.partials.print', compact('EnrollmentFemale', 'EnrollmentMale', 'ClassSubjectDetail', 'FacultyInformation'));
        $pdf = \PDF::loadView('control_panel_faculty.student_grade_sheet.partials.print', compact('EnrollmentFemale', 'EnrollmentMale', 'ClassSubjectDetail', 'FacultyInformation'));
        $pdf->setPaper('Letter', 'portrait');
        return $pdf->stream();
    }
    
    public function list_class_subject_details (Request $request) 
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first(); 
       
        $faculty_id = TeacherSubject::join('class_subject_details','class_subject_details.id', '=', 'teacher_subjects.class_subject_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->select(\DB::raw('  
                class_subject_details.id,
                class_subject_details.class_details_id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                class_subject_details.sem,
                teacher_subjects.faculty_id
            '))
            ->where('teacher_subjects.faculty_id', $FacultyInformation->id)
            // ->where('class_details.school_year_id', $request->search_sy)
            ->where('teacher_subjects.status', 1)
            ->first();

        // return $faculty_id->faculty_id;
        try {
            if($faculty_id->faculty_id)
            {
                $faculty = 'teacher_subjects.faculty_id';
            }
            else
            {
                $faculty = 'class_subject_details.faculty_id';
            }
        } catch (\Throwable $th) {
            $faculty = 'class_subject_details.faculty_id';
        }
        

        // return $faculty;
        
        $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->where($faculty, $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('  
                class_subject_details.id,
                class_subject_details.class_details_id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                class_subject_details.sem,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level
            '))
            ->get();        
                
            $class_details_elements = '<option value="">Select Class Subject</option>';
            if ($ClassSubjectDetail) 
            {
                foreach ($ClassSubjectDetail as $data) 
                {
                    $class_details_elements .= '<option value="'. $data->id .'">'.  ' '. $data->subject_code . ' ' . $data->subject . ' - Grade ' .  $data->grade_level . ' Section ' . $data->section . '</option>';
                }
    
                return $class_details_elements;
            }
            return $class_details_elements;
                      
    }

    public function semester()
    {
        $class_details_elements = '<option value="">Select Semester</option>';
        $class_details_elements .= '<option value="1st">First Semester</option>';
        $class_details_elements .= '<option value="2nd">Second Semester</option>'; 
        return $class_details_elements;        
    }

    public function list_class_subject_details1 (Request $request) 
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();  
        $faculty_id = TeacherSubject::join('class_subject_details','class_subject_details.id', '=', 'teacher_subjects.class_subject_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->select(\DB::raw('  
                class_subject_details.id,
                class_subject_details.class_details_id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                class_subject_details.sem,
                teacher_subjects.faculty_id
            '))
            ->where('teacher_subjects.faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            ->where('teacher_subjects.status', 1)
            ->first();

        // return $faculty_id->faculty_id;
        try {
            if($faculty_id->faculty_id)
            {
                $faculty = 'teacher_subjects.faculty_id';
            }
            else
            {
                $faculty = 'class_subject_details.faculty_id';
            }
        } catch (\Throwable $th) {
            $faculty = 'class_subject_details.faculty_id';
        }

        if($request->search_semester == '1st')
        {
            
            $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
                ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
                ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
                ->where($faculty, $FacultyInformation->id)
                ->where('class_details.school_year_id', $request->search_sy1)
                ->where('class_subject_details.status', '!=', 0)
                ->where('class_details.status', '!=', 0)
                ->where('class_subject_details.sem', 1)
                ->select(\DB::raw('  
                    class_subject_details.id,
                    class_subject_details.class_details_id,
                    class_subject_details.class_schedule,
                    class_subject_details.class_time_from,
                    class_subject_details.class_time_to,
                    class_subject_details.class_days,
                    class_subject_details.sem,
                    subject_details.subject_code,
                    subject_details.subject,
                    section_details.section,
                    class_details.grade_level
                '))
                ->get();
            
            
                $class_details_elements = '<option value="">Select Class Subject</option>';
                if ($ClassSubjectDetail) 
                {
                    foreach ($ClassSubjectDetail as $data) 
                    {
                        $class_details_elements .= '<option value="'. $data->id .'">'. 'Semester-'. $data->sem . ' '. $data->subject_code . ' ' . $data->subject . ' - Grade ' .  $data->grade_level . ' Section ' . $data->section . '</option>';
                    }
        
                    return $class_details_elements;
                }
                return $class_details_elements;
          
           
        }
        else 
        {
            
            $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
                ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
                ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
                ->where($faculty, $FacultyInformation->id)
                ->where('class_details.school_year_id', $request->search_sy1)
                ->where('class_subject_details.status', '!=', 0)
                ->where('class_details.status', '!=', 0)
                ->where('class_subject_details.sem', 2)
                ->select(\DB::raw('  
                    class_subject_details.id,
                    class_subject_details.class_details_id,
                    class_subject_details.class_schedule,
                    class_subject_details.class_time_from,
                    class_subject_details.class_time_to,
                    class_subject_details.class_days,
                    class_subject_details.sem,
                    subject_details.subject_code,
                    subject_details.subject,
                    section_details.section,
                    class_details.grade_level
                '))
                ->get();
            
            
                $class_details_elements = '<option value="">Select Class Subject</option>';
                if ($ClassSubjectDetail) 
                {
                    foreach ($ClassSubjectDetail as $data) 
                    {
                        $class_details_elements .= '<option value="'. $data->id .'">'. 'Semester-'. $data->sem . ' '. $data->subject_code . ' ' . $data->subject . ' - Grade ' .  $data->grade_level . ' Section ' . $data->section . '</option>';
                    }
        
                    return $class_details_elements;
                }
                return $class_details_elements;
          
        }
        
        
    }

    public function list_students_by_class1 (Request $request) 
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();
        $faculty_id = TeacherSubject::where('faculty_id', $FacultyInformation->id)->first();
        
        if($faculty_id)
        {
            $faculty = 'teacher_subjects.faculty_id';
        }
        else
        {
            $faculty = 'faculty_id';
        }

        $EnrollmentMale = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->join('student_enrolled_subjects', function ($join) {
                $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
            })
            ->whereRaw($faculty.' = '. $FacultyInformation->id)
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject_sem)
            ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject_sem)
            ->whereRaw('class_details.current = 1')
            ->whereRaw('class_details.status != 0')
            ->whereRaw('student_informations.gender = 1')
            ->where('enrollments.status',1)
            ->select(\DB::raw("
                student_informations.id,
                class_details.id as class_details_id,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_informations.gender,
                student_enrolled_subjects.id as student_enrolled_subject_id,
                enrollments.id as enrollment_id,
                student_enrolled_subjects.fir_g,
                student_enrolled_subjects.fir_g_status,
                student_enrolled_subjects.sec_g,
                student_enrolled_subjects.sec_g_status,
                student_enrolled_subjects.thi_g,
                student_enrolled_subjects.thi_g_status,
                student_enrolled_subjects.fou_g,
                student_enrolled_subjects.fou_g_status,
                student_enrolled_subjects.fin_g,
                student_enrolled_subjects.fin_g_status,
                class_subject_details.status as grading_status,
                class_subject_details.sem
            "))
            ->orderBy('student_name',  'ASC')
            ->paginate(100);
            
                    
        $EnrollmentFemale = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->join('student_enrolled_subjects', function ($join) {
                $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
            })
            ->whereRaw($faculty.' = '. $FacultyInformation->id)
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject_sem)
            ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject_sem)
            ->whereRaw('class_details.current = 1')
            ->whereRaw('class_details.status != 0')
            ->whereRaw('student_informations.gender = 2')
            ->where('enrollments.status',1)
            ->select(\DB::raw("
                student_informations.id,
                class_details.id as class_details_id,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_informations.gender,
                student_enrolled_subjects.id as student_enrolled_subject_id,
                enrollments.id as enrollment_id,
                student_enrolled_subjects.fir_g,
                student_enrolled_subjects.fir_g_status,
                student_enrolled_subjects.sec_g,
                student_enrolled_subjects.sec_g_status,
                student_enrolled_subjects.thi_g,
                student_enrolled_subjects.thi_g_status,
                student_enrolled_subjects.fou_g,
                student_enrolled_subjects.fou_g_status,
                student_enrolled_subjects.fin_g,
                student_enrolled_subjects.fin_g_status,
                class_subject_details.status as grading_status,
                class_subject_details.sem
            "))
            ->orderBy('student_name', 'ASC')
            ->paginate(100);
        // return json_encode($Enrollment);
        // $ClassSubjectDetail_status = ClassSubjectDetail::where('id', $request->search_class_subject)->first();
        $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject_sem)
            ->where($faculty, $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy1)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('
                class_subject_details.id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                class_subject_details.sem
            '))
            ->first();
        // return json_encode($ClassSubjectDetail);
        $semester;
        if($request->search_semester == '1st')
        {
            $semester = 1;
        }
        else 
        {
            $semester = 2;
        }
        return view('control_panel_faculty.student_grade_sheet.partials.data_list', 
            compact('EnrollmentFemale', 'EnrollmentMale', 'ClassSubjectDetail','semester'))->render();
    }

    public function list_students_by_class_print_senior (Request $request) 
    {
        
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();

        $faculty_id = TeacherSubject::where('faculty_id', $FacultyInformation->id)->first();
        
        if($faculty_id)
        {
            $faculty = 'teacher_subjects.faculty_id';
        }
        else
        {
            $faculty = 'faculty_id';
        }
        // return json_encode(['FacultyInformation' => $FacultyInformation, 'req' => $request->all()]);
        $EnrollmentMale = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->join('student_enrolled_subjects', function ($join) {
                $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
            })
            ->where($faculty, $FacultyInformation->id)
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject_sem)
            ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject_sem)
            ->where('enrollments.status',1)
            ->whereRaw('class_details.current = 1')
            ->whereRaw('class_details.status != 0')
            ->whereRaw('student_informations.gender = 1')
            ->select(\DB::raw("
                student_informations.id,
                class_details.id as class_details_id,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_enrolled_subjects.id as student_enrolled_subject_id,
                enrollments.id as enrollment_id,
                student_enrolled_subjects.fir_g,
                student_enrolled_subjects.fir_g_status,
                student_enrolled_subjects.sec_g,
                student_enrolled_subjects.sec_g_status,
                student_enrolled_subjects.thi_g,
                student_enrolled_subjects.thi_g_status,
                student_enrolled_subjects.fou_g,
                student_enrolled_subjects.fou_g_status,
                student_enrolled_subjects.fin_g,
                student_enrolled_subjects.fin_g_status,
                class_subject_details.status as grading_status 
            "))
            ->orderBy('student_informations.gender', 'ASC')
            ->orderBy('student_name', 'ASC')
            ->get();

        $EnrollmentFemale = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
            ->join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('student_informations', 'student_informations.id', '=', 'enrollments.student_information_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->join('student_enrolled_subjects', function ($join) {
                $join->on('student_enrolled_subjects.enrollments_id', '=', 'enrollments.id');
            })
            ->where($faculty, $FacultyInformation->id)
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject_sem)
            ->whereRaw('student_enrolled_subjects.class_subject_details_id = '. $request->search_class_subject_sem)
            ->where('enrollments.status',1)
            ->whereRaw('class_details.current = 1')
            ->whereRaw('class_details.status != 0')
            ->whereRaw('student_informations.gender = 2')
            ->select(\DB::raw("
                student_informations.id,
                class_details.id as class_details_id,
                CONCAT(student_informations.last_name, ', ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                student_enrolled_subjects.id as student_enrolled_subject_id,
                enrollments.id as enrollment_id,
                student_enrolled_subjects.fir_g,
                student_enrolled_subjects.fir_g_status,
                student_enrolled_subjects.sec_g,
                student_enrolled_subjects.sec_g_status,
                student_enrolled_subjects.thi_g,
                student_enrolled_subjects.thi_g_status,
                student_enrolled_subjects.fou_g,
                student_enrolled_subjects.fou_g_status,
                student_enrolled_subjects.fin_g,
                student_enrolled_subjects.fin_g_status,
                class_subject_details.status as grading_status 
            "))
            ->orderBy('student_informations.gender', 'ASC')
            ->orderBy('student_name', 'ASC')
            ->get();
                    
        $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id', '=' ,'class_details.school_year_id')
            ->leftJoin('teacher_subjects', 'teacher_subjects.class_subject_details_id', '=', 'class_subject_details.id')
            ->whereRaw('class_subject_details.id = '. $request->search_class_subject_sem)            
            ->where($faculty, $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy1)
            ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('
                class_subject_details.id,
                class_subject_details.class_schedule,
                class_subject_details.class_time_from,
                class_subject_details.class_time_to,
                class_subject_details.class_days,
                class_subject_details.sem,
                subject_details.subject_code,
                subject_details.subject,
                section_details.section,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                school_years.school_year
            '))
            ->first();

        if (count($EnrollmentFemale) == 0 || count($EnrollmentMale) == 0) {
            return "invalid request";
        }

        $semester = $request->search_semester;

        return view('control_panel_faculty.student_grade_sheet.partials.print_senior', 
            compact('EnrollmentFemale', 'EnrollmentMale', 'ClassSubjectDetail', 'FacultyInformation','semester'));
        $pdf = \PDF::loadView('control_panel_faculty.student_grade_sheet.partials.print_senior', compact('EnrollmentFemale', 'EnrollmentMale', 'ClassSubjectDetail', 'FacultyInformation','semester'));
        $pdf->setPaper('Letter', 'portrait');
        return $pdf->stream();
    }

    public function temporary_save_grade(Request $request)
    {
        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->first();

        if (!$request->student_enrolled_subject_id || !$request->enrollment_id || !$request->grading || !$request->classSubjectDetailID ) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.',]);
        } 

        $validator = \Validator::make($request->all(), [
            'grade' => 'numeric|between:0,100.00'
        ], [
            'grade.between' => 'grade is invalid. 0 - 100.00'
        ]);
        if ($validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'grade is invalid. 0 - 100.00.', 'res_error_msg' => $validator->getMessageBag()]);
        }

        $student_enrolled_subject_id = base64_decode($request->student_enrolled_subject_id);
        $enrollment_id = base64_decode($request->enrollment_id);
        $grading = base64_decode($request->grading);
        $grade = $request->grade;

        $StudentEnrolledSubject = StudentEnrolledSubject::where('id', $student_enrolled_subject_id)->where('enrollments_id', $enrollment_id)
            ->where('class_subject_details_id', $request->classSubjectDetailID)->first();

        $selectedsubjectid = ClassSubjectDetail::where('id', $StudentEnrolledSubject->class_subject_details_id)->first();

        $SelectedSubject = SubjectDetail::where('id', $selectedsubjectid->subject_id)
                ->first();

                $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
                ->join('rooms','rooms.id', '=', 'class_details.room_id')
                ->join('section_details', 'section_details.id', '=', 'class_details.section_id')       
                ->where('class_subject_details.id',  $StudentEnrolledSubject->class_subject_details_id)
                ->select(\DB::raw('                
                    rooms.room_code,
                    rooms.room_description,
                    section_details.section,
                    class_details.id,
                    class_details.section_id,
                    class_details.grade_level,
                    class_subject_details.status as grading_status,
                    class_subject_details.sem, class_subject_details.class_subject_order
                '))
                ->first();

        if (!$StudentEnrolledSubject)
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.',]);
        }
        
        if ($grading == 'first') 
        {
            $StudentEnrolledSubject->fir_g = $request->grade;
            $StudentEnrolledSubject->save();        
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
        }
        else if ($grading == 'second') 
        {
            $StudentEnrolledSubject->sec_g = $request->grade;
            $StudentEnrolledSubject->save();        
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
        }
        else if ($grading == 'third') 
        {
            $StudentEnrolledSubject->thi_g = $request->grade;
            $StudentEnrolledSubject->save();        
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
        }
        else if ($grading == 'fourth') 
        {
            $StudentEnrolledSubject->fou_g = $grade;
            $StudentEnrolledSubject->save();        
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
        }            
        
    }
    public function save_grade (Request $request)
    {
        if (!$request->student_enrolled_subject_id || !$request->enrollment_id || !$request->grading || !$request->grade || !$request->classSubjectDetailID) 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.',]);
        }

        $validator = \Validator::make($request->all(), [
            'grade' => 'numeric|between:65,100.00'
        ], [
            'grade.between' => 'grade is invalid. 65 - 100.00'
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'grade is invalid. 65 - 100.00.', 'res_error_msg' => $validator->getMessageBag()]);
        }


        $student_enrolled_subject_id = base64_decode($request->student_enrolled_subject_id);
        $enrollment_id = base64_decode($request->enrollment_id);
        $grading = base64_decode($request->grading);
        $grade = $request->grade;
        
        $StudentEnrolledSubject = StudentEnrolledSubject::where('id', $student_enrolled_subject_id)->where('enrollments_id', $enrollment_id)
        ->where('class_subject_details_id', $request->classSubjectDetailID)->first();

        $selectedsubjectid = ClassSubjectDetail::where('id', $StudentEnrolledSubject->class_subject_details_id)->first();

        $SelectedSubject = SubjectDetail::where('id', $selectedsubjectid->subject_id)
                ->first();

        // $Grade_leve = ClassSubjectDetail::join('class_details_id', 'class_details')
        $ClassSubjectDetail = ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
        ->join('rooms','rooms.id', '=', 'class_details.room_id')
        ->join('section_details', 'section_details.id', '=', 'class_details.section_id')       
        ->where('class_subject_details.id',  $StudentEnrolledSubject->class_subject_details_id)
        ->select(\DB::raw('                
            rooms.room_code,
            rooms.room_description,
            section_details.section,
            class_details.id,
            class_details.section_id,
            class_details.grade_level,
            class_subject_details.status as grading_status,
            class_subject_details.sem, class_subject_details.class_subject_order
        '))
        ->first();


        $SchoolYear = SchoolYear::where('current', 1)->where('status', 1)->first();   

        if (!$StudentEnrolledSubject)
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request.',]);
        }
        
        if ($grading == 'first') 
        {
            $StudentEnrolledSubject->fir_g = $request->grade;
            $StudentEnrolledSubject->fir_g_status = 1;            

            $StudentEnrolledSubject->save();        
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
        }
        else if ($grading == 'second') 
        {
            $StudentEnrolledSubject->sec_g = $request->grade;
            $StudentEnrolledSubject->sec_g_status = 1;            

            $StudentEnrolledSubject->save();        
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
        }
        else if ($grading == 'third') 
        {
            $StudentEnrolledSubject->thi_g = $request->grade;
            $StudentEnrolledSubject->thi_g_status = 1;            

            $StudentEnrolledSubject->save();        
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
        }
        else if ($grading == 'fourth') 
        {
            $StudentEnrolledSubject->fou_g = $request->grade;
            $StudentEnrolledSubject->fou_g_status = 1;            

            $StudentEnrolledSubject->save();        
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully saved.',]);
        }
        
        
    }
    public function finalize_grade (Request $request) 
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();
        $ClassSubjectDetail = ClassSubjectDetail::where('class_subject_details.id', $request->id)
            ->where('faculty_id', $FacultyInformation->id)
            ->first();
        if ($ClassSubjectDetail) 
        {
            $ClassSubjectDetail->status = 2;
            $ClassSubjectDetail->save();
            return response()->json(['res_code' => 0, 'res_msg' => 'Grade successfully finalized.',]);
        }
        else 
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Invalid request',]); 
        }
    }

    public function view_student_data()
    {
        $SchoolYear = SectionDetail::get();
        return view('control_panel_faculty.student_data.index', compact('SchoolYear'));
    }

    
}