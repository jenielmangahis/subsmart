<?php foreach ($NsmartUpgrades as $nu) : ?>
    <?php if( array_key_exists($nu->id, $active_addons_id)): ?>
        <div class="col-12 col-md-3">
            <div class="nsm-card primary p-5 role="button" data-id="<?= $nu->id; ?>">
                <div class="nsm-card-content h-100">
                    <div class="row h-100 align-content-between">
                        <div class="col-12 text-center mb-3">
                            <img class="nsm-card-img" src="<?php echo base_url('/assets/img/onboarding/' . $nu->image_filename) ?>">

                            <div class="nsm-card-title">
                                <span><?php echo $nu->name; ?></span>
                            </div>
                            <label class="nsm-subtitle d-block mt-3">
                                <?php echo $nu->description; ?>
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
                            <button type="button" class="nsm-button primary btn-open-addon" data-id="<?= $nu->id; ?>" data-name="<?= $nu->name; ?>">Open Module</button>
                            <?php if( $active_addons_id[$nu->id] == 1 ){ ?>
                                <button type="button" class="nsm-button btn-cancel-request-removal" data-tab="active-addons" data-id="<?= $nu->id; ?>" data-name="<?= $nu->name; ?>">Cancel Request Removal</button>
                            <?php }else{ ?>
                                <button type="button" class="nsm-button btn-remove-add-on" data-tab="active-addons" data-id="<?= $nu->id; ?>" data-name="<?= $nu->name; ?>">Remove Addon</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>