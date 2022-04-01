<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/estimate_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('estimate/save_setting/', ['class' => 'form-validate require-validation', 'id' => 'settings_form', 'autocomplete' => 'off']); ?>
                <div class="row g-3 align-items-start">
                    <div class="col-12 col-md-3">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Invoice Number</span>
                                </div>
                                <label class="nsm-subtitle">Set the prefix and the next auto-generated number.</label>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12 col-md-3">
                                        <input type="text" placeholder="Prefix" name="prefix" class="nsm-field form-control" value="<?php echo ($setting) ? $setting->estimate_num_prefix : 0 ?>" autocomplete="off"/>
                                        <span class="validation-error-field hide" data-formerrors-for-name="next_custom_number_prefix" data-formerrors-message="true"></span>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" placeholder="Next Number" name="base" class="nsm-field form-control" value="<?php echo ($setting) ? $setting->estimate_num_next : ''  ?>" autocomplete="off"/>
                                        <span class="validation-error-field hide" data-formerrors-for-name="next_custom_number_base" data-formerrors-message="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="nsm-tab">
                                    <nav>
                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-residential-tab" data-bs-toggle="tab" data-bs-target="#nav-residential" type="button" role="tab" aria-controls="nav-residential" aria-selected="true">Residential</button>
                                            <button class="nav-link" id="nav-commercial-tab" data-bs-toggle="tab" data-bs-target="#nav-commercial" type="button" role="tab" aria-controls="nav-commercial" aria-selected="false">Commercial</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-residential" role="tabpanel" aria-labelledby="nav-residential-tab">
                                            <div class="row g-2">
                                                <div class="col-12 col-md-6">
                                                    <div class="nsm-card-title">
                                                        <span>Residential Invoice Default Message</span>
                                                    </div>
                                                    <label class="nsm-subtitle">Custom message that will be placed at the bottom section of the invoice.</label>
                                                    <textarea name="residential_message" id="residential_message" cols="40" rows="2" class="form-control nsm-field mt-3" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->residential_message : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="message" data-formerrors-message="true"></span>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="nsm-card-title">
                                                        <span>Residential Invoice Default Terms & Conditions</span>
                                                    </div>
                                                    <label class="nsm-subtitle">Your T&C that will appear at the bottom section of the invoice.</label>
                                                    <textarea name="residential_terms" id="residential_terms" cols="40" rows="2" class="form-control nsm-field mt-3" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->residential_terms_and_conditions : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-commercial" role="tabpanel" aria-labelledby="nav-commercial-tab">
                                            <?php
                                            $is_checked = '';
                                            if ($setting) {
                                                if ($setting->is_residential_message_default == 1) {
                                                    $is_checked = 'checked="checked"';
                                                }
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" id="same_as_residential" name="is_residential_default" <?= $is_checked; ?>>
                                                        <label class="form-check-label" for="same_as_residential">
                                                            Set default value as Residential
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12 col-md-6">
                                                    <div class="nsm-card-title">
                                                        <span>Commercial Invoice Default Message</span>
                                                    </div>
                                                    <label class="nsm-subtitle">Custom message that will be placed at the bottom section of the invoice.</label>
                                                    <textarea name="message_commercial" id="message_commercial" cols="40" rows="2" class="form-control nsm-field mt-3" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->commercial_message : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="message" data-formerrors-message="true"></span>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="nsm-card-title">
                                                        <span>Commercial Invoice Default Terms & Conditions</span>
                                                    </div>
                                                    <label class="nsm-subtitle">Your T&C that will appear at the bottom section of the invoice.</label>
                                                    <textarea name="terms_commercial" id="terms_commercial" cols="40" rows="2" class="form-control nsm-field mt-3" autocomplete="off" placeholder="" required=""><?php echo ($setting) ? $setting->commercial_terms_and_conditions : '' ?></textarea>
                                                    <span class="validation-error-field hide" data-formerrors-for-name="terms" data-formerrors-message="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" data-action="save" class="nsm-button primary">
                            Save Changes
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?> 
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>