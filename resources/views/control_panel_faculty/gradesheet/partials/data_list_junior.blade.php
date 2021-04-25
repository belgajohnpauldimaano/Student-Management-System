<div class="table-responsive table-responsive-sm" style="height: 600px;">
    <table class="table table-sm table-head-fixed table-bordered table-hover text-nowrap">
        <thead style="position: sticky;top: 0"> 
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
            @if($quarter == 'average')
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    @foreach ($AdvisorySubject as $item)
                        <th class="text-center" colspan="5">
                            {{$item->subject->subject_code}}
                        </th>
                    @endforeach
                    <th class="text-center" colspan="2">G.A.</th>
                    <th class="text-center">REMARKS</th>
                </tr>
                <tr>
                    <th colspan="2"></th>
                    @foreach ($AdvisorySubject as $item)
                        <th>1st</th>
                        <th>2nd</th>
                        <th>3rd</th>
                        <th>4th</th>
                        <th class="text-red">AVE</th>
                    @endforeach
                    <th class="text-center" colspan="3"></th>
                </tr>
            @endif
        </thead>
        <tbody>            
            <tr class="bg-danger">
                @if($quarter == 'average')
                    <td colspan="{{ (($AdvisorySubject->count() * 5) + 5) }}">
                        <b>Male</b>
                    </td>
                @else
                    <td colspan="13">
                        <b>Male</b>
                    </td>
                @endif
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
                    $empty = 0;
                    $divisor = $AdvisorySubject->count();
                    $g_status = 0;
                    $inc = 0;
                    $average = 0;
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
                                        ->where('class_subject_details_id', $sub->id)
                                        ->where('status', 1)
                                        ->first();                      

                                    if($quarter == '1st')
                                    {
                                        $sum += $sub_grade['fir_g'];
                                        echo number_format(round($sub_grade['fir_g']));
                                        
                                        if($sub_grade['fir_g'] < 80)
                                        {
                                            $g_status += 1;
                                        }

                                        if($sub_grade['fir_g'] == 0)
                                        {
                                            $inc += 1;
                                        }

                                        if($sub_grade['fir_g'] == 0.00)
                                        {
                                            $isEmpty = 'na';                                        
                                        }
                                        else
                                        {
                                            $empty += 1;                                            
                                            if($empty == 9)
                                            {
                                                $isEmpty = '0';
                                            }
                                        }
                                    }                                
                                    if($quarter == '2nd')
                                    {
                                        $sum += $sub_grade['sec_g'];
                                        echo number_format(round($sub_grade['sec_g']));

                                        if($sub_grade['sec_g'] < 80)
                                        {
                                            $g_status += 1;
                                        }

                                        if($sub_grade['sec_g'] == 0)
                                        {
                                            $inc += 1;
                                        }

                                        if($sub_grade['sec_g'] == 0.00)
                                        {
                                            $isEmpty = 'na';         
                                        }
                                        else
                                        {
                                            $empty += 1;                                            
                                            if($empty == 9)
                                            {
                                                $isEmpty = '0';
                                            }
                                        }
                                    }                                
                                    if($quarter == '3rd')
                                    {
                                        $sum += $sub_grade['thi_g'];
                                        echo number_format(round($sub_grade['thi_g']));

                                        if($sub_grade['thi_g'] < 80)
                                        {
                                            $g_status += 1;
                                        }

                                        if($sub_grade['thi_g'] == 0)
                                        {
                                            $inc += 1;
                                        }

                                        if($sub_grade['thi_g'] == 0.00)
                                        {
                                            $isEmpty = 'na';         
                                        }
                                        else
                                        {
                                            $empty += 1;                                            
                                            if($empty == 9)
                                            {
                                                $isEmpty = '0';
                                            }
                                        }
                                    }                                
                                    if($quarter == '4th')
                                    {
                                        $sum += $sub_grade['fou_g'];
                                        echo number_format(round($sub_grade['fou_g']));

                                        if($sub_grade['fou_g'] < 80)
                                        {
                                            $g_status += 1;
                                        }

                                        if($sub_grade['fou_g'] == 0)
                                        {
                                            $inc += 1;
                                        }

                                        if($sub_grade['fou_g'] == 0.00)
                                        {
                                            $isEmpty = 'na';         
                                        }
                                        else
                                        {
                                            $empty += 1;                                            
                                            if($empty == 9)
                                            {
                                                $isEmpty = '0';
                                            }
                                        }
                                    }
                                    $final = $sum / $divisor;                                                                
                                @endphp
                            </td>
                        @endforeach
                    @endif
                    @if($quarter == '1st-2nd' || $quarter == '1st-3rd' || $quarter == '1st-4th')
                        @foreach ($AdvisorySubject as $key => $sub)                                         
                            @php 
                                $sub_grade = $subject_grades
                                    ->where('enrollments_id',$item->id)
                                    // ->where('subject_id', $sub->subject_id)
                                    ->where('class_subject_details_id', $sub->id)
                                    ->where('status', 1)
                                    ->first();                          

                                $fir += $sub_grade['fir_g'];
                                $sec += $sub_grade['sec_g'];   
                                $thi += $sub_grade['thi_g'];
                                $fou += $sub_grade['fou_g'];
                                
                                if($sub_grade['fir_g'] < 80 && $sub_grade['sec_g'] < 80 && $sub_grade['thi_g'] < 80 && $sub_grade['fou_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                if($sub_grade['fir_g'] == 0 )
                                {
                                    $inc += 1;
                                }
                                if($sub_grade['sec_g'] == 0)
                                {
                                    $inc += 1;
                                }
                                if($sub_grade['thi_g'] == 0)
                                {
                                    $inc += 1;
                                }
                                if($sub_grade['fou_g'] == 0)
                                {
                                    $inc += 1;
                                }
                                
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
                                if($sub_grade['fir_g'] == 0 || $sub_grade['sec_g'] == 0)
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
                    @if($quarter == 'average')
                        @foreach ($AdvisorySubject as $key => $sub)
                            @php 
                                $sub_grade = $subject_grades
                                   ->where('enrollments_id',$item->id)
                                   ->where('class_subject_details_id', $sub->id)
                                   ->where('status', 1)
                                   ->first();

                                if($sub_grade['fir_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                if($sub_grade['sec_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                if($sub_grade['thi_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                if($sub_grade['fou_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                $sum += $sub_grade['fir_g'];
                                echo '<td class="text-center">'.number_format(round($sub_grade['fir_g'])).'</td>';

                                $sum += $sub_grade['sec_g'];
                                echo '<td class="text-center">'.number_format(round($sub_grade['sec_g'])).'</td>';

                                $sum += $sub_grade['thi_g'];
                                echo '<td class="text-center">'.number_format(round($sub_grade['thi_g'])).'</td>';

                                $sum += $sub_grade['fou_g'];
                                echo '<td class="text-center">'.number_format(round($sub_grade['fou_g'])).'</td>';

                                $total = round($sub_grade['fir_g'] + $sub_grade['sec_g'] + $sub_grade['thi_g'] + $sub_grade['fou_g']) / 4; 

                                echo '<td class="text-center text-red">'.number_format(round($total)).'</td>';

                                $average += round($total);
                                $final = $average / $divisor;

                            @endphp                        
                        @endforeach
                    @endif

                    
                    @if($quarter == 'average')
                    <td class="text-center">
                        {{number_format($final, 2)}}
                    </td>
                    @endif
                    <td class="text-center text-red">
                        {{number_format(round($final))}}                
                    </td>
                    <td class="text-center">
                        @if($isEmpty != 'na')
                            @if(round($final) > 74 && round($final) <= 89)
                                Passed
                            @elseif(round($final) >= 90 && round($final) <= 94)
                                @if($g_status > 0)
                                    Passed
                                @else
                                    <span class="text-green">with honors</span>
                                @endif
                            @elseif(round($final)>= 95 && round($final) <= 97)
                                @if($g_status > 0)
                                    Passed
                                @else
                                    <span class="text-green">with high honors</span>
                                @endif
                            @elseif(round($final) >= 98 && round($final) <= 100)
                                @if($g_status > 0)
                                    Passed
                                @else
                                    <span class="text-green">with highest honors</span>
                                @endif
                            @elseif(round($final) < 75)                                    
                                <span class="text-red">Failed</span>
                            @endif
                        @else
                            <span class="text-red">
                                {{ $inc > 0 ? 'INC' : '' }}
                            </span>        
                        @endif                             
                    </td>
                </tr>
            @endforeach
            <tr class="bg-yellow">
                @if($quarter == 'average')
                    <td colspan="{{ (($AdvisorySubject->count() * 5) + 5) }}">
                        <b>Female</b>
                    </td>
                @else
                    <td colspan="13">
                        <b>Female</b>
                    </td>
                @endif
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
                    $empty = 0;
                    $divisor = $AdvisorySubject->count();
                    $g_status = 0;
                    $inc = 0;
                    $average = 0;
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
                                        ->where('class_subject_details_id', $sub->id)
                                        ->where('status', 1)
                                        ->first();                      

                                    if($quarter == '1st')
                                    {
                                        $sum += $sub_grade['fir_g'];
                                        echo number_format(round($sub_grade['fir_g']));
                                        
                                        if($sub_grade['fir_g'] < 80)
                                        {
                                            $g_status += 1;
                                        }

                                        if($sub_grade['fir_g'] == 0)
                                        {
                                            $inc += 1;
                                        }

                                        if($sub_grade['fir_g'] == 0.00)
                                        {
                                            $isEmpty = 'na';                                        
                                        }
                                        else
                                        {
                                            $empty += 1;                                            
                                            if($empty == 9)
                                            {
                                                $isEmpty = '0';
                                            }
                                        }
                                    }                                
                                    if($quarter == '2nd')
                                    {
                                        $sum += $sub_grade['sec_g'];
                                        echo number_format(round($sub_grade['sec_g']));

                                        if($sub_grade['sec_g'] < 80)
                                        {
                                            $g_status += 1;
                                        }

                                        if($sub_grade['sec_g'] == 0)
                                        {
                                            $inc += 1;
                                        }

                                        if($sub_grade['sec_g'] == 0.00)
                                        {
                                            $isEmpty = 'na';         
                                        }
                                        else
                                        {
                                            $empty += 1;                                            
                                            if($empty == 9)
                                            {
                                                $isEmpty = '0';
                                            }
                                        }
                                    }                                
                                    if($quarter == '3rd')
                                    {
                                        $sum += $sub_grade['thi_g'];
                                        echo number_format(round($sub_grade['thi_g']));

                                        if($sub_grade['thi_g'] < 80)
                                        {
                                            $g_status += 1;
                                        }

                                        if($sub_grade['thi_g'] == 0)
                                        {
                                            $inc += 1;
                                        }

                                        if($sub_grade['thi_g'] == 0.00)
                                        {
                                            $isEmpty = 'na';         
                                        }
                                        else
                                        {
                                            $empty += 1;                                            
                                            if($empty == 9)
                                            {
                                                $isEmpty = '0';
                                            }
                                        }
                                    }                                
                                    if($quarter == '4th')
                                    {
                                        $sum += $sub_grade['fou_g'];
                                        echo number_format(round($sub_grade['fou_g']));

                                        if($sub_grade['fou_g'] < 80)
                                        {
                                            $g_status += 1;
                                        }

                                        if($sub_grade['fou_g'] == 0)
                                        {
                                            $inc += 1;
                                        }

                                        if($sub_grade['fou_g'] == 0.00)
                                        {
                                            $isEmpty = 'na';         
                                        }
                                        else
                                        {
                                            $empty += 1;                                            
                                            if($empty == 9)
                                            {
                                                $isEmpty = '0';
                                            }
                                        }
                                    }
                                    $final = $sum / $divisor;                                                                
                                @endphp
                            </td>
                        @endforeach
                    @endif
                    @if($quarter == '1st-2nd' || $quarter == '1st-3rd' || $quarter == '1st-4th')
                        @foreach ($AdvisorySubject as $key => $sub)                                         
                            @php 
                                $sub_grade = $subject_grades
                                    ->where('enrollments_id',$item->id)
                                    // ->where('subject_id', $sub->subject_id)
                                    ->where('class_subject_details_id', $sub->id)
                                    ->where('status', 1)
                                    ->first();                          

                                $fir += $sub_grade['fir_g'];
                                $sec += $sub_grade['sec_g'];   
                                $thi += $sub_grade['thi_g'];
                                $fou += $sub_grade['fou_g'];
                                
                                if($sub_grade['fir_g'] < 80 && $sub_grade['sec_g'] < 80 && $sub_grade['thi_g'] < 80 && $sub_grade['fou_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                if($sub_grade['fir_g'] == 0 )
                                {
                                    $inc += 1;
                                }
                                if($sub_grade['sec_g'] == 0)
                                {
                                    $inc += 1;
                                }
                                if($sub_grade['thi_g'] == 0)
                                {
                                    $inc += 1;
                                }
                                if($sub_grade['fou_g'] == 0)
                                {
                                    $inc += 1;
                                }
                                
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
                                if($sub_grade['fir_g'] == 0 || $sub_grade['sec_g'] == 0)
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
                    @if($quarter == 'average')
                        @foreach ($AdvisorySubject as $key => $sub)
                            @php 
                                $sub_grade = $subject_grades
                                   ->where('enrollments_id',$item->id)
                                   ->where('class_subject_details_id', $sub->id)
                                   ->where('status', 1)
                                   ->first();

                                if($sub_grade['fir_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                if($sub_grade['sec_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                if($sub_grade['thi_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                if($sub_grade['fou_g'] < 80)
                                {
                                    $g_status += 1;
                                }

                                $sum += $sub_grade['fir_g'];
                                echo '<td class="text-center">'.number_format(round($sub_grade['fir_g'])).'</td>';

                                $sum += $sub_grade['sec_g'];
                                echo '<td class="text-center">'.number_format(round($sub_grade['sec_g'])).'</td>';

                                $sum += $sub_grade['thi_g'];
                                echo '<td class="text-center">'.number_format(round($sub_grade['thi_g'])).'</td>';

                                $sum += $sub_grade['fou_g'];
                                echo '<td class="text-center">'.number_format(round($sub_grade['fou_g'])).'</td>';

                                $total = round($sub_grade['fir_g'] + $sub_grade['sec_g'] + $sub_grade['thi_g'] + $sub_grade['fou_g']) / 4; 

                                echo '<td class="text-center text-red">'.number_format(round($total)).'</td>';

                                $average += round($total);
                                $final = $average / $divisor;

                            @endphp                        
                        @endforeach
                    @endif

                    
                    @if($quarter == 'average')
                    <td class="text-center">
                        {{number_format($final, 2)}}
                    </td>
                    @endif
                    <td class="text-center text-red">
                        {{number_format(round($final))}}                
                    </td>
                    <td class="text-center">
                        @if($isEmpty != 'na')
                            @if(round($final) > 74 && round($final) <= 89)
                                Passed
                            @elseif(round($final) >= 90 && round($final) <= 94)
                                @if($g_status > 0)
                                    Passed
                                @else
                                    <span class="text-green">with honors</span>
                                @endif
                            @elseif(round($final)>= 95 && round($final) <= 97)
                                @if($g_status > 0)
                                    Passed
                                @else
                                    <span class="text-green">with high honors</span>
                                @endif
                            @elseif(round($final) >= 98 && round($final) <= 100)
                                @if($g_status > 0)
                                    Passed
                                @else
                                    <span class="text-green">with highest honors</span>
                                @endif
                            @elseif(round($final) < 75)                                    
                                <span class="text-red">Failed</span>
                            @endif
                        @else
                            <span class="text-red">
                                {{ $inc > 0 ? 'INC' : '' }}
                            </span>        
                        @endif                             
                    </td>
                </tr>
            @endforeach
            
            
        </tbody>
    </table>
</div>