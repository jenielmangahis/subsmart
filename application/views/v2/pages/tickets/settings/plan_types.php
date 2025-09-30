<?php include viewPath('v2/includes/header'); ?>

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
                            Manage Service Ticket Plan Types.
                        </div>
                    </div>
                </div>                                
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('service-ticket-settings', 'write')){ ?>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">                            
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#modal-add-new-plan-type">
                                <i class='bx bx-plus'></i> Plan Type
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>                
                <table class="nsm-table" id="tbl-plan-type-list">
                    <thead>
                        <tr>
                            <?php if(checkRoleCanAccessModule('service-ticket-settings', 'write')){ ?>
                            <td class="table-icon text-center sorting_disabled">
                                <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                            </td>
                            <?php } ?>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Manage" style="width:5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $planTypes ){ ?>
                            <?php foreach ($planTypes as $plan) { ?>
                                <tr>
                                    <?php if(checkRoleCanAccessModule('service-ticket-settings', 'write')){ ?>
                                    <td>
                                        <input class="form-check-input row-select table-select" name="planTypes[]" type="checkbox" value="<?= $plan->id; ?>">
                                    </td>
                                    <?php } ?>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-cog'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $plan->name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('service-ticket-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item row-edit-plan-type" href="javascript:void(0);" data-id="<?= $plan->id; ?>" data-name="<?= $plan->name; ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('service-ticket-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item row-delete-plan-type" href="javascript:void(0);" data-id="<?= $plan->id; ?>" data-name="<?= $plan->name; ?>">Delete</a>
                                                </li>
                                                <?php } ?>
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

    <div class="modal fade" id="modal-add-new-plan-type" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="frm-create-plan-type" method="post">
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><span id="modal-header-label">Add New Plan Type</span></span>
                        <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="plan-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                                <input type="text" name="plan_type_name" id="plan-type-name" class="nsm-field form-control" placeholder="" required>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-create-plan-type">Save</button>
                    </div>                                       
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-plan-type" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="frm-update-plan-type" method="post">
                    <input type="hidden" name="pid" id="pid" value="" />
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><span id="modal-header-label">Edit Plan Type</span></span>
                        <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="plan-type-name" class="content-subtitle fw-bold d-block mb-2">Name </label>
                                <input type="text" name="plan_type_name" id="edit-plan-type-name" class="nsm-field form-control" placeholder="" required>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-plan-type">Save</button>
                    </div>                                       
                </form>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">
$(function(){
    $(".nsm-table").nsmPagination();

    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

    $(document).on('change', '#select-all', function(){
        $('tr:visible .row-select:checkbox').prop('checked', this.checked);  
        let total= $('#tbl-plan-type-list tr:visible input[name="planTypes[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#tbl-plan-type-list input[name="planTypes[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('click', '#with-selected-delete', function(){
        let total= $('#tbl-plan-type-list input[name="planTypes[]"]:checked').length;
        if( total <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select rows',
            });
        }else{
            Swal.fire({
                title: 'Delete Plan Types',
                html: `Are you sure you want to delete selected rows?<br /><br /><small>Note : This cannot be undone</small>`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        method: 'POST',
                        url: base_url + 'tickets/_with_selected_delete_panel_types',
                        dataType: 'json',
                        data: $('#frm-with-selected').serialize(),
                        success: function(result) {                        
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                    title: 'Delete Plan Types',
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

    $('.row-edit-plan-type').on('click', function(){
        var pid = $(this).attr('data-id');
        var plan_name = $(this).attr('data-name');

        $('#pid').val(pid);
        $('#edit-plan-type-name').val(plan_name);
        $('#modal-edit-plan-type').modal('show');

    });

    $('.row-delete-plan-type').on('click', function(){
        var plan_type_name = $(this).attr('data-name');
        var pid = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete',
            html: `Proceed with deleting <b>${plan_type_name}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "tickets/_delete_plan_type",
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

    $('#frm-create-plan-type').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'tickets/_create_plan_type';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#frm-create-plan-type').serialize(),
            success: function(data) {    
                $('#btn-create-plan-type').html('Save');                   
                if (data.is_success) {
                    $('#modal-add-new-plan-type').modal('hide');
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
                $('#btn-create-plan-type').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-update-plan-type').on('submit', function(e){
        e.preventDefault();
        var url = base_url + 'tickets/_update_plan_type';

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#frm-update-plan-type').serialize(),
            success: function(data) {    
                $('#btn-create-plan-type').html('Save');                   
                if (data.is_success) {
                    $('#modal-edit-plan-type').modal('hide');
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
                $('#btn-update-plan-type').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>