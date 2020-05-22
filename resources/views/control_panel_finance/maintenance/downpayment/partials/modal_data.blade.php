<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_downpayment">
                {{ csrf_field() }}
                @if ($DownpaymentFee)
                    <input type="hidden" name="id" value="{{ $DownpaymentFee->id }}">
                @endif
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{ $DownpaymentFee ? 'Edit Downpayment Fee' : 'Add Downpayment Fee' }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Downpayment fee</label>
                        <input type="number" class="form-control" name="downpayment_fee" value="{{ $DownpaymentFee ? $DownpaymentFee->downpayment_amt : '' }}">
                        <div class="help-block text-red text-center" id="js-downpayment_fee">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Set as Current Downpayment Fee</label>
                        <select name="current_sy" id="current_sy" class="form-control">
                            <option value="1" {{ $DownpaymentFee ? ($DownpaymentFee->current == 0 ? 'selected' : '')  : 'selected' }}>Yes</option>
                            <option value="0" {{ $DownpaymentFee ? ($DownpaymentFee->current == 0 ? 'selected' : '')  : '' }}>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-current_sy">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->