
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