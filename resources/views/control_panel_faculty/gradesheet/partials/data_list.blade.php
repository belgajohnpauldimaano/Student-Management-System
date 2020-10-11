{{-- <h4>Quarter: <span class="text-red"><i>{{ $quarter }}</i></span></h4> --}}
<h4>Grade &amp; Section: <span class="text-red"><i>{{ $class_detail->grade->grade_level . '-' .$class_detail->grade->section->section }}</i></span></h4>


<table class="table table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Student Name</th>
            @foreach ($AdvisorySubject as $item)
                <th class="text-center">{{$item->subject->subject_code}}</th>
            @endforeach
            <th class="text-center">G.A.</th>
            <th class="text-center">REMARKS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
           <td colspan="12">
               <b>Male</b>
           </td>
        </tr>
        @foreach ($Grade_sheet_males as $key => $item)
            <tr>
                <td class="text-center">{{$key+1}}.</td>
                <td>
                    {{$item->full_name == 'CASAJE, STEVEN JARELL PASALO' ? ucwords(strtolower($item->full_name)) : $item->full_name}}
                </td>

                @php 
                    $final;
                    $isEmpty = '0';
                    $sum = 0; 
                @endphp
                
                @foreach ($AdvisorySubject as $key => $sub)
                    <td class="text-center">                       
                        @php 
                            $sub_grade = $subject_grades
                                ->where('enrollments_id',$item->id)
                                ->where('subject_id', $sub->subject_id)
                                ->first();
                            $divisor = $AdvisorySubject->count();                            
                            $sum += $sub_grade->fir_g;
                            $final = $sum / $divisor;
                            if($sub_grade->fir_g == 0)
                            {
                              $isEmpty = 'na';
                            }
                        @endphp
                        {{number_format(round($sub_grade->fir_g))}}
                    </td>
                @endforeach
                <td class="text-center">
                    {{number_format(round($final))}}                
                </td>
                <td class="text-center">
                    @if($isEmpty != 'na')
                        @if(round($final) >= 75 && round($final) <= 89)
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
           <td colspan="12">
               <b>Female</b>
           </td>
        </tr>
        @foreach ($Grade_sheet_females as $key => $item)
            <tr>
                <td class="text-center">{{$key+1}}.</td>
                <td style="text-transform: capitalize !important">
                    {{$item->full_name == 'CASAJE, STEVEN JARELL PASALO' ? ucwords(strtolower($item->full_name)) : $item->full_name}}
                </td>

                @php 
                    $final;
                    $isEmpty = '0';
                    $sum = 0; 
                @endphp
                
                @foreach ($AdvisorySubject as $key => $sub)
                    <td class="text-center">                       
                        @php 
                            $sub_grade = $subject_grades
                                ->where('enrollments_id',$item->id)
                                ->where('subject_id', $sub->subject_id)
                                ->first();
                            $divisor = $AdvisorySubject->count();                            
                            $sum += $sub_grade->fir_g;
                            $final = $sum / $divisor;
                            if($sub_grade->fir_g == 0)
                            {
                              $isEmpty = 'na';
                            }
                        @endphp
                        {{number_format(round($sub_grade->fir_g))}}
                    </td>
                @endforeach
                <td class="text-center">
                    {{number_format(round($final))}}                
                </td>
                <td class="text-center">
                    @if($isEmpty != 'na')
                        @if(round($final) >= 75 && round($final) <= 89)
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



