@extends('control_panel.layouts.master')

@section ('content_title')
    Dashboard
@endsection

@section ('content')
    <div class="row">
        <div class="col-sm-12 col-md-3">
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
        <div class="col-sm-12 col-md-3">
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
        <div class="col-sm-12 col-md-3">
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
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>{{ $registrar->registrar_count }}</h3>
                    <p>Registrar Count</p>
                </div>
                <div class="icon">
                    <i class="fab fa-audible"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $faculty->faculty_count }}</h3>
                    <p>Faculty Count</p>
                </div>
                <div class="icon">
                    <i class="fas fa-diagnoses"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-indigo">
                <div class="inner">
                    <h3>{{ $finance->finance_count }}</h3>
                    <p>Finance Count</p>
                </div>
                <div class="icon">
                    <i class="fas fa-diagnoses"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3>{{ $admission->admission_count }}</h3>
                    <p>Admission Count</p>
                </div>
                <div class="icon">
                    <i class="fas fa-diagnoses"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{  $rooms->rooms_count }}</h3>
                    <p>Room Count</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pallet"></i>
                </div>
            </div>
        </div>
    </div>
@endsection