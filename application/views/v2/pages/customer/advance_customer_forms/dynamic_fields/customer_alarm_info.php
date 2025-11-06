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
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'dealer_number') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'dealer_number'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="dealer_number" id="dealer_number" value="<?= $alarm_info && $alarm_info->dealer_number != '' ? $alarm_info->dealer_number : $default_dealer_number; ?>" />
            </div>
        </div>
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
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'contract_status') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'contract_status'); ?></div>
            <div class="col-md-6">
                <?php 
                    $contract_status = 'Contract Monitoring';
                    if( $alarm_info && $alarm_info->contract_status != '' ){
                        $contract_status = $alarm_info->contract_status;
                    }
                ?>
                <select id="contract_status" name="contract_status" data-customer-source="dropdown" class="form-select input_select" >
                    <option value="" selected=""></option>
                    <option <?= $contract_status == 'Contract Monitoring' ? 'selected="selected"' : ''; ?> value="Contract Monitoring">Contract Monitoring</option>
                    <option <?= $contract_status == 'Sold' ? 'selected="selected"' : ''; ?> value="Sold">Sold</option>
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
                    <?php 
                        $account_type = '';
                        if( $defaultAccountType ){
                            $account_type = $defaultAccountType->account_type;
                        }

                        if( $alarm_info && $alarm_info->acct_type != ''){
                            $account_type = $alarm_info->acct_type;
                        }   
                    ?>
                    <?php foreach( $accountTypes as $at ){ ?>
                        <option <?= $account_type == $at->account_type ? 'selected="selected"' : ''; ?> value="<?= $at->account_type; ?>"><?= $at->account_type; ?></option>
                    <?php } ?>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-account-type"><span class="fa fa-plus"></span> Add Account Type</a>            
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'site_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'site_type'); ?></div>
            <div class="col-md-6">
                <select id='site_type' name="site_type" data-type="site_type" class="form-control" >
                    <?php 
                        $site_type = '';
                        if( $defaultAlarmSiteType ){
                            $site_type = $defaultAlarmSiteType->name;
                        }

                        if( $alarm_info && $alarm_info->site_type != '' ){
                            $site_type = $alarm_info->site_type;
                        }
                    ?>
                    <option value="" <?= $site_type == '' ? 'selected="selected"' : ''; ?>>Select</option>
                    <?php foreach($siteTypes as $st){ ?>
                        <option <?= $site_type == $st->name ? 'selected="selected"' : ''; ?> value="<?= $st->name; ?>"><?= $st->name; ?></option>
                    <?php } ?>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-site-type"><span class="fa fa-plus"></span> Add Site Type</a>    
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

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'passcode') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'passcode'); ?></div>
            <div class="col-md-6">
                <?php 
                    $passcode = '';
                    if( $woSubmittedLatest ){
                        $passcode = $woSubmittedLatest->password;
                    }

                    if( $alarm_info && $alarm_info->passcode != '' ){
                        $passcode = $alarm_info->passcode;
                    }
                ?>
                <input type="text" class="form-control" name="passcode" id="passcode" value="<?= $passcode; ?>"/>
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'install_code') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'install_code'); ?></div>
            <div class="col-md-6">
                <?php 
                    $installer_code = '';

                    if( $defaultInstallerCode ){
                        $installer_code = $defaultInstallerCode->installer_code;
                    }

                    if( $alarm_info && $alarm_info->install_code != '' ){
                        $installer_code = $alarm_info->install_code;
                    }
                    
                ?>
                <select class="form-control" data-type="install_code" id="install_code" name="install_code">
                    <?php if( $installer_code != '' ){ ?>
                    <option value="<?= $installer_code; ?>"><?= $installer_code; ?></option>
                    <?php } ?>
                </select>    
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-installer-code"><span class="fa fa-plus"></span> Add Installer Code</a>            
            </div>
        </div>

        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'master_code') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'master_code'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="master_code" id="master_code" value="<?= $alarm_info ? ($alarm_info->master_code != '' ? $alarm_info->master_code : '') : '';  ?>"/>
            </div>
        </div>

        <hr />
                    
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
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'install_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'install_type'); ?></div>
            <div class="col-md-6">
                <?php 
                    $install_type = 'New Panel';
                    if( $alarm_info && $alarm_info->install_type != '' ){
                        $install_type = $alarm_info->install_type;
                    }
                ?>
                <select id='install_type' name="install_type"  class="form-control" >
                    <option value="" selected="selected">Select</option>
                    <option <?= $install_type == 'New Panel' ? 'selected="selected"' : ''; ?> value="New Panel">New Panel</option>
                    <option <?= $install_type == 'Existing Panel' ? 'selected="selected"' : ''; ?> value="Existing Panel">Existing Panel</option>
                    <option <?= $install_type == 'Takeover' ? 'selected="selected"' : ''; ?> value="Takeover">Takeover</option>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container mt-2" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'panel_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'panel_type'); ?></div>
            <div class="col-md-6">
                <select name="panel_type" id="panel_type" class="input_select" data-value="<?= isset($alarm_info) ? $alarm_info->panel_type : "" ?>">
                    <?php foreach($panelTypes as $pt){ ?>
                        <option <?= $alarm_info && $alarm_info->panel_type == $pt->name ? 'selected="selected"' : ''; ?> value="<?= $pt->name ?>"><?= $pt->name; ?></option>
                    <?php } ?>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-panel-type"><span class="fa fa-plus"></span> Add Panel Type</a>            
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
        <div class="row form_line field-custom-name-container mt-2" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'secondary_system_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'secondary_system_type'); ?></div>
            <div class="col-md-6">
                <select id='secondary_system_type' name="secondary_system_type"  class="form-control" >
                    <option value="" selected="selected">Select</option>
                    <option <?= $alarm_info && $alarm_info->secondary_system_type == 'WiFi' ? 'selected="selected"' : ''; ?> value="WiFi">WiFi</option>
                    <option <?= $alarm_info && $alarm_info->secondary_system_type == 'GSM' ? 'selected="selected"' : ''; ?> value="GSM">GSM</option>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'radio_serial_number') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'radio_serial_number'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="radio_serial_number" id="radio_serial_number" value="<?= $alarm_info ? ($alarm_info->radio_serial_number != '' ? $alarm_info->radio_serial_number : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'panel_location') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'panel_location'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="panel_location" id="panel_location" value="<?= $alarm_info ? ($alarm_info->panel_location != '' ? $alarm_info->panel_location : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'transformer_location') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'transformer_location'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="transformer_location" id="transformer_location" value="<?= $alarm_info ? ($alarm_info->transformer_location != '' ? $alarm_info->transformer_location : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'connection_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'connection_type'); ?></div>
            <div class="col-md-6">
                <?php 
                    $connection_type = 'GSM';
                    if( $alarm_info && $alarm_info->connection_type != '' ){
                        $connection_type = $alarm_info->connection_type;
                    }
                ?>
                <select id="connection_type" name="connection_type" data-customer-source="dropdown" class="form-select input_select" >
                    <option value="" selected=""></option>
                    <option <?= $connection_type == 'GSM' ? 'selected="selected"' : ''; ?> value="GSM">GSM</option>
                    <option <?= $connection_type == 'Digi' ? 'selected="selected"' : ''; ?> value="Digi">Digi</option>
                    <option <?= $connection_type == 'Wireless' ? 'selected="selected"' : ''; ?> value="Wireless">Wireless</option>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'csid_number') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'csid_number'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="csid_number" id="csid_number" value="<?= $alarm_info ? ($alarm_info->csid_number != '' ? $alarm_info->csid_number : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'report_format') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'report_format'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="report_format" id="report_format" value="<?= $alarm_info ? ($alarm_info->report_format != '' ? $alarm_info->report_format : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'receiver_phone_number') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'receiver_phone_number'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="receiver_phone_number" id="receiver_phone_number" value="<?= $alarm_info ? ($alarm_info->receiver_phone_number != '' ? $alarm_info->receiver_phone_number : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'panel_phone_number') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'panel_phone_number'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="panel_phone_number" id="panel_phone_number" value="<?= $alarm_info ? ($alarm_info->panel_phone_number != '' ? $alarm_info->panel_phone_number : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'dsl_voip') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'dsl_voip'); ?></div>
            <div class="col-md-6">
                <select id="dsl_voip" name="dsl_voip" data-customer-source="dropdown" class="form-select input_select" >
                    <option value="" selected=""></option>
                    <option <?= $alarm_info && $alarm_info->dsl_voip == 'DSL' ? 'selected="selected"' : ''; ?> value="DSL">DSL</option>
                    <option <?= $alarm_info && $alarm_info->dsl_voip == 'VOIP' ? 'selected="selected"' : ''; ?> value="VOIP">VOIP</option>
                    <option <?= $alarm_info && $alarm_info->dsl_voip == 'DSL VOIP' ? 'selected="selected"' : ''; ?> value="DSL VOIP">DSL VOIP</option>
                    <option <?= $alarm_info && $alarm_info->dsl_voip == 'None' ? 'selected="selected"' : ''; ?> value="None">None</option>
                </select>
            </div>
        </div>
        
        <hr />
        
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'service_provider') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'service_provider'); ?></div>
            <div class="col-md-6">
                <?php 
                    $service_provider = "Alarm.com";
                    if( $alarm_info && $alarm_info->service_provider != '' ){
                        $service_provider = $alarm_info->service_provider;
                    } 
                ?>
                <select id="service_provider" name="service_provider" data-customer-source="dropdown" class="form-select input_select" >
                    <option value="" selected=""></option>
                    <option <?= $service_provider == 'Alarm.com' ? 'selected="selected"' : ''; ?> value="Alarm.com">Alarm.com</option>
                    <option <?= $service_provider == 'AlarmNet' ? 'selected="selected"' : ''; ?> value="AlarmNet">AlarmNet</option>
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
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-communication-type"><span class="fa fa-plus"></span> Add Communication Type</a>   
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'addon_feature_cost') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'addon_feature_cost'); ?></div>
            <div class="col-md-6">
                <input type="number" step="any" placeholder="0.00" class="form-control" name="addon_feature_cost" id="addon_feature_cost" value="<?= $alarm_info ? ($alarm_info->addon_feature_cost != '' ? $alarm_info->addon_feature_cost : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'account_cost') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'account_cost'); ?></div>
            <div class="col-md-6">
                <input type="number" step="any" placeholder="0.00" class="form-control" name="account_cost" id="account_cost" value="<?= $alarm_info ? ($alarm_info->account_cost !=0 ? $alarm_info->account_cost : '') : '';  ?>"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'pass_thru_cost') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'pass_thru_cost'); ?></div>
            <div class="col-md-6">
                <?php 
                    $passThruCost = ($alarm_info->pass_thru_cost != "" && $alarm_info->pass_thru_cost != 0) ? $alarm_info->pass_thru_cost : $alarmcom_info['package_total_price'];
                ?>
                <input type="number" step="any" placeholder="0.00" class="form-control" name="pass_thru_cost" id="pass_thru_cost" value="<?= $passThruCost;  ?>"/>
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
                <?php 
                    $dealer = "Alarm.com";
                    if( $alarm_info && $alarm_info->dealer != '' ){
                        $dealer = $alarm_info->dealer;
                    } 
                ?>
                <select id="dealer" name="dealer" data-customer-source="dropdown" class="input_select" >
                    <option value=""></option>
                    <option <?= $dealer == 'Alarm.com' ? 'selected="selected"' : ''; ?> value="Alarm.com">Alarm.com</option>
                    <option <?= $dealer == 'AlarmNet' ? 'selected="selected"' : ''; ?> value="AlarmNet">AlarmNet</option>
                </select>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'alarm_customer_id') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'alarm_customer_id'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="alarm_customer_id" id="alarm_customer_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_customer_id; } ?>"/>
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
        <!-- <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'alarm-information', 'alarm_cs_account') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'alarm-information', 'alarm_cs_account'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="alarm_cs_account" id="alarm_cs_account" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_cs_account; } ?>"/>
            </div>
        </div> -->
    </div>
</div>




