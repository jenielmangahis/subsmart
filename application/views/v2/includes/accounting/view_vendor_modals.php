<div class="modal fade nsm-modal" id="print_vendor_transactions_modal" tabindex="-1" aria-labelledby="print_vendor_transactions_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_vendor_transactions_modal_label">Print Vendor Transactions List</span>
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
                            <td data-name="Due date">DUE DATE</td>
                            <td data-name="Balance">BALANCE</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Status">STATUS</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($transactions) > 0) : ?>
                        <?php foreach($transactions as $transaction) : ?>
                        <tr>
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
                <button type="button" class="nsm-button primary" id="btn_print_vendor_transactions">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_vendor_transactions_modal" tabindex="-1" aria-labelledby="print_preview_vendor_transactions_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_vendor_transactions_modal_label">Print vendors List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="vendor_transactions_table_print">
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
                            <td data-name="Due date">DUE DATE</td>
                            <td data-name="Balance">BALANCE</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Status">STATUS</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($transactions) > 0) : ?>
                        <?php foreach($transactions as $transaction) : ?>
                        <tr>
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

<!-- Select category modal -->
<div class="modal fade nsm-modal" id="select_category_modal" tabindex="-1" aria-labelledby="select_category_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="select_category_modal_label">Categorize Selected</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="categorize-selected-form">
                <div class="modal-body" style="max-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <select name="category_id" id="category-id" class="form-control nsm-field" required></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-sm-6">
                            <button type="button" class="nsm-button m-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="nsm-button success float-end m-0">Apply</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end select category modal -->