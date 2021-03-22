<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<script src="https://js.stripe.com/v3/"></script>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.tabs-menu {
    margin-bottom: 20px;
    padding: 0;
    margin-top: 20px;
}
.tabs-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.md-right {
  float: right;
  width: max-content;
  display: block;
  padding-right: 0px;
}
.tabs-menu .active, .tabs-menu .active a {
    color: #2ab363;
}
.tabs-menu li {
    float: left;
    margin: 0;
    padding: 0px 83px 0px 0px;
    font-weight: 600;
    font-size: 17px;
}
.cart-summary-total{
  /*font-weight: bold;*/
  font-size: 22px;
}
.payment-method{
  padding: 0px;
  list-style: none;
}
.payment-method li{
  margin-bottom: 35px;
}
.payment-method li input{
  margin-right: 10px;
}
.payment-method li img{
  display: inline-block;
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <!--
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Create SMS Campaign</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Start a new SMS campaign to promote your business.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                    <a href="<?php echo url('sms_campaigns') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to SMS Blast list
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
            <!-- end row -->
            <?php echo form_open_multipart('sms_campaigns/process_payment', ['class' => 'form-validate', 'id' => 'payment-sms-blast', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Purchase</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('sms_campaigns') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to SMS Blast list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">The final step is to purchase the campaign.
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li>1. Create Campaign</li>
                                  <li>2. Select Customers</li>
                                  <li>3. Build SMS</li>
                                  <li>4. Preview</li>
                                  <li class="active">5. Purchase</li>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-8">                                    
                                    <div class="payment-options">
                                      <p><b>Select Payment Method</b></p>
                                      <ul class="payment-method">
                                        <li>
                                          <input type="radio" id="paypal" name="payment_method" value="paypal">
                                          <img src="<?php echo $url->assets ?>img/paypal-logo.png" alt="" style="height: 62px;">
                                        </li>
                                        <li>
                                          <input type="radio" id="stripe" name="payment_method" value="stripe">
                                          <img src="<?php echo $url->assets ?>img/stripe-logo.png" alt="" style="height: 62px;">
                                        </li>
                                        <li>
                                          <input type="radio" id="converge" name="payment_method" value="converge">
                                          <img src="<?php echo $url->assets ?>img/converge-logo.png" alt="" style="height: 62px;">
                                        </li>
                                      </ul> 
                                    </div>
                                    
                                    <div class="stripe-form" style="display: none;">
                                      <div class="col-md-12">
                                        <h4 class="font-weight-bold pl-0 my-4" style="font-size: 17px;"><strong>Stripe Payment Method</strong></h3>
                                          <div class="payment-method" style="display: block;margin-bottom: 16px;">
                                            <label>SMS Campaign</label><br />
                                            <label>Total Amount : <b><span class="total-amount">$<?= number_format($grand_total, 2); ?></span></b></label><br />
                                            <hr />
                                          </div>
                                        <div id="card-element"></div>                       
                                        <div id="card-errors" role="alert"></div>
                                        <button class="stripe-btn">Submit Payment</button>`
                                        <button type="button" class="stripe-cancel-btn margin-right">Cancel</button>
                                      </div>
                                    </div>
                                    <div class="clear clearfix"></div>
                                    <hr />
                                    <div class="margin-top" style="color:#888888;">
                                      For any issues with your order, click here to <a href="<?= base_url('contact'); ?>" target="_new" style="color:#259e57;">contact us</a>.
                                    </div>
                                    <div style="color:#888888;">
                                      <p>By clicking Purchase button you agree to <a href="<?= base_url("terms-and-condition"); ?>" style="color:#259e57;" target="_new">NSmarTrac's Terms & Conditions</a>, <a href="<?= base_url("privacy-policy"); ?>" style="color:#259e57;" target="_new">Privacy Policy</a> and <a href="<?= base_url("anti-spam-policy"); ?>" style="color:#259e57;" style="color:#259e57;" target="_new">Anti-Spam Policy</a></p>
                                    </div>
                                    <hr class="card-hr" />
                                    <div class="row form-footer-container">
                                      <div class="col-md-4">
                                        <button type="button" class="btn btn-flat btn-primary margin-right btn-sms-purchase" style="margin-right: 0px;">Purchase</button>
                                      </div>
                                      <div class="col-md-8" style="text-align: right;"><strong>Amount to Pay $<?= number_format($grand_total, 2); ?></strong></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cart-summary" style="background-color: #f2f2f2;padding: 20px;">
                                      <div class="row margin-bottom-sec ">
                                        <div class="col-md-8"><strong style="font-size: 15px;">SMS Campaign</strong></div>
                                      </div>
                                      <div class="row margin-top-sec margin-bottom-sec">
                                        <div class="col-md-6"><strong style="font-size: 15px;">Amount to Pay</strong></div>
                                        <div class="col-md-6"><span class="cart-summary-total">$<?= number_format($grand_total, 2); ?></span></div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="col-md-4 form-group md-right">
                                    <a class="btn btn-default margin-right" href="<?php echo url('sms_campaigns/preview_sms_message/'); ?>">&laquo; Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
<script>
$(function(){
    $(".btn-sms-purchase").click(function(){      
      $(".btn-sms-purchase").html('<span class="spinner-border spinner-border-sm m-0"></span>  Processing Payment');
      
      var payment_method = $('input[name="payment_method"]:checked').val();  
      
      if( payment_method == 'paypal' ){
        var url = base_url + 'sms_campaigns/_load_paypal';
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#create_sms_blast").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    location.href = o.approvalUrl;
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Cannot Process Payment',
                    text: o.msg
                  });
                  $(".btn-sms-purchase").html('Purchase');
                }
             }
          });
        }, 1000);


      }else if( payment_method == 'converge' ){
        $( "#payment-sms-blast" ).submit();
      }else if( payment_method == 'stripe' ){
        $(".payment-options").hide();
        $(".form-footer-container").hide();
        $(".btn-sms-purchase").html('Purchase');
        $(".stripe-form").show();
      }else{
        Swal.fire({
          icon: 'error',
          title: 'Cannot Process Payment',
          text: 'Please select payment method'
        });
        $(".btn-sms-purchase").html('Purchase');
      }
    });

    $(".stripe-cancel-btn").click(function(){
      $(".payment-options").show();
      $(".form-footer-container").show();      
      $(".stripe-form").hide();
    });

    $("#create_sms_blast").submit(function(e){
        e.preventDefault();
        var url = base_url + 'sms_campaigns/save_draft_campaign';
        $(".btn-campaign-save-draft").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#create_sms_blast").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "sms_campaigns/add_campaign_send_to";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                    $(".btn-campaign-save-draft").html('Continue »');
                }
             }
          });
        }, 1000);
    });

    // Create a Stripe client.
    var stripe = Stripe('pk_test_51Hzgs3IDqnMOqOtpSskepkfFhP2rFNJ0wTtuKB6Ye6wJA75uHL5rMOi7JwWajcag33ScyPywLTKMGNbgdsPxVJiG00kZxZnPNu');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    // Handle form submission.
    var form = document.getElementById('payment-sms-blast');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      $(".stripe-btn").html('<span class="spinner-border spinner-border-sm m-0"></span>  Processing Payment');
      stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
          $(".stripe-btn").html('Submit Payment');
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-sms-blast');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);

      // Submit the form
      stripeUpdateSmsPayment();
      //form.submit();
    }

    function stripeUpdateSmsPayment(){
      $(".payment-method").html('<div class="alert alert-success">Payment process completed.</div>');
      $(".stripe-btn").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      var url = base_url + 'sms_campaigns/process_stripe_payment';
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data:$("#payment-sms-blast").serialize(),
           success: function(o)
           {
              location.href = base_url + 'sms_campaigns';
           }
        });
      }, 1000);
    }
});
</script>
