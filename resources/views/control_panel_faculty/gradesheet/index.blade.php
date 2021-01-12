@extends('control_panel.layouts.master')

@section ('styles') 
<style>
    td.text-red{
        color: rgb(240, 13, 13) !important;
    }
    
</style>
@endsection

@section ('content_title')
    My advisory Class Grade Sheet
@endsection

@section ('content')
    <div class="box">        
        @if($GradeLevel->grade_level  == 11 ||  $GradeLevel->grade_level  == 12)                    
            <div class="box-header with-border">                
                <h3 class="box-title">Filter</h3>  

                <form id="js-form_filter">
                    {{ csrf_field() }}
                    <div class="form-group col-sm-12 col-md-3" style="padding-left:0;padding-right:0">
                        <select name="search_school_year" id="search_school_year" class="form-control">
                            @foreach ($SchoolYear as $data)
                                <option value="{{ encrypt($data->id) }}">{{ $data->school_year }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="form-group col-sm-12 col-md-4" style="padding-left:0;padding-right:0">
                        <select name="semester_grades" id="semester_grades" class="form-control">                            
                            <option value="">Select Semester</option>
                            <option value="1st">First Semester</option>
                            <option value="2nd">Second Semester</option>
                            <option value="3rd">Average</option>                      
                        </select>
                    </div>                
                    <div class="form-group col-sm-12 col-md-4" style="padding-left:0;padding-right:0">
                        <select name="quarter" id="quarter" class="form-control">
                            <option value="">Select Class Quarter</option>
                        </select>
                    </div>                
                    <button type="submit" class="btn btn-flat btn-success">Search</button>
                </form>
            </div>
            <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        @else
            <div class="box-header with-border">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <h3 class="box-title">Filter</h3>
                    </div>
                </div>                   
                <form id="js-form_search">                    
                    {{ csrf_field() }}
                    <div class="form-group col-sm-12 col-md-3" style="padding-left:0;padding-right:0">
                        <select name="search_sy" id="search_sy" class="form-control">
                            @foreach ($SchoolYear as $data)
                                <option value="{{ encrypt($data->id) }}">{{ $data->school_year }}</option>
                            @endforeach
                        </select>
                    </div> 
                    &nbsp;
                    <div class="form-group col-sm-12 col-md-4" style="padding-left:0;padding-right:0">
                        <select name="quarter_grades" id="quarter_grades" class="form-control">
                            <option value="">Select Class Quarter</option>       
                            <option value="1st">First Quarter</option>
                            <option value="2nd">Second Quarter</option>
                            <option value="3rd">Third Quarter</option>
                            <option value="4th">Fourth Quarter</option>
                            <option value="">-------------------------------AVERAGE--------------------------------</option>
                            <option value="1st-2nd">First - Second Quarter Average</option>
                            <option value="1st-3rd">First - Second - Third Quarter Average</option>
                            <option value="1st-4th">First - Second - Third - Fourth Quarter Average</option>       
                        </select>
                    </div>                
                    &nbsp;
                    <button type="submit" class="btn btn-flat btn-success">Search</button>                    
                </form>
            </div>
            <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        @endif   
        <div class="box-body">
            <div class="js-data-container"></div>
        </div>                                                 
    </div>      
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script>
        var page = 1;
        function fetchGrades(formData)
        {            
            formData.append('page', page);
            loader_overlay();
            
            $.ajax({
                url : "{{ route('faculty.student_gradesheet.fetch_grades') }}",
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

        $('body').on('submit', '#js-form_search', function (e) {
            e.preventDefault();

            if (!$('#search_sy').val()) {                    
                show_toast_alert({
                    heading : 'Invalid',
                    message : 'Please select a School year!',
                    type    : 'error'
                });
                return;
            }
            if (!$('#quarter_grades').val()) {                    
                show_toast_alert({
                    heading : 'Invalid',
                    message : 'Please select Class Quarter!',
                    type    : 'error'
                });
                return;            
            }
            if($('#search_sy').val() !== null && $('#quarter_grades').val() !== null )
            {
                var formData = new FormData($('#js-form_search')[0]);
                fetchGrades(formData);
            }
            
        });

        $('body').on('submit', '#js-form_filter', function (e) {
            e.preventDefault();
            var formData = new FormData($('#js-form_filter')[0]);

            if ($('#search_school_year').val() && $('#semester_grades').val() && $('#quarter').val()) {
                fetchGrades(formData);
            }            
        });

        $(function(){            
            $('body').on('change', '#search_school_year', function () {
                $.ajax({
                    url : "{{ route('faculty.MyAdvisoryClass.list_class_subject_details') }}",
                    type : 'POST',
                    data        : {_token: '{{ csrf_token() }}', search_school_year: $('#search_school_year').val()},
                    success     : function (res) {
                        $('#semester_grades').html(res);
                    }
                })
            })

            $('body').on('change', '#semester_grades', function () {
                $.ajax({
                    url : "{{ route('faculty.student_gradesheet.list_quarter_sem') }}",
                    type : 'POST',
                    data        : {_token: '{{ csrf_token() }}', semester_grades: $('#semester_grades').val()},
                    success     : function (res) {
                        $('#quarter').html(res);
                    }
                })
            })

            $('body').on('change', '#search_sy', function () {
                $.ajax({
                    url : "{{ route('faculty.MyAdvisoryClass.list_quarter') }}",
                    type : 'POST',
                    data        : {_token: '{{ csrf_token() }}', search_sy: $('#search_sy').val()},
                    success     : function (res) {
                        $('#quarter_grades').html(res);
                    }
                })
            })

            
            //2nd form
            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#search_school_year').val()) {
                    
                    show_toast_alert({
                        heading : 'Invalid',
                        message : 'Please select School year!',
                        type    : 'error'
                    });
                    return;
                }
            });

            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#semester_grades').val()) {
                    
                    show_toast_alert({
                        heading : 'Invalid',
                        message : 'Please select Semester!',
                        type    : 'error'
                    });
                    return;
                }
            });

            $('body').on('submit', '#js-form_filter', function (e) {
                e.preventDefault();
                if (!$('#quarter').val()) {

                    show_toast_alert({
                        heading : 'Invalid',
                        message : 'Please select Class Quarter!',
                        type    : 'error'
                    });
                    
                    return;
                }
                // fetch_data1();
            });
        });

        $('body').on('click', '#js-print', function (e) {
            e.preventDefault()
            const search_sy = $('#search_sy').val();
            const quarter_grades = $('#quarter_grades').val(); 

            
            const search_school_year = $('#search_school_year').val();
            const semester = $('#semester_grades').val();
            const quarter = $('#quarter').val();

            var id = $(this).data('id');
            var sy = $(this).data('sy');
            var adviser_id = $(this).data('adviser_id');            
            
            if(search_sy && quarter_grades)
            {
                $category = 'junior';
                window.open("{{ route('faculty.student_grade_sheet.print') }}?sy="+sy+"&id="+id+"&ad_id="+adviser_id+"&quarter="+quarter_grades+"&level="+$category,'','height=800,width=800')
            }

            if(search_school_year && semester && quarter)
            {
                $category = 'senior';
                window.open("{{ route('faculty.student_grade_sheet.print') }}?sy="+sy+"&id="+id+"&ad_id="+adviser_id+"&sem="+semester+"&quarter="+quarter+"&level="+$category,'','height=800,width=800')
            }
            
        });
       
        
    </script>
@endsection