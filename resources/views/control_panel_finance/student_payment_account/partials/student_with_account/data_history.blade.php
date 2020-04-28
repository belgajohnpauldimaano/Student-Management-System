<div class="col-12">    
    <h3>Payment History</h3>
        
    <table class="table table-bordered table-hover table-striped" style="margin-top: 20px">
        <thead class="thead-dark">
            <tr>
                <th  style="width: 20%">OR Number</th>
                <th  style="width: 20%">For the Month</th>
                <th  style="width: 20%">Payment Fee</th>
                <th  style="width: 20%">Remarks</th>
                <th  style="width: 20%">Date</th>
            </tr>
        </thead>
        @if($Account)
            @foreach ($TransactionMonthPaid as $key => $item)
                <tr>
                    <td>{{ $item->or_no }}</td>
                    <td>{{ $item->month_paid }}</td>
                    <td>{{ number_format($item->payment, 2)}}</td>
                    <td><span class="label label-success">Paid</span></td>
                    <td>{{ date_format(date_create($item->created_at), 'F d, Y H:i:s') }}</td>
                </tr>
            @endforeach
        @else
            <th colspan="5" style="text-align: center">No payment history yet.</th>
        @endif
    </table>

    <h3>Enrollment Payment</h3>
    <table class="table table-bordered table-hover table-striped" style="margin-top: 20px">
        <thead>
            <tr>
                <th  style="width: 20%">OR Number</th>
                <th  style="width: 20%">Discount</th>
                <th  style="width: 20%">Downpayment</th>
                <th  style="width: 20%">Remarks</th>
                <th  style="width: 20%">Date</th>
            </tr>
        </thead>        
        <tr>
            <td>{{ $Transaction->or_number }}</td>
            <td>
                @if($Transaction_disc)
                    @foreach($Transaction_disc as $data)
                        {{$data->discountFee->disc_type}} {{number_format($data->discountFee->disc_amt,2)}}<br/>
                    @endforeach
                @endif
            </td>
            <td>{{ number_format($Transaction->downpayment, 2)}}</td>
            <td><span class="label label-success">Paid</span></td>
            <td>{{ date_format(date_create($Transaction->created_at), 'F d, Y H:i:s') }}</td>
        </tr>       
    </table>

</div>   