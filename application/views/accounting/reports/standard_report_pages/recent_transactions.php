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
                                        $tableID = "recenttransactions_table"; 
                                        $reportCategory = "recent_transactions"; 
                                    ?>
                                   
                                    <table id="<?php echo $tableID; ?>" class="nsm-table w-100 border-0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>TRANS. TYPE</th>
                                                <th>NUM</th>
                                                <th>CREATE DATE</th>
                                                <th>NAME</th>
                                                <th>MEMO/DESC</th>
                                                <th>ACCT</th>
                                                <th>SPLIT</th>
                                                <th>REF#</th>
                                                <th>SALES REP</th>
                                                <th>PO NUM.</th>
                                                <th>PO STATUS</th>
                                                <th>PYMT METHOD</th>
                                                <th>TERMS</th>
                                                <th>DUE DATE</th>
                                                <th>INV. DATE</th>
                                                <th>OPEN BAL.</th>
                                                <th>DEBIT</th>
                                                <th>CREDIT</th>
                                                <th>TAX AMT</th>
                                                <th style="text-align: right;">AMT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="21">
                                                    <center>
                                                        <div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="nsm-table grid-mb" id="reports-table" style="display: none;">
                                        <thead>
                                            <tr>
                                                <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                                <td data-name=""></td>
                                                <?php endif; ?>
                                                <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                                                <td data-name="Transaction Type" <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>>TRANSACTION TYPE</td>
                                                <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td> 
                                                <!-- <td data-name="Adj" <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>>ADJ</td> -->
                                                <!-- <td data-name="Posting" <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>>POSTING</td> -->
                                                <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                                <!-- <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td> -->
                                                <!-- <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td> -->
                                                <!-- <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td> -->
                                                <td data-name="Name" <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>>NAME</td>
                                                <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                                <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                                                <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                                                <td data-name="Ref No." <?=isset($columns) && !in_array('Ref No.', $columns) ? 'style="display: none"' : ''?>>REF #</td>
                                                <td data-name="Sales Rep" <?=isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''?>>SALES REP</td>
                                                <td data-name="P.O. Number" <?=isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''?>>P.O. NUMBER</td>
                                                <td data-name="PO Status" <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>>PO STATUS</td>
                                                <!-- <td data-name="Ship Via" <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>>SHIP VIA</td> -->
                                                <td data-name="Payment Method" <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>>PAYMENT METHOD</td>
                                                <td data-name="Terms" <?=isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''?>>TERMS</td>
                                                <td data-name="Due Date" <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>>DUE DATE</td>
                                                <!-- <td data-name="Customer/Vendor Message" <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>>CUSTOMER/VENDOR MESSAGE</td> -->
                                                <td data-name="Invoice Date" <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>>INVOICE DATE</td>
                                                <!-- <td data-name="A/R Paid" <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>>A/R PAID</td>
                                                <td data-name="A/P Paid" <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>>A/P PAID</td>
                                                <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                                                <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                                                <td data-name="Paid by MAS" <?=isset($columns) && !in_array('Paid by MAS', $columns) ? 'style="display: none"' : ''?>>PAID BY MAS</td> -->
                                                <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                                                <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                                                <td data-name="Debit" <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>>DEBIT</td>
                                                <td data-name="Credit" <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>>CREDIT</td>
                                                <!-- <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td> -->
                                                <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>>TAX AMOUNT</td>
                                                <!-- <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>>TAXABLE AMOUNT</td> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($transactions) > 0) : ?>
                                            <?php foreach($transactions as $index => $transaction) : ?>
                                            <?php if($group_by === 'none') : ?>
                                            <tr>
                                                <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['date']?></td>
                                                <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['transaction_type']?></td>
                                                <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$transaction['num']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>><?=$transaction['adj']?></td> -->
                                                <!-- <td <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>><?=$transaction['posting']?></td> -->
                                                <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['create_date']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['created_by']?></td> -->
                                                <!-- <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified']?></td> -->
                                                <!-- <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified_by']?></td> -->
                                                <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['name']?></td>
                                                <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo_desc']?></td>
                                                <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account']?></td>
                                                <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$transaction['split']?></td>
                                                <td <?=isset($columns) && !in_array('Ref No.', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ref_no']?></td>
                                                <td <?=isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''?>><?=$transaction['sales_rep']?></td>
                                                <td <?=isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''?>><?=$transaction['po_number']?></td>
                                                <td <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>><?=$transaction['po_status']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ship_via']?></td> -->
                                                <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$transaction['payment_method']?></td>
                                                <td <?=isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''?>><?=$transaction['terms']?></td>
                                                <td <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['due_date']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$transaction['cust_vendor_message']?></td> -->
                                                <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['invoice_date']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ar_paid']?></td>
                                                <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ap_paid']?></td>
                                                <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$transaction['clr']?></td>
                                                <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_printed']?></td>
                                                <td <?=isset($columns) && !in_array('Paid by MAS', $columns) ? 'style="display: none"' : ''?>><?=$transaction['paid_by_mas']?></td> -->
                                                <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                                                <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['open_balance']?></td>
                                                <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['debit']?></td>
                                                <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['credit']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$transaction['online_banking']?></td> -->
                                                <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_amount']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['taxable_amount']?></td> -->
                                            </tr>
                                            <?php else : ?>
                                            <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                                <td colspan="<?=isset($columns) ? $total_index : '14'?>"><i class="bx bx-fw bx-caret-right"></i> <b><?=$transaction['name']?></b></td>
                                                <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['amount_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Open Balance', $columns) || $columns[0] === 'Open Balance' ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['debit_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['credit_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Online Banking', $columns) || $columns[0] === 'Online Banking' ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['tax_amount_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['taxable_amount_total']?></b></td>
                                            </tr>
                                            <?php foreach($transaction['transactions'] as $tran) : ?>
                                            <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                                <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                                <td></td>
                                                <?php endif; ?>
                                                <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$tran['date']?></td>
                                                <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$tran['transaction_type']?></td>
                                                <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$tran['num']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>><?=$transaction['adj']?></td> -->
                                                <!-- <td <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>><?=$tran['posting']?></td> -->
                                                <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$tran['create_date']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$tran['created_by']?></td> -->
                                                <!-- <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$tran['last_modified']?></td> -->
                                                <!-- <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$tran['last_modified_by']?></td> -->
                                                <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$tran['name']?></td>
                                                <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$tran['memo_desc']?></td>
                                                <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$tran['account']?></td>
                                                <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$tran['split']?></td>
                                                <td <?=isset($columns) && !in_array('Ref No.', $columns) ? 'style="display: none"' : ''?>><?=$tran['ref_no']?></td>
                                                <td <?=isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''?>><?=$tran['sales_rep']?></td>
                                                <td <?=isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''?>><?=$tran['po_number']?></td>
                                                <td <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>><?=$tran['po_status']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>><?=$tran['ship_via']?></td> -->
                                                <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$tran['payment_method']?></td>
                                                <td <?=isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''?>><?=$tran['terms']?></td>
                                                <td <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>><?=$tran['due_date']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$tran['cust_vendor_message']?></td> -->
                                                <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$tran['invoice_date']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$tran['ar_paid']?></td>
                                                <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$tran['ap_paid']?></td>
                                                <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$tran['clr']?></td>
                                                <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$tran['check_printed']?></td>
                                                <td <?=isset($columns) && !in_array('Paid by MAS', $columns) ? 'style="display: none"' : ''?>><?=$tran['paid_by_mas']?></td> -->
                                                <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$tran['amount']?></td>
                                                <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$tran['open_balance']?></td>
                                                <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$tran['debit']?></td>
                                                <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$tran['credit']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$tran['online_banking']?></td> -->
                                                <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$tran['tax_amount']?></td>
                                                <!-- <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$tran['taxable_amount']?></td> -->
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr class="clickable collapse-row collapse group-total" id="accordion-<?=$index?>">
                                                <td colspan="<?=isset($columns) ? $total_index : '14'?>"><b>Total for <?=$transaction['name']?></b></td>
                                                <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['amount_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Open Balance', $columns) || $columns[0] === 'Open Balance' ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['debit_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['credit_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Online Banking', $columns) || $columns[0] === 'Online Banking' ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['tax_amount_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['taxable_amount_total']?></b></td>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <?php else : ?>
                                            <tr>
                                                <td colspan="35">
                                                    <div class="nsm-empty">
                                                        <span>No results found.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
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
                                <div class="col-md-3 mb-3">
                                    <label for="from-date">From Date</label>
                                    <div class="">
                                        <input type="date" id="from-date" name="date_from" class="form-control nsm-field" value="<?= $reportSettings && $reportSettings->report_date_from_text != '' ? date("Y-m-d",strtotime($reportSettings->report_date_from_text)) : date("Y-m-d"); ?>" data-type="filter-date">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="to-date">To Date</label>
                                    <div class="">
                                        <input type="date" id="to-date" name="date_to" class="form-control nsm-field" value="<?= $reportSettings && $reportSettings->report_date_to_text != '' ? date("Y-m-d",strtotime($reportSettings->report_date_to_text)) : date("Y-m-d"); ?>" data-type="filter-date">
                                    </div>
                                </div>                                
                                <!-- <div class="col-md-2 mb-3">
                                    <label class="mb-1 fw-xnormal">Row Size</label>
                                    <select name="page_size" id="page-size" class="nsm-field form-select">
                                        <option value="9999" <?php echo ($reportSettings->page_size == "9999") ? "selected" : "" ?>>All</option>
                                        <option value="10" <?php echo ($reportSettings->page_size == "10") ? "selected" : "" ?>>10</option>
                                        <option value="25" <?php echo ($reportSettings->page_size == "25") ? "selected" : "" ?>>25</option>
                                        <option value="50" <?php echo ($reportSettings->page_size == "50") ? "selected" : "" ?>>50</option>
                                        <option value="100" <?php echo ($reportSettings->page_size == "100") ? "selected" : "" ?>>100</option>
                                        <option value="500" <?php echo ($reportSettings->page_size == "500") ? "selected" : "" ?>>500</option>
                                    </select>
                                </div> -->
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort_by" class="nsm-field form-select">
                                                <option value="date" <?=$reportSettings->sort_by === 'date' ? 'selected' : ''?>>Date</option>
                                                <option value="transaction-type" <?=$reportSettings->sort_by === 'transaction-type' ? 'selected' : ''?>>Transaction Type</option>
                                                <option value="num" <?=$reportSettings->sort_by === 'num' ? 'selected' : ''?>>Num</option>
                                                <option value="create-date" <?=$reportSettings->sort_by === 'create-date' ? 'selected' : ''?>>Create Date</option>
                                                <option value="name" <?=$reportSettings->sort_by === 'name' ? 'selected' : ''?>>Name</option>
                                                <option value="memo-desc" <?=$reportSettings->sort_by === 'memo-desc' ? 'selected' : ''?>>Memo/Description</option>
                                                <option value="account" <?=$reportSettings->sort_by === 'account' ? 'selected' : ''?>>Account</option>
                                                <option value="split" <?=$reportSettings->sort_by === 'split' ? 'selected' : ''?>>Split</option>
                                                <option value="ref-no" <?=$reportSettings->sort_by === 'ref-no' ? 'selected' : ''?>>Ref #</option>
                                                <option value="sales-rep" <?=$reportSettings->sort_by === 'sales-rep' ? 'selected' : ''?>>Sales Rep</option>
                                                <option value="po-number" <?=$reportSettings->sort_by === 'po-number' ? 'selected' : ''?>>P.O. Number</option>
                                                <option value="po-status" <?=$reportSettings->sort_by === 'po-status' ? 'selected' : ''?>>PO Status</option>
                                                <option value="payment-method" <?=$sort_by === 'payment-method' ? 'selected' : ''?>>Payment Method</option>
                                                <option value="terms" <?=$reportSettings->sort_by === 'terms' ? 'selected' : ''?>>Terms</option>
                                                <option value="due-date" <?=$reportSettings->sort_by === 'due-date' ? 'selected' : ''?>>Due Date</option>
                                                <option value="tax-amount" <?=$reportSettings->sort_by === 'tax-amount' ? 'selected' : ''?>>Tax Amount</option>
                                                <!--
                                                <option value="default" <?=empty($reportSettings->sort_by) || $reportSettings->sort_by === 'default' ? 'selected' : ''?>>Default</option>
                                                <option value="ap-paid" <?=$reportSettings->sort_by === 'ap-paid' ? 'selected' : ''?>>A/P Paid</option>
                                                <option value="ar-paid" <?=$reportSettings->sort_by === 'ar-paid' ? 'selected' : ''?>>A/R Paid</option>
                                                <option value="adj" <?=$reportSettings->sort_by === 'adj' ? 'selected' : ''?>>Adj</option>
                                                <option value="check-printed" <?=$reportSettings->sort_by === 'check-printed' ? 'selected' : ''?>>Check Printed</option>
                                                <option value="clr" <?=$reportSettings->sort_by === 'clr' ? 'selected' : ''?>>Clr</option>
                                                <option value="created-by" <?=$reportSettings->sort_by === 'created-by' ? 'selected' : ''?>>Created By</option>
                                                <option value="customer-vendor-message" <?=$reportSettings->sort_by === 'customer-vendor-message' ? 'selected' : ''?>>Customer/Vendor Message</option>
                                                <option value="invoice-date" <?=$reportSettings->sort_by === 'invoice-date' ? 'selected' : ''?>>Invoice Date</option>
                                                <option value="last-modified" <?=$reportSettings->sort_by === 'last-modified' ? 'selected' : ''?>>Last Modified</option>
                                                <option value="last-modified-by" <?=$reportSettings->sort_by === 'last-modified-by' ? 'selected' : ''?>>Last Modified By</option>
                                                <option value="online-banking" <?=$reportSettings->sort_by === 'online-banking' ? 'selected' : ''?>>Online Banking</option>
                                                <option value="paid-by-mas" <?=$reportSettings->sort_by === 'paid-by-mas' ? 'selected' : ''?>>Paid by MAS</option>
                                                <option value="posting" <?=$reportSettings->sort_by === 'posting' ? 'selected' : ''?>>Posting</option>
                                                <option value="ship-via" <?=$reportSettings->sort_by === 'ship-via' ? 'selected' : ''?>>Ship Via</option>
                                                <option value="taxable-amount" <?=$reportSettings->sort_by === 'taxable-amount' ? 'selected' : ''?>>Taxable Amount</option>
                                                -->
                                            </select>
                                            <select name="sort_order" id="sort_order" class="nsm-field form-select">
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