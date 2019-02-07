@extends('control_panel.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Encode Class Students
@endsection

@section ('content')
    <div class="box">
        
                {{--  <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="padding-right:0">
                    <input type="text" class="form-control" name="search">
                </div>  --}}                      

               
                    <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    <div class="box-body">
                        <div class="js-data-container1">
                                <button class="btn btn-flat btn-danger pull-right" id="js-btn_print" data-id=""><i class="fa fa-file-pdf"></i> Print</button>
                                <table class="table no-margin table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px">#</th>
                                                <th colspan="13" style="text-align:left">Student Name</th>        
                                                                            
                                                
                                            </tr>
                                        </thead>
                                        <tbody>      
                                                                       
                                            <tr>
                                                <td colspan="16">
                                                    <b>Male</b> 
                                                </td>
                                            </tr>

                                            @foreach ($EnrollmentMale as $key => $data) 
                                            <tr>
                                                <td>{{ $key + 1 }}.</td>
                                                <td><b style="font-size: 15px">{{ $data->student_name }}</b>
                                                    <br/>
                                                    <br/>
                                                        <table class="table">
                                                                <tr>
                                                                   
                                                                    {{-- {{ $data->attendance }} --}}
                                                                      
                                                    
                                                                   <?php
                                                                   $table_header = [
                                                                        ['key' => 'Jun',],
                                                                        ['key' => 'Jul',],
                                                                        ['key' => 'Aug',],
                                                                        ['key' => 'Sep',],
                                                                        ['key' => 'Oct',],
                                                                        ['key' => 'Nov',],
                                                                        ['key' => 'Dec',],
                                                                        ['key' => 'Jan',],
                                                                        ['key' => 'Feb',],
                                                                        ['key' => 'Mar',],
                                                                        ['key' => 'Apr',],
                                                                        ['key' => 'total',],
                                                                    ];
                                                                    $attendance_data = json_decode(json_encode([
                                                                        'days_of_school' => [
                                                                            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                                        ],
                                                                        'days_present' => [
                                                                            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                                        ],
                                                                        'days_absent' => [
                                                                            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                                        ],
                                                                        'times_tardy' => [
                                                                            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 
                                                                        ]
                                                                    ]));
                                                                    
                                                                    $attendance_data = json_decode($data->attendance);
                                                                      

                                                                    $student_attendance = [
                                                                        // 'student_name'      => $EnrollmentMale[0]->student_name,
                                                                        'attendance_data'   => $attendance_data,
                                                                        'table_header'      => $table_header,
                                                                        'days_of_school_total' => array_sum($attendance_data->days_of_school),
                                                                        'days_present_total' => array_sum($attendance_data->days_present),
                                                                        'days_absent_total' => array_sum($attendance_data->days_absent),
                                                                        'times_tardy_total' => array_sum($attendance_data->times_tardy),
                                                                    ];
                                                                    ?>
                                                                    
                                                                    
                                                                   <?php ?>

                                                                    <th>
                                                                        TITLE
                                                                    </th>
                                                                        @foreach ($student_attendance['table_header'] as $data)
                                                                                <th>{{ $data['key'] }}</th> 
                                                                        {{-- / {{ json_encode($data) }}  --}}
                                                                        @endforeach
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        Days of School
                                                                    </th>
                                                                    @foreach ($student_attendance['attendance_data']->days_of_school as $key => $data)
                                                                        <th style="width:7%">
                                                                            <input type="text" class="form-control days_of_school"  min="0" max="30" id="days_of_school{{ $key }}" name="days_of_school[]"  value="{{ $data }}" />
                                                                        </th>
                                                                    @endforeach
                                                                    <th class="days_of_school_total">
                                                                        {{ $student_attendance['days_of_school_total'] }}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        Days Present
                                                                    </th>
                                                                    @foreach ($student_attendance['attendance_data']->days_present as $key => $data)
                                                                        <th style="width:7%">
                                                                            <input type="text" class="form-control days_present" min="0" max="30" id="days_present{{ $key }}" name="days_present[]" value="{{ $data }}" />    
                                                                        </th>
                                                                    @endforeach
                                                                    <th class="days_present_total">
                                                                        {{ $student_attendance['days_present_total'] }}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        Days Absent
                                                                    </th>
                                                                    @foreach ($student_attendance['attendance_data']->days_absent as $key => $data)
                                                                        <th style="width:7%">
                                                                            <input type="text" class="form-control days_absent" min="0" max="30" id="days_present{{ $key }}" name="days_absent[]" value="{{ $data }}" />    
                                                                        </th>
                                                                    @endforeach
                                                                    <th class="days_absent_total">
                                                                        {{ $student_attendance['days_absent_total'] }}
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        Times Tardy
                                                                    </th>
                                                                    @foreach ($student_attendance['attendance_data']->times_tardy as $key => $data)
                                                                        <th style="width:7%">
                                                                            <input type="text" class="form-control times_tardy" min="0" max="30" id="days_present{{ $key }}" name="times_tardy[]" value="{{ $data }}" />    
                                                                        </th>
                                                                    @endforeach
                                                                    <th class="times_tardy_total">
                                                                        {{ $student_attendance['times_tardy_total'] }}
                                                                    </th>
                                                                </tr>
                                                            </table>
                                        
                                                        
                                                            {{-- <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal">Close</button> --}}
                                                            <button type="submit" class="btn btn-primary btn-flat pull-right">Save</button>
                                                        </div>
                                                </td>
                                            </tr>
                                            @endforeach
            
                                            <tr>
                                                <td colspan="16">
                                                    <b>Female</b>
                                                </td>
                                            </tr>
            
                                            
                                            <tr>
            
                                            </tr>                                    
                                                
                                            
                                </table>
                       
                        </div>
                    </div>
                    
                
                
            
            
            
        </div>       
                
                
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script>
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();

            var quarter_grades = $('#quarter_grades').val();
                    
                    if (quarter_grades == '1st') 
                    {
                       {{-- alert('1st'); --}}
                        $.ajax({
                            url : "{{ route('faculty.MyAdvisoryClass.firstquarter') }}",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                        }
                        
                        });
                        return;
                    }
                    else if(quarter_grades == '2nd')
                    {
                        {{-- alert('2nd'); --}}
                        $.ajax({
                            url : "{{ route('faculty.MyAdvisoryClass.secondquarter') }}",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                        }
                        });
                        return;
                    }
                    else if(quarter_grades == '3rd')
                    {
                        {{-- alert('3rd'); --}}
                        $.ajax({
                            url : "{{ route('faculty.MyAdvisoryClass.thirdquarter') }}",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                        }
                        });
                        return;
                    }
                    else if(quarter_grades == '4th')
                    {
                        {{-- alert('4th'); --}}
                        $.ajax({
                            url : "{{ route('faculty.MyAdvisoryClass.fourthquarter') }}",
                            type : 'POST',
                            data : formData,
                            processData : false,
                            contentType : false,
                            success     : function (res) {
                                loader_overlay();
                                $('.js-data-container').html(res);
                        }
                        });
                        return;
                    }
        }

        // var page = 1;
        function fetch_data1() {
            var formData = new FormData($('#js-form_filter')[0]);
            formData.append('page', page);
            loader_overlay();
            
            var semester_grades = $('#semester_grades').val();
            var quarter_ = $("#quarter_").val();
                    
                    if (semester_grades == '1st') 
                    {
                       
                        if (quarter_ == '1st') 
                        {
                            // alert('1st'); 
                            $.ajax({
                                url : "{{ route('faculty.MyAdvisoryClass.first_sem_1quarter') }}",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }
                        else
                        {
                            // alert('2nd');
                            $.ajax({
                                url : "{{ route('faculty.MyAdvisoryClass.first_sem_2quarter') }}",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }        
                    
                    }
                    else if(semester_grades == '2nd')
                    {
                        // alert('2nd');
                        
                        if (quarter_ == '1st') 
                        {
                            // alert('1st'); 
                            $.ajax({
                                url : "{{ route('faculty.MyAdvisoryClass.first_sem_3quarter') }}",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }
                        else
                        {
                            // alert('2nd');
                            $.ajax({
                                url : "{{ route('faculty.MyAdvisoryClass.first_sem_4quarter') }}",
                                type : 'POST',
                                data : formData,
                                processData : false,
                                contentType : false,
                                success     : function (res)
                                {
                                    loader_overlay();
                                    $('.js-data-container1').html(res);
                                }                        
                            });
                            return;
                        }        
                    }
                   
        }
        $(function(){
            
            $('body').on('change', '#search_sy1', function () {
                $.ajax({
                    url : "{{ route('faculty.MyAdvisoryClass.list_class_subject_details') }}",
                    type : 'POST',
                    {{--  dataType    : 'JSON',  --}}
                    data        : {_token: '{{ csrf_token() }}', search_sy1: $('#search_sy1').val()},
                    success     : function (res) {

                        $('#semester_grades').html(res);
                    }
                })
            })

            $('body').on('change', '#semester_grades', function () {
                $.ajax({
                    url : "{{ route('faculty.MyAdvisoryClass.list_quarter-sem-details') }}",
                    type : 'POST',
                    {{--  dataType    : 'JSON',  --}}
                    data        : {_token: '{{ csrf_token() }}', semester_grades: $('#semester_grades').val()},
                    success     : function (res) {

                        $('#quarter_').html(res);
                    }
                })
            })

            $('body').on('change', '#search_sy', function () {
                $.ajax({
                    url : "{{ route('faculty.MyAdvisoryClass.list_quarter') }}",
                    type : 'POST',
                    {{--  dataType    : 'JSON',  --}}
                    data        : {_token: '{{ csrf_token() }}', search_sy: $('#search_sy').val()},
                    success     : function (res) {

                        $('#quarter_grades').html(res);
                    }
                })
            })

            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                if (!$('#search_sy').val()) {
                    alert('Please select a School year!');
                    return;
                }
                {{--  fetch_data();  --}}
            });
            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                if (!$('#quarter_grades').val()) {
                    alert('Please select Class Quarter!');
                    return;
                }
                fetch_data();
            });
            //2nd form
            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#search_sy1').val()) {
                    alert('Please select School year!');
                    return;
                }
                {{--  fetch_data1();  --}}
            });

            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#semester_grades').val()) {
                    alert('Please select Semester!');
                    return;
                }
                // fetch_data1();
            });

            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#quarter_').val()) {
                    alert('Please select Class Quarter!');
                    return;
                }
                fetch_data1();
            });

            // $('body').on('click', '.pagination a', function (e) {
            //     e.preventDefault();
            //     page = $(this).attr('href').split('=')[1];
            //     fetch_data();
            // });
        });

        $('body').on('click', '#js-btn_print', function (e) {
            e.preventDefault()
            const quarter_grades = $('#quarter_grades').val();
          
            const search_class_subject = $('#search_class_subject').val()
            const search_sy = $('#search_sy').val()
            const search_sy1 = $('#search_sy1').val();
            const semester_grades = $('#semester_grades').val()
            const quarter_ = $('#quarter_').val()

                   
                    
                    if (quarter_grades == '1st') 
                    {
                       {{--  alert('1st');  --}}
                       window.open("{{ route('faculty.MyAdvisoryClass.print_first_quarter') }}?search_class_subject="+search_class_subject+'&search_sy='+search_sy, '', 'height=800,width=800')
                         
                       
                        {{--  return;  --}}
                    }
                    else if(quarter_grades == '2nd')
                    {
                        {{--  alert('2nd');  --}}
                        window.open("{{ route('faculty.MyAdvisoryClass.print_second_quarter') }}?search_class_subject="+search_class_subject+'&search_sy='+search_sy, '', 'height=800,width=800')
                         
                        
                        {{--  return;  --}}
                    }
                    else if(quarter_grades == '3rd')
                    {
                        {{--  alert('3rd');  --}}
                        window.open("{{ route('faculty.MyAdvisoryClass.print_third_quarter') }}?search_class_subject="+search_class_subject+'&search_sy='+search_sy, '', 'height=800,width=800')
                         
                        {{--  return;  --}}
                    }
                    else if(quarter_grades == '4th')
                    {
                        {{--  alert('4th');  --}}
                        window.open("{{ route('faculty.MyAdvisoryClass.print_fourth_quarter') }}?search_class_subject="+search_class_subject+'&search_sy='+search_sy, '', 'height=800,width=800')
                         
                        {{--  return;  --}}
                    }

                    if(semester_grades == '1st')
                    {
                        if(quarter_ == '1st')
                        {
                            // alert('1st');
                            window.open("{{ route('faculty.MyAdvisoryClass.print_firstSem_firstq') }}?search_sy1="+search_sy1, '', 'height=800,width=800')                       
                        }
                        else
                        {
                            window.open("{{ route('faculty.MyAdvisoryClass.print_firstSem_secondq') }}?search_sy1="+search_sy1, '', 'height=800,width=800') 
                        }
                    }
                    else
                    {
                        if(quarter_ == '1st')
                        {
                            window.open("{{ route('faculty.MyAdvisoryClass.print_secondSem_firstq') }}?search_sy1="+search_sy1, '', 'height=800,width=800') 
                        }
                        else
                        {
                            window.open("{{ route('faculty.MyAdvisoryClass.print_secondSem_secondq') }}?search_sy1="+search_sy1, '', 'height=800,width=800') 
                        }
                    }
            
              });
       
        
    </script>
@endsection