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
                        <label for="">Grade lvl</label>
                        <select name="gradelvl" id="gradelvl" class="form-control">
                            <option value="">Select Grade level</option>
                            @if($Gradelvl)
                                @foreach($Gradelvl as $grade_lvl)
                                    <option value="{{$grade_lvl->id}}" {{ $DownpaymentFee ? $DownpaymentFee->grade_level_id == $grade_lvl->id ? 'selected' : '' : '' }}> Grade {{ $grade_lvl->grade }}</option>                    
                                @endforeach
                            @endif
                        </select>
                        <div class="help-block text-red text-center" id="js-gradelvl">
                        </div>                        
                    </div>

                    <div class="form-group">
                        <label for="">Set as Modified</label>
                        <select name="modified" id="modified" class="form-control">
                            <option value="1" {{ $DownpaymentFee ? ($DownpaymentFee->modified == 1 ? 'selected' : '')  : 'selected' }}>Yes</option>
                            <option value="0" {{ $DownpaymentFee ? ($DownpaymentFee->modified == 0 ? 'selected' : '')  : '' }}>No</option>
                        </select>
                        <div class="help-block text-red text-center" id="js-modified">
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