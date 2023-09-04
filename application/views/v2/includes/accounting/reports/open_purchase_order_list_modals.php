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
                            <td colspan="20" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="20" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="20" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td data-name=""></td>
                            <?php endif; ?>
                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>>VENDOR</td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                            <td data-name="PO Status" <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>>PO STATUS</td>
                            <td data-name="Ship Via" <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>>SHIP VIA</td>
                            <td data-name="Customer/Vendor Message" <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>>CUSTOMER/VENDOR MESSAGE</td>
                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                            <td data-name="Sent" <?=isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''?>>SENT</td>
                            <td data-name="Delivery Address" <?=isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''?>>DELIVERY ADDRESS</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($purchaseOrders) > 0) : ?>
                        <?php foreach($purchaseOrders as $index => $purchaseOrder) : ?>
                        <?php if($group_by === 'none') : ?>
                        <tr>
                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['date']?></td>
                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['num']?></td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['create_date']?></td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['created_by']?></td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['last_modified']?></td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['last_modified_by']?></td>
                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['vendor']?></td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['memo_description']?></td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['account']?></td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['split']?></td>
                            <td data-name="PO Status" <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['po_status']?></td>
                            <td data-name="Ship Via" <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['ship_via']?></td>
                            <td data-name="Customer/Vendor Message" <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['customer_vendor_message']?></td>
                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['clr']?></td>
                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['check_printed']?></td>
                            <td data-name="Sent" <?=isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['sent']?></td>
                            <td data-name="Delivery Address" <?=isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['delivery_address']?></td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['amount']?></td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['online_banking']?></td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['open_balance']?></td>
                        </tr>
                        <?php else : ?>
                        <tr class="group-header">
                            <td colspan="<?=isset($columns) ? $total_index : '17'?>"><b><?=$purchaseOrder['name']?></b></td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['amount_total']?></b></td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) || $columns[0] === 'Online Banking' ? 'style="display: none"' : ''?>><b></b></td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) || $columns[0] === 'Open Balance' ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['open_balance_total']?></b></td>
                        </tr>
                        <?php foreach($purchaseOrder['purchase_orders'] as $po) : ?>
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td data-name=""></td>
                            <?php endif; ?>
                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$po['date']?></td>
                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$po['num']?></td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$po['create_date']?></td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$po['created_by']?></td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$po['last_modified']?></td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$po['last_modified_by']?></td>
                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$po['vendor']?></td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$po['memo_description']?></td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$po['account']?></td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$po['split']?></td>
                            <td data-name="PO Status" <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>><?=$po['po_status']?></td>
                            <td data-name="Ship Via" <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>><?=$po['ship_via']?></td>
                            <td data-name="Customer/Vendor Message" <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$po['customer_vendor_message']?></td>
                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$po['clr']?></td>
                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$po['check_printed']?></td>
                            <td data-name="Sent" <?=isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''?>><?=$po['sent']?></td>
                            <td data-name="Delivery Address" <?=isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''?>><?=$po['delivery_address']?></td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$po['amount']?></td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$po['online_banking']?></td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$po['open_balance']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="group-total">
                            <td colspan="<?=isset($columns) ? $total_index : '17'?>"><b>Total for <?=$purchaseOrder['name']?></b></td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['amount_total']?></b></td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) || $columns[0] === 'Online Banking' ? 'style="display: none"' : ''?>><b></b></td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) || $columns[0] === 'Open Balance' ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['open_balance_total']?></b></td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="20">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
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
                            <td colspan="20" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="20" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="20" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td data-name=""></td>
                            <?php endif; ?>
                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>>VENDOR</td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                            <td data-name="PO Status" <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>>PO STATUS</td>
                            <td data-name="Ship Via" <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>>SHIP VIA</td>
                            <td data-name="Customer/Vendor Message" <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>>CUSTOMER/VENDOR MESSAGE</td>
                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                            <td data-name="Sent" <?=isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''?>>SENT</td>
                            <td data-name="Delivery Address" <?=isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''?>>DELIVERY ADDRESS</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($purchaseOrders) > 0) : ?>
                        <?php foreach($purchaseOrders as $index => $purchaseOrder) : ?>
                        <?php if($group_by === 'none') : ?>
                        <tr>
                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['date']?></td>
                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['num']?></td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['create_date']?></td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['created_by']?></td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['last_modified']?></td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['last_modified_by']?></td>
                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['vendor']?></td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['memo_description']?></td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['account']?></td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['split']?></td>
                            <td data-name="PO Status" <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['po_status']?></td>
                            <td data-name="Ship Via" <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['ship_via']?></td>
                            <td data-name="Customer/Vendor Message" <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['customer_vendor_message']?></td>
                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['clr']?></td>
                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['check_printed']?></td>
                            <td data-name="Sent" <?=isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['sent']?></td>
                            <td data-name="Delivery Address" <?=isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['delivery_address']?></td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['amount']?></td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['online_banking']?></td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['open_balance']?></td>
                        </tr>
                        <?php else : ?>
                        <tr class="group-header">
                            <td colspan="<?=isset($columns) ? $total_index : '17'?>"><b><?=$purchaseOrder['name']?></b></td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['amount_total']?></b></td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) || $columns[0] === 'Online Banking' ? 'style="display: none"' : ''?>><b></b></td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) || $columns[0] === 'Open Balance' ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['open_balance_total']?></b></td>
                        </tr>
                        <?php foreach($purchaseOrder['purchase_orders'] as $po) : ?>
                        <tr>
                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                            <td data-name=""></td>
                            <?php endif; ?>
                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$po['date']?></td>
                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$po['num']?></td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$po['create_date']?></td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$po['created_by']?></td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$po['last_modified']?></td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$po['last_modified_by']?></td>
                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$po['vendor']?></td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$po['memo_description']?></td>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$po['account']?></td>
                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$po['split']?></td>
                            <td data-name="PO Status" <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>><?=$po['po_status']?></td>
                            <td data-name="Ship Via" <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>><?=$po['ship_via']?></td>
                            <td data-name="Customer/Vendor Message" <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$po['customer_vendor_message']?></td>
                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$po['clr']?></td>
                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$po['check_printed']?></td>
                            <td data-name="Sent" <?=isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''?>><?=$po['sent']?></td>
                            <td data-name="Delivery Address" <?=isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''?>><?=$po['delivery_address']?></td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$po['amount']?></td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$po['online_banking']?></td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$po['open_balance']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="group-total">
                            <td colspan="<?=isset($columns) ? $total_index : '17'?>"><b>Total for <?=$purchaseOrder['name']?></b></td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['amount_total']?></b></td>
                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) || $columns[0] === 'Online Banking' ? 'style="display: none"' : ''?>><b></b></td>
                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) || $columns[0] === 'Open Balance' ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['open_balance_total']?></b></td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="20">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
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
                                                <label for="report-period-date"><b>Report period</b></label>
                                                <select name="report_period_date" id="report-period-date" class="nsm-field form-control">
                                                    <option value="all-dates" <?=empty($filter_date) || $filter_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                                    <option value="custom" <?=$filter_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                                    <option value="today" <?=$filter_date === 'today' ? 'selected' : ''?>>Today</option>
                                                    <option value="this-week" <?=$filter_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                                    <option value="this-week-to-date" <?=$filter_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                                    <option value="this-month" <?=$filter_date === 'this-month' ? 'selected' : ''?>>This Month</option>
                                                    <option value="this-month-to-date" <?=$filter_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
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
                                            <?php if(!empty($filter_date)) : ?>
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
                                                    <option value="account" <?=$group_by === 'account' ? 'selected' : ''?>>Account</option>
                                                    <option value="name" <?=$group_by === 'name' ? 'selected' : ''?>>Name</option>
                                                    <option value="vendor" <?=empty($group_by) || $group_by === 'vendor' ? 'selected' : ''?>>Vendor</option>
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-num" <?=isset($columns) && in_array('Num', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-num">
                                                                Num
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-create-date" <?=isset($columns) && in_array('Created Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-create-date">
                                                                Created Date
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-vendor" <?=isset($columns) && in_array('Vendor', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-vendor">
                                                                Vendor
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-po-status" <?=isset($columns) && in_array('PO Status', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-po-status">
                                                                PO Status
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-ship-via" <?=isset($columns) && in_array('Ship Via', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-ship-via">
                                                                Ship Via
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-customer-vendor-message" <?=isset($columns) && in_array('Customer/Vendor Message', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-customer-vendor-message">
                                                                Customer/Vendor Message
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-sent" <?=isset($columns) && in_array('Sent', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-sent">
                                                                Sent
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-delivery-address" <?=isset($columns) && in_array('Delivery Address', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-delivery-address">
                                                                Delivery Address
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-online-banking" <?=isset($columns) && in_array('Online Banking', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-online-banking">
                                                                Online Banking
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
                                                    <option value="specified" selected>Specified</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
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
                                                    <input class="form-check-input" <?=isset($filter_ship_via) ? 'checked' : '' ?> type="checkbox" name="allow_filter_ship_via" value="1" id="allow-filter-ship-via">
                                                    <label class="form-check-label" for="allow-filter-ship-via">
                                                        Ship Via
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($filter_ship_via) ? $filter_ship_via : ''?>" name="filter_ship_via" id="filter-ship-via">
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
                <span class="modal-title content-title" id="email_report_modal_label">Email Open Purchase Order List Report</span>
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