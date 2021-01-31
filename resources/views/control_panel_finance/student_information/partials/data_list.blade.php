<div class="table-responsive">      
    <div class="float-right">
        {{ $StudentInformation ? $StudentInformation->links() : '' }}
    </div>
    <table class="table no-margin table-hover table-sm">
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
                        @if($sy_transaction)
                            @php
                                $transactionSchoolYear->where('school_year_id', $sy_transaction)->first();
                                $sub = $transactionMonth->where('student_id', $data->id)
                                    ->where('school_year_id', $sy_transaction)
                                    ->whereApproval('Approved')->orderBY('id', 'DESC')->first();
                                if($sub){
                                    echo number_format($sub->balance, 2);
                                }else{
                                    echo '<span class="badge badge-warning">
                                        None
                                    </span> ';
                                }
                            @endphp
                        @else
                            @if($data->student_balance)
                                {{ number_format($data->student_balance->balance, 2) }}
                            @else
                                <span class="badge badge-warning">
                                    None
                                </span> 
                            @endif
                        @endif
                    </td>
                    <td style="color: red">
                        @if($sy_transaction)
                            @php
                                $sub_sy =  $transactionSchoolYear->where('student_id', $data->id)
                                    ->where('school_year_id', $sy_transaction)->first();
                                if($sub_sy){
                                    echo '<span class="badge ';
                                        echo $sub_sy->status == 0 ? 'badge-success' : 'badge-danger';
                                        echo '">';
                                    echo $sub_sy->status == 0 ? 'Paid' : 'Not-Paid';
                                    echo '</span>';
                                }else{
                                    echo '<span class="badge badge-warning">
                                        None
                                    </span> ';
                                }
                            @endphp
                        @else
                            @if($data->transactions)
                                <span class="badge {{ $data->transactions->status == 0 ? 'badge-success' : 'badge-danger' }}">
                                    {{ $data->transactions->status == 0 ? 'Paid' : 'Not-Paid' }}
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Not-Paid
                                </span>
                            @endif   
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $data->status == 1 ? 'bg-green' : 'bg-red' }}">
                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="input-group-btn float-left text-left">
                            @if(!$Transaction)
                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}&school_year={{ $sy_transaction }}&class_details={{ $data->class_details_id }}"
                                    class="btn btn-primary btn-sm"
                                >
                                    <i class="far fa-user"></i> Account
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