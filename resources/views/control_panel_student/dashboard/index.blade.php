@extends('control_panel_student.layouts.master')

@section('styles')
 <style>
     

</style>   
@endsection
@section ('content_title')
    Home
@endsection

@section ('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                {{-- <div class="overlay hidden" id="js-loader-overlay"><i class="fa fa-refresh fa-spin"></i></div> --}}
                <div class="card-header">
                    <h3 class="card-title">Announcement:</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <h3 class="card-title"> </h3>
                   
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Lessons</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">FILIPINO</a>
                      <span class="product-description">
                        Pang-uri
                      </span>
                    </div>
                  </li>                  
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Lessons</a>
              </div>
              <!-- /.card-footer -->
            </div>
            {{-- assignment --}}
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Assignments</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">FILIPINO</a>
                      <span class="product-description">
                        Pang-uri
                      </span>
                    </div>
                  </li>                  
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Assignments</a>
              </div>
              <!-- /.card-footer -->
            </div>

            {{-- appointment --}}
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Appointments</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">FILIPINO</a>
                      <span class="product-description">
                        Pang-uri
                      </span>
                    </div>
                  </li>                  
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Appointment</a>
              </div>
              <!-- /.card-footer -->
            </div>
                
                
                
                {{-- <div class="box box-primary direct-chat direct-chat-primary">
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
                                <p>Date and Time: {{ $item ? date_format(date_create($item->appointment->date),  'F d, Y h:i A') : '' }} {{$item->appointment->time}}</p>
                                <p>Queue number: {{$item->queueing_number}}</p>
                                <div>
                                    <button class="btn btn-primary">Done</button> &nbsp; <button class="btn btn-danger">Cancel</button>
                                </div>
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
                </div>             --}}
        </div>
        
    </div>

    

    
@endsection
@section('scripts')
    <script>
        setInterval(function(){ 
            // check notif count
            $('.sample-body').text('hello world!');
            // alert('hello')
        }, 3000);
        
    </script>
@endsection