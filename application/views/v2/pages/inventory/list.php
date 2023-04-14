<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_modals'); ?>
<style type="text/css">
    table {
        width: 100% !important;
    }
    #INVENTORY_TABLE_filter, #INVENTORY_TABLE_length, #ITEM_LOCATION_TABLE_info, #ITEM_LOCATION_TABLE_paginate, #ITEM_LOCATION_TABLE_length, #ITEM_LOCATION_TABLE_filter, #HISTORY_TABLE_length, #HISTORY_TABLE_filter, #HISTORY_TABLE_info, .HISTORY_DIV{
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
    .modal-blur {
    filter: blur(4px);
    }
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li onclick="location.href='<?php echo url('inventory/import') ?>'">
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
        <li onclick="location.href='<?php echo base_url('inventory/add') ?>'">
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
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo url('inventory/import') ?>'">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('inventory/add') ?>'">
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
                        <?php foreach ($items as $item) { ?>
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
                                <button class="nsm-button btn-sm SEE_LOCATION" data-id="<?php echo $item[10]; ?>" disabled>See Location</button>
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item history-item link-modal-open" href="#" data-id="" id="history_items" data-toggle="modal" data-target="#history_list" onclick="$('#HISTORY_TABLE_SEARCH').val('<?php echo md5($item[3]); ?>').trigger('keyup');">History</a>
                                            <!-- ITEM_LOCATION_TABLE.columns(1).search('^'+DATA_ID+'$', true, false).draw(); -->
                                        </li>
                                        <li>
                                            <a class="dropdown-item edit-item" href="<?php echo base_url('inventory/edit_item/' . $item[3]); ?>" data-id="<?php echo $item[3]; ?>">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $item[10]; ?>">Delete</a>
                                        </li>
                                    </ul>
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


<!-- MODAL SECTION -->
<div class="modal" id="inventory_location_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Item Locations</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-1">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="nsm-button primary btn-sm" id="open-second-modal-btn">
                            <i class='bx bx-fw bx-list-plus'></i>  Add Location
                            </button>
                        </div>
                            <table id="ITEM_LOCATION_TABLE" class="nsm-table">
                                <thead>
                                    <tr>
                                        <td class='d-none' data-name="Item_ID">Item ID</td>
                                        <td data-name="Location">Location</td>
                                        <td data-name="Quantity">Quantity</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $TR = "";
                                        foreach ($items_location as $items_locations) {
                                            if ($items_locations != null) { 
                                                if (count($items_locations) > 1) {
                                                    for ($i=0; $i < count($items_locations); $i++) { 
                                                        $TR .= "<tr>
                                                            <td class='d-none'>".$items_locations[$i]['item_id']."</td>
                                                            <td>".getLocationName($items_locations[$i]['loc_id'])->location_name."</td>
                                                            <td>".$items_locations[$i]['qty']."</td>
                                                            <td>
                                                                <div class='dropdown table-management'>
                                                                    <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                                    </a>
                                                                    <ul class='dropdown-menu dropdown-menu-end'>
                                                                        <li>
                                                                        <a class='dropdown-item edit-location-item' data-id='".$items_locations[$i]['id']."'>Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class='dropdown-item delete-location-item' href='javascript:void(0);' data-id='".$items_locations[$i]['id']."'>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>";
                                                    } 
                                                } else {
                                                    $TR .= "<tr>
                                                            <td class='d-none'>".$items_locations[0]['item_id']."</td>
                                                            <td>".getLocationName($items_locations[0]['loc_id'])->location_name."</td>
                                                            <td>".$items_locations[0]['qty']."</td>
                                                            <td>
                                                                <div class='dropdown table-management'>
                                                                    <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                                    </a>
                                                                    <ul class='dropdown-menu dropdown-menu-end'>
                                                                        <li>
                                                                            <a class='dropdown-item edit-location-item' data-id='".$items_locations[0]['id']."'>Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <a class='dropdown-item delete-location-item' href='javascript:void(0);' data-id='".$items_locations[0]['id']."'>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>";
                                                }
                                            }
                                        }
                                        echo $TR;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="add_location_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add Location</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="location_form">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <input type="text" name="item_id" hidden>
                            <strong>Location</strong>
                            <select id="location" name="loc_id" class="form-control location" >
                                <option value="">Select Type</option>
                                    <?php foreach ($locations as $location): ?>
                                        <option value="<?= $location->loc_id ?>"><?= $location->location_name  ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <strong>Quantity</strong>
                            <input type="number" class="form-control " name="qty" id="qty" required />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-list-plus'></i> Add </button>
                        <button type="button" id="close-add-location-modal" class="nsm-button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="edit_location_qty_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Update Location</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="edit_location_qty">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <input type="text" name="item_id" hidden>
                            <strong>Location</strong>
                            <input type="text" class="form-control" name="location_name" id="location_name" readonly />
                            <input type="text" class="form-control" name="id" id="id" hidden />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <strong>Quantity</strong>
                            <input type="number" class="form-control " name="qty" id="qty" required />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-list-plus'></i> Save </button>
                        <button type="button" id="close-edit-location-qty-modal" class="nsm-button">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL SECTION -->

  <!-- Modal -->
  <div class="modal fade" id="history_list" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Item Dispense History</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>  
            <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 mb-2 HISTORY_DIV">
                            <input id="HISTORY_TABLE_SEARCH" style="width: 200px;" class="form-control" type="text" placeholder="Search History...">
                        </div>
                        <div class="col-sm-12">
                                <table id="HISTORY_TABLE" class="nsm-table">
                                <thead class="bg-light"> 
                                    <tr>
                                        <th data-name="Datetime">Datetime</th>
                                        <th data-name="Item" class="d-none">Item ID</th>
                                        <th data-name="Item" style="width: 125px;">Item</th>
                                        <th data-name="Deduction">Deduction</th>
                                        <th data-name="Remaining">Remaining</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items_history as $history) { ?>
                                    <tr>
                                        <td><?php echo $history->datetime ?></td>
                                        <td class="d-none"><?php echo $history->item_id ?></td>
                                        <td style="width: 125px;"><?php echo $history->item_name ?></td>
                                        <td>-<?php echo $history->deduction ?></td>
                                        <td><?php echo $history->remaining_quantity ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url("assets/js/v2/printThis.js") ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var HISTORY_TABLE = $("#HISTORY_TABLE").DataTable({
            "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            },
        });

        $("#HISTORY_TABLE_SEARCH").keyup(function() {
            HISTORY_TABLE.columns(1).search($(this).val()).draw();
        });
    });

    var ITEM_ID;
    $('.SEE_LOCATION').click(function() {
        ITEM_ID = $(this).data('id');
        $('#inventory_location_modal').modal('show');

    });
    $('#open-second-modal-btn').click(function() {
        $('#inventory_location_modal').modal('hide');
        $('#add_location_modal').modal('show');
    });
    $('.edit-location-item').click(async function() {
        var id = $(this).data('id');
        $('#inventory_location_modal').modal('hide');
        $('#edit_location_qty_modal').modal('show');
        getLoc(id).then(LOCATION_NAME => {
            console.log(LOCATION_NAME);
            $('#location_name').val(LOCATION_NAME);
            $('#id').val(id);
        });
    });
    $('#close-edit-location-qty-modal').click(function() {
        $('#inventory_location_modal').modal('show');
        $('#edit_location_qty_modal').modal('hide');
    });
    $('#close-add-location-modal').click(function() {
        $('#inventory_location_modal').modal('show');
        $('#add_location_modal').modal('hide');
    });

    function getLoc(id){
        return new Promise((resolve, reject) => {
            var postData = new FormData();
            postData.append('id', id);
            fetch('<?= base_url('inventory/getItemLocationNameById') ?>',{
                method: 'POST',
                body: postData
            }).then(response => response.json()).then(response => {
                var { locations } = response;
                resolve(locations.location_name);
            })
        }).catch((error) =>{
            console.log(error);
        })
    }
    $("#edit_location_qty").submit(function(e) {
        e.preventDefault();
        var form = $('#edit_location_qty');
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>inventory/updateItemLocationQty",
            data: form.serialize(), 
        });
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Quantity was updated successfully!',
        }).then((result) => {
                window.location.href = "<?= base_url()?>inventory";
        });
    });
    $("#location_form").submit(function(e) {
        e.preventDefault();
        var form = $('#location_form');
        var url = form.attr('action');
        form.find('input[name=item_id]').val(ITEM_ID); 
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>inventory/addNewItemLocation",
            data: form.serialize(), 
        });
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Item was added successfully!',
        }).then((result) => {
                window.location.href = "<?= base_url()?>/inventory";
        });
    });
$(document).ready(function() {

    var ITEM_LOCATION_TABLE = $("#ITEM_LOCATION_TABLE").DataTable({
        "ordering": false,
        language: {
            processing: '<span>Fetching data...</span>'
        },
    });

    $('.SEE_LOCATION').delay(1000).removeAttr('disabled');
    $('.SEE_LOCATION').hover(function() {
        const DATA_ID = parseInt($(this).attr("data-id"));
        ITEM_LOCATION_TABLE.columns(0).search('^'+DATA_ID+'$', true, false).draw();
    }, function() {
        ITEM_LOCATION_TABLE.search('').draw();
    });


    var INVENTORY_TABLE = $("#INVENTORY_TABLE").DataTable({
        "ordering": false,
        language: {
            processing: '<span>Fetching data...</span>'
        },
    });

    $("#search_field_custom").keyup(function() {
        INVENTORY_TABLE.search($(this).val()).draw();
    });

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
        window.location.href = "<?php echo base_url('inventory/export_list') ?>";
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
                    url: "<?php echo base_url('inventory/deleteMultiple') ?>",
                    data: params,
                    // success: function(response) {
                    //     Swal.fire({
                    //         title: 'Delete Success',
                    //         text: "Selected data has been deleted successfully!",
                    //         icon: 'success',
                    //         showCancelButton: false,
                    //         confirmButtonText: 'Okay'
                    //     }).then((result) => {
                    //         if (result.value) {
                    //             location.reload();
                    //         }
                    //     });
                    // },
                });
                Swal.fire({
                    title: 'Delete Success',
                    text: "Selected data has been deleted successfully!",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
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
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/inventory/delete') ?>",
                    data: {
                        id: id
                    },
                    // success: function(data) {
                    //     if (data === "1") {
                    //         Swal.fire({
                    //             title: 'Delete Success',
                    //             text: "Data has been deleted successfully!",
                    //             icon: 'success',
                    //             showCancelButton: false,
                    //             confirmButtonText: 'Okay'
                    //         }).then((result) => {
                    //             if (result.value) {
                    //                 location.reload();
                    //             }
                    //         });
                    //     } else {
                    //         Swal.fire({
                    //             title: 'Delete Failed',
                    //             text: "Please try again later.",
                    //             icon: 'error',
                    //             showCancelButton: false,
                    //             confirmButtonText: 'Okay'
                    //         });
                    //     }
                    // }
                });
                Swal.fire({
                    title: 'Delete Success',
                    text: "Data has been deleted successfully!",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        });
    });
    $(document).on("click", ".delete-location-item", function() {
        let id = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete Location',
            text: "Are you sure you want to delete this location?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/inventory/deleteItemLocation') ?>", 
                    data: {
                        id: id
                    },
                });
                Swal.fire({
                    title: 'Delete Success',
                    text: "Data has been deleted successfully!",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
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
