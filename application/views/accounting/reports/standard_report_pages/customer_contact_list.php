<?php include viewPath('v2/includes/accounting_header'); ?>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<style>
    .saveCustomize {
        display: none;
    }

    table {
        width: 100% !important;
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
        width: 150px;
    }

    .accountingRadio {
        position: absolute;
        bottom: 5px;
    }

    .pdfAttachmentCheckbox,
    .xlsxAttachmentCheckbox {
        width: 18px;
        height: 18px;
    }

    .borderRadius0 > * {
        border-radius: 0px;
    }

    .pdfAttachment {
        margin-bottom: -1px;
    }

    .modal-body {
        padding-top: 10px;
    }

    .nsm-table td {
        padding: 5px 5px 5px 0px;
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
            <div class="nsm-callout primary"><button><i class="bx bx-x"></i></button><?php echo $page->description ?></div>
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
                                    <button type="button" class="nsm-button" data-bs-toggle="dropdown"><span>Settings</span> <i class='bx bx-fw bx-chevron-down'></i></button>
                                    <ul class="dropdown-menu p-3" style="width: 200px">
                                        <form id="sortReportForm" method="POST">
                                            <div class="row">
                                                <div class="col-lg-12 mb-2">
                                                    <label class="fw-bold mb-1">Sort By</label>
                                                    <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                        <option value="prof_id" selected>Default</option>
                                                        <option value="customer">Customer</option>
                                                        <option value="phoneNumber">Phone Numbers</option>
                                                        <option value="email">Email</option>
                                                        <option value="billingAddress">Billing</option>
                                                        <option value="shippingAddress">Shipping Address</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 mb-2">
                                                    <div class="form-check">
                                                        <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" value="ASC">
                                                        <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" id="sort-desc" name="sort_order" class="form-check-input" value="DESC" checked>
                                                        <label for="sort-desc" class="form-check-label">Descending order</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-2"><hr class="m-0"></div>
                                                <div class="col-lg-12 mb-2">
                                                    <label class="fw-bold mb-1">Page Size</label>
                                                    <select name="page_size" id="page-size" class="nsm-field form-select">
                                                        <option value="10" selected>10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                        <option value="500">500</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 mb-1"><button class="nsm-button primary small" type="submit">Apply</button></div>
                                            </div>
                                        </form>
                                    </ul>
                                    <button class="nsm-button addNotes">Add Notes</button>
                                </span>
                                <span class="float-end">
                                    <button data-bs-toggle="modal" data-bs-target="#emailReportModal" class="nsm-button border-0"><i class="bx bx-fw bx-envelope"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#printPreviewModal" class="nsm-button border-0"><i class="bx bx-fw bx-printer"></i></button>
                                    <button class="nsm-button border-0" data-bs-toggle="dropdown"><i class="bx bx-fw bx-export"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end export-dropdown" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="exportToXLSX">Export to Excel</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="exportToPDF" download>Export to PDF</a></li>
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
                                        <h3 id="businessName"><?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?></h3>
                                    </center>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <center>
                                        <h5><strong id="reportName"><?php echo $page->title ?></strong></h5>
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
                                                <td colspan="5">
                                                    <center>
                                                        <div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <span id="notesContent" class="text-muted">Loading Notes...</span>
                                    <form id="addNotesForm" method="POST" style="display: none;">
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
                                                    <button type="button" id="cancelNotes" class="nsm-button">Cancel</button>
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
<div class="modal" id="printPreviewModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
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
                            <select id="pageOrientation" name="pageOrientation" class="form-select">
                                <option value="P" selected>Portrait</option>
                                <option value="L">Landscape</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input id="pageHeaderRepeat" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Repeat Page Header</label>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <iframe id="pdfPreview" class="border-0" width="100%" height="450px"></iframe>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start">
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="float-end">
                            <button type="button" class="nsm-button primary savePDF">Save as PDF</button>
                            <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: PRINT/SAVE MODAL -->
<!-- START: EMAIL REPORT MODAL -->
<div class="modal" id="emailReportModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="sendEmailForm">
                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <h6>To</h6>
                                <input id="emailTo" class="form-control" type="email" placeholder="Send to" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>CC</h6>
                                <input id="emailCC" class="form-control" type="email" placeholder="Carbon Copy" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <input id="emailSubject" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <div id="emailBody">Hello,<br><br>Attached here is the <?php echo $page->title ?> from <?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?>.<br><br>Regards,<br><?php echo "$users->FName $users->LName"; ?></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Attachment</h6>
                                <div class="row">
                                    <div class="input-group borderRadius0 pdfAttachment">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox" type="checkbox"></div>
                                        <input id="pdfReportFilename" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".pdf" style="max-width: 60px;">
                                    </div>
                                    <div class="input-group borderRadius0">
                                        <div class="input-group-text"><input class="form-check-input mt-0 xlsxAttachmentCheckbox" type="checkbox"></div>
                                        <input id="xlsxReportFileName" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".xlsx" style="max-width: 60px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="emailCloseModal" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary sendEmail"><span class="sendEmail_Loader"></span>Send</button>
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

<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace( 'emailBody', {
            toolbarGroups: [
                { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            ], height: '165px',
        });
        
        $('select').select2('destroy'); // Disable Select2
    });

    var businessName = $("#businessName").text();
    var reportName = $("#reportName").text();
    var filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
    var notes = $("#notesContent").text();
    var reportID = "<?php echo $reportTypeId; ?>";
    var sort_by = $('select[name="sort_by"]').val();
    var sort_order = $('input[name="sort_order"]:checked').val();
    var page_size = $('select[name="page_size"]').val();
    var pageOrientation = $('#pageOrientation').val();
    var reportConfig = {
        sort_by: sort_by,
        sort_order: sort_order,
        page_size: page_size,
        pageOrientation: pageOrientation,
    };

    // Render result function
    function renderReportList(businessName, reportName, filename, notes, reportConfig) {
        $('#pdfPreview').before('<span class="dataLoader"><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...</span>').hide();
        $("#customercontactlist_table > tbody").empty().html('<tr><td colspan="5"><center><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result... </center></td></tr>');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('accounting_controllers/Reports/getReportData/customer_contact_list'); ?>",
            data: { 
                businessName: this.businessName, 
                reportName: this.reportName, 
                filename: this.filename, 
                notes: this.notes, 
                reportConfig: this.reportConfig, 
            },
            success: function(data) {
                $("#customercontactlist_table > tbody").empty().html(data);
                loadReportPreview();
            }
        });
    }

    // Fetch report notes function
    function getReportNotes(reportID) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('accounting_controllers/reports/getNotes'); ?>",
            data: { reportID: this.reportID, },
            success: function(data) {
                notes = data;
                $('#notesContent').html("Loading notes...");
                $('#notesContent').html(data);
                $("#NOTES").val(data);
                (data !== "") ? $('.addNotes').text('Edit Notes'): $('.addNotes').text('Add Notes');
                renderReportList(businessName, reportName, filename, notes, reportConfig);
            }
        });
    } getReportNotes(reportID);

    // Preview .pdf report in embedded frame function
    function loadReportPreview() {
        $('#pdfPreview').hide();
        $('#pdfPreview').attr(
            'src', 
            '<?php echo base_url("assets/pdf/accounting/"); ?>' + filename + '.pdf?' + Math.round(Math.random() * 1000000)
        ).on('load', function() {
            $('.dataLoader').remove();
            $('#pdfPreview').show();
        });
    }

    // Sort feature config
    $('#sortReportForm').submit(function(event) {
        event.preventDefault();
        sort_by = $('select[name="sort_by"]').val();
        sort_order = $('input[name="sort_order"]:checked').val();
        page_size = $('select[name="page_size"]').val();
        pageOrientation = $('#pageOrientation').val();
        reportConfig = {
            sort_by: sort_by,
            sort_order: sort_order,
            page_size: page_size,
            pageOrientation: pageOrientation,
        };
        renderReportList(businessName, reportName, filename, notes, reportConfig);
    });

    // Page orientation feature config
    $('#pageOrientation').change(function(event) {
        sort_by = $('select[name="sort_by"]').val();
        sort_order = $('input[name="sort_order"]:checked').val();
        page_size = $('select[name="page_size"]').val();
        pageOrientation = $('#pageOrientation').val();
        reportConfig = {
            sort_by: sort_by,
            sort_order: sort_order,
            page_size: page_size,
            pageOrientation: pageOrientation,
        };
        renderReportList(businessName, reportName, filename, notes, reportConfig);
    });

    // Add notes script
    $('#addNotesForm').submit(function(event) {
        event.preventDefault();
        // =========
        $("#customercontactlist_table > tbody").empty().html('<tr><td colspan="5"><center><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result... </center></td></tr>');
        // =========
        var reportNotes = $("#NOTES").val();
        // =========
        $('#notesContent').html(reportNotes);
        $("#notesContent").show();
        $("#addNotesForm").hide();
        (reportNotes !== "") ? $('.addNotes').text('Edit Notes'): $('.addNotes').text('Add Notes');
        // =========
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('accounting_controllers/reports/saveNotes'); ?>",
            data: { 
                reportID: reportID,
                reportNotes: reportNotes,
            },
            success: function(data) {
                notes = $("#notesContent").text();
                renderReportList(businessName, reportName, filename, notes, reportConfig);
            }
        });

    });

    // Send report in email script
    $('#sendEmailForm').submit(function(event) {
        event.preventDefault();
        $(".sendEmail").attr('disabled', '').empty().append('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Send');
        var emailTo = $("#emailTo").val();
        var emailCC = $("#emailCC").val();
        var emailSubject = $("#emailSubject").val();
        var emailBody = $("#emailBody").html();
        var customAttachmentNamePDF = ($('.pdfAttachmentCheckbox').is(":checked") == true) ? $("#pdfReportFilename").val() : "";
        var customAttachmentNameXLSX = ($('.xlsxAttachmentCheckbox').is(":checked") == true) ? $("#xlsxReportFileName").val() : "";
        var attachmentConfig = {
            reportFilePathPDF: filename + ".pdf",
            reportFilePathXLSX: filename + ".xlsx",
            customAttachmentNamePDF: customAttachmentNamePDF,
            customAttachmentNameXLSX: customAttachmentNameXLSX,
        }

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('AccountingMailer/emailReport/customer_contact_list'); ?>",
            data: {
                emailTo: emailTo,
                emailCC: emailCC,
                emailSubject: emailSubject,
                emailBody: emailBody,
                attachmentConfig: attachmentConfig,
            },
            success: function(data) {
                $(".sendEmail").removeAttr('disabled').empty().append('Send');
                if (data == "true") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Report was emailed successfully!',
                    }).then((result) => {
                        $("#emailCloseModal").click();
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

    // Export Report to PDF feature
    $("#exportToPDF, .savePDF").click(function(event) {
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

    // Export Report to XLSX feature
    $("#exportToXLSX").click(function(event) {
        event.preventDefault();
        var filePath = "<?php echo base_url('assets/pdf/accounting/'); ?>" + filename + ".xlsx";
        var link = $("<a>", {
            href: filePath,
            download: filename + ".xlsx",
        });
        $("body").append(link);
        link[0].click();
        link.remove();
    });

    // Show/hide script
    $('.addNotes').on('click', function(event) {
        $("#notesContent").hide();
        $("#addNotesForm").show();
        $("#NOTES").focus();
    });
    $('#cancelNotes').on('click', function(event) {
        $("#notesContent").show();
        $("#addNotesForm").hide();
    });
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
</script>
<?php include viewPath('v2/includes/footer'); ?>