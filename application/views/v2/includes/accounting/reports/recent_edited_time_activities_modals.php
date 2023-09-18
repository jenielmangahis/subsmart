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
                        <?php if(isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="19" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0">Created/Edited: Since <?=date("F j, Y")?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td data-name="Activity Date" <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>>ACTIVITY DATE</td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                            <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>>EMPLOYEE</td>
                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                            <td data-name="Rates" <?=isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''?>>RATES</td>
                            <td data-name="Duration" <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>>DURATION</td>
                            <td data-name="Start Time" <?=isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''?>>START TIME</td>
                            <td data-name="End Time" <?=isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''?>>END TIME</td>
                            <td data-name="Break" <?=isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''?>>BREAK</td>
                            <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>>TAXABLE</td>
                            <td data-name="Billable" <?=isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''?>>BILLABLE</td>
                            <td data-name="Invoice Date" <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>>INVOICE DATE</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($activities) > 0) : ?>
                        <?php foreach($activities as $activity) : ?>
                        <tr>
                            <td <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>><?=$activity['activity_date']?></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($activity['create_date']))?></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$activity['created_by']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($activity['last_modified']))?></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$activity['last_modified_by']?></td>
                            <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$activity['customer']?></td>
                            <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$activity['employee']?></td>
                            <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$activity['product_service']?></td>
                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$activity['memo_desc']?></td>
                            <td <?=isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''?>><?=$activity['rates']?></td>
                            <td <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><?=$activity['duration']?></td>
                            <td <?=isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''?>><?=$activity['start_time']?></td>
                            <td <?=isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''?>><?=$activity['end_time']?></td>
                            <td <?=isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''?>><?=$activity['break']?></td>
                            <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$activity['taxable']?></td>
                            <td <?=isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''?>><?=$activity['billable']?></td>
                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$activity['invoice_date']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$activity['amount']?></td>
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
                        <?php if(isset($show_report_period)) : ?>
                        <tr>
                            <td colspan="19" class="<?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                <p class="m-0">Created/Edited: Since <?=date("F j, Y")?></p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td data-name="Activity Date" <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>>ACTIVITY DATE</td>
                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                            <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>>EMPLOYEE</td>
                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                            <td data-name="Rates" <?=isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''?>>RATES</td>
                            <td data-name="Duration" <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>>DURATION</td>
                            <td data-name="Start Time" <?=isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''?>>START TIME</td>
                            <td data-name="End Time" <?=isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''?>>END TIME</td>
                            <td data-name="Break" <?=isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''?>>BREAK</td>
                            <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>>TAXABLE</td>
                            <td data-name="Billable" <?=isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''?>>BILLABLE</td>
                            <td data-name="Invoice Date" <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>>INVOICE DATE</td>
                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($activities) > 0) : ?>
                        <?php foreach($activities as $activity) : ?>
                        <tr>
                            <td <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>><?=$activity['activity_date']?></td>
                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($activity['create_date']))?></td>
                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$activity['created_by']?></td>
                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($activity['last_modified']))?></td>
                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$activity['last_modified_by']?></td>
                            <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$activity['customer']?></td>
                            <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$activity['employee']?></td>
                            <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$activity['product_service']?></td>
                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$activity['memo_desc']?></td>
                            <td <?=isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''?>><?=$activity['rates']?></td>
                            <td <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><?=$activity['duration']?></td>
                            <td <?=isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''?>><?=$activity['start_time']?></td>
                            <td <?=isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''?>><?=$activity['end_time']?></td>
                            <td <?=isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''?>><?=$activity['break']?></td>
                            <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$activity['taxable']?></td>
                            <td <?=isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''?>><?=$activity['billable']?></td>
                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$activity['invoice_date']?></td>
                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$activity['amount']?></td>
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
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-4">
                                                <label for="time-activity-date"><b>Time Activity Date</b></label>
                                                <select name="time_activity_date" id="time-activity-date" class="nsm-field form-control">
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
                                            <?php if(!empty($filter_date) && $filter_date !== 'all-dates') : ?>
                                            <div class="col-12 col-md-4">
                                                <label for="from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="time-activity-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$end_date?>" id="time-activity-date-to">
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
                                                <label for="limit"><b>Limit</b></label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="number" name="limit" id="limit" class="nsm-field form-control" value="<?=isset($limit) ? $limit : '25'?>">
                                            </div>
                                            <div class="col-12 d-none">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label for="select-columns"><b>Select columns</b></label>
                                                        <a href="#" class="float-end text-decoration-none" id="reset-columns-to-default">Reset to default</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-activity-date" <?=isset($columns) && in_array('Activity Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-activity-date">
                                                                Activity Date
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-customer" <?=isset($columns) && in_array('Customer', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-customer">
                                                                Customer
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-memo-description" <?=isset($columns) && in_array('Memo/Description', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-memo-description">
                                                                Memo/Description
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-rates" <?=isset($columns) && in_array('Rates', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-rates">
                                                                Rates
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-duration" <?=isset($columns) && in_array('Duration', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-duration">
                                                                Duration
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-start-time" <?=isset($columns) && in_array('Start Time', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-start-time">
                                                                Start Time
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-end-time" <?=isset($columns) && in_array('End Time', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-end-time">
                                                                End Time
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-break" <?=isset($columns) && in_array('Break', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-break">
                                                                Break
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
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-billable" <?=isset($columns) && in_array('Billable', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-billable">
                                                                Billable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-invoice-date" <?=isset($columns) && in_array('Invoice Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-invoice-date">
                                                                Invoice Date
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
                                                    <input class="form-check-input" type="checkbox" <?=isset($filter_customer) ? 'checked' : '' ?> name="allow_filter_customer" value="1" id="allow-filter-customer">
                                                    <label class="form-check-label" for="allow-filter-customer">
                                                        Customer
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_customer" id="filter-customer" class="nsm-field form-control">
                                                    <?php if(isset($filter_customer)) : ?>
                                                    <?php if(!in_array($filter_customer->id, ['all', 'not-specified', 'specified'])) : ?>
                                                    <option value="<?=$filter_customer->id?>" selected><?=$filter_customer->name?></option>
                                                    <?php endif; ?>
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
                                                    <?php if(is_object($product_service) && !in_array($product_service->id, ['all', 'not-specified', 'specified'])) : ?>
                                                    <option value="<?=$product_service->id?>" selected><?=$product_service->name?></option>
                                                    <?php endif; ?>
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
                                                    <?php if(is_object($employee) && !in_array($employee->id, ['all', 'not-specified', 'specified'])) : ?>
                                                    <option value="<?=$employee->id?>" selected><?=$employee->name?></option>
                                                    <?php endif; ?>
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
                                                    <option value="all-dates" <?=$last_modified_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
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
                                                    <option value="since-30-days-ago" <?=empty($last_modified_date) || $last_modified_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago" <?=$last_modified_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago" <?=$last_modified_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago" <?=$last_modified_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <?php if(empty($last_modified_date) && $last_modified_date !== 'all-dates') : ?>
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
                                                    <input class="form-check-input" <?=isset($billable) ? 'checked' : '' ?> type="checkbox" name="allow_filter_billable" value="1" id="allow-filter-billable">
                                                    <label class="form-check-label" for="allow-filter-billable">
                                                        Billable
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_billable" id="filter-billable" class="nsm-field form-control">
                                                    <option value="all" <?=empty($billable) || $billable === 'all' ? 'selected' : ''?>>All</option>
                                                    <option value="yes" <?=$billable === 'yes' ? 'selected' : ''?>>Billable</option>
                                                    <option value="no" <?=$billable === 'no' ? 'selected' : ''?>>Non-Billable</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?=isset($memo) ? 'checked' : '' ?> type="checkbox" name="allow_filter_memo" value="1" id="allow-filter-memo">
                                                    <label class="form-check-label" for="allow-filter-memo">
                                                        Memo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="<?=isset($memo) ? $memo : ''?>" name="filter_memo" id="filter-memo">
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
                                                    <input class="form-check-input" <?=isset($show_report_period) ? 'checked' : ''?> type="checkbox" name="show_report_period" value="1" id="show-report-period">
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
                <span class="modal-title content-title" id="email_report_modal_label">Email Recent/Edited Time Activities Report</span>
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