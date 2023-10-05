<div class="modal fade nsm-modal fade" id="edit_employee_modal" tabindex="-1" aria-labelledby="edit_employee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit_employee_form" action="/accounting/employees/update/personal-info/<?=$employee->id?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Employee</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit_employee_container" style="overflow-x: auto;max-height: 800px;">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Basic Details</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                            <input type="text" name="first_name" class="nsm-field form-control" required value="<?= $employee->FName; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                            <input type="text" name="last_name" class="nsm-field form-control" required value="<?= $employee->LName; ?>" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">    
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                            <input type="text" name="mobile" class="nsm-field form-control" value="<?= $employee->mobile; ?>" />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                            <input type="text" name="phone" class="nsm-field form-control" value="<?= $employee->phone; ?>" />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">nSmart App Login Details</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
                            <div class="nsm-field-group icon-right">
                                <input type="email" class="nsm-field form-control" id="employeeEmail" name="email" required value="<?= $employee->email; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Username</label>
                            <div class="nsm-field-group icon-right">
                                <input type="text" class="nsm-field form-control" id="employeeUsername" name="username" required value="<?= $employee->username; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Other Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                            <input type="text" class="nsm-field form-control" name="address" value="<?= $employee->address; ?>">
                        </div>
                        <div class="col-12 col-md-8">
                            <label class="content-subtitle fw-bold d-block mb-2">State</label>
                            <input type="text" class="nsm-field form-control" name="state" value="<?= $employee->state; ?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
                            <input type="text" class="nsm-field form-control" name="postal_code" value="<?= $employee->postal_code; ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Title</label>
                            <select class="nsm-field form-select" name="role" id="employee_role" required>
                                <option value="" disabled>Select Title</option>
                                <?php foreach ($roles as $r) : ?>
                                    <option value="<?= $r->id; ?>" <?= $r->id == $employee->role ? 'selected' : ''; ?>><?= $r->title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                            <select class="nsm-field form-select" name="status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="1" <?= $employee->status == 1 ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?= $employee->status == 0 ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch nsm-switch d-inline-block me-3">
                                <input class="form-check-input" type="checkbox" id="app_access" name="app_access" <?=$employee->has_app_access === 1 ? 'checked' : ''?>>
                                <label class="form-check-label" for="app_access">App Access</label>
                            </div>
                            <div class="form-check form-switch nsm-switch d-inline-block">
                                <input class="form-check-input" type="checkbox" id="web_access" name="web_access" <?=$employee->has_web_access === 1 ? 'checked' : ''?>>
                                <label class="form-check-label" for="web_access">Web Access</label>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3">
                        <div class="col-12 col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="content-title">Profile Picture</label>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-img-upload" style="background-image: url('<?= base_url('/uploads/users/user-profile/'.$employee->profile_img); ?>');">
                                        <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                        <input type="file" name="userfile" class="nsm-upload" accept="image/*">
                                    </div>
                                </div>
                            </div>
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

<div class="modal fade nsm-modal" id="edit-employment-details-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-employment-details-form" action="/accounting/employees/update/employment-details/<?=$employee->id?>">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Employment details</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h3>Let's get down to <?=$employee->FName?>'s job specifics</h3>
                    </div>
                </div>
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="content-title">Basic Details</label>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2" for="employee_number">Employee Number</label>
                                <input type="text" name="employee_number" class="nsm-field form-control" id="employee_number" value="<?= $employee->employee_number ? $employee->employee_number : '-'; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label class="content-title">Employment Details</label>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Hire date</label>
                                <div class="nsm-field-group calendar">
                                    <input type="text" class="form-control nsm-field date" id="hire-date" name="hire_date" value="<?=date("m/d/Y", strtotime($employee->date_hired))?>">
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold d-block mb-2">Pay schedule</label>
                                        <select name="pay_schedule" id="pay-schedule" class="form-select nsm-field">
                                            <option value="add">&plus; Add new</option>
                                            <?php foreach($pay_schedules as $pay_schedule) : ?>
                                                <option value="<?=$pay_schedule->id?>" <?=$pay_details->pay_schedule_id === $pay_schedule->id ? 'selected' : ''?>><?=$pay_schedule->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-end">
                                        <label for="pay-schedule" class="<?=count($pay_schedules) > 0 || count(array_filter($pay_schedules, function($v) { return $v->use_for_new_employees === "1"; })) > 0 ? '' : 'd-none'?>">starting <span><?=$nextPayDate?></span> <a href="#" class="text-decoration-none text-muted" id="edit-pay-schedule"><i class="bx bx-fw bx-pencil"></i></a></label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Work location</label>
                                <select class="nsm-field form-select" id="work-location" name="work_location" required>
                                    <option value="" disabled>Select work location</option>
                                    <option value="add">&plus; Add new</option>
                                    <?php foreach($worksites as $worksite) : ?>
                                        <option value="<?= $worksite->id; ?>" <?= $employmentDetails->work_location_id == $worksite->id ? 'selected="selected"' : ''; ?>><?= $worksite->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Job title</label>
                                <input type="text" class="nsm-field form-control" id="job-title" name="job_title" value="<?=!empty($employmentDetails) ? $employmentDetails->job_title : ''?>">
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Workers' comp class</label>
                                <input type="text" class="nsm-field form-control" id="workers-comp-class" name="workers_comp_class" value="<?=!empty($employmentDetails) ? $employmentDetails->workers_comp_class : ''?>">
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
                                    <input class="form-check-input" type="radio" id="role_7" value="7" name="user_type" <?= $employee->user_type == 7 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_7">
                                        Admin
                                        <span class="content-subtitle d-block fst-italic">ALL Access</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" id="role_1" name="user_type" <?= $employee->user_type == 1 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_1">
                                        Office Manager
                                        <span class="content-subtitle d-block fst-italic">ALL except high security file vault</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="2" id="role_2" name="user_type" <?= $employee->user_type == 2 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_2">
                                        Partner
                                        <span class="content-subtitle d-block fst-italic">ALL base on plan type</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="3" id="role_3" name="user_type" <?= $employee->user_type == 3 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_3">
                                        Team Leader
                                        <span class="content-subtitle d-block fst-italic">No accounting or any changes to company profile or deletion</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="4" id="role_4" name="user_type" <?= $employee->user_type == 4 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_4">
                                        Standard User
                                        <span class="content-subtitle d-block fst-italic">Cannot add or delete employees, can not manage subscriptions</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="5" id="role_5" name="user_type" <?= $employee->user_type == 5 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_5">
                                        Field Sales
                                        <span class="content-subtitle d-block fst-italic">View only no input</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="6" id="role_6" name="user_type" <?= $employee->user_type == 6 ? 'checked="checked"' : ''; ?>>
                                    <label class="form-check-label" for="role_6">
                                        Field Tech
                                        <span class="content-subtitle d-block fst-italic">App access only, no Web access</span>
                                    </label>
                                </div>
                            </div>
                        </div>
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

<div class="modal fade nsm-modal" id="edit-payment-method-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-payment-method-form" action="/accounting/employees/update/payment-method/<?=$employee->id?>">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select payment method</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h3>How would you like to pay <?=$employee->FName?>?</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="payment-method">Payment method</label>
                        <select name="payment_method" id="payment-method" class="form-select nsm-field">
                            <option value="paper-check" <?=$pay_details->pay_method === 'paper-check' ? 'selected' : ''?>>Paper check</option>
                            <option value="direct-deposit" <?=$pay_details->pay_method === 'direct-deposit' ? 'selected' : ''?>>Direct deposit</option>
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

<div class="modal fade nsm-modal" id="edit-pay-types-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-pay-types-form" action="/accounting/employees/update/pay-types/<?=$employee->id?>">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Pay types</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h3>Please select a payscale for <?=$employee->FName?>?</h3>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="content-subtitle fw-bold d-block mb-2">Payscale</label>
                                <select class="nsm-field form-select" name="empPayscale" required>
                                    <option value="" disabled>Select payscale</option>
                                    <?php foreach($payscale as $p) : ?>
                                        <option value="<?= $p->id; ?>" <?= $employee->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 d-none">
                                <label class="content-subtitle fw-bold d-block mb-2">Base Salary</label>
                                <input class="form-control" name="empBaseSalary" type="number" step="any" min="0" value="<?php echo ($user->base_salary) ? $user->base_salary : "0"; ?>">
                            </div>
                            <div class="col-12 base_hourlyrate" style="display: none;">
                                <label class="content-subtitle fw-bold d-block mb-2">Hourly Rate</label>
                                <input class="form-control" name="empBaseHourlyRate" type="number" step="any" min="0" value="<?php echo ($user->base_hourly) ? $user->base_hourly : "0"; ?>">
                            </div>
                            <div class="col-12 base_weeklyrate" style="display: none;">
                                <label class="content-subtitle fw-bold d-block mb-2">Weekly Rate</label>
                                <input class="form-control" name="empBaseWeeklyRate" type="number" step="any" min="0" value="<?php echo ($user->base_weekly) ? $user->base_weekly : "0"; ?>">
                            </div>
                            <div class="col-12 base_monthlyrate" style="display: none;">
                                <label class="content-subtitle fw-bold d-block mb-2">Monthly Rate</label>
                                <input class="form-control" name="empBaseMonthlyRate" type="number" step="any" min="0" value="<?php echo ($user->base_monthly) ? $user->base_monthly : "0"; ?>">
                            </div>
                            <div class="col-12 compensation_baseamount" style="display: none;">
                                <label class="content-subtitle fw-bold d-block mb-2">Base Amount</label>
                                <input class="form-control" name="empCompensationBase" type="number" step="any" min="0" value="<?php echo ($user->compensation_base) ? $user->compensation_base : "0"; ?>">
                            </div>
                            <div class="col-12 compensation_hourlyrate" style="display: none;">
                                <label class="content-subtitle fw-bold d-block mb-2">Hourly Rate</label>
                                <input class="form-control" name="empCompensationHourlyRate" type="number" step="any" min="0" value="<?php echo ($user->compensation_rate) ? $user->compensation_rate : "0"; ?>">
                            </div>
                            <div class="col-12 jobtypebase_install" style="display: none;">
                                <label class="content-subtitle fw-bold d-block mb-2">Amount</label>
                                <input class="form-control" name="empJobTypeBaseInstall" type="number" step="any" min="0" value="<?php echo ($user->jobtypebase_amount) ? $user->jobtypebase_amount : "0"; ?>">
                            </div>
                            <div class="commission-percentage-grp row" style="display:none;">
                                <div class="col">
                                    <label class="content-subtitle fw-bold d-block mb-2">Commission</label>
                                    <select class="nsm-field form-select" name="empCommission" id="empCommission" required>
                                        <option value="" disabled>Select Type</option>
                                        <option value="2" <?php echo $user->commission_id == 2 ? 'selected="selected"' : ''; ?>>None</option>
                                        <option value="0" <?php echo $user->commission_id == 0 ? 'selected="selected"' : ''; ?>>Percentage (Gross, Net)</option>
                                        <option value="1" <?php echo $user->commission_id == 1 ? 'selected="selected"' : ''; ?>>Net + Percentage</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="content-subtitle fw-bold d-block mb-2">&nbsp;</label>
                                    <select class="nsm-field form-select" name="empCommissionPercentage" id="empCommissionPercentage" required>
                                        <option <?php echo $user->commission_percentage == 0 ? 'selected="selected"' : ''; ?> value="0">0%</option>
                                        <option <?php echo $user->commission_percentage == 0.01 ? 'selected="selected"' : ''; ?> value="0.01">1%</option>
                                        <option <?php echo $user->commission_percentage == 0.02 ? 'selected="selected"' : ''; ?> value="0.02">2%</option>
                                        <option <?php echo $user->commission_percentage == 0.03 ? 'selected="selected"' : ''; ?> value="0.03">3%</option>
                                        <option <?php echo $user->commission_percentage == 0.04 ? 'selected="selected"' : ''; ?> value="0.04">4%</option>
                                        <option <?php echo $user->commission_percentage == 0.05 ? 'selected="selected"' : ''; ?> value="0.05">5%</option>
                                        <option <?php echo $user->commission_percentage == 0.06 ? 'selected="selected"' : ''; ?> value="0.06">6%</option>
                                        <option <?php echo $user->commission_percentage == 0.07 ? 'selected="selected"' : ''; ?> value="0.07">7%</option>
                                        <option <?php echo $user->commission_percentage == 0.08 ? 'selected="selected"' : ''; ?> value="0.08">8%</option>
                                        <option <?php echo $user->commission_percentage == 0.09 ? 'selected="selected"' : ''; ?> value="0.09">9%</option>
                                        <option <?php echo $user->commission_percentage == 0.1 ? 'selected="selected"' : ''; ?> value="0.1">10%</option>
                                        <option <?php echo $user->commission_percentage == 0.11 ? 'selected="selected"' : ''; ?> value="0.11">11%</option>
                                        <option <?php echo $user->commission_percentage == 0.12 ? 'selected="selected"' : ''; ?> value="0.12">12%</option>
                                        <option <?php echo $user->commission_percentage == 0.13 ? 'selected="selected"' : ''; ?> value="0.13">13%</option>
                                        <option <?php echo $user->commission_percentage == 0.14 ? 'selected="selected"' : ''; ?> value="0.14">14%</option>
                                        <option <?php echo $user->commission_percentage == 0.15 ? 'selected="selected"' : ''; ?> value="0.15">15%</option>
                                        <option <?php echo $user->commission_percentage == 0.16 ? 'selected="selected"' : ''; ?> value="0.16">16%</option>
                                        <option <?php echo $user->commission_percentage == 0.17 ? 'selected="selected"' : ''; ?> value="0.17">17%</option>
                                        <option <?php echo $user->commission_percentage == 0.18 ? 'selected="selected"' : ''; ?> value="0.18">18%</option>
                                        <option <?php echo $user->commission_percentage == 0.19 ? 'selected="selected"' : ''; ?> value="0.19">19%</option>
                                        <option <?php echo $user->commission_percentage == 0.2 ? 'selected="selected"' : ''; ?> value="0.2">20%</option>
                                        <option <?php echo $user->commission_percentage == 0.25 ? 'selected="selected"' : ''; ?> value="0.25">25%</option>
                                        <option <?php echo $user->commission_percentage == 0.3 ? 'selected="selected"' : ''; ?> value="0.3">30%</option>
                                        <option <?php echo $user->commission_percentage == 0.35 ? 'selected="selected"' : ''; ?> value="0.35">35%</option>
                                        <option <?php echo $user->commission_percentage == 0.4 ? 'selected="selected"' : ''; ?> value="0.4">40%</option>
                                        <option <?php echo $user->commission_percentage == 0.5 ? 'selected="selected"' : ''; ?> value="0.5">50%</option>
                                        <option <?php echo $user->commission_percentage == 0.51 ? 'selected="selected"' : ''; ?> value="0.51">51%</option>
                                        <!-- <option value="0" <?php echo $user->commission_id == 0 ? 'selected="selected"' : ''; ?>>Percentage (Gross, Net)</option> -->
                                        <!-- <option value="1" <?php echo $user->commission_id == 1 ? 'selected="selected"' : ''; ?>>Net + Percentage</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 mt-5">
                        <label class="content-title" style="display:inline-block;">Commission Settings</label>
                        <a class="nsm-button primary small btn-edit-add-new-commision" href="javascript:void(0);"><i class='bx bx-plus'></i> Add New</a>
                    </div>
                    <div class="col-12 col-md-12">
                        <table class="table" id="edit-commission-settings">
                            <thead>
                            <tr>
                                <td style="width: 50%;">Name</td>
                                <td style="width:30%;">Type</td>
                                <td>Value</td>
                                <td style="width:5%;"></td>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
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

<div class="modal fade nsm-modal" id="notes-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <form method="POST" id="edit-notes-form" action="/accounting/employees/update/notes/<?=$employee->id?>">
    <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title content-title">Add notes</span>
            <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <label for="notes">Notes for <?=$employee->FName?></label>
                    <textarea name="notes" id="notes" class="form-control nsm-field"><?=$pay_details->notes?></textarea>
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

<div class="modal fade nsm-modal" id="add-worksite-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <form id="add-worksite-form">
    <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title content-title">Add work location</span>
            <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <label for="name">Name</label>
                    <input type="text" class="form-control nsm-field" id="name" name="name" required>
                </div>
                <div class="col-12">
                    <label for="street">Street</label>
                    <input type="text" class="form-control nsm-field" id="street" name="street" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control nsm-field" id="city" name="city" required>
                </div>
                <div class="col-12 col-md-3">
                    <label for="state">State</label>
                    <input type="text" class="form-control nsm-field" id="state" name="state" required>
                </div>
                <div class="col-12 col-md-3">
                    <label for="zip-code">ZIP code</label>
                    <input type="text" class="form-control nsm-field" id="zip-code" name="zip_code" required>
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