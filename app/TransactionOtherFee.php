<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionOtherFee extends Model
{
    public function other()
    {        
        return $this->hasOne(OtherFee::class, 'id', 'others_fee_id');
    }
}
