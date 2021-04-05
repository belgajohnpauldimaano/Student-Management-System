<?php

namespace App\Http\Controllers\Control_Panel_Student;

use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Traits\HasGradeLevel;
use App\Traits\HasSchoolYear;
use App\Traits\HasAssessments;
use App\Traits\HasStudentDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AssessmentController extends Controller
{
    use HasStudentDetails, HasSchoolYear, HasGradeLevel, HasAssessments;
    
    public function index(Request $request)
    {
        $SchoolYear = $this->schoolYearActiveStatus()->id;

        $StudentInformation = $this->student();
        
        $subject = $this->gradeLevel()->whereStudentInformationId($StudentInformation->id)
            ->select('enrollments.student_information_id', 'enrollments.class_details_id', 'enrollments.id')
            ->whereHas('classDetail', function($query) use ($SchoolYear) {
                $query->where('school_year_id', $SchoolYear);
            })
            ->first();
            
        return view('control_panel_student.assessments.assessment_subject_lists.index', compact('subject'));
    }

    public function subject(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        $Assessment = $this->assessments($id)->whereExamStatus(1)->paginate(10);
        // return json_encode($ClassSubjectDetail);
        
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_student.assessments.assessment_subject_details.index', compact('ClassSubjectDetail', 'Assessment'));
    }

    public function getAssessmentData($id)
    {
        $Assessment = $this->assessments($id)->whereExamStatus(1)->paginate(10);
        return response()->json([
            'assessment'   => $Assessment
        ], 200);
    }

    public function takeAssessment(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        $Assessment = $this->assessments($id)->whereExamStatus(1)->first();
        $instructions = Instruction::whereInstructionableId($Assessment->id)->get();
        // return json_encode($instructions);

        return view('control_panel_student.assessments.assessment_questions.index', compact('ClassSubjectDetail','Assessment','instructions'));
    }
}