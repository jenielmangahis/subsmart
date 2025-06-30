<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_modals'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<style type="text/css">
    table {
        width: 100% !important;
    }
    .dataTables_filter, .dataTables_length{
        display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}
.row-item-description{
    font-size:12px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('inventory/item_groups/add') ?>'">
        <i class='bx bx-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Manage your item categories.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field_custom" placeholder="Search Categories">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    With Selected
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="delete_selected">Delete</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn-add-new-category">
                                <i class='bx bx-fw bx-plus'></i> Add New Category
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="nsm-table" id="ITEMGROUP_TABLE">
                        <thead>
                            <tr>
                                <td class="table-icon text-center">
                                        <input class="form-check-input select-all table-select" type="checkbox">
                                </td>
                                <td class="table-icon"></td>
                                <td data-name="Name">Name</td>
                                <!-- <td data-name="Description">Description</td> -->
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item_categories as $item) : ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon table-checkbox">
                                            <input class="form-check-input select-one table-select" type="checkbox" data-id="<?php echo $item->item_categories_id; ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-cube'></i>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary" style="width:60%;">
                                        <label class="d-block fw-bold"><?= $item->name; ?></label>
                                        <span class="text-mute row-item-description"><?= $item->description; ?></span>
                                    </td>
                                    <!-- <td><?= $item->description; ?></td> -->
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item edit-item" data-id="<?php echo $item->item_categories_id; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-name="<?= $item->name; ?>" data-id="<?php echo $item->item_categories_id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="modal fade nsm-modal fade" id="modal-add-new-category" tabindex="-1" aria-labelledby="modal-add-new-category_label" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Add New Item Category</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <form id="frm-create-item-category">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <strong>Name</strong>
                                <input type="text" class="form-control" name="category_name" id="category_name" required/>
                            </div>
                            <div class="col-lg-12 mb-2">
                                <strong>Description</strong>
                                <textarea class="form-control" name="category_description" id="category_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-category">Save</button>
                    </div>
                    </form>                
                </div>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="modal-edit-category" tabindex="-1" aria-labelledby="modal-edit-category_label" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title">Edit Item Category</span>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                    </div>
                    <form id="frm-update-item-category">
                    <div class="modal-body" id="edit-item-category-container"></div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-category">Save</button>
                    </div>
                    </form>                
                </div>
            </div>
        </div>


    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    let selectedIds = [];

    var ITEMGROUP_TABLE = $("#ITEMGROUP_TABLE").DataTable({
        "ordering": false,
        language: {
            processing: '<span>Fetching data...</span>'
        }        
    });

    $("#search_field_custom").keyup(function() {
        ITEMGROUP_TABLE.search($(this).val()).draw()
    });
    ITEMGROUP_TABLE_SETTINGS = ITEMGROUP_TABLE.settings();

    $('#btn-add-new-category').on('click', function(){
        $('#modal-add-new-category').modal('show');
    });

    $(document).on("change", ".table-select", function() {
        let id = $(this).attr("data-id");
        let _this = $(this);

        if (!_this.prop("checked") && $(".select-all").prop("checked")) {
            $(".select-all").prop("checked", false);
        }

        if (!_this.prop("checked")) {
            selectedIds = $.grep(selectedIds, function(value) {
                return value != id
            });
            $("#selected_ids").val(selectedIds);
        } else {
            selectedIds.push(id);
            $("#selected_ids").val(selectedIds);
        }

        toggleBatchDelete($(".table-select:checked").length > 0);
    });

    $(document).on("change", ".select-all", function() {
        let _this = $(this);

        if (_this.prop("checked")) {
            $(".table-select").prop("checked", true);
            selectedIds = [];

            $(".table-select").each(function() {
                if ($(this).prop("checked"))
                    selectedIds.push($(this).attr("data-id"));
            })
            $("#selected_ids").val(selectedIds);
        } else {
            $(".table-select").prop("checked", false);
            $("#selected_ids").val('');
            $("#delete_selected").addClass("disabled");
        }

        toggleBatchDelete(_this.prop("checked"));
    });

    $("#frm-create-item-category").submit(function(e) {
        e.preventDefault(); 

        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/_create_item_category",
            data: form.serialize(), 
            dataType:'json',
            success: function(data) {
                $("#btn-save-category").html('Save');
                if (data.is_success) {
                    $('#modal-add-new-category').modal('hide');
                    Swal.fire({
                        title: 'Item Category',
                        text: "Item category has been created successfully.",
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
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
            },
            beforeSend: function(){
                $("#btn-save-category").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('.edit-item').on('click', function(){
        var id = $(this).attr('data-id');

        $('#modal-edit-category').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "inventory/_edit_item_category",
            data: {id:id}, 
            success: function(response) {
                $('#edit-item-category-container').html(response);
            },
            beforeSend: function(){
                $('#edit-item-category-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#frm-update-item-category").submit(function(e) {
        e.preventDefault(); 

        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/_update_item_category",
            data: form.serialize(), 
            dataType:'json',
            success: function(data) {
                $("#btn-update-category").html('Save');
                if (data.is_success) {
                    $('#modal-edit-category').modal('hide');
                    Swal.fire({
                        title: 'Item Category',
                        text: "Item category has been updated successfully.",
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
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
            },
            beforeSend: function(){
                $("#btn-update-category").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#delete_selected").on("click", function() {
        let params = {
            ids: $("#selected_ids").val(),
        }

        Swal.fire({
            title: 'Delete Selected Items',
            text: "Are you sure you want to delete the selected items?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "inventory/deleteMultipleItemGroup",
                    data: params,
                    dataType: 'json',
                    success: function(data) {
                        if (data.is_success) {
                            Swal.fire({
                                title: 'Delete Item Category',
                                text: "Item categories has been deleted successfully!",
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
                                text: data.msg,
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


    $(document).on("click", ".delete-item", function() {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Item Category',
            html: `Are you sure you want to delete item category <b>${name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "inventory/item_groups/delete",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.is_success) {
                            Swal.fire({
                                title: 'Delete Item Category',
                                text: "Item category has been deleted successfully!",
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
                                text: data.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    }
                });
            }
        });
    });
});

function toggleBatchDelete(enable = True) {
    enable ? $("#delete_selected").removeClass("disabled") : $("#delete_selected").addClass("disabled");
}
</script>
<?php include viewPath('v2/includes/footer'); ?>