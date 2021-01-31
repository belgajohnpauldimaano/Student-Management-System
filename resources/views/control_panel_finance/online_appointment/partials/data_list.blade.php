

<div class="table-responsive">    
    <div class="active tab-pane" id="js-unpaid">     
        {{-- <div class="pull-right">
            {{ $appointment ? $appointment->links() : '' }}
        </div> --}}
        
        <table class="table table-bordered table-sm table-hover" id="myTable">
            <thead>
                <th width="4%">No.</th>
                <th>Name</th>
                <th>Grade level</th>
                <th>Queue number</th>
                <th>Status</th>
                <th width="20%">Action</th>
            </thead>
            <tbody>
            @if($OnlineAppointment)   
                <button style="margin-bottom: 1em" class="btn btn-danger btn-deactivate pull-right" data-id="{{$OnlineAppointment->id}}">
                    <i class="fas fa-exclamation-circle"></i> Deactivate this entire Schedule
                </button>   
                <button id="js-btn_print" type="button" class="btn btn-success btn-flat">
                        <i class="fas fa-file-pdf"></i> Print report
                </button>
                
                @if($hasAppointment)      
                    @foreach ($appointment as $key => $item)
                        <tr>
                            <td>{{ $key + 1}}.</td>
                            <td>{{ $item->student_name }}</td>
                            <td>{{ $item->grade_lvl }}</td>
                            <td>{{ $item->queueing_number }}</td>
                            <td>
                                <span class="label label-{{ $item->status == 1 ? 'success' : 'danger' }}">
                                    {{ $item->status == 1 ? 'Queue' : 'Done' }}
                                </span>
                            </td>
                            <td >
                                <button {{ $item->status == 1 ? '' : 'disabled' }} class="btn btn-primary btn_done" data-id="{{$item->student_time_appointment_id}}">
                                    <i class="far fa-check-circle"></i> {{ $item->status == 1 ? 'Done' : 'Already Done' }}
                                </button>
                                {{-- <button class="btn btn-danger btn_disapprove" data-id="{{$item->student_time_appointment_id}}"><i class="far fa-times-circle"></i> Disapprove</button> --}}
                            </td>
                        </tr>
                    @endforeach             
                @else
                    <tr>
                        <td colspan="6">There is no active appointment</td>
                    </tr>
                @endif          
            @endif
            </tbody>
        </table>

    </div>  
</div>                               

