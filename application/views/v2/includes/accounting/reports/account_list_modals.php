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
                            <td colspan="19" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="19" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                            <td data-name="Type" <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>>TYPE</td>
                            <td data-name="Detail Type" <?=isset($columns) && !in_array('Detail Type', $columns) ? 'style="display: none"' : ''?>>DETAIL TYPE</td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                            <td data-name="Description" <?=isset($columns) && !in_array('Description', $columns) ? 'style="display: none"' : ''?>>DESCRIPTION</td>
                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>>BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($accounts) > 0) : ?>
                        <?php foreach($accounts as $account) : ?>
                        <tr>
                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$account['name']?></td>
                            <td <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>><?=$account['type']?></td>
                            <td <?=isset($columns) && !in_array('Detail Type', $columns) ? 'style="display: none"' : ''?>><?=$account['detail_type']?></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$account['create_date']?></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$account['created_by']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$account['last_modified']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$account['last_modified_by']?></td>
                            <td <?=isset($columns) && !in_array('Description', $columns) ? 'style="display: none"' : ''?>><?=$account['description']?></td>
                            <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$account['balance']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="19">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <?php if(!is_null($reportNote) && !empty($reportNote->notes)) : ?>
                        <tr>
                            <td colspan="19">
                                <p class="m-0"><b>Note</b></p>
                                <span><?=str_replace("\n", "<br />", $reportNote->notes)?></span>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="19" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
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
                            <td colspan="19" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!isset($show_report_title)) : ?>
                        <tr>
                            <td colspan="19" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                            <td data-name="Type" <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>>TYPE</td>
                            <td data-name="Detail Type" <?=isset($columns) && !in_array('Detail Type', $columns) ? 'style="display: none"' : ''?>>DETAIL TYPE</td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                            <td data-name="Description" <?=isset($columns) && !in_array('Description', $columns) ? 'style="display: none"' : ''?>>DESCRIPTION</td>
                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>>BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($accounts) > 0) : ?>
                        <?php foreach($accounts as $account) : ?>
                        <tr>
                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$account['name']?></td>
                            <td <?=isset($columns) && !in_array('Type', $columns) ? 'style="display: none"' : ''?>><?=$account['type']?></td>
                            <td <?=isset($columns) && !in_array('Detail Type', $columns) ? 'style="display: none"' : ''?>><?=$account['detail_type']?></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$account['create_date']?></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$account['created_by']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$account['last_modified']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$account['last_modified_by']?></td>
                            <td <?=isset($columns) && !in_array('Description', $columns) ? 'style="display: none"' : ''?>><?=$account['description']?></td>
                            <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$account['balance']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="19">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <?php if(!is_null($reportNote) && !empty($reportNote->notes)) : ?>
                        <tr>
                            <td colspan="19">
                                <p class="m-0"><b>Note</b></p>
                                <span><?=str_replace("\n", "<br />", $reportNote->notes)?></span>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="19" class="<?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
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
                                            <div class="col-12 d-none">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label for="select-columns"><b>Select columns</b></label>
                                                        <a href="#" class="float-end text-decoration-none" id="reset-columns-to-default">Reset to default</a>
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-type" <?=isset($columns) && in_array('Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-type">
                                                                Type
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-detail-type" <?=isset($columns) && in_array('Detail Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-detail-type">
                                                                Detail Type
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-description" <?=isset($columns) && in_array('Description', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-description">
                                                                Description
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
                                                    <input class="form-check-input" <?=isset($deleted) ? 'checked' : '' ?> type="checkbox" name="allow_filter_deleted" value="1" id="allow-filter-deleted">
                                                    <label class="form-check-label" for="allow-filter-deleted">
                                                        Deleted
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_deleted" id="filter-deleted" class="nsm-field form-control">
                                                    <option value="all" <?=$deleted === 'all' ? 'selected' : ''?>>All</option>
                                                    <option value="yes" <?=$deleted === 'yes' ? 'selected' : ''?>>Deleted</option>
                                                    <option value="no" <?=empty($deleted) || $deleted === 'no' ? 'selected' : ''?>>Not Deleted</option>
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
                <span class="modal-title content-title" id="email_report_modal_label">Email Account List Report</span>
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