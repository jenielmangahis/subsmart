<div class="row recurring-details">
    <div class="col-md-12">
        <h3>Recurring Bank Deposit</h3>
        <div class="form-row">
            <div class="col-md-3 form-group">
                <label for="templateName">Template name</label>
                <input type="text" class="form-control" id="templateName" name="template_name">
            </div>
            <div class="col-md-2 form-group">
                <label for="recurringType">Type</label>
                <select class="form-control" id="recurringType" name="recurring_type">
                    <option value="scheduled">Scheduled</option>
                    <option value="reminder">Reminder</option>
                    <option value="unscheduled">Unscheduled</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <div class="row m-0 h-100 d-flex">
                    <div class="align-self-end d-flex align-items-center">
                        <span>Create &nbsp;</span>
                        <input type="number" name="days_in_advance" id="dayInAdvance" class="form-control" style="width: 20%">
                        <span>&nbsp; days in advance</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row recurring-bank-account">
    <div class="col-md-12">
        <div class="form-row">
            <div class="col-md-3 form-group">
                <label for="bankAccount">Account</label>
                <select name="bank_account" id="bankAccount" class="form-control" required="">
                    <?php foreach($accounts as $key => $value) : ?>
                        <optgroup label="<?= $key ?>">
                            <?php foreach($value as $account) : ?>
                                <option value="<?= $account['value'] ?>" <?= $account['selected'] === true ? 'selected' : '' ?>><?= $account['text'] ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row recurring-interval-container">
    <div class="col-md-12">
        <div class="form-row">
            <div class="col-md-2 form-group">
                <label>Interval</label>
                <select class="form-control" name="recurring_interval" id="recurringinterval">
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly" selected="">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <div class="row m-0 h-100 d-flex">
                    <div class="align-self-end d-flex align-items-center w-100">
                        <span>on &nbsp;</span>
                        <select name="recurring_week" class="form-control" style="width: 20%">
                            <option value="day">day</option>
                            <option value="first">first</option>
                            <option value="second">second</option>
                            <option value="third">third</option>
                            <option value="fourth">fourth</option>
                            <option value="last">last</option>
                        </select>
                        <select class="form-control" style="width: 25%" name="recurring_day">
                            <?php foreach($recurringDays as $key => $value) : ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span>&nbsp; of every &nbsp;</span>
                        <input type="number" value="1" class="form-control" name="recurr_every" style="width: 15%">
                        <span>&nbsp; month(s)</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 form-group">
                <label for="startDate">Start date</label>
                <input type="text" class="form-control date" name="start_date" id="startDate"/>
            </div>
            <div class="col-md-1 form-group">
                <label for="endType">End</label>
                <select name="end_type" class="form-control" id="endType">
                    <option value="none">None</option>
                    <option value="by">By</option>
                    <option value="after">After</option>
                </select>
            </div>
        </div>
    </div>
</div>