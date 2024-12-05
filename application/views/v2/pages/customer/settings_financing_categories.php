<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_system_package_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_settings_tabs'); ?>
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
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn-add-new-category">
                                <i class='bx bx-plus-medical'></i> New Financing Category
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Value">Value</td>
                            <td data-name="Date Created" style="width:10%;">Date Created</td>
                            <td data-name="Manage" style="width:5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($financingCategories)) { ?>
                            <?php foreach ($financingCategories as $category) { ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-package'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $category->name; ?></td>
                                    <td class="fw-bold nsm-text-primary"><?= $category->value; ?></td>
                                    <td><?= date("m/d/Y h:i A",strtotime($category->created_at)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item edit-row-item" href="javascript:void(0);" data-id="<?= $category->id; ?>" data-name="<?= $category->name; ?>" data-value="<?= $category->value; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-row-item" href="javascript:void(0);" data-id="<?= $category->id; ?>" data-name="<?= $category->name; ?>">Delete</a>
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

    <div class="modal fade" id="modal_add_financing_category" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;">Create Financing Category</span>
                    <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                </div>
                <div class="modal-body">
                    <form id="frm-add-financing-category">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="mb-2">Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="category_name" value="" class="form-control" required="" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="mb-2">Value</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="category_value" value="" class="form-control" required="" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">                        
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary" id="btn-save-financing-category">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_financing_category" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" style="font-size: 17px;">Edit Financing Category</span>
                    <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                </div>
                <div class="modal-body">
                    <form id="frm-edit-financing-category">
                        <input type="hidden" name="catid" id="cat-id" value="" />
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="mb-2">Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="category_name" id="edit-category-name" value="" class="form-control" required="" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="mb-2">Value</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="category_value" id="edit-category-value" value="" class="form-control" required="" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">                        
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary" id="btn-update-financing-category">Save</button>
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

        $('#btn-add-new-category').on('click', function(){
            $('#modal_add_financing_category').modal('show');
        });

        $('.edit-row-item').on('click', function(){
            var catid = $(this).attr('data-id');
            var catname = $(this).attr('data-name');
            var catval  = $(this).attr('data-value');

            $('#cat-id').val(catid);
            $('#edit-category-name').val(catname);
            $('#edit-category-value').val(catval);
            $('#modal_edit_financing_category').modal('show');
        });

        $('#frm-add-financing-category').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_update_financing_category',
                dataType: 'json',
                data: $('#frm-add-financing-category').serialize(),
                success: function(data) {    
                    $('#btn-save-financing-category').html('Save');                   
                    if (data.is_success) {
                        $('#modal_add_financing_category').modal('hide');
                        Swal.fire({
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
                    $('#btn-save-financing-category').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('#frm-edit-financing-category').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + 'customers/_update_financing_category',
                dataType: 'json',
                data: $('#frm-edit-financing-category').serialize(),
                success: function(data) {    
                    $('#btn-update-financing-category').html('Save');                   
                    if (data.is_success) {
                        $('#modal_edit_financing_category').modal('hide');
                        Swal.fire({
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
                    $('#btn-update-financing-category').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $('.delete-row-item').on('click', function(){
            var catid   = $(this).attr('data-id');
            var catname = $(this).attr('data-name');

            Swal.fire({
                title: 'Delete Financing Category',
                html: `Proceed with deleting financing category  <b>${catname}</b>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "customers/_delete_financing_category",
                        data: {catid:catid},
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Data was successfully deleted.',
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
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>