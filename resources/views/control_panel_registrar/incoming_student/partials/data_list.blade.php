                                                
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#js-notyetapproved" data-toggle="tab">Not yet Approved &nbsp;
                                        <span class="{{$IncomingStudentCount == 0 ? '' : 'label label-danger'}} pull-right">
                                            {{$IncomingStudentCount == 0 ? '' : $IncomingStudentCount}}
                                        </span>
                                    </a>
                                </li>                                
                                <li>
                                    <a href="#js-approved" data-toggle="tab">Approved</a>
                                </li> 
                                <li>
                                    <a href="#js-disapproved" data-toggle="tab">Disapproved</a>
                                </li>                                
                            </ul>
                            <div class="tab-content">                                
                                <div class="active tab-pane" id="js-notyetapproved">     
                                    <div class="pull-right">
                                        {{ $IncomingStudent ? $IncomingStudent->links() : '' }}
                                    </div>                             
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Student type</th>
                                                <th>Student level</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($IncomingStudent as $item)
                                                <tr>
                                                    <td>{{$item->student_name}}</td>
                                                    <td>{{$item->student_type == '1' ? 'Transferee' : 'Freshman'}}</td>
                                                    <td>Grade {{$item->grade_level_id}}</td>
                                                    <td>
                                                        <span class="label label-{{$item->approval ? $item->approval == 'Approved' ? 'success' : 'danger' : 'danger'}}">
                                                            {{$item->approval}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-view-modal" data-id="{{$item->student_id}}">View</button>
                                                        <button class="btn btn-sm btn-success btn-approve" data-id="{{$item->student_id}}">
                                                            Approve
                                                        </button>
                                                        <button class="btn btn-sm btn-danger btn-disapprove" data-id="{{$item->student_id}}">
                                                            Disapprove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>                                 
                        
                                <div class="tab-pane" id="js-approved">
                                    <div class="pull-right">
                                        {{ $IncomingStudentApproved ? $IncomingStudentApproved->links() : '' }}
                                    </div>
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>                                                
                                                <th>Name</th>
                                                <th>Student type</th>
                                                <th>Student level</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($IncomingStudentApproved as $item)
                                                <tr>
                                                    <td>{{$item->student_name}}</td>
                                                    <td>{{$item->student_type == '1' ? 'Transferee' : 'Freshman'}}</td>
                                                    <td>Grade {{$item->grade_level_id}}</td>
                                                    <td>
                                                        <span class="label label-{{$item->approval ? $item->approval == 'Approved' ? 'success' : 'danger' : 'danger'}}">
                                                            {{$item->approval}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-view-modal" data-id="{{$item->student_id}}">View</button>
                                                        <button class="btn btn-sm btn-danger btn-disapprove" data-id="{{$item->student_id}}">
                                                            Disapprove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                    </table> 
                                </div>  

                                <div class="tab-pane" id="js-disapproved">
                                    <div class="pull-right">
                                        {{ $Disapproved ? $Disapproved->links() : '' }}
                                    </div>
                                    <table class="table no-margin table-bordered table-striped">
                                        <thead>
                                            <tr>                                                
                                                <th>Name</th>
                                                <th>Student type</th>
                                                <th>Student level</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Disapproved as $item)
                                                <tr>
                                                    <td>{{$item->student_name}}</td>
                                                    <td>{{$item->student_type == '1' ? 'Transferee' : 'Freshman'}}</td>
                                                    <td>Grade {{$item->grade_level_id}}</td>
                                                    <td>
                                                        <span class="label label-{{$item->approval ? $item->approval == 'Approved' ? 'success' : 'danger' : 'danger'}}">
                                                            {{$item->approval}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-view-modal" data-id="{{$item->student_id}}">View</button>
                                                        <button class="btn btn-sm btn-success btn-approve" data-id="{{$item->student_id}}">
                                                            Approve
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach   
                                        </tbody>
                                    </table> 
                                </div>  
                                
                                 
                            </div>                  
                        </div> 
                        
                        