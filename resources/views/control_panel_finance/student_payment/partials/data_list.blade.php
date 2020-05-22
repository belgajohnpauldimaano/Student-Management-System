                                                
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                <a href="#js-disapproved" data-toggle="tab">Not yet Approved &nbsp;<span class="label label-danger pull-right">{{$NotyetApprovedCount}}</span></a>
                                </li>                                
                                <li>
                                    <a href="#js-approved" data-toggle="tab">Approved</a>
                                </li>
                                
                            </ul>
                            <div class="tab-content">                                
                                <div class="active tab-pane" id="js-disapproved">     
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
                                                <th>Disc Fee</th>
                                                <th>Total Fees</th>
                                                <th>Payment</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($NotyetApproved as $key => $data)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$data->student_name}}</td>
                                                    <td>{{$data->student_level}}</td>
                                                    <td>{{number_format($data->tuition_amt,2)}}</td>
                                                    <td>{{number_format($data->misc_amt,2)}}</td>
                                                    <td>
                                                        {{number_format($data->discount_amt, 2)}}
                                                    </td>
                                                    <td>
                                                        {{number_format(($data->tuition_amt + $data->misc_amt) - $data->discount_amt, 2)}}
                                                    </td>
                                                    <td>{{number_format($data->payment,2)}}</td>
                                                    <td>{{number_format($data->balance,2)}}</td>
                                                    <td>
                                                        <span class="label {{ $data->approval ? $data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                                                        {{ $data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-view-modal" data-id="{{$data->transaction_id}}"  data-monthly_id="{{$data->transact_monthly_id}}">View</button>
                                                        <button class="btn btn-sm btn-success btn-approve" data-id="{{$data->transact_monthly_id}}">Approve</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>                                 
                        
                                <div class="tab-pane" id="js-approved">
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
                                                <th>Disc Fee</th>
                                                <th>Total Fees</th>
                                                <th>Payment</th>
                                                <th>Balance</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($Approved as $key => $data)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$data->student_name}}</td>
                                                    <td>{{$data->student_level}}</td>
                                                    <td>{{number_format($data->tuition_amt,2)}}</td>
                                                    <td>{{number_format($data->misc_amt,2)}}</td>
                                                    <td>
                                                        {{number_format($data->discount_amt, 2)}}
                                                    </td>
                                                    <td>{{number_format($data->tuition_amt + $data->misc_amt, 2)}}</td>
                                                    <td>{{number_format($data->payment,2)}}</td>
                                                    <td>{{number_format($data->balance,2)}}</td>
                                                    <td>
                                                        <span class="label {{ $data->approval ? $data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                                                        {{ $data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-view-modal" data-id="{{$data->transaction_id}}"  data-monthly_id="{{$data->transact_monthly_id}}">View</button>
                                                        <button class="btn btn-sm btn-danger btn-disapprove" data-id="{{$data->transact_monthly_id}}">Disapprove</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> 
                                </div>  
                                
                                 
                            </div>                  
                        </div> 
                        
                        