<div class="row">    
    <form id="js-fetch_record">                                   
        <div class="col-md-3">
            <label class="control-label">Date From:</label>                                            
            <div class="input-group input-date_from">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date_from" id="date_from" data-date-format="yyyy/m/d" class="form-control pull-right">
            </div>
            <div class="help-block text-red text-left" id="js-date_from">
            </div>
        </div>

        <div class="col-md-3">
            <label class="control-label">Date To:</label>
            <div class="input-group input-date_to">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date_to" id="date_to" data-date-format="yyyy/m/d" class="form-control pull-right">                
            </div>
            <div class="help-block text-red text-left" id="js-date_to">
            </div>
        </div>

        <div class="col-md-3">
            <label class="control-label">&nbsp;</label>
            <div class="input-group date">
                <button type="button" class="btn btn-primary btn-flat btn-fetch_record">
                    <i class="fas fa-file-medical"></i> Fetch record
                </button>
            </div>
        </div>

        <div class="col-md-3">
            <label class="control-label">&nbsp;</label>
            <div class="input-group pull-right" style="padding-top: 25px">
                <button id="js-btn_print" type="button" class="btn btn-success btn-flat pull-right">
                    <i class="fas fa-file-pdf"></i> Print report
                </button>
            </div>
        </div>
    </form>                                       
</div>
<br/>

<table class="table no-margin table-bordered table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Student level</th>
            <th>Total Balance</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>        
    </tbody>
    <tfoot>        
    </tfoot>
</table> 
