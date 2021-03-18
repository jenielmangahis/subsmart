<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
                                    <hr />
                                    <div class="margin-top" style="color:#888888;">
                                      For any issues with your order, click here to <a href="<?= base_url('contact'); ?>" target="_new" style="color:#259e57;">contact us</a>.
                                    </div>
                                    <div style="color:#888888;">
                                      <p>By clicking Purchase button you agree to <a href="<?= base_url("terms-and-condition"); ?>" style="color:#259e57;" target="_new">NSmarTrac's Terms & Conditions</a>, <a href="<?= base_url("privacy-policy"); ?>" style="color:#259e57;" target="_new">Privacy Policy</a> and <a href="<?= base_url("anti-spam-policy"); ?>" style="color:#259e57;" style="color:#259e57;" target="_new">Anti-Spam Policy</a></p>
                                    </div>
                                    <hr class="card-hr" />
                                    <div class="row">
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
<script>
$(function(){
    $(".btn-sms-purchase").click(function(){
      var url = base_url + 'sms_campaigns/process_payment';
      $(".btn-sms-purchase").html('<span class="spinner-border spinner-border-sm m-0"></span>  Processing Payment');
      var payment_method = $('input[name="payment_method"]:checked').val();  
      if( payment_method == 'paypal' || payment_method == 'converge' ){
        $( "#payment-sms-blast" ).submit();
      }else if( payment_method == 'stripe' ){

      }else{
        Swal.fire({
          icon: 'error',
          title: 'Cannot Process Payment',
          text: 'Please select payment method'
        })
      }
      $(".btn-sms-purchase").html('Purchase');
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
});
</script>
