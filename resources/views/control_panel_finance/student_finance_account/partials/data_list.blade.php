<div class="float-right col-12">
    {{ $student_account ? $student_account->links() : '' }}
</div>
<table class="table no-margin table-condensed table-sm table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th class="text-center">Student level</th>
            <th class="text-center">Balance</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($student_account as $key => $data)
            <tr>
                <td>{{$key + 1}}. </td>
                <td>{{$data->student_name}}</td>
                <td class="text-center">{{$data->student_level}}</td>
                <td class="text-center">
                    {{$data->balance_account}}
                </td>
                <td class="text-center">
                    <span class="badge badge-{{ $tab ? $tab == 'not-paid' ? 'danger' : 'success' : ''}}">
                        {{ $tab ? $tab == 'not-paid' ? 'not paid' : 'paid' : ''}}
                    </span>
                </td>
                <td class="text-center">
                    <a class="btn btn-sm btn-primary btn-disapprove-modal" 
                        data-id="{{$data->transactions_id}}" 
                        data-monthly_id="{{$data->transact_monthly_id}}">
                        <i class="fas fa-eye"></i>
                    </a>
                    @if ($tab == 'not-paid')
                        <a class="btn btn-sm btn-success btn-paid" data-id="{{$data->transact_monthly_id}}">
                            Paid
                        </a>
                    @endif
                    
                    {{-- <a class="btn btn-sm btn-danger btn-disapprove" data-id="{{$data->transact_monthly_id}}"><i class="fas fa-thumbs-down"></i></a> --}}
                    {{-- <button class="btn btn-sm btn-primary btn-disapprove-modal" data-id="{{$data->transactions_id}}">View</button>
                    <button class="btn btn-sm btn-success btn-paid" data-id="{{$data->transactions_id}}">
                        Paid
                    </button> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>