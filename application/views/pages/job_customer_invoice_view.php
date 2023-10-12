<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header_front'); ?>
<?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>    
<?php } ?>
<?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD"></script>
<?php } ?>
<?php if($braintree_token != ''){ ?>
<script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.min.js"></script>
<?php } ?>

<?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
    <link rel="stylesheet" href="/reference/sdks/web/static/styles/code-preview.css" preload>
    <script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<?php } ?>

<?php include viewPath('job/css/job_new'); ?>
<style>
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117) !important;
    }
    .card-body {
        padding: 0 !important;
    }
    .right-text{
        position: relative;
        float:right;
        right: 0;
        bottom: 10px;
    }
    #map{
        height: 190px;
    }
    .title-border{
        border-bottom: 2px solid rgba(0,0,0,.1);
        padding-bottom: 5px;
    }
    .icon_preview{
        font-size: 16px;
        color : #45a73c;
    }
    /**
   * The CSS shown here will not be introduced in the Quickstart guide, but shows
   * how you can use CSS to style your Element's container.
   */
    .StripeElement {
      box-sizing: border-box;

      height: 40px;

      padding: 10px 12px;

      border: 1px solid transparent;
      border-radius: 4px;
      background-color: white;

      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }
    .stripe-btn, .stripe-cancel-btn{
      border: none;
        border-radius: 4px;
        outline: none;
        text-decoration: none;
        color: #fff;
        background: #32325d;
        white-space: nowrap;
        display: inline-block;
        height: 40px;
        line-height: 40px;
        padding: 0 14px;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
        border-radius: 4px;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.025em;
        text-decoration: none;
        -webkit-transition: all 150ms ease;
        transition: all 150ms ease;      
        margin-left: 12px;
        margin-top: 28px;
    }
    .paypal-buttons-context-iframe{
        top: 19px;
    }    
    .gpay-card-info-container.black, .gpay-card-info-animation-container.black {
        height: 46px;
    }
    #google-pay-button{
      position: relative;
      top: 20px;
    }
    #apple-pay-button {
      height: 48px;
      width: 50%;
      display: inline-block;
      -webkit-appearance: -apple-pay-button;
      -apple-pay-button-type: plain;
      -apple-pay-button-style: black;
      vertical-align:top;
    }
    #google-pay-button, #apple-pay-button{
        display:inline-block;        
    }
    .api-button{
        display:block !important;
        width:90% !important;
        margin: 15px;
    }
    .vertical-alignment-helper {
        display:table;
        height: 100%;
        width: 100%;
        pointer-events:none;
    }
    .vertical-align-center {
        /* To center vertically */
        display: table-cell;
        vertical-align: middle;
        pointer-events:none;
    }
    .modal-content {
        /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
        width:inherit;
        max-width:inherit; /* For Bootstrap 4 - to avoid the modal window stretching full width */
        height:inherit;
        /* To center horizontally */
        margin: 0 auto;
        pointer-events:all;
    }
    #square-cancel-button{
      margin-left:23px;
    }

    .payment-status-container{
      padding:10px 0px;
    }

    .modal-total-amount{
      color: darkred;
      font-size: 19px;
      font-weight: bold;
      margin-bottom: 19px;
      display: block;
    }

    @media only screen and (max-width: 600px) {
      #square-payment-modal .modal-content {
        width:100% !important; 
      }
      #braintree-payment-modal .modal-content {
        width:100% !important; 
      }
      .square-pay-button{
        width:100% !important;
      }
      .btn-braintree-pay-now, .cancel-braintree{
        width:100% !important;
      }
      #google-pay-button{
        width:100%;
        top:3px !important;
      }
      #square-cancel-button{
        width:100% !important;
        margin-left:0px !important;
      }
      .gpay-card-info-container {
        width:100% !important;
      }
    }
</style>
<?php if($onlinePaymentAccount->converge_merchant_id != '' && $onlinePaymentAccount->converge_merchant_user_id != ''){ ?>
    <!-- Remove demo in url for production -->   
     <!--Demo  -->
    <!-- <script src="https://api.demo.convergepay.com/hosted-payments/Checkout.js"></script>
    <script src="https://demo.convergepay.com/hosted-payments/PayWithConverge.js"></script> -->
    <!-- Production -->
    <script src="https://api.convergepay.com/hosted-payments/Checkout.js"></script>
    <!-- <script src="https://convergepay.com/hosted-payments/PayWithConverge.js"></script> -->
    <script src="https://api.convergepay.com/hosted-payments/PayWithConverge.js"></script>
<?php } ?>
<?php 
function frontIsMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

if( frontIsMobile() ){
    include_once('job_customer_invoice_view_content_mobile.php');
}else{
    include_once('job_customer_invoice_view_content_desktop.php');
}
?>
<div class="modal fade fade" id="square-payment-modal" tabindex="-1" aria-labelledby="square_paynment_label" aria-hidden="true" style="margin-top:-1%;">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center modal-md">
        <div class="modal-content" style="width:45%;">            
            <div class="modal-header">                
                <span class="modal-title content-title" id="new_feed_modal_label">Square Payment</span>    
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
            </div>
            <div class="modal-body">
              <div class="square-form">
                    <div id="payment-form">
                      <span class="modal-total-amount"></span>
                      <div id="payment-status-container"></div>                        
                      <div id="card-container"></div>                                              
                      <button id="card-button" class="btn btn-primary square-pay-button" type="button">Pay Now</button>
                      <div id="google-pay-button"></div>
                      <?php if( isApple() ){ ?>
                      <div id="apple-pay-button"></div>
                      <?php } ?>
                      <button id="square-cancel-button" class="btn btn-primary" type="button">Cancel</button>
                      
                  </div>
              </div>                 
            </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade fade" id="braintree-payment-modal" tabindex="-1" aria-labelledby="square_paynment_label" aria-hidden="true" style="margin-top:-1%;">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center modal-md">
        <div class="modal-content" style="width:45%;">            
            <div class="modal-header">                
                <span class="modal-title content-title" id="new_feed_modal_label">Braintree Payment</span>    
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
            </div>
            <div class="modal-body">
              <div class="braintree-form">
                <span class="modal-total-amount"></span>
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <div id="bt-dropin"></div>                  
                <button type="submit" class="btn btn-primary btn-braintree-pay-now" id="btn-billing-pay-now">Pay Now</button> 
                <a class="cancel-braintree btn btn-primary" href="javascript:void(0);">Cancel</a>       
              </div>               
            </div>
        </div>
    </div>
  </div>
</div>

<?php include viewPath('includes/footer_pages'); ?>
<script>
$(function(){
  function updateJobToPaid(payment_method){
    var job_id = $("#jobid").val();
    var url = base_url + '_update_job_status_paid';
    $.ajax({
       type: "POST",
       url: url,
       dataType: "json",
       data: {job_id:job_id,payment_method:payment_method},
       success: function(o)
       {
          $(".payment-api-container").hide();
          Swal.fire({
            icon: 'success',
            title: 'Payment Successful',
            text: 'Payment process completed.'
          });            
       }
    });
  }
  //Converge payment
  $(".btn-pay-converge").click(function(){
    //initiateLightbox();
    var token = $('#converge-token').val();
    openLightbox(token);
  });

  $('.btn-pay-braintree').click(function(){
    var text_total_amount = $('.form-total-amount-label').text();      
    $('.modal-total-amount').text(text_total_amount);
    $('#braintree-payment-modal').modal('show');
    //$('.braintree-form').show();
    //$('.payment-api-container').hide();
  });

  $('.cancel-braintree').click(function(){
    $('#braintree-payment-modal').modal('hude');
    //$('.braintree-form').hide();
    //$('.payment-api-container').show();
  });

  $('.btn-confirm-order').click(function(){
    var job_id = $("#jobid").val();
    var total_amount = $("#total_amount").val();
    <?php if($onlinePaymentAccount->converge_merchant_user_id != '' && $onlinePaymentAccount->converge_merchant_pin != ''){ ?>
        var url = base_url + '_converge_request_token';
        $(".btn-confirm-order").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: {job_id:job_id, total_amount:total_amount},
               success: function(o)
               {
                    if( o.is_success ){
                        $('#converge-token').val(o.token);    
                        <?php if( isApple() ){ ?>
                        initiateApplePay(o.token);          
                        <?php } ?>

                        $(".btn-pay-converge").show();

                        <?php if($braintree_token != ''){ ?>
                            $(".btn-pay-braintree").show();
                        <?php } ?>

                        <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
                            $(".btn-pay-stripe").show();
                        <?php } ?>

                        <?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
                            $(".btn-pay-square").show();
                        <?php } ?>

                        <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
                            // Render the PayPal button into #paypal-button-container
                            paypal.Buttons({
                                style: {
                                    layout: 'horizontal',
                                    tagline: false,
                                    height:45,
                                    color:'blue'
                                },
                                // Set up the transaction
                                createOrder: function(data, actions) {
                                    return actions.order.create({                
                                        purchase_units: [{
                                            amount: {
                                                value: $("#total_amount").val()
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
                                        //console.log(details);
                                        updateJobToPaid('converge');       
                                    });
                                }
                            }).render('#paypal-button-container');
                        <?php } ?>
                        $(".btn-confirm-order").hide();

                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Cannot Process Payment',
                          text: o.msg
                        });

                        $(".btn-confirm-order").html('CONFIRM ORDER');
                    }
               }
            });
        }, 1000);
    <?php }else{ ?>
        $(".btn-confirm-order").hide();
        
        <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
            $(".btn-pay-stripe").show();
        <?php } ?>

        <?php if($braintree_token != ''){ ?>
            $(".btn-pay-braintree").show();
        <?php } ?>

        <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
            // Render the PayPal button into #paypal-button-container
            paypal.Buttons({
                style: {
                    layout: 'horizontal',
                    tagline: false,
                    height:45,
                    color:'blue'
                },
                // Set up the transaction
                createOrder: function(data, actions) {
                    return actions.order.create({                
                        purchase_units: [{
                            amount: {
                                value: $("#total_amount").val()
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
                        //console.log(details);
                        updateJobToPaid();       
                    });
                }
            }).render('#paypal-button-container');
        <?php } ?>

    <?php } ?>
  });
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
                var jobid = $('#jobid').val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>_braintree_process_payment",
                    data: {jobid:jobid, nonce:nonce},
                    dataType: 'json',
                    success: function(o) {                    
                        if(o.is_success === 1){
                            $('.braintree-form').hide();
                            updateJobToPaid();
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

                        $("#btn-billing-pay-now").html('Pay Now');
                    },beforeSend: function() {
                        $("#btn-billing-pay-now").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                    }
                }); 
            });
          });
        });
    <?php } ?>        
    /*End Braintree Payment*/

    //Converge
    function initiateLightbox () {
      var job_id = $("#jobid").val();
      var total_amount = $("#total_amount").val();

      var url = base_url + '_converge_request_token';
      $(".btn-pay-converge").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: {job_id:job_id, total_amount:total_amount},
           success: function(o)
           {
              if( o.is_success ){
                  //initiateApplePay(o.token);
                  openLightbox(o.token);                  
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot Process Payment',
                  text: o.msg
                });
              }

              $(".btn-pay-converge").html('PAY NOW');
           }
        });
      }, 1000);
    }

    function initiateApplePay(token){
        var paymentFields = {
            ssl_txn_auth_token: token
        };
        var callback = {
            onError: function (error) {
                //showResult("error", error);
                Swal.fire({
                  icon: 'error',
                  title: 'Declined',
                  text: 'Apple Pay not available'
                });
            },
            onCancelled: function () {
                //showResult("cancelled", "");
            },
            onDeclined: function (response) {
                //showResult("declined", JSON.stringify(response, null, '\t'));
            },
            onApproval: function (response) {
                //showResult("approval", JSON.stringify(response, null, '\t'));
            }
        };
        ConvergeEmbeddedPayment.initApplePay('applepay-button', paymentFields, callback);
        return false;
    }

    function openLightbox (token) {
      var paymentFields = {
              ssl_txn_auth_token: token
      };
      var callback = {
          onError: function (error) {
              //showResult("error", error);
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error
              });
          },
          onCancelled: function () {
              //showResult("cancelled", "");
          },
          onDeclined: function (response) {
            Swal.fire({
              icon: 'error',
              title: 'Declined',
              text: 'Cannot process payment'
            });
            //showResult("declined", JSON.stringify(response, null, '\t'));
            //updateJobToPaid();
          },
          onApproval: function (response) {              
              updateJobToPaid();
              //showResult("approval", JSON.stringify(response, null, '\t'));
          }
      };
      PayWithConverge.open(paymentFields, callback);

      return false;
    }
    /*End Converge*/

    //Stripe Payment
    <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>    
        var handler = StripeCheckout.configure({
            key: '<?= $onlinePaymentAccount->stripe_publish_key; ?>',
            image: '',
            token: function(token) {
              updateJobToPaid();                  
            }
        });

        $('.btn-pay-stripe').on('click', function(e) {
        var amountInCents = Math.floor($("#total_amount").val() * 100);
        var displayAmount = parseFloat(Math.floor($("#total_amount").val() * 100) / 100).toFixed(2);
        // Open Checkout with further options
        handler.open({
            image : '<?= base_url('/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image); ?>',
            name: $("#job-number").val(),
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

    //Paypal
    <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
        
    <?php } ?>
    /*End paypal*/

    //Square
    $('.btn-pay-square').on('click',function(){
      var text_total_amount = $('.form-total-amount-label').text();
      $('#square-payment-modal').modal('show');
      $('.modal-total-amount').text(text_total_amount);
      //$('.payment-api-container').hide();
      //$('.square-form').show();
    });
    $('#square-cancel-button').on('click', function(){
        $('#square-payment-modal').modal('hide');
        //$('.payment-api-container').show();
        //$('.square-form').hide();
    });
    //End Square Payment
});
</script>
<?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
<!-- Square Payment -->
<script type="module">
    const jobid = document.getElementById('jobid').value;
    const payments = Square.payments('sandbox-sq0idb-_QITXE8-SXhp_NdfL99Vdw', '<?= $onlinePaymentAccount->square_location_id; ?>');
    const card = await payments.card();
    await card.attach('#card-container');

    const square_total_amount = document.getElementById('total_amount').value;
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
            const square_response = await fetch(base_url + `_square_process_payment`, {
                  method: "POST",
                  body: JSON.stringify({ token: tokenResult.token, jobid:jobid, source_type:source_type }),
                  headers: {    
                      accepts: "application/json",                
                      "content-type": "application/json",
                  },
              });    
              const data = await square_response.json();  
              if( data.is_success == 1 ){
                  $('.payment-api-container').hide();
                  $('.square-form').hide();

                  Swal.fire({
                      icon: 'success',
                      title: 'Payment Successful',
                      text: 'Payment process completed.'
                  });       
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
            const square_response = await fetch(base_url + `_square_process_payment`, {
                method: "POST",
                body: JSON.stringify({ token: tokenResult.token, jobid:jobid, source_type:source_type }),
                headers: {    
                    accepts: "application/json",                
                    "content-type": "application/json",
                },
            });    
            const data = await square_response.json();  
            if( data.is_success == 1 ){
                $('.payment-api-container').hide();
                $('.square-form').hide();

                Swal.fire({
                    icon: 'success',
                    title: 'Payment Successful',
                    text: 'Payment process completed.'
                });       
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
            const square_response = await fetch(base_url + `_square_process_payment`, {
                method: "POST",
                body: JSON.stringify({ token: result.token, jobid:jobid, source_type:source_type }),
                headers: {    
                    accepts: "application/json",                
                    "content-type": "application/json",
                },
            });    
            const data = await square_response.json();  
            if( data.is_success == 1 ){
                $('.payment-api-container').hide();
                $('.square-form').hide();

                Swal.fire({
                    icon: 'success',
                    title: 'Payment Successful',
                    text: 'Payment process completed.'
                });       
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
