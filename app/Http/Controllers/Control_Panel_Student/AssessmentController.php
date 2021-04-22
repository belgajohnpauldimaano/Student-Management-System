<?php

namespace App\Http\Controllers\Control_Panel_Student;

use Carbon\Carbon;
use App\Models\Assessment;
use App\Models\Enrollment;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Traits\HasGradeLevel;
use App\Traits\HasGradeSheet;
use App\Traits\HasSchoolYear;
use App\Models\QuestionAnswer;
use App\Traits\HasAssessments;
use App\Models\StudentExamRecord;
use App\Traits\HasStudentDetails;
use App\Models\StudentExamDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AssessmentController extends Controller
{
    use HasStudentDetails, HasSchoolYear, HasGradeLevel, HasAssessments;

    
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
        $dt =  Carbon::now();
        // return json_encode($dt);

        if($tab == null)
        {
            $tab = 'new';
        }
        
        $id = Crypt::decrypt($request->id);
        // return json_encode($id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        $StudentInformation = $this->student()->id;

        $query = Enrollment::join('class_subject_details', 'class_subject_details.class_details_id', '=', 'enrollments.class_details_id')
            ->join('assessments', 'assessments.class_subject_details_id', '=', 'class_subject_details.id')
            ->where('class_subject_details.id', $id)
            ->where('enrollments.student_information_id', $StudentInformation)
            ->select('class_subject_details.id as class_subject_details_id',
                'assessments.id as assessment_id','assessments.period', 'assessments.date_time_publish','assessments.exam_status',
                'assessments.date_time_expiration','assessments.attempt_limit','assessments.title','enrollments.student_information_id'
            )
            ->orderBY('assessments.id', 'desc');
       
        $Assessment = $query->whereExamStatus(1)->paginate(10);

        // return json_encode($Assessment);
        return view('control_panel_student.assessments.assessment_subject_details.index',
            compact('ClassSubjectDetail', 'Assessment', 'tab', 'dt'));
    }

    public function getAssessmentData($id)
    {
        $Assessment = $this->assessments($id)->whereExamStatus(1)->paginate(10);
        
        return response()->json([
            'assessment'   => $Assessment
        ], 200);
    }
    // private $StudentInformation;

    private function examStudentDetail($assessment_id)
    {
        $StudentInformation = $this->student()->id;
        return  StudentExamDetails::where('assessment_id', $assessment_id)
            ->where('student_information_id', $StudentInformation)->first();
    }

    private function saveAssessmentDetails($id)
    {
        $StudentInformation = $this->student()->id;
        $dt = Carbon::now();
        // $assessment = $this->assessments($id)->first();
        $student_exam = $this->examStudentDetail($id);

        if(!$student_exam)
        {
            $student_exam = new StudentExamDetails;
            $student_exam->time_start               =   $dt->toDateTimeString();
            $student_exam->assessment_id            =   $id;
            $student_exam->student_information_id   =   $StudentInformation;
            $student_exam->assessment_outcome       =   2;
            $student_exam->status                   =   1;
            $student_exam->save();
        }
    }

    public function takeAssessment(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        // return json_encode($instructions);
        // $assessment = $this->assessmentData($id)->first();
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
            'id'  =>  encrypt($id)
        ],200);
    }

    public function redirectAssessment(Request $request, $id)
    {
        // return json_encode($request->tab);
        $tab = $request->tab;
        $id = Crypt::decrypt($request->id);
        $Assessment = $this->assessmentData($id);        
        // $Assessment = $this->assessments($id)->whereExamStatus(1)->first();
        $student_exam = $this->examStudentDetail($id);
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);
        $instructions = Instruction::whereInstructionableId($id)->get();
        // $student_record = StudentExamRecord::whereAssessmentId($id)->get();
        // return json_encode($instructions);
        return view('control_panel_student.assessments.assessment_questions.index', 
            compact('ClassSubjectDetail','Assessment','instructions', 'student_exam', 'tab'));
    }

    private function assessmentData($id)
    {
        return Assessment::whereId($id)->whereExamStatus(1)->first();
    }

    public function save(Request $request)
    {
        $student_exam_id = $request->student_exam_id;
        $student_exam = StudentExamDetails::find($student_exam_id);
        $assessment = $this->assessmentData($student_exam->assessment_id);
        $option_answersArray = $request->options_answers;

        if($student_exam->status != 3){
            DB::beginTransaction();
            try {
                $count = 0;
                //code...
                foreach($option_answersArray as $key => $answer){
                    // echo json_encode($answer);
                    
                    $assessment_answer = QuestionAnswer::whereQuestionId($request->question_id + $key)->first();
                    // save here
                    $student_assessment = new StudentExamRecord();
                    $student_assessment->student_information_id     =   $student_exam->student_information_id;
                    $student_assessment->assessment_id              =   $student_exam->assessment_id;
                    $student_assessment->question_id                =   $request->question_id + $key;
                    $student_assessment->student_answer_option      =   $answer;
                    $student_assessment->student_answer_option_status      =   1;

                    if($assessment_answer->correct_option_answer == $answer){
                        // echo 'tama<br/>';
                        $student_assessment->remarks  =  1;
                        $count++;
                    }else{
                        // echo 'mali<br/>';
                        $student_assessment->remarks  =  0;
                    }
                    $student_assessment->save();
                }

                // echo $count;
                $student_details = StudentExamDetails::whereId($student_exam->id)->first();
                $student_details->score  = $count;//score
                $student_details->status = 3;//done taking assessment
                $student_details->save();

                DB::commit();
                
                return response()->json([
                    'res_code' => 0, 
                    'Your assessment account successfully saved.',
                    'score'      => $student_details->score,
                    'total_item' => $assessment->QuestionsCount
                ],200);

            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();

                return response()->json([
                    'res_code' => 1,
                    "something wen't wrong please contact our admin. Thank you"
                ],200);
            }
        }
    }
}