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
                                        $tableID = "transactiondetailbyaccount_table"; 
                                        $reportCategory = "transaction_detail_by_account"; 
                                    ?>
                                    <table id="<?php echo $tableID; ?>" class="nsm-table w-100 border-0">
                                        <thead>
                                            <tr>
                                                <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                                    <th data-name=""></th>
                                                <?php endif; ?>
                                                <th>DATE</th>
                                                <th>TRANS TYPE</th>
                                                <th>NUM</th>
                                                <th>CREATE DATE</th>
                                                <th>NAME</th>
                                                <th>CUST.</th>
                                                <th>VENDOR</th>
                                                <th>MEMO/DESC</th>
                                                <th>ACCT</th>
                                                <th>SPLIT</th>
                                                <th>LAST MOD.</th>
                                                <th>CHECK PRINT</th>
                                                <th>AMOUNT</th>
                                                <th>BALANCE</th>
                                                <th>TAXABLE</th>
                                                <th>DEBIT</th>
                                                <th>CREDIT</th>                                                
                                                <th>ONLINE BANKING</th>
                                                <th>TAX NAME</th>
                                                <th>TAX AMOUNT</th>
                                                <th>TAXABLE AMOUNT</th>

                                                <!--
                                                <th>ADJ</th>
                                                <th>CREATED BY</th>
                                                <th>LAST MODIFIED BY</th>
                                                <th>EMPLOYEE</th>
                                                <th>PRODUCT/SERVICE</th>
                                                <th>SKU</th>
                                                <th>QTY</th>
                                                <th>RATE</th>
                                                <th>PAYMENT METHOD</th>
                                                <th>A/R PAID</th>
                                                <th>A/P PAID</th>
                                                <th>DUE DATE</th>
                                                <th>CLR</th>
                                                <th>OPEN BALANCE</th>
                                                -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="22">
                                                    <center>
                                                        <div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- 
                                    <table class="nsm-table grid-mb" id="reports-table">
                                        <thead>
                                            <tr>
                                                <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                                <td data-name=""></td>
                                                <?php endif; ?>
                                                <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                                                <td data-name="Transaction Type" <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>>TRANSACTION TYPE</td>
                                                <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td>
                                                <td data-name="Adj" <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>>ADJ</td>
                                                <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                                <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                                <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                                <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                                <td data-name="Name" <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>>NAME</td>
                                                <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                                                <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>>VENDOR</td>
                                                <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>>EMPLOYEE</td>
                                                <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                                                <td data-name="SKU" <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>>SKU</td>
                                                <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                                <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>>QTY</td>
                                                <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>>RATE</td>
                                                <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                                                <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                                                <td data-name="Payment Method" <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>>PAYMENT METHOD</td>
                                                <td data-name="A/R Paid" <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>>A/R PAID</td>
                                                <td data-name="A/P Paid" <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>>A/P PAID</td>
                                                <td data-name="Due Date" <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>>DUE DATE</td>
                                                <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                                                <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                                                <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                                                <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                                                <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>>BALANCE</td>
                                                <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>>TAXABLE</td>
                                                <td data-name="Debit" <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>>DEBIT</td>
                                                <td data-name="Credit" <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>>CREDIT</td>
                                                <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td>
                                                <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>>TAX NAME</td>
                                                <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>>TAX AMOUNT</td>
                                                <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>>TAXABLE AMOUNT</td>
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
                                                <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>><?=$transaction['adj']?></td>
                                                <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['create_date']?></td>
                                                <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['created_by']?></td>
                                                <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified']?></td>
                                                <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified_by']?></td>
                                                <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['name']?></td>
                                                <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$transaction['customer']?></td>
                                                <td <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$transaction['vendor']?></td>
                                                <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$transaction['employee']?></td>
                                                <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$transaction['product_service']?></td>
                                                <td <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>><?=$transaction['sku']?></td>
                                                <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo_desc']?></td>
                                                <td <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$transaction['qty']?></td>
                                                <td <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$transaction['rate']?></td>
                                                <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account']?></td>
                                                <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$transaction['split']?></td>
                                                <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$transaction['payment_method']?></td>
                                                <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ar_paid']?></td>
                                                <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ap_paid']?></td>
                                                <td <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['due_date']?></td>
                                                <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$transaction['clr']?></td>
                                                <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_printed']?></td>
                                                <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['open_balance']?></td>
                                                <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                                                <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['balance']?></td>
                                                <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$transaction['taxable']?></td>
                                                <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['debit']?></td>
                                                <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['credit']?></td>
                                                <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$transaction['online_banking']?></td>
                                                <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_name']?></td>
                                                <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_amount']?></td>
                                                <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['taxable_amount']?></td>
                                            </tr>
                                            <?php else : ?>
                                            <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                                <td colspan="<?=isset($columns) ? $total_index : '26'?>"><i class="bx bx-fw bx-caret-right"></i> <b><?=$transaction['name']?></b></td>
                                                <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['amount_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['debit_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['credit_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>></td>
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
                                                <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>><?=$tran['adj']?></td>
                                                <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$tran['create_date']?></td>
                                                <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$tran['created_by']?></td>
                                                <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$tran['last_modified']?></td>
                                                <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$tran['last_modified_by']?></td>
                                                <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$tran['name']?></td>
                                                <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$tran['customer']?></td>
                                                <td <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$tran['vendor']?></td>
                                                <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$tran['employee']?></td>
                                                <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$tran['product_service']?></td>
                                                <td <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>><?=$tran['sku']?></td>
                                                <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$tran['memo_desc']?></td>
                                                <td <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$tran['qty']?></td>
                                                <td <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$tran['rate']?></td>
                                                <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$tran['account']?></td>
                                                <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$tran['split']?></td>
                                                <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$tran['payment_method']?></td>
                                                <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$tran['ar_paid']?></td>
                                                <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$tran['ap_paid']?></td>
                                                <td <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>><?=$tran['due_date']?></td>
                                                <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$tran['clr']?></td>
                                                <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$tran['check_printed']?></td>
                                                <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$tran['open_balance']?></td>
                                                <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$tran['amount']?></td>
                                                <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$tran['balance']?></td>
                                                <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$tran['taxable']?></td>
                                                <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$tran['debit']?></td>
                                                <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$tran['credit']?></td>
                                                <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$tran['online_banking']?></td>
                                                <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$tran['tax_name']?></td>
                                                <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$tran['tax_amount']?></td>
                                                <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$tran['taxable_amount']?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr class="clickable collapse-row collapse group-total" id="accordion-<?=$index?>">
                                                <td colspan="<?=isset($columns) ? $total_index : '26'?>"><b>Total for <?=$transaction['name']?></b></td>
                                                <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['amount_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['debit_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['credit_total']?></b></td>
                                                <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>></td>
                                                <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>></td>
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
                                    -->                                   
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
                                <!--
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
                                -->
                                <!--
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
                                -->
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