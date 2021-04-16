<?php
namespace App\Traits;

use Storage;
use App\Models\Question;
use App\Models\Assessment;
use App\Models\Enrollment;
use App\Models\ClassDetail;
use App\Models\Instruction;
use App\Models\QuestionAnswer;
use App\Models\ClassSubjectDetail;
use App\Models\StudentExamDetails;

trait HasAssessments{
    

    public function getQuestionAttribute(){
        $question_type = [
            '', 
            'Multiple Choice', 
            'True/False' ,
            'Matching',
            'Ordering',
            'Fill in the Blank Text',
            'Short Answer/Essay'
        ];
        return $question_type[$this->question_type];
    }

    public function getAssessmentStatusAttribute()
    {
        $route_type = [
            'unpublished', 
            'published', 
            'archived' 
        ];
        return $route_type[$this->exam_status];
    }

    public function getAnswerAttribute(){
    
        return QuestionAnswer::where('question_id', $this->question_id)->where('order_number', $this->order_number)->first();
    }

    
    // public function classDetail()
    // {
    //    return $this->hasOne(ClassDetail::class, 'id','class_details_id')
    //     ->whereStatus(1);
    // }

    private function subjectDetails($id)
    {
        return ClassSubjectDetail::whereId($id)->first();
    }

    public function enrolled()
    {
        return $this->hasOne(Enrollment::class, 'class_details_id', 'id');
    }

    // public function assessment()
    // {
    //     return $this->hasOne(Assessment::class, 'class_subject_details_id', 'id')->where('exam_status', 1);
    // }

    public function assessments($id)
    {
        return Assessment::whereClassSubjectDetailsId($id)
            ->orderBY('id', 'desc');
    }

    public function studentExamDetails()
    {
        return $this->hasMany(StudentExamDetails::class ,'assessment_id', 'id')->whereStatus(1);
    }
    
    public function getQuestionsCountAttribute()
    {
        return $this->hasMany(Question::class ,'assessment_id', 'id')->whereStatus(1)->count();
    }
  
    public function getCheckOrderAttribute($x)
    {
        return Instruction::whereInstructionable_id($this->id);
    }
}