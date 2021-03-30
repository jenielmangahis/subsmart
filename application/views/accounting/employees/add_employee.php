<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form action="/accounting/employees/create" method="post" id="modal-form">
<!-- <form onsubmit="submitModalForm(event, this)" id="modal-form"> -->
    <div id="add-employee-modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Add Employee</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Personal info</h4>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="employee_number">Employee number</label>
                                                                <input type="text" name="employee_number" id="employee_number" class="form-control">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="first_name">First name*</label>
                                                                <input type="text" name="first_name" id="first_name" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="last_name">Last name*</label>
                                                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Login Details</h4>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="email">Email <small>(Will be use as your username)</small></label>
                                                                <input type="email" name="email" id="email" class="form-control">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="password-container">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="password">Password</label>
                                                                    <input type="password" name="password" id="password" class="form-control">
                                                                    <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip" data-original-title="Show password"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="confirm_password">Confirm Password</label>
                                                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                                                    <i class="fa fa-eye view-password showConfirmPass" id="" title="" data-toggle="tooltip" data-original-title="Show password"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Other Details</h4>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="address">Address</label>
                                                                <input type="text" name="address" id="address" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="state">State</label>
                                                                <input type="text" name="state" id="state" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="zip_code">Zip Code</label>
                                                                <input type="text" name="zip_code" id="zip_code" class="form-control">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="title">Title</label>
                                                                <select name="title" id="title" class="form-control">

                                                                </select>
                                                            </div>
                                                            <div class="col-md-6"></div>
                                                            <div class="col-md-6">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-switch d-inline-block" style="margin-right: 20px">
                                                                    <label for="">App Access</label><br>
                                                                    <input type="checkbox" name="app_access" class="js-switch" checked />
                                                                </div>
                                                                <div class="input-switch d-inline-block">
                                                                    <label for="">Web Access</label><br>
                                                                    <input type="checkbox" name="web_access" class="js-switch" checked />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Profile Image</h4>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="image">Image</label>
                                                                <div id="employeeProfilePhoto" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                                    <div class="dz-message" style="margin: 20px;border">
                                                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="img_id" id="photoIdAdd">
                                                                <input type="hidden" name="profile_photo" id="photoNameAdd">

                                                                <label for="payscale">Payscale</label>
                                                                <select name="payscale" id="payscale" class="form-control">
                                                                    <option disabled selected>Select payscale</option>
                                                                    <?php foreach ($payscale as $p) : ?>
                                                                        <option value="<?= $p->id; ?>"><?= $p->payscale_name; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="role">Role and Access</label>
                                                                <div class="help help-sm help-block">Select employee role</div>
                                                                <div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="radio" name="user_type" value="1" id="role_1">
                                                                        <label for="role_1"><span>Office Manager</span></label>
                                                                    </div>
                                                                    <div class="help help-sm help-block">
                                                                        ALL except high security file vault<br>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="radio" name="user_type" value="2" id="role_2">
                                                                        <label for="role_2"><span>Partner</span></label>
                                                                    </div>
                                                                    <div class="help help-sm help-block">
                                                                        ALL base on plan type
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="radio" name="user_type" value="3" id="role_3">
                                                                        <label for="role_3"><span>Team Leader</span></label>
                                                                    </div>
                                                                    <div class="help help-sm help-block">
                                                                        No accounting or any changes to company profile or deletion
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="radio" name="user_type" value="4" id="role_4">
                                                                        <label for="role_4"><span>Standard User</span></label>
                                                                    </div>
                                                                    <div class="help help-sm help-block">
                                                                        Can not add or delete employees, can not manage subscriptions
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="radio" name="user_type" value="5" id="role_5">
                                                                        <label for="role_5"><span>Field Sales</span></label>
                                                                    </div>
                                                                    <div class="help help-sm help-block">
                                                                        View only no input
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="checkbox checkbox-sec margin-right">
                                                                        <input type="radio" name="user_type" value="6" id="role_6">
                                                                        <label for="role_6"><span>Field Tech</span></label>
                                                                    </div>
                                                                    <div class="help help-sm help-block">
                                                                        App access only, no Web access
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>What are this employee's employment details?</h4>
                                            <p>Add employee's hire date and where they work.</p>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label for="hire_date" class="col-sm-4 col-form-label">Hire date</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="hire_date" id="hire_date" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>How often do you pay this employee?</h4>
                                            <p>Enter a few details and we'll work out your company's payroll calendar.</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-8">
                                                            <select name="pay_schedule" id="pay-schedule" class="form-control">
                                                                <option disabled selected>&nbsp;</option>
                                                                <option value="add">&plus; Add new</option>
                                                            </select>
                                                        </div>
                                                        <label for="pay-schedule" class="col-sm-4 col-form-label">starting <span></span></label>
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
                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <button type="submit" class="btn btn-success float-right">
                                Done
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