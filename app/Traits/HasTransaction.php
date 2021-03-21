<?php
namespace App\Traits;

use App\Models\SchoolYear;
use App\Models\Transaction;
use App\Models\PaymentCategory;
use App\Models\StudentCategory;
use App\Models\TransactionDiscount;
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

    private function otherComputation()
    {
        return $other = TransactionOtherFee::where('student_id', $this->student_id)
                ->where('school_year_id', $this->school_year_id)
                ->where('transaction_id', $this->transaction_id)
                ->where('isSuccess', 1)
                ->sum('item_price');
    }

    private function discountComputation()
    {
        return $discount = TransactionDiscount::where('student_id', $this->student_id)
            ->where('school_year_id', $this->school_year_id)
            ->where('isSuccess', 1)
            ->sum('discount_amt');
    }

    public function getOtherTotalAttribute()
    {
        $other = $this->otherComputation();
        return number_format($other, 2);
    }

    public function getDiscountTotalAttribute()
    {
        $discount = $this->discountComputation();
        return number_format($discount, 2);
    }

    public function getTotalFeesAttribute()
    {
        $other = $this->otherComputation();
        $discount = $this->discountComputation();
        return number_format(($this->tuition_amt + $this->misc_amt + $other) - $discount, 2);
    }

    public function getPaymentStatusAttribute()
    {
        $status = $this->approval ? $this->approval =='Approved' ? 'badge-success' : 'badge-danger' : 'label-danger';
        $status_text = $this->approval ? $this->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved';
        
        return '<span class="badge '.$status.'">'.$status_text.'</span>';
    }
}