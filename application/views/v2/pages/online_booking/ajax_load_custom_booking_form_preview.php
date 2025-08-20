<div class="row">
    <?php if( $booking_forms ){ ?>
        <?php foreach($booking_forms as $form){ ?>
            <?php if( $form->is_visible == 1 ){ ?>
            <div class="col-12 col-md-6 mt-2">
                <div class="form-group form-group-contact_number">
                    <label><?= $form->label; ?></label> 
                        <?php if( $form->is_required == 1 ){ ?>
                        <span class="form-required">*</span>
                        <?php } ?> 
                    <?php if( $form->field_name == 'message' ){ ?>
                        <textarea class="form-control" id="<?= $form->field_name; ?>" name="<?= $form->field_name; ?>"></textarea>
                    <?php }elseif( $form->field_name == 'preferred_time_to_contact' ){ ?>
                        <select class="form-select" id="<?= $form->field_name; ?>" name="<?= $form->field_name; ?>">
                            <option value="0" selected="selected">Any time</option> 
                            <option value="1">7am to 10am</option> 
                            <option value="2">10am to Noon</option> 
                            <option value="3">Noon to 4pm</option> 
                            <option value="4">4pm to 7pm</option>
                        </select>
                    <?php }else{ ?>
                        <input type="text" id="<?= $form->field_name; ?>" name="<?= $form->field_name; ?>" class="form-control">
                    <?php } ?>
                    
                </div>
            </div>
            <?php } ?>
        <?php } ?>
    <?php }else{ ?>
        <?php foreach($default_form_fields as $key => $value){ ?>
            <div class="col-12 col-md-6 mt-2">
                <div class="form-group form-group-contact_number">
                    <label><?= $key; ?></label> 
                        <?php if( $value == 'full_name' || $value == 'contact_number' || $value == 'email' ){ ?>
                            <span class="form-required">*</span>
                        <?php } ?> 
                    <?php if( $value == 'message' ){ ?>
                        <textarea class="form-control" id="<?= $value; ?>" name="<?= $value; ?>"></textarea>
                    <?php }elseif( $value == 'preferred_time_to_contact' ){ ?>
                        <select class="form-select" id="<?= $value; ?>" name="<?= $value; ?>">
                            <option value="0" selected="selected">Any time</option> 
                            <option value="1">7am to 10am</option> 
                            <option value="2">10am to Noon</option> 
                            <option value="3">Noon to 4pm</option> 
                            <option value="4">4pm to 7pm</option>
                        </select>
                    <?php }else{ ?>
                        <input type="text" id="<?= $value; ?>" name="<?= $value; ?>" class="form-control">
                    <?php } ?>
                    
                </div>
            </div>
        <?php } ?>        
    <?php } ?>
    <div class="col-12 col-md-12 text-end mt-4">
        <div class="widget-contact-submit"><button type="button" class="nsm-button primary">Book Now</button></div>
    </div>
</div>
