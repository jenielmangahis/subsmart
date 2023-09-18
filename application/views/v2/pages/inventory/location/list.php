<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/inventory/inventory_modals'); ?>
<style type="text/css">
    table {
        width: 100% !important;
    }
    #INV_LOCATION_TBL_filter, #INV_LOCATION_TBL_length, #ITEM_LOCATION_TABLE_info, #ITEM_LOCATION_TABLE_paginate, #ITEM_LOCATION_TABLE_length, #ITEM_LOCATION_TABLE_filter{
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
    .nsm-table tr:not(.nsm-row-collapse) td:not(:last-child) {    
        max-width: initial !important;
    }
</style>


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
                        
                        <div class="nsm-page-buttons page-button-container">                            
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('inventory/addInventoryLocation') ?>'">
                                <i class='bx bx-fw bx-list-plus'></i> New Location
                            </button>
                            <button type="button" class="nsm-button btn-danger" id="delete_selected">
                            <i class='bx bx-select-multiple text-white'></i> Delete Selected
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
                <input type="hidden" id="selected_ids" name="selected_ids" value="" />
                <form id="storage-location-list">
                    <table id="INV_LOCATION_TBL" class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon text-center">
                                    <input class="form-check-input select-all table-select" type="checkbox">
                                </td>
                                <td class="table-icon"></td>
                                <td data-name="Name">Location</td>
                                <td data-name="Default">Is Default</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($location as $locations) :?>

                            <tr>
                                <td>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select" type="checkbox" name="storageLocations[]" value="<?= $locations->loc_id; ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="table-row-icon">
                                        <i class='bx bx-cube'></i>
                                    </div>
                                </td>
                                <td><b><?php echo $locations->location_name ?></b></td>
                                <td>
                                    <?php if( $locations->default == "true" ){ ?>
                                        <span class="nsm-badge nsm-badge-primary" style="width:100%;display:block;text-align:center;"><i class='bx bx-check text-white' style="font-size:20px;"></i></span>
                                    <?php }else { ?>
                                        <span class="nsm-badge nsm-badge-danger" style="width:100%;display:block;text-align:center;"><i class='bx bx-x text-white' style="font-size:20px;"></i></span>
                                    <?php } ?>                                
                                </td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item edit-item" href="<?php echo base_url('inventory/editInventoryLocation/' . $locations->loc_id); ?>" data-id="<?php echo $locations->loc_id  ?>">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $locations->loc_id?>">Delete</a>
                                            </li>
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
    </div>
</div>



<script src="<?php echo base_url("assets/js/v2/printThis.js") ?>"></script>
<script type="text/javascript">
$(document).ready(function() {

    var INV_LOCATION_TBL = $("#INV_LOCATION_TBL").DataTable({
        "ordering": false,
        language: {
            processing: '<span>Fetching data...</span>'
        },
        "columns": [
            { "width": "1%" },
            { "width": "1%" },
            { "width": "85%" },
            { "width": "6%" },
            null        
        ]
    });

    $("#search_field_custom").keyup(function() {
        INV_LOCATION_TBL.search($(this).val()).draw()
    });
    INV_LOCATION_TBL_SETTINGS = INV_LOCATION_TBL.settings();


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
            //title: 'Success',
            text: "Shareable link has been copied to clipboard.",
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'Okay'
        });
    });

    $("#btn_print_inventory").on("click", function() {
        $("#INV_LOCATION_TBL_print").printThis();
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
            //$("#selected_ids").val(selectedIds);
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
                    url: "<?php echo base_url('inventory/_delete_selected_storage_location') ?>",
                    data: $('#storage-location-list').serialize(),
                    dataType:'json',
                    success: function(result) {                        
                        if (result.is_success == 1) {
                            Swal.fire({
                                text: "Selected data has been deleted successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#51bcda',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }
                    },
                });                
            }
        });
    });

    $(document).on("click", ".delete-item", function() {
        let id = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete Storage Location',
            text: "Are you sure you want to delete this item?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/inventory/deleteLocation') ?>",
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
