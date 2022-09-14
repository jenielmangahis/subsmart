<div class="modal fade nsm-modal" id="print_expenses_modal" tabindex="-1" aria-labelledby="print_expenses_modal_label" aria-hidden="true">
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

<div class="modal fade nsm-modal" id="print_preview_expenses_modal" tabindex="-1" aria-labelledby="print_preview_expenses_modal_label" aria-hidden="true">
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

<!-- attach file modal -->
<div class="modal fade nsm-modal" id="attach_file_modal" tabindex="-1" aria-labelledby="attach_file_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered m-auto" role="document" style="max-width: 40%">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="attach_file_modal_label">Attachments</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form id="attach-file-form" method="post">
            <div class="modal-body" style="max-height: 800px;">
                <div class="row">
                    <div class="col-12 grid-mb border-bottom">
                        <div class="attachments grid-mb">
                            <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                            <span>Maximum size: 20MB</span>
                            <div id="transaction-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                <div class="dz-message" style="margin: 20px;border">
                                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                    <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <h5>Attach existing</h5>
                        <div class="grid-mb w-50">
                            <select id="attachments-filter" class="form-control">
                                <option value="unlinked" selected>Unlinked</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row attachments-container">
                    <?php foreach($unlinked_attachments as $attachment) : ?>
                        <div class="col-12 col-md-3">
                            <div class="card">
                                <img class="card-img-top m-0" src="/uploads/accounting/attachments/<?=$attachment['stored_name']?>" alt="<?=$attachment['uploaded_name'].'.'.$attachment['file_extension']?>">
                                <div class="card-body">
                                    <h6 class="card-title"><?=$attachment['uploaded_name'].'.'.$attachment['file_extension']?></h6>
                                    <p class="card-subtitle mb-2 text-muted"><?=date("m/d/Y", strtotime($attachment['created_at']))?></p>
                                    <ul class="d-flex justify-content-around list-unstyled">
                                        <li><a href="#" class="text-decoration-none attach-to-transaction" data-id="<?=$attachment['id']?>">Add</a></li>
                                        <li><a href="/uploads/accounting/attachments/<?=$attachment['stored_name']?>" target="_blank" class="text-decoration-none">Preview</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end attach file modal -->