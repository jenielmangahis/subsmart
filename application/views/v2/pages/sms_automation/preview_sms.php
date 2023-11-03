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
                            <div>Preview & Confirm</div>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'automation_send_schedule', 'autocomplete' => 'off']); ?>
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
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li>1. Set Rules</li>
                                  <li>2. Build SMS</li>
                                  <li class="active">3. Preview</li>
                                  <li>4. Payment</li>
                                </ul>
                            </div>                    
                            <div class="mt-5">
                                <div class="form-msg" style="display: none;"></div>
                                <div style="margin-bottom: 10px;">  
                                    <label><b>Price per SMS: $<?= number_format($price_per_sms, 2); ?></b></label>                                  
                                </div>                                
                            </div>
                            <div class="mt-5" style="bottom: 55px;">
                                <div class="col-sm-12"></div>
                                <div class="col-sm-12 text-right">
                                    <a class="nsm-button" href="<?php echo url('sms_automation/build_sms'); ?>">&laquo; Back</a>
                                    <button class="nsm-button primary btn-automation-update-send-schedule">Continue &raquo;</button>
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
<script>
$(function(){
    $("#automation_send_schedule").submit(function(e){
        e.preventDefault();
        location.href = base_url + "sms_automation/payment";
    });
});
</script>