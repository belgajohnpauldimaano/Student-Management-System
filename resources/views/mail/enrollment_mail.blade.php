<html>
    <head>
        <meta http-equiv=3D"Content-Type" content=3D"text/html; charset==3DUTF-8" />
    </head>
    <style>
        td{
            text-align: center;
        }
    </style>
    <body>
    <p>Dear {{$payment->student->last_name.', '.$payment->student->first_name}}</p>
    
    <p>Below is your payment history.</p>

    <table border="1" style="border-color: #666;border-collapse: collapse;width:100%; " cellpadding="5">
        <thead>
            <th>Student Level</th>
            <th>Tuition Fee</th>
            <th>Misc Fee</th>
            <th>Payment</th>
        </thead>
        <tbody>
            <td>{{$payment->payment_cat->stud_category->student_category.'-'.$payment->payment_cat->grade_level_id}}</td>
            <td>{{number_format($payment->payment_cat->tuition->tuition_amt, 2)}}</td>
            <td>{{number_format($payment->payment_cat->misc_fee->misc_amt, 2)}}</td>
            <td>{{number_format($payment->downpayment, 2)}}</td>
        </tbody>
    </table>

    <p>This is auto generated receipt. Thank you!</p>
    </body>
</html>