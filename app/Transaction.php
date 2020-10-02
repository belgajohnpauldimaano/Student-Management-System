<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function transactions() 
    {
        return $this->hasOne(TransactionOtherFee::class, 'or_number', 'or_number');
    }    

    public function monthly(){
        return $this->hasOne(TransactionMonthPaid::class, 'transaction_id', 'id')->orderBY('id', 'DESC')->where('isSuccess', 1)
        ->where('approval', 'Approved');
    }

    public function monthly_transaction(){
        return $this->hasOne(TransactionMonthPaid::class, 'transaction_id', 'id')->orderBY('id', 'DESC')->where('isSuccess', 1);
    }

    public function payment_cat()
    {
        return $this->hasOne(PaymentCategory::class, 'id', 'payment_category_id');
    }

    public function student() 
    {
        return $this->hasOne(StudentInformation::class, 'id', 'student_id');
    }

    public function stud_category()
    {        
        return $this->hasOne(StudentCategory::class, 'stud_id', 'student_category_id' );
    }

    public function tuition()
    {        
        return $this->hasOne(TuitionFee::class, 'tuition_fee_id', 'tuition_fee_id' );
    }

    public function misc_fee()
    {        
        return $this->hasOne(MiscFee::class, 'misc_fee_id', 'misc_fee_id' );
    }
    
    public function others() 
    {
        return $this->hasOne(TransactionOtherFee::class, 'transaction_id', 'id')->where('isSuccess', 1);
    }

    public function otherfee() 
    {
        return $this->hasOne(TransactionOtherFee::class, 'other_fee_id', 'other_fee_id')->where('isSuccess', 1);
    }
    
    public function disc_transaction_fee()
    {        
        return $this->hasMany(TransactionDiscount::class, 'transaction_month_paid_id', 'id' )->where('isSuccess', 1);
    }


    public function downpayment(){
        return $this->hasOne(DownpaymentFee::class, 'id','downpayment_id');
    }

    public function schoolyear(){
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }
}