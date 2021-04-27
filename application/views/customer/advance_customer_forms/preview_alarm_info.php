<div class="card">

    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Alarm Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                Monitoring Company
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->monitor_comp) ? $alarm_info->monitor_comp : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Monitoring ID
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Account Type
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->acct_type) ? $alarm_info->acct_type : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Abort/Password Code
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->passcode) ? $alarm_info->passcode : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Installer Code
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->install_code) ? $alarm_info->install_code : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Monitoring Confirm #
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->mcn) ? $alarm_info->mcn : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Signal Confirm #
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->scn) ? $alarm_info->scn : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Panel Type
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->panel_type) ? $alarm_info->panel_type : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                System Package Type
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->system_type) ? $alarm_info->system_type : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Warranty Type
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->warranty_type) ? $alarm_info->warranty_type : '---';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Dealer
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->dealer) ? $alarm_info->dealer : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                 Login 
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->alarm_login) ? $alarm_info->alarm_login : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Customer ID 
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->alarm_customer_id) ? $alarm_info->alarm_customer_id : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                CS Account
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->alarm_cs_account) ? $alarm_info->alarm_cs_account : '---';?>
            </div>
        </div>
    </div>

    <div class="card-header">
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Funding Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                Pre-Install Survey
            </div>
            <div class="col-md-6" style="color: <?= $office_info->pre_install_survey == 'Pass' ? 'darkgreen' : 'darkred';?>; ">
                <?= !empty($office_info->pre_install_survey) ? $office_info->pre_install_survey : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Post-Install Survey
            </div>
            <div class="col-md-6" style="color: <?= $office_info->pre_install_survey == 'Pass' ? 'darkgreen' : 'darkred';?>;">
                <?= !empty($office_info->post_install_survey) ? $office_info->post_install_survey : '---';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Monitoring Waived
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->monitoring_waived) ? $office_info->monitoring_waived.' months' : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="rebate_offer"><span>Rebate Offered</span>
            </div>
            <div class="col-md-6">
                <?= $office_info->rebate_offer == 1 ? 'Enabled' : '---';?>
            </div>
        </div>


        <div class="row form_line">
            <div class="col-md-6">
                Rebate Check # 1
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rebate_check1) ? $office_info->rebate_check1 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Amount $
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->rebate_check1_amt) ? number_format((float)$office_info->rebate_check1_amt,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Rebate Check # 2
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rebate_check2) ? $office_info->rebate_check2 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Amount $
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->rebate_check2_amt) ? number_format((float)$office_info->rebate_check2_amt,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Activation Fee
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->activation_fee) ? $office_info->activation_fee : '---';?>
                <span><?= !empty($office_info->way_of_pay) ? $office_info->way_of_pay : '---';?></span>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Commision Scheme
            </div>
            <div class="col-md-6">
                <?= $office_info->commision_scheme == 1 ? 'On' : 'Off';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Rep Commission 
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->rep_comm) ?number_format((float)$office_info->rep_comm,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Rep Upfront Pay
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->rep_upfront_pay) ? number_format((float)$office_info->rep_upfront_pay,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Rep Tiered Upront Bonus
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->rep_tiered_bonus) ? number_format((float)$office_info->rep_tiered_bonus,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Rep Tiered Holdfund
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->rep_holdfund_bonus) ? number_format((float)$office_info->rep_holdfund_bonus,2,'.',',') : '0.00';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Rep Deduction Total
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->rep_deduction) ? number_format((float)$office_info->rep_deduction,2,'.',',') : '0.00';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Tech Commission 
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->tech_comm) ? number_format((float)$office_info->tech_comm,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="tech_upfront_pay">Tech Upfront Pay 
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->tech_upfront_pay) ? number_format((float)$office_info->tech_upfront_pay,2,'.',',') : '0.00';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Tech Deduction Total
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->tech_deduction) ? number_format((float)$office_info->price_per_point,2,'.',','): '---';?>
            </div>
        </div>

        <hr>

        <div class="row form_line">
            <div class="col-md-8">
                Rep Hold Fund Charge Back 
            </div>
            <div class="col-md-4">
                $<?= !empty($office_info->rep_charge_back) ? number_format((float)$office_info->rep_charge_back,2,'.',','): '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-8">
                Rep Payroll Charge Back 
            </div>
            <div class="col-md-4">
                $<?= !empty($office_info->rep_payroll_charge_back) ? number_format((float)$office_info->rep_payroll_charge_back,2,'.',',') : '0.00';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Points Scheme Override
            </div>
            <div class="col-md-6">
                <?= $office_info->pso == 1 ? 'On' : 'Off';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Points Included
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->points_include) ? $office_info->points_include : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Price Per Point 
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->price_per_point) ? number_format((float)$office_info->price_per_point,2,'.',',') : '0.00';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Purchase Price 
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->purchase_price) ? number_format((float)$office_info->purchase_price,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Purchase Multiple
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->purchase_multiple) ? $office_info->purchase_multiple : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Purchase Discount 
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->purchase_discount) ? number_format((float)$office_info->purchase_discount,2,'.',',') : '0.00';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Equipment Cost
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->equipment_cost) ? number_format((float)$office_info->equipment_cost,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Labor Cost
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->labor_cost) ? number_format((float)$office_info->labor_cost,2,'.',',') : '0.00';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Job Profit
            </div>
            <div class="col-md-6">
                $<?= !empty($office_info->job_profit) ? number_format((float)$office_info->job_profit,2,'.',',') : '0.00';?>
            </div>
        </div>
        <br>
        <div class="row form_line">
            <div class="col-md-6">
                Shareable Url Link
            </div>
            <div class="col-md-6">
                <input readonly type="text" id="sharableLink" value="<?=  base_url('customer/preview/').$this->uri->segment(3); ?>"/>
                <!--<a href="<?= base_url('customer/preview/').$this->uri->segment(3) ?>"  id="exportCustomers"><span class="fa fa-share"></span> Share</a>-->
                <a onclick="copy_url();" id="copyLink" href="javascript:void(0);"><span style="color: darkgreen;" class="fa fa-copy"></span></a>
            </div>
        </div>
    </div>

</div>