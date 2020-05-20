<div class="modal fade" tabindex="-1" role="dialog" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #fff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fas fa-history"></i> Transaction History</h4>
            </div>
            <div class="modal-body" style="background-color: #ecf0f5;">
                @if($hasTransaction)
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">
                                Account Payment
                            </h3>   
                            
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td>Tuition Fee</td>
                                        <td>
                                            ₱ {{ number_format($Transaction_history[0]->payment_cat->tuition->tuition_amt, 2)}}
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Miscelleneous Fee</td>
                                        <td>
                                            ₱ {{ number_format($Transaction_history[0]->payment_cat->misc_fee->misc_amt, 2)}}
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>{{$Discount ? $Discount->discount_type : ''}} Discount Fee</td>
                                        <td>
                                            ₱   {{$Discount ? number_format($Discount->discount_amt,2) : '--NA--'}} 
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Total Fees</td>
                                        <td>
                                            @if($Discount)
                                                ₱ {{ number_format($tuition_misc_fee, 2)}}
                                            @else
                                                ₱ {{ number_format($tuition_misc_fee, 2)}}
                                            @endif
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Payment Status</td>
                                        <td>
                                            <span class="label label-{{ $Transaction_history[0]->status=='1' ? 'danger': 'success'}}">
                                                {{ $Transaction_history[0]->status=='1' ? 'Not yet Paid': 'Paid'}}
                                            </span>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div> 
                    
                    <h4>History</h4>
                    @foreach ($Transaction as $key => $transaction)
                        <div class="box">
                            <div class="box-header">
                                <p style="font-weight: bold">
                                    Payment Option - {{$transaction->payment_option}}
                                </p>
                                <p style="color: #008fef">Date and Time: {{ $transaction ? date_format(date_create($transaction->created_at), 'F d, Y h:i A') : '' }}</p>   
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                        </tr>
                                        <tr>
                                            <td>1.</td>
                                            <td>Payment</td>
                                            <td>
                                                ₱ {{ number_format($transaction->payment, 2)}}
                                            </td>                                        
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Balance</td>
                                            <td>
                                                ₱ {{ number_format($transaction->balance, 2)}}
                                            </td>                                        
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>Status</td>
                                            <td>
                                                <span class="label label-{{ $transaction->approval=='Approved' ? 'success': 'danger'}}">{{ $transaction->approval}}</span>
                                            </td>                                        
                                        </tr>
                                        <div class="lightbox-target" id="img_receipt{{$transaction->receipt_img}}">
                                            <img src="{{ $transaction->receipt_img ? \File::exists(public_path('/img/receipt/'.$transaction->receipt_img)) ?
                                                asset('/img/receipt/'.$transaction->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                                asset('/img/receipt/blank-user.gif') }}"/>
                                            <a class="lightbox-close" href="#"></a>
                                        </div>
                                        
                                        @if($transaction->payment_option != 'Credit Card/Debit Card')
                                            <div class="form-group" style="padding: 10px">
                                                <label for="">Image Receipt <small>(Click to zoom)</small></label>
                                                <a class="lightbox" href="#img_receipt{{$transaction->receipt_img}}">
                                                    <img class="img-responsive" 
                                                    id="img-receipt"
                                                    src="{{ $transaction->receipt_img ? \File::exists(public_path('/img/receipt/'.$transaction->receipt_img)) ?
                                                    asset('/img/receipt/'.$transaction->receipt_img) : asset('/img/receipt/blank-user.gif') :
                                                    asset('/img/receipt/blank-user.gif') }}" 
                                                    alt="User profile picture">
                                                </a>
                                            </div> 
                                        @endif
                                    </tbody>
                                    
                                </table>
                            </div>
                            
                        </div>                    
                    @endforeach  
                @else
                    <p style="font-weight: bold"><i class="fas fa-ban"></i> No Transaction yet</p>
                @endif       
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->