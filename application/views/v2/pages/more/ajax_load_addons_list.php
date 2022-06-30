<?php foreach ($NsmartUpgrades as $nu): ?>  
    <div class="col-12 col-md-3">
        <?php 
            $add_class = '';
            if( in_array($nu->id, $active_addons_id) ){
                $add_class = 'availed';
            }
        ?>
        <div class="nsm-card primary p-5 btn-addon <?= $add_class; ?>" role="button" data-id="<?= $nu->id; ?>">
            <div class="nsm-card-content h-100">
                <div class="row h-100 align-content-between">
                    <div class="col-12 text-center mb-3">
                        <img class="nsm-card-img" src="<?php echo base_url('/assets/img/onboarding/'.$nu->image_filename) ?>">

                        <div class="nsm-card-title">
                            <span><?php echo $nu->name; ?></span>
                        </div>
                        <label class="nsm-subtitle d-block mt-3">
                            <?php  echo $nu->description; ?>
                        </label>
                    </div>
                    <div class="col-12 text-center">
                        <div class="row align-items-center mb-3">
                            <div class="col-12">
                                <label class="nsm-subtitle text-success">
                                    <?php  
                                        if( $nu->sms_fee > 0 ){
                                            echo "$" . $nu->sms_fee . "/SMS + $" . $nu->service_fee . " Service Fee";
                                        }else{
                                            echo "$" . $nu->service_fee . " Service Fee";
                                        }
                                    ?>
                                </label>
                            </div>
                        </div>
                        <?php if( !in_array($nu->id, $active_addons_id) ): ?>
                            <button type="button" class="nsm-button primary">Subscribe Now</button>
                        <?php else: ?>
                            <button type="button" class="nsm-button">Active Addon</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>