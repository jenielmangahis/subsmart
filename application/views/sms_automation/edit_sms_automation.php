<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart('sms_automation/save', ['class' => 'form-validate', 'id' => 'create_sms_automation', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Edit SMS Automation</h3>
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
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Select an event and a time to send a text message.
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="validation-error" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li class="active"><a href="<?= base_url("/sms_automation/edit_sms_automation/" . $smsAutomation->id); ?>">1. Edit Rules</a></li>
                                  <li><a href="<?= base_url("/sms_automation/build_sms"); ?>">2. Build SMS</a></li>
                                  <li><a href="<?= base_url("/sms_automation/preview_sms_message"); ?>">3. Preview</a></li>
                                  <li><a href="<?= base_url("/sms_automation/payment"); ?>">4. Payment</a></li>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>On Event</b></label><br />
                                    <select class="form-control" id="rule-event"  name="rule_event" style="width: 55%;">
                                      <?php foreach($optionRuleNotify as $key => $value){ ?>
                                        <option <?= $smsAutomation->rule_event == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Send</b><br /><small>This represents the time when we send the text.</small></label><br />
                                    <select class="form-control" name="rule_notify_at" style="width: 55%;">
                                      <?php foreach($optionRuleNotifyAt as $key => $value){ ?>
                                        <option <?= $smsAutomation->rule_notify_at == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                      <?php } ?>
                                    </select>
                                    <label class="rule-notify-description" style="display: inline-block;margin-left: 10px;">
                                      <?php 
                                        if($smsAutomation->rule_event == 'estimate_submitted'){
                                          echo 'After event';
                                        }elseif( $smsAutomation->rule_event == 'invoice_paid' ){
                                          echo 'After invoice was paid';
                                        }elseif( $smsAutomation->rule_event == 'invoice_due' ){
                                          echo 'After event';
                                        }else{
                                          echo 'After work order was completed';
                                        }
                                      ?>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Automation Name</b><br /><small>Set a name for your own reference.</small></label>
                                    <input type="text" class="form-control" name="automation_name" value="<?= $smsAutomation->automation_name; ?>" id="" required placeholder="" autofocus style="width: 55%;"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Customer Type</b></label><Br />
                                    <select class="form-control" name="business_customer_type_service" style="width: 55%;">
                                      <?php foreach($optionCustomerTypeService as $key => $value){ ?>
                                        <option <?= $smsAutomation->business_customer_type_service == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Exclude Customer Groups</b><br /><small>Optional, select the groups if you would like to exclude them from automation.</small></label>
                                    <div class="margin-bottom-sec">
                                      <ul class="group-list">
                                          <?php foreach($customerGroups as $cg){ ?>
                                              <li>
                                                  <div class="checkbox checkbox-sm">
                                                      <input class="checkbox-select chk-contact-group" type="checkbox" <?= array_key_exists($cg->id, $selectedGroups) ? 'checked="checked"' : ''; ?> name="excludeGroups[]" value="<?= $cg->id; ?>" id="chk-customer-group-<?= $cg->id; ?>">
                                                      <label for="chk-customer-group-<?= $cg->id; ?>"><?= $cg->name; ?></label>
                                                  </div>
                                              </li>
                                          <?php } ?>
                                      </ul>
                                  </div>
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="col-md-4 form-group md-right">
                                    <a class="btn btn-default" href="<?php echo url('sms_automation') ?>" style="float: left;margin-right: 10px;">Cancel</a>
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-automation-save-draft" style="float: left;margin-right: 0px;">Continue »</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
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
