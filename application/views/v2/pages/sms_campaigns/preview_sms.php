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
    .phone {
        display: inline-block;
        background: url(<?php echo base_url() ?>/assets/img/sms_preview_phone.png) no-repeat 0 0;
        width: 350px;
        height: 530px;
    }
    .phone__cnt {
        margin: 190px 65px 0 50px;
    }
    .sms-blast-msg {
        background: #e5e5ea;
        border-radius: 20px;
        padding: 15px;
        margin-bottom: 10px;
        text-align: left;
        position: relative;
    }
    .sms-blast-msg:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 20%;
        width: 0;
        height: 0;
        border: 20px solid transparent;
        border-right-color: #e5e5ea;
        border-left: 0;
        border-bottom: 0;
        margin-top: -5px;
        margin-left: -10px;
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
                            <div>Preview and select when to send the SMS-es.</div>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'campaign_send_schedule', 'autocomplete' => 'off']); ?>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li>1. Edit Campaign</li>
                          <li>2. Select Customers</li>
                          <li>3. Build SMS</li>
                          <li class="active">4. Preview</li>
                          <li>5. Purchase</li>
                        </ul>
                    </div>                    
                    
                    <div class="row mt-5">
                        <div class="col-md-4 pl-0 pr-0 left" style="background-color: #ffffff !important;">
                            <div class="panel-info" style="background-color: #ffffff;">
                                <div class="phone" style="margin-left: 38px;">
                                    <div class="phone__cnt">
                                        <div class="sms-blast-msg"><?= $sms_text; ?></div>
                                    </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-8 pl-0 pr-0 left">
                            <div class="panel-info" style="margin-top: 29px;">
                                <div class="form-msg" style="display: none;"></div>
                                <div style="margin-bottom: 10px;">  
                                    <label>Price for service: <b>$<?= number_format($service_price, 2); ?></b></label>                                      
                                </div>
                                <div style="margin-bottom: 10px;">                                        
                                  <label>Price for all SMSes: <b>$<?= number_format($total_sms_price, 2); ?></label> (<?= $total_recipients; ?> x $<?= number_format($price_per_sms, 2); ?>)</b>
                                </div>
                                <div class="help help-sm help-block" style="margin-top:10px; margin-bottom: 20px;">
                                Pay a flat fee to use the service and only <b>$0.05</b> for each message (segment).The SMSes will be sent to your customers upon confirmation.
                                </div>
                                <div class="form-group">
                                    <div class="checkbox checkbox-sec">
                                      <?php 

                                        if($smsBlast->price_variables != ''){ 
                                          $is_scheduled = 'checked="checked"';
                                          $send_date = date("m/d/Y",strtotime($smsBlast->send_date));
                                          $send_time = date("H:i A", strtotime($smsBlast->send_time));
                                        }else{
                                          $is_scheduled = "";
                                          $send_date = date("m/d/Y");
                                          $send_time = date("H:i A");
                                        }

                                      ?>
                                      <input type="checkbox" name="is_scheduled" value="1"  id="is_scheduled" <?= $is_scheduled; ?> />
                                      <label style="font-weight: 500;" for="is_scheduled">Schedule Campaign</label>
                                    </div>
                                    <div class="select-date-time" style="display: none;">
                                      <br />
                                        <div class="help help-sm help-block">Select this to set a date if you would like to schedule this campaign.</div>
                                        <div class="hide" id="scheduled">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="input-group mb-3" style="display: grid;">
                                                        <div class="input-group-prepend">                                                          
                                                          <input type="text" name="send_date" value="<?= $send_date; ?>"  class="form-control default-datepicker" autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">                                                    
                                                    <div class="input-group mb-3" style="display: grid;">
                                                        <div class="input-group-prepend bootstrap-timepicker timepicker">
                                                            <input id="smsTimepicker" name="send_time" value="<?= $send_time; ?>" type="text" class="form-control input-small">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  <hr>
                                  <div style="margin-top:15px;margin-bottom: 30px;">
                                      <span class="bold margin-right" style="font-size: 19px;">Total: <b>$<?= number_format($grand_total, 2); ?></b></span>                                  </div>
                                </div>
                            </div>
                            <div class="row margin-top" style="bottom: 55px;">
                                <div class="col-sm-12"></div>
                                <div class="col-sm-12 text-right">
                                    <a class="nsm-button" href="<?php echo url('sms_campaigns/build_sms/'); ?>">&laquo; Back</a>
                                    <button class="nsm-button primary btn-campaign-update-send-schedule" data-form="submit" data-shop="to-cart" data-on-click-label="Saving...">Continue &raquo;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/timepicker/bootstrap-timepicker.min.css") ?>">
<script src="<?= base_url("assets/timepicker/bootstrap-timepicker.js") ?>"></script> 
<script>
$(function(){
    $("#campaign_send_schedule").submit(function(e){
        e.preventDefault();

        $('.form-msg').hide().html("");

        var url = base_url + 'sms_campaigns/create_send_schedule';
        $(".btn-campaign-update-send-schedule").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#campaign_send_schedule").serialize(),
             success: function(o)
             {
                if( o.is_success == 1 ){
                    $('.form-msg').hide().html("<p class='alert alert-info'>"+o.msg+"</p>").fadeIn(500);
                    location.href = base_url + "sms_campaigns/payment";
                    //$(".btn-campaign-update-send-schedule").html('<span class="spinner-border spinner-border-sm m-0"></span>  Redirecting to list');
                    /*setTimeout(function() {
                        location.href = base_url + "sms_campaigns";
                    }, 2500);*/
                }else{
                    $('.form-msg').hide().html("<p class='alert alert-danger'>"+o.msg+"</p>").fadeIn(500);
                    $(".btn-campaign-update-send-schedule").html('Save');
                }
             }
          });
        }, 1000);
    });

    <?php if($smsBlast->price_variables != ''){  ?>
      $(".select-date-time").fadeIn();
    <?php } ?>

    $("#is_scheduled").change(function(){
        if ($(this).is(':checked')) {
            $(".select-date-time").fadeIn();
        }else{
            $(".select-date-time").fadeOut();
        }
    });

    $('#smsTimepicker').timepicker({
        showInputs: false
    });

    $('.default-datepicker').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true
    });
});
</script>