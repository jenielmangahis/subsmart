<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(0);
?>
<?php include viewPath('includes/no_menu_header'); ?>
<style type="text/css">
.wrapper-onboarding {
  padding: 40px;
  max-width: 1340px;
  margin: 0 auto;
  width: 100%;
}
body {
  /*background: #f9f9f9 !important;*/
}
._2LpwQ___Wrapper__cls1._1cMla___Wrapper__media-tablet-up {
  margin-top:30px !important;
}
.profile-avatar-help-container span {
  color: #6b3a96;
}
.text-booking {
  text-align: center;color: #682998;font-size: 27px;
}
.submit-onboard {
  width: 97.5%;
  float: right;
}
.calendly-container {
  min-width:320px;height:75vh;bottom:30px;
}
.validation-error-field {
  padding-top: 0px !important;
}
.margin-top-img {
  margin-top: 24px;
}
.text-right {
  text-align: right;
}
.card h3 {
  padding-bottom: 6px;
  border-bottom: 1px solid #e6e3e3;
  margin-bottom: 20px;
}
#form-business-details .card {
  padding: 20px 30px !important;
}
@media only screen and (max-width: 800px) {
  .text-booking {
    text-align: center;color: #682998;font-size: 20px;
  }
  .calendly-container {
      min-width: 320px;
      height: 60vh;
      bottom: 0px;
      top: 20px;
  }
}
@media only screen and (max-width: 600px) {
  body #topnav {
    min-height: 0px;
  }
  .col-md-9, .col-md-3, .col-md-4, .col-md-6 {
      padding-left: 0px !important;
      padding-right: 0px !important;
  }
  .profile-avatar-container {
    margin-bottom: 15px;
  }
  .checkbox-sec label span {
    font-size: 13px !important;
  }
  #form-business-details .card {
    padding: 20px;
  }
  .wrapper-onboarding {
    padding: 20px 10px 60px 10px;
  }
  .card {
    width: 100% !important;
  }
  .col-md-6 {
    padding-top: 10px !important;
  }
  .checkbox.checkbox-sec label span {
      width: 100% !important;
      font-size: 11px !important;
  }
}
</style>
<div>
   <div class="wrapper-onboarding">
    <h3 style="background-color: #4A2268;color:#ffffff;padding:11px;">Would you like to learn more about our features, from one of our experts? </h3>
    <div class="card">
      <div class="col-md-24 col-lg-24 col-xl-18">     
          <!-- Calendly inline widget begin -->
          <div class="calendly-inline-widget" data-url="https://calendly.com/support-2405" style="min-width:320px;height:630px;"></div>
          <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
          <!-- Calendly inline widget end -->
              
          <!-- Calendly inline widget begin -->
          <!-- <div class="calendly-inline-widget calendly-container" data-url="https://calendly.com/bryann-revina03?primary_color=9d00ff"></div> -->
          <!-- <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script> -->
          <!-- Calendly inline widget end -->
          <div class="msg-container"></div>
      </div>
      <div class="row">
         <div class="col-xs-16 text-right submit-onboard">
            <a class="btn btn-default btn-lg" href="<?php echo base_url("/onboarding/credentials");?>">« Back</a>
            <a class="btn btn-primary btn-lg margin-left btn-onboarding-fin" href="javascript:void(0);">Finish</a>
         </div>
      </div>
   </div>
 </div>
</div>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
  $(".btn-onboarding-fin").click(function(){
    var msg = '<img src="'+base_url+'/assets/img/spinner.gif" style="display:inline-block;" /> Saving...';
    var url = base_url + 'onboarding/_complete_onboarding';
    
    $(".msg-container").html(msg);

    setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: {},
             success: function(o)
             {
                location.href = base_url + 'dashboard';
             }
          });
      }, 500);
  });
});
</script>
