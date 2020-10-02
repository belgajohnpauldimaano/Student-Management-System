<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTransaction;
use App\Traits\HasUser;

class StudentInformation extends Model
{
    use HasTransaction, HasUser;
    
    public function enrolled_class ()
    {        
       return $this->hasMany(Enrollment::class, 'student_information_id', 'id');
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