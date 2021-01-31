
<div class="float-right">
    {{ $Grade8 ? $Grade8->links() : '' }}
</div>                             
<table class="table table-sm table-hover no-margin table-bordered">
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
                    @forelse ($Grade8 as $key => $data)     
                    <tr>                                         
                        <td>{{$key + 1}}.</td>
                        <td style="width 80%">{{$data->student_name}}</td>
                        <td>{{$data->student_level}}</td>
                        <td>
                            <span class="badge {{ $data->approval ? $data->approval =='Approved' ? 'badge-success' : 'badge-danger' : 'badge-danger'}}">
                            {{ $data->approval ? $data->approval =='Approved' ? 'Approved' : 'Not yet approved' : 'Not yet approved'}}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger">Action</button>
                                <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    @if(!$g_s_8_c)
                                        <a class="dropdown-item">There is no Available section,<br/> Please set it in Class Lists<br/>Thank you</a>
                                    @endif
                                    @foreach ($g_s_8 as $item)
                                        <a href="#" class="js-btn_enroll_student dropdown-item" data-student="{{$data->student_name}}" data-section="{{$item->section->section}}" data-class_id="{{$item->id}}" data-student_id="{{$data->student_id}}">
                                            Section {{$item->section->section}} - {{$item->section->grade_level}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <th colspan="5" class="text-center">
                            No Data Available
                        </th>
                    @endforelse    
                </tbody>
</table>
       