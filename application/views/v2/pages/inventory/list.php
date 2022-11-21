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
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li onclick="location.href='<?= url('inventor/import') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-import"></i>
            </div>
            <span class="nsm-fab-label">Import</span>
        </li>
        <li class="export-items">
            <div class="nsm-fab-icon">
                <i class="bx bx-export"></i>
            </div>
            <span class="nsm-fab-label">Export</span>
        </li>
        <li onclick="location.href='<?= base_url('inventory/add') ?>'">
            <div class="nsm-fab-icon">
                <i class="bx bx-list-plus"></i>
            </div>
            <span class="nsm-fab-label">New Item</span>
        </li>
        <li class="btn-share-url">
            <div class="nsm-fab-icon">
                <i class="bx bx-share-alt"></i>
            </div>
            <span class="nsm-fab-label">Share</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#print_inventory_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-printer"></i>
            </div>
            <span class="nsm-fab-label">Print</span>
        </li>
    </ul>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/inventory_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/inventory_subtabs'); ?>
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
                            <!-- <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Item"> -->
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field_custom" placeholder="Search Item">
                        </div>
                    </div>
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
                            <button type="button" class="nsm-button" onclick="location.href='<?= url('inventor/import') ?>'">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?= base_url('inventory/add') ?>'">
                                <i class='bx bx-fw bx-list-plus'></i> New Item
                            </button>
                            <button type="button" class="nsm-button btn-share-url">
                                <i class='bx bx-fw bx-share-alt'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_inventory_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- <table class="nsm-table" id="inventory_list">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Item">Item</td>
                            <td data-name="Model">Model</td>
                            <td data-name="Brand">Brand</td>
                            <td data-name="Quantity-OH">Quantity-OH</td>
                            <td data-name="Quantity-Ordered">Quantity-Ordered</td>
                            <td data-name="Re-order Point">Re-order Point</td>
                            <td data-name="Location">Location</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($items)) :
                        ?>
                            <?php
                            foreach ($items as $item) :
                                if ($item[1] != "header") :
                            ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon table-checkbox">
                                                <input class="form-check-input select-one table-select" type="checkbox" data-id="<?php echo $item[3]; ?>">
                                            </div>
                                        </td>
                                        <td class="nsm-text-primary">
                                            <label class="nsm-link default d-block fw-bold"><?php echo $item[0]; ?></label>
                                            <label class="nsm-link default content-subtitle"><?php echo $item[1]; ?></label>
                                        </td>
                                        <td><?php echo $item[7]; ?></td>
                                        <td><?php echo $item[2]; ?></td>
                                        <td><?php echo getItemQtyOH($item[3]); ?></td>
                                        <td><?php echo $item[8]; ?></td>
                                        <td><?php echo $item[9]; ?></td>
                                        <td>
                                            <button class="nsm-button btn-sm" data-bs-toggle="modal" data-bs-target="#inventory_location_modal">See Location</button>
                                        </td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item" href="javascript:void(0)" data-id="<?= $item[3]; ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $item[3]; ?>">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table> -->
                <table id="INVENTORY_TABLE" class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Item">Item</td>
                            <td data-name="Model">Model</td>
                            <td data-name="Brand">Brand</td>
                            <td data-name="Quantity-OH">Quantity-OH</td>
                            <td data-name="Quantity-Ordered">Quantity-Ordered</td>
                            <td data-name="Re-order Point">Re-order Point</td>
                            <td data-name="Location">Location</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($items as $item) {
                        ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" data-id="<?php echo $item[3]; ?>">
                                </div>
                            </td>
                            <td class="nsm-text-primary">
                                <label class="nsm-link default d-block fw-bold"><?php echo $item[0]; ?></label>
                                <label class="nsm-link default content-subtitle"><?php echo $item[1]; ?></label>
                            </td>
                            <td><?php echo $item[7]; ?></td>
                            <td><?php echo $item[2]; ?></td>
                            <td><?php echo getItemQtyOH($item[3]); ?></td>
                            <td><?php echo $item[8]; ?></td>
                            <td><?php echo $item[9]; ?></td>
                            <td>
                                <button class="nsm-button btn-sm" data-bs-toggle="modal" data-bs-target="#inventory_location_modal">See Location</button>
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item edit-item" href="<?= base_url('inventory/edit_item/' . $item[3]); ?>" data-id="<?= $item[3]; ?>">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $item[10]; ?>">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

var INVENTORY_TABLE = $("#INVENTORY_TABLE").DataTable({
        "ordering": false,
        language: {
            processing: '<span>Fetching data...</span>'
        },
});

$("#search_field_custom").keyup(function() {
        INVENTORY_TABLE.search($(this).val()).draw()
    });
INVENTORY_TABLE_SETTINGS = INVENTORY_TABLE.settings();


        let selectedIds = [];

        $("#inventory_list").nsmPagination();

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));
        }, 1000));

        $("#select-all").on("change", function() {
            let isChecked = $(this).is(":checked");

            if (isChecked) {
                $(".nsm-table").find(".select-one").prop("checked", true);
                $(".batch-actions").find("a.dropdown-item").removeClass("disabled");
            } else {
                $(".nsm-table").find(".select-one").prop("checked", false);
                $(".batch-actions").find("a.dropdown-item").addClass("disabled");
            }
        });

        $(".btn-share-url").on("click", function() {
            var _shareableLink = $("<input>");
            $("body").append(_shareableLink);
            _shareableLink.val(window.location.href).select();
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

        $("#btn_print_inventory").on("click", function() {
            $("#inventory_table_print").printThis();
        });

        $(".export-items").click(function() {
            window.location.href = "<?= base_url('inventory/export_list') ?>";
        });

        $(document).on("change", ".table-select", function() {
            let _this = $(this);
            let id = _this.attr("data-id");

            if (!_this.prop("checked") && $(".select-all").prop("checked")) {
                $(".select-all").prop("checked", false);
            }

            if (!_this.prop("checked")) {
                selectedIds = $.grep(selectedIds, function(value) {
                    return value != id
                });
                $("#selected_ids").val(selectedIds);
            }
            else{
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
        Swal.fire({
            title: 'Delete Success',
            text: "Selected data has been deleted successfully!",
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'Okay'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('inventory/deleteMultiple') ?>",
                data: params,
                success: function(response) {
                    // Swal.fire({
                    //     title: 'Delete Success',
                    //     text: "Selected data has been deleted successfully!",
                    //     icon: 'success',
                    //     showCancelButton: false,
                    //     confirmButtonText: 'Okay'
                    // }).then((result) => {
                    //     if (result.value) {
                    //         location.reload();
                    //     }
                    // });
                },
            });
        }
    });
});

$(document).on("click", ".delete-item", function() {
    let id = $(this).attr('data-id');

    Swal.fire({
        title: 'Delete Inventory Item',
        text: "Are you sure you want to delete this item?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        Swal.fire({
            title: 'Delete Success',
            text: "Data has been deleted successfully!",
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'Okay'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });

        if (result.value) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('/inventory/delete') ?>",
                data: {
                    id: id
                },
                success: function(data) {
                    // if (data === "1") {
                    //     Swal.fire({
                    //         title: 'Delete Success',
                    //         text: "Data has been deleted successfully!",
                    //         icon: 'success',
                    //         showCancelButton: false,
                    //         confirmButtonText: 'Okay'
                    //     }).then((result) => {
                    //         if (result.value) {
                    //             location.reload();
                    //         }
                    //     });
                    // } else {
                    //     Swal.fire({
                    //         title: 'Delete Failed',
                    //         text: "Please try again later.",
                    //         icon: 'error',
                    //         showCancelButton: false,
                    //         confirmButtonText: 'Okay'
                    //     });
                    // }
                }
            });
        }
    });
});
    });

    function toggleBatchDelete(enable=True){
        enable ? $("#delete_selected").removeClass("disabled") : $("#delete_selected").addClass("disabled");
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>
