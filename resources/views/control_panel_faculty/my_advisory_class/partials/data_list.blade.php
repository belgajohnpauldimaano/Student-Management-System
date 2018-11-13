                        
                        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->id . ' ' .$ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
                        <h4>Room: <span class="text-red"><i>{{ $ClassSubjectDetail->room_code . ' ' .$ClassSubjectDetail->room_description }}</i></span></h4>

                        <table class="table no-margin">
                                <thead>
                                    <tr>
                                        
                                        <th>Student Name</th>
                                        {{--  <th>Subject ID</th>  --}}
                                        
                                    {{--  @if ($ClassSubjectDetail->grade_level >= 11) 
                                        <th>First Semister</th>
                                        <th>Second Semister</th>
                                    @elseif($ClassSubjectDetail->grade_level <= 10)  --}}
                                    @foreach ($AdvisorySubject as $sub)
                                     <th><center>{{$sub->subject}}</center></th>
                                     
                                    {{--  @endif  --}}
                                        
                                    @endforeach

                                        <th>Final Grading</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                    <tr>
                                        <th></th>

                                        @foreach ($EnrollmentMale as $data)
                                            
                                            
                                            <th  style="font-weight: normal"><center>{{$data->fir_g}}</center></th>
                                            
                                           {{--  @endif  --}}
                                               
                                           @endforeach
                                           <th><center>0.00</center></th>
                                    </tr>
                                   
                                </tbody>
                        </table>