<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/employees_modals'); ?>
<?php include viewPath('v2/includes/accounting/modal_forms/payroll_modal'); ?>

<style>
    table.dataTable thead th, 
    table.dataTable thead td {
        padding: 10px 10px !important;
        border-bottom: 1px solid #e8e8e8 !important;
    }

    table.dataTable.no-footer {
        border-bottom: unset !important;
    }

    .dataTables_length,
    .dataTables_filter {
        display: none;
    }
    .custom-header{
        background-color: #6a4a86;
        color: #ffffff;
        font-size: 15px;
        padding: 10px;
        display:block;
    }
    #employeeTable .badge{
        width:80px;
        display:block;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/employees_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Here you will get a detailed summary of pay rate, payment method and the status of each of your employee. With this report, you will be able to forecast a better budget for future weeks.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Employee...">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">  
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <?php } ?>                        
                        <div class="d-inline-block me-2">
                            <select id="status_filter" class="form-select w-auto">
                                <option value="">All Employees</option>
                                <option value="Active">Active</option>
                                <option value="Disabled">Inactive</option>
                            </select>
                        </div>
                        <div class="d-inline-block me-2">
                            <select id="pay_method_filter" class="form-select w-auto">
                                <option value="">All Pay Method</option>
                                <option value="direct-deposit">Direct deposit</option>
                                <option value="paper-check">Check</option>
                                <option value="Missing">Missing</option>
                            </select>
                        </div>

                        <!-- <div class="d-inline-block me-2">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>More actions</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="run-payroll">Run payroll</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="bonus-only">Bonus only</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="commission-only">Commission only</a></li>
                            </ul>
                        </div> -->

                        <!-- <div class="d-inline-block me-2">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#add_employee_modal">
                                <i class='bx bx-fw bx-list-plus'></i> Add an employee
                            </button>
                        </div> -->

                        <div class="nsm-page-buttons page-button-container">                            
                            <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                            <div class="btn-group nsm-main-buttons" style="margin-bottom: 4px !important;">
                                <button type="button" class="btn btn-nsm" data-bs-toggle="modal" data-bs-target="#add_employee_modal"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Employee</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                    <li><a class="dropdown-item" href="javascript:void(0);" id="run-payroll">Run payroll</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" id="bonus-only">Bonus only</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" id="commission-only">Commission only</a></li>
                                    <li><a class="dropdown-item" id="btn-archived" href="javascript:void(0);">Archived</a></li>                               
                                    <li><a class="dropdown-item" id="btn-export-list" href="javascript:void(0);">Export</a></li>                                        
                                </ul>
                            </div>
                            <?php } ?>
                        </div>

                        <!-- <div class="d-inline-block">
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Show columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHidePayRate" name="col_chk" class="form-check-input">
                                    <label for="showHidePayRate" class="form-check-label">Pay rate</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHidePayMethod" name="col_chk" class="form-check-input">
                                    <label for="showHidePayMethod" class="form-check-label">Pay method</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHideStatus" name="col_chk" class="form-check-input">
                                    <label for="showHideStatus" class="form-check-label">Status</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHideEmailAddress" name="col_chk" class="form-check-input">
                                    <label for="showHideEmailAddress" class="form-check-label">Email address</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="showHidePhoneNum" name="col_chk" class="form-check-input">
                                    <label for="showHidePhoneNum" class="form-check-label">Phone number</label>
                                </div>
                                <div class="form-check form-switch nsm-switch">
                                    <label for="privacy" class="form-check-label">Privacy </label>
                                    <input type="checkbox" name="privacy" id="privacy" class="form-check-input">
                                </div>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="frm-with-selected">
                            <table id="employeeTable" class="nsm-table w-100 tbl-users-list">
                                <thead>
                                    <tr>
                                        <?php if(checkRoleCanAccessModule('users', 'write')){ ?>
                                        <th class="table-icon text-center sorting_disabled">
                                            <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                        </th>
                                        <?php } ?>                                        
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Payscale</th>
                                        <th>Pay Method</th>                                        
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>

<script>
    var emp_url = `${base_url}accounting/employees/_get_employees`;

    // DataTable Configuration ===============
    var employee_table = $('#employeeTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": {
            //"url": "<?php //echo base_url('accounting_controllers/employees/getEmployeeServerside/'); ?>",
            "url": emp_url,
            "type": "POST",
        },
        "language": {
            "infoFiltered": "",
        },
        // "order": [[0, 'desc'] ],
    });

    populateEmployeeRoles();
    populateEmployeeRolesV2();

    $(document).on('keyup', '#search_field', function() {
        employee_table.search($(this).val()).draw();
    });

    $(document).on('change', '#status_filter', function() {
        employee_table.column(4).search($(this).val()).draw();
    });

    $(document).on('change', '#pay_method_filter', function() {
        employee_table.column(3).search($(this).val()).draw();
    });

    function showHideColumn(id) {
        alert(id);
    }

    $('input[name="col_chk"]').change(function (e) { 
        const checkbox = $(this);
        const checkboxID = $(this).attr('id');
        switch (checkboxID) {
            case 'showHidePayRate':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(2), #employeeTable td:nth-child(2)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(2), #employeeTable td:nth-child(2)').hide();
                }
                break;
            case 'showHidePayMethod':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(3), #employeeTable td:nth-child(3)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(3), #employeeTable td:nth-child(3)').hide();
                }
                break;
            case 'showHideStatus':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(4), #employeeTable td:nth-child(4)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(4), #employeeTable td:nth-child(4)').hide();
                }
                break;
            case 'showHideEmailAddress':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(5), #employeeTable td:nth-child(5)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(5), #employeeTable td:nth-child(5)').hide();
                }
                break;
            case 'showHidePhoneNum':
                if (checkbox.prop('checked') == true) {
                    $('#employeeTable th:nth-child(6), #employeeTable td:nth-child(6)').fadeIn('fast');
                } else {
                    $('#employeeTable th:nth-child(6), #employeeTable td:nth-child(6)').hide();
                }
                break;
        }
    });

    $(document).on("click", ".delete-employee-item", function() {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Employee',
            html: `Are you sure you want to delete employee <b>${name}</b>?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
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

    $('#btn-archived, #btn-mobile-archived').on('click', function(){
        $('#modal-view-archive').modal('show');

         $.ajax({
            type: "POST",
            url: base_url + "users/_archived_list",
            success: function(html) {    
                $('#users-archived-container').html(html);
            },
            beforeSend: function() {
                $('#users-archived-container').html('<div class="col"><span class="bx bx-loader bx-spin"></span></div>');
            }
        });
    });   
    
    $(document).on('click', '#with-selected-restore', function(){
        let total= $('#archived-users input[name="users[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Restore Employees',
                html: `Are you sure you want to restore selected rows?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_restore_selected_users',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Restore Employees',
                                    text: "Data restored successfully!",
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
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    }); //Ok

    $(document).on('click', '#with-selected-perma-delete', function(){
        let total = $('#archived-users input[name="users[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Employees',
                html: `Are you sure you want to <b>permanently delete</b> selected rows? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_permanently_delete_selected_users',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Delete Employees',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        //location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    }); //Ok 

    $(document).on('click', '#btn-empty-archives', function(){        
        let total = $('#archived-users input[name="users[]"]').length;        
        if( total > 0 ){
            Swal.fire({
                title: 'Empty Archived',
                html: `Are you sure you want to <b>permanently delete</b> <b>${total}</b> archived employees? <br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_delete_all_archived_users',
                        dataType: 'json',
                        data: $('#frm-archive-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                $('#modal-view-archive').modal('hide');
                                Swal.fire({
                                    title: 'Empty Archived',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        //location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }else{
            Swal.fire({                
                icon: 'error',
                title: 'Error',              
                html: 'Archived is empty',
            });
        }        
    }); //Ok

    $(document).on('click', '.btn-restore-user', function(){
        let user_id   = $(this).attr('data-id');
        let user_name = $(this).attr('data-name');

        Swal.fire({
            title: 'Restore Employee',
            html: `Are you sure you want to restore user <b>${user_name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'users/_restore_user',
                    data: {
                        user_id: user_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Restore Employee',
                                html: "Data updated successfully!",
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
                                title: 'Error',
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
    }); //Ok

    $(document).on('click', '.btn-permanently-delete-user', function(){
        let user_id   = $(this).attr('data-id');
        let user_name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Employee',
            html: `Are you sure you want to <b>permanently delete</b> employee <b>${user_name}</b>? <br/><br/>Note : This cannot be undone.`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'users/_delete_archived_user',
                    data: {
                        user_id: user_id
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#modal-view-archive').modal('hide');
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Employee',
                                html: "Data deleted successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    //location.reload();
                                //}
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
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

    $("#btn-export-list, .btn-export-list").on("click", function() {
        location.href = base_url + 'accounting/employees/export_list';
    });    

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('.tbl-users-list input[name="users[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Employees',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Deleted data can be restored via archived list.</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'users/_archive_selected_users',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Employees',
                                    text: "Data deleted successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: result.msg,
                                });
                            }
                        },
                    });

                }
            });
        }        
    });   
    
    $(document).on('change', '#select-all', function(){
        $('.row-select:checkbox').prop('checked', this.checked);  
        let total= $('.tbl-users-list input[name="users[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('.tbl-users-list input[name="users[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
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

    function populateEmployeeRolesV2() {        
        let _container = $("#employee-role");
        let url = "<?php echo base_url('users/_get_roles_by_default_company'); ?>";

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

</script>