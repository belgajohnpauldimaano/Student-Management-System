<div class="col-12">    
    <h3>Payment History</h3>
        
    <table class="table table-bordered table-hover table-striped" style="margin-top: 20px">
        <thead class="thead-dark">
            <tr>
                <th style="width: 15%">Payment Option</th>
                <th  style="width: 15%">OR Number</th>
                <th  style="width: 15%">Payment Fee</th>
                <th  style="width: 15%">Balance</th>
                <th  style="width: 15%">Remarks</th>
                <th  style="width: 15%">Date</th>
            </tr>
        </thead>
        @if($Account)
            @foreach ($TransactionMonthPaid as $key => $item)
                <tr>
                    <td>{{ $item->payment_option }}</td>
                    <td>{{ $item->or_no }}</td>
                    <td>{{ number_format($item->payment, 2)}}</td>
                    <td>{{ number_format($item->balance, 2) }}</td>
                    <td>
                        <span class="label label-{{ $item->approval == "Approved" ? 'success' : 'danger' }}">{{$item->approval}}</span>
                    </td>
                    <td>{{ date_format(date_create($item->created_at), 'F d, Y H:i:s') }}</td>
                </tr>
            @endforeach
        @else
            <th colspan="5" style="text-align: center">No payment history yet.</th>
        @endif
    </table>

    {{-- <h3>Enrollment Payment</h3>
    <table class="table table-bordered table-hover table-striped" style="margin-top: 20px">
        <thead>
            <tr>
                <th style="width: 15%">Payment Option</th>
                <th  style="width: 15%">OR Number</th>
                <th  style="width: 15%">Discount</th>
                <th  style="width: 15%">Downpayment</th>
                <th  style="width: 15%">Remarks</th>
                <th  style="width: 15%">Date</th>
            </tr>
        </thead>        
        <tr>
            <td>{{ $TransactionMonthPaid[0]->payment_option }}</td>
            <td>{{ $Transaction->or_number }}</td>
            <td>
                @if($Transaction_disc)
                    @foreach($Transaction_disc as $data)
                        {{$data->discount_type}} {{number_format($data->discount_amt,2)}}<br/>
                    @endforeach
                @endif
            </td>
            <td>{{ number_format($TransactionMonthPaid[0]->payment, 2)}}</td>
            <td>
                <span class="label label-{{ $TransactionMonthPaid[0]->approval == "Approved" ? 'success' : 'danger' }}">{{$TransactionMonthPaid[0]->approval}}</span>
            </td>
            <td>{{ date_format(date_create($Transaction->created_at), 'F d, Y H:i:s') }}</td>
        </tr>       
    </table> --}}

</div>   