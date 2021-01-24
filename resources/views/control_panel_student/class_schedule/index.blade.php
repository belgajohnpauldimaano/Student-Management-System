@extends('control_panel_student.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Schedules
@endsection

@section ('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Schedules:</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="overlay d-none" id="js-loader-overlay"><i class="fas fa-sync"></i></div>
                <h3 class="card-title"> </h3>
                @include('control_panel_student.class_schedule.partials.data_list')
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
                url : "{{ route('faculty.subject_class.list_students_by_class') }}",
                type : 'POST',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    loader_overlay();
                    $('.js-data-container').html(res);
                }
            });
        }
        $(function () {

            $('body').on('submit', '#js-form_search', function (e) {
                e.preventDefault();
                if (!$('#search_class_subject').val()) {
                    alert('Please select a subject');
                    return;
                }
                fetch_data();
            });
            $('body').on('change', '#search_sy', function () {
                $.ajax({
                    url : "{{ route('faculty.subject_class.list_class_subject_details') }}",
                    type : 'POST',
                    {{--  dataType    : 'JSON',  --}}
                    data        : {_token: '{{ csrf_token() }}', search_sy: $('#search_sy').val()},
                    success     : function (res) {

                        $('#search_class_subject').html(res);
                    }
                })
            })
        });
    </script>
@endsection