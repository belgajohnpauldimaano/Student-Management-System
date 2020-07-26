<div class="row">
    <form id="js-others_item">
        {{ csrf_field() }}
        <div class="col-lg-6">
            <div class="box box-danger box-solid" 
            {{-- style="height: 16em;" --}}
            >
            
                <div class="box-header">
                    <h3 class="box-title">Other(s)</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Enter O.R. # </label>
                        <input type="text" placeholder="00000000000" class="form-control" name="or_number_others" id="or_number_others" value="">
                        <div class="help-block text-red text-left" id="js-or_number_others"></div>
                    </div>

                    <table id="others_item" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th width="15%">Qty</th>
                                <th width="15%" style="text-align: right">Action</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach ($OtherFee as $item)
                                <tr>
                                    <th><span style="display:none" class="item-id">{{ $item->id }}</span><span class="item-description">{{$item->other_fee_name}}  (₱ {{ number_format($item->other_fee_amt, 2) }})</span><span class="item-price" style="display:none">{{ $item->other_fee_amt }}</span></th>
                                    <td>
                                        <input type="number" name="qty" class="form-control item-qty" value="" />
                                    </td>
                                    <td class="pull-right">
                                        <button type="button" class="btn btn-sm btn-flat btn-primary js-btnAdd">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>                                
                            @endforeach                                             
                        </tbody>
                    </table>
                </div>
            </div>                                    
        </div>  
        <div class="col-lg-6">
            <div class="box box-danger box-solid">
                <div class="box-header">
                    <h3 class="box-title">Summary Bill for Invoice</h3>
                </div>
                <div class="box-body">   
                        <div class="transaction-other-success">
                        </div>   
                        <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                        <div>
                            <h5><b>OR Number:</b> <span id="js-or_num_others" style="text-align: right !important">00000000000000</span></h5>
                        </div>
                        <table id="others_result" class="table table-bordered table-invoice table-striped">
                            <thead>                                          
                                <tr>
                                    <th style="width:50%">Description</th>
                                    <th style="width:15%; text-align: center">Qty</th>
                                    <th style="width:20%; text-align: center">Total Price</th>
                                    <th style="width:15%; text-align: center">Action</th>
                                </tr>                    
                            </thead>
                            <tbody>                            
                                {{-- <tr id="item"></tr>                             --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="text-align: right" colspan="2"><b>Total cost:</b> </td><td colspan="2" style="text-align: center"><span id="total"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                        
                    
                        <div class="form-group" style="margin-top: 10px" align="right">                
                            <button type="submit" id="js-btn-others-save" data-id='1' class="btn btn-primary btn-flat">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button type="button" class="btn btn-danger btn-flat" id="js-btn_print_others"
                                data-syid="{{$School_year_id->id}}"
                                data-studid="{{ $StudentInformation->id }}"
                            >
                                <i class="fa fa-file-pdf"></i> Print
                            </button>
                        </div>  
                    </form>                                 
                </div>    
            </div>
        </div>
</div>