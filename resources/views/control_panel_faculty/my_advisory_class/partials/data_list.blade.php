                        
                        <h4>Grade &amp; Section: <span class="text-red"><i>{{ $ClassSubjectDetail->grade_level . ' ' .$ClassSubjectDetail->section }}</i></span></h4>
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
                                    
                                </tbody>
                        </table>