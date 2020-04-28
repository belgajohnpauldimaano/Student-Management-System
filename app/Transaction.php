<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function transaction_others_fee() 
    {
        return $this->hasMany(TransactionOtherFee::class, 'or_number', 'or_number');
    }

    public function payment_cat() 
    {
        return $this->hasOne(PaymentCategory::class, 'id', 'payment_category_id');
    }

    
}
