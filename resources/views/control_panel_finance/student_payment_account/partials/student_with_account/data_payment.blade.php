<form id="js-form_payment_transaction">
    {{ csrf_field() }} 
    @if ($StudentInformation)
        <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
        <input type="hidden" id='stud_status' name="stud_status" value="1">
        <input type="hidden" name="no_months_paid" value="{{$Transaction->no_month_paid}}" />                    
    @endif

    <div class="modal-body">                                        
        @include('control_panel_finance.student_payment_account.partials.student_with_account.data_status')
        <hr>
        <div class="row">
            <div class="col-lg-7">                            
                <div class="box box-danger box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Tuition Fee</h3>
                    </div>
                    <div class="box-body">                            
                        <div class="form-group">
                            <label for="">Email Address </label>
                            <input type="text" placeholder="email@address.com" class="form-control" name="email" id="email" value="{{ $StudentInformation ? $StudentInformation->email : ''}}">
                            <div class="help-block text-red text-left" id="js-email"></div>
                        </div>                
                        <div class="form-group">
                            <label for="">O.R. # </label>
                            <input type="text" placeholder="00000000000" class="form-control" name="or_number_payment" id="or_number_payment" value="">
                            <div class="help-block text-red text-left" id="js-or_number_payment"></div>
                        </div> 
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
                                            ?>
                                            <input type="checkbox" 
                                                {{$hasAlreadyDiscount ? 'disabled' : ''  }} 
                                                class="js-discount"
                                                name="_discount[]" 
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
                        </div>                       
                        <div class="form-group">
                            <label for="">Payment </label>
                            <input placeholder="0.00" type="number" class="form-control" name="payment_bill" id="payment_bill" value="">
                            <div class="help-block text-red text-left" id="js-payment_bill"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="box box-danger box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Summary Bill for Invoice</h3>
                    </div>
                    <div class="box-body">
                        <div class="transaction-success">
                        </div>
                        <table class="table table-bordered table-invoice table-striped">
                            <tbody>
                                <tr>                       
                                    <tr>
                                        <td style="width:140px">OR Number</td>
                                        <td align="right" id="js-or_num_payment"></td>
                                    </tr>                       
                                    <tr>
                                        <td style="width:140px">Payment Fee</td>
                                        <td align="right" id="js-monthly_fee_payment">
                                            {{ number_format($Transaction->monthly_fee, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Discount Fee</td>
                                        <td align="right" id="js-discount_fee_payment">
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:140px">Current Balance </td>
                                        <td align="right">
                                            ₱ <span id="js-current_bal">0</span>
                                        </td>
                                    </tr>
                                    
                                </tr>
                            </tbody>                
                        </table>
                        
                        <div class="form-group" align="right">                
                            <button type="submit" id="js-btn-save-monthly" data-id='1' class="js-btn-save btn btn-primary btn-flat">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button type="button" 
                                    class="btn btn-danger btn-flat js-btn_print" 
                                    data-syid="{{$School_year_id->id}}"
                                    data-studid="{{ $StudentInformation->id }}"
                            >
                                <i class="fa fa-file-pdf"></i> Print
                            </button>
                        </div>                              
                </div>                        
            </div>
        </div>
    </div>
    
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat btn-close" data-dismiss="modal">Close</button>
</div>
