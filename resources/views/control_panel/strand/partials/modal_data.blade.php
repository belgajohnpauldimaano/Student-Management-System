<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="js-form_school_year">
                {{ csrf_field() }}
                @if ($Strand)
                    <input type="hidden" name="id" value="{{ $Strand->id }}">
                @endif
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ $Strand ? 'Edit Strand' : 'Add Strand' }}                        
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                            <label for="">Strand Name</label>
                            <input type="text" class="form-control" name="strand_name" value="{{ $Strand ? $Strand->strand : '' }}">
                            <div class="help-block text-red text-center" id="js-strand_name">
                            </div>
                    </div>
                    <div class="form-group">
                            <label for="">Strand Name Abbreviation</label>
                            <input type="text" class="form-control" name="abb_name" value="{{ $Strand ? $Strand->abbreviation : '' }}">
                            <div class="help-block text-red text-center" id="js-abb_name">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

