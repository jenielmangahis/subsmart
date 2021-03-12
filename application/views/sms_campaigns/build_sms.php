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
.group-tags .btn{
    display: inline-block;
    width: auto;
    margin: 5px;
    padding: 5px 10px;
}
.modal-tags-list li{
    margin-bottom: : 30px;
}
.tags-group-name{
    background-color: #32243D;
    color : #ffffff;
    padding: 10px !important;
    margin-top: 20px;
    margin-bottom: 10px;
}
.phone {
    display: inline-block;
    background: url(<?php echo base_url() ?>/assets/img/sms_preview_phone.png) no-repeat 0 0;
    width: 350px;
    height: 530px;
}
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
          <!--
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">SMS Blast</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Build and preview the SMS.</li>
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
            <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'id' => 'build_sms', 'autocomplete' => 'off']); ?>
            <div class="card mt-0">
                <div class="row">
                  <div class="col-sm-6 left">
                    <h3 class="page-title">SMS Blast</h3>
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
                    <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Build and preview the SMS.</span>
                </div>
                <div class="card-body">
                    <div class="validation-error" style="display: none;"></div>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li>1. Edit Campaign</li>
                          <li>2. Select Customers</li>
                          <li class="active">3. Build SMS</li>
                          <li>4. Preview</li>
                          <li>5. Purchase</li>
                        </ul>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="campaign__text">
                                <label>SMS message</label>
                                <textarea name="sms_text" cols="40" class="form-control" id="sms-txt" style="height: 150px !important;" autocomplete="off">Sms from ADi</textarea>
                            </div>
                            <div class="help help-sm margin-bottom-sec">
                                message characters: <span class="margin-right-sec char-counter">0</span>
                                left characters: <span class="margin-right-sec char-counter-left">0</span>
                                segments: <span class="char-counter-segments">1</span>
                            </div>
                            <div class="help help-sm">When you send a SMS message over 135 characters the message will be split in 2 messages/segments. You will be billed for each message/segment.</div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel-info">
                                <label>Personalize your SMS with Smart Tags</label>
                                <p class="margin-bottom">Click to select and insert smart tags in the content which will dynamically be replaced with the appropriate data.</p>
                                <div>
                                    <a class="btn btn-default btn-insert-smart-tags" href="javascript:void(0);">Insert Smart Tags</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row margin-top">
                        <div class="col-sm-6">
                            <a class="btn btn-default margin-right btn-preview-sms" href="javascript:void(0);">Preview SMS</a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a class="btn btn-default margin-right" href="javascript:void(0);" style="margin-right: 10px;">&laquo; Back</a>
                            <button class="btn btn-primary btn-create-sms-msg" type="submit">Continue &raquo;</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>

            <div class="modal fade" id="modalSmartTags" tabindex="-1" role="dialog" aria-labelledby="modalSmartTagsTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Insert Smart Tags</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="padding: 0px 30px;">
                        <ul class="modal-tags-list" data-tags-modal="list">
                            <li>
                                <div class="text-ter weight-medium tags-group-name">Customer</div>
                                <div class="group-tags">
                                    <a class="btn btn-default btn-stag" data-id="customer.name">Full Name</a>
                                    <a class="btn btn-default btn-stag" data-id="customer.first_name">First Name</a>
                                    <a class="btn btn-default btn-stag" data-id="customer.last_name">Last Name</a>
                                    <a class="btn btn-default btn-stag" data-id="customer.phone">Phone</a>
                                </div>
                            </li>
                            <li>
                                <div class="text-ter weight-medium tags-group-name">Business</div>
                                <div class="group-tags">
                                    <a class="btn btn-default btn-stag" data-id="business.name">Name</a>
                                    <a class="btn btn-default btn-stag" data-id="business.email">Email</a>
                                    <a class="btn btn-default btn-stag" data-id="business.phone">Phone</a>
                                </div>
                            </li>
                            <li>
                                <div class="text-ter weight-medium tags-group-name">Other</div>
                                <div class="group-tags">
                                    <a class="btn btn-default btn-stag" data-id="estimate.custom_number">Estimate Number (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="estimate.date_added_text">Estimate Date  (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="estimate.total_text">Estimate Amount (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="invoice.custom_number">Invoice Number (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="invoice.date_issued_text">Invoice Date Issued (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="invoice.total_text">Invoice Amount (last)</a>
                                    <a class="btn btn-default btn-stag" data-id="event.date_start_text">Job Date (last)</a>
                                </div>
                            </li>
                        </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalPreviewSms" tabindex="-1" role="dialog" aria-labelledby="modalPreviewSmsTitle" aria-hidden="true">
                <div class="modal-dialog" role="document" style="margin-top:5%;">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Preview SMS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="padding: 0px 30px;text-align:center;">
                        <div class="phone" style="margin-top:20px;">
                            <div class="phone__cnt">
                                <div class="sms-blast-msg"></div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                </div>
            </div>

            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    function smsCharCounter(){
        var chars_max   = 270;
        var chars_total = $("#sms-txt").val().length;
        var chars_left  = chars_max - chars_total;

        $('.char-counter').html(chars_total);
        $(".char-counter-left").html(chars_left);

        return chars_left;
    }

    $("#sms-txt").keydown(function(e){
        var chars_left = smsCharCounter();
        if( chars_left <= 0 ){
            if (e.keyCode != 46 && e.keyCode != 8 ) return false;
        }else{
            return true;
        }
    });

    $(".btn-stag").click(function(){
        var sms_message = $("#sms-txt").val();
        var tag = "{{" + $(this).attr("data-id") + "}}";

        sms_message = sms_message + tag;
        $("#sms-txt").val(sms_message);

        $("#modalSmartTags").modal("hide");
    });

    smsCharCounter();

    $(".btn-insert-smart-tags").click(function(){
        $("#modalSmartTags").modal('show');
    });

    $(".btn-preview-sms").click(function(){
        $("#modalPreviewSms").modal('show');
        $(".sms-blast-msg").html($("#sms-txt").val());
    });

    $("#build_sms").submit(function(e){
        e.preventDefault();
        var url = base_url + 'sms_campaigns/create_sms_message';
        $(".btn-create-sms-msg").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#build_sms").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "sms_campaigns/preview_sms_message";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                }
                $(".btn-create-sms-msg").html('Continue »');
             }
          });
        }, 1000);
    });
});
</script>
