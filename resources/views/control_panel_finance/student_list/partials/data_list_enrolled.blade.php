                       

                          
                           
                           @if($ClassDetail->grade_level == 11 || $ClassDetail->grade_level == 12)            
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
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
                                                        @if($data->finance_transaction)
                                                            @if($data->finance_transaction->school_year_id == $School_year_id)
                                                                <span class="label {{ $data->finance_transaction->status == 0 ? 'label-success' : 'label-danger' }}">
                                                                    {{ $data->finance_transaction->status == 0 ? 'Paid' : 'Not-Paid' }}
                                                                </span>
                                                            @else
                                                                <span class="label label-danger">
                                                                    Not-Paid
                                                                </span> 
                                                            @endif
                                                        @else
                                                            <span class="label label-danger">
                                                            Not-Paid
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="input-group-btn pull-left text-left">
                                                            {{-- @if(!$Transaction)                                                                  --}}
                                                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->student_information_id) }}&school_year={{ $data->school_year_id }}&class_details={{ $data->id }}"
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
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Number</th>
                                            <th>Student Name</th>
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
                                                        <?php 
                                                            $Transaction = \App\Transaction::where('student_id', $data->student_information_id)->first();                                                            

                                                            try {
                                                               $status = $Transaction->status;
                                                            } catch (\Throwable $th) {
                                                                $status = 1;
                                                            }
                                                        ?>
                                                        <span class="label {{ $status == 0 ? 'label-success' : 'label-danger' }}">
                                                            {{ $status == 0 ? 'Paid' : 'Not-Paid' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="input-group-btn pull-left text-left">
                                                            {{-- @if(!$Transaction)                                                                  --}}
                                                                <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->student_information_id) }}&school_year={{ $data->school_year_id }}&class_details={{ $data->id }}"
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
                             

                            
               