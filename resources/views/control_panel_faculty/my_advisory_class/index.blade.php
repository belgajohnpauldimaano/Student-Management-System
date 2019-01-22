@extends('control_panel.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    My advisory Class Grade Sheet
@endsection

@section ('content')
    <div class="box">
        
                {{--  <div id="js-form_search" class="form-group col-sm-12 col-md-3" style="padding-right:0">
                    <input type="text" class="form-control" name="search">
                </div>  --}}                      

                @if($GradeLevel->grade_level  == 11 ||  $GradeLevel->grade_level  == 12)
                    <div class="box-header with-border">
                        <h3 class="box-title">Filter</h3>
                            <form id="js-form_filter">
                                    {{ csrf_field() }}

                                        <div class="form-group col-sm-12 col-md-3" style="padding-right:0">
                                            <select name="search_sy1" id="search_sy1" class="form-control">
                                                <option value="">Select SY</option>
                                                @foreach ($SchoolYear as $data)
                                                    <option value="{{ $data->id }}">{{ $data->school_year }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        &nbsp;
                                        <div class="form-group col-sm-12 col-md-4" style="padding-right:0">
                                            <select name="semester_grades" id="semester_grades" class="form-control">                            
                                                <option value="">Select Semester</option>                      
                                            </select>
                                        </div>                
                                        &nbsp;
                                        <div class="form-group col-sm-12 col-md-4" style="padding-right:0">
                                            <select name="quarter_" id="quarter_" class="form-control">
                                                <option value="">Select Class Quarter</option>
                                            </select>
                                        </div>                
                                    &nbsp;

                                    <button type="submit" class="btn btn-flat btn-success">Search</button>
                                {{--  <button type="button" class="pull-right btn btn-flat btn-danger btn-sm" id="js-button-add"><i class="fa fa-plus"></i> Add</button>  --}}
                            </form>
                    </div>
                    <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    <div class="box-body">
                        <div class="js-data-container1">
                            {{-- @include('control_panel_faculty.student_grade_sheet_details.partials.data_list')  --}}
                        </div>
                    </div>
                    
                @else

                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                    <form id="js-form_search">
                        {{ csrf_field() }}
                        <div class="form-group col-sm-12 col-md-3" style="padding-right:0">
                            <select name="search_sy" id="search_sy" class="form-control">
                                <option value="">Select SY</option>
                                @foreach ($SchoolYear as $data)
                                    <option value="{{ $data->id }}">{{ $data->school_year }}</option>
                                @endforeach
                            </select>
                        </div> 
                        &nbsp;   

                        <div class="form-group col-sm-12 col-md-4" style="padding-right:0">
                            <select name="quarter_grades" id="quarter_grades" class="form-control">
                                <option value="">Select Class Quarter</option>                                
                            </select>
                        </div>                
                        &nbsp;

                    <button type="submit" class="btn btn-flat btn-success">Search</button>
                {{--  <button type="button" class="pull-right btn btn-flat btn-danger btn-sm" id="js-button-add"><i class="fa fa-plus"></i> Add</button>  --}}
                    </form>
                </div>
                <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-body">
                    <div class="js-data-container">
                         {{-- @include('control_panel_faculty.student_grade_sheet_details.partials.data_list')  --}}
                    </div>
                </div>
                @endif
                
            
            
            
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
              });
       
        
    </script>
@endsection