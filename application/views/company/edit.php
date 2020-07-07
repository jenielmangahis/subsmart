<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User
    <small>Manage users</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

<?php echo form_open_multipart('company/update/'.$User->id, [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit User</h3>

      <div class="box-tools pull-right">
        <a href="<?php echo url('users') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to User</a>
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
            <label for="formClient-Name">Name</label>
            <input type="text" class="form-control" name="name" id="formClient-Name" required placeholder="Enter Name" value="<?php echo $User->name ?>" autofocus />
          </div>

          
          <div class="form-group">
            <label for="formClient-Contact">Contact Number</label>
            <input type="text" class="form-control" name="phone" id="formClient-Contact" placeholder="Enter Contact Number" value="<?php echo $User->phone ?>" />
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
            <label for="formClient-Username">Username</label>
            <input type="text" class="form-control" data-rule-remote="<?php echo url('users/check?notId='.$User->id) ?>" data-msg-remote="Username Already taken" name="username" id="formClient-Username" required placeholder="Enter Username"  value="<?php echo $User->username ?>"/>
          </div>

          <div class="form-group">
            <label for="formClient-Email">Email</label>
            <input type="email" class="form-control" name="email" data-rule-remote="<?php echo url('users/check?notId='.$User->id) ?>" data-msg-remote="Email Already Exists" id="formClient-Email" required placeholder="Enter email"  value="<?php echo $User->email ?>">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" minlength="6" name="password" id="password" placeholder="Password" />
            <p class="help-block">Leave Blank to remain unchanged !</p>
          </div>

          <div class="form-group">
            <label for="formClient-ConfirmPassword">Confirm Password</label>
            <input type="password" class="form-control" minlength="6" equalTo="#password" name="confirm_password" id="formClient-ConfirmPassword" placeholder="Confirm Password" />
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
            <textarea type="text" class="form-control" name="address" id="formClient-Address" placeholder="Enter Address" rows="3"><?php echo $User->address ?></textarea>

          </div>

          <div class="form-group">
            <label for="formClient-Role">Role</label>
            <select name="role" id="formClient-Role" class="form-control select2" required>
              <option value="">Select Role</option>
              <?php foreach ($this->roles_model->get() as $row): ?>
                <?php $sel = !empty($User->role) && $User->role==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->title ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <?php if (logged('id')!=$User->id): ?>
            
          <?php endif ?>
          <div class="form-group">
            <label for="formClient-Status">Status</label>
            <select name="status" id="formClient-Status" class="form-control" <?php echo logged('id')==$User->id ? 'disabled' : '' ?>>
              <?php $sel = $User->status==1 ? 'selected' : '' ?>
              <option value="1" <?php echo $sel ?>>Active</option>
              <?php $sel = $User->status==0 ? 'selected' : '' ?>
              <option value="0" <?php echo $sel ?>>InActive</option>
            </select>
          </div>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Profile Image</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Image">Image</label>
            <input type="file" class="form-control" name="image" id="formClient-Image" placeholder="Upload Image" accept="image/*" onchange="previewImage(this, '#imagePreview')">
          </div>
          <div class="form-group" id="imagePreview">
            <img src="<?php echo userProfile($User->id) ?>" class="img-circle" alt="Uploaded Image Preview" width="100" height="100">
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

</script>

<?php include viewPath('includes/footer'); ?>

