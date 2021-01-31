@extends('control_panel.layouts.master')

@section ('styles') 
<style>
    /* Styles the thumbnail */

    a.lightbox img {
        height: 300px;
        border: 3px solid white;
        box-shadow: 0px 0px 8px rgba(0,0,0,.3);
        /* margin: 94px 20px 20px 20px; */
    }

    /* Styles the lightbox, removes it from sight and adds the fade-in transition */

    .lightbox-target {
        position: fixed;
        top: -100%;
        width: 100%;
        background: rgba(0,0,0,.7);
        width: 100%;
        opacity: 0;
        -webkit-transition: opacity .5s ease-in-out;
        -moz-transition: opacity .5s ease-in-out;
        -o-transition: opacity .5s ease-in-out;
        transition: opacity .5s ease-in-out;
        overflow: hidden;
    }

    /* Styles the lightbox image, centers it vertically and horizontally, adds the zoom-in transition and makes it responsive using a combination of margin and absolute positioning */

    .lightbox-target img {
        margin: auto;
        position: absolute;
        top: 0;
        left:0;
        right:0;
        bottom: 0;
        max-height: 0%;
        max-width: 0%;
        border: 3px solid white;
        box-shadow: 0px 0px 8px rgba(0,0,0,.3);
        box-sizing: border-box;
        -webkit-transition: .5s ease-in-out;
        -moz-transition: .5s ease-in-out;
        -o-transition: .5s ease-in-out;
        transition: .5s ease-in-out;
    }

    /* Styles the close link, adds the slide down transition */

    a.lightbox-close {
        display: block;
        width:50px;
        height:50px;
        box-sizing: border-box;
        background: white;
        color: black;
        text-decoration: none;
        position: absolute;
        top: -80px;
        right: 0;
        -webkit-transition: .5s ease-in-out;
        -moz-transition: .5s ease-in-out;
        -o-transition: .5s ease-in-out;
        transition: .5s ease-in-out;
    }

    /* Provides part of the "X" to eliminate an image from the close link */

    a.lightbox-close:before {
        content: "";
        display: block;
        height: 30px;
        width: 1px;
        background: black;
        position: absolute;
        left: 26px;
        top:10px;
        -webkit-transform:rotate(45deg);
        -moz-transform:rotate(45deg);
        -o-transform:rotate(45deg);
        transform:rotate(45deg);
    }

    /* Provides part of the "X" to eliminate an image from the close link */

    a.lightbox-close:after {
        content: "";
        display: block;
        height: 30px;
        width: 1px;
        background: black;
        position: absolute;
        left: 26px;
        top:10px;
        -webkit-transform:rotate(-45deg);
        -moz-transform:rotate(-45deg);
        -o-transform:rotate(-45deg);
        transform:rotate(-45deg);
    }

    /* Uses the :target pseudo-class to perform the animations upon clicking the .lightbox-target anchor */

    .lightbox-target:target {
        opacity: 1;
        top: 0;
        bottom: 0;
        left: 0;
    }

    .lightbox-target:target img {
        max-height: 100%;
        max-width: 100%;
    }

    .lightbox-target:target a.lightbox-close {
        top: 0px;
       
    }
</style>
@endsection

@section ('content_title')
    Payment Summary
@endsection

@section ('content')
    <div class="card card-default">
        <div class="overlay d-none" id="js-loader-overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        <div class="card-header">
            <h3 class="card-title">Summary:</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="js-data-container">
                        @include('control_panel_finance.payment_summary.partials.data_list')       
                    </div>     
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('cms/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $('#date_from').datepicker({
            autoclose: true
        }) 

        $('#date_to').datepicker({
            autoclose: true
        }) 

        
        function currencyFormat(num) {
            return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        } 

        

        function fetch_data (date_from = '', date_to = '') {
            $.ajax({
            url:"{{ route('finance.summary.fetch_record') }}",
            method:"POST",
            data:{ _token : '{{ csrf_token() }}', date_from : date_from,  date_to : date_to},
            dataType:"json",
            success:function(data)
            {
                var total = 0;
                var output = '';                
                // $('#total_records').text(data.length);
                for(var count = 0; count < data.length; count++)
                {
                    output += '<tr>';
                    output += '<td style="width: 20%">' + data[count].created_at + '</td>';
                    output += '<td style="width: 30%">' + data[count].student_name + '</td>';
                    output += '<td style="width: 20%">' + data[count].student_level + '</td>';
                    
                    if(data[count].balance == null){
                        output += '<td style="width: 15%;text-align: right">' + data[count].balance + '</td>';
                    }else{
                        output += '<td style="width: 15%;text-align: right">' + currencyFormat(data[count].balance) + '</td>';
                    }
                    
                    output += '<td style="width: 15%;text-align: right">' + currencyFormat(data[count].payment) + '</td>';
                    output += '</tr>';
                    if (!isNaN(data[count].payment)) {
                        total += data[count].payment;                        
                    }
                }
                var total_output = '';
                total_output +='<tr>';
                total_output +='<td style="text-align: right" colspan="4"><b>Total:</b> </td>';
                total_output +='<td colspan="2" style="text-align: right">'+currencyFormat(total)+'</td>';
                total_output +='</tr>';
                total_output +='</tr>';
                $('tbody').html(output);
                $('tfoot').html(total_output);
                
            }
            })
            
        } 
        
        $('body').on('click', '#js-btn_print', function (e) {
            e.preventDefault()
            const date_from = $('#date_from').val();
            const date_to = $('#date_to').val()
            window.open("{{ route('finance.summary.print') }}?date_from="+date_from+"&date_to="+date_to, '', 'height=800,width=800')
        })

        $('.btn-fetch_record').click(function(){
            var date_from = $('#date_from').val();
            var date_to = $('#date_to').val();
            if(date_from != '' &&  date_to != '')
            {
                fetch_data(date_from, date_to);
            }
            else
            {
                check_date_from();
                check_date_to();
            }
        });

        $('#date_from').focusin(function(){
            check_date_from();
        })

        $('#date_to').focusin(function(){
            check_date_to();
        })

        $('#date_from').change(function(){
            check_date_from();
        })

        $('#date_to').change(function(){
            check_date_to();
        })

        function check_date_from(){
            var date_from = $('#date_from').val();
            
            if(date_from != ''){
                $('.input-date_from').addClass('has-success');
                $('.input-date_from').removeClass('has-error');
                $('#js-date_from').css('color', 'green').text('');               
            }else{
                $('.input-date_from').addClass('has-error');
                $('.input-date_from').removeClass('has-success');
                $('#js-date_from').css('color', 'red').text('You must be select your date from.');
            }
        }

        function check_date_to(){
            var date_to = $('#date_to').val();
            
            if(date_to != ''){
                $('.input-date_to').addClass('has-success');
                $('.input-date_to').removeClass('has-error');
                $('#js-date_to').css('color', 'green').text('');               
            }else{
                $('.input-date_to').addClass('has-error');
                $('.input-date_to').removeClass('has-success');
                $('#js-date_to').css('color', 'red').text('You must be select your date to.');
            }
        }

    </script>
@endsection