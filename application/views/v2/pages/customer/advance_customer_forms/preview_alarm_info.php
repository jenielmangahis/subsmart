<div class="nsm-card">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Alarm Information</span>
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Monitoring Company</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->monitor_comp) ? $alarm_info->monitor_comp : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Monitoring ID</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Account Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->acct_type) ? $alarm_info->acct_type : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Abort/Password Code</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->passcode) ? $alarm_info->passcode : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Installer Code</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->install_code) ? $alarm_info->install_code : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Monitoring Confirm #</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->mcn) ? $alarm_info->mcn : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Signal Confirm #</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->scn) ? $alarm_info->scn : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Panel Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->panel_type) ? $alarm_info->panel_type : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">System Package Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->system_type) ? $alarm_info->system_type : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Warranty Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->warranty_type) ? $alarm_info->warranty_type : '---'; ?></label>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Dealer</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->dealer) ? $alarm_info->dealer : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Login</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->alarm_login) ? $alarm_info->alarm_login : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Customer ID</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->alarm_customer_id) ? $alarm_info->alarm_customer_id : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">CS Account</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($alarm_info->alarm_cs_account) ? $alarm_info->alarm_cs_account : '---'; ?></label>
            </div>
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
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Custom Field 1</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">---</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Custom Field 2</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">---</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Custom Field 3</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">---</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Custom Field 4</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">---</label>
            </div>
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
                <label class="content-subtitle">$<?= !empty($billing_info->transaction_amount) ?  number_format((float)$billing_info->transaction_amount, 2, '.', ',') : '0.00' ?></label>
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
                    <input type="text" class="form-control nsm-field" readonly id="sharableLink" value="<?= base_url('customer/preview/') . $this->uri->segment(3); ?>">
                    <button class="nsm-button mb-0" type="button" id="copyLink">
                        <i class='bx bx-copy mt-2'></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>