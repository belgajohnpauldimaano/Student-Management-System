<?php

namespace App\Models;

use App\Models\MiscFee;
use App\Models\TuitionFee;
use App\Models\Transaction;
use App\Models\PaymentCategory;
use App\Models\StudentCategory;
use App\Models\StudentInformation;
use App\Models\TransactionDiscount;
use Illuminate\Database\Eloquent\Model;

class TransactionMonthPaid extends Model
{

    public function transaction(){
        return $this->hasMany(Transaction::class, 'id', 'transaction_id');
    }

    public function payment_cat() 
    {
        return $this->hasOne(PaymentCategory::class, 'payment_category_id', 'payment_category_id');
    }

    public function student() 
    {
        return $this->hasOne(StudentInformation::class, 'id', 'student_id');
    }

    public function stud_category()
    {        
        return $this->hasOne(StudentCategory::class, 'id', 'student_category_id' );
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
        return $this->hasOne(TransactionDiscount::class, 'transaction_month_paid_id', 'id' );
    }
}