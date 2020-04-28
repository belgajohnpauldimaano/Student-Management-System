<div class="nav-tabs-custom"  style="box-shadow: 0 1px 1px 1px rgba(0,0,1,0.2);">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#enroll" data-toggle="tab">Enroll</a>
        </li>
        <li>
            <a href="#other" data-toggle="tab">Other(s)</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="enroll">
            <div class="row">
                @include('control_panel_finance.student_payment_account.partials.student_enroll.data_list')
            </div>
            </div>
        </div>
        
        <div class="tab-pane" id="other">
            @include('control_panel_finance.student_payment_account.partials.data_others')
        </div>
    </div>
</div>


   