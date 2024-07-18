<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>nSmartrac: <?= $invoice->invoice_number; ?> Invoice </title>

    <style>
        body {
            margin: 0;
            font-size: 14px;
            background-color:#ffffff !important;
        }

        .container {
            padding: 16px;
            background-color: #f5f5f5;
        }

        .main {
            width: 800px;
            margin: auto;
            padding: 16px;
            box-sizing: border-box;
            background-color: #fff;
        }

        table {
            width: 100%;
        }

        .payinvoice {
            display: block;
            height: 50px;
            line-height: 50px;
            font-size: 20px;
            text-decoration: none;
            width: 90%;
            margin: auto;
            border-radius: 8px;
            text-align: center;
            background-color: #64477d;
            color: #fff !important;
            box-shadow: 0px 15px 20px #64477d87;
            max-width: 200px;
        }

        .companyimage {
            width: 85px;                 
            background-color: #ffffff;
            display: block;
            margin:10px 0px;
        }

        .companyimage.companyimage-big {
            width: 265px;
            height: auto;
            min-width: 100px;
            min-height: 100px;
        }
        .container-left{
            width:50%;
            float:left;
        }
        .container-right{
            width:50%;
            float:right;
        }
        .clear{
            clear:both;
        }

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
        #btn-pay-stripe{
            display:block;
            width: 95%;
            margin-left: 7px;
            text-align: center;
            margin-top:10px;
            background-color: #6a4a86 !important;
            color: #fff;
            border: 1px solid #d3d3d3;
            border-radius: 5px;
            padding: 0.5em 0.7em;
            font-size: 14px;
            font-weight: 700;
        }
        #btn-braintree-pay-now, #card-button{
            width: 100%;
            margin-left: -1px;
            text-align: center;
        }
    </style>

    <?php include viewPath('includes/header_front'); ?>
      
    <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
        <script src="https://js.stripe.com/v3/"></script>
        <script src="https://checkout.stripe.com/checkout.js"></script>    
    <?php } ?>
    <script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.min.js"></script>
    <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
    <script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD"></script>
    <?php } ?>
    <?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
        <link rel="stylesheet" href="/reference/sdks/web/static/styles/code-preview.css" preload>
        <script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
    <?php } ?>

</head>

<body>
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
<?= $invoice_template; ?>
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
  
  $('.payinvoice').on('click', function(){
    $(this).hide();
    $('.online-payment-container').show();
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

  