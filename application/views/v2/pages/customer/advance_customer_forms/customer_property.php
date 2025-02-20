<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-building"></i>Customer Property</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Inventory 
            </div>
            <div class="col-md-6">
                <input data-type="prop_inventory" type="text" class="form-control" name="prop_inventory" id="prop_inventory" value="<?php if(isset($customerProperty)){ echo $customerProperty->inventory; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Plan Type 
            </div>
            <div class="col-md-6">
                <input data-type="prop_plan_type" type="text" class="form-control" name="prop_plan_type" id="prop_plan_type" value="<?php if(isset($customerProperty)){ echo $customerProperty->plan_type; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Deductible 
            </div>
            <div class="col-md-6">
                <input data-type="prop_deductible" type="text" class="form-control" name="prop_deductible" id="prop_deductible" value="<?php if(isset($customerProperty)){ echo $customerProperty->deductible; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Revenue
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" id="prop_revenue" name="prop_revenue"  value="<?= isset($customerProperty) ? $customerProperty->revenue : ''; ?>">
                </div>
            </div>
        </div> 
        <div class="row form_line">
            <div class="col-md-6">
                Territory 
            </div>
            <div class="col-md-6">
                <input data-type="prop_territory" type="text" class="form-control" name="prop_territory" id="prop_territory" value="<?php if(isset($customerProperty)){ echo $customerProperty->territory; } ?>" />
            </div>
        </div>     
        <div class="row form_line">
            <div class="col-md-6">
                Property Tax
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" id="prop_property_tax" name="prop_property_tax"  value="<?= isset($customerProperty) ? $customerProperty->property_tax : ''; ?>">
                </div>
            </div>
        </div> 
        <div class="row form_line">
            <div class="col-md-6">
                Add On 
            </div>
            <div class="col-md-6">
                <input data-type="prop_add_on" type="text" class="form-control" name="prop_add_on" id="prop_add_on" value="<?php if(isset($customerProperty)){ echo $customerProperty->add_on; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                AC Type 
            </div>
            <div class="col-md-6">
                <input data-type="prop_ac_type" type="text" class="form-control" name="prop_ac_type" id="prop_ac_type" value="<?php if(isset($customerProperty)){ echo $customerProperty->ac_type; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Payment History
            </div>
            <div class="col-md-6">
                <input data-type="prop_payment_history" type="text" class="form-control" name="prop_payment_history" id="prop_payment_history" value="<?php if(isset($customerProperty)){ echo $customerProperty->payment_history; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Late Fee Collected
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" id="prop_late_fee_collected" name="prop_late_fee_collected" value="<?= isset($customerProperty) ? $customerProperty->late_fee_collected : ''; ?>">
                </div>
            </div>
        </div> 
        <div class="row form_line">
            <div class="col-md-6">
                Alarm System
            </div>
            <div class="col-md-6">
                <input data-type="prop_alarm_system" type="text" class="form-control" name="prop_alarm_system" id="prop_alarm_system" value="<?php if(isset($customerProperty)){ echo $customerProperty->alarm_system; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Key Code
            </div>
            <div class="col-md-6">
                <input data-type="prop_key_code" type="text" class="form-control" name="prop_key_code" id="prop_key_code" value="<?php if(isset($customerProperty)){ echo $customerProperty->key_code; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Source
            </div>
            <div class="col-md-6">
                <input data-type="prop_source" type="text" class="form-control" name="prop_source" id="prop_source" value="<?php if(isset($customerProperty)){ echo $customerProperty->source; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Ownership
            </div>
            <div class="col-md-6">
                <input data-type="prop_ownership" type="text" class="form-control" name="prop_ownership" id="prop_ownership" value="<?php if(isset($customerProperty)){ echo $customerProperty->ownership; } ?>" />
            </div>
        </div>
        
    </div>
</div>