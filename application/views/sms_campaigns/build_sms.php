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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
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
            <!-- end row -->
            <?php echo form_open_multipart('users/save', ['class' => 'form-validate', 'id' => 'create_sms_blast', 'autocomplete' => 'off']); ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="campaign__text">
                                <label>SMS message</label>
                                <textarea name="text" cols="40" class="form-control" id="sms-txt" style="height: 150px !important;" autocomplete="off">Sms from ADi</textarea>
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
                        <div class="col-sm-12">
                            <button class="btn btn-default margin-right" data-form="sms-preview" data-on-click-label="Preview...">Preview SMS</button>
                        </div>
                        <div class="col-sm-12 text-right">
                            <a class="btn btn-default margin-right" href="https://www.markate.com/pro/marketing/sms_campaigns/main/send_to/id/1161">&laquo; Back</a>
                            <button class="btn btn-primary" data-form="submit" data-on-click-label="Saving...">Continue &raquo;</button>
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

    $("#create_sms_blast").submit(function(e){
        e.preventDefault();
        var url = base_url + '/sms_campaigns/save_draft_campaign';
        $(".btn-campaign-save-draft").html('<span class="spinner-border spinner-border-sm m-0"></span>  saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,    
             dataType: "json",      
             data: $("#create_sms_blast").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "/sms_campaigns/add_campaign_send_to";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                }
                $(".btn-campaign-save-draft").html('Save as Draft');
             }
          });
        }, 1000);
    });
});
</script>