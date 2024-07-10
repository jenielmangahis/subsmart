<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('accounting/reports/reports_assets/report_css'); ?>

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
                                    <button data-bs-toggle="modal" data-bs-target="#emailReportModal" class="nsm-button border-0 top-button"><i class="bx bx-fw bx-envelope icon-top"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#printPreviewModal" class="nsm-button border-0 top-button"><i class="bx bx-fw bx-printer icon-top"></i></button>
                                    <button class="nsm-button border-0 top-button" data-bs-toggle="dropdown"><i class="bx bx-fw bx-export icon-top"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end export-dropdown" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="exportToXLSX">Export to Excel</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="exportToPDF" download>Export to PDF</a></li>
                                    </ul>
                                    <button class="nsm-button border-0 primary top-button" data-bs-toggle="modal" data-bs-target="#reportSettings"><i class="bx bx-fw bx-cog icon-top"></i></button>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="nsm-card-content">
                            <div class="row mb-4">
                                <div class="col-lg-12 headerInfo">
                                    <img id="businessLogo" class="<?php echo ($reportSettings->show_logo == 0 || !isset($reportSettings->show_logo)) ? 'd-none-custom' : ''; ?>" src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
                                    <div class="reportTitleInfo">
                                        <h3 id="businessName"><?php echo ($reportSettings->company_name) ? $reportSettings->company_name : strtoupper($companyInfo->business_name) ?></h3>
                                        <h5><strong id="reportName"><?php echo $reportSettings->title ?></strong></h5>
                                        <h5><small id="report_date_text">As of <?php echo date('F d, Y'); ?></small></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <?php
                                    $tableID = "balanceSheetDetails_table";
                                    $reportCategory = "balance_sheet_details";
                                    ?>
                                    <table class="nsm-table balance-sheet-details-table" id="tableID">
                                        <thead>
                                            <tr>
                                                <td data-name="Date">DATE</td>
                                                <td data-name="Transaction Type">TRANSACTION TYPE</td>
                                                <td data-name="Num">NUM</td>
                                                <td data-name="Name">NAME</td>
                                                <td data-name="Memo/Description">MEMO/DESCRIPTION</td>
                                                <td data-name="Split">SPLIT</td>
                                                <td data-name="Debit">DEBIT</td>
                                                <td data-name="Credit">CREDIT</td>
                                                <td data-name="Amount">AMOUNT</td>
                                                <td data-name="Balance">BALANCE</td>
                                            </tr>
                                        </thead>
                                        <tbody id="reportTable">
                                            <!-- ASSETS -->
                                            <tr data-bs-toggle="collapse" data-bs-target="#assets" class="clickable collapse-row collapsed">
                                                <td><i class="bx bx-fw bx-caret-right"></i> ASSETS</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>$22,544.77</td>
                                                <td>$1,404,676.97</td>
                                            </tr>
                                            <tr id="assets" class="collapse">
                                                <td colspan="10">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr data-bs-toggle="collapse" data-bs-target="#checking" class="clickable collapse-row collapsed">
                                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Checking</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr id="checking" class="collapse">
                                                                <td colspan="10">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Beginning balance</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>1,081,409.39</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>06/01/2022</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payment</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payment Fees-1</td>
                                                                                <td></td>
                                                                                <td>$19.95</td>
                                                                                <td>-19.95</td>
                                                                                <td>1,081,389.44</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>06/01/2022</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>-Split-</td>
                                                                                <td>$1,167.62</td>
                                                                                <td></td>
                                                                                <td>1,167.62</td>
                                                                                <td>1,082,557.06</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&emsp;<b>TOTAL ASSETS</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>$22,544.77</td>
                                                                <td>$1,404,676.97</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- LIABILITIES AND EQUITY -->
                                            <tr data-bs-toggle="collapse" data-bs-target="#liabilitiesEquity" class="clickable collapse-row collapsed">
                                                <td><i class="bx bx-fw bx-caret-right"></i> LIABILITIES AND EQUITY</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>$1,922,289.76</td>
                                                <td>$1,404,676.97</td>
                                            </tr>
                                            <tr id="liabilitiesEquity" class="collapse">
                                                <td colspan="10">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <!-- Liabilities -->
                                                            <tr data-bs-toggle="collapse" data-bs-target="#liabilities" class="clickable collapse-row collapsed">
                                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Liabilities</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr id="liabilities" class="collapse">
                                                                <td colspan="10">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Accounts Payable</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>$10,000.00</td>
                                                                                <td>$15,000.00</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Short-term Loans</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>$5,000.00</td>
                                                                                <td>$7,000.00</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>&emsp;<b>TOTAL LIABILITIES</b></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>$15,000.00</td>
                                                                                <td>$22,000.00</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&emsp;<b>TOTAL LIABILITIES AND EQUITY</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>$1,922,289.76</td>
                                                                <td>$1,404,676.97</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
                            <?php
                            $footer_css = '';
                            if ($reportSettings) {
                                if ($reportSettings->footer_align == 'C') {
                                    $footer_css = 'text-align:center;';
                                } elseif ($reportSettings->footer_align == 'L') {
                                    $footer_css = 'text-align:left;';
                                } elseif ($reportSettings->footer_align == 'R') {
                                    $footer_css = 'text-align:right;';
                                }
                            }
                            ?>
                            <div class="row footerInfo" style="<?= $footer_css; ?>">
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

<!-- START: PRINT/SAVE MODAL -->
<div class="modal fade" id="printPreviewModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
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
                                <option value="p" selected>Portrait</option>
                                <option value="l">Landscape</option>
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
                                <input id="emailCC" class="form-control" type="email" placeholder="Carbon Copy">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <!-- <input id="emailSubject" class="form-control" type="text" value="<?php echo $companyInfo ? strtoupper($companyInfo->business_name) : ''; ?>: <?php echo $page->title; ?>" required> -->
                                <input id="emailSubject" class="form-control" type="text" value="<?php echo $page->title; ?>" required>
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
<!-- Modal for Report Settings -->
<div class="modal fade" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
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
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableBusinessName" type="checkbox" checked></div>
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?= $reportSettings && $reportSettings->company_name != '' ? $reportSettings->company_name : $companyInfo->business_name; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableReportName" type="checkbox" checked></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?= $reportSettings && $reportSettings->title != '' ? $reportSettings->title : 'Balance Sheet Details'; ?>" required>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4 mb-3">
                                    <label for="filter-date">Date</label>
                                    <div class="">
                                        <input type="date" name="date" id="report-date" class="form-control nsm-field date" value="<?= $reportSettings && $reportSettings->report_date_text != '' ? date("Y-m-d", strtotime($reportSettings->report_date_text)) : date("Y-m-d"); ?>" data-type="filter-date">
                                    </div>
                                </div> -->
                                <div class="col-md-4 mb-3">
                                    <label for="filter-date">Date</label>
                                    <div class="">
                                        <input type="date" id="filter-date" class="form-control nsm-field date" value="<?= $reportSettings && $reportSettings->report_date_text != '' ? date("Y-m-d", strtotime($reportSettings->report_date_text)) : date("Y-m-d"); ?>" data-type="filter-date">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Logo</label>
                                    <select id="showHideLogo" name="showHideLogo" class="nsm-field form-select">
                                        <option value="1" <?= $reportSettings && $reportSettings->show_logo == 1 ? 'selected="selected"' : ''; ?> selected>Show</option>
                                        <option value="0" <?= $reportSettings && $reportSettings->show_logo == 0 ? 'selected="selected"' : ''; ?>>Hide</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Header Align</label>
                                    <select name="header_align" id="header-align" class="nsm-field form-select">
                                        <option value="C" <?= $reportSettings && $reportSettings->header_align == 'C' ? 'selected="selected"' : ''; ?>>Center</option>
                                        <option value="L" <?= $reportSettings && $reportSettings->header_align == 'L' ? 'selected="selected"' : ''; ?>>Left</option>
                                        <option value="R" <?= $reportSettings && $reportSettings->header_align == 'R' ? 'selected="selected"' : ''; ?>>Right</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Footer Align</label>
                                    <select name="footer_align" id="footer-align" class="nsm-field form-select">
                                        <option value="C" <?= $reportSettings && $reportSettings->footer_align == 'C' ? 'selected="selected"' : ''; ?>>Center</option>
                                        <option value="L" <?= $reportSettings && $reportSettings->footer_align == 'L' ? 'selected="selected"' : ''; ?>>Left</option>
                                        <option value="R" <?= $reportSettings && $reportSettings->footer_align == 'R' ? 'selected="selected"' : ''; ?>>Right</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Page Size</label>
                                    <select name="page_size" id="page-size" class="nsm-field form-select">
                                        <option value="10" <?= $reportSettings && $reportSettings->page_size == 10 ? 'selected="selected"' : ''; ?>>10</option>
                                        <option value="25" <?= $reportSettings && $reportSettings->page_size == 25 ? 'selected="selected"' : ''; ?>>25</option>
                                        <option value="50" <?= $reportSettings && $reportSettings->page_size == 50 ? 'selected="selected"' : ''; ?>>50</option>
                                        <option value="100" <?= $reportSettings && $reportSettings->page_size == 100 ? 'selected="selected"' : ''; ?>>100</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                <option value="date" <?= $reportSettings && $reportSettings->sort_by == 'date' ? 'selected="selected"' : ''; ?>>Date</option>
                                                <option value="user" <?= $reportSettings && $reportSettings->sort_by == 'user' ? 'selected="selected"' : ''; ?>>User</option>
                                                <option value="event" <?= $reportSettings && $reportSettings->sort_by == 'event' ? 'selected="selected"' : ''; ?>>Event</option>
                                                <option value="name" <?= $reportSettings && $reportSettings->sort_by == 'name' ? 'selected="selected"' : ''; ?>>Name</option>
                                                <option value="amount" <?= $reportSettings && $reportSettings->sort_by == 'amount' ? 'selected="selected"' : ''; ?>>Amount</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select" style="margin-left:2px;">
                                                <option value="ASC" <?= $reportSettings && $reportSettings->sort_asc_desc == 'ASC' ? 'selected="selected"' : ''; ?>>ASC</option>
                                                <option value="DESC" <?= $reportSettings && $reportSettings->sort_asc_desc == 'DESC' ? 'selected="selected"' : ''; ?>>DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="mb-1 fw-xnormal">Display Density</label><br />
                                    <input type="checkbox" id="compact_display" name="compact_display" class="form-check-input">
                                    <label for="compact-display" class="form-check-label">Compact</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="mb-1 fw-xnormal">Change Columns</label><br />
                                        <div class="checkbox-grid">
                                            <div class="form-check">
                                                <input type="checkbox" id="date" class="form-check-input">
                                                <label for="date" class="form-check-label">Date</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="create-date" class="form-check-input">
                                                <label for="create-date" class="form-check-label">Create Date</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="last-modified-by" class="form-check-input">
                                                <label for="last-modified-by" class="form-check-label">Last Modified By</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="split" class="form-check-input">
                                                <label for="split" class="form-check-label">Split</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="payment-method" class="form-check-input">
                                                <label for="payment-method" class="form-check-label">Payment Method</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="transaction-type" class="form-check-input">
                                                <label for="transaction-type" class="form-check-label">Transaction Type</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="created-by" class="form-check-input">
                                                <label for="created-by" class="form-check-label">Created By</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="name" class="form-check-input">
                                                <label for="name" class="form-check-label">Name</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="debit" class="form-check-input">
                                                <label for="debit" class="form-check-label">Debit</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="amount" class="form-check-input">
                                                <label for="amount" class="form-check-label">Amount</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="num" class="form-check-input">
                                                <label for="num" class="form-check-label">Num</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="last-modified" class="form-check-input">
                                                <label for="last-modified" class="form-check-label">Last Modified</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="memo-description" class="form-check-input">
                                                <label for="memo-description" class="form-check-label">Memo/Description</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="credit" class="form-check-input">
                                                <label for="credit" class="form-check-label">Credit</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="balance" class="form-check-input">
                                                <label for="balance" class="form-check-label">Balance</label>
                                            </div>
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

<?php include viewPath('v2/includes/footer'); ?>
<?php include viewPath('accounting/reports/reports_assets/balance_sheet_details_js'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>