
                           @if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)
                                <table class="table no-margin table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($Enrollment)
                                            @foreach ($Enrollment as $key => $data)
                                                <tr>
                                                    <td> {{ $key + 1 }}.</td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>{{ ucwords($data->full_name) }}</td>
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
                                                    <td>
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
                                                        <div class="input-group-btn float-left text-left">
                                                            {{-- @if(!$transactions)                                                                  --}}
                                                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}&school_year={{ $sy_transaction }}&class_details={{ $_id }}"
                                                                    class="btn btn-primary btn-sm"
                                                                >
                                                                    <i class="far fa-user"></i>  Account
                                                                </a>   
                                                            {{-- @endif                                                     --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            @else
                                <table class="table no-margin table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($Enrollment)
                                            @foreach ($Enrollment as  $key => $data)
                                                <tr>
                                                    <td>{{ $key + 1 }}. </td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>{{ ucwords($data->full_name) }}</td>
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
                                                    <td>
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
                                                        <div class="input-group-btn float-left text-left">
                                                            {{-- @if(!$Transaction)                                                                  --}}
                                                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}&school_year={{ $sy_transaction }}&class_details={{ $_id }}"
                                                                    class="btn btn-primary btn-sm"
                                                                >
                                                                    <i class="far fa-user"></i>  Account
                                                                </a>   
                                                            {{-- @endif                                                     --}}
                                                        </div>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            @endif
                             

                            
               