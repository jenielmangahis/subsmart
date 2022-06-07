<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php include 'includes/header.php' ?>
<style type="text/css">
  .centered {
    position: fixed;
    left: 30%;
    top: 25%;
    /*transform: translateX(-50%, -50%);*/
  }
</style>
<div class="login-box centered">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo">
      <!-- <a href="<?php //echo url('/')
                    ?>"><b>Business</b> Panel</a> -->
      <a href="<?php echo url('/'); ?>"
        class="logo">
        <img style="width: 200px;"
          src="<?php echo base_url() ?>assets/dashboard/images/logo.png"
          alt="">
      </a>
    </div>
    <p class="login-box-msg">Sign in to start your session</p>

    <?php if (isset($message)) : ?>
    <div class="alert alert-<?php echo $message_type ?>">
      <p><?php echo $message ?>
      </p>
    </div>
    <?php endif; ?>

    <?php if (!empty($this->session->flashdata('message'))) : ?>
    <div
      class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
      <p><?php echo $this->session->flashdata('message') ?>
      </p>
    </div>
    <?php endif; ?>

    <?php // include( VIEWPATH.'/includes/notifications.php' );
    ?>


    <?php echo form_open('/login/customer_check', ['method' => 'POST', 'autocomplete' => 'off']); ?>
    <div class="form-group has-feedback">
      <input type="text" class="form-control" placeholder="Username"
        value="<?php echo post('username') == '' ? $remember_username : post('username'); ?>"
        name="username" autofocus />
      <span class="fa fa-user form-control-feedback"></span>
      <?php echo form_error('username', '<div class="error" style="color: red;">', '</div>'); ?>
    </div>

    <div class="form-group has-feedback">
      <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $remember_password != '' ? $remember_password : ''; ?>">
      <span class="fa fa-lock form-control-feedback"></span>
      <?php echo form_error('password', '<div class="error" style="color: red;">', '</div>'); ?>
    </div>


    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck mr-top-6">
          <label>
            <input type="checkbox" <?php echo $remember_me ? 'checked' : '' ?>
            name="remember_me" /> Remember Me
          </label>
        </div>
      </div>
      <!-- /.col -->

      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div>
      <!-- /.col -->
    </div>
    <?php echo form_close(); ?>
    <!-- <a href="<?php echo url('login/forget'); ?>">Forgot
      your password ?</a><br> -->
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include 'includes/footer.php' ?>