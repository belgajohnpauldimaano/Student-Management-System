<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog box box-danger" style="width: 1140px;" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                    <h4 class="modal-title">
                        Student Account
                    </h4>
                </div>
            </div>            
            
            <div class="nav-tabs-custom" style=" padding-left: 10px; padding-right: 10px">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#payment" data-toggle="tab">Payment</a>
                    </li>
                    <li>
                        <a href="#other" data-toggle="tab">Other(s)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="payment">
                            <div class="row">
                                @include('control_panel_finance.student_payment_account.partials.student_with_account.data_payment')
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="other">
                        @include('control_panel_finance.student_payment_account.partials.data_others')
                    </div>
                </div>
            </div>
            
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->