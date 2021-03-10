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
height:35px;
width:35px;
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
.box-step-1, .box-step-2 {
  width: 400px;
  margin: 0 auto;
  display: block;
}
div.login-box {
    background-color: white !important;
    height: auto;
    width: 650px;
    padding-top:10px;
    display: block;
    position: absolute;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    top:15vh;
    box-shadow: rgb(0 0 0 / 30%) 3px 0px 6px;
}
.clear {
  clear: both;
}
.center-fix {
  position: absolute;
  margin-left: auto;
  margin-right: auto;
  left: 0;
  right: 0;
  margin-top: 25px;
}
i.fa.fa-eye.view-password.showPass {
    float: right;
    margin-top: 10px;
    margin-bottom: 10px;
    position: relative;
    bottom: 34px;
    right: 10px;
}
.divider-box {
  display: block;
  height: 150px;
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
@media only screen and (max-width: 600px) {
  div.login-box {
    width: 95%;
  }
}
</style>

<div class="login-box">

  <div class="col-md-12 center-fix">
    <ul class="progressbar">
      <li class="step-1 active">ENTER USER ID</li>
      <li class="step-2"><span>SELECT PASSWORD</span></li>
      <li class="step-3">LOGIN</li>
    </ul>
  </div>
  <div class="divider-box"></div>
  <div class="box-step-1">
    <div style="display:block;width:70%;margin:0 auto;">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="userid" type="text" class="form-control" name="userid" placeholder="Enter your User ID">
      </div>
    </div>
    <br class="clear" />
    <div style="display:block;width:70%;margin:0 auto;text-align:center;">
      <a class="btn btn-info btn-step1-next" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">CONTINUE</a>
      <br class="clear" />
      <a class="btn-cancel" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">CANCEL</a>
    </div>
  </div>

  <div class="box-step-2" style="display: none;">

      <div style="display:block;width:70%;margin:0 auto;">
          <label for="">New Password</label>
          <input type="password" name="new_password" id="newPassword" required="" class="form-control">
          <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
          <span class="old-password-error"></span>
      </div>
      <br class="clear" />
      <div style="display:block;width:70%;margin:0 auto;">
          <label for="">Retype Password</label>
          <input type="password" name="re_password" id="rePassword" required="" class="form-control">
          <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
      </div>
      <br class="clear" />
      <div style="display:block;width:70%;margin:0 auto;text-align:center;">
        <a class="btn btn-info btn-step2-next" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">CONTINUE</a>
        <br class="clear" />
        <a class="btn-cancel" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">CANCEL</a>
      </div>
  </div>
  <br class="clear" /><br class="clear" />

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
