<div class="modal fade" tabindex="-1" role="dialog" id="paypal-modal" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class=" modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4>Payment Method</h4>
            </div>
            
                <div class=" modal-body">                        
                    {{-- <h2 class="w3-text-blue">Payment Method</h2>                    
                    <div class="form-group input-payment">
                        <label for="pay_fee">Enter Amount</label>
                        <input type="number" class="form-control" name="amount">
                        <div class="help-block text-left" id="js-pay_fee"></div>
                    </div>                         --}}
                    <div id="paypal-button-container"></div>
                    {{-- <script src="https://www.paypal.com/sdk/js?client-id=ASVJ0J0h6UgKmn1IGKMhGQhhLIW1JnEneYPjYqtUsN2Yg_H3i12b2neDar0Wuskc7J_mPpm4JniAvEiA&currency=USD"
                     data-sdk-integration-source="button-factory"></script>
                    <script>
                        var amount1 = $('#pay_fee').val();
                    paypal.Buttons({
                        style: {
                            shape: 'rect',
                            color: 'gold',
                            layout: 'vertical',
                            label: 'pay',
                            
                        },
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: '1'
                                    }
                                }]
                            });
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                alert('Transaction completed by ' + details.payer.name.given_name + '!');
                            });
                        }
                    }).render('#paypal-button-container');
                    </script> --}}
                   
                        
                      
                    <input type="submit" width="200" class="btn btn-lg btnpaypal" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    
                </div>     
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

