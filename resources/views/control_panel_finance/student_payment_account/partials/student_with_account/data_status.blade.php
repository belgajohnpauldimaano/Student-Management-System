<div class="row">   
    <div class="col-lg-12"> 
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 order-0">
                        <h4>Payment Account:</h4>
                    </div>
                    <div class="col-md-6 order-1">
                        <div>
                            @if($Transaction->status == 1)
                                <button type="button" class="float-right btn btn-success btn-sm btn-paid" 
                                    data-id="{{ $Transaction->id }}" id="js-button-paid">
                                    <i class="fas fa-check"></i> Paid
                                </button>
                            @else
                                <button type="button" class="float-right btn btn-danger btn-sm btn-unpaid" 
                                    data-id="{{ $Transaction->id }}" id="js-button-paid">
                                    <i class="fas fa-check"></i> Unpaid
                                </button>
                            @endif
                            <button type="button" class="float-right btn btn-danger btn-sm mr-3" data-id="{{ $Transaction->id }}"  id="js-button-delete">
                                <i class="fas fa-trash"></i> Delete Entire Transaction
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-6">
                        <h6>
                            <b>Student Category:</b> 
                            <i style="color: red">
                                @php echo $Stud_cat_payment->student_category; echo -  $Payment->grade_level_id; @endphp
                            </i>
                        </h6>
                    
                        <h6>
                            <b>Tuition Fee:</b> 
                            <i style="color: red"> 
                                @php echo number_format($Tuitionfee_payment->tuition_amt, 2); @endphp 
                            </i>
                            <b>| Miscelleneous Fee:</b> 
                            <i style="color: red"> 
                                @php echo number_format($MiscFee_payment->misc_amt,2); @endphp
                            </i>                   
                        </h6>

                        <h6>
                            <b>Discount(s):</b> 
                            @forelse ($TransactionDiscount as $item)
                                <b>{{ $item->discount_type }}</b> : <i style="color: red"> {{ number_format($item->discount_amt, 2) }}</i><br/>
                            @empty
                                <b><i style="color: red">No Record Discount</i></b>
                            @endforelse
                        </h6>
                        
                    </div>
                    <div class="col-lg-6">
                        <h6>
                            <b>Downpayment Fee:</b>
                            <i style="color: red">
                                {{number_format($Transaction->downpayment->downpayment_amt,2)}}
                            </i>
                        </h6>
                        <h6>
                            <b>Total Balance:</b>
                            <i style="color: red">
                                @if($TransactionMonthPaid->count())
                                    {{number_format($TransactionMonthPaid[0]->balance,2)}}
                                @endif
                            </i>
                            <input type="hidden" name="js_current_balance" id="js-current_balance" 
                                value="
                                @if($TransactionMonthPaid->count())
                                    {{$TransactionMonthPaid[0]->balance}}
                                @endif
                                ">
                        </h6>
                        <h6>
                            <b>Other(s):</b> 
                            @forelse ($others as $data)
                                <b>{{$data->other_name}}</b> : <i style="color: red"> {{number_format($data->item_price, 2)}}</i> | <b>Qty:</b> {{$data->item_qty}}<br/>
                            @empty
                                <b><i style="color: red">No Record Other</i></b>
                            @endforelse
                        </h6>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>