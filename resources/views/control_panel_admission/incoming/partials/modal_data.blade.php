<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                    <h4 style="margin-right: 5em;" class="modal-title">
                        Student Information
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            
                <div class="modal-body">          
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img class="profile-user-img img-responsive img-circle" id="img--user_photo" 
                            src="{{ $IncomingStudent->photo ? \File::exists(public_path('/img/account/photo/'.$IncomingStudent->photo)) ? 
                            asset('/img/account/photo/'.$IncomingStudent->photo) : 
                            asset('/img/account/photo/blank-user.gif') : 
                            asset('/img/account/photo/blank-user.gif') }}" 
                            style="width:150px; height:150px;  border-radius:50%;">
                        </div>
                        
                        <div class="col-md-6" style="margin-top: 15px">
                            <div class="form-group">
                                <label for="">Student Name</label>
                                <p>{{$IncomingStudent->student_name}}</p>
                            </div> 
        
                            <div class="form-group">
                                <label for="">Student level</label>
                                <p>Grade {{$IncomingStudent->grade_level_id}}</p>
                            </div>  

                            <div class="form-group">
                                <label for="">Email address</label>
                                <p>{{$IncomingStudent->email}}</p>
                            </div>  
                        </div>
                        <div class="col-md-6 mt-4" style="margin-top: 15px">
                            <div class="form-group">
                                <label for="">LRN</label><br/>
                                <p>{{$IncomingStudent->username}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Registration Type</label>
                                <p>{{$IncomingStudent->student_type == '1' ? 'Transferee' : 'Freshman'}}</p>
                            </div>  
                            <div class="form-group">
                                <label for="">Phone number</label>
                                <p>{{$IncomingStudent->contact_number}}</p>
                            </div>  
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Birthdate</label><br/>
                                <p>{{$IncomingStudent->birthdate}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Registration Type</label>
                                <p>{{$IncomingStudent->gender == '1' ? 'Male' : 'Female'}}</p>
                            </div> 
                            <div class="form-group">
                                <label for="">Father name</label><br/>
                                <p>{{$IncomingStudent->father_name}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Mother name</label>
                                <p>{{$IncomingStudent->mother_name}}</p>
                            </div>   
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Current Address</label><br/>
                                <p>{{$IncomingStudent->c_address}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Permanent Address</label>
                                <p>{{$IncomingStudent->p_address}}</p>
                            </div>    
                            <div class="form-group">
                                <label for="">Guardian</label><br/>
                                <p>{{$IncomingStudent->guardian}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label><br/>
                                <span class="label label-{{$IncomingStudent->approval ? $IncomingStudent->approval == 'Approved' ? 'success' : 'danger' : 'danger'}}">
                                    {{$IncomingStudent->approval}}
                                </span>
                            </div>                          
                        </div>
                    </div>
                                        
                    
                </div>            
                <div class="modal-footer">
                    <button class="btn btn-{{ $IncomingStudent->approval ? 
                        $IncomingStudent->approval =='Approved' ? 
                        'danger btn-disapprove' : 
                        'success btn-approve' : 
                        'danger btn-disapprove'}} 
                        float-right"
                         data-id="{{$IncomingStudent->student_id}}">
                        {{ $IncomingStudent->approval ? $IncomingStudent->approval =='Approved' ? 'Dispprove' : 'Approve' : 'Dispprove'}}
                    </button>
                </div>     
            </div>    
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->