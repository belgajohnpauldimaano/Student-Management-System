@extends('control_panel.layouts.print_layout')
@section ('content_title')
    Student Information
@endsection

@section ('content')
<div style="padding: .5em">
    <table class="table-student-info" style="margin-bottom: 40px">
        <thead>
            <tr>
                <td style="width: 15% !important">
                    <img style="" class="logo deped-bataan-logo" width="100" 
                        src="img/sja-logo.png" />
                </td>
                <td style="width: 60% !important">                    
                    <img style="margin-left: 20px" class=""  
                        src="img/head.png" />                    
                </td>
                <td style="width: 25% !important">
                    <img style="" class="s_photo" width="100" 
                        src="img/account/photo/{{ $photo }}" />
                </td>
            </tr>
        </thead>
    </table>

    @include('control_panel_admission.incoming.partials.data_print_email')    

    <div style="padding: 1px 10px 1px 10px !important; background: rgb(222,222,222); margin-top: 1em">
        <p style="text-align: justify">
            <i>
                I hereby declare that all information provided in this application form and all supporting documents are true and
                correct. I fully understand that any misinterpretation of failure to disclose pertinent information on my part as 
                required herein, may cause the disapproval of this application. In the event that the application is approved, it is
                deemed that I shall accept and abide by the policies, procedures and conditions set by <b>ST. John's Academy Inc</b>.
            </i>
        </p>
    </div>
    
    <table class="table-student-info text-center" style="margin-top: 2em">
        <thead>
            <tr>
                <td style="width: 40% !important">
                    <p class="m2 underline-field">
                        <b>&nbsp;</b>
                    </p>
                    <br/><i>Signature of Application over printed name</i>
                </td>
                <td style="width: 20% !important">
                </td>
                <td style="width: 40% !important">
                    <p class="m2 underline-field">
                        <b>&nbsp;</b>
                    </p>
                    <br/><i>Signature of Parent/Guardian</i>
                </td>
            </tr>
        </thead>
    </table>

    <p style="margin-bottom: -15em">
        <i><b>Note:<br/> Data gathered will be used for students application purposes only</b></i>
    </p>   
</div>
@endsection