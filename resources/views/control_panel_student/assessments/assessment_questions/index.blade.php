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
                        <div id="clockdiv">
                            <div>
                                Time:  <span class="hours"></span>:<span class="minutes"></span>:<span class="seconds"></span>                    
                            </div>
                        </div>
                    </h5>
                </div>
                <div class="col-md-6">
                    <h5>Score: </h5>
                </div>
            </div>
           
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="js-data-container">
                            <input type="hidden" id="js_minutes" value="{{ $Assessment->time_limit }}">
                            @include('control_panel_student.assessments.assessment_questions.partials.data_list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section ('scripts')
    <script src="{{ asset('cms-new/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datetimepicker/datetimepicker.js') }}"></script>
    <script src="{{ asset('js/student_assessment.js') }}"></script>
    <script>
        
        var time_assessment = $('#js_minutes').val();
        var page = 1;
        function fetch_data () {
            var formData = new FormData($('#js-form_search')[0]);
            formData.append('page', page);
            loader_overlay();
            
            $.ajax({
                url : "student-assessment-subject-details",
                type : 'POST',
                data : formData,
                processData : false,
                contentType : false,
                success     : function (res) {
                    loader_overlay();
                    $('.js-data-container').html(res);
                }
            });
        }

        var remaining_min = time_assessment;
        var remaining_sec;
        var remaining_date
        function getTimeRemaining(endtime) {
            // remaining_date = localStorage.endTime = new Date;
            const total = Date.parse(endtime) - Date.parse(new Date());
            // const total = Date.parse(endtime) - Date.parse(localStorage.endTime);
            console.log(localStorage.endTime)
            const seconds = Math.floor((total / 1000) % 60);
            const minutes = Math.floor((total / 1000 / 60) % 60);
            const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
            const days = Math.floor(total / (1000 * 60 * 60 * 24));
            
            return {
                total,
                hours,
                minutes,
                seconds
            };
        }

        // var remaining = localStorage.endTime =  + new Date + time_assessment;
        // console.log(remaining);
        // var beginning = localStorage.endTime - new Date;
        // console.log(beginning);

        function initializeClock(id, endtime) {
            const clock = document.getElementById(id);
            
            const hoursSpan = clock.querySelector('.hours');
            const minutesSpan = clock.querySelector('.minutes');
            const secondsSpan = clock.querySelector('.seconds');
            const totalSpan = clock.querySelector('.total');

            
            function updateClock() {
                const t = getTimeRemaining(endtime);
                
                // daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                console.log(totalSpan)

                remaining_min = localStorage.endMin =  t.minutes;
                remaining_sec = localStorage.endSec =  t.seconds;
                console.log(remaining_min)
                console.log(remaining_sec)

                if(remaining_min <= 0 && remaining_sec <= 0){
                    reset();
                }

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }                

            updateClock();
            const timeinterval = setInterval(updateClock, 1000);
        }
        
        remaining_min = localStorage.endMin != null ? localStorage.endMin : time_assessment;
        remaining_sec = localStorage.endSec !=null ? localStorage.endSec : 60;

        if(remaining_min <= 0 && remaining_sec <= 0){
            reset();
            const deadline = new Date(Date.parse(new Date()) +  time_assessment * 60 * 1000);
            initializeClock('clockdiv', deadline);
        }else{
            remaining_min;
            remaining_sec;
            const deadline = new Date(Date.parse(new Date()) +  remaining_min * 60 * 1000);
            initializeClock('clockdiv', deadline);
        }
        
        // reset()
        function reset()
        {
            alert('local storage will be clear!')
            localStorage.clear();
        }
        
    </script>
@endsection