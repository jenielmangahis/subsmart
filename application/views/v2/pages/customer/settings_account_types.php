<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#modal-add-account-type">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php //include viewPath('v2/includes/page_navigations/customer_settings_tabs'); ?>
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Manage Account Types.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="">
                        </div>
                    </div> 

                    <div class="col-6 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">                                
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#modal-add-account-type">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <form id="frm-with-selected">
                <table class="nsm-table" id="tbl-account-types">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <?php } ?>
                            <td class="table-icon"></td>
                            <td data-name="Name">Code</td>
                            <td data-name="Is Default" style="width:5%;">Is Default</td>
                            <td data-name="Date Created" style="width:8%;">Date Created</td>
                            <td data-name="Manage" style="width:3%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($accountTypes)) :
                        ?>
                            <?php
                            foreach ($accountTypes as $at) :
                            ?>
                                <tr>
                                    <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="accountTypes[]" type="checkbox" value="<?= $at->id; ?>">
                                    </td>
                                    <?php } ?>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-layer'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary show"><?= $at->account_type; ?></td>
                                    <td>
                                        <span class="badge <?= $at->is_default == 'Yes' ? 'badge-primary' : 'badge-secondary'; ?>"><?= $at->is_default; ?></span>
                                    </td>
                                    <td><?= date("m/d/Y h:i A",strtotime($at->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item edit-item" href="javascript:void(0);" data-id="<?= $at->id; ?>" data-value="<?= $at->account_type; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item set-default-item" href="javascript:void(0);" data-id="<?= $at->id; ?>" data-value="<?= $at->account_type; ?>">Set As Default</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $at->id; ?>" data-value="<?= $at->account_type; ?>">Delete</a>
                                                </li>
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
                                <td colspan="6">
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
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $(document).on('change', '#select-all', function(){
            $('tr:visible .row-select:checkbox').prop('checked', this.checked);  
            let total= $('#tbl-account-types tr:visible input[name="accountTypes[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('change', '.row-select', function(){
            let total= $('#tbl-account-types input[name="accountTypes[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('click', '.edit-item', function(){
            let id = $(this).attr('data-id');
            let value = $(this).attr('data-value');

            $('#account-type-id').val(id);
            $('#edit-account-type').val(value);

            $('#modal-edit-account-type').modal('show');
        });

        $(document).on('click', '#with-selected-delete', function(){
            let total= $('#tbl-account-types input[name="accountTypes[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Account Type',
                    html: `Are you sure you want to delete selected rows?<br/><br/>Note : This cannot be undone.`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'customers/_delete_selected_account_types',
                            dataType: 'json',
                            data: $('#frm-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Delete Account Type',
                                        text: "Data deleted successfully!",
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
                            beforeSend: function(){
                                Swal.fire({
                                    icon: "info",
                                    title: "Processing",
                                    html: "Please wait while the process is running...",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    },
                                });
                            }
                        });

                    }
                });
            }        
        });

        $('#frm-save-account-type').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_account_type',
                dataType: 'json',
                data: $('#frm-save-account-type').serialize(),
                success: function(data) {    
                    $('#btn-save-account-type').html('Save');                   
                    if (data.is_success) {
                        $('#modal-add-account-type').modal('hide');
                        Swal.fire({
                            title: 'Add Account Type',
                            text: "Data has been created successfully.",
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
                            title: 'Error',
                            text: data.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            
                        });
                    }
                },
                beforeSend: function() {
                    $('#btn-save-account-type').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-update-account-type').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_update_account_type',
                dataType: 'json',
                data: $('#frm-update-account-type').serialize(),
                success: function(data) {    
                    $('#btn-update-account-type').html('Save');                   
                    if (data.is_success) {
                        $('#modal-edit-account-type').modal('hide');
                        Swal.fire({
                            title: 'Edit Account Type',
                            text: "Data has been updated successfully.",
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
                            title: 'Error',
                            text: data.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            
                        });
                    }
                },
                beforeSend: function() {
                    $('#btn-update-account-type').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");
            let value = $(this).attr('data-value');

            Swal.fire({
                title: 'Delete Account Type',
                html: `Are you sure you want to delete account type <b>${value}</b>?<br/><br/>Note : This cannot be undone.`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customers/_delete_account_type",
                        data: {id: id},
                        dataType: "JSON",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Delete Account Type',
                                    text: "Data Deleted Successfully!",
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
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });
                }
            });
        });

        $(document).on("click", ".set-default-item", function() {
            let id = $(this).attr("data-id");
            let value = $(this).attr('data-value');

            Swal.fire({
                title: 'Set As Default',
                html: `Are you sure you want to set account type <b>${value}</b> as default?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customer/_set_default_account_type",
                        data: {id: id},
                        dataType: "JSON",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Set As Default',
                                    text: "Data Updated Successfully!",
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
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Processing",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>