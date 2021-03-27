<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#enroll" data-toggle="tab">Enroll</a></li>
            <li class="nav-item"><a class="nav-link" href="#other" data-toggle="tab">Other(s)</a></li>
        </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="enroll">
                <!-- Post -->
                <div class="row">
                    @include('control_panel_finance.student_payment_account.partials.student_enroll.data_list')
                </div>
                <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="other">
                <!-- The timeline -->
                 @include('control_panel_finance.student_payment_account.partials.data_others')
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>

   