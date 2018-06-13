@extends('control_panel_student.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Schedules
@endsection

@section ('content')
    <div class="box">
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
            <div class="js-data-container">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>1st Grading</th>
                            <th>2nd Grading</th>
                            <th>3rd Grading</th>
                            <th>4th Grading</th>
                            <th>Final Grading</th>
                            <th>Remarks</th>
                            {{--  <th>Time</th>
                            <th>Days</th>
                            <th>Room</th>  --}}
                            <th>Grade & Section</th>
                            <th>Faculty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($GradeSheetData)
                            @foreach ($GradeSheetData as $key => $data)
                                <tr>
                                    <td>{{ $data->subject_code . ' ' . $data->subject }}</td>
                                    <td>{{ number_format($data->fir_g, 2) }}</td>
                                    <td>{{ number_format($data->sec_g, 2) }}</td>
                                    <td>{{ number_format($data->thi_g, 2) }}</td>
                                    <td>{{ number_format($data->fou_g, 2) }}</td>
                                    <td>{{ number_format($data->final_g, 2) }}</td>
                                    <td style="color:{{ $data->final_g >= 75 ? 'green' : 'red' }};"><strong>{{ $data->final_g >= 75 ? 'Passed' : 'Failed' }}</strong></td>
                                    {{--  <td>{{ $data->class_time_from . ' -  ' . $data->class_time_to }}</td>
                                    <td>{{ $data->class_days }}</td>
                                    <td>{{ 'Room' . $data->room_code }}</td>  --}}
                                    <td>{{ $data->grade_level . ' - ' . $data->section }}</td>
                                    <td>{{ $data->faculty_name }}</td>
                                </tr>
                            @endforeach
                        @else
                            
                        @endif
                    </tbody>
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