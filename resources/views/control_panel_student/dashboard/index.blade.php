@extends('control_panel_student.layouts.master')

@section ('content_title')
    Home
@endsection

@section ('content')
    <div class="row">        
        <div class="col-md-8">
            <div class="box">
                <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-body">   
                    <h2 style="text-align: center">
                        <b>
                            Welcome, {{ $StudentInformation->first_name.' '.$StudentInformation->middle_name.' '.$StudentInformation->last_name }}
                        </b>
                    </h2>            
                    <center>
                            <img class="img-responsive  img-responsive img-circle" src="{{ asset('img/sja-logo.png') }}" style="width:150px; height:150px;  border-radius:50%;">
                    </center> 
                    <br/>
                    <br/>              
                </div>
            </div>
        </div>
        <div class="col-md-4">
                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Appointment</h3>    
                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="" class="{{$AppointedCount ? 'badge bg-light-blue' : ''}}" data-original-title="{{$AppointedCount ? $AppointedCount : 'No'}} Appointment">
                            {{$AppointedCount ? $AppointedCount : ''}}
                        </span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>                   
                    </div>
                    </div>               
                    <div class="box-body">                  
                    <div class="">
                        @if($hasAppointment)
                            @foreach ($Appointed as $item)
                            <div style="padding: 5px 10px;background:;border: 1px solid #d2d6de;margin: 5px 5px 0 5px;color: rgb(2, 2, 2);" class="success">
                                <h4>Appointment Schedule</h4>
                                <p>Date and Time: {{ $item ? date_format(date_create($item->appointment->date), 'F d, Y') : '' }} {{$item->appointment->time}}</p>
                                <p>Queue number: {{$item->queueing_number}}</p>
                                {{-- <div>
                                    <button class="btn btn-primary">Done</button> &nbsp; <button class="btn btn-danger">Cancel</button>
                                </div> --}}
                            </div>
                            @endforeach
                        @else
                            <div style="padding: 10px">
                                <h4>No Appointment</h4>
                            </div>                            
                        @endif
                    </div>                 
                    </div>
                    
                    <div class="box-footer">
                    </div>
                </div>            
        </div>
    </div>

    
@endsection