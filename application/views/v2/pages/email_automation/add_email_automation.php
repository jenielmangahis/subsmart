<?php include viewPath('v2/includes/header'); ?>
<style>
.group-list{
    list-style: none;
    padding: 0px;
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
.btn-stag{
    display: inline-block;
    margin: 10px;
    width: 203px;
    text-align: center;
}
.btn-stag:hover{
    cursor: pointer;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/email_automation_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Select an event name and a time to send the email.
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('create_email_automation/save', ['class' => 'form-validate', 'id' => 'create_email_automation', 'autocomplete' => 'off']); ?>
                <div class="row">                    
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><b>On Event</b></label><br />
                            <select class="form-control" id="rule-event"  name="rule_event" style="width: 55%;">
                              <?php foreach($optionRuleEvent as $key => $value){ ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mt-5">
                            <label for=""><b>Send</b><br /><small>This represents the time when we send the text.</small></label><br />
                            <select class="form-control" name="rule_notify_at" style="width: 55%;display: inline-block;">
                              <?php foreach($optionRuleNotifyAt as $key => $value){ ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                              <?php } ?>
                            </select>
                            <div style="display: inline-block;">
                              <label class="weight-normal margin-right-sec" data-automation="rule_notity_op_before"><input type="radio" name="rule_notify_op" checked="checked">
                                  <span data-automation="rule_notity_op_after_text">After event</span>
                              </label>
                              <label class="weight-normal" data-automation="rule_notity_op_after"><input type="radio" name="rule_notify_op"style="margin-left: 10px;">
                                <span data-automation="rule_notity_op_before_text">Before event</span>
                              </label>
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <label for=""><b>Automation Name</b><br /><small>Set a name for your own reference.</small></label>
                            <input type="text" class="form-control" name="automation_name" id="" required placeholder="" autofocus style="width: 55%;"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for=""><b>Customer Type</b></label><Br />
                            <select class="form-control" name="business_customer_type_service" style="width: 55%;">
                              <?php foreach($optionCustomerType as $key => $value){ ?>
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
                                              <input class="checkbox-select chk-contact-group" type="checkbox" name="excludeGroups[]" value="<?= $cg->id; ?>" id="chk-customer-group-<?= $cg->id; ?>">
                                              <label for="chk-customer-group-<?= $cg->id; ?>"><?= $cg->title; ?></label>
                                          </div>
                                      </li>
                                  <?php } ?>
                              </ul>
                          </div>
                        </div>
                    </div>
                </div>   
                <br />             
                <div class="row">
                    <div class="col-8">                        
                        <div class="form-group mt-5">
                            <label for=""><b>Subject</b></label>
                            <input type="text" class="form-control" name="email_subject" value="" id="email_subject" required placeholder="" autofocus/>
                        </div>
                        <div class="form-group mt-5">
                            <label for="formClient-Name"><b>Email Body</b></label>
                            <textarea name="email_body" cols="40" rows="30"  class="form-control" id="mail_body" autocomplete="off">
                                <h2>Dear {{customer.first_name}},</h2>
                                <br />
                                <p>Sample email content.</p>
                                <br />
                                <p>Thanks,</p>
                                <p><?= $company->business_name; ?></p>
                                <p><?= $company->phone_number; ?></p>
                            </textarea>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mt-5">
                            <label><b>Use default template</b></label>
                            <select name="template_id" class="form-control email-template">
                                <option value="0">- Select -</option>
                                <?php foreach($emailAutomationTemplates as $et){ ?>
                                  <option value="<?= $et->id; ?>"><?= $et->name; ?></option>
                                <?php } ?>
                            </select>
                            <div class="mt-4">
                                <a class="nsm-button primary btn-set-template" href="javascript:void(0);">Set</a>
                                <a class="nsm-button" href="<?= base_url("email_automation/templates"); ?>" target="_new">Manage templates
                                </a>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <label><b>Placeholders</b></label>
                            <p class="mt-2">Click to select and insert placeholders in the content which will dynamically be replaced with the appropriate data.</p>
                            <div class="mt-4">
                                <a class="nsm-button btn-insert-smart-tags" href="javascript:void(0);">Insert Placeholders</a>
                            </div>
                        </div>

                        <div style="margin-top:108px;">                                    
                            <button type="submit" class="nsm-button primary btn-automation-save" style="float: left;margin-right: 10px;">Save</button>
                            <a class="nsm-button primary btn-preview-email" href="javascript:void(0);" style="float: left;margin-right: 10px;">Preview</a>                                    
                            <a class="nsm-button" href="<?php echo url('email_automation') ?>" style="float: left;margin-right: 10px;">Cancel</a>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
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

                <!-- Preview Email -->
                <div class="modal fade nsm-modal fade" id="modalPreviewEmail" aria-labelledby="modalPreviewEmailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Preview Email</span>
                                <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>                        
                            <div class="modal-body">
                                <div class="email-blast-msg" style="height: 600px;overflow: auto;"></div>
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
</div>

<script type="text/javascript">
$(function(){
    $("#create_email_automation").submit(function(e){
        e.preventDefault();
        var url = base_url + 'email_automation/create_email_automation';
        $(".btn-automation-save").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#create_email_automation").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                    location.href = base_url + "email_automation";
                }else{
                    Swal.fire({
                      icon: 'error',
                      title: 'Cannot proceed.',
                      text: o.msg
                    });
                    $(".btn-automation-save").html('Save');
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
<?php include viewPath('v2/includes/footer'); ?>