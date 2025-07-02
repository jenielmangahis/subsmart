<?php foreach ($NsmartUpgrades as $nu): ?>  
    <div class="col-12 col-md-3">
        <?php 
            $add_class = '';
            if( in_array($nu->id, $active_addons_id) ){
                $add_class = 'availed';
            }
        ?>
        <div class="nsm-card primary p-5 <?= $add_class; ?>" data-id="<?= $nu->id; ?>">
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
                                <label class="nsm-subtitle" style="font-size:15px;font-weight:bold;">
                                    <?php  
                                        if( $nu->sms_fee > 0 ){
                                            //echo "$" . number_format($nu->sms_fee,2,".",",") . "/SMS + $" . $nu->service_fee . " Service Fee";
                                            echo "$" . number_format($nu->service_fee,2,".",",") . " Service Fee";
                                        }else{
                                            echo "$" . number_format($nu->service_fee,2,".",",") . " Service Fee";
                                        }
                                    ?>
                                </label>
                            </div>
                        </div>
                        <?php if( !array_key_exists($nu->id, $active_addons_id) ){ ?>
                            <button type="button" class="nsm-button primary btn-subscribe-now" data-name="<?= $nu->name; ?>" data-servicefee="<?= number_format($nu->service_fee,2,".",","); ?>" data-id="<?= $nu->id; ?>" data-smsfee="<?= number_format($nu->sms_fee,2,".",","); ?>">Subscribe Now</button>
                        <?php }else{ ?>
                            <button type="button" class="nsm-button primary btn-open-addon" data-id="<?= $nu->id; ?>" data-name="<?= $nu->name; ?>">Open Module</button>
                            <?php if( $active_addons_id[$nu->id] == 1 ){ ?>
                                <button type="button" class="nsm-button btn-cancel-request-removal" data-id="<?= $nu->id; ?>" data-name="<?= $nu->name; ?>">Cancel Request Removal</button>
                            <?php }else{ ?>
                                <button type="button" class="nsm-button btn-remove-add-on" data-id="<?= $nu->id; ?>" data-name="<?= $nu->name; ?>">Remove Addon</button>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>