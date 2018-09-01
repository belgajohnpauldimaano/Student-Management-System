@extends('control_panel_student.layouts.master')

@section ('styles') 
@endsection

@section ('content_title')
    Grade Sheet
@endsection

@section ('content')
    <div class="box">
        <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
        <div class="box-body">
            <button class="btn btn-flat pull-right btn-primary" id="js-btn_print"><i class="fa fa-file-pdf"></i> Print</button>
            <div class="js-data-container">
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            @if ($grade_level >= 11) 
                                <th>First Semister</th>
                                <th>Second Semister</th>
                            @elseif($grade_level <= 10)
                                <th>First Grading</th>
                                <th>Second Grading</th>
                                <th>Third Grading</th>
                                <th>Fourth Grading</th>
                            @endif
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
                                    @if ($data->grade_status != 2)
                                        <td colspan="6" class="text-center text-red">Grade not yet finalized</td>
                                    @else 
                                    
                                        @if ($grade_level >= 11) 
                                            <td>{{ number_format($data->fir_g, 2) }}</td>
                                            <td>{{ number_format($data->sec_g, 2) }}</td>
                                            <td style="color:{{ $data->final_g >= 75 ? 'green' : 'red' }};"><strong>{{ $data->final_g >= 75 ? 'Passed' : 'Failed' }}</strong></td>
                                        @else
                                            <td>{{ $data->fir_g ? number_format($data->fir_g, 2) : '' }}</td>
                                            <td>{{ $data->sec_g ? number_format($data->sec_g, 2) : '' }}</td>
                                            <td>{{ $data->thi_g ? number_format($data->thi_g, 2) : '' }}</td>
                                            <td>{{ $data->fou_g ? number_format($data->fou_g, 2) : '' }}</td>
                                            <td>{{ $data->fou_g ? number_format($data->final_g, 2) : '' }}</td>
                                            @if (!$data->fir_g || !$data->sec_g || !$data->thi_g || !$data->fou_g)
                                                <td></td>
                                            @else
                                                <td style="color:{{ $data->final_g >= 75 ? 'green' : 'red' }};"><strong>{{ $data->final_g >= 75 ? 'Passed' : 'Failed' }}</strong></td>
                                            @endif
                                        @endif
                                    @endif
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
            $('body').on('click', '#js-btn_print', function (e) {
                e.preventDefault()
                const search_class_subject = $('#search_class_subject').val()
                const search_sy = $('#search_sy').val()
                window.open("{{ route('student.grade_sheet.print_grades') }}", '', 'height=800,width=800')
            })
        });
    </script>
@endsection