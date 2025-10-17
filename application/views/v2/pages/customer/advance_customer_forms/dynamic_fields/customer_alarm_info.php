<style>
.badge-primary{
    background-color: #007bff;
}
.badge{
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    margin-top: 9px;
}
.customer-notes-list{
    max-height: 200px;
    overflow: auto;
}
</style>
<div class="nsm-card primary">
<div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Alarm Information</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>    
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'monitor_comp') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'monitor_comp'); ?></div>
            <div class="col-md-6">
                <select id="monitor_comp" name="monitor_comp" data-customer-source="dropdown" class="input_select" >
                    <option value=""></option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'ADT' ?  'selected' : '';?> value="ABT">ADT</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'CMS' ?  'selected' : '';?> value="CMS">CMS</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'COPS' ?  'selected' : '';?> value="COPS">COPS</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'FrontPoint' ?  'selected' : '';?> value="FrontPoint">FrontPoint</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'ProtectionOne' ?  'selected' : '';?> value="ProtectionOne">ProtectionOne</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Stanley' ?  'selected' : '';?> value="Stanley">Stanley</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Guardian' ?  'selected' : '';?> value="Guardian">Guardian</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Vector' ?  'selected' : '';?> value="Vector">Vector</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Central' ?  'selected' : '';?> value="Central">Central</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Brinks' ?  'selected' : '';?> value="Brinks">Brinks</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Equipment Funding' ?  'selected' : '';?> value="Equipment Funding">Equipment Funding</option>
                    <option <?= isset($alarm_info) && $alarm_info->monitor_comp == 'Other' ?  'selected' : '';?> value="Other">Other</option>
                </select>

            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'monitor_id') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'monitor_id'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="monitor_id" id="monitor_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_id != '0' ? $alarm_info->monitor_id : '' ; } ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'acct_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'acct_type'); ?></div>
            <div class="col-md-6">
                <select name="acct_type" id="acct_type" class="input_select">
                    <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == ''){echo "selected";} } ?> value=""></option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'In-House'){echo "selected";} } ?> value="In-House">In-House</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Funded'){echo "selected";} } ?> value="Funded">Funded</option>
                    <!-- <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Commercial'){echo "selected";} } ?> value="Commercial">Commercial</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Rental'){echo "selected";} } ?> value="Rental">Rental</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Residential'){echo "selected";} } ?> value="Residential">Residential</option> -->
                </select>
                <!-- <a href="<?= base_url() ?>customer/settings" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp; -->
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'online') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'online'); ?></div>
            <div class="col-md-6">
                <select id="online" name="online" data-customer-source="dropdown" class="form-controls input_select">
                    <option <?= isset($alarm_info) && $alarm_info->online == 'Yes' ?  'selected' : '';?> value="Yes">Yes</option>
                    <option <?= isset($alarm_info) && $alarm_info->online == 'No' ?  'selected' : '';?> value="No">No</option>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'in_service') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6">
                <label><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'in_service'); ?></div>
            <div class="col-md-6">
                <select id="in_service" name="in_service" data-customer-source="dropdown" class="form-controls input_select">
                    <option <?= isset($alarm_info) && $alarm_info->in_service == 'Yes' ?  'selected' : '';?> value="Yes">Yes</option>
                    <option <?= isset($alarm_info) && $alarm_info->in_service == 'No' ?  'selected' : '';?> value="No">No</option>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'equipment') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6">
                <label><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'equipment'); ?></label>
            </div>
            <div class="col-md-6">
                <select id="equipment" name="equipment" data-customer-source="dropdown" class="form-controls input_select">
                    <option value=""></option>
                    <option <?= isset($alarm_info) && $alarm_info->equipment == 'Not Installed' ?  'selected' : '';?> value="Not Installed">Not Installed</option>
                    <option <?= isset($alarm_info) && $alarm_info->equipment == 'Installed' ?  'selected' : '';?> value="Installed">Installed</option>
                    <option <?= isset($alarm_info) && $alarm_info->equipment == 'System Pulled' ?  'selected' : '';?> value="System Pulled">System Pulled</option>
                </select>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'passcode') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'passcode'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="passcode" id="passcode" value="<?php if(isset($alarm_info)){ echo $alarm_info->passcode; } ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'install_code') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'install_code'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="install_code" id="install_code" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_code ?  $alarm_info->install_code : ''; } ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'mcn') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'mcn'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="mcn" id="mcn" value="<?php if(isset($alarm_info)){ echo $alarm_info->mcn !=0 ? $alarm_info->mcn : ''; } ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'scn') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'scn'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="scn" id="scn" value="<?php if(isset($alarm_info)){ echo $alarm_info->scn !=0 ? $alarm_info->scn : ''; } ?>"/>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'panel_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'panel_type'); ?></div>
            <div class="col-md-6">
                <select name="panel_type" id="panel_type" class="input_select" data-value="<?= isset($alarm_info) ? $alarm_info->panel_type : "" ?>">
                    <?php foreach($panel_type as $panels) : ?>
                        <option <?php if(isset($alarm_info)){if($alarm_info->panel_type == $panels->panel_type){echo "selected";}} ?>><?= $panels->panel_type ?></option>
                    <?php endforeach; ?>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == ''){echo "selected";} } ?> value=""></option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AERIONICS'){echo "selected";} } ?> value="AERIONICS">AERIONICS</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AlarmNet'){echo "selected";} } ?> value="AlarmNet">AlarmNet</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alarm.com'){echo "selected";} } ?> value="Alarm.com">Alarm.com</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alula'){echo "selected";} } ?> value="Alula">Alula</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Bosch'){echo "selected";} } ?> value="Bosch">Bosch</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DSC'){echo "selected";} } ?> value="DSC">DSC</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'ELK'){echo "selected";} } ?> value="ELK">ELK</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'FBI'){echo "selected";} } ?> value="FBI">FBI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GRI'){echo "selected";} } ?> value="GRI">GRI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GE'){echo "selected";} } ?> value="GE">GE</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell">Honeywell</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Touch'){echo "selected";} } ?> value="Honeywell Touch">Honeywell Touch</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell 3000'){echo "selected";} } ?> value="Honeywell 3000">Honeywell 3000</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista">Honeywell Vista</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Vista with Sem'){echo "selected";} } ?> value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell Lyric'){echo "selected";} } ?> value="Honeywell Lyric">Honeywell Lyric</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'IEI'){echo "selected";} } ?> value="IEI">IEI</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'MIER'){echo "selected";} } ?> value="MIER">MIER</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG">2 GIG</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG Go Panel 2'){echo "selected";} } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG Go Panel 3'){echo "selected";} } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 2'){echo "selected";} } ?> value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 2 Plus'){echo "selected";} } ?> value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys IQ Panel 3'){echo "selected";} } ?> value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Custom'){echo "selected";} } ?> value="Custom">Custom</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Other'){echo "selected";} } ?> value="Other">Other</option>
                </select>
            </div>
        </div>
        
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'warranty_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'warranty_type'); ?></div>
            <div class="col-md-6">
                <select id="warranty_type" name="warranty_type" data-customer-source="dropdown" class="input_select" >
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == ""){ echo 'selected'; } } ?> value="">Select</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Limited. 90 Days"){ echo 'selected'; } } ?> value="Limited. 90 Days">Limited 90 Days</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "1 Year"){ echo 'selected'; } } ?>  value="1 Year">1 Year</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$25 Trip"){ echo 'selected'; } } ?>  value="$25 Trip">$25 Trip</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "$50 Trip and $65 Deductible"){ echo 'selected'; } } ?>  value="$50 Trip and $65 Deductible">$50 Trip and $65 Deductible</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "Extended"){ echo 'selected'; } } ?>  value="Extended">Extended</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->warranty_type == "None"){ echo 'selected'; } } ?>  value="None">None</option>
                </select>
            </div>
        </div>

        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'comm_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'comm_type'); ?></div>
            <div class="col-md-6">
                <select id='communication_type' name="comm_type"  class="form-control" >
                    <option value=""></option>
                    <?php foreach($system_package_type as $cType): ?>
                        <option <?= isset($alarm_info) && $alarm_info->comm_type == $cType->name ?  'selected' : '';  ?> value="<?= $cType->name ?>"><?= $cType->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'account_cost') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'account_cost'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="account_cost" id="account_cost" value="<?= $alarm_info ? ($alarm_info->account_cost !=0 ? $alarm_info->account_cost : '') : '';  ?>"/>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'pass_thru_cost') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'pass_thru_cost'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="pass_thru_cost" id="pass_thru_cost" value="<?= $alarm_info ? ($alarm_info->pass_thru_cost !=0 ? $alarm_info->pass_thru_cost : '') : '';  ?>"/>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'otps') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'otps'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="otps" id="otps" value="<?= $alarm_info ? ($alarm_info->otps !=0 ? $alarm_info->otps : '') : '';  ?>"/>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'equipment_cost_alarm') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'equipment_cost_alarm'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="equipment_cost_alarm" id="equipment_cost_alarm" value="<?= $alarm_info ? ($alarm_info->equipment_cost !=0 ? $alarm_info->equipment_cost : '') : '';  ?>"/>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'monthly_monitoring') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'monthly_monitoring'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="monthly_monitoring" id="monthly_monitoring" value="<?= $alarm_info ? ($alarm_info->monthly_monitoring !=0 ? $alarm_info->monthly_monitoring : '') : '';  ?>"/>
            </div>
        </div>

        <hr>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'dealer') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'dealer'); ?></div>
            <div class="col-md-6">
                <select id="dealer" name="dealer" data-customer-source="dropdown" class="input_select" >
                    <option value=""></option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->dealer == "Alarm.com"){ echo 'selected'; } } ?> value="Alarm.com">Alarm.com</option>
                    <option <?php if(isset($alarm_info)){ if($alarm_info->dealer == "AlarmNet"){ echo 'selected'; } } ?> value="AlarmNet">AlarmNet</option>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'alarm_login') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'alarm_login'); ?></div>
            <div class="col-md-6">
                <?php 
                    $alarm_login = $default_login_value;
                    if( isset($alarm_info) && $alarm_info->alarm_login != '' ){
                        $alarm_login = $alarm_info->alarm_login;
                    }
                ?>
                <input type="text" class="form-control" name="alarm_login" id="alarm_login" value="<?= $alarm_login; ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'alarm_customer_id') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'alarm_customer_id'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="alarm_customer_id" id="alarm_customer_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_customer_id; } ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'alarm_cs_account') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'alarm_cs_account'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="alarm_cs_account" id="alarm_cs_account" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_cs_account; } ?>"/>
            </div>
        </div>
    </div>
</div>




