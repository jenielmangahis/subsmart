<div class="form-group">
  <label>Subject</label> <span class="help"></span>
  <input type="text" name="email_subject" id="email_subject" value="<?php echo $email_automation->email_subject; ?>" class="form-control" autocomplete="off" required="">
</div>    

<div class="form-group">
  <label>Email Body</label> <span class="help"></span>
  <textarea name="email_body" id="automation_email_body_create_edit" cols="40" rows="5" class="email-body-create form-control"><?php echo $email_automation->email_body; ?></textarea>
</div>

<script>

  CKEDITOR.replace("automation_email_body_create_edit",
  {
       height: 360
  }); 
  
</script>