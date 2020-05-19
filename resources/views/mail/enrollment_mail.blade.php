<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
    
    <body>
    <div style="padding: 20px">
        <h3 style="text-align:center; margin-bottom:10px">
            SJAI Online Registration Confirmation
        </h3>
        <br/>
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
                        <td>Discount Fee</td>
                        <td> ₱ 
                            <?php
                                $discount = \App\TransactionDiscount::where('student_id', $payment->student_id)
                                        ->where('school_year_id', $payment->school_year_id)->first();
                                
                                if($discount){
                                    echo number_format($discount->discount_amt, 2);
                                }else{
                                    echo '--NA--';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Fees</td>
                        <?php
                            $tuitionMisc_fee = $payment->payment_cat->tuition->tuition_amt + $payment->payment_cat->misc_fee->misc_amt;
                            if($discount){
                                $totalDiscount =  number_format($tuitionMisc_fee - $discount->discount_amt, 2);
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
                        <td>₱ 
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
                                    {{number_format($tuitionMisc_fee,2)}}
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