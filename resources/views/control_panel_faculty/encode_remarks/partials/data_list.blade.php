@if($ClassSubjectDetail)                        
    {{-- <h4><b>Year and Section: <i style="color: red">Grade:{{ $ClassSubjectDetail->grade_level }} - {{ $ClassSubjectDetail->section }}</i></b></h4>      --}}

    <div class="table-responsive  table-responsive-sm" style="height: 600px;">
        <table class="table table-sm no-margin table-head-fixed table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 30px">#</th>
                    <th style="width: ">Student Name<br/></th>   
                    <th style="text-align:center">Eligible to transfer and admission to</th>
                    <th style="text-align:center">Lacking units in<br/></th>
                    <th style="text-align:center; width: 170px">Date<br/></th>            
                    <th style="text-align:center" >Action<br/></th>                          
                </tr>
            </thead>
            <tbody>                     
                <tr>
                    <td class="bg-danger" colspan="16">
                        <b>Male</b> 
                    </td>
                </tr>
                    @foreach ($EnrollmentMale as $key => $data) 
                        <form id="js_lacking_units_jr">
                            {{ csrf_field() }}
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $data->student_name }}</td>                            
                                <td> 
                                    @if($Semester_id == 1)                                    
                                        <input type="text" class="form-control form-control-sm" name="eligible_transfer" value="{{$data->eligible_transfer}}" placeholder="none">                                     
                                    @else
                                        <input type="text" class="form-control form-control-sm" name="eligible_transfer" 
                                        placeholder="Grade">                                             
                                    @endif                                 
                                </td>
                                <td>
                                    @if($ClassSubjectDetail->grade_level < 11) 
                                        <input type="text" class="form-control form-control-sm" name="jlacking_units" value="{{ $data->j_lacking_unit }}" placeholder="none"> 
                                    @elseif($ClassSubjectDetail->grade_level > 10)
                                        @if($Semester_id == 1)
                                            <input type="text" class="form-control form-control-sm" name="s1_lacking_units" value="{{ $data->s1_lacking_unit }}" placeholder="none"> 
                                        @else
                                            <input type="text" class="form-control form-control-sm" name="s2_lacking_units" value="{{ $data->s2_lacking_unit }}" placeholder="none"> 
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        
                                        @if($ClassSubjectDetail->grade_level < 11) 
                                            <input type="text" name="date" disabled class="tbdatepicker form-control form-control-sm pull-right" 
                                                    id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks != '' ? $DateRemarks->j_date : '' }}">
                                        @elseif($ClassSubjectDetail->grade_level > 10)
                                            @if($Semester_id == 1)
                                                <input type="text" name="date" disabled class="tbdatepicker form-control form-control-sm pull-right" 
                                                    id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->s_date1 ? $DateRemarks->s_date1 : '' }}"
                                                    
                                                >
                                            @else
                                                <input type="text" name="date" disabled class="tbdatepicker form-control form-control-sm pull-right" 
                                                id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->s_date2 ? $DateRemarks->s_date2 : '' }}">
                                            @endif
                                        @endif
                                    </div>                                
                                </td>
                                
                                <td class="text-center">                                 
                                    <input name="print_sy" id="print_sy" value="{{ encrypt($ClassSubjectDetail->id) }}" type="hidden" /> 
                                    <input name="stud_id" id="stud_id" value="{{ $data->student_information_id }}" type="hidden" />
                                    <input name="s_year" id="s_year" value="{{ $SchoolYear->id }}" type="hidden" />
                                    <input name="level" id="level" value="{{ $ClassSubjectDetail->grade_level }}" type="hidden" />
                                    <input name="sem" id="sem" value="{{ $Semester_id }}" type="hidden" />
                                    <input name="e_id" value="{{ $data->e_id}}" type="hidden" />
                                    <button type="submit" class="btn btn-sm btn-primary save">save</button>
                                    
                                    @if($ClassSubjectDetail->grade_level < 11)
                                            <button 
                                                @php
                                                    try {
                                                        echo $DateRemarks->j_date ? '' : 'disabled';
                                                    } catch (\Throwable $th) {
                                                        echo $DateRemarks = 'disabled';
                                                    }
                                                @endphp  
                                            class="btn btn-sm btn-danger printGradebtn" 
                                                rel="{{ encrypt($data->student_information_id) }}" 
                                                id="js-btn_print" 
                                                data-id="{{ encrypt($data->student_information_id) }}">
                                                Print
                                            </button>
                                    @endif

                                    @if($ClassSubjectDetail->grade_level > 10)
                                        @if($Semester_id == 1)
                                            <button 
                                                @php
                                                    try {
                                                        echo $DateRemarks->s_date1 ? '' : 'disabled';
                                                    } catch (\Throwable $th) {
                                                        echo $DateRemarks = 'disabled';
                                                    }
                                                @endphp  
                                            class="btn btn-sm btn-danger printGradebtn" 
                                                rel="{{ encrypt($data->student_information_id) }}" 
                                                id="js-btn_print" 
                                                data-id="{{ encrypt($data->student_information_id) }}">
                                                Print
                                            </button>
                                        @else
                                            <button 
                                                @php
                                                    try {
                                                        echo $DateRemarks->s_date2 ? '' : 'disabled';
                                                    } catch (\Throwable $th) {
                                                        echo $DateRemarks = 'disabled';
                                                    }
                                                @endphp  
                                            class="btn btn-sm btn-danger printGradebtn" 
                                                rel="{{ encrypt($data->student_information_id) }}" 
                                                id="js-btn_print" 
                                                data-id="{{ encrypt($data->student_information_id) }}">
                                                Print
                                            </button>
                                        @endif
                                    @endif
                                </td>                            
                            </tr>
                        </form>
                    @endforeach
                
                <tr>
                    <td class="bg-yellow" colspan="16">
                        <b>Female</b> 
                    </td>
                </tr>
                    @foreach ($EnrollmentFemale as $key => $data) 
                        <form id="js_lacking_units_jr">
                            {{ csrf_field() }}
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $data->student_name }}</td>                            
                                <td> 
                                    @if($Semester_id == 1)                                    
                                        <input type="text" class="form-control form-control-sm" name="eligible_transfer" value="{{$data->eligible_transfer}}" placeholder="none">                                     
                                    @else
                                        <input type="text" class="form-control form-control-sm" name="eligible_transfer" 
                                            placeholder="Grade">                                             
                                    @endif     
                                </td>
                                <td>
                                    @if($ClassSubjectDetail->grade_level < 11) 
                                        <input type="text" class="form-control form-control-sm" name="jlacking_units" value="{{ $data->j_lacking_unit }}" placeholder="none"> 
                                    @elseif($ClassSubjectDetail->grade_level > 10)
                                        @if($Semester_id == 1)
                                            <input type="text" class="form-control form-control-sm" name="s1_lacking_units" value="{{ $data->s1_lacking_unit }}" placeholder="none"> 
                                        @else
                                            <input type="text" class="form-control form-control-sm" name="s2_lacking_units" value="{{ $data->s2_lacking_unit }}" placeholder="none"> 
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        
                                        @if($ClassSubjectDetail->grade_level < 11) 
                                            <input type="text" name="date" disabled class="tbdatepicker form-control form-control-sm pull-right" 
                                                    id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks != '' ? $DateRemarks->j_date : '' }}">
                                        @elseif($ClassSubjectDetail->grade_level > 10)
                                            @if($Semester_id == 1)
                                                <input type="text" name="date" disabled class="tbdatepicker form-control form-control-sm pull-right" 
                                                    id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->s_date1 ? $DateRemarks->s_date1 : '' }}"
                                                    
                                                >
                                            @else
                                                <input type="text" name="date" disabled class="tbdatepicker form-control form-control-sm pull-right" 
                                                id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->s_date2 ? $DateRemarks->s_date2 : '' }}">
                                            @endif
                                        @endif
                                    </div>                                 
                                </td>
                                
                                <td class="text-center">                                    
                                    <input name="print_sy" id="print_sy" value="{{ encrypt($ClassSubjectDetail->id) }}" type="hidden" /> 
                                    <input name="stud_id" id="stud_id" value="{{ $data->student_information_id }}" type="hidden" />
                                    <input name="s_year" id="s_year" value="{{ $SchoolYear->id }}" type="hidden" />
                                    <input name="level" id="level" value="{{ $ClassSubjectDetail->grade_level }}" type="hidden" />
                                    <input name="sem" id="sem" value="{{ $Semester_id }}" type="hidden" />
                                    <input name="e_id" value="{{ $data->e_id}}" type="hidden" />

                                    <button type="submit" class="btn btn-sm btn-primary save">save</button>
                                    @if($ClassSubjectDetail->grade_level < 11)
                                            <button 
                                                @php
                                                    try {
                                                        echo $DateRemarks->j_date ? '' : 'disabled';
                                                    } catch (\Throwable $th) {
                                                        echo $DateRemarks = 'disabled';
                                                    }
                                                @endphp  
                                            class="btn btn-sm btn-danger printGradebtn" 
                                                rel="{{ encrypt($data->student_information_id) }}" 
                                                id="js-btn_print" 
                                                data-id="{{ encrypt($data->student_information_id) }}">
                                                Print
                                            </button>
                                    @endif

                                    @if($ClassSubjectDetail->grade_level > 10)
                                        @if($Semester_id == 1)
                                            <button 
                                                @php
                                                    try {
                                                        echo $DateRemarks->s_date1 ? '' : 'disabled';
                                                    } catch (\Throwable $th) {
                                                        echo $DateRemarks = 'disabled';
                                                    }
                                                @endphp  
                                            class="btn btn-sm btn-danger printGradebtn" 
                                                rel="{{ encrypt($data->student_information_id) }}" 
                                                id="js-btn_print" 
                                                data-id="{{ encrypt($data->student_information_id) }}">
                                                Print
                                            </button>
                                        @else
                                            <button 
                                                @php
                                                    try {
                                                        echo $DateRemarks->s_date2 ? '' : 'disabled';
                                                    } catch (\Throwable $th) {
                                                        echo $DateRemarks = 'disabled';
                                                    }
                                                @endphp  
                                            class="btn btn-sm btn-danger printGradebtn" 
                                                rel="{{ encrypt($data->student_information_id) }}" 
                                                id="js-btn_print" 
                                                data-id="{{ encrypt($data->student_information_id) }}">
                                                Print
                                            </button>
                                        @endif
                                    @endif
                                </td>                            
                            </tr>
                        </form>
                    @endforeach
            </tbody>            
        </table>
    </div>
@endif



