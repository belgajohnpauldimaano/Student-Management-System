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
            <div class="box">
                <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-body">   
                    <div class="callout callout-success">
                        <h4>Your Appointment</h4>
                        <hr>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Queue No.</th>
                                </tr>
                            </tbody>
                            <tbody>
                                @if($hasAppointment)
                                    @foreach ($Appointed as $item)
                                        <tr>
                                            <td>{{ $item ? date_format(date_create($item->appointment->date), 'F d, Y') : '' }}</td>
                                            <td>{{$item->appointment->time}}</td>
                                            <td>{{$item->queueing_number}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="3" style="text-align: center">No Appointment</td>
                                @endif
                            </tbody>
                        </table>
                    </div> 
                    <br/>
                    <br/>         
                </div>
            </div>
        </div>
        
      
        
       
    </div>

    
@endsection