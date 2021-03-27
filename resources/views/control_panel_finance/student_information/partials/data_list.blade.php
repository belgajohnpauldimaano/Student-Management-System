<div class="table-responsive">      
    <div class="float-right">
        {{ $StudentInformation ? $StudentInformation->links() : '' }}
    </div>
    <table class="table no-margin table-hover table-sm">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th class="text-center">Gender</th>
                <th class="text-center">Balance</th>
                <th class="text-center">Payment Status</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>                               
            @forelse ($StudentInformation as $data)
                <tr>
                    <td>{{ $data->full_name }} </td>
                    <td>{{ $hasUser == 1 ? $data->username : $data->user->username }}</td>
                    <td class="text-center">{{ ($data->gender == 1 ? 'Male' : 'Female') }}</td>
                    <td class="text-center">
                        @if($sy_transaction)
                            {!! $data->finance_transaction_bal !!}
                        @else
                            {!! $data->finance_student_bal !!}
                        @endif
                    </td>
                    <td style="color: red" class="text-center">                        
                        @if($sy_transaction)
                            {!! $data->transaction_status !!}
                        @else
                            {!! $data->transaction_status_not_filtered !!}
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge {{ $data->status == 1 ? 'bg-green' : 'bg-red' }}">
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="input-group-btn">
                            <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}&school_year={{ $sy_transaction }}&class_details={{ $data->class_details_id }}"
                                class="btn btn-primary btn-sm"
                            >
                                <i class="far fa-user"></i> Account
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <div class="box-body">
                    <div class="row">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="text-align:center">
                                        <img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/>
                                        <br/>Sorry, there is no data found. Or please combine the filter year and section. Thank you!
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforelse
        </tbody>
    </table>
</div>