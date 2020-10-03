<div class="form-group">
  <label>Subject</label> <span class="help"></span>
  <input type="text" name="email_subject" id="email_subject" value="<?php echo $post_data['email_subject']; ?>" class="email_subject_create form-control" autocomplete="off" required="">
</div>    

<div class="form-group">
  <label>Email Body</label> <span class="help"></span>
  <textarea name="email_body" id="automation_email_body_create" cols="40" rows="5" class="email-body-create form-control"><?php echo $post_data['email_body']; ?> <?php echo $post_data['placeholder_name']; ?></textarea>
</div>

<script>

  CKEDITOR.replace("automation_email_body_create",
  {
       height: 360
  }); 
  
</script>