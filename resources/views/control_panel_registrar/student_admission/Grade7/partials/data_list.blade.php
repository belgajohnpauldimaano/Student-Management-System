                                                
    
            <div class="pull-right">
                {{ $Grade7 ? $Grade7->links() : '' }}
            </div>                             
            <table class="table no-margin table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Student level</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>                                            
                    @foreach ($Grade7 as $key => $data)  
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
                                    @foreach ($g_s_7 as $item)
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
         

        
                        