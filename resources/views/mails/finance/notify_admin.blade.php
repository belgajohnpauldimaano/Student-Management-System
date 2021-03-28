@extends('mails.mail_layout')
@section ('content')
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
                <td>Other Fee {!! $payment->transaction_other_name !!}</td>
                <td> ₱ {{ $payment->transaction_other_fee }}</td>
            </tr>
            <tr>
                @if(!$payment->check_transaction_discount)
                    <td>Discount Fee</td>
                    <td>--NA--</td>
                @else
                    <td>
                        Discount Fee
                    </td>
                    <td></td>
                @endif
            </tr>
            @if($payment->check_transaction_discount)
                <tr>
                    <td>
                        @foreach ($payment->transaction_discounts as $item)
                            {{ $item->discount_type }},<br/>
                        @endforeach
                    </td>
                    <td>  
                        @foreach ($payment->transaction_discounts as $item)
                            {{ number_format($item->discount_amt,2) }}<br/>
                        @endforeach
                    </td>
                </tr>
            @endif
            <tr>
                <td>Total Fees</td>
                <td>₱ {{number_format($payment->transaction_total_fees, 2)}}</td>
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
                <td> ₱ {{ $payment->transaction_current_balance }}</td>
            </tr>                
            <tr style="margin-top: 10px">
                <td>Incoming Balance</td>
                <td>{{ $payment->incoming_balance }}</td>
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