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
  /*background: #f9f9f9 !important;*/
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
<div class="wrapper-onboarding">
<div class="row">    
   <div class="col-md-12">
    <h3 style="background-color: #4A2268;color:#ffffff;padding:11px;">Which add ons do you like to use ?</h3>
    <div class="card">      
        <h5>Use our plugins for managing your business</h5>  
        <p>Pick from our wide range of plugins which will greatly helps you in boosting and managing your business</p>
         <?php // echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <?php  $row = 1;
                           if($NsmartUpgrades) {  foreach ($NsmartUpgrades as $key => $NsmartUpgrade) { 
                                $active_addons = "";
                                $active_subsciption = "Subscribe Now";
                                if($NsmartUpgradedItems){
                                  $is_subscribed = false;
                                    foreach ($NsmartUpgradedItems as $NsmartUpgradedItem) {
                                           $plan_id = $NsmartUpgrade->id;
                                           
                                           if ($plan_id == $NsmartUpgradedItem->plan_upgrade_id){
                                              $active_addons = "addon-selected";
                                              $active_subsciption = "Subscribed";
                                              $is_subscribed = true;
                                           }
                                    } 
                                } ?>
                           <?php if($row == 1){ ?>
                             <div class="marketing-card-deck card-deck pl-50 pb-25"> <?php } $row++; ?>
                                <!-- add class addon-selected for selector on anchor -->
                                <a href="javascript:void(0);" class="card border-gr btn-addon <?php echo $active_addons; ?>" data-id="<?= $NsmartUpgrade->id; ?>"><img class="marketing-img" alt="SMS Blast - Flaticons" src="<?php echo base_url('/assets/img/onboarding/'.$NsmartUpgrade->image_filename) ?>" data-holder-rendered="true">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0 text-center"><?php echo $NsmartUpgrade->name; ?></h5>
                                        <p style="text-align: justify;" class="card-text mt-txt"><?php  echo $NsmartUpgrade->description; ?></p>
                                        <p class="sc-bt"><strong><?php echo $active_subsciption; ?></strong></p>
                                        <div style="text-align: center;" class="card-price sc-bottom">$<?php  echo $NsmartUpgrade->sms_fee; ?>/SMS + $<?php  echo $NsmartUpgrade->service_fee; ?> service fee</div>
                                    </div>
                                </a>
                         <?php if($row == 4){ ?>
                          </div>
                        <?php $row = 1; }   ?>


                    <?php    }
                          } ?>
   </div>
   <div class="row">
      <div class="col-xs-16 text-right submit-onboard-v2">
         <a class="btn btn-default btn-lg margin-right" href="<?php echo base_url("/dashboard");?>">Skip</a>
         <a class="btn btn-default btn-lg" href="<?php echo base_url("/onboarding/industry_type");?>">« Back</a>
         <a class="btn btn-primary btn-lg margin-left" href="<?php echo base_url("/onboarding/availability");?>">Next »</a>
      </div>
   </div>
    </div>
   <br class="clear"/>
   <br/>   
<?php // echo form_close(); ?>

  <!-- Modal loading box --> 
  <div class="modal fade" id="modalLoadingMsg" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="">Plugin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open_multipart('onboarding/add_plugin', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
          <?php echo form_input(array('name' => 'pid', 'type' => 'hidden', 'value' => '', 'id' => 'pid'));?>
          <div class="modal-body plugin-info-container"></div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-add-plugin" name="action" value="add">Add Plugin</button>
              <button type="submit" class="btn btn-danger btn-remove-plugin" name="action" value="remove">Remove Plugin</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
  </div>

</div>
<?php include viewPath('includes/footer'); ?>

<script>
$(function(){
    $(".btn-addon").click(function(){
        var aid = $(this).attr("data-id");
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline-block;" /> Loading...</div>';
        var url = base_url + 'onboarding/_load_plugin_details';

        if( $(this).hasClass("addon-selected") ){
          $(".btn-add-plugin").hide();
          $(".btn-remove-plugin").show();
        }else{
          $(".btn-add-plugin").show();
          $(".btn-remove-plugin").hide();
        }

        $("#pid").val(aid);
        $("#modalLoadingMsg").modal("show");
        $(".plugin-info-container").html(msg);

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {aid:aid},
               success: function(o)
               {
                  $(".plugin-info-container").html(o);
               }
            });
        }, 500);
    });
});
</script>