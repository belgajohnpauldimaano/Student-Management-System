<?php
namespace App\Traits;

use Storage;
use App\Models\Assessment;

trait HasAssessments{
    public function getExamPeriodBadgeAttribute(){
        if($this->period == 1){
            return '<span class="badge bg-success">Prelims</span>';
        }
        if($this->period == 2){
            return '<span class="badge bg-primary">Midterms</span>';
        }
        if($this->period == 3){
            return '<span class="badge bg-info">Finals</span>';
        }
    }

    public function getExamStatusBadgeAttribute(){
        if($this->exam_status == 0){
            return '<span class="badge bg-danger">Unpublish</span>';
        }
        if($this->exam_status == 1){
            return '<span class="badge bg-success">Publish</span>';
        }
        if($this->exam_status == 2){
            return '<span class="badge bg-warning">Archive</span>';
        }
    }

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
}