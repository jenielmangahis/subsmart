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
.box-step-1, .box-step-2, .box-step-3 {
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
<form id="frm-forgot-pw">
  <div class="col-md-12 center-fix">
    <ul class="progressbar">
      <?php if( $is_with_token > 0 ){ ?>
        <?php $show_step_1 = 0; ?>
        <li class="step-1 active">USERNAME / EMAIL</li>
        <li class="step-2 active"><span>PASSWORD</span></li>
        <li class="step-3">LOGIN</li>
      <?php }else{ ?>
        <?php $show_step_1 = 1; ?>
        <li class="step-1 active">USERNAME / EMAIL</li>
        <li class="step-2"><span>PASSWORD</span></li>
        <li class="step-3">LOGIN</li>
      <?php } ?>      
    </ul>
  </div>
  <div class="divider-box"></div>
    <div class="box-step-1" <?= $show_step_1 == 0 ? 'style="display:none;"' : '';  ?>>
      <div style="display:block;width:70%;margin:0 auto;">
        <div class="stp1-msg"></div>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="user_id" type="text" class="form-control" name="user_id" placeholder="Username / Email">
        </div>
        <!-- <br />
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
          <input id="user_zipcode" type="text" class="form-control" name="user_zipcode" placeholder="Zip Code">
        </div> -->
      </div>
      <br class="clear" />
      <div style="display:block;width:70%;margin:0 auto;text-align:center;">
        <a class="btn btn-info btn-step1-next" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">CONTINUE</a>
        <br class="clear" />
        <a class="btn-cancel" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">CANCEL</a>
      </div>
    </div>

    <div class="box-step-2" <?= $show_step_1 == 1 ? 'style="display:none;"' : '';  ?>>        
        <?php if($is_with_token == 1){ ?>
          <div class="stp2-msg"></div><br />
          <input type="hidden" id="reset-token" name="reset_token" value="<?= $reset_token; ?>">
          <div style="display:block;width:70%;margin:0 auto;">
              <label for="">New Password</label>
              <input type="password" name="new_password" id="new_password" required="" class="form-control">
              <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
              <span class="old-password-error"></span>
          </div>
          <br class="clear" />
          <div style="display:block;width:70%;margin:0 auto;">
              <label for="">Retype Password</label>
              <input type="password" name="re_password" id="re_password" required="" class="form-control">
              <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
          </div>
          <br class="clear" />
          <div style="display:block;width:70%;margin:0 auto;text-align:center;">
            <a class="btn btn-info btn-step2-next" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">CONTINUE</a>
            <br class="clear" />
            <a class="btn-cancel" href="javascript:void(0);" style="width: 100%;margin-bottom: 10px;">CANCEL</a>
          </div>
        <?php }else{ ?>
          <div class="stp2-msg"><p class='alert alert-danger'>Invalid reset token</p></div>
        <?php } ?>
    </div>

    <div class="box-step-3" style="display: none;">
      <div style="display:block;width:70%;margin:0 auto;">
        <div class="stp3-msg"></div>
      </div>
      
    </div>

  <br class="clear" /><br class="clear" />
</form>
</div>
<!-- /.login-box -->

<?php include 'includes/footer.php' ?>
<script>
$(function(){
  var base_url = '<?= base_url() ?>';
  $(".btn-step1-next").click(function(){
    var url = base_url + 'login/_check_user_id_exists';
    $(".stp1-msg").html("");

    if( $("#user_id").val() == '' ){
      var msg = "<p class='alert alert-danger'>Please enter your user id</p>";
      $('.stp1-msg').hide().html(msg).fadeIn(500);
    }else if( $("#user_zipcode").val() == '' ){
      var msg = "<p class='alert alert-danger'>Please enter your zip code</p>";
      $('.stp1-msg').hide().html(msg).fadeIn(500);
    }else{
      $(".btn-step1-next").html('<span class="spinner-border spinner-border-sm m-0"></span>  Validating');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,    
           dataType: "json",      
           data: $("#frm-forgot-pw").serialize(),
           success: function(o)
           {
              if( o.is_success == 1 ){
                  $('.stp1-msg').hide().html("<p class='alert alert-success'>Password reset link was sent to your email. Please check your email.</p>").fadeIn(500);
                  /*$(".stp1-msg").html("");

                  $(".box-step-1").css("display", "none");
                  //$(".box-step-1").fadeOut();
                  $(".box-step-2").fadeIn();

                  $(".step-2").addClass('active');*/
                  $(".btn-step1-next").html('CONTINUE');
              }else{
                  $('.stp1-msg').hide().html("<p class='alert alert-danger'>"+o.msg+"</p>").fadeIn(500);
                  $(".btn-step1-next").html('CONTINUE');
              }            
           }
        });
      }, 1000);
    }    
  });

  $(".btn-step2-next").click(function(){
    var url = base_url + 'login/_update_user_password';
    $(".stp2-msg").html("");
    if( $("#new_password").val() == '' ){
      var msg = "<p class='alert alert-danger'>Please enter your new password</p>";
      $('.stp2-msg').hide().html(msg).fadeIn(500);
    }else if( $("#re_password").val() == '' ){
      var msg = "<p class='alert alert-danger'>Please retype your password</p>";
      $('.stp2-msg').hide().html(msg).fadeIn(500);
    }else{
      $(".btn-step2-next").html('<span class="spinner-border spinner-border-sm m-0"></span>  Validating');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,    
           dataType: "json",      
           data: $("#frm-forgot-pw").serialize(),
           success: function(o)
           {
              if( o.is_success == 1 ){
                  $(".box-step-2").css("display", "none");
                  //$(".box-step-2").fadeOut();
                  $(".box-step-3").fadeIn();
                  $(".step-3").addClass('active');

                  $('.stp3-msg').hide().html("<p class='alert alert-info'>"+o.msg+"</p>").fadeIn(500);
                  setTimeout(function() {
                    location.href = base_url + "login";
                  }, 2500);
              }else{
                  $('.stp2-msg').hide().html("<p class='alert alert-danger'>"+o.msg+"</p>").fadeIn(500);
                  $(".btn-step2-next").html('CONTINUE');
              }            
           }
        });
      }, 1000);
    }
  });

  $(".btn-cancel").click(function(){
    location.href = base_url + "login";
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
