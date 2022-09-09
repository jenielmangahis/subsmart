<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'includes/header.php' ?>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
  <div class="login-logo">
    <a href="<?php echo url('/');?>" class="logo">          <img style="width: 200px;" src="<?php echo base_url()?>assets/dashboard/images/logo.png" alt="">     </a>
  </div>

  <hr>
  <div class="text-center">
  	<img src="<?php echo userProfile($user->id) ?>" width="150" class="img-circle" alt="Profile Image"><br>
  	<strong><?php echo $user->name ?></strong>
  </div>
  <hr>

    <p class="login-box-msg">Set New Password for you account !</p>

    <?php if(isset($message)): ?>
      <div class="alert alert-<?php echo $message_type ?>">
        <p><?php echo $message ?></p>
      </div>
    <?php endif; ?>

    <?php if(!empty($this->session->flashdata('message'))): ?>
      <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
        <p><?php echo $this->session->flashdata('message') ?></p>
      </div>
    <?php endif; ?>


    <?php echo form_open('/login/set_new_password', ['method' => 'POST', 'autocomplete' => 'off']); ?> 
    	<input type="hidden" value="<?php echo $user->reset_token ?>" />
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Enter New Password..." minlength="6" name="password" required autofocus id="password" />
        <span class="fa fa-lock form-control-feedback"></span>
        <?php echo form_error('password', '<div class="error" style="color: red;">', '</div>'); ?>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" equalTo="#password" placeholder="Enter New Password Again..." required name="password_confirm" />
        <span class="fa fa-lock form-control-feedback"></span>
        <?php echo form_error('password_confirm', '<div class="error" style="color: red;">', '</div>'); ?>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="button" type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close(); ?>

    <a href="<?php echo url('login') ?>"> <i class="fa fa-chevron-left"></i> Go To Login</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include 'includes/footer.php' ?>
