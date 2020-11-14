<table class="table table-condensed table-bordered table-hover">
        <thead style="position: sticky;top: 0" class="thead-dark">
            @if($quarter == '1st' || $quarter == '2nd' || $quarter == '3rd' || $quarter == '4th')
            <tr>
                <th>#</th>
                <th>Student Name</th>
                @foreach ($AdvisorySubject as $item)
                    <th class="text-center">{{$item->subject->subject_code}}</th>
                @endforeach
                <th class="text-center">G.A.</th>
                <th class="text-center">REMARKS</th>
            </tr>
            @endif
            @if($quarter == '1st-2nd' || $quarter == '1st-3rd' || $quarter == '1st-4th')
                <tr>
                    <th colspan="2"></th>
                    @if($quarter == '1st-2nd')        
                        <th class="text-center">First Grading</th>
                        <th class="text-center">Second Grading</th>            
                    @endif
                    @if($quarter =='1st-3rd')
                        <th class="text-center">First Grading</th>
                        <th class="text-center">Second Grading</th>
                        <th class="text-center">Third Grading</th>
                    @endif
                    @if($quarter =='1st-4th')
                        <th class="text-center">First Grading</th>
                        <th class="text-center">Second Grading</th>
                        <th class="text-center">Third Grading</th>
                        <th class="text-center">Fourth Grading</th>
                    @endif
                    <th class="text-center">G.A.</th>
                    <th class="text-center">REMARKS</th>
                </tr>
            @endif
        </thead>
        <tbody>
            
            <tr>
            <td colspan="13">
                <b>Male</b>
            </td>
            </tr>        
            @foreach ($Grade_sheet_males as $key => $item)
                @php 
                    $final;
                    $isEmpty = '0';
                    $sum = 0;
                    $fir = 0;
                    $sec = 0;
                    $thi = 0;
                    $fou = 0;
                    $divisor = $AdvisorySubject->count();
                @endphp
                <tr>
                    <td class="text-center">{{$key+1}}.</td>
                    <td>
                        {{$item->full_name == 'CASAJE, STEVEN JARELL PASALO' ? ucwords(strtolower($item->full_name)) : $item->full_name}}
                    </td>
                    @if($quarter == '1st' || $quarter == '2nd' || $quarter == '3rd' || $quarter == '4th')
                        @foreach ($AdvisorySubject as $key => $sub)
                            <td class="text-center">                       
                                @php 
                                    $sub_grade = $subject_grades
                                        ->where('enrollments_id',$item->id)
                                        ->where('subject_id', $sub->subject_id)
                                        ->first();                       

                                    if($quarter == '1st')
                                    {
                                        $sum += $sub_grade->fir_g;
                                        echo number_format(round($sub_grade->fir_g));
                                    }                                
                                    if($quarter == '2nd')
                                    {
                                        $sum += $sub_grade->sec_g;
                                        echo number_format(round($sub_grade->sec_g));
                                    }                                
                                    if($quarter == '3rd')
                                    {
                                        $sum += $sub_grade->thi_g;
                                        echo number_format(round($sub_grade->thi_g));
                                    }                                
                                    if($quarter == '4th')
                                    {
                                        $sum += $sub_grade->fou_g;
                                        echo number_format(round($sub_grade->fou_g));
                                    }
                                    $final = $sum / $divisor;
                                    if($sub_grade->fir_g == 0 || $sub_grade->sec_g == 0 || $sub_grade->thi_g == 0 || $sub_grade->fou_g == 0)
                                    {
                                        $isEmpty = 'na';
                                    }                                
                                @endphp                        
                            </td>
                        @endforeach
                    @endif
                    @if($quarter == '1st-2nd' || $quarter == '1st-3rd' || $quarter == '1st-4th')
                        @foreach ($AdvisorySubject as $key => $sub)                                         
                            @php 
                                $sub_grade = $subject_grades
                                    ->where('enrollments_id',$item->id)
                                    ->where('subject_id', $sub->subject_id)
                                    ->first();                         

                                $fir += $sub_grade->fir_g;
                                $sec += $sub_grade->sec_g;   
                                $thi += $sub_grade->thi_g;
                                $fou += $sub_grade->fou_g;                               
                                $final_first = $fir / $divisor;
                                $final_sec = $sec / $divisor;
                                $final_thi = $thi / $divisor;
                                $final_fou = $fou / $divisor;

                                if($quarter == '1st-2nd'){
                                    $final = round($final_first + $final_sec) / 2;
                                }
                                if($quarter == '1st-3rd'){
                                    $final = round($final_first + $final_sec + $final_thi) / 3;
                                }
                                if($quarter == '1st-4th'){
                                    $final = round($final_first + $final_sec + $final_thi + $final_fou) / 4;
                                }
                                if($sub_grade->fir_g == 0 || $sub_grade->sec_g == 0)
                                {
                                    $isEmpty = 'na';
                                }
                            @endphp
                        @endforeach
                            <td class="text-center"> 
                                {{number_format(round($final_first))}}
                            </td>
                            <td class="text-center"> 
                                {{number_format(round($final_sec))}}
                            </td>
                        @if($quarter == '1st-3rd')
                            <td class="text-center"> 
                                {{number_format(round($final_thi))}}
                            </td>
                        @endif
                        @if($quarter == '1st-4th')
                            <td class="text-center"> 
                                {{number_format(round($final_thi))}}
                            </td>
                            <td class="text-center"> 
                                {{number_format(round($final_fou))}}
                            </td>
                        @endif
                    @endif
                    
                    <td class="text-center">
                        {{number_format(round($final))}}                
                    </td>
                    <td class="text-center">
                        @if($isEmpty != 'na')
                            @if(round($final) > 74 && round($final) <= 89)
                                Passed
                            @elseif(round($final) >= 90 && round($final) <= 94)
                                with honors
                            @elseif(round($final)>= 95 && round($final) <= 97)
                                with high honors
                            @elseif(round($final) >= 98 && round($final) <= 100)
                                with highest honors
                            @elseif(round($final) < 75)
                                Failed
                            @endif   
                        @endif                 
                    </td>
                </tr>
            @endforeach
            <tr>
            <td colspan="13">
                <b>Female</b>
            </td>
            </tr>
            @foreach ($Grade_sheet_females as $key => $item)
                @php 
                    $final;
                    $isEmpty = '0';
                    $sum = 0;
                    $fir = 0;
                    $sec = 0;
                    $thi = 0;
                    $fou = 0;
                    $divisor = $AdvisorySubject->count();
                @endphp
                <tr>
                    <td class="text-center">{{$key+1}}.</td>
                    <td>
                        {{$item->full_name == 'CASAJE, STEVEN JARELL PASALO' ? ucwords(strtolower($item->full_name)) : $item->full_name}}
                    </td>
                    @if($quarter == '1st' || $quarter == '2nd' || $quarter == '3rd' || $quarter == '4th')
                        @foreach ($AdvisorySubject as $key => $sub)
                            <td class="text-center">                       
                                @php 
                                    $sub_grade = $subject_grades
                                        ->where('enrollments_id',$item->id)
                                        ->where('subject_id', $sub->subject_id)
                                        ->first();                       

                                    if($quarter == '1st')
                                    {
                                        $sum += $sub_grade->fir_g;
                                        echo number_format(round($sub_grade->fir_g));
                                    }                                
                                    if($quarter == '2nd')
                                    {
                                        $sum += $sub_grade->sec_g;
                                        echo number_format(round($sub_grade->sec_g));
                                    }                                
                                    if($quarter == '3rd')
                                    {
                                        $sum += $sub_grade->thi_g;
                                        echo number_format(round($sub_grade->thi_g));
                                    }                                
                                    if($quarter == '4th')
                                    {
                                        $sum += $sub_grade->fou_g;
                                        echo number_format(round($sub_grade->fou_g));
                                    }
                                    $final = $sum / $divisor;
                                    if($sub_grade->fir_g == 0 || $sub_grade->sec_g == 0 || $sub_grade->thi_g == 0 || $sub_grade->fou_g == 0)
                                    {
                                        $isEmpty = 'na';
                                    }                                
                                @endphp                        
                            </td>
                        @endforeach
                    @endif
                    @if($quarter == '1st-2nd' || $quarter == '1st-3rd' || $quarter == '1st-4th')
                        @foreach ($AdvisorySubject as $key => $sub)                                         
                            @php 
                                $sub_grade = $subject_grades
                                    ->where('enrollments_id',$item->id)
                                    ->where('subject_id', $sub->subject_id)
                                    ->first();                         

                                $fir += $sub_grade->fir_g;
                                $sec += $sub_grade->sec_g;   
                                $thi += $sub_grade->thi_g;
                                $fou += $sub_grade->fou_g;                               
                                $final_first = $fir / $divisor;
                                $final_sec = $sec / $divisor;
                                $final_thi = $thi / $divisor;
                                $final_fou = $fou / $divisor;

                                if($quarter == '1st-2nd'){
                                    $final = round($final_first + $final_sec) / 2;
                                }
                                if($quarter == '1st-3rd'){
                                    $final = round($final_first + $final_sec + $final_thi) / 3;
                                }
                                if($quarter == '1st-4th'){
                                    $final = round($final_first + $final_sec + $final_thi + $final_fou) / 4;
                                }
                                if($sub_grade->fir_g == 0 || $sub_grade->sec_g == 0)
                                {
                                    $isEmpty = 'na';
                                }
                            @endphp
                        @endforeach
                            <td class="text-center"> 
                                {{number_format(round($final_first))}}
                            </td>
                            <td class="text-center"> 
                                {{number_format(round($final_sec))}}
                            </td>
                        @if($quarter == '1st-3rd')
                            <td class="text-center"> 
                                {{number_format(round($final_thi))}}
                            </td>
                        @endif
                        @if($quarter == '1st-4th')
                            <td class="text-center"> 
                                {{number_format(round($final_thi))}}
                            </td>
                            <td class="text-center"> 
                                {{number_format(round($final_fou))}}
                            </td>
                        @endif
                    @endif
                    
                    <td class="text-center">
                        {{number_format(round($final))}}                
                    </td>
                    <td class="text-center">
                        @if($isEmpty != 'na')
                            @if(round($final) > 74 && round($final) <= 89)
                                Passed
                            @elseif(round($final) >= 90 && round($final) <= 94)
                                with honors
                            @elseif(round($final)>= 95 && round($final) <= 97)
                                with high honors
                            @elseif(round($final) >= 98 && round($final) <= 100)
                                with highest honors
                            @elseif(round($final) < 75)
                                Failed
                            @endif   
                        @endif                 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>