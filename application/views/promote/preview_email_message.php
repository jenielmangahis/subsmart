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
                        <h3 class="page-title">Preview & Confirm Deals</h3>
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
                    <div class="alert alert-warning mt-2 mb-3" role="alert">
                        <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Preview and select the valid period.</span>
                    </div>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li>1. Create Deal</li>
                          <li>2. Select Customers</li>
                          <li>3. Build Email</li>
                          <li class="active">4. Preview</li>
                          <li>5. Purchase</li>
                        </ul>
                        <hr />
                    </div>
                    <div class="row">
                      <div class="col-md-6 pl-0 pr-0 left" style="background-color: #ffffff !important;">
                        <div class="box">
                          <div class="form-group">
                              <h3 style="font-size: 26px;"><?= $dealsSteals->title; ?></h3>
                              <h3 style="color:#2ab363;font-size: 24px;">$<?= number_format($dealsSteals->deal_price,2); ?></h3>
                          </div>
                          <div class="row margin-bottom-sec">
                              <div class="col-md-6">
                                  <?php 
                                    $diff_increase  = $dealsSteals->original_price - $dealsSteals->deal_price;
                                    $percentage_off = ($diff_increase / $dealsSteals->original_price) * 100;  
                                  ?>
                                  <span class="text-ter">was <span style="font-size:18px;">$<?= number_format($dealsSteals->original_price,2); ?></span> you get <span style="font-size: 18px;"><?= number_format($percentage_off,2); ?>%</span> off</span>
                              </div>
                              <div class="col-md-6 text-right">
                                  <span class="text-ter"><i class="fa fa-clock-o"></i> Expires in <span data-shop="valid-days">30</span> days</span>
                              </div>
                          </div>
                          <div class="row margin-bottom-sec">
                              <div class="col-md-12">
                                  <img src="<?= base_url("uploads/deals_steals/" . $dealsSteals->company_id . "/" . $dealsSteals->photos); ?>" style="width: 100%;">
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 pl-0 pr-0 left">
                          <div class="panel-info" style="margin-top: 29px;">
                                  <div class="margin-bottom">
                                      <div class="form-msg" style="display: none;"></div>
                                      <div>
                                          <label>The current package to run the deal:</label><br/><br/>
                                          <label style="font-weight: bold;">Pay flat fee $10.00 to list your deal for 1 Month.</label>
                                      </div>
                                      <div class="help help-sm help-block">                                        
                                        <div class="help help-sm">
                                            The deal will be emailed to your customers upon confirmation.
                                            You pay a monthly fee to keep the deal valid. No additional commission on customer bookings and transactions.
                                        </div>
                                  </div>
                                  <div class="form-group" style="margin-top: 72px;">
                                      <div class="select-date-time">
                                          <div class="hide" id="scheduled">
                                              <div class="row">
                                                  <div class="col-sm-8">
                                                      <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                          <label style="width: 400px;">Valid From <span class="fa fa-question-circle help-tooltip" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Select the start date. You can schedule a deal if you set this date in future." data-original-title="" title="" style="margin-left: 10px;"></span></label>                                                          
                                                          <input type="text" name="send_date" value="<?= $send_date; ?>"  class="form-control default-datepicker" autocomplete="off" required /><span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-sm-8">
                                                      <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                          <label style="width: 400px;">Valid To <span style="margin-left: 10px;" class="fa fa-question-circle help-tooltip" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="The date when the deal will expire." data-original-title="" title=""></span></label>                                                          
                                                          <input type="text" name="send_date" value="<?= $send_date; ?>"  class="form-control default-datepicker" autocomplete="off" required /><span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
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
