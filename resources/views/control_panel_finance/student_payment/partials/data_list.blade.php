<div class="table-responsive">
    <div class="col-md-12 float-right float-lg-right float-md-right">
        {{ $Student_account ? $Student_account->links() : '' }}
    </div>
    <table class="table no-margin table-condensed table-hover table-sm">
        <thead>
            <tr>
                <th>No.</th>
                <th width="17%">Name</th>
                <th>Student level</th>
                <th>Tuition Fee</th>
                <th>Misc Fee</th>
                <th>Other Fee</th>
                <th>Disc Fee</th>
                <th>Total Fees</th>
                <th class="text-center">Payment</th>
                <th class="text-center">Incoming Balance</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($Student_account as $key => $data)
                <tr>
                    <td class="text-center">{{$key + 1}}. </td>
                    <td>{{$data->student_name}}</td>
                    <td>{{$data->student_level}}</td>
                    <td>{{number_format($data->tuition_amt,2)}}</td>
                    <td>{{number_format($data->misc_amt,2)}}</td>
                    <td>{{ $data->other_total }}</td>
                    <td>{{ $data->discount_total }}</td>
                    <td>{{ $data->total_fees }}</td>
                    <td>{{number_format($data->payment, 2)}}</td>
                    <td class="text-center">{{number_format($data->balance, 2)}}</td>
                    <td class="text-center">{!! $data->payment_status !!}</td>
                    <td class="text-center" width="15%">
                        <a class="btn btn-sm btn-primary btn-view-modal" title="View" data-id="{{$data->transaction_id}}" data-monthly_id="{{$data->transact_monthly_id}}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-sm btn-success btn-approve" title="Approve" data-id="{{$data->transact_monthly_id}}" data-balance="{{$data->balance}}">
                            <i class="fas fa-thumbs-up"></i>
                        </a>
                        <a class="btn btn-sm btn-danger btn-disapprove" title="Disapprove" data-id="{{$data->transact_monthly_id}}">
                            <i class="fas fa-thumbs-down"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <th colspan="12">No Data Record Found</th>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>