<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/users/users_modals'); ?>
<style>
#add_employee_modal .custom-header, #edit_employee_modal .custom-header{
    background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
    display:block;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
        <li data-bs-toggle="modal" data-bs-target="#add_employee_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-user-plus"></i>
            </div>
            <span class="nsm-fab-label">Add Employee</span>
        </li>
        <li class="btn-export-list">
            <div class="nsm-fab-icon">
                <i class="bx bx-export"></i>
            </div>
            <span class="nsm-fab-label">Export List</span>
        </li>
        <?php } ?>
        <li onclick="location.href='<?php echo url('email_automation/templates') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-share-alt"></i>
            </div>
            <span class="nsm-fab-label">Share Add Employee</span>
        </li>
    </ul>
</div>


<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage Employees.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Employee">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">                            
                            <button type="button" name="btn_link" class="nsm-button primary btn-export-list">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                            <button type="button" name="btn_link" class="nsm-button primary add-employee" data-bs-toggle="modal" data-bs-target="#add_employee_modal">
                                <i class='bx bx-fw bx-user-plus'></i> Add Employee
                            </button>
                            <?php } ?>
                            <button type="button" name="btn_link" class="nsm-button primary btn-share-url">
                                <i class='bx bx-fw bx-share-alt'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="User">User</td>
                            <td data-name="Email">Email</td>
                            <td data-name="Mobile">Mobile</td>
                            <?php if ($show_pass == 1) : ?>
                                <td data-name="Password">Password</td>
                            <?php endif; ?>
                            <td data-name="Title">Title</td>
                            <td data-name="Rights">Role</td>
                            <td data-name="Last Login">Last Login</td>
                            <td data-name="Status">Status</td>
                            <td data-name="App Access">App Access</td>
                            <td data-name="Web Access">Web Access</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($users)) :
                        ?>
                            <?php
                            foreach ($users as $cnt => $row) :
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                        if ($row->profile_img != '') {
                                            $data_img = $row->profile_img;
                                        } else {
                                            $data_img = 'default.png';
                                        }
                                        ?>
                                        <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($row->id); ?>');" data-img="<?php echo $data_img; ?>"></div>
                                    </td>
                                    <td class="nsm-text-primary">
                                        <label class="d-block fw-bold"><?php echo ucwords(strtolower($row->FName)) . ' ' . ucwords(strtolower($row->LName)); ?></label>
                                        <?php
                                        if ($row->employee_number) {
                                            $employee_number = $row->employee_number;
                                        } else {
                                            $employee_number = '---';
                                        }
                                        ?>
                                        <label class="content-subtitle fst-italic d-block">Employee ID: <?php echo $employee_number; ?></label>
                                    </td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php echo $row->mobile != '' ? formatPhoneNumber($row->mobile) : '---'; ?></td>
                                    <?php if ($show_pass == 1) : ?>
                                        <td><?php echo $row->password_plain ?></td>
                                    <?php endif; ?>
                                    <td><?php echo ($row->role) ? ucfirst($this->roles_model->getById($row->role)->title) : '' ?></td>
                                    <td><?php echo getUserType($row->user_type); ?></td>
                                    <td><?php echo date('M d,Y', strtotime($row->last_login)); ?></td>
                                    <td>
                                        <?php
                                        if ($row->status == 1) :
                                            $status = "Active";
                                            $badge = "success";
                                        else :
                                            $status = "Inactive";
                                            $badge = "";
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?= $status ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->has_app_access == 1) :
                                            $status = "Yes";
                                            $badge = "success";
                                        else :
                                            $status = "No";
                                            $badge = "error";
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?= $status ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->has_web_access == 1) :
                                            $status = "Yes";
                                            $badge = "success";
                                        else :
                                            $status = "No";
                                            $badge = "error";
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?= $status ?></span>
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" name="btn_view" href="<?php echo url('users/view/' . $row->id) ?>" data-id="<?php echo $row->id ?>">View</a>
                                                </li>
                                                <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                                                    <li>
                                                        <a class="dropdown-item edit-item" name="btn_edit" href="javascript:void(0);" data-id="<?php echo $row->id ?>">Edit</a>
                                                    </li>                                                
                                                    <!-- <li>
                                                        <a class="dropdown-item commissions-list" name="" href="javascript:void(0);" data-id="<?php echo $row->id ?>">Commissions</a>
                                                    </li> -->
                                                    <li>
                                                        <a class="dropdown-item update-profile-item" name="btn_update_profile_image" href="javascript:void(0);" data-id="<?php echo $row->id ?>" data-img="<?php echo $data_img; ?>">Update Profile Image</a>
                                                    </li>                                                
                                                    <?php if(isSolarCompany() == 1){ ?>
                                                        <li>
                                                            <a class="dropdown-item change-adt-portal-access" name="btn_adt_portal_access" href="javascript:void(0);" data-id="<?php echo $row->id ?>">Set ADT Portal Access</a>
                                                        </li>
                                                    <?php } ?>
                                                    <li>
                                                        <a class="dropdown-item change-password-item" name="btn_change_pw" href="javascript:void(0);" data-name="<?php echo $row->FName . ' ' . $row->LName; ?>" data-id="<?php echo $row->id ?>">Change Password</a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('users', 'delete')){ ?>
                                                    <?php if ($row->id != 1 && logged('id') != $row->id) : ?>
                                                        <li>
                                                            <a class="dropdown-item delete-item" data-name="<?php echo ucwords(strtolower($row->FName)) . ' ' . ucwords(strtolower($row->LName)); ?>" name="btn_delete" href="javascript:void(0);" data-id="<?= $row->id; ?>">Delete</a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#add_employee_modal').modal({backdrop: 'static', keyboard: false});
        $('#edit_employee_modal').modal({backdrop: 'static', keyboard: false});

        populateEmployeeRoles();
        $(".nsm-table").nsmPagination();

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));
        }, 1000));

        $(".btn-export-list").on("click", function() {
            location.href = "<?php echo base_url('users/export_list'); ?>";
        });

        $("#employee_username").on("input", debounce(function() {
            let _this = $(this);
            let url = "<?php echo base_url('users/checkUsername'); ?>";
            let username = _this.val();

            _this.closest(".nsm-field-group").removeClass("error x check success");
            _this.next("small").remove();
            _this.removeClass("error");

            if (username != "") {
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    data: {
                        username: username
                    },
                    success: function(result) {
                        if (result > 0) {
                            _this.closest(".nsm-field-group").addClass("error x");
                            _this.after("<small class='nsm-text-error'>Username already exist</small>");
                            _this.addClass("error");
                        } else {
                            _this.closest(".nsm-field-group").addClass("check success");
                        }
                    }
                });
            }
        }, 1000));

        $(".password-field").on("click", function(e) {
            let _this = $(this);
            let _container = _this.closest(".nsm-field-group");
            let shown = _container.hasClass("show");

            if (e.offsetX > 345) {
                if (shown) {
                    _container.removeClass("show").addClass("hide");
                    _this.attr("type", "text");
                } else {
                    _container.removeClass("hide").addClass("show");
                    _this.attr("type", "password");
                }
            }
        });

        $('#add_employee_modal .form-select').select2({
            dropdownParent: $("#add_employee_modal")
        });

        $(".btn-share-url").on("click", function() {
            var _shareableLink = $("<input>");
            $("body").append(_shareableLink);
            _shareableLink.val("<?php echo base_url('/add_company_employee/' . $eid); ?>").select();
            document.execCommand('copy');
            _shareableLink.remove();

            Swal.fire({
                title: 'Success',
                text: "Shareable link has been copied to clipboard.",
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
        });

        $("#add_employee_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var formData = new FormData($("#add_employee_form")[0]);

            var url = base_url + "user/_create_employee";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(result) {
                    if (result == 1) {
                        $('#add_employee_modal').modal('hide');
                        Swal.fire({
                            title: 'Create Employee',
                            text: "Data has been created successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            location.reload();
                        });
                    } else if (result == 3) {
                        Swal.fire({
                            title: 'Failed',
                            text: "Insufficient license. Please purchase license to continue adding user.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Purchase License'
                        }).then((result) => {
                            window.location.href = base_url + 'mycrm/membership';
                        });
                    } else if (result == 4) {
                        Swal.fire({
                            title: 'Failed',
                            text: "ADT Sales App password not same",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else if (result == 5) {
                        Swal.fire({
                            title: 'Failed',
                            text: "ADT Sales App account already exists",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else if (result == 6) {
                        Swal.fire({
                            title: 'Failed',
                            text: "Username already exists",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });                        
                    } else {
                        Swal.fire({
                            title: 'Failed',
                            text: "Cannot create employee",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    //$("#add_employee_modal").modal('hide');
                    //_this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".edit-item", function() {
            let id = $(this).attr("data-id");
            let _container = $("#edit_employee_container");
            let _form = $("#edit_employee_form");
            let url = "<?php echo base_url('users/_edit_employee'); ?>";
            showLoader(_container);

            $.ajax({
                url: url,
                type: "POST",
                dataType: "html",
                data: {
                    user_id: id
                },
                success: function(result) {
                    _container.html(result);
                    _form.find("button[type=submit]").prop("disabled", false);
                    $("#edit_employee_modal").modal("show");
                }
            });
        });

        $(document).on("click", ".btn-delete-commission-setting-row", function(e){  
            var tableRow = $(this).closest('tr'); 
            tableRow.find('td').fadeOut('fast', 
                function(){ 
                    tableRow.remove();                    
                }
            );
        });

        function modalShowLoader(_elem) {
            let loader = '<div class="row">' +
                '<div class="col-12">' +
                '<div class="nsm-loader">' +
                '<i class="bx bx-loader-alt bx-spin"></i>' +
                '</div>' +
                '</div>' +
                '</div>';
            _elem.html(loader);
        }

        $(document).on('click', '.view-job-row', function(){
            var appointment_id = $(this).attr('data-id');
            var url = base_url + "job/_quick_view_details";  

            $('#modal-quick-view-job').modal('show');
            modalShowLoader($(".view-schedule-container")); 

            setTimeout(function () {
            $.ajax({
                type: "POST",
                url: url,
                data: {appointment_id:appointment_id},
                success: function(o)
                {          
                    $(".view-schedule-container").html(o);
                }
            });
            }, 500);
        });

        $(document).on('click', '.delete-employee-commission-item', function(){
            let cid = $(this).attr('data-id');
            let url = base_url + "user/_get_employee_commission_status";  
            $.ajax({
                type: "POST",
                url: url,
                data: {cid:cid},
                dataType:'json',
                success: function(result)
                {          
                    if( result.msg != '' ){
                        Swal.fire({
                            title: 'Failed',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }else{
                        if( result.is_paid == 1 ){
                            Swal.fire({
                                title: 'Failed',
                                text: 'Cannot delete already processed commission',
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }else{
                            Swal.fire({
                                title: 'Delete Employee Commission',
                                text: "Are you sure you want to delete the selected employee commission?",
                                icon: 'question',
                                confirmButtonText: 'Proceed',
                                showCancelButton: true,
                                cancelButtonText: "Cancel"
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        type: 'POST',
                                        url: base_url + "user/_delete_employee_commission",
                                        data: {
                                            cid: cid
                                        },
                                        dataType: "json",
                                        success: function(aresult) {
                                            if (aresult.is_success) {
                                                Swal.fire({
                                                    title: 'Success',
                                                    text: "Data was successfully deleted.",
                                                    icon: 'success',
                                                    showCancelButton: false,
                                                    confirmButtonText: 'Okay'
                                                }).then((result) => {
                                                    load_employee_commissions_list(aresult.employee_id);
                                                });
                                            } else {
                                                Swal.fire({
                                                    title: 'Failed',
                                                    text: aresult.msg,
                                                    icon: 'error',
                                                    showCancelButton: false,
                                                    confirmButtonText: 'Okay'
                                                });
                                            }
                                        },
                                    });
                                }
                            });    
                        }    
                    }
                }
            });
        });

        $(document).on('click', '.commissions-list', function(){
            var eid = $(this).attr('data-id');
            $('#employee_commissions_list_modal').modal('show'); 
            load_employee_commissions_list(eid);            
        });

        function load_employee_commissions_list(eid){
            var url = base_url + 'user/_commission_list';
            $.ajax({
              url: url,
                type: "POST",
                data: {eid:eid},
                success: function(o) {
                    $('#employee-commissions-list-container').html(o);
                }
            });
        }

        $(document).on('click', '.edit-employee-commission-item', function(){
            var rowcid = $(this).attr('data-id');
            var amount = $('.row-commission-amount-'+rowcid).text();
            
            $('#row-employee-commission-'+rowcid).val(amount);
            $('.row-commission-amount-'+rowcid).hide();
            $('.row-commission-form-group-'+rowcid).show();
        });

        $(document).on('click', '.row-employee-commission-cancel', function(){
            var rowid = $(this).attr('data-id');
            $('.row-commission-amount-'+rowid).show();            
            $('.row-commission-form-group-'+rowid).hide();
        });

        $(document).on('click', '.row-employee-commission-update', function(){
            var rowid = $(this).attr('data-id');
            var com_amount = $('#row-employee-commission-'+rowid).val();
            if( com_amount > 0 ){                
                $.ajax({
                    url: base_url + 'user/_update_employee_commission',
                    type: "POST",
                    dataType: "json",
                    data: {cid:rowid, amount:com_amount},
                    success: function(data) {
                        if (data.is_success == 1) {                  
                            Swal.fire({
                                title: 'Success',
                                text: "Employee commission was successfully updated.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#32243d',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                $('.row-commission-amount-'+rowid).show();
                                $('.row-commission-amount-'+rowid).text(data.commission_amount);
                                $('.row-commission-form-group-'+rowid).hide();
                                $('#row-employee-commission-'+rowid).val(data.commission_amount);
                                $('.row-commission-total').text(data.total_commission);
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
            }else{
                Swal.fire({
                    showConfirmButton: false,
                    title: 'Failed',
                    text: 'Please enter commission amount',
                    icon: 'warning'
                });
            }
        });

        $(document).on('submit', '#edit_employee_form', function(e){
            e.preventDefault();

            var _this = $(this);
            var formData = new FormData(this);
            $.ajax({
              url: base_url + 'users/_update_employee',
                type: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false, 
                success: function(data) {
                    if (data.is_success == 1) {                  
                      Swal.fire({
                        title: 'Edit Employee',
                        text: "Data was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        //if (result.value) {
                          location.reload()
                        //}
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

                    $("#edit_employee_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                }
            });
        });

        $(document).on("click", ".change-password-item", function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");

            $("#changePasswordUserId").val(id);
            $("#changePasswordEmployeeName").val(name);
            $("#change_password_modal").modal("show");
        });

        $("#change_password_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>users/ajaxUpdateEmployeePasswordV2";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success) {
                        $("#change_password_modal").modal('hide');
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Employee password has been updated successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Failed',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');

            Swal.fire({
                title: 'Delete User',
                html: `Are you sure you want to delete employee <b>${name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "users/_delete_user",
                        data: {
                            eid: id
                        },
                        dataType: "json",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Delete Employee',
                                    text: "Data was successfully deleted.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'Failed',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });

        $(document).on("click", ".add-employee", function(){
            $('#commission-settings tbody').html('');
        });

        $(document).on("click", ".update-profile-item", function(){
            let id = $(this).attr("data-id");
            let img = $(this).attr("data-img");
            let _form = $("#change_profile_form");

            _form.find(".nsm-img-upload").css("background-image", "url('<?= base_url('/uploads/users/user-profile/') ?>" + img + "')");         
            _form.find("#user_id_prof").val(id);
            $("#change_profile_modal").modal("show");
        });

        $("#change_profile_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            let url = "<?php echo base_url(); ?>users/ajaxUpdateEmployeeProfilePhoto";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);
            let formData = new FormData(_this[0]);   

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: "json",
                contentType: false,
                cache: false,
                processData:false,
                data: formData,
                success: function(result) {
                    if (result == 1) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Employee photo has been updated successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });

                        $("#change_profile_modal").modal('hide');
                        _this.trigger("reset");
                    } else {
                        Swal.fire({
                            title: 'Failed',
                            text: "Please select a valid image.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
    });

    function populateEmployeeRoles() {
        let _container = $("#employee_role");
        let url = "<?php echo base_url('users/getRoles'); ?>";

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(result) {
                $.each(result, function(i, obj) {
                    _container.append("<option value=" + obj.id + ">" + obj.text + "</option>");
                });
            }
        });
    }

    $(document).on('click', '.change-adt-portal-access', function(){
        let uid = $(this).attr("data-id");
        let _container = $("#adt-portal-access-container");
        let url = "<?php echo base_url('user/_load_edit_adt_portal_login_details'); ?>";
        $("#change_adt_portal_access_modal").modal("show");
        showLoader(_container);

        $.ajax({
            url: url,
            type: "POST",
            data: {uid:uid},
            success: function(result) {
                _container.html(result);
               // _form.find("button[type=submit]").prop("disabled", false);                
            }
        });
    });

    $(document).on('click', '.btn-add-new-commision', function(e){
        let url = base_url + "user/_add_commission_form";
        $.ajax({
            type: 'POST',
            url: url,
            success: function(o) {
                $("#commission-settings tbody").append(o).children(':last').hide().fadeIn(400);                
            },
        });
    });

    $(document).on('click', '.btn-edit-add-new-commision', function(e){
        let url = base_url + "user/_add_commission_form";
        $.ajax({
            type: 'POST',
            url: url,
            success: function(o) {
                $("#edit-commission-settings tbody").append(o).children(':last').hide().fadeIn(400);                
            },
        });
    });

    $(document).on('submit', '#change-adt-portal-login', function(e){
        let _this = $(this);
        e.preventDefault();

        let url = "<?php echo base_url(); ?>user/_update_adt_portal_login_details";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);
        let formData = new FormData(_this[0]);   

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType: "json",
            contentType: false,
            cache: false,
            processData:false,
            data: formData,
            success: function(result) {
                if (result.is_success == 1) {
                    $("#change_adt_portal_access_modal").modal("hide");
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Employee ADT Sales Portal Access was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {                        
                        /*if (result.value) {
                            location.reload();
                        }*/
                    });
                } else {
                    Swal.fire({
                        title: 'Failed',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>