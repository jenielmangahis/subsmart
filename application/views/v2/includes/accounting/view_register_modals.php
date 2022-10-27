<div class="modal fade nsm-modal" id="print_registers_modal" tabindex="-1" aria-labelledby="print_registers_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_registers_modal_label">Print Accounts List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="Ref No.">REF NO.</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Payee">PAYEE</td>
                            <td data-name="Account">ACCOUNT</td>
                            <td data-name="Memo">MEMO</td>
                            <?php switch($type) {
                                case 'Asset' :
                                    $var1 = 'DECREASE';
                                    $var2 = 'INCREASE';
                                break;
                                case 'Liability' :
                                    $var1 = 'INCREASE';
                                    $var2 = 'DECREASE';
                                break;
                                case 'Credit Card' :
                                    $var1 = 'CHARGE';
                                    $var2 = 'PAYMENT';
                                break;
                                default :
                                    $var1 = 'PAYMENT';
                                    $var2 = 'DEPOSIT';
                                break;
                            } ?>
                            <td data-name="<?=ucfirst(strtolower($var1))?>"><?=$var1?></td>
                            <td data-name="<?=ucfirst(strtolower($var2))?>"><?=$var2?></td>
                            <td data-name="Reconcile Status" class="table-icon text-center">
                                STATUS
                            </td>
                            <td data-name="Banking Status" class="table-icon text-center">
                                AUTO
                            </td>
                            <td class="table-icon text-center" data-name="Attachments">
                                ATTACHMENTS
                            </td>
                            <td data-name="Tax">TAX</td>
                        </tr>
                        <?php else : ?>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="Ref No.">REF NO.</td>
                            <td data-name="<?=$type === 'A/R' ? 'Customer' : 'Vendor'?>"><?=$type === 'A/R' ? 'CUSTOMER' : 'VENDOR'?></td>
                            <?php if($type === 'A/R') : ?>
                            <td data-name="Memo">MEMO</td>
                            <?php endif; ?>
                            <td data-name="Due Date">DUE DATE</td>
                            <td data-name="<?=$type === 'A/R' ? 'Charge/Credit' : 'Billed'?>"><?=$type === 'A/R' ? 'CHARGE/CREDIT' : 'BILLED'?></td>
                            <td data-name="<?=$type === 'A/R' ? 'Payment' : 'Paid'?>"><?=$type === 'A/R' ? 'PAYMENT' : 'PAID'?></td>
                        </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($registers) > 0) : ?>
                        <?php foreach($registers as $register) : ?>
                        <tr>
                            <td><?=$register['date']?></td>
                            <td><?=$register['ref_no']?></td>
                            <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                            <td><?=$register['type']?></td>
                            <td><?=$register['payee']?></td>
                            <td><?=$register['account']?></td>
                            <?php else : ?>
                            <td><?=$type === 'A/R' ? $register['customer'] : $register['vendor']?></td>
                            <?php endif;?>
                            <?php if($type !== 'A/P') : ?>
                            <td><?=$register['memo']?></td>
                            <?php endif; ?>
                            <?php switch($type) {
                                case 'Asset' : ?>
                                <td><?=$register['decrease']?></td>
                                <td><?=$register['increase']?></td>
                                <?php break;
                                case 'Liability' : ?>
                                <td><?=$register['increase']?></td>
                                <td><?=$register['decrease']?></td>
                                <?php break;
                                case 'Credit Card' : ?>
                                <td><?=$register['charge']?></td>
                                <td><?=$register['payment']?></td>
                                <?php break;
                                case 'A/R' : ?>
                                <td><?=$register['charge_credit']?></td>
                                <td><?=$register['payment']?></td>
                                <?php break;
                                case 'A/P' : ?>
                                <td><?=$register['billed']?></td>
                                <td><?=$register['paid']?></td>
                                <?php break;
                                default : ?>
                                <td><?=$register['payment']?></td>
                                <td><?=$register['deposit']?></td>
                                <?php break;
                            } ?>
                            <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                            <td><?=$register['reconcile_status']?></td>
                            <td><?=$register['banking_status']?></td>
                            <td><?=$register['attachments']?></td>
                            <td><?=$register['tax']?></td>
                            <?php else : ?>
                            <td><?=$register['due_date']?></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="13">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_registers">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_registers_modal" tabindex="-1" aria-labelledby="print_preview_registers_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_registers_modal_label">Print Accounts List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="registers_table_print">
                    <thead>
                        <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="Ref No.">REF NO.</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Payee">PAYEE</td>
                            <td data-name="Account">ACCOUNT</td>
                            <td data-name="Memo">MEMO</td>
                            <?php switch($type) {
                                case 'Asset' :
                                    $var1 = 'DECREASE';
                                    $var2 = 'INCREASE';
                                break;
                                case 'Liability' :
                                    $var1 = 'INCREASE';
                                    $var2 = 'DECREASE';
                                break;
                                case 'Credit Card' :
                                    $var1 = 'CHARGE';
                                    $var2 = 'PAYMENT';
                                break;
                                default :
                                    $var1 = 'PAYMENT';
                                    $var2 = 'DEPOSIT';
                                break;
                            } ?>
                            <td data-name="<?=ucfirst(strtolower($var1))?>"><?=$var1?></td>
                            <td data-name="<?=ucfirst(strtolower($var2))?>"><?=$var2?></td>
                            <td data-name="Reconcile Status" class="table-icon text-center">
                                STATUS
                            </td>
                            <td data-name="Banking Status" class="table-icon text-center">
                                AUTO
                            </td>
                            <td class="table-icon text-center" data-name="Attachments">
                                ATTACHMENTS
                            </td>
                            <td data-name="Tax">TAX</td>
                        </tr>
                        <?php else : ?>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="Ref No.">REF NO.</td>
                            <td data-name="<?=$type === 'A/R' ? 'Customer' : 'Vendor'?>"><?=$type === 'A/R' ? 'CUSTOMER' : 'VENDOR'?></td>
                            <?php if($type === 'A/R') : ?>
                            <td data-name="Memo">MEMO</td>
                            <?php endif; ?>
                            <td data-name="Due Date">DUE DATE</td>
                            <td data-name="<?=$type === 'A/R' ? 'Charge/Credit' : 'Billed'?>"><?=$type === 'A/R' ? 'CHARGE/CREDIT' : 'BILLED'?></td>
                            <td data-name="<?=$type === 'A/R' ? 'Payment' : 'Paid'?>"><?=$type === 'A/R' ? 'PAYMENT' : 'PAID'?></td>
                        </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php if(count($registers) > 0) : ?>
                        <?php foreach($registers as $register) : ?>
                        <tr>
                            <td><?=$register['date']?></td>
                            <td><?=$register['ref_no']?></td>
                            <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                            <td><?=$register['type']?></td>
                            <td><?=$register['payee']?></td>
                            <td><?=$register['account']?></td>
                            <?php else : ?>
                            <td><?=$type === 'A/R' ? $register['customer'] : $register['vendor']?></td>
                            <?php endif;?>
                            <?php if($type !== 'A/P') : ?>
                            <td><?=$register['memo']?></td>
                            <?php endif; ?>
                            <?php switch($type) {
                                case 'Asset' : ?>
                                <td><?=$register['decrease']?></td>
                                <td><?=$register['increase']?></td>
                                <?php break;
                                case 'Liability' : ?>
                                <td><?=$register['increase']?></td>
                                <td><?=$register['decrease']?></td>
                                <?php break;
                                case 'Credit Card' : ?>
                                <td><?=$register['charge']?></td>
                                <td><?=$register['payment']?></td>
                                <?php break;
                                case 'A/R' : ?>
                                <td><?=$register['charge_credit']?></td>
                                <td><?=$register['payment']?></td>
                                <?php break;
                                case 'A/P' : ?>
                                <td><?=$register['billed']?></td>
                                <td><?=$register['paid']?></td>
                                <?php break;
                                default : ?>
                                <td><?=$register['payment']?></td>
                                <td><?=$register['deposit']?></td>
                                <?php break;
                            } ?>
                            <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                            <td><?=$register['reconcile_status']?></td>
                            <td><?=$register['banking_status']?></td>
                            <td><?=$register['attachments']?></td>
                            <td><?=$register['tax']?></td>
                            <?php else : ?>
                            <td><?=$register['due_date']?></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="13">
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
    </div>
</div>