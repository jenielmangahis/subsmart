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
                            <div class="col-12">
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
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Payscale</label>
                                <select class="nsm-field form-select" name="empPayscale" required>
                                    <option value="" disabled>Select payscale</option>
                                    <?php foreach($payscale as $p) : ?>
                                        <option value="<?= $p->id; ?>" <?= $employee->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
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
                        <h3>How much do you want to pay <?=$employee->FName?>?</h3>
                    </div>
                </div>
                <div class="row gy-3">
                    <div class="col-12">
                        <label class="content-title">How much do you pay this employee?</label>
                        <label class="content-subtitle">If your company offers additional pay types, add them here. These pay types show up when you run payroll.</label>
                    </div>
                    <div class="col-12 col-md-4 d-flex align-items-end">
                        <select name="pay_type" id="pay-type" class="form-select nsm-field">
                            <option value="hourly" <?=!empty($pay_details) && $pay_details->pay_type === 'hourly' ? 'selected' : ''?>>Hourly</option>
                            <option value="salary" <?=!empty($pay_details) && $pay_details->pay_type === 'salary' ? 'selected' : ''?>>Salary</option>
                            <option value="commission" <?=!empty($pay_details) && $pay_details->pay_type === 'commission' ? 'selected' : ''?>>Commission only</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-8">
                        <?php if(empty($pay_details) || !empty($pay_details) && $pay_details->pay_type === 'hourly') : ?>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" name="pay_rate" id="pay-rate" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)" value="<?=!empty($pay_details) ? number_format(floatval(str_replace(',', '', $pay_details->pay_rate)), 2) : ''?>">
                            <span class="input-group-text">/hour</span>
                        </div>
                        <?php else : ?>
                        <?php if($pay_details->pay_type === 'salary') : ?>
                        <div class="row">
                            <div class="col">
                                <label for="pay-frequency">Pay frequency</label>
                                <select id="pay-frequency" class="form-select nsm-field" name="pay_frequency">
                                    <option value="per-year">per year</option>
                                    <option value="per-month">per month</option>
                                    <option value="per-week" selected>per week</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="pay-rate">Salary</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="pay_rate" id="pay-rate" class="form-control nsm-field" step=".01" onchange="convertToDecimal(this)" value="<?=number_format(floatval(str_replace(',', '', $pay_details->pay_rate)), 2)?>">
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
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
                    <?php endif; ?>
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

<div class="modal fade nsm-modal fade" id="pay-schedule-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form method="post" id="add-pay-schedule-form">
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
                            <div class="row gy-3">
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
                            <div class="row gy-3 mb-4">
                                <div class="col-12">
                                    <label class="content-title">Upcoming pay periods</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 grid-mb">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <label class="content-subtitle">Pay period</label>
                                                            <p class="m-0 pay-period"><span></span> - <span></span></p>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <label class="content-subtitle">Pay date</label>
                                                            <p class="m-0 pay-date"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 grid-mb">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <label class="content-subtitle">Pay period</label>
                                                            <p class="m-0 pay-period"><span></span> - <span></span></p>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <label class="content-subtitle">Pay date</label>
                                                            <p class="m-0 pay-date"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 grid-mb">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <label class="content-subtitle">Pay period</label>
                                                            <p class="m-0 pay-period"><span></span> - <span></span></p>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <label class="content-subtitle">Pay date</label>
                                                            <p class="m-0 pay-date"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 grid-mb">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <label class="content-subtitle">Pay period</label>
                                                            <p class="m-0 pay-period"><span></span> - <span></span></p>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <label class="content-subtitle">Pay date</label>
                                                            <p class="m-0 pay-date"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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