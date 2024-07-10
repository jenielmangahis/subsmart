<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('accounting/reports/reports_assets/report_css'); ?>
<style>
.table-wrapper {
    overflow-x: auto;
    max-width: 100%;
    margin-bottom: 1rem;
}

.table-wrapper table thead tr th {
    padding: 20px
}

.nsm-table {
    width: 100%;
    white-space: nowrap;
}

.transaction-content {
    max-height: 100px;
    overflow-y: auto;
}

.transaction-content tr td {
    text-align: center
}

.compact-table td,
.compact-table th {
    padding: 4px 8px;
    font-size: 12px;
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
                                    <img id="businessLogo" class="<?php echo ($reportSettings->show_logo == 0 || !isset($reportSettings->show_logo)) ? 'd-none-custom' : '';?>"  src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
                                    <div class="reportTitleInfo">
                                        <h3 id="businessName"><?php echo ($reportSettings->company_name) ? $reportSettings->company_name : strtoupper($companyInfo->business_name)?></h3>
                                        <h5><strong id="reportName"><?php echo $reportSettings->title ?></strong></h5>
                                        <h5><small id="reportDate">As of <?php echo date('F d, Y'); ?></small></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                <?php
                                    $tableID = 'accounts_receivable_aging_detail_table';
$reportCategory = 'accounts_receivable_aging_detail_list';
?>
                                  <table class="nsm-table grid-mb">
                                        <thead>
                                            <tr>
                                                <?php if (isset($columns) && $total_index === 0) { ?>
                                                <td data-name=""></td>
                                                <?php } ?>
                                                <td data-name="Date"
                                                    <?php echo isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    DATE</td>
                                                <td data-name="Transaction Type"
                                                    <?php echo isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''; ?>>
                                                    TRANSACTION TYPE</td>
                                                <td data-name="Num"
                                                    <?php echo isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''; ?>>
                                                    NUM</td>
                                                <td data-name="Create Date"
                                                    <?php echo isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    CREATE DATE</td>
                                                <td data-name="Created By"
                                                    <?php echo isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''; ?>>
                                                    CREATED BY</td>
                                                <td data-name="Last Modified"
                                                    <?php echo isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''; ?>>
                                                    LAST MODIFIED</td>
                                                <td data-name="Last Modified By"
                                                    <?php echo isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''; ?>>
                                                    LAST MODIFIED BY</td>
                                                <td data-name="Customer"
                                                    <?php echo isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''; ?>>
                                                    CUSTOMER</td>
                                                <td data-name="Phone"
                                                    <?php echo isset($columns) && !in_array('Phone', $columns) ? 'style="display: none"' : ''; ?>>
                                                    PHONE</td>
                                                <td data-name="Phone Numbers"
                                                    <?php echo isset($columns) && !in_array('Phone Numbers', $columns) ? 'style="display: none"' : ''; ?>>
                                                    PHONE NUMBERS</td>
                                                <td data-name="Email"
                                                    <?php echo isset($columns) && !in_array('Email', $columns) ? 'style="display: none"' : ''; ?>>
                                                    EMAIL</td>
                                                <td data-name="Full Name"
                                                    <?php echo isset($columns) && !in_array('Full Name', $columns) ? 'style="display: none"' : ''; ?>>
                                                    FULL NAME</td>
                                                <td data-name="Billing Address"
                                                    <?php echo isset($columns) && !in_array('Billing Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    BILLING ADDRESS</td>
                                                <td data-name="Shipping Address"
                                                    <?php echo isset($columns) && !in_array('Shipping Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    SHIPPING ADDRESS</td>
                                                <td data-name="Company Name"
                                                    <?php echo isset($columns) && !in_array('Company Name', $columns) ? 'style="display: none"' : ''; ?>>
                                                    COMPANY NAME</td>
                                                <td data-name="Sales Rep"
                                                    <?php echo isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''; ?>>
                                                    SALES REP</td>
                                                <td data-name="P.O. Number"
                                                    <?php echo isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''; ?>>
                                                    P.O. NUMBER</td>
                                                <td data-name="Ship Via"
                                                    <?php echo isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''; ?>>
                                                    SHIP VIA</td>
                                                <td data-name="Terms"
                                                    <?php echo isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''; ?>>
                                                    TERMS</td>
                                                <td data-name="Client/Vendor Message"
                                                    <?php echo isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''; ?>>
                                                    CLIENT/VENDOR MESSAGE</td>
                                                <td data-name="Due Date"
                                                    <?php echo isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    DUE DATE</td>
                                                <td data-name="Past Due"
                                                    <?php echo isset($columns) && !in_array('Past Due', $columns) ? 'style="display: none"' : ''; ?>>
                                                    PAST DUE</td>
                                                <td data-name="Sent"
                                                    <?php echo isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''; ?>>
                                                    SENT</td>
                                                <td data-name="Delivery Address"
                                                    <?php echo isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    DELIVERY ADDRESS</td>
                                                <td data-name="Amount"
                                                    <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>>
                                                    AMOUNT</td>
                                                <td data-name="Open Balance"
                                                    <?php echo isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''; ?>>
                                                    OPEN BALANCE</td>
                                                <td data-name="Memo/Description"
                                                    <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>>
                                                    MEMO/DESCRIPTION</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($transactions) > 0) { ?>
                                            <?php foreach ($transactions as $index => $transaction) { ?>
                                            <tr data-bs-toggle="collapse"
                                                data-bs-target="#accordion-<?php echo $index; ?>"
                                                class="clickable collapse-row collapsed">
                                                <td colspan="<?php echo isset($columns) ? $total_index : '24'; ?>"><i
                                                        class="bx bx-fw bx-caret-right"></i>
                                                    <b><?php echo $transaction['name']; ?></b>
                                                </td>
                                                <td data-name="Amount"
                                                    <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <b><?php echo $transaction['amount_total']; ?></b>
                                                </td>
                                                <td data-name="Open Balance"
                                                    <?php echo isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <b><?php echo $transaction['open_balance_total']; ?></b>
                                                </td>
                                                <td data-name="Memo/Description"
                                                    <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>>
                                                </td>
                                            </tr>
                                        <tbody class="transaction-content clickable collapse-row collapse"
                                            id="accordion-<?php echo $index; ?>">
                                            <?php foreach ($transaction['transactions'] as $tran) { ?>
                                            <tr>
                                                <?php if (isset($columns) && $total_index === 0) { ?>
                                                <td data-name=""></td>
                                                <?php } ?>
                                                <td data-name="Date"
                                                    <?php echo isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['date'] != '' || $tran['date'] != null ? $tran['date'] : '---'; ?>
                                                </td>
                                                <td data-name="Transaction Type"
                                                    <?php echo isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['transaction_type'] != '' || $tran['transaction_type'] != null ? $tran['transaction_type'] : '---'; ?>
                                                </td>
                                                <td data-name="Num"
                                                    <?php echo isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['num'] != '' || $tran['num'] != null ? $tran['num'] : '---'; ?>
                                                </td>
                                                <td data-name="Create Date"
                                                    <?php echo isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['create_date'] != '' || $tran['create_date'] != null ? $tran['create_date'] : '---'; ?>
                                                </td>
                                                <td data-name="Created By"
                                                    <?php echo isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['created_by'] != '' || $tran['created_by'] != null ? $tran['created_by'] : '---'; ?>
                                                </td>
                                                <td data-name="Last Modified"
                                                    <?php echo isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['last_modified'] != '' || $tran['last_modified'] != null ? $tran['last_modified'] : '---'; ?>
                                                </td>
                                                <td data-name="Last Modified By"
                                                    <?php echo isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['last_modified_by'] != '' || $tran['last_modified_by'] != null ? $tran['last_modified_by'] : '---'; ?>
                                                </td>
                                                <td data-name="Customer"
                                                    <?php echo isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['customer'] != '' || $tran['customer'] != null ? $tran['customer'] : '---'; ?>
                                                </td>
                                                <td data-name="Phone"
                                                    <?php echo isset($columns) && !in_array('Phone', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['phone'] != '' || $tran['phone'] != null ? $tran['phone'] : '---'; ?>
                                                </td>
                                                <td data-name="Phone Numbers"
                                                    <?php echo isset($columns) && !in_array('Phone Numbers', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['phone_numbers'] != '' || $tran['phone_numbers'] != null ? $tran['phone_numbers'] : '---'; ?>
                                                </td>
                                                <td data-name="Email"
                                                    <?php echo isset($columns) && !in_array('Email', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['email'] != '' || $tran['email'] != null ? $tran['email'] : '---'; ?>
                                                </td>
                                                <td data-name="Full Name"
                                                    <?php echo isset($columns) && !in_array('Full Name', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['full_name'] != '' || $tran['full_name'] != null ? $tran['full_name'] : '---'; ?>
                                                </td>
                                                <td data-name="Billing Address"
                                                    <?php echo isset($columns) && !in_array('Billing Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['billing_address'] != '' || $tran['billing_address'] != null ? $tran['billing_address'] : '---'; ?>
                                                </td>
                                                <td data-name="Shipping Address"
                                                    <?php echo isset($columns) && !in_array('Shipping Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['shipping_address'] != '' || $tran['shipping_address'] != null ? $tran['shipping_address'] : '---'; ?>
                                                </td>
                                                <td data-name="Company Name"
                                                    <?php echo isset($columns) && !in_array('Company Name', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['company_name'] != '' || $tran['company_name'] != null ? $tran['company_name'] : '---'; ?>
                                                </td>
                                                <td data-name="Sales Rep"
                                                    <?php echo isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['sales_rep'] != '' || $tran['sales_rep'] != null ? $tran['sales_rep'] : '---'; ?>
                                                </td>
                                                <td data-name="P.O. Number"
                                                    <?php echo isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['po_number'] != '' || $tran['po_number'] != null ? $tran['po_number'] : '---'; ?>
                                                </td>
                                                <td data-name="Ship Via"
                                                    <?php echo isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['ship_via'] != '' || $tran['ship_via'] != null ? $tran['ship_via'] : '---'; ?>
                                                </td>
                                                <td data-name="Terms"
                                                    <?php echo isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['terms'] != '' || $tran['terms'] != null ? $tran['terms'] : '---'; ?>
                                                </td>
                                                <td data-name="Client/Vendor Message"
                                                    <?php echo isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['client_vendor_message'] != '' || $tran['client_vendor_message'] != null ? $tran['client_vendor_message'] : '---'; ?>
                                                </td>
                                                <td data-name="Due Date"
                                                    <?php echo isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['due_date'] != '' || $tran['due_date'] != null ? $tran['due_date'] : '---'; ?>
                                                </td>
                                                <td data-name="Past Due"
                                                    <?php echo isset($columns) && !in_array('Past Due', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['past_due'] != '' || $tran['past_due'] != null ? $tran['past_due'] : '---'; ?>
                                                </td>
                                                <td data-name="Sent"
                                                    <?php echo isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['sent'] != '' || $tran['sent'] != null ? $tran['sent'] : '---'; ?>
                                                </td>
                                                <td data-name="Delivery Address"
                                                    <?php echo isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['delivery_address'] != '' || $tran['delivery_address'] != null ? $tran['delivery_address'] : '---'; ?>
                                                </td>
                                                <td data-name="Amount"
                                                    <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['amount'] != '' || $tran['amount'] != null ? $tran['amount'] : '---'; ?>
                                                </td>
                                                <td data-name="Open Balance"
                                                    <?php echo isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['open_balance'] != '' || $tran['open_balance'] != null ? $tran['open_balance'] : '---'; ?>
                                                </td>
                                                <td data-name="Memo/Description"
                                                    <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['memo_description'] != '' || $tran['memo_description'] != null ? $tran['memo_description'] : '---'; ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <tr class="clickable collapse-row collapse group-total"
                                                id="accordion-<?php echo $index; ?>">
                                                <td colspan="<?php echo isset($columns) ? $total_index : '24'; ?>">
                                                    <b>Total for
                                                        <?php echo $transaction['name']; ?></b>
                                                </td>
                                                <td data-name="Amount"
                                                    <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <b><?php echo $transaction['amount_total']; ?></b>
                                                </td>
                                                <td data-name="Open Balance"
                                                    <?php echo isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <b><?php echo $transaction['open_balance_total']; ?></b>
                                                </td>
                                                <td data-name="Memo/Description"
                                                    <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <?php } ?>
                                        <?php } else { ?>
                                        <tr>
                                            <td colspan="27">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
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
                                                <option value="id" <?php echo ($reportSettings->sort_by == "id") ? "selected" : "" ?>>ID</option>
                                                <option value="vendor" <?php echo ($reportSettings->sort_by == "vendor") ? "selected" : "" ?>>Vendor</option>
                                                <option value="phone_numbers" <?php echo ($reportSettings->sort_by == "phone_numbers") ? "selected" : "" ?>>Phone Numbers</option>
                                                <option value="email" <?php echo ($reportSettings->sort_by == "email") ? "selected" : "" ?>>Email</option>
                                                <option value="fullname" <?php echo ($reportSettings->sort_by == "fullname") ? "selected" : "" ?>>Full Name</option>
                                                <option value="address" <?php echo ($reportSettings->sort_by == "address") ? "selected" : "" ?>>Address</option>
                                                <option value="account_number" <?php echo ($reportSettings->sort_by == "account_number") ? "selected" : "" ?>>Account #</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select">
                                                <option value="DESC" <?php echo ($reportSettings->sort_asc_desc == "DESC") ? "selected" : "" ?>>DESC</option>
                                                <option value="ASC" <?php echo ($reportSettings->sort_asc_desc== "ASC") ? "selected" : "" ?>>ASC</option>
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
                            <input id="pageHeaderRepeat" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Repeat Page Header</label>
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