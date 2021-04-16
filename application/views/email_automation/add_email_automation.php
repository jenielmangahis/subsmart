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
label>input {
 visibility: visible;
 position: inherit;
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
                            <h3 class="page-title">Add Email Automation</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('email_automation') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Email Automation list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Select an event name and a time to send the email.
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>On Event</b></label><br />
                                    <select class="form-control" id="rule-event"  name="rule_event" style="width: 55%;">
                                      <?php foreach($optionRuleEvent as $key => $value){ ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Send</b><br /><small>This represents the time when we send the text.</small></label><br />
                                    <select class="form-control" name="rule_notify_at" style="width: 55%;">
                                      <?php foreach($optionRuleNotifyAt as $key => $value){ ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                      <?php } ?>
                                    </select>
                                    <div style="display: inline-block;">
                                      <label class="weight-normal margin-right-sec" data-automation="rule_notity_op_before"><input type="radio" name="rule_notify_op" value="+" checked="checked">
                                          <span data-automation="rule_notity_op_after_text">After event</span>
                                      </label>
                                      <label class="weight-normal" data-automation="rule_notity_op_after"><input type="radio" name="rule_notify_op" value="-">
                                        <span data-automation="rule_notity_op_before_text">Before event</span>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Automation Name</b><br /><small>Set a name for your own reference.</small></label>
                                    <input type="text" class="form-control" name="automation_name" id="" required placeholder="" autofocus style="width: 55%;"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Customer Type</b></label><Br />
                                    <select class="form-control" name="business_customer_type_service" style="width: 55%;">
                                      <?php foreach($optionCustomerType as $key => $value){ ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
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
                            <div class="row">
                              <div class="col-md-7">
                                  <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="formClient-Name">Subject</label>
                                        <input type="text" class="form-control" name="email_subject" value="<?= $emailCampaign ? $emailCampaign->email_subject : ''; ?>" id="email_subject" required placeholder="" autofocus/>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="formClient-Name">Email Body</label>
                                        <textarea name="email_body" cols="40" rows="30"  class="form-control" id="mail_body" autocomplete="off">
                                          <?php if($emailCampaign->email_body != ''){ ?>
                                            <?= $emailCampaign->email_body; ?>
                                          <?php }else{ ?>
                                            <h2>Dear {{customer.first_name}},</h2>
                                            <br />
                                            <p>Sample email content.</p>
                                            <br />
                                            <p>Thanks,</p>
                                            <p><?= $company->business_name; ?></p>
                                            <p><?= $company->phone_number; ?></p>
                                          <?php } ?>
                                        </textarea>
                                    </div>
                                  </div>                                  
                              </div>

                              <div class="col-md-5">
                                    <div class="panel-info">
                                        <div class="margin-bottom-sec">
                                            <label>Use default template</label>
                                            <select name="template_id" class="form-control" data-template="dropdown">
                                            <option value="0">- select -</option>
                                            <option value="2295">Due for next service</option>
                                            <option value="2296">Estimate Follow-up</option>
                                            <option value="2297">Invoice Due Reminder</option>
                                            <option value="2294">Thank you</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary margin-right" style="width: 80px;" data-template="select" data-on-click-label="Set...">Set</button>
                                        <a data-template="manage" href="#">Manage templates</a>
                                        <hr>
                                        <div class="form-group">
                                            <label>Placeholders</label>
                                            <p class="margin-bottom">Click to select and insert placeholders in the content which will dynamically be replaced with the appropriate data.</p>
                                            <div>
                                                <a class="btn btn-default" href="#" data-tags-modal="open" data-template-default-id="">Insert Placeholders</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
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

    // instance, using default configuration.
    CKEDITOR.replace('mail_body', {
        height: '400'
        //removePlugins: 'toolbar',
        //allowedContent: 'p h1 h2 strong em; a[!href]; img[!src,width,height] alignment;'
    });

    CKEDITOR.config.allowedContent = true;
});
</script>
