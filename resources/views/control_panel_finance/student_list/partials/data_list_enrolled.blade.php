
                           {{-- @if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)
                                <table class="table table-sm no-margin table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
                                            <th class="text-center">Balance</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($Enrollment)
                                            @foreach ($Enrollment as $key => $data)
                                                <tr>
                                                    <td> {{ $key + 1 }}.</td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>{{ ucwords($data->full_name) }}</td>
                                                    <td class="text-center">
                                                        @if($sy_transaction)
                                                            {!! $data->finance_transaction_bal !!}
                                                        @else
                                                            {!! $data->finance_student_bal !!}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($sy_transaction)
                                                            {!! $data->transaction_status !!}
                                                        @else
                                                            {!! $data->transaction_status_not_filtered !!}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group-btn">
                                                                                                                             
                                                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}&school_year={{ $sy_transaction }}&class_details={{ $_id }}"
                                                                    class="btn btn-primary btn-sm"
                                                                >
                                                                    <i class="far fa-user"></i>  Account
                                                                </a>   
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            @else --}}
                                <table class="table table-sm no-margin table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
                                            <th class="text-center">Balance</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($Enrollment)
                                            @foreach ($Enrollment as  $key => $data)
                                                <tr>
                                                    <td>{{ $key + 1 }}. </td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>{{ ucwords($data->full_name) }}</td>
                                                    <td class="text-center">
                                                        @if($sy_transaction)
                                                            {!! $data->finance_transaction_bal !!}
                                                            {{-- {{ $data->finance_transaction_bal }} --}}
                                                        @else
                                                            {!! $data->finance_student_bal !!}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                         @if($sy_transaction)
                                                            {!! $data->transaction_status !!}
                                                        @else
                                                            {!! $data->transaction_status_not_filtered !!}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="input-group-btn">
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

                            {{-- @endif --}}
                             

                            
               