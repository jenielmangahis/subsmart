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
                                <?php if($filter_date !== 'all-dates') : ?>
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
                                    <div class="col-12">
                                        <label for="rows-columns"><b>Rows/Columns</b></label>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        <label for="group-by">Group by</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select id="group-by" class="form-control nsm-field">
                                            <option value="none" <?=empty($group_by) || $group_by === 'none' ? 'selected' : ''?>>None</option>
                                            <option value="account" <?=$group_by === 'account' ? 'selected' : ''?>>Account</option>
                                            <option value="name" <?=$group_by === 'name' ? 'selected' : ''?>>Name</option>
                                            <option value="transaction-type" <?=$group_by === 'transaction-type' ? 'selected' : ''?>>Transaction Type</option>
                                            <option value="customer" <?=$group_by === 'customer' ? 'selected' : ''?>>Customer</option>
                                            <option value="vendor" <?=$group_by === 'vendor' ? 'selected' : ''?>>Vendor</option>
                                            <option value="employee" <?=$group_by === 'employee' ? 'selected' : ''?>>Employee</option>
                                            <option value="payment-method" <?=$group_by === 'payment-method' ? 'selected' : ''?>>Payment Method</option>
                                            <option value="day" <?=$group_by === 'day' ? 'selected' : ''?>>Day</option>
                                            <option value="week" <?=$group_by === 'week' ? 'selected' : ''?>>Week</option>
                                            <option value="month" <?=$group_by === 'month' ? 'selected' : ''?>>Month</option>
                                            <option value="quarter" <?=$group_by === 'quarter' ? 'selected' : ''?>>Quarter</option>
                                            <option value="year" <?=$group_by === 'year' ? 'selected' : ''?>>Year</option>
                                        </select>
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
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Transaction List by Date">
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
                                                    <option value="ap-paid" <?=$sort_by === 'ap-paid' ? 'selected' : ''?>>A/P Paid</option>
                                                    <option value="ar-paid" <?=$sort_by === 'ar-paid' ? 'selected' : ''?>>A/R Paid</option>
                                                    <option value="account" <?=$sort_by === 'account' ? 'selected' : ''?>>Account</option>
                                                    <option value="adj" <?=$sort_by === 'adj' ? 'selected' : ''?>>Adj</option>
                                                    <option value="check-printed" <?=$sort_by === 'check-printed' ? 'selected' : ''?>>Check Printed</option>
                                                    <option value="clr" <?=$sort_by === 'clr' ? 'selected' : ''?>>Clr</option>
                                                    <option value="create-date" <?=$sort_by === 'create-date' ? 'selected' : ''?>>Create Date</option>
                                                    <option value="created-by" <?=$sort_by === 'created-by' ? 'selected' : ''?>>Created By</option>
                                                    <option value="customer-vendor-message" <?=$sort_by === 'customer-vendor-message' ? 'selected' : ''?>>Customer/Vendor Message</option>
                                                    <option value="date" <?=$sort_by === 'date' ? 'selected' : ''?>>Date</option>
                                                    <option value="due-date" <?=$sort_by === 'due-date' ? 'selected' : ''?>>Due Date</option>
                                                    <option value="invoice-date" <?=$sort_by === 'invoice-date' ? 'selected' : ''?>>Invoice Date</option>
                                                    <option value="last-modified" <?=$sort_by === 'last-modified' ? 'selected' : ''?>>Last Modified</option>
                                                    <option value="last-modified-by" <?=$sort_by === 'last-modified-by' ? 'selected' : ''?>>Last Modified By</option>
                                                    <option value="memo-desc" <?=$sort_by === 'memo-desc' ? 'selected' : ''?>>Memo/Description</option>
                                                    <option value="name" <?=$sort_by === 'name' ? 'selected' : ''?>>Name</option>
                                                    <option value="num" <?=$sort_by === 'num' ? 'selected' : ''?>>Num</option>
                                                    <option value="online-banking" <?=$sort_by === 'online-banking' ? 'selected' : ''?>>Online Banking</option>
                                                    <option value="po-number" <?=$sort_by === 'po-number' ? 'selected' : ''?>>P.O. Number</option>
                                                    <option value="po-status" <?=$sort_by === 'po-status' ? 'selected' : ''?>>PO Status</option>
                                                    <option value="paid-by-mas" <?=$sort_by === 'paid-by-mas' ? 'selected' : ''?>>Paid by MAS</option>
                                                    <option value="payment-method" <?=$sort_by === 'payment-method' ? 'selected' : ''?>>Payment Method</option>
                                                    <option value="posting" <?=$sort_by === 'posting' ? 'selected' : ''?>>Posting</option>
                                                    <option value="ref-no" <?=$sort_by === 'ref-no' ? 'selected' : ''?>>Ref #</option>
                                                    <option value="sku" <?=$sort_by === 'sku' ? 'selected' : ''?>>SKU</option>
                                                    <option value="sales-rep" <?=$sort_by === 'sales-rep' ? 'selected' : ''?>>Sales Rep</option>
                                                    <option value="ship-via" <?=$sort_by === 'ship-via' ? 'selected' : ''?>>Ship Via</option>
                                                    <option value="split" <?=$sort_by === 'split' ? 'selected' : ''?>>Split</option>
                                                    <option value="tax-amount" <?=$sort_by === 'tax-amount' ? 'selected' : ''?>>Tax Amount</option>
                                                    <option value="taxable-amount" <?=$sort_by === 'taxable-amount' ? 'selected' : ''?>>Taxable Amount</option>
                                                    <option value="terms" <?=$sort_by === 'terms' ? 'selected' : ''?>>Terms</option>
                                                    <option value="transaction-type" <?=$sort_by === 'transaction-type' ? 'selected' : ''?>>Transaction Type</option>
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
                                                            <input type="checkbox" name="col_chk" id="col-posting" class="form-check-input" <?=isset($columns) && in_array('Posting', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-posting" class="form-check-label">Posting</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-memo-description" class="form-check-input" <?=isset($columns) && in_array('Memo/Description', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-memo-description" class="form-check-label">Memo/Description</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-ref-no" class="form-check-input" <?=isset($columns) && in_array('Ref No.', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-ref-no" class="form-check-label">Ref #</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-sales-rep" class="form-check-input" <?=isset($columns) && in_array('Sales Rep', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-sales-rep" class="form-check-label">Sales Rep</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-po-number" class="form-check-input" <?=isset($columns) && in_array('P.O. Number', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-po-number" class="form-check-label">P.O. Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-po-status" class="form-check-input" <?=isset($columns) && in_array('PO Status', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-po-status" class="form-check-label">PO Status</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-ship-via" class="form-check-input" <?=isset($columns) && in_array('Ship Via', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-ship-via" class="form-check-label">Ship Via</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-payment-method" class="form-check-input" <?=isset($columns) && in_array('Payment Method', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-payment-method" class="form-check-label">Payment Method</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-terms" class="form-check-input" <?=isset($columns) && in_array('Terms', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-terms" class="form-check-label">Terms</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-due-date" class="form-check-input" <?=isset($columns) && in_array('Due Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-due-date" class="form-check-label">Due Date</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-customer-vendor-message" class="form-check-input" <?=isset($columns) && in_array('Customer/Vendor Message', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-customer-vendor-message" class="form-check-label">Customer/Vendor Message</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-paid-by-mas" class="form-check-input" <?=isset($columns) && in_array('Paid by MAS', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-paid-by-mas" class="form-check-label">Paid by MAS</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-open-balance" class="form-check-input" <?=isset($columns) && in_array('Open Balance', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-open-balance" class="form-check-label">Open Balance</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-online-banking" class="form-check-input" <?=isset($columns) && in_array('Online Banking', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-online-banking" class="form-check-label">Online Banking</label>
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
                                            <?php if(isset($columns) && $total_index === 0 && !is_null($group_by)) : ?>
                                            <td data-name=""></td>
                                            <?php endif; ?>
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                                            <td data-name="Transaction Type" <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>>TRANSACTION TYPE</td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td>
                                            <td data-name="Adj" <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>>ADJ</td>
                                            <td data-name="Posting" <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>>POSTING</td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Name" <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>>NAME</td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                                            <td data-name="Split" <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>>SPLIT</td>
                                            <td data-name="Ref No." <?=isset($columns) && !in_array('Ref No.', $columns) ? 'style="display: none"' : ''?>>REF #</td>
                                            <td data-name="Sales Rep" <?=isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''?>>SALES REP</td>
                                            <td data-name="P.O. Number" <?=isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''?>>P.O. NUMBER</td>
                                            <td data-name="PO Status" <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>>PO STATUS</td>
                                            <td data-name="Ship Via" <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>>SHIP VIA</td>
                                            <td data-name="Payment Method" <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>>PAYMENT METHOD</td>
                                            <td data-name="Terms" <?=isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''?>>TERMS</td>
                                            <td data-name="Due Date" <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>>DUE DATE</td>
                                            <td data-name="Customer/Vendor Message" <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>>CUSTOMER/VENDOR MESSAGE</td>
                                            <td data-name="Invoice Date" <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>>INVOICE DATE</td>
                                            <td data-name="A/R Paid" <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>>A/R PAID</td>
                                            <td data-name="A/P Paid" <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>>A/P PAID</td>
                                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                                            <td data-name="Paid by MAS" <?=isset($columns) && !in_array('Paid by MAS', $columns) ? 'style="display: none"' : ''?>>PAID BY MAS</td>
                                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                                            <td data-name="Debit" <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>>DEBIT</td>
                                            <td data-name="Credit" <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>>CREDIT</td>
                                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>>TAX AMOUNT</td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>>TAXABLE AMOUNT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($transactions) > 0) : ?>
                                        <?php foreach($transactions as $index => $transaction) : ?>
                                        <?php if(is_null($group_by)) : ?>
                                        <tr>
                                            <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['date']?></td>
                                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['transaction_type']?></td>
                                            <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$transaction['num']?></td>
                                            <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>><?=$transaction['adj']?></td>
                                            <td <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>><?=$transaction['posting']?></td>
                                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['create_date']?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['name']?></td>
                                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo_description']?></td>
                                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account']?></td>
                                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$transaction['split']?></td>
                                            <td <?=isset($columns) && !in_array('Ref No.', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ref_no']?></td>
                                            <td <?=isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''?>><?=$transaction['sales_rep']?></td>
                                            <td <?=isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''?>><?=$transaction['po_number']?></td>
                                            <td <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>><?=$transaction['po_status']?></td>
                                            <td <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ship_via']?></td>
                                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$transaction['payment_method']?></td>
                                            <td <?=isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''?>><?=$transaction['terms']?></td>
                                            <td <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['due_date']?></td>
                                            <td <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$transaction['customer_vendor_message']?></td>
                                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['invoice_date']?></td>
                                            <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ar_paid']?></td>
                                            <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ap_paid']?></td>
                                            <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$transaction['clr']?></td>
                                            <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_printed']?></td>
                                            <td <?=isset($columns) && !in_array('Paid by MAS', $columns) ? 'style="display: none"' : ''?>><?=$transaction['paid_by_mas']?></td>
                                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['open_balance']?></td>
                                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['debit']?></td>
                                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['credit']?></td>
                                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$transaction['online_banking']?></td>
                                            <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_amount']?></td>
                                            <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['taxable_amount']?></td>
                                        </tr>
                                        <?php else : ?>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                            <td colspan="<?=isset($columns) ? $total_index : '28'?>"><i class="bx bx-fw bx-caret-right"></i> <b><?=$transaction['name']?></b></td>
                                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['amount_total']?></b></td>
                                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['debit_total']?></b></td>
                                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['credit_total']?></b></td>
                                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['tax_amount_total']?></b></td>
                                            <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['taxable_amount_total']?></b></td>
                                        </tr>
                                        <?php foreach($transaction['transactions'] as $tran) : ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                            <?php if(isset($columns) && $total_index === 0 && !is_null($group_by)) : ?>
                                            <td></td>
                                            <?php endif; ?>
                                            <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['date']?></td>
                                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['transaction_type']?></td>
                                            <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$transaction['num']?></td>
                                            <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>><?=$transaction['adj']?></td>
                                            <td <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>><?=$transaction['posting']?></td>
                                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['create_date']?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['name']?></td>
                                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo_description']?></td>
                                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account']?></td>
                                            <td <?=isset($columns) && !in_array('Split', $columns) ? 'style="display: none"' : ''?>><?=$transaction['split']?></td>
                                            <td <?=isset($columns) && !in_array('Ref No.', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ref_no']?></td>
                                            <td <?=isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''?>><?=$transaction['sales_rep']?></td>
                                            <td <?=isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''?>><?=$transaction['po_number']?></td>
                                            <td <?=isset($columns) && !in_array('PO Status', $columns) ? 'style="display: none"' : ''?>><?=$transaction['po_status']?></td>
                                            <td <?=isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ship_via']?></td>
                                            <td <?=isset($columns) && !in_array('Payment Method', $columns) ? 'style="display: none"' : ''?>><?=$transaction['payment_method']?></td>
                                            <td <?=isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''?>><?=$transaction['terms']?></td>
                                            <td <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['due_date']?></td>
                                            <td <?=isset($columns) && !in_array('Customer/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$transaction['customer_vendor_message']?></td>
                                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['invoice_date']?></td>
                                            <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ar_paid']?></td>
                                            <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ap_paid']?></td>
                                            <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$transaction['clr']?></td>
                                            <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_printed']?></td>
                                            <td <?=isset($columns) && !in_array('Paid by MAS', $columns) ? 'style="display: none"' : ''?>><?=$transaction['paid_by_mas']?></td>
                                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['amount']?></td>
                                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['open_balance']?></td>
                                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['debit']?></td>
                                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['credit']?></td>
                                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$transaction['online_banking']?></td>
                                            <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['tax_amount']?></td>
                                            <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$transaction['taxable_amount']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="clickable collapse-row collapse group-total" id="accordion-<?=$index?>">
                                            <td colspan="<?=isset($columns) ? $total_index : '28'?>"><b>Total for <?=$transaction['name']?></b></td>
                                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['amount_total']?></b></td>
                                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['debit_total']?></b></td>
                                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['credit_total']?></b></td>
                                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['tax_amount_total']?></b></td>
                                            <td <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$transaction['taxable_amount_total']?></b></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="35">
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