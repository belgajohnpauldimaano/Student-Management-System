<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionOtherFee extends Model
{
    public function other()
    {        
        return $this->hasOne(OtherFee::class, 'id', 'others_fee_id');
    }

    public function transactions() 
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    } 

    public function payment_cat()
    {
        return $this->hasOne(PaymentCategory::class, 'id', 'payment_category_id');
    }
}
