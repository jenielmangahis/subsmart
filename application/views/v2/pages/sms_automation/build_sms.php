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
.group-tags .btn{
    display: inline-block;
    width: auto;
    margin: 5px;
    padding: 5px 10px;
}
.modal-tags-list{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.modal-tags-list li{
    margin-bottom: : 30px;
}
.tags-group-name{
    background-color: #DAD1E0;
    color: #6A4A86;
    padding: 10px !important;
    margin-top: 20px;
    margin-bottom: 10px;
    font-weight: bold;
}
.phone {
    display: inline-block;
    background: url(<?php echo base_url() ?>/assets/img/sms_preview_phone.png) no-repeat 0 0;
    width: 350px;
    height: 530px;
}
.btn-stag{
    display: inline-block;
    margin: 10px;
    width: 203px;
    text-align: center;
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
                            <div>Select an event and a time to send a text message.</div>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'build_sms', 'autocomplete' => 'off']); ?>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li>1. Set Rules</li>
                          <li class="active">2. Build SMS</li>
                          <li>3. Preview</li>
                          <li>4. Payment</li>
                        </ul>
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>SMS message</b></label>
                            <?php 
                                $sms_text = 'Sms from ' . $company->business_name;
                                if( $smsAutomation->sms_text != '' ){
                                    $sms_text = $smsAutomation->sms_text;
                                }
                            ?>
                            <textarea name="sms_text" cols="40" class="form-control" id="sms-txt" style="height: 150px !important;" autocomplete="off"><?= $sms_text; ?></textarea>
                            <div class="help help-sm margin-bottom-sec">
                                message characters: <span class="margin-right-sec char-counter">0</span>
                                left characters: <span class="margin-right-sec char-counter-left">0</span>
                                segments: <span class="char-counter-segments">1</span>
                            </div>
                            <div class="help help-sm">When you send a SMS message over 135 characters the message will be split in 2 messages/segments. You will be billed for each message/segment.</div>
                            <div class="mt-5">
                                <a class="nsm-button btn-preview-sms" href="javascript:void(0);">Preview SMS</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel-info">
                                <label><b>Personalize your SMS with Smart Tags</b></label>
                                <p class="margin-bottom">Click to select and insert smart tags in the content which will dynamically be replaced with the appropriate data.</p>
                                <div>
                                    <a class="btn btn-default btn-insert-smart-tags" href="javascript:void(0);">Insert Smart Tags</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3 text-end">                                                                                          
                            <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('sms_automation/edit_sms_automation/' . $smsAutomation->id); ?>'">Back</button>
                            <button type="submit" class="nsm-button primary btn-create-sms-msg">Continue »</button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>

            <!-- Smart Tags Modal -->
            <div class="modal fade nsm-modal fade" id="modalSmartTags" aria-labelledby="modalSmartTagsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Insert Smart Tags</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body">
                            <ul class="modal-tags-list" data-tags-modal="list">
                                <li>
                                    <div class="text-ter weight-medium tags-group-name">Customer</div>
                                    <div class="group-tags">
                                        <a class="nsm-button primary btn-stag" data-id="customer.name">Full Name</a>
                                        <a class="nsm-button primary btn-stag" data-id="customer.first_name">First Name</a>
                                        <a class="nsm-button primary bbtn-stag" data-id="customer.last_name">Last Name</a>
                                        <a class="nsm-button primary btn-stag" data-id="customer.phone">Phone</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="text-ter weight-medium tags-group-name">Business</div>
                                    <div class="group-tags">
                                        <a class="nsm-button primary btn-stag" data-id="business.name">Name</a>
                                        <a class="nsm-button primary btn-stag" data-id="business.email">Email</a>
                                        <a class="nsm-button primary btn-stag" data-id="business.phone">Phone</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="text-ter weight-medium tags-group-name">Other</div>
                                    <div class="group-tags">
                                        <a class="nsm-button primary btn-stag" data-id="estimate.custom_number">Estimate Number (last)</a>
                                        <a class="nsm-button primary btn-stag" data-id="estimate.date_added_text">Estimate Date  (last)</a>
                                        <a class="nsm-button primary btn-stag" data-id="estimate.total_text">Estimate Amount (last)</a>
                                        <a class="nsm-button primary btn-stag" data-id="invoice.custom_number">Invoice Number (last)</a>
                                        <a class="nsm-button primary btn-stag" data-id="invoice.date_issued_text">Invoice Date Issued (last)</a>
                                        <a class="nsm-button primary btn-stag" data-id="invoice.total_text">Invoice Amount (last)</a>
                                        <a class="nsm-button primary btn-stag" data-id="event.date_start_text">Job Date (last)</a>
                                    </div>
                                </li>
                            </ul>
                        </div>                    
                    </div>
                </div>
            </div>

            <!-- Preview SMS -->
            <div class="modal fade nsm-modal fade" id="modalPreviewSms" aria-labelledby="modalPreviewSmsLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Preview SMS</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>                        
                        <div class="modal-body" style="margin: 0 auto;">
                            <div class="phone" style="margin-top:20px;">
                                <div class="phone__cnt">
                                    <div class="sms-blast-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button name="btn_close_modal" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>                      
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
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
        var url = base_url + 'sms_automation/create_sms_message';
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
                    $(".validation-msg").hide();
                    $(".validation-msg").html('');
                    
                    location.href = base_url + "sms_automation/preview_sms_message";
                }else{
                    $(".validation-msg").show();
                    $(".validation-msg").html(o.err_msg);
                }
                $(".btn-create-sms-msg").html('Continue »');
             }
          });
        }, 1000);
    });
});
</script>