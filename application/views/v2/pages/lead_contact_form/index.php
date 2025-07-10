<?php include viewPath('v2/includes/header'); ?>
<style>
#tbl-custom-fields thead tr{
    font-size:16;
} 
#tbl-custom-fields tbody tr{
    font-size:14px;
} 
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/lead_contact_form_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Place a contact form on your website and collect leads from your customers directly into nSmartrac. Customize the way the form looks and get notifications on new contact inquiries or check the leads online. Copy/Paste the iframe or javascript code on a page on your website.
                        </div>
                    </div>
                </div>                
                <form id="frm-save-lead-contact-form">
                <div class="row g-3 align-items-start">                    
                    <div class="col-md-6 col-sm-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>
                                        <i class="bx bx-fw bxs-edit"></i> Customize Form Fields 
                                        <i class="bx bx-fw bx-help-circle" id="popover-custom-form-fields"></i>
                                    </span>                                    
                                    <a href="javascript:void(0)" class="nsm-button btn-small default pull-right" id="btn-add-new-custom-field">Add New Field</a>     
                                </div>
                            </div>                          

                            <div class="nsm-card-content">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover" id="tbl-custom-fields">
                                        <thead>
                                            <tr>
                                                <th style="width:2%;"></th>
                                                <th>Field</th>
                                                <th style="width:10%;text-align:center;">Visible</th>
                                                <th style="width:10%;text-align:center;">Required</th>
                                                <th style="width:10%;text-align:center;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($customizeLeadFormsDefault as $formDefault){ ?>
                                                <tr>
                                                    <td><i class='bx bx-grid-alt'></i></td>
                                                    <td><?= $formDefault->field; ?></td>
                                                    <td style="text-align:center;">
                                                        <input class="form-check-input" type="checkbox" value="" checked="" disabled="">
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <input class="form-check-input" type="checkbox" value="" checked="" disabled="">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            <?php } ?>
                                            <?php if( $customizeLeadForms ){ ?>
                                                <?php $row = 0; ?>
                                                <?php foreach($customizeLeadForms as $lf){ ?>
                                                    <tr>
                                                        <td><i class='bx bx-grid-alt'></i></td>
                                                        <td>
                                                            <input type="hidden" class="form-input" name="customFields[<?= $row; ?>][name]" value="<?= $lf->field; ?>">
                                                            <?= $lf->field; ?>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <input class="form-check-input" name="customFields[<?= $row; ?>][is_visible]" type="checkbox" <?= $lf->visible == 1 ? 'checked=""' : ''; ?>>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <input class="form-check-input" type="checkbox" name="customFields[<?= $row; ?>][is_required]" <?= $lf->required == 1 ? 'checked=""' : ''; ?>>
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <button class="nsm-button btn-small default row-btn-delete"><i class='bx bx-trash'></i></button>
                                                        </td>
                                                    </tr>
                                                <?php $row++; } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="nsm-card primary mt-4">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span>
                                        <i class='bx bx-palette'></i> Appearance 
                                        <i class="bx bx-fw bx-help-circle" id="popover-custom-form-appearance"></i>
                                    </span>         
                                </div>
                            </div>                          

                            <div class="nsm-card-content">
                                <div class="row mb-3">                                    
                                    <div class="col-sm-12 col-md-6">
                                        <label for="form-text-size" class="col-sm-2 col-form-label">Text Size</label>
                                        <select name="custom_field_text_size" class="nsm-field form-select" id="form-text-size">
                                            <?php for($x = 10; $x <= 20; $x++){ ?>
                                                <option value="<?= $x; ?>" <?= $leadForm && $leadForm->text_size == $x ? 'selected="selected"' : ''; ?>><?= $x; ?> px</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="form-text-color" class="col-sm-2 col-form-label">Text Color</label>
                                        <input type="color" name="custom_field_text_color" value="<?= $leadForm ? $leadForm->text_color : '#000000'; ?>" style="width:30%;height:32px;" class="form-control" id="form-text-color">
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="form-text-font" class="col-sm-2 col-form-label">Text Font</label>
                                        <select name="custom_field_text_font" class="nsm-field form-select" id="form-text-font">
                                            <?php foreach($optionTextFont as $font){ ?>
                                                <option value="<?= $font; ?>" <?= $leadForm && $leadForm->text_font == $x ? 'selected="selected"' : ''; ?>><?= $font; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="form-button-color" class="col-sm-12 col-form-label">Button Color</label>
                                                <input type="color" value="<?= $leadForm ? $leadForm->button_color : '#6a4a86'; ?>" name="custom_field_button_color" style="height:32px;" class="form-control" id="form-button-color">
                                            </div>
                                            <div class="col-6">
                                                <label for="form-button-text-color" class="col-sm-12 col-form-label">Button Text Color</label>
                                                <input type="color" value="<?= $leadForm ? $leadForm->button_text_color : '#ffffff'; ?>" name="custom_field_button_text_color" style="width:63%;height:32px;" class="form-control" id="form-button-text-color">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 col-sm-12">
                                    <div class="nsm-card-header mt-4">
                                        <div class="nsm-card-title">
                                            <span>
                                                <i class='bx bx-bell' ></i> Notifications 
                                                <i class="bx bx-fw bx-help-circle" id="popover-custom-form-notification"></i>
                                            </span>         
                                        </div>
                                    </div>  
                                    <div class="nsm-card-content">
                                        <div class="row mb-3">   
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="notification_email" id="custom-form-notification-email" value="1" <?= $leadForm && $leadForm->email_notification == 1 ? 'checked=""' : ''; ?>>
                                                    <label class="form-check-label" for="custom-form-notification-email">Email</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="notification_app_notification" id="custom-form-notification-app" value="1" <?= $leadForm && $leadForm->app_notification == 1 ? 'checked=""' : ''; ?>>
                                                    <label class="form-check-label" for="custom-form-notification-app">App Notification</label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="row mb-3" id="notification-email-recipient" style="<?= $leadForm && $leadForm->email_notification == 1 ? '' : 'display:none;'; ?>">   
                                            <div class="col-sm-12 col-md-9">
                                                <label for="notification-email-recipient" class="col-sm-12 col-form-label">Email address where notification will be sent</label>
                                                <input type="email" value="<?= $leadForm ? $leadForm->email_notification_recipient : $default_email; ?>" name="notification_email_recipient" style="height:32px;" class="form-control" id="notification-email-recipient">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="nsm-card-header mt-4">
                                        <div class="nsm-card-title">
                                            <span>
                                                <i class='bx bxl-google'></i> Google Analytics 
                                                <i class="bx bx-fw bx-help-circle" id="popover-custom-form-google-analytics"></i>
                                            </span>         
                                        </div>
                                    </div>  
                                    <div class="nsm-card-content">
                                        <div class="row mb-3">   
                                            <div class="col-sm-12 col-md-12">
                                                <input type="text" name="google_analytics_tracking_id" value="<?= $leadForm ? $leadForm->google_analytics_tracking_id : ''; ?>" class="form-control" id="form-google-analytics-tracking-id" placeholder="Google Analytics Tracking Id" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="nsm-card-header mt-4">
                                        <div class="nsm-card-title">
                                            <span>
                                                <i class='bx bx-code-alt'></i> Snippet Code 
                                                <i class="bx bx-fw bx-help-circle" id="popover-custom-form-snippet-code"></i>
                                            </span>         
                                        </div>
                                    </div>  
                                    <div class="nsm-card-content">
                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-12">
                                                <div style="margin-bottom: 5px;">
                                                    <a href="javascript:void(0)" class="nsm-button btn-small default pull-right mb-2">
                                                        <i class='bx bx-clipboard'></i> Copy to clipboard
                                                    </a>
                                                </div>
                                                <div style="margin-bottom: 10px;">
                                                    <textarea rows="3" readonly="readonly" name="iframe_code" id="code-iframe" class="input-focus form-control"><?= $leadForm ? $leadForm->iframe_code : ''; ?><iframe src="<?= $iframe_url; ?>" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;" height="100%" width="100%"></iframe></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" data-action="save" id="btn-update-lead-contact-form" class="nsm-button primary">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span><i class="bx bx-fw bxs-edit"></i> Form Preview</span><br />               
                                </div>
                            </div>                          

                            <div class="nsm-card-content">
                                <div id="lead-contact-form-preview"></div>                                
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/lead_contact_form/modals'); ?>
<?php include viewPath('v2/pages/lead_contact_form/js/index'); ?>
<?php include viewPath('v2/includes/footer'); ?>