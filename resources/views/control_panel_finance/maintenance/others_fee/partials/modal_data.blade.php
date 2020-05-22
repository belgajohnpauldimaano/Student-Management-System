<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_other_fee">
                {{ csrf_field() }}
                @if ($OtherFee)
                    <input type="hidden" name="id" value="{{ $OtherFee->id }}">
                @endif
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        {{ $OtherFee ? 'Edit Other Fee' : 'Add Other Fee' }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Other Fee Name</label>
                        <input type="text" class="form-control" name="otherfee_name" value="{{ $OtherFee ? $OtherFee->other_fee_name : '' }}">
                        <div class="help-block text-red text-center" id="js-otherfee_name">
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="">Other Fee Amount</label>
                            <input type="number" class="form-control" name="other_fee" value="{{ $OtherFee ? $OtherFee->other_fee_amt : '' }}">
                            <div class="help-block text-red text-center" id="js-other_fee">
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="">Set as Current Other Fee</label>
                        <select name="current" id="current" class="form-control">
                            <option value="1" {{ $OtherFee ? ($OtherFee->current == 1 ? 'selected' : '')  : '' }}>Yes</option>
                            <option value="0" {{ $OtherFee ? ($OtherFee->current == 0 ? 'selected' : '')  : 'selected' }}>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-current">
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