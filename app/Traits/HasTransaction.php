<?php
namespace App\Traits;

use App\Models\SchoolYear;
use App\Models\Transaction;
use App\Models\PaymentCategory;
use App\Models\StudentCategory;
use App\Models\TransactionOtherFee;
use App\Models\TransactionMonthPaid;

trait HasTransaction{

    // public function schoolYear($sy_transaction){
    //     $school_year = $sy_transaction;     
    //     return $school_year;   
    // }   

    public function transactions()
    {
        return $this->hasOne(Transaction::class, 'student_id', 'id');
    }

    public function student_balance()
    {
        return $this->hasOne(TransactionMonthPaid::class, 'student_id', 'id')
            ->whereApproval('Approved')->orderBY('id', 'DESC')->latest();
    }

    public function paymentCat()
    {        
         return $this->hasOne(PaymentCategory::class);
    }
    
    public function transactionStudCategory() {
        return $this->hasManyThrough(PaymentCategory::class, StudentCategory::class);
    }

    public function monthlyTransaction()
    {
        return $this->belongsTo(TransactionMonthPaid::class, 'student_id', 'id' )
            ->whereApproval('Approved')
            ->where('isSuccess', 1)
            ->latest();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class,'id', 'transaction_id')->where('isEnrolled', 1);
    }

    public function finance_transaction ()
    {
        // $School_year_id = SchoolYear::where('status', 1)
        //     ->where('current', 1)->first()->id;
        // return $this->hasOne(Transaction::class, 'student_id', 'id')->where('school_year_id', $School_year_id);
        return $this->hasOne(Transaction::class, 'id', 'id');
    }

}