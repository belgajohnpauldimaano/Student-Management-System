<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Models\ClassDetail;
use App\Traits\HasGradeSheet;
use App\Traits\HasTransaction;
use App\Models\TransactionMonthPaid;
use App\Models\StudentEnrolledSubject;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasTransaction, HasGradeSheet, HasUser;
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
    
    // public function studentEnrolledSubject(){
    //     return $this->hasOne(StudentEnrolledSubject::class, 'subject_id', 'subject_id');
    // }
    // public function enrollment()
    // {
    //     return $this->belongsTo('App\Registration', 'regid', 'id');
    // }

    // public function getFullNameAttribute() {
    //     return ucwords($this->last_name . ', ' . $this->first_name. ' ' . $this->middle_name);
    // }

    // public function student_balance()
    // {
    //     return $this->hasOne(TransactionMonthPaid::class, 'student_id', 'id')->whereApproval('Approved')->latest();
    // }
    
}