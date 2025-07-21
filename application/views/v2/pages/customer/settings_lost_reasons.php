<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_sales_area_modal">
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
                            Manage lost reasons.
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
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#modal-create-lost-reason">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Lost Reason</td>
                            <td data-name="Date Created" style="width:10%;">Date Created</td>
                            <td data-name="Manage" style="width:1%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lostReasons)) { ?>
                            <?php foreach ($lostReasons as $lr) { ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-bar-chart-square'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $lr->lost_reason; ?></td>
                                    <td><?= date("m/d/Y h:i A", strtotime($lr->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item row-edit-item" href="javascript:void(0);" data-id="<?= $lr->id; ?>" data-value="<?= $lr->lost_reason; ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item row-delete-item" href="javascript:void(0);" data-value="<?= $lr->lost_reason; ?>" data-id="<?= $lr->id; ?>">Delete</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else { ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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

        $(document).on('click', '.row-edit-item', function(){
            let lrid = $(this).attr('data-id');
            let reason = $(this).attr('data-value');

            $('#edit-lrid').val(lrid);
            $('#edit-lost-reason').val(reason);
            $('#modal-edit-lost-reason').modal('show');
        });

        $('#frm-add-new-lost-reason').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "customer_deals/_create_lost_reason",
                dataType: 'json',
                data: $('#frm-add-new-lost-reason').serialize(),
                success: function(data) { 
                    $('#btn-save-lost-reason').html('Save');                  
                    if (data.is_success) {                     
                        $('#modal-create-lost-reason').modal('hide');
                        $('#frm-add-new-lost-reason')[0].reset();

                        Swal.fire({
                            title: 'Lost Reason',
                            text: "New lost reason has been added successfully.",
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
                    $('#btn-save-lost-reason').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-update-lost-reason').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "customer_deals/_update_lost_reason",
                dataType: 'json',
                data: $('#frm-update-lost-reason').serialize(),
                success: function(data) { 
                    $('#btn-update-lost-reason').html('Save');                  
                    if (data.is_success) {                     
                        $('#modal-edit-lost-reason').modal('hide');
                        $('#frm-update-lost-reason')[0].reset();

                        Swal.fire({
                            title: 'Lost Reason',
                            text: "Lost reason has been updated successfully.",
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
                    $('#btn-update-lost-reason').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on("click", ".row-delete-item", function() {
            let lrid = $(this).attr("data-id");
            let reason = $(this).attr("data-value");

            Swal.fire({
                title: 'Delete Lost Reason',
                html: `Are you sure you want to delete reason <b>${reason}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customer_deals/_delete_lost_reason",
                        data: {lrid: lrid},
                        dataType: "JSON",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Delete Lost Reason',
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
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>