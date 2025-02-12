<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-building"></i>Customer Property</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_inventory') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_inventory'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_inventory" type="text" class="form-control" name="prop_inventory" id="prop_inventory" value="<?php if(isset($customerProperty)){ echo $customerProperty->inventory; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_plan_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_plan_type'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_plan_type" type="text" class="form-control" name="prop_plan_type" id="prop_plan_type" value="<?php if(isset($customerProperty)){ echo $customerProperty->plan_type; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_deductible') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_deductible'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_deductible" type="text" class="form-control" name="prop_deductible" id="prop_deductible" value="<?php if(isset($customerProperty)){ echo $customerProperty->deductible; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_revenue') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_revenue'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" id="prop_revenue" name="prop_revenue"  value="<?= isset($customerProperty) ? $customerProperty->revenue : ''; ?>">
                </div>
            </div>
        </div> 
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_territory') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_territory'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_territory" type="text" class="form-control" name="prop_territory" id="prop_territory" value="<?php if(isset($customerProperty)){ echo $customerProperty->territory; } ?>" />
            </div>
        </div>     
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_property_tax') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_property_tax'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" id="prop_property_tax" name="prop_property_tax"  value="<?= isset($customerProperty) ? $customerProperty->property_tax : ''; ?>">
                </div>
            </div>
        </div> 
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_add_on') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_add_on'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_add_on" type="text" class="form-control" name="prop_add_on" id="prop_add_on" value="<?php if(isset($customerProperty)){ echo $customerProperty->add_on; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_ac_type') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_ac_type'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_ac_type" type="text" class="form-control" name="prop_ac_type" id="prop_ac_type" value="<?php if(isset($customerProperty)){ echo $customerProperty->ac_type; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_payment_history') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_payment_history'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_payment_history" type="text" class="form-control" name="prop_payment_history" id="prop_payment_history" value="<?php if(isset($customerProperty)){ echo $customerProperty->payment_history; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_late_fee_collected') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_late_fee_collected'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" id="prop_late_fee_collected" name="prop_late_fee_collected" value="<?= isset($customerProperty) ? $customerProperty->late_fee_collected : ''; ?>">
                </div>
            </div>
        </div> 
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_alarm_system') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_alarm_system'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_alarm_system" type="text" class="form-control" name="prop_alarm_system" id="prop_alarm_system" value="<?php if(isset($customerProperty)){ echo $customerProperty->alarm_system; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_key_code') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_key_code'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_key_code" type="text" class="form-control" name="prop_key_code" id="prop_key_code" value="<?php if(isset($customerProperty)){ echo $customerProperty->key_code; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_source') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_source'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_source" type="text" class="form-control" name="prop_source" id="prop_source" value="<?php if(isset($customerProperty)){ echo $customerProperty->source; } ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'customer-property', 'prop_ownership') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'customer-property', 'prop_ownership'); ?></div>
            <div class="col-md-6">
                <input data-type="prop_ownership" type="text" class="form-control" name="prop_ownership" id="prop_ownership" value="<?php if(isset($customerProperty)){ echo $customerProperty->ownership; } ?>" />
            </div>
        </div>
        
    </div>
</div>