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
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Access Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                Portal Status (on/off)
            </div>
            <div class="col-md-6">
                <?php
                if($access_info->portal_status == 1){
                    echo 'On';
                }else{
                    echo 'Off';
                }
                ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Login
            </div>
            <div class="col-md-6">
                <?= !empty($access_info->access_login) ?  $access_info->access_login : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Password
            </div>
            <div class="col-md-6">
                <?=  !empty($access_info->access_password) ?  $access_info->access_password : '---' ?>
            </div>
        </div>

    </div>

    <div class="card-header">
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Custom Field</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                Custom Field 1
            </div>
            <div class="col-md-6">
                ---
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Custom Field 2
            </div>
            <div class="col-md-6">
                ---
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Custom Field 3
            </div>
            <div class="col-md-6">
                ---
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Custom Field 4
            </div>
            <div class="col-md-6">
                ---
            </div>
        </div>
    </div>

    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-credit-card"></span>&nbsp; &nbsp;Subscription Pay Plan</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                Finance Amount
            </div>
            <div class="col-md-6">
                $<?=  $billing_info->finance_amount != "" ? number_format((float)$billing_info->finance_amount ,2,'.',',') : '0.00' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Recurring Start Date
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->recurring_start_date) ?  $billing_info->recurring_start_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Recurring End Date
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->recurring_end_date) ?  $billing_info->recurring_end_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Transaction Amount
            </div>
            <div class="col-md-6">
                $<?= !empty($billing_info->transaction_amount) ?  number_format((float)$billing_info->transaction_amount ,2,'.',',') : '0.00' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Transaction Category
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->transaction_category) ?  $billing_info->transaction_category : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Frequency
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->frequency) ?  $billing_info->frequency.' months' : '---' ?>
            </div>
        </div>
        <br>
        <a href="<?= base_url('customer/subscription/'.$this->uri->segment(3)) ?>">
            <button type="submit" class="btn btn-primary">Capture Now</button>
        </a>
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
    <br><br><br><br><br>
</div>