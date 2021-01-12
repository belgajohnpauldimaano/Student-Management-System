<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                            
                    <h4 style="margin-right: 5em;" class="modal-title">
                        Edit Discount/Subsidy
                    </h4>
                </div>
                <form  id="js-update_discount">
                    {{ csrf_field() }}
                    <div class="modal-body">   
                        <input type="hidden" name="id" value="{{ $TransactionDiscount->id }}">
                        <div class="form-group">
                            <label for="e_discount">Discount/Subsidy Fee</label>
                                <div class="radio" style="margin-top: -2.5px;">
                                    @foreach ($DiscountFee as $item)         
                                        <label>                      
                                            @php 
                                                $hasAlreadyDiscount = \App\Models\TransactionDiscount::where('student_id', $TransactionDiscount->student_id)
                                                    ->where('school_year_id', $SchoolYear->id)->where('discount_type', $item->disc_type)
                                                    ->where('isSuccess', 1)
                                                    ->first();
                                                
                                            @endphp
                                            <input type="radio" 
                                                {{$hasAlreadyDiscount ? 'checked' : ''  }} 
                                                class="js-discount"
                                                name="discount[]" 
                                                value="{{$item->id}}"
                                                data-type="{{$item->disc_type}}" 
                                                data-fee="{{$item->disc_amt}}"
                                            >
                                            
                                                {{$item->disc_type}} ({{number_format($item->disc_amt, 2)}})
                                             
                                        </label> 
                                    &nbsp;&nbsp;        
                                    @endforeach
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