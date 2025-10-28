<hr />
<span style="font-size:18px; font-weight:bold;" class="d-block mb-4">Funding</span>
<div class="row g-3">
    <div class="col-12 col-md-6">
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label class="content-title">Pre-Install Survey</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= !empty($office_info->pre_install_survey) ? $office_info->pre_install_survey : '---'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Post-Install Survey</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= !empty($office_info->post_install_survey) ? $office_info->post_install_survey : '---'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Monitoring Waived</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= !empty($office_info->monitoring_waived) ? $office_info->monitoring_waived . ' months' : '---'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Credit Score</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?php 
                        if ($office_info->credit_score) {
                            echo $office_info->credit_score; 
                        } else {
                            echo "---";
                        }
                    ?>
                </span>
            </div>     
            <div class="col-12 col-md-6">
                <label class="content-title">Rebate Offered</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= $office_info->rebate_offer == 1 ? 'Enabled' : '---'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rebate Check # 1</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= !empty($office_info->rebate_check1) ? $office_info->rebate_check1 : '---'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rebate Check # 1 Amount</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->rebate_check1_amt) ? number_format((float)$office_info->rebate_check1_amt, 2, '.', ',') : '0.00'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rebate Check # 2</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= !empty($office_info->rebate_check2) ? $office_info->rebate_check2 : '---'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rebate Check # 2 Amount</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->rebate_check2_amt) ? number_format((float)$office_info->rebate_check2_amt, 2, '.', ',') : '0.00'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Activation Fee</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= !empty($office_info->activation_fee) ? $office_info->activation_fee : '---'; ?>
                    <?= !empty($office_info->way_of_pay) ? $office_info->way_of_pay : '---'; ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Commision Scheme</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= $office_info->commision_scheme == 1 ? 'On' : 'Off';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rep Commission</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?php echo ($office_info->rep_comm) ? number_format((float)$office_info->rep_comm,2,'.',',') : 0.0 ?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rep Upfront Pay</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->rep_upfront_pay) ? number_format((float)$office_info->rep_upfront_pay,2,'.',',') : '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rep Tiered Upront Bonus</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->rep_tiered_bonus) ? number_format((float)$office_info->rep_tiered_bonus,2,'.',',') : '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rep Tiered Holdfund</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->rep_holdfund_bonus) ? number_format((float)$office_info->rep_holdfund_bonus,2,'.',',') : '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rep Deduction Total</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->rep_deduction) ? number_format((float)$office_info->rep_deduction,2,'.',',') : '0.00';?>
                </span>
            </div>             
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label class="content-title">Tech Commission</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->tech_comm) ? number_format((float)$office_info->tech_comm,2,'.',',') : '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Tech Upfront Pay</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->tech_upfront_pay) ? number_format((float)$office_info->tech_upfront_pay,2,'.',',') : '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Tech Deduction Total</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                $<?= !empty($office_info->tech_deduction) ? number_format((float)$office_info->tech_deduction,2,'.',','): '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rep Hold Fund Charge Back</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->rep_charge_back) ? number_format((float)$office_info->rep_charge_back,2,'.',','): '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Rep Payroll Charge Back</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->rep_payroll_charge_back) ? number_format((float)$office_info->rep_payroll_charge_back,2,'.',',') : '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Points Scheme Override</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= $office_info->pso == 1 ? 'On' : 'Off';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Points Included</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= !empty($office_info->points_include) ? $office_info->points_include : '---';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Price Per Point</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->price_per_point) ? number_format((float)$office_info->price_per_point,2,'.',',') : '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Purchase Price</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->purchase_price) ? number_format((float)$office_info->purchase_price,2,'.',',') : '0.00';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Purchase Multiple</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= !empty($office_info->purchase_multiple) ? $office_info->purchase_multiple : '---';?>
                </span>
            </div> 
            <div class="col-12 col-md-6">
                <label class="content-title">Purchase Discount</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    $<?= !empty($office_info->purchase_discount) ? number_format((float)$office_info->purchase_discount,2,'.',',') : '0.00';?>
                </span>
            </div> 
        </div>
    </div>
</div>