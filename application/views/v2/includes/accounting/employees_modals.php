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
                        <div class="col-12 col-md-6">
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
                                <option value="" disabled>Select Title</option>
                                <?php foreach ($roles as $r) : ?>
                                    <option value="<?= $r->id; ?>"><?= $r->title; ?></option>
                                <?php endforeach; ?>
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
                                    <select class="nsm-field form-select add-emp-payscale" name="empPayscale" required>
                                        <option value="" selected="selected" disabled>Select payscale</option>
                                        <?php foreach ($payscale as $p) : ?>
                                            <option value="<?= $p->id; ?>"><?= $p->payscale_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 add-pay-type-container" style="display:none;">
                                    <label class="content-subtitle fw-bold d-block mb-2 add-payscale-pay-type"></label>
                                    <input class="form-control" name="salary_rate" type="number" step="any" min="0" value="0.00">
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
                        <div class="col-12 col-md-12 mt-5">
                            <label class="content-title" style="display:inline-block;">Commission Settings</label>
                            <a class="nsm-button primary small btn-add-new-commision" href="javascript:void(0);"><i class='bx bx-plus'></i> Add New</a>
                        </div>
                        <div class="col-12 col-md-12">
                            <table class="table" id="commission-settings">
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

<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="bonus-only-form">
    <div id="bonus-payroll-modal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Run Payroll: Bonus Only</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <div class="form-group">
                                <h5>How would you like to enter your bonus amounts?</h5>
                            </div>
                        </div>
                        <div class="col-12 ps-5">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="net-pay" id="bonus_as_net_pay" name="bonus_as">
                                <label class="form-check-label" for="bonus_as_net_pay">
                                    As net pay
                                    <span class="content-subtitle d-none fst-italic">Great! We'll figure out the total pay for you.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12 ps-5">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="gross-pay" id="bonus_as_gross_pay" name="bonus_as" checked>
                                <label class="form-check-label" for="bonus_as_gross_pay">
                                    As gross pay
                                    <span class="content-subtitle d-block fst-italic">Got it! We'll figure out the net pay for you.</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal" id="close-payroll-modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <button class="nsm-button success float-end" type="button" id="continue-bonus-payroll">
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>

<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="commission-only-form">
    <div id="commission-payroll-modal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Run Payroll: Commission Only</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <label for="payFrom">Pay from</label>
                            <select name="pay_from_account" id="bank-account" class="form-select nsm-field" required>
                                <option value="<?=$accounts[array_key_first($accounts)]->id?>" selected><?=$accounts[array_key_first($accounts)]->name?></option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2 d-flex align-items-center">
                            <h6>Balance <?=str_replace('$-', '-$', '$'.number_format(floatval($accounts[array_key_first($accounts)]->balance), 2, '.', ','))?></h6>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="pay-period-start">Pay period start</label>
                            <div class="nsm-field-group calendar">
                                <input type="text" class="form-control nsm-field date" name="pay_period_start" id="pay-period-start" value="<?php echo date('m/d/Y') ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="pay-period-end">Pay period end</label>
                            <div class="nsm-field-group calendar">
                                <input type="text" class="form-control nsm-field date" name="pay_period_end" id="pay-period-end" value="<?php echo date('m/d/Y') ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="payDate">Pay date</label>
                            <div class="nsm-field-group calendar">
                                <input type="text" class="form-control nsm-field date" name="pay_date" id="payDate" value="<?php echo date('m/d/Y') ?>"/>
                            </div>
                        </div>
                        <div class="col text-end">
                            <h6>TOTAL PAY</h6>
                            <h2 class="total-pay"><?=str_replace('$-', '-$', '$'.number_format(array_sum(array_column($employees, 'commission')), 2))?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="nsm-table" id="payroll-table">
                                <thead>
                                    <tr>
                                        <td class="table-icon text-center">
                                            <input class="form-check-input select-all table-select" type="checkbox" checked>
                                        </td>
                                        <td>EMPLOYEE</td>
                                        <td>PAY METHOD</td>
                                        <td class="text-end">COMMISSION</td>
                                        <td>MEMO</td>
                                        <td class="text-end">TOTAL PAY</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($employees as $employee) : ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon table-checkbox">
                                                <input class="form-check-input select-one table-select" type="checkbox" value="<?=$employee['id']?>" checked>
                                            </div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('accounting/employees/view/' . $employee['id']) ?>'"><?=$employee['name']?></td>
                                        <td><?=$employee['pay_method'] === 'Direct deposit' ? 'Direct deposit' : 'Paper check'?></td>
                                        <td class="text-end"><?=str_replace('$-', '-$', '$'.number_format(floatval(str_replace(',', '', $employee['commission'])), 2))?></td>
                                        <td>
                                            <input type="text" name="memo[]" class="form-control nsm-field">
                                        </td>
                                        <td><p class="m-0 text-end"><span class="total-pay"><?=str_replace('$-', '-$', '$'.number_format(floatval(str_replace(',', '', $employee['commission'])), 2))?></span></p></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-end">
                                        <td></td>
                                        <td></td>
                                        <td>TOTAL</td>
                                        <td><?=str_replace('$-', '-$', '$'.number_format(array_sum(array_column($employees, 'commission')), 2))?></td>
                                        <td></td>
                                        <td><?=str_replace('$-', '-$', '$'.number_format(array_sum(array_column($employees, 'commission')), 2))?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div class="nsm-page-buttons page-buttons-container">
                                                <button type="button" class="nsm-button">
                                                    Add an employee
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal" id="close-payroll-modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success" id="preview-payroll">
                                    Preview payroll
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Save for later</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>