<div class="nsm-card primary">
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
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'project_id') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'project_id'); ?></div>
            <div class="col-md-6">
                <input type="text" value="<?= $acs_info_solar ? $acs_info_solar->project_id : ''; ?>" class="form-control" name="project_id" id="project_id"/>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'lender_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'lender_type'); ?></div>
            <div class="col-md-6">
                <select name="lender_type" id="lender_type" class="input_select solar_infos">
                    <option  value=""></option>
                    <?php foreach ($solarLenderTypes  as $lender): ?>
                        <?php if( $acs_info_solar ){ ?>
                            <option <?= $acs_info_solar->lender_type == $lender->name ? 'selected="selected"' : ''; ?> value="<?= $lender->name ?>"><?= $lender->name ?></option>
                        <?php }else{ ?>
                            <option value="<?= $lender->name ?>"><?= $lender->name ?></option>
                        <?php } ?>
                        
                    <?php endforeach; ?>
                </select>         
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-lender-type"><span class="fa fa-plus"></span> Add Lender Type</a>       
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'proposed_system_size') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'proposed_system_size'); ?></div>
            <div class="col-md-6">
                <select name="proposed_system_size" id="proposed_system_size" class="input_select solar_infos">
                    <option  value=""></option>
                    <?php foreach ($solarSystemSizes  as $size): ?>
                        <?php if( $acs_info_solar ){ ?>
                            <option <?= $acs_info_solar->proposed_system_size == $size->name ? 'selected="selected"' : ''; ?> value="<?= $size->name ?>"><?= $size->name ?></option>
                        <?php }else{ ?>
                            <option  value="<?= $size->name ?>"><?= $size->name ?></option>
                        <?php } ?>                            
                    <?php endforeach; ?>
                </select><br>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-system-size"><span class="fa fa-plus"></span> Add System Size</a>    
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'proposed_modules') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'proposed_modules'); ?></div>
            <div class="col-md-6">
                <select name="proposed_modules" id="proposed_modules" class="input_select solar_infos">
                    <option  value=""></option>
                    <?php foreach ($solarProposedModules  as $module): ?>
                        <?php if( $acs_info_solar ){ ?>
                            <option <?= $acs_info_solar->proposed_modules == $module->name ? 'selected="selected"' : ''; ?>  value="<?= $module->name ?>"><?= $module->name ?></option>
                        <?php }else{ ?>
                            <option  value="<?= $module->name ?>"><?= $module->name ?></option>
                        <?php } ?>                            
                    <?php endforeach; ?>
                </select><br>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-proposed-module"><span class="fa fa-plus"></span> Add Proposed Module</a>    
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'proposed_inverter') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'proposed_inverter'); ?></div>
            <div class="col-md-6">
                <select name="proposed_inverter" id="proposed_inverter" class="input_select solar_infos">
                    <option  value=""></option>
                    <?php foreach ($solarProposedInverters  as $inverter): ?>
                        <?php if( $acs_info_solar ){ ?>
                            <option <?= $acs_info_solar->proposed_inverter == $inverter->name ? 'selected="selected"' : ''; ?> value="<?= $inverter->name ?>"><?= $inverter->name ?></option>
                        <?php }else{ ?>
                            <option  value="<?= $inverter->name ?>"><?= $inverter->name ?></option>
                        <?php } ?>                            
                    <?php endforeach; ?>
                </select><br>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-proposed-inverter"><span class="fa fa-plus"></span> Add Proposed Inverter</a> 
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'proposed_offset') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'proposed_offset'); ?></div>
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
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'proposed_solar') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'proposed_solar'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" class="form-control input_select" name="proposed_solar" value="<?= $acs_info_solar ? $acs_info_solar->proposed_solar : ''; ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'proposed_utility') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'proposed_utility'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" class="form-control input_select" name="proposed_utility" value="<?= $acs_info_solar ? $acs_info_solar->proposed_utility : ''; ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'proposed_payment') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'proposed_payment'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" class="form-control input_select" name="proposed_payment" value="<?= $acs_info_solar ? $acs_info_solar->proposed_payment : ''; ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'annual_income') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'annual_income'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" class="form-control input_select" name="annual_income" value="<?= $acs_info_solar ? $acs_info_solar->annual_income : ''; ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'tree_estimate') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'tree_estimate'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" class="form-control input_select" name="tree_estimate" value="<?= $acs_info_solar ? $acs_info_solar->tree_estimate : ''; ?>">
                </div>
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'roof_estimate') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'roof_estimate'); ?></div>
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
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'utility_account') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'utility_account'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="utility_account" id="utility_account" value="<?= $acs_info_solar ? $acs_info_solar->utility_account : ''; ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'utility_login') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'utility_login'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="utility_login" id="utility_login" value="<?= $acs_info_solar ? $acs_info_solar->utility_login : ''; ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'utility_pass') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'utility_pass'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="utility_pass" id="utility_pass" value="<?= $acs_info_solar ? $acs_info_solar->utility_pass : ''; ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'meter_number') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'meter_number'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="meter_number" id="meter_number" value="<?= $acs_info_solar ? $acs_info_solar->meter_number : ''; ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'insurance_name') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'insurance_name'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="insurance_name" id="insurance_name" value="<?= $acs_info_solar ? $acs_info_solar->insurance_name : ''; ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'insurance_number') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'insurance_number'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="insurance_number" id="insurance_number" value="<?= $acs_info_solar ? $acs_info_solar->insurance_number : ''; ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'policy_number') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'policy_number'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="policy_number" id="policy_number" value="<?= $acs_info_solar ? $acs_info_solar->policy_number : ''; ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'solar_system_size') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'solar_system_size'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="solar_system_size" id="solar_system_size" value="<?= $acs_info_solar ? $acs_info_solar->solar_system_size : ''; ?>" />
            </div>
        </div>
        <div class="row form_line field-custom-name-container" <?= isCustomerFieldEnabled($companyFormSetting, 'solar-information', 'kw_dc') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'solar-information', 'kw_dc'); ?></div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="kw_dc" id="kw_dc" value="<?= $acs_info_solar ? $acs_info_solar->kw_dc : ''; ?>" />
            </div>
        </div>
    </div>
</div>