                        <div class="pull-right">                            
                            {{ $PaymentCategory ? $PaymentCategory->links() : '' }}                                    
                        </div>
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th width="15%">Student Category</th>
                                    <th width="7%">Grade Lvl</th>
                                    <th width="7%">Tuition Fee</th>
                                    <th width="7%">Misc Fee</th>
                                    <th width="7%">Other Fee</th>
                                    <th width="7%">Current</th>
                                    <th width="7%">Status</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @if ($PaymentCategory)
                                    @foreach ($PaymentCategory as $data)
                                        <tr>
                                            <td>{{ $data->stud_category->student_category }}</td>
                                            <td>{{ $data->grade_level_id }}</td>
                                            <td>
                                                @if($data->tuition)
                                                    {{ number_format($data->tuition->tuition_amt, 2) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->misc_fee)
                                                    {{ number_format($data->misc_fee->misc_amt, 2) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->other_fee)
                                                    {{ number_format($data->other_fee->other_fee_amt, 2) }}
                                                @endif
                                            </td>
                                            {{-- <td>{{ $data->months }}</td> --}}
                                            <td>{{ $data->current == 1 ? 'Yes' : 'No' }}</td> 
                                            <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <div class="input-group-btn pull-left text-left">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                                        <span class="fa fa-caret-down"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="js-btn_update" data-id="{{ $data->id }}">Edit</a></li>
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