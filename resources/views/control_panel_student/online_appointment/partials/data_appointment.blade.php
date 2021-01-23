<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Appointment:</h3>
        <span data-toggle="tooltip" title="" class="{{$AppointedCount ? 'badge bg-light-blue' : ''}}" data-original-title="{{$AppointedCount ? $AppointedCount : 'No'}} Appointment">
            {{$AppointedCount ? $AppointedCount : ''}}
        </span>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <h3 class="card-title">Appointment Schedule</h3>
            @if($hasAppointment)
                @foreach ($Appointed as $item)
                <div style="padding: 5px 10px;background:;border: 1px solid #d2d6de;margin: 5px 5px 0 5px;color: rgb(2, 2, 2);" class="success">
                    <p>Date and Time: {{ $item ? date_format(date_create($item->appointment->date), 'F d, Y h:i A') : '' }} {{$item->appointment->time}}</p>
                    <p>Queue number: {{$item->queueing_number}}</p>
                    <div>
                        {{-- <button class="btn btn-primary">Done</button> &nbsp; <button class="btn btn-danger">Cancel</button> --}}
                    </div>
                </div>
                @endforeach
            @else
                <div style="padding: 10px">
                    <h4>No Appointment</h4>
                </div> 
            @endif
        </div>
    </div>
</div>
