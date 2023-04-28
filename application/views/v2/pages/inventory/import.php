<?php include viewPath('v2/includes/header'); ?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<style type="text/css">
    .POINTER_CURSOR {
        cursor: pointer;
    }
    /*.IMPORT_DIV {
        width: 1000px;
    }
    #FILE_UPLOAD_INPUT {
        width: 400px;
    }*/
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
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Add Items in Inventory through CSV file import.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="IMPORT_DIV">
                            <div class="nsm-progressbar">
                                <div class="progressbar">
                                    <ul class="items-2">
                                        <li id="INVENTORY_IMPORT_STEP1" class="active">
                                            <span class="POINTER_CURSOR">
                                                <div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;File Upload
                                            </span>
                                        </li>
                                        <li id="INVENTORY_IMPORT_STEP2" class="">
                                            <span class="POINTER_CURSOR">Header Mapping</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="IMPORT_DIV p-5" style="background: #f3f3f3; border-radius: 8px;">
                            <div class="row" style="margin-bottom: -20px;">
                                <div class="col-lg-12 FILE_UPLOAD_SECTION mb-3">
                                    <form id="INVENTORY_FILE_IMPORT_FORM" enctype="multipart/form-data">
                                        <label for="FILE_UPLOAD_INPUT" class="form-label">Upload a .csv file</label>
                                        <input id="FILE_UPLOAD_INPUT" class="form-control mb-3" type="file" accept=".csv" required>
                                        <button id="FILE_UPLOAD_BUTTON" class="btn btn-secondary d-none" type="submit"><i class='bx bxs-chevrons-right'></i>&nbsp;Proceed to Header Mapping</button>
                                    </form>
                                </div>
                                <div class="col-lg-12 HEADER_MAPPING_SECTION mb-3 d-none">
                                    <span>Specify headers in each columns.</span>
                                    <div class="table-responsive"></div>
                                    <hr>
                                    <button id="SAVE_CSV_TO_DATABASE" class="btn btn-danger" type="submit"><i class='bx bx-upload'></i>&nbsp;Save Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading File... -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.2/papaparse.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
$("#FILE_UPLOAD_INPUT").change(function() {
    var file = this.files[0];
    var allowedExtensions = /(\.csv)$/i; // allowed extensions
    if (!allowedExtensions.exec(file.name)) {
        $("#FILE_UPLOAD_BUTTON").addClass('d-none');
        Swal.fire({
            title: 'Error',
            text: "The file you selected is not a .csv file.",
            icon: 'error',
            showCancelButton: true,
            showConfirmButton: false,
        });
        this.value = "";
        return false;
    } else {
        $("#FILE_UPLOAD_BUTTON").removeClass('d-none');
        $('#FILE_UPLOAD_INPUT').parse({
            config: {
                delimiter: "auto",
                header: false,
                complete: CSV_TO_DATATABLE,
            },
            // before: function(file, inputElem) { console.log("Parsing file...", file); },
            // error: function(err, file) { console.log("ERROR:", err, file); },
            // complete: function() { console.log(); }
        });

        function CSV_TO_DATATABLE(results) {
            // console.log(results);
            var table = "<table id='CSV_INVENTORY_TABLE' class='table table-bordered table-hover table-sm w-100' style='border-bottom: lightgray; background: white;'>";
            var data = results.data;

            table += "<thead class='table-light'>";
            for (i = 0; i < 1; i++) {
                table += "<tr>";
                var row = data[i];
                var cells = row.join(",").split(",");
                for (j = 0; j < cells.length; j++) {
                    table += "<th style='width: 0px !important;'>";
                    table += "<select class='TESTING14325'>";
                    table += "<option value='" + cells[j] + "'>";
                    table += cells[j];
                    table += "</option>";
                    table += "<option value='COGS'>COGS</option>";
                    table += "<option value='price'>price</option>";
                    table += "<option value='retail'>retail</option>";
                    table += "<option value='rebate'>rebate</option>";
                    table += "<option value='url'>url</option>";
                    table += "<option value='notes'>notes</option>";
                    table += "<option value='item_categories_id'>item_categories_id</option>";
                    table += "<option value='is_active'>is_active</option>";
                    table += "<option value='vendor_id'>vendor_id</option>";
                    table += "</select>";
                    table += "</th>";
                }
                table += "</tr>";
            }
            table += "</thead>";

            table += "<tbody>";

            for (i = 1; i < data.length; i++) {
                table += "<tr>";
                var row = data[i];
                var cells = row.join(",").split(",");

                for (j = 0; j < cells.length; j++) {
                    table += "<td style='width: 0px !important;'>";
                    table += cells[j];
                    table += "</td>";
                }
                table += "</tr>";
            }
            table += "</tbody>";

            table += "</table>";
            $(".HEADER_MAPPING_SECTION > .table-responsive").html(table);
            $(document).ready(function() {
                $('#CSV_INVENTORY_TABLE').DataTable({
                    pageLength: 5,
                    "bSort": false,
                    "lengthChange": false,
                    "searching": false,
                });
            });
        }
    }
});

$("#INVENTORY_FILE_IMPORT_FORM").on('submit', function(event) {
    event.preventDefault();
    $("#FILE_UPLOAD_BUTTON").attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading File...');
    $("#FILE_UPLOAD_INPUT").attr('disabled', 'disabled');

    setInterval(function() {
        $("#INVENTORY_IMPORT_STEP1 > .POINTER_CURSOR").html("✅ File Upload");
        $("#INVENTORY_IMPORT_STEP2").addClass('active');
        $("#INVENTORY_IMPORT_STEP2 > .POINTER_CURSOR").html("<div class='spinner-border spinner-border-sm' role='status'></div>&nbsp;&nbsp;Header Mapping");
        $(".FILE_UPLOAD_SECTION").addClass('d-none');
        $(".HEADER_MAPPING_SECTION").removeClass('d-none');
    }, 1000);
});


// THIS SCRIPT GETS THE HEADER OF THE DATATABLE
// // Get the header row of the table
// var headerRow = $('#CSV_INVENTORY_TABLE tr:first');

// // Get an array of the selected options for each column
// var selectedOptions = [];
// headerRow.find('th select').each(function() {
//   selectedOptions.push($(this).val());
// });

// // The selectedOptions array now contains the selected option for each column
// console.log(selectedOptions);

</script>
<?php include viewPath('v2/includes/footer'); ?>
