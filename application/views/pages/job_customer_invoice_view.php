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
</style>
<?php if($onlinePaymentAccount->converge_merchant_id != '' && $onlinePaymentAccount->converge_merchant_user_id != ''){ ?>
    <!-- Remove demo in url for production -->    
    <script src="https://api.demo.convergepay.com/hosted-payments/Checkout.js"></script>
    <script src="https://demo.convergepay.com/hosted-payments/PayWithConverge.js"></script>
    <!-- <script src="https://api.convergepay.com/hosted-payments/PayWithConverge.js"></script> -->
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
    $('.braintree-form').show();
    $('.payment-api-container').hide();
  });

  $('.cancel-braintree').click(function(){
    $('.braintree-form').hide();
    $('.payment-api-container').show();
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
});
</script>
