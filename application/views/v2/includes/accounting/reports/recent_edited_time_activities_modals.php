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
                            <td data-name="Activity Date">ACTIVITY DATE</td>
                            <td data-name="Create Date">CREATE DATE</td>
                            <td data-name="Created By">CREATED BY</td>
                            <td data-name="Last Modified">LAST MODIFIED</td>
                            <td data-name="Last Modified By">LAST MODIFIED BY</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Employee">EMPLOYEE</td>
                            <td data-name="Product/Service">PRODUCT/SERVICE</td>
                            <td data-name="Memo/Description">MEMO/DESCRIPTION</td>
                            <td data-name="Rates">RATES</td>
                            <td data-name="Duration">DURATION</td>
                            <td data-name="Start Time">START TIME</td>
                            <td data-name="End Time">END TIME</td>
                            <td data-name="Break">BREAK</td>
                            <td data-name="Taxable">TAXABLE</td>
                            <td data-name="Billable">BILLABLE</td>
                            <td data-name="Invoice Date">INVOICE DATE</td>
                            <td data-name="Amount">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($activities) > 0) : ?>
                        <?php foreach($activities as $activity) : ?>
                        <tr>
                            <td><?=$activity['activity_date']?></td>
                            <td><?=$activity['create_date']?></td>
                            <td><?=$activity['created_by']?></td>
                            <td><?=$activity['last_modified']?></td>
                            <td><?=$activity['last_modified_by']?></td>
                            <td><?=$activity['customer']?></td>
                            <td><?=$activity['employee']?></td>
                            <td><?=$activity['product_service']?></td>
                            <td><?=$activity['memo_desc']?></td>
                            <td><?=$activity['rates']?></td>
                            <td><?=$activity['duration']?></td>
                            <td><?=$activity['start_time']?></td>
                            <td><?=$activity['end_time']?></td>
                            <td><?=$activity['break']?></td>
                            <td><?=$activity['taxable']?></td>
                            <td><?=$activity['billable']?></td>
                            <td><?=$activity['invoice_date']?></td>
                            <td><?=$activity['amount']?></td>
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
                            <td colspan="19" class="text-center">
                                <h4><?=$clients->business_name?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="19" class="text-center">
                                Recent/Edited Time Activities
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Activity Date">ACTIVITY DATE</td>
                            <td data-name="Create Date">CREATE DATE</td>
                            <td data-name="Created By">CREATED BY</td>
                            <td data-name="Last Modified">LAST MODIFIED</td>
                            <td data-name="Last Modified By">LAST MODIFIED BY</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Employee">EMPLOYEE</td>
                            <td data-name="Product/Service">PRODUCT/SERVICE</td>
                            <td data-name="Memo/Description">MEMO/DESCRIPTION</td>
                            <td data-name="Rates">RATES</td>
                            <td data-name="Duration">DURATION</td>
                            <td data-name="Start Time">START TIME</td>
                            <td data-name="End Time">END TIME</td>
                            <td data-name="Break">BREAK</td>
                            <td data-name="Taxable">TAXABLE</td>
                            <td data-name="Billable">BILLABLE</td>
                            <td data-name="Invoice Date">INVOICE DATE</td>
                            <td data-name="Amount">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($activities) > 0) : ?>
                        <?php foreach($activities as $activity) : ?>
                        <tr>
                            <td><?=$activity['activity_date']?></td>
                            <td><?=$activity['create_date']?></td>
                            <td><?=$activity['created_by']?></td>
                            <td><?=$activity['last_modified']?></td>
                            <td><?=$activity['last_modified_by']?></td>
                            <td><?=$activity['customer']?></td>
                            <td><?=$activity['employee']?></td>
                            <td><?=$activity['product_service']?></td>
                            <td><?=$activity['memo_desc']?></td>
                            <td><?=$activity['rates']?></td>
                            <td><?=$activity['duration']?></td>
                            <td><?=$activity['start_time']?></td>
                            <td><?=$activity['end_time']?></td>
                            <td><?=$activity['break']?></td>
                            <td><?=$activity['taxable']?></td>
                            <td><?=$activity['billable']?></td>
                            <td><?=$activity['invoice_date']?></td>
                            <td><?=$activity['amount']?></td>
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
                                                    <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=$end_date?>" id="to">
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
                                                    <input class="form-check-input" type="checkbox" name="number_format" value="divide-by-100" id="divide-by-100">
                                                    <label class="form-check-label" for="divide-by-100">
                                                        Divide by 100
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="number_format" value="without-cents" id="without-cents">
                                                    <label class="form-check-label" for="without-cents">
                                                        Without cents
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="negative_numbers" id="negative-numbers" class="nsm-field form-control">
                                                    <option value="-100">-100</option>
                                                    <option value="(100)">(100)</option>
                                                    <option value="100-">100-</option>
                                                </select>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="show_in_red" value="1" id="show-in-red">
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
                                                <input type="number" name="limit" id="limit" class="nsm-field form-control" value="25">
                                            </div>
                                            <div class="col-12 d-none">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <label for="select-columns"><b>Select columns</b></label>
                                                        <a href="#" class="float-end text-decoration-none" id="reset-columns-to-default">Reset to default</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-activity-date">
                                                            <label class="form-check-label" for="select-activity-date">
                                                                Activity Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-create-date">
                                                            <label class="form-check-label" for="select-create-date">
                                                                Create Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-created-by">
                                                            <label class="form-check-label" for="select-created-by">
                                                                Created By
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-last-modified">
                                                            <label class="form-check-label" for="select-last-modified">
                                                                Last Modified
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-last-modified-by">
                                                            <label class="form-check-label" for="select-last-modified-by">
                                                                Last Modified By
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-customer">
                                                            <label class="form-check-label" for="select-customer">
                                                                Customer
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-employee">
                                                            <label class="form-check-label" for="select-employee">
                                                                Employee
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-product-service">
                                                            <label class="form-check-label" for="select-product-service">
                                                                Product/Service
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-memo-description">
                                                            <label class="form-check-label" for="select-memo-description">
                                                                Memo/Description
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-rates">
                                                            <label class="form-check-label" for="select-rates">
                                                                Rates
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-duration">
                                                            <label class="form-check-label" for="select-duration">
                                                                Duration
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-start-time">
                                                            <label class="form-check-label" for="select-start-time">
                                                                Start Time
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-end-time">
                                                            <label class="form-check-label" for="select-end-time">
                                                                End Time
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-break">
                                                            <label class="form-check-label" for="select-break">
                                                                Break
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-taxable">
                                                            <label class="form-check-label" for="select-taxable">
                                                                Taxable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-billable">
                                                            <label class="form-check-label" for="select-billable">
                                                                Billable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-invoice-date">
                                                            <label class="form-check-label" for="select-invoice-date">
                                                                Invoice Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked type="checkbox" name="select_columns" value="1" id="select-amount">
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
                                                    <input class="form-check-input" type="checkbox" name="allow_filter_customer" value="1" id="allow-filter-customer">
                                                    <label class="form-check-label" for="allow-filter-customer">
                                                        Customer
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_customer" id="filter-customer" class="nsm-field form-control">
                                                    <option value="all" selected>All</option>
                                                    <option value="not-specified">Not Specified</option>
                                                    <option value="Specified">Specified</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="allow_filter_product_service" value="1" id="allow-filter-product-service">
                                                    <label class="form-check-label" for="allow-filter-product-service">
                                                        Product/Service
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_product_service" id="filter-product-service" class="nsm-field form-control">
                                                    <option value="all" selected>All</option>
                                                    <option value="not-specified">Not Specified</option>
                                                    <option value="Specified">Specified</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="allow_filter_employee" value="1" id="allow-filter-employee">
                                                    <label class="form-check-label" for="allow-filter-employee">
                                                        Employee
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_employee" id="filter-employee" class="nsm-field form-control">
                                                    <option value="all" selected>All</option>
                                                    <option value="not-specified">Not Specified</option>
                                                    <option value="Specified">Specified</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="allow_filter_create_date" value="1" id="allow-filter-create-date">
                                                    <label class="form-check-label" for="allow-filter-create-date">
                                                        Create Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_create_date" id="filter-create-date" class="nsm-field form-control">
                                                    <option value="all-dates">All Dates</option>
                                                    <option value="custom">Custom</option>
                                                    <option value="today">Today</option>
                                                    <option value="this-week">This Week</option>
                                                    <option value="this-week-to-date">This Week-to-date</option>
                                                    <option value="this-month">This Month</option>
                                                    <option value="this-month-to-date">This Month-to-date</option>
                                                    <option value="this-quarter">This Quarter</option>
                                                    <option value="this-quarter-to-date">This Quarter-to-date</option>
                                                    <option value="this-year">This Year</option>
                                                    <option value="this-year-to-date">This Year-to-date</option>
                                                    <option value="this-year-to-last-month">This Year-to-last-month</option>
                                                    <option value="yesterday">Yesterday</option>
                                                    <option value="recent">Recent</option>
                                                    <option value="last-week">Last Week</option>
                                                    <option value="last-week-to-date">Last Week-to-date</option>
                                                    <option value="last-month">Last Month</option>
                                                    <option value="last-month-to-date">Last Month-to-date</option>
                                                    <option value="last-quarter">Last Quarter</option>
                                                    <option value="last-quarter-to-date">Last Quarter-to-date</option>
                                                    <option value="last-year">Last Year</option>
                                                    <option value="last-year-to-date">Last Year-to-date</option>
                                                    <option value="since-30-days-ago">Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago">Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago">Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago">Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="allow_filter_last_modified_date" value="1" id="allow-filter-last-modified-date">
                                                    <label class="form-check-label" for="allow-filter-last-modified-date">
                                                        Last Modified Date
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_last_modified_date" id="filter-last-modified-date" class="nsm-field form-control">
                                                    <option value="all-dates">All Dates</option>
                                                    <option value="custom">Custom</option>
                                                    <option value="today">Today</option>
                                                    <option value="this-week">This Week</option>
                                                    <option value="this-week-to-date">This Week-to-date</option>
                                                    <option value="this-month">This Month</option>
                                                    <option value="this-month-to-date">This Month-to-date</option>
                                                    <option value="this-quarter">This Quarter</option>
                                                    <option value="this-quarter-to-date">This Quarter-to-date</option>
                                                    <option value="this-year">This Year</option>
                                                    <option value="this-year-to-date">This Year-to-date</option>
                                                    <option value="this-year-to-last-month">This Year-to-last-month</option>
                                                    <option value="yesterday">Yesterday</option>
                                                    <option value="recent">Recent</option>
                                                    <option value="last-week">Last Week</option>
                                                    <option value="last-week-to-date">Last Week-to-date</option>
                                                    <option value="last-month">Last Month</option>
                                                    <option value="last-month-to-date">Last Month-to-date</option>
                                                    <option value="last-quarter">Last Quarter</option>
                                                    <option value="last-quarter-to-date">Last Quarter-to-date</option>
                                                    <option value="last-year">Last Year</option>
                                                    <option value="last-year-to-date">Last Year-to-date</option>
                                                    <option value="since-30-days-ago" selected>Since 30 Days Ago</option>
                                                    <option value="since-60-days-ago">Since 60 Days Ago</option>
                                                    <option value="since-90-days-ago">Since 90 Days Ago</option>
                                                    <option value="since-365-days-ago">Since 365 Days Ago</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="last-modified-from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="<?=date("m/d/Y", strtotime("-30 days"))?>" id="filter-last-modified-date-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="last-modified-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control date" value="" id="filter-last-modified-date-to">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="allow_filter_billable" value="1" id="allow-filter-billable">
                                                    <label class="form-check-label" for="allow-filter-billable">
                                                        Billable
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="filter_billable" id="filter-billable" class="nsm-field form-control">
                                                    <option value="all">All</option>
                                                    <option value="yes">Billable</option>
                                                    <option value="no">Non-Billable</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="allow_filter_memo" value="1" id="allow-filter-memo">
                                                    <label class="form-check-label" for="allow-filter-memo">
                                                        Memo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" class="nsm-field form-control" value="" name="filter_memo" id="filter-memo">
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
                                                    <input class="form-check-input" type="checkbox" name="show_logo" value="1" id="show-logo">
                                                    <label class="form-check-label" for="show-logo">
                                                        Show logo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6"></div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="customize_company_name" checked value="1" id="customize-company-name">
                                                    <label class="form-check-label" for="company-name">
                                                        Company name
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="company_name" id="company-name" class="nsm-field form-control" value="<?=$clients->business_name?>">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="customize_report_title" checked value="1" id="customize-report-title">
                                                    <label class="form-check-label" for="customize-report-title">
                                                        Report title
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" name="report_title" id="report-title" class="nsm-field form-control" value="Recent/Edited Time Activities">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="show_report_period" checked value="1" id="show-report-period">
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
                                                    <input class="form-check-input" type="checkbox" name="show_date_prepared" checked value="1" id="show-date-prepared">
                                                    <label class="form-check-label" for="show-date-prepared">
                                                        Date prepared
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="show_time_prepared" checked value="1" id="show-time-prepared">
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
                                                    <option value="left">Left</option>
                                                    <option value="center" selected>Center</option>
                                                    <option value="right">Right</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-3">
                                                <label for="footer-alignment">Footer</label>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <select name="footer_alignment" id="footer-alignment" class="nsm-field form-control">
                                                    <option value="left">Left</option>
                                                    <option value="center" selected>Center</option>
                                                    <option value="right">Right</option>
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