                       

                          
                           
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
                                                        @if($data->student_balance)
                                                            {{ number_format($data->student_balance->balance, 2) }}
                                                        @else
                                                            <span class="label label-warning">
                                                                None
                                                            </span> 
                                                        @endif
                                                    </td>
                                                    <td>
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
                                                        <div class="input-group-btn pull-left text-left">
                                                            {{-- @if(!$transactions)                                                                  --}}
                                                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}&school_year={{ $data->school_year_id }}&class_details={{ $data->id }}"
                                                                    class="btn btn-flat btn-primary btn-sm"
                                                                >
                                                                    Account
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
                                                    <td>{{ $key + 1 }}.</td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>{{ ucwords($data->full_name) }}</td>
                                                    <td>
                                                        @if($data->student_balance)
                                                            {{ number_format($data->student_balance->balance, 2) }}
                                                        @else
                                                            <span class="label label-warning">
                                                                None
                                                            </span> 
                                                        @endif
                                                    </td>
                                                    <td>
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
                                                        <div class="input-group-btn pull-left text-left">
                                                            {{-- @if(!$Transaction)                                                                  --}}
                                                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}&school_year={{ $data->school_year_id }}&class_details={{ $data->id }}"
                                                                    class="btn btn-flat btn-primary btn-sm"
                                                                >
                                                                    Account
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
                             

                            
               