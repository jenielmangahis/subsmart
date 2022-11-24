<div class="modal fade nsm-modal" id="print_transactions_modal" tabindex="-1" aria-labelledby="print_transactions_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_transactions_modal_label">Print Transactions By Tag List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="From/To">FROM/TO</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Amount">AMOUNT</td>
                            <td data-name="Tags">TAGS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($transactions) > 0) : ?>
                        <?php foreach($transactions as $transaction) : ?>
                        <tr>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['from_to']?></td>
                            <td><?=$transaction['category']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['type']?></td>
                            <td>
                                <?php 
                                    $amount = '$'.number_format(floatval($transaction['amount']), 2);
                                    echo str_replace('$-', '-$', $amount);
                                ?>
                            </td>
                            <td>
                                <?php foreach($transaction['tags'] as $index => $tag) : ?>
                                <span class="nsm-badge"><?=$tag->name?></span>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
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
                <button type="button" class="nsm-button primary" id="btn_print_transactions">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_transactions_modal" tabindex="-1" aria-labelledby="print_preview_transactions_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_transactions_modal_label">Print Transactions List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="transactions_table_print">
                    <thead>
                        <tr>
                            <td data-name="Date">DATE</td>
                            <td data-name="From/To">FROM/TO</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Amount">AMOUNT</td>
                            <td data-name="Tags">TAGS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($transactions) > 0) : ?>
                        <?php foreach($transactions as $transaction) : ?>
                        <tr>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['from_to']?></td>
                            <td><?=$transaction['category']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['type']?></td>
                            <td>
                                <?php 
                                    $amount = '$'.number_format(floatval($transaction['amount']), 2);
                                    echo str_replace('$-', '-$', $amount);
                                ?>
                            </td>
                            <td>
                                <?php foreach($transaction['tags'] as $index => $tag) : ?>
                                <span class="nsm-badge"><?=$tag->name?></span>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
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

<div class="modal fade nsm-modal" id="add-tags-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add tags</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <span class="selected-transaction-count">0</span> transaction selected
                    </div>
                    <div class="col-12">
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-select nsm-field" multiple="multiple"></select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="apply-add-tags">Apply</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="remove-tags-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Remove tags</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <span class="selected-transaction-count">0</span> transaction selected
                    </div>
                    <div class="col-12">
                        <div class="nsm-field-group search mw-100">
                            <input type="text" class="nsm-field form-control" value="" id="search-tags-to-remove">
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="nsm-table" id="remove-tags-table">
                            <thead>
                                <tr>
                                    <td colspan="2">TAGS TO REMOVE</td>
                                    <td class="text-end"><span>0 selected</span></td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="remove-tags-button" disabled>Remove</button>
            </div>
        </div>
    </div>
</div>