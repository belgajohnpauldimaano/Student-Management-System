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
                        <?php $other = \App\TransactionOtherFee::where('student_id', $payment->student_id)
                                 ->where('school_year_id', $payment->school_year_id)
                                ->where('transaction_id', $payment->id)->first();
                        ?>
                        <td>Other Fee 
                            <?php  if($other){
                                echo '('.$other->other_name.')';
                            }else{
                                echo '';
                            }?>
                        </td>
                        <td> ₱
                            <?php  if($other){
                                echo number_format($other->item_price, 2);
                            }else{
                                echo '0';
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <?php 
                            $discount_transction = \App\Transaction::where('id', $payment->id)->first();
                        
                            $discount = \App\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                    ->where('school_year_id', $discount_transction->school_year_id)
                                    ->get();
                                    
                            $total_discount = \App\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                    ->where('school_year_id', $discount_transction->school_year_id)
                                    ->sum('discount_amt');
                                    
                            $hasDiscount = \App\TransactionDiscount::where('student_id', $discount_transction->student_id)
                                    ->where('school_year_id', $discount_transction->school_year_id)
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
                            $tuitionMisc_fee = $payment->payment_cat->tuition->tuition_amt + $payment->payment_cat->misc_fee->misc_amt + $other->item_price;
                            if($discount){
                                $totalDiscount =  number_format($tuitionMisc_fee  - $total_discount, 2);
                            }                            
                         ?>
                        @if($discount)
                            <td>₱ {{$totalDiscount}}</td>
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
                        <td>{{$payment->monthly->payment_option}}</td>
                        <td>₱ {{number_format($payment->monthly->payment, 2)}}</td>
                    </tr>
                    <tr style="margin-top: 10px">
                        <td>Previous Balance</td>
                        <td> ₱
                            <?php 
                                $current_bal = \App\TransactionMonthPaid::where('student_id', $payment->student_id)
                                    ->where('school_year_id', $payment->school_year_id)
                                    ->orderBY('id', 'desc')
                                    ->skip(1)
                                    ->take(1)
                                    ->first();
                                if($current_bal){
                                    if($current_bal->balance==0){
                                        echo number_format($tuitionMisc_fee,2);
                                    }else{
                                        echo number_format($current_bal->balance, 2);
                                    }                                    
                                }else{
                                ?>                                
                                    @if($discount)
                                         {{$totalDiscount}}
                                    @else
                                         {{number_format($tuitionMisc_fee,2)}}
                                    @endif
                                <?php
                                }
                            ?>
                        </td>
                    </tr>
                    
                    <tr style="margin-top: 10px">
                        <td>Current Balance</td>
                        <td>₱ {{number_format($payment->monthly->balance, 2)}}</td>
                    </tr>
                    <tr style="margin-top: 10px">
                        <td>Date and Time:</td>
                        <td>{{ $payment ? date_format(date_create($payment->monthly->created_at), 'F d, Y h:i A') : '' }}</td>
                    </tr>
                    <tr style="margin-top: 10px">
                        <td>Total Amount paid (to be confirmed by finance)</td>
                        <td>₱ {{number_format($payment->monthly->payment, 2)}}</td>
                    </tr>
                    
                </tbody>
            </table>
        
        <br/>
        <p>This is auto generated receipt. Thank you!</p>
    </div>
    </body>
</html>