<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<!-- Main content -->
<section class="content">

  <div class="row">

    <div class="col-sm-3">

      <?php include 'sidebar.php'; ?>

    </div>
    <div class="col-sm-9">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Company Settings</h3>
        </div>

        <?php echo form_open_multipart('settings/companyUpdate', [ 'class' => 'form-validate', 'autocomplete' => 'off', 'method' => 'post' ]); ?>
        <div class="box-body">

          <div class="form-group">
            <label for="formSetting-Company-Name">Company Name</label>
            <input type="text" class="form-control" name="company_name" id="formSetting-Company-Name" value="<?php echo setting('company_name') ?>" required placeholder="Enter Company Name" autofocus />
          </div>

          <div class="form-group">
            <label for="formSetting-Company-Email">Company Email</label>
            <input type="text" class="form-control" name="company_email" id="formSetting-Company-Email" value="<?php echo setting('company_email') ?>" required placeholder="Enter Company Email" autofocus />
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-flat btn-primary">Submit</button>
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

      //Initialize Select2 Elements
    $('.select2').select2()

  })

  function previewImage(input, previewDom) {

    if (input.files && input.files[0]) {

      $(previewDom).show();

      var reader = new FileReader();

      reader.onload = function(e) {
        $(previewDom).find('img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }else{
      $(previewDom).hide();
    }

  }
</script>

<?php include viewPath('includes/footer'); ?>

