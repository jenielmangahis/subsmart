<?php include viewPath('v2/includes/accounting_header'); ?>

<style>
    .saveCustomize {
        display: none;
    }

    table {
        width: 100% !important;
    }

    .dataTables_filter,
    .dataTables_length,
    .dataTables_info,
    .dt-buttons {
        display: none;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px 18px;
        border-bottom: 1px solid lightgray;
    }

    table.dataTable.no-footer {
        border-bottom: 0px solid #111;
        margin-bottom: 10px;
    }

    .customizeContainer {
        display: none;
    }

    .customizeComponent {
        background: #00000008;
    }

    .dateToContainer {
        position: relative;
        width: 35px;
    }

    .dateTo {
        position: absolute;
        bottom: 0px;
    }

    .verticalRuleContainer {
        position: relative;
        width: 0px;
    }

    .vr {
        position: absolute;
        bottom: 0px;
        height: 55px;
    }

    .customizeRunReportContainer {
        position: relative;
    }

    .customizeRunReport {
        position: absolute;
        bottom: 11px;
        border-radius: 100px;
    }

    .accountingMethodContainer {
        position: relative;
        width: 180px;
    }

    .accountingRadio {
        position: absolute;
        bottom: 5px;
    }
</style>

<div class="container-fluid">
    <div class="row mb-1">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="float-end">
                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                    <span>Filter <i class='bx bx-fw bx-chevron-down'></i></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                    <p class="m-0">Rows/columns</p>
                    <div class="row grid-mb">
                        <div class="col-12">
                            <label for="filter-group-by">Group by</label>
                            <select class="nsm-field form-select" name="filter_group_by" id="filter-group-by">
                                <option value="none" selected>None</option>
                                <option value="Tax Name">Tax Name</option>
                                <option value="Gross Total">Gross Total</option>
                                <option value="Non-Taxable">Non-Taxable</option>
                                <option value="Taxable Amount">Taxable Amount</option>
                                <option value="Tax Amount">Tax Amount</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="nsm-button primary">Run Report</button>
                        </div>
                    </div>
                </ul>
                <button type="button" class="nsm-button openCustomize"><i class='bx bx-fw bx-customize'></i> Customize</button>
                <button type="button" class="nsm-button primary saveCustomize"><i class='bx bx-fw bx-save'></i> Save customization</button>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row addMargin3">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 customizeContainer">
            <div class="float-end">
            </div>
            <div class="card">
                <div class="card-body customizeComponent">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Report Period</label>
                                <select class="form-select">
                                    <option value="all-dates">All Dates</option>
                                    <option value="custom">Custom</option>
                                    <option value="today">Today</option>
                                    <option value="this-week">This Week</option>
                                    <option value="this-week-to-date">This Week-to-date</option>
                                    <option value="this-month">This Month</option>
                                    <option value="this-month-to-date" selected="">This Month-to-date</option>
                                    <option value="this-quarter">This Quarter</option>
                                    <option value="this-quarter-to-date">This Quarter-to-date</option>
                                    <option value="this-year">This Year</option>
                                    <option value="this-year-to-date">This Year-to-date</option>
                                    <option value="this-year-to-last-month">This Year-to-last-month</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="recent">Recent</option>
                                    <option value="last-week">Last Week</option>
                                    <option value="last-week-to-date">Last Week-to-date</option>
                                    <option value="last-month">Last Month</option>
                                    <option value="last-month-to-date">Last Month-to-date</option>
                                    <option value="last-quarter">Last Quarter</option>
                                    <option value="last-quarter-to-date">Last Quarter-to-date</option>
                                    <option value="last-year">Last Year</option>
                                    <option value="last-year-to-date">Last Year-to-date</option>
                                    <option value="since-30-days-ago">Since 30 Days Ago</option>
                                    <option value="since-60-days-ago">Since 60 Days Ago</option>
                                    <option value="since-90-days-ago">Since 90 Days Ago</option>
                                    <option value="since-365-days-ago">Since 365 Days Ago</option>
                                    <option value="next-week">Next Week</option>
                                    <option value="next-4-weeks">Next 4 Weeks</option>
                                    <option value="next-month">Next Month</option>
                                    <option value="next-quarter">Next Quarter</option>
                                    <option value="next-year">Next Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">&nbsp;</label>
                            <input class="form-control" type="date">
                        </div>
                        <div class="col-md-1 dateToContainer">
                            <label class="form-label dateTo">To</label>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">&nbsp;</label>
                            <input class="form-control" type="date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Tax Agency</label>
                                <select class="form-select">
                                    <option value="All">All</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 accountingMethodContainer">
                            <label class="form-label fw-bold">Accounting method</label>
                            <div class="accountingRadio">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="CashRadio" value="Cash">
                                  <label class="form-check-label" for="CashRadio">Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="AccrualRadio" value="Accrual">
                                  <label class="form-check-label" for="AccrualRadio">Accrual</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 verticalRuleContainer">
                            <div class="vr"></div>
                        </div>
                        <div class="col-md-2 customizeRunReportContainer">
                            <button class="btn btn-success customizeRunReport">Run Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="nsm-card primary">
                        <div class="nsm-card-header">
                            <div class="col-lg-12">
                                <span class="float-start">
                                    <button type="button" class="nsm-button" data-bs-toggle="dropdown"><span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i></button>
                                    <ul class="dropdown-menu p-3">
                                        <p class="m-0">Sort by</p>
                                        <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                            <option value="default" selected>Default</option>
                                            <option value="Tax Name">Tax Name</option>
                                            <option value="Gross Total">Gross Total</option>
                                            <option value="Non-Taxable">Non-Taxable</option>
                                            <option value="Taxable Amount">Taxable Amount</option>
                                            <option value="Tax Amount">Tax Amount</option>
                                        </select>
                                        <p class="m-0">Sort in</p>
                                        <div class="form-check">
                                            <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" checked>
                                            <label for="sort-asc" class="form-check-label">Ascending order</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                            <label for="sort-desc" class="form-check-label">Descending order</label>
                                        </div>
                                    </ul>
                                    <button class="nsm-button add_notes">Add Notes</button>
                                </span>
                                <span class="float-end">
                                    <button data-bs-toggle="modal" data-bs-target="#EMAIL_REPORT_MODAL" class="nsm-button border-0"><i class="bx bx-fw bx-envelope"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#PRINT_SAVE_MODAL" class="nsm-button border-0"><i class="bx bx-fw bx-printer"></i></button>
                                    <button class="nsm-button border-0" data-bs-toggle="dropdown"><i class="bx bx-fw bx-export"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end export-dropdown" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="EXPORT_TO_EXCEL" onclick="$('.buttons-excel').click();">Export to Excel</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="EXPORT_TO_PDF" onclick="$('.buttons-pdf').click();">Export to PDF</a></li>
                                    </ul>
                                    <button class="nsm-button border-0 primary"><i class="bx bx-fw bx-cog"></i></button>
                                    <!-- Example single danger button -->
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="nsm-card-content">
                            <div class="row mt-4 mb-2">
                                <div class="col-lg-12">
                                    <center>
                                        <h3 id="BUSINESS_NAME"><?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?></h3>
                                    </center>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <center>
                                        <h5><strong id="REPORT_NAME">Sales Tax Liability Report</strong></h5>
                                    </center>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <table id="SALES_TAX_LIABILITIES_TABLE" class="nsm-table w-100 display" data-tableName="Test Table 1">
                                        <thead>
                                            <tr>
                                                <th>Tax Name</th>
                                                <th>Gross Total</th>
                                                <th>Non-Taxable</th>
                                                <th>Taxable Amount</th>
                                                <th>Tax Amount</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <span id="NOTES_CONTENT" class="text-muted">Loading Notes...</span>
                                    <form id="ADD_NOTES_FORM" method="POST" style="display: none;">
                                        <div class="row">
                                            <div class="col-sm-12 mt-1 mb-3">
                                                <div class="form-group">
                                                    <textarea id="NOTES" class="form-control" maxlength="4000"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="float-start">
                                                    4000 characters max
                                                </div>
                                                <div class="float-end">
                                                    <button type="button" id="NOTE_CLOSE_MODAL" class="nsm-button">Cancel</button>
                                                    <button type="submit" class="nsm-button primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <center class="mt-4 mb-4"><?php echo date("l, F j, Y h:i A eP") ?></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
<!-- START: MODALS -->

<!-- START: PRINT/SAVE MODAL -->
<div class="modal" id="PRINT_SAVE_MODAL" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" style="max-width: 1120px;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Print or save as PDF</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 mt-1 mb-3">
                        <h6>Report print settings</h6>
                        <hr>
                        <div class="form-group mb-2">
                            <label>Orientation</label>
                            <select id="PAGE_ORIENTATION" name="PAGE_ORIENTATION" class="form-select">
                                <option value="PORTRAIT" selected>Portrait</option>
                                <option value="LANDSCAPE">Landscape</option>
                            </select>
                            <script type="text/javascript">
                                $('#PAGE_ORIENTATION').select2();
                            </script>
                        </div>
                        <div class="form-check">
                            <input id="PAGE_HEADER_REPEAT" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Repeat Page Header</label>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <iframe id="PDF_PREVIEW" class="border-0" width="100%" height="450px"></iframe>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start">
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>
                        <!-- <div class="float-end">
                                <button type="button" class="nsm-button">Save as PDF</button>
                                <button onclick="PRINT_TABLE();" type="button" class="nsm-button success">Print</button>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: PRINT/SAVE MODAL -->
<!-- START: EMAIL REPORT MODAL -->
<div class="modal" id="EMAIL_REPORT_MODAL" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="SEND_EMAIL_FORM">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>To</h6>
                                <input id="EMAIL_TO" class="form-control" type="email" placeholder="Send to" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>CC</h6>
                                <input id="EMAIL_CC" class="form-control" type="email" placeholder="Carbon Copy" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <input id="EMAIL_SUBJECT" class="form-control" type="text" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <textarea id="EMAIL_BODY" class="form-control"></textarea required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1 mb-3">
                            <div class="form-group">
                                <h6>Report <small class="text-muted">(ReportFileName.pdf)</small></h6>
                                <div class="input-group">
                                    <input id="EMAIL_REPORT_FILENAME" class="form-control" type="text" value="Sales Tax Liability Report" required>
                                    <input class="form-control" type="text" disabled readonly value=".pdf" style="max-width: 60px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="EMAIL_CLOSE_MODAL" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button success sendEmail"><span class="sendEmail_Loader"></span>Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END: EMAIL REPORT MODAL -->
<!-- END: MODALS -->

<!-- START: LIBRARY AND FRAMEWORKS IMPORTS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>
<!-- END: LIBRARY AND FRAMEWORKS IMPORTS -->

<script type="text/javascript">
    $(".openCustomize").click(function(event) {
        $(".openCustomize").hide();
        $(".saveCustomize").show();
        $(".customizeContainer").show();
        $(".addMargin3").addClass('mb-3');

    });

    $(".saveCustomize").click(function(event) {
        $(".openCustomize").show();
        $(".saveCustomize").hide();
        $(".customizeContainer").hide();
        $(".addMargin3").removeClass('mb-3');
    });


    $(document).ready(function() {
        $("#PAGE_ORIENTATION").select2({
            dropdownParent: $("#PRINT_SAVE_MODAL")
        });
    });

    var SALES_TAX_LIABILITIES_TABLE_TABLE = $('#SALES_TAX_LIABILITIES_TABLE').DataTable({
        "ordering": false,
        // paging: false,
        // "ajax": "<?php echo base_url('accounting_controllers/reports/getCustomerContactList'); ?>",
        // "columns": [{
        //         "data": "CUSTOMER"
        //     },
        //     {
        //         "data": "PHONE_NUMBER"
        //     },
        //     {
        //         "data": "EMAIL"
        //     },
        //     {
        //         "data": "BILLING_ADDRESS"
        //     },
        //     {
        //         "data": "SHIPPING_ADDRESS"
        //     },
        // ],
        // language: {
        //     processing: '<span>Fetching data...</span>'
        // },
        // dom: 'Blfrtip',
        // buttons: [{
        //         extend: 'excelHtml5',
        //         title: '<?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?> Customer Contact List'
        //     },
        //     {
        //         extend: 'pdfHtml5',
        //         title: '<?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?> Customer Contact List'
        //     },
        // ]
    });
    var TABLE_SETTINGS = SALES_TAX_LIABILITIES_TABLE_TABLE.settings();

    // START: PDF SETTINGS SCRIPT
    var PAGE = "PAGE=ACCOUNTING";
    var BUSINESS_NAME = "BUSINESS_NAME=" + $("#BUSINESS_NAME").html();
    var REPORT_NAME = "REPORT_NAME=" + $("#REPORT_NAME").html();
    var PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=false";
    var PDF_ORIENTATION = "PAGE_ORIENTATION=PORTRAIT";

    // INITIATE SETTINGS
    $('#PDF_PREVIEW').attr('src', '<?php echo base_url("TCPDFReport?"); ?>' + PAGE + "&" + BUSINESS_NAME + "&" + REPORT_NAME + "&" + PDF_ORIENTATION + "&" + PDF_HEADER_REPEAT);

    $('#PAGE_ORIENTATION').change(function(event) {
        PDF_ORIENTATION = "PAGE_ORIENTATION=" + $(this).val();
        $('#PDF_PREVIEW').attr('src', '<?php echo base_url("TCPDFReport?"); ?>' + PAGE + "&" + BUSINESS_NAME + "&" + REPORT_NAME + "&" + PDF_ORIENTATION + "&" + PDF_HEADER_REPEAT);
    });

    $('#PAGE_HEADER_REPEAT').change(function() {
        if ($(this).is(':checked')) {
            PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=true";
            $('#PDF_PREVIEW').attr('src', '<?php echo base_url("TCPDFReport?"); ?>' + PAGE + "&" + BUSINESS_NAME + "&" + REPORT_NAME + "&" + PDF_ORIENTATION + "&" + PDF_HEADER_REPEAT);
        } else {
            PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=false";
            $('#PDF_PREVIEW').attr('src', '<?php echo base_url("TCPDFReport?"); ?>' + PAGE + "&" + BUSINESS_NAME + "&" + REPORT_NAME + "&" + PDF_ORIENTATION + "&" + PDF_HEADER_REPEAT);
        }
    });
    // END: PDF SETTINGS SCRIPT

    var REPORT_ID = "<?php echo $reportTypeId; ?>";
    $.post("<?php echo base_url('accounting_controllers/reports/getNotes'); ?>", {
        REPORT_ID: REPORT_ID,
    }).done(function(data) {
        $('#NOTES_CONTENT').html("Loading notes...");
        $('#NOTES_CONTENT').html(data);
        $("#NOTES").val(data);
        (data !== "") ? $('.add_notes').text('Edit Notes'): $('.add_notes').text('Add Notes');
    });

    // START: ADD NOTES SCRIPT
    $('#ADD_NOTES_FORM').submit(function(event) {
        event.preventDefault();
        var REPORT_NOTES = $("#NOTES").val();
        // =========
        $('#NOTES_CONTENT').html(REPORT_NOTES);
        $("#NOTES_CONTENT").show();
        $("#ADD_NOTES_FORM").hide();
        (REPORT_NOTES !== "") ? $('.add_notes').text('Edit Notes'): $('.add_notes').text('Add Notes');
        // =========
        $.post("<?php echo base_url('accounting_controllers/reports/saveNotes'); ?>", {
            REPORT_ID: REPORT_ID,
            REPORT_NOTES: REPORT_NOTES,
        }).done(function(data) {
            $("#NOTES_CLOSE_MODAL").click();
        });
    });
    // END: ADD NOTES SCRIPT

    // START: ADD EVENT SCRIPT
    // <div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;
    $('#SEND_EMAIL_FORM').submit(function(event) {
        event.preventDefault();
        $(".sendEmail").attr('disabled', '').empty().append('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Send');
        var emailTo = $("#EMAIL_TO").val();
        var emailCC = $("#EMAIL_CC").val();
        var emailSubject = $("#EMAIL_SUBJECT").val();
        var emailBody = $("#EMAIL_BODY").val();
        var EMAIL_REPORT_FILENAME = $("#EMAIL_REPORT_FILENAME").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('AccountingMailer/emailReport/sales_tax_liability'); ?>",
            data: {
                emailTo: emailTo,
                emailCC: emailCC,
                emailSubject: emailSubject,
                emailBody: emailBody,
                // EMAIL_REPORT_FILENAME: EMAIL_REPORT_FILENAME,
            },
            success: function(data) {
                $(".sendEmail").removeAttr('disabled').empty().append('Send');
                if (data == "true") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Report was emailed successfully!',
                    }).then((result) => {
                        $("#EMAIL_CLOSE_MODAL").click();
                    });
                } else {
                    $(".sendEmail").removeAttr('disabled').empty().append('Send');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to send report!',
                    });
                }
            }
        });
    });

    // END: ADD EVENT SCRIPT

    $('.add_notes').on('click', function(event) {
        $("#NOTES_CONTENT").hide();
        $("#ADD_NOTES_FORM").show();
    });
    $('#NOTE_CLOSE_MODAL').on('click', function(event) {
        $("#NOTES_CONTENT").show();
        $("#ADD_NOTES_FORM").hide();
    });


    // function PRINT_TABLE() {
    //     TABLE_SETTINGS[0]._iDisplayLength = 9999999999;
    //     SALES_TAX_LIABILITIES_TABLE_TABLE.draw();
    //     var filename = "[<?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?>] Customer Contact List";
    //     var tab = document.gNOTE_CLOSE_MODAL";
    //     style = style + "table {width: 100%;}";
    //     style = style + "* {font-family: arial;}";
    //     style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse; padding: 3px 5px;text-align: left;}";
    //     style = style + "</style>";
    //     var win = window.open('', '', 'height=650,width=1000');
    //     // win.document.write("<img style='position: absolute; top: 6px; right: 5px; width: 28%;' src='../files/image/IMAGE_FILE_HERE.png'>");
    //     win.document.write("<h2><strong><?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?></strong></h2>");
    //     win.document.write("<h4 style='margin: -20px 0px 15px 0px; font-weight: normal;'>Customer Contact List</h4>");
    //     win.document.write(tab.outerHTML);
    //     win.document.write(style);
    //     win.document.write("<style>#SALES_TAX_LIABILITIES_TABLE>tbody>tr>td{font-size: 12px;} #SALES_TAX_LIABILITIES_TABLE>thead>tr>th{font-size: 10px;}table{width: 100% !important}.avatar {width: 34px;min-width: 34px;height: 34px;}</style>");
    //     win.document.title = filename;
    //     setTimeout(function() {
    //         win.print();
    //         win.close();
    //     }, 1000);
    //     TABLE_SETTINGS[0]._iDisplayLength = 10;
    //     SALES_TAX_LIABILITIES_TABLE_TABLE.draw();
    // }
</script>
<?php include viewPath('v2/includes/footer'); ?>