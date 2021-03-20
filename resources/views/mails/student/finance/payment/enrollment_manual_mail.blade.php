@extends('mails.mail_layout')
@section ('content')
    <p style="text-align: right;">Date: {{ $payment ? date_format(date_create($payment->created_at), 'F d, Y h:i A') : '' }}</p>

    <p>Dear {{$payment->student->last_name.', '.$payment->student->first_name}}</p>
    
    <p>Thank you for using online payment. Below is your payment history.</p>

    <p>Student Level : {{$payment->payment_cat->stud_category->student_category.'-'.$payment->payment_cat->grade_level_id}}</p>
    
        <table border="1" style="border-color: #666;border-collapse: collapse;width:100%; " cellpadding="5">
            <thead>
                <th style="width: 40%">Description</th>
                <th>Amount</th>
            </thead>
            <tbody>
                <tr>
                    <td>Tuition Fee</td>
                    <td>₱ {{number_format($payment->payment_cat->tuition->tuition_amt, 2)}}</td>
                </tr>
                <tr>
                    <td>Misc Fee</td>
                    <td>₱ {{number_format($payment->payment_cat->misc_fee->misc_amt, 2)}}</td>
                </tr>
                <tr>
                    @php $other = \App\Models\TransactionOtherFee::where('student_id', $payment->student_id)
                            ->where('school_year_id', $payment->school_year_id)
                            ->where('transaction_id', $payment->id)->where('isSuccess', 1)
                            ->first();
                    @endphp
                    <td>Other Fee 
                        @php  
                            if($other){
                                echo '('.$other->other_name.')';
                            }else{
                                echo '';
                            }
                        @endphp
                    </td>
                    <td> ₱
                        @php  
                            if($other){
                                echo number_format($other->item_price, 2);
                            }else{
                                echo '0.00';
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    @php
                       
                        $discount_transction = \App\Models\Transaction::where('id', $payment->id)->first();
                    
                        $discount = \App\Models\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                ->where('school_year_id', $discount_transction->school_year_id)
                                ->where('isSuccess', 1)
                                ->get();
                                
                        $total_discount = \App\Models\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                ->where('school_year_id', $discount_transction->school_year_id)
                                ->where('isSuccess', 1)
                                ->sum('discount_amt');
                                
                        $hasDiscount = \App\Models\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                ->where('school_year_id', $discount_transction->school_year_id)
                                ->where('isSuccess', 1)
                                ->first();   
                    @endphp
                    
                    @if(!$hasDiscount)
                        <td>Discount Fee</td>
                        <td>--NA--</td>
                    @else
                        <td colspan="2">Discount Fee</td>

                    @endif
                </tr>
                @if($hasDiscount)
                    <tr>
                        <td>
                            @php
                                foreach ($discount as $item) {
                                    echo $item->discount_type.'<br/>';
                                }
                            @endphp                                
                        </td>
                        <td>  
                            @php
                                $total_disc = 0;
                                if($discount){
                                    foreach ($discount as $item) {
                                        echo '₱ '.number_format($item->discount_amt, 2).'<br/>';
                                        // $total_disc += $item->discount_amt;
                                    }
                                }else{
                                    echo '--NA--';
                                }
                            @endphp
                            {{-- {{number_format($payment->disc_transaction_fee->discount_amt, 2)}} --}}                            
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>Total Fees</td>
                    @php
                        $other_total = 0;
                        if($other){
                            $other_total = $other->item_price;
                        }else{
                            $other_total = 0;
                        }
                        $tuitionMisc_fee = $payment->payment_cat->tuition->tuition_amt + $payment->payment_cat->misc_fee->misc_amt + $other_total;
                        if($discount){
                            $totalDiscount =  $tuitionMisc_fee  - $total_discount;
                        }                            
                     @endphp
                    @if($discount)
                        <td>₱ {{number_format($totalDiscount, 2)}}</td>
                    @else
                        <td>₱ {{number_format($tuitionMisc_fee,2)}}</td>
                    @endif
                    
                </tr>
                
                <tr>
                    <td colspan="2" style="text-align:left">
                    <br>
                        <b>Payment</b>
                    </td>
                </tr>
                <tr>
                    <td>{{$payment->monthly_transaction->payment_option}}</td>
                    <td>₱ {{number_format($payment->monthly_transaction->payment, 2)}}</td>
                </tr>
                <tr style="margin-top: 10px">
                    <td>Previous Balance</td>
                    <td> ₱
                        @php 
                            $current_bal = \App\Models\TransactionMonthPaid::where('student_id', $payment->student_id)
                                ->where('school_year_id', $payment->school_year_id)
                                ->where('approval', 'Approved')
                                ->where('isSuccess', 1)
                                ->sum('payment');

                            if($current_bal){
                                if($current_bal==0){
                                    echo number_format($tuitionMisc_fee,2);
                                }else{
                                    // echo number_format($current_bal, 2);
                                    if($discount){
                                        echo number_format($totalDiscount - $current_bal + ($payment->monthly_transaction->payment), 2);
                                    }
                                    else
                                    {
                                        echo number_format($tuitionMisc_fee - $current_bal + ($payment->monthly_transaction->payment), 2);
                                    }
                                }                                    
                            }else{
                            @endphp                
                                @if($discount)
                                    {{ number_format($totalDiscount, 2)}}
                                @else
                                    {{ number_format($tuitionMisc_fee + $payment->monthly_transaction->payment,2)}}
                                @endif      
                            @php
                            }
                        @endphp
                    </td>
                </tr>
                
                <tr style="margin-top: 10px">
                    <td>Incoming Balance</td>
                    <td>₱ {{number_format($payment->monthly_transaction->balance, 2)}}</td>
                </tr>
                <tr style="margin-top: 10px">
                    <td>Date and Time:</td>
                    <td>{{ $payment ? date_format(date_create($payment->monthly_transaction->created_at), 'F d, Y h:i A') : '' }}</td>
                </tr>
                <tr style="margin-top: 10px">
                    <td>Total Amount paid (to be confirmed by finance)</td>
                    <td>₱ {{number_format($payment->monthly_transaction->payment, 2)}}</td>
                </tr>
                
            </tbody>
        </table>
@endsection