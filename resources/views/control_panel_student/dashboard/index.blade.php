@extends('control_panel_student.layouts.master')

@section ('content_title')
    Dashboard
@endsection

@section ('content')
    <div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="info-box bg-green">
            <span class="info-box-icon ">
                <i class="fab fa-audible"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Current Entrolled Subjects</span>
                {{--  <span class="info-box-number">{{ $StudentInformation_all->student_count }}</span>  --}}
            </div>
        </div>
    </div>

    
@endsection