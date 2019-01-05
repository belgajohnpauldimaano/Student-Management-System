
                        <h4>Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4>
                        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
                        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>

                        <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id="{{ $ClassSubjectDetail->id }}"><i class="fa fa-file-pdf"></i> Print</button>
                        <table class="table no-margin table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th style="width: 200px">Student Name</th>                                       
                                        {{--  @foreach ($AdvisorySubject as $sub)
                                        <th><center>{{$sub->subject}} {{$sub->id}}</center></th>                                                                        
                                        @endforeach  --}}
                                        <th style="width: 80px">Filipino</th>
                                        <th style="width: 80px">English</th>
                                        <th style="width: 80px">Math</th>
                                        <th style="width: 80px">Science</th>
                                        <th style="width: 80px">Araling<br/> Panlipunan</th>
                                        <th style="width: 80px">ICT</th>
                                        <th style="width: 80px">MAPEH</th>
                                        <th style="width: 80px">ESP</th>
                                        <th style="width: 80px">Religion</th>
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
                                                    $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 2);
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
                                                $formattedNum = number_format(round($average = ($sub->filipino + $sub->english + $sub->math + $sub->science + $sub->ap + $sub->ict + $sub->mapeh + $sub->esp +$sub->religion)/9), 2);
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

