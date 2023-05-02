<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Recent/Edited Time Activities List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <?php if(!isset($show_company_name)) : ?>
                        <tr>
                            <td colspan="32" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="32" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="32" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
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
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>>QTY</td>
                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>>RATE</td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                            <td data-name="Invoice Date" <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>>INVOICE DATE</td>
                            <td data-name="A/R Paid" <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>>A/R PAID</td>
                            <td data-name="A/P Paid" <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>>A/P PAID</td>
                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                            <td data-name="Debit" <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>>DEBIT</td>
                            <td data-name="Credit" <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>>CREDIT</td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>>BALANCE</td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td>
                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>>TAX NAME</td>
                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>>TAX AMOUNT</td>
                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>>TAXABLE AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($accounts) > 0) : ?>
                        <?php foreach($accounts as $index => $account) : ?>
                        <tr class="group-header">
                            <td colspan="23"><b><?=$account['name']?></b></td>
                            <td><b><?=$account['debit_total']?></b></td>
                            <td><b><?=$account['credit_total']?></b></td>
                            <td></td>
                            <td><b><?=$account['amount_total']?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b><?=$account['tax_amount_total']?></b></td>
                            <td><b><?=$account['taxable_amount_total']?></b></td>
                        </tr>
                        <tr class="starting-balance-row">
                            <td colspan="27"><b>Beginning Balance</b></td>
                            <td><b><?=$account['beginning_balance']?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php foreach($account['transactions'] as $transaction) : ?>
                        <tr>
                            <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['date']?></td>
                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['transaction_type']?></td>
                            <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$transaction['number']?></td>
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
                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo_description']?></td>
                            <td <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$transaction['qty']?></td>
                            <td <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$transaction['rate']?></td>
                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account']?></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$transaction['split']?></td>
                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['invoice_date']?></td>
                            <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ar_paid']?></td>
                            <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ap_paid']?></td>
                            <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$transaction['clr']?></td>
                            <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_printed']?></td>
                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['debit']?></td>
                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['credit']?></td>
                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['open_balance']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                            <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['balance']?></td>
                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$transaction['online_banking']?></td>
                            <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_name']?></td>
                            <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_amount']?></td>
                            <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['taxable_amount']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="group-total">
                            <td colspan="23">Total for <?=$account['name']?></td>
                            <td><b><?=$account['debit_total']?></b></td>
                            <td><b><?=$account['credit_total']?></b></td>
                            <td></td>
                            <td><b><?=$account['amount_total']?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b><?=$account['tax_amount_total']?></b></td>
                            <td><b><?=$account['taxable_amount_total']?></b></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="32">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="32" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_report">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_report_modal" tabindex="-1" aria-labelledby="print_preview_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Recent/Edited Time Activities List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="report_table_print">
                    <thead>
                        <?php if(!isset($show_company_name)) : ?>
                        <tr>
                            <td colspan="32" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="32" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="32" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
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
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>>QTY</td>
                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>>RATE</td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                            <td data-name="Invoice Date" <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>>INVOICE DATE</td>
                            <td data-name="A/R Paid" <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>>A/R PAID</td>
                            <td data-name="A/P Paid" <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>>A/P PAID</td>
                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                            <td data-name="Debit" <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>>DEBIT</td>
                            <td data-name="Credit" <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>>CREDIT</td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>>BALANCE</td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td>
                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>>TAX NAME</td>
                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>>TAX AMOUNT</td>
                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>>TAXABLE AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($accounts) > 0) : ?>
                        <?php foreach($accounts as $index => $account) : ?>
                        <tr class="group-header">
                            <td colspan="23"><b><?=$account['name']?></b></td>
                            <td><b><?=$account['debit_total']?></b></td>
                            <td><b><?=$account['credit_total']?></b></td>
                            <td></td>
                            <td><b><?=$account['amount_total']?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b><?=$account['tax_amount_total']?></b></td>
                            <td><b><?=$account['taxable_amount_total']?></b></td>
                        </tr>
                        <tr class="starting-balance-row">
                            <td colspan="27"><b>Beginning Balance</b></td>
                            <td><b><?=$account['beginning_balance']?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php foreach($account['transactions'] as $transaction) : ?>
                        <tr>
                            <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['date']?></td>
                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['transaction_type']?></td>
                            <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$transaction['number']?></td>
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
                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo_description']?></td>
                            <td <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$transaction['qty']?></td>
                            <td <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$transaction['rate']?></td>
                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account']?></td>
                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$transaction['split']?></td>
                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['invoice_date']?></td>
                            <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ar_paid']?></td>
                            <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ap_paid']?></td>
                            <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$transaction['clr']?></td>
                            <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_printed']?></td>
                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['debit']?></td>
                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['credit']?></td>
                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['open_balance']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                            <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['balance']?></td>
                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$transaction['online_banking']?></td>
                            <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_name']?></td>
                            <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_amount']?></td>
                            <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['taxable_amount']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="group-total">
                            <td colspan="23">Total for <?=$account['name']?></td>
                            <td><b><?=$account['debit_total']?></b></td>
                            <td><b><?=$account['credit_total']?></b></td>
                            <td></td>
                            <td><b><?=$account['amount_total']?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b><?=$account['tax_amount_total']?></b></td>
                            <td><b><?=$account['taxable_amount_total']?></b></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="32">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="32" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>