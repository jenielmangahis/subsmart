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
                            <div>The final step is to activate payments for automation.</div>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'activate-automation', 'autocomplete' => 'off']); ?>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li>1. Set Rules</li>
                          <li>2. Build SMS</li>
                          <li>3. Preview</li>
                          <li class="active">4. Payment</li>
                        </ul>
                    </div>                    
                    <div class="row mt-5">
                        <div class="col-md-6 form-group">
                            <p style="font-size:18px;"><b>SMS Automation Payment</b></p>
                            <ul class="payment-list" style="">
                              <li st>Your card will be billed monthly on your subscription day.</li>
                              <li>The amount is calculated based on the total number of text messages sent for that month.</li>
                              <li>You will be charged $0.10 for one text.</li>
                              <li>You can see a log with number of texts sent for each automation.</li>
                              <li>You can pause or delete an automation at any time.</li>
                            </ul>
                            <br />
                            <div class="checkbox checkbox-sm">
                                <input class="checkbox-select chk-terms" type="checkbox" name="accept_terms" value="1" id="chk-terms">
                                <label for="chk-terms">I agree to bill my card (<?= $primaryCard->cc_type; ?> <?= maskCreditCardNumber($primaryCard->card_number); ?>)</label>
                            </div>
                            <br />
                            <div class="terms-condition">
                              <p>By clicking Activate button you agree to <a href="<?= base_url("terms-and-condition"); ?>" style="color:#259e57;" target="_new">NSmarTrac's Terms & Conditions</a>, <a href="<?= base_url("privacy-policy"); ?>" style="color:#259e57;" target="_new">Privacy Policy</a> and <a href="<?= base_url("anti-spam-policy"); ?>" style="color:#259e57;" style="color:#259e57;" target="_new">Anti-Spam Policy</a></p>
                            </div>  
                        </div>
                    </div>
                    <div class="row mt-5">                        
                        <div class="col-sm-6 text-right">
                            <a class="nsm-button" href="<?php echo url('sms_automation/preview_sms_message'); ?>" style="margin-right: 10px;">&laquo; Back</a>
                            <button type="submit" class="nsm-button primary btn-automation-activate" style="margin-right: 0px;">Purchase</button>                            
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
    $("#activate-automation").submit(function(e){
        e.preventDefault();

        if( $("#chk-terms").is(":checked") ){
          var url = base_url + 'sms_automation/activate_automation';
          $(".btn-automation-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
          setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#activate-automation").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $('.form-msg').hide().html("<p class='alert alert-info'>"+o.msg+"</p>").fadeIn(500);
                      $(".btn-automation-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>  Redirecting to list');
                      setTimeout(function() {
                          location.href = base_url + "sms_automation";
                      }, 2500);
                  }else{
                      $(".btn-automation-activate").html('Activate Automation');

                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot activate automation.',
                        text: 'Please try again later'
                      });
                  }
               }
            });
          }, 1000);
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Cannot proceed.',
            text: 'Please check form inputs'
          });
        }

        
    });
});
</script>