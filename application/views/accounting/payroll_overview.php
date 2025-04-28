<?php include viewPath('v2/includes/accounting_header'); ?>

<style>
    /* .btn-success {
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
    } */

    #employeeTable tr>th {
        text-align: center;
    }

    /* .add-employee {
        float: right;
    } */

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
        background-color: #38a4f8;
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

    .pr-a {
        text-decoration: none;
        color: black;
        cursor: pointer;
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

    .bordered-box {
        border: 1px solid #ddd;
        border-top: 5px solid #6a4a86;
        border-radius: 8px;
    }


    .icon-hover {
        color: #6a4a86;
        border: 2px solid #6a4a86;
        border-radius: 50%;
        padding: 25px;
        font-size: 2rem;
        transition: color 0.3s ease, background-color 0.3s ease;
    }

    .icon-hover:hover {
        color: white;
        background-color: #6a4a86;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="col-lg-6 px-0">
                            <h3>Payroll Overview</h3>
                        </div>
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            No Payroll History Needed. All Reports in One Spot. Very easy shortcuts to help reduce the headaches of paying your staffs and vendors. Let's go!
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-lg-7 pl-0">
                            <div class="bg-white">
                                <div class="bg-white p-4 rounded h-100 bordered-box">
                                    <div class="col">
                                        <h1>It's time to run payroll</h1>
                                        <a href="javascript:void(0);" class="nsm-button primary ajax-modal" id="payroll_Modal" data-view="payroll_modal" data-toggle="modal" data-target="#payrollModal">
                                            Let's go
                                        </a>
                                    </div>
                                </div>
                                <div class="row align-items-end mx-0 p-4">
                                    <div class="col text-center">
                                        <button type="button" class="nsm-button primary" onclick="window.location.href='<?php echo base_url(); ?>accounting/employees/paycheck-list'">
                                            View Paycheck List
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 pr-0">
                            <div class="bg-white p-4 rounded h-100 bordered-box">
                                <h4 class="text-default mt-0">SHORTCUTS</h4>
                                <div class="row px-2 text-center mt-4 align-items-center">
                                    <div class="col-sm-6">
                                        <a href="javascript:void(0);" data-view="payroll_modal" data-toggle="modal" data-target="#payrollModal" class="ajax-modal pr-a">
                                            <p><i class="fa fa-money h2 icon-hover"></i></p>
                                            <h5 class="text-secondary mt-0">Run Payroll</h5>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo base_url(); ?>accounting/employees" class="pr-a">
                                            <p><i class="fa fa-user-plus h2 icon-hover"></i></p>
                                            <h5 class="text-secondary mt-0">Add Employee</h5>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo base_url(); ?>accounting/contractors" class="pr-a">
                                            <p><i class="fa fa-briefcase h2 icon-hover"></i></p>
                                            <h5 class="text-secondary mt-0">Pay Contractor</h5>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo base_url(); ?>accounting/contractors" class="pr-a">
                                            <p><i class="fa fa-user-plus h2 icon-hover"></i></p>
                                            <h5 class="text-secondary mt-0">Add Contractor</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add contractor modal -->
    <div class="modal fade" id="modalAddContractor" tabindex="-1" role="dialog" aria-labelledby="addContractorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg w-25 m-auto" role="document">
            <div class="modal-content">
                <form action="/accounting/contractors/add" method="post" class="form-validate" novalidate="novalidate">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addContractorLabel">Add a contractor</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <div class="modal-body" style="max-height: 25%;">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card p-0 m-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Name *</label>
                                                    <input type="text" class="form-control" name="name" id="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email *</label>
                                                    <input type="email" class="form-control" name="email" id="email" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                    </div>
                    <!-- end modal-body -->
                    <div class="modal-footer">
                        <div class="row w-100">
                            <div class="col-md-6"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div>
                            <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end add contractor modal -->
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
                        <button type="button" class="btn btn-success" id="savedNewEmployee">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end add contractor modal -->


</div>

<?php include viewPath('v2/includes/footer'); ?>

<script>
    $(document).ready(function() {
        $('.run-payroll').on('click', function() {
            $('#new-popup .ajax-modal[data-view="payroll_modal"]').trigger('click');
        });

        $('#employeeTable').DataTable({
            "searching": true,
            "sort": false
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

        $(document).on('click', '#addEmployeeData', function() {
            $('#modalAddEmployee').modal('show');
        });
        $(document).on('click', '#editEmployeeProfile', function() {
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
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "Employee record has been Updated",
                                icon: 'success'
                            });
                            location.reload();
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

        $(document).on('click', '#updateEmployeeProfilePhoto', function() {
            let values = {};
            $.each($('#editEmployeeProfileForm').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            if (values['profile_img']) {
                $.ajax({
                    url: base_url + 'users/ajaxUpdateEmployeeProfilePhoto',
                    type: "POST",
                    dataType: "json",
                    data: {
                        values: values
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#modalEditEmployeeProfile").modal('hide');
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "Employee record has been Updated",
                                icon: 'success'
                            });
                            location.reload();
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
                    $(".modal-edit-employee").html(data);
                }
            });
        });

        $(document).on('click', '#editEmployeeProfile', function() {
            var user_id = $(this).attr('data-id');
            $('#user_id_prof').val(user_id);
        });

        $(document).on('click', '#closeEditEmployeeModal', function() {
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

        /*
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
        */
    });
</script>