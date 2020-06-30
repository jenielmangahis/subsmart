<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Company
    <small>manage company</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

<?php echo form_open_multipart('company/save', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">New User</h3>

      <div class="box-tools pull-right">
        <a href="<?php echo url('company') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to User</a>
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
          <h3 class="box-title">Basic Details</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Name">First Name</label>
            <input type="text" class="form-control" name="FName" id="formClient-FName" required placeholder="Enter First Name" onkeyup="$('#formClient-Username').val(createUsername(this.value))" autofocus />
          </div>

          <div class="form-group">
            <label for="formClient-Name">Last Name</label>
            <input type="text" class="form-control" name="LName" id="formClient-LName" required placeholder="Enter Last Name" onkeyup="$('#formClient-Username').val(createUsername(this.value))" autofocus />
          </div>

          <div class="form-group">
            <label for="formClient-Contact">Company Number</label>
            <input type="text" class="form-control" name="phone" id="formClient-Contact" placeholder="Enter Contact Number" />
          </div>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Login Details</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Email">Email</label>
            <input type="email" class="form-control" name="email" data-rule-remote="<?php echo url('users/check') ?>" data-msg-remote="Email Already Exists" id="formClient-Email" required placeholder="Enter email">
          </div>

          <div class="form-group">
            <label for="formClient-Username">Username</label>
            <input type="text" class="form-control" data-rule-remote="<?php echo url('users/check') ?>" data-msg-remote="Username Already taken" name="username" id="formClient-Username" required placeholder="Enter Username" />
          </div>

          <div class="form-group">
            <label for="formClient-Password">Password</label>
            <input type="password" class="form-control" name="password" minlength="6" id="formClient-Password" required placeholder="Password">
          </div>

          <div class="form-group">
            <label for="formClient-ConfirmPassword">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" equalTo="#formClient-Password" id="formClient-ConfirmPassword" required placeholder="Confirm Password">
          </div>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
      
    </div>
    <div class="col-sm-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Other Details</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Address">Address</label>
            <textarea type="text" class="form-control" name="address" id="formClient-Address" placeholder="Enter Address" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="formClient-Role">Role</label>
            <select name="role" id="formClient-Role" class="form-control select2" required>
              <option value="">Select Role</option>
              <?php foreach ($this->roles_model->get() as $row): ?>
                <?php $sel = !empty(get('role')) && get('role')==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->title ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="formClient-Status">Status</label>
            <select name="status" id="formClient-Status" class="form-control">
              <option value="1" selected>Active</option>
              <option value="0">InActive</option>
            </select>
          </div>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Company logo</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Image">Image</label>
            <input type="file" class="form-control" name="image" id="formClient-Image" placeholder="Upload Image" accept="image/*" onchange="previewImage(this, '#imagePreview')">
          </div>
          <div class="form-group" id="imagePreview">
            <img src="<?php echo userProfile('default') ?>" class="img-circle" alt="Uploaded Image Preview" width="100" height="100">
          </div>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

    </div>
  </div>

  <!-- Default box -->
  <div class="box">
    <div class="box-footer">
      <button type="submit" class="btn btn-flat btn-primary">Submit</button>
    </div>
    <!-- /.box-footer-->

  </div>
  <!-- /.box -->

<?php echo form_close(); ?>

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

  function createUsername(name) {
      return name.toLowerCase()
        .replace(/ /g,'_')
        .replace(/[^\w-]+/g,'')
        ;;
  }

</script>

<?php include viewPath('includes/footer'); ?>

