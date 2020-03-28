<div class="table-responsive">
    <table class="table no-margin table-striped table-bordered" style="font-size: 13px">
        <thead>
            <tr>
                @if($quarter == 'First - Second')
                    <tr>
                        <th rowspan="2" style="width: 20px">#</th>
                        <th rowspan="2">
                            <center>
                                Student<br/> Name
                            </center>
                        </th>     
                        <td colspan="{{$Totalsubject_1st_sem}}">
                            <center>
                                <b>First Sem</b>
                            </center>
                        </td>
                        <td colspan="{{$Totalsubject_2nd_sem}}">
                            <center>
                                <b>Second Sem</b>
                            </center>
                        </td>
                        {{-- <td colspan="2"></td> --}}
                        <th rowspan="2" style="width: 20px; text-align: center">
                            <center>GENERAL<br/> AVERAGE</center>
                        </th>
                        <th rowspan="2" style="width: 20px; text-align: center">REMARKS</th>
                    </tr>
                    
                    @foreach ($Subject_1stsem as $key => $sub)                                     
                        <th style="width: 20px; text-align: center">{{ $sub->subject_code }} </th>                                                                  
                    @endforeach
                    
                    @foreach ($Subject_2ndsem as $key => $sub)                                     
                        <th style="width: 20px; text-align: center">{{ $sub->subject_code }} </th>                                                                  
                    @endforeach
                @else                    
                    <th style="width: 80px; text-align: center">First Semester</th>
                    <th style="width: 80px; text-align: center">Second Semester</th>
                @endif                
                </tr>
        </thead>
        <tbody>
                @if($sem == 'First')
                    
                        <tr>
                            <td colspan="{{$Totalsubject_1st_sem + $Totalsubject_2nd_sem + 4}}">
                                <b>Male</b>
                            </td>
                        </tr>
                        
                        @foreach($GradeSheetMale as $key => $sub)
                            <?php
                                
                                $SchoolYear = \App\SchoolYear::where('current', 1)->where('status', 1)->first();
                                
                                $Enrollment1 = \App\Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
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
                                    ->where('enrollments.student_information_id', $sub->student_informations_id)
                                    ->where('class_subject_details.status', '!=', 0)
                                    ->where('enrollments.status', 1)
                                    ->where('class_details.status', 1)
                                    ->where('class_subject_details.sem', 1)
                                    ->where('class_details.school_year_id', $SchoolYear->id)
                                    ->orderBy('class_subject_details.class_subject_order', 'ASC')
                                    ->get();

                                    $Enrollment2 = \App\Enrollment::join('class_details', 'class_details.id', '=', 'enrollments.class_details_id')
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
                                            ->where('enrollments.student_information_id', $sub->student_informations_id)
                                            ->where('class_subject_details.status', '!=', 0)
                                            ->where('enrollments.status', 1)
                                            ->where('class_details.status', 1)
                                            ->where('class_subject_details.sem', 2)
                                            ->where('class_details.school_year_id', $SchoolYear->id)
                                            ->orderBy('class_subject_details.class_subject_order', 'ASC')
                                            ->get();

                                            $total_sem1 = 0;
                                            $total_sem2 = 0;
 
                            ?>
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $sub->student_name }}</td>
                                @foreach($Enrollment1 as $key => $data)
                                    <td>
                                        <center>
                                        <?php
                                            $first_sem = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                                                ->where('subject_id', $data->subject_id)
                                                ->where('sem', 1)
                                                ->first();

                                                if($first_sem)
                                                {
                                                    
                                                    echo round($final_ave = (round($first_sem->fir_g) + round($first_sem->sec_g)) / 2);
                                                    $total_sem1 += round($final_ave) ;   
                                                }      
                                        ?>  
                                        </center>
                                    </td>
                                @endforeach
                               
                                @foreach($Enrollment2 as $key => $data)
                                    <td>
                                        <center>
                                        <?php 
                                                $second_sem = \App\StudentEnrolledSubject::where('enrollments_id', $data->enrollment_id)
                                                    ->where('subject_id', $data->subject_id)
                                                    ->where('sem', 2)
                                                    ->first();

                                                    if($second_sem)
                                                    {
                                                        
                                                            echo round($final_ave = (round($second_sem->thi_g) + round($second_sem->fou_g)) / 2);
                                                            $total_sem2 += round($final_ave) ;   
                                                    }      
                                            ?>
                                        </center>
                                    </td>
                                @endforeach
                                <td>
                                    <center>
                                    <?php 
                                        $subject = $Totalsubject_1st_sem + $Totalsubject_2nd_sem;
                                        $final_average = $total_sem1 + $total_sem2;

                                        echo   round($final_average / $subject);                                        
                                    ?>
                                    </center>
                                </td>
                                

                                
                            </tr>
                        @endforeach
                    
                        <tr>
                            <td colspan="7">
                                <b>Female</b>
                            </td>
                        </tr>
                        @foreach($GradeSheetFeMale as $key => $sub)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $sub->student_name }}</td>
                                
                                
                                @foreach ($Subject_1stsem as $key => $sub)                                     
                                    <td style="width: 30px; text-align: center">{{ $sub->id }} </td>                                                                  
                                @endforeach
                                    
                    
                                
                                
                                
                            </tr>
                        @endforeach
                   
                    
                @elseif($sem == 'Second')
                            
                        @if($NumberOfSubject->class_subject_order == 7)
                            <tr>
                                <td colspan="7">
                                    <b>Male</b>
                                </td>
                            </tr>
                            @foreach($GradeSheetMale as $key => $sub)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $sub->student_name }}</td>
                                <td style="text-align: center">
                                    <?php
                                    $formattedNum = round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7);
                                    echo $formattedNum;
                                    ?>                                                
                                </td>
                                <td style="text-align: center">
                                    <?php
                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $result = round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7);
                                        echo $result;
                                    ?>    
                                </td>
                                <?php                                                    
                                        $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        $subject_1 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                
                                        $fg_1 = round(($subject_1 + $subject1) / 2);
                                                                                    
                                        $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        $subject_2 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                
                                        $fg_2 = round(($subject_2 + $subject2) / 2);
                                                                                    
                                        $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                        $subject_3 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);

                                        $fg_3 = round(($subject_3 + $subject3) / 2);
                                                                                        
                                        $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        $subject_4 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        
                                        $fg_4 = round(($subject_4 + $subject4) / 2);
                                                                                        
                                        $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                        $subject_5 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    
                                        $fg_5 = round(($subject_5 + $subject5) / 2);
                                                                                        
                                        $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        $subject_6 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        
                                        $fg_6 = round(($subject_6 + $subject6) / 2);
                                                                                        
                                        $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        $subject_7 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        
                                        $fg_7 = round(($subject_7 + $subject7) / 2);
                                                                                        
                                        
                                ?>
                    
                                <td>
                                        <center>                                                
                                                <?php
                                                    $average_2sem = round($average = ($fg_1 + $fg_2 + $fg_3 + $fg_4 + $fg_5 + $fg_6 + $fg_7 )/7, 2);
                                                    echo round($average_2sem);
                                                ?>
                                        </center>
                                </td>
                                @if(round($average_2sem) >= 75 && round($average_2sem) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($average_2sem) >= 90 && round($average_2sem) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($average_2sem)>= 95 && round($average_2sem) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($average_2sem) >= 98 && round($average_2sem) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($average_2sem) < 75)
                                    <td>
                                        <center>Failed</center>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        
                                <tr>
                                    <td colspan="7">
                                        <b>Female</b>
                                    </td>
                                </tr>
                                @foreach($GradeSheetFeMale as $key => $sub)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $sub->student_name }}</td>
                                    <td style="text-align: center">
                                        <?php
                                        $formattedNum = round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7);
                                        echo $formattedNum;
                                        ?>                                                
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                            $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7);
                                            echo $result;
                                        ?>    
                                    </td>
                                        <?php                                                    
                                        $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        $subject_1 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                
                                        $fg_1 = round(($subject_1 + $subject1) / 2);
                                                                                    
                                        $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        $subject_2 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                
                                        $fg_2 = round(($subject_2 + $subject2) / 2);
                                                                                    
                                        $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                        $subject_3 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);

                                        $fg_3 = round(($subject_3 + $subject3) / 2);
                                                                                        
                                        $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        $subject_4 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        
                                        $fg_4 = round(($subject_4 + $subject4) / 2);
                                                                                        
                                        $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                        $subject_5 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    
                                        $fg_5 = round(($subject_5 + $subject5) / 2);
                                                                                        
                                        $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        $subject_6 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        
                                        $fg_6 = round(($subject_6 + $subject6) / 2);
                                                                                        
                                        $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        $subject_7 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        
                                        $fg_7 = round(($subject_7 + $subject7) / 2);
                                                                                        
                                        
                                ?>
                    
                                <td>
                                        <center>                                                
                                                <?php
                                                    $average_2sem = round($average = ($fg_1 + $fg_2 + $fg_3 + $fg_4 + $fg_5 + $fg_6 + $fg_7 )/7, 2);
                                                    echo round($average_2sem);
                                                ?>
                                        </center>
                                </td>
                                @if(round($average_2sem) >= 75 && round($average_2sem) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($average_2sem) >= 90 && round($average_2sem) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($average_2sem)>= 95 && round($average_2sem) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($average_2sem) >= 98 && round($average_2sem) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($average_2sem) < 75)
                                    <td>
                                        <center>Failed</center>
                                    </td>
                                @endif
                                </tr>
                                @endforeach
                        @elseif($NumberOfSubject->class_subject_order == 8)
                            <tr>
                                <td colspan="7">
                                    <b>Male</b>
                                </td>
                            </tr>
                            @foreach($GradeSheetMale as $key => $sub)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $sub->student_name }}</td>
                                <td style="text-align: center">
                                    <?php
                                    $formattedNum = round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8);
                                    echo $formattedNum;
                                    ?>                                                
                                </td>
                                <td style="text-align: center">
                                    <?php
                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $result = round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8);
                                        echo $result;
                                    ?>    
                                </td>
                                <?php                                                    
                                        $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        $subject_1 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                
                                        $fg_1 = round(($subject_1 + $subject1) / 2);
                                                                                    
                                        $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        $subject_2 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                
                                        $fg_2 = round(($subject_2 + $subject2) / 2);
                                                                                    
                                        $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                        $subject_3 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);

                                        $fg_3 = round(($subject_3 + $subject3) / 2);
                                                                                        
                                        $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        $subject_4 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        
                                        $fg_4 = round(($subject_4 + $subject4) / 2);
                                                                                        
                                        $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                        $subject_5 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    
                                        $fg_5 = round(($subject_5 + $subject5) / 2);
                                                                                        
                                        $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        $subject_6 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        
                                        $fg_6 = round(($subject_6 + $subject6) / 2);
                                                                                        
                                        $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        $subject_7 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        
                                        $fg_7 = round(($subject_7 + $subject7) / 2);
                                                                                        
                                        $subject8 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                        $subject_8 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                        
                                        $fg_8 = round(($subject_8 + $subject8) / 2);
                                                                                        
                                        
                                ?>
                    
                                <td>
                                        <center>                                                
                                                <?php
                                                    $average_2sem = round($average = ($fg_1 + $fg_2 + $fg_3 + $fg_4 + $fg_5 + $fg_6 + $fg_7 + $fg_8 )/8, 2);
                                                    echo round($average_2sem);
                                                ?>
                                        </center>
                                </td>
                                @if(round($average_2sem) >= 75 && round($average_2sem) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($average_2sem) >= 90 && round($average_2sem) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($average_2sem)>= 95 && round($average_2sem) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($average_2sem) >= 98 && round($average_2sem) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($average_2sem) < 75)
                                    <td>
                                        <center>Failed</center>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        
                                <tr>
                                    <td colspan="7">
                                        <b>Female</b>
                                    </td>
                                </tr>
                                @foreach($GradeSheetFeMale as $key => $sub)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $sub->student_name }}</td>
                                    <td style="text-align: center">
                                        <?php
                                        $formattedNum = round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8);
                                        echo $formattedNum;
                                        ?>                                                
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                            $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8);
                                        echo $result;
                                        ?>    
                                    </td>
                                    <?php                                                    
                                        $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        $subject_1 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                
                                        $fg_1 = round(($subject_1 + $subject1) / 2);
                                                                                    
                                        $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        $subject_2 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                
                                        $fg_2 = round(($subject_2 + $subject2) / 2);
                                                                                    
                                        $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                        $subject_3 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);

                                        $fg_3 = round(($subject_3 + $subject3) / 2);
                                                                                        
                                        $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        $subject_4 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        
                                        $fg_4 = round(($subject_4 + $subject4) / 2);
                                                                                        
                                        $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                        $subject_5 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    
                                        $fg_5 = round(($subject_5 + $subject5) / 2);
                                                                                        
                                        $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        $subject_6 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        
                                        $fg_6 = round(($subject_6 + $subject6) / 2);
                                                                                        
                                        $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        $subject_7 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        
                                        $fg_7 = round(($subject_7 + $subject7) / 2);
                                                                                        
                                        $subject8 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                        $subject_8 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                        
                                        $fg_8 = round(($subject_8 + $subject8) / 2);
                                                                                        
                                        
                                ?>
                    
                                <td>
                                    <center>                                                
                                            <?php
                                                $average_2sem = round($average = ($fg_1 + $fg_2 + $fg_3 + $fg_4 + $fg_5 + $fg_6 + $fg_7 + $fg_8)/8, 2);
                                                echo round($average_2sem);
                                            ?>
                                    </center>
                                </td>
                                @if(round($average_2sem) >= 75 && round($average_2sem) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($average_2sem) >= 90 && round($average_2sem) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($average_2sem)>= 95 && round($average_2sem) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($average_2sem) >= 98 && round($average_2sem) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($average_2sem) < 75)
                                    <td>
                                        <center>Failed</center>
                                    </td>
                                @endif
                                </tr>
                                @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <b>Male</b>
                                </td>
                            </tr>
                            @foreach($GradeSheetMale as $key => $sub)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $sub->student_name }}</td>
                                <td style="text-align: center">
                                    <?php
                                    $formattedNum = round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7+ $sub->subject_8+ $sub->subject_9)/9);
                                    echo $formattedNum;
                                    ?>                                                
                                </td>
                                <td style="text-align: center">
                                    <?php
                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $result = round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9);
                                        echo $result;
                                    ?>    
                                </td>
                                <?php                                                    
                                        $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                        $subject_1 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                
                                        $fg_1 = round(($subject_1 + $subject1) / 2);
                                                                                    
                                        $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                        $subject_2 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                
                                        $fg_2 = round(($subject_2 + $subject2) / 2);
                                                                                    
                                        $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                        $subject_3 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);

                                        $fg_3 = round(($subject_3 + $subject3) / 2);
                                                                                        
                                        $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        $subject_4 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                        
                                        $fg_4 = round(($subject_4 + $subject4) / 2);
                                                                                        
                                        $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                        $subject_5 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                    
                                        $fg_5 = round(($subject_5 + $subject5) / 2);
                                                                                        
                                        $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        $subject_6 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                        
                                        $fg_6 = round(($subject_6 + $subject6) / 2);
                                                                                        
                                        $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        $subject_7 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                        
                                        $fg_7 = round(($subject_7 + $subject7) / 2);
                                                                                        
                                        $subject8 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                        $subject_8 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                        
                                        $fg_8 = round(($subject_8 + $subject8) / 2);
                                                                                        
                                        $subject9 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_9);
                                        $subject_9 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_9);
                                        
                                        $fg_9 = round(($subject_9 + $subject9) / 2);
                                ?>
                    
                                <td>
                                        <center>                                                
                                                <?php
                                                    $average_2sem = round($average = ($fg_1 + $fg_2 + $fg_3 + $fg_4 + $fg_5 + $fg_6 + $fg_7 + $fg_8 + $fg_9)/9, 2);
                                                    echo round($average_2sem);
                                                ?>
                                        </center>
                                </td>
                                @if(round($average_2sem) >= 75 && round($average_2sem) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($average_2sem) >= 90 && round($average_2sem) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($average_2sem)>= 95 && round($average_2sem) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($average_2sem) >= 98 && round($average_2sem) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($average_2sem) < 75)
                                    <td>
                                        <center>Failed</center>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        
                                <tr>
                                    <td colspan="7">
                                        <b>Female</b>
                                    </td>
                                </tr>
                                @foreach($GradeSheetFeMale as $key => $sub)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $sub->student_name }}</td>
                                    <td style="text-align: center">
                                        <?php
                                        $formattedNum = round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 + $sub->subject_9)/9);
                                        echo $formattedNum;
                                        ?>                                                
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                            $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9);
                                            echo $result;
                                        ?>    
                                        </td>
                                        <?php                                                    
                                            $subject1 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                            $subject_1 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_1);
                                    
                                            $fg_1 = round(($subject_1 + $subject1) / 2);
                                                                                        
                                            $subject2 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                            $subject_2 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_2);
                                    
                                            $fg_2 = round(($subject_2 + $subject2) / 2);
                                                                                        
                                            $subject3 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);
                                            $subject_3 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_3);

                                            $fg_3 = round(($subject_3 + $subject3) / 2);
                                                                                            
                                            $subject4 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                            $subject_4 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_4);
                                            
                                            $fg_4 = round(($subject_4 + $subject4) / 2);
                                                                                            
                                            $subject5 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                            $subject_5 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_5);
                                        
                                            $fg_5 = round(($subject_5 + $subject5) / 2);
                                                                                            
                                            $subject6 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                            $subject_6 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_6);
                                            
                                            $fg_6 = round(($subject_6 + $subject6) / 2);
                                                                                            
                                            $subject7 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                            $subject_7 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_7);
                                            
                                            $fg_7 = round(($subject_7 + $subject7) / 2);
                                                                                            
                                            $subject8 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                            $subject_8 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_8);
                                            
                                            $fg_8 = round(($subject_8 + $subject8) / 2);
                                                                                            
                                            $subject9 = round(\App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first()->subject_9);
                                            $subject_9 = round(\App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first()->subject_9);
                                            
                                            $fg_9 = round(($subject_9 + $subject9) / 2);
                                    ?>
                            
                                <td>
                                        <center>                                                
                                                <?php
                                                    $average_2sem = round($average = ($fg_1 + $fg_2 + $fg_3 + $fg_4 + $fg_5 + $fg_6 + $fg_7 + $fg_8 + $fg_9)/9, 2);
                                                    echo round($average_2sem);
                                                ?>
                                        </center>
                                </td>
                                    @if(round($average_2sem) >= 75 && round($average_2sem) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($average_2sem) >= 90 && round($average_2sem) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($average_2sem)>= 95 && round($average_2sem) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($average_2sem) >= 98 && round($average_2sem) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($average_2sem) < 75)
                                        <td>
                                            <center>Failed</center>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                        @endif
                @else
                    {{-- @include('control_panel_faculty.my_advisory_class.partials.data_senior_average')                 --}}
                @endif
        </tbody>
    </table>
</div>