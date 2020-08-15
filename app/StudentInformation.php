<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInformation extends Model
{
    public function user ()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function enrolled_class () 
    {
        return $this->hasMany(Enrollment::class, 'student_information_id', 'id');
    }

    public function transactions ()
    {
        return $this->hasOne(Transaction::class, 'id', 'student_id');
    }

    public function finance_transaction ()
    {
        $School_year_id = SchoolYear::where('status', 1)
            ->where('current', 1)->first()->id;

        return $this->hasOne(Transaction::class, 'student_id', 'id')->where('school_year_id', $School_year_id);
    }
    
    public function payment_cat() 
    {
        return $this->hasOne(PaymentCategory::class, 'id', 'payment_category_id');
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

    
    public function disc_transaction_fee()
    {        
        return $this->hasMany(TransactionDiscount::class, 'transaction_month_paid_id', 'id' );
    }
}
