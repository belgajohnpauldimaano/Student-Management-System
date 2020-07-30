<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDiscount extends Model
{
    public function discountFee()
    {        
        return $this->hasOne(DiscountFee::class, 'id', 'discount_fee_id');
    }

    public function transactionMonth()
    {
        return $this->belongsTo(TransactionMonthPaid::class, 'transaction_month_paid_id', 'id');
    }
}
