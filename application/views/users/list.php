<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    .btn-success {
        background-color: #46a83d;
    }

    .center {
        text-align: center;
    }

    .img-center {
        horiz-align: center;
        border-radius: 50%;
    }

    .header-title {
        font-size: 22px;
        position: relative;
        top: 5px;
    }

    label>input {
        visibility: initial !important;
        position: initial !important;
    }

    #employeeTable tr>th {
        text-align: center;
    }

    .add-employee {
        float: right;
    }

    #modalAddEmployee .modal-dialog {
        max-width: 800px;
    }

    #modalAddEmployee .modal-content {
        width: 100%;
    }

    #modalAddEmployee .modal-body,
    #modalEditEmployee .modal-body {
        padding: 20px !important;
        max-height: 550px;
        overflow-y: auto;
    }

    #modalAddEmployee .section-title,
    #modalEditEmployee .section-title {
        font-size: 20px;
        font-weight: bold;
        color: grey;
    }

    #modalAddEmployee label,
    #modalEditEmployee label {
        font-weight: bold;
    }

    .view-password {
        position: absolute;
        bottom: 2px;
        right: 15px;
        width: 24px;
        height: 24px;
        cursor: pointer;
    }

    .input-switch {
        display: inline-block;
        margin-right: 20px;
    }

    .check-if-exist,
    #employeeEmail,
    #employeeUsername {
        display: inline;
    }

    .col-md-12.allow_clock_out_map {
        padding: 7px 47px;
    }
    .col-md-12.allow_clock_in_map {
    padding: 7px 47px;
}

    .check-if-exist {
        margin-left: 10px;
    }

    .check-if-exist:hover {
        color: #0b62a4;
    }

    .email-error,
    .username-error {
        visibility: hidden;
        display: block;
        font-style: italic;
        color: red;
    }

    .password-error {
        visibility: hidden;
        position: absolute;
        font-style: italic;
        color: red;
    }

    .profile-container {
        width: 150px;
        height: 150px;
        position: absolute;
        bottom: 0;
        display: none;
    }

    .profile-container img {
        width: 100%;
        height: 100%;
        border-radius: 3%;
        border: 1px solid grey;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .new-password-container,
    .change-password {
        display: none;
    }

    .change-password {
        margin-top: 20px;
        color: #0b97c4;
        font-weight: bold;
    }

    .change-password:hover {
        text-decoration: underline;
        color: grey;
    }

    #shareEmployeeForm {
        float: right;
        margin-right: 10px;
    }

    .section-title {
        background-color: #32243d;
        color: #ffffff !important;
        padding: 10px;
        margin-bottom: 27px;
    }

    .page-title,
    .box-title {
        font-family: Sarabun, sans-serif !important;
        font-size: 1.75rem !important;
        font-weight: 600 !important;
        padding-top: 5px;
    }

    .pr-b10 {
        position: relative;
        bottom: 10px;
    }

    .left {
        float: left;
    }

    .p-40 {
        padding-left: 15px !important;
        padding-top: 40px !important;
    }

    a.btn-primary.btn-md {
        height: 38px;
        display: inline-block;
        border: 0px;
        padding-top: 7px;
        position: relative;
        top: 0px;
    }

    .card.p-20 {
        padding-top: 18px !important;
    }

    .col.col-4.pd-17.left.alert.alert-warning.mt-0.mb-2 {
        position: relative;
        left: 13px;
    }

    .fr-right {
        float: right;
        justify-content: flex-end;
    }

    .p-20 {
        padding-top: 25px !important;
        padding-bottom: 25px !important;
        padding-right: 20px !important;
        padding-left: 20px !important;
    }

    .pd-17 {
        position: relative;
        left: 17px;
    }

    @media only screen and (max-width: 1300px) {
        .card-deck-upgrades div a {
            min-height: 440px;
        }
    }

    @media only screen and (max-width: 1250px) {
        .card-deck-upgrades div a {
            min-height: 480px;
        }

        .card-deck-upgrades div {
            padding: 10px !important;
        }
    }

    @media only screen and (max-width: 600px) {
        .p-40 {
            padding-top: 0px !important;
        }

        .pr-b10 {
            position: relative;
            bottom: 0px;
        }
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="page-title">Employees</h3>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <button class="btn btn-primary btn-md btn-export-list" style="float: right;margin-left: 10px;"><i class="fa fa-upload"></i> Export List</button>
                                <button class="btn btn-primary btn-md add-employee" id="addEmployeeData"><i class="fa fa-user-plus"></i> Add Employee</button>
                                <button class="btn btn-primary btn-md share-add-employee" id="shareEmployeeForm"><i class="fa fa-globe"></i> Share Add Employee</button>
                            </div>
                        </div>
                        <div class="pl-3 pr-3 mt-0 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage Employees.</span>
                            </div>
                        </div>
                        <br />
                        <div class="card-body" style="padding:0px !important;">
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="employeeTable" data-page-length='25' class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Email</th>
                                                <?php if ($show_pass == 1) { ?>
                                                    <th>Password</th>
                                                <?php } ?>
                                                <th>Title</th>
                                                <th>Rights</th>
                                                <th>Last Login</th>
                                                <th>Status</th>
                                                <th>App Access</th>
                                                <th>Web Access</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $cnt => $row) : ?>
                                                <tr>
                                                    <td class="center">
                                                        <?php
                                                        if ($row->profile_img != '') {
                                                            $data_img = $row->profile_img;
                                                        } else {
                                                            $data_img = 'default.png';
                                                        }
                                                        ?>
                                                        <a href="javascript:void(0)" data-id="<?php echo $row->id ?>" id="editEmployeeProfile" title="Change User Photo" data-toggle="tooltip" data-img="<?php echo $data_img; ?>">
                                                            <span>
                                                                <img src="<?php echo userProfileImage($row->id); ?>" width="40" height="40" alt="" class="img-avatar img-center" style="display:inline;" />
                                                                <i class="fa fa-pencil"></i>
                                                            </span>
                                                        </a>
                                                        <div><?php echo $row->FName . ' ' . $row->LName ?></div>
                                                        <div>
                                                            <?php
                                                            if ($row->employee_number) {
                                                                $employee_number = $row->employee_number;
                                                            } else {
                                                                $employee_number = '---';
                                                            }
                                                            ?>
                                                            Employee ID: <?php echo $employee_number; ?>
                                                        </div>
                                                    </td>
                                                    <td class="center"><?php echo $row->email ?></td>
                                                    <?php if ($show_pass == 1) { ?>
                                                        <td class="center pw-row-<?= $row->id; ?>"><?php echo $row->password_plain ?></td>
                                                    <?php } ?>
                                                    <td class="center"><?php echo ($row->role) ? ucfirst($this->roles_model->getById($row->role)->title) : '' ?></td>
                                                    <td class="center"><?php echo getUserType($row->user_type); ?></td>
                                                    <td class="center"><?php echo date('M d,Y', strtotime($row->last_login)); ?></td>
                                                    <td class="center">
                                                        <?php //if (logged('id') !== $row->id): 
                                                        ?>
                                                        <!-- <input type="checkbox" class="js-switch"
                                                               onchange="updateUserStatus('<?php //echo $row->id 
                                                                                            ?>', $(this).is(':checked') )" <?php //echo ($row->status) ? 'checked' : '' 
                                                                                                                            ?> /> -->
                                                        <?php if ($row->status == 1) : ?>
                                                            <span>Active</span>
                                                        <?php else : ?>
                                                            <span>Inactive</span>
                                                        <?php endif; ?>
                                                        <?php //endif 
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <i class="fa fa-lg fa-mobile"></i> -->
                                                        <?php if ($row->has_app_access == 1) { ?>
                                                            <a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Has mobile app access" data-toggle="tooltip"><i class="fa fa-lg fa-check"></i></a>
                                                        <?php } else { ?>
                                                            <a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Has no mobile app access" data-toggle="tooltip"><i class="fa fa-lg fa-close"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <span class="fa fa-lg fa-desktop"></span> -->
                                                        <?php if ($row->has_web_access == 1) { ?>
                                                            <a class="btn btn-sm btn-primary" href="javascript:void(0);" title="Has web app access" data-toggle="tooltip"><i class="fa fa-lg fa-check"></i></a>
                                                        <?php } else { ?>
                                                            <a class="btn btn-sm btn-danger" href="javascript:void(0);" title="Has no web app access" data-toggle="tooltip"><i class="fa fa-lg fa-close"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php //if (hasPermissions('users_edit')){ 
                                                        ?>
                                                        <!-- <a href="<?php echo url('users/edit/' . $row->id); ?>" title="Edit User" data-toggle="tooltip"><i class="fa fa-edit"></i></a> -->
                                                        <?php //} 
                                                        ?>
                                                        <a class="btn btn-sm btn-primary" href="javascript:void(0)" data-id="<?php echo $row->id ?>" id="editEmployee" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                        <a class="btn btn-sm btn-primary" href="javascript:void(0)" data-name="<?php echo $row->FName . ' ' . $row->LName; ?>" data-id="<?php echo $row->id ?>" id="changePassword" title="Change Password" data-toggle="tooltip"><i class="fa fa-lock"></i></a>
                                                        <?php //endif 
                                                        ?>
                                                        <?php //if (hasPermissions('users_view')): 
                                                        ?>
                                                        <a class="btn btn-sm btn-primary" href="<?php echo url('users/view/' . $row->id) ?>" title="View User" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                                        <?php //endif 
                                                        ?>
                                                        <?php //if (hasPermissions('users_delete')): 
                                                        ?>
                                                        <?php if ($row->id != 1 && logged('id') != $row->id) : ?>
                                                            <!-- <a class="btn btn-sm btn-primary" href="<?php echo url('users/delete/' . $row->id) ?>" onclick="return confirm('Do you really want to delete this user ?')" title="Delete User" data-toggle="tooltip"><i class="fa fa-trash"></i></a> -->
                                                            <a class="btn btn-sm btn-primary btn-delete-user" data-id="<?= $row->id; ?>" href="javascript:void(0);" title="Delete User" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                                        <?php else : ?>
                                                            <a class="btn btn-sm btn-primary" href="javascript:void (0)" title="You cannot Delete this User" data-toggle="tooltip" disabled><i class="fa fa-trash"></i></a>
                                                        <?php endif ?>
                                                        <?php //endif 
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<!--Edit Employee modal-->
<div class="modal fade" id="modalEditEmployee">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-pencil"></i> Edit Employee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="editEmployeeForm">
                <div class="modal-body modal-edit-employee"></div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="closeEditEmployeeModal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="updateEmployee">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!--Change Employee Profile modal-->
<div class="modal fade" id="modalEditEmployeeProfile">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-image"></i> Change Employee Photo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="editEmployeeProfileForm">
                <div class="modal-body modal-edit-employee-profile" style="padding-bottom: 0px;">
                    <div class="form-group" style="margin-bottom: 0px !important;">
                        <div class="row">
                            <div class="col-md-12">
                                <img style="margin:0 auto; height: 300px;" id="img_profile" src="">
                                <div class="margin-bottom" style="text-align: center;margin-top: 10px;">
                                    <input type="file" class="form-control" style="margin-left: 77px; width: auto;" name="user_photo" id="upload-employee-photo" placeholder="Upload Image" accept="image/*" required="">
                                </div>
                                <input type="hidden" name="user_id_prof" id="user_id_prof">
                                <input type="hidden" name="img_id" id="photoId">
                                <input type="hidden" name="profile_img" id="photoName">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="closeEditEmployeeModalProfilePhoto">Close</button>
                    <button type="button" class="btn btn-primary" id="updateEmployeeProfilePhoto">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!--Change Password modal-->
<div class="modal fade" id="modalChangePassword">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-lock"></i> Change Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="changePasswordForm">
                <input type="hidden" name="change_password_user_id" id="changePasswordUserId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Employee Name</label>
                            <input type="text" id="changePasswordEmployeeName" class="form-control" readonly="" disabled="">
                        </div>
                    </div>
                    <br />
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">New Password</label>
                            <input type="password" name="new_password" id="newPassword" required="" class="form-control">
                            <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                            <span class="old-password-error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="">Retype Password</label>
                            <input type="password" name="re_password" id="rePassword" required="" class="form-control">
                            <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="closedChangePasswordModal">Close</button>
                    <button type="button" class="btn btn-primary" id="updatePassword">Save & exit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!--Adding Employee modal-->
<div class="modal fade" id="modalAddEmployee">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Add Employee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="" id="addEmployeeForm">
                <input type="hidden" name="user_id" id="userID">
                <div class="modal-body">
                    <div class="section-title" style="">Basic Details</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Employee Number</label>
                                <input type="text" name="emp_number" class="form-control" id="emp_number" placeholder="Enter Employee Number">
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="">Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="section-title">Login Details</div>
                    <div class="form-group">
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <label for="" style="display: block">Email</label>
                                <input type="text" name="email" class="form-control" id="employeeEmail" placeholder="e.g: email@mail.com" style="width: 90%">
                                <i class="fa fa-sync-alt check-if-exist" title="Check if Email is already exist" data-toggle="tooltip"></i>
                                <span class="email-error"></span>
                            </div> -->
                            <div class="col-md-7">
                                <label for="" style="display: block">Email <small>(Will be use as your username)</small></label>
                                <input type="email" name="username" class="form-control" id="employeeUsername" placeholder="e.g: nsmartrac" style="width: 90%">
                                <i class="fa fa-sync-alt check-if-exist" title="Check if Username already exist" data-toggle="tooltip"></i>
                                <span class="username-error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="password-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Password</label>
                                    <input type="password" name="addnew_password" id="employeePass" class="form-control">
                                    <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                                    <span class="password-error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="employeeConfirmPass" class="form-control">
                                    <i class="fa fa-eye view-password showConfirmPass" id="" title="Show password" data-toggle="tooltip"></i>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void (0)" class="change-password" id="changePassword">Want to change password?</a>
                        <div class="new-password-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Old Password</label>
                                    <input type="password" name="password" id="oldPassword" class="form-control">
                                    <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                                    <span class="old-password-error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">New Password</label>
                                    <input type="password" name="password" id="newPassword" class="form-control">
                                    <i class="fa fa-eye view-password showPass" id="" title="Show password" data-toggle="tooltip"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-title">Other Details</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">State</label>
                                <input type="text" name="state" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Zip Code</label>
                                <input type="text" name="postal_code" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Title</label>
                                <select name="role" id="employeeRole" class="form-control select2-role"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-switch">
                                    <label for="">App Access</label><br>
                                    <input type="checkbox" name="app_access" class="js-switch" checked />
                                </div>
                                <div class="input-switch">
                                    <label for="">Web Access</label><br>
                                    <input type="checkbox" name="web_access" class="js-switch" checked />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-title">Profile Image</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Image</label>
                                <div id="employeeProfilePhoto" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                    <div class="dz-message" style="margin: 20px;">
                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                    </div>
                                </div>
                                <input type="hidden" name="img_id" id="photoIdAdd">
                                <input type="hidden" name="profile_photo" id="photoNameAdd">

                                <div>
                                    <label for="">Payscale</label>
                                    <select name="empPayscale" id="empPayscale" class="form-control select2-payscale">
                                        <option value="">Select payscale</option>
                                        <?php foreach ($payscale as $p) { ?>
                                            <option value="<?= $p->id; ?>"><?= $p->payscale_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-container">
                                    <img src="/uploads/users/default.png" alt="Profile photo">
                                </div>
                                <label>Rights and Permissions</label>
                                <div class="help help-sm help-block">Select employee role</div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="user_type" value="7" id="role_7">
                                        <label for="role_7"><span>Admin</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        ALL Access<br>
                                    </div>
                                </div>
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
                                        Cannot add or delete employees, can not manage subscriptions
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
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="closedEmployeeModal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="savedNewEmployee">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!--Delete User modal-->
<div class="modal fade" id="modalDeleteUser">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i> Delete User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="eid" value="">
                <p>Are you sure you want to delete selected user?</p>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="btn-modal-delete-user">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalShareAddEmployee">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-globe"></i> Public URL</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <p>You public URL for adding employees</p>
                <div class="copy-info"></div>
                <input type="hidden" id="e-public-url" value="<?php echo base_url('/add_company_employee/' . $eid); ?>">
                <label class="label label-default label-public-url" style="padding: 10px;font-size:15px;width: 88%; color: #ffffff;"><?php echo base_url('/add_company_employee/' . $eid); ?></label><a class="btn-copy-public-url" href="javascript:void(0);" style="padding: 10px;"><i class="fa fa-copy"></i></a>
            </div>
        </div>
    </div>
</div>


<div id="manage_timsheet_clockin_clockout_gps_html_setter" style="display: none;">
    <div class="section-title">Manage Clock In & Clock Out Location</div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="custom-control custom-switch">

                                    <input type="checkbox" value=0 class="custom-control-input allow_clock_in" id="allow_clock_in_input" name="allow_clock_in_toggle_btn">
                                    <label class="custom-control-label allow_clock_in disabled" for="allow_clock_in_input"> <span id="status_clock_in">Enable</span> User <b>GPS Clock In</b> </label>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 allow_clock_in_map" style="display:none;">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Set Clock In Location</label>
                                <div class="form-group">
                                    <label for="">Enter an address or drag the map to find your place</label>
                                    <input id="clock_in_formatted_address" type="text" name="clock_in_formatted_address" class="form-control ts-start-date" value="" required>
                                    <input type="text" name="clock_in_location_latitude" id="allow_clock_in_lat" style="display:none">
                                    <input type="text" name="clock_in_location_longtitude" id="allow_clock_in_lng" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="form-group map-canva" style="position: relative;">
                            <div class="clock_in_address_radius_container">
                                <label class="clock_in_radius_number_view">250 ft zone</label>
                                <input type="range" class="form-range" name="clock_in_radius_field" min="76.2" max="3218.688" step="0.001" id="clock_in_address_radius" value="76.2">
                                <!-- <input type="text" name="clock_in_radius_field" style="display:none;"> -->
                            </div>
                            <div id="clock_in_address_map" class="clock_in_address_map" style="height:400px;width:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="custom-control custom-switch">

                                    <input type="checkbox" value=0 class="custom-control-input allow_clock_in" id="allow_clock_out_input" name="allow_clock_out_toggle_btn">
                                    <label class="custom-control-label allow_clock_in disabled" for="allow_clock_out_input"> <span id="status_clock_out">Enable</span> User <b>GPS Clock Out</b> </label>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 allow_clock_out_map" style="display:none;">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Set Clock Out Location</label>
                                <div class="form-group">
                                    <label for="">Enter an address or drag the map to find your place</label>
                                    <input id="clock_out_formatted_address" type="text" name="clock_out_formatted_address" class="form-control ts-start-date" value="" required>
                                    <input type="text" name="clock_out_location_latitude" id="allow_clock_out_lat" style="display:none">
                                    <input type="text" name="clock_out_location_longtitude" id="allow_clock_out_lng" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="form-group map-canva" style="position: relative;">
                            <div class="clock_out_address_radius_container">
                                <label class="clock_out_radius_number_view">250 ft zone</label>
                                <input type="range" name="clock_out_radius_field" class="form-range" min="76.2" max="3218.688" step="0.001" id="clock_out_address_radius" value="76.2">
                                <!-- <input type="text" name="clock_out_radius_field" style="display:none;"> -->
                            </div>
                            <div id="clock_out_address_map" class="clock_out_address_map" style="height:400px;width:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end of modal-->
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function() {
        $('#employeeTable').DataTable({
            "searching": true,
            "sort": false
        });

        $(".btn-export-list").click(function() {
            window.location.href = base_url + 'users/export_list';
        });

        $("#shareEmployeeForm").click(function() {
            $("#modalShareAddEmployee").modal("show");
        });

        $(".btn-copy-public-url").click(function() {
            var copyText = document.getElementById("e-public-url");
            copyText.type = 'text';
            copyText.select();
            document.execCommand("copy");
            copyText.type = 'hidden';

            $(".label-public-url").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
        });

        $(document).on('change', '#upload-employee-photo', function(e) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('img_profile');
                output.src = reader.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        });

        $("#btn-modal-delete-user").click(function() {
            var eid = $("#eid").val();
            $.ajax({
                url: base_url + 'users/_delete_user',
                type: "POST",
                dataType: "json",
                data: {
                    eid: eid
                },
                success: function(data) {
                    if (data.is_success) {
                        $("#modalDeleteUser").modal('hide');
                        Swal.fire({
                            title: 'Success',
                            text: "User was successfully deleted.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            text: data.msg,
                            icon: 'warning'
                        });
                    }
                }
            });
        });

        $(document).on('click', '.btn-delete-user', function() {
            var eid = $(this).attr("data-id");
            $("#eid").val(eid);
            $("#modalDeleteUser").modal('show');
        });

        $(document).on('click', '#addEmployeeData', function() {
            $('#modalAddEmployee').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $(document).on('click', '#editEmployeeProfile', function() {
            var data_img = $(this).attr('data-img');
            if (data_img == 'default.png') {
                var default_img = base_url + 'uploads/users/' + data_img;
            } else {
                var default_img = base_url + 'uploads/users/user-profile/' + data_img;
            }

            $("#img_profile").attr("src", default_img);

            $('#modalEditEmployeeProfile').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $('.showPass').click(function() {
            $(this).toggleClass('fa-eye-slash');
            if ($(this).prev('input[type="password"]').length == 1) {
                $(this).prev('input[type="password"]').attr('type', 'text');
                $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
            } else {
                $(this).prev('input[type="text"]').attr('type', 'password');
                $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
            }
        });
        $('.showConfirmPass').click(function() {
            $(this).toggleClass('fa-eye-slash');
            if ($(this).prev('input[type="password"]').length == 1) {
                $(this).prev('input[type="password"]').attr('type', 'text');
                $(this).attr('title', 'Hide password').attr('data-original-title', 'Hide password').tooltip('update').tooltip('show');
            } else {
                $(this).prev('input[type="text"]').attr('type', 'password');
                $(this).attr('title', 'Show password').attr('data-original-title', 'Show password').tooltip('update').tooltip('show');
            }
        });

        // Switch button
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
            var switchery = new Switchery(html, {
                size: 'small'
            });
        });
        //Select2 initialization
        $('.select2-role').select2({
            placeholder: 'Select Title',
            allowClear: true,
            width: 'resolve',
            delay: 250,
            ajax: {
                url: 'users/getRoles',
                type: "GET",
                dataType: "json",
                data: function(params) {
                    var query = {
                        search: params.term
                    };
                    return query;
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $('.select2-payscale').select2({
            placeholder: 'Select Payscale',
            allowClear: true,
            width: 'resolve'
        });
        $(document).on('change', '#employeeEmail', function() {
            var email = $(this).val();
            var selected = this;
            var status = $(this).next('i');
            if (!validateEmail(email)) {
                $(this).css('border-color', 'red');
                $('.email-error').text('*Email format invalid').css('visibility', 'visible');
            } else {
                $(this).css('border-color', '#e0e0e0');
                $('.email-error').css('visibility', 'hidden');
                $.ajax({
                    url: base_url + "users/checkEmailExist",
                    type: "GET",
                    data: {
                        email: email
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data > 0) {
                            $(selected).css('border-color', 'red');
                            status.removeClass('fa-sync-alt').addClass('fa-times-circle').css('color', 'red');
                            status.attr('title', 'Input another email').attr('data-original-title', 'Input another email').tooltip('update').tooltip('show');
                            $('.email-error').text('*Email already exist').css('visibility', 'visible');
                        } else {
                            $(selected).css('border-color', '#e0e0e0');
                            status.removeClass('fa-sync-alt').removeClass('fa-times-circle').addClass('fa-check').css('color', 'greenyellow');
                            status.attr('title', 'Email is unique. Ready to go.').attr('data-original-title', 'Email is unique. Ready to go.').tooltip('update').tooltip('show');
                            $('.email-error').css('visibility', 'hidden');
                        }
                    }
                });
            }
        });

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }

        $(document).on('change', '#employeeUsername', function() {
            var username = $(this).val();
            var selected = this;
            var status = $(this).next('i');
            $.ajax({
                url: base_url + "users/checkUsername",
                type: "GET",
                dataType: 'json',
                data: {
                    username: username
                },
                success: function(data) {
                    if (data > 0) {
                        $(selected).css('border-color', 'red');
                        status.removeClass('fa-sync-alt').addClass('fa-times-circle').css('color', 'red');
                        status.attr('title', 'Input another username').attr('data-original-title', 'Input another username').tooltip('update').tooltip('show');
                        $('.username-error').text('*Username already exist').css('visibility', 'visible');
                    } else {
                        $(selected).css('border-color', '#e0e0e0');
                        status.removeClass('fa-sync-alt').removeClass('fa-times-circle').addClass('fa-check').css('color', 'greenyellow');
                        status.attr('title', 'Username is unique. Ready to go.').attr('data-original-title', 'Username is unique. Ready to go.').tooltip('update').tooltip('show');
                        $('.username-error').css('visibility', 'hidden');
                    }
                }
            });

        });
        // Password and Confirm Password Validation
        $(document).on('change', '#employeeConfirmPass', function() {
            var con_pass = $(this).val();
            var pass = $('#employeePass').val();
            if (con_pass != pass) {
                $('.password-error').text('*Password field and Confirm password does not match.').css('visibility', 'visible');
                $(this).css('border-color', 'red');
                $('#employeePass').css('border-color', 'red');
            } else {
                $('.password-error').css('visibility', 'hidden');
                $(this).css('border-color', '#e0e0e0');
                $('#employeePass').css('border-color', '#e0e0e0');
            }
        });
        $(document).on('click', '#closedEmployeeModal', function() {
            $('#employeeProfilePhoto').next().next($('.dz-preview').remove());
            $('#employeeProfilePhoto').next($('.dz-message').css({
                "display": "inherit"
            }));
            var image_id = $('#photoId').val();
            var image = $('#photoName').val();
            $.ajax({
                url: base_url + 'users/removeTemporaryImg',
                type: 'POST',
                dataType: 'json',
                data: {
                    image_id: image_id,
                    image: image
                },
                success: function(data) {

                }
            });
            $('#addEmployeeForm')[0].reset();
            if ($('.check-if-exist').hasClass('fa-check') == true || $('.check-if-exist').hasClass('fa-times-circle') == true) {
                $('.check-if-exist').removeClass('fa-check').removeClass('fa-times-circle').addClass('fa-sync-alt').css('color', '#111111');
                $('.username-error').css('visibility', 'hidden');
                $('.email-error').css('visibility', 'hidden');
                $('#employeeUsername').css('border-color', '#e0e0e0');
                $('#employeeEmail').css('border-color', '#e0e0e0');
            }
            $(".select2-role").select2('val', 'All');
            $("#modalAddEmployee").modal('hide');
        });
        $(document).on('click', '#savedNewEmployee', function() {
            let values = {};
            $.each($('#addEmployeeForm').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            if (values['addnew_password'] != '') {
                values['password'] = values['addnew_password'];
            }
            //if(values['firstname'] && values['lastname'] && values['email'] && values['username'] && values['password'] && values['role']){
            if (values['firstname'] && values['lastname'] && values['username'] && values['password'] && values['role']) {
                $.ajax({
                    url: base_url + 'users/addNewEmployee',
                    type: "POST",
                    dataType: "json",
                    data: {
                        values: values
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#modalAddEmployee").modal('hide');
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "New Employee has been Added",
                                icon: 'success'
                            });
                            location.reload();
                        } else if (data == 3) {
                            Swal.fire({
                                title: 'Failed',
                                text: 'Insufficient license. Please purchase license to continue adding user',
                                icon: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#32243d',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Purchase License'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = base_url + 'mycrm/membership';
                                }
                            });
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Failed',
                                text: "Something is wrong in the process",
                                icon: 'warning'
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: 'Failed',
                    text: "Something is wrong in the process",
                    icon: 'warning'
                });
            }
        });
        $(document).on('click', '#updateEmployee', function() {


            Swal.fire({
                title: "Save?",
                html: "Are your sure you want to save this changes? ",
                imageUrl: baseURL + "/assets/img/trac360/map_with_marker1.png",
                showCancelButton: true,
                confirmButtonColor: "#2ca01c",
                cancelButtonColor: "#d33",
                confirmButtonText: "Save changes",
            }).then((result) => {
                if (result.value) {
                    ////saving the map long-lat

                    var center = clock_in_address_map.getCenter();
                    $("#allow_clock_in_lat").val(center.lat());
                    $("#allow_clock_in_lng").val(center.lng());

                    center = clock_out_address_map.getCenter();
                    $("#allow_clock_out_lat").val(center.lat());
                    $("#allow_clock_out_lng").val(center.lng());
                    ///end saving map

                    let values = {};
                    $.each($('#editEmployeeForm').serializeArray(), function(i, field) {
                        values[field.name] = field.value;
                    });
                    if (values['firstname'] && values['lastname'] && values['email'] && values['username'] && values['role']) {
                        $.ajax({
                            url: base_url + 'users/_update_employee',
                            type: "POST",
                            dataType: "json",
                            data: {
                                values: values
                            },
                            success: function(data) {
                                if (data == 1) {
                                    $("#modalEditEmployee").modal('hide');
                                    Swal.fire({
                                        title: 'Success',
                                        text: "Employee record has been Updated.",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#32243d',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.value) {
                                            // location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        showConfirmButton: false,
                                        timer: 2000,
                                        title: 'Failed',
                                        text: "Something is wrong in the process",
                                        icon: 'warning'
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            text: "Something is wrong in the process",
                            icon: 'warning'
                        });
                    }
                }
            });
        });

        $(document).on('click', '#updateEmployeeProfilePhoto', function() {
            var formData = new FormData($("#editEmployeeProfileForm")[0]);
            $.ajax({
                url: base_url + 'users/ajaxUpdateEmployeeProfilePhoto',
                type: "POST",
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(data) {
                    if (data == 1) {
                        $("#modalEditEmployeeProfile").modal('hide');
                        Swal.fire({
                            title: 'Success',
                            text: "Employee photo has been Updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            text: "Please select a valid image",
                            icon: 'warning'
                        });
                    }
                }
            });
        });

        $(document).on('click', '#updatePassword', function() {
            let values = {};
            $.each($('#changePasswordForm').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            if (values['new_password'] && values['re_password']) {
                $.ajax({
                    url: base_url + 'users/_update_employee_password',
                    type: "POST",
                    dataType: "json",
                    data: {
                        values: values
                    },
                    success: function(data) {
                        if (data.is_success) {
                            $("#modalChangePassword").modal('hide');
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "Employee password has been Updated",
                                icon: 'success'
                            });

                            $(".pw-row-" + $("#changePasswordUserId").val()).html(values['new_password']);
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Failed',
                                text: data.msg,
                                icon: 'warning'
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: 'Failed',
                    text: "Please fillup form entries",
                    icon: 'warning'
                });
            }
        });

        $(document).on('click', '#editEmployee', function() {
            var user_id = $(this).attr('data-id');
            $(".modal-edit-employee").html('<span class="spinner-border spinner-border-sm m-0"></span>  Loading');
            $('#modalEditEmployee').modal({
                backdrop: 'static',
                keyboard: false
            });
            $.ajax({
                url: base_url + "users/ajax_edit_employee",
                type: "POST",
                dataType: "html",
                data: {
                    user_id: user_id
                },
                success: function(data) {
                    if ($(" #manage_timsheet_clockin_clockout_gps_html_setter").html() == "") {
                        $("#manage_timsheet_clockin_clockout_gps_html_setter").html($(".modal-edit-employee #manage_timsheet_clockin_clockout_gps").html());
                        $(".modal-edit-employee #manage_timsheet_clockin_clockout_gps").html("");
                    }
                    $(".modal-edit-employee").html(data);
                    $(".modal-edit-employee #manage_timsheet_clockin_clockout_gps").html($("#manage_timsheet_clockin_clockout_gps_html_setter").html());
                    $("#manage_timsheet_clockin_clockout_gps_html_setter").html("");

                    initMap();
                    $.ajax({
                        url: base_url + 'users/getData_for_clock_in_out_location',
                        type: "POST",
                        dataType: "json",
                        data: {
                            user_id: $("#editUserID").val()
                        },
                        success: function(data) {
                            if (data.cLocation > 0) {
                                if (data.allow_gps_clock_in > 0) {
                                    $('#allow_clock_in_input').prop('checked', true);
                                } else {
                                    $('#allow_clock_in_input').prop('checked', false);
                                }
                                if (data.allow_gps_clock_out > 0) {
                                    $('#allow_clock_out_input').prop('checked', true);
                                } else {
                                    $('#allow_clock_out_input').prop('checked', false);
                                }

                            } else {
                                $('#allow_clock_in_input').prop('checked', false);
                                $('#allow_clock_out_input').prop('checked', false);
                            }


                            toogle_btn_gps_clock("#allow_clock_in_input", ".allow_clock_in_map");
                            toogle_btn_gps_clock("#allow_clock_out_input", ".allow_clock_out_map");
                        }
                    });
                }
            });
        });

        $(document).on('click', '#editEmployeeProfile', function() {
            var user_id = $(this).attr('data-id');
            $('#user_id_prof').val(user_id);
        });

        $(document).on('click', '#closeEditEmployeeModal', function() {
            if ($("#manage_timsheet_clockin_clockout_gps_html_setter").html() == "") {
                $("#manage_timsheet_clockin_clockout_gps_html_setter").html($(".modal-edit-employee #manage_timsheet_clockin_clockout_gps").html());
                $(".modal-edit-employee #manage_timsheet_clockin_clockout_gps").html("");
            }

            $("#modalEditEmployee").modal('hide');
        });

        $(document).on('click', '#closeEditEmployeeModalProfilePhoto', function() {
            $("#modalEditEmployeeProfile").modal('hide');
        });

        $(document).on('click', '#closedChangePasswordModal', function() {
            $("#modalChangePassword").modal('hide');
        });

        $(document).on('click', '#changePassword', function() {
            var user_id = $(this).attr('data-id');
            var employee_name = $(this).attr('data-name');
            $("#changePasswordUserId").val(user_id);
            $("#changePasswordEmployeeName").val(employee_name);
            $("#modalChangePassword").modal('show');
        });

        /*Old Edit*/
        /*$(document).on('click','#editEmployee',function () {
            var user_id = $(this).attr('data-id');
            $('#modalAddEmployee').modal({backdrop: 'static', keyboard: false});
            var form = $('#modalAddEmployee').find('form');
            $.ajax({
                url: base_url + "users/getEmployeeData",
                type:"GET",
                dataType:'json',
                data:{user_id:user_id},
                success:function (data) {
                    form.find($('input[name="firstname"]')).val(data.fname);
                    form.find($('input[name="lastname"]')).val(data.lname);
                    form.find($('input[name="email"]')).val(data.email);
                    form.find($('input[name="username"]')).val(data.username);
                    form.find($('input[name="status"]')).val(data.status);
                    $('div.password-container').hide();
                    $('#changePassword').show();
                    $("#employeeRole option[value='" + data.role_id +"']").attr('selected',true);
                    $('#employeeRole').next($('#select2-employeeRole-container').attr('title',data.role).html(data.role));
                }
            });
        });*/
    });
    /*$('#changePassword').click(function () {
        $('div.new-password-container').toggle();
        var text =  $(this).text();
        $(this).text(text == "Want to change password?" ? "I changed my mind. Maybe later." : "Want to change password?").css('color','#0b97c4');
    });*/
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        var fname = [];
        var selected = [];
        var profilePhoto = new Dropzone('#employeeProfilePhoto', {
            url: '<?= base_url() ?>users/profilePhoto',
            acceptedFiles: "image/*",
            maxFilesize: 20,
            maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var file_name = JSON.parse(response)['photo'];
                    fname.push(file_name.replace(/\"/g, ""));
                    selected.push(file);
                    $('#photoIdAdd').val(JSON.parse(response)['id']);
                    $('#photoNameAdd').val(JSON.parse(response)['photo']);
                });
            },
            removedfile: function(file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];
                $.ajax({
                    type: "POST",
                    url: base_url + 'users/removeProfilePhoto',
                    dataType: 'json',
                    data: {
                        name: name,
                        index: index
                    },
                    success: function(data) {
                        if (data == 1) {
                            $('#photoId').val(null);
                        }
                    }
                });
                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

        var profilePhoto = new Dropzone('#employeeProfilePhotoUpdate', {
            url: base_url + 'users/profilePhoto',
            acceptedFiles: "image/*",
            maxFilesize: 20,
            maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var file_name = JSON.parse(response)['photo'];
                    fname.push(file_name.replace(/\"/g, ""));
                    selected.push(file);
                    $('#photoId').val(JSON.parse(response)['id']);
                    $('#photoName').val(JSON.parse(response)['photo']);
                });
            },
            removedfile: function(file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];
                $.ajax({
                    type: "POST",
                    url: base_url + 'users/removeProfilePhoto',
                    dataType: 'json',
                    data: {
                        name: name,
                        index: index
                    },
                    success: function(data) {
                        if (data == 1) {
                            $('#photoId').val(null);
                        }
                    }
                });
                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });
    });


    var user_id = 0;
    var map;
    var clock_in_address_map;
    var new_map_marker;
    var antennasCircle_main_map;
    var main_map_marker;

    var antennasCircle_clock_out_map;
    var clock_out_address_map;
    var edit_lat;
    var edit_lng;
    var radius_clock_out_address = 76.2;
    var edit_created_by;

    var current_lat = 0;
    var current_lng = 0;

    var clock_in_map_lat;
    var clock_in_map_lng;
    var clock_out_map_lat;
    var clock_out_map_lng;

    var antennasCircle_clock_in_map;
    var radius_clock_in_address = 76.2;
    var current_notify_settings;


    function initMap() {
        if (antennasCircle_clock_in_map != null) {
            antennasCircle_clock_in_map.setMap(null);
            clock_in_address_map.fitBounds(antennasCircle_clock_in_map.getBounds());
        }
        if (antennasCircle_clock_out_map != null) {
            antennasCircle_clock_out_map.setMap(null);
            clock_out_address_map.fitBounds(antennasCircle_clock_out_map.getBounds());
        }
        get_current_user_location();
    }

    function get_current_user_location() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(show_current_user_position);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function show_current_user_position(position) {

        current_lat = position.coords.latitude;
        current_lng = position.coords.longitude;
        get_employee_map_coords();
    }

    function get_employee_map_coords() {
        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        $("#map-loader").hide();
        $("#map-holder").show();
        clock_in_map_lat = current_lat;
        clock_in_map_lng = current_lng;
        clock_out_map_lat = current_lat;
        clock_out_map_lng = current_lng;

        $.ajax({
            url: base_url + 'users/getData_for_clock_in_out_location',
            type: "POST",
            dataType: "json",
            data: {
                user_id: $("#editUserID").val()
            },
            success: function(data) {
                if (data.cLocation > 0) {
                    if (data.allow_gps_clock_in > 0) {
                        $('#allow_clock_in_input').prop('checked', true);
                        $('#allow_clock_in_input').val(1);
                        $('#status_clock_in').html('Disable');
                        clock_in_map_lat = data.clock_in_latitude;
                        clock_in_map_lng = data.clock_in_longtitude;
                        radius_clock_in_address = data.clock_in_radius;
                        $("#clock_in_address_radius").val(radius_clock_in_address);
                        $(".clock_in_radius_number_view").html(parseInt($("#clock_in_address_radius").val() * 3.28084, 10) + " ft zone");

                        $("#clock_in_formatted_address").val(data.clock_in_address);
                    }
                    if (data.allow_gps_clock_out > 0) {
                        $('#allow_clock_out_input').prop('checked', true);
                        $('#allow_clock_out_input').val(1);
                        $('#status_clock_out').html('Disable');
                        clock_out_map_lat = data.clock_out_latitude;
                        clock_out_map_lng = data.clock_out_longtitude;
                        radius_clock_out_address = data.clock_out_radius;
                        $("#clock_out_address_radius").val(radius_clock_out_address);
                        $(".clock_out_radius_number_view").html(parseInt($("#clock_out_address_radius").val() * 3.28084, 10) + " ft zone");

                        $("#clock_out_formatted_address").val(data.clock_out_address);
                    }
                }


                toogle_btn_gps_clock("#allow_clock_in_input", ".allow_clock_in_map");
                toogle_btn_gps_clock("#allow_clock_out_input", ".allow_clock_out_map");

                initMap_clock_in_out_address_map();
            }
        });
    }


    function initMap_clock_in_out_address_map() {

        console.log("after success");
        clock_in_address_map = new google.maps.Map(document.getElementById("clock_in_address_map"), {
            center: {
                lat: clock_in_map_lat,
                lng: clock_in_map_lng
            },
            zoom: 18,
            mapTypeControlOptions: {
                mapTypeIds: [
                    "roadmap",
                    "satellite",
                    "hybrid",
                    "terrain",
                    "styled_map",
                ],
            },
            mapTypeControl: false,
            overviewMapControl: false,
            zoomControl: true,
            draggable: true,
            fullscreenControl: false,
            streetViewControl: false,
        });
        clock_out_address_map = new google.maps.Map(document.getElementById("clock_out_address_map"), {
            center: {
                lat: clock_out_map_lat,
                lng: clock_out_map_lng
            },
            zoom: 18,
            mapTypeControlOptions: {
                mapTypeIds: [
                    "roadmap",
                    "satellite",
                    "hybrid",
                    "terrain",
                    "styled_map",
                ],
            },
            mapTypeControl: false,
            overviewMapControl: false,
            zoomControl: true,
            draggable: true,
            fullscreenControl: false,
            streetViewControl: false,
        });
        var center = clock_in_address_map.getCenter();
        setMapCenter("clock_in", center.lat(), center.lng());

        center = clock_out_address_map.getCenter();
        setMapCenter("clock_out", center.lat(), center.lng());

        google.maps.event.addListener(clock_in_address_map, 'dragend', function() {
            $("#clock_in_formatted_address").val("Loading address...");
            clock_in_address_map_changed();
        });
        google.maps.event.addListener(clock_out_address_map, 'dragend', function() {
            $("#clock_out_formatted_address").val("Loading address...");
            clock_out_address_map_changed();
        });
    }

    function clock_in_address_map_changed() {

        var center = clock_in_address_map.getCenter()
        var lat = center.lat();
        var lng = center.lng();
        if (current_lat != lat && current_lng != lng) {
            current_lat = lat;
            current_lng = lng;

            if (antennasCircle_clock_in_map != null) {
                antennasCircle_clock_in_map.setMap(null);
                clock_in_address_map.fitBounds(antennasCircle_clock_in_map.getBounds());
            }
            antennasCircle_clock_in_map = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: clock_in_address_map,
                center: {
                    lat: current_lat,
                    lng: current_lng
                },
                radius: radius_clock_in_address
            });
            clock_in_address_map.fitBounds(antennasCircle_clock_in_map.getBounds());

            var latlng = new google.maps.LatLng(current_lat, current_lng);
            // This is making the Geocode request
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, (results, status) => {
                if (status !== google.maps.GeocoderStatus.OK) {
                    // alert(status);
                }
                // This is checking to see if the Geoeode Status is OK before proceeding
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = (results[0].formatted_address);
                    $("#clock_in_formatted_address").val(address);

                }
            });
        }
    }

    function clock_out_address_map_changed() {
        var center = clock_out_address_map.getCenter()
        var lat = center.lat();
        var lng = center.lng();
        if (edit_lat != lat && edit_lng != lng) {
            edit_lat = lat;
            edit_lng = lng;

            if (antennasCircle_clock_out_map != null) {
                antennasCircle_clock_out_map.setMap(null);
                clock_out_address_map.fitBounds(antennasCircle_clock_out_map.getBounds());
            }
            antennasCircle_clock_out_map = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: clock_out_address_map,
                center: {
                    lat: edit_lat,
                    lng: edit_lng
                },
                radius: radius_clock_out_address
            });
            clock_out_address_map.fitBounds(antennasCircle_clock_out_map.getBounds());

            var latlng = new google.maps.LatLng(edit_lat, edit_lng);
            // This is making the Geocode request
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, (results, status) => {
                if (status !== google.maps.GeocoderStatus.OK) {
                    // alert(status);
                }
                // This is checking to see if the Geoeode Status is OK before proceeding
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = (results[0].formatted_address);
                    $("#clock_out_formatted_address").val(address);

                }
            });
        }
    }

    function formatted_address_changed(e, map_locator) {

        var geocoder = new google.maps.Geocoder();
        var address = $(e).val();
        geocoder.geocode({
            'address': address
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                current_lat = latitude;
                current_lng = longitude;
                setMapCenter(map_locator, current_lat, current_lng);
            }
        });
    }


    function toogle_btn_gps_clock(input_id = "", classes = "") {
        if ($(input_id).is(":checked")) {
            $(classes).show();
            $(input_id).val(1);

        } else {
            $(classes).hide();
            $(input_id).val(0);



        }


    }


    function setMapCenter(update_the_map, the_lat, the_lng, first = false) {
        var the_map = map;
        if (update_the_map == "clock_in") {
            the_map = clock_in_address_map;
        } else if (update_the_map == "clock_out") {
            the_map = clock_out_address_map;
        }
        if (update_the_map == "clock_in") {
            if (antennasCircle_clock_in_map != null) {
                antennasCircle_clock_in_map.setMap(null);
                clock_in_address_map.fitBounds(antennasCircle_clock_in_map.getBounds());
            }
            antennasCircle_clock_in_map = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: the_map,
                center: {
                    lat: the_lat,
                    lng: the_lng
                },
                radius: radius_clock_in_address
            });
            the_map.fitBounds(antennasCircle_clock_in_map.getBounds());

            if (first) {
                the_map.setZoom(13);
            }
            clock_in_address_map = the_map;
            var latlng = new google.maps.LatLng(the_lat, the_lng);
            // This is making the Geocode request
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, (results, status) => {
                if (status !== google.maps.GeocoderStatus.OK) {
                    // alert(status);
                }
                // This is checking to see if the Geoeode Status is OK before proceeding
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = (results[0].formatted_address);
                    $("#new_formatted_address").val(address);
                }
            });

        } else if (update_the_map == "clock_out") {
            if (antennasCircle_clock_out_map != null) {
                antennasCircle_clock_out_map.setMap(null);
                clock_out_address_map.fitBounds(antennasCircle_clock_out_map.getBounds());
            }
            antennasCircle_clock_out_map = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: clock_out_address_map,
                center: {
                    lat: the_lat,
                    lng: the_lng
                },
                radius: radius_clock_out_address
            });
            clock_out_address_map.fitBounds(antennasCircle_clock_out_map.getBounds());

            var latlng = new google.maps.LatLng(the_lat, the_lng);
            // This is making the Geocode request
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, (results, status) => {
                if (status !== google.maps.GeocoderStatus.OK) {
                    // alert(status);
                }
                // This is checking to see if the Geoeode Status is OK before proceeding
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = (results[0].formatted_address);
                    $("#edit_formatted_address").val(address);
                }
            });

            if (antennasCircle_clock_out_map != null) {
                antennasCircle_clock_out_map.setMap(null);
                clock_out_address_map.fitBounds(antennasCircle_clock_out_map.getBounds());
            }
            antennasCircle_clock_out_map = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: clock_out_address_map,
                center: {
                    lat: the_lat,
                    lng: the_lng
                },
                radius: radius_clock_out_address
            });
            clock_out_address_map.fitBounds(antennasCircle_clock_out_map.getBounds());
            // clock_out_address_map.setZoom(18);
        }

        the_map.setCenter({
            lat: the_lat,
            lng: the_lng,
        });
    }



    $(document).ready(function() {

        $(document).on('change', "#clock_in_formatted_address", function() {
            formatted_address_changed(this, "clock_in");
        });
        $(document).on('change', "#clock_out_formatted_address", function() {
            formatted_address_changed(this, "clock_out");
        });

        $(document).on('input', "#clock_in_address_radius", function() {
            $(".clock_in_radius_number_view").html(parseInt($("#clock_in_address_radius").val() * 3.28084, 10) + " ft zone");
            radius_clock_in_address = $("#clock_in_address_radius").val() * 1;
            var center = clock_in_address_map.getCenter();
            setMapCenter("clock_in", center.lat(), center.lng());
        });

        $(document).on('input', '#clock_out_address_radius', function() {
            $(".clock_out_radius_number_view").html(parseInt($("#clock_out_address_radius").val() * 3.28084, 10) + " ft zone");
            radius_clock_out_address = $("#clock_out_address_radius").val() * 1;
            var center = clock_out_address_map.getCenter();
            // console.log(center.lat());
            setMapCenter("clock_out", center.lat(), center.lng());
        });

        $(document).on('change', "#allow_clock_in_input", function() {

            toogle_btn_gps_clock("#allow_clock_in_input", ".allow_clock_in_map");
            if ($('#allow_clock_in_input').val() == 0) {
                $('#status_clock_in').html('Enable');
            } else {
                $('#status_clock_in').html('Disable');
            }
        });
        $(document).on('change', '#allow_clock_out_input', function() {

            toogle_btn_gps_clock("#allow_clock_out_input", ".allow_clock_out_map");
            if ($('#allow_clock_out_input').val() == 0) {
                $('#status_clock_out').html('Enable');
            } else {
                $('#status_clock_out').html('Disable');
            }
        });
        $('#modalEditEmployee').on('hidden.bs.modal', function() {
            if ($(" #manage_timsheet_clockin_clockout_gps_html_setter").html() == "") {
                $("#manage_timsheet_clockin_clockout_gps_html_setter").html($(".modal-edit-employee #manage_timsheet_clockin_clockout_gps").html());
                $(".modal-edit-employee #manage_timsheet_clockin_clockout_gps").html("");
            }
        })
    });
</script>

<script src="<?= "https://maps.googleapis.com/maps/api/js?key=" . GOOGLE_MAP_API_KEY . "&callback=initMap&libraries=&v=weekly" ?>" async></script>