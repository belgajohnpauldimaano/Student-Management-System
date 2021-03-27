<div class="table-responsive">  
    <a href="{{ route('export_excel.excel') }}" class="btn btn-success mb-1">
        <i class="fas fa-file-excel"></i> Export to Excel
    </a>
    <div class="float-right">
        {{ $Approved ? $Approved->links() : '' }}
    </div>
    <table class="table no-margin table-bordered table-sm table-hover">
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
                <th>Payment</th>
                <th>Balance</th>
                <th>Status</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($Approved as $key => $data)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$data->student->full_name}}</td>
                    <td>
                        {{$data->student_level}}
                    </td>
                    <td>{{number_format($data->tuition_amt,2)}}</td>
                    <td>{{number_format($data->misc_amt,2)}}</td>
                    <td>
                        {{ $data->other_total }}
                    </td>
                    <td>
                        {{ $data->discount_total }}
                        {{-- {{number_format($data->discount_amt, 2)}} --}}
                    </td>
                    <td>
                        {{ $data->total_fees }}
                    </td>
                    <td>{{number_format($data->payment, 2)}}</td>
                    <td>{{number_format($data->balance, 2)}}</td>
                    <td>
                        {!! $data->payment_status !!}
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary btn-view-modal" title="View" data-id="{{$data->transaction_id}}"  data-monthly_id="{{$data->transact_monthly_id}}"><i class="fas fa-eye"></i></a>
                        {{-- <a class="btn btn-sm btn-success btn-approve" title="Approve" data-id="{{$data->transact_monthly_id}}"><i class="fas fa-thumbs-up"></i></a> --}}
                        <a class="btn btn-sm btn-danger btn-disapprove" title="Disapprove" data-id="{{$data->transact_monthly_id}}"><i class="fas fa-thumbs-down"></i></a>
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