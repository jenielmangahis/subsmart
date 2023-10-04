<div class="modal fade nsm-modal fade" id="add_employee_modal" tabindex="-1" aria-labelledby="add_employee_modal_label" aria-hidden="true">
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
                            <label class="content-title">Login Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Email</label>
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
                    <?php //if(isSolarCompany() == 1){ 
                    ?>
                    <!-- <div class="row gy-3 mb-4">
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
                    </div> -->
                    <?php //} 
                    ?>
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-title">Other Details</label>
                        </div>
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                            <input type="text" class="nsm-field form-control" name="address" required>
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="content-subtitle fw-bold d-block mb-2">City</label>
                            <input type="text" class="nsm-field form-control" name="city" required>
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="content-subtitle fw-bold d-block mb-2">State</label>
                            <input type="text" class="nsm-field form-control" name="state" required>
                        </div>
                        <div class="col-12 col-md-2">
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
                    <div class="row gy-3">
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
                                <hr class="mb-0">
                                <!-- <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Total Salary</label>
                                    <span><?php echo ($commission->totalSalary) ? "$" . number_format($commission->totalSalary, 2) : "$0"; ?></span>
                                </div>
                                <div class="col-6">
                                    <label class="content-subtitle fw-bold d-block mb-2">Total Commission</label>
                                    <span><?php echo ($commission->totalCommission) ? "$" . number_format($commission->totalCommission, 2) : "$0"; ?></span>
                                </div> -->
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

                    <div class="row gy-3">
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

                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_employee_modal" tabindex="-1" aria-labelledby="edit_employee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit_employee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Employee</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit_employee_container" style="overflow-x: auto;max-height: 800px;">
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary" disabled>Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_password_modal" tabindex="-1" aria-labelledby="change_password_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="change_password_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Change Password</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3 mb-4">
                        <div class="col-12">
                            <label class="content-subtitle fw-bold d-block mb-2">Employee Name</label>
                            <input type="hidden" name="change_password_user_id" id="changePasswordUserId">
                            <input type="text" class="nsm-field form-control" id="changePasswordEmployeeName" required />
                        </div>
                    </div>
                    <div class="row gy-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">New Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="newPassword" name="new_password" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold d-block mb-2">Retype Password</label>
                            <div class="nsm-field-group show icon-right">
                                <input type="password" class="nsm-field form-control password-field" id="rePassword" name="re_password" required>
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

<div class="modal fade nsm-modal fade" id="change_adt_portal_access_modal" tabindex="-1" aria-labelledby="change_password_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="change-adt-portal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Set ADT Sales Portal Login</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="adt-portal-access-container"></div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="employee_commissions_list_modal" tabindex="-1" aria-labelledby="employee_commissions_list_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Commissions List</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="employee-commissions-list-container"></div>                
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_profile_modal" tabindex="-1" aria-labelledby="change_profile_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="change_profile_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Change Employee Photo</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="content-title">Profile Picture</label>
                        </div>
                        <div class="col-12">
                            <div class="nsm-img-upload" style="background-size: contain;">
                                <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                <input type="file" name="user_photo" class="nsm-upload" accept="image/*" required>
                                <input type="hidden" name="user_id_prof" id="user_id_prof">
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

<script type="text/javascript">
    function setDefaultEmpCommissionValue() {
        let selectedPayscaleOption = $('select[name="empPayscale"]').find('option:selected').text();

        if (selectedPayscaleOption.includes("Base (Hourly Rate)") || selectedPayscaleOption.includes("Base (Weekly Rate)") || selectedPayscaleOption.includes("Base (Monthly Rate)")) {
            $('select[name="empCommission"]').find('option[value="2"]').prop("selected", true);
            $('select[name="empCommissionPercentage"]').val("0");
        } else {
            $('select[name="empCommission"]').val('');
            $('select[name="empCommissionPercentage"]').val('0');
        }
        
    }

    function compensationHideShow() {
        let selectedOption = $('.add-emp-payscale').find('option:selected').text();
        let selectedValue = $('.add-emp-payscale').val();

        if ( selectedValue == 3 ) { //Base Hourly rate
            $('.base_hourlyrate').fadeIn('fast');
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 4 ) { //Base (Weekly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').fadeIn('fast');
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 5 ) { //Base (Monthly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').fadeIn('fast');
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 6 ) { //Compensation (Base Amount)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').fadeIn('fast');
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 7 ) { //Compensation (Hourly Rate)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').fadeIn('fast');
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        } else if ( selectedValue == 8 ) { //Job Type Base(Install/Service)
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').fadeIn('fast');
            $('.commission-percentage-grp').hide();
        } else {
            $('.base_hourlyrate').fadeIn('fast');
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
            $('.commission-percentage-grp').hide();
        }

        /*if (selectedOption.includes("Base (Hourly Rate)")) {
            $('.base_hourlyrate').fadeIn('fast');
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Base (Weekly Rate)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').fadeIn('fast');
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Base (Monthly Rate)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').fadeIn('fast');
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Compensation (Base Amount)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').fadeIn('fast');
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Compensation (Hourly Rate)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').fadeIn('fast');
            $('.jobtypebase_install').hide();
        } else if (selectedOption.includes("Job Type Base(Install/Service)")) {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').fadeIn('fast');
        } else {
            $('.base_hourlyrate').hide();
            $('.base_weeklyrate').hide();
            $('.base_monthlyrate').hide();
            $('.compensation_baseamount').hide();
            $('.compensation_hourlyrate').hide();
            $('.jobtypebase_install').hide();
        }*/
    }
    compensationHideShow();

    $('.add-emp-payscale').change(function() {
        var psid = $(this).val();
        var url  = base_url + 'payscale/_get_details'
        $.ajax({
            type: 'POST',
            url: url,
            data: {psid:psid},
            dataType: "json",
            success: function(result) {
                if( result.pay_type == 'Commission Only' ){
                    $('.add-pay-type-container').hide();
                }else{
                    var rate_label = result.pay_type + ' Rate';
                    $('.add-pay-type-container').show();
                    $('.add-payscale-pay-type').html(rate_label);
                }                
            },
        });
        //compensationHideShow();
        //setDefaultEmpCommissionValue();
    });
</script>