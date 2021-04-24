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
        <div class="container-fluid p-40">
            <?php echo form_open_multipart('update_email_automation/save', ['class' => 'form-validate', 'id' => 'update_email_automation', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Edit Email Automation</h3>
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
                                        <option <?= $emailAutomation->rule_event == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Send</b><br /><small>This represents the time when we send the text.</small></label><br />
                                    <select class="form-control" name="rule_notify_at" style="width: 55%;">
                                      <?php foreach($optionRuleNotifyAt as $key => $value){ ?>
                                        <option <?= $emailAutomation->rule_notify_at == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
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
                                    <input type="text" class="form-control" value="<?= $emailAutomation->name; ?>" name="automation_name" id="" required placeholder="" autofocus style="width: 55%;"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for=""><b>Customer Type</b></label><Br />
                                    <select class="form-control" name="business_customer_type_service" style="width: 55%;">
                                      <?php foreach($optionCustomerType as $key => $value){ ?>
                                        <option <?= $emailAutomation->business_customer_type_service == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
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
                                        <input type="text" class="form-control" name="email_subject" value="<?= $emailAutomation->email_subject; ?>" id="email_subject" required placeholder="" autofocus/>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="formClient-Name">Email Body</label>
                                        <textarea name="email_body" cols="40" rows="30"  class="form-control" id="mail_body" autocomplete="off">
                                          <?php if($emailAutomation->email_body != ''){ ?>
                                            <?= $emailAutomation->email_body; ?>
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
                                            <select name="template_id" class="form-control email-template">
                                            <option value="0">- Select -</option>
                                            <?php foreach($emailAutomationTemplates as $et){ ?>
                                              <option value="<?= $et->id; ?>"><?= $et->name; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <a class="btn btn-primary margin-right btn-set-template" href="javascript:void(0);">Set</a>                                        
                                        <a href="<?= base_url("email_automation/templates"); ?>" target="_new">Manage templates</a>
                                        <hr>
                                        <div class="form-group">
                                            <label>Placeholders</label>
                                            <p class="margin-bottom">Click to select and insert placeholders in the content which will dynamically be replaced with the appropriate data.</p>
                                            <div>
                                                <a class="btn btn-default btn-insert-smart-tags" href="javascript:void(0);">Insert Placeholders</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-4 form-group md-right">                                    
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-automation-save" style="float: left;margin-right: 10px;">Save</button>
                                    <a class="btn btn-primary btn-preview-email" href="javascript:void(0);" style="float: left;margin-right: 10px;">Preview</a>                                    
                                    <a class="btn btn-default" href="<?php echo url('email_automation') ?>" style="float: left;margin-right: 10px;">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->

            <div class="modal fade" id="modalSmartTags" tabindex="-1" role="dialog" aria-labelledby="modalSmartTagsTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Insert Placeholders</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="padding: 0px 30px;">
                        <p>Click one of the placeholders below to insert.</p>
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

            <div class="modal fade" id="modalPreviewEmail" tabindex="-1" role="dialog" aria-labelledby="modalPreviewEmailTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="margin-top:5%;">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Preview Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="padding: 0px 30px;">
                        <div class="email-blast-msg" style="height: 600px;overflow: auto;"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
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
    $("#update_email_automation").submit(function(e){
        e.preventDefault();
        var url = base_url + 'email_automation/update_email_automation';
        $(".btn-automation-save").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#update_email_automation").serialize(),
             success: function(o)
             {
                $(".btn-automation-save").html('Save');
                if( o.is_success ){
                    Swal.fire({
                        title: 'Email automation was successfully upated!',
                        text: '',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href= base_url + 'email_automation';
                        }
                    });
                }else{
                    Swal.fire({
                        title: 'Warning!',
                        text: o.msg,
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {

                    });
                }
             }
          });
        }, 1000);
    });

    $(".btn-insert-smart-tags").click(function(){
        $("#modalSmartTags").modal('show');
    });

    $(".btn-stag").click(function(){
        var tag = "{{" + $(this).attr("data-id") + "}}";

        CKEDITOR.instances['mail_body'].insertHtml(tag);
        $("#modalSmartTags").modal("hide");
    });

    $(".btn-preview-email").click(function(){
        var email_body = CKEDITOR.instances['mail_body'].getData();
        var email_subject = $("#email_subject").val();
        $("#modalPreviewEmail").modal('show');

        var url = base_url + 'email_automation/_generate_preview';
        $(".email-blast-msg").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {email_body:email_body, email_subject:email_subject},
             success: function(o)
             {
                $(".email-blast-msg").html(o);
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

    $(document).on('click', '.btn-set-template', function(){
      var tid = $('.email-template').val();
      var url = base_url + 'email_automation/_get_template_message';
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: {tid:tid},
           success: function(o)
           {
              CKEDITOR.instances['mail_body'].insertHtml(o.message);
           }
        });
      }, 300);
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
