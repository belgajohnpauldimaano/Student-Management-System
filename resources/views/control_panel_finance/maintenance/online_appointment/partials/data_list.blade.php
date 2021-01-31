<div class="table-responsive">
    <div class="float-right">
        <div class="float-right">
            {{ $OnlineAppointment ? $OnlineAppointment->links() : '' }}
        </div>          
    </div>
    <table class="table table-sm table-hover no-margin">
        <thead>
            <tr>
                <th width="15%">Date and Time</th>
                {{-- <th width="15%">Time</th> --}}
                <th width="15%">Grade level</th>
                <th width="15%">No. of Appointee</th>
                {{-- <th width="15%">Current</th> --}}
                <th width="10%">Status</th>
                <th width="20%">Actions</th>
            </tr>
        </thead>
        <tbody> 
            @if ($OnlineAppointment)
                @forelse ($OnlineAppointment as $data)
                    <tr>
                        <td>{{ $data ? date_format(date_create($data->date), 'F d, Y h:i A') : '' }}</td>
                        {{-- <td>{{ $data->time}}</td> --}}
                        <td>Grade level - {{ $data->grade_lvl_id == 0 ? 'All' : $data->grade_lvl_id}}</td>
                        <td>{{ $data->available_students}}</td>
                        {{-- <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td> --}}
                        <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <div class="input-group-btn pull-left text-left">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                    <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="js-btn_update_sy" data-id="{{ $data->id }}">Edit</a></li>
                                    <li><a href="#" class="js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a></li>
                                    {{-- <li><a href="#" class="js-btn_toggle_current" data-id="{{ $data->id }}" data-toggle_title="{{ ( $data->current ? 'Remove from current active' : 'Add to current active' ) }}">{{ ( $data->current ? 'Remove from current Active' : 'Add to current Active' ) }}</a></li> --}}
                                </ul>>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th class="text-center" colspan="5">No Data Available</th>
                    </tr>
                @endforelse
            @endif
        </tbody>
    </table>
</div>