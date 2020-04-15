@if($ClassSubjectDetail)                        
    <h4><b>Year and Section: <i style="color: red">Grade:{{ $ClassSubjectDetail->grade_level }} - {{ $ClassSubjectDetail->section }}</i></b></h4>     

    @if($ClassSubjectDetail->grade_level < 11 )        
        <table class="table no-margin table-striped table-bordered">
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
                    <td colspan="16">
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
                                    @if(round($StudentEnrolledSubject1->fir_g) != 0 && round($StudentEnrolledSubject1->sec_g) != 0 && round($StudentEnrolledSubject1->thi_g) != 0 && round($StudentEnrolledSubject1->fou_g) != 0)
                                        @if(round($totalsum) > 74) 
                                            @if($ClassSubjectDetail->grade_level < 11)                                            
                                                <input type="text" class="form-control" name="grade" value="Grade {{ $ClassSubjectDetail->grade_level + 1 }}" placeholder="Grade">
                                            @endif
                                        @elseif(round($totalsum) < 75)                                        
                                            <input type="text" class="form-control" name="grade" value="Grade {{ $ClassSubjectDetail->grade_level - 1 }}" placeholder="Grade">
                                        @endif
                                    @else
                                        <input type="text" class="form-control" name="grade" value="" placeholder="Grade">
                                    @endif                                
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="jlacking_units" value="{{ $data->j_lacking_unit }}" placeholder="none">                               
                                </td>
                                <td>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" disabled name="date" class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->j_date }}">
                                    </div>                                
                                </td>
                                
                                <td>
                                    <center>    
                                        <input name="print_sy" id="print_sy" value="{{ encrypt($ClassSubjectDetail->id) }}" type="hidden" /> 
                                        <input name="stud_id" id="stud_id" value="{{ $data->student_information_id }}" type="hidden" />
                                        <input name="s_year" id="s_year" value="{{ $SchoolYear->id }}" type="hidden" />
                                        <input name="level" id="level" value="{{ $ClassSubjectDetail->grade_level }}" type="hidden" />

                                        <button type="submit" class="btn btn-sm btn-primary save">save</button>
                                        <button class="btn btn-sm btn-danger printGradebtn" rel="{{ encrypt($data->student_information_id) }}" id="js-btn_print" data-id="{{ encrypt($data->student_information_id) }}">Print</button>
                                    </center>
                                </td>                            
                            </tr>
                        </form>
                    @endforeach
                    
                    <tr>
                        <td colspan="16">
                            <b>Female</b> 
                        </td>
                    </tr>

                    @foreach ($EnrollmentFemale as $key => $data) 
                        <form id="js_lacking_units_jr_fem">
                            {{ csrf_field() }}
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $data->student_name }}</td>                            
                                <td>   
                                    @if(round($StudentEnrolledSubject1->fir_g) != 0 && round($StudentEnrolledSubject1->sec_g) != 0 && round($StudentEnrolledSubject1->thi_g) != 0 && round($StudentEnrolledSubject1->fou_g) != 0)
                                        @if(round($totalsum) > 74) 
                                            @if($ClassSubjectDetail->grade_level < 11)
                                                
                                                <input type="text" class="form-control" name="grade" value="Grade {{ $ClassSubjectDetail->grade_level + 1 }}" placeholder="Grade">
                                            
                                            @endif
                                        @elseif(round($totalsum) < 75)                                        
                                            <input type="text" class="form-control" name="grade" value="Grade {{ $ClassSubjectDetail->grade_level - 1 }}" placeholder="Grade">
                                        @endif
                                    @else
                                        <input type="text" class="form-control" name="grade" value="" placeholder="Grade">
                                    @endif
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="jlacking_units" value="{{ $data->j_lacking_unit }}" placeholder="none">
                                </td>
                                <td>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>                                        
                                        <input type="text" disabled name="date" class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->j_date }}">
                                    </div>
                                </td>                                
                                <td>
                                    <center>                                        
                                        <input name="print_sy" id="print_sy" value="{{ encrypt($ClassSubjectDetail->id) }}" type="hidden" /> 
                                        <input name="stud_id" id="stud_id" value="{{ $data->student_information_id }}" type="hidden" />
                                        <input name="s_year" id="s_year" value="{{ $SchoolYear->id }}" type="hidden" />
                                        <input name="level" id="level" value="{{ $ClassSubjectDetail->grade_level }}" type="hidden" />                                        

                                        <button type="submit" class="btn btn-sm btn-primary save">save</button>                                        
                                        <button class="btn btn-sm btn-danger printGradebtn" rel="{{ encrypt($data->student_information_id) }}" id="js-btn_print" data-id="{{ encrypt($data->student_information_id) }}">Print</button>
                                    </center>
                                </td>                                
                            </tr>
                        </form>
                    @endforeach
            </tbody>            
        </table>
        
    @elseif($ClassSubjectDetail->grade_level > 10)

        <table class="table no-margin table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width: 30px">#</th>
                    <th style="width: ">Student Name</th>   
                    <th style="text-align:center">Eligible to transfer and admission to</th>
                    <th style="text-align:center">Lacking units in</th>
                    <th style="text-align:center">Date</th>            
                    <th style="text-align:center" >Action</th>
                </tr>            
            </thead>
            <tbody>                                        
                <tr>
                    <td colspan="16">
                        <b>Male</b> 
                    </td>
                </tr>
                    @foreach ($EnrollmentMale as $key => $data) 
                        <form id="js_lacking_units_sr">
                        {{ csrf_field() }}
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $data->student_name }}</td> 
                                <td>
                                    <?php            
                                        $SchoolYear = \App\SchoolYear::where('current', 1)->where('status', 1)->first();
                                        
                                        $Enrollment = \App\Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
                                        // ->join('student_enrolled_subjects', 'student_enrolled_subjects.enrollments_id', '=', 'enrollments.id')
                                        ->join('class_subject_details', 'class_subject_details.class_details_id', '=', 'class_details.id')
                                        ->join('rooms', 'rooms.id', '=', 'class_details.room_id')
                                        ->join('faculty_informations', 'faculty_informations.id', '=', 'class_subject_details.faculty_id')
                                        ->join('section_details', 'section_details.id', '=', 'class_details.section_id')
                                        ->join('subject_details', 'subject_details.id', '=', 'class_subject_details.subject_id')                                
                                        ->select(\DB::raw("
                                            enrollments.id as enrollment_id,
                                            enrollments.class_details_id as cid,
                                            enrollments.attendance_first,
                                            enrollments.attendance_second,
                                            enrollments.j_lacking_unit,
                                            enrollments.s1_lacking_unit,
                                            class_details.grade_level,
                                            class_subject_details.id as class_subject_details_id,
                                            class_subject_details.class_days,
                                            class_subject_details.class_time_from,
                                            class_subject_details.class_time_to,
                                            class_subject_details.status as grade_status,
                                            class_subject_details.class_subject_order,
                                            class_subject_details.class_details_id,
                                            CONCAT(faculty_informations.last_name, ', ', faculty_informations.first_name, ' ', faculty_informations.middle_name) as faculty_name,
                                            subject_details.id AS subject_id,
                                            subject_details.subject_code,
                                            subject_details.subject,
                                            rooms.room_code,
                                            section_details.section
                                            
                                        "))
                                        ->where('enrollments.student_information_id', $data->e_id)
                                        ->where('class_subject_details.status', '!=', 0)
                                        ->where('enrollments.status', 1)
                                        ->where('class_details.status', 1)
                                        ->where('class_subject_details.sem', 1)
                                        ->where('class_details.school_year_id', $SchoolYear->id)
                                        ->orderBy('class_subject_details.class_subject_order', 'ASC')
                                        ->get();
                                        
                                       
                                        foreach ($Enrollment as $key => $enroll) {
                                            $StudentEnrolledSubject1 = \App\StudentEnrolledSubject::where('enrollments_id', $enroll->enrollment_id)
                                                ->where('subject_id', $enroll->subject_id)
                                                ->where('class_subject_details_id', $enroll->class_subject_details_id)
                                                ->where('sem', 1)
                                                ->first(); 
                                            
                                            if($StudentEnrolledSubject1)
                                            {
                                                echo $StudentEnrolledSubject1->fir_g ? $StudentEnrolledSubject1->fir_g > 0 ? round($StudentEnrolledSubject1->fir_g) : '' : '';
                                            }
                                        }
                                       
                                            
                                    ?>
                                    
                                    @if($ClassSubjectDetail->grade_level == 11)  
                                                                          
                                        @if(round($StudentEnrolledSubject1->fir_g) != 0 || round($StudentEnrolledSubject1->sec_g) != 0)
                                            @if(round($totalsum) > 74) 
                                                @if($ClassDetail->section_grade_level == 12)                                                    
                                                    <input type="text" class="form-control" name="grade" value="College" placeholder="Grade">                                                                                                
                                                @else
                                                    <input type="text" class="form-control" name="grade" value="Grade {{ $Semester ? $Semester == 1 ? '11 - Second Semester' : $ClassDetail->section_grade_level + 1 : '' }} " placeholder="Grade">
                                                @endif
                                            @elseif(round($totalsum) < 75)                                        
                                                <input type="text" class="form-control" name="grade" value="Grade {{ $ClassDetail->section_grade_level }}" placeholder="Grade">
                                            @endif
                                        @else
                                        <input type="text" class="form-control" name="grade" value="Grade {{ $Semester ? $Semester == 1 ? '11 - Second Semester' : $ClassDetail->section_grade_level + 1 : '' }} " placeholder="Grade">
                                        @endif        
                                    @elseif($ClassSubjectDetail->grade_level == 12)        
                                        @if(round($StudentEnrolledSubject1->thi_g) != 0 && round($StudentEnrolledSubject1->fou_g) != 0)
                                            @if(round($totalsum) > 74) 
                                                @if($ClassDetail->section_grade_level == 12)
                                                    <input type="text" class="form-control" name="grade" value="College" placeholder="Grade">
                                                @else
                                                    <input type="text" class="form-control" name="grade" value="Grade {{ $Semester ? $Semester == 1 ? 'first Semester' : 'second' : '' }}" placeholder="Grade">
                                                @endif
                                            @elseif(round($totalsum) < 75)                                        
                                                <input type="text" class="form-control" name="grade" value="Grade {{ $ClassDetail->section_grade_level - 1 }}" placeholder="Grade">
                                            @endif
                                        @else
                                            <input type="text" class="form-control" name="grade" value="" placeholder="Grade">
                                        @endif        
                                    @endif                                    
                                    <div class="help-block text-red text-center" id="js-grade">
                                    </div>   
                                </td>
                                <td>
                                    @if($ClassSubjectDetail->grade_level == 11)
                                        @if($Semester == 1)
                                            <input type="text" class="form-control" name="s1_lacking_units" placeholder="Lacking units" value="{{ $data->s1_lacking_unit }}">  
                                        @else
                                            <input type="text" class="form-control" name="s2_lacking_units" placeholder="Lacking units" value="{{ $data->s2_lacking_unit }}"> 
                                        @endif
                                    @elseif($ClassSubjectDetail->grade_level == 12)        
                                        @if($Semester == 1)
                                            <input type="text" class="form-control" name="s1_lacking_units" placeholder="Lacking units" value="{{ $data->s1_lacking_unit }}">  
                                        @else
                                            <input type="text" class="form-control" name="s2_lacking_units" placeholder="Lacking units" value="{{ $data->s2_lacking_unit }}"> 
                                        @endif                                    
                                    @endif
                                </td>
                                <td>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        @if($ClassSubjectDetail->grade_level == 11)
                                            <input type="text" name="date" disabled class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->s_date1 }}">
                                        @elseif($ClassSubjectDetail->grade_level == 12)
                                            <input type="text" name="date" disabled class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->s_date2 }}">
                                        @endif
                                    </div>
                                    <div class="help-block text-red text-center" id="js-date">
                                    </div>                                    
                                </td>                                
                                <td>
                                    <center>  
                                        <input name="print_sy" id="print_sy" value="{{ encrypt($ClassSubjectDetail->id) }}" type="hidden" />  
                                        <input name="stud_id" id="stud_id" value="{{ $data->student_information_id }}" type="hidden" />
                                        <input name="s_year" id="s_year" value="{{ $SchoolYear->id }}" type="hidden" /> 
                                        <input name="sem" id="sem" value="{{ $ClassSubjectDetail->sem }}" type="hidden" /> 
                                        <input name="level" id="level" value="{{ $ClassSubjectDetail->grade_level }}" type="hidden" />
                                        
                                        <button type="submit" class="btn btn-sm btn-primary save">save</button>                                    
                                        <button class="btn btn-sm btn-danger printGradebtn" rel="{{ encrypt($data->student_information_id) }}" id="js-btn_print" data-id="{{ encrypt($data->student_information_id) }}">Print</button>
                                    </center>
                                </td>                            
                            </tr>
                        </form>
                    @endforeach
                <tr>
                    <td colspan="16">
                        <b>Female</b> 
                    </td>
                </tr>
                @foreach ($EnrollmentFemale as $key => $data) 
                <form id="js_lacking_units_sr_fem">
                {{ csrf_field() }}
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $data->student_name }}</td>
                                <td>
                                        @if($ClassSubjectDetail->grade_level == 11)                                    
                                            @if(round($StudentEnrolledSubject1->fir_g) != 0 && round($StudentEnrolledSubject1->sec_g) != 0)
                                                @if(round($totalsum) > 74) 
                                                    @if($ClassDetail->section_grade_level == 12)                                                        
                                                        <input type="text" class="form-control" name="grade" value="College" placeholder="Grade">
                                                    @else
                                                    <input type="text" class="form-control" name="grade" value="Grade {{ $Semester ? $Semester == 1 ? '11 - Second Semester' : $ClassDetail->section_grade_level + 1 : '' }} " placeholder="Grade">
                                                    @endif
                                                @elseif(round($totalsum) < 75)                                        
                                                    <input type="text" class="form-control" name="grade" value="Grade {{ $ClassDetail->section_grade_level }}" placeholder="Grade">
                                                @endif
                                            @else
                                            <input type="text" class="form-control" name="grade" value="Grade {{ $Semester ? $Semester == 1 ? '11 - Second Semester' : $ClassDetail->section_grade_level + 1 : '' }} " placeholder="Grade">
                                            @endif        
                                        @elseif($ClassSubjectDetail->grade_level == 12)        
                                            @if(round($StudentEnrolledSubject1->thi_g) != 0 && round($StudentEnrolledSubject1->fou_g) != 0)
                                                @if(round($totalsum) > 74) 
                                                    @if($ClassDetail->section_grade_level == 12)
                                                        
                                                        <input type="text" class="form-control" name="grade" value="College" placeholder="Grade">
                                                    @else
                                                        <input type="text" class="form-control" name="grade" value="Grade {{ $ClassDetail->section_grade_level }}" placeholder="Grade">
                                                        
                                                    @endif
                                                @elseif(round($totalsum) < 75)                                        
                                                    <input type="text" class="form-control" name="grade" value="Grade {{ $ClassDetail->section_grade_level - 1 }}" placeholder="Grade">
                                                @endif
                                            @else
                                                <input type="text" class="form-control" name="grade" value="" placeholder="Grade">
                                            @endif        
                                        @endif                                    
                                        <div class="help-block text-red text-center" id="js-grade">
                                        </div>   
                                </td>
                                <td>
                                    @if($ClassSubjectDetail->grade_level == 11)
                                        @if($Semester == 1)
                                            <input type="text" class="form-control" name="s1_lacking_units" placeholder="Lacking units" value="{{ $data->s1_lacking_unit }}">  
                                        @else
                                            <input type="text" class="form-control" name="s2_lacking_units" placeholder="Lacking units" value="{{ $data->s2_lacking_unit }}"> 
                                        @endif                                        
                                    @elseif($ClassSubjectDetail->grade_level == 12)        
                                        @if($Semester == 1)
                                            <input type="text" class="form-control" name="s1_lacking_units" placeholder="Lacking units" value="{{ $data->s1_lacking_unit }}">  
                                        @else
                                            <input type="text" class="form-control" name="s2_lacking_units" placeholder="Lacking units" value="{{ $data->s2_lacking_unit }}"> 
                                        @endif                                  
                                    @endif
                                </td>
                                <td>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        @if($ClassSubjectDetail->grade_level == 11)
                                            <input type="text" name="date" disabled class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->s_date1 }}">
                                        @elseif($ClassSubjectDetail->grade_level == 12)
                                            <input type="text" name="date" disabled class="tbdatepicker form-control pull-right" id="tbdatepicker" placeholder="11/11/2000" value="{{ $DateRemarks->s_date2 }}">
                                        @endif
                                    </div>
                                    <div class="help-block text-red text-center" id="js-date">
                                    </div>
                                </td>
                                
                                <td>
                                    <center>        
                                        <input name="print_sy" id="print_sy" value="{{ encrypt($ClassSubjectDetail->id) }}" type="hidden" />  
                                        <input name="stud_id" id="stud_id" value="{{ $data->student_information_id }}" type="hidden" />
                                        <input name="s_year" id="s_year" value="{{ $SchoolYear->id }}" type="hidden" /> 
                                        <input name="sem" id="sem" value="{{ $ClassSubjectDetail->sem }}" type="hidden" /> 
                                        <input name="level" id="level" value="{{ $ClassSubjectDetail->grade_level }}" type="hidden" />
                                        
                                        <button type="submit" class="btn btn-sm btn-primary save">save</button>                                   
                                        <button class="btn btn-sm btn-danger printGradebtn" rel="{{ encrypt($data->student_information_id) }}" id="js-btn_print" data-id="{{ encrypt($data->student_information_id) }}">Print</button>
                                    </center>
                                </td>                            
                            </tr>
                </form>
                @endforeach
            </tbody>
        </table>
    @endif
@else
    <h4><b> <i style="color: red">There is no Student enrolled in the current school year, Pls. Contact the administrator!</i></b></h4>
@endif



