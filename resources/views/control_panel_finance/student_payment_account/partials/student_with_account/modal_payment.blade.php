<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog box box-danger" style="width: 1140px;" role="document">
        <div class="modal-content">
            <div class="box-body">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
                    <h4 class="modal-title">
                        Student Account
                    </h4>
                </div>
            </div>            
            
            <div class="nav-tabs-custom" style=" padding-left: 10px; padding-right: 10px">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#payment" data-toggle="tab">Payment</a>
                    </li>
                    <li>
                        <a href="#other" data-toggle="tab">Other(s)</a>
                    </li>
                    <li>
                        <a href="#discount" data-toggle="tab">Discount(s)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="payment">
                            <div class="row">
                                @include('control_panel_finance.student_payment_account.partials.student_with_account.data_payment')
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="other">
                        @include('control_panel_finance.student_payment_account.partials.data_others')
                    </div>

                    <div class="tab-pane" id="discount">
                        <div class="transaction-discount-success"></div>
                        <form  id="js-discount_fee">
                            {{ csrf_field() }}
                            <div class="box box-danger box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Discount(s)</h3>
                                </div>
                                <div class="box-body">
                                    @if($TransactionMonthPaid->count())
                                        @if(!$TransactionMonthPaid[0]->id)
                                            <input type="hidden" name="transaction_month_paid_id" value="{{ $TransactionDiscount->transaction_month_paid_id }}">
                                        @else
                                            <input type="hidden" name="transaction_month_paid_id" value="{{ $TransactionMonthPaid[0]->id }}">
                                        @endif
                                    @else

                                    @endif

                                   

                                    <input type="hidden" name="student_id" value="{{ $StudentInformation->id }}">

                                    <div class="form-group">
                                        
                                        <label for="e_discount">Discount Fee</label>
                                            <div class="checkbox" style="margin-top: -2.5px;">
                                                @foreach ($Discount as $item)         
                                                    <label>                      
                                                        <?php 
                                                            $hasAlreadyDiscount = \App\TransactionDiscount::where('student_id', $StudentInformation->id)
                                                                ->where('school_year_id', $SchoolYear->id)->where('discount_type', $item->disc_type)
                                                                ->where('isSuccess', 1)
                                                                ->first();

                                                            // echo $hasAlreadyDiscount;
                                                        ?>
                                                        
                                                        <input type="checkbox" 
                                                            {{$hasAlreadyDiscount ? 'disabled' : ''  }} 
                                                            class="js-discount"
                                                            name="discount[]" 
                                                            value="{{$item->id}}"
                                                            data-type="{{$item->disc_type}}" 
                                                            data-fee="{{$item->disc_amt}}"
                                                        >
                                                        <span style="{{$hasAlreadyDiscount ? 'text-decoration: line-through;color: red;' : ''  }}">
                                                            {{$item->disc_type}} ({{number_format($item->disc_amt, 2)}}) <b>
                                                        </span> </b>
                                                    </label> 
                                                &nbsp;&nbsp;        
                                                @endforeach
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-flat pull-right">Save</button>
                                        
                                    </div>  
                                </div>
                            </div>
                             
                        </form>  
                    </div>
                </div>
            </div>
            
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->