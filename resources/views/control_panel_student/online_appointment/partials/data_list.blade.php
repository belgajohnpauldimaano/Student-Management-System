<div class="box-body">
    <div class="js-data-container" >
        <div class="table-responsive">
            
            <div class="row">
                <div class="class col-md-12">
                    <div class="callout callout-success">
                        <h4>Your Appointment</h4>
                        <hr>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Queue No.</th>
                                </tr>
                            </tbody>
                            <tbody>
                                @if($hasAppointment)
                                    @foreach ($Appointed as $item)
                                        <tr>
                                            <td>{{ $item ? date_format(date_create($item->appointment->date), 'F d, Y') : '' }}</td>
                                            <td>{{$item->appointment->time}}</td>
                                            <td>{{$item->queueing_number}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="3" style="text-align: center">No Appointment</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="class col-md-12">
                    <div class="form-group col-lg-4 input-email">
                        <label for="email">Check your Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" value="{{ $StudentInformation->email }}">
                        <div class="help-block text-left" id="js-email"></div>
                    </div>    
                    <table class="table no-margin table-striped table-bordered">
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
                            @if($OnlineAppointment)
                                @foreach ($OnlineAppointment as $item)
                                    <tr>
                                        <td>{{ $item ? date_format(date_create($item->date), 'F d, Y') : '' }}</td>
                                        <td>{{$item->time}}</td>
                                        <td>{{$item->available_students == 0 ? 'The maximum number are reached to this schedule' : $item->available_students}}</td>
                                        <td>{{$item->status}}</td>
                                        <td> 
                                            <?php                                         
                                                $Appointed = \App\StudentTimeAppointment::where('student_id', $StudentInformation->id)
                                                    // ->where('school_year_id', $SchoolYear->id)
                                                    // ->where('status', 1)
                                                    ->where('online_appointment_id', $item->id)->first(); 
        
                                                if($Appointed){
                                                    $OnlineAppointment = \App\OnlineAppointment::where('status', 1)
                                                        ->where('id', $Appointed->online_appointment_id)
                                                        ->first();
                                                }
                                            ?>
                                            @if($Appointed)
                                                @if($OnlineAppointment->date == $item->date)                                   
                                                    <button {{$Appointed ? 'disabled' : ''}} class="btn btn-primary btn-reserve" 
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
                                @endforeach         
                            @endif           
                        </tbody>
                    </table>
                </div>
            </div>
            
            
        </div>
    </div>
</div>