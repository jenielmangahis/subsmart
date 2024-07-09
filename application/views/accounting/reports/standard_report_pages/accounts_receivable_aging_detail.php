<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('accounting/reports/reports_assets/report_css'); ?>
<style>
.table-wrapper {
    overflow-x: auto;
    max-width: 100%;
    margin-bottom: 1rem;
}

.table-wrapper table thead tr th {
    padding: 20px
}

.nsm-table {
    width: 100%;
    white-space: nowrap;
}

.transaction-content {
    max-height: 100px;
    overflow-y: auto;
}

.transaction-content tr td {
    text-align: center
}

.compact-table td,
.compact-table th {
    padding: 4px 8px;
    font-size: 12px;
}
</style>
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
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period">Report period</label>
                                        <select class="nsm-field form-select" name="filter_report_period"
                                            id="filter-report-period">
                                            <option value="all-dates"
                                                <?php echo $filter_date === 'all-dates' ? 'selected' : ''; ?>>All Dates
                                            </option>
                                            <option value="custom"
                                                <?php echo $filter_date === 'custom' ? 'selected' : ''; ?>>
                                                Custom</option>
                                            <option value="today"
                                                <?php echo empty($filter_date) || $filter_date === 'today' ? 'selected' : ''; ?>>
                                                Today</option>
                                            <option value="this-week"
                                                <?php echo $filter_date === 'this-week' ? 'selected' : ''; ?>>This Week
                                            </option>
                                            <option value="this-week-to-date"
                                                <?php echo $filter_date === 'this-week-to-date' ? 'selected' : ''; ?>>
                                                This
                                                Week-to-date</option>
                                            <option value="this-month"
                                                <?php echo $filter_date === 'this-month' ? 'selected' : ''; ?>>This
                                                Month</option>
                                            <option value="this-month-to-date"
                                                <?php echo $filter_date === 'this-month-to-date' ? 'selected' : ''; ?>>
                                                This
                                                Month-to-date</option>
                                            <option value="this-quarter"
                                                <?php echo $filter_date === 'this-quarter' ? 'selected' : ''; ?>>This
                                                Quarter
                                            </option>
                                            <option value="this-quarter-to-date"
                                                <?php echo $filter_date === 'this-quarter-to-date' ? 'selected' : ''; ?>>
                                                This
                                                Quarter-to-date</option>
                                            <option value="this-year"
                                                <?php echo $filter_date === 'this-year' ? 'selected' : ''; ?>>This Year
                                            </option>
                                            <option value="this-year-to-date"
                                                <?php echo $filter_date === 'this-year-to-date' ? 'selected' : ''; ?>>
                                                This
                                                Year-to-date</option>
                                            <option value="this-year-to-last-month"
                                                <?php echo $filter_date === 'this-year-to-last-month' ? 'selected' : ''; ?>>
                                                This
                                                Year-to-last-month</option>
                                            <option value="yesterday"
                                                <?php echo $filter_date === 'yesterday' ? 'selected' : ''; ?>>Yesterday
                                            </option>
                                            <option value="recent"
                                                <?php echo $filter_date === 'recent' ? 'selected' : ''; ?>>
                                                Recent</option>
                                            <option value="last-week"
                                                <?php echo $filter_date === 'last-week' ? 'selected' : ''; ?>>Last Week
                                            </option>
                                            <option value="last-week-to-date"
                                                <?php echo $filter_date === 'last-week-to-date' ? 'selected' : ''; ?>>
                                                Last
                                                Week-to-date</option>
                                            <option value="last-month"
                                                <?php echo $filter_date === 'last-month' ? 'selected' : ''; ?>>Last
                                                Month</option>
                                            <option value="last-month-to-date"
                                                <?php echo $filter_date === 'last-month-to-date' ? 'selected' : ''; ?>>
                                                Last
                                                Month-to-date</option>
                                            <option value="last-quarter"
                                                <?php echo $filter_date === 'last-quarter' ? 'selected' : ''; ?>>Last
                                                Quarter
                                            </option>
                                            <option value="last-quarter-to-date"
                                                <?php echo $filter_date === 'last-quarter-to-date' ? 'selected' : ''; ?>>
                                                Last
                                                Quarter-to-date</option>
                                            <option value="last-year"
                                                <?php echo $filter_date === 'last-year' ? 'selected' : ''; ?>>Last Year
                                            </option>
                                            <option value="last-year-to-date"
                                                <?php echo $filter_date === 'last-year-to-date' ? 'selected' : ''; ?>>
                                                Last
                                                Year-to-date</option>
                                            <option value="since-30-days-ago"
                                                <?php echo $filter_date === 'since-30-days-ago' ? 'selected' : ''; ?>>
                                                Since 30
                                                Days Ago</option>
                                            <option value="since-60-days-ago"
                                                <?php echo $filter_date === 'since-60-days-ago' ? 'selected' : ''; ?>>
                                                Since 60
                                                Days Ago</option>
                                            <option value="since-90-days-ago"
                                                <?php echo $filter_date === 'since-90-days-ago' ? 'selected' : ''; ?>>
                                                Since 90
                                                Days Ago</option>
                                            <option value="since-365-days-ago"
                                                <?php echo $filter_date === 'since-365-days-ago' ? 'selected' : ''; ?>>
                                                Since 365
                                                Days Ago</option>
                                            <option value="next-week"
                                                <?php echo $filter_date === 'next-week' ? 'selected' : ''; ?>>Next Week
                                            </option>
                                            <option value="next-4-weeks"
                                                <?php echo $filter_date === 'next-4-weeks' ? 'selected' : ''; ?>>Next 4
                                                Weeks
                                            </option>
                                            <option value="next-month"
                                                <?php echo $filter_date === 'next-month' ? 'selected' : ''; ?>>Next
                                                Month</option>
                                            <option value="next-quarter"
                                                <?php echo $filter_date === 'next-quarter' ? 'selected' : ''; ?>>Next
                                                Quarter
                                            </option>
                                            <option value="next-year"
                                                <?php echo $filter_date === 'next-year' ? 'selected' : ''; ?>>Next Year
                                            </option>
                                        </select>
                                    </div>
                                    <?php if ($filter_date !== 'all-dates') { ?>
                                    <div class="col-12 col-md-auto d-flex justify-content-center align-items-end">
                                        <span>as of</span>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex justify-content-center align-items-end">
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date"
                                                value="<?php echo $end_date; ?>" id="filter-report-period-to">
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="aging-method">Aging method</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="filter_aging_method" id="aging-method-current"
                                                        value="current"
                                                        <?php echo $aging_method === 'current' ? 'checked' : ''; ?>>
                                                    <label class="form-check-label"
                                                        for="aging-method-current">Current</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="filter_aging_method" id="aging-method-report-date"
                                                        value="report-date"
                                                        <?php echo empty($aging_method) || $aging_method === 'report-date' ? 'checked' : ''; ?>>
                                                    <label class="form-check-label"
                                                        for="aging-method-report-date">Report date</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="filter-days-per-aging-period">Days per aging period</label>
                                        <input type="text" class="nsm-field form-control"
                                            value="<?php echo !empty($days_per_aging_period) ? $days_per_aging_period : 30; ?>"
                                            id="filter-days-per-aging-period">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="filter-number-of-periods">Number of periods</label>
                                        <input type="text" class="nsm-field form-control"
                                            value="<?php echo !empty($number_of_periods) ? $number_of_periods : 4; ?>"
                                            id="filter-number-of-periods">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="filter-min-days-past-due">Min. days past due</label>
                                        <input type="text" class="nsm-field form-control"
                                            value="<?php echo !empty($min_days_past_due) ? $min_days_past_due : ''; ?>"
                                            id="filter-min-days-past-due">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="nsm-button primary" id="run-report">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>

                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 20%">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="custom-report-name">Custom report name</label>
                                        <input type="text" name="custom_report_name" id="custom-report-name"
                                            class="nsm-field form-control" value="A/R Aging Detail">
                                    </div>
                                    <div class="col-12">
                                        <label for="custom-report-group">Add this report to a group</label>
                                        <select name="custom_report_group" id="custom-report-group"
                                            class="nsm-field form-control"></select>
                                        <a href="#" class="text-decoration-none" id="add-new-custom-report-group">Add
                                            new group</a>
                                    </div>
                                    <div class="col-12 d-none">
                                        <form id="new-custom-report-group">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="custom-group-name">New group name</label>
                                                    <input type="text" class="nsm-field form-control"
                                                        name="new_custom_group_name" id="custom-group-name">
                                                </div>
                                                <div class="col-4 d-flex align-items-end">
                                                    <button type="submit" class="nsm-button success">Add</button>
                                                    <button class="nsm-button"
                                                        id="cancel-new-custom-report-group">Cancel</button>
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

                <div class="row g-3">
                    <div class="col-auto">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button"
                                                id="<?php echo is_null($reportNote) ? 'add-notes' : 'edit-notes'; ?>">
                                                <?php if (is_null($reportNote) || empty($reportNote->notes)) { ?>
                                                <span>Add notes</span>
                                                <?php } else { ?>
                                                <span>Edit notes</span>
                                                <?php } ?>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal"
                                                data-bs-target="#emailReportModal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal"
                                                data-bs-target="#print_report_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);"
                                                        id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);"
                                                        id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                            <button type="button" class="nsm-button " data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-book-content"></i>
                                            </button>
                                            <button class="nsm-button border-0 primary top-button"
                                                data-bs-toggle="modal" data-bs-target="#reportSettings"><i
                                                    class="bx bx-fw bx-cog icon-top"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-25">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" id="display" class="form-check-input">
                                                    <label for="compact-display"
                                                        class="form-check-label">Compact</label>
                                                </div>
                                                <p class="m-0">Change columns</p>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-date"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Date', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-date" class="form-check-label">Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk"
                                                                id="col-transaction-type" class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Transaction Type', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-transaction-type"
                                                                class="form-check-label">Transaction Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-num"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Num', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-num" class="form-check-label">Num</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-create-date"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Create Date', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-create-date" class="form-check-label">Create
                                                                Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-created-by"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Created By', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-created-by" class="form-check-label">Created
                                                                By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-last-modified"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Last Modified', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-last-modified" class="form-check-label">Last
                                                                Modified</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk"
                                                                id="col-last-modified-by" class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Last Modified By', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-last-modified-by"
                                                                class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-customer"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Customer', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-customer"
                                                                class="form-check-label">Customer</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-phone"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Phone', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-phone"
                                                                class="form-check-label">Phone</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-phone-numbers"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Phone Numbers', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-phone-numbers"
                                                                class="form-check-label">Phone Numbers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-email"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Email', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-email"
                                                                class="form-check-label">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-full-name"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Full Name', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-full-name" class="form-check-label">Full
                                                                Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk"
                                                                id="col-billing-address" class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Billing Address', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-billing-address"
                                                                class="form-check-label">Billing Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk"
                                                                id="col-shipping-address" class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Shipping Address', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-shipping-address"
                                                                class="form-check-label">Shipping Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-company-name"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Company Name', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-company-name"
                                                                class="form-check-label">Company Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-sales-rep"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Sales Rep', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-sales-rep" class="form-check-label">Sales
                                                                Rep</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-po-number"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('P.O. Number', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-po-number" class="form-check-label">P.O.
                                                                Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-ship-via"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Ship Via', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-ship-via" class="form-check-label">Ship
                                                                Via</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-terms"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Terms', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-terms"
                                                                class="form-check-label">Terms</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk"
                                                                id="col-client-message" class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Client/Vendor Message', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-client-message"
                                                                class="form-check-label">Client/Vendor Message</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-due-date"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Due Date', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-due-date" class="form-check-label">Due
                                                                Date</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-past-due"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Past Due', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-past-due" class="form-check-label">Past
                                                                Due</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-sent"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Sent', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-sent" class="form-check-label">Sent</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk"
                                                                id="col-delivery-address" class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Delivery Address', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-delivery-address"
                                                                class="form-check-label">Delivery Address</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-amount"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Amount', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-amount"
                                                                class="form-check-label">Amount</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-open-balance"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Open Balance', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-open-balance" class="form-check-label">Open
                                                                Balance</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-memo-desc"
                                                                class="form-check-input"
                                                                <?php echo isset($columns) && in_array('Memo/Description', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-memo-desc"
                                                                class="form-check-label">Memo/Description</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="row mb-4">
                                        <div class="col-lg-12 headerInfo">
                                            <img id="businessLogo"
                                                class="<?php echo ($reportSettings->show_logo == 0 || !isset($reportSettings->show_logo)) ? 'd-none-custom' : ''; ?>"
                                                src="<?php echo base_url('uploads/users/business_profile/')."$companyInfo->id/$companyInfo->business_image"; ?>">
                                            <div class="reportTitleInfo">
                                                <h3 id="businessName">
                                                    <?php echo ($reportSettings->company_name) ? $reportSettings->company_name : strtoupper($companyInfo->business_name); ?>
                                                </h3>
                                                <h5><strong
                                                        id="reportName"><?php echo $reportSettings->title; ?></strong>
                                                </h5>
                                                <h5><small id="reportDate">As of <?php echo date('F d, Y'); ?></small>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <div class="table-wrapper">
                                    <?php
                                    $tableID = 'accounts_receivable_aging_detail_table';
$reportCategory = 'accounts_receivable_aging_detail_list';
?>
                                    <table  class="nsm-table grid-mb">
                                        <thead>
                                            <tr>
                                                <?php if (isset($columns) && $total_index === 0) { ?>
                                                <td data-name=""></td>
                                                <?php } ?>
                                                <td data-name="Date"
                                                    <?php echo isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    DATE</td>
                                                <td data-name="Transaction Type"
                                                    <?php echo isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''; ?>>
                                                    TRANSACTION TYPE</td>
                                                <td data-name="Num"
                                                    <?php echo isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''; ?>>
                                                    NUM</td>
                                                <td data-name="Create Date"
                                                    <?php echo isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    CREATE DATE</td>
                                                <td data-name="Created By"
                                                    <?php echo isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''; ?>>
                                                    CREATED BY</td>
                                                <td data-name="Last Modified"
                                                    <?php echo isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''; ?>>
                                                    LAST MODIFIED</td>
                                                <td data-name="Last Modified By"
                                                    <?php echo isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''; ?>>
                                                    LAST MODIFIED BY</td>
                                                <td data-name="Customer"
                                                    <?php echo isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''; ?>>
                                                    CUSTOMER</td>
                                                <td data-name="Phone"
                                                    <?php echo isset($columns) && !in_array('Phone', $columns) ? 'style="display: none"' : ''; ?>>
                                                    PHONE</td>
                                                <td data-name="Phone Numbers"
                                                    <?php echo isset($columns) && !in_array('Phone Numbers', $columns) ? 'style="display: none"' : ''; ?>>
                                                    PHONE NUMBERS</td>
                                                <td data-name="Email"
                                                    <?php echo isset($columns) && !in_array('Email', $columns) ? 'style="display: none"' : ''; ?>>
                                                    EMAIL</td>
                                                <td data-name="Full Name"
                                                    <?php echo isset($columns) && !in_array('Full Name', $columns) ? 'style="display: none"' : ''; ?>>
                                                    FULL NAME</td>
                                                <td data-name="Billing Address"
                                                    <?php echo isset($columns) && !in_array('Billing Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    BILLING ADDRESS</td>
                                                <td data-name="Shipping Address"
                                                    <?php echo isset($columns) && !in_array('Shipping Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    SHIPPING ADDRESS</td>
                                                <td data-name="Company Name"
                                                    <?php echo isset($columns) && !in_array('Company Name', $columns) ? 'style="display: none"' : ''; ?>>
                                                    COMPANY NAME</td>
                                                <td data-name="Sales Rep"
                                                    <?php echo isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''; ?>>
                                                    SALES REP</td>
                                                <td data-name="P.O. Number"
                                                    <?php echo isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''; ?>>
                                                    P.O. NUMBER</td>
                                                <td data-name="Ship Via"
                                                    <?php echo isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''; ?>>
                                                    SHIP VIA</td>
                                                <td data-name="Terms"
                                                    <?php echo isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''; ?>>
                                                    TERMS</td>
                                                <td data-name="Client/Vendor Message"
                                                    <?php echo isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''; ?>>
                                                    CLIENT/VENDOR MESSAGE</td>
                                                <td data-name="Due Date"
                                                    <?php echo isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    DUE DATE</td>
                                                <td data-name="Past Due"
                                                    <?php echo isset($columns) && !in_array('Past Due', $columns) ? 'style="display: none"' : ''; ?>>
                                                    PAST DUE</td>
                                                <td data-name="Sent"
                                                    <?php echo isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''; ?>>
                                                    SENT</td>
                                                <td data-name="Delivery Address"
                                                    <?php echo isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    DELIVERY ADDRESS</td>
                                                <td data-name="Amount"
                                                    <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>>
                                                    AMOUNT</td>
                                                <td data-name="Open Balance"
                                                    <?php echo isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''; ?>>
                                                    OPEN BALANCE</td>
                                                <td data-name="Memo/Description"
                                                    <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>>
                                                    MEMO/DESCRIPTION</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($transactions) > 0) { ?>
                                            <?php foreach ($transactions as $index => $transaction) { ?>
                                            <tr data-bs-toggle="collapse"
                                                data-bs-target="#accordion-<?php echo $index; ?>"
                                                class="clickable collapse-row collapsed">
                                                <td colspan="<?php echo isset($columns) ? $total_index : '24'; ?>"><i
                                                        class="bx bx-fw bx-caret-right"></i>
                                                    <b><?php echo $transaction['name']; ?></b>
                                                </td>
                                                <td data-name="Amount"
                                                    <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <b><?php echo $transaction['amount_total']; ?></b>
                                                </td>
                                                <td data-name="Open Balance"
                                                    <?php echo isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <b><?php echo $transaction['open_balance_total']; ?></b>
                                                </td>
                                                <td data-name="Memo/Description"
                                                    <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>>
                                                </td>
                                            </tr>
                                        <tbody class="transaction-content clickable collapse-row collapse"
                                            id="accordion-<?php echo $index; ?>">
                                            <?php foreach ($transaction['transactions'] as $tran) { ?>
                                            <tr>
                                                <?php if (isset($columns) && $total_index === 0) { ?>
                                                <td data-name=""></td>
                                                <?php } ?>
                                                <td data-name="Date"
                                                    <?php echo isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['date'] != '' || $tran['date'] != null ? $tran['date'] : '---'; ?>
                                                </td>
                                                <td data-name="Transaction Type"
                                                    <?php echo isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['transaction_type'] != '' || $tran['transaction_type'] != null ? $tran['transaction_type'] : '---'; ?>
                                                </td>
                                                <td data-name="Num"
                                                    <?php echo isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['num'] != '' || $tran['num'] != null ? $tran['num'] : '---'; ?>
                                                </td>
                                                <td data-name="Create Date"
                                                    <?php echo isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['create_date'] != '' || $tran['create_date'] != null ? $tran['create_date'] : '---'; ?>
                                                </td>
                                                <td data-name="Created By"
                                                    <?php echo isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['created_by'] != '' || $tran['created_by'] != null ? $tran['created_by'] : '---'; ?>
                                                </td>
                                                <td data-name="Last Modified"
                                                    <?php echo isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['last_modified'] != '' || $tran['last_modified'] != null ? $tran['last_modified'] : '---'; ?>
                                                </td>
                                                <td data-name="Last Modified By"
                                                    <?php echo isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['last_modified_by'] != '' || $tran['last_modified_by'] != null ? $tran['last_modified_by'] : '---'; ?>
                                                </td>
                                                <td data-name="Customer"
                                                    <?php echo isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['customer'] != '' || $tran['customer'] != null ? $tran['customer'] : '---'; ?>
                                                </td>
                                                <td data-name="Phone"
                                                    <?php echo isset($columns) && !in_array('Phone', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['phone'] != '' || $tran['phone'] != null ? $tran['phone'] : '---'; ?>
                                                </td>
                                                <td data-name="Phone Numbers"
                                                    <?php echo isset($columns) && !in_array('Phone Numbers', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['phone_numbers'] != '' || $tran['phone_numbers'] != null ? $tran['phone_numbers'] : '---'; ?>
                                                </td>
                                                <td data-name="Email"
                                                    <?php echo isset($columns) && !in_array('Email', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['email'] != '' || $tran['email'] != null ? $tran['email'] : '---'; ?>
                                                </td>
                                                <td data-name="Full Name"
                                                    <?php echo isset($columns) && !in_array('Full Name', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['full_name'] != '' || $tran['full_name'] != null ? $tran['full_name'] : '---'; ?>
                                                </td>
                                                <td data-name="Billing Address"
                                                    <?php echo isset($columns) && !in_array('Billing Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['billing_address'] != '' || $tran['billing_address'] != null ? $tran['billing_address'] : '---'; ?>
                                                </td>
                                                <td data-name="Shipping Address"
                                                    <?php echo isset($columns) && !in_array('Shipping Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['shipping_address'] != '' || $tran['shipping_address'] != null ? $tran['shipping_address'] : '---'; ?>
                                                </td>
                                                <td data-name="Company Name"
                                                    <?php echo isset($columns) && !in_array('Company Name', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['company_name'] != '' || $tran['company_name'] != null ? $tran['company_name'] : '---'; ?>
                                                </td>
                                                <td data-name="Sales Rep"
                                                    <?php echo isset($columns) && !in_array('Sales Rep', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['sales_rep'] != '' || $tran['sales_rep'] != null ? $tran['sales_rep'] : '---'; ?>
                                                </td>
                                                <td data-name="P.O. Number"
                                                    <?php echo isset($columns) && !in_array('P.O. Number', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['po_number'] != '' || $tran['po_number'] != null ? $tran['po_number'] : '---'; ?>
                                                </td>
                                                <td data-name="Ship Via"
                                                    <?php echo isset($columns) && !in_array('Ship Via', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['ship_via'] != '' || $tran['ship_via'] != null ? $tran['ship_via'] : '---'; ?>
                                                </td>
                                                <td data-name="Terms"
                                                    <?php echo isset($columns) && !in_array('Terms', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['terms'] != '' || $tran['terms'] != null ? $tran['terms'] : '---'; ?>
                                                </td>
                                                <td data-name="Client/Vendor Message"
                                                    <?php echo isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['client_vendor_message'] != '' || $tran['client_vendor_message'] != null ? $tran['client_vendor_message'] : '---'; ?>
                                                </td>
                                                <td data-name="Due Date"
                                                    <?php echo isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['due_date'] != '' || $tran['due_date'] != null ? $tran['due_date'] : '---'; ?>
                                                </td>
                                                <td data-name="Past Due"
                                                    <?php echo isset($columns) && !in_array('Past Due', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['past_due'] != '' || $tran['past_due'] != null ? $tran['past_due'] : '---'; ?>
                                                </td>
                                                <td data-name="Sent"
                                                    <?php echo isset($columns) && !in_array('Sent', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['sent'] != '' || $tran['sent'] != null ? $tran['sent'] : '---'; ?>
                                                </td>
                                                <td data-name="Delivery Address"
                                                    <?php echo isset($columns) && !in_array('Delivery Address', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['delivery_address'] != '' || $tran['delivery_address'] != null ? $tran['delivery_address'] : '---'; ?>
                                                </td>
                                                <td data-name="Amount"
                                                    <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['amount'] != '' || $tran['amount'] != null ? $tran['amount'] : '---'; ?>
                                                </td>
                                                <td data-name="Open Balance"
                                                    <?php echo isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['open_balance'] != '' || $tran['open_balance'] != null ? $tran['open_balance'] : '---'; ?>
                                                </td>
                                                <td data-name="Memo/Description"
                                                    <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <?php echo $tran['memo_description'] != '' || $tran['memo_description'] != null ? $tran['memo_description'] : '---'; ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <tr class="clickable collapse-row collapse group-total"
                                                id="accordion-<?php echo $index; ?>">
                                                <td colspan="<?php echo isset($columns) ? $total_index : '24'; ?>">
                                                    <b>Total for
                                                        <?php echo $transaction['name']; ?></b></td>
                                                <td data-name="Amount"
                                                    <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <b><?php echo $transaction['amount_total']; ?></b>
                                                </td>
                                                <td data-name="Open Balance"
                                                    <?php echo isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''; ?>>
                                                    <b><?php echo $transaction['open_balance_total']; ?></b>
                                                </td>
                                                <td data-name="Memo/Description"
                                                    <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <?php } ?>
                                        <?php } else { ?>
                                        <tr>
                                            <td colspan="27">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="row">
                                    <div class="col-12 d-none" id="report-note-form">
                                        <textarea name="report_note" id="report-note" maxlength="4000"
                                            class="nsm-field form-control mb-3"
                                            placeholder="Add notes or include additional info with your report"><?php echo !is_null($reportNote) ? str_replace('<br />', '', $reportNote->notes) : ''; ?></textarea>
                                        <label for="report-note" class="noteCharMax">4000 characters max</label>
                                        <button class="nsm-button primary float-end" id="save-note">Save</button>
                                        <button class="nsm-button float-end" id="cancel-note-update">Cancel</button>
                                    </div>
                                    <div class="col-12 <?php echo is_null($reportNote) ? 'd-none' : ''; ?>"
                                        id="report-note-cont">
                                        <?php if (!is_null($reportNote) && !empty($reportNote->notes)) { ?>
                                        <p class="m-0"><b>Note</b></p>
                                        <span><?php echo str_replace("\n", '<br />', $reportNote->notes); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row footerInfo">
                                <span class=""><?php echo date('l, F j, Y h:i A eP'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Report Settings</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button"
                    name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="reportSettingsForm" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label class="mb-1 fw-xnormal">Logo</label>
                                    <select id="showHideLogo" name="showHideLogo" class="nsm-field form-select">
                                        <?php if (isset($reportSettings->show_logo)) { ?>
                                        <option value="1"
                                            <?php echo (isset($reportSettings->show_logo) && $reportSettings->show_logo == 1) ? 'selected' : ''; ?>>
                                            Show</option>
                                        <option value="0"
                                            <?php echo (isset($reportSettings->show_logo) && $reportSettings->show_logo == 0) ? 'selected' : ''; ?>>
                                            Hide</option>
                                        <?php } else { ?>
                                        <option value="1" selected>Show</option>
                                        <option value="0">Hide</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input
                                                class="form-check-input mt-0 enableDisableBusinessName" type="checkbox"
                                                <?php echo (isset($reportSettings->show_company_name) && $reportSettings->show_company_name == 1) ? 'checked' : ''; ?>>
                                        </div>
                                        <input id="company_name" class="nsm-field form-control" type="text"
                                            name="company_name"
                                            value="<?php echo (!empty($reportSettings->company_name)) ? $reportSettings->company_name : strtoupper($companyInfo->business_name); ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input
                                                class="form-check-input mt-0 enableDisableReportName" type="checkbox"
                                                <?php echo (isset($reportSettings->show_title) && $reportSettings->show_title == 1) ? 'checked' : ''; ?>>
                                        </div>
                                        <input id="report_name" class="nsm-field form-control" type="text"
                                            name="report_name"
                                            value="<?php echo (!empty($reportSettings->title)) ? $reportSettings->title : $page->title; ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="mb-1 fw-xnormal">Header Align</label>
                                    <select name="header_align" id="header-align" class="nsm-field form-select">
                                        <option value="C"
                                            <?php echo ($reportSettings->header_align == 'C') ? 'selected' : ''; ?>>
                                            Center</option>
                                        <option value="L"
                                            <?php echo ($reportSettings->header_align == 'L') ? 'selected' : ''; ?>>Left
                                        </option>
                                        <option value="R"
                                            <?php echo ($reportSettings->header_align == 'R') ? 'selected' : ''; ?>>
                                            Right</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="mb-1 fw-xnormal">Footer Align</label>
                                    <select name="footer_align" id="footer-align" class="nsm-field form-select">
                                        <option value="C"
                                            <?php echo ($reportSettings->footer_align == 'C') ? 'selected' : ''; ?>>
                                            Center</option>
                                        <option value="L"
                                            <?php echo ($reportSettings->footer_align == 'L') ? 'selected' : ''; ?>>Left
                                        </option>
                                        <option value="R"
                                            <?php echo ($reportSettings->footer_align == 'R') ? 'selected' : ''; ?>>
                                            Right</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="mb-1 fw-xnormal">Row Size</label>
                                    <select name="page_size" id="page-size" class="nsm-field form-select">
                                        <option value="9999"
                                            <?php echo ($reportSettings->page_size == '9999') ? 'selected' : ''; ?>>All
                                        </option>
                                        <option value="10"
                                            <?php echo ($reportSettings->page_size == '10') ? 'selected' : ''; ?>>10
                                        </option>
                                        <option value="25"
                                            <?php echo ($reportSettings->page_size == '25') ? 'selected' : ''; ?>>25
                                        </option>
                                        <option value="50"
                                            <?php echo ($reportSettings->page_size == '50') ? 'selected' : ''; ?>>50
                                        </option>
                                        <option value="100"
                                            <?php echo ($reportSettings->page_size == '100') ? 'selected' : ''; ?>>100
                                        </option>
                                        <option value="500"
                                            <?php echo ($reportSettings->page_size == '500') ? 'selected' : ''; ?>>500
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                <option value="id"
                                                    <?php echo ($reportSettings->sort_by == 'id') ? 'selected' : ''; ?>>
                                                    Default</option>
                                                <option value="vendor"
                                                    <?php echo ($reportSettings->sort_by == 'vendor') ? 'selected' : ''; ?>>
                                                    Vendor</option>
                                                <option value="phone_numbers"
                                                    <?php echo ($reportSettings->sort_by == 'phone_numbers') ? 'selected' : ''; ?>>
                                                    Phone Numbers</option>
                                                <option value="email"
                                                    <?php echo ($reportSettings->sort_by == 'email') ? 'selected' : ''; ?>>
                                                    Email</option>
                                                <option value="fullname"
                                                    <?php echo ($reportSettings->sort_by == 'fullname') ? 'selected' : ''; ?>>
                                                    Full Name</option>
                                                <option value="address"
                                                    <?php echo ($reportSettings->sort_by == 'address') ? 'selected' : ''; ?>>
                                                    Address</option>
                                                <option value="account_number"
                                                    <?php echo ($reportSettings->sort_by == 'account_number') ? 'selected' : ''; ?>>
                                                    Account #</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select">
                                                <option value="DESC"
                                                    <?php echo ($reportSettings->sort_order == 'DESC') ? 'selected' : ''; ?>>
                                                    DESC</option>
                                                <option value="ASC"
                                                    <?php echo ($reportSettings->sort_order == 'ASC') ? 'selected' : ''; ?>>
                                                    ASC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary settingsApplyButton">Apply</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- START: EMAIL REPORT MODAL -->
<div class="modal fade" id="emailReportModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="sendEmailForm">
                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <h6>To</h6>
                                <input id="emailTo" class="form-control" type="email" placeholder="Send to" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>CC</h6>
                                <input id="emailCC" class="form-control" type="email" placeholder="Carbon Copy">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <input id="emailSubject" class="form-control" type="text" value="<?php echo $page->title; ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <div id="emailBody">Hello,<br><br>Attached here is the <?php echo $page->title; ?> from <?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : ''; ?>.<br><br>Regards,<br><?php echo "$users->FName $users->LName"; ?></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Attachment</h6>
                                <div class="row">
                                    <div class="input-group borderRadius0 pdfAttachment">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox" type="checkbox"></div>
                                        <input id="pdfReportFilename" class="form-control" type="text" value="<?php echo $page->title; ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".pdf" style="max-width: 60px;">
                                    </div>
                                    <div class="input-group borderRadius0">
                                        <div class="input-group-text"><input class="form-check-input mt-0 xlsxAttachmentCheckbox" type="checkbox"></div>
                                        <input id="xlsxReportFileName" class="form-control" type="text" value="<?php echo $page->title; ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".xlsx" style="max-width: 60px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="emailCloseModal" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary sendEmail"><span class="sendEmail_Loader"></span>Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const reportTitleElem = document.getElementById('reportTitle');
    const reportTable = document.getElementById('reports-table');
    const compactDisplayCheckbox = document.getElementById('display');
    const applyButton = document.querySelector('.settingsApplyButton');

    const applyCompactStyle = () => {
        if (compactDisplayCheckbox.checked) {
            reportTable.classList.add('compact-table');
            localStorage.setItem('compactState', 'true');
        } else {
            reportTable.classList.remove('compact-table');
            localStorage.setItem('compactState', 'false');
        }
    };

    const loadCompactState = () => {
        const compactState = localStorage.getItem('compactState');
        if (compactState === 'true') {
            compactDisplayCheckbox.checked = true;
            reportTable.classList.add('compact-table');
        } else {
            compactDisplayCheckbox.checked = false;
            reportTable.classList.remove('compact-table');
        }
    };

    loadCompactState();

    compactDisplayCheckbox.addEventListener('change', applyCompactStyle);

    const setLoading = (isLoading) => {
        if (isLoading) {
            applyButton.textContent = 'Applying Changes...';
            applyButton.disabled = true;
        } else {
            applyButton.textContent = 'Apply';
            applyButton.disabled = false;
        }
    };

    const saveSettings = () => {
        setLoading(true);

        const newTitle = reportTitleElem.value;
        const isCompact = compactDisplayCheckbox.checked ? 1 : 0;

        $.ajax({
            url: base_url + 'accounting/reports/_update_title',
            type: 'POST',
            data: {
                report_id: 17,
                title: newTitle,
                compact: isCompact
            },
            dataType: 'json',
            success: function(response) {
                setLoading(false);

                if (response.is_success === 1) {
                    document.querySelector('.company-name').textContent = newTitle;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: 'An unknown error occurred.'
                    });
                }
            },
            error: function(xhr, status, error) {
                setLoading(false);

                console.error('AJAX Error:', status, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'An error occurred while making the AJAX request. Please try again.'
                });
            },
        });
    };

    document.getElementById('reportSettingsForm').addEventListener('submit', function(event) {
        event.preventDefault();
        saveSettings();
    });
});
</script> -->
<?php include viewPath('accounting/reports/reports_assets/report_js'); ?>
<?php include viewPath('v2/includes/footer'); ?>