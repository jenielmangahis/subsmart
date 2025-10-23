<?php 
    $is_container_hidden = '';
    if( isset($alarm_info) && $alarm_info->acct_type == 'In-House' ){
        //$is_container_hidden = 'style="display:none;"';
    }   
?>
<div class="nsm-card primary" id="funding-information-cointainer" <?= $is_container_hidden; ?>>
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-user"></i>Funding Information</span>
                    <div class="form-check float-end">
                        <input class="form-check-input" type="checkbox" value="1" id="chk-preview-show-financing-equipment">
                        <label class="form-check-label" for="chk-preview-show-financing-equipment">
                            <b>Financing Equipment</b>
                        </label>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1" id="preview-financing-equipment" style="display:none;">
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
                <?php 
                    $recurring_start_date = '---';
                    if( $billing_info && strtotime($billing_info->recurring_start_date) > 0 ){
                        $recurring_start_date = date("m/d/Y", strtotime($billing_info->recurring_start_date));
                    }
                ?>
                <label class="content-subtitle"><?= $recurring_start_date; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Recurring End Date</label>
            </div>
            <div class="col-12 col-md-6">
                <?php 
                    $recurring_end_date = '---';
                    if( $billing_info && strtotime($billing_info->recurring_end_date) > 0 ){
                        $recurring_end_date = date("m/d/Y", strtotime($billing_info->recurring_end_date));
                    }
                ?>
                <label class="content-subtitle"><?= $recurring_end_date; ?></label>
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
            <div class="col-12"><hr></div>
        </div>
        <div class="row g-1">
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Pre-Install Survey" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle" style="color: <?= $office_info->pre_install_survey == 'Pass' ? 'darkgreen' : 'darkred'; ?>; ">
                        <?= !empty($office_info->pre_install_survey) ? $office_info->pre_install_survey : '---'; ?>
                    </label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Post-Install Survey" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle" style="color: <?= $office_info->pre_install_survey == 'Pass' ? 'darkgreen' : 'darkred'; ?>;">
                        <?= !empty($office_info->post_install_survey) ? $office_info->post_install_survey : '---'; ?>
                    </label>
                </div>
            </div>
            <div class="col-12"><hr></div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Monitoring Waived" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($office_info->monitoring_waived) ? $office_info->monitoring_waived . ' months' : '---'; ?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rebate Offered" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= $office_info->rebate_offer == 1 ? 'Enabled' : '---'; ?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rebate Check # 1" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($office_info->rebate_check1) ? $office_info->rebate_check1 : '---'; ?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rebate Check # 1 Amount" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->rebate_check1_amt) ? number_format((float)$office_info->rebate_check1_amt, 2, '.', ',') : '0.00'; ?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rebate Check # 2" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($office_info->rebate_check2) ? $office_info->rebate_check2 : '---'; ?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rebate Check # 2 Amount" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->rebate_check2_amt) ? number_format((float)$office_info->rebate_check2_amt, 2, '.', ',') : '0.00'; ?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Activation Fee" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">
                        <?= !empty($office_info->activation_fee) ? $office_info->activation_fee : '---'; ?>
                        <?= !empty($office_info->way_of_pay) ? $office_info->way_of_pay : '---'; ?>
                    </label>
                </div>
            </div>
            <div class="col-12"><hr></div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Commision Scheme" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= $office_info->commision_scheme == 1 ? 'On' : 'Off';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rep Commission" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <!-- <label class="content-subtitle">$<?php echo ($commission->totalCommission) ? number_format((float)$commission->totalCommission,2,'.',',') : 0.0 ?></label> -->
                    <label class="content-subtitle">$<?php echo ($office_info->rep_comm) ? number_format((float)$office_info->rep_comm,2,'.',',') : 0.0 ?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rep Upfront Pay" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->rep_upfront_pay) ? number_format((float)$office_info->rep_upfront_pay,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rep Tiered Upront Bonus" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->rep_tiered_bonus) ? number_format((float)$office_info->rep_tiered_bonus,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rep Tiered Holdfund" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->rep_holdfund_bonus) ? number_format((float)$office_info->rep_holdfund_bonus,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rep Deduction Total" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->rep_deduction) ? number_format((float)$office_info->rep_deduction,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Tech Commission" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->tech_comm) ? number_format((float)$office_info->tech_comm,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Tech Upfront Pay" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->tech_upfront_pay) ? number_format((float)$office_info->tech_upfront_pay,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Tech Deduction Total" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->tech_deduction) ? number_format((float)$office_info->tech_deduction,2,'.',','): '0.00';?></label>
                </div>
            </div>
            <div class="col-12"><hr></div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rep Hold Fund Charge Back" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->rep_charge_back) ? number_format((float)$office_info->rep_charge_back,2,'.',','): '0.00';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Rep Payroll Charge Back" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->rep_payroll_charge_back) ? number_format((float)$office_info->rep_payroll_charge_back,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="col-12"><hr></div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Points Scheme Override" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= $office_info->pso == 1 ? 'On' : 'Off';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Points Included" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($office_info->points_include) ? $office_info->points_include : '---';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Price Per Point" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->price_per_point) ? number_format((float)$office_info->price_per_point,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="col-12"><hr></div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Purchase Price" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->purchase_price) ? number_format((float)$office_info->purchase_price,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Purchase Multiple" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle"><?= !empty($office_info->purchase_multiple) ? $office_info->purchase_multiple : '---';?></label>
                </div>
            </div>
            <div class="row p-0 field-custom-name-container">
                <div class="col-12 col-md-6">
                    <label class="content-subtitle fw-bold">
                        <field-custom-name readonly default="Purchase Discount" form="funding_info"></field-custom-name>
                    </label>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-subtitle">$<?= !empty($office_info->purchase_discount) ? number_format((float)$office_info->purchase_discount,2,'.',',') : '0.00';?></label>
                </div>
            </div>
            <div class="col-12"><hr></div>
            <div class="col-12 mt-5">
                <button type="button" class="nsm-button primary w-100" onclick="location.href='<?= base_url('customer/subscription/' . $this->uri->segment(3)) ?>'">Capture Now</button>
            </div>
        </div>        
    </div>
</div>