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


    <?php echo form_open('/login/check', ['method' => 'POST', 'autocomplete' => 'off']); ?>
    <div class="form-group has-feedback">
      <input type="text" class="form-control" placeholder="Enter Username or Email..."
        value="<?php echo post('username') ?>"
        name="username" autofocus />
      <span class="fa fa-user form-control-feedback"></span>
      <?php echo form_error('username', '<div class="error" style="color: red;">', '</div>'); ?>
    </div>

    <div class="form-group has-feedback">
      <input type="password" class="form-control" placeholder="Password" name="password">
      <span class="fa fa-lock form-control-feedback"></span>
      <?php echo form_error('password', '<div class="error" style="color: red;">', '</div>'); ?>
    </div>

    <?php if (setting('google_recaptcha_enabled') == '1') : ?>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div class="form-group">
      <div class="g-recaptcha"
        data-sitekey="<?php echo setting('google_recaptcha_sitekey') ?>">
      </div>
      <?php echo form_error('g-recaptcha-response', '<div class="error" style="color: red;">', '</div>'); ?>
    </div>

    <?php endif ?>



    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck mr-top-6">
          <label>
            <input type="checkbox" <?php echo post('remember_me') ? 'checked' : '' ?>
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
    <div class="row mr-bottom-10">
      <div class="col-xs-6">
        <a href="#" class="login-social fb-color"><i class="fa fa-facebook"></i> Sign In Facebook</a>
      </div>
      <div class="col-xs-6" style="padding-left:0px;">
        <img
          src="<?php echo base_url() ?>assets/dashboard/images/google/google.png"
          width="160" style="cursor:pointer;" alt="">
        <!-- <a href="#" class="login-social google-color"><i class="fa fa-google"></i>Sign In Gmail</a> -->
      </div>
    </div>
    <a href="<?php echo url('login/forget'); ?>">Forgot
      your password ?</a><br>
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include 'includes/footer.php' ?>
<script>
  $(document).ready(function() {
    // var timeZoneFormatted = new Date().toString().match(/([A-Z]+[\+-][0-9]+)/)[1];
    var offset = new Date().getTimezoneOffset();
    var offset_zone = (offset / 60) * (-1);
    if (offset_zone >= 0) {
      offset_zone = "+" + offset_zone;
    }
    $.ajax({
      url: "<?= base_url() ?>/login/timezonesetter",
      type: "POST",
      dataType: "json",
      data: {
        usertimezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
        offset_zone: "GMT" + offset_zone
      },
      success: function(data) {}
    });




  });
</script>