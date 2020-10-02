<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTransaction;
use App\Traits\HasUser;

class Enrollment extends Model
{
    use HasTransaction, HasUser;
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