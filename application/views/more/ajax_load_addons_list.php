<style>
.add-addon, .active-addon{
  text-align: center;
  width: 100%;
  padding: 10px;
  color: #ffffff;
}
.active-addon{
  background-color: #45a73c;
}
.add-addon{
  background-color: #32243d;
}
</style>
<?php foreach ($NsmartUpgrades as $nu) { ?>  
    <div class="col-md-3 col-sm-12" style="padding: 0px;">
      <div class="marketing-card-deck card-deck-upgrades pl-1 pb-30">
           <div class="card-container">
              <?php 
                $add_class = '';
                if( in_array($nu->id, $active_addons_id) ){
                  $add_class = 'availed';
                }
              ?>
              <a href="javascript:void(0);" class="card border-gr btn-addon <?= $add_class; ?>" data-id="<?= $nu->id; ?>">
                  <img class="marketing-img" alt="Add On" src="<?php echo base_url('/assets/img/onboarding/'.$nu->image_filename) ?>" data-holder-rendered="true">
                  <div class="card-body align-left">
                      <h5 class="card-title mb-0"><?php echo $nu->name; ?></h5>
                      <p style="text-align: justify;margin-top: 45px;height: 100px;" class="card-text mt-txt"><?php  echo $nu->description; ?></p>
                      <p style="color:#36c12a;text-align: center;font-size: 17px;">
                        <?php  
                          if( $nu->sms_fee > 0 ){
                            echo "$" . $nu->sms_fee . "/SMS + $" . $nu->service_fee . " service fee";
                          }else{
                            echo "$" . $nu->service_fee . " service fee";
                          }
                        ?>
                      </p>
                      <?php if( !in_array($nu->id, $active_addons_id) ){ ?>
                        <p style="text-align: center;" class="add-addon"><strong>Subscribe Now</strong></p>
                      <?php }else{ ?>
                        <p style="text-align: center;" class="active-addon"><strong>Active Addon</strong></p>
                      <?php } ?>
                      
                  </div>
              </a>
            </div>
          </div>
    </div>
<?php } ?>