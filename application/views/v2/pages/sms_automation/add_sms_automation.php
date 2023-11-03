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
.list-customer-groups{
    padding: 0px;
    margin: 0px;
    list-style: none;
}
.list-customer-groups li{
    display: inline-block;
    margin: 10px;
    width: 200px;
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
                <?php echo form_open_multipart('sms_automation/save', ['class' => 'form-validate', 'id' => 'create_sms_automation', 'autocomplete' => 'off']); ?>
                    <div class="tabs-menu">
                        <ul class="clearfix">
                          <li class="active">1. Set Rules</li>
                          <li>2. Build SMS</li>
                          <li>3. Preview</li>
                          <li>4. Payment</li>
                        </ul>
                    </div>                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>On Event</b></label><br />
                                <select class="form-control" id="rule-event"  name="rule_event" style="width: 55%;">
                                  <?php foreach($optionRuleNotify as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                  <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mt-5">
                                <label for=""><b>Send</b><br /><small>This represents the time when we send the text.</small></label><br />
                                <select class="form-control" name="rule_notify_at" style="width: 55%; display: inline-block;">
                                  <?php foreach($optionRuleNotifyAt as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                  <?php } ?>
                                </select>
                                <label class="rule-notify-description" style="display: inline-block;margin-left: 10px;">After event</label>
                            </div>
                            <div class="form-group mt-5">
                                <label for=""><b>Automation Name</b><br /><small>Set a name for your own reference.</small></label>
                                <input type="text" class="form-control" name="automation_name" id="" required placeholder="" autofocus style="width: 55%;"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><b>Customer Type</b></label><Br />
                                <select class="form-control" name="business_customer_type_service" style="width: 55%;">
                                  <?php foreach($optionCustomerTypeService as $key => $value){ ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                  <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mt-5">
                                <label for=""><b>Exclude Customer Groups</b><br /><small>Optional, select the groups if you would like to exclude them from automation.</small></label>
                                <div class="margin-bottom-sec">
                                    <ul class="list-customer-groups">
                                        <?php foreach($customerGroups as $cg){ ?>
                                            <li>
                                                <div class="checkbox checkbox-sm">
                                                  <input class="checkbox-select chk-contact-group" type="checkbox" <?= array_key_exists($cg->id, $selectedGroups) ? 'checked="checked"' : ''; ?> name="excludeGroups[]" value="<?= $cg->id; ?>" id="chk-customer-group-<?= $cg->id; ?>">
                                                  <label for="chk-customer-group-<?= $cg->id; ?>"><?= $cg->title; ?></label>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3 text-end">                                                                
                                <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('sms_automation') ?>'">Go Back to SMS Automation List</button>
                                <button type="submit" class="nsm-button primary btn-automation-save-draft">Continue »</button>
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
    $("#create_sms_automation").submit(function(e){
        e.preventDefault();
        var url = base_url + 'sms_automation/save_draft_automation';
        $(".btn-automation-save-draft").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#create_sms_automation").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    $(".validation-error").hide();
                    $(".validation-error").html('');
                    //redirect to step2
                    location.href = base_url + "sms_automation/build_sms";
                }else{
                    $(".validation-error").show();
                    $(".validation-error").html(o.err_msg);
                    $(".btn-automation-save-draft").html('Continue »');
                }
             }
          });
        }, 1000);
    });

    $("#rule-event").change(function(){
      var selected = $(this).val();
      if( selected == 'estimate_submitted' || selected == 'invoice_due' ){
        $(".rule-notify-description").html("After event");
      }else if( selected == 'invoice_paid' ){
        $(".rule-notify-description").html("After invoice was paid");
      }else if( selected == 'work_order_completed' ){
        $(".rule-notify-description").html("After work order was completed");
      }
    });
});
</script>