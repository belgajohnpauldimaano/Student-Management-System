


<div class="active tab-pane" id="js-unpaid">     
    {{-- <div class="pull-right">
        {{ $appointment ? $appointment->links() : '' }}
    </div> --}}

    <table class="table table-bordered" id="myTable">
        <thead>
            <th width="4%">No.</th>
            <th>Name</th>
            <th>Queue number</th>
            <th>Status</th>
            <th width="7%">Action</th>
        </thead>
        <tbody>
         @if($OnlineAppointment)   
            <button style="margin-bottom: 1em" class="btn btn-danger btn-deactivate pull-right" data-id="{{$OnlineAppointment->id}}">
                <i class="fas fa-exclamation-circle"></i> Deactivate this entire Schedule
            </button>   
            @if($hasAppointment)      
                @foreach ($appointment as $key => $item)
                    <tr>
                        <td>{{$key + 1}}.</td>
                        <td>{{$item->student_name}}</td>
                        <td>{{ $item->queueing_number }}</td>
                        <td><span class="label label-{{ $item->status == 1 ? 'success' : 'danger' }}">{{ $item->status == 1 ? 'Active' : 'Deactivated' }}</span></td>
                        <td >
                            <button class="btn btn-primary btn_done" data-id="{{$item->student_time_appointment_id}}"><i class="far fa-check-circle"></i> Done</button>
                        </td>
                    </tr>
                @endforeach             
            @else
                <tr>
                    <td colspan="5">There is no active appointment</td>
                </tr>
            @endif          
        @endif
        </tbody>
    </table>

</div>                                 

