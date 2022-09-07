<div class="modal fade nsm-modal fade" id="print_expenses_modal" tabindex="-1" aria-labelledby="print_expenses_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_expenses_modal_label">Print Expenses List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Payee">PAYEE</td>
                            <td data-name="Method">METHOD</td>
                            <td data-name="Source">SOURCE</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Due Date">DUE DATE</td>
                            <td data-name="Balance">BALANCE</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Status">STATUS</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($transactions)) :
                        ?>
                            <?php foreach($transactions as $transaction): ?>
                            <tr data-type="<?=$transaction['type']?>">
                                <td><?=$transaction['date']?></td>
                                <td><?=$transaction['type']?></td>
                                <td><?=$transaction['number']?></td>
                                <td><?=$transaction['payee']?></td>
                                <td><?=$transaction['method']?></td>
                                <td><?=$transaction['source']?></td>
                                <td>
                                    <?php if($transaction['category'] !== '-Split-' && $transaction['category'] !== '') : ?>
                                    <?=$transaction['category']['name']?>
                                    <?php else : ?>
                                    <?=$transaction['category']?>
                                    <?php endif; ?>
                                </td>
                                <td><?=$transaction['memo']?></td>
                                <td><?=$transaction['due_date']?></td>
                                <td><?=$transaction['balance']?></td>
                                <td><?=$transaction['total']?></td>
                                <td><?=$transaction['status']?></td>
                                <td><?=count($transaction['attachments'])?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_expenses">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="print_preview_expenses_modal" tabindex="-1" aria-labelledby="print_preview_expenses_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_expenses_modal_label">Print Expenses List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="expenses_table_print">
                    <thead>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Payee">PAYEE</td>
                            <td data-name="Method">METHOD</td>
                            <td data-name="Source">SOURCE</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Due Date">DUE DATE</td>
                            <td data-name="Balance">BALANCE</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Status">STATUS</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($transactions)) :
                        ?>
                            <?php foreach($transactions as $transaction): ?>
                            <tr data-type="<?=$transaction['type']?>">
                                <td><?=$transaction['date']?></td>
                                <td><?=$transaction['type']?></td>
                                <td><?=$transaction['number']?></td>
                                <td><?=$transaction['payee']?></td>
                                <td><?=$transaction['method']?></td>
                                <td><?=$transaction['source']?></td>
                                <td>
                                    <?php if($transaction['category'] !== '-Split-' && $transaction['category'] !== '') : ?>
                                    <?=$transaction['category']['name']?>
                                    <?php else : ?>
                                    <?=$transaction['category']?>
                                    <?php endif; ?>
                                </td>
                                <td><?=$transaction['memo']?></td>
                                <td><?=$transaction['due_date']?></td>
                                <td><?=$transaction['balance']?></td>
                                <td><?=$transaction['total']?></td>
                                <td><?=$transaction['status']?></td>
                                <td><?=count($transaction['attachments'])?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>