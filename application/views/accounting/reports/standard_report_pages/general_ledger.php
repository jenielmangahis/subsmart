<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath("v2/includes/accounting/reports/$modalsView"); ?>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="filter-report-period">Report period</label>
                                        <select class="nsm-field form-select" name="filter_report_period" id="filter-report-period">
                                            <option value="all-dates" <?=$filter_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                            <option value="custom" <?=$filter_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                            <option value="today" <?=$filter_date === 'today' ? 'selected' : ''?>>Today</option>
                                            <option value="this-week" <?=$filter_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                            <option value="this-week-to-date" <?=$filter_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                            <option value="this-month" <?=$filter_date === 'this-month' ? 'selected' : ''?>>This Month</option>
                                            <option value="this-month-to-date" <?=empty($filter_date) || $filter_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
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
                                </div>
                                <?php if(!empty($filter_date) && $filter_date !== 'all-dates' || empty($filter_date)) : ?>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="filter-report-period-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$end_date?>" id="filter-report-period-to">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="" class="w-100">Accounting method</label>
                                        <div class="form-check d-inline-block">
                                            <input type="radio" id="cash-method" class="form-check-input" name="accounting_method" <?=isset($accounting_method) && $accounting_method === 'cash' ? 'checked' : ''?>>
                                            <label for="cash-method" class="form-check-label">Cash</label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                            <input type="radio" id="accrual-method" class="form-check-input" name="accounting_method" <?=!isset($accounting_method) ? 'checked' : ''?>>
                                            <label for="accrual-method" class="form-check-label">Accrual</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary" id="run-report">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#settings-modal">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 20%">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="custom-report-name">Custom report name</label>
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Account List">
                                    </div>
                                    <div class="col-12">
                                        <label for="custom-report-group">Add this report to a group</label>
                                        <select name="custom_report_group" id="custom-report-group" class="nsm-field form-control"></select>
                                        <a href="#" class="text-decoration-none" id="add-new-custom-report-group">Add new group</a>
                                    </div>
                                    <div class="col-12 d-none">
                                        <form id="new-custom-report-group">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="custom-group-name">New group name</label>
                                                    <input type="text" class="nsm-field form-control" name="new_custom_group_name" id="custom-group-name">
                                                </div>
                                                <div class="col-4 d-flex align-items-end">
                                                    <button type="submit" class="nsm-button success">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12">
                                        <label for="share-with">Share with</label>
                                        <select name="share_with" id="share-with" class="nsm-field form-control">
                                            <option value="all">All</option>
                                            <option value="none" selected>None</option>
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary" id="save-custom-report">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center">
                    <div class="col-auto">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <p class="m-0">Sort by</p>
                                                <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                    <option value="default" <?=empty($sort_by) || $sort_by === 'default' ? 'selected' : ''?>>Default</option>
                                                    <option value="account" <?=$sort_by === 'account' ? 'selected' : ''?>>Account</option>
                                                    <option value="create-date" <?=$sort_by === 'create-date' ? 'selected' : ''?>>Create Date</option>
                                                    <option value="created-by" <?=$sort_by === 'created-by' ? 'selected' : ''?>>Created By</option>
                                                    <option value="description" <?=$sort_by === 'description' ? 'selected' : ''?>>Description</option>
                                                    <option value="detail-type" <?=$sort_by === 'detail-type' ? 'selected' : ''?>>Detail Type</option>
                                                    <option value="last-modified" <?=$sort_by === 'last-modified' ? 'selected' : ''?>>Last Modified</option>
                                                    <option value="last-modified-by" <?=$sort_by === 'last-modified-by' ? 'selected' : ''?>>Last Modified By</option>
                                                    <option value="type" <?=$sort_by === 'type' ? 'selected' : ''?>>Type</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" value="asc" <?=!isset($sort_in) ? 'checked' : ''?>>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input" value="desc" <?=isset($sort_in) && $sort_in === 'desc' ? 'checked' : ''?>>
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button" id="<?=is_null($reportNote) ? 'add-notes' : 'edit-notes'?>">
                                                <?php if(is_null($reportNote) || empty($reportNote->notes)) : ?>
                                                <span>Add notes</span>
                                                <?php else : ?>
                                                <span>Edit notes</span>
                                                <?php endif; ?>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_report_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-25">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                                <p class="m-0">Change columns</p>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-date" class="form-check-input" <?=isset($columns) && in_array('Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-date" class="form-check-label">Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-transaction-type" class="form-check-input" <?=isset($columns) && in_array('Transaction Type', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-transaction-type" class="form-check-label">Transaction Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-num" class="form-check-input" <?=isset($columns) && in_array('Num', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-num" class="form-check-label">Num</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-adj" class="form-check-input" <?=isset($columns) && in_array('Adj', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-adj" class="form-check-label">Adj</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-create-date" class="form-check-input" <?=isset($columns) && in_array('Create Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-create-date" class="form-check-label">Create Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-created-by" class="form-check-input" <?=isset($columns) && in_array('Created By', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-created-by" class="form-check-label">Created By</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-last-modified" class="form-check-input" <?=isset($columns) && in_array('Last Modified', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-last-modified" class="form-check-label">Last Modified</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-last-modified-by" class="form-check-input" <?=isset($columns) && in_array('Last Modified By', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-last-modified-by" class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-name" class="form-check-input" <?=isset($columns) && in_array('Name', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-name" class="form-check-label">Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-customer" class="form-check-input" <?=isset($columns) && in_array('Customer', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-customer" class="form-check-label">Customer</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-vendor" class="form-check-input" <?=isset($columns) && in_array('Vendor', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-vendor" class="form-check-label">Vendor</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-employee" class="form-check-input" <?=isset($columns) && in_array('Employee', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-employee" class="form-check-label">Employee</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-product-service" class="form-check-input" <?=isset($columns) && in_array('Product/Service', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-product-service" class="form-check-label">Product/Service</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-memo-description" class="form-check-input" <?=isset($columns) && in_array('Memo/Description', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-memo-description" class="form-check-label">Memo/Description</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-qty" class="form-check-input" <?=isset($columns) && in_array('Qty', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-qty" class="form-check-label">Qty</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-rate" class="form-check-input" <?=isset($columns) && in_array('Rate', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-rate" class="form-check-label">Rate</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-account" class="form-check-input" <?=isset($columns) && in_array('Account', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-account" class="form-check-label">Account</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-split" class="form-check-input" <?=isset($columns) && in_array('Split', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-split" class="form-check-label">Split</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-invoice-date" class="form-check-input" <?=isset($columns) && in_array('Invoice Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-invoice-date" class="form-check-label">Invoice Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-ar-paid" class="form-check-input" <?=isset($columns) && in_array('A/R Paid', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-ar-paid" class="form-check-label">A/R Paid</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-ap-paid" class="form-check-input" <?=isset($columns) && in_array('A/P Paid', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-ap-paid" class="form-check-label">A/P Paid</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-clr" class="form-check-input" <?=isset($columns) && in_array('Clr', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-clr" class="form-check-label">Clr</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-check-printed" class="form-check-input" <?=isset($columns) && in_array('Check Printed', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-check-printed" class="form-check-label">Check Printed</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-debit" class="form-check-input" <?=isset($columns) && in_array('Debit', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-debit" class="form-check-label">Debit</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-credit" class="form-check-input" <?=isset($columns) && in_array('Credit', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-credit" class="form-check-label">Credit</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-open-balance" class="form-check-input" <?=isset($columns) && in_array('Open Balance', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-open-balance" class="form-check-label">Open Balance</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-amount" class="form-check-input" <?=isset($columns) && in_array('Amount', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-amount" class="form-check-label">Amount</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-balance" class="form-check-input" <?=isset($columns) && in_array('Balance', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-balance" class="form-check-label">Balance</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-online-banking" class="form-check-input" <?=isset($columns) && in_array('Online Banking', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-online-banking" class="form-check-label">Online Banking</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-tax-name" class="form-check-input" <?=isset($columns) && in_array('Tax Name', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-tax-name" class="form-check-label">Tax Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-tax-amount" class="form-check-input" <?=isset($columns) && in_array('Tax Amount', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-tax-amount" class="form-check-label">Tax Amount</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-taxable-amount" class="form-check-input" <?=isset($columns) && in_array('Taxable Amount', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-taxable-amount" class="form-check-label">Taxable Amount</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row <?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                    <?php if(isset($show_logo)) : ?>
                                    <!-- <div class="position-absolute">
                                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px"/>
                                    </div> -->
                                    <?php endif; ?>
                                    <?php if(!isset($show_company_name)) : ?>
                                    <div class="col-12 grid-mb">
                                        <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!isset($show_report_title)) : ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0 fw-bold"><?=$report_title?></p>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!isset($show_report_period)) : ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0"><?=$report_period?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                                            <td data-name="Transaction Type" <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>>TRANSACTION TYPE</td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td>
                                            <td data-name="Adj" <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>>ADJ</td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Name" <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>>NAME</td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>>VENDOR</td>
                                            <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>>EMPLOYEE</td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>>QTY</td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>>RATE</td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                                            <td data-name="Invoice Date" <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>>INVOICE DATE</td>
                                            <td data-name="A/R Paid" <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>>A/R PAID</td>
                                            <td data-name="A/P Paid" <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>>A/P PAID</td>
                                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                                            <td data-name="Debit" <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>>DEBIT</td>
                                            <td data-name="Credit" <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>>CREDIT</td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>>BALANCE</td>
                                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>>TAX NAME</td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>>TAX AMOUNT</td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>>TAXABLE AMOUNT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($accounts) > 0) : ?>
                                        <?php foreach($accounts as $index => $account) : ?>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                            <td colspan="23"><i class="bx bx-fw bx-caret-right"></i> <b><?=$account['name']?></b></td>
                                            <td><b><?=$account['debit_total']?></b></td>
                                            <td><b><?=$account['credit_total']?></b></td>
                                            <td></td>
                                            <td><b><?=$account['amount_total']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=$account['tax_amount_total']?></b></td>
                                            <td><b><?=$account['taxable_amount_total']?></b></td>
                                        </tr>
                                        <tr class="clickable collapse-row collapse starting-balance-row" id="accordion-<?=$index?>">
                                            <td colspan="27"><b>Beginning Balance</b></td>
                                            <td><b><?=$account['beginning_balance']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php foreach($account['transactions'] as $transaction) : ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                            <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['date']?></td>
                                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['transaction_type']?></td>
                                            <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$transaction['number']?></td>
                                            <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>><?=$transaction['adj']?></td>
                                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['create_date']?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['name']?></td>
                                            <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$transaction['customer']?></td>
                                            <td <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$transaction['vendor']?></td>
                                            <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$transaction['employee']?></td>
                                            <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$transaction['product_service']?></td>
                                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo_description']?></td>
                                            <td <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$transaction['qty']?></td>
                                            <td <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$transaction['rate']?></td>
                                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account']?></td>
                                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$transaction['split']?></td>
                                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['invoice_date']?></td>
                                            <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ar_paid']?></td>
                                            <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ap_paid']?></td>
                                            <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$transaction['clr']?></td>
                                            <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_printed']?></td>
                                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['debit']?></td>
                                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['credit']?></td>
                                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['open_balance']?></td>
                                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                                            <td <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['balance']?></td>
                                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$transaction['online_banking']?></td>
                                            <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_name']?></td>
                                            <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_amount']?></td>
                                            <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['taxable_amount']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="clickable collapse-row collapse group-total" id="accordion-<?=$index?>">
                                            <td colspan="23">Total for <?=$account['name']?></td>
                                            <td><b><?=$account['debit_total']?></b></td>
                                            <td><b><?=$account['credit_total']?></b></td>
                                            <td></td>
                                            <td><b><?=$account['amount_total']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=$account['tax_amount_total']?></b></td>
                                            <td><b><?=$account['taxable_amount_total']?></b></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="32">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-12 d-none" id="report-note-form">
                                        <textarea name="report_note" id="report-note" maxlength="4000" class="nsm-field form-control mb-3" placeholder="Add notes or include additional info with your report"><?=!is_null($reportNote) ? str_replace("<br />", "", $reportNote->notes) : ''?></textarea>
                                        <label for="report-note">4000 characters max</label>
                                        <button class="nsm-button primary float-end" id="save-note">Save</button>
                                        <button class="nsm-button float-end" id="cancel-note-update">Cancel</button>
                                    </div>
                                    <div class="col-12 <?=is_null($reportNote) ? 'd-none' : ''?>" id="report-note-cont">
                                        <?php if(!is_null($reportNote)) : ?>
                                        <?=str_replace("\n", "<br />", $reportNote->notes)?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-footer <?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
                                <p class="m-0"><?=date($prepared_timestamp)?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const companyName = "<?=$clients->business_name?>"
</script>
<?php include viewPath('v2/includes/footer'); ?>