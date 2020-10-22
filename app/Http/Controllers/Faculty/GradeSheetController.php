<?php

namespace App\Http\Controllers\Faculty;

use PDF;
use App\Enrollment;
use App\SchoolYear;
use App\ClassDetail;
use App\SectionDetail;
use App\SubjectDetail;
use App\TeacherSubject;
use App\Grade_sheet_first;
use App\Grade_sheet_third;
use App\ClassSubjectDetail;
use App\FacultyInformation;
use App\Grade11_Second_Sem;
use App\Grade_sheet_fourth;
use App\Grade_sheet_second;
use Illuminate\Http\Request;
use App\Grade_sheet_firstsem;
use App\StudentEnrolledSubject;
use Illuminate\Support\Facades\DB;
use App\Grade_sheet_firstsemsecond;
use App\Grade_sheet_secondsemsecond;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class GradeSheetController extends Controller
{    
    public function index (Request $request) 
    {
        $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first();
        // return json_encode(['FacultyInformation' => $FacultyInformation, 'Auth' => \Auth::user()]);
        $SchoolYear = SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'ASC')->orderBy('school_year', 'ASC')->get();


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
        

        return view('control_panel_faculty.student_grade_sheet.partials.print_senior', compact('EnrollmentFemale', 'EnrollmentMale', 'ClassSubjectDetail', 'FacultyInformation','semester'));
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

    public function list_class_section (Request $request) 
    {
        // $FacultyInformation = FacultyInformation::where('user_id', \Auth::user()->id)->first(); 
        $sectionID = $request->search_sy; 
        // $data = $request->all();
        $SchoolYearID = SchoolYear::where('current', 1)->where('status', 1)->first();

        $getIdClassDetails = ClassDetail::where(['section_id'=> $sectionID])->where(['school_year_id'=>$SchoolYearID->id])->first();

        $EnrollmentID = Enrollment::where(['class_details_id'=>$getIdClassDetails->id])->get();

        

        foreach($EnrollmentID as $dataID)
        {

            $Grade_sheet_first = new Grade_sheet_first();
            $Grade_sheet_first->school_year_id =  $SchoolYearID->id;
            $Grade_sheet_first->enrollment_id =  $dataID->id;
            $Grade_sheet_first->section_details_id = $sectionID;
            $Grade_sheet_first->filipino = 0.00;
            $Grade_sheet_first->english = 0.00;
            $Grade_sheet_first->math = 0.00;
            $Grade_sheet_first->science = 0.00;
            $Grade_sheet_first->ap = 0.00;
            $Grade_sheet_first->ict = 0.00;
            $Grade_sheet_first->mapeh = 0.00;
            $Grade_sheet_first->esp = 0.00;
            $Grade_sheet_first->religion = 0.00; 
            $Grade_sheet_first->current = 1;
            $Grade_sheet_first->status = 1;
            $Grade_sheet_first->save();
            
            $Grade_sheet_second = new Grade_sheet_second();
            $Grade_sheet_second->school_year_id =  $SchoolYearID->id;
            $Grade_sheet_second->enrollment_id =  $dataID->id;
            $Grade_sheet_second->section_details_id = $sectionID;
            $Grade_sheet_second->filipino = 0.00;
            $Grade_sheet_second->english = 0.00;
            $Grade_sheet_second->math = 0.00;
            $Grade_sheet_second->science = 0.00;
            $Grade_sheet_second->ap = 0.00;
            $Grade_sheet_second->ict = 0.00;
            $Grade_sheet_second->mapeh = 0.00;
            $Grade_sheet_second->esp = 0.00;
            $Grade_sheet_second->religion = 0.00;   
            $Grade_sheet_second->current = 1;
            $Grade_sheet_second->status = 1;
            $Grade_sheet_second->save();

            $Grade_sheet_third = new Grade_sheet_third();
            $Grade_sheet_third->school_year_id =  $SchoolYearID->id;
            $Grade_sheet_third->enrollment_id =  $dataID->id;
            $Grade_sheet_third->section_details_id = $sectionID;
            $Grade_sheet_third->filipino = 0.00;
            $Grade_sheet_third->english = 0.00;
            $Grade_sheet_third->math = 0.00;
            $Grade_sheet_third->science = 0.00;
            $Grade_sheet_third->ap = 0.00;
            $Grade_sheet_third->ict = 0.00;
            $Grade_sheet_third->mapeh = 0.00;
            $Grade_sheet_third->esp = 0.00;
            $Grade_sheet_third->religion = 0.00;
            $Grade_sheet_third->current = 1;
            $Grade_sheet_third->status = 1;
            $Grade_sheet_third->save();

            $Grade_sheet_fourth = new Grade_sheet_fourth();
            $Grade_sheet_fourth->school_year_id =  $SchoolYearID->id;
            $Grade_sheet_fourth->enrollment_id =  $dataID->id;
            $Grade_sheet_fourth->section_details_id = $sectionID;
            $Grade_sheet_fourth->filipino = 0.00;
            $Grade_sheet_fourth->english = 0.00;
            $Grade_sheet_fourth->math = 0.00;
            $Grade_sheet_fourth->science = 0.00;
            $Grade_sheet_fourth->ap = 0.00;
            $Grade_sheet_fourth->ict = 0.00;
            $Grade_sheet_fourth->mapeh = 0.00;
            $Grade_sheet_fourth->esp = 0.00;
            $Grade_sheet_fourth->religion = 0.00;
            $Grade_sheet_fourth->current = 1;
            $Grade_sheet_fourth->status = 1;
            $Grade_sheet_fourth->save();

            // $Grade_sheet_first->subject_1 = 0.00;
            // $Grade_sheet_first->subject_2 = 0.00;
            // $Grade_sheet_first->subject_3 = 0.00;
            // $Grade_sheet_first->subject_4 = 0.00;
            // $Grade_sheet_first->subject_5 = 0.00;
            // $Grade_sheet_first->subject_6 = 0.00;
            // $Grade_sheet_first->subject_7 = 0.00;
            // $Grade_sheet_first->subject_8 = 0.00;
            // $Grade_sheet_first->subject_9 = 0.00; 

            $Grade_sheet_fourth->filipino = 0.00;
            $Grade_sheet_fourth->english = 0.00;
            $Grade_sheet_fourth->math = 0.00;
            $Grade_sheet_fourth->science = 0.00;
            $Grade_sheet_fourth->ap = 0.00;
            $Grade_sheet_fourth->ict = 0.00;
            $Grade_sheet_fourth->mapeh = 0.00;
            $Grade_sheet_fourth->esp = 0.00;
            $Grade_sheet_fourth->religion = 0.00;

        }

        return redirect()->back()->with('flash_message_success','Room Reserved Successfuly!');
       
    }
}