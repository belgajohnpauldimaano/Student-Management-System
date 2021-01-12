<?php
namespace App\Traits;

use App\Models\TransactionMonthPaid;

trait hasNotYetApproved{
    public function notYetApproved(){
        $NotyetApprovedCount = TransactionMonthPaid::where('approval', 'Not yet Approved')->where('isSuccess', 1)
        ->count();
        return $NotyetApprovedCount;
    }
}