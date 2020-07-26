<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                            
                    <h4 style="margin-right: 5em;" class="modal-title">
                        Edit Transaction
                    </h4>
                </div>
                <form  id="js-update_transaction">
                    {{ csrf_field() }}
                    <div class="modal-body">   
                        <input type="hidden" name="id" value="{{ $TransactionMonthPaid->id }}">
                       
                        <div class="row">                         
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Payment Option</label>
                                    <input type="text" disabled class="form-control"  value="{{ $TransactionMonthPaid->payment_option }}">
                                    <div class="help-block text-red text-center" id="js-payment_option"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">OR Number</label>
                                    <input type="text" placeholder="00000000000" class="form-control" name="or_number" value="{{ $TransactionMonthPaid->or_no }}">
                                    <div class="help-block text-red text-center" id="js-or_number"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Payment</label>
                                    <input placeholder="0.00" type="number" class="form-control" name="payment" id="payment" value="{{ $TransactionMonthPaid->payment }}">
                                    <div class="help-block text-red text-center" id="js-payment"></div>
                                </div>
                            </div>   

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Payment</label>
                                    <input placeholder="0.00" type="number" class="form-control" name="balance" id="balance" value="{{ $TransactionMonthPaid->balance }}">
                                    <div class="help-block text-red text-center" id="js-balance"></div>
                                </div>
                            </div> 
                        </div>
                                            
                    </div>
                    <div class="modal-footer">
                        
                            <button type="submit" class="btn btn-primary btn-flat pull-right">Update</button>
                            <button type="button" class="btn btn-default btn-flat btn-close pull-left" data-dismiss="modal">Close</button>
                       
                    </div>  
                </form>  
            </div>   
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->