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

    .correct-bg{
        background-color: #22d44b36!important;
        border: 2px solid #28a745!important;
    }
    
</style>
@endsection

@section ('content_title')
    Assessment | 
    {{ $ClassSubjectDetail->subject->subject }}
@endsection

@section ('content')
    <div class="card">
        <div class="col-md-12">
            <a 
            href="{{ route('student.assessment.subject.details', [encrypt($ClassSubjectDetail->id), 'tab' => $tab]) }}" 
            {{-- href="{{ route('student.assessment.subject.details', [encrypt($ClassSubjectDetail->id), 'tab' => 'new']) }}"> --}}
                style="margin-top: -3em" class="btn-success btn btn-sm float-right">
                <i class="fas fa-arrow-left"></i> back
            </a>
        </div>
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
                                Time:  @if($student_exam->status != 3)<span class="countdown"></span>@else 0:00 @endif
                            </div>
                        </div>
                    </h5>
                </div>
                <div class="col-md-3">
                    <h5>Score: {{ $student_exam->score != null ? $student_exam->score : '' }}/{{ $Assessment->QuestionsCount }}</h5>
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
                                <input type="hidden" id="js_minutes" value="{{ $student_exam->score != null ? 0 : $Assessment->time_limit }}">
                                <input type="hidden" id="student_information_id" value="{{ encrypt($student_exam->student_information_id) }}">
                                <input type="hidden" id="student_exam_id" name="student_exam_id" value="{{ $student_exam->id }}">
                                @include('control_panel_student.assessments.assessment_questions.partials.data_list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row float-right">
                    <button id="studentExamBtn" {{ $student_exam->status != 3 ? '' : 'disabled' }} class="btn btn-primary " type="submit">
                        <i class="far fa-check-square"></i> Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="assessmentTimesUp" tabindex="-1" role="dialog" 
        aria-labelledby="assessmentTimesUpTitle" aria-hidden="false"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You've reach the maximum time. The assessment will save automatically. Thank you!</p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary">Okay</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('js/student_assessment.js') }}"></script>
@endsection