<?php

namespace App\Http\Controllers\Faculty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyAdvisoryClassController extends Controller
{
    public function index (Request $request) 
    {
        // $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
        // return json_encode(['FacultyInformation' => $FacultyInformation, 'Auth' => \Auth::user()]);
        $SchoolYear         = \App\SchoolYear::where('status', 1)->where('current', 1)->orderBy('current', 'ASC')->orderBy('school_year', 'ASC')->get();
        return view('control_panel_faculty.my_advisory_class.index', compact('SchoolYear'));
        // return view('control_panel_faculty.my_advisory_class.index');
    
    }

    public function firstquarter (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject, subject_details.id
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();            
            

            $GradeSheetMale = \App\Grade_sheet_first::join('class_details','class_details.section_id','=','grade_sheet_firsts.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_firsts.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_firsts.filipino, grade_sheet_firsts.english, grade_sheet_firsts.math, grade_sheet_firsts.science, grade_sheet_firsts.ap, grade_sheet_firsts.ict, grade_sheet_firsts.mapeh
                    , grade_sheet_firsts.esp, grade_sheet_firsts.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $GradeSheetFeMale = \App\Grade_sheet_first::join('class_details','class_details.section_id','=','grade_sheet_firsts.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_firsts.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_firsts.filipino, grade_sheet_firsts.english, grade_sheet_firsts.math, grade_sheet_firsts.science, grade_sheet_firsts.ap, grade_sheet_firsts.ict, grade_sheet_firsts.mapeh
                    , grade_sheet_firsts.esp, grade_sheet_firsts.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $quarter = 'First';

           
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'))->render();
    }

    public function secondquarter (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject, subject_details.id
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();


            
            

            $GradeSheetMale = \App\Grade_sheet_second::join('class_details','class_details.section_id','=','grade_sheet_seconds.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_seconds.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_seconds.filipino, grade_sheet_seconds.english, grade_sheet_seconds.math, grade_sheet_seconds.science, grade_sheet_seconds.ap, grade_sheet_seconds.ict, grade_sheet_seconds.mapeh
                    , grade_sheet_seconds.esp, grade_sheet_seconds.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $GradeSheetFeMale = \App\Grade_sheet_second::join('class_details','class_details.section_id','=','grade_sheet_seconds.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_seconds.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_seconds.filipino, grade_sheet_seconds.english, grade_sheet_seconds.math, grade_sheet_seconds.science, grade_sheet_seconds.ap, grade_sheet_seconds.ict, grade_sheet_seconds.mapeh
                    , grade_sheet_seconds.esp, grade_sheet_seconds.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $quarter = 'Second';
           
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'))->render();
    }

    public function thirdquarter (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject, subject_details.id
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();


            
            

            $GradeSheetMale = \App\Grade_sheet_third::join('class_details','class_details.section_id','=','grade_sheet_thirds.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_thirds.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_thirds.filipino, grade_sheet_thirds.english, grade_sheet_thirds.math, grade_sheet_thirds.science, grade_sheet_thirds.ap, grade_sheet_thirds.ict, grade_sheet_thirds.mapeh
                    , grade_sheet_thirds.esp, grade_sheet_thirds.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $GradeSheetFeMale = \App\Grade_sheet_third::join('class_details','class_details.section_id','=','grade_sheet_thirds.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_thirds.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_thirds.filipino, grade_sheet_thirds.english, grade_sheet_thirds.math, grade_sheet_thirds.science, grade_sheet_thirds.ap, grade_sheet_thirds.ict, grade_sheet_thirds.mapeh
                    , grade_sheet_thirds.esp, grade_sheet_thirds.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $quarter = 'Third';
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'))->render();
    }

    public function fourthquarter (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject, subject_details.id
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();


            
            

            $GradeSheetMale = \App\Grade_sheet_fourth::join('class_details','class_details.section_id','=','grade_sheet_fourths.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_fourths.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_fourths.filipino, grade_sheet_fourths.english, grade_sheet_fourths.math, grade_sheet_fourths.science, grade_sheet_fourths.ap, grade_sheet_fourths.ict, grade_sheet_fourths.mapeh
                    , grade_sheet_fourths.esp, grade_sheet_fourths.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $GradeSheetFeMale = \App\Grade_sheet_fourth::join('class_details','class_details.section_id','=','grade_sheet_fourths.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_fourths.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_fourths.filipino, grade_sheet_fourths.english, grade_sheet_fourths.math, grade_sheet_fourths.science, grade_sheet_fourths.ap, grade_sheet_fourths.ict, grade_sheet_fourths.mapeh
                    , grade_sheet_fourths.esp, grade_sheet_fourths.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $quarter = 'Fourth';           
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'))->render();
    }


    public function print_firstquarter (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
            ->join('faculty_informations', 'faculty_informations.id','=','class_details.adviser_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                faculty_informations.first_name, faculty_informations.middle_name ,  faculty_informations.last_name,
                school_years.school_year                
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject, subject_details.id
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();            
            

            $GradeSheetMale = \App\Grade_sheet_first::join('class_details','class_details.section_id','=','grade_sheet_firsts.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_firsts.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_firsts.filipino, grade_sheet_firsts.english, grade_sheet_firsts.math, grade_sheet_firsts.science, grade_sheet_firsts.ap, grade_sheet_firsts.ict, grade_sheet_firsts.mapeh
                    , grade_sheet_firsts.esp, grade_sheet_firsts.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $GradeSheetFeMale = \App\Grade_sheet_first::join('class_details','class_details.section_id','=','grade_sheet_firsts.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_firsts.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_firsts.filipino, grade_sheet_firsts.english, grade_sheet_firsts.math, grade_sheet_firsts.science, grade_sheet_firsts.ap, grade_sheet_firsts.ict, grade_sheet_firsts.mapeh
                    , grade_sheet_firsts.esp, grade_sheet_firsts.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $quarter = 'First';

           
        // return json_encode($ClassSubjectDetail);
        // return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'))->render();
        $pdf = \PDF::loadView('control_panel_faculty.my_advisory_class.partials.print_first_quarter', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'));
        $pdf->setPaper('Legal', 'portrait');
        // $pdf->setPaper([0, 0, 396.85, 1800.98],'Letter', 'landscape');
        // $dompdf->setPaper(array(0,0,612,$height))
        return $pdf->stream();
    }

    public function print_secondquarter (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
            ->join('faculty_informations', 'faculty_informations.id','=','class_details.adviser_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                faculty_informations.first_name, faculty_informations.middle_name ,  faculty_informations.last_name,
                school_years.school_year                
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject, subject_details.id
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();            
            

            $GradeSheetMale = \App\Grade_sheet_second::join('class_details','class_details.section_id','=','grade_sheet_seconds.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_seconds.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_seconds.filipino, grade_sheet_seconds.english, grade_sheet_seconds.math, grade_sheet_seconds.science, grade_sheet_seconds.ap, grade_sheet_seconds.ict, grade_sheet_seconds.mapeh
                    , grade_sheet_seconds.esp, grade_sheet_seconds.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $GradeSheetFeMale = \App\Grade_sheet_second::join('class_details','class_details.section_id','=','grade_sheet_seconds.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_seconds.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_seconds.filipino, grade_sheet_seconds.english, grade_sheet_seconds.math, grade_sheet_seconds.science, grade_sheet_seconds.ap, grade_sheet_seconds.ict, grade_sheet_seconds.mapeh
                    , grade_sheet_seconds.esp, grade_sheet_seconds.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $quarter = 'Second';

           
        // return json_encode($ClassSubjectDetail);
        // return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'))->render();
        $pdf = \PDF::loadView('control_panel_faculty.my_advisory_class.partials.print_first_quarter', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'));
        $pdf->setPaper('Legal', 'portrait');
        // $pdf->setPaper([0, 0, 396.85, 1800.98],'Letter', 'landscape');
        // $dompdf->setPaper(array(0,0,612,$height))
        return $pdf->stream();
    }

    public function print_thirdquarter (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
            ->join('faculty_informations', 'faculty_informations.id','=','class_details.adviser_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                faculty_informations.first_name, faculty_informations.middle_name ,  faculty_informations.last_name,
                school_years.school_year                
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject, subject_details.id
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();            
            

            $GradeSheetMale = \App\Grade_sheet_third::join('class_details','class_details.section_id','=','grade_sheet_thirds.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_thirds.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_thirds.filipino, grade_sheet_thirds.english, grade_sheet_thirds.math, grade_sheet_thirds.science, grade_sheet_thirds.ap, grade_sheet_thirds.ict, grade_sheet_thirds.mapeh
                    , grade_sheet_thirds.esp, grade_sheet_thirds.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $GradeSheetFeMale = \App\Grade_sheet_third::join('class_details','class_details.section_id','=','grade_sheet_thirds.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_thirds.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_thirds.filipino, grade_sheet_thirds.english, grade_sheet_thirds.math, grade_sheet_thirds.science, grade_sheet_thirds.ap, grade_sheet_thirds.ict, grade_sheet_thirds.mapeh
                    , grade_sheet_thirds.esp, grade_sheet_thirds.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $quarter = 'Third';

           
        // return json_encode($ClassSubjectDetail);
        // return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'))->render();
        $pdf = \PDF::loadView('control_panel_faculty.my_advisory_class.partials.print_first_quarter', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'));
        $pdf->setPaper('Legal', 'portrait');
        // $pdf->setPaper([0, 0, 396.85, 1800.98],'Letter', 'landscape');
        // $dompdf->setPaper(array(0,0,612,$height))
        return $pdf->stream();
    }

    public function print_fourthquarter (Request $request) 
    {
        $FacultyInformation = \App\FacultyInformation::where('user_id', \Auth::user()->id)->first();
     
        $ClassSubjectDetail = \App\ClassSubjectDetail::join('class_details', 'class_details.id', '=', 'class_subject_details.class_details_id')
            // ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')
            ->join('rooms','rooms.id', '=', 'class_details.room_id')
            ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
            ->join('school_years', 'school_years.id' ,'=', 'class_details.school_year_id')
            ->join('faculty_informations', 'faculty_informations.id','=','class_details.adviser_id')
            // ->whereRaw('class_subject_details.id = '. $request->search_class_subject)
            // ->whereRaw('class_details.id = '. $search_class_subject[1])
            ->where('class_details.adviser_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            // ->where('class_subject_details.status', '!=', 0)
            ->where('class_details.status', '!=', 0)
            ->select(\DB::raw('                
                rooms.room_code,
                rooms.room_description,
                section_details.section,
                class_details.id,
                class_details.section_id,
                class_details.grade_level,
                class_subject_details.status as grading_status,
                faculty_informations.first_name, faculty_informations.middle_name ,  faculty_informations.last_name,
                school_years.school_year                
            '))
            ->first();
            
        
            $AdvisorySubject = \App\ClassSubjectDetail::join('subject_details', 'subject_details.id', '=' ,'class_subject_details.subject_id')
            ->join('class_details', 'class_details.id', '=' ,'class_subject_details.class_details_id')
            ->join('faculty_informations', 'faculty_informations.id', '=' ,'class_subject_details.faculty_id')           
            ->selectRaw("                
                subject_details.subject, subject_details.id
            ")
            ->where('class_subject_details.class_details_id', $ClassSubjectDetail->id)
            ->where('class_subject_details.status', 1)
            // ->where('faculty_id', $FacultyInformation->id)
            ->where('class_details.school_year_id', $request->search_sy)
            //  ->where('class_details.school_year_id', $request->search_sy)
            // ->orderBy('class_subject_details.class_time_from', 'ASC');
            ->get();            
            

            $GradeSheetMale = \App\Grade_sheet_fourth::join('class_details','class_details.section_id','=','grade_sheet_fourths.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_fourths.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 1')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_fourths.filipino, grade_sheet_fourths.english, grade_sheet_fourths.math, grade_sheet_fourths.science, grade_sheet_fourths.ap, grade_sheet_fourths.ict, grade_sheet_fourths.mapeh
                    , grade_sheet_fourths.esp, grade_sheet_fourths.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $GradeSheetFeMale = \App\Grade_sheet_fourth::join('class_details','class_details.section_id','=','grade_sheet_fourths.section_details_id')            
            ->join('enrollments','enrollments.id','=','grade_sheet_fourths.enrollment_id')
            ->join('student_informations','student_informations.id','=','enrollments.student_information_id')
            ->where('class_details.section_id', $ClassSubjectDetail->section_id)
            ->whereRaw('student_informations.gender = 2')
            ->selectRaw("                    
                    CONCAT(student_informations.last_name, ' ', student_informations.first_name, ' ', student_informations.middle_name) as student_name,
                    grade_sheet_fourths.filipino, grade_sheet_fourths.english, grade_sheet_fourths.math, grade_sheet_fourths.science, grade_sheet_fourths.ap, grade_sheet_fourths.ict, grade_sheet_fourths.mapeh
                    , grade_sheet_fourths.esp, grade_sheet_fourths.religion
                    ")
            ->distinct()
            ->orderBY('student_name','ASC')
            ->get();

            $quarter = 'Fourth';

           
        // return json_encode($ClassSubjectDetail);
        // return view('control_panel_faculty.my_advisory_class.partials.data_list', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'))->render();
        $pdf = \PDF::loadView('control_panel_faculty.my_advisory_class.partials.print_first_quarter', compact( 'ClassSubjectDetail','AdvisorySubject','GradeSheetMale','GradeSheetFeMale','quarter'));
        $pdf->setPaper('Legal', 'portrait');
        // $pdf->setPaper([0, 0, 396.85, 1800.98],'Letter', 'landscape');
        // $dompdf->setPaper(array(0,0,612,$height))
        return $pdf->stream();
    }
}
