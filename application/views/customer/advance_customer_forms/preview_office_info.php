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
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Sales Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Credit Score </label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label class="alarm_label"> <span >Pay History </span>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Sales Rep</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?> <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-envelope"></span>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Technician</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?><span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-envelope"></span>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Install Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Tech Arrival Time</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Tech Departure Time</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Lead Source</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Verification:</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Cancellation Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Cancellation Reason</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Collection Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Collection Amount</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Language</label>
            </div>
            <div class="col-md-6">
                English
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
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Login</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Password</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
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
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Recurring Start Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Recurring End Date</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Transaction Amount</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Transaction Category</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="">Frequency</label>
            </div>
            <div class="col-md-6">
                <?= isset($office_info) && !empty($office_info->time_entered) ?  $office_info->time_entered : '---' ?>
            </div>
        </div>

    </div>




</div>