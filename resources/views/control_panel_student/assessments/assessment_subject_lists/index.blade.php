@extends('control_panel_student.layouts.master')

@section ('content_title')
    Assessment
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
            <h6 class="card-title">Subject lists for {{ $subject->classDetail->grade->id . '-' .$subject->classDetail->section->section }}</h6>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container">
                        @include('control_panel_student.assessments.assessment_subject_lists.partials.data_list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')

@endsection