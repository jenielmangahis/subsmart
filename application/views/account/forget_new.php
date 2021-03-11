<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'includes/header.php' ?>
<style>
.container {
width:100%;
margin-top: 100px;
}
.progressbar {
counter-reset: step;
}
.progressbar li{
list-style-type: none;
float: left;
width: 33.33%;
position:relative;
text-align: center;
font-weight: 600;
}
.progressbar li:before {
/* CSS for creating steper block before the li item*/
content:counter(step);
counter-increment: step;
height:30px;
width:30px;
line-height: 30px;
border: 2px solid #ddd;
display:block;
text-align: center;
margin: 0 auto 10px auto;
border-radius: 50%;
background-color: white;
}
.progressbar li:after {
/* CSS for creating horizontal line*/
content:’’;
position: absolute;
width:100%;
height:2px;
background-color: #ddd;
top: 15px;
left: -50%;
z-index: -1;
}
.progressbar li:first-child:after {
content:none;
}
.progressbar li.active {
color:#27ae60;
}
.progressbar li.active:before {
border-color:#27ae60;
}
.progressbar li.active + li:after{
background-color:#27ae60;
}
</style>

<div class="login-box">
  <div class="row">
  <div class="col-md-6">
    <ul class="progressbar">
      <li class="step-1 active">ENTER USER ID</li>
      <li class="step-2">SELECT PASSWORD</li>
      <li class="step-3">LOGIN</li>
    </ul>
  </div>
  </div>
  <div class="box-step-1" style="position: absolute;">
    <div class="row">
      <div class="col-md-6">
        <input type="text" class="form-control" placeholder="User ID" value="">
      </div>    
    </div>
    <div class="row">
      <div class="col-md-6">
        <a class="btn btn-info btn-step1-next" href="javascript:void(0);">CONTINUE</a>
        <a class="btn btn-info btn-cancel" href="javascript:void(0);">CANCEL</a>
      </div>
    </div>
  </div>

  <div class="box-step-2" style="display: none;">
    <div class="row">
      <div class="col-md-6">
          <label for="">New Password</label>
          <input type="password" name="new_password" id="newPassword" required="" class="form-control">
          <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
          <span class="old-password-error"></span>
      </div>
      <div class="col-md-6">
          <label for="">Retype Password</label>
          <input type="password" name="re_password" id="rePassword" required="" class="form-control">
          <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <a class="btn btn-info btn-step2-next" href="javascript:void(0);">CONTINUE</a>
        <a class="btn btn-info btn-cancel" href="javascript:void(0);">CANCEL</a>
      </div>
    </div>
  </div>
  <br /><br />  

</div>
<!-- /.login-box -->

<?php include 'includes/footer.php' ?>
<script>
$(function(){
  $(".btn-step1-next").click(function(){
    $(".box-step-1").fadeOut();
    $(".box-step-2").fadeIn();

    $(".step-2").addClass('active');
  });

  $('.showPass').click(function () {
      $(this).toggleClass('fa-eye-slash');
      if ($(this).prev('input[type="password"]').length == 1){
          $(this).prev('input[type="password"]').attr('type','text');
          $(this).attr('title','Hide password').attr('data-original-title','Hide password').tooltip('update').tooltip('show');
      }else{
          $(this).prev('input[type="text"]').attr('type','password');
          $(this).attr('title','Show password').attr('data-original-title','Show password').tooltip('update').tooltip('show');
      }
  });
  $('.showConfirmPass').click(function () {
      $(this).toggleClass('fa-eye-slash');
      if ($(this).prev('input[type="password"]').length == 1){
          $(this).prev('input[type="password"]').attr('type','text');
          $(this).attr('title','Hide password').attr('data-original-title','Hide password').tooltip('update').tooltip('show');
      }else{
          $(this).prev('input[type="text"]').attr('type','password');
          $(this).attr('title','Show password').attr('data-original-title','Show password').tooltip('update').tooltip('show');
      }
  });
});
</script>
