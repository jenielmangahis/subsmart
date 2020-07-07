<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Document
    <small>Manage document</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

<?php echo form_open_multipart('document/save', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">New User</h3>

      <div class="box-tools pull-right">
        <a href="<?php echo url('company') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to Documents</a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Document Details</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Name">Document Name</label>
            <input type="text" class="form-control" name="name" id="formClient-Name" required placeholder="Enter Document Name" onkeyup="$('#formClient-Username').val(createUsername(this.value))" autofocus />
          </div>

          <div class="form-group">
            <label for="formClient-Image">Document Image</label>
            <input type="file" class="form-control" name="image" id="formClient-Image" placeholder="Upload Image" accept="image/*" onchange="previewImage(this, '#imagePreview')">
            <div class="form-group" id="imagePreview">
              <img src="<?php echo userProfile('default') ?>" class="img-circle" alt="Uploaded Image Preview" width="100" height="100">
            </div>
          </div>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->


      
   


  <!-- Default box -->
  <div class="box">
    <div class="box-footer">
      <button type="submit" class="btn btn-flat btn-primary pull-right">Submit</button>
    </div>
    <!-- /.box-footer-->

  </div>
  <!-- /.box -->
 </div>
<?php echo form_close(); ?>

</section>
<!-- /.content -->


<script>
  $(document).ready(function() {
    $('.form-validate').validate();
    $('.select2').select2();
  });

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

  function createUsername(name) {
      return name.toLowerCase()
        .replace(/ /g,'_')
        .replace(/[^\w-]+/g,'')
        ;
  }

</script>

<?php include viewPath('includes/footer'); ?>

