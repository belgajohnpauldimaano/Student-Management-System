                        <div class="pull-right">
                            <div class="pull-right">
                                {{ $OnlineAppointment ? $OnlineAppointment->links() : '' }}
                            </div>          
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th width="15%">Date</th>
                                    <th width="15%">Time</th>
                                    <th width="15%">No. of Appointee</th>
                                    <th width="15%">Current</th>
                                    <th width="10%">Status</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if ($OnlineAppointment)
                                    @foreach ($OnlineAppointment as $data)
                                        <tr>
                                            <td>{{ $data ? date_format(date_create($data->date), 'F d, Y') : '' }}</td>
                                            <td>{{ $data->time}}</td>
                                            <td>{{ $data->available_students}}</td>
                                            <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td>
                                            <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_update_sy" data-id="{{ $data->id }}">Edit</a></li>
                                                        <li><a href="#" class="js-btn_deactivate" data-id="{{ $data->id }}">Deactivate</a></li>
                                                        <li><a href="#" class="js-btn_toggle_current" data-id="{{ $data->id }}" data-toggle_title="{{ ( $data->current ? 'Remove from current active' : 'Add to current active' ) }}">{{ ( $data->current ? 'Remove from current Active' : 'Add to current Active' ) }}</a></li>
                                                    </ul>>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>