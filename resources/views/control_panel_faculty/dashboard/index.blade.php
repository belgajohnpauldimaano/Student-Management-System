@extends('control_panel.layouts.master')

@section ('content_title')
    Dashboard
@endsection

@section ('content')
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $StudentInformation_tagged_student->total_students }}</h3>
                    <p>Total Tagged Students</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people-outline"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $StudentInformation_tagged_student_male->total_students }}</h3>
                    <p>Tagged Male</p>
                </div>
                <div class="icon">
                    <i class="fas fa-male"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $StudentInformation_tagged_student_female->total_students }}</h3>
                    <p>Tagged Female</p>
                </div>
                <div class="icon">
                    <i class="fas fa-female"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $ClassSubjectDetail_count->subject_count }}</h3>
                    <p>Current Subject</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function () {
            // Summernote
            $('#summernote').summernote();
            $('.select2').select2();

        })
    </script>
@endsection