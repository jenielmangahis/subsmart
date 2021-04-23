<div class="card">
    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Office Use Information</h6>
    </div>
    <div class="card-body">
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Entered By</label>
            </div>
            <div class="col-md-6">
                <?= $logged_in_user->FName.' '. $logged_in_user->LName; ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Time Entered</label>
            </div>
            <div class="col-md-6">
                <?= !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Sales Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->sales_date) ?  $office_info->sales_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Credit Score </label>
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
                <?= isset($office_info) && !empty($office_info->pay_history) ?  $office_info->pay_history : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Sales Rep</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->fk_sales_rep_office) ?  $office_info->fk_sales_rep_office : '---' ?> <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-envelope"></span>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Technician</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->technician) ?  $office_info->technician : '---' ?><span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-envelope"></span>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Install Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->install_date) ?  $office_info->install_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Tech Arrival Time</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->tech_arrive_time) ?  $office_info->tech_arrive_time : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Tech Departure Time</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->tech_depart_time) ?  $office_info->tech_depart_time : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Lead Source</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->lead_source) ?  $office_info->lead_source : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Verification:</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->verification) ?  $office_info->verification : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Cancel Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->cancel_date) ?  $office_info->cancel_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Cancel Reason</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->cancel_reason) ?  $office_info->cancel_reason : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Collection Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->collect_date) ?  $office_info->collect_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Collection Amount</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->collect_amount) ?  $office_info->collect_amount : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Language</label>
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
                <label for="">Portal Status (on/off)</label>
            </div>
            <div class="col-md-6">
                <?= !empty($access_info->portal_status) ?  $access_info->portal_status : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Login</label>
            </div>
            <div class="col-md-6">
                <?= !empty($access_info->access_login) ?  $access_info->access_login : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Password</label>
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
                <label for="">Custom Field 1</label>
            </div>
            <div class="col-md-6">
                ---
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Custom Field 2</label>
            </div>
            <div class="col-md-6">
                ---
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Custom Field 3</label>
            </div>
            <div class="col-md-6">
                ---
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Custom Field 4</label>
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
                <label for="">Finance Amount</label>
            </div>
            <div class="col-md-6">
                <?=  $billing_info->finance_amount != "" ?  $billing_info->finance_amount : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Recurring Start Date</label>
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->recurring_start_date) ?  $billing_info->recurring_start_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Recurring End Date</label>
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->recurring_end_date) ?  $billing_info->recurring_end_date : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Transaction Amount</label>
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->transaction_amount) ?  $billing_info->transaction_amount : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Transaction Category</label>
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->transaction_category) ?  $billing_info->transaction_category : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Frequency</label>
            </div>
            <div class="col-md-6">
                <?= !empty($billing_info->frequency) ?  $billing_info->frequency : '---' ?>
            </div>
        </div>
        <br>
        <a href="<?= base_url('customer/subscription/'.$this->uri->segment(3)) ?>">
        <button type="submit" class="btn btn-primary">Capture Now</button>
        </a>
    </div>
</div>