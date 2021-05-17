<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="box-body">
                <div class="modal-header">
                    <h4 style="margin-right: 5em;" class="modal-title  text-uppercase">
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

                                    <div class=" mt-1" style="line-height: 15px;">
                                        <label for="">Incoming Student level: </label>
                                        Grade {{$IncomingStudent->incomingStudent->grade_level_id ? $IncomingStudent->incomingStudent->grade_level_id : ''}}
                                    </div>
                                    @if($IncomingStudent->incomingStudent->grade_level_id == 11)
                                    <div class=" mt-3" style="line-height: 15px;">
                                        <label for="">Strand: </label>
                                        {{$IncomingStudent->admission_strand}}
                                    </div>
                                    @endif
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
                            <div class="col-md-12 mt-4 text-uppercase">
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
                                    {{$IncomingStudent->birthdate ? date_format(date_create($IncomingStudent->birthdate), 'F d, Y') : 'NA'}}
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

                            <div class="col-md-12 mt-4 text-uppercase">
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


                            <div class="col-md-12 mt-4 text-uppercase">
                                <h5>Family Information</h5>
                                <hr>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Father name: </label>
                                    {{$IncomingStudent->father->name ? $IncomingStudent->father->name : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Father Occupation: </label>
                                    {{$IncomingStudent->father->occupation ? $IncomingStudent->father->occupation: 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Father FB/Messenger Acct: </label>
                                    {{$IncomingStudent->father->fb_acct ? $IncomingStudent->father->fb_acct : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Father Contact no.: </label>
                                    {{$IncomingStudent->father->number ? $IncomingStudent->father->number : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Mother name: </label>
                                    {{$IncomingStudent->mother->name ? $IncomingStudent->mother->name : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Mother Occupation: </label>
                                    {{$IncomingStudent->mother->occupation ? $IncomingStudent->mother->occupation: 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Mother FB/Messenger Acct: </label>
                                    {{$IncomingStudent->mother->fb_acct ? $IncomingStudent->mother->fb_acct : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Mother Contact no.: </label>
                                    {{$IncomingStudent->mother->number ? $IncomingStudent->mother->number : 'NA'}}
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Guardian: </label>
                                    {{$IncomingStudent->guardian->name ? $IncomingStudent->guardian->name : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Guardian FB/Messenger Acct: </label>
                                    {{$IncomingStudent->guardian->fb_acct ? $IncomingStudent->guardian->fb_acct : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">Guardian Contact no.: </label>
                                    {{$IncomingStudent->guardian->number ? $IncomingStudent->guardian->number : 'NA'}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label for="">No. of your siblings: </label>
                                    {{$IncomingStudent->no_siblings ? $IncomingStudent->no_siblings : 'NA'}}
                                </div>
                            </div>

                            <div class="col-md-12 mt-4 text-uppercase">
                                <h5>Student Scholar Type</h5>
                                <hr>
                            </div>

                            @foreach ($IncomingStudent->scholarTypes as $scholar)
                                <div class="form-check form-check-inline">
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-check-circle"></i> {{ $scholar->name }}
                                    </button>
                                </div>
                            @endforeach

                            <div class="col-md-12 mt-4 text-uppercase">
                                <h5>NAME OF BROTHER'S & SISTER(S) WHO ARE CURRENTLY ENROLLED</h5>
                                <hr>
                            </div>

                            <table class="table table-sm table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Grade Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($IncomingStudent->siblings as $sibling)
                                        <tr>
                                            <td>{{ $sibling->name }}</td>
                                            <td class="text-center">{{ $sibling->grade_level_id }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th class="text-center" colspan="2">No Data</th class="text-center">
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                    </div>
                                        
                    
                </div>            
                <div class="modal-footer">
                    <button class="btn btn-{{ $IncomingStudent->incomingStudent->approval ? 
                        $IncomingStudent->incomingStudent->approval =='Approved' ? 
                        'danger btn-disapprove' : 
                        'success btn-approve' : 
                        'danger btn-disapprove'}} 
                        float-right"
                         data-id="{{$IncomingStudent->incomingStudent->student_id}}">
                        {{ $IncomingStudent->incomingStudent->approval ? $IncomingStudent->incomingStudent->approval =='Approved' ? 'Dispprove' : 'Approve' : 'Dispprove'}}
                    </button>
                </div>     
            </div>    
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->