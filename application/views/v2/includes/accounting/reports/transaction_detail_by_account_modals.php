<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Transaction Detail by Account Report</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <?php if(!isset($show_company_name)) : ?>
                        <tr>
                            <td colspan="35" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="35" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="35" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
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
                        <tr class="group-header">
                            <td colspan="<?=isset($columns) ? $total_index : '26'?>"><b><?=$transaction['name']?></b></td>
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
                        <tr>
                            <?php if(isset($columns) && $total_index === 0) : ?>
                            <td></td>
                            <?php endif; ?>
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
                        <?php endforeach; ?>
                        <tr class="group-total">
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
                    <tfoot>
                        <tr>
                            <td colspan="35" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
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
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Transaction Detail by Account Report</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="report_table_print">
                    <thead>
                        <?php if(!isset($show_company_name)) : ?>
                        <tr>
                            <td colspan="35" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="35" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="35" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
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
                        <tr class="group-header">
                            <td colspan="<?=isset($columns) ? $total_index : '26'?>"><b><?=$transaction['name']?></b></td>
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
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td></td>
                            <?php endif; ?>
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
                        <?php endforeach; ?>
                        <tr class="group-total">
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
                    <tfoot>
                        <tr>
                            <td colspan="35" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="settings-modal" tabindex="-1" aria-labelledby="settings_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="settings_modal_label">Customize report</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-general" aria-expanded="true" aria-controls="collapse-general">
                                        General
                                    </button>
                                </h2>
                                <div id="collapse-general" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-4">
                                                <label for="report-period-date"><b>Time Activity Date</b></label>
                                                <select name="report_period_date" id="report-period-date" class="nsm-field form-control">
                                                    <option value="all-dates" <?=$filter_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                                    <option value="custom" <?=$filter_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                    <option value="today" <?=$filter_date === 'today' ? 'selected' : ''?>>Today</option>
                                                    <option value="this-week" <?=$filter_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                                    <option value="this-week-to-date" <?=$filter_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                                    <option value="this-month" <?=$filter_date === 'this-month' ? 'selected' : ''?>>This Month</option>
                                                    <option value="this-month-to-date" <?=empty($filter_date) || $filter_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                                    <option value="this-quarter" <?=$filter_date === 'this-quarter' ? 'selected' : ''?>>This Quarter</option>
                                                    <option value="this-quarter-to-date" <?=$filter_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                                    <option value="this-year" <?=$filter_date === 'this-year' ? 'selected' : ''?>>This Year</option>
                                                    <option value="this-year-to-date" <?=$filter_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                                    <option value="this-year-to-last-month" <?=$filter_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                                    <option value="yesterday" <?=$filter_date === 'yesterday' ? 'selected' : ''?>>Yesterday</option>
                                                    <option value="recent" <?=$filter_date === 'recent' ? 'selected' : ''?>>Recent</option>
                                                    <option value="last-week" <?=$filter_date === 'last-week' ? 'selected' : ''?>>Last Week</option>
                                                    <option value="last-week-to-date" <?=$filter_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                                    <option value="last-month" <?=$filter_date === 'last-month' ? 'selected' : ''?>>Last Month</option>
                                                    <option value="last-month-to-date" <?=$filter_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                                    <option value="last-quarter" <?=$filter_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                                    <option value="last-quarter-to-date" <?=$filter_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                                    <option value="last-year" <?=$filter_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                                    <option value="last-year-to-date" <?=$filter_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                                    <option value="since-30-days-ago" <?=$filter_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago" <?=$filter_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago" <?=$filter_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago" <?=$filter_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                                    <option value="next-week" <?=$filter_date === 'next-week' ? 'selected' : ''?>>Next Week</option>
                                                    <option value="next-4-weeks" <?=$filter_date === 'next-4-weeks' ? 'selected' : ''?>>Next 4 Weeks</option>
                                                    <option value="next-month" <?=$filter_date === 'next-month' ? 'selected' : ''?>>Next Month</option>
                                                    <option value="next-quarter" <?=$filter_date === 'next-quarter' ? 'selected' : ''?>>Next Quarter</option>
                                                    <option value="next-year" <?=$filter_date === 'next-year' ? 'selected' : ''?>>Next Year</option>
                                                </select>
                                            </div>
                                            <?php if($filter_date !== 'all-dates') : ?>
                                            <div class="col-12 col-md-4">
                                                <label for="from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="report-period-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$end_date?>" id="report-period-date-to">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label for="number-format"><b>Number format</b></label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="negative-numbers"><b>Negative numbers</b></label>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($divide_by_100) ? 'checked' : ''?> type="checkbox" name="number_format" value="divide-by-100" id="divide-by-100">
                                                    <label class="form-check-label" for="divide-by-100">
                                                        Divide by 100
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($without_cents) ? 'checked' : ''?> type="checkbox" name="number_format" value="without-cents" id="without-cents">
                                                    <label class="form-check-label" for="without-cents">
                                                        Without cents
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="negative_numbers" id="negative-numbers" class="nsm-field form-control">
                                                    <option value="-100" <?=empty($negative_numbers) || $negative_numbers === '-100' ? 'selected' : ''?>>-100</option>
                                                    <option value="(100)" <?=$negative_numbers === '(100)' ? 'selected' : ''?>>(100)</option>
                                                    <option value="100-" <?=$negative_numbers === '100-' ? 'selected' : ''?>>100-</option>
                                                </select>
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($show_in_red) ? 'checked' : ''?> type="checkbox" name="show_in_red" value="1" id="show-in-red">
                                                    <label class="form-check-label" for="show-in-red">
                                                        Show in red
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-rows-columns" aria-expanded="true" aria-controls="collapse-rows-columns">
                                        Rows/Columns
                                    </button>
                                </h2>
                                <div id="collapse-rows-columns" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12">
                                                <label for="custom-group-by">Group by</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <select id="custom-group-by" class="form-control nsm-field">
                                                    <option value="none" <?=$group_by === 'none' ? 'selected' : ''?>>None</option>
                                                    <option value="account" <?=empty($group_by) || $group_by === 'account' ? 'selected' : ''?>>Account</option>
                                                    <option value="transaction-type" <?=$group_by === 'transaction-type' ? 'selected' : ''?>>Transaction Type</option>
                                                    <option value="customer" <?=$group_by === 'customer' ? 'selected' : ''?>>Customer</option>
                                                    <option value="vendor" <?=$group_by === 'vendor' ? 'selected' : ''?>>Vendor</option>
                                                    <option value="employee" <?=$group_by === 'employee' ? 'selected' : ''?>>Employee</option>
                                                    <option value="product-service" <?=$group_by === 'product-service' ? 'selected' : ''?>>Product/Service</option>
                                                    <option value="sku" <?=$group_by === 'sku' ? 'selected' : ''?>>SKU</option>
                                                    <option value="payment-method" <?=$group_by === 'payment-method' ? 'selected' : ''?>>Payment Method</option>
                                                    <option value="day" <?=$group_by === 'day' ? 'selected' : ''?>>Day</option>
                                                    <option value="week" <?=$group_by === 'week' ? 'selected' : ''?>>Week</option>
                                                    <option value="month" <?=$group_by === 'month' ? 'selected' : ''?>>Month</option>
                                                    <option value="quarter" <?=$group_by === 'quarter' ? 'selected' : ''?>>Quarter</option>
                                                    <option value="year" <?=$group_by === 'year' ? 'selected' : ''?>>Year</option>
                                                </select>
                                            </div>
                                            <div class="col-12 d-none">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label for="select-columns"><b>Select columns</b></label>
                                                        <a href="#" class="float-end text-decoration-none" id="reset-columns-to-default">Reset to default</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-date" <?=isset($columns) && in_array('Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-date">
                                                                Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-transaction-type" <?=isset($columns) && in_array('Transaction Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-transaction-type">
                                                                Transaction Type
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-num" <?=isset($columns) && in_array('Num', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-num">
                                                                Num
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-adj" <?=isset($columns) && in_array('Adj', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-adj">
                                                                Adj
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-create-date" <?=isset($columns) && in_array('Create Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-create-date">
                                                                Create Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-created-by" <?=isset($columns) && in_array('Created By', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-created-by">
                                                                Created By
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-last-modified" <?=isset($columns) && in_array('Last Modified', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-last-modified">
                                                                Last Modified
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-last-modified-by" <?=isset($columns) && in_array('Last Modified By', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-last-modified-by">
                                                                Last Modified By
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-name" <?=isset($columns) && in_array('Name', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-name">
                                                                Name
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-customer" <?=isset($columns) && in_array('Customer', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-customer">
                                                                Customer
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-vendor" <?=isset($columns) && in_array('Vendor', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-vendor">
                                                                Vendor
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-employee" <?=isset($columns) && in_array('Employee', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-employee">
                                                                Employee
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-product-service" <?=isset($columns) && in_array('Product/Service', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-product-service">
                                                                Product/Service
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-sku" <?=isset($columns) && in_array('SKU', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-sku">
                                                                SKU
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-memo-description" <?=isset($columns) && in_array('Memo/Description', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-memo-description">
                                                                Memo/Description
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-qty" <?=isset($columns) && in_array('Qty', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-qty">
                                                                Qty
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-rate" <?=isset($columns) && in_array('Rate', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-rate">
                                                                Rate
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-account" <?=isset($columns) && in_array('Account', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-account">
                                                                Account
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-split" <?=isset($columns) && in_array('Split', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-split">
                                                                Split
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-payment-method" <?=isset($columns) && in_array('Payment Method', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-payment-method">
                                                                Payment Method
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-ar-paid" <?=isset($columns) && in_array('A/R Paid', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-ar-paid">
                                                                A/R Paid
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-ap-paid" <?=isset($columns) && in_array('A/P Paid', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-ap-paid">
                                                                A/P Paid
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-due-date" <?=isset($columns) && in_array('Terms', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-due-date">
                                                                Due Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-clr" <?=isset($columns) && in_array('Clr', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-clr">
                                                                Clr
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-check-printed" <?=isset($columns) && in_array('Check Printed', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-check-printed">
                                                                Check Printed
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-open-balance" <?=isset($columns) && in_array('Open Balance', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-open-balance">
                                                                Open Balance
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-amount" <?=isset($columns) && in_array('Amount', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-amount">
                                                                Amount
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-balance" <?=isset($columns) && in_array('Balance', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-balance">
                                                                Balance
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-taxable" <?=isset($columns) && in_array('Taxable', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-taxable">
                                                                Taxable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-debit" <?=isset($columns) && in_array('Debit', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-debit">
                                                                Debit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-credit" <?=isset($columns) && in_array('Credit', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-credit">
                                                                Credit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-online-banking" <?=isset($columns) && in_array('Online Banking', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-online-banking">
                                                                Online Banking
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-tax-name" <?=isset($columns) && in_array('Tax Name', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-tax-name">
                                                                Tax Name
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-tax-amount" <?=isset($columns) && in_array('Tax Amount', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-tax-amount">
                                                                Tax Amount
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-taxable-amount" <?=isset($columns) && in_array('Taxable Amount', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-taxable-amount">
                                                                Taxable Amount
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a href="#" class="text-decoration-none" id="change-columns">Change columns</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-filter" aria-expanded="false" aria-controls="collapse-filter">
                                        Filter
                                    </button>
                                </h2>
                                <div id="collapse-filter" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="row grid-mb g-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_transaction_type) ? 'checked' : '' ?> name="allow_filter_transaction_type" value="1" id="allow-filter-transaction-type">
                                                    <label class="form-check-label" for="allow-filter-transaction-type">
                                                        Transaction Type
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_transaction_type" id="filter-transaction-type" class="nsm-field form-control">
                                                    <option value="all" <?=!isset($filter_transaction_type) || $filter_transaction_type === 'all' ? 'selected' : '' ?>>All</option>
                                                    <option value="posting" <?=$filter_transaction_type === 'posting' ? 'selected' : '' ?>>Posting</option>
                                                    <option value="non-posting" <?=$filter_transaction_type === 'non-posting' ? 'selected' : '' ?>>Non-Posting</option>
                                                    <option value="credit-card-expense" <?=$filter_transaction_type === 'credit-card-expense' ? 'selected' : '' ?>?>Credit Card Expense</option>
                                                    <option value="check" <?=$filter_transaction_type === 'check' ? 'selected' : '' ?>>Check</option>
                                                    <option value="invoice" <?=$filter_transaction_type === 'invoice' ? 'selected' : '' ?>>Invoice</option>
                                                    <option value="payment" <?=$filter_transaction_type === 'payment' ? 'selected' : '' ?>>Payment</option>
                                                    <option value="journal-entry" <?=$filter_transaction_type === 'journal-entry' ? 'selected' : '' ?>>Journal Entry</option>
                                                    <option value="bill" <?=$filter_transaction_type === 'bill' ? 'selected' : '' ?>>Bill</option>
                                                    <option value="credit-card-credit" <?=$filter_transaction_type === 'credit-card-credit' ? 'selected' : '' ?>>Credit Card Credit</option>
                                                    <option value="vendor-credit" <?=$filter_transaction_type === 'vendor-credit' ? 'selected' : '' ?>>Vendor Credit</option>
                                                    <option value="credit" <?=$filter_transaction_type === 'credit' ? 'selected' : '' ?>>Credit</option>
                                                    <option value="bill-payment-check" <?=$filter_transaction_type === 'bill-payment-check' ? 'selected' : '' ?>>Bill Payment (Check)</option>
                                                    <option value="bill-payment-credit-card" <?=$filter_transaction_type === 'bill-payment-credit-card' ? 'selected' : '' ?>>Bill Payment (Credit Card)</option>
                                                    <option value="paycheck" <?=$filter_transaction_type === 'paycheck' ? 'selected' : '' ?>>Paycheck</option>
                                                    <option value="charge" <?=$filter_transaction_type === 'charge' ? 'selected' : '' ?>>Charge</option>
                                                    <option value="transfer" <?=$filter_transaction_type === 'transfer' ? 'selected' : '' ?>>Transfer</option>
                                                    <option value="deposit" <?=$filter_transaction_type === 'deposit' ? 'selected' : '' ?>>Deposit</option>
                                                    <option value="statement" <?=$filter_transaction_type === 'statement' ? 'selected' : '' ?>>Statement</option>
                                                    <option value="billable-expense-charge" <?=$filter_transaction_type === 'billable-expense-charge' ? 'selected' : '' ?>>Billable Expense Charge</option>
                                                    <option value="time-charge" <?=$filter_transaction_type === 'time-charge' ? 'selected' : '' ?>>Time Charge</option>
                                                    <option value="cash-expense" <?=$filter_transaction_type === 'cash-expense' ? 'selected' : '' ?>>Cash Expense</option>
                                                    <option value="sales-receipt" <?=$filter_transaction_type === 'sales-receipt' ? 'selected' : '' ?>>Sales Receipt</option>
                                                    <option value="credit-memo" <?=$filter_transaction_type === 'credit-memo' ? 'selected' : '' ?>>Credit Memo</option>
                                                    <option value="refund" <?=$filter_transaction_type === 'refund' ? 'selected' : '' ?>>Refund</option>
                                                    <option value="estimate" <?=$filter_transaction_type === 'estimate' ? 'selected' : '' ?>>Estimate</option>
                                                    <option value="obsolete-payroll-adjustment" <?=$filter_transaction_type === 'obsolete-payroll-adjustment' ? 'selected' : '' ?>>Obsolete Payroll Adjustment</option>
                                                    <option value="liability-payment-check" <?=$filter_transaction_type === 'liability-payment-check' ? 'selected' : '' ?>>Liability Payment (Check)</option>
                                                    <option value="liability-payment-credit-card" <?=$filter_transaction_type === 'liability-payment-credit-card' ? 'selected' : '' ?>>Liability Payment (Credit Card)</option>
                                                    <option value="payroll-ytd" <?=$filter_transaction_type === 'payroll-ytd' ? 'selected' : '' ?>>Payroll YTD</option>
                                                    <option value="liability-refund" <?=$filter_transaction_type === 'liability-refund' ? 'selected' : '' ?>>Liability Refund</option>
                                                    <option value="prior-liability-payments" <?=$filter_transaction_type === 'prior-liability-payments' ? 'selected' : '' ?>>Prior Liability Payments</option>
                                                    <option value="direct-deposit-withdrawal" <?=$filter_transaction_type === 'direct-deposit-withdrawal' ? 'selected' : '' ?>>Direct Deposit Withdrawal</option>
                                                    <option value="liability-payment-epay" <?=$filter_transaction_type === 'liability-payment-epay' ? 'selected' : '' ?>>Liability Payment (E-pay)</option>
                                                    <option value="liability-payment-marked-paid" <?=$filter_transaction_type === 'liability-payment-marked-paid' ? 'selected' : '' ?>>Liability Payment (Marked Paid)</option>
                                                    <option value="inventory-qty-adjust" <?=$filter_transaction_type === 'inventory-qty-adjust' ? 'selected' : '' ?>>Inventory Qty Adjust</option>
                                                    <option value="purchase-order" <?=$filter_transaction_type === 'purchase-order' ? 'selected' : '' ?>>Purchase Order</option>
                                                    <option value="payroll-check" <?=$filter_transaction_type === 'payroll-check' ? 'selected' : '' ?>>Payroll Check</option>
                                                    <option value="tax-payment" <?=$filter_transaction_type === 'tax-payment' ? 'selected' : '' ?>>Tax Payment</option>
                                                    <option value="payroll-adjustment" <?=$filter_transaction_type === 'payroll-adjustment' ? 'selected' : '' ?>>Payroll Adjustment</option>
                                                    <option value="payroll-refund" <?=$filter_transaction_type === 'payroll-refund' ? 'selected' : '' ?>>Payroll Refund</option>
                                                    <option value="sales-tax-payment" <?=$filter_transaction_type === 'sales-tax-payment' ? 'selected' : '' ?>>Sales Tax Payment</option>
                                                    <option value="sales-tax-adjustment" <?=$filter_transaction_type === 'sales-tax-adjustment' ? 'selected' : '' ?>>Sales Tax Adjustment</option>
                                                    <option value="job" <?=$filter_transaction_type === 'job' ? 'selected' : '' ?>>Job</option>
                                                    <option value="expense" <?=$filter_transaction_type === 'expense' ? 'selected' : '' ?>>Expense</option>
                                                    <option value="service-tax-partial-utilisation" <?=$filter_transaction_type === 'service-tax-partial-utilisation' ? 'selected' : '' ?>>Service Tax Partial Utilisation</option>
                                                    <option value="service-tax-defer" <?=$filter_transaction_type === 'service-tax-defer' ? 'selected' : '' ?>>Service Tax Defer</option>
                                                    <option value="service-tax-reversal" <?=$filter_transaction_type === 'service-tax-reversal' ? 'selected' : '' ?>>Service Tax Reversal</option>
                                                    <option value="service-tax-refund" <?=$filter_transaction_type === 'service-tax-refund' ? 'selected' : '' ?>>Service Tax Refund</option>
                                                    <option value="service-tax-gross-adjustment" <?=$filter_transaction_type === 'service-tax-gross-adjustment' ? 'selected' : '' ?>>Service Tax Gross Adjustment</option>
                                                    <option value="reverse-charge" <?=$filter_transaction_type === 'reverse-charge' ? 'selected' : '' ?>>Reverse Charge</option>
                                                    <option value="inventory-starting-value-from-desktop" <?=$filter_transaction_type === 'inventory-starting-value-from-desktop' ? 'selected' : '' ?>>Inventory Starting Value from Desktop</option>
                                                    <option value="inventory-starting-value" <?=$filter_transaction_type === 'inventory-starting-value' ? 'selected' : '' ?>>Inventory Starting Value</option>
                                                    <option value="credit-card-payment" <?=$filter_transaction_type === 'credit-card-payment' ? 'selected' : '' ?>>Credit Card Payment</option>
                                                    <option value="revenue-recognition" <?=$filter_transaction_type === 'revenue-recognition' ? 'selected' : '' ?>>Revenue Recognition</option>
                                                    <option value="employee-non-reimbursable-expense" <?=$filter_transaction_type === 'employee-non-reimbursable-expense' ? 'selected' : '' ?>>Employee Non-Reimbursable Expense</option>
                                                    <option value="employee-reimbursement" <?=$filter_transaction_type === 'employee-reimbursement' ? 'selected' : '' ?>>Employee Reimbursement</option>
                                                    <option value="employee-reimbursable-expense" <?=$filter_transaction_type === 'employee-reimbursable-expense' ? 'selected' : '' ?>>Employee Reimbursable Expense</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_distribution_account) ? 'checked' : '' ?> name="allow_filter_distribution_account" value="1" id="allow-filter-distribution-account">
                                                    <label class="form-check-label" for="allow-filter-distribution-account">
                                                        Distribution Account
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_distribution_account" id="filter-distribution-account" class="nsm-field form-control">
                                                    <?php if(isset($filter_distribution_account)) : ?>
                                                    <option value="<?=$filter_distribution_account->id?>" selected><?=$filter_distribution_account->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_account) ? 'checked' : '' ?> name="allow_filter_account" value="1" id="allow-filter-account">
                                                    <label class="form-check-label" for="allow-filter-account">
                                                        Account
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_account" id="filter-account" class="nsm-field form-control">
                                                    <?php if(isset($filter_account)) : ?>
                                                    <option value="<?=$filter_account->id?>" selected><?=$filter_account->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_name) ? 'checked' : '' ?> name="allow_filter_name" value="1" id="allow-filter-name">
                                                    <label class="form-check-label" for="allow-filter-name">
                                                        Name
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_name" id="filter-name" class="nsm-field form-control">
                                                    <?php if(isset($filter_name)) : ?>
                                                    <option value="<?=$filter_name->id?>" selected><?=$filter_name->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_customer) ? 'checked' : '' ?> name="allow_filter_customer" value="1" id="allow-filter-customer">
                                                    <label class="form-check-label" for="allow-filter-customer">
                                                        Customer
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_customer" id="filter-customer" class="nsm-field form-control">
                                                    <?php if(isset($filter_customer)) : ?>
                                                    <option value="<?=$filter_customer->id?>" selected><?=$filter_customer->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_vendor) ? 'checked' : '' ?> name="allow_filter_vendor" value="1" id="allow-filter-vendor">
                                                    <label class="form-check-label" for="allow-filter-vendor">
                                                        Vendor
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_vendor" id="filter-vendor" class="nsm-field form-control">
                                                    <?php if(isset($filter_vendor)) : ?>
                                                    <option value="<?=$filter_vendor->id?>" selected><?=$filter_vendor->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($employee) ? 'checked' : '' ?> type="checkbox" name="allow_filter_employee" value="1" id="allow-filter-employee">
                                                    <label class="form-check-label" for="allow-filter-employee">
                                                        Employee
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_employee" id="filter-employee" class="nsm-field form-control">
                                                    <?php if(isset($employee)) : ?>
                                                    <option value="<?=$employee->id?>" selected><?=$employee->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_payment_method) ? 'checked' : '' ?> name="allow_filter_payment_method" value="1" id="allow-filter-payment-method">
                                                    <label class="form-check-label" for="allow-filter-payment-method">
                                                        Payment Method
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_payment_method" id="filter-payment-method" class="nsm-field form-control">
                                                    <?php if(isset($filter_payment_method)) : ?>
                                                    <option value="<?=$filter_payment_method->id?>" selected><?=$filter_payment_method->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_terms) ? 'checked' : '' ?> name="filter_terms" value="1" id="allow-filter-terms">
                                                    <label class="form-check-label" for="allow-filter-terms">
                                                        Terms
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_terms" id="filter-terms" class="nsm-field form-control">
                                                    <?php if(isset($filter_terms)) : ?>
                                                    <option value="<?=$filter_terms->id?>" selected><?=$filter_terms->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($product_service) ? 'checked' : '' ?> type="checkbox" name="allow_filter_product_service" value="1" id="allow-filter-product-service">
                                                    <label class="form-check-label" for="allow-filter-product-service">
                                                        Product/Service
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_product_service" id="filter-product-service" class="nsm-field form-control">
                                                    <?php if(isset($product_service)) : ?>
                                                    <option value="<?=$product_service->id?>" selected><?=$product_service->name?></option>
                                                    <?php else : ?>
                                                    <option value="all" selected>All</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($due_date) ? 'checked' : '' ?> type="checkbox" name="allow_filter_due_date" value="1" id="allow-filter-due-date">
                                                    <label class="form-check-label" for="allow-filter-due-date">
                                                        Due Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_due_date" id="filter-due-date" class="nsm-field form-control">
                                                    <option value="all-dates" <?=empty($due_date) || $due_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                                    <option value="custom" <?=$due_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                    <option value="today" <?=$due_date === 'today' ? 'selected' : ''?>>Today</option>
                                                    <option value="this-week" <?=$due_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                                    <option value="this-week-to-date" <?=$due_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                                    <option value="this-month" <?=$due_date === 'custom' ? 'this-month' : ''?>>This Month</option>
                                                    <option value="this-month-to-date" <?=$due_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                                    <option value="this-quarter" <?=$due_date === 'custom' ? 'this-quarter' : ''?>>This Quarter</option>
                                                    <option value="this-quarter-to-date" <?=$due_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                                    <option value="this-year" <?=$due_date === 'custom' ? 'this-year' : ''?>>This Year</option>
                                                    <option value="this-year-to-date" <?=$due_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                                    <option value="this-year-to-last-month" <?=$due_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                                    <option value="yesterday" <?=$due_date === 'custom' ? 'yesterday' : ''?>>Yesterday</option>
                                                    <option value="recent" <?=$due_date === 'custom' ? 'recent' : ''?>>Recent</option>
                                                    <option value="last-week" <?=$due_date === 'custom' ? 'last-week' : ''?>>Last Week</option>
                                                    <option value="last-week-to-date" <?=$due_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                                    <option value="last-month" <?=$due_date === 'custom' ? 'last-month' : ''?>>Last Month</option>
                                                    <option value="last-month-to-date" <?=$due_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                                    <option value="last-quarter" <?=$due_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                                    <option value="last-quarter-to-date" <?=$due_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                                    <option value="last-year" <?=$due_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                                    <option value="last-year-to-date" <?=$due_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                                    <option value="since-30-days-ago" <?=$due_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago" <?=$due_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago" <?=$due_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago" <?=$due_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <?php if(!empty($due_date) && $due_date !== 'all-dates') : ?>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-due-date-from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$due_date_from?>" id="filter-due-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-due-date-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$due_date_to?>" id="filter-due-date-to">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($create_date) ? 'checked' : '' ?> type="checkbox" name="allow_filter_create_date" value="1" id="allow-filter-create-date">
                                                    <label class="form-check-label" for="allow-filter-create-date">
                                                        Create Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_create_date" id="filter-create-date" class="nsm-field form-control">
                                                    <option value="all-dates" <?=empty($create_date) || $create_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                                    <option value="custom" <?=$create_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                    <option value="today" <?=$create_date === 'today' ? 'selected' : ''?>>Today</option>
                                                    <option value="this-week" <?=$create_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                                    <option value="this-week-to-date" <?=$create_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                                    <option value="this-month" <?=$create_date === 'custom' ? 'this-month' : ''?>>This Month</option>
                                                    <option value="this-month-to-date" <?=$create_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                                    <option value="this-quarter" <?=$create_date === 'custom' ? 'this-quarter' : ''?>>This Quarter</option>
                                                    <option value="this-quarter-to-date" <?=$create_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                                    <option value="this-year" <?=$create_date === 'custom' ? 'this-year' : ''?>>This Year</option>
                                                    <option value="this-year-to-date" <?=$create_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                                    <option value="this-year-to-last-month" <?=$create_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                                    <option value="yesterday" <?=$create_date === 'custom' ? 'yesterday' : ''?>>Yesterday</option>
                                                    <option value="recent" <?=$create_date === 'custom' ? 'recent' : ''?>>Recent</option>
                                                    <option value="last-week" <?=$create_date === 'custom' ? 'last-week' : ''?>>Last Week</option>
                                                    <option value="last-week-to-date" <?=$create_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                                    <option value="last-month" <?=$create_date === 'custom' ? 'last-month' : ''?>>Last Month</option>
                                                    <option value="last-month-to-date" <?=$create_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                                    <option value="last-quarter" <?=$create_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                                    <option value="last-quarter-to-date" <?=$create_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                                    <option value="last-year" <?=$create_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                                    <option value="last-year-to-date" <?=$create_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                                    <option value="since-30-days-ago" <?=$create_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago" <?=$create_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago" <?=$create_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago" <?=$create_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <?php if(!empty($create_date) && $create_date !== 'all-dates') : ?>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-create-date-from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$create_date_from?>" id="filter-create-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-create-date-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$create_date_to?>" id="filter-create-date-to">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($last_modified_date) ? 'checked' : '' ?> type="checkbox" name="allow_filter_last_modified_date" value="1" id="allow-filter-last-modified-date">
                                                    <label class="form-check-label" for="allow-filter-last-modified-date">
                                                        Last Modified Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_last_modified_date" id="filter-last-modified-date" class="nsm-field form-control">
                                                    <option value="all-dates" <?=empty($last_modified_date) || $last_modified_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                                    <option value="custom" <?=$last_modified_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                    <option value="today" <?=$last_modified_date === 'today' ? 'selected' : ''?>>Today</option>
                                                    <option value="this-week" <?=$last_modified_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                                    <option value="this-week-to-date" <?=$last_modified_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                                    <option value="this-month" <?=$last_modified_date === 'custom' ? 'this-month' : ''?>>This Month</option>
                                                    <option value="this-month-to-date" <?=$last_modified_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                                    <option value="this-quarter" <?=$last_modified_date === 'custom' ? 'this-quarter' : ''?>>This Quarter</option>
                                                    <option value="this-quarter-to-date" <?=$last_modified_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                                    <option value="this-year" <?=$last_modified_date === 'custom' ? 'this-year' : ''?>>This Year</option>
                                                    <option value="this-year-to-date" <?=$last_modified_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                                    <option value="this-year-to-last-month" <?=$last_modified_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                                    <option value="yesterday" <?=$last_modified_date === 'custom' ? 'yesterday' : ''?>>Yesterday</option>
                                                    <option value="recent" <?=$last_modified_date === 'custom' ? 'recent' : ''?>>Recent</option>
                                                    <option value="last-week" <?=$last_modified_date === 'custom' ? 'last-week' : ''?>>Last Week</option>
                                                    <option value="last-week-to-date" <?=$last_modified_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                                    <option value="last-month" <?=$last_modified_date === 'custom' ? 'last-month' : ''?>>Last Month</option>
                                                    <option value="last-month-to-date" <?=$last_modified_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                                    <option value="last-quarter" <?=$last_modified_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                                    <option value="last-quarter-to-date" <?=$last_modified_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                                    <option value="last-year" <?=$last_modified_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                                    <option value="last-year-to-date" <?=$last_modified_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                                    <option value="since-30-days-ago" <?=$last_modified_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago" <?=$last_modified_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago" <?=$last_modified_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago" <?=$last_modified_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <?php if(!empty($last_modified_date) && $last_modified_date !== 'all-dates') : ?>
                                            <div class="col-12 col-md-6">
                                                <label for="last-modified-from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=empty($last_modified_date) || $last_modified_date === 'since-30-days-ago' ? date("m/d/Y", strtotime("-30 days")) : $last_modified_date_from?>" id="filter-last-modified-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="last-modified-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$last_modified_date === 'all-dates' ? '' : $last_modified_date_to?>" id="filter-last-modified-date-to">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($cleared) ? 'checked' : '' ?> type="checkbox" name="allow_filter_cleared" value="1" id="allow-filter-cleared">
                                                    <label class="form-check-label" for="allow-filter-cleared">
                                                        Cleared
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_cleared" id="filter-cleared" class="nsm-field form-control">
                                                    <option value="all" <?=empty($cleared) || $cleared === 'all' ? 'selected' : ''?>>All</option>
                                                    <option value="yes" <?=$cleared === 'yes' ? 'selected' : ''?>>Cleared</option>
                                                    <option value="no" <?=$cleared === 'no' ? 'selected' : ''?>>Uncleared</option>
                                                    <option value="reconciled" <?=$cleared === 'reconciled' ? 'selected' : ''?>>Reconciled</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_ar_paid) ? 'checked' : '' ?> type="checkbox" name="allow_filter_ar_paid" value="1" id="allow-filter-ar-paid">
                                                    <label class="form-check-label" for="allow-filter-ar-paid">
                                                        A/R Paid
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_ar_paid" id="filter-ar-paid" class="nsm-field form-control">
                                                    <option value="all" <?=empty($filter_ar_paid) || $filter_ar_paid === 'all' ? 'selected' : ''?>>All</option>
                                                    <option value="yes" <?=$filter_ar_paid === 'yes' ? 'selected' : ''?>>Paid</option>
                                                    <option value="no" <?=$filter_ar_paid === 'no' ? 'selected' : ''?>>Unpaid</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_ap_paid) ? 'checked' : '' ?> type="checkbox" name="allow_filter_ap_paid" value="1" id="allow-filter-ap-paid">
                                                    <label class="form-check-label" for="allow-filter-ap-paid">
                                                        A/P Paid
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_ap_paid" id="filter-ap-paid" class="nsm-field form-control">
                                                    <option value="all" <?=empty($filter_ap_paid) || $filter_ap_paid === 'all' ? 'selected' : ''?>>All</option>
                                                    <option value="yes" <?=$filter_ap_paid === 'yes' ? 'selected' : ''?>>Paid</option>
                                                    <option value="no" <?=$filter_ap_paid === 'no' ? 'selected' : ''?>>Unpaid</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_check_printed) ? 'checked' : '' ?> type="checkbox" name="allow_filter_check_printed" value="1" id="allow-filter-check-printed">
                                                    <label class="form-check-label" for="allow-filter-check-printed">
                                                        Check Printed
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_check_printed" id="filter-check-printed" class="nsm-field form-control">
                                                    <option value="all" <?=empty($filter_check_printed) || $filter_check_printed === 'all' ? 'selected' : ''?>>All</option>
                                                    <option value="yes" <?=$filter_check_printed === 'yes' ? 'selected' : ''?>>Printed</option>
                                                    <option value="no" <?=$filter_check_printed === 'no' ? 'selected' : ''?>>To be printed</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_amount) ? 'checked' : '' ?> type="checkbox" name="allow_filter_amount" value="1" id="allow-filter-amount">
                                                    <label class="form-check-label" for="allow-filter-amount">
                                                        Amount
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_amount) ? $filter_amount : ''?>" name="filter_amount" id="filter-amount">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_memo) ? 'checked' : '' ?> type="checkbox" name="allow_filter_memo" value="1" id="allow-filter-memo">
                                                    <label class="form-check-label" for="allow-filter-memo">
                                                        Memo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_memo) ? $filter_memo : ''?>" name="filter_memo" id="filter-memo">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_num) ? 'checked' : '' ?> type="checkbox" name="allow_filter_num" value="1" id="allow-filter-num">
                                                    <label class="form-check-label" for="allow-filter-num">
                                                        Num
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_num) ? $filter_num : ''?>" name="filter_num" id="filter-num">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_ship_via) ? 'checked' : '' ?> type="checkbox" name="allow_filter_ship_via" value="1" id="allow-filter-ship-via">
                                                    <label class="form-check-label" for="allow-filter-ship-via">
                                                        Ship Via
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_ship_via) ? $filter_ship_via : ''?>" name="filter_ship_via" id="filter-ship-via">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_po_number) ? 'checked' : '' ?> type="checkbox" name="allow_filter_po_number" value="1" id="allow-filter-po-number">
                                                    <label class="form-check-label" for="allow-filter-po-number">
                                                        P.O. Number
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_po_number) ? $filter_po_number : ''?>" name="filter_po_number" id="filter-po-number">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($filter_sales_rep) ? 'checked' : '' ?> type="checkbox" name="allow_filter_sales_rep" value="1" id="allow-filter-sales-rep">
                                                    <label class="form-check-label" for="allow-filter-sales-rep">
                                                        Sales Rep
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_sales_rep) ? $filter_sales_rep : ''?>" name="filter_sales_rep" id="filter-sales-rep">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-header-footer" aria-expanded="true" aria-controls="collapse-header-footer">
                                        Header/Footer
                                    </button>
                                </h2>
                                <div id="collapse-header-footer" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="Header"><b>Header</b></label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($show_logo) ? 'checked' : '' ?> type="checkbox" name="show_logo" value="1" id="show-logo">
                                                    <label class="form-check-label" for="show-logo">
                                                        Show logo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6"></div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_company_name) ? 'checked' : ''?> type="checkbox" name="show_company_name" value="1" id="show-company-name">
                                                    <label class="form-check-label" for="show-company-name">
                                                        Company name
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="company_name" id="company-name" class="nsm-field form-control" value="<?=$company_name?>">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_report_title) ? 'checked' : ''?> type="checkbox" name="show_report_title" value="1" id="show-report-title">
                                                    <label class="form-check-label" for="show-report-title">
                                                        Report title
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="report_title" id="report-title" class="nsm-field form-control" value="<?=$report_title?>">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_report_period) ? 'checked' : ''?> type="checkbox" name="show_report_period" value="1" id="show-report-period">
                                                    <label class="form-check-label" for="show-report-period">
                                                        Report period
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6"></div>
                                            <div class="col-12">
                                                <label for="footer"><b>Footer</b></label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_date_prepared) ? 'checked' : ''?> type="checkbox" name="show_date_prepared" value="1" id="show-date-prepared">
                                                    <label class="form-check-label" for="show-date-prepared">
                                                        Date prepared
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=!isset($show_time_prepared) ? 'checked' : ''?> type="checkbox" name="show_time_prepared" value="1" id="show-time-prepared">
                                                    <label class="form-check-label" for="show-time-prepared">
                                                        Time prepared
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="alignment"><b>Alignment</b></label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label for="header-alignment">Header</label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <select name="header_alignment" id="header-alignment" class="nsm-field form-control">
                                                    <option value="left" <?=$header_alignment === 'start' ? 'selected' : ''?>>Left</option>
                                                    <option value="center" <?=empty($header_alignment) || $header_alignment === 'center' ? 'selected' : ''?>>Center</option>
                                                    <option value="right" <?=$header_alignment === 'end' ? 'selected' : ''?>>Right</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-3">
                                                <label for="footer-alignment">Footer</label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <select name="footer_alignment" id="footer-alignment" class="nsm-field form-control">
                                                    <option value="left" <?=$footer_alignment === 'start' ? 'selected' : ''?>>Left</option>
                                                    <option value="center" <?=empty($footer_alignment) || $footer_alignment === 'center' ? 'selected' : ''?>>Center</option>
                                                    <option value="right" <?=$footer_alignment === 'end' ? 'selected' : ''?>>Right</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" id="run-report-button">Run report</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="email_report_modal" tabindex="-1" aria-labelledby="email_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="email_report_modal_label">Email Transaction Detail by Account Report</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <form id="send-email-form">
                <div class="row">
                    <div class="col-12">
                        <label for="email-to">To</label>
                        <input type="email" class="nsm-field form-control mb-3" value="" id="email-to" name="email_to" required>
                    </div>
                    <div class="col-12">
                        <label for="email-cc">CC</label>
                        <input type="email" class="nsm-field form-control mb-3" value="" id="email-cc" name="email_cc">
                    </div>
                    <div class="col-12">
                        <label for="email-subject">Subject</label>
                        <input type="text" class="nsm-field form-control mb-3" value="Your <?=$report_title?> Report" id="email-subject" name="email_subject" required>
                    </div>
                    <div class="col-12">
                        <label for="email-body">Body</label>
                        <textarea name="email_body" id="email-body" style="min-height: 140px" maxlength="4000" class="nsm-field form-control mb-3" required>Hello

Attached is the <?=$report_title?> report for <?=$company_name?>. 

Regards
<?=$this->page_data['users']->FName.' '.$this->page_data['users']->LName?></textarea>
                    </div>
                    <div class="col-12">
                        <label for="email-file-name">Report file name</label>
                        <input type="text" class="nsm-field form-control" value="<?=$report_title?> Report" id="email-file-name" name="email_file_name" required>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_send_report">Send</button>
            </div>
        </div>
    </div>
</div>