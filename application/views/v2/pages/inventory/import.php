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
                                        <label for="FILE_UPLOAD_INPUT" class="form-label">Upload a .csv file</label>
                                        <input id="FILE_UPLOAD_INPUT" class="form-control mb-3" type="file" accept=".csv" required>
                                        <a class="nsm-button default" style="margin-left:0px;" href="<?= base_url('uploads/import_templates/import_inventory_template.csv'); ?>">Download Import Template</a>
                                        <button id="FILE_UPLOAD_BUTTON" class="btn btn-secondary d-none" type="button"><i class='bx bxs-chevrons-right'></i>&nbsp;Proceed to Header Mapping</button>
                                </div>
                                <div class="col-lg-12 HEADER_MAPPING_SECTION mb-3 d-none">
                                    <span>Specify headers in each columns.</span>
                                    <div class="table-responsive"></div>
                                    <hr>
                                    <button id="SAVE_CSV_TO_DATABASE" class="nsm-button primary" type="button"><i class='bx bx-upload'></i>&nbsp;Save Data</button>
                                    <button id="import-cancel" class="nsm-button primary" type="button">&nbsp;Cancel</button>
                                    <button id="RETURN_TO_INVENTORY" class="btn btn-secondary d-none" type="button" onclick="window.location.replace('<?php echo base_url("inventory"); ?>')"><i class="bx bxs-chevrons-left"></i>&nbsp;Return to Inventory List</button>
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
var executeOnce = 1;
$("#FILE_UPLOAD_INPUT").change(function() {
    var file = this.files[0];
    var allowedExtensions = /(\.csv)$/i; // allowed extensions
    if (!allowedExtensions.exec(file.name)) {
        this.value = "";
        $("#FILE_UPLOAD_BUTTON").addClass('d-none');
        Swal.fire({
            title: 'Error File',
            text: "The file you selected is not a .csv file.",
            icon: 'error',
            showCancelButton: true,
            showConfirmButton: false,
        });
        return false;
    } else {
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
            var table = "<table id='CSV_INVENTORY_TABLE' class='table table-bordered table-hover table-sm w-100' style='border-bottom: lightgray; background: white;'>";
            var data = results.data;
            table += "<thead class='table-light'>";
            for (i = 0; i < 1; i++) {
                table += "<tr>";
                var row = data[i];
                var cells = row.join(",").split(",");
                var totalHeaderColumn = cells.length;
                for (j = 0; j < cells.length; j++) {
                    table += "<th style='width: 0px !important;'>";
                    table += "<select>";
                    // table += (cells[j] == "id") ? "<option selected value='id'>id</option>" : "<option  value='id'>id</option>";
                    // table += (cells[j] == "company_id") ? "<option selected value='company_id'>company_id</option>" : "<option value='company_id'>company_id</option>";
                    table += (cells[j] == "title") ? "<option selected value='title'>title</option>" : "<option value='title'>title</option>";
                    table += (cells[j] == "type") ? "<option selected value='type'>type</option>" : "<option value='type'>type</option>";
                    table += (cells[j] == "description") ? "<option selected value='description'>description</option>" : "<option value='description'>description</option>";
                    table += (cells[j] == "model") ? "<option selected value='model'>model</option>" : "<option value='model'>model</option>";
                    table += (cells[j] == "brand") ? "<option selected value='brand'>brand</option>" : "<option value='brand'>brand</option>";
                    table += (cells[j] == "COGS") ? "<option selected value='COGS'>COGS</option>" : "<option value='COGS'>COGS</option>";
                    table += (cells[j] == "price") ? "<option selected value='price'>price</option>" : "<option value='price'>price</option>";
                    table += (cells[j] == "retail") ? "<option selected value='retail'>retail</option>" : "<option value='retail'>retail</option>";
                    table += (cells[j] == "rebate") ? "<option selected value='rebate'>rebate</option>" : "<option value='rebate'>rebate</option>";
                    table += (cells[j] == "cost per") ? "<option selected value='cost per'>cost per</option>" : "<option value='cost per'>cost per</option>";
                    table += (cells[j] == "url") ? "<option selected value='url'>url</option>" : "<option value='url'>url</option>";
                    table += (cells[j] == "notes") ? "<option selected value='notes'>notes</option>" : "<option value='notes'>notes</option>";
                    table += (cells[j] == "item_categories_id") ? "<option selected value='item_categories_id'>item_categories_id</option>" : "<option value='item_categories_id'>item_categories_id</option>";
                    table += (cells[j] == "is_active") ? "<option selected value='is_active'>is_active</option>" : "<option value='is_active'>is_active</option>";
                    table += (cells[j] == "vendor_id") ? "<option selected value='vendor_id'>vendor_id</option>" : "<option value='vendor_id'>vendor_id</option>";
                    table += (cells[j] == "units") ? "<option selected value='units'>units</option>" : "<option value='units'>units</option>";
                    table += (cells[j] == "frequency") ? "<option selected value='frequency'>frequency</option>" : "<option value='frequency'>frequency</option>";
                    table += (cells[j] == "estimated_time") ? "<option selected value='estimated_time'>estimated_time</option>" : "<option value='estimated_time'>estimated_time</option>";
                    table += (cells[j] == "modified") ? "<option selected value='modified'>modified</option>" : "<option value='modified'>modified</option>";
                    table += (cells[j] == "attached_image") ? "<option selected value='attached_image'>attached_image</option>" : "<option value='attached_image'>attached_image</option>";
                    table += (cells[j] == "cost") ? "<option selected value='cost'>cost</option>" : "<option value='cost'>cost</option>";
                    table += (cells[j] == "serial_number") ? "<option selected value='serial_number'>serial_number</option>" : "<option value='serial_number'>serial_number</option>";
                    table += (cells[j] == "points") ? "<option selected value='points'>points</option>" : "<option value='points'>points</option>";
                    table += (cells[j] == "qty_order") ? "<option selected value='qty_order'>qty_order</option>" : "<option value='qty_order'>qty_order</option>";
                    table += (cells[j] == "cost_per") ? "<option selected value='cost_per'>cost_per</option>" : "<option value='cost_per'>cost_per</option>";
                    table += (cells[j] == "re_order_points") ? "<option selected value='re_order_points'>re_order_points</option>" : "<option value='re_order_points'>re_order_points</option>";
                    table += "</select>";
                    table += "</th>";
                }
                table += "</tr>";
            }
            table += "</thead>";
            table += "<tbody>";
            for (i = 1; i < data.length - 1; i++) {
                table += "<tr>";
                var row = data[i];                
                var cells = row.join(",").split(",");                
                var totalBodyColumn = cells.length;
                for (j = 0; j < cells.length; j++) {
                    if (totalHeaderColumn == totalBodyColumn) {
                        table += "<td style='width: 0px !important;'>";
                        table += cells[j];
                        table += "</td>";
                    } else {
                        $("#FILE_UPLOAD_BUTTON").addClass('d-none');
                        $("#FILE_UPLOAD_INPUT").val(null);
                        Swal.fire({
                            title: 'Unable to Load CSV File',
                            text: "This .csv file contains uneven numbers of columns. Make sure that all rows has the same number of columns.",
                            icon: 'error',
                            showCancelButton: true,
                            showConfirmButton: false,
                        });
                    }
                }
                table += "</tr>";
            }
            table += "</tbody>";
            table += "</table>";
            try {
                $("#FILE_UPLOAD_BUTTON").removeClass('d-none');
                $(".HEADER_MAPPING_SECTION > .table-responsive").html(table);
                $('#CSV_INVENTORY_TABLE').DataTable({
                    pageLength: 5,
                    "bSort": false,
                    "lengthChange": false,
                    "searching": false,
                });
            } catch (e) {
                $("#FILE_UPLOAD_BUTTON").addClass('d-none');
                $("#FILE_UPLOAD_INPUT").val(null);
                Swal.fire({
                    title: 'Unable to Load CSV File',
                    text: "This .csv file contains uneven numbers of columns. Make sure that all rows has the same number of columns.",
                    icon: 'error',
                    showCancelButton: true,
                    showConfirmButton: false,
                });
            }
        }
    }
});

$("#FILE_UPLOAD_BUTTON").on('click', function(event) {
    event.preventDefault();
    $("#FILE_UPLOAD_BUTTON").attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading file...');
    $("#FILE_UPLOAD_INPUT").attr('disabled', 'disabled');

    $("#INVENTORY_IMPORT_STEP1 > .POINTER_CURSOR").html("✅ File Upload");
    $("#INVENTORY_IMPORT_STEP2").addClass('active');
    $("#INVENTORY_IMPORT_STEP2 > .POINTER_CURSOR").html("<div class='spinner-border spinner-border-sm' role='status'></div>&nbsp;&nbsp;Header Mapping");
    $(".FILE_UPLOAD_SECTION").addClass('d-none');
    $(".HEADER_MAPPING_SECTION").removeClass('d-none');
});

$('#import-cancel').on('click', function(){
    location.href = base_url + 'inventory/import';
});

$("#SAVE_CSV_TO_DATABASE").on('click', function(event) {
    event.preventDefault();

    var headerRow = $('#CSV_INVENTORY_TABLE tr:first');
    var headerName = [];
    var bodyRows = [];
    var duplicates = [];

    headerRow.find('th select').each(function() {
        headerName.push($(this).val());
    });

    $('#CSV_INVENTORY_TABLE').DataTable().rows().every(function(rowIdx, tableLoop, rowLoop) {
        var thisRow = {};
        var data = this.data();
        for (var i = 0; i < data.length; i++) {
            thisRow[i] = data[i];
        }
        bodyRows.push(thisRow);
    });

    for (var i = 0; i < headerName.length; i++) {
        if (headerName.indexOf(headerName[i]) !== i && duplicates.indexOf(headerName[i]) === -1) {
            duplicates.push(headerName[i]);
        }
    }

    if (duplicates.length) {
        Swal.fire({
            title: 'Unable to Save Data',
            html: "Duplicating <strong>" + duplicates.join(", ") + "</strong> header(s). Make sure that there is no duplicating header.",
            icon: 'error',
            showCancelButton: true,
            showConfirmButton: false,
        });

    } else {
        $("#SAVE_CSV_TO_DATABASE").attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving Data...');
        $.ajax({
            url: '<?php echo base_url("inventory/importCSV"); ?>',
            type: 'POST',
            data: {
                headers: JSON.stringify(headerName),
                columnLength: headerName.length,
                rows: JSON.stringify(bodyRows),
                rowLength: bodyRows.length,
            },
            dataType: 'json',
            complete: function(data, textStatus, xhr) {
                if (data.responseText == "true") {
                    $("#INVENTORY_IMPORT_STEP2 > .POINTER_CURSOR").html("✅ Header Mapping");
                    $("#SAVE_CSV_TO_DATABASE").addClass('d-none');
                    $("#RETURN_TO_INVENTORY").removeClass('d-none');
                    if (executeOnce == 1) {
                        executeOnce = 0;
                        Swal.fire({
                            title: 'Success',
                            text: 'The Data in CSV has been imported successfully.',
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: true,
                            customClass: {
                                container: 'T12345' // Add a unique identifier here
                            }
                        }); 
                    }
                } else { }
            }
        });

        // console.log("Headers:");
        // console.log(headerName);
        // console.log("Column Length:");
        // console.log(headerName.length);
        // console.log("Body Rows:");
        // console.log(bodyRows);
        // console.log("Body Rows Count:");
        // console.log(bodyRows.length);
    }
});
// // Get references to all the select elements with class name "TEST_SELECT"
// const selects = $('.TESTING14325');

// // When an option is selected in any select element, remove it from all other select elements
// selects.on('change', function() {
//   const selectedOption = $(this).val();
//   if (selectedOption) {
//     selects.each(function() {
//       if (this !== event.currentTarget) {
//         const optionToRemove = $(this).find(`option[value="${selectedOption}"]`);
//         if (optionToRemove.length) {
//           optionToRemove.hide();
//         } else {
//           $(this).find(`option[value="${selectedOption}"]`).show();
//         }
//       }
//     });
//   }
//   // Show any options that were previously hidden but are now unselected
//   selects.find('option:hidden').each(function() {
//     const optionValue = $(this).val();
//     let isSelected = false;
//     selects.each(function() {
//       if ($(this).val() === optionValue) {
//         isSelected = true;
//       }
//     });
//     if (!isSelected) {
//       $(this).show();
//     }
//   });
// });
</script>
<?php include viewPath('v2/includes/footer'); ?>
