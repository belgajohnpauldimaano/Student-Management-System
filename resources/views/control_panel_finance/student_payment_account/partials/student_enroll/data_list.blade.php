<form id="js-form_payment_transaction">
    {{ csrf_field() }} 
    <div class="col-lg-7">                            
        <div class="box box-danger box-solid">
            <div class="box-header">
                <h3 class="box-title">Tuition Fee</h3>
            </div>
            
            <div class="box-body">
                
                <input type="hidden" name="id" value="{{ $StudentInformation->id }}">
                <div class="form-group">
                    <label for="">Email Address </label>
                    <input type="text" placeholder="email@address.com" class="form-control" name="email" id="email" value="{{ $StudentInformation ? $StudentInformation->email : ''}}">
                    <div class="help-block text-red text-left" id="js-email"></div>
                </div>
                <div class="form-group">
                    <label for="">O.R. # </label>
                    <input type="text" placeholder="00000000000" class="form-control" name="or_number" id="or_number" value="">
                    <div class="help-block text-red text-left" id="js-or_number"></div>
                </div>            
                <div class="form-group">
                    <label for="">Student Category</label>
                    
                    <select name="payment_category" id="payment_category" class="form-control">
                        <option value="">Select Student Category</option>  
                        @if($grade_level_id < 13)                                  
                            @foreach($PaymentCategory as $p_cat)
                                <option 
                                    value="{{$p_cat->id}}" 
                                    data-gradelvl="{{$p_cat->grade_level_id}}" 
                                    data-tuition="{{ $p_cat->tuition->tuition_amt }}"
                                    data-misc="{{ $p_cat->misc_fee->misc_amt }}"
                                    data-other="{{$p_cat->other_fee->other_fee_amt}}"
                                    {{ $p_cat ? ($p_cat->id == $student_payment_category->id ? 'selected' : '')  : 'selected' }}
                                >
                                    {{$p_cat->stud_category->student_category}} {{$p_cat->grade_level_id}} - Tuition Fee: {{ number_format($p_cat->tuition->tuition_amt, 2) }} 
                                    | Miscelleneous Fee {{ number_format($p_cat->misc_fee->misc_amt, 2) }} | Other Fee {{ number_format($p_cat->other_fee->other_fee_amt, 2) }}
                                </option>                    
                            @endforeach
                        @else
                                <option value="">The Grade level is over and not qualified.</option>
                        @endif
                    </select>
                    <div class="help-block text-red text-left" id="js-payment_category">
                    </div>
                </div>
            <div class="check-downpayment">                
                    <label for="">Downpayment Category</label>                   
                    <div class="radio check-downpayment" style="margin-top: -2.5px;">
                        @foreach ($Downpayment as $item)                
                        <label>                      
                            <input type="radio" class="downpaymentSelected" name="downpayment1[]" value="{{$item->id}}"
                            data-modified="{{$item->modified}}" 
                            data-fee="{{$item->downpayment_amt}}">
                            {{number_format($item->downpayment_amt, 2)}} {{$item->modified == 1 ? '- modified' : ''}}                           
                        </label>                       
                        &nbsp;&nbsp;               
                        @endforeach
                        <div class="help-block text-left js-downpayment" id="js-downpayment"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Payment </label>
                    <input placeholder="0.00" type="number" class="form-control" name="payment" id="payment" value="">
                    <div class="help-block text-red text-left" id="js-payment"></div>
                </div>
                <div class="form-group">
                    <label for="">Discount: </label>
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
                                    <input type="checkbox" {{$hasAlreadyDiscount ? 'disabled' : ''  }} class="discountSelected" name="discount[]" value="{{$item->id}}"
                                    data-type="{{$item->disc_type}}" 
                                    data-fee="{{$item->disc_amt}}">
                                    <span style="{{$hasAlreadyDiscount ? 'text-decoration: line-through;color: red;' : ''  }}">{{$item->disc_type}} ({{number_format($item->disc_amt, 2)}}) <b></span> </b>
                                </label> 
                            &nbsp;&nbsp;        
                            @endforeach
                        </div>
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

                <table class="table table-bordered table-invoice ">
                    <tbody>
                        <tr>                       
                            <tr>
                                <td style="width:140px">OR Number</td>
                                <td align="right" id="or_num">00000000</td>
                            </tr>
                            
                            <tr>
                                <td style="width:140px">Tuition Fee</td>
                                <td align="right" id="tuition_fee"></td>
                            </tr>
                            <tr>
                                <td style="width:140px">Misc Fee</td>
                                <td align="right" id="misc_fee"></td>
                            </tr>
                            <tr>
                                <td style="width:140px">Other Fee</td>
                                <td align="right" id="other_fee"></td>
                            </tr>
                            <tr >
                                <td style="width:140px">Discount</td>
                                <td id="disc_amt" align="right">0</td>
                            </tr>                      
                            <tr>
                                <td style="width:140px">Payment </td>
                                <td align="right"><b>
                                    ₱ <span id="dp_enrollment">0</span></b>
                                </td>
                            </tr>                
                            <tr>
                                <td style="width:140px">Total Balance</td>
                                <td align="right">
                                    ₱ <span id="total_balance">0</span>
                                </td>
                            </tr>
                            
                        </tr>
                    </tbody>

                </table>

                
                            
                <hr>
                
                <div class="form-group" style="margin-top: 40px" align="">   
                    <div class="col-md-4" align="left"> 
                        <button style="display: none" type="submit" id="js-btn-done" data-id='1' class="js-btn-done btn btn-success btn-flat">
                            <i class="fas fa-check"></i> Done
                        </button> 
                    </div> 
                    
                    <div  class="col-md-8" align="right">
                        <button type="submit" id="js-btn-save" data-id='1' class="js-btn-save btn btn-primary btn-flat">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <button type="button" 
                                class="btn btn-danger btn-flat js-btn_print" 
                                data-syid="{{$School_year_id}}"
                                data-studid="{{ $StudentInformation->id }}"
                        >
                            <i class="fa fa-file-pdf"></i> Print
                        </button>
                    </div>  
                </div>
        </div>                        
    </div>
</form>