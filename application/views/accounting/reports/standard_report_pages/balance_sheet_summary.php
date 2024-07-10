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
                                <button type="button" id="collapseButton" class="nsm-button">
                                    <span>Collapse</span>
                                </button>
                                <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                    <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu p-3">
                                    <div class="form-check">
                                        <input type="radio" checked id="sort-default" name="sort_order" class="form-check-input">
                                        <label for="sort-default" class="form-check-label">Default</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="sort-asc" name="sort_order" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Total in ascending order</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                        <label for="sort-desc" class="form-check-label">Total in descending order</label>
                                    </div>
                                </ul>
                                <span class="float-start">
                                    <button class="nsm-button addNotes">Add Notes</button>
                                </span>
                                <span class="float-end">
                                    <button data-bs-toggle="modal" data-bs-target="#emailReportModal" class="nsm-button border-0 top-button"><i class="bx bx-fw bx-envelope icon-top"></i></button>
                                    <!-- <button data-bs-toggle="modal" data-bs-target="#printPreviewModal" class="nsm-button border-0 top-button"><i class="bx bx-fw bx-printer icon-top"></i></button> -->
                                    <button type="button" class="nsm-button border-0" data-bs-toggle="modal" data-bs-target="#printPreviewModal" onclick="previewPDF()">
                                        <i class='bx bx-fw bx-printer'></i>
                                    </button>
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
                                    <table class="nsm-table balance-sheet-summary-table" id="tableID">
                                        <thead>
                                            <tr>
                                                <td data-name="Name"></td>
                                                <td data-name="Total">TOTAL</td>
                                            </tr>
                                        </thead>
                                        <tbody id="reportTable">
                                            <!-- ASSETS -->
                                            <tr data-bs-toggle="collapse" data-bs-target="#assets" class="clickable collapse-row collapsed">
                                                <td><i class="bx bx-fw bx-caret-right"></i> ASSETS</td>
                                                <td>$571,265.66</td>
                                            </tr>
                                            <tr class="collapse" id="assets">
                                                <td colspan="2">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr data-bs-toggle="collapse" data-bs-target="#currentAssets" class="clickable collapse-row collapsed">
                                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Current Assets</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr id="currentAssets" class="collapse">
                                                                <td colspan="2">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr data-bs-toggle="collapse" data-bs-target="#bankAccounts" class="clickable collapse-row collapsed">
                                                                                <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Bank Accounts</td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr id="bankAccounts" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Checking</td>
                                                                                <td>$305,061.93</td>
                                                                            </tr>
                                                                            <tr data-bs-toggle="collapse" data-bs-target="#testBank" class="clickable collapse-row collapsed">
                                                                                <td>&emsp;&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Test Bank (Cash on hand)</td>
                                                                                <td>$990.77</td>
                                                                            </tr>
                                                                            <tr id="testBank" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;&emsp;Sub-bank (Cash on hand)</td>
                                                                                <td>$990.00</td>
                                                                            </tr>
                                                                            <tr id="testBank" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;&emsp;<b>Total Test Bank (Cash on hand)</b></td>
                                                                                <td><b>$1,980.77</b></td>
                                                                            </tr>
                                                                            <tr id="bankAccounts" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Test Category</td>
                                                                                <td>$10.00</td>
                                                                            </tr>
                                                                            <tr id="bankAccounts" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;<b>Total Bank Accounts</b></td>
                                                                                <td><b>$307,052.70</b></td>
                                                                            </tr>
                                                                            <tr data-bs-toggle="collapse" data-bs-target="#accountsReceivable" class="clickable collapse-row collapsed">
                                                                                <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Accounts Receivable</td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr id="accountsReceivable" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Accounts Receivable</td>
                                                                                <td>$205,324.93</td>
                                                                            </tr>
                                                                            <tr id="accountsReceivable" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;<b>Total Accounts Receivable</b></td>
                                                                                <td><b>$205,324.93</b></td>
                                                                            </tr>
                                                                            <tr data-bs-toggle="collapse" data-bs-target="#otherCurrentAssets" class="clickable collapse-row collapsed">
                                                                                <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Other Current Assets</td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr id="otherCurrentAssets" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Credit Card Receivables</td>
                                                                                <td>$207.95</td>
                                                                            </tr>
                                                                            <tr id="otherCurrentAssets" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Inventory</td>
                                                                                <td>$25.00</td>
                                                                            </tr>
                                                                            <tr id="otherCurrentAssets" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                                                                <td>$25,705.75</td>
                                                                            </tr>
                                                                            <tr id="otherCurrentAssets" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Test OCA</td>
                                                                                <td>$1,000.00</td>
                                                                            </tr>
                                                                            <tr id="otherCurrentAssets" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                                                                <td>$9,068.80</td>
                                                                            </tr>
                                                                            <tr id="otherCurrentAssets" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                                                                <td>$16,347.82</td>
                                                                            </tr>
                                                                            <tr id="otherCurrentAssets" class="collapse">
                                                                                <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                                                                <td><b>$52,355.32</b></td>
                                                                            </tr>
                                                                            <tr id="currentAssets" class="collapse">
                                                                                <td>&emsp;&emsp;<b>Total Current Assets</b></td>
                                                                                <td><b>$564,732.95</b></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr data-bs-toggle="collapse" data-bs-target="#fixedAssets" class="clickable collapse-row collapsed">
                                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Fixed Assets</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr id="fixedAssets" class="collapse">
                                                                <td colspan="2">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr id="fixedAssets" class="collapse">
                                                                                <td>&emsp;&emsp;Accumulated Depreciation</td>
                                                                                <td>$-26,176.00</td>
                                                                            </tr>
                                                                            <tr id="fixedAssets" class="collapse">
                                                                                <td>&emsp;&emsp;Fixed Asset Computers</td>
                                                                                <td>$6,069.00</td>
                                                                            </tr>
                                                                            <tr id="fixedAssets" class="collapse">
                                                                                <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                                                                <td>$25,289.00</td>
                                                                            </tr>
                                                                            <tr id="fixedAssets" class="collapse">
                                                                                <td>&emsp;&emsp;Fixed Asset Phone</td>
                                                                                <td>$1,200.00</td>
                                                                            </tr>
                                                                            <tr id="fixedAssets" class="collapse">
                                                                                <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                                                                <td><b>$6,382.00</b></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr id="assets" class="collapse">
                                                                <td>&emsp;<b>TOTAL ASSETS</b></td>
                                                                <td><b>$571,114.95</b></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- LIABILITIES AND EQUITY -->
                                            <tr data-bs-toggle="collapse" data-bs-target="#liabilitiesEquity" class="clickable collapse-row collapsed">
                                                <td><i class="bx bx-fw bx-caret-right"></i> LIABILITIES AND EQUITY</td>
                                                <td>$571,265.66</td>
                                            </tr>
                                            <tr class="collapse" id="liabilitiesEquity">
                                                <td colspan="2">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr data-bs-toggle="collapse" data-bs-target="#liabilities" class="clickable collapse-row collapsed">
                                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Liabilities</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr id="liabilities" class="collapse">
                                                                <td colspan="2">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr data-bs-toggle="collapse" data-bs-target="#currentLiabilities" class="clickable collapse-row collapsed">
                                                                                <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Current Liabilities</td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr id="currentLiabilities" class="collapse">
                                                                                <td colspan="2">
                                                                                    <table class="table mb-0">
                                                                                        <tbody>
                                                                                            <tr id="currentLiabilities" class="collapse">
                                                                                                <td>&emsp;&emsp;&emsp;Accounts Payable</td>
                                                                                                <td>$15,000.00</td>
                                                                                            </tr>
                                                                                            <tr id="currentLiabilities" class="collapse">
                                                                                                <td>&emsp;&emsp;&emsp;Credit Card</td>
                                                                                                <td>$5,000.00</td>
                                                                                            </tr>
                                                                                            <tr id="currentLiabilities" class="collapse">
                                                                                                <td>&emsp;&emsp;&emsp;<b>Total Current Liabilities</b></td>
                                                                                                <td><b>$20,000.00</b></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr data-bs-toggle="collapse" data-bs-target="#longTermLiabilities" class="clickable collapse-row collapsed">
                                                                                <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Long-term Liabilities</td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr id="longTermLiabilities" class="collapse">
                                                                                <td colspan="2">
                                                                                    <table class="table mb-0">
                                                                                        <tbody>
                                                                                            <tr id="longTermLiabilities" class="collapse">
                                                                                                <td>&emsp;&emsp;&emsp;Mortgage Payable</td>
                                                                                                <td>$100,000.00</td>
                                                                                            </tr>
                                                                                            <tr id="longTermLiabilities" class="collapse">
                                                                                                <td>&emsp;&emsp;&emsp;Car Loan</td>
                                                                                                <td>$15,000.00</td>
                                                                                            </tr>
                                                                                            <tr id="longTermLiabilities" class="collapse">
                                                                                                <td>&emsp;&emsp;&emsp;<b>Total Long-term Liabilities</b></td>
                                                                                                <td><b>$115,000.00</b></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr id="liabilities" class="collapse">
                                                                                <td>&emsp;&emsp;<b>Total Liabilities</b></td>
                                                                                <td><b>$135,000.00</b></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr data-bs-toggle="collapse" data-bs-target="#equity" class="clickable collapse-row collapsed">
                                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Equity</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr id="equity" class="collapse">
                                                                <td colspan="2">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr id="equity" class="collapse">
                                                                                <td>&emsp;&emsp;Owner's Equity</td>
                                                                                <td>$400,000.00</td>
                                                                            </tr>
                                                                            <tr id="equity" class="collapse">
                                                                                <td>&emsp;&emsp;Retained Earnings</td>
                                                                                <td>$36,265.66</td>
                                                                            </tr>
                                                                            <tr id="equity" class="collapse">
                                                                                <td>&emsp;&emsp;<b>Total Equity</b></td>
                                                                                <td><b>$436,265.66</b></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr id="liabilitiesEquity" class="collapse">
                                                                <td>&emsp;<b>Total Liabilities and Equity</b></td>
                                                                <td><b>$571,265.66</b></td>
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
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?= $reportSettings && $reportSettings->title != '' ? $reportSettings->title : 'Balance Sheet Summary'; ?>" required>
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
<?php include viewPath('accounting/reports/reports_assets/balance_sheet_summary_js'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>