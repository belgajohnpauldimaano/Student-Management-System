<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
    
    <body>
    <div style="padding: 20px">
        <h3 style="text-align:center; margin-bottom:10px">
            St. John's Academy Inc.<br/>
            Online Registration Confirmation
        </h3>
        <br/>
        <p style="text-align: right;">Date: {{ $payment ? date_format(date_create($payment->created_at), 'F d, Y h:i A') : '' }}</p>

        <p>Dear Finance,</p>
        
        <p>You have received the payment of {{$payment->student->last_name.', '.$payment->student->first_name}}.</p>

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
                    <?php $other = \App\TransactionOtherFee::where('student_id', $payment->student_id)
                            ->where('school_year_id', $payment->school_year_id)
                            ->where('transaction_id', $payment->id)->where('isSuccess', 1)
                            ->first();
                    ?>
                    <td>Other Fee 
                        <?php  
                            if($other){
                                echo '('.$other->other_name.')';
                            }else{
                                echo '';
                            }
                        ?>
                    </td>
                    <td> ₱
                        <?php  
                            if($other){
                                echo number_format($other->item_price, 2);
                            }else{
                                echo '0.00';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <?php
                       
                        $discount_transction = \App\Transaction::where('id', $payment->id)->first();
                    
                        $discount = \App\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                ->where('school_year_id', $discount_transction->school_year_id)
                                ->where('isSuccess', 1)
                                ->get();
                                
                        $total_discount = \App\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                ->where('school_year_id', $discount_transction->school_year_id)
                                ->where('isSuccess', 1)
                                ->sum('discount_amt');
                                
                        $hasDiscount = \App\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                ->where('school_year_id', $discount_transction->school_year_id)
                                ->where('isSuccess', 1)
                                ->first();   
                    ?>
                    
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
                            <?php
                                foreach ($discount as $item) {
                                    echo $item->discount_type.'<br/>';
                                }
                            ?>                                
                        </td>
                        <td>  
                            <?php
                                $total_disc = 0;
                                if($discount){
                                    foreach ($discount as $item) {
                                        echo '₱ '.number_format($item->discount_amt, 2).'<br/>';
                                        // $total_disc += $item->discount_amt;
                                    }
                                }else{
                                    echo '--NA--';
                                }
                            ?>
                            {{-- {{number_format($payment->disc_transaction_fee->discount_amt, 2)}} --}}                            
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>Total Fees</td>
                    <?php
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
                     ?>
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
                        <?php 
                            $current_bal = \App\TransactionMonthPaid::where('student_id', $payment->student_id)
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
                            ?>                
                                @if($discount)
                                    {{ number_format($totalDiscount, 2)}}
                                @else
                                    {{ number_format($tuitionMisc_fee + $payment->monthly_transaction->payment,2)}}
                                @endif      
                            <?php
                            }
                        ?>
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
        
        <br/>
        {{-- <p>This is auto generated receipt. Thank you!</p> --}}
        <br>
        <p>
            DISCLAIMER : The message (including the attachments) contains Confidential Information and is intended for the named recipient only. Unless you are the intended recipient (or authorized to receive for the intended recipient), you may not read, print, retain, use, copy, distribute nor disclose to anyone this message or any information contained herein. If you have received the message in error, please advise the sender immediately by reply e-mail, and destroy all copies of the original message (including the attachments).
        </p>
    </div>
    </body>
</html>