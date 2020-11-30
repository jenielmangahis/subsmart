<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/no_menu_header'); ?>
<div role="wrapper">
   <div wrapper__section>
      <div class="col-md-24 col-lg-24 col-xl-18">
         <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <?php  $row = 1; 
                           if($NsmartUpgrades) {  foreach ($NsmartUpgrades as $key => $NsmartUpgrade) { ?>
                           
                           <?php if($row == 1){ ?>
                             <div class="marketing-card-deck card-deck pl-50 pb-100"> <?php } $row++; ?>
                            
                                <a href="#" class="card border-gr btn-addon" data-id="<?= $NsmartUpgrade->id; ?>"><img class="marketing-img" alt="SMS Blast - Flaticons" src="<?php echo base_url('/assets/dashboard/images/online-booking.png') ?>" data-holder-rendered="true">
                                    <div class="card-body align-left">
                                        <h5 class="card-title mb-0"><?php echo $NsmartUpgrade->name; ?></h5>
                                        <p style="text-align: justify;" class="card-text mt-txt"><?php  echo $NsmartUpgrade->description; ?></p>
                                        <p style="text-align: center;"><strong>Subscribe Now</strong></p>
                                        <div style="text-align: center;" class="card-price bottom-txt">$<?php  echo $NsmartUpgrade->sms_fee; ?>/SMS + $<?php  echo $NsmartUpgrade->service_fee; ?> service fee</div>
                                    </div>
                                </a>     
                         <?php if($row == 4){ ?>
                          </div>
                        <?php $row = 1; }   ?>


                    <?php    } 
                          } ?>
                          <div class="row">
               <div class="col-xs-16 text-right submit-onboard">
                  <button class="btn btn-primary btn-lg margin-left" name="action" value="business_info" type="submit">Next »</button>
               </div>
            </div>
         <?php echo form_close(); ?>
   </div>
</div>
<?php include viewPath('includes/footer'); ?> 



