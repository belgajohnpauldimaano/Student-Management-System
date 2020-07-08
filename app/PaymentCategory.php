<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentCategory extends Model
{
    public function stud_category()
    {        
        return $this->hasOne(StudentCategory::class, 'id', 'student_category_id' );
    }

    public function tuition()
    {        
        return $this->hasOne(TuitionFee::class, 'id', 'tuition_fee_id' );
    }

    public function misc_fee()
    {        
        return $this->hasOne(MiscFee::class, 'id', 'misc_fee_id' );
    }

    public function other_fee()
    {        
        return $this->hasOne(OtherFee::class, 'id', 'other_fee_id' );
    }
}
