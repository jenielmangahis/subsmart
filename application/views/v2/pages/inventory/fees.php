<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_modals'); ?>
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
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('inventory/fees/add') ?>'">
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
                            Track and manage the storage, request, transfer, and consumption of every item in your inventory, and ensure that your mobile workforce has the right parts in stock to do their job.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field_custom" placeholder="Search Fees">
                        </div>
                    </div>
                    <?php if(checkRoleCanAccessModule('inventory', 'write')){ ?>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="delete_selected">Delete Selected</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn-add-new">
                                <i class='bx bx-fw bx-plus'></i> Fees
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>                
                 <div class="row">
                    <form id="frm-fees">
                    <table class="nsm-table" id="FEES_TABLE">
                        <thead>
                            <tr>
                                <td class="table-icon text-center show">
                                    <input class="form-check-input select-all table-select" type="checkbox">
                                </td>
                                <td class="table-icon show"></td>
                                <td data-name="Item" class="show">Item</td>
                                <td data-name="Billing Type">Billing Type</td>
                                <td data-name="Cost" style="text-align:right;">Cost</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) : ?>
                                    <tr>
                                        <td style="width:1%;" class="show">
                                            <div class="table-row-icon table-checkbox">
                                                <input class="form-check-input select-one table-select" type="checkbox" name="items[]" value="<?= $item[3]; ?>" data-id="<?php echo $item[3]; ?>">
                                            </div>
                                        </td>
                                        <td style="width:1%;" class="show">
                                            <div class="table-row-icon">
                                                <i class='bx bxs-dollar-circle'></i>
                                            </div>
                                        </td>
                                        <td class="nsm-text-primary show" style="width:60%;">
                                            <label class="nsm-link default d-block fw-bold"><?php echo $item[0]; ?></label>
                                            <label class="nsm-link default content-subtitle"><?php echo $item[1]; ?></label>
                                        </td>                                        
                                        <td><?php echo $item[5]; ?></td>
                                        <td style="text-align:right;">$<?php echo number_format($item[4],2,".",","); ?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <?php if(checkRoleCanAccessModule('inventory', 'write')){ ?>
                                                        <li><a class="dropdown-item row-edit-item" href="javascript:void(0);" data-id="<?= $item[3]; ?>">Edit</a></li>
                                                    <?php } ?>
                                                    <?php if(checkRoleCanAccessModule('inventory', 'delete')){ ?>
                                                        <li><a class="dropdown-item delete-item" href="javascript:void(0);" data-name="<?php echo $item[0]; ?>" data-id="<?= $item[3]; ?>">Delete</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-add-new-fee" tabindex="-1" aria-labelledby="modal-add-new-fee_label" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">Add New Inventory Fee</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form id="fees_form">                        
                            <div class="modal-body">                
                                <div class="row">
                                    <div class="mb-2 col-md-12">
                                        <strong>Name</strong>
                                        <input type="text" class="form-control " name="title" id="title" required/>
                                    </div>
                                    <div class="mb-2 col-md-6">
                                        <strong>Price</strong>
                                        <input type="number" step="any" class="form-control" name="price" id="price" value="0.00" required/>
                                    </div>
                                    <div class="mb-2 col-md-6">
                                        <strong>Frequency</strong>
                                        <select class="form-control" name="frequency" id="frequency" required>
                                            <option value="One Time" selected>One Time</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Monthly">Monthly</option>
                                            <option value="Yearly">Yearly</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-md-12 mb-2">
                                        <strong>Description</strong>
                                        <textarea class="form-control " name="description" id="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="nsm-button primary" id="btn-save-inventory-fee">Save</button>
                            </div>
                        </form>
                    </div>        
                </div>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-edit-fee" tabindex="-1" aria-labelledby="modal-edit-fee_label" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">Edit Inventory Fee</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form id="fees_update_form">           
                            <input type="hidden" name="fid" id="fid" value="">             
                            <div class="modal-body" id="edit-inventory-fee-container"></div>
                            <div class="modal-footer">
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="nsm-button primary" id="btn-update-inventory-fee">Save</button>
                            </div>
                        </form>
                    </div>        
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    let selectedIds = [];

    var FEES_TABLE = $("#FEES_TABLE").DataTable({
        "ordering": false,
        language: {
            processing: '<span>Fetching data...</span>'
        },
    });

    $("#search_field_custom").keyup(function() {
        FEES_TABLE.search($(this).val()).draw()
    });
    FEES_TABLE_SETTINGS = FEES_TABLE.settings();

    // $(".nsm-table").nsmPagination();

    // $("#search_field").on("input", debounce(function() {
    //     tableSearch($(this));
    // }, 1000));

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

    $('#btn-add-new').on('click', function(){
        $('#modal-add-new-fee').modal('show');
    });
    
    $("#fees_form").submit(function(e) {
        e.preventDefault(); 

        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/_create_inventory_fee",
            data: form.serialize(), 
            dataType:'json',
            success: function(data) {
                $("#btn-save-inventory-fee").html('Save');
                if (data.is_success) {
                    $('#modal-add-new-fee').modal('hide');
                    Swal.fire({
                        title: 'Inventory Fee',
                        text: "Inventory fee has been created successfully.",
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
                $("#btn-save-inventory-fee").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('.row-edit-item').on('click', function(){
        let id = $(this).attr('data-id');

        $('#fid').val(id);
        $('#modal-edit-fee').modal('show');

        $.ajax({
            type: "POST",
            url: base_url + "inventory/_edit_inventory_fee",
            data: {id:id}, 
            success: function(html) {
                $('#edit-inventory-fee-container').html(html);
            },
            beforeSend: function(){
                $('#edit-inventory-fee-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#fees_update_form").submit(function(e) {
        e.preventDefault(); 

        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/_update_inventory_fee",
            data: form.serialize(), 
            dataType:'json',
            success: function(data) {
                $("#btn-update-inventory-fee").html('Save');
                if (data.is_success) {
                    $('#modal-edit-fee').modal('hide');
                    Swal.fire({
                        title: 'Inventory Fee',
                        text: "Inventory fee has been updated successfully.",
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
                $("#btn-update-inventory-fee").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#delete_selected").on("click", function() {
        Swal.fire({
            title: 'Delete Inventory Fee',
            text: "Are you sure you want to delete the selected items?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "inventory/_delete_selected",
                    data: $('#frm-fees').serialize(),
                    dataType:"json",
                    success: function(data) {
                        if (data.is_success) {
                            Swal.fire({
                                title: 'Delete Inventory Fee',
                                text: "Inventory fees has been deleted successfully!",
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
                                text: "Please try again later.",
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

    $(document).on("click", ".delete-item", function() {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Inventory Fee',
            html: `Are you sure you want to delete <b>${name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "inventory/_delete",
                    dataType:'json',
                    data: {id: id},
                    success: function(data) {
                        if (data.is_success) {
                            Swal.fire({
                                title: 'Delete Inventory Fee',
                                text: "Inventory fee has been deleted successfully!",
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
                                text: "Please try again later.",
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