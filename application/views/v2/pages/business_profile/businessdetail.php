<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/business/business_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3 mt-3 align-items-start">
                    <div class="col-12 col-md-12">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Profile Picture</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="nsm-img-upload circle m-auto">
                                                    <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                                    <input type="file" name="image" class="nsm-upload" accept="image/*">
                                                </div>
                                                <label class="content-subtitle text-muted w-100 text-center mt-4">Help your customers recognize your business by uploading a profile picture. Accepted files type: gif, jpg, png.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Basic Info</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Name <span class="nsm-text-error">*</span></label>
                                                <input type="text" placeholder="e.g. Acme Inc" name="business_name" class="nsm-field form-control" autocomplete="off" value="<?php echo ($profiledata) ? $profiledata->business_name : '' ?>" required />
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Street Address <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="address" id="address" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->address ?>" placeholder="e.g. 123 Old Oak Drive" required/>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Suite/Unit</label>
                                                <input type="text" name="unit_nbr" id="unit_nbr" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->unit_nbr ?>" placeholder="e.g. Ap #12" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">City <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="city" id="city" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->city ?>" placeholder="e.g. Phoenix" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Zip/Postal Code <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="zip" id="zip" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->zip ?>" placeholder="e.g. 86336" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">State/Province <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="state" id="state" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->state ?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Contact Details</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Business Phone <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="business_phone" id="business_phone" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->business_phone ?>" required/>
                                                <label class="content-subtitle text-muted">We'll send you text/sms notifications to this number.</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="content-subtitle fw-bold d-block mb-2">Suite/Unit</label>
                                                <input type="text" name="unit_nbr" id="unit_nbr" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->unit_nbr ?>" placeholder="e.g. Ap #12" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">City <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="city" id="city" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->city ?>" placeholder="e.g. Phoenix" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">Zip/Postal Code <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="zip" id="zip" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->zip ?>" placeholder="e.g. 86336" required/>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="content-subtitle fw-bold d-block mb-2">State/Province <span class="nsm-text-error">*</span></label>
                                                <input type="text" name="state" id="state" class="nsm-field form-control" autocomplete="off" value="<?php echo $profiledata->state ?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {});
</script>
<?php include viewPath('v2/includes/footer'); ?>