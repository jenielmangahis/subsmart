<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    .btn-success{
        background-color: #46a83d;
    }
    .center{
        text-align: center;
    }
    .img-center{
        horiz-align: center;
        border-radius: 50%;
    }
    #employeeTable tr > th{
        text-align: center;
    }
    .add-employee{
        float: right;
    }
    #modalAddEmployee .modal-dialog {
        max-width: 800px;
    }
    #modalAddEmployee .modal-content{
        width: 100%;
    }
    #modalAddEmployee .modal-body{
        padding: 20px!important;
        max-height: 550px;
        overflow-y: auto;
    }
    #modalAddEmployee .section-title{
        font-size: 20px;
        font-weight: bold;
        color: grey;
    }
    #modalAddEmployee label{
        font-weight: bold;
    }
    .view-password{
        position: absolute;
        bottom:2px;
        right:15px;
        width:24px;
        height:24px;
        cursor: pointer;
    }
    .input-switch{
        display: inline-block;
        margin-right: 20px;
    }

    .check-if-exist,#employeeEmail,#employeeUsername{
        display: inline;
    }
    .check-if-exist{
        margin-left: 10px;
    }
    .check-if-exist:hover{
        color: #0b62a4;
    }
    .email-error ,.username-error{
        visibility: hidden;
        display: block;
        font-style: italic;
        color: red;
    }
    .password-error{
        visibility: hidden;
        position: absolute;
        font-style: italic;
        color: red;
    }
    .profile-container{
        width: 150px;
        height: 150px;
        position: absolute;
        bottom: 0;
        display: none;
    }
    .profile-container img{
        width: 100%;
        height: 100%;
        border-radius: 3%;
        border: 1px solid grey;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
    .new-password-container ,.change-password{
        display: none;
    }
    .change-password{
        margin-top: 20px;
        color: #0b97c4;
        font-weight: bold;
    }
    .change-password:hover{
        text-decoration: underline;
        color: grey;
    }

    #shareEmployeeForm{
    	float: right;
    	margin-right: 10px;
    }

</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Employees</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Employees</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php ////if (hasPermissions('users_add')): ?>
                                <!--                                <a href="--><?php //echo url('users/add') ?><!--" class="btn btn-primary"-->
                                <!--                                   aria-expanded="false">-->
                                <!--                                    <i class="mdi mdi-settings mr-2"></i> New Employee-->
                                <!--                                </a>-->
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mt-0 header-title mb-5">Employee list</h4>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info add-employee" id="addEmployeeData"><i class="fa fa-user-plus"></i> Add Employee</button>
                                    <button class="btn btn-info share-add-employee" id="shareEmployeeForm"><i class="fa fa-globe"></i> Share Add Employee</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="employeeTable" data-page-length='25' class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Last Login</th>
                                            <th>Status</th>
                                            <th>App Access</th>
                                            <th>Web Access</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($users as $cnt => $row): ?>
                                            <tr>
                                                <td class="center"><?php echo $cnt+1; ?></td>
                                                <td class="center">
                                                    <img src="<?php echo userProfileImage($row->id);?>" width="40" height="40" alt="" class="img-avatar img-center" />
                                                </td>
                                                <td><?php echo $row->FName.' '.$row->LName ?></td>
                                                <td class="center"><?php echo $row->email ?></td>
                                                <td class="center"><?php echo $row->password_plain ?></td>
                                                <td class="center"><?php echo ($row->role) ? ucfirst($this->roles_model->getById($row->role)->title) : '' ?></td>
                                                <td class="center"><?php echo date('M d,Y')?></td>
                                                <td class="center">
                                                    <?php //if (logged('id') !== $row->id): ?>
                                                    <!-- <input type="checkbox" class="js-switch"
                                                               onchange="updateUserStatus('<?php //echo $row->id ?>', $(this).is(':checked') )" <?php //echo ($row->status) ? 'checked' : '' ?> /> -->
                                                    <?php if( $row->status == 1 ): ?>
                                                        <span>Active</span>
                                                    <?php else: ?>
                                                        <span>Inactive</span>
                                                    <?php endif; ?>
                                                    <?php //endif ?>
                                                </td>
                                                <td class="text-center"><span class="fa fa-lg fa-mobile"></span></td>
                                                <td class="text-center"><span class="fa fa-lg fa-desktop"></span></td>
                                                <td class="center">
                                                    <?php //if (hasPermissions('users_edit')): ?>
                                                    <!--                                                        <a href="--><?php //echo url('users/edit/' . $row->id) ?><!--"  title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>-->
                                                    <a href="javascript:void(0)" data-id="<?php echo $row->id?>" id="editEmployee"  title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                    <?php //endif ?>
                                                    <?php //if (hasPermissions('users_view')): ?>
                                                    <a href="<?php echo url('users/view/' . $row->id) ?>" title="View User" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                                    <?php //endif ?>
                                                    <?php //if (hasPermissions('users_delete')): ?>
                                                    <?php if ($row->id != 1 && logged('id') != $row->id): ?>
                                                        <a href="<?php echo url('users/delete/' . $row->id) ?>"
                                                           onclick="return confirm('Do you really want to delete this user ?')"
                                                           title="Delete User" data-toggle="tooltip"><i
                                                                    class="fa fa-trash"></i></a>
                                                    <?php else: ?>
                                                        <a href="javascript:void (0)"
                                                           title="You cannot Delete this User" data-toggle="tooltip"
                                                           disabled><i class="fa fa-trash"></i></a>
                                                    <?php endif ?>
                                                    <?php //endif ?>
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
<!--Adding Employee modal-->
<!-- The Modal -->
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
                    <div class="section-title">Basic Details</div>
                    <div class="form-group">
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
                            <div class="col-md-6">
                                <label for="" style="display: block">Email</label>
                                <input type="text" name="email" class="form-control" id="employeeEmail" placeholder="e.g: email@mail.com" style="width: 90%">
                                <i class="fa fa-sync-alt check-if-exist" title="Check if Email is already exist" data-toggle="tooltip"></i>
                                <span class="email-error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" style="display: block">Username</label>
                                <input type="text" name="username" class="form-control" id="employeeUsername" placeholder="e.g: nsmartrac" style="width: 90%">
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
                                    <input type="password" name="password" id="employeePass" class="form-control">
                                    <i class="fa fa-eye view-password" id="showPass" title="Show password" data-toggle="tooltip"></i>
                                    <span class="password-error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="employeeConfirmPass" class="form-control">
                                    <i class="fa fa-eye view-password" id="showConfirmPass" title="Show password" data-toggle="tooltip"></i>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void (0)" class="change-password" id="changePassword">Want to change password?</a>
                        <div class="new-password-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Old Password</label>
                                    <input type="password" name="password" id="oldPassword" class="form-control">
                                    <i class="fa fa-eye view-password" id="showPass" title="Show password" data-toggle="tooltip"></i>
                                    <span class="old-password-error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">New Password</label>
                                    <input type="password" name="password" id="newPassword" class="form-control">
                                    <i class="fa fa-eye view-password" id="showPass" title="Show password" data-toggle="tooltip"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-title">Other Details</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Role</label>
                                <select name="role" id="employeeRole" class="form-control select2-role"></select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
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
                                    <div class="dz-message" style="margin: 20px;border">
                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                    </div>
                                </div>
                                <input type="hidden" name="profile_photo" id="photoId">
                                <input type="hidden" name="img_id" id="photoName">
                            </div>
                            <div class="col-md-6">
                                <div class="profile-container">
                                    <img src="/uploads/users/default.png" alt="Profile photo">
                                </div>
                                <label>Role and Access</label>
                                <div class="help help-sm help-block">Select employee role</div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="1" id="role_1">
                                        <label for="role_1"><span>Office Manager</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        ALL except high security file vault<br>
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="2" id="role_2">
                                        <label for="role_2"><span>Partner</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        ALL base on plan type
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="3" id="role_3">
                                        <label for="role_3"><span>Team Leader</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        No accounting or any changes to company profile or deletion
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="4" id="role_4">
                                        <label for="role_4"><span>Standard User</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        Can not add or delete employees, can not manage subscriptions
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="5" id="role_5">
                                        <label for="role_5"><span>Field Sales</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        View only no input 
                                    </div>
                                </div>
                                <div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="radio" name="role" value="6" id="role_6">
                                        <label for="role_6"><span>Field Tech</span></label>
                                    </div>
                                    <div class="help help-sm help-block">
                                        App access only, no Web access 
                                    </div>
                                </div>
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
                    </div>
                </div>
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="closedEmployeeModal">Close</button>
                <button type="button" class="btn btn-success" id="savedNewEmployee">Save & exit</button>
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
<!--end of modal-->
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function () {
        $('#employeeTable').DataTable({"sort":false});

        $("#shareEmployeeForm").click(function(){
        	$("#modalShareAddEmployee").modal("show");
        });

        $(".btn-copy-public-url").click(function(){
			var copyText = document.getElementById("e-public-url");
			copyText.type = 'text';
			copyText.select();
			document.execCommand("copy");
			copyText.type = 'hidden';

			$(".label-public-url").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
        });

        $(document).on('click','#addEmployeeData',function () {
            $('#modalAddEmployee').modal({backdrop: 'static', keyboard: false});
        });
        $('#showPass').click(function () {
            $(this).toggleClass('fa-eye-slash');
            if ($(this).prev('input[type="password"]').length == 1){
                $(this).prev('input[type="password"]').attr('type','text');
                $(this).attr('title','Hide password').attr('data-original-title','Hide password').tooltip('update').tooltip('show');
            }else{
                $(this).prev('input[type="text"]').attr('type','password');
                $(this).attr('title','Show password').attr('data-original-title','Show password').tooltip('update').tooltip('show');
            }
        });
        $('#showConfirmPass').click(function () {
            $(this).toggleClass('fa-eye-slash');
            if ($(this).prev('input[type="password"]').length == 1){
                $(this).prev('input[type="password"]').attr('type','text');
                $(this).attr('title','Hide password').attr('data-original-title','Hide password').tooltip('update').tooltip('show');
            }else{
                $(this).prev('input[type="text"]').attr('type','password');
                $(this).attr('title','Show password').attr('data-original-title','Show password').tooltip('update').tooltip('show');
            }
        });

        // Switch button
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {size: 'small'});
        });
        //Select2 initialization
        $('.select2-role').select2({
            placeholder: 'Select role',
            allowClear: true,
            width: 'resolve',
            delay:250,
            ajax:{
                url:'users/getRoles',
                type:"GET",
                dataType:"json",
                data:function (params) {
                    var query = {
                        search: params.term
                    };
                    return query;
                },
                processResults:function (response) {
                    return{results:response};
                },
                cache:true
            }
        });
        $(document).on('change','#employeeEmail',function () {
            var email = $(this).val();
            var selected = this;
            var status = $(this).next('i');
            if( !validateEmail(email)) {
                $(this).css('border-color','red');
                $('.email-error').text('*Email format invalid').css('visibility','visible');
            }else{
                $(this).css('border-color','#e0e0e0');
                $('.email-error').css('visibility','hidden');
                $.ajax({
                    url:"/users/checkEmailExist",
                    type:"GET",
                    data:{email:email},
                    dataType:'json',
                    success:function (data) {
                        if (data > 0){
                            $(selected).css('border-color','red');
                            status.removeClass('fa-sync-alt').addClass('fa-times-circle').css('color','red');
                            status.attr('title','Input another email').attr('data-original-title','Input another email').tooltip('update').tooltip('show');
                            $('.email-error').text('*Email already exist').css('visibility','visible');
                        }else{
                            $(selected).css('border-color','#e0e0e0');
                            status.removeClass('fa-sync-alt').removeClass('fa-times-circle').addClass('fa-check').css('color','greenyellow');
                            status.attr('title','Email is unique. Ready to go.').attr('data-original-title','Email is unique. Ready to go.').tooltip('update').tooltip('show');
                            $('.email-error').css('visibility','hidden');
                        }
                    }
                });
            }
        });
        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
        }

        $(document).on('change','#employeeUsername',function () {
            var username = $(this).val();
            var selected = this;
            var status = $(this).next('i');
            $.ajax({
                url:"/users/checkUsername",
                type:"GET",
                dataType:'json',
                data:{username:username},
                success:function (data) {
                    if (data > 0){
                        $(selected).css('border-color','red');
                        status.removeClass('fa-sync-alt').addClass('fa-times-circle').css('color','red');
                        status.attr('title','Input another username').attr('data-original-title','Input another username').tooltip('update').tooltip('show');
                        $('.username-error').text('*Username already exist').css('visibility','visible');
                    }else{
                        $(selected).css('border-color','#e0e0e0');
                        status.removeClass('fa-sync-alt').removeClass('fa-times-circle').addClass('fa-check').css('color','greenyellow');
                        status.attr('title','Username is unique. Ready to go.').attr('data-original-title','Username is unique. Ready to go.').tooltip('update').tooltip('show');
                        $('.username-error').css('visibility','hidden');
                    }
                }
            });

        });
        // Password and Confirm Password Validation
        $(document).on('change','#employeeConfirmPass',function () {
            var con_pass = $(this).val();
            var pass = $('#employeePass').val();
            if (con_pass != pass){
                $('.password-error').text('*Password field and Confirm password does not match.').css('visibility','visible');
                $(this).css('border-color','red');
                $('#employeePass').css('border-color','red');
            }else{
                $('.password-error').css('visibility','hidden');
                $(this).css('border-color','#e0e0e0');
                $('#employeePass').css('border-color','#e0e0e0');
            }
        });
        $(document).on('click','#closedEmployeeModal',function () {
            $('#employeeProfilePhoto').next().next($('.dz-preview').remove());
            $('#employeeProfilePhoto').next($('.dz-message').css({"display":"inherit"}));
            var image_id = $('#photoId').val();
            var image = $('#photoName').val();
            $.ajax({
                url:'/users/removeTemporaryImg',
                type:'POST',
                dataType:'json',
                data:{image_id:image_id,image:image},
                success:function (data) {

                }
            });
            $('#addEmployeeForm')[0].reset();
            if($('.check-if-exist').hasClass('fa-check') == true || $('.check-if-exist').hasClass('fa-times-circle') == true){
                $('.check-if-exist').removeClass('fa-check').removeClass('fa-times-circle').addClass('fa-sync-alt').css('color','#111111');
                $('.username-error').css('visibility','hidden');
                $('.email-error').css('visibility','hidden');
                $('#employeeUsername').css('border-color','#e0e0e0');
                $('#employeeEmail').css('border-color','#e0e0e0');
            }
            $(".select2-role").select2('val','All');
            $("#modalAddEmployee").modal('hide');
        });
        $(document).on('click','#savedNewEmployee',function () {
            let values = {};
            $.each($('#addEmployeeForm').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            if(values['firstname'] && values['lastname'] && values['email'] && values['username'] && values['password'] && values['role']){
                $.ajax({
                    url:'/users/addNewEmployee',
                    type:"POST",
                    dataType:"json",
                    data:{values:values},
                    success:function (data) {
                        if (data == 1){
                            $("#modalAddEmployee").modal('hide');
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    text: "New Employee has been Added",
                                    icon: 'success'
                                });
                        }else{
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                        }
                    }
                });
            }else{

            }
        });
        $(document).on('click','#editEmployee',function () {
            var user_id = $(this).attr('data-id');
            $('#modalAddEmployee').modal({backdrop: 'static', keyboard: false});
            var form = $('#modalAddEmployee').find('form');
            $.ajax({
                url:"users/getEmployeeData",
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
        });
    });
    $('#changePassword').click(function () {
        $('div.new-password-container').toggle();
        var text =  $(this).text();
        $(this).text(text == "Want to change password?" ? "I changed my mind. Maybe later." : "Want to change password?").css('color','#0b97c4');
    });
    Dropzone.autoDiscover = false;
    $(document).ready(function () {
        var fname = [];
        var selected = [];
        var profilePhoto = new Dropzone('#employeeProfilePhoto', {
            url: '/users/profilePhoto',
            acceptedFiles: "image/*",
            maxFilesize:20,
            maxFiles: 1,
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    var file_name = JSON.parse(response)['photo'];
                    fname.push(file_name.replace(/\"/g, ""));
                    selected.push(file);
                    $('#photoId').val(JSON.parse(response)['id']);
                    $('#photoName').val(JSON.parse(response)['photo']);
                });
            },
            removedfile:function (file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if(d == file) return index;
                }).filter(isFinite)[0];
                $.ajax({
                    type:"POST",
                    url:'/users/removeProfilePhoto',
                    dataType:'json',
                    data:{name:name,index:index},
                    success:function (data) {
                        if (data == 1){
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

</script>