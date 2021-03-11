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
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Preview & Confirm</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Preview and select when to send the SMS-es.</li>
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
            <!-- end row -->
            <?php echo form_open_multipart('sms_campaigns/save_send_to', ['class' => 'form-validate', 'id' => 'campaign_send_schedule', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-md-4">

                    <div class="panel-info">
                        <div class="phone" style="margin-left: 38px;">
                            <div class="phone__cnt">
                                <div class="sms-blast-msg"><?= $sms_text; ?></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-8">

                    <div class="panel-info">
                        <form class="form" name="plan-form" data-shop="form">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li>1. Edit Campaign</li>
                                  <li>2. Select Customers</li>
                                  <li>3. Build SMS</li>
                                  <li class="active">4. Preview</li>
                                  <!-- <li>5. Purchase</li> -->
                                </ul>
                            </div>
                            <hr />  

                            <div class="margin-bottom">
                                <div>
                                    <label>Price for service: $<?= number_format($service_price, 2); ?></label>
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <?php ?>
                                    <label>Price for all SMSes: $<?= number_format($total_sms_price, 2); ?></label> (<?= $total_recipients; ?> x $<?= number_format($price_per_sms, 2); ?>)
                                </div>
                                <div class="help help-sm help-block">Pay a flat fee to use the service and only $0.05 for each message (segment).
                                The SMSes will be sent to your customers upon confirmation.</div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-sec">
                                    <input type="checkbox" name="is_scheduled" value="1"  id="is_scheduled" />
                                    <label style="font-weight: 500;" for="is_scheduled">Schedule Campaign</label>
                                </div>
                                <div class="select-date-time" style="display: none;">
                                    <br />
                                    <div class="help help-sm help-block">Select this to set a date if you would like to schedule this campaign.</div>
                                    <div class="hide" id="scheduled">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" name="send_date" value="<?= date("Y-m-d"); ?>"  class="form-control default-datepicker" autocomplete="off" required />
                                                  </div>                                                  
                                                </div>                                                
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                  <div class="input-group-prepend bootstrap-timepicker timepicker">
                                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-clock-o"></i></span>
                                                    <input id="smsTimepicker" name="send_time" type="text" class="form-control input-small">
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="margin-bottom">
                                <span class="bold margin-right">Total: $<?= number_format($grand_total, 2); ?></span>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            <hr>
            <div class="row margin-top">
                <div class="col-sm-12"></div>
                <div class="col-sm-12 text-right">
                    <a class="btn btn-default margin-right" href="#">&laquo; Back</a>
                    <button class="btn btn-primary" data-form="submit" data-shop="to-cart" data-on-click-label="Saving...">Continue &raquo;</button>
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
    $("#campaign_send_schedule").submit(function(e){
        e.preventDefault();
        var url = base_url + 'sms_campaigns/create_send_schedule';
        $(".btn-campaign-save-send-settings").html('<span class="spinner-border spinner-border-sm m-0"></span>  saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,    
             dataType: "json",      
             data: $("#create_campaign_send_to").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "sms_campaigns/build_sms";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                }
                $(".btn-campaign-save-send-settings").html('Continue »');
             }
          });
        }, 1000);
    });

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
        format: 'yyyy-mm-dd',
        autoclose: true
    });
});
</script>