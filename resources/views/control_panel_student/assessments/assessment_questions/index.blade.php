@extends('control_panel_student.layouts.master')
@section('styles')
<style>
    .card-header {
        overflow: hidden;
        position: -webkit-sticky;
        position: sticky;
        top: 45px !important;
        background-color: #fff !important;
        font-size: 15px;
        z-index: 100;
    }
    
</style>
@endsection

@section ('content_title')
    Assessment | 
    {{ $ClassSubjectDetail->subject->subject }}
@endsection

@section ('content')
    <div class="card">
        {{-- <div class="col-md-12">
            <a href="{{ route('student.assessment.index') }}" style="margin-top: -3em" class="btn-success btn btn-sm float-right">
                <i class="fas fa-arrow-left"></i> back
            </a>
        </div> --}}
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header h3">
            <div class="row">
                <div class="col-md-6">
                    <h5>
                         {{-- Time: <div class="countdown"></div> --}}
                        <div id="clockdiv">
                            <div>
                                Time:  <span class="countdown"></span>                    
                            </div>
                        </div>
                    </h5>
                </div>
                <div class="col-md-3">
                    <h5>Score: </h5>
                </div>
                <div class="col-md-3">
                    <h5>Status: {!! $student_exam->student_status !!}</h5>
                </div>
            </div>
        </div>
        <form id="js-studentExamForm">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="js-data-container">
                                <input type="hidden" id="js_minutes" value="{{ $Assessment->time_limit }}">
                                <input type="hidden" id="student_information_id" value="{{ encrypt($student_exam->student_information_id) }}">
                                <input type="hidden" id="student_exam_id" value="{{ $student_exam->id }}">
                                @include('control_panel_student.assessments.assessment_questions.partials.data_list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row float-right">
                    <button id="studentExamBtn" {{ $student_exam->status != 3 ? '' : 'disabled' }} class="btn btn-primary" type="submit"><i class="far fa-check-square"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('js/student_assessment.js') }}"></script>
    <script>
        
    </script>
@endsection