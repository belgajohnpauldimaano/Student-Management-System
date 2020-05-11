<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
    </head>
 
    <body>
    <h3 style="text-align:center; margin-bottom:10px">
        SJAI Online Registration Confirmation:
    </h3>

    <p>Dear {{$payment->student->last_name.', '.$payment->student->first_name}}</p>
    
    <p>Thank you for using online payment. Below is your payment history.</p>

    <p>Student Level : {{$payment->payment_cat->stud_category->student_category.'-'.$payment->payment_cat->grade_level_id}}</p>

    <table border="1" style="border-color: #666;border-collapse: collapse;width:100%; " cellpadding="5">
        <thead>
            <th>Description</th>
            <th>Amount</th>
        </thead>
        <tbody>
            <tr>
                <td>Tuition Fee</td>
                <td>{{number_format($payment->payment_cat->tuition->tuition_amt, 2)}}</td>
            </tr>
            <tr>
                <td>Misc Fee</td>
                <td>{{number_format($payment->payment_cat->misc_fee->misc_amt, 2)}}</td>
            </tr>
            <tr>
                <td>Total Fees</td>
                <td>{{number_format($payment->payment_cat->tuition->tuition_amt + $payment->payment_cat->misc_fee->misc_amt, 2)}}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:left">Payment</td>
            </tr>
            <tr>
                <td>{{$payment->payment_option}}</td>
                <td>{{number_format($payment->downpayment, 2)}}</td>
            </tr>
            <tr style="margin-top: 10px">
                <td>Balance</td>
                <td>{{number_format($payment->balance, 2)}}</td>
            </tr>
            <tr style="margin-top: 10px">
                <td>Due:</td>
                <td>{{$payment->created_at}}</td>
            </tr>
            <tr style="margin-top: 10px">
                <td>Total Due:</td>
                <td>{{$payment->downpayment, 2}}</td>
            </tr>
            
        </tbody>
    </table>

    <p>This is auto generated receipt. Thank you!</p>
    </body>
</html>