<div class="card">
    <?php if($company_id == 58): ?>
        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Solar Information</h6>
        </div>
        <div class="card-body">
            <div class="row form_line">
                <div class="col-md-6">
                    Project ID
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="project_id" id="project_id"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Lender Type
                </div>
                <div class="col-md-6">
                    <?php $lenderTypes = json_decode($solar_info_settings[0]->field_value); ?>
                    <select name="lender_type" id="lender_type" class="input_select solar_infos">
                        <option  value=""></option>
                        <?php foreach ($lenderTypes  as $lender): ?>
                            <option  value="<?= $lender->name ?>"><?= $lender->name ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <a href="<?= base_url('customer/settings_solar_lender_type') ?>"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp;
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Proposed System Size
                </div>
                <div class="col-md-6">
                <?php $proposed_system_sizes = json_decode($solar_info_settings[1]->field_value); ?>
                    <select name="proposed_system_size" id="proposed_system_size" class="input_select solar_infos">
                        <option  value=""></option>
                        <?php foreach ($proposed_system_sizes  as $size): ?>
                            <option  value="<?= $size->name ?>"><?= $size->name ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <a href="<?= base_url('customer/settings_solar_system_size') ?>" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Size</a>&nbsp;&nbsp;
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Proposed Modules
                </div>
                <div class="col-md-6">
                    <?php $proposed_modules = json_decode($solar_info_settings[2]->field_value); ?>
                    <select name="proposed_modules" id="proposed_modules" class="input_select solar_infos">
                        <option  value=""></option>
                        <?php foreach ($proposed_modules  as $module): ?>
                            <option  value="<?= $module->name ?>"><?= $module->name ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <a href="<?= base_url('customer/settings_solar_modules') ?>" style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Modules</a>&nbsp;&nbsp;
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Proposed Inverter
                </div>
                <div class="col-md-6">
                    <?php $proposed_inverters = json_decode($solar_info_settings[3]->field_value); ?>
                    <select name="proposed_inverter" id="proposed_inverter" class="input_select solar_infos">
                        <option  value=""></option>
                        <?php foreach ($proposed_inverters  as $inverter): ?>
                            <option  value="<?= $inverter->name ?>"><?= $inverter->name ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <a href="<?= base_url('customer/settings_solar_inverter') ?>"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Inverter</a>&nbsp;&nbsp;
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Proposed Offset
                </div>
                <div class="col-md-6">
                    <select name="proposed_offset" id="proposed_offset" class="input_select">
                        <option  value=""></option>
                        <option  value="1">Less than 30%</option>
                        <?php for($x=31;$x<=120;$x++): ?>
                            <option  value="<?= $x ?>"><?= $x ?>%</option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Proposed Solar $
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="proposed_solar" value="">
                    </div>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Proposed Utility $
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="proposed_utility" value="">
                    </div>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Proposed Payment
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="proposed_payment" value="">
                    </div>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Annual Income
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="annual_income" value="">
                    </div>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Tree Estimate
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="tree_estimate" value="">
                    </div>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Roof Estimate
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input type="number" class="form-control input_select" name="roof_estimate" value="">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row form_line">
                <div class="col-md-6">
                    Utility Account #
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="utility_account" id="utility_account"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Utility Login
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="utility_login" id="utility_login"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Utility Password
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="utility_pass" id="utility_pass"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Meter Number
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="meter_number" id="meter_number"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Insurance Name
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="insurance_name" id="insurance_name"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Insurance Number
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="insurance_number" id="insurance_number"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Policy Number
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="policy_number" id="policy_number"/>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Alarm Information</h6>
        </div>
        <div class="card-body">
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
                    <input type="text" class="form-control" name="monitor_id" id="monitor_id" value="<?php if(isset($alarm_info)){ echo $alarm_info->monitor_id != 0 ? $alarm_info->monitor_id : '' ; } ?>"/>
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
                    </select>
                    <a href="<?= base_url() ?>customer/settings" target="_blank"  style="color:#58bc4f;font-size: 10px;"><span class="fa fa-plus"></span> Manage Type</a>&nbsp;&nbsp;
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
                    <input type="text" class="form-control" name="install_code" id="install_code" value="<?php if(isset($alarm_info)){ echo $alarm_info->install_code!=0 ?  $alarm_info->install_code : ''; } ?>"/>
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

    
    

        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Access Information</h6>
        </div>
        <div class="card-body">
            <div class="row form_line">
                <div class="col-md-6">
                    Portal Status (on/off)
                </div>
                <div class="col-md-6">
                    <input type="radio" name="portal_status" value="1" id="portal_status1" <?php if(isset($access_info)){ echo $access_info->portal_status == 1 ? 'checked': ''; } ?> >
                    <span>On</span>
                    &nbsp;&nbsp;
                    <input type="radio" name="portal_status" value="0"  id="portal_status" <?php if(isset($access_info)){ echo $access_info->portal_status == 0 ? 'checked': ''; } ?>>
                    <span>Off</span>
                </div>
            </div>
            <?php if(isset($access_info)): ?>
            <div class="row form_line">
                <div class="col-md-6">
                    Reset Password 
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-md" name="reset_password" id="reset_password" >Send Email Reset </button>
                </div>
            </div>
            <?php endif; ?>
            <div class="row form_line">
                <div class="col-md-6">
                    Login
                </div>
                <div class="col-md-6">
                    <input data-type="access_info_user" type="text" class="form-control" name="access_login" id="login" value="<?php if(isset($access_info)){ echo $access_info->access_login; } ?>"/>
                </div>
            </div>
            <div class="row form_line">
                <div class="col-md-6">
                    Password
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input data-type="access_info_pass" type="text" class="form-control" name="access_password" id="password" data-value="<?php if(isset($access_info)){ echo $access_info->access_password; } ?>"/>
                        <div class="input-group-append">
                            <button data-action="access_info_generate_pass" class="btn btn-primary" type="button" style="padding: 0;width: 35px;">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Custom Field</h6>
        </div>
        <div class="card-body" id="custom_field" data-section="custom_field">
            <a href="javascript:void;" id="add_field" style="color:#58bc4f;font-size: 12px;"><span class="fa fa-plus"></span> Add Field</a>
            <?php if(isset($profile_info)):  ?>
                <?php $custom_fields = json_decode($profile_info->custom_fields); ?>
                <?php if(!empty($custom_fields)): ?>
                <?php foreach ($custom_fields as $field): ?>
                    <div class="row form_line">
                        <div class="col-md-5">
                            Name
                            <input type="text" class="form-control" name="custom_name[]" value="<?= $field->name; ?>" />
                        </div>
                        <div class="col-md-5">
                            Value
                            <input type="text" class="form-control" name="custom_value[]" value="<?= $field->value; ?>" />
                        </div>
                        <div class="col-md-2">
                            <button style="margin-top: 30px;" type="button" class="btn btn-primary btn-sm items_remove_btn remove_item_row"><span class="fa fa-trash-o"></span></button>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="row form_line">
                    <div class="col-md-5">
                        Name
                        <input type="text" class="form-control" name="custom_name[]" value="" />
                    </div>
                    <div class="col-md-5">
                        Value
                        <input type="text" class="form-control" name="custom_value[]" value="" />
                    </div>
                    <div class="col-md-2">
                        <button style="margin-top: 30px;" type="button" class="btn btn-primary btn-sm items_remove_btn remove_item_row"><span class="fa fa-trash-o"></span></button>
                    </div>
                </div>
            <?php endif; ?>

        </div>

        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

            <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Notes</h6>
        </div>
        <div class="card-body">
            <div class="row form-line">
                <textarea type="text" class="form-controls" name="notes" id="notes" cols="100%" rows="5"></textarea>
            </div>
        </div>
    <?php if(isset($customer_notes)) :?>
        <div class="card-header">
            <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

            <h6 ><span class="fa fa-user"></span>&nbsp; Existing&nbsp;Notes</h6>
        </div>
        <div class="card-body">
                <div class="row">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tbody>
                        <?php foreach ($customer_notes as $note) : ?>
                            <tr>
                                <td style="width: 880px; text-align: left; vertical-align: top; font-size: 11px; color: #336699">
                                    <?= $note->datetime; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left; border: 1px; border-style: solid; border-color: #999999; background-color: #FFFF71; font-size: 11px">
                                    <?= $note->note; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        </div>
    <?php endif; ?>
    <?php 
        $contact1 = null;
        $contact2 = null;
        $contact3 = null;

        if (isset($contacts)) {
            if (isset($contacts[0])) {
                $contact1 = $contacts[0];
            }

            if (isset($contacts[1])) {
                $contact2 = $contacts[1];
            }

            if (isset($contacts[2])) {
                $contact3 = $contacts[2];
            }
        }
    ?>
    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Emergency Contacts</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-4 ">
                Contact Name 1
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name1" id="contact_name1" value="<?= isset($contact1) ? $contact1->name : "" ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4 ">
                Relationship
            </div>
            <div class="col-md-8">
                <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship1">
                    <option><?= isset($contact1) ? $contact1->relation : "" ?></option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Phone Number
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone1" id="contact_phone1" value="<?= isset($contact1) ? $contact1->phone : "" ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Contact Name 2
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name2" id="contact_name2" value="<?= isset($contact2) ? $contact2->name : "" ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4 ">
                Relationship
            </div>
            <div class="col-md-8">
                <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship2">
                    <option><?= isset($contact2) ? $contact2->relation : "" ?></option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Phone Number
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone2" id="contact_phone2" value="<?= isset($contact2) ? $contact2->phone : "" ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Contact Name 3
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="contact_name3" id="contact_name3" value="<?= isset($contact3) ? $contact3->name : "" ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4 ">
                Relationship
            </div>
            <div class="col-md-8">
                <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship2">
                    <option><?= isset($contact3) ? $contact3->relation : "" ?></option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-4">
                Phone Number
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone3" id="contact_phone3" value="<?= isset($contact3) ? $contact3->phone : "" ?>"/>
            </div>
        </div>
    </div>
        <div class="row" style="margin: 0 0 0 5px;">
            <a href="<?php echo base_url('customer') ?>">
                <button type="button" class="btn btn-primary"><span class="fa fa-remove"></span> Cancel </button> &nbsp;
            </a>
            <?php if(isset($profile_info)): ?>
                <input type="hidden" name="customer_id" value="<?= $profile_info->prof_id; ?>"/>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary" name="" id="" ><span class="fa fa-paper-plane-o"></span> <?=isset($profile_info) ? 'Save Changes' : 'Save'; ?> </button>
        </div>
    </div>
