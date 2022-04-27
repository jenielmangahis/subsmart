<?php include viewPath('v2/includes/header_admin'); ?>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing of all users.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by Company: <?= $cid_search; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/users'); ?>">All Companies</a></li>
                                <?php foreach( $companies as $c ){ ?>
                                    <li><a class="dropdown-item" data-id="filter_all" href="<?= base_url('admin/users?cid='.$c->company_id); ?>"><?= $c->business_name; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-export-list" href="<?= base_url('admin/export_users_list') ?>" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Export List</a>
                            <a class="nsm-button primary btn-add-user" href="javascript:void(0);"><i class='bx bx-fw bx-user'></i> Create User</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Photo"></td>
                            <td data-name="User">User</td>
                            <td data-name="Company">Company</td>
                            <td data-name="Email">Email</td>
                            <td data-name="Password">Password</td>
                            <td data-name="Title">Title</td>
                            <td data-name="Rights">Rights</td>
                            <td data-name="Last Login">Last Login</td>
                            <td data-name="Status">Status</td>
                            <td data-name="App Access">App Access</td>
                            <td data-name="Web Access">Web Access</td>
                            <td data-name="Manage">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $cnt => $row) : ?>
                        <tr>
                            <td class="center">
                                <a href="javascript:void(0)" data-id="<?php echo $row->id ?>" id="editEmployeeProfile" title="Edit User Profile" data-toggle="tooltip">
                                    <span>
                                        <img src="<?php echo userProfileImage($row->id); ?>" width="40" height="40" alt="" class="img-avatar img-center" style="display:inline;" />
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                </a>                                
                            </td>
                            <td>
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
                            <td class="center"><?php echo $row->business_name; ?></td>
                            <td class="center"><?php echo $row->email ?></td>
                            <td class="center pw-row-<?= $row->id; ?>"><?php echo $row->password_plain ?></td>
                            <td class="center"><?php echo ($row->role) ? ucfirst($this->roles_model->getById($row->role)->title) : '' ?></td>
                            <td class="center"><?php echo getUserType($row->user_type); ?></td>
                            <td class="center"><?php echo date('M d,Y', strtotime($row->last_login)); ?></td>
                            <td class="center">                                
                                <?php if ($row->status == 1) : ?>
                                    <span class="badge" style="background-color: #6a4a86; color: #ffffff;display: block; margin: 5px;">Active</span>
                                <?php else : ?>
                                    <span class="badge" style="background-color: #dc3545; color: #ffffff;display: block; margin: 5px;">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if( $row->has_app_access == 1 ){ ?>
                                    <a class="btn btn-success btn-md" href="javascript:void(0);" title="Has mobile app access" data-toggle="tooltip" style="width: 83%;"><i class='bx bx-fw bxs-check-square' style="color:#ffffff;"></i> Has Mobile Access</a>
                                <?php }else{ ?>
                                    <a class="btn btn-danger btn-md" href="javascript:void(0);" title="Has no mobile app access" data-toggle="tooltip" style="width:83%;">
                                        <i class='bx bx-fw bxs-x-square' style="color:#ffffff;"></i> Has no Mobile Access
                                    </a>
                                <?php } ?>    
                            </td>
                            <td class="text-center">
                                <?php if( $row->has_web_access == 1 ){ ?>
                                    <a class="btn btn-success btn-md" href="javascript:void(0);" title="Has mobile app access" data-toggle="tooltip" style="width: 83%;"><i class='bx bx-fw bxs-check-square' style="color:#ffffff;"></i> Has Web Access</a>
                                <?php }else{ ?>
                                    <a class="btn btn-danger btn-md" href="javascript:void(0);" title="Has no mobile app access" data-toggle="tooltip" style="width: 83%;">
                                        <i class='bx bx-fw bxs-x-square' style="color:#ffffff;"></i> Has no Web Access
                                    </a>
                                <?php } ?>
                            </td>
                            <td class="center actions-col">
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item editEmployee" href="javascript:void(0)" data-id="<?php echo $row->id ?>"><i class="bx bx-fw bx-edit"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item change-password" href="javascript:void(0);" data-name="<?= $row->FName . ' ' . $row->LName; ?>" data-email="<?= $row->email; ?>" data-id="<?= $row->id; ?>"><i class='bx bx-fw bxs-lock'></i>Change Password</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item login-user" href="javascript:void(0);" data-name="<?= $row->FName . ' ' . $row->LName; ?>" data-id="<?= $row->id; ?>"><i class="bx bx-fw bx-refresh"></i> Login as User</a>
                                        </li>                                        
                                        <li>
                                            <?php if( $row->status == 1 ){ ?>
                                                <a href="javascript:void(0)" data-name="<?= $row->FName . ' ' . $row->LName; ?>" data-id="<?php echo $row->id ?>" class="deactivate-user dropdown-item"><i class="bx bx-fw bxs-x-square"></i> Deactivate</a>
                                            <?php }else{ ?>
                                                <a href="javascript:void(0)" data-name="<?= $row->FName . ' ' . $row->LName; ?>" data-id="<?php echo $row->id ?>" class="activate-user dropdown-item"><i class="bx bx-fw bxs-check-square"></i> Activate</a>
                                            <?php } ?>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-user" href="javascript:void(0);" data-name="<?= $row->FName . ' ' . $row->LName; ?>" data-id="<?= $row->id; ?>"><i class="bx bx-fw bx-trash"></i> Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                </table>

                <!--Add Employee modal-->
                <div class="modal fade nsm-modal fade" id="modalAddEmployee" tabindex="-1" aria-labelledby="modalAddEmployeeLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Add Employee</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <form action="" id="frm-add-employee">
                            <div class="modal-body" style="max-height:600px; overflow-y: auto;">
                                <?= include_once('add_form.php'); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary btn-add-employee">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--Edit Employee modal-->
                <div class="modal fade nsm-modal fade" id="modalEditEmployee" tabindex="-1" aria-labelledby="modalEditEmployeeLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Edit Employee</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <form action="" id="frm-edit-employee">
                            <div class="modal-body modal-edit-employee" style="max-height:600px; overflow-y: auto;"></div>
                            <div class="modal-footer">
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary btn-update-employee">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--Change Password modal-->
                <div class="modal fade nsm-modal fade" id="modalChangePassword" tabindex="-1" aria-labelledby="modalChangePasswordLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="change_password_label">Change Password</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <form action="" id="frm-employee-change-password">
                            <input type="hidden" name="eid" value="" id="change-pw-eid">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Employee Name</label>
                                        <input type="text" id="change-pw-name" class="form-control" readonly="" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Employee Email</label>
                                        <input type="text" id="change-pw-email" class="form-control" readonly="" disabled="">
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
                            <div class="modal-footer">
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary btn-change-password">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $(document).on('click', '.btn-add-user', function(e) {
        var user_id = $(this).attr('data-id');
        $("#modalAddEmployee").modal("show");
    });

    $(document).on('click', '.editEmployee', function(e) {
        var user_id = $(this).attr('data-id');
        $("#modalEditEmployee").modal("show");
        $.ajax({
            url: base_url + "admin/ajax_edit_employee",
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

    $(document).on('click', '.change-password', function(e) {
        var eid = $(this).attr('data-id');
        var ename = $(this).attr('data-name');
        var eemail = $(this).attr('data-email');

        $('#change-pw-name').val(ename);
        $('#change-pw-email').val(eemail);
        $('#change-pw-eid').val(eid);

        $("#modalChangePassword").modal("show");
    });

    $(document).on('submit', '#frm-add-employee', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxCreateUser';
        $(".btn-add-employee").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-employee")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalAddEmployee").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Employee was successfully created.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.reload();
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-add-employee").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('submit', '#frm-edit-employee', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxUpdateUser';
        $(".btn-update-employee").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-employee")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalEditEmployee").modal("hide");               
                    Swal.fire({
                        title: 'Update Successful!',
                        text: "Employee details has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.reload();
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-update-employee").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('submit', '#frm-employee-change-password', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxUpdateEmployeePassword';
        $(".btn-change-password").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-employee-change-password")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){
                    $("#modalChangePassword").modal("hide");
                    Swal.fire({
                        title: 'Update Successful!',
                        text: "Employee password has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                        location.reload();
                        //}
                    });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-change-password").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-user", function(e) {
        var delete_user_id = $(this).attr("data-id");
        var emp_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxDeleteUser';

        Swal.fire({
            title: 'Delete User',
            html: "Are you sure you want to delete employee <b>"+emp_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {delete_user_id:delete_user_id},
                    success: function(result) {
                        Swal.fire({
                            title: 'Delete Successful!',
                            text: "Employee Data Deleted Successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    },
                });
            }
        });
    });

    $(document).on("click", ".deactivate-user", function(e) {
        var status_user_id = $(this).attr("data-id");
        var emp_name = $(this).attr('data-name');
        var status_user_status = 0;
        var url = base_url + 'admin/ajaxUpdateEmployeeStatus';

        Swal.fire({
            title: 'Deactivate User',
            html: "Are you sure you want to deactivate (will not be able to access application) employee <b>"+emp_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {status_user_id:status_user_id, status_user_status:status_user_status},
                    success: function(result) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Employee Data Updated Successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    },
                });
            }
        });
    });

    $(document).on('click', '.login-user', function(e){
        var uid = $(this).attr("data-id");
        var emp_name = $(this).attr('data-name');
        var url = base_url + 'admin/ajaxLoginCompanyUser';

        Swal.fire({
            title: 'Login User',
            html: "Login as employee <b>"+emp_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Login',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {uid:uid},
                    dataType: 'json',
                    success: function(result) {
                        if( result.is_valid == 1 ){
                            location.href = result.redirect_url;
                        }else{
                            Swal.fire({
                              icon: 'error',
                              title: 'Error!',
                              confirmButtonColor: '#32243d',
                              html: result.msg
                            });
                        }
                    },
                });
            }
        });
    });

    $(document).on("click", ".activate-user", function(e) {
        var status_user_id = $(this).attr("data-id");
        var emp_name = $(this).attr('data-name');
        var status_user_status = 1;
        var url = base_url + 'admin/ajaxUpdateEmployeeStatus';

        Swal.fire({
            title: 'Activate User',
            html: "Are you sure you want to activate (will be able to access application) employee <b>"+emp_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {status_user_id:status_user_id, status_user_status:status_user_status},
                    success: function(result) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Employee Data Updated Successfully!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    },
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>