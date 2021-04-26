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
.box {
    border: 1px solid #dfdfdf;
    padding: 20px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart('sms_campaigns/save_send_to', ['class' => 'form-validate', 'id' => 'campaign_send_schedule', 'autocomplete' => 'off']); ?>
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
                                    <a href="<?php echo url('sms_campaigns') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to SMS Blast list
                                    </a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="alert alert-warning mt-2 mb-3" role="alert">
                        <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Preview and select when to send the SMS-es.
                        </span>
                    </div>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li><a href="<?= base_url('email_campaigns/edit_campaign/' . $emailCampaign->id); ?>">1. Create Campaign</a></li>
                          <li><a href="<?= base_url('email_campaigns/add_campaign_send_to'); ?>">2. Select Customers</a></li>
                          <li><a href="<?= base_url('email_campaigns/build_email'); ?>">3. Build Email</a></li>
                          <li class="active"><a href="<?= base_url('email_campaigns/preview_email_message'); ?>">4. Preview</a></li>
                          <li><a href="<?= base_url('email_campaigns/payment'); ?>">5. Purchase</a></li>
                        </ul>
                        <hr />
                    </div>
                    <div class="row">
                      <div class="col-md-6 pl-0 pr-0 left" style="background-color: #ffffff !important;">
                        <div class="box">
                          <div class="form-group">
                              <label><b>Campaign Name</b></label>
                              <div><?= $emailCampaign->campaign_name; ?></div>
                          </div>
                          <div class="form-group">
                              <label><b>Send To</b></label>
                              <div><?= $send_to; ?></div>
                          </div>
                          <div class="form-group">
                              <label><b>Subject</b></label>
                              <div><?= $emailCampaign->email_subject; ?></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 pl-0 pr-0 left">
                          <div class="panel-info" style="margin-top: 29px;">
                                  <div class="margin-bottom">
                                      <div class="form-msg" style="display: none;"></div>
                                      <div>
                                          <label><b>Price : $<?= number_format($price_per_email, 2); ?> (up to 1000 emails)</b></label>
                                      </div>
                                      <div style="margin-bottom: 10px;">
                                        <b>Send to: <?= $total_recipients; ?> customers</b>
                                      </div>
                                      <div class="help help-sm help-block">Pay a flat fee to use the service and only $<?= number_format($price_per_email, 2); ?> for every 1000 emails.
                                      The emails will be sent to your customers upon confirmation.</div>
                                  </div>
                                  <div class="form-group">
                                      <div class="">
                                          <?php 

                                            if($emailCampaign->price_variables != ''){ 
                                              $is_scheduled = 'checked="checked"';
                                              $send_date = date("m/d/Y",strtotime($emailCampaign->send_date));
                                            }else{
                                              $is_scheduled = "";
                                              $send_date = date("m/d/Y");
                                            }

                                          ?>
                                          <label style="font-weight: bold;" for="is_scheduled">Schedule On</label>
                                      </div>
                                      <div class="select-date-time">
                                          <br />
                                          <div class="help help-sm help-block">Optional, select a date if you would like to schedule this campaign.</div>
                                          <div class="hide" id="scheduled">
                                              <div class="row">
                                                  <div class="col-sm-8">
                                                      <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                                          <input type="text" name="send_date" value="<?= $send_date; ?>"  class="form-control default-datepicker" autocomplete="off" required />
                                                        </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row margin-top" style="bottom: 55px;">
                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-12 text-right">
                                        <a class="btn btn-default margin-right" href="<?php echo url('email_campaigns/build_email'); ?>">&laquo; Back</a>
                                        <button class="btn btn-primary btn-campaign-update-send-schedule" data-form="submit" data-shop="to-cart" data-on-click-label="Saving...">Continue &raquo;</button>
                                    </div>
                                </div>
                          </div>
                        </div>
                          
                        </form>
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
    $("#campaign_send_schedule").submit(function(e){
        e.preventDefault();

        $('.form-msg').hide().html("");

        var url = base_url + 'email_campaigns/create_send_schedule';
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
                    location.href = base_url + "email_campaigns/payment";
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
