<div class="modal fade nsm-modal fade" id="add_employee_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="add_employee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Employee</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="overflow-x: auto;max-height: 800px;">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Basic Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Employee Number</label>
                            <input type="text" name="emp_number" class="nsm-field form-control" id="emp_number" required />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                            <input type="text" name="firstname" class="nsm-field form-control" required />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                            <input type="text" name="lastname" class="nsm-field form-control" required />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">    
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                            <input type="text" name="mobile" class="nsm-field form-control" value="" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                            <input type="text" name="phone" class="nsm-field form-control" value="" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">nSmart App Login Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Email <small>(Will be use as your username)</small></label>
                            <div class="nsm-field-group icon-right">
                                <input type="email" class="nsm-field form-control" id="employee_username" name="username" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="employee_password" name="password" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Confirm Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="employee_password_2" name="confirm_password" required>
                            </div>
                        </div>
                    </div>
                    <?php if(isSolarCompany() == 1){ ?>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">ADT Sales App Login Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Username</label>
                            <div class="nsm-field-group icon-right">
                                <input type="text" class="nsm-field form-control" id="portal_username" name="portal_username" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="portal_password" name="portal_password" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Confirm Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="portal_confirm_password" name="portal_confirm_password" />
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Other Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                            <input type="text" class="nsm-field form-control" name="address" required>
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">State</label>
                            <input type="text" class="nsm-field form-control" name="state" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
                            <input type="text" class="nsm-field form-control" name="postal_code" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Title</label>
                            <select class="nsm-field form-select" name="role" id="employee_role" required>
                                <option value="" selected="selected" disabled>Select Title</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                            <select class="nsm-field form-select" name="status" required>
                                <option value="" selected="selected" disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch nsm-switch d-inline-block me-3">
                                <input class="form-check-input" type="checkbox" id="app_access" name="app_access">
                                <label class="form-check-label" for="app_access">App Access</label>
                            </div>
                            <div class="form-check form-switch nsm-switch d-inline-block">
                                <input class="form-check-input" type="checkbox" id="web_access" name="web_access">
                                <label class="form-check-label" for="web_access">Web Access</label>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12 col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="content-title">Profile Picture</label>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-img-upload">
                                        <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                        <input type="file" name="userfile" class="nsm-upload" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="content-subtitle fw-bold d-block mb-2">Payscale</label>
                                    <select class="nsm-field form-select" name="empPayscale" required>
                                        <option value="" selected="selected" disabled>Select payscale</option>
                                        <?php foreach ($payscale as $p) : ?>
                                            <option value="<?= $p->id; ?>"><?= $p->payscale_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="content-title">Rights and Permissions</label>
                                    <label class="content-subtitle">Select employee role</label>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="7" id="role_7" name="user_type">
                                        <label class="form-check-label" for="role_7">
                                            Admin
                                            <span class="content-subtitle d-block fst-italic">ALL Access</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="1" id="role_1" name="user_type">
                                        <label class="form-check-label" for="role_1">
                                            Office Manager
                                            <span class="content-subtitle d-block fst-italic">ALL except high security file vault</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="2" id="role_2" name="user_type">
                                        <label class="form-check-label" for="role_2">
                                            Partner
                                            <span class="content-subtitle d-block fst-italic">ALL base on plan type</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="3" id="role_3" name="user_type">
                                        <label class="form-check-label" for="role_3">
                                            Team Leader
                                            <span class="content-subtitle d-block fst-italic">No accounting or any changes to company profile or deletion</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="4" id="role_4" name="user_type">
                                        <label class="form-check-label" for="role_4">
                                            Standard User
                                            <span class="content-subtitle d-block fst-italic">Cannot add or delete employees, can not manage subscriptions</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="5" id="role_5" name="user_type">
                                        <label class="form-check-label" for="role_5">
                                            Field Sales
                                            <span class="content-subtitle d-block fst-italic">View only no input</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="6" id="role_6" name="user_type">
                                        <label class="form-check-label" for="role_6">
                                            Field Tech
                                            <span class="content-subtitle d-block fst-italic">App access only, no Web access</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">What are this employee's employment details?</label>
                            <label class="content-subtitle">Add employee's hire date and where they work.</label>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label for="hire_date">Hire date</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="hire_date" id="hire_date" class="form-control nsm-field date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">How often do you pay this employee?</label>
                            <label class="content-subtitle">Enter a few details and we'll work out your company's payroll calendar.</label>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <select name="pay_schedule" id="pay-schedule" class="form-select nsm-field">
                                        <option disabled selected>&nbsp;</option>
                                        <option value="add">&plus; Add new</option>
                                        <?php foreach($pay_schedules as $pay_schedule) : ?>
                                            <option value="<?=$pay_schedule->id?>" <?=$pay_schedule->use_for_new_employees === "1" ? 'selected' : ''?>><?=$pay_schedule->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 d-flex align-items-center">
                                    <label for="pay-schedule" class="<?=count($pay_schedules) > 0 || count(array_filter($pay_schedules, function($v) { return $v->use_for_new_employees === "1"; })) > 0 ? '' : 'd-none'?>">starting <span><?=$nextPayDate?></span> <a href="#" class="text-decoration-none text-muted"><i class="bx bx-fw bx-pencil"></i></a></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">How much do you pay this employee?</label>
                            <label class="content-subtitle">If your company offers additional pay types, add them here. These pay types show up when you run payroll.</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <select name="pay_type" id="pay-type" class="form-select nsm-field">
                                <option value="hourly">Hourly</option>
                                <option value="salary">Salary</option>
                                <option value="commission">Commission only</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" name="pay_rate" id="pay-rate" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                                <span class="input-group-text">/hour</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text">Default hours:</span>
                                <input type="text" name="default_hours" id="default-hours" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                                <span class="input-group-text">hours per day and</span>
                                <input type="text" name="days_per_week" id="days-per-week" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)">
                                <span class="input-group-text">days per week.</span>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">How do you want to pay this employee?</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <select name="pay_method" id="pay-method" class="form-select nsm-field">
                                <option value="direct-deposit">Direct deposit</option>
                                <option value="paper-check">Paper check</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="add-pay-schedule-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" id="pay-schedule-form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add a pay schedule</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="overflow-x: auto;max-height: 800px;">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row gy-3 mb-4">
                                <div class="col-12">
                                    <label class="content-title">Select when you pay your employees</label>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-2">
                                        <label for="pay-frequency">Pay frequency</label>
                                        <select name="pay_frequency" id="pay-frequency" class="form-select nsm-field">
                                            <option value="every-week">Every week</option>
                                            <option value="every-other-week">Every other week</option>
                                            <option value="twice-month">Twice a month</option>
                                            <option value="every-month">Every month</option>
                                        </select>
                                    </div>
                                    <div class="form-check form-switch nsm-switch">
                                        <label for="custom-schedule" class="form-check-label">Custom schedule</label>
                                        <input type="checkbox" name="custom_schedule" id="custom-schedule" class="form-check-input">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="next-payday">Next payday</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="next_payday" id="next-payday" class="form-control nsm-field date" value="<?=$nextPayday?>">
                                    </div>
                                    <p class="m-0">Friday</p>
                                </div>
                                <div class="col-12">
                                    <label for="next-pay-period-end">End of next pay period</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="next_pay_period_end" id="next-pay-period-end" class="form-control nsm-field date" value="<?=$nextPayPeriodEnd?>">
                                    </div>
                                    <p class="m-0">Wednesday</p>
                                </div>
                            </div>
                            <div class="row gy-3 mb-4">
                                <div class="col-12">
                                    <label class="content-title">First pay period of the month</label>
                                </div>
                                <div class="col-12">
                                    <label for="first_payday">First payday of the month</label>
                                    <select name="first_payday" id="first_payday" class="form-select nsm-field">
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                        <option value="5">5th</option>
                                        <option value="6">6th</option>
                                        <option value="7">7th</option>
                                        <option value="8">8th</option>
                                        <option value="9">9th</option>
                                        <option value="10">10th</option>
                                        <option value="11">11th</option>
                                        <option value="12">12th</option>
                                        <option value="13">13th</option>
                                        <option value="14">14th</option>
                                        <option value="15">15th</option>
                                        <option value="16">16th</option>
                                        <option value="17">17th</option>
                                        <option value="18">18th</option>
                                        <option value="19">19th</option>
                                        <option value="20">20th</option>
                                        <option value="21">21st</option>
                                        <option value="22">22nd</option>
                                        <option value="23">23rd</option>
                                        <option value="24">24th</option>
                                        <option value="25">25th</option>
                                        <option value="26">26th</option>
                                        <option value="27">27th</option>
                                        <option value="28">28th</option>
                                        <option value="29">29th</option>
                                        <option value="30">30th</option>
                                        <option value="0">End of month</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row gy-3 mb-4">
                                <div class="col-12">
                                    <label class="content-title">End of first pay period</label>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="end_of_first_pay_period" id="end_date_first_pay" class="form-check-input" value="end-date" checked>
                                        <label for="end_date_first_pay" class="form-check-label">End date</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="end_of_first_pay_period" id="number_of_days_first_pay" class="form-check-input ml-2" value="number-of-days-before">
                                        <label for="number_of_days_first_pay" class="form-check-label">Number of days before payday</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="first_pay_month">Month</label>
                                            <select name="first_pay_month" id="first_pay_month" class="form-seelct nsm-field">
                                                <option value="same">Same</option>
                                                <option value="previous">Previous</option>
                                                <option value="next">Next</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="first_pay_day">Day</label>
                                            <select name="first_pay_day" id="first_pay_day" class="form-select nsm-field">
                                                <option value="1">1st</option>
                                                <option value="2">2nd</option>
                                                <option value="3">3rd</option>
                                                <option value="4">4th</option>
                                                <option value="5">5th</option>
                                                <option value="6">6th</option>
                                                <option value="7">7th</option>
                                                <option value="8">8th</option>
                                                <option value="9">9th</option>
                                                <option value="10">10th</option>
                                                <option value="11">11th</option>
                                                <option value="12">12th</option>
                                                <option value="13">13th</option>
                                                <option value="14">14th</option>
                                                <option value="15">15th</option>
                                                <option value="16">16th</option>
                                                <option value="17">17th</option>
                                                <option value="18">18th</option>
                                                <option value="19">19th</option>
                                                <option value="20">20th</option>
                                                <option value="21">21st</option>
                                                <option value="22">22nd</option>
                                                <option value="23">23rd</option>
                                                <option value="24">24th</option>
                                                <option value="25">25th</option>
                                                <option value="26">26th</option>
                                                <option value="27">27th</option>
                                                <option value="28">28th</option>
                                                <option value="29">29th</option>
                                                <option value="30">30th</option>
                                                <option value="0">End of month</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="first_pay_days_before">Days before payday</label>
                                            <select name="first_pay_days_before" id="first_pay_days_before" class="form-select nsm-field">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                                <option value="-9">-9</option>
                                                <option value="-8">-8</option>
                                                <option value="-7">-7</option>
                                                <option value="-6">-6</option>
                                                <option value="-5">-5</option>
                                                <option value="-4">-4</option>
                                                <option value="-3">-3</option>
                                                <option value="-2">-2</option>
                                                <option value="-1">-1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-3 mb-4">
                                <div class="col-12">
                                    <label class="content-title">Second pay period of the month</label>
                                </div>
                                <div class="col-12">
                                    <label for="second_payday">Second payday of the month</label>
                                    <select name="second_payday" id="second_payday" class="form-select nsm-field">
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                        <option value="5">5th</option>
                                        <option value="6">6th</option>
                                        <option value="7">7th</option>
                                        <option value="8">8th</option>
                                        <option value="9">9th</option>
                                        <option value="10">10th</option>
                                        <option value="11">11th</option>
                                        <option value="12">12th</option>
                                        <option value="13">13th</option>
                                        <option value="14">14th</option>
                                        <option value="15">15th</option>
                                        <option value="16" selected>16th</option>
                                        <option value="17">17th</option>
                                        <option value="18">18th</option>
                                        <option value="19">19th</option>
                                        <option value="20">20th</option>
                                        <option value="21">21st</option>
                                        <option value="22">22nd</option>
                                        <option value="23">23rd</option>
                                        <option value="24">24th</option>
                                        <option value="25">25th</option>
                                        <option value="26">26th</option>
                                        <option value="27">27th</option>
                                        <option value="28">28th</option>
                                        <option value="29">29th</option>
                                        <option value="30">30th</option>
                                        <option value="0">End of month</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row gy-3 mb-4">
                                <div class="col-12">
                                    <label class="content-title">End of second pay period</label>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="end_of_second_pay_period" id="end_date_second_pay" class="form-check-input" value="end-date" checked>
                                        <label for="end_date_second_pay" class="form-check-label">End date</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="end_of_second_pay_period" id="number_of_days_second_pay" class="form-check-input ml-2" value="number-of-days-before">
                                        <label for="number_of_days_second_pay" class="form-check-label">Number of days before payday</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="second_pay_month">Month</label>
                                            <select name="second_pay_month" id="second_pay_month" class="form-seelct nsm-field">
                                                <option value="same">Same</option>
                                                <option value="previous">Previous</option>
                                                <option value="next">Next</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="second_pay_day">Day</label>
                                            <select name="second_pay_day" id="second_pay_day" class="form-select nsm-field">
                                                <option value="1">1st</option>
                                                <option value="2">2nd</option>
                                                <option value="3">3rd</option>
                                                <option value="4">4th</option>
                                                <option value="5">5th</option>
                                                <option value="6">6th</option>
                                                <option value="7">7th</option>
                                                <option value="8">8th</option>
                                                <option value="9">9th</option>
                                                <option value="10">10th</option>
                                                <option value="11">11th</option>
                                                <option value="12">12th</option>
                                                <option value="13">13th</option>
                                                <option value="14">14th</option>
                                                <option value="15">15th</option>
                                                <option value="16">16th</option>
                                                <option value="17">17th</option>
                                                <option value="18">18th</option>
                                                <option value="19">19th</option>
                                                <option value="20">20th</option>
                                                <option value="21">21st</option>
                                                <option value="22">22nd</option>
                                                <option value="23">23rd</option>
                                                <option value="24">24th</option>
                                                <option value="25">25th</option>
                                                <option value="26">26th</option>
                                                <option value="27">27th</option>
                                                <option value="28">28th</option>
                                                <option value="29">29th</option>
                                                <option value="30">30th</option>
                                                <option value="0">End of month</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="second_pay_days_before">Days before payday</label>
                                            <select name="second_pay_days_before" id="second_pay_days_before" class="form-select nsm-field">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                                <option value="-9">-9</option>
                                                <option value="-8">-8</option>
                                                <option value="-7">-7</option>
                                                <option value="-6">-6</option>
                                                <option value="-5">-5</option>
                                                <option value="-4">-4</option>
                                                <option value="-3">-3</option>
                                                <option value="-2">-2</option>
                                                <option value="-1">-1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="name">Pay schedule name</label>
                                    <input type="text" name="name" id="name" class="form-control nsm-field" value="Every Friday">
                                    <div class="form-check">
                                        <input type="checkbox" name="use_for_new_employees" id="use-for-new-emps" class="form-check-input" value="1" checked>
                                        <label for="use-for-new-emps" class="form-check-label">Use this pay schedule for employees you add after this one</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>