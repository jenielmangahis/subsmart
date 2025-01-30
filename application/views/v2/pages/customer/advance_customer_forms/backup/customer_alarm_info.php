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
    <?php if($company_id == 58): ?>
        <div class="nsm-card-header">
            <div class="nsm-card-title">
                <span><i class="bx bx-fw bx-user"></i>Solar Information</span>
                <?php if( $profile_info->adt_sales_project_id > 0 ){ ?>
                    <span class="badge badge-primary" style="font-size:13px; float: right;">ADT Sales Portal Project Data</span>
                <?php } ?>
            </div>
        </div>
        <div class="nsm-card-content">
            <hr>            
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Project ID" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" value="<?= $acs_info_solar ? $acs_info_solar->project_id : ''; ?>" class="form-control" name="project_id" id="project_id"/>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Lender Type" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <?php $lenderTypes = json_decode($solar_info_settings[0]->field_value); ?>
                    <select name="lender_type" id="lender_type" class="input_select solar_infos">
                        <option  value=""></option>
                        <?php foreach ($lenderTypes  as $lender): ?>
                            <?php if( $acs_info_solar ){ ?>
                                <option <?= $acs_info_solar->lender_type == $lender->name ? 'selected="selected"' : ''; ?> value="<?= $lender->name ?>"><?= $lender->name ?></option>
                            <?php }else{ ?>
                                <option value="<?= $lender->name ?>"><?= $lender->name ?></option>
                            <?php } ?>
                            
                        <?php endforeach; ?>
                    </select>                    
                    <a href="<?= base_url('customer/settings_solar_lender_type') ?>"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp;
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Proposed System Size" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                <?php $proposed_system_sizes = json_decode($solar_info_settings[1]->field_value); ?>
                    <select name="proposed_system_size" id="proposed_system_size" class="input_select solar_infos">
                        <option  value=""></option>
                        <?php foreach ($proposed_system_sizes  as $size): ?>
                            <?php if( $acs_info_solar ){ ?>
                                <option <?= $acs_info_solar->proposed_system_size == $size->name ? 'selected="selected"' : ''; ?> value="<?= $size->name ?>"><?= $size->name ?></option>
                            <?php }else{ ?>
                                <option  value="<?= $size->name ?>"><?= $size->name ?></option>
                            <?php } ?>                            
                        <?php endforeach; ?>
                    </select><br>
                    <a href="<?= base_url('customer/settings_solar_system_size') ?>" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Size</a>&nbsp;&nbsp;
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Proposed Modules" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <?php $proposed_modules = json_decode($solar_info_settings[2]->field_value); ?>
                    <select name="proposed_modules" id="proposed_modules" class="input_select solar_infos">
                        <option  value=""></option>
                        <?php foreach ($proposed_modules  as $module): ?>
                            <?php if( $acs_info_solar ){ ?>
                                <option <?= $acs_info_solar->proposed_modules == $module->name ? 'selected="selected"' : ''; ?>  value="<?= $module->name ?>"><?= $module->name ?></option>
                            <?php }else{ ?>
                                <option  value="<?= $module->name ?>"><?= $module->name ?></option>
                            <?php } ?>                            
                        <?php endforeach; ?>
                    </select><br>
                    <a href="<?= base_url('customer/settings_solar_modules') ?>" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Modules</a>&nbsp;&nbsp;
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Proposed Inverter" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <?php $proposed_inverters = json_decode($solar_info_settings[3]->field_value); ?>
                    <select name="proposed_inverter" id="proposed_inverter" class="input_select solar_infos">
                        <option  value=""></option>
                        <?php foreach ($proposed_inverters  as $inverter): ?>
                            <?php if( $acs_info_solar ){ ?>
                                <option <?= $acs_info_solar->proposed_inverter == $inverter->name ? 'selected="selected"' : ''; ?> value="<?= $inverter->name ?>"><?= $inverter->name ?></option>
                            <?php }else{ ?>
                                <option  value="<?= $inverter->name ?>"><?= $inverter->name ?></option>
                            <?php } ?>                            
                        <?php endforeach; ?>
                    </select><br>
                    <a href="<?= base_url('customer/settings_solar_inverter') ?>"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Inverter</a>&nbsp;&nbsp;
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Proposed Offset" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <select name="proposed_offset" id="proposed_offset" class="input_select">
                        <option  value=""></option>
                        <option  value="1">Less than 30%</option>
                        <?php for($x=31;$x<=120;$x++): ?>
                            <?php if( $acs_info_solar ){ ?>
                                <option <?= $acs_info_solar->proposed_offset == $x ? 'selected="selected"' : ''; ?> value="<?= $x ?>"><?= $x ?>%</option>
                            <?php }else{ ?>
                                <option  value="<?= $x ?>"><?= $x ?>%</option>
                            <?php } ?>                            
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Proposed Solar $" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="proposed_solar" value="<?= $acs_info_solar ? $acs_info_solar->proposed_solar : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Proposed Utility $" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="proposed_utility" value="<?= $acs_info_solar ? $acs_info_solar->proposed_utility : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Proposed Payment" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="proposed_payment" value="<?= $acs_info_solar ? $acs_info_solar->proposed_payment : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Annual Income" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="annual_income" value="<?= $acs_info_solar ? $acs_info_solar->annual_income : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Tree Estimate" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="tree_estimate" value="<?= $acs_info_solar ? $acs_info_solar->tree_estimate : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Roof Estimate" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="roof_estimate" value="<?= $acs_info_solar ? $acs_info_solar->roof_estimate : ''; ?>">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Utility Account #" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="utility_account" id="utility_account" value="<?= $acs_info_solar ? $acs_info_solar->utility_account : ''; ?>" />
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Utility Login #" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="utility_login" id="utility_login" value="<?= $acs_info_solar ? $acs_info_solar->utility_login : ''; ?>" />
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Utility Password" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="utility_pass" id="utility_pass" value="<?= $acs_info_solar ? $acs_info_solar->utility_pass : ''; ?>" />
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Meter Number" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="meter_number" id="meter_number" value="<?= $acs_info_solar ? $acs_info_solar->meter_number : ''; ?>" />
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Insurance Name" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="insurance_name" id="insurance_name" value="<?= $acs_info_solar ? $acs_info_solar->insurance_name : ''; ?>" />
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Insurance Number" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="insurance_number" id="insurance_number" value="<?= $acs_info_solar ? $acs_info_solar->insurance_number : ''; ?>" />
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Policy Number" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="policy_number" id="policy_number" value="<?= $acs_info_solar ? $acs_info_solar->policy_number : ''; ?>" />
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Solar System Size" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="solar_system_size" id="solar_system_size" value="<?= $acs_info_solar ? $acs_info_solar->solar_system_size : ''; ?>" />
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="kW DC" form="solar_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="kw_dc" id="kw_dc" value="<?= $acs_info_solar ? $acs_info_solar->kw_dc : ''; ?>" />
                </div>
            </div>

        </div>
    <?php else: ?>
        <div class="nsm-card-header">
            <div class="nsm-card-title">
                <span><i class="bx bx-fw bx-user"></i>Alarm Information</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <hr>    
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Monitoring Company" form="alarm_info"></field-custom-name>
                </div>
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
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Monitoring ID" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="monitor_id" id="monitor_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_id != '0' ? $alarm_info->monitor_id : '' ; } ?>"/>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Account Type" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <select name="acct_type" id="acct_type" class="input_select">
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == ''){echo "selected";} } ?> value=""></option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'In-House'){echo "selected";} } ?> value="In-House">In-House</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Purchase'){echo "selected";} } ?> value="Purchase">Purchase</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Commercial'){echo "selected";} } ?> value="Commercial">Commercial</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Rental'){echo "selected";} } ?> value="Rental">Rental</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->acct_type == 'Residential'){echo "selected";} } ?> value="Residential">Residential</option>
                    </select>
                    <!-- <a href="<?= base_url() ?>customer/settings" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp; -->
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <label>
                        <field-custom-name default="Online" form="alarm_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-md-6">
                    <select id="online" name="online" data-customer-source="dropdown" class="form-controls input_select">
                        <option <?= isset($alarm_info) && $alarm_info->online == 'Yes' ?  'selected' : '';?> value="Yes">Yes</option>
                        <option <?= isset($alarm_info) && $alarm_info->online == 'No' ?  'selected' : '';?> value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <label>
                        <field-custom-name default="In Service" form="alarm_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-md-6">
                    <select id="in_service" name="in_service" data-customer-source="dropdown" class="form-controls input_select">
                        <option <?= isset($alarm_info) && $alarm_info->in_service == 'Yes' ?  'selected' : '';?> value="Yes">Yes</option>
                        <option <?= isset($alarm_info) && $alarm_info->in_service == 'No' ?  'selected' : '';?> value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <label>
                        <field-custom-name default="Equipment" form="alarm_info"></field-custom-name>
                    </label>
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

            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Abort Code" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="passcode" id="passcode" value="<?php if(isset($alarm_info)){ echo $alarm_info->passcode; } ?>"/>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Installer Code" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="install_code" id="install_code" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_code ?  $alarm_info->install_code : ''; } ?>"/>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Monitoring Confirm#" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="mcn" id="mcn" value="<?php if(isset($alarm_info)){ echo $alarm_info->mcn !=0 ? $alarm_info->mcn : ''; } ?>"/>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Signal Confirm#" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="scn" id="scn" value="<?php if(isset($alarm_info)){ echo $alarm_info->scn !=0 ? $alarm_info->scn : ''; } ?>"/>
                </div>
            </div>

            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Panel Type" form="alarm_info"></field-custom-name>
                </div>
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
            
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Warranty Type" form="alarm_info"></field-custom-name>
                </div>
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

            <div class="row form_line">
                <div class="col-md-6">
                    Communication Type
                </div>
                <div class="col-md-6">
                    <select id='communication_type' name="comm_type"  class="form-control" >
                        <option value=""></option>
                        <?php foreach($system_package_type as $cType): ?>
                            <option <?= isset($alarm_info) && $alarm_info->comm_type == $cType->name ?  'selected' : '';  ?> value="<?= $cType->name ?>"><?= $cType->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Program and Setup" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="otps" id="otps" value="<?= $alarm_info ? ($alarm_info->otps !=0 ? $alarm_info->otps : '') : '';  ?>"/>
                </div>
            </div>

            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Equipment Cost" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="equipment_cost_alarm" id="equipment_cost_alarm" value="<?= $alarm_info ? ($alarm_info->equipment_cost !=0 ? $alarm_info->equipment_cost : '') : '';  ?>"/>
                </div>
            </div>

            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Monthly Monitoring Rate" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="monthly_monitoring" id="monthly_monitoring" value="<?= $alarm_info ? ($alarm_info->monthly_monitoring !=0 ? $alarm_info->monthly_monitoring : '') : '';  ?>"/>
                </div>
            </div>

            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Account Cost" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="account_cost" id="account_cost" value="<?= $alarm_info ? ($alarm_info->account_cost !=0 ? $alarm_info->account_cost : '') : '';  ?>"/>
                </div>
            </div>

            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Pass Thru Cost" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="pass_thru_cost" id="pass_thru_cost" value="<?= $alarm_info ? ($alarm_info->pass_thru_cost !=0 ? $alarm_info->pass_thru_cost : '') : '';  ?>"/>
                </div>
            </div>

            <hr>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Dealer" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <select id="dealer" name="dealer" data-customer-source="dropdown" class="input_select" >
                        <option value=""></option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->dealer == "Alarm.com"){ echo 'selected'; } } ?> value="Alarm.com">Alarm.com</option>
                        <option <?php if(isset($alarm_info)){ if($alarm_info->dealer == "AlarmNet"){ echo 'selected'; } } ?> value="AlarmNet">AlarmNet</option>
                    </select>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Login" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="alarm_login" id="alarm_login" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_login; } ?>"/>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="Customer ID" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="alarm_customer_id" id="alarm_customer_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_customer_id; } ?>"/>
                </div>
            </div>
            <div class="row form_line field-custom-name-container">
                <div class="col-md-6">
                    <field-custom-name default="CS Account" form="alarm_info"></field-custom-name>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="alarm_cs_account" id="alarm_cs_account" value="<?php if(isset($alarm_info)){ echo $alarm_info->alarm_cs_account; } ?>"/>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>




