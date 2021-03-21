<div class="row">    
    <form id="js-fetch_record">
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">- School year -</label>                                            
                <div class="input-group input-school_year">
                    <select name="school_year" id="school_year" class="form-control form-control-sm ">                            
                        <option value="0">
                            - Select School Year -
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </option>
                        @foreach ($School_years as $item)
                            <option value="{{ $item->id }}">{{ $item->school_year }}</option>
                        @endforeach      
                    </select>
                </div>
                <div class="help-block text-red text-left" id="js-school_year">
                </div>
            </div>

            <div class="col-md-3">
                <label class="control-label">Date From:</label>                                            
                <div class="input-group input-date_from">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" name="date_from" id="date_from" data-date-format="yyyy/m/d" class="form-control form-control-sm pull-right">
                </div>
                <div class="help-block text-red text-left" id="js-date_from">
                </div>
            </div>

            <div class="col-md-3">
                <label class="control-label">Date To:</label>
                <div class="input-group input-date_to">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" name="date_to" id="date_to" data-date-format="yyyy/m/d" class="form-control form-control-sm pull-right">                
                </div>
                <div class="help-block text-red text-left" id="js-date_to">
                </div>
            </div>

            <div class="col-md-3" align="right">
                <label class="control-label">&nbsp;</label>
                <div class="input-group date">
                    <button type="button" class="btn btn-primary  btn-fetch_record">
                        <i class="fas fa-file"></i> Fetch record
                    </button>
                    &nbsp;
                    <button id="js-btn_print" title="print" type="button" class="btn btn-success pull-right">
                        <i class="fas fa-file-pdf"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<br/>

<table class="table no-margin table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th style="width: 10%">No.</th>
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
