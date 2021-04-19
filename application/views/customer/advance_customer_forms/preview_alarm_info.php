<div class="card">

    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Alarm Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Monitoring Company</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->monitor_comp) ? $alarm_info->monitor_comp : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Monitoring ID</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Account Type</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->acct_type) ? $alarm_info->acct_type : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Abort/Password Code</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->passcode) ? $alarm_info->passcode : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Installer Code</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->install_code) ? $alarm_info->install_code : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Monitoring Confirm #</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->mcn) ? $alarm_info->mcn : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Signal Confirm #</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->scn) ? $alarm_info->scn : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Panel Type</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->panel_type) ? $alarm_info->panel_type : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">System Package Type</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->system_type) ? $alarm_info->system_type : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Warranty Type</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->warranty_type) ? $alarm_info->warranty_type : '---';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Dealer</label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->dealer) ? $alarm_info->dealer : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for=""> Login </label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->alarm_login) ? $alarm_info->alarm_login : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Customer ID </label>
            </div>
            <div class="col-md-6">
                <?= !empty($alarm_info->alarm_customer_id) ? $alarm_info->alarm_customer_id : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">CS Account</label>
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
                <label for="">Pre-Install Survey</label>
            </div>
            <div class="col-md-6" style="color: <?= $office_info->pre_install_survey == 'Pass' ? 'darkgreen' : 'darkred';?>; ">
                <?= !empty($office_info->pre_install_survey) ? $office_info->pre_install_survey : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Post-Install Survey</label>
            </div>
            <div class="col-md-6" style="color: <?= $office_info->pre_install_survey == 'Pass' ? 'darkgreen' : 'darkred';?>;">
                <?= !empty($office_info->post_install_survey) ? $office_info->post_install_survey : '---';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Monitoring Waived</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->monitoring_waived) ? $office_info->monitoring_waived : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="rebate_offer"><span>Rebate Offered</span>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rebate_offer) ? $office_info->rebate_offer : '---';?>
            </div>
        </div>


        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Rebate Check # 1</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rebate_check1) ? $office_info->rebate_check1 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Amount $</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rebate_check1_amt) ? $office_info->rebate_check1_amt : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Rebate Check # 2</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rebate_check2) ? $office_info->rebate_check2 : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Amount $</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rebate_check2_amt) ? $office_info->rebate_check2_amt : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Activation Fee</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->activation_fee) ? $office_info->activation_fee : '---';?>
                <span><?= !empty($office_info->way_of_pay) ? $office_info->way_of_pay : '---';?></span>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Commision Scheme</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->commision_scheme) ? $office_info->commision_scheme : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Rep Commission </label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rep_comm) ? $office_info->rep_comm : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Rep Upfront Pay</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rep_upfront_pay) ? $office_info->rep_upfront_pay : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Rep Tiered Upront Bonus</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rep_tiered_bonus) ? $office_info->rep_tiered_bonus : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Rep Tiered Holdfund</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rep_holdfund_bonus) ? $office_info->rep_holdfund_bonus : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Rep Deduction Total</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->rep_deduction) ? $office_info->rep_deduction : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Tech Commission </label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->tech_comm) ? $office_info->tech_comm : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="tech_upfront_pay">Tech Upfront Pay </label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->tech_upfront_pay) ? $office_info->tech_upfront_pay : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Tech Deduction Total</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->tech_deduction) ? $office_info->tech_deduction : '---';?>
            </div>
        </div>

        <hr>

        <div class="row form_line">
            <div class="col-md-8">
                <label for="">Rep Hold Fund Charge Back </label>
            </div>
            <div class="col-md-4">
                <?= !empty($office_info->rep_charge_back) ? $office_info->rep_charge_back : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-8">
                <label for="">Rep Payroll Charge Back </label>
            </div>
            <div class="col-md-4">
                <?= !empty($office_info->rep_payroll_charge_back) ? $office_info->rep_payroll_charge_back : '---';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Points Scheme Override</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->pso) ? $office_info->pso : '---';?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Points Included</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->points_include) ? $office_info->points_include : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Price Per Point </label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->price_per_point) ? $office_info->price_per_point : '---';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Purchase Price </label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->purchase_price) ? $office_info->purchase_price : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Purchase Multiple</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->purchase_multiple) ? $office_info->purchase_multiple : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Purchase Discount </label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->purchase_discount) ? $office_info->purchase_discount : '---';?>
            </div>
        </div>
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Equipment Cost</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->equipment_cost) ? $office_info->equipment_cost : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Labor Cost</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->labor_cost) ? $office_info->labor_cost : '---';?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Job Profit</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->job_profit) ? $office_info->job_profit : '---';?>
            </div>
        </div>
        <br>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Shareable Url Link</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->url) ? $office_info->url : '---';?>
                <br>
                <a href="<?= base_url('customer/preview/').$this->uri->segment(3) ?>"  id="exportCustomers"><span class="fa fa-share"></span> Share</a>
            </div>
        </div>
    </div>

</div>