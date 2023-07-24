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
                        <tr>
                            <td colspan="10" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Pay Date">PAY DATE</td>
                            <td data-name="Contractor">CONTRACTOR</td>
                            <td data-name="Type" <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>>TYPE</td>
                            <td data-name="Pay Method" <?=isset($columns) && !in_array('Pay method', $columns) ? 'style="display: none"' : ''?>>PAY METHOD</td>
                            <td data-name="Check Number" <?=isset($columns) && !in_array('Check number', $columns) ? 'style="display: none"' : ''?>>CHECK NUMBER</td>
                            <td data-name="Account Name" <?=isset($columns) && !in_array('Account name', $columns) ? 'style="display: none"' : ''?>>ACCOUNT NAME</td>
                            <td data-name="Pay Status" <?=isset($columns) && !in_array('Pay status', $columns) ? 'style="display: none"' : ''?>>PAY STATUS</td>
                            <td data-name="Category" <?=isset($columns) && !in_array('Category', $columns) ? 'style="display: none"' : ''?>>CATEGORY</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                            <td data-name="Memo" <?=isset($columns) && !in_array('Memo', $columns) ? 'style="display: none"' : ''?>>MEMO</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
                        <?php foreach($transactions as $index => $transaction) : ?>
                        <tr>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['contractor']?></td>
                            <td <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['type']?></td>
                            <td <?=isset($columns) && !in_array('Pay Method', $columns) ? 'style="display: none"' : ''?>><?=$transaction['pay_method']?></td>
                            <td <?=isset($columns) && !in_array('Check Number', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_number']?></td>
                            <td <?=isset($columns) && !in_array('Account Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account_name']?></td>
                            <td <?=isset($columns) && !in_array('Pay Status', $columns) ? 'style="display: none"' : ''?>><?=$transaction['pay_status']?></td>
                            <td <?=isset($columns) && !in_array('Category', $columns) ? 'style="display: none"' : ''?>><?=$transaction['category']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                            <td <?=isset($columns) && !in_array('Memo', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="10">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10" class="text-center">
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
                        <tr>
                            <td colspan="10" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Pay Date">PAY DATE</td>
                            <td data-name="Contractor">CONTRACTOR</td>
                            <td data-name="Type" <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>>TYPE</td>
                            <td data-name="Pay Method" <?=isset($columns) && !in_array('Pay method', $columns) ? 'style="display: none"' : ''?>>PAY METHOD</td>
                            <td data-name="Check Number" <?=isset($columns) && !in_array('Check number', $columns) ? 'style="display: none"' : ''?>>CHECK NUMBER</td>
                            <td data-name="Account Name" <?=isset($columns) && !in_array('Account name', $columns) ? 'style="display: none"' : ''?>>ACCOUNT NAME</td>
                            <td data-name="Pay Status" <?=isset($columns) && !in_array('Pay status', $columns) ? 'style="display: none"' : ''?>>PAY STATUS</td>
                            <td data-name="Category" <?=isset($columns) && !in_array('Category', $columns) ? 'style="display: none"' : ''?>>CATEGORY</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                            <td data-name="Memo" <?=isset($columns) && !in_array('Memo', $columns) ? 'style="display: none"' : ''?>>MEMO</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
                        <?php foreach($transactions as $index => $transaction) : ?>
                        <tr>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['contractor']?></td>
                            <td <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['type']?></td>
                            <td <?=isset($columns) && !in_array('Pay Method', $columns) ? 'style="display: none"' : ''?>><?=$transaction['pay_method']?></td>
                            <td <?=isset($columns) && !in_array('Check Number', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_number']?></td>
                            <td <?=isset($columns) && !in_array('Account Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account_name']?></td>
                            <td <?=isset($columns) && !in_array('Pay Status', $columns) ? 'style="display: none"' : ''?>><?=$transaction['pay_status']?></td>
                            <td <?=isset($columns) && !in_array('Category', $columns) ? 'style="display: none"' : ''?>><?=$transaction['category']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                            <td <?=isset($columns) && !in_array('Memo', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="10">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10" class="text-center">
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
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-who-to-include" aria-expanded="true" aria-controls="collapse-who-to-include">
                                        Who to include
                                    </button>
                                </h2>
                                <div id="collapse-who-to-include" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-4">
                                                <label for="filter-contractor"><b>Contractor</b></label>
                                                <select name="filter_contractor" id="filter-contractor" class="nsm-field form-control">
                                                    <option value="active" <?=$filter_status === 'active' ? 'selected' : ''?>>Active contractors</option>
                                                    <option value="inactive" <?=$filter_status === 'inactive' ? 'selected' : ''?>>Inactive contractors</option>
                                                    <option value="all" <?=empty($filter_status) || $filter_status === 'all' ? 'selected' : ''?>>All contractors</option>
                                                </select>
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
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-what-to-include" aria-expanded="true" aria-controls="collapse-what-to-include">
                                        What to include
                                    </button>
                                </h2>
                                <div id="collapse-what-to-include" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <a href="#" class="text-decoration-none" id="<?=!isset($columns) ? 'unselect-all-columns' : 'select-all-columns'?>"><?=!isset($columns) ? 'Unselect' : 'Select'?> all</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-type" <?=isset($columns) && in_array('Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-type">
                                                                Type
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-pay-method" <?=isset($columns) && in_array('Pay Method', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-pay-method">
                                                                Pay Method
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-check-number" <?=isset($columns) && in_array('Check Number', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-check-number">
                                                                Check Number
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-pay-status" <?=isset($columns) && in_array('Pay Status', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-pay-status">
                                                                Pay Status
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-category" <?=isset($columns) && in_array('Category', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-category">
                                                                Category
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-account-name" <?=isset($columns) && in_array('Account Name', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-account-name">
                                                                Account Name
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-memo" <?=isset($columns) && in_array('Memo', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-memo">
                                                                Memo
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" id="run-report-button">Run report</button>
            </div>
        </div>
    </div>
</div>