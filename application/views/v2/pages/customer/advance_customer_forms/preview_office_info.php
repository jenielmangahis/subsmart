<div class="nsm-card">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Office Use Information</span>
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Entered By</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $logged_in_user->FName . ' ' . $logged_in_user->LName; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Time Entered</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Sales Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->sales_date) ?  $office_info->sales_date : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Credit Score</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->credit_score) ?  $office_info->credit_score : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Pay History</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->pay_history) ?  pay_history($office_info->pay_history) : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Sales Rep</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php
                    $sales_rep = !empty($office_info->fk_sales_rep_office) ?  get_employee_name($office_info->fk_sales_rep_office) : '---';
                    ?>
                    <?= $sales_rep->FName . ' ' . $sales_rep->LName; ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Technician</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->technician) ?  $office_info->technician : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Install Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->install_date) ?  $office_info->install_date : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Tech Arrival Time</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->tech_arrive_time) ?  $office_info->tech_arrive_time : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Tech Departure Time</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->tech_depart_time) ?  $office_info->tech_depart_time : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Lead Source</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->lead_source) ?  $office_info->lead_source : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Verification</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->verification) ?  $office_info->verification : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Cancel Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->cancel_date) ?  $office_info->cancel_date : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Cancel Reason</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->cancel_reason) ?  $office_info->cancel_reason : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Collection Date</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($office_info) && !empty($office_info->collect_date) ?  $office_info->collect_date : '---' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Collection Amount</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= isset($office_info) && !empty($office_info->collect_amount) ?  number_format((float)$office_info->collect_amount, 2, '.', ',') : '0.00' ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Language</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->language) ?  $office_info->language : '---' ?></label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Funding Information</span>
                </div>
            </div>
        </div>
        <div class="row g-1">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Pre-Install Survey</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle" style="color: <?= $office_info->pre_install_survey == 'Pass' ? 'darkgreen' : 'darkred'; ?>; ">
                    <?= !empty($office_info->pre_install_survey) ? $office_info->pre_install_survey : '---'; ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Post-Install Survey</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle" style="color: <?= $office_info->pre_install_survey == 'Pass' ? 'darkgreen' : 'darkred'; ?>;">
                    <?= !empty($office_info->post_install_survey) ? $office_info->post_install_survey : '---'; ?>
                </label>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Monitoring Waived</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->monitoring_waived) ? $office_info->monitoring_waived . ' months' : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rebate Offered</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $office_info->rebate_offer == 1 ? 'Enabled' : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rebate Check # 1</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->rebate_check1) ? $office_info->rebate_check1 : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Amount</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rebate_check1_amt) ? number_format((float)$office_info->rebate_check1_amt, 2, '.', ',') : '0.00'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rebate Check # 2</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->rebate_check2) ? $office_info->rebate_check2 : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Amount</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rebate_check2_amt) ? number_format((float)$office_info->rebate_check2_amt, 2, '.', ',') : '0.00'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Activation Fee</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?= !empty($office_info->activation_fee) ? $office_info->activation_fee : '---'; ?>
                    <?= !empty($office_info->way_of_pay) ? $office_info->way_of_pay : '---'; ?>
                </label>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Commision Scheme</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $office_info->commision_scheme == 1 ? 'On' : 'Off';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rep Commission</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rep_comm) ?number_format((float)$office_info->rep_comm,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rep Upfront Pay</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rep_upfront_pay) ? number_format((float)$office_info->rep_upfront_pay,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rep Tiered Upront Bonus</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rep_tiered_bonus) ? number_format((float)$office_info->rep_tiered_bonus,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rep Tiered Holdfund</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rep_holdfund_bonus) ? number_format((float)$office_info->rep_holdfund_bonus,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rep Deduction Total</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rep_deduction) ? number_format((float)$office_info->rep_deduction,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Tech Commission</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->tech_comm) ? number_format((float)$office_info->tech_comm,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Tech Upfront Pay</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->tech_upfront_pay) ? number_format((float)$office_info->tech_upfront_pay,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Tech Deduction Total</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->tech_deduction) ? number_format((float)$office_info->price_per_point,2,'.',','): '---';?></label>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rep Hold Fund Charge Back</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rep_charge_back) ? number_format((float)$office_info->rep_charge_back,2,'.',','): '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Rep Payroll Charge Back</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->rep_payroll_charge_back) ? number_format((float)$office_info->rep_payroll_charge_back,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Points Scheme Override</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $office_info->pso == 1 ? 'On' : 'Off';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Points Included</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->points_include) ? $office_info->points_include : '---';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Price Per Point</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->price_per_point) ? number_format((float)$office_info->price_per_point,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Purchase Price</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->purchase_price) ? number_format((float)$office_info->purchase_price,2,'.',',') : '0.00';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Purchase Multiple</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($office_info->purchase_multiple) ? $office_info->purchase_multiple : '---';?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Purchase Discount</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">$<?= !empty($office_info->purchase_discount) ? number_format((float)$office_info->purchase_discount,2,'.',',') : '0.00';?></label>
            </div>
        </div>
    </div>
</div>