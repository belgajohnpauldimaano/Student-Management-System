                        
                        <div class="pull-right">
                            {{ $StudentInformation ? $StudentInformation->links() : '' }}
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Gender</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($hasUser ? $student_informations_count > 0 : $StudentInformation)
                                    @foreach ($StudentInformation as $data)
                                        <tr>
                                            <td>{{ $data->last_name . ' ' .$data->first_name . ' ' . $data->middle_name }}</td>
                                            <td>{{ $hasUser == 1 ? $data->username : $data->user->username }}</td>
                                            <td>{{ ($data->gender == 1 ? 'Male' : 'Female') }}</td>
                                            <td style="color: red">
                                                {{-- {{ $data->transactions}} --}}
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
                                                <span class="badge {{ $data->status == 1 ? 'bg-green' : 'bg-red' }}">
                                                    {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    @if(!$Transaction)                                                                 
                                                        <a href="{{ route('finance.student_payment_account') }}?c={{ encrypt($data->id) }}" 
                                                            data-id="{{ encrypt($data->id) }}" 
                                                            data-school_year="{{ $data->school_year_id }}" 
                                                            data-class_details="{{ $data->class_details_id }}"
                                                            class="btn btn-flat btn-primary btn-sm"
                                                        >
                                                            Account
                                                        </a>   
                                                    @endif                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="box-body"><div class="row"><table class="table"><tbody><tr><th style="text-align:center"><img src="https://cdn.iconscout.com/icon/free/png-256/data-not-found-1965034-1662569.png" alt="no data"/><br/>Sorry, there is no data found.</th></tr></tbody></table></div></div>
                                @endif
                            </tbody>
                        </table>