<?php

namespace App\Models;

use App\Models\MiscFee;
use App\Traits\HasUser;
use App\Models\Enrollment;
use App\Models\TuitionFee;
use Illuminate\Http\Request;
use App\Traits\HasTransaction;
use App\Models\PaymentCategory;
use App\Models\StudentCategory;
use App\Models\TransactionDiscount;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasOne(TuitionFee::class, 'id', 'tuition_fee_id' );
    }

    public function misc_fee()
    {        
        return $this->hasOne(MiscFee::class, 'id', 'misc_fee_id' );
    }
    
    public function disc_transaction_fee()
    {        
        return $this->hasMany(TransactionDiscount::class, 'transaction_month_paid_id', 'id' );
    }
    
    public function incomingStudent()
    {
        return $this->hasOne(IncomingStudent::class, 'student_id', 'id');
    }


    // public function student(){
    //     return $this->belongsTo(StudentInformation::class);
    // }

    protected $table = 'student_informations';

    protected $fillable = [
        'first_name', 
        'middle_name', 
        'last_name',
        'address',
        'email',
        'contact_number',
        'photo',
        'user_id',
        'current',
        'status'
    ];
}