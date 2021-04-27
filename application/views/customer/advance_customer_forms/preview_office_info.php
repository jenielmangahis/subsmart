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
                $<?= isset($office_info) && !empty($office_info->collect_amount) ?  number_format((float)$office_info->collect_amount,2,'.',',') : '$0.00' ?>
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
    </div>
</div>