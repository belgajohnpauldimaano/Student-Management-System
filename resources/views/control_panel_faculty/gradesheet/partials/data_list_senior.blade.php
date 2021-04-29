<div class="table-responsive table-responsive-sm" style="height: 600px;">
    <table class="table table-sm table-head-fixed table-bordered table-hover text-nowrap">
        <thead style="position: sticky;top: 0">
            @if ($quarter == '1st-2nd' && $sem == '3rd')
                <tr>
                    <th colspan="2"></th>
                    <th class="text-center" colspan="{{$AdvisorySubject->where('sem',1)->count()}}">First Sem</th>
                    <th class="text-center" colspan="{{$AdvisorySubject->where('sem',2)->count()}}">Second Sem</th>                
                    <th colspan="3"></th>
                </tr>
            @endif
        </thead>
        <thead style="position: sticky;top: 0"> 
            @if($quarter == '1st' && $sem == '1st' || $quarter == '3rd' && $sem == '2nd')
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
            
            @if($quarter == '1st-2nd' && $sem == '3rd')
            <tr>
                <th>#</th>
                <th>Student Name</th>
                @foreach ($AdvisorySubject->where('sem',1) as $item)
                    <th class="text-center">{{$item->subject->subject_code}}</th>
                @endforeach
                @forelse ($AdvisorySubject->where('sem',2) as $item)
                    <th class="text-center">{{$item->subject->subject_code}}</th>
                @empty
                    <th class="text-center">No Second Sem yet</th>
                @endforelse        
                <th class="text-center" colspan="2">G.A.</th>
                <th class="text-center">REMARKS</th>
            </tr>
            @endif
            @if($quarter == '2nd' && $sem == '1st' || $quarter == '4th' && $sem == '2nd')
            <tr>
                <th>#</th>
                <th>Student Name</th>
                @foreach ($AdvisorySubject as $item)
                    <th class="text-center" colspan="3">{{$item->subject->subject_code}}</th>
                @endforeach
                <th colspan="2" class="text-center">G.A.</th>
                <th class="text-center">REMARKS</th>
            </tr>
                @if(!$no_second_sem == 'No data found')
                    <tr>
                        <tr>
                            <th colspan="2"></th>
                        @foreach ($AdvisorySubject as $item)
                            <td class="text-center">1st</td>
                            <td class="text-center">2nd</td>
                            <td class="text-center, text-red">Final</td>
                        @endforeach
                        <th colspan="3"></th>
                    </tr>
                @endif
            @endif
            
        </thead>
        <tbody>
            @if($no_second_sem == 'No data found')
                <th class="text-center" 
                    colspan="
                        @if($quarter == '3rd' && $sem == '2nd' )
                            4
                        @elseif($quarter == '4th' && $sem == '2nd')
                            5
                        @endif

                        @if($quarter == '1st' && $sem == '1st')
                            4
                        @endif

                        @if($quarter == '2nd' && $sem == '1st')
                            5
                        @endif
                    ">
                    No Data Found
                </th>
            @else
                <tr class="bg-danger">
                    <td colspan="
                        @if($AdvisorySubject->where('sem',2)->count()=='')
                            @if($quarter == '2nd' && $sem == '1st' || $quarter == '4th' && $sem == '2nd')
                                {{($AdvisorySubject->count() * 3) + 6}}
                            @else
                                {{$AdvisorySubject->count() + 6}}
                            @endif
                            
                        @else
                            @if($quarter == '4th' && $sem == '2nd')
                                {{($AdvisorySubject->count() * 3) + 6}}
                            @else
                                {{$AdvisorySubject->count() + 5}}
                            @endif
                            
                        @endif                    
                    ">
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
                        $final_g;
                        $average = 0;
                        $i = 1;
                        $g_status = 0;
                        $inc = 0;
                        $divisor = $AdvisorySubject->count();
                        $sum_fir=0;
                        $sum_sec=0;
                    @endphp
                    <tr>
                        <td class="text-center">{{$key+1}}.</td>
                        <td>
                            {{$item->full_name == 'CASAJE, STEVEN JARELL PASALO' ? ucwords(strtolower($item->full_name)) : $item->full_name}}
                        </td>
                        @if($quarter == '1st' && $sem == '1st' || $quarter == '3rd' && $sem == '2nd')
                            @foreach ($AdvisorySubject as $key => $sub)
                                <td class="text-center">      
                                    {{-- {{$sub->id}}                  --}}
                                    @php 
                                        $sub_grade = $subject_grades
                                            ->where('enrollments_id',$item->id)
                                            // ->where('subject_id', $sub->subject_id)
                                            ->where('class_subject_details_id', $sub->id)
                                            ->where('status', 1)
                                            ->first();                       

                                        if($quarter == '1st')
                                        {
                                            $sum += $sub_grade['fir_g'];
                                            echo number_format(round($sub_grade['fir_g']));
                                            // echo $sub_grade['class_subject_details_id'];
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
                                        }                                
                                        
                                        $final = $sum / $divisor;                                                               
                                    @endphp                        
                                </td>
                            @endforeach
                        @endif
                                            
                        @if($quarter == '2nd' && $sem == '1st' || $quarter == '4th' && $sem == '2nd')
                                
                                @foreach ($AdvisorySubject as $key => $sub)
                                                        
                                    @php 
                                        $sub_grade = $subject_grades
                                            ->where('enrollments_id',$item->id)
                                            // ->where('subject_id', $sub->subject_id)
                                            ->where('class_subject_details_id', $sub->id)
                                            ->where('status', 1)
                                            ->first();                       

                                        if($quarter == '2nd' && $sem == '1st')
                                        {
                                            // $fir += round($sub_grade['fir_g']);
                                            // $sec += round($sub_grade['sec_g']);
                                            // $final_first = round($fir + $sec);
                                            // $div = $divisor * 2;
                                            // $final = $final_first / $div;
                                            
                                            $final_first = round($sub_grade['fir_g'] + $sub_grade['sec_g']) / 2;                                   
                                            echo '<td class="text-center">'.number_format(round($sub_grade['fir_g'])).'</td>';
                                            echo '<td class="text-center">'.number_format(round($sub_grade['sec_g'])).'</td>';
                                            echo '<td class="text-center text-red">'.number_format(round($final_first)).'</td>';

                                            $average += round($final_first);
                                            $final =  $average / $divisor;

                                            if($sub_grade['fir_g'] < 80)
                                            {
                                                $g_status += 1;
                                            }
                                            if($sub_grade['sec_g'] < 80)
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
                                            
                                            if($sub_grade['sec_g'] == 0.00)
                                            {
                                                $isEmpty = 'na';
                                            } 
                                        }                                
                                                                    
                                        if($quarter == '4th' && $sem == '2nd')
                                        {                                    
                                            // $thi += round($sub_grade['thi_g']);
                                            // $fou += round($sub_grade['fou_g']);
                                            // $final_sec = round($thi + $fou);
                                            // $div = $divisor * 2;
                                            // $final = $final_sec / $div;
                                            
                                            $final_sec = round($sub_grade['thi_g'] + $sub_grade['fou_g']) / 2;
                                            echo '<td class="text-center">'.number_format(round($sub_grade['thi_g'])).'</td>';                                
                                            echo '<td class="text-center">'.number_format(round($sub_grade['fou_g'])).'</td>';
                                            echo '<td class="text-center text-red">'.number_format(round($final_sec)).'</td>';

                                            $average += round($final_sec);
                                            $final =  $average / $divisor;

                                            if($sub_grade['thi_g'] < 80)
                                            {
                                                $g_status += 1;
                                            }
                                            if($sub_grade['fou_g'] < 80)
                                            {
                                                $g_status += 1;
                                            }
                                            if($sub_grade['thi_g'] == 0 )
                                            {
                                                $inc += 1;
                                            }
                                            if($sub_grade['fou_g'] == 0)
                                            {
                                                $inc += 1;
                                            }
                                            
                                            if($sub_grade['fou_g'] == 0.00)
                                            {
                                                $isEmpty = 'na';
                                            }      
                                        }
                                    @endphp
                                @endforeach
                        @endif
                        
                        @if($quarter == '1st-2nd' && $sem == '3rd')
                                @foreach ($AdvisorySubject->where('sem', 1) as $key => $sub)
                                    <td class="text-center">                                                  
                                        @php 
                                            $sub_grade = $subject_grades
                                                ->where('enrollments_id',$item->id)
                                                // ->where('subject_id', $sub->subject_id)
                                                ->where('class_subject_details_id', $sub->id)
                                                ->where('status', 1)
                                                ->first(); 
                                            
                                            $fir += round($sub_grade['fir_g']);
                                            $sec += round($sub_grade['sec_g']);

                                            // $final_first = round($fir) + round($sec);                                            
                                           
                                            $fg = round($sub_grade['fir_g'] + $sub_grade['sec_g']); 
                                            $sum_fir += number_format(round($fg) / 2);
                                            echo $first = number_format(round($fg) / 2);
                                            
                                            if($sub_grade['fir_g'] < 80)
                                            {
                                                $g_status += 1;
                                            }
                                            if($sub_grade['sec_g'] < 80)
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
                                        @endphp  
                                    </td>
                                @endforeach
                               
                                @forelse ($AdvisorySubject->where('sem', 2) as $key => $sub)
                                    <td class="text-center">                                                  
                                        @php 
                                            $sub_grade = $subject_grades
                                                ->where('enrollments_id',$item->id)
                                                ->where('class_subject_details_id', $sub->id)
                                                ->where('status', 1)
                                                ->first(); 

                                            $thi += round($sub_grade['thi_g']);
                                            $fou += round($sub_grade['fou_g']);

                                            try {
                                                $final_sec = round($thi) + round($fou);
                                                $fg = round($sub_grade['thi_g'] + $sub_grade['fou_g']); 
                                                $sum_sec += number_format(round($fg) / 2);
                                                
                                                if($sub_grade['thi_g'] < 80)
                                                {
                                                    $g_status += 1;
                                                }
                                                if($sub_grade['fou_g'] < 80)
                                                {
                                                    $g_status += 1;
                                                }
                                                if($sub_grade['thi_g'] == 0 )
                                                {
                                                    $inc += 1;
                                                }
                                                if($sub_grade['fou_g'] == 0)
                                                {
                                                    $inc += 1;
                                                }
                                                echo $second = number_format(round($fg) / 2);
                                            } catch (\Throwable $th) {
                                                $final_sec = 0;
                                            }
                                        @endphp  
                                    </td> 
                                @empty
                                    <td class="text-center" colspan="{{$AdvisorySubject->where('sem',2)->count()}}">
                                    </td>
                                @endforelse
                                @php
                                    // $div = $divisor * 2;
                                    if($sub_grade['fir_g'] == 0.00 && $sub_grade['sec_g'] == 0.00 && $sub_grade['thi_g'] == 0.00 && $sub_grade['fou_g'] == 0.00)
                                    {
                                        $isEmpty = 'na';
                                    }   
                                    // $final_first = $sum_fir;
                                    // $final_sec  = $sum_sec;
                                    // echo $second.' - ';
                                    try {
                                        $final = (round($sum_fir) + round($sum_sec)) / $divisor;
                                    } catch (\Throwable $th) {
                                        $final = $final_first / $div;
                                    }
                                    
                                @endphp

                        @endif
                        @if($quarter == '2nd' && $sem == '1st' || $quarter == '4th' && $sem == '2nd')
                        <td class="text-center">
                            @php
                                try {
                                    echo round($final, 2);
                                } catch (\Throwable $th) {
                                    $final = '';
                                }
                            @endphp           
                        </td>
                        @endif
                        
                        @if($quarter == '1st-2nd' && $sem == '3rd')
                            <td class="text-center text-green">
                                @php
                                    try {
                                        echo number_format(($final), 2);
                                    } catch (\Throwable $th) {
                                        $final = '';
                                    }
                                @endphp
                            </td>
                        @endif
                        
                        <td class="text-center text-green">
                            @php
                                try {
                                    echo number_format(round($final));
                                } catch (\Throwable $th) {
                                    $final = '';
                                }
                            @endphp
                        </td>
                        
                        <td class="text-center">
                            @if($isEmpty != 'na')
                                {{-- {{ $g_status }} --}}
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
                    <td colspan="
                        @if($AdvisorySubject->where('sem',2)->count()=='')
                            @if($quarter == '2nd' && $sem == '1st' || $quarter == '4th' && $sem == '2nd')
                                {{($AdvisorySubject->count() * 3) + 6}}
                            @else
                                {{$AdvisorySubject->count() + 6}}
                            @endif
                        @else
                            @if($quarter == '4th' && $sem == '2nd')
                                {{($AdvisorySubject->count() * 3) + 6}}
                            @else
                                {{$AdvisorySubject->count() + 5}}
                            @endif
                            
                        @endif                    
                    ">
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
                        $final_g;
                        $average = 0;
                        $i = 1;
                        $g_status = 0;
                        $inc = 0;
                        $divisor = $AdvisorySubject->count();
                        $sum_fir=0;
                        $sum_sec=0;
                    @endphp
                    <tr>
                        <td class="text-center">{{$key+1}}.</td>
                        <td>
                            {{$item->full_name == 'CASAJE, STEVEN JARELL PASALO' ? ucwords(strtolower($item->full_name)) : $item->full_name}}
                        </td>
                        @if($quarter == '1st' && $sem == '1st' || $quarter == '3rd' && $sem == '2nd')
                            @foreach ($AdvisorySubject as $key => $sub)
                                <td class="text-center">      
                                    {{-- {{$sub->id}}                  --}}
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
                                            // echo $sub_grade['class_subject_details_id'];
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
                                        }                                
                                        
                                        $final = $sum / $divisor;                                                               
                                    @endphp                        
                                </td>
                            @endforeach
                        @endif
                                            
                        @if($quarter == '2nd' && $sem == '1st' || $quarter == '4th' && $sem == '2nd')
                                
                                @foreach ($AdvisorySubject as $key => $sub)
                                                        
                                    @php 
                                        $sub_grade = $subject_grades
                                            ->where('enrollments_id',$item->id)
                                            // ->where('subject_id', $sub->subject_id)
                                            ->where('class_subject_details_id', $sub->id)
                                            ->where('status', 1)
                                            ->first();                       

                                        if($quarter == '2nd' && $sem == '1st')
                                        {
                                            // $fir += round($sub_grade['fir_g']);
                                            // $sec += round($sub_grade['sec_g']);
                                            // $final_first = round($fir + $sec);
                                            // $div = $divisor * 2;
                                            // $final = $final_first / $div;
                                            
                                            $final_first = round($sub_grade['fir_g'] + $sub_grade['sec_g']) / 2;                                   
                                            echo '<td class="text-center">'.number_format(round($sub_grade['fir_g'])).'</td>';
                                            echo '<td class="text-center">'.number_format(round($sub_grade['sec_g'])).'</td>';
                                            echo '<td class="text-center text-red">'.number_format(round($final_first)).'</td>';

                                            $average += round($final_first);
                                            $final =  $average / $divisor;

                                            if($sub_grade['fir_g'] < 80)
                                            {
                                                $g_status += 1;
                                            }
                                            if($sub_grade['sec_g'] < 80)
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
                                            
                                            if($sub_grade['sec_g'] == 0.00)
                                            {
                                                $isEmpty = 'na';
                                            } 
                                        }                                
                                                                    
                                        if($quarter == '4th' && $sem == '2nd')
                                        {                                    
                                            // $thi += round($sub_grade['thi_g']);
                                            // $fou += round($sub_grade['fou_g']);
                                            // $final_sec = round($thi + $fou);
                                            // $div = $divisor * 2;
                                            // $final = $final_sec / $div;
                                            
                                            $final_sec = round($sub_grade['thi_g'] + $sub_grade['fou_g']) / 2;
                                            echo '<td class="text-center">'.number_format(round($sub_grade['thi_g'])).'</td>';                                
                                            echo '<td class="text-center">'.number_format(round($sub_grade['fou_g'])).'</td>';
                                            echo '<td class="text-center text-red">'.number_format(round($final_sec)).'</td>';

                                            $average += round($final_sec);
                                            $final =  $average / $divisor;

                                            if($sub_grade['thi_g'] < 80)
                                            {
                                                $g_status += 1;
                                            }
                                            if($sub_grade['fou_g'] < 80)
                                            {
                                                $g_status += 1;
                                            }
                                            if($sub_grade['thi_g'] == 0 )
                                            {
                                                $inc += 1;
                                            }
                                            if($sub_grade['fou_g'] == 0)
                                            {
                                                $inc += 1;
                                            }
                                            
                                            if($sub_grade['fou_g'] == 0.00)
                                            {
                                                $isEmpty = 'na';
                                            }      
                                        }
                                    @endphp
                                @endforeach
                        @endif
                        
                        @if($quarter == '1st-2nd' && $sem == '3rd')
                                @foreach ($AdvisorySubject->where('sem', 1) as $key => $sub)
                                    <td class="text-center">                                                  
                                        @php 
                                            $sub_grade = $subject_grades
                                                ->where('enrollments_id',$item->id)
                                                // ->where('subject_id', $sub->subject_id)
                                                ->where('class_subject_details_id', $sub->id)
                                                ->where('status', 1)
                                                ->first(); 
                                            
                                            $fir += round($sub_grade['fir_g']);
                                            $sec += round($sub_grade['sec_g']);

                                            // $final_first = round($fir) + round($sec);                                            
                                           
                                            $fg = round($sub_grade['fir_g'] + $sub_grade['sec_g']); 
                                            $sum_fir += number_format(round($fg) / 2);
                                            echo $first = number_format(round($fg) / 2);
                                            
                                            if($sub_grade['fir_g'] < 80)
                                            {
                                                $g_status += 1;
                                            }
                                            if($sub_grade['sec_g'] < 80)
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
                                        @endphp  
                                    </td>
                                @endforeach
                               
                                @forelse ($AdvisorySubject->where('sem', 2) as $key => $sub)
                                    <td class="text-center">                                                  
                                        @php 
                                            $sub_grade = $subject_grades
                                                ->where('enrollments_id',$item->id)
                                                // ->where('subject_id', $sub->subject_id)
                                                ->where('class_subject_details_id', $sub->id)
                                                ->where('status', 1)
                                                ->first(); 

                                            $thi += round($sub_grade['thi_g']);
                                            $fou += round($sub_grade['fou_g']);

                                            try {
                                                $final_sec = round($thi) + round($fou);
                                                $fg = round($sub_grade['thi_g'] + $sub_grade['fou_g']); 
                                                $sum_sec += number_format(round($fg) / 2);
                                                
                                                if($sub_grade['thi_g'] < 80)
                                                {
                                                    $g_status += 1;
                                                }
                                                if($sub_grade['fou_g'] < 80)
                                                {
                                                    $g_status += 1;
                                                }
                                                if($sub_grade['thi_g'] == 0 )
                                                {
                                                    $inc += 1;
                                                }
                                                if($sub_grade['fou_g'] == 0)
                                                {
                                                    $inc += 1;
                                                }
                                                echo $second = number_format(round($fg) / 2);
                                            } catch (\Throwable $th) {
                                                $final_sec = 0;
                                            }
                                        @endphp  
                                    </td> 
                                @empty
                                    <td class="text-center" colspan="{{$AdvisorySubject->where('sem',2)->count()}}">
                                    </td>
                                @endforelse
                                @php
                                    // $div = $divisor * 2;
                                    if($sub_grade['fir_g'] == 0.00 && $sub_grade['sec_g'] == 0.00 && $sub_grade['thi_g'] == 0.00 && $sub_grade['fou_g'] == 0.00)
                                    {
                                        $isEmpty = 'na';
                                    }   
                                    // $final_first = $sum_fir;
                                    // $final_sec  = $sum_sec;
                                    // echo $second.' - ';
                                    try {
                                        $final = (round($sum_fir) + round($sum_sec)) / $divisor;
                                    } catch (\Throwable $th) {
                                        $final = $final_first / $div;
                                    }
                                    
                                @endphp

                        @endif
                        @if($quarter == '2nd' && $sem == '1st' || $quarter == '4th' && $sem == '2nd')
                        <td class="text-center">
                            @php
                                try {
                                    echo round($final, 2);
                                } catch (\Throwable $th) {
                                    $final = '';
                                }
                            @endphp           
                        </td>
                        @endif
                        @if($quarter == '1st-2nd' && $sem == '3rd')
                            <td class="text-center text-green">
                                @php
                                    try {
                                        echo number_format(($final), 2);
                                    } catch (\Throwable $th) {
                                        $final = '';
                                    }
                                @endphp
                            </td>
                        @endif
                        <td class="text-center text-green">
                            @php
                                try {
                                    echo number_format(round($final));
                                } catch (\Throwable $th) {
                                    $final = '';
                                }
                            @endphp
                        </td>
                        
                        <td class="text-center">
                            @if($isEmpty != 'na')
                                {{-- {{ $g_status }} --}}
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
            @endif
            
        </tbody>
    </table>
</div>