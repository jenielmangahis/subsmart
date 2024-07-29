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
                                        <h5><small id="reportDate"><span id="date_from_text"></span> &mdash; <span id="date_to_text"></span></small></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <?php 
                                        $tableID = "contractorpayments_table"; 
                                        $reportCategory = "contractor_payments"; 
                                    ?>
                                    <table id="<?php echo $tableID; ?>" class="nsm-table w-100 border-0">
                                        <thead>
                                            <tr>                                                
                                                <th>PAY DATE</th>
                                                <th>CONTRACTOR</th>
                                                <th>TYPE</th>
                                                <th>PAY METHOD</th>
                                                <th>CHECK NUMBER</th>
                                                <th>ACCOUNT NAME</th>
                                                <th>PAY STATUS</th>                                                
                                                <th class="PLACE_RIGHT">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8">
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
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
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
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?php echo (!empty($reportSettings->company_name)) ? $reportSettings->company_name : strtoupper($companyInfo->business_name)?>" required>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableReportName" type="checkbox" <?php echo (!isset($reportSettings->show_title) || $reportSettings->show_title == 1) ? "checked" : ""; ?>></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?php echo (!empty($reportSettings->title)) ? $reportSettings->title : $page->title ?>" required>
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
                                                <option value="contractor_name" <?php echo ($reportSettings->sort_by == "contractor_name") ? "selected" : "" ?>>Contractor Name</option>
                                                <option value="payment_date" <?php echo ($reportSettings->sort_by == "payment_date") ? "selected" : "" ?>>Pay Date</option>
                                                <option value="total_amount" <?php echo ($reportSettings->sort_by == "total_amount") ? "selected" : "" ?>>Amount</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select">
                                                <option value="DESC" <?php echo ($reportSettings->sort_asc_desc == "DESC") ? "selected" : "" ?>>DESC</option>
                                                <option value="ASC" <?php echo ($reportSettings->sort_asc_desc== "ASC") ? "selected" : "" ?>>ASC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12"><hr class="mt-0"></div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Date Range <small class="text-muted">(From &mdash; To)</small></label>
                                    <div class="input-group">
                                        <input name="date_from" class="form-control mt-0" type="date" value="<?php echo (isset($reportSettings->report_date_from_text)) ? $reportSettings->report_date_from_text : date('Y').'-01-01'; ?>">
                                        <input name="date_to" class="form-control mt-0" type="date" value="<?php echo (isset($reportSettings->report_date_to_text)) ? $reportSettings->report_date_to_text : date('Y-m-d'); ?>">
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