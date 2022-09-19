<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('settings/create_sms_template') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/email_templates_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Create your email branding that will help recognize your business.
                        </div>
                    </div>
                </div>

                <?php echo form_open_multipart('settings/update_email_branding_setting', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <div class="row g-3">
                    <div class="col-12 col-md-7">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Email From Name</span>
                                        </div>
                                        <label class="nsm-subtitle">Emails sent to customers will display this name.</label>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <input type="text" placeholder="ADI" name="email_from_name" class="nsm-field form-control" value="<?= $setting_data['email_from_name']; ?>" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Email Footer Text</span>
                                        </div>
                                        <label class="nsm-subtitle">Add a custom message to email footer. E.g. Call us on (212) 123-4567</label>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <input type="text" placeholder="Alarm Direct, Inc." name="email_template_footer_text" class="nsm-field form-control" value="<?= $setting_data['email_template_footer_text']; ?>" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Logo</span>
                                </div>
                                <label class="nsm-subtitle">Customize your invoice, estimate or email to better match your branding. Your logo will appear on the top left corner.</label>
                            </div>
                            <div class="nsm-card-content">
                                <?php
                                $logo_file     = $setting_data['logo'];
                                if (file_exists('uploads/email_branding/' . $setting_data['uid'] . '/' . $logo_file) == FALSE || $logo_file == null) {
                                    $branding_logo = '';
                                } else {
                                    $branding_logo = base_url('uploads/email_branding/' . $setting_data['uid'] . '/' . $logo_file);
                                }
                                ?>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="nsm-img-upload" style="background-image: url('<?php echo $branding_logo ?>')">
                                            <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                            <input type="file" name="file-logo" class="nsm-upload" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" name="btn_email_branding_save" data-action="save" class="nsm-button primary">
                            Save Changes
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>