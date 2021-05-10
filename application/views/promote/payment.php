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
.card-help {
    padding-left: 45px;
    padding-top: 10px;
}
.text-ter {
    color: #888888;
}
.card-type.visa {
    background-position: 0 0;
}
.card-type {
    margin-left: 25px;
    display: inline-block;
    width: 30px;
    height: 20px;
    background: url(<?= base_url("/assets/img/credit_cards.png"); ?>) no-repeat 0 0;
    background-size: cover;
    vertical-align: middle;
    margin-right: 10px;
}
.card-type.americanexpress {
    background-position: -83px 0;
}
.expired{
  color:red;
}
.card-type.discover {
    background-position: -125px 0;
}
input[type="radio"], input[type="checkbox"] {
    margin: 4px 5px 0 0 !important;
}
input[type=checkbox], input[type=radio] {
    margin: 4px 0 0;
    margin-top: 1px\9;
    line-height: normal;
}
input[type=checkbox], input[type=radio] {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding: 0;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
}
label>input {
  visibility: visible;
}
.cc-list li{
  margin: 25px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'activate-deals-steals', 'autocomplete' => 'off']); ?>
            <input type="hidden" id="order-number" name="order_number" value="">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Purchase Deal</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('promote/deals') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Deals Steals list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">The final step is to purchase the deal.
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="form-msg" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <ul class="clearfix">
                                    <li><a href="<?= base_url("promote/edit_deals/" . $dealsSteals->id); ?>">1. Edit Deal</a></li>
                                    <li><a href="<?= base_url("promote/add_send_to"); ?>">2. Select Customers</a></li>
                                    <li><a href="<?= base_url("promote/build_email"); ?>">3. Build Email</a></li>
                                    <li><a href="<?= base_url("promote/preview_email_message"); ?>">4. Preview</a></li>
                                    <li class="active"><a href="<?= base_url("promote/payment"); ?>">5. Purchase</a></li>
                                  </ul>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6">                                    
                                    <div class="payment-options">
                                      <p style="font-size: 23px;"><b>Payment Method</b></p>
                                      <p>Pay securely using your credit card.</p>
                                      <ul class="cc-list">
                                      <?php foreach($creditCards as $c){ ?>
                                        <li>
                                          <?php 
                                            $is_checked = '';
                                            if( $emailBlast->cards_file_id == $c->id ){
                                              $is_checked = 'checked="checked"';
                                            }
                                          ?>
                                          <label class="weight-normal"><input <?= $is_checked; ?> type="radio" name="payment_method_token" value="<?= $c->id; ?>">
                                          <?php 
                                            $card_type = strtolower($c->cc_type); 
                                            $card_type = str_replace(" ", "", $card_type);
                                          ?>
                                          <span class="card-type <?= $card_type; ?>"></span>                                       
                                          <?php 
                                            $card_number = maskCreditCardNumber($c->card_number);
                                            echo $card_number;
                                          ?>   
                                          <?php
                                            $today = date("y-m-d");  
                                            $day   = date("d");                                 
                                            $expires = date("y-m-d",strtotime($c->expiration_year . "-" . $c->expiration_month . "-" . $day));
                                            $expired = 'expires';
                                            if( strtotime($expires) < strtotime($today) ){
                                              $expired = 'expired';
                                            }
                                            
                                          ?>   
                                            <span class="<?= $expired; ?>"> (<?= $expired; ?> <?= $c->expiration_month . "/" . $c->expiration_year; ?>)</span>
                                          </label>
                                        </li>
                                      <?php } ?>
                                      </ul>
                                      <div data-payment="cc-save-container">
                                          <label class="weight-normal"><input type="checkbox" name="is_auto_renew" id="is_auto_renew" value="1" checked="checked">
                                          <span style="display: inline-block;margin-left: 22px;">Keep this deal active until I cancel it (auto-renew)</span></label>
                                          <span class="help help-block help-sm">This will auto charge your card at the end of the billing cycle.</span>
                                      </div>
                                    </div>
                                    
                                    <div class="stripe-form" style="display: none;">
                                      <div class="col-md-12">
                                        <h4 class="font-weight-bold pl-0 my-4" style="font-size: 17px;"><strong>Stripe Payment Method</strong></h3>
                                          <div class="payment-method" style="display: block;margin-bottom: 16px;">
                                            <label>Deal</label><br />
                                            <label>Total Amount : <b><span class="total-amount">$<?= number_format($total_price, 2); ?></span></b></label><br />
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
                                        <button type="submit" class="btn btn-flat btn-primary margin-right btn-deals-steals-activate" style="margin-right: 0px;">Purchase</button>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="cart-summary" style="background-color: #f2f2f2;padding: 20px;">
                                      <div class="row margin-bottom-sec ">
                                        <div class="col-md-6"><strong style="font-size: 15px;">Deal</strong></div>
                                        <div class="col-md-6"><strong style="font-size: 15px;"><?= $dealsSteals->title; ?></strong></div>
                                      </div>
                                      <div class="row margin-bottom-sec ">
                                        <div class="col-md-6"><strong style="font-size: 15px;">Package</strong></div>
                                        <div class="col-md-6"><strong style="font-size: 15px;">1 Month for $<?= number_format($deals_price, 2); ?></strong></div>
                                      </div>
                                      <div class="row margin-bottom-sec ">
                                        <div class="col-md-6"><strong style="font-size: 15px;">Valid Period</strong></div>
                                        <div class="col-md-6"><strong style="font-size: 15px;"><?= date("d-M-Y", strtotime($dealsSteals->valid_from)) . " to " . date("d-M-Y", strtotime($dealsSteals->valid_to)) ?></strong></div>
                                      </div>
                                      <div class="row margin-top-sec margin-bottom-sec">
                                        <div class="col-md-6"><strong style="font-size: 15px;">Amount to Pay</strong></div>
                                        <div class="col-md-6"><span class="cart-summary-total" style="font-size: 22px;">$<?= number_format($deals_price, 2); ?></span></div>
                                      </div>
                                    </div>
                                    <div class="row margin-top-sec margin-bottom-sec" style="text-align: center;">
                                      <div class="payment-ssl" style="margin-top: 60px;text-align: center;width: 100%;">
                                          <div class="margin-bottom">
                                              <img src="<?= base_url("assets/img/credit_cards.png") ?>" style="display: inline-block;margin-bottom: 20px;" /><br />
                                              <div class="text-ter">We accept all major credit cards</div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="col-md-4 form-group md-right">
                                    <a class="btn btn-default margin-right" href="<?php echo url('promote/preview_email_message/'); ?>">&laquo; Back</a>
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

    function activate_deals(){
      var url = base_url + 'promote/_activate_deals';
      $(".btn-deals-steals-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: $("#activate-deals-steals").serialize(),
           success: function(o)
           {
              if( o.is_success ){
                  Swal.fire({
                      title: 'Update Successful!',
                      text: 'Deals was successfully activated',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      if (result.value) {
                          window.location.href= base_url + 'promote/payment_details';
                      }
                  });
              }else{
                  Swal.fire({
                    icon: 'error',
                    title: o.msg,
                    text: 'Cannot activate deals'
                  });
              }
           }
        });
      }, 1000);
    }

    $("#activate-deals-steals").submit(function(e){
        e.preventDefault();

        var url = base_url + 'promote/_converge_send_payment';
        $(".btn-deals-steals-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: $("#activate-deals-steals").serialize(),
           success: function(o)
           {
              if( o.is_success ){
                $("#order-number").val(o.order_number);
                activate_deals();
              }else{
                  Swal.fire({
                    icon: 'error',
                    title: o.msg,
                    text: 'Cannot activate deals'
                  });
              }
              $(".btn-deals-steals-activate").html('Purchase');
           }
        });
      }, 1000);
        
        
    });
});
</script>
