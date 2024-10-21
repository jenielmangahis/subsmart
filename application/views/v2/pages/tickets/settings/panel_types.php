<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_sales_area_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_tickets_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/service_ticket_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Manage Tickets Panel Types.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#modal-add-new-panel-type">
                                <i class='bx bx-plus-medical'></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Manage" style="width:5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $panelTypes ){ ?>
                            <?php foreach ($panelTypes as $panel) { ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-cog'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $panel->name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item row-edit-panel-type" href="javascript:void(0);" data-id="<?= $panel->id; ?>" data-name="<?= $panel->name; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item row-delete-panel-type" href="javascript:void(0);" data-id="<?= $panel->id; ?>" data-name="<?= $panel->name; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
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

    <div class="modal fade" id="modal-add-new-panel-type" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="frm-create-panel-type" method="post">
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><span id="modal-header-label">Add New Panel Type</span></span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="panel-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                                <input type="text" name="panel_type_name" id="panel-type-name" class="nsm-field form-control" placeholder="" required>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-create-panel-type">Save</button>
                    </div>                                       
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-panel-type" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="frm-update-panel-type" method="post">
                    <input type="hidden" name="pid" id="pid" value="" />
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><span id="modal-header-label">Edit Panel Type</span></span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="panel-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                                <input type="text" name="panel_type_name" id="edit-panel-type-name" class="nsm-field form-control" placeholder="" required>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-panel-type">Save</button>
                    </div>                                       
                </form>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">
$(function(){
    $('.row-edit-panel-type').on('click', function(){
        var pid = $(this).attr('data-id');
        var panel_name = $(this).attr('data-name');

        $('#pid').val(pid);
        $('#edit-panel-type-name').val(panel_name);
        $('#modal-edit-panel-type').modal('show');

    });

    $('.row-delete-panel-type').on('click', function(){
        var panel_type_name = $(this).attr('data-name');
        var pid = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete',
            html: `Proceed with deleting <b>${panel_type_name}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "tickets/_delete_panel_type",
                    data: {pid:pid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Delete',
                            text: 'Panel type was successfully deleted.',
                            }).then((result) => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });

    $('#frm-create-panel-type').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'tickets/_create_panel_type';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#frm-create-panel-type').serialize(),
            success: function(data) {    
                $('#btn-create-panel-type').html('Save');                   
                if (data.is_success) {
                    $('#modal-add-new-panel-type').modal('hide');
                    Swal.fire({
                        title: 'Create',
                        text: 'Data was successfully created',
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
                $('#btn-create-panel-type').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-update-panel-type').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'tickets/_update_panel_type';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#frm-update-panel-type').serialize(),
            success: function(data) {    
                $('#btn-create-panel-type').html('Save');                   
                if (data.is_success) {
                    $('#modal-edit-panel-type').modal('hide');
                    Swal.fire({
                        title: 'Update',
                        text: 'Data was successfully updated',
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
                $('#btn-update-panel-type').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>