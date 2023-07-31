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
    <!-- <div class="row mb-1">
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
                                <option value="Customer">Customer</option>
                                <option value="Phone Numbers">Phone Numbers</option>
                                <option value="Email">Email</option>
                                <option value="Billing">Billing</option>
                                <option value="Shipping Address">Shipping Address</option>
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
    </div> -->
    <!-- <div class="row addMargin3">
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
    </div> -->
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
                                            <option value="Customer">Customer</option>
                                            <option value="Phone Numbers">Phone Numbers</option>
                                            <option value="Email">Email</option>
                                            <option value="Billing">Billing</option>
                                            <option value="Shipping Address">Shipping Address</option>
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
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="EXPORT_TO_EXCEL">Export to Excel</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="EXPORT_TO_PDF" download>Export to PDF</a></li>
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
                                        <h5><strong id="REPORT_NAME">Customer Contact List Report</strong></h5>
                                    </center>
                                </div>
                            </div>
                            <!-- <div class="row mb-3"> 
                                <div class="col-lg-12">
                                    <center>
                                        <h5><small id="reportDate">April - June, 2023</small></h5>
                                    </center>
                                </div>
                            </div> -->
                            <div class="mb-4"></div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <table id="customercontactlist_table" class="nsm-table w-100 border-0" data-tableName="Test Table 1">
                                        <thead>
                                            <tr>
                                                <th>CUSTOMER</th>
                                                <th>PHONE NUMBERS</th>
                                                <th>EMAIL</th>
                                                <th>BILLING</th>
                                                <th>SHIPPING ADDRESS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5"><center><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...</center></td>
                                            </tr>
                                        </tbody>
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
                                            <script type="text/javascript">
                                                $("#NOTES").change(function(event) {
                                                    console.log($(this).val());
                                                });
                                            </script>
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
                        <div class="float-end">
                                <button type="button" class="nsm-button success savePDF">Save as PDF</button>
                                <!-- <button type="button" class="nsm-button success printPDF">Print</button> -->
                            </div>
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
                                    <input id="EMAIL_REPORT_FILENAME" class="form-control" type="text" value="Customer Contact List Report" required>
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

    var businessName = $("#BUSINESS_NAME").html();
    var reportName = $("#REPORT_NAME").html();
    var filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('accounting_controllers/Reports/getReportData/customer_contact_list'); ?>",
        data: { 
            businessName: businessName, 
            reportName: reportName, 
            filename: filename, 
        },
        success: function(data) {
            $("#customercontactlist_table > tbody").empty().html(data);
        }
    });

    // START: PDF SETTINGS SCRIPT
    var PAGE = "PAGE=ACCOUNTING";
    var BUSINESS_NAME = "BUSINESS_NAME=" + $("#BUSINESS_NAME").html();
    var REPORT_NAME = "REPORT_NAME=" + $("#REPORT_NAME").html();
    var PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=false";
    var PDF_ORIENTATION = "PAGE_ORIENTATION=PORTRAIT";

    // INITIATE SETTINGS
    $('#PDF_PREVIEW').attr('src', '<?php echo base_url("assets/pdf/accounting/"); ?>' + filename + '.pdf');

    // $('#PAGE_ORIENTATION').change(function(event) {
    //     PDF_ORIENTATION = "PAGE_ORIENTATION=" + $(this).val();
    //     $('#PDF_PREVIEW').attr('src', '<?php echo base_url("AccountingGenerateReport?"); ?>' + PAGE + "&" + BUSINESS_NAME + "&" + REPORT_NAME + "&" + PDF_ORIENTATION + "&" + PDF_HEADER_REPEAT);
    // });

    // $('#PAGE_HEADER_REPEAT').change(function() {
    //     if ($(this).is(':checked')) {
    //         PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=true";
    //         $('#PDF_PREVIEW').attr('src', '<?php echo base_url("AccountingGenerateReport?"); ?>' + PAGE + "&" + BUSINESS_NAME + "&" + REPORT_NAME + "&" + PDF_ORIENTATION + "&" + PDF_HEADER_REPEAT);
    //     } else {
    //         PDF_HEADER_REPEAT = "PAGE_HEADER_REPEAT=false";
    //         $('#PDF_PREVIEW').attr('src', '<?php echo base_url("AccountingGenerateReport?"); ?>' + PAGE + "&" + BUSINESS_NAME + "&" + REPORT_NAME + "&" + PDF_ORIENTATION + "&" + PDF_HEADER_REPEAT);
    //     }
    // });
    // END: PDF SETTINGS SCRIPT

    var REPORT_ID = "<?php echo $reportTypeId; ?>";
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('accounting_controllers/reports/getNotes'); ?>",
        data: { 
            REPORT_ID: REPORT_ID,
        },
        success: function(data) {
            $('#NOTES_CONTENT').html("Loading notes...");
            $('#NOTES_CONTENT').html(data);
            $("#NOTES").val(data);
            (data !== "") ? $('.add_notes').text('Edit Notes'): $('.add_notes').text('Add Notes');
        }
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
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('accounting_controllers/reports/saveNotes'); ?>",
            data: { 
                REPORT_ID: REPORT_ID,
                REPORT_NOTES: REPORT_NOTES,
            },
            success: function(data) {
                $("#NOTES_CLOSE_MODAL").click();
            }
        });

    });
    // END: ADD NOTES SCRIPT

    // START: ADD EVENT SCRIPT
    $('#SEND_EMAIL_FORM').submit(function(event) {
        event.preventDefault();
        $(".sendEmail").attr('disabled', '').empty().append('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Send');
        var emailTo = $("#EMAIL_TO").val();
        var emailCC = $("#EMAIL_CC").val();
        var emailSubject = $("#EMAIL_SUBJECT").val();
        var emailBody = $("#EMAIL_BODY").val();
        var customAttachmentName = $("#EMAIL_REPORT_FILENAME").val();
        var reportFilePath = filename + ".pdf";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('AccountingMailer/emailReport/customer_contact_list'); ?>",
            data: {
                emailTo: emailTo,
                emailCC: emailCC,
                emailSubject: emailSubject,
                emailBody: emailBody,
                customAttachmentName: customAttachmentName,
                reportFilePath: reportFilePath,
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
        $("#NOTES").focus();
    });
    $('#NOTE_CLOSE_MODAL').on('click', function(event) {
        $("#NOTES_CONTENT").show();
        $("#ADD_NOTES_FORM").hide();
    });

    $("#EXPORT_TO_PDF, .savePDF").click(function(event) {
        event.preventDefault();
        var filePath = "<?php echo base_url('assets/pdf/accounting/'); ?>" + filename + ".pdf";
        var link = $("<a>", {
            href: filePath,
            download: filename + ".pdf",
        });
        $("body").append(link);
        link[0].click();
        link.remove();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>