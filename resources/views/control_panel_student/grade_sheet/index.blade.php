@extends('control_panel_student.layouts.master')

@section('styles')
    <style>
        .table-responsive {
            display: table;
        }
    </style>
@endsection

@section ('content_title')
    Grade Sheet
@endsection

@section ('content')

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Grades:</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="m-auto">
                <form id="js-form_search">
                    {{ csrf_field() }}                
                    <label class="control-label">- School year -</label>
                    <div class="form-group col-md-12 input-school_year" style="padding-right:0; padding-left: 0">
                        <select name="school_year" id="school_year" class="form-control">                            
                            <option value="0">
                                - Select School Year -
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </option>
                            @foreach ($School_years as $item)
                                <option value="{{ $item->id }}">{{ $item->school_year }}</option>
                            @endforeach      
                        </select>
                    </div>
                    <div class="help-block text-red text-left" id="js-school_year">
                    </div>
                   
                    <button type="submit" class="btn btn-success">Search</button>
                    <button type="button" class="btn btn-primary btn_clear" style="display: none">
                        <i class="fa fa-refresh"></i> Clear
                    </button>                    
                </form>
            </div>
            
            <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
            </div>
            <div class="">          
                <div class="js-data-container" style="margin-top: 4em">
                    @include('control_panel_student.grade_sheet.partials.data_list')       
                </div>            
            </div>
       
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
            $.ajax({
                url : "{{ route('student.grade_sheet.index') }}",
                type : 'POST',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    loader_overlay();
                    $('.js-data-container').html(res);
                    $('.btn_clear').removeAttr('style');
                }
            });
        }

        $('.btn_clear').click(function (){
            location.reload();
        });

        $(function () {
            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                if (!$('#school_year').val()) {
                    alert('Please select a school_year');
                    return;
                }
                fetch_data();
            });
            // $('body').on('change', '#search_sy', function () {
            //     $.ajax({
            //         url : "{{ route('faculty.subject_class.list_class_subject_details') }}",
            //         type : 'POST',
            //         {{--  dataType    : 'JSON',  --}}
            //         data        : {_token: '{{ csrf_token() }}', search_sy: $('#search_sy').val()},
            //         success     : function (res) {

            //             $('#search_class_subject').html(res);
            //         }
            //     })
            // })
            $('body').on('click', '#js-btn_print', function (e) {
                e.preventDefault()
                const search_class_subject = $('#search_class_subject').val()
                const search_sy = $('#search_sy').val()
                window.open("{{ route('student.grade_sheet.print_grades') }}", '', 'height=800,width=800')
            })
        });
    </script>
@endsection