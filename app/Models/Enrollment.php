<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Traits\HasGradeSheet;
use App\Traits\HasTransaction;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasTransaction, HasGradeSheet, HasUser;
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