@extends('control_panel_student.layouts.master')

@section ('content_title')
    Assessment | 
    {{ $ClassSubjectDetail->subject->subject }}
@endsection

@section ('content')
    <div class="card">
        <div class="col-md-12">
            <a href="{{ route('student.assessment.index') }}" style="margin-top: -3em" class="btn-success btn btn-sm float-right">
                <i class="fas fa-arrow-left"></i> back
            </a>
        </div>
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header p-2">
            <h5 class="card-title">
                Subject: 
                <span class="text-red"><i>{{ $ClassSubjectDetail->subject->subject }}</i></span>
            </h5>
        </div>
        <div class="card-header">
                <div class="col-md-8 m-auto">
                    <h6 class="box-title">Search</h6>
                    <form id="js-form_search">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-9 m-auto">
                                <div id="js-form_search" class="form-group" style="padding-left:0;padding-right:0">
                                    <input type="text" class="form-control form-control-sm" name="search">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-sm btn-success">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="js-data-container">
                            @include('control_panel_student.assessments.assessment_subject_details.partials.data_list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section ('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('js/student_assessment.js') }}"></script>
    <script>
        
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            
            $.ajax({
                url : "student-assessment-subject-details",
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
        
    </script>
@endsection