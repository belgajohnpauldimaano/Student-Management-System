
$('body').on('click', '#js-button-take', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    // alert(id)
    alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-sm btn-primary";
    alertify.defaults.theme.cancel = "btn btn-sm btn-danger";
    alertify.confirm('Reminder', 'The time will start when you take the assessment. Take the assessment? ', function () {
        
        $.ajax({
            url : "/student/assessment/subject/"+id+"/take-assessment",
            type : 'POST',
            data : { _token : $('input[name=_token]').val(), id : id },
            success : function (res) {
                if (res.res_code == 1)
                {
                    show_toast_alert({
                        heading : 'Error',
                        message : res.res_msg,
                        type    : 'error'
                    });
                }
                else
                {
                    // show_toast_alert({
                    //     heading : 'Success',
                    //     message : res.res_msg,
                    //     type    : 'success'
                    // });
                    // var url = location.protocol + '//' + location.host + "/student/assessment/subject/"+res.id+"/subject-details";
                    var url = "redirect-assessment?id="+id;
                    window.location.href=url;
                }
                
            }
        });

        
    }, function(){  
    }); 
});

// assessment_questions
        
        var student_exam_status = $('#student_exam_status').val();
        var student_information_id = $('#student_information_id').val();
        
        
        // console.log(student_exam_id)
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

        

        // $('#studentExamBtn').prop('disabled', true);
        $('body').on('submit', '#js-studentExamForm', function (e) {
            e.preventDefault(); 
            // var self = $(this);
            // let id = student_information_id;
            var formData = new FormData($(this)[0]);

            alertify.defaults.transition = "slide";
            alertify.defaults.theme.ok = "btn btn-primary ";
            alertify.defaults.theme.cancel = "btn btn-danger ";
            alertify.confirm('Confirmation', 'Are you sure you want to submit it? It will not revert?', function(){  
                $.ajax({
                    url         : "/student/assessment/subject/"+student_information_id+"/save-data",
                    type        : 'POST',
                    data        : formData,
                    processData : false,
                    contentType : false,
                    success     : function (res) {
                        $('.help-block').html('');
                        if (res.res_code == 1)
                        {
                            show_toast_alert({
                                heading : 'Error',
                                message : res.res_msg,
                                type    : 'error'
                            });
                        }
                        else
                        {
                            show_toast_alert({
                                heading : 'Success',
                                message : res.res_msg,
                                type    : 'success'
                            });
                            // fetch_data();
                        }
                    }
                });
            }, function(){  
            });
        });


        var student_exam_id = $('#student_exam_id').val();
        var time_assessment = $('#js_minutes').val();
        if(student_exam_id){
            examCountDown();
        }
        // $('#studentExamBtn').attr('disabled' , true);
        // localStorage.clear();
        var timer2;
        var remaining_min;
        var remaining_sec;
        
        function examCountDown()
        {
            
            var localMin = localStorage.getItem("endMin_"+student_exam_id+"");
            var localSec = localStorage.getItem("endSec_"+student_exam_id+"");
            
            try {
                remaining_min = localMin == undefined ? time_assessment : localMin;
                remaining_sec = localSec == undefined ? '00' : localSec;
            } catch (err) {
                console.log('error');
                remaining_min = time_assessment;
                remaining_sec = '00';
            }
        
            timer2 = remaining_min + ':' + remaining_sec;
            
            // var timer2 = time_assessment+':00';
            var interval = setInterval(function() {
                var timer = timer2.split(':');
                //by parsing integer, I avoid all extra string processing
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;

                if (minutes < 0) {
                    // localStorage.clear();
                    reset();
                    clearInterval(interval);
                } else {
                    if (localMin == 0 && localSec == 0) {
                        reset();
                    }
                    remaining_min = localStorage.setItem("endMin_"+student_exam_id+"", minutes);
                    remaining_sec = localStorage.setItem("endSec_"+student_exam_id+"", seconds);
                    $('.countdown').html(minutes + ':' + seconds);
                    timer2 = minutes + ':' + seconds;
                }
                //minutes = (minutes < 10) ?  minutes : minutes;
                // console.log(minutes);
            }, 1000);
            
        }
        
        // reset()
        function reset()
        {
            localStorage.removeItem("endMin_"+student_exam_id+"");
            localStorage.removeItem("endSec_"+student_exam_id+"");
            alert('local storage will be clear!')
        }