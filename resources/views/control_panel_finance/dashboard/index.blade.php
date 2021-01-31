@extends('control_panel.layouts.master')

@section ('content_title')
    Dashboard
@endsection

@section ('content')
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $StudentInformation_all->student_count }}</h3>
                    <p>Total Registered Students</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people-outline"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $StudentInformation_all_male->student_count }}</h3>
                    <p>Registered Male</p>
                </div>
                <div class="icon">
                    <i class="fas fa-male"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $StudentInformation_all_female->student_count }}</h3>
                    <p>Registered Female</p>
                </div>
                <div class="icon">
                    <i class="fas fa-female"></i>
                </div>
            </div>
        </div>
    </div>
@endsection