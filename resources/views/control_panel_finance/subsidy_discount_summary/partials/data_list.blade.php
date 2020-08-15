<div class="row">    
    <form id="js-fetch_record">   
        
        <div class="col-md-3">
            <label class="control-label">- School year -</label>                                            
            <div class="input-group input-school_year">
                <select name="school_year" id="school_year" class="form-control ">                            
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
            <label class="control-label">- Filter Category -</label>                                            
            <div class="input-group input-category_type">
                <select name="category_type" id="category_type" class="form-control ">                            
                    <option value="2">
                        - Select Category -
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </option>
                    <option value="0">Subsidy</option>
                    <option value="1">Discount</option>                      
                </select>
            </div>
            <div class="help-block text-red text-left" id="js-category_type">
            </div>
        </div>      

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

        <div class="col-md-12" align="right">
            <label class="control-label">&nbsp;</label>
            <div class="input-group date">
                <button type="button" class="btn btn-primary btn-flat btn-fetch_record">
                    <i class="fas fa-file"></i> Fetch record
                </button>
                &nbsp;
                <button id="js-btn_print" title="print report" type="button" class="btn btn-success btn-flat pull-right">
                    <i class="fas fa-file-pdf"></i>
                </button>
            </div>
        </div>

        {{-- <div class="col-md-1" align="left">
            <label class="control-label">&nbsp;</label>
            <div class="input-group pull-right" style="padding-top: 25px">
                <button id="js-btn_print" title="print report" type="button" class="btn btn-success btn-flat pull-right">
                    <i class="fas fa-file-pdf"></i>
                </button>
            </div>
        </div> --}}
    </form>                                       
</div>
<br/>

<table class="table no-margin table-bordered table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Date</th>
            <th>Name</th>
            <th>Student level</th>
            <th>Amount</th>
            {{-- <th>Payment</th> --}}
        </tr>
    </thead>
    <tbody>        
    </tbody>
    <tfoot>        
    </tfoot>
</table> 
