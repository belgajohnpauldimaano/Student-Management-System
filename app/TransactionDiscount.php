<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDiscount extends Model
{
    public function discountFee()
    {        
        return $this->hasOne(DiscountFee::class, 'id', 'discount_fee_id');
    }
}
