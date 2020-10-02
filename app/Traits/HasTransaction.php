<?php
namespace App\Traits;

use App\Transaction;
use App\TransactionMonthPaid;

trait HasTransaction{

    public function transactions()
    {
        return $this->hasOne(Transaction::class, 'student_id', 'id');
    }

    public function student_balance()
    {
        $id = 'id' != '' ? 'id' : 'student_id';

        return $this->hasOne(TransactionMonthPaid::class, 'student_id', $id )->whereApproval('Approved')->latest();
    }

    public function finance_transaction ()
    {
        // $School_year_id = SchoolYear::where('status', 1)
        //     ->where('current', 1)->first()->id;
        // return $this->hasOne(Transaction::class, 'student_id', 'id')->where('school_year_id', $School_year_id);
        return $this->hasOne(Transaction::class, 'id', 'id');
    }
    
}