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
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('inventory/vendor/add') ?>'">
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
                            Manage your inventory vendors.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field_custom" placeholder="Search Vendors">
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
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('inventory/vendor/add') ?>'">
                                <i class='bx bx-fw bx-list-plus'></i> Add New Vendor
                            </button>
                        </div>
                    </div>
                </div>
                <!-- <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Vendor Name">Vendor Name</td>
                            <td data-name="Email">Email</td>
                            <td data-name="Phone Number">Phone Number</td>
                            <td data-name="Address">Address</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($vendors)) :
                        ?>
                            <?php
                            foreach ($vendors as $row) :
                            ?>
                                    <tr>
                                        <td>
                                            <div class="nsm-profile">
                                                <span><?= ucwords($row->vendor_name[0]) ?></span>
                                            </div>
                                        </td>
                                        <td class="nsm-text-primary">
                                            <label class="d-block fw-bold"><?= $row->vendor_name ?></label>
                                        </td>
                                        <td><?= $row->email ?></td>
                                        <td><?= $row->phone ?></td>
                                        <td><?= $row->street_address.' '.$row->city. ' '.$row->state ?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo url('inventory/vendor/edit/'.$row->vendor_id); ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $row->vendor_id; ?>">Delete</a>
                                                    </li>
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
                                <td colspan="6">
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
                <div class="row">
                    <table class="nsm-table" id="VENDORS_TABLE">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                    <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <!-- <td class="table-icon"></td> -->
                            <td data-name="Vendor Name">Vendor Name</td>
                            <td data-name="Email">Email</td>
                            <td data-name="Phone Number">Phone Number</td>
                            <td data-name="Address">Address</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendors as $row) : ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon table-checkbox">
                                                <input class="form-check-input select-one table-select" type="checkbox" data-id="<?php echo $row->vendor_id; ?>">
                                            </div>
                                        </td>
                                        <!-- <td>
                                            <div class="nsm-profile">
                                                <span><?= ucwords($row->vendor_name[0]) ?></span>
                                            </div>
                                        </td> -->
                                        <td class="nsm-text-primary">
                                            <label class="d-block fw-bold"><?= $row->vendor_name ?></label>
                                        </td>
                                        <td><?= $row->email ?></td>
                                        <td><?= $row->phone ?></td>
                                        <td><?= $row->street_address.' '.$row->city. ' '.$row->state ?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo url('inventory/vendor/edit/'.$row->vendor_id); ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $row->vendor_id; ?>">Delete</a>
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
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
let selectedIds = [];

    var VENDORS_TABLE = $("#VENDORS_TABLE").DataTable({
        "ordering": false,
        language: {
            processing: '<span>Fetching data...</span>'
        },
    });

    $("#search_field_custom").keyup(function () {
        VENDORS_TABLE.search($(this).val()).draw()
    });
    VENDORS_TABLE_SETTINGS = VENDORS_TABLE.settings();

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
                url: "<?= base_url('inventory/deleteMultipleVendor') ?>",
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
        title: 'Delete Vendor',
        text: "Are you sure you want to delete this vendor?",
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
                url: "<?= base_url('/inventory/vendor/delete') ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    // if (data.is_success == 1) {
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
function toggleBatchDelete(enable=True){
        enable ? $("#delete_selected").removeClass("disabled") : $("#delete_selected").addClass("disabled");
    }
});
</script>
<?php include viewPath('v2/includes/footer'); ?>