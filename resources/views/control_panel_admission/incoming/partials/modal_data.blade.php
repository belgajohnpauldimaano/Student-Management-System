<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="box-body">
                <div class="modal-header">
                    <h4 style="margin-right: 5em;" class="modal-title">
                        Student Information
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column text-left order-2 order-lg-1">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h5><small>SY:</small> {{$IncomingStudent->incomingStudent->schoolYear->school_year ? $IncomingStudent->incomingStudent->schoolYear->school_year : ''}}</h5>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="">
                                        <label for="">Status: </label>
                                        <span class="badge badge-{{$IncomingStudent->incomingStudent->approval ? $IncomingStudent->incomingStudent->approval == 'Approved' ? 'success' : 'danger' : 'danger'}}">
                                            {{$IncomingStudent->incomingStudent->approval}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label for="">Student Type: </label>
                                        {{$IncomingStudent->incomingStudent->student_type == 1 ? 'Transferee' : 'Freshman'}}
                                    </div>

                                    <div class=" mt-1">
                                        <label for="">Incoming Student level: </label>
                                        Grade {{$IncomingStudent->incomingStudent->grade_level_id ? $IncomingStudent->incomingStudent->grade_level_id : ''}}
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="">
                                        <label for="">LRN: </label>
                                        {{$IncomingStudent->user->username ? $IncomingStudent->user->username : 'NA'}}
                                    </div>
                                    <div class="">
                                        <label for="">FB/Messenger Account: </label>
                                        {{$IncomingStudent->fb_acct ? $IncomingStudent->fb_acct : 'NA'}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center order-1 order-lg-2">
                            <img class="img-responsive " id="img--user_photo" 
                            src="{{ $IncomingStudent->photo ? \File::exists(public_path('/img/account/photo/'.$IncomingStudent->photo)) ? 
                            asset('/img/account/photo/'.$IncomingStudent->photo) : 
                            asset('/img/account/photo/blank-user.gif') : 
                            asset('/img/account/photo/blank-user.gif') }}" 
                            style="width:150px; height:150px; ">
                        </div>
                    </div>
                    <div class="row order-3 order-lg-3">
                            <div class="col-md-12 mt-4">
                                <h5>Personal Information</h5>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="p-0" for="">Student Name: </label>
                                    {{$IncomingStudent->full_name ? $IncomingStudent->full_name : 'NA'}}
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Email address: </label>
                                    {{$IncomingStudent->email ? $IncomingStudent->email : 'NA'}}
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="" style="line-height: 15px;">
                                    <label for="">Current Address: </label>
                                    {{$IncomingStudent->c_address ? $IncomingStudent->c_address : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6" style="line-height: 15px;">
                                <div class="">
                                    <label for="">Permanent Address: </label>
                                    {{$IncomingStudent->p_address ? $IncomingStudent->p_address : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Birthdate: </label>
                                    {{$IncomingStudent->birthdate ? $IncomingStudent->birthdate : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Place of Birthdate: </label>
                                    {{$IncomingStudent->place_of_birth ? $IncomingStudent->place_of_birth : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Age: </label>
                                    {{$IncomingStudent->age ? $IncomingStudent->age : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Gender: </label>
                                    {{$IncomingStudent->gender == '1' ? 'Male' : 'Female'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Religion: </label>
                                    {{$IncomingStudent->religion ? $IncomingStudent->religion : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Citizenship: </label>
                                    {{$IncomingStudent->citizenship ? $IncomingStudent->citizenship : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Phone number: </label>
                                    {{$IncomingStudent->contact_number ? $IncomingStudent->contact_number : 'NA'}}
                                </div>  
                            </div>

                            <div class="col-md-12 mt-4">
                                <h5>Educational Data</h5>
                                <hr>
                            </div>

                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Name of School: </label>
                                    {{$IncomingStudent->admission_school_name}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">School Type: </label>
                                    {{$IncomingStudent->admission_school_type}}
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">School Address: </label>
                                    {{$IncomingStudent->admission_school_address}}
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Last School Year Attended: </label>
                                    {{ $IncomingStudent->school_year ? : 'NA' }}
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Average (GWA): </label>
                                    {{$IncomingStudent->admission_gwa}}
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">ESC grantee: </label>
                                    {{$IncomingStudent->isEsc ? $IncomingStudent->isEsc == 1 ? 'Yes' : 'No' : 'NA'}}
                                </div>  
                            </div>


                            <div class="col-md-12 mt-4">
                                <h5>Family Information</h5>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Father name: </label>
                                    {{$IncomingStudent->father_name ? $IncomingStudent->father_name : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Father Occupation: </label>
                                    {{$IncomingStudent->father_occupation ? $IncomingStudent->father_occupation: 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Father FB/Messenger Acct: </label>
                                    {{$IncomingStudent->father_fb_acct ? $IncomingStudent->father_fb_acct : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Mother name: </label>
                                    {{$IncomingStudent->mother_name ? $IncomingStudent->mother_name : 'NA'}}
                                </div>   
                            </div>
                             <div class="col-md-6">
                                <div class="">
                                    <label for="">Mother Occupation: </label>
                                    {{$IncomingStudent->mother_occupation ? $IncomingStudent->mother_occupation : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Mother FB/Messenger Acct: </label>
                                    {{$IncomingStudent->mother_fb_acct ? $IncomingStudent->mother_fb_acct : 'NA'}}
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Guardian: </label>
                                    {{$IncomingStudent->guardian ? $IncomingStudent->guardian : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Guardian FB/Messenger Acct: </label>
                                    {{$IncomingStudent->guardian_fb_acct ? $IncomingStudent->guardian_fb_acct : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">No. of your siblings: </label>
                                    {{$IncomingStudent->no_siblings ? $IncomingStudent->no_siblings : 'NA'}}
                                </div>
                            </div>
                    </div>
                                        
                    
                </div>            
                <div class="modal-footer">
                    <button class="btn btn-{{ $IncomingStudent->incomingStudent->approval ? 
                        $IncomingStudent->incomingStudent->approval =='Approved' ? 
                        'danger btn-disapprove' : 
                        'success btn-approve' : 
                        'danger btn-disapprove'}} 
                        float-right"
                         data-id="{{$IncomingStudent->student_id}}">
                        {{ $IncomingStudent->incomingStudent->approval ? $IncomingStudent->incomingStudent->approval =='Approved' ? 'Dispprove' : 'Approve' : 'Dispprove'}}
                    </button>
                </div>     
            </div>    
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->