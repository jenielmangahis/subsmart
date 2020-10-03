<div class="row">
  <div class="col-md-12">

    <div class="form-group"><p>Set a name and enter email subject and body.</p></div>
    <input type="hidden" name="template_id" id="template_id" value="<?php echo $template_id; ?>">
    <div class="form-group">
      <label>Template Name</label> <span class="help">(for your reference)</span>
      <input type="text" name="name" id="name" value="<?php echo $template->name; ?>" class="form-control" autocomplete="off" required="">
    </div>  

    <div class="form-group">
      <label>Subject</label> <span class="help"></span>
      <input type="text" name="email_subject" id="email_subject" value="<?php echo $template->email_subject; ?>" class="form-control" autocomplete="off" required="">
    </div>    

    <div class="form-group">
      <label>Email Body</label> <span class="help"></span>
      <textarea name="email_body" id="template_email_body_edit" cols="40" rows="5" class="form-control"><?php echo $template->email_body; ?></textarea>
    </div>     

  </div>          
</div>

<script>
  
CKEDITOR.replace("template_email_body_edit",
{
  height: 360
});

</script>