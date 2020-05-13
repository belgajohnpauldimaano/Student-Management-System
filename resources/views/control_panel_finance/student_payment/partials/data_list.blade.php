                                                
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#progress" data-toggle="tab">Not yet Approved</a>
                                </li>                                
                                <li>
                                    <a href="#queue" data-toggle="tab">Approved</a>
                                </li>
                                
                            </ul>
                            <div class="tab-content">                                
                                <div class="active tab-pane" id="progress">     
                                    <div class="pull-right">
                                        {{ $NotyetApproved ? $NotyetApproved->links() : '' }}
                                    </div>                             
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Student level</th>
                                                <th>Tuition Fee</th>
                                                <th>Misc Fee</th>
                                                <th>Total Fees</th>
                                                <th>Payment</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($NotyetApproved)
                                                @foreach ($NotyetApproved as $key => $data)
                                                <tr>
                                                    <td>{{$key + 1}}.</td>
                                                    <td>{{$data->student->last_name.', '.$data->student->first_name.' '.$data->student->middle_name}}</td>
                                                    <td>{{$data->payment_cat->stud_category->student_category.'-'.$data->payment_cat->grade_level_id}}</td>
                                                    <td>{{ number_format($data->payment_cat->tuition->tuition_amt, 2)}}</td>
                                                    <td>{{ number_format($data->payment_cat->misc_fee->misc_amt, 2)}}</td>
                                                    <td>{{ number_format($data->payment_cat->tuition->tuition_amt + $data->payment_cat->misc_fee->misc_amt, 2)}}</td>
                                                    <td>{{ number_format($data->downpayment, 2)}}</td>
                                                    <td>{{ number_format($data->balance, 2)}}</td>
                                                    <td>
                                                        <span class="label {{ $data->approval ? $data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                                                        {{ $data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-disapprove-modal" data-id="{{$data->id}}">View</button>
                                                        <button class="btn btn-sm btn-success btn-approve" data-id="{{$data->id}}">Approve</button>
                                                        
                                                        {{-- <button class="btn btn-sm btn-danger">Disapprove</button> --}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif                                            
                                        </tbody>
                                    </table>
                                </div>                                 
                        
                                <div class="tab-pane" id="queue">
                                    <div class="pull-right">
                                        {{ $Approved ? $Approved->links() : '' }}
                                    </div>
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Student level</th>
                                                <th>Tuition Fee</th>
                                                <th>Misc Fee</th>
                                                <th>Total Fees</th>
                                                <th>Payment</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($Approved)
                                                @foreach ($Approved as $key => $data)
                                                <tr>
                                                    <td>{{$key + 1}}.</td>
                                                    <td>{{$data->student->last_name.', '.$data->student->first_name.' '.$data->student->middle_name}}</td>
                                                    <td>{{$data->payment_cat->stud_category->student_category.'-'.$data->payment_cat->grade_level_id}}</td>
                                                    <td>{{ number_format($data->payment_cat->tuition->tuition_amt, 2)}}</td>
                                                    <td>{{ number_format($data->payment_cat->misc_fee->misc_amt, 2)}}</td>
                                                    <td>{{ number_format($data->payment_cat->tuition->tuition_amt + $data->payment_cat->misc_fee->misc_amt, 2)}}</td>
                                                    <td>{{ number_format($data->downpayment, 2)}}</td>
                                                    <td>{{ number_format($data->balance, 2)}}</td>
                                                    <td>
                                                        <span class="label {{ $data->approval ? $data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                                                        {{ $data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-disapprove-modal" data-id="{{$data->id}}">View</button>
                                                        <button class="btn btn-sm btn-success btn-disapprove" data-id="{{$data->id}}">Disapprove</button>
                                                        {{-- <button class="btn btn-sm btn-danger">Disapprove</button> --}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif                                            
                                        </tbody>
                                    </table> 
                                </div>  
                                
                                 
                            </div>                  
                        </div> 
                        <div class="pull-right">
                            {{-- {{ $StudentInformation ? $StudentInformation->links() : '' }} --}}
                        </div>
                        