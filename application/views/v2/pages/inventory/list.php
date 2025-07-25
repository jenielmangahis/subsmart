<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_modals'); ?>
<style type="text/css">
    table {
        width: 100% !important;
    }
    #INVENTORY_TABLE_filter, #INVENTORY_TABLE_length, #ITEM_LOCATION_TABLE_info, #ITEM_LOCATION_TABLE_paginate, #ITEM_LOCATION_TABLE_length, #ITEM_LOCATION_TABLE_filter, #HISTORY_TABLE_length, #HISTORY_TABLE_filter, #HISTORY_TABLE_info, .HISTORY_DIV, #CUSTOMER_HISTORY_TABLE_length, #CUSTOMER_HISTORY_TABLE_filter, #CUSTOMER_HISTORY_TABLE_info, #LOCATION_STATUS_TABLE_length, #LOCATION_STATUS_TABLE_filter, #LOCATION_STATUS_TABLE_info {
        display: none;
    }
    #INV_ITEM_NAME {
        font-weight: normal;
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
        <!-- <li class="btn-share-url">
            <div class="nsm-fab-icon">
                <i class="bx bx-share-alt"></i>
            </div>
            <span class="nsm-fab-label">Share</span>
        </li> -->
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
                        <?php if(checkRoleCanAccessModule('inventory', 'write')){ ?>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('inventory/import') ?>'">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button export-items primary">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('inventory/add') ?>'">
                                <i class='bx bx-fw bx-plus'></i> Add New Item
                            </button>
                            <!-- <button type="button" class="nsm-button btn-share-url">
                                <i class='bx bx-fw bx-share-alt'></i>
                            </button> -->
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_inventory_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <form id="frm-list-inventory">
                    <table id="INVENTORY_TABLE" class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon text-center">
                                    <input class="form-check-input select-all table-select" type="checkbox">
                                </td>
                                <td class="table-icon"></td>
                                <td data-name="Item">Item</td>
                                <td data-name="Model">Model</td>
                                <td data-name="Brand">Brand</td>
                                <td data-name="Quantity-OH" style="text-align:right;">Quantity-OH</td>
                                <td data-name="Quantity-Ordered" style="text-align:right;">Quantity-Ordered</td>
                                <td data-name="Re-order Point" style="text-align:right;">Re-order Point</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) { ?>
                            <tr>
                                <td style="width:1%;">
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select" type="checkbox" data-id="<?php echo $item[3]; ?>" name="items[<?= $item[3]; ?>]" value="<?php echo $item[3]; ?>">
                                    </div>
                                </td>
                                <td style="width:1%;">
                                    <div class="table-row-icon">
                                        <i class='bx bx-package' ></i>
                                    </div>
                                </td>
                                <td class="nsm-text-primary">
                                    <label class="nsm-link default d-block fw-bold"><?php echo $item[0]; ?></label>
                                    <label class="nsm-link default content-subtitle"><?php echo $item[1]; ?></label>
                                </td>
                                <td><?php echo $item[7] != '' ? $item[7] : '---'; ?></td>
                                <td><?php echo $item[2] != '' ? $item[2] : '---'; ?></td>
                                <td style="text-align:right;"><?php echo getItemQtyOH($item[3]); ?></td>
                                <td style="text-align:right;"><?php echo $item[8] != '' ? $item[8] : 0; ?></td>
                                <td style="text-align:right;"><?php echo $item[9] != '' ? $item[9] : 0; ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">                                        
                                            <?php if(checkRoleCanAccessModule('inventory', 'write')){ ?>
                                            <li>
                                                <a class="dropdown-item edit-item" href="<?php echo base_url('inventory/edit_item/' . $item[3]); ?>" data-id="<?php echo $item[3]; ?>">Edit</a>
                                            </li>
                                            <?php } ?>
                                            <li>
                                                <a class="dropdown-item edit-item SEE_LOCATION" href="javascript:void(0);" data-id="<?php echo $item[10]; ?>">Storage Location</a>
                                            </li>
                                            <?php if(checkRoleCanAccessModule('inventory', 'write')){ ?>
                                            <li>
                                                <a class="dropdown-item delete-item" href="javascript:void(0);" data-name="<?= $item[0]; ?>" data-id="<?php echo $item[10]; ?>">Delete</a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL SECTION -->
<div class="modal fade" id="inventory_location_modal" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="width:640px;">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Item Locations</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 mt-1 mb-1">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="nsm-button primary btn-sm" id="open-second-modal-btn">
                            <i class='bx bx-fw bx-list-plus'></i>  Add Location
                            </button>
                        </div>
                    </div>
                    <div class="item-locations-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="add_location_modal" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add Location</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="location_form">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <input type="text" name="item_id" hidden>
                            <strong>Location</strong>
                            <select id="location" name="loc_id" class="form-control location" required="">
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
                        <button type="submit" class="nsm-button primary">Add</button>
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
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="edit_location_qty">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <input type="text" id="item-id" name="item_id" hidden>
                            <strong>Location</strong>
                            <input type="text" class="form-control" name="location_name" id="location_name" readonly />
                            <input type="text" class="form-control" name="id" id="id" hidden />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <strong>Quantity</strong>
                            <input type="number" class="form-control " name="qty" id="update-location-qty" required />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="nsm-button primary">Save </button>
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
        <div class="modal-content" style="width: 110%;">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Item Transaction History <i id="INV_ITEM_NAME"></i></span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>  
            <div class="modal-body">
                <div id="ITH_LOADER">
                    <h5>Fetching data, please wait...</h5>
                </div>
                <div id="ITH_CONTENT" style="display: none;">
                    <ul class="nav nav-pills mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="true">User</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customer" type="button" role="tab" aria-controls="customer" aria-selected="false">Customer</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location_status" type="button" role="tab" aria-controls="location_status" aria-selected="false">Location Status</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                            <div class="row">
                                <div class="col-sm-12 mb-2 HISTORY_DIV">
                                    <input id="HISTORY_TABLE_SEARCH" style="width: 250px;" class="form-control" type="text" placeholder="Search History...">
                                </div>
                                <div class="col-sm-12">
                                        <table id="HISTORY_TABLE" class="nsm-table">
                                        <thead class="bg-light"> 
                                            <tr>
                                                <th data-name="ID" class="d-none">ID</th>
                                                <th data-name="Datetime">Date</th>
                                                <th data-name="Item" class="d-none">Search ID</th>
                                                <th data-name="Name Transaction">User&nbsp;</th>
                                                <th data-name="Location">Location</th>
                                                <th data-name="Transaction">Transaction</th>
                                                <th data-name="Running Quantity">Running Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($user_item_transaction_history as $history) { ?>
                                            <tr>
                                                <td class="d-none"><?php echo $history->id; ?></td>
                                                <td><?php echo date_format(date_create($history->datetime), "m/d/Y"); ?></td>
                                                <td class="d-none"><?php echo $history->search_id; ?></td>
                                                <td><?php echo $history->name_transaction; ?></td>
                                                <td><?php echo $history->item_location; ?></td>
                                                <td><?php echo $history->transaction; ?></td>
                                                <td><?php echo $history->running_quantity; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                            <div class="row">
                                <div class="col-sm-12 mb-2 HISTORY_DIV">
                                    <input id="CUSTOMER_HISTORY_TABLE_SEARCH" style="width: 250px;" class="form-control" type="text" placeholder="Search History...">
                                </div>
                                <div class="col-sm-12">
                                        <table id="CUSTOMER_HISTORY_TABLE" class="nsm-table">
                                        <thead class="bg-light"> 
                                            <tr>
                                                <th data-name="ID" class="d-none">ID</th>
                                                <th data-name="Datetime">Date</th>
                                                <th data-name="Item" class="d-none">Search ID</th>
                                                <th data-name="Name Transaction">Customer</th>
                                                <th data-name="Location">Location</th>
                                                <th data-name="Transaction">Transaction</th>
                                                <th data-name="Running Quantity">Running Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($customer_transaction_history as $history) { ?>
                                            <tr>
                                                <td class="d-none"><?php echo $history->id; ?></td>
                                                <td><?php echo date_format(date_create($history->datetime), "m/d/Y"); ?></td>
                                                <td class="d-none"><?php echo $history->search_id; ?></td>
                                                <td><?php echo $history->name_transaction; ?></td>
                                                <td><?php echo $history->item_location; ?></td>
                                                <td><?php echo $history->transaction; ?></td>
                                                <td><?php echo $history->running_quantity; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="location_status" role="tabpanel" aria-labelledby="location-tab">
                            <div class="row">
                                <!-- <?php
                                    echo "<pre>";
                                    print_r ($items_location);
                                    echo "</pre>";
                                ?> -->
                                <div class="col-sm-12 mb-2 HISTORY_DIV">
                                    <input id="LOCATION_STATUS_TABLE_SEARCH" style="width: 250px;" class="form-control" type="text" placeholder="Search History...">
                                </div>
                                <div class="col-sm-12">
                                        <table id="LOCATION_STATUS_TABLE" class="nsm-table">
                                        <thead class="bg-light"> 
                                            <tr>
                                                <th data-name="Item" class="d-none">Search ID</th>
                                                <th data-name="Location">Location</th>
                                                <th data-name="Running Quantity">Remaining Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach ($items_location as $items_locations) {
                                                    for ($i = 0; $i < count($items_locations); $i++) { 
                                                        echo "<tr>";
                                                        echo "<td class='d-none'>".md5($items_locations[$i]['item_id'])."</td>";
                                                        echo "<td>".$items_locations[$i]['name']."</td>";
                                                        echo "<td>".$items_locations[$i]['qty']."</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url("assets/js/v2/printThis.js") ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#ITH_LOADER').hide();
        $('#ITH_CONTENT').fadeIn('fast');

        var HISTORY_TABLE = $("#HISTORY_TABLE").DataTable({
            order: [[0, 'desc']],
            // "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            },
        });

        $("#HISTORY_TABLE_SEARCH").keyup(function() {
            HISTORY_TABLE.columns(2).search($(this).val()).draw();
        });

        var CUSTOMER_HISTORY_TABLE = $("#CUSTOMER_HISTORY_TABLE").DataTable({
            order: [[0, 'desc']],
            // "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            },
        });

        $("#CUSTOMER_HISTORY_TABLE_SEARCH").keyup(function() {
            CUSTOMER_HISTORY_TABLE.columns(2).search($(this).val()).draw();
        });

        var LOCATION_STATUS_TABLE = $("#LOCATION_STATUS_TABLE").DataTable({
            order: [[0, 'desc']],
            // "ordering": false,
            language: {
                processing: '<span>Fetching data...</span>'
            },
        });

        $("#LOCATION_STATUS_TABLE_SEARCH").keyup(function() {
            LOCATION_STATUS_TABLE.columns(0).search($(this).val()).draw();
        });
    });

    var ITEM_ID;
    $('.SEE_LOCATION').click(function() {
        ITEM_ID = $(this).data('id');
        $('#inventory_location_modal').modal('show');
        load_item_location_list(ITEM_ID);
    });

    function load_item_location_list(item_id){
        $.ajax({
            type: "POST",
            url: base_url + "inventory/_item_location_list",
            data: {item_id:item_id},
            success: function(html) {    
                $('.item-locations-container').html(html);
            },
            beforeSend: function() {
                $('.item-locations-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }

    $('#open-second-modal-btn').click(function() {
        $('#inventory_location_modal').modal('hide');
        $('#add_location_modal').modal('show');
        $('#qty').val('');
        $('#location').val('');
    });

    $(document).on('click', '.edit-location-item', function(){
        var id = $(this).data('id');
        var item_id = $(this).data('item-id');
        var qty     = $(this).data('qty');

        $('#inventory_location_modal').modal('hide');
        $('#edit_location_qty_modal').modal('show');
        $('#item-id').val(item_id);
        $('#update-location-qty').val(qty);

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
            dataType: "json",
            success: function (response) {
                $('#edit_location_qty_modal').modal('hide');
                $('#inventory_location_modal').modal('show');
                load_item_location_list(response.item_id);
                // Swal.fire({
                //     icon: 'success',
                //     title: 'Success',
                //     text: 'Quantity was updated successfully!',
                // }).then((result) => {
                //     $('#edit_location_qty_modal').modal('hide');
                //     $('#inventory_location_modal').modal('show');
                //     load_item_location_list(response.item_id);
                // });
            }
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
            dataType:'json',
            success: function(response){
                $('#add_location_modal').modal('hide');
                $('#inventory_location_modal').modal('show');
                load_item_location_list(response.item_id);
            }
        });        
    });
$(document).ready(function() {

    // var ITEM_LOCATION_TABLE = $("#ITEM_LOCATION_TABLE").DataTable({
    //     "ordering": false,
    //     language: {
    //         processing: '<span>Fetching data...</span>'
    //     },
    //     "columnDefs": [
    //         { "width": "5%"},
    //         { "width": "80%"},
    //         { "width": "5%"}
    //     ],
    // });

    $('.SEE_LOCATION').delay(1000).removeAttr('disabled');
    // $('.SEE_LOCATION').hover(function() {
    //     const DATA_ID = parseInt($(this).attr("data-id"));
    //     ITEM_LOCATION_TABLE.columns(0).search('^'+DATA_ID+'$', true, false).draw();
    // }, function() {
    //     ITEM_LOCATION_TABLE.search('').draw();
    // });


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
                    data: $('#frm-list-inventory').serialize(),
                    dataType:'json',
                    success: function(response) {
                        if( response.is_success == 1 ){
                            Swal.fire({
                                title: 'Delete Inventory Item',
                                text: "Selected data has been deleted successfully!",
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
                                icon: 'error',
                                title: 'Error',
                                text: response.msg,
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
            title: 'Delete Inventory Item',
            html: `Are you sure you want to delete item <b>${name}</b>?`,
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
                    data: {id: id},
                    dataType:'json',
                    success: function(response){
                        if(response.is_success == 1 ){
                            load_item_location_list(response.item_id);
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Cannot find data',
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
