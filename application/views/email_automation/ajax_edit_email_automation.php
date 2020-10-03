<input type="hidden" name="template_automation_id" id="template_automation_id" value="<?php echo $template_automation_id; ?>">
<div class="row">
  <div class="col-md-8">

    <div class="form-group"><p>Select an event name and a time to send the email.</p></div>

    <div class="form-group">
      <label>On Event</label> <span class="help"></span>
      <select name="rule_event" class="form-control" data-automation="rule_event">
        <option value="">- select -</option>
        <option <?php echo $email_automation->rule_event == "estimate_submitted" ? "selected=''" : ""; ?> value="estimate_submitted">Estimate Follow-up</option>
        <option <?php echo $email_automation->rule_event == "invoice_paid" ? "selected=''" : ""; ?> value="invoice_paid">Invoice Paid</option>
        <option <?php echo $email_automation->rule_event == "invoice_due" ? "selected=''" : ""; ?> value="invoice_due">Invoice Due</option>
        <option <?php echo $email_automation->rule_event == "work_order_completed" ? "selected=''" : ""; ?> value="work_order_completed">Work Order Completed</option>
      </select>
    </div>

    <div class="form-group">
      <label>Send</label> <span class="help"></span>
      <select name="rule_notify_at" class="form-control">
        <option <?php echo $email_automation->rule_notify_at == "P1D" ? "selected=''" : ""; ?> value="P1D">1 day</option>
        <option <?php echo $email_automation->rule_notify_at == "P2D" ? "selected=''" : ""; ?> value="P2D">2 days</option>
        <option <?php echo $email_automation->rule_notify_at == "P3D" ? "selected=''" : ""; ?> value="P3D">3 days</option>
        <option <?php echo $email_automation->rule_notify_at == "P4D" ? "selected=''" : ""; ?> value="P4D">4 days</option>
        <option <?php echo $email_automation->rule_notify_at == "P5D" ? "selected=''" : ""; ?> value="P5D">5 days</option>
        <option <?php echo $email_automation->rule_notify_at == "P6D" ? "selected=''" : ""; ?> value="P6D">6 days</option>
        <option <?php echo $email_automation->rule_notify_at == "P7D" ? "selected=''" : ""; ?> value="P7D">7 days</option>
        <option <?php echo $email_automation->rule_notify_at == "P1W" ? "selected=''" : ""; ?> value="P1W">1 week</option>
        <option <?php echo $email_automation->rule_notify_at == "P2W" ? "selected=''" : ""; ?> value="P2W">2 weeks</option>
        <option <?php echo $email_automation->rule_notify_at == "P3W" ? "selected=''" : ""; ?> value="P3W">3 weeks</option>
        <option <?php echo $email_automation->rule_notify_at == "P4W" ? "selected=''" : ""; ?> value="P4W">4 weeks</option>
        <option <?php echo $email_automation->rule_notify_at == "P1M" ? "selected=''" : ""; ?> value="P1M">1 month</option>
        <option <?php echo $email_automation->rule_notify_at == "P45D" ? "selected=''" : ""; ?> value="P45D">45 days</option>
        <option <?php echo $email_automation->rule_notify_at == "P3M" ? "selected=''" : ""; ?> value="P3M">3 months</option>
        <option <?php echo $email_automation->rule_notify_at == "P4M" ? "selected=''" : ""; ?> value="P4M">4 months</option>
        <option <?php echo $email_automation->rule_notify_at == "P6M" ? "selected=''" : ""; ?> value="P6M">6 months</option>
        <option <?php echo $email_automation->rule_notify_at == "P9M" ? "selected=''" : ""; ?> value="P9M">9 months</option>
        <option <?php echo $email_automation->rule_notify_at == "P12M" ? "selected=''" : ""; ?> value="P12M">12 months</option>
        <option <?php echo $email_automation->rule_notify_at == "P18M" ? "selected=''" : ""; ?> value="P18M">1 year and a half</option>
        <option <?php echo $email_automation->rule_notify_at == "P24M" ? "selected=''" : ""; ?> value="P24M">2 years</option>
        <option <?php echo $email_automation->rule_notify_at == "P36M" ? "selected=''" : ""; ?> value="P36M">3 years</option>
        <option <?php echo $email_automation->rule_notify_at == "P48M" ? "selected=''" : ""; ?> value="P48M">4 years</option>
      </select><br />

      <div style="padding-top: 10px;">
          <?php 
            $rule_notify_op_0 = "";
            $rule_notify_op_1 = "";
            if($email_automation->rule_notify_op == 0) {
              $rule_notify_op_0 = "checked='checked'";
            }elseif($email_automation->rule_notify_op == 0) {
              $rule_notify_op_1 = "checked='checked'";
            }
          ?>
          <label class="weight-normal margin-right-sec" data-automation="rule_notity_op_before">
            <input type="radio" name="rule_notify_op" value="0" <?php echo $rule_notify_op_0; ?>>
          <span data-automation="rule_notity_op_after_text">After event</span></label>
          <label class="weight-normal" data-automation="rule_notity_op_after">
            <input type="radio" name="rule_notify_op" value="1" <?php echo $rule_notify_op_1; ?>>
          <span data-automation="rule_notity_op_before_text">Before event</span></label>
      </div>

    </div>          

    <div class="form-group">
      <label>Automation Name</label> <span class="help">(Set a name for your own reference.)</span>
      <input type="text" name="name" id="name" value="<?php echo $email_automation->name; ?>" class="form-control" autocomplete="off" required="">
    </div>  

    <div class="form-group"> 
      <label>Customer Type</label> <span class="help"></span>
      <select name="business_customer_type_service" class="form-control">
        <option <?php echo $email_automation->customer_type_service == 0 ? 'selected="selected"' : ''; ?> value="0" >Both Residential and Commercial</option>
        <option <?php echo $email_automation->customer_type_service == 1 ? 'selected="selected"' : ''; ?> value="1">Residential customers</option>
        <option <?php echo $email_automation->customer_type_service == 2 ? 'selected="selected"' : ''; ?> value="2">Commercial customers</option>
      </select>
    </div>   
    
    <div class="form-group">
      <label>Exclude Customer Groups</label> 
      <span class="help">Optional, select the groups if you would like to exclude them from automation.</span>
      <select name="exclude_customer_group" class="form-control">
        <option <?php echo $email_automation->exclude_customer_group == 0 ? 'selected="selected"' : ''; ?> value="0">Panel</option>
        <option <?php echo $email_automation->exclude_customer_group == 1 ? 'selected="selected"' : ''; ?> value="1">Test Group Only</option>
      </select>
    </div>                              

  </div> 

  <div class="col-md-4">
    &nbsp;
  </div>

</div>

<div class="row">
    <div class="col-md-8" id="subject-body-container-edit">
    <div class="form-group">
      <label>Subject</label> <span class="help"></span>
      <input type="text" name="email_subject" id="email_subject" value="<?php echo $email_automation->email_subject; ?>" class="form-control" autocomplete="off" required="">
    </div>    

    <div class="form-group">
      <label>Email Body</label> <span class="help"></span>
      <textarea name="email_body" id="automation_email_body_edit" cols="40" rows="5" class="form-control"><?php echo $email_automation->email_body; ?></textarea>
    </div>
  </div>

  <div class="col-md-4">

    <div class="panel-info">
      <div class="margin-bottom-sec">
          <label>Use default template</label>
          <select id="template_id" name="template_id" class="template_id_edit form-control" data-template="dropdown">
            <option value="0">- select -</option>
            <?php foreach($email_automation_templates_list as $email_atl) { ?>
                    <option value="<?php echo $email_atl->id ?>"><?php echo $email_atl->name ?></option>
            <?php } ?>
          </select>
      </div>
      <a id="set-default-template-edit" class="btn btn-primary margin-right" style="width: 80px;" href="javascript:void(0);">Set</a>
      <br /><a data-template="manage" href="#">Manage templates</a>
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

<script>

  CKEDITOR.replace("automation_email_body_edit",
  {
       height: 360
  }); 

  $(document).ready(function() {

    $("#set-default-template-edit").click(function(){
      var tid = $(".template_id_edit").val();
      var url = base_url + '/email_automation/ajax_set_default_template_edit';

      if(tid > 0) {
        var loading = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
        $("#subject-body-container-edit").html(loading);    

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {tid:tid},
               success: function(o)
               {
                  $("#subject-body-container-edit").html(o);
               }
            });
        }, 1000);

      }

    });  

  });

</script>