<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('accounting/reports/reports_assets/report_css'); ?>
<?php
    $currentMonth = date("n");
    $startMonth = ceil($currentMonth / 3) * 3 - 2;
    $endMonth = $startMonth + 2;
    $currentQuarter = "This Quarter (" . date("M", mktime(0, 0, 0, $startMonth, 1)) . " - " . date("M", mktime(0, 0, 0, $endMonth, 1)) . ")";
?>
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
                                    <img id="businessLogo" class="<?php echo ($reportSettings->show_logo == 0 || !isset($reportSettings->show_logo)) ? 'd-none-custom' : '';?>"  src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
                                    <div class="reportTitleInfo">
                                        <h3 id="businessName"><?php echo ($reportSettings->company_name) ? $reportSettings->company_name : strtoupper($companyInfo->business_name)?></h3>
                                        <h5><strong id="reportName"><?php echo $reportSettings->title ?></strong></h5>
                                        <h5><small id="reportDate"><span id="filter_by_text"></span></small></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <?php 
                                        $tableID = "active_subscriptions_table"; 
                                        $reportCategory = "active_subscriptions"; 
                                    ?>
                                    <table id="<?php echo $tableID; ?>" class="nsm-table w-100 border-0">
                                        <thead>
                                            <tr>
                                                <th>CUSTOMER</th>
                                                <th>STATUS</th>
                                                <th>BILLING START DATE</th>
                                                <th>BILLING END DATE</th>
                                                <th style="text-align:right;">MMR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fetchResultLoader">
                                                    <center>
                                                        <div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <script> $('.fetchResultLoader').attr('colspan', $('#<?php echo $tableID ?> > thead > tr > th').length); </script>
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
                                                <div class="float-start noteCharMax">
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
<div class="modal fade" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Report Settings</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="reportSettingsForm" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label class="mb-1 fw-xnormal">Logo</label>
                                    <select id="showHideLogo" name="showHideLogo" class="nsm-field form-select">
                                        <?php if (isset($reportSettings->show_logo)) { ?>
                                            <option value="1" <?php echo (isset($reportSettings->show_logo) && $reportSettings->show_logo == 1) ? "selected" : "" ?>>Show</option>
                                            <option value="0" <?php echo (isset($reportSettings->show_logo) && $reportSettings->show_logo == 0) ? "selected" : "" ?>>Hide</option>
                                        <?php } else { ?>
                                            <option value="1" selected>Show</option>
                                            <option value="0">Hide</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableBusinessName" type="checkbox" <?php echo (!isset($reportSettings->show_company_name) || $reportSettings->show_company_name == 1) ? "checked" : ""; ?>></div>
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?php echo (trim(str_replace('&nbsp;', '', $reportSettings->company_name)) !== '') ? $reportSettings->company_name : strtoupper($companyInfo->business_name); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableReportName" type="checkbox" <?php echo (!isset($reportSettings->show_title) || $reportSettings->show_title == 1) ? "checked" : ""; ?>></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?php echo (trim(str_replace('&nbsp;', '', $reportSettings->title)) !== '') ? $reportSettings->title : $page->title; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="mb-1 fw-xnormal">Header Align</label>
                                    <select name="header_align" id="header-align" class="nsm-field form-select">
                                        <option value="C" <?php echo ($reportSettings->header_align == "C") ? "selected" : "" ?>>Center</option>
                                        <option value="L" <?php echo ($reportSettings->header_align == "L") ? "selected" : "" ?>>Left</option>
                                        <option value="R" <?php echo ($reportSettings->header_align == "R") ? "selected" : "" ?>>Right</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="mb-1 fw-xnormal">Footer Align</label>
                                    <select name="footer_align" id="footer-align" class="nsm-field form-select">
                                        <option value="C" <?php echo ($reportSettings->footer_align == "C") ? "selected" : "" ?>>Center</option>
                                        <option value="L" <?php echo ($reportSettings->footer_align == "L") ? "selected" : "" ?>>Left</option>
                                        <option value="R" <?php echo ($reportSettings->footer_align == "R") ? "selected" : "" ?>>Right</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="mb-1 fw-xnormal">Row Size</label>
                                    <select name="page_size" id="page-size" class="nsm-field form-select">
                                        <option value="9999" <?php echo ($reportSettings->page_size == "9999") ? "selected" : "" ?>>All</option>
                                        <option value="10" <?php echo ($reportSettings->page_size == "10") ? "selected" : "" ?>>10</option>
                                        <option value="25" <?php echo ($reportSettings->page_size == "25") ? "selected" : "" ?>>25</option>
                                        <option value="50" <?php echo ($reportSettings->page_size == "50") ? "selected" : "" ?>>50</option>
                                        <option value="100" <?php echo ($reportSettings->page_size == "100") ? "selected" : "" ?>>100</option>
                                        <option value="500" <?php echo ($reportSettings->page_size == "500") ? "selected" : "" ?>>500</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                <option value="bill_end_date" <?php echo ($reportSettings->sort_by == "bill_end_date") ? "selected" : "" ?>>Bill. End Date</option>
                                                <option value="customer" <?php echo ($reportSettings->sort_by == "customer") ? "selected" : "" ?>>Customer</option>
                                                <option value="customer_id" <?php echo ($reportSettings->sort_by == "customer_id") ? "selected" : "" ?>>Customer ID</option>
                                                <option value="status" <?php echo ($reportSettings->sort_by == "status") ? "selected" : "" ?>>Status</option>
                                                <option value="bill_start_date" <?php echo ($reportSettings->sort_by == "bill_start_date") ? "selected" : "" ?>>Bill. Start Date</option>
                                                <option value="mmr" <?php echo ($reportSettings->sort_by == "mmr") ? "selected" : "" ?>>MMR</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select">
                                                <option value="ASC" <?php echo ($reportSettings->sort_asc_desc== "ASC") ? "selected" : "" ?>>ASC</option>
                                                <option value="DESC" <?php echo ($reportSettings->sort_asc_desc == "DESC") ? "selected" : "" ?>>DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Date Filter</label>
                                    <select name="date_filter" id="date-filter" class="nsm-field form-select">
                                        <option value="get_all" <?php echo ($reportSettings->filter_by == "get_all") ? "selected" : "" ?>>None (get all records)</option>
                                        <option value="current_month" <?php echo ($reportSettings->filter_by == "current_month") ? "selected" : "" ?>>This Month (<?php echo date('M') . ' 1 - ' . date('t'); ?>)</option>
                                        <option value="current_quarter" <?php echo ($reportSettings->filter_by == "current_quarter") ? "selected" : "" ?>><?php echo $currentQuarter;?></option>
                                        <option selected value="current_year" <?php echo ($reportSettings->filter_by == "current_year") ? "selected" : "" ?>>This Year (<?php echo date('Y'); ?>)</option>
                                        <option value="custom" <?php echo ($reportSettings->filter_by == "custom") ? "selected" : "" ?>>Custom</option>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3 dateRangeFilterSection" style="display: none;">
                                    <label class="mb-1 fw-xnormal">Date Range <small class="text-muted"><i>(Specify From &mdash; To Dates)</i></small></label>
                                    <div class="input-group">
                                        <input name="date_from" class="form-control mt-0" type="date" value="<?= date('Y').'-01-01'; ?>">
                                        <input name="date_to" class="form-control mt-0" type="date" value="<?= date('Y-m-t'); ?>">
                                    </div>
                                </div>
                                <!-- <div class="col-md-12"><hr class="mt-0"></div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="mb-1 fw-xnormal">Subscription Period</label>
                                            <select name="subscription_period" id="subscription-period" class="nsm-field form-select">
                                                <option value="all" <?php echo ($reportSettings->subscription_period == "all") ? "selected" : "" ?>>All</option>
                                                <option value="last_7_days" <?php echo ($reportSettings->subscription_period == "last_7_days") ? "selected" : "" ?>>Last 7 Days</option>
                                                <option value="last_14_days" <?php echo ($reportSettings->subscription_period == "last_14_days") ? "selected" : "" ?>>Last 14 Days</option>
                                                <option value="last_30_days" <?php echo ($reportSettings->subscription_period == "last_30_days") ? "selected" : "" ?>>Last 30 Days</option>
                                                <option value="last_60_days" <?php echo ($reportSettings->subscription_period == "last_60_days") ? "selected" : "" ?>>Last 60 Days</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-12"><hr class="mt-0"></div>
                            </div>
                        </div>
                    </div>
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

<!-- START: PRINT/SAVE MODAL -->
<div class="modal fade" id="printPreviewModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Print or save as PDF</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
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
                        <!-- <div class="form-check">
                            <input id="pageHeaderRepeat" name="pageHeaderRepeat" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="pageHeaderRepeat">Repeat Page Header</label>
                        </div> -->
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
<div class="modal fade" id="emailReportModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
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
                                <input id="emailCC" class="form-control" type="email" placeholder="Carbon Copy">
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
<?php include viewPath('accounting/reports/reports_assets/report_js'); ?>
<?php include viewPath('v2/includes/footer'); ?>