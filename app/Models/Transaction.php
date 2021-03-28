<?php

namespace App\Models;

use App\Models\MiscFee;
use App\Models\SchoolYear;
use App\Models\TuitionFee;
use App\Models\Transaction;
use App\Models\DownpaymentFee;
use App\Models\PaymentCategory;
use App\Models\StudentCategory;
use App\Models\StudentInformation;
use App\Models\TransactionDiscount;
use App\Models\TransactionOtherFee;
use App\Models\TransactionMonthPaid;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function transactions() 
    {
        return $this->hasOne(TransactionOtherFee::class, 'or_number', 'or_number');
    }    

    public function monthly(){
        return $this->hasOne(TransactionMonthPaid::class, 'transaction_id', 'id')->orderBY('id', 'DESC')->where('isSuccess', 1)
        ->where('approval', 'Approved');
    }

    public function monthly_transaction(){
        return $this->hasOne(TransactionMonthPaid::class, 'transaction_id', 'id')->orderBY('id', 'DESC')->where('isSuccess', 1);
    }

    public function payment_cat()
    {
        return $this->hasOne(PaymentCategory::class, 'id', 'payment_category_id');
    }

    public function student() 
    {
        return $this->hasOne(StudentInformation::class, 'id', 'student_id');
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
    
    public function others() 
    {
        return $this->hasOne(TransactionOtherFee::class, 'transaction_id', 'id')->where('isSuccess', 1);
    }

    public function otherfee() 
    {
        return $this->hasOne(TransactionOtherFee::class, 'other_fee_id', 'other_fee_id')->where('isSuccess', 1);
    }
    
    public function disc_transaction_fee()
    {        
        return $this->hasMany(TransactionDiscount::class, 'transaction_month_paid_id', 'id' )->where('isSuccess', 1);
    }


    public function downpayment(){
        return $this->hasOne(DownpaymentFee::class, 'id','downpayment_id');
    }

    public function schoolyear(){
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }

    private function transactionOther($student_id, $school_year_id, $transaction_id)
    {
        return TransactionOtherFee::where('student_id', $student_id)
                    ->where('school_year_id', $school_year_id)
                    ->where('transaction_id', $transaction_id)->where('isSuccess', 1)
                    ->first();
        
    }

    public function getTransactionOtherNameAttribute()
    {
        $other = $this->transactionOther($this->student_id, $this->school_year_id, $this->id);
        
        if($other){
            $result = '('.$other->other_name.')';
        }else{
            $result = '';
        }

        return $result;
    }

    public function getTransactionOtherFeeAttribute()
    {
        $other = $this->transactionOther($this->student_id, $this->school_year_id, $this->id);
        
        if($other){
            $result = number_format($other->item_price, 2);
        }else{
            $result = '';
        }

        return $result;
    }

    private function transactionDetails($transaction_id)
    {
        return Transaction::where('id', $transaction_id)->first();
    }

    public function getTransactionDiscountsAttribute()
    {
        $transaction = $this->transactionDetails($this->id);
        return TransactionDiscount::where('student_id', $transaction->student_id)
                    ->where('school_year_id', $transaction->school_year_id)
                    ->where('isSuccess', 1)
                    ->get();
    }

    private function TransactionTotalDiscount($transaction_id)
    {
        $transaction = $this->transactionDetails($transaction_id);
        return transactionDiscount::where('student_id', $transaction->student_id)
                    ->where('school_year_id', $transaction->school_year_id)
                    ->where('isSuccess', 1)
                    ->sum('discount_amt');
    }

    public function getCheckTransactionDiscountAttribute()
    {
        $transaction = $this->transactionDetails($this->id);
        return TransactionDiscount::where('student_id', $transaction->student_id)
                ->where('school_year_id', $transaction->school_year_id)
                ->where('isSuccess', 1)
                ->first();
    }

    public function getTransactionTotalFeesAttribute()
    {
        $other = $this->transactionOther($this->student_id, $this->school_year_id, $this->id);
        $total_discount = $this->TransactionTotalDiscount($this->id);
        $other_total = 0;
        $discount = $this->getTransactionDiscountsAttribute();
        
        if($other){
            $other_total = $other->item_price;
        }else{
            $other_total = 0;
        }

        $tuition_amt = $this->payment_cat->tuition->tuition_amt;
        $misc_amt = $this->payment_cat->misc_fee->misc_amt;
        
        $tuitionMisc_fee = ($tuition_amt + $misc_amt + $other_total);
        if($discount)
        {
            return $totalDiscount =  ($tuitionMisc_fee  - $total_discount);
        }else{
            return $tuitionMisc_fee;
        }
        
    }

    private function currentBalance($student_id, $school_year_id)
    {
        return TransactionMonthPaid::where('student_id', $student_id)
                        ->where('school_year_id', $school_year_id)
                        ->where('approval', 'Approved')
                        ->where('isSuccess', 1)
                        ->sum('payment');
    }

    public function getTransactionCurrentBalanceAttribute()
    {
        $discount =  $this->getTransactionDiscountsAttribute();
        $total_fee = $this->getTransactionTotalFeesAttribute();
        $current_bal = $this->currentBalance($this->student_id, $this->school_year_id);

       if($current_bal){
            if($current_bal==0){
                return 0;
            }else{
               return number_format($total_fee - $current_bal, 2);
            }
        }
        else{
            return 0;
        }
    }

    public function getIncomingBalanceAttribute()
    {
        $total_fee = $this->getTransactionTotalFeesAttribute();
        $balance = $this->currentBalance($this->student_id, $this->school_year_id);
        $current_bal = ($total_fee - $balance);
        
        $bal = ($current_bal - $this->monthly_transaction->payment);
        return number_format($bal,2);
    }
   
}