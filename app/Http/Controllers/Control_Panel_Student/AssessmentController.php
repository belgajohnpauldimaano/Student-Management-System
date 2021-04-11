<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Carbon\Carbon;
use App\Models\Assessment;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Traits\HasGradeLevel;
use App\Traits\HasSchoolYear;
use App\Traits\HasAssessments;
use App\Traits\HasStudentDetails;
use App\Models\StudentExamDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AssessmentController extends Controller
{
    use HasStudentDetails, HasSchoolYear, HasGradeLevel, HasAssessments;

    private function assessmentStudent($id, $tab)
    {
        $query = Assessment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'assessments.class_subject_details_id')
            ->leftJoin('student_exam_details', 'student_exam_details.assessment_id', '=', 'assessments.id')
            ->select('assessments.*','student_exam_details.status','student_exam_details.assessment_id','student_exam_details.assessment_outcome')
            ->whereClassSubjectDetailsId($id)
            ->orderBY('id', 'desc');
            
        if($tab == 'new')
        {
            $query->orWhere('student_exam_details.status','!=', 3);
        }

        if($tab == 'old')
        {
            $query->Where('student_exam_details.status', 3);
        }

        return $query;
    }
    
    public function index(Request $request)
    {
        $SchoolYear = $this->schoolYearActiveStatus()->id;
        $StudentInformation = $this->student();

        // return json_encode($StudentInformation);
        
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
        $tab = $request->tab;
        if($tab == null)
        {
            $tab = 'new';
        }
        $id = Crypt::decrypt($request->id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        
        $Assessment = $this->assessmentStudent($id, $tab)->whereExamStatus(1)->paginate(10);
        
        // return json_encode($ClassSubjectDetail);
        return view('control_panel_student.assessments.assessment_subject_details.index',
            compact('ClassSubjectDetail', 'Assessment', 'tab'));
    }

    public function getAssessmentData($id)
    {
        $Assessment = $this->assessments($id)->whereExamStatus(1)->paginate(10);
        
        return response()->json([
            'assessment'   => $Assessment
        ], 200);
    }
    
    private $StudentInformation;

    private function examStudentDetail($assessment_id)
    {
        $this->StudentInformation = $this->student()->id;
        return  StudentExamDetails::where('assessment_id', $assessment_id)
            ->where('student_information_id', $this->StudentInformation)->first();
    }

    private function saveAssessmentDetails($id)
    {
        $dt = Carbon::now();
        $assessment = $this->assessments($id)->first();
        $student_exam = $this->examStudentDetail($assessment->id);

        if(!$student_exam)
        {
            $student_exam = new StudentExamDetails;
            $student_exam->time_start               =   $dt->toDateTimeString();
            $student_exam->assessment_id            =   $assessment->id;
            $student_exam->student_information_id   =   $this->StudentInformation;
            $student_exam->assessment_outcome       =   2;
            $student_exam->status                   =   1;
            $student_exam->save();
        }
        
    }

    public function takeAssessment(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        // return json_encode($instructions);
        $assessment = $this->assessments($id)->first();
        $student_exam = $this->examStudentDetail($id);
        // return json_encode($student_exam);
        // return json_encode($this->StudentInformation);
            
        try {
            if($student_exam == 3){
                return response()->json([
                    'res_code' => 1, 
                    'res_msg'  => 'You are already taken this assessment or please contact the faculty'
                ]);
            }else{
                $this->saveAssessmentDetails($id);
            }
        } catch (\Throwable $th) {
            $this->saveAssessmentDetails($id);
        }
        // return response
        return response()->json([
            'id'        =>  encrypt($id)
        ],200);
    }

   

    public function redirectAssessment(Request $request, $id)
    {
        $id = Crypt::decrypt($request->id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        $Assessment = $this->assessments($id)->whereExamStatus(1)->first();
        $instructions = Instruction::whereInstructionableId($Assessment->id)->get();
        
        return view('control_panel_student.assessments.assessment_questions.index', compact('ClassSubjectDetail','Assessment','instructions'));
    }
}