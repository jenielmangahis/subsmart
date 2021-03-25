<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
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
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'automation_send_schedule', 'autocomplete' => 'off']); ?>
            <div class="row">
              <div class="col-xl-12">
                  <div class="card mt-0">
                    <div class="row">
                      <div class="col-sm-6 left">
                        <h3 class="page-title">Preview & Confirm</h3>
                      </div>
                      <div class="col-sm-6 right dashboard-container-1">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                    <a href="<?php echo url('sms_automation') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to SMS Automation list
                                    </a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="alert alert-warning mt-2 mb-3" role="alert">
                        <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Preview and select when to send the SMS-es.
                        </span>
                    </div>
                    <div class="row">
                      <div class="col-md-4 pl-0 pr-0 left">

                          <div class="">
                              <div class="phone" style="margin-left: 38px;">
                                  <div class="phone__cnt">
                                      <div class="sms-blast-msg"><?= $sms_text; ?></div>
                                  </div>
                              </div>
                          </div>

                      </div>
                      <div class="col-md-8 pl-0 pr-0 left">

                          <div class="">
                              <form class="form" name="plan-form" data-shop="form">
                                  <div class="tabs-menu">
                                      <ul class="clearfix">
                                        <li><a href="<?= base_url("/sms_automation/edit_sms_automation/" . $smsAutomation->id); ?>">1. Edit Rules</a></li>
                                        <li><a href="<?= base_url("/sms_automation/build_sms"); ?>">2. Build SMS</a></li>
                                        <li class="active"><a href="<?= base_url("/sms_automation/preview_sms_message"); ?>">3. Preview</a></li>
                                        <li><a href="<?= base_url("/sms_automation/payment"); ?>">4. Payment</a></li>
                                      </ul>
                                  </div>
                                  <hr />

                                  <div class="margin-bottom panel-info">
                                      <div class="form-msg" style="display: none;"></div>
                                      <div style="margin-bottom: 10px;">                                          
                                          <label>Price per SMS: $<?= number_format($price_per_sms, 2); ?></label>
                                      </div>
                                      
                                  </div>
                                  <div class="clearfix"></div>
                                  <div class="row margin-top">
                                      <div class="col-sm-12"></div>
                                      <div class="col-sm-12 text-right">
                                          <a class="btn btn-default margin-right" href="<?php echo url('sms_automation/build_sms'); ?>">&laquo; Back</a>
                                          <button class="btn btn-primary btn-automation-update-send-schedule" data-form="submit" data-shop="to-cart" data-on-click-label="Saving...">Continue &raquo;</button>
                                      </div>
                                  </div>
                              </form>
                          </div>

                      </div>
                  </div>
                </div>
                <hr>

                <?php echo form_close(); ?>
                <!-- end row -->
            </div>
          </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $("#automation_send_schedule").submit(function(e){
        e.preventDefault();
        location.href = base_url + "sms_automation/payment";
    });
});
</script>
