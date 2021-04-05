
$('body').on('click', '#js-button-take', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    // alert(id)
    alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-sm btn-primary";
    alertify.defaults.theme.cancel = "btn btn-sm btn-danger";
    alertify.confirm('Reminder', 'The time will start when you take the assessment. Take the assessment? ', function () {
        
        // $.ajax({
        //     url : "student-take-assessment?class_subject_details_id="+id, 
        //     type : 'POST',
        //     data : { _token : '{{ csrf_token() }}', id : id },
        //     success : function (res) {
        //         $('.js-modal_holder').html(res);
        //         $('.js-modal_holder .modal').modal({ backdrop : 'static' });
                
                
        //     }
        // });
        var url = "take-assessment?id="+id;
        window.location.href=url;

    }, function(){  
    }); 
});