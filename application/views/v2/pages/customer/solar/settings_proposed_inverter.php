<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_proposed_module_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process of managing interactions with existing as well as past and potential customers is to have one powerful platform that can provide an immediate response to your customer needs.
                            Try our quick action icons to create invoices, scheduling, communicating and more with all your customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_proposed_inverter_modal">
                                <i class='bx bx-fw bx-plus'></i> New Proposed Inverter
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name" style="width:80%;">Name</td>
                            <td data-name="Date Created">Date Created</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($proposedInverters)) :
                        ?>
                            <?php
                            foreach ($proposedInverters as $inv) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-notepad'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $inv->name; ?></td>
                                    <td><?= date("m/d/Y h:i A",strtotime($inv->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item edit-item" href="javascript:void(0);" data-id="<?= $inv->id; ?>"  data-name="<?= $inv->name; ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $inv->id; ?>" data-name="<?= $inv->name; ?>">Delete</a>
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

    <div class="modal fade" id="new_proposed_inverter_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;">Create Proposed Inveter</span>
                    <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                </div>
                <div class="modal-body">
                    <form id="new_proposed_inverter_form">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="mb-2">Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="proposed_inverter_name" id="proposed_inverter_name" value="" class="form-control" required="" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">                        
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-fixed-width" id="btn-save-proposed-inverter">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_proposed_inverter_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;">Edit Proposed Inverter</span>
                    <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                </div>
                <div class="modal-body">
                    <form id="edit_proposed_inverter_form">
                        <input type="hidden" name="proposed_inverter_id" id="edit_proposed_inverter_id" value="" />
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="mb-2">Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="proposed_inverter_name" id="edit_proposed_inverter_name" value="" class="form-control" required="" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">                        
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-fixed-width" id="btn-update-proposed-inverter">Save</button>
                        </div>
                    </form>
                </div>
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

        <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
        $(document).on("click", ".edit-item", function(){
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");

            $("#edit_proposed_inverter_id").val(id);
            $("#edit_proposed_inverter_name").val(name);

            $("#edit_proposed_inverter_modal").modal("show");
        });

        $("#new_proposed_inverter_form").on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_create_proposed_inverter',
                dataType: 'json',
                data: $('#new_proposed_inverter_form').serialize(),
                success: function(data) {    
                    $('#btn-save-proposed-inverter').html('Save');                   
                    if (data.is_success) {
                        $('#new_proposed_inverter_modal').modal('hide');
                        Swal.fire({
                            title: 'Proposed Inverter',
                            text: "Proposed inverter has been created successfully.",
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
                    $('#btn-save-proposed-inverter').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $("#edit_proposed_inverter_form").on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_update_proposed_inverter',
                dataType: 'json',
                data: $('#edit_proposed_inverter_form').serialize(),
                success: function(data) {    
                    $('#btn-update-proposed-inverter').html('Save');                   
                    if (data.is_success) {
                        $('#edit_proposed_inverter_modal').modal('hide');
                        Swal.fire({
                            title: 'Solar Proposed Inverter',
                            text: "Proposed inverter has been updated successfully.",
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
                    $('#btn-update-proposed-inverter').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });
        <?php } ?>

        <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>        
        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr('data-name');
            Swal.fire({
                title: 'Delete Proposed Inverter',
                html: `Are you sure you want to delete proposed inverter <b>${name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customers/_delete_proposed_inverter",
                        data: {iid : id},
                        dataType:"json",
                        success: function(data) {
                            if (data.is_success) {
                                Swal.fire({
                                    title: 'Delete Proposed Inverter',
                                    text: "Data Deleted Successfully!",
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
                    });
                }
            });
        });
        <?php } ?>
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>