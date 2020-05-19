<div class="pull-right">
    {{ $StudentAccount ? $StudentAccount->links() : '' }}
</div>
<table class="table no-margin table-bordered table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Student level</th>
            <th>Balance</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($StudentAccount as $key => $data)
            <tr>
                <td>{{$key + 1}}.</td>
                <td>{{$data->student_name}}</td>
                <td>{{$data->student_level}}</td>
                <td>
                    <?php 
                        $bal = \App\TransactionMonthPaid::where('transaction_id', $data->transactions_id)->ORDERBY('id', 'DESC')->first();
                        if($bal){
                            echo number_format($bal->balance, 2);
                        }else{
                            echo '0.00';
                        }                        
                    ?>
                </td>
                <td>
                    <span class="label {{ $data->status ? $data->status == 0 ? 'label-success' : 'label-danger' : 'label-danger'}}">
                    {{ $data->status ? $data->status == 0 ? 'Paid' : 'Not yet Paid' : 'Not yet Paid'}}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-primary btn-disapprove-modal" data-id="{{$data->transactions_id}}">View</button>
                    <button class="btn btn-sm btn-success btn-approve" data-id="{{$data->transactions_id}}">Paid</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>