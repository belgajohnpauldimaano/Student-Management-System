@if($type == 'average')
        
        @if($ClassSubjectDetail->grade_level == 11 || $ClassSubjectDetail->grade_level == 12)
        
       
            <h4>Semester: <span class="text-red"><i>{{ $sem }}</i></span> Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>                        
            <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
            <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>
            <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id="{{ $ClassSubjectDetail->id }}"><i class="fa fa-file-pdf"></i> Print</button>
            
            <table class="table no-margin table-striped table-bordered">
                    <thead>
                        <tr>
                                <th style="width: 30px">#</th>
                                <th style="width: 200px">Student Name</th>                                       

                                @if($quarter == 'First - Second')
                                    <th style="width: 80px; text-align: center">First Quarter</th>
                                    <th style="width: 80px; text-align: center">Second Quarter</th>
                                @else
                                    <th style="width: 80px; text-align: center">First Semester</th>
                                    <th style="width: 80px; text-align: center">Second Semester</th>
                                @endif
    
                                <th style="width: 80px; text-align: center">GENERAL AVERAGE</th>
                                <th style="width: 80px; text-align: center">REMARKS</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if($sem == 'First')
                            
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
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                            echo $formattedNum;
                                            ?>                                                
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                                $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                                echo $result;
                                            ?>    
                                            </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result) / 2);
                                            ?>
                                        </td>
                                        @if(round($result_final) >= 75 && round($result_final) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($result_final) < 75)
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
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
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
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                            echo $formattedNum;
                                            ?>                                                
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                                $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7+$sec_g->subject_8)/8), 0);
                                                echo $result;
                                            ?>    
                                            </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result) / 2);
                                            ?>
                                        </td>
                                        @if(round($result_final) >= 75 && round($result_final) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($result_final) < 75)
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
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7+$sec_g->subject_8)/8), 0);
                                                echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
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
                                            $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7+ $sub->subject_8+ $sub->subject_9)/9), 0);
                                            echo $formattedNum;
                                            ?>                                                
                                        </td>
                                        <td style="text-align: center">
                                            <?php
                                                $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);
                                                echo $result;
                                            ?>    
                                            </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result) / 2);
                                            ?>
                                        </td>
                                        @if(round($result_final) >= 75 && round($result_final) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($result_final) < 75)
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
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8+ $sub->subject_9)/9), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                @endif
                                
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
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                                    echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
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
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                                    echo $formattedNum;
                                                    ?>                                                
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                                        echo $result;
                                                    ?>    
                                                    </td>
                                                <td style="text-align: center">
                                                    <?php 
                                                        echo round($result_final = ($formattedNum + $result) / 2);
                                                    ?>
                                                </td>
                                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                    <td>
                                                        <center>Passed</center>
                                                    </td>
                                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                    <td>
                                                        <center>with honors</center>
                                                    </td>
                                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                    <td>
                                                        <center>with high honors</center>
                                                    </td>
                                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                    <td>
                                                        <center>with highest honors</center>
                                                    </td>
                                                @elseif(round($result_final) < 75)
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
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8), 0);
                                                    echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
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
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                                    echo $formattedNum;
                                                    ?>                                                
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8), 0);
                                                    echo $result;
                                                    ?>    
                                                    </td>
                                                <td style="text-align: center">
                                                    <?php 
                                                        echo round($result_final = ($formattedNum + $result) / 2);
                                                    ?>
                                                </td>
                                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                    <td>
                                                        <center>Passed</center>
                                                    </td>
                                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                    <td>
                                                        <center>with honors</center>
                                                    </td>
                                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                    <td>
                                                        <center>with high honors</center>
                                                    </td>
                                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                    <td>
                                                        <center>with highest honors</center>
                                                    </td>
                                                @elseif(round($result_final) < 75)
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
                                                $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7+ $sub->subject_8+ $sub->subject_9)/9), 0);
                                                echo $formattedNum;
                                                ?>                                                
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                    $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                    $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);
                                                    echo $result;
                                                ?>    
                                                </td>
                                            <td style="text-align: center">
                                                <?php 
                                                    echo round($result_final = ($formattedNum + $result) / 2);
                                                ?>
                                            </td>
                                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($result_final) < 75)
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
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 + $sub->subject_9)/9), 0);
                                                    echo $formattedNum;
                                                    ?>                                                
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                        $sec_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);
                                                        echo $result;
                                                    ?>    
                                                    </td>
                                                <td style="text-align: center">
                                                    <?php 
                                                        echo round($result_final = ($formattedNum + $result) / 2);
                                                    ?>
                                                </td>
                                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                                    <td>
                                                        <center>Passed</center>
                                                    </td>
                                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                                    <td>
                                                        <center>with honors</center>
                                                    </td>
                                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                                    <td>
                                                        <center>with high honors</center>
                                                    </td>
                                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                                    <td>
                                                        <center>with highest honors</center>
                                                    </td>
                                                @elseif(round($result_final) < 75)
                                                    <td>
                                                        <center>Failed</center>
                                                    </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                    @endif
                            @else

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
                                    
                                        <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                        
                                        ?>                                                
                                    
                                        <?php
                                            $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                            
                                        ?>    
                                    
                                            <?php
                                                $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                                $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7)/7), 0);
                                                
                                            ?>    
                                    
                                        <?php
                                            $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7)/7), 0);
                                            
                                        ?>    
                                    
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_1sem = ($formattedNum + $result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php 
                                            echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                        ?>
                                    </td>
                                    @if(round($result_final) >= 75 && round($result_final) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($result_final) < 75)
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
                                    
                                        <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                        ?>                                                
                                    
                                        <?php
                                            $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7)/7), 0);
                                        ?>    
                                        
                                        <?php
                                            $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                            $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7)/7), 0);
                                        ?>    
                                        
                                        <?php
                                            $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7)/7), 0);
                                        ?>    
                                        
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_1sem = ($formattedNum + $result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                            ?>
                                        </td>
                                    @if(round($result_final) >= 75 && round($result_final) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($result_final) < 75)
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
                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                    ?>                                                
                                
                                    <?php
                                        $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7+$sec_g->subject_8)/8), 0);
                                    ?>    
                                    
                                    <?php
                                        $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                        $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7 + $thi_g->subject_8)/8), 0);
                                    ?>    
                                    
                                    <?php
                                        $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7 + $fou_g->subject_8)/8), 0);
                                    ?>    
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_1sem = ($formattedNum + $result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php 
                                            echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                        ?>
                                    </td>
                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($result_final) < 75)
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
                                    
                                        <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8)/8), 0);
                                        
                                        ?>                                                
                                    
                                        <?php
                                            $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8)/8), 0);
                                       ?>    
                                        
                                        <?php
                                            $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                            $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7 + $thi_g->subject_8)/8), 0);
                                        ?>    
                                        
                                        <?php
                                            $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7 + $fou_g->subject_8)/8), 0);
                                        ?>    
                                        
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_1sem = ($formattedNum + $result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                            ?>
                                        </td>
                                    @if(round($result_final) >= 75 && round($result_final) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($result_final) < 75)
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
                                
                                    <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7+ $sub->subject_8+ $sub->subject_9)/9), 0);
                                        //echo $formattedNum;
                                    ?>                                                
                                
                                    <?php
                                        $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7+$sec_g->subject_8+$sec_g->subject_9)/9), 0);
                                        //echo $result;
                                    ?>    
                                    
                                    <?php
                                        $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                        $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7 + $thi_g->subject_8 + $thi_g->subject_9)/9), 0);
                                                //echo $thi_result;
                                    ?>    
                                    
                                    <?php
                                        $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                        $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7 + $fou_g->subject_8+ $thi_g->subject_9)/9), 0);
                                            //echo $fou_result;
                                    ?>    
                                    
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_1sem = ($formattedNum + $result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align:center">
                                            <?php 
                                                echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                            ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php 
                                            echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                        ?>
                                    </td>
                                @if(round($result_final) >= 75 && round($result_final) <= 89)
                                    <td>
                                        <center>Passed</center>
                                    </td>
                                @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                    <td>
                                        <center>with honors</center>
                                    </td>
                                @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                    <td>
                                        <center>with high honors</center>
                                    </td>
                                @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                    <td>
                                        <center>with highest honors</center>
                                    </td>
                                @elseif(round($result_final) < 75)
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
                                    
                                        <?php
                                        $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8+ $sub->subject_9)/9), 0);
                                        
                                        ?>                                                
                                    
                                        <?php
                                            $sec_g = \App\Grade_sheet_firstsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $result = number_format(round($average = ($sec_g->subject_1 + $sec_g->subject_2 + $sec_g->subject_3 + $sec_g->subject_4 + $sec_g->subject_5 + $sec_g->subject_6 + $sec_g->subject_7 + $sec_g->subject_8 + $sec_g->subject_9)/9), 0);;
                                        ?>    
                                        
                                        <?php
                                            $thi_g = \App\Grade11_Second_Sem::where('enrollment_id', $sub->enrollment_id)->first();
                                            $thi_result = number_format(round($average = ($thi_g->subject_1 + $thi_g->subject_2 + $thi_g->subject_3 + $thi_g->subject_4 + $thi_g->subject_5 + $thi_g->subject_6 + $thi_g->subject_7 + $thi_g->subject_8 + $thi_g->subject_9)/9), 0);
                                                    
                                        ?>    
                                        
                                        <?php
                                            $fou_g = \App\Grade_sheet_secondsemsecond::where('enrollment_id', $sub->enrollment_id)->first();
                                            $fou_result = number_format(round($average = ($fou_g->subject_1 + $fou_g->subject_2 + $fou_g->subject_3 + $fou_g->subject_4 + $fou_g->subject_5 + $fou_g->subject_6 + $fou_g->subject_7 + $fou_g->subject_8+ $thi_g->subject_9)/9), 0);
                                                
                                        ?>    
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_1sem = ($formattedNum + $result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align:center">
                                                <?php 
                                                    echo round($average_2sem = ($thi_result + $fou_result) / 2);
                                                ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php 
                                                echo round($result_final = ($formattedNum + $result + $thi_result + $fou_result) / 4);
                                            ?>
                                        </td>
                                    @if(round($result_final) >= 75 && round($result_final) <= 89)
                                        <td>
                                            <center>Passed</center>
                                        </td>
                                    @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                        <td>
                                            <center>with honors</center>
                                        </td>
                                    @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                        <td>
                                            <center>with high honors</center>
                                        </td>
                                    @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                        <td>
                                            <center>with highest honors</center>
                                        </td>
                                    @elseif(round($result_final) < 75)
                                        <td>
                                            <center>Failed</center>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                        @endif
                            @endif
                    </tbody>
            </table>
        
        @else
        {{-- Junior Highschool --}}
            <h4>Quarter: <span class="text-red"><span class="text-red"><i>{{ $quarter }}</i></span></h4>
                        
            <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
            <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>
            <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id="{{ $ClassSubjectDetail->id }}"><i class="fa fa-file-pdf"></i> Print</button>
                    
            <table class="table no-margin table-striped table-bordered">
                <thead>
                    <tr>
                            <th style="width: 30px">#</th>
                            <th style="width: 200px">Student Name</th>                                       
                            {{--  @foreach ($AdvisorySubject as $sub)
                            <th><center>{{$sub->subject}} {{$sub->id}}</center></th>                                                                        
                            @endforeach  --}}
                            @if($quarter == 'First - Second')
                                <th style="width: 80px; text-align: center">First Grading</th>
                                <th style="width: 80px; text-align: center">Second Grading</th>
                            @elseif($quarter =='First - Third')
                                <th style="width: 80px; text-align: center">First Grading</th>
                                <th style="width: 80px; text-align: center">Second Grading</th>
                                <th style="width: 80px; text-align: center">Third Grading</th>
                            @elseif($quarter =='First - Fourth')
                                <th style="width: 80px; text-align: center">First Grading</th>
                                <th style="width: 80px; text-align: center">Second Grading</th>
                                <th style="width: 80px; text-align: center">Third Grading</th>
                                <th style="width: 80px; text-align: center">Fourth Grading</th>
                            @endif

                            <th style="width: 80px; text-align: center">GENERAL AVERAGE</th>
                            <th style="width: 80px; text-align: center">REMARKS</th>
                    </tr>
                </thead>
                <tbody> 
                    
                    @if($quarter == 'First - Second')
                        <tr>
                            <td colspan="6">
                                <b>Male</b>
                            </td>
                        </tr>
                        @foreach($GradeSheetMale as $key => $sub)
                        <tr>
                            <td>{{ $key + 1 }}.</td>
                            <td>{{ $sub->student_name }}</td>
                            <td style="text-align: center">
                                <?php
                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                echo $formattedNum;
                                ?>                                                
                            </td>
                            <td style="text-align: center">
                                <?php
                                    $sec_g = \App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first();
                                    $result = number_format(round($average = ($sec_g->filipino + $sec_g->english + $sec_g->math + $sec_g->science + $sec_g->ap + $sec_g->ict + $sec_g->mapeh + $sec_g->esp +$sec_g->religion)/9), 0);
                                    echo $result;
                                ?>    
                                </td>
                            <td style="text-align: center">
                                <?php 
                                    echo round($result_final = ($formattedNum + $result) / 2);
                                ?>
                            </td>
                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                <td>
                                    <center>Passed</center>
                                </td>
                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                <td>
                                    <center>with honors</center>
                                </td>
                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                <td>
                                    <center>with high honors</center>
                                </td>
                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                <td>
                                    <center>with highest honors</center>
                                </td>
                            @elseif(round($result_final) < 75)
                                <td>
                                    <center>Failed</center>
                                </td>
                            @endif
                        </tr>    
                        @endforeach
                        <tr>
                            <td colspan="6">
                                <b>Female</b>
                            </td>
                        </tr>
                        @foreach($GradeSheetFeMale as $key => $sub)
                        <tr>
                            <td>{{ $key + 1 }}.</td>
                            <td>{{ $sub->student_name }}</td>
                            <td style="text-align: center">
                                <?php
                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                echo $formattedNum;
                                ?>                                                
                            </td>
                            <td style="text-align: center">
                                <?php
                                    $sec_g = \App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first();
                                    $result = number_format(round($average = ($sec_g->filipino + $sec_g->english + $sec_g->math + $sec_g->science + $sec_g->ap + $sec_g->ict + $sec_g->mapeh + $sec_g->esp +$sec_g->religion)/9), 0);
                                    echo $result;
                                ?>    
                                </td>
                            <td style="text-align: center">
                                <?php 
                                    echo round($result_final = ($formattedNum + $result) / 2);
                                ?>
                            </td>
                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                <td>
                                    <center>Passed</center>
                                </td>
                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                <td>
                                    <center>with honors</center>
                                </td>
                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                <td>
                                    <center>with high honors</center>
                                </td>
                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                <td>
                                    <center>with highest honors</center>
                                </td>
                            @elseif(round($result_final) < 75)
                                <td>
                                    <center>Failed</center>
                                </td>
                            @endif
                        </tr>    
                        @endforeach
                    @elseif($quarter =='First - Third')
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
                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                echo $formattedNum;
                                ?>                                                
                            </td>
                            <td style="text-align: center">
                                <?php
                                    $sec_g = \App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first();
                                    $sec_result = number_format(round($average = ($sec_g->filipino + $sec_g->english + $sec_g->math + $sec_g->science + $sec_g->ap + $sec_g->ict + $sec_g->mapeh + $sec_g->esp +$sec_g->religion)/9), 0);
                                    echo $sec_result;
                                ?>    
                            </td>
                            <td style="text-align: center">
                                <?php
                                    $thi_g = \App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first();
                                    $thi_result = number_format(round($average = ($thi_g->filipino + $thi_g->english + $thi_g->math + $thi_g->science + $thi_g->ap + $thi_g->ict + $thi_g->mapeh + $thi_g->esp +$thi_g->religion)/9), 0);
                                    echo $thi_result;
                                ?>    
                            </td>
                            <td style="text-align: center">
                                <?php 
                                    echo round($result_final = ($formattedNum + $sec_result + $thi_result) / 3);
                                ?>
                            </td>
                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                <td>
                                    <center>Passed</center>
                                </td>
                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                <td>
                                    <center>with honors</center>
                                </td>
                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                <td>
                                    <center>with high honors</center>
                                </td>
                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                <td>
                                    <center>with highest honors</center>
                                </td>
                            @elseif(round($result_final) < 75)
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
                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                echo $formattedNum;
                                ?>                                                
                            </td>
                            <td style="text-align: center">
                                    <?php
                                        $sec_g = \App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first();
                                        $sec_result = number_format(round($average = ($sec_g->filipino + $sec_g->english + $sec_g->math + $sec_g->science + $sec_g->ap + $sec_g->ict + $sec_g->mapeh + $sec_g->esp +$sec_g->religion)/9), 0);
                                        echo $sec_result;
                                    ?>    
                            </td>
                            <td style="text-align: center">
                                    <?php
                                        $thi_g = \App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first();
                                        $thi_result = number_format(round($average = ($thi_g->filipino + $thi_g->english + $thi_g->math + $thi_g->science + $thi_g->ap + $thi_g->ict + $thi_g->mapeh + $thi_g->esp +$thi_g->religion)/9), 0);
                                        echo $thi_result;
                                    ?>    
                            </td>
                            <td style="text-align: center">
                                    <?php 
                                        echo round($result_final = ($formattedNum + $sec_result + $thi_result) / 3);
                                    ?>
                                </td>
                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                <td>
                                    <center>Passed</center>
                                </td>
                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                <td>
                                    <center>with honors</center>
                                </td>
                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                <td>
                                    <center>with high honors</center>
                                </td>
                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                <td>
                                    <center>with highest honors</center>
                                </td>
                            @elseif(round($result_final) < 75)
                                <td>
                                    <center>Failed</center>
                                </td>
                            @endif
                        </tr>    
                        @endforeach
                    @elseif($quarter =='First - Fourth')
                        <tr>
                            <td colspan="8">
                                <b>Male</b>
                            </td>
                        </tr>
                        @foreach($GradeSheetMale as $key => $sub)
                        <tr>
                            <td>{{ $key + 1 }}.</td>
                            <td>{{ $sub->student_name }}</td>
                            <td style="text-align: center">
                                <?php
                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                echo $formattedNum;
                                ?>                                                
                            </td>
                            <td style="text-align: center">
                                <?php
                                    $sec_g = \App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first();
                                    $sec_result = number_format(round($average = ($sec_g->filipino + $sec_g->english + $sec_g->math + $sec_g->science + $sec_g->ap + $sec_g->ict + $sec_g->mapeh + $sec_g->esp +$sec_g->religion)/9), 0);
                                    echo $sec_result;
                                ?>    
                            </td>
                            <td style="text-align: center">
                                <?php
                                    $thi_g = \App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first();
                                    $thi_result = number_format(round($average = ($thi_g->filipino + $thi_g->english + $thi_g->math + $thi_g->science + $thi_g->ap + $thi_g->ict + $thi_g->mapeh + $thi_g->esp +$thi_g->religion)/9), 0);
                                    echo $thi_result;
                                ?>    
                            </td>
                            <td style="text-align: center">
                                <?php
                                    $fou_g = \App\Grade_sheet_fourth::where('enrollment_id', $sub->enrollment_id)->first();
                                    $fou_result = number_format(round($average = ($fou_g->filipino + $fou_g->english + $fou_g->math + $fou_g->science + $fou_g->ap + $fou_g->ict + $fou_g->mapeh + $fou_g->esp +$fou_g->religion)/9), 0);
                                    echo $fou_result;
                                ?>    
                            </td>
                            <td style="text-align: center">
                                <?php 
                                    echo round($result_final = ($formattedNum + $sec_result + $thi_result + $fou_result) / 4);
                                ?>
                            </td>
                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                <td>
                                    <center>Passed</center>
                                </td>
                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                <td>
                                    <center>with honors</center>
                                </td>
                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                <td>
                                    <center>with high honors</center>
                                </td>
                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                <td>
                                    <center>with highest honors</center>
                                </td>
                            @elseif(round($result_final) < 75)
                                <td>
                                    <center>Failed</center>
                                </td>
                            @endif
                        </tr>    
                        @endforeach
                        <tr>
                            <td colspan="8">
                                <b>Female</b>
                            </td>
                        </tr>
                        @foreach($GradeSheetFeMale as $key => $sub)
                        <tr>
                            <td>{{ $key + 1 }}.</td>
                            <td>{{ $sub->student_name }}</td>
                            <td style="text-align: center">
                                <?php
                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                echo $formattedNum;
                                ?>                                                
                            </td>
                            <td style="text-align: center">
                                    <?php
                                        $sec_g = \App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first();
                                        $sec_result = number_format(round($average = ($sec_g->filipino + $sec_g->english + $sec_g->math + $sec_g->science + $sec_g->ap + $sec_g->ict + $sec_g->mapeh + $sec_g->esp +$sec_g->religion)/9), 0);
                                        echo $sec_result;
                                    ?>    
                            </td>
                            <td style="text-align: center">
                                    <?php
                                        $thi_g = \App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first();
                                        $thi_result = number_format(round($average = ($thi_g->filipino + $thi_g->english + $thi_g->math + $thi_g->science + $thi_g->ap + $thi_g->ict + $thi_g->mapeh + $thi_g->esp +$thi_g->religion)/9), 0);
                                        echo $thi_result;
                                    ?>    
                            </td>
                            <td style="text-align: center">
                                    <?php
                                        $fou_g = \App\Grade_sheet_fourth::where('enrollment_id', $sub->enrollment_id)->first();
                                        $fou_result = number_format(round($average = ($fou_g->filipino + $fou_g->english + $fou_g->math + $fou_g->science + $fou_g->ap + $fou_g->ict + $fou_g->mapeh + $fou_g->esp +$fou_g->religion)/9), 0);
                                        echo $fou_result;
                                    ?>    
                            </td>
                            <td style="text-align: center">
                                    <?php 
                                        echo round($result_final = ($formattedNum + $sec_result + $thi_result + $fou_result) / 4);
                                    ?>
                            </td>
                            @if(round($result_final) >= 75 && round($result_final) <= 89)
                                <td>
                                    <center>Passed</center>
                                </td>
                            @elseif(round($result_final) >= 90 && round($result_final) <= 94)
                                <td>
                                    <center>with honors</center>
                                </td>
                            @elseif(round($result_final)>= 95 && round($result_final) <= 97)
                                <td>
                                    <center>with high honors</center>
                                </td>
                            @elseif(round($result_final) >= 98 && round($result_final) <= 100)
                                <td>
                                    <center>with highest honors</center>
                                </td>
                            @elseif(round($result_final) < 75)
                                <td>
                                    <center>Failed</center>
                                </td>
                            @endif
                        </tr>    
                        @endforeach
                    @endif
                </tbody>
            </table>
            
        @endif
                 
@else

               
            @if($ClassSubjectDetail->grade_level == 11 || $ClassSubjectDetail->grade_level == 12)
                        
                    <h4>Semester: <span class="text-red"><i>{{ $sem }}</i></span> Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>
                     
                    <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
                    <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>

                    <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id="{{ $ClassSubjectDetail->id }}"><i class="fa fa-file-pdf"></i> Print</button>
                    <table class="table no-margin table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 30px">#</th>
                                    <th style="width: 200px">Student Name</th>                                       
                                    @foreach ($AdvisorySubject as $key => $sub)                                     
                                        <th style="width: 30px; text-align: center">{{ $sub->subject_code }} </th>                                                                  
                                    @endforeach 
                                    
                                    <th style="width: 80px">GENERAL AVERAGE</th>
                                    <th style="width: 80px">REMARKS</th>
                                </tr>
                            </thead>
                            <tbody>                                  
                                <tr>
                                    <td colspan="13">
                                        <b>Male</b>
                                    </td>
                                </tr>
                                @foreach($GradeSheetMale as $key => $sub)
                                <tr>
                                        {{-- $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section
                                    @if($ClassSubjectDetail->grade_level == 12 && $ClassSubjectDetail->section == '') --}}
                                    @if($NumberOfSubject->class_subject_order == 7)
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{$sub->student_name}}</td>
                                        <td><center>{{ $sub->subject_1 }}</center></td>
                                        <td><center>{{ $sub->subject_2 }}</center></td>
                                        <td><center>{{$sub->subject_3}}</center></td>
                                        <td><center>{{$sub->subject_4}}</center></td>
                                        <td><center>{{$sub->subject_5}}</center></td>
                                        <td><center>{{$sub->subject_6}}</center></td>
                                        <td><center>{{$sub->subject_7}}</center></td>
                                        <td>
                                            <center>                                                
                                                <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                                    echo $formattedNum;
                                                ?>
                                            </center>
                                        </td>
    
                                        @if(round($average) >= 75 && round($average) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($average) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                                
                                                                            
                                        

                                    @elseif($NumberOfSubject->class_subject_order == 8)
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{$sub->student_name}}</td>
                                        <td><center>{{ $sub->subject_1 }}</center></td>
                                        <td><center>{{ $sub->subject_2 }}</center></td>
                                        <td><center>{{$sub->subject_3}}</center></td>
                                        <td><center>{{$sub->subject_4}}</center></td>
                                        <td><center>{{$sub->subject_5}}</center></td>
                                        <td><center>{{$sub->subject_6}}</center></td>
                                        <td><center>{{$sub->subject_7}}</center></td>
                                        <td><center>{{$sub->subject_8}}</center></td>
                                        {{-- <td><center>{{$sub->subject_9}}</center></td> --}}
                                        <td>
                                            <center>                                                
                                                <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 )/8), 0);
                                                    echo $formattedNum;
                                                ?>
                                            </center>
                                        </td>
    
                                        @if(round($average) >= 75 && round($average) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($average) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                                
                                                                           
                                        

                                    @else
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{$sub->student_name}}</td>
                                        <td><center>{{ $sub->subject_1 }}</center></td>
                                        <td><center>{{ $sub->subject_2 }}</center></td>
                                        <td><center>{{$sub->subject_3}}</center></td>
                                        <td><center>{{$sub->subject_4}}</center></td>
                                        <td><center>{{$sub->subject_5}}</center></td>
                                        <td><center>{{$sub->subject_6}}</center></td>
                                        <td><center>{{$sub->subject_7}}</center></td>
                                        <td><center>{{$sub->subject_8}}</center></td>
                                        <td><center>{{$sub->subject_9}}</center></td>

                                        <td>
                                            <center>                                                
                                                <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 +$sub->subject_9)/9), 0);
                                                    echo $formattedNum;
                                                ?>
                                            </center>
                                        </td>
    
                                        @if(round($average) >= 75 && round($average) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($average) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                                
                                                                        
                                        
                                    @endif    
                                </tr>                                
                                @endforeach
                                

                                <tr>
                                    <td colspan="13">
                                        <b>Female</b>
                                    </td>
                                </tr>

                                @foreach($GradeSheetFeMale as $key => $sub)
                                <tr>
                                    
                                    @if($NumberOfSubject->class_subject_order == 7)
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{$sub->student_name}}</td>
                                        <td><center>{{ $sub->subject_1 }}</center></td>
                                        <td><center>{{ $sub->subject_2 }}</center></td>
                                        <td><center>{{$sub->subject_3}}</center></td>
                                        <td><center>{{$sub->subject_4}}</center></td>
                                        <td><center>{{$sub->subject_5}}</center></td>
                                        <td><center>{{$sub->subject_6}}</center></td>
                                        <td><center>{{$sub->subject_7}}</center></td>
                                        <td>
                                            <center>                                                
                                                <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7)/7), 0);
                                                    echo $formattedNum;
                                                ?>
                                            </center>
                                        </td>
    
                                        @if(round($average) >= 75 && round($average) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($average) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                                
                                                                            
                                        

                                    @elseif($NumberOfSubject->class_subject_order == 8)
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{$sub->student_name}}</td>
                                        <td><center>{{ $sub->subject_1 }}</center></td>
                                        <td><center>{{ $sub->subject_2 }}</center></td>
                                        <td><center>{{$sub->subject_3}}</center></td>
                                        <td><center>{{$sub->subject_4}}</center></td>
                                        <td><center>{{$sub->subject_5}}</center></td>
                                        <td><center>{{$sub->subject_6}}</center></td>
                                        <td><center>{{$sub->subject_7}}</center></td>
                                        <td><center>{{$sub->subject_8}}</center></td>
                                        {{-- <td><center>{{$sub->subject_9}}</center></td> --}}
                                        <td>
                                            <center>                                                
                                                <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 )/8), 0);
                                                    echo $formattedNum;
                                                ?>
                                            </center>
                                        </td>
    
                                        @if(round($average) >= 75 && round($average) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($average) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                                
                                                                           
                                        

                                    @else
                                        <td>{{ $key + 1 }}.</td>
                                        <td>{{$sub->student_name}}</td>
                                        <td><center>{{ $sub->subject_1 }}</center></td>
                                        <td><center>{{ $sub->subject_2 }}</center></td>
                                        <td><center>{{$sub->subject_3}}</center></td>
                                        <td><center>{{$sub->subject_4}}</center></td>
                                        <td><center>{{$sub->subject_5}}</center></td>
                                        <td><center>{{$sub->subject_6}}</center></td>
                                        <td><center>{{$sub->subject_7}}</center></td>
                                        <td><center>{{$sub->subject_8}}</center></td>
                                        <td><center>{{$sub->subject_9}}</center></td>

                                        <td>
                                            <center>                                                
                                                <?php
                                                    $formattedNum = number_format(round($average = ($sub->subject_1 + $sub->subject_2 + $sub->subject_3 + $sub->subject_4 + $sub->subject_5 + $sub->subject_6 + $sub->subject_7 + $sub->subject_8 +$sub->subject_9)/9), 0);
                                                    echo $formattedNum;
                                                ?>
                                            </center>
                                        </td>
    
                                        @if(round($average) >= 75 && round($average) <= 89)
                                            <td>
                                                <center>Passed</center>
                                            </td>
                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                            <td>
                                                <center>with honors</center>
                                            </td>
                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                            <td>
                                                <center>with high honors</center>
                                            </td>
                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                            <td>
                                                <center>with highest honors</center>
                                            </td>
                                        @elseif(round($average) < 75)
                                            <td>
                                                <center>Failed</center>
                                            </td>
                                        @endif
                                                
                                                                        
                                        
                                    @endif
                                    
                            </tr>             
                            @endforeach 
                    </table>
            
            @elseif($ClassSubjectDetail->grade_level == 7 || $ClassSubjectDetail->grade_level == 8)
                   
                
                        <h4>Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>
                        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
                        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>
            
                                    <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id="{{ $ClassSubjectDetail->id }}"><i class="fa fa-file-pdf"></i> Print</button>
                                    @if($quarter == 'Fourth')
                                            <table class="table no-margin table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30px">#</th>
                                                        <th style="width: 200px">Student Name</th>                                       
                                                        {{--  @foreach ($AdvisorySubject as $sub)
                                                        <th><center>{{$sub->subject}} {{$sub->id}}</center></th>                                                                        
                                                        @endforeach  --}}
                                                        <th style="width: 80px; text-align: center" colspan="2">Filipino</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">English</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">Math</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">Science</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">Araling<br/> Panlipunan</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">ESP</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">ICT</th>
                                                        <th style="width: 80px; text-align: center" colspan="2">MAPEH</th>                                                        
                                                        <th style="width: 80px; text-align: center" colspan="2">Religion</th>

                                                        <th style="width: 80px; text-align: center">GENERAL AVERAGE</th>
                                                        <th style="width: 80px; text-align: center">REMARKS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                  
                                                    <tr>
                                                        <td> 
                                                            <b>Male</b>
                                                        </td>
                                                        <td></td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                        <td style="color: red">4TH</td>
                                                        <td style="color: blue">FG</td>
                                                    </tr>
                                                    @foreach($GradeSheetMale as $key => $sub)
                                                    <tr>
                                                        <td>{{ $key + 1 }}.</td>
                                                        <td>{{$sub->student_name}}</td>
                                                        <td><center>{{ $sub->filipino }}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->filipino);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->filipino) / 4);
                                                            ?>
                                                        </td>
                                                        <td><center>{{$sub->english}}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                            $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->english);                                                                                                        
                                                            $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                            $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                            echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->english) / 4);
                                                            ?>
                                                        </td>
                                                        <td><center>{{$sub->math}}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                            $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->math);                                                                                                        
                                                            $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                            $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                            echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->math) / 4);
                                                            ?>
                                                        </td>
                                                        <td><center>{{$sub->science}}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                            $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->science);                                                                                                        
                                                            $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                            $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                            echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->science) / 4);
                                                            ?>
                                                        </td>
                                                        <td><center>{{$sub->ap}}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                            $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ap);                                                                                                        
                                                            $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                            $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                            echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->ap) / 4);
                                                            ?>
                                                        </td>
                                                        <td><center>{{$sub->esp}}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                            $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->esp);                                                                                                        
                                                            $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                            $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                            echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->esp) / 4);
                                                            ?>
                                                        </td>
                                                        <td><center>{{$sub->ict}}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                            $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ict);                                                                                                        
                                                            $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                            $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                            echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->ict) / 4);
                                                            ?>
                                                        </td>
                                                        <td><center>{{$sub->mapeh}}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                            $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);                                                                                                        
                                                            $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                            $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                            echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->mapeh) / 4);
                                                            ?>
                                                        </td>
                                                        
                                                        <td><center>{{$sub->religion}}</center></td>
                                                        <td>
                                                            <?php                                                    
                                                            $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->religion);                                                                                                        
                                                            $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                            $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                            echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->religion) / 4);
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <center>                                                
                                                                <?php
                                                                    $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                                    echo $formattedNum;
                                                                ?>
                                                            </center>
                                                        </td>
            
                                                        @if(round($average) >= 75 && round($average) <= 89)
                                                            <td>
                                                                <center>Passed</center>
                                                            </td>
                                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                                            <td>
                                                                <center>with honors</center>
                                                            </td>
                                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                                            <td>
                                                                <center>with high honors</center>
                                                            </td>
                                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                                            <td>
                                                                <center>with highest honors</center>
                                                            </td>
                                                        @elseif(round($average) < 75)
                                                            <td>
                                                                <center>Failed</center>
                                                            </td>
                                                        @endif
                                                                
                                                        </tr>                                    
                                                        @endforeach
            
                                                    <tr>
                                                        <td colspan="13">
                                                            <b>Female</b>
                                                        </td>
                                                    </tr>
                                                    @foreach($GradeSheetFeMale as $key => $sub)
                                                    <tr>
                                                        <td>{{ $key + 1 }}.</td>
                                                        <td>{{$sub->student_name}}</td>
                                                            <td><center>{{$sub->filipino}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->filipino);                                                                                                        
                                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->filipino) / 4);
                                                                ?>
                                                            </td>
                                                            <td><center>{{$sub->english}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->english);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->english) / 4);
                                                                ?>
                                                            </td>
                                                            <td><center>{{$sub->math}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->math);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->math) / 4);
                                                                ?>
                                                            </td>
                                                            <td><center>{{$sub->science}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->science);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->science) / 4);
                                                                ?>
                                                            </td>
                                                            <td><center>{{$sub->ap}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ap);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->ap) / 4);
                                                                ?>
                                                            </td>
                                                            <td><center>{{$sub->esp}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->esp);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->esp) / 4);
                                                                ?>
                                                            </td>
                                                            <td><center>{{$sub->ict}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ict);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->ict) / 4);
                                                                ?>
                                                            </td>
                                                            <td><center>{{$sub->mapeh}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->mapeh) / 4);
                                                                ?>
                                                            </td>
                                                            
                                                            <td><center>{{$sub->religion}}</center></td>
                                                            <td>
                                                                <?php                                                    
                                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->religion);                                                                                                        
                                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->religion) / 4);
                                                                ?>
                                                            </td>
                                                        <td>
                                                            <center>
                                                                <?php
                                                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                                echo $formattedNum;
                                                                ?>                                                
                                                            </center>
                                                        </td>
                                                        
                                                    
                                                        @if(round($average) >= 75 && round($average) <= 89)
                                                            <td>
                                                                <center>Passed</center>
                                                            </td>
                                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                                            <td>
                                                                <center>with honors</center>
                                                            </td>
                                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                                            <td>
                                                                <center>with high honors</center>
                                                            </td>
                                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                                            <td>
                                                                <center>with highest honors</center>
                                                            </td>
                                                        @elseif(round($average) < 75)
                                                            <td>
                                                                <center>Failed</center>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                    
                                                    
                                                </tbody>
                                            </table>

                                    @else
                                        <table class="table no-margin table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30px">#</th>
                                                        <th style="width: 200px">Student Name</th>                                       
                                                        {{--  @foreach ($AdvisorySubject as $sub)
                                                        <th><center>{{$sub->subject}} {{$sub->id}}</center></th>                                                                        
                                                        @endforeach  --}}
                                                        <th style="width: 80px; text-align: center">Filipino</th>
                                                        <th style="width: 80px; text-align: center">English</th>
                                                        <th style="width: 80px; text-align: center">Mathematics</th>
                                                        <th style="width: 80px; text-align: center">Science</th>
                                                        <th style="width: 80px; text-align: center">Araling<br/> Panlipunan</th>
                                                        <th style="width: 80px; text-align: center">ESP</th>
                                                        <th style="width: 80px; text-align: center">ICT</th>
                                                        <th style="width: 80px; text-align: center">MAPEH</th>                                        
                                                        <th style="width: 80px; text-align: center">Religion</th>
                                                        <th style="width: 80px; text-align: center">GENERAL AVERAGE</th>
                                                        <th style="width: 80px; text-align: center">REMARKS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                  
                                                    <tr>
                                                        <td colspan="13">
                                                            <b>Male</b>
                                                        </td>
                                                    </tr>
                                                    @foreach($GradeSheetMale as $key => $sub)
                                                    <tr>
                                                        <td>{{ $key + 1 }}.</td>
                                                        <td>{{$sub->student_name}}</td>
                                                        <td><center>{{ $sub->filipino }}</center></td>
                                                        <td><center>{{$sub->english}}</center></td>
                                                        <td><center>{{$sub->math}}</center></td>
                                                        <td><center>{{$sub->science}}</center></td>
                                                        <td><center>{{$sub->ap}}</center></td>
                                                        <td><center>{{$sub->esp}}</center></td>
                                                        <td><center>{{$sub->ict}}</center></td>
                                                        <td><center>{{$sub->mapeh}}</center></td>                                        
                                                        <td><center>{{$sub->religion}}</center></td>
                                                        <td>
                                                            <center>                                                
                                                                <?php
                                                                    $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                                    echo $formattedNum;
                                                                ?>
                                                            </center>
                                                        </td>
                
                                                        @if(round($average) >= 75 && round($average) <= 89)
                                                            <td>
                                                                <center>Passed</center>
                                                            </td>
                                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                                            <td>
                                                                <center>with honors</center>
                                                            </td>
                                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                                            <td>
                                                                <center>with high honors</center>
                                                            </td>
                                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                                            <td>
                                                                <center>with highest honors</center>
                                                            </td>
                                                        @elseif(round($average) < 75)
                                                            <td>
                                                                <center>Failed</center>
                                                            </td>
                                                        @endif
                                                                
                                                        </tr>                                    
                                                        @endforeach
                
                                                    <tr>
                                                        <td colspan="13">
                                                            <b>Female</b>
                                                        </td>
                                                    </tr>
                                                    @foreach($GradeSheetFeMale as $key => $sub)
                                                    <tr>
                                                        <td>{{ $key + 1 }}.</td>
                                                        <td>{{$sub->student_name}}</td>
                                                        <td><center>{{ $sub->filipino }}</center></td>
                                                        <td><center>{{$sub->english}}</center></td>
                                                        <td><center>{{$sub->math}}</center></td>
                                                        <td><center>{{$sub->science}}</center></td>
                                                        <td><center>{{$sub->ap}}</center></td>
                                                        <td><center>{{$sub->esp}}</center></td>
                                                        <td><center>{{$sub->ict}}</center></td>
                                                        <td><center>{{$sub->mapeh}}</center></td>                                        
                                                        <td><center>{{$sub->religion}}</center></td>
                                                        <td>
                                                            <center>
                                                                <?php
                                                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                                echo $formattedNum;
                                                                ?>                                                
                                                            </center>
                                                        </td>
                                                        
                                                    
                                                        @if(round($average) >= 75 && round($average) <= 89)
                                                            <td>
                                                                <center>Passed</center>
                                                            </td>
                                                        @elseif(round($average) >= 90 && round($average) <= 94)
                                                            <td>
                                                                <center>with honors</center>
                                                            </td>
                                                        @elseif(round($average)>= 95 && round($average) <= 97)
                                                            <td>
                                                                <center>with high honors</center>
                                                            </td>
                                                        @elseif(round($average) >= 98 && round($average) <= 100)
                                                            <td>
                                                                <center>with highest honors</center>
                                                            </td>
                                                        @elseif(round($average) < 75)
                                                            <td>
                                                                <center>Failed</center>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                    
                                                    
                                                </tbody>
                                        </table>
                                @endif
                   


            @else
                
                    <h4>Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>
                            <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
                            <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>

                            <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id="{{ $ClassSubjectDetail->id }}"><i class="fa fa-file-pdf"></i> Print</button>
                            
                            @if($quarter == 'Fourth')
                                <table class="table no-margin table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th style="width: 200px">Student Name</th>                                       
                                            {{--  @foreach ($AdvisorySubject as $sub)
                                            <th><center>{{$sub->subject}} {{$sub->id}}</center></th>                                                                        
                                            @endforeach  --}}
                                            <th style="width: 80px; text-align: center" colspan="2">Filipino</th>
                                            <th style="width: 80px; text-align: center" colspan="2">English</th>
                                            <th style="width: 80px; text-align: center" colspan="2">Math</th>
                                            <th style="width: 80px; text-align: center" colspan="2">Science</th>
                                            <th style="width: 80px; text-align: center" colspan="2">Araling<br/> Panlipunan</th>
                                            <th style="width: 80px; text-align: center" colspan="2">ICT</th>
                                            <th style="width: 80px; text-align: center" colspan="2">MAPEH</th>
                                            <th style="width: 80px; text-align: center" colspan="2">ESP</th>
                                            <th style="width: 80px; text-align: center" colspan="2">Religion</th>
                                            <th style="width: 80px; text-align: center">GENERAL AVERAGE</th>
                                            <th style="width: 80px; text-align: center">REMARKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                  
                                        <tr>
                                            <td> 
                                                <b>Male</b>
                                            </td>
                                            <td></td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                            <td style="color: red">4TH</td>
                                            <td style="color: blue">FG</td>
                                        </tr>
                                        @foreach($GradeSheetMale as $key => $sub)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{$sub->student_name}}</td>
                                            <td><center>{{ $sub->filipino }}</center></td>
                                            <td>
                                                <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->filipino);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->filipino) / 4);
                                                ?>
                                            </td>
                                            <td><center>{{$sub->english}}</center></td>
                                            <td>
                                                <?php                                                    
                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->english);                                                                                                        
                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->english) / 4);
                                                ?>
                                            </td>
                                            <td><center>{{$sub->math}}</center></td>
                                            <td>
                                                <?php                                                    
                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->math);                                                                                                        
                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->math) / 4);
                                                ?>
                                            </td>
                                            <td><center>{{$sub->science}}</center></td>
                                            <td>
                                                <?php                                                    
                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->science);                                                                                                        
                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->science) / 4);
                                                ?>
                                            </td>
                                            <td><center>{{$sub->ap}}</center></td>
                                            <td>
                                                <?php                                                    
                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ap);                                                                                                        
                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->ap) / 4);
                                                ?>
                                            </td>
                                            <td><center>{{$sub->ict}}</center></td>
                                            <td>
                                                <?php                                                    
                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ict);                                                                                                        
                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->ict) / 4);
                                                ?>
                                            </td>
                                            <td><center>{{$sub->mapeh}}</center></td>
                                            <td>
                                                <?php                                                    
                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);                                                                                                        
                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->mapeh) / 4);
                                                ?>
                                            </td>
                                            <td><center>{{$sub->esp}}</center></td>
                                            <td>
                                                <?php                                                    
                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->esp);                                                                                                        
                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->esp) / 4);
                                                ?>
                                            </td>
                                            <td><center>{{$sub->religion}}</center></td>
                                            <td>
                                                <?php                                                    
                                                $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->religion);                                                                                                        
                                                $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->religion) / 4);
                                                ?>
                                            </td>
                                            <td>
                                                <center>                                                
                                                    <?php
                                                        $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                        echo $formattedNum;
                                                    ?>
                                                </center>
                                            </td>

                                            @if(round($average) >= 75 && round($average) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($average) >= 90 && round($average) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($average)>= 95 && round($average) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($average) >= 98 && round($average) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($average) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                                    
                                            </tr>                                    
                                            @endforeach

                                        <tr>
                                            <td colspan="13">
                                                <b>Female</b>
                                            </td>
                                        </tr>
                                        @foreach($GradeSheetFeMale as $key => $sub)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{$sub->student_name}}</td>
                                                <td><center>{{$sub->filipino}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                        $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->filipino);                                                                                                        
                                                        $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                        $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->filipino);
                                                        echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->filipino) / 4);
                                                    ?>
                                                </td>
                                                <td><center>{{$sub->english}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->english);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->english);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->english) / 4);
                                                    ?>
                                                </td>
                                                <td><center>{{$sub->math}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->math);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->math);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->math) / 4);
                                                    ?>
                                                </td>
                                                <td><center>{{$sub->science}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->science);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->science);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->science) / 4);
                                                    ?>
                                                </td>
                                                <td><center>{{$sub->ap}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ap);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ap);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->ap) / 4);
                                                    ?>
                                                </td>
                                                <td><center>{{$sub->ict}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->ict);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->ict);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->ict) / 4);
                                                    ?>
                                                </td>
                                                <td><center>{{$sub->mapeh}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->mapeh);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->mapeh) / 4);
                                                    ?>
                                                </td>
                                                <td><center>{{$sub->esp}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->esp);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->esp);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->esp) / 4);
                                                    ?>
                                                </td>
                                                <td><center>{{$sub->religion}}</center></td>
                                                <td>
                                                    <?php                                                    
                                                    $fir_g = round(\App\Grade_sheet_first::where('enrollment_id', $sub->enrollment_id)->first()->religion);                                                                                                        
                                                    $sec_g = round(\App\Grade_sheet_second::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                    $thi_g = round(\App\Grade_sheet_third::where('enrollment_id', $sub->enrollment_id)->first()->religion);
                                                    echo $WA = round(($fir_g + $sec_g + $thi_g + $sub->religion) / 4);
                                                    ?>
                                                </td>
                                            <td>
                                                <center>
                                                    <?php
                                                    $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                    echo $formattedNum;
                                                    ?>                                                
                                                </center>
                                            </td>
                                            
                                        
                                            @if(round($average) >= 75 && round($average) <= 89)
                                                <td>
                                                    <center>Passed</center>
                                                </td>
                                            @elseif(round($average) >= 90 && round($average) <= 94)
                                                <td>
                                                    <center>with honors</center>
                                                </td>
                                            @elseif(round($average)>= 95 && round($average) <= 97)
                                                <td>
                                                    <center>with high honors</center>
                                                </td>
                                            @elseif(round($average) >= 98 && round($average) <= 100)
                                                <td>
                                                    <center>with highest honors</center>
                                                </td>
                                            @elseif(round($average) < 75)
                                                <td>
                                                    <center>Failed</center>
                                                </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                </table>
                            @else
                                    <table class="table no-margin table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px">#</th>
                                                <th style="width: 200px">Student Name</th>                                       
                                                {{--  @foreach ($AdvisorySubject as $sub)
                                                <th><center>{{$sub->subject}} {{$sub->id}}</center></th>                                                                        
                                                @endforeach  --}}
                                                <th style="width: 80px; text-align: center">Filipino</th>
                                                <th style="width: 80px; text-align: center">English</th>
                                                <th style="width: 80px; text-align: center">Math</th>
                                                <th style="width: 80px; text-align: center">Science</th>
                                                <th style="width: 80px; text-align: center">Araling<br/> Panlipunan</th>
                                                <th style="width: 80px; text-align: center">ICT</th>
                                                <th style="width: 80px; text-align: center">MAPEH</th>
                                                <th style="width: 80px; text-align: center">ESP</th>
                                                <th style="width: 80px; text-align: center">Religion</th>
                                                <th style="width: 80px; text-align: center">GENERAL AVERAGE</th>
                                                <th style="width: 80px; text-align: center">REMARKS</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                  
                                            <tr>
                                                <td colspan="13">
                                                    <b>Male</b>
                                                </td>
                                            </tr>
                                            @foreach($GradeSheetMale as $key => $sub)
                                            <tr>
                                                <td>{{ $key + 1 }}.</td>
                                                <td>{{$sub->student_name}}</td>
                                                <td><center>{{ $sub->filipino }}</center></td>
                                                <td><center>{{$sub->english}}</center></td>
                                                <td><center>{{$sub->math}}</center></td>
                                                <td><center>{{$sub->science}}</center></td>
                                                <td><center>{{$sub->ap}}</center></td>
                                                <td><center>{{$sub->ict}}</center></td>
                                                <td><center>{{$sub->mapeh}}</center></td>
                                                <td><center>{{$sub->esp}}</center></td>
                                                <td><center>{{$sub->religion}}</center></td>
                                                <td>
                                                    <center>                                                
                                                        <?php
                                                            $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                            echo $formattedNum;
                                                        ?>
                                                    </center>
                                                </td>

                                                @if(round($average) >= 75 && round($average) <= 89)
                                                    <td>
                                                        <center>Passed</center>
                                                    </td>
                                                @elseif(round($average) >= 90 && round($average) <= 94)
                                                    <td>
                                                        <center>with honors</center>
                                                    </td>
                                                @elseif(round($average)>= 95 && round($average) <= 97)
                                                    <td>
                                                        <center>with high honors</center>
                                                    </td>
                                                @elseif(round($average) >= 98 && round($average) <= 100)
                                                    <td>
                                                        <center>with highest honors</center>
                                                    </td>
                                                @elseif(round($average) < 75)
                                                    <td>
                                                        <center>Failed</center>
                                                    </td>
                                                @endif
                                                        
                                                </tr>                                    
                                                @endforeach

                                            <tr>
                                                <td colspan="13">
                                                    <b>Female</b>
                                                </td>
                                            </tr>
                                            @foreach($GradeSheetFeMale as $key => $sub)
                                            <tr>
                                                <td>{{ $key + 1 }}.</td>
                                                <td>{{$sub->student_name}}</td>
                                                <td><center>{{ $sub->filipino }}</center></td>
                                                <td><center>{{$sub->english}}</center></td>
                                                <td><center>{{$sub->math}}</center></td>
                                                <td><center>{{$sub->science}}</center></td>
                                                <td><center>{{$sub->ap}}</center></td>
                                                <td><center>{{$sub->ict}}</center></td>
                                                <td><center>{{$sub->mapeh}}</center></td>
                                                <td><center>{{$sub->esp}}</center></td>
                                                <td><center>{{$sub->religion}}</center></td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 0);
                                                        echo $formattedNum;
                                                        ?>                                                
                                                    </center>
                                                </td>
                                                
                                            
                                                @if(round($average) >= 75 && round($average) <= 89)
                                                    <td>
                                                        <center>Passed</center>
                                                    </td>
                                                @elseif(round($average) >= 90 && round($average) <= 94)
                                                    <td>
                                                        <center>with honors</center>
                                                    </td>
                                                @elseif(round($average)>= 95 && round($average) <= 97)
                                                    <td>
                                                        <center>with high honors</center>
                                                    </td>
                                                @elseif(round($average) >= 98 && round($average) <= 100)
                                                    <td>
                                                        <center>with highest honors</center>
                                                    </td>
                                                @elseif(round($average) < 75)
                                                    <td>
                                                        <center>Failed</center>
                                                    </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                            
                                            
                                        </tbody>
                                    </table>
                            @endif
                            
                
            @endif
 @endif