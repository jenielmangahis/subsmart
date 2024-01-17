<style>
.label-bold{
    font-weight:bold;    
}    
#paypal-button-container{
    margin-top:15px;
}
#btn-pay-stripe{
    width: 95%;
    margin-left: 7px;
    text-align: center;
    margin-top:10px;
}
#btn-braintree-pay-now, #card-button{
    width: 100%;
    margin-left: -1px;
    text-align: center;
}
.payment-status-container{
    padding:10px 0px;
}
#btn-cash-pay-now{
    width: 100%;
    margin-left: -1px;
    text-align: center;
    margin-top:10px;
}
</style>
<div class="row" id="plansItemDiv">
    <input type="hidden" name="invoice_id" id="pay-now-invoice-id" value="<?= $invoice->id; ?>" />
    <input type="hidden" id="pay-now-total-amount" value="<?= $invoice->grand_total; ?>" />
    <input type="hidden" id="pay-now-invoice-number" value="<?= $invoice->invoice_number; ?>" />
    <div class="col-md-12 table-responsive">
        <table class="table table-hover">
            <input type="hidden" name="count" value="0" id="count">
            <thead>
            <tr>
                <th>Item</th>
                <th width="100px" id="qty_type_value">Quantity</th>
                <th width="100px">Price</th>
                <th width="100px">Discount</th>
                <th>Tax(%)</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody id="table_body">
            <?php $total_tax = 0; ?>
            <?php foreach ($items as $item ) { ?>
                <tr class="table-items__tr">
                    <td valign="top">
                        <?php //echo $value['item'] 
                        echo $item->title; ?>
                    </td>
                    <td style="width: 100px;" valign="top">
                        <?php //echo $value['quantity'] 
                        echo $item->qty;?>                    
                    </td>
                    <td style="width: 100px;" valign="top">
                        $ <?php //echo number_format($value['price'], 2, '.', ',') 
                        echo number_format($item->costing, 2); ?>                    
                    </td>
                    <td style="width: 100px;" valign="top">
                        <!-- $0.00                     -->
                        $ <?php echo number_format($item->discount, 2); ?>
                    </td>
                    <td style="width: ;" valign="top">
                        <!-- $<?php //echo number_format($value['tax'], 2, '.', ',') ?> <br> (7.5%)  -->
                        <?php //$total_tax += floatval($value['tax']); ?>      
                        <?php echo number_format($item->tax, 2); ?>             
                    </td>
                    <td style="width: ;" valign="top">
                        $ <?php //echo number_format($value['total'], 2, '.', ',') ?>   
                        <?php echo number_format($item->total, 2); ?>                 
                    </td>
                </tr>
                <tr class="table-items__tr-last">
                    <td></td>
                    <td colspan="6"></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>       
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <div class="col-md-12">
                        <span class="help help-sm help-block">Payment Method.</span>
                    </div>
                    <div class="col-md-12 form-group">
                        <select name="payment_method" id="pay-now-payment-method" class="form-control">
                            <option value="" selected="selected">- Select Payment Method -</option>
                            <option value="cash">Cash</option>
                            <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
                                <option value="stripe">Stripe</option>
                            <?php } ?>
                            <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
                                <option value="paypal">Paypal</option>
                            <?php } ?>
                            <?php if($braintree_token != ''){ ?>
                                <option value="braintree">Credit Card via Braintree</option>
                            <?php } ?>
                            <?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
                                <option value="square">Credit Card via Square</option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
                        <a class="nsm nsm-button primary" id="btn-pay-stripe" href="javascript:void(0);" style="display:none;">PAY VIA STRIPE</a>
                    <?php } ?>
                    <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
                        <div id="paypal-button-container" style="display: none;height: 44px;"></div>
                    <?php } ?>  
                    <div id="cash-container" style="margin-top:10px;display:none;">  
                        <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'frm-cash-payment', 'autocomplete' => 'off']); ?>  
                        <input type="hidden" name="invoice_id" value="<?= $invoice->id; ?>" />                    
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Payment Date</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="date_payment" id="cash-payment-date" class="form-control" value="<?= date("Y-m-d"); ?>">                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Reference #</label> <span class="help">(optional)</span>
                                    <input type="text" name="reference" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Comments / Notes</label> <span class="help">(optional)</span>
                                    <input type="text" name="notes" value="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="nsm nsm-button primary" id="btn-cash-pay-now">Pay Now</button> 
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Subtotal
                        <span class="label-bold">$<?= number_format($invoice->sub_total,2,'.','',); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Taxes
                        <span class="label-bold">$<?= number_format($invoice->taxes,2,'.','',); ?></span>
                    </li>
                    <?php if( $invoice->adjustment_value > 0 ){ ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $invoice->adjustment_name; ?>
                        <span class="label-bold"><?= number_format($invoice->adjustment_value,2,'.','',); ?></span>
                    </li>
                    <?php } ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Grand Total
                        <span class="label-bold">$<?= number_format($invoice->grand_total,2,'.','',); ?></span>
                    </li>
                </ul>
            </div>
            <?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
                <div class="col-12" id="square-container" style="display:none;">
                    <div id="payment-form">
                      <span class="modal-total-amount"></span>
                      <div id="payment-status-container"></div>                        
                      <div id="card-container"></div>                                              
                      <button id="card-button" class="nsm nsm-button primary square-pay-button" type="button">Pay Now</button>
                      <div id="google-pay-button"></div>
                      <?php if( isApple() ){ ?>
                      <div id="apple-pay-button"></div>
                      <?php } ?>                      
                    </div>
                </div>
            <?php } ?>
            <?php if($braintree_token != ''){ ?>
                <div class="col-12" id="braintree-container" style="display:none;">
                    <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'payment-job-invoice', 'autocomplete' => 'off']); ?>
                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <div id="bt-dropin"></div>                  
                        <button type="submit" class="nsm nsm-button primary" id="btn-braintree-pay-now">Pay Now</button> 
                    <?php echo form_close(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
$(function(){
    $('#cash-payment-date').datepicker({
        minDate: '0',
        format: "yyyy-mm-dd"
    });

    // Cash Payment
    $('#frm-cash-payment').on('submit', function(e){
        e.preventDefault();
        var url  = base_url + 'invoice/_process_cash_payment';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(), 
            success: function(data) {
                if( data.is_success == 1 ){
                    updateInvoiceToPaid('paypal');       
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#btn-cash-pay-now").html('Schedule');
            }, beforeSend: function() {
                $("#btn-cash-pay-now").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
    $('#pay-now-payment-method').on('change', function(){
        var selected = $(this).val();
        <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
            if( selected == 'paypal' ){
                $('#paypal-button-container').show();
                $('#paypal-button-container').html('');
                $('#btn-pay-stripe').hide();
                $('#braintree-container').hide();  
                $('#square-container').hide();                 
                $('#cash-container').hide();                 
                // Render the PayPal button into #paypal-button-container
                
                paypal.Buttons({
                    style: {
                        layout: 'horizontal',
                        tagline: false,
                        height:40,
                        color:'blue',
                        label:'pay'
                    },
                    // Set up the transaction
                    createOrder: function(data, actions) {
                        return actions.order.create({                
                            purchase_units: [{
                                amount: {
                                    value: $("#pay-now-total-amount").val()
                                }
                            }],
                            application_context: {
                                shipping_preference: 'NO_SHIPPING'
                            }
                        });
                    },
                    // Finalize the transaction
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            // Show a success message to the buyer
                            updateInvoiceToPaid('paypal');       
                        });
                    }
                }).render('#paypal-button-container');
            }
        <?php } ?>

        <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
            if( selected == 'stripe' ){
                $('#btn-pay-stripe').show();
                $('#paypal-button-container').hide(); 
                $('#braintree-container').hide();     
                $('#square-container').hide();
                $('#cash-container').hide();                               
            }
        <?php } ?>

        <?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
            if( selected == 'square' ){
                $('#square-container').show();    
                $('#btn-pay-stripe').hide();
                $('#paypal-button-container').hide(); 
                $('#braintree-container').hide();
                $('#cash-container').hide();                                
            }
        <?php } ?>

        <?php if($braintree_token != ''){ ?>
            if( selected == 'braintree' ){
                $('#braintree-container').show();
                $('#btn-pay-stripe').hide();
                $('#paypal-button-container').hide();
                $('#square-container').hide();  
                $('#cash-container').hide();                   
            }                               
        <?php } ?>

        if( selected == 'cash' ){
            $('#cash-container').show();  
            $('#braintree-container').hide();
            $('#btn-pay-stripe').hide();
            $('#paypal-button-container').hide();
            $('#square-container').hide();
        }
        
    });  

    //Stripe Payment
    <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>    
        var handler = StripeCheckout.configure({
            key: '<?= $onlinePaymentAccount->stripe_publish_key; ?>',
            image: '',
            token: function(token) {
                updateInvoiceToPaid('stripe');                  
            }
        });

        $('#btn-pay-stripe').on('click', function(e) {
        var amountInCents = Math.floor($("#pay-now-total-amount").val() * 100);
        var displayAmount = parseFloat(Math.floor($("#pay-now-total-amount").val() * 100) / 100).toFixed(2);
        // Open Checkout with further options
        handler.open({
            image : '<?= base_url('/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image); ?>',
            name: $("#pay-now-invoice-number").val(),
            description: 'Total amount ($' + displayAmount + ')',
            amount: amountInCents,
        });
        e.preventDefault();
        });

        // Close Checkout on page navigation
        $(window).on('popstate', function() {
        handler.close();
        });
    <?php } ?>
    /*End Stripe Payment*/

    /*Braintree Payment*/
    <?php if($braintree_token != ''){ ?>
        var form = document.querySelector('#payment-job-invoice');
        var client_token = "<?= $braintree_token; ?>";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',          
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;

              //form.submit();

              //var url = form.attr('action');   
                var nonce = payload.nonce;           
                var invoice_id = $('#pay-now-invoice-id').val();
                $.ajax({
                    type: "POST",
                    url: base_url + "invoice/_process_braintree_payment",
                    data: {invoice_id:invoice_id, nonce:nonce},
                    dataType: 'json',
                    success: function(o) {                    
                        if(o.is_success === 1){
                            updateInvoiceToPaid('braintree');  
                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: o.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#32243d',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                
                            });
                        }
                    },beforeSend: function() {
                        $("#btn-braintree-pay-now").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                    }
                }); 
            });
          });
        });
    <?php } ?>        
    /*End Braintree Payment*/
    
    function updateInvoiceToPaid(payment_method){
        var invoice_id = $("#pay-now-invoice-id").val();
        var url = base_url + 'invoice/_update_payment_status';
        $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: {invoice_id:invoice_id,payment_method:payment_method},
        success: function(result)
        {
            if( result.is_success == 1 ){
                $('#modalPayNowForm').modal('hide');
                Swal.fire({
                    text: 'Invoice payment was successfully created',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#6a4a86',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    location.reload();
                }); 
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: data.msg
                });
            }         
        }
        });
    }
});
</script>

<?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
<!-- Square Payment -->
<script type="module">
const invoice_id = document.getElementById('pay-now-invoice-id').value;
const payments = Square.payments('<?= $square_client_id; ?>', '<?= $onlinePaymentAccount->square_location_id; ?>');
const card = await payments.card();
await card.attach('#card-container');

const square_total_amount = document.getElementById('pay-now-total-amount').value;
const paymentRequest = payments.paymentRequest({
    countryCode: 'US',
    currencyCode: 'USD',
    total: {
    amount: square_total_amount,
    label: 'Total',
    },
});

//Apple Pay
<?php if( isApple() ){ ?>
    const applePayButton = document.getElementById('apple-pay-button');
    try {
        // There are a number of reason why Apple Pay may not be supported
        // (e.g. Browser Support, Device Support, Account). Therefore, you should handle
        // initialization failures while still loading other applicable payment methods.
        const applePay = await payments.applePay(paymentRequest);
        // Note: You do not need to `attach` applePay.
    } catch (e) {
    if(e.name === "PaymentMethodUnsupportedError" ) {
        applePayButton.innerHTML = `Apple Pay is unsupported: ${e.message}`
    }
    console.error(e);
    }

    applePayButton.addEventListener('click', async () => {
    const statusContainer = document.getElementById('payment-status-container');

    try {
        const tokenResult = await applePay.tokenize();
        if (tokenResult.status === 'OK') {
        const source_type = 'APPLE PAY';
        //console.log(`Payment token is ${tokenResult.token}`);
        const square_response = await fetch(base_url + `invoice/_process_square_payment`, {
                method: "POST",
                body: JSON.stringify({ token: tokenResult.token, invoice_id:invoice_id, source_type:source_type }),
                headers: {    
                    accepts: "application/json",                
                    "content-type": "application/json",
                },
            });    
            const data = await square_response.json();  
            if( data.is_success == 1 ){
                updateInvoiceToPaid('square');          
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot Process Payment',
                    text: data.msg
                });
            }
        //statusContainer.innerHTML = "Payment Successful";
        } else {
        let errorMessage = `Tokenization failed with status: ${tokenResult.status}`;
        if (tokenResult.errors) {
            errorMessage += ` and errors: ${JSON.stringify(
            tokenResult.errors
            )}`;
        }

        throw new Error(errorMessage);
        }
    } catch (e) {
        console.error(e.message);
        //statusContainer.innerHTML = "Payment Failed";
    }
    });
<?php } ?>

//Google Pay
const googlePay = await payments.googlePay(paymentRequest);
await googlePay.attach('#google-pay-button');
const googlePayButton = document.getElementById('google-pay-button');
googlePayButton.addEventListener('click', async () => {
    const statusContainer = document.getElementById('payment-status-container');      
    const source_type = 'GOOGLE PAY';
    try {
    const tokenResult = await googlePay.tokenize();
    if (tokenResult.status === 'OK') {
        //console.log(`Payment token is ${tokenResult.token}`);
        const square_response = await fetch(base_url + `invoice/_process_square_payment`, {
            method: "POST",
            body: JSON.stringify({ token: tokenResult.token, invoice_id:invoice_id, source_type:source_type }),
            headers: {    
                accepts: "application/json",                
                "content-type": "application/json",
            },
        });    
        const data = await square_response.json();  
        if( data.is_success == 1 ){
            updateInvoiceToPaid('square');       
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Cannot Process Payment',
                text: data.msg
            });
        }   
    } else {
        let errorMessage = `Tokenization failed with status: ${tokenResult.status}`;
        if (tokenResult.errors) {
        errorMessage += ` and errors: ${JSON.stringify(
            tokenResult.errors
        )}`;
        }

        throw new Error(errorMessage);
    }
    } catch (e) {
    console.error(e.message);
    statusContainer.innerHTML = "Payment Failed";
    }
});

//Credit Card
const cardButton = document.getElementById('card-button');
cardButton.addEventListener('click', async () => {
    const statusContainer = document.getElementById('payment-status-container');      
    const source_type = 'CARD';
    try {
    const result = await card.tokenize();
    if (result.status === 'OK') {
        //console.log(`Payment token is ${result.token}`);
        const square_response = await fetch(base_url + `invoice/_process_square_payment`, {
            method: "POST",
            body: JSON.stringify({ token: result.token, invoice_id:invoice_id, source_type:source_type }),
            headers: {    
                accepts: "application/json",                
                "content-type": "application/json",
            },
        });    
        const data = await square_response.json();  
        if( data.is_success == 1 ){
            updateInvoiceToPaid('square');     
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Cannot Process Payment',
                text: data.msg
            });
        }   
    } else {
        let errorMessage = `Tokenization failed with status: ${result.status}`;
        if (result.errors) {
        errorMessage += ` and errors: ${JSON.stringify(
            result.errors
        )}`;
        }

        throw new Error(errorMessage);
    }
    } catch (e) {
    console.error(e);
    statusContainer.innerHTML = "Payment Failed";
    }
});
</script>
<!-- End Square Payment -->
<?php } ?>