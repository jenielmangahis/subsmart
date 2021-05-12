<div class="card">
    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Office Use Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                Entered By
            </div>
            <div class="col-md-6">
                <?= $logged_in_user->FName.' '. $logged_in_user->LName; ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Time Entered
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Sales Date
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->sales_date) ?  $office_info->sales_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Credit Score 
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->credit_score) ?  $office_info->credit_score : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label class="alarm_label"> <span >Pay History </span>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->pay_history) ?  pay_history($office_info->pay_history) : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Sales Rep
            </div>
            <div class="col-md-6">
                <?php
                     $sales_rep = !empty($office_info->fk_sales_rep_office) ?  get_employee_name($office_info->fk_sales_rep_office) : '---';
                ?>
                <?= $sales_rep->FName. ' ' . $sales_rep->LName; ?> <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-envelope"></span>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Technician
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->technician) ?  $office_info->technician : '---' ?><span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-envelope"></span>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Install Date
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->install_date) ?  $office_info->install_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Tech Arrival Time
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->tech_arrive_time) ?  $office_info->tech_arrive_time : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Tech Departure Time
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->tech_depart_time) ?  $office_info->tech_depart_time : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Lead Source
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->lead_source) ?  $office_info->lead_source : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Verification:
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->verification) ?  $office_info->verification : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Cancel Date
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->cancel_date) ?  $office_info->cancel_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Cancel Reason
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->cancel_reason) ?  $office_info->cancel_reason : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Collection Date
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->collect_date) ?  $office_info->collect_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Collection Amount
            </div>
            <div class="col-md-6">
                $<?= isset($office_info) && !empty($office_info->collect_amount) ?  number_format((float)$office_info->collect_amount,2,'.',',') : '0.00' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Language
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->language) ?  $office_info->language : '---' ?>
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
    </div>
    <br><br>
</div>