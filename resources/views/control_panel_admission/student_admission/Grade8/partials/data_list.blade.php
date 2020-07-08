
<div class="pull-right">
    {{ $Grade8 ? $Grade8->links() : '' }}
</div>                             
<table class="table no-margin table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="20%">Name</th>
                        <th width="20%">Student level</th>
                        <th width="10%">Status</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>                                            
                    @foreach ($Grade8 as $key => $data)     
                    <tr>                                         
                        <td>{{$key + 1}}.</td>
                        <td style="width 80%">{{$data->student_name}}</td>
                        <td>{{$data->student_level}}</td>
                        <td>
                            <span class="label {{ $data->approval ? $data->approval =='Approved' ? 'label-success' : 'label-danger' : 'label-danger'}}">
                            {{ $data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                            </span>
                        </td>
                        <td>
                            <div class="input-group-btn pull-left text-left">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                    <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    @if(!$g_s_8_c)
                                        <li><a>There is no Available section,<br/> Please set it in Class Lists<br/>Thank you</a></li>
                                    @endif
                                    @foreach ($g_s_8 as $item)
                                        <li>
                                        <a href="#" class="js-btn_enroll_student" data-student="{{$data->student_name}}" data-section="{{$item->section->section}}" data-class_id="{{$item->id}}" data-student_id="{{$data->student_id}}">
                                                Section {{$item->section->section}} - {{$item->section->grade_level}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach     
                </tbody>
</table>
       