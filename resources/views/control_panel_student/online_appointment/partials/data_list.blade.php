
    
        
<div class="row">
    @if($GradeSheet==0)
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                <h3 class="box-title">Appointment</h3>
                </div>
                <div class="box-body">
                <div class="col-md-12">
                    <h4>This account maybe not updated. Please contact the administrator. Thank you</h4>
                </div>
                <br><br><br><br>
                </div>
                <!-- /.box-body -->
            </div>
        </div>        
    @else    
        <div class="col-md-8">
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h4><i class="far fa-calendar-check"></i> Available Schedule of Appointment for paying tuition</h4>
                <div class="box-tools pull-right">            
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>                   
                </div>
                </div>               
                <div class="box-body">                  
                    <div class="table-responsive">
                        <div class="form-group col-lg-6 input-email">                        
                            <label for="exampleInputEmail1">You are incoming Grade-level 
                                <i style="color:red">
                                @if($IncomingStudentCount)
                                    {{$IncomingStudentCount->grade_level_id}}
                                    <input type="hidden" class="js-grade" value="{{$IncomingStudentCount->grade_level_id}}">
                                @else
                                    {{$ClassDetail->grade_level}}
                                    <input type="hidden" class="js-grade" value="{{$ClassDetail->grade_level}}">
                                @endif
                                </i>
                            </label><br/>
                            <label for="email">Check your Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" value="{{ $StudentInformation->email }}">
                            <div class="help-block text-left" id="js-email"></div>
                        </div>    
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Available Total Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @forelse ($OnlineAppointment as $item)
                                        <tr>
                                            <td>{{ $item ? date_format(date_create($item->date), 'F d, Y') : '' }}</td>
                                            <td>{{ $item ? date_format(date_create($item->date), 'h:i A') : '' }}</td>
                                            <td>{{$item->available_students == 0 ? 'The maximum number are reached to this schedule' : $item->available_students}}</td>
                                            <td>{{$item->status}}</td>
                                            <td> 
                                                <?php                                         
                                                    $Appointment = \App\StudentTimeAppointment::where('student_id', $StudentInformation->id)
                                                        // ->where('school_year_id', $SchoolYear->id)
                                                        // ->where('status', 1)
                                                        ->where('online_appointment_id', $item->id)->first(); 
                        
                                                    if($Appointment){
                                                        $OnlineAppointment = \App\OnlineAppointment::where('status', 1)
                                                            ->where('id', $Appointment->online_appointment_id)
                                                            ->first();
                                                    }
                                                ?>
                                                @if($Appointment)
                                                    @if($OnlineAppointment->date == $item->date)                                   
                                                        <button {{$Appointment ? 'disabled' : ''}} class="btn btn-primary btn-reserve" 
                                                                data-id="{{$item->id}}"
                                                                data-date="{{ $item ? date_format(date_create($item->date), 'F d, Y') : '' }}"
                                                                data-time="{{$item->time}}"
                                                        >
                                                                <i class="fas fa-mouse-pointer"></i> Reserve
                                                        </button>                                            
                                                    @else
                                                        <button class="btn btn-primary btn-reserve" 
                                                            data-id="{{$item->id}}"
                                                            data-date="{{ $item ? date_format(date_create($item->date), 'F d, Y') : '' }}"
                                                            data-time="{{$item->time}}"
                                                        >
                                                            <i class="fas fa-mouse-pointer"></i> Reserve
                                                        </button>
                                                    @endif
                                                @else
                                                    <button {{$item->available_students == 0 ? 'disabled' : ''}} class="btn btn-primary btn-reserve" 
                                                            data-id="{{$item->id}}"
                                                            data-date="{{ $item ? date_format(date_create($item->date), 'F d, Y') : '' }}"
                                                            data-time="{{$item->time}}"
                                                        >
                                                            <i class="fas fa-mouse-pointer"></i> Reserve
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="5">
                                                No Appointment Available
                                            </td>
                                        </tr>
                                    @endforelse
                                    
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @include('control_panel_student.online_appointment.partials.data_appointment')
        </div>

    @endif
</div>            

            
       
    

