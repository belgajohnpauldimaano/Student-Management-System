<div class="row">   
    <div class="col-lg-12">  
        @if($Transaction->status == 1)
            <button type="button" class="pull-right btn btn-flat btn-success btn-md btn-paid" 
                data-id="{{ $Transaction->id }}" id="js-button-paid">
                <i class="fas fa-check"></i> Paid
            </button>
        @else
            <button type="button" class="pull-right btn btn-flat btn-danger btn-md btn-unpaid" 
                data-id="{{ $Transaction->id }}" id="js-button-paid">
                <i class="fas fa-check"></i> Unpaid
            </button>
        @endif              
        <h3 style="margin-bottom: 0em">Payment Account:</h3>
       
        <div class="row">
            <div class="col-lg-6">
                <h5>
                    <b>Student Category:</b> 
                    <i style="color: red">
                        <?php echo $Stud_cat_payment->student_category; echo -  $Payment->grade_level_id;?>
                    </i>
                </h5>
            
                <h5>
                    <b>Tuition Fee:</b> 
                    <i style="color: red"> 
                        <?php echo number_format($Tuitionfee_payment->tuition_amt, 2); ?> 
                    </i>
                    <b>| Miscelleneous Fee:</b> 
                    <i style="color: red"> 
                        <?php echo number_format($MiscFee_payment->misc_amt,2); ?>
                    </i>                   
                </h5>

                <h5>
                    <b>Discount(s):</b> 
                    @forelse ($TransactionDiscount as $item)
                        <b>{{ $item->discount_type }}</b> : <i style="color: red"> {{ number_format($item->discount_amt, 2) }}</i><br/>
                    @empty
                        <b><i style="color: red">No Record Discount</i></b>
                    @endforelse
                </h5>
                
            </div>
            <div class="col-lg-6">
                <h5>
                    <b>Downpayment Fee:</b>
                    <i style="color: red">
                        {{number_format($Transaction->downpayment->downpayment_amt,2)}}
                    </i>
                </h5>
                <h5>
                    <b>Total Balance:</b>
                    <i style="color: red">
                        {{number_format($TransactionMonthPaid[0]->balance,2)}}
                    </i>
                    <input type="hidden" name="js_current_balance" id="js-current_balance" 
                        value="{{$TransactionMonthPaid[0]->balance}}">
                </h5>
                <h5>
                    <b>Other(s):</b> 
                    @forelse ($others as $data)
                        <b>{{$data->other->other_fee_name}}</b> : <i style="color: red"> {{number_format($data->item_price, 2)}}</i> | <b>Qty:</b> {{$data->item_qty}}<br/>
                    @empty
                        <b><i style="color: red">No Record Other</i></b>
                    @endforelse
                </h5>
            </div>
        </div>                
    </div>
</div>