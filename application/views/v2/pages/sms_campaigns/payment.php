<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

<style>
    div[wrapper__section] {
        padding: 60px 10px !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
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
    .cc-list{
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .cc-list li{
      margin: 25px;
      margin-left: 0px;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            <div>The final step is to purchase the campaign.</div>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'payment-sms-blast', 'autocomplete' => 'off']); ?>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li>1. Create Campaign</li>
                          <li>2. Select Customers</li>
                          <li>3. Build SMS</li>
                          <li>4. Preview</li>
                          <li class="active">5. Purchase</li>
                        </ul>
                    </div>                    
                    <div class="row mt-5">
                        <div class="col-md-8">                                    
                            <div class="payment-options">
                              <!-- p style="font-size: 19px;"><b>Payment Method</b></p> -->
                              <p style="font-size: 15px;"><b>Pay securely using your credit card.</b></p>
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
                                  <label class="weight-normal"><input type="checkbox" name="chk_terms" id="chk-terms" value="1" checked="checked">
                                  <span style="display: inline-block;">Securely save my card for future purchases</span></label>
                                  <span class="help help-block help-sm">Easy to pay on your future purchases.</span>
                              </div> 
                            </div>
                            <hr style="width:61%;" />
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
                            
                            <div class="margin-top" style="color:#888888;">
                              For any issues with your order, click here to <a href="<?= base_url('contact'); ?>" target="_new" style="color:#259e57;">contact us</a>.
                            </div>
                            <div style="color:#888888;">
                              <p>By clicking Purchase button you agree to <a href="<?= base_url("terms-and-condition"); ?>" style="color:#259e57;" target="_new">NSmarTrac's Terms & Conditions</a>, <a href="<?= base_url("privacy-policy"); ?>" style="color:#259e57;" target="_new">Privacy Policy</a> and <a href="<?= base_url("anti-spam-policy"); ?>" style="color:#259e57;" style="color:#259e57;" target="_new">Anti-Spam Policy</a></p>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="cart-summary" style="background-color: #f2f2f2;padding: 20px;">
                              <div class="row margin-bottom-sec ">
                                <div class="col-md-8"><strong style="font-size: 15px;">SMS Campaign</strong></div>
                              </div>
                              <div class="row margin-top-sec margin-bottom-sec">
                                <div class="col-md-6"><strong style="font-size: 15px;">Amount to Pay</strong></div>
                                <div class="col-md-6"><span class="cart-summary-total" style="font-size: 21px;"><b>$<?= number_format($grand_total, 2); ?></b></span></div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">                        
                        <div class="col-sm-6 text-right">
                            <button type="submit" class="nsm-button primary margin-right btn-sms-purchase" style="margin-right: 0px;">Purchase</button>
                            <a class="nsm-button" href="<?php echo url('sms_campaigns/preview_sms_message/'); ?>" style="margin-right: 10px;">&laquo; Back</a>
                        </div>
                    </div>                    
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
    $("#payment-sms-blast").submit(function(e){
        e.preventDefault();

        var url = base_url + 'sms_campaigns/activate_campaign';
        $(".btn-sms-purchase").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#payment-sms-blast").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    Swal.fire({
                        title: 'Update Successful!',
                        text: 'SMS Campaign was successfully activated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href= base_url + 'sms_campaigns/payment_details';
                        }
                    });
                    
                }else{
                    Swal.fire({
                      icon: 'error',
                      title: 'Cannot activate campaign.',
                      text: o.msg
                    });
                }

                $(".btn-sms-purchase").html('Purchase');
             }
          });
        }, 1000);
    });
});
</script>