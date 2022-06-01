<div class="modal fade nsm-modal fade" id="add_employee_modal" tabindex="-1" aria-labelledby="add_employee_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="add_employee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Employee</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
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
                        <div class="col-12">
                            <label class="content-title">Login Details</label>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
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
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" id="edit_employee_container">
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" disabled>Save</button>
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
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
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
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="change_profile_modal" tabindex="-1" aria-labelledby="change_profile_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="change_profile_form">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Change Employee Photo</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="content-title">Profile Picture</label>
                        </div>
                        <div class="col-12">
                            <div class="nsm-img-upload">
                                <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                                <input type="file" name="user_photo" class="nsm-upload" accept="image/*" required>
                                <input type="hidden" name="user_id_prof" id="user_id_prof">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>