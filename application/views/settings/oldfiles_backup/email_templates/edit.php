<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<!-- Main content -->
<section class="content">

  <div class="row">

    <div class="col-sm-3">

      <?php include VIEWPATH.'/settings/sidebar.php'; ?>

    </div>
    <div class="col-sm-9">

      <!-- Default box -->
      <div class="box">
       
        <?php echo form_open_multipart('settings/update_email_templates/'.$template->id, [ 'class' => 'form-validate', 'autocomplete' => 'off', 'method' => 'post' ]); ?>

        <div class="box-header with-border">
          <h3 class="box-title">Email Templates</h3>

          <div class="box-tools pull-right">
            <a href="<?php echo url('settings/email_templates') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to Email Templates</a>
          </div>

        </div>

        <div class="box-body">

          <div class="form-group">
            <label for="Code"> Code</label>
            <input type="text" class="form-control" readonly name="code" id="Code" value="<?php echo $template->code ?>" required placeholder="Enter Code" />
          </div>

          <div class="form-group">
            <label for="Name"> Name</label>
            <input type="text" class="form-control" name="name" id="Name" value="<?php echo $template->name ?>" required placeholder="Enter Name" autofocus />
          </div>

          <div class="form-group">
            <label for="Data"> Template</label>
            <textarea name="data" rows="40" id="Data"><?php echo $template->data ?></textarea>
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-flat btn-primary">Submit</button>
          <a href="<?php echo url('settings/email_templates') ?>" class="btn btn-flat btn-danger pull-right">Cancel</a>
        </div>
        <!-- /.box-footer-->

        <?php echo form_close(); ?>

      </div>
      <!-- /.box -->

    </div>
  </div>

</section>
<!-- /.content -->

<script>
  $(document).ready(function() {
    $('.form-validate').validate();

  })

</script>

<?php include viewPath('includes/footer'); ?>

<!-- CK Editor -->
<script src="<?php echo $url->assets ?>plugins/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('Data')
  })
</script>
