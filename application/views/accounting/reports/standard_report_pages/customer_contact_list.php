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
                                    <button class="nsm-button border-0 primary" data-bs-toggle="modal" data-bs-target="#reportSettings"><i class="bx bx-fw bx-cog"></i></button>
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
                            <div class="row mb-3 d-none"> 
                                <div class="col-lg-12">
                                    <center>
                                        <h5><small id="reportDate"></small></h5>
                                    </center>
                                </div>
                            </div>
                            <div class="mb-4"></div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <?php 
                                        $tableID = "customercontactlist_table"; 
                                        $reportCategory = "customer_contact_list"; 
                                    ?>
                                    <table id="<?php echo $tableID; ?>" class="nsm-table w-100 border-0">
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
                                                    <button type="submit" class="nsm-button primary noteSaveButton">Save</button>
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
<!-- Modal for Report Settings -->
<div class="modal" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Report Settings</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="reportSettingsForm" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- FOR LATER UPDATES -->
                            <!-- <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-xnormal">Date Changed</label>
                                        <select class="form-select">
                                            <option value="Today">Today</option>
                                            <option value="Yesterday">Yesterday</option>
                                            <option value="This Week">This Week</option>
                                            <option value="This Month">This Month</option>
                                            <option value="This Quarter">This Quarter</option>
                                            <option value="This Year">This Year</option>
                                            <option value="Last Week">Last Week</option>
                                            <option value="Last Month">Last Month</option>
                                            <option value="Last Quarter">Last Quarter</option>
                                            <option value="Last Year">Last Year</option>
                                            <option value="Last Seven Years">Last Seven Years</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-xnormal">Event <small class="text-muted">(Module)</small></label>
                                        <select class="form-select">
                                            <option value="All">All</option>
                                            <option value="Workorder">Workorder</option>
                                            <option value="Invoice">Invoice</option>
                                            <option value="Taskhub">Taskhub</option>
                                            <option value="Customer">Customer</option>
                                            <option value="Estimate">Estimate</option>
                                            <option value="Event">Event</option>
                                            <option value="Appointment">Appointment</option>
                                            <option value="Jobs">Jobs</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox" type="checkbox" checked></div>
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?php echo ($head) ? strtoupper($company_title) : strtoupper($clients->business_name); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox" type="checkbox" checked></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?php echo $page->title ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label fw-xnormal">Header Align</label>
                                    <select name="header_align" id="header-align" class="form-select">
                                        <option value="C" selected>Center</option>
                                        <option value="L">Left</option>
                                        <option value="R">Right</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label fw-xnormal">Footer Align</label>
                                    <select name="footer_align" id="footer-align" class="form-select">
                                        <option value="C" selected>Center</option>
                                        <option value="L">Left</option>
                                        <option value="R">Right</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label fw-xnormal">Page Size</label>
                                    <select name="page_size" id="page-size" class="form-select">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-xnormal">Sort By</label>
                                        <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                            <option value="prof_id" selected>Default</option>
                                            <option value="customer">Customer</option>
                                            <option value="phoneNumber">Phone Numbers</option>
                                            <option value="email">Email</option>
                                            <option value="billingAddress">Billing</option>
                                            <option value="shippingAddress">Shipping Address</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-xnormal">Sort In</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sort_order" id="sort-asc" value="ASC">
                                            <label class="form-check-label" for="sort-asc">ASC</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sort_order" id="sort-desc" value="DESC" checked>
                                            <label class="form-check-label" for="sort-desc">DESC</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary settingsApplyButton">Apply</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Report Settings -->

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

    var BASE_URL = window.location.origin;
    var REPORT_CATEGORY = "<?php echo $reportCategory; ?>";
    var REPORT_ID = "<?php echo $reportTypeId; ?>";
    // =========================
    var theadColumnNames = $(`#<?php echo $tableID; ?> th`).map(function() { return $(this).text(); }).get();
    var theadTotalColumn = $("#<?php echo $tableID; ?>").find('tr:first th').length;
    var businessName = $("#businessName").text();
    var reportName = $("#reportName").text();
    var reportDate = $("#reportDate").text();
    var filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
    var notes = $("#notesContent").text();
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

    // update variable data function
    function updateDataOnVariable() {
        theadColumnNames = $(`#<?php echo $tableID; ?> th`).map(function() { return $(this).text(); }).get();
        theadTotalColumn = $("#<?php echo $tableID; ?>").find('tr:first th').length;
        businessName = $("#businessName").text();
        reportName = $("#reportName").text();
        reportDate = $("#reportDate").text();
        filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
        notes = $("#notesContent").text();
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
    }

    // Render result function
    function renderReportList(theadColumnNames, theadTotalColumn, businessName, reportName, reportDate, filename, notes, reportConfig) {
        $(".settingsApplyButton").attr('disabled', '').empty().append('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Applying changes...');
        $('#pdfPreview').before('<span class="dataLoader"><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...</span>').hide();
        $("#<?php echo $tableID; ?> > tbody").empty().html('<tr><td colspan="7"><center><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result... </center></td></tr>');
        $.ajax({
            type: "POST",
            url: BASE_URL + "/accounting_controllers/Reports/getReportData/" + REPORT_CATEGORY,
            data: { 
                theadColumnNames: this.theadColumnNames,
                theadTotalColumn: this.theadTotalColumn,
                businessName: this.businessName,
                reportName: this.reportName, 
                reportDate: this.reportDate, 
                filename: this.filename, 
                notes: this.notes, 
                reportConfig: this.reportConfig, 
            },
            success: function(data) {
                $("#<?php echo $tableID; ?> > tbody").empty().html(data);
                loadReportPreview();
                $(".settingsApplyButton").removeAttr('disabled').empty().append('Apply');
                $('#reportSettings').modal('hide');
            }
        });
    }

    // Fetch report notes function
    function getReportNotes(REPORT_ID) {
        $.ajax({
            type: "POST",
            url: BASE_URL + "/accounting_controllers/reports/getNotes",
            data: { reportID: this.REPORT_ID, },
            success: function(data) {
                notes = data;
                $('#notesContent').html("Loading notes...");
                $('#notesContent').html(data);
                $("#NOTES").val(data);
                (data !== "") ? $('.addNotes').text('Edit Notes'): $('.addNotes').text('Add Notes');
                renderReportList(theadColumnNames, theadTotalColumn, businessName, reportName, reportDate, filename, notes, reportConfig);
            }
        });
    } getReportNotes(REPORT_ID);

    // Preview .pdf report in embedded frame function
    function loadReportPreview() {
        $('#pdfPreview').hide();
        $('#pdfPreview').attr(
            'src', 
            BASE_URL + "/assets/pdf/accounting/" + filename + ".pdf?" + Math.round(Math.random() * 1000000)
        ).on('load', function() {
            $('.dataLoader').remove();
            $('#pdfPreview').show();
        });
    }

    // Sort feature config
    $('#reportSettingsForm').submit(function(event) {
        event.preventDefault();
        updateDataOnVariable();
        renderReportList(theadColumnNames, theadTotalColumn, businessName, reportName, reportDate, filename, notes, reportConfig);
    });

    // Page orientation feature config
    $('#pageOrientation').change(function(event) {
        updateDataOnVariable();
        renderReportList(theadColumnNames, theadTotalColumn, businessName, reportName, reportDate, filename, notes, reportConfig);
    });

    // Add notes script
    $('#addNotesForm').submit(function(event) {
        event.preventDefault();
        // =========
        $(".noteSaveButton").attr('disabled', '').empty().append('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Saving notes...');
        // =========
        var reportNotes = $("#NOTES").val();
        // =========
        $('#notesContent').html(reportNotes);
        (reportNotes !== "") ? $('.addNotes').text('Edit Notes'): $('.addNotes').text('Add Notes');
        // =========
        $.ajax({
            type: "POST",
            url: BASE_URL + "/accounting_controllers/reports/saveNotes",
            data: { 
                reportID: REPORT_ID,
                reportNotes: reportNotes,
            },
            success: function(data) {
                notes = $("#notesContent").text();
                $(".noteSaveButton").removeAttr('disabled').empty().append('Save');
                $("#notesContent").show();
                $("#addNotesForm").hide();
                updateDataOnVariable();
                renderReportList(theadColumnNames, theadTotalColumn, businessName, reportName, reportDate, filename, notes, reportConfig);
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
            url: BASE_URL + "/AccountingMailer/emailReport/" + REPORT_CATEGORY,
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
        var filePath = BASE_URL + "/assets/pdf/accounting/" + filename + ".pdf";
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
        var filePath = BASE_URL + "/assets/pdf/accounting/" + filename + ".xlsx";
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
        $(".addNotes").focus();
        $("#notesContent").show();
        $("#addNotesForm").hide();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>