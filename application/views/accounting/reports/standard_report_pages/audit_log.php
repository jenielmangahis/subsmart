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
/*        display: none;*/
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

    .fw-xnormal {
        font-weight: 500;
    }

    #sort-by {
        width: 125px;
    }

    .headerInfo {
        position: relative;
    }

    .footerInfo {
        text-align: center;
    }

    .reportTitleInfo {
        text-align: center;
    }

    #businessLogo {
        height: auto;
        width: 85px;
        position: absolute;
        left: 20px;
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
                            <div class="row mb-4">
                                <div class="col-lg-12 headerInfo">
                                    <img id="businessLogo" src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
                                    <div class="reportTitleInfo">
                                        <h3 id="businessName"><?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?></h3>
                                        <h5><strong id="reportName"><?php echo $page->title ?></strong></h5>
                                        <h5><small id="reportDate">As of <?php echo date('F d, Y'); ?></small></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <?php 
                                        $tableID = "auditloglist_table"; 
                                        $reportCategory = "audit_log_list"; 
                                    ?>
                                    <table id="<?php echo $tableID; ?>" class="nsm-table w-100 border-0">
                                        <thead>
                                            <tr>
                                                <th>DATE CHANGED</th>
                                                <th>USER</th>
                                                <th>EVENT</th>
                                                <th>NAME</th>
                                                <th>DATE</th>
                                                <th>AMOUNT</th>
                                                <th>HISTORY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7">
                                                    <center>
                                                        <div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-3">
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
                            <div class="row footerInfo">
                                <span class=""><?php echo date("l, F j, Y h:i A eP") ?></span>
                            </div>
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
                                        <label class="mb-1 fw-xnormal">User</label>
                                        <select class="form-select">
                                            <option value="all" selected>All</option>
                                            <?php 
                                                foreach ($customerByCompanyID as $customerByCompanyIDs) {
                                                    echo "<option value='$customerByCompanyIDs->prof_id'>$customerByCompanyIDs->first_name $customerByCompanyIDs->last_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Date Changed</label>
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
                                        <label class="mb-1 fw-xnormal">Event <small class="text-muted">(Module)</small></label>
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
                                <div class="col-md-2 mb-3">
                                    <label class="mb-1 fw-xnormal">Logo</label>
                                    <select id="showHideLogo" name="showHideLogo" class="nsm-field form-select">
                                        <option value="1" selected>Show</option>
                                        <option value="0">Hide</option>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox enableDisableBusinessName" type="checkbox" checked></div>
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox enableDisableReportName" type="checkbox" checked></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?php echo $page->title ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="mb-1 fw-xnormal">Header Align</label>
                                    <select name="header_align" id="header-align" class="nsm-field form-select">
                                        <option value="L">Left</option>
                                        <option value="C" selected>Center</option>
                                        <option value="R">Right</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="mb-1 fw-xnormal">Footer Align</label>
                                    <select name="footer_align" id="footer-align" class="nsm-field form-select">
                                        <option value="L">Left</option>
                                        <option value="C" selected>Center</option>
                                        <option value="R">Right</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="mb-1 fw-xnormal">Page Size</label>
                                    <select name="page_size" id="page-size" class="nsm-field form-select">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                <option value="id" selected>Default</option>
                                                <option value="date_changed">Date Changed</option>
                                                <option value="user">User</option>
                                                <option value="event">Event</option>
                                                <option value="name">Name</option>
                                                <option value="date">Date</option>
                                                <option value="amount">Amount</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select">
                                                <option value="ASC">ASC</option>
                                                <option value="DESC" selected>DESC</option>
                                            </select>
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
                                <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Report Settings -->

<!-- Modal for Appointment and Job Preview -->
<div class="modal" id="historyPreviewModal" role="dialog" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title historyPreviewModalTitle" style="font-size: 17px;"></span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body historyPreviewModalBody">Fetching Result...</div>
        </div>
    </div>
</div>
<!-- Modal for Appointment and Job Preview -->
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
                            <input id="pageHeaderRepeat" name="pageHeaderRepeat" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="pageHeaderRepeat">Repeat Page Header</label>
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
                                    <div id="emailBody">Hello,<br><br>Attached here is the <?php echo $page->title ?> from <?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?>.<br><br>Regards,<br><?php echo "$users->FName $users->LName"; ?></div>
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
    $(function() { $('select').select2('destroy'); });

    CKEDITOR.replace('emailBody', {
        toolbarGroups: [
            { name: 'clipboard', groups: ['clipboard', 'undo'] },
            { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        ],
        height: '165px',
    });

    var BASE_URL = window.location.origin;
    var REPORT_CATEGORY = "<?php echo $reportCategory; ?>";
    var REPORT_ID = "<?php echo $reportTypeId; ?>";
    // =========================
    var theadColumnNames = $(`#<?php echo $tableID; ?> th`).map(function() { return $(this).text(); }).get();
    var theadTotalColumn = $("#<?php echo $tableID; ?>").find('tr:first th').length;
    var businessLogoURL = 'uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image"; ?>';
    var businessName = $('input[name="company_name"]').val();
    var reportName = $('input[name="report_name"]').val();
    var reportDate = $("#reportDate").text();
    var filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
    var notes = $("#notesContent").text();
    // =========================
    var showHideLogo = $('select[name="showHideLogo"]').val();
    var enableDisableBusinessName = $('.enableDisableBusinessName').prop('checked');
    var enableDisableReportName = $('.enableDisableReportName').prop('checked');
    var header_align = $('select[name="header_align"]').val();
    var footer_align = $('select[name="footer_align"]').val();
    var sort_by = $('select[name="sort_by"]').val();
    var sort_order = $('select[name="sort_order"]').val();
    var page_size = $('select[name="page_size"]').val();
    var pageOrientation = $('select[name="pageOrientation"]').val();
    var pageHeaderRepeat = ($('input[name="pageHeaderRepeat"]').prop('checked') == true) ? 1 : 0;
    // =========================
    var reportConfig = {
        businessLogoURL: businessLogoURL,
        showHideLogo: showHideLogo,
        header_align: header_align,
        footer_align: footer_align,
        sort_by: sort_by,
        sort_order: sort_order,
        page_size: page_size,
        pageOrientation: pageOrientation,
        pageHeaderRepeat: pageHeaderRepeat,
    };

    // Render Report Data Script
    function renderReportList() {
        theadColumnNames = $(`#<?php echo $tableID; ?> th`).map(function() { return $(this).text(); }).get();
        theadTotalColumn = $("#<?php echo $tableID; ?>").find('tr:first th').length;
        businessLogoURL = 'uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image"; ?>';
        businessName = $('input[name="company_name"]').val();
        reportName = $('input[name="report_name"]').val();
        reportDate = $("#reportDate").text();
        filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
        notes = $("#notesContent").text();
        showHideLogo = $('select[name="showHideLogo"]').val();
        enableDisableBusinessName = $('.enableDisableBusinessName').prop('checked');
        enableDisableReportName = $('.enableDisableReportName').prop('checked');
        header_align = $('select[name="header_align"]').val();
        footer_align = $('select[name="footer_align"]').val();
        sort_by = $('select[name="sort_by"]').val();
        sort_order = $('select[name="sort_order"]').val();
        page_size = $('select[name="page_size"]').val();
        pageOrientation = $('select[name="pageOrientation"]').val();
        pageHeaderRepeat = ($('input[name="pageHeaderRepeat"]').prop('checked') == true) ? 1 : 0;
        reportConfig = {
            businessLogoURL: businessLogoURL,
            showHideLogo: showHideLogo,
            header_align: header_align,
            footer_align: footer_align,
            sort_by: sort_by,
            sort_order: sort_order,
            page_size: page_size,
            pageOrientation: pageOrientation,
            pageHeaderRepeat: pageHeaderRepeat,
        };
        // =========================
        (enableDisableBusinessName) ? $("#businessName").text(businessName) : businessName = $("#businessName").html("&nbsp;").html() ;
        (enableDisableReportName) ? $("#reportName").text(reportName) : reportName = $("#reportName").html("&nbsp;").html() ;
        if (showHideLogo == "1") {
            $('#businessLogo').attr('src', BASE_URL + '/uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image?"; ?>' + Math.round(Math.random() * 1000000)).show();
            if (header_align == "L") { $('.reportTitleInfo').css({textAlign: 'left', marginLeft: '115px'}); }
            if (header_align == "C") { $('.reportTitleInfo').css({textAlign: 'center', marginLeft: 'unset'}); }
            if (header_align == "R") { $('.reportTitleInfo').css({textAlign: 'right', marginLeft: 'unset'}); }
            if (footer_align == "L") { $('.footerInfo').css({textAlign: 'left'}); }
            if (footer_align == "C") { $('.footerInfo').css({textAlign: 'center'}); }
            if (footer_align == "R") { $('.footerInfo').css({textAlign: 'right'}); }
        } else {
            $('#businessLogo').hide();
            if (header_align == "L") { $('.reportTitleInfo').css({textAlign: 'left', marginLeft: 'unset'}); }
            if (header_align == "C") { $('.reportTitleInfo').css({textAlign: 'center', marginLeft: 'unset'}); }
            if (header_align == "R") { $('.reportTitleInfo').css({textAlign: 'right', marginLeft: 'unset'}); }
            if (footer_align == "L") { $('.footerInfo').css({textAlign: 'left'}); }
            if (footer_align == "C") { $('.footerInfo').css({textAlign: 'center'}); }
            if (footer_align == "R") { $('.footerInfo').css({textAlign: 'right'}); }
        }
        $(".settingsApplyButton").attr('disabled', '').html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Applying changes...');
        $('#pdfPreview').before('<span class="dataLoader"><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...</span>').hide();
        $("#<?php echo $tableID; ?> > tbody").html('<tr><td colspan="' + theadColumnNames.length + '"><center><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result... </center></td></tr>');
        // =========================
        $.ajax({
            type: "POST",
            url: BASE_URL + "/accounting_controllers/Reports/getReportData/" + REPORT_CATEGORY,
            data: { 
                theadColumnNames: theadColumnNames,
                theadTotalColumn: theadTotalColumn,
                businessName: businessName,
                reportName: reportName, 
                reportDate: reportDate, 
                filename: filename, 
                notes: notes, 
                reportConfig: reportConfig, 
            },
            success: function(data) {
                loadReportPreview();
                $("#<?php echo $tableID; ?> > tbody").html(data);
                $(".settingsApplyButton").removeAttr('disabled').html('Apply');
                $('#reportSettings').modal('hide');
            }
        });
    }

    // Load .pdf Report Script
    function loadReportPreview() {
        $('#pdfPreview').hide();
        $('#pdfPreview').attr('src', BASE_URL + "/assets/pdf/accounting/" + filename + ".pdf?" + Math.round(Math.random() * 1000000) ).on('load', function() {
            $('.dataLoader').remove();
            $('#pdfPreview').show();
        });
    }

    // Report Config Script
    $('#reportSettingsForm').submit(function(event) {
        event.preventDefault();
        renderReportList();
    });

    // Page Orientation Config Script
    $('#pageOrientation').change(function(event) {
        renderReportList();
    });

    // Header Repeat Config Script
    $('#pageHeaderRepeat').change(function(event) {
        renderReportList();
    });

    // Fetch Report Notes On Page Load
    $.ajax({
        type: "POST",
        url: BASE_URL + "/accounting_controllers/reports/getNotes",
        data: { reportID: REPORT_ID, },
        success: function(data) {
            (data !== "") ? $('.addNotes').text('Edit Notes'): $('.addNotes').text('Add Notes');
            $('#notesContent').html(data);
            $("#NOTES").val(data);
            renderReportList();
        }
    });

    // Add and Edit Notes Script
    $('#addNotesForm').submit(function(event) {
        event.preventDefault();
        $(".noteSaveButton").attr('disabled', '').html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Saving notes...');
        $('#notesContent').html($("#NOTES").val());
        ($("#NOTES").val() !== "") ? $('.addNotes').text('Edit Notes'): $('.addNotes').text('Add Notes');
        // =========
        $.ajax({
            type: "POST",
            url: BASE_URL + "/accounting_controllers/reports/saveNotes",
            data: { 
                reportID: REPORT_ID,
                reportNotes: $("#NOTES").val(),
            },
            success: function(data) {
                $(".noteSaveButton").removeAttr('disabled').html('Save');
                $("#notesContent").show();
                $("#addNotesForm").hide();
                renderReportList();
            }
        });
    });

    // Email Report Script
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

    // Export Report to PDF Script
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

    // Export Report to XLSX Script
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