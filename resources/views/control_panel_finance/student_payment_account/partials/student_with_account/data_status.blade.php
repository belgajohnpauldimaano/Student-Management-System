<div class="row">   
    <div class="col-lg-12">                
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
            </div>
        </div>                
    </div>
</div>