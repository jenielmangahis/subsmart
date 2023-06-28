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
</style>
<div class="nsm-card">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <?php if($companyId == 58): ?>
                        <span>Solar Information</span>
                        <?php if( $profile_info->adt_sales_project_id > 0 ){ ?>
                            <span class="badge badge-primary" style="font-size:13px; float: right;">ADT Sales Portal Project Data</span>
                        <?php } ?>
                    <?php else: ?>
                        <span>Alarm Information</span>
                    <?php endif; ?>  
                    
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <?php if($companyId == 58): ?>
                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Project ID" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->project_id ? $solar_info->project_id : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Lender Type" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->lender_type ? $solar_info->lender_type : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed System Size" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_system_size ? $solar_info->proposed_system_size : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Modules" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_modules ? $solar_info->proposed_modules : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Inverter" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_inverter ? $solar_info->proposed_inverter : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Offset" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_offset ? $solar_info->proposed_offset : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Solar $" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_solar ? $solar_info->proposed_solar : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Utility $" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_utility ? $solar_info->proposed_utility : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Proposed Payment $" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->proposed_payment ? $solar_info->proposed_payment : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Annual Income" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->annual_income ? $solar_info->annual_income : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Tree Estimate" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->tree_estimate ? $solar_info->tree_estimate : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Roof Estimate" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->roof_estimate ? $solar_info->roof_estimate : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Utility Account #" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->utility_account ? $solar_info->utility_account : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Utility Login" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->utility_login ? $solar_info->utility_login : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Utility Password" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->utility_pass ? $solar_info->utility_pass : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Meter Number" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->meter_number ? $solar_info->meter_number : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Insurance Name" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->insurance_name ? $solar_info->insurance_name : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Insurance Number" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->insurance_number ? $solar_info->insurance_number : '---'  ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Policy Number" form="solar_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= $solar_info->policy_number ? $solar_info->policy_number : '---'  ?></label>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>
            <?php else: ?>
                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Monitoring Company" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->monitor_comp) ? $alarm_info->monitor_comp : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Monitoring ID" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Account Type" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->acct_type) ? $alarm_info->acct_type : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Abort/Password Code" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->passcode) ? $alarm_info->passcode : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Installer Code" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->install_code) ? $alarm_info->install_code : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Monitoring Confirm #" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->mcn) ? $alarm_info->mcn : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Signal Confirm #" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->scn) ? $alarm_info->scn : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Panel Type" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->panel_type) ? $alarm_info->panel_type : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="System Package Type" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->system_type) ? $alarm_info->system_type : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Warranty Type" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->warranty_type) ? $alarm_info->warranty_type : '---'; ?></label>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">Communication Type</label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($alarm_info->comm_type) ? $alarm_info->comm_type : '---'; ?></label>
                </div>

                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">Program and Setup</label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($alarm_info->otps) ? $alarm_info->otps : '---'; ?></label>
                </div>

                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">Equipment Cost</label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($alarm_info->equipment_cost) ? $alarm_info->equipment_cost : '---'; ?></label>
                </div>

                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">Monhtly Monitoring Rate</label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($alarm_info->monthly_monitoring) ? $alarm_info->monthly_monitoring : '---'; ?></label>
                </div>



                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">Account Cost</label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($alarm_info->account_cost) ? $alarm_info->account_cost : '0.00'; ?></label>
                </div>

                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">Pass Thru Cost</label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($alarm_info->pass_thru_cost) ? $alarm_info->pass_thru_cost : '---'; ?></label>
                </div>
               
                <div class="col-12">
                    <hr>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Dealer" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->dealer) ? $alarm_info->dealer : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Login" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->alarm_login) ? $alarm_info->alarm_login : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="Customer ID" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->alarm_customer_id) ? $alarm_info->alarm_customer_id : '---'; ?></label>
                    </div>
                </div>

                <div class="row p-0 field-custom-name-container">
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold">
                            <field-custom-name readonly default="CS Account" form="alarm_info"></field-custom-name>
                        </label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?= !empty($alarm_info->alarm_cs_account) ? $alarm_info->alarm_cs_account : '---'; ?></label>
                    </div>
                </div>
            <?php endif; ?> 
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Access Information</span>
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Portal Status (on/off)</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php
                    if ($access_info->portal_status == 1) {
                        echo 'On';
                    } else {
                        echo 'Off';
                    }
                    ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Login</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($access_info->access_login) ?  $access_info->access_login : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Password</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($access_info->access_password) ?  $access_info->access_password : '---' ?></label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Custom Field</span>
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <?php
                $fields = [];
                if (!empty($profile_info->custom_fields)) {
                    $fields = json_decode($profile_info->custom_fields, true);
                    $fields = is_array($fields) ? $fields : [];
                }
            ?>
            <?php if (!empty($fields) && is_array($fields)): ?>
                <?php foreach ($fields as $key => $field): ?>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle fw-bold"><?=$field['name'];?></label>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="content-subtitle"><?=$field['value'];?></label>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 col-md-12">
                    <label class="content-subtitle">No custom field found.</label>
                </div>
            <?php endif; ?>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Subscription Pay Plan</span>
                </div>
            </div>
        </div>
        <div class="row g-1">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Finance Amount</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= $billing_info->finance_amount != "" ? number_format((float)$billing_info->finance_amount, 2, '.', ',') : '0.00' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Recurring Start Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->recurring_start_date) ?  $billing_info->recurring_start_date : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Recurring End Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->recurring_end_date) ?  $billing_info->recurring_end_date : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Transaction Amount</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($billing_info->transaction_amount) ?  number_format((float)$billing_info->transaction_amount, 2, '.', ',') : number_format((float)$billing_info->mmr, 2, '.', ',')?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Transaction Category</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->transaction_category) ?  $billing_info->transaction_category : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Frequency</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($billing_info->frequency) ?  $billing_info->frequency . ' months' : '---' ?></label>
            </div>
            <div class="col-12 mt-3">
                <button type="button" class="nsm-button primary w-100" onclick="location.href='<?= base_url('customer/subscription/' . $this->uri->segment(3)) ?>'">Capture Now</button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Equipment Cost</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->equipment_cost) ? number_format((float)$office_info->equipment_cost, 2, '.', ',') : '0.00'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Labor Cost</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->labor_cost) ? number_format((float)$office_info->labor_cost, 2, '.', ',') : '0.00'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Job Profit</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->job_profit) ? number_format((float)$office_info->job_profit, 2, '.', ',') : '0.00'; ?></label>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold">Shareable Url Link</label>
            </div>
            <div class="col-12 mt-3">
                <div class="input-group">
                    <input type="text" class="form-control nsm-field" readonly id="sharableLink" value="<?= base_url('share_link/public_preview_/') . $this->uri->segment(3); ?>">
                    <button class="nsm-button mb-0" type="button" id="copyLink">
                        <i class='bx bx-copy mt-2'></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

