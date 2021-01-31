<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_misc_fee">
                {{ csrf_field() }}
                @if ($MiscFee)
                    <input type="hidden" name="id" value="{{ $MiscFee->id }}">
                @endif
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ $MiscFee ? 'Edit Miscellaneous Fee' : 'Add Miscellaneous Fee' }}
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Miscellaneous Fee Amount</label>
                        <input type="number" class="form-control" name="misc_fee" value="{{ $MiscFee ? $MiscFee->misc_amt : '' }}">
                        <div class="help-block text-red text-center" id="js-misc_fee">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Set as Current School Year</label>
                        <select name="current_sy" id="current_sy" class="form-control">
                            <option value="1" {{ $MiscFee ? ($MiscFee->current == 0 ? 'selected' : '')  : 'selected' }}>Yes</option>
                            <option value="0" {{ $MiscFee ? ($MiscFee->current == 0 ? 'selected' : '')  : '' }}>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-current_sy">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->