<div class="table-responsive">      
    <div class="pull-right">
        {{ $StudentInformation ? $StudentInformation->links() : '' }}
    </div>
    <table class="table no-margin table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Balance</th>
                <th>Payment Status</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>                               
            @forelse ($StudentInformation as $data)
                <tr>
                    <td>{{ $data->full_name }} </td>
                    <td>{{ $hasUser == 1 ? $data->username : $data->user->username }}</td>
                    <td>{{ ($data->gender == 1 ? 'Male' : 'Female') }}</td>
                    <td>
                        @if($data->student_balance)
                            {{ number_format($data->student_balance->balance, 2) }}
                        @else
                            <span class="label label-warning">
                                None
                            </span> 
                        @endif
                    </td>
                    <td style="color: red">
                        {{-- {{ $data->transactions}} --}}
                        @if($data->transactions)
                                                            <span class="label {{ $data->transactions->status == 0 ? 'label-success' : 'label-danger' }}">
                                                                {{ $data->transactions->status == 0 ? 'Paid' : 'Not-Paid' }}
                                                            </span>
                                                        @else
                                                            <span class="label label-danger">
                                                                 Not-Paid
                                                            </span>
                                                        @endif   
                    </td>
                    <td>
                        <span class="badge {{ $data->status == 1 ? 'bg-green' : 'bg-red' }}">
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="input-group-btn pull-left text-left">
                            @if(!$Transaction)                                                                 
                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}&school_year={{ $data->school_year_id }}&class_details={{ $data->class_details_id }}"
                                    class="btn btn-flat btn-primary btn-sm"
                                >
                                    Account
                                </a>   
                            @endif                                                    
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
                                        <br/>Sorry, there is no data found.
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