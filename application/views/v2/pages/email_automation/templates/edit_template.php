<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li onclick="location.href='<?php echo url('email_automation/add_email_automation') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-mail-send"></i>
            </div>
            <span class="nsm-fab-label">Add Email Automation</span>
        </li>
        <li onclick="location.href='<?php echo url('email_automation/templates') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-cog"></i>
            </div>
            <span class="nsm-fab-label">Manage Default Templates</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/email_automation_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Set a name and enter email subject and body.
                        </div>
                    </div>
                </div>
                
                <?php echo form_open_multipart('email_automation/update_template', ['class' => 'form-validate', 'id' => 'create_email_template', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span></span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-6 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2"><b>Template Name</b><small>(For your reference.)</small></label>
                                        <input type="text" class="nsm-field form-control" value="<?= $emailTemplate->name; ?>" name="name" id="" required placeholder="" autocomplete="off" autofocus/>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-6 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2"><b>Subject</b></label>
                                        <input type="text" class="nsm-field form-control" name="email_subject" id="email_subject" required placeholder="" autocomplete="off" value="<?= $emailTemplate->email_subject; ?>" autofocus/>
                                    </div>
                                    <div class="col-12 col-md-12 mt-5">
                                        <label class="content-subtitle fw-bold d-block mb-2"><b>Email Body</b></label>
                                        <textarea name="email_body" cols="40" rows="30"  class="nsm-field form-control" id="email_body" autocomplete="off"><?= $emailTemplate->email_body; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('email_automation/templates') ?>'">Go Back to Template List</button>
                        <button type="submit" name="btn_save" class="nsm-button primary">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    // instance, using default configuration.
    CKEDITOR.replace('email_body', {
        height: '400'
        //removePlugins: 'toolbar',
        //allowedContent: 'p h1 h2 strong em; a[!href]; img[!src,width,height] alignment;'
    });

    CKEDITOR.config.allowedContent = true;
});
</script>
<?php include viewPath('v2/includes/footer'); ?>