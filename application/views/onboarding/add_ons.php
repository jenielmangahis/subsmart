<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/no_menu_header'); ?>
<style type="text/css">
.wrapper-onboarding {
  padding: 40px;
  max-width: 1340px;
  margin: 0 auto;
  width: 100%;
}
body {
  background: #f9f9f9 !important;
}
a.card.border-gr.btn-addon {
  box-shadow: rgb(0 0 0 / 18%) 4px 5px 12px;
}
.profile-avatar-help-container span {
  color: #6b3a96;
}
.submit-onboard {
  width: 97.5%;
  float: right;
}
.validation-error-field {
  padding-top: 0px !important;
}
.clear {
  clear: both;
}
.margin-top-img {
  margin-top: 24px;
}
.submit-onboard-v2 {
  width: 95.5%;
  float: right;
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
.pb-25 {
  padding-bottom: 25px;
}
.sc-bt {
  position: absolute;
  bottom: 32px;
  text-align: center;
  width: 71%;
  color: #5e43c7;
  font-size: 16px;3
}
.sc-bottom {
  width: 100%;
  text-align: center;
  color: #369e2c;
  position: absolute;
  bottom: 20px;
  right: 4px;
  font-size: 17px;
  font-weight: bold;
}
.addon-selected {
  background: #a3ecc5;
}
.text-center {
  text-align: center !important;
}
@media only screen and (max-width: 1160px) {
  .card-deck .card {
    flex: 0 1 27%;
    flex-direction: column;
    margin-right: 30px;
    margin-bottom: 0;
    margin-left: 15px;
    margin-top: 15px;
    max-width: 480px;
  }
  .sc-bt {
    font-size: 14px;
  }
  .sc-bottom {
    position: absolute;
    right: -2px;
    font-size: 14px
  }
}
@media only screen and (max-width: 800px) {
  .card-deck .card {
    flex: 0 1 85% !important;
    margin: 0 auto !important;
    margin-bottom: 40px !important;
  }
  .card-body {
    width: 100% !important;
  }
  .col-xs-16.text-right.submit-onboard-v2 {
      width: 50%;
      margin: 0 auto;
      position: relative;
      right: 6vw;
  }
}
@media only screen and (max-width: 600px) {
  body #topnav {
    min-height: 0px;
  }
  .card-body {
    width: 100% !important;
  }
  .card-deck .card {
    flex: 0 1 90% !important;
    margin: 0 auto !important;
    margin-bottom: 40px !important;tant
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
    padding: 20px 25px 60px 25px;
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
   <div>
      <div class="wrapper-onboarding">
         <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <?php  $row = 1;
                           if($NsmartUpgrades) {  foreach ($NsmartUpgrades as $key => $NsmartUpgrade) { ?>

                           <?php if($row == 1){ ?>
                             <div class="marketing-card-deck card-deck pl-50 pb-25"> <?php } $row++; ?>
                                <!-- add class addon-selected for selector on anchor -->
                                <a href="#" class="card border-gr btn-addon" data-id="<?= $NsmartUpgrade->id; ?>"><img class="marketing-img" alt="SMS Blast - Flaticons" src="<?php echo base_url('/assets/dashboard/images/online-booking.png') ?>" data-holder-rendered="true">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0 text-center"><?php echo $NsmartUpgrade->name; ?></h5>
                                        <p style="text-align: justify;" class="card-text mt-txt"><?php  echo $NsmartUpgrade->description; ?></p>
                                        <p class="sc-bt"><strong>Subscribe Now</strong></p>
                                        <div style="text-align: center;" class="card-price sc-bottom">$<?php  echo $NsmartUpgrade->sms_fee; ?>/SMS + $<?php  echo $NsmartUpgrade->service_fee; ?> service fee</div>
                                    </div>
                                </a>
                         <?php if($row == 4){ ?>
                          </div>
                        <?php $row = 1; }   ?>


                    <?php    }
                          } ?>
   </div>
   <br class="clear"/>
   <br/>
   <div class="row">
      <div class="col-xs-16 text-right submit-onboard-v2">
         <button class="btn btn-primary btn-lg margin-left" name="action" value="business_info" type="submit">Next »</button>
      </div>
   </div>
<?php echo form_close(); ?>
</div>
<?php include viewPath('includes/footer'); ?>
