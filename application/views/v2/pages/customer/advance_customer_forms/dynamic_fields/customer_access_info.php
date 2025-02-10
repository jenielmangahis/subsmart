<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-cog'></i> Access Information</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'portal-access', 'portal_status') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'portal-access', 'portal_status'); ?></div>
            <div class="col-md-6">
                <input type="radio" name="portal_status" value="1" id="portal_status1" <?php if(isset($access_info)){ echo $access_info->portal_status == 1 ? 'checked': ''; } ?> >
                <span>On</span>
                &nbsp;&nbsp;
                <input type="radio" name="portal_status" value="0"  id="portal_status" <?php if(isset($access_info)){ echo $access_info->portal_status == 0 ? 'checked': ''; } ?>>
                <span>Off</span>
            </div>
        </div>        
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'portal-access', 'access_login') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'portal-access', 'access_login'); ?></div>
            <div class="col-md-6">
                <input data-type="access_info_user" type="text" class="form-control" name="access_login" id="login" value="<?php if(isset($access_info)){ echo $access_info->access_login; } ?>"/>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'portal-access', 'access_password') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'portal-access', 'access_password'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <input data-type="access_info_pass" type="text" class="form-control" name="access_password" id="password" data-value="<?php if(isset($access_info)){ echo $access_info->access_password; } ?>"/>
                    <div class="input-group-append">
                        <button data-action="access_info_generate_pass" class="nsm-button primary" type="button" style="font-size:17px;padding: 0;width: 35px;margin-top:5px;margin-left:5px;">
                            <i class='bx bx-refresh'></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($access_info)): ?>
        <div class="row form_line mt-2" <?= isCustomerFieldEnabled($companyFormSetting, 'portal-access', 'portal_status') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <button type="button" class="nsm-button primary btn-md" name="reset_password" data-id="<?= $access_info->fk_prof_id; ?>" id="btn-notify-customer-new-pw" >Send Email Reset </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>