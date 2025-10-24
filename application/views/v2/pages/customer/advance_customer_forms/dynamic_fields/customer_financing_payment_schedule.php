<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-credit-card"></i>Financing Payment Schedule</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'financing-schedule', 'finance_amount') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'financing-schedule', 'finance_amount'); ?></div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" min="0" class="form-control input_select" id="financing-payment-amount" name="finance_amount"  value="<?= isset($billing_info) ? $billing_info->finance_amount : ''; ?>">
                </div>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'financing-schedule', 'recurring_start_date') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'financing-schedule', 'recurring_start_date'); ?></div>
            <div class="col-md-6">
                <?php 
                    $recurring_start_date = '';
                    if( $billing_info && strtotime($billing_info->recurring_start_date) > 0 ){
                        $recurring_start_date = date("m/d/Y", strtotime($billing_info->recurring_start_date));
                    }
                ?>
                <input data-type="subscription_start_date" type="text" class="form-control datepicker" name="recurring_start_date" id="recurring_start_date" value="<?= $recurring_start_date; ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'financing-schedule', 'recurring_end_date') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'financing-schedule', 'recurring_end_date'); ?></div>
            <div class="col-md-6">
                <?php 
                    $recurring_end_date = '';
                    if( $billing_info && strtotime($billing_info->recurring_end_date) > 0 ){
                        $recurring_end_date = date("m/d/Y", strtotime($billing_info->recurring_end_date));
                    }
                ?>
                <input data-type="subscription_end_date" type="text" class="form-control datepicker" name="recurring_end_date" id="recurring_end_date" value="<?= $recurring_end_date; ?>" />
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'financing-schedule', 'transaction_category') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'financing-schedule', 'transaction_category'); ?></div>
            <div class="col-md-6">
                <select id="transaction_category" name="transaction_category" data-customer-source="dropdown" class="input_select">
                    <option  value="">Select Category</option>
                    <?php foreach($financingCategories as $cat){ ?>
                        <option <?= isset($billing_info) && $billing_info->transaction_category ==  $cat->value ? 'selected' : '';?> value="<?= $cat->value; ?>"><?= $cat->name; ?></option>    
                    <?php } ?>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-financing-category"><span class="fa fa-plus"></span> Add Category</a>
            </div>
        </div>
        <div class="row form_line" <?= isCustomerFieldEnabled($companyFormSetting, 'financing-schedule', 'frequency') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'financing-schedule', 'frequency'); ?></div>
            <div class="col-md-6">
                <select data-type="subscription_frequency" id="frequency" name="frequency" data-customer-source="dropdown" class="input_select" >
                    <option  value="">Select</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == ""){echo "selected";} } ?> value="">- Select -</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "0"){echo "selected";} } ?> value="0">One Time Only</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "1"){echo "selected";} } ?> value="1">Monthly</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "3"){echo "selected";} } ?> value="3">Quarterly</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "6"){echo "selected";} } ?> value="6">Semi-Annual</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "12"){echo "selected";} } ?> value="12">Annually</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "36"){echo "selected";} } ?> value="12">3 Years Prepaid</option>
                </select>
            </div>
        </div>          
    </div>
</div>