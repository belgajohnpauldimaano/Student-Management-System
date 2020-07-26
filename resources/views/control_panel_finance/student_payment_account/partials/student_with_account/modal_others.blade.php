<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                            
                    <h4 style="margin-right: 5em;" class="modal-title">
                        Edit Others
                    </h4>
                </div>
                <form  id="js-update_other">
                    {{ csrf_field() }}
                    <div class="modal-body">   
                        <input type="hidden" name="id" value="{{ $TransactionOthers->id }}">
                       
                        <div class="row">                         
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Transaction ID</label>
                                    <input type="text" disabled class="form-control"  value="{{ $TransactionOthers->transaction_id }}">
                                    {{-- <div class="help-block text-red text-center" id="js-payment_option"></div> --}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">OR Number</label>
                                    <input type="text" placeholder="00000000000" class="form-control" name="or_no" value="{{ $TransactionOthers->or_no }}">
                                    <div class="help-block text-red text-center" id="js-or_no"></div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input  type="text" class="form-control" name="other_name" id="other_name" value="{{ $TransactionOthers->other_name }}">
                                    <div class="help-block text-red text-center" id="js-other_name"></div>
                                </div>
                            </div>   
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Qty</label>
                                    <input placeholder="0.00" type="number" class="form-control" name="item_qty" id="item_qty" value="{{ $TransactionOthers->item_qty }}">
                                    <div class="help-block text-red text-center" id="js-item_qty"></div>
                                </div>
                            </div>   

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input placeholder="0.00" type="number" class="form-control" name="item_price" id="item_price" value="{{ $TransactionOthers->item_price }}">
                                    <div class="help-block text-red text-center" id="js-item_price"></div>
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