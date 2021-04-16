<?php

namespace App\Http\Controllers\Faculty;

use Carbon\Carbon;
use App\Models\Semester;
use App\Models\Assessment;
use App\Models\Enrollment;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Traits\HasGradeSheet;
use App\Traits\HasAssessments;
use App\Traits\HasInstruction;
use App\Traits\HasFacultyDetails;
use App\Models\ClassSubjectDetail;
use App\Models\StudentExamDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AssessmentSubjectController extends Controller
{
    use HasAssessments, HasGradeSheet;
    
    private function semester(){
        return $semester = Semester::whereCurrent(1)->first()->id;
    }
    
    public function index(Request $request)
    {
        $tab = $request->tab;

        $id = Crypt::decrypt($request->class_subject_details_id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        $semester = $this->semester();
        $query = $this->assessments($id);
        
        if($tab == 'unpublished'){
            $query->where('exam_status', 0);
        }

        if($tab == 'published'){
            $query->where('exam_status', 1);
        }

        if($tab == 'archived'){
            $query->where('exam_status', 2);
        }
        
        $Assessment = $query->paginate(10);
        
        if($request->ajax())
        {
            return view('control_panel_faculty.assessment_per_subject.partials.data_list', compact('ClassSubjectDetail','Assessment','semester','tab'));
        }
        return view('control_panel_faculty.assessment_per_subject.index', compact('ClassSubjectDetail','Assessment','semester','tab'));
    }

    public function modal(Request $request){

        $id = $request->class_subject_details_id;
        $ClassSubjectDetail = $this->subjectDetails($id);
        
        return view('control_panel_faculty.assessment_per_subject.partials.modal_data', 
            compact('ClassSubjectDetail'))->render();
    }

    public function create(Request $request){

        $Assessment=null;
        $id = Crypt::decrypt($request->class_subject_details_id);
        $ClassSubjectDetail = $this->subjectDetails($id);
        
        return view('control_panel_faculty.assessment_per_subject._index', 
            compact('ClassSubjectDetail','Assessment'))->render();
    }

    public function edit(Request $request){

        $tab =  $request->tab ? $request->tab : 'setup';
        $question = $request->question;
        $instruction=null;
        $id = Crypt::decrypt($request->class_subject_details_id);
        $Assessment = Assessment::whereId($id)->first();
        
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);

        if($request->ajax())
        {
             return view('control_panel_faculty.assessment_per_subject.partials.data_list_question', 
                compact('ClassSubjectDetail','Assessment','instruction','tab','question'))->render();
        }
        
        return view('control_panel_faculty.assessment_per_subject._index', 
            compact('ClassSubjectDetail','Assessment','instruction','tab','question'))->render();
    }

    public function getDataStudent(Request $request)
    {
        $dt = Carbon::now();
        $id = Crypt::decrypt($request->class_subject_details_id);//assessment_id
        $Assessment = Assessment::whereId($id)->select()->first();
        $question_total = $Assessment->QuestionsCount;
        $ClassSubjectDetail = $this->subjectDetails($Assessment->class_subject_details_id);
        
        // return json_encode($ClassSubjectDetail);

        $data = null; // our return data
        $timeout = 30; // timeout in seconds
        $now = time(); // start time
        $attempt=1;

        $id = $Assessment->class_subject_details_id;
        $assessment_id = $Assessment->id;

            $student_male = $this->enrollmentInfo($id, $assessment_id)->where('student_informations.gender', 1)->get();
            $student_female = $this->enrollmentInfo($id, $assessment_id)->where('student_informations.gender', 2)->get();

            $student_male = $student_male->map(function($item, $key) use ($id, $assessment_id){
                return $this->studentData($item, $assessment_id);
            });

            $student_female = $student_female->map(function($item, $key) use ($id, $assessment_id){
                return $this->studentData($item, $assessment_id);
            });
            

        // loop for $timeout seconds from $now until we get $data
        while((time() - $now) < $timeout) {
            return response()->json([
                'student_male'      => $student_male,
                'student_female'    => $student_female,
                'question_total'    => $question_total,
                'assess_data'       => $Assessment
            ], 200);
        }
    }

    private function studentData($item, $assessment_id)
    {
        $student_exam_detail = StudentExamDetails::where('assessment_id', $assessment_id)
                ->where('student_information_id', $item->student_information_id)->first();
        $status;
        $time_start;

        try {
            $status = $student_exam_detail->status == null ? 2 : $student_exam_detail->status;
            $time_start = $student_exam_detail->time_start == null ? '0:00' : $student_exam_detail->time_start;
        } catch (\Throwable $th) {
            $status = 2;
            $time_start = '0:00';
        }
        
        $data = [
            'class_details_id'  =>  $item->class_details_id,
            'exam_status'       =>  $status,
            'first_name'        =>  $item->first_name,
            'middle_name'       =>  $item->middle_name,
            'last_name'         =>  $item->last_name,
            'status'            =>  $item->status,
            'time_start'        =>  $time_start,
            'gender'            =>  $item->gender
        ];
        return $data;
    }
    
    public function save(Request $request){

        $rules = [
            'title'                 => 'required',
            'exam_period'           => 'required',
            'publish_date_time'     => 'required',
            'exp_date_time'         => 'required',
            'quarter_period'        => 'required',
            // 'instructions'          => 'required',
            'time_limit'            => 'required',
            'total_item'            => 'required',
        ];
        
        $Validator = \Validator($request->all(), $rules);

        if ($Validator->fails())
        {
            return response()->json(['res_code' => 1, 'res_msg' => 'Please fill all required fields.', 'res_error_msg' => $Validator->getMessageBag()]);
        }

        $semester = $this->semester();
        // return json_encode($semester);
        $ClassSubjectDetail = $request->class_subject_details_id;

        try {
            //code...
            if ($request->id)
            {
                $Assessment = Assessment::whereId($request->id)->first();
            }
            else{
                $Assessment = new Assessment;
                $Assessment->class_subject_details_id = $ClassSubjectDetail;
            }

            // return json_encode(['tab' => 'setup']);
                $Assessment->title                  = $request->title;
                // $Assessment->instructions           =  $request->instructions;
                $Assessment->period                 =  $request->exam_period;
                $Assessment->date_time_publish      =  $request->publish_date_time;
                $Assessment->date_time_expiration   =  $request->exp_date_time;
                $Assessment->semester               =  $request->semester_period ? $request->semester_period : $semester;
                $Assessment->quarter                =  $request->quarter_period;
                $Assessment->randomly_ordered       =  $request->randomly_ordered;
                $Assessment->time_limit             =  $request->time_limit;
                $Assessment->total_items            =  $request->total_item;
                $Assessment->student_view_result    =  $request->view_results;
                $Assessment->attempt_limit          =  $request->attempts;
                $Assessment->exam_status            =  $request->exam_status;
                $Assessment->save();
                
                // $tab = 'active';

                if ($request->id)
                {
                    return response()->json([
                        'res_code' => 0, 'res_msg' => 'Assessment successfully updated.'
                    ],200);

                }else{
                    return response()->json([
                        'res_code'  => 0,
                        'res_msg'   => 'Assessment successfully saved.',
                        'data'      => encrypt($Assessment->id),
                        // 'tab'       => $tab
                    ],201);
                }
            
        } catch (\Throwable $th) {
            return response()->json([
                    'res_code'  => 1,
                    'res_msg'   => 'Something went wrong.',
            ]);
        }

    }
}