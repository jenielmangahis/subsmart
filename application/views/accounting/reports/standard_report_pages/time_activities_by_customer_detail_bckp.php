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
                                        <label for="filter-activity-date">Time Activity Date</label>
                                        <select class="nsm-field form-select" name="filter_activity_date" id="filter-activity-date">
                                            <option value="all-dates" <?php echo $filter_date === 'all-dates' ? 'selected' : ''; ?>>All Dates</option>
                                            <option value="custom" <?php echo $filter_date === 'custom' ? 'selected' : ''; ?>>Custom</option>
                                            <option value="today" <?php echo $filter_date === 'today' ? 'selected' : ''; ?>>Today</option>
                                            <option value="this-week" <?php echo $filter_date === 'this-week' ? 'selected' : ''; ?>>This Week</option>
                                            <option value="this-week-to-date" <?php echo $filter_date === 'this-week-to-date' ? 'selected' : ''; ?>>This Week-to-date</option>
                                            <option value="this-month" <?php echo $filter_date === 'this-month' ? 'selected' : ''; ?>>This Month</option>
                                            <option value="this-month-to-date" <?php echo empty($filter_date) || $filter_date === 'this-month-to-date' ? 'selected' : ''; ?>>This Month-to-date</option>
                                            <option value="this-quarter" <?php echo $filter_date === 'this-quarter' ? 'selected' : ''; ?>>This Quarter</option>
                                            <option value="this-quarter-to-date" <?php echo $filter_date === 'this-quarter-to-date' ? 'selected' : ''; ?>>This Quarter-to-date</option>
                                            <option value="this-year" <?php echo $filter_date === 'this-year' ? 'selected' : ''; ?>>This Year</option>
                                            <option value="this-year-to-date" <?php echo $filter_date === 'this-year-to-date' ? 'selected' : ''; ?>>This Year-to-date</option>
                                            <option value="this-year-to-last-month" <?php echo $filter_date === 'this-year-to-last-month' ? 'selected' : ''; ?>>This Year-to-last-month</option>
                                            <option value="yesterday" <?php echo $filter_date === 'yesterday' ? 'selected' : ''; ?>>Yesterday</option>
                                            <option value="recent" <?php echo $filter_date === 'recent' ? 'selected' : ''; ?>>Recent</option>
                                            <option value="last-week" <?php echo $filter_date === 'last-week' ? 'selected' : ''; ?>>Last Week</option>
                                            <option value="last-week-to-date" <?php echo $filter_date === 'last-week-to-date' ? 'selected' : ''; ?>>Last Week-to-date</option>
                                            <option value="last-month" <?php echo $filter_date === 'last-month' ? 'selected' : ''; ?>>Last Month</option>
                                            <option value="last-month-to-date" <?php echo $filter_date === 'last-month-to-date' ? 'selected' : ''; ?>>Last Month-to-date</option>
                                            <option value="last-quarter" <?php echo $filter_date === 'last-quarter' ? 'selected' : ''; ?>>Last Quarter</option>
                                            <option value="last-quarter-to-date" <?php echo $filter_date === 'last-quarter-to-date' ? 'selected' : ''; ?>>Last Quarter-to-date</option>
                                            <option value="last-year" <?php echo $filter_date === 'last-year' ? 'selected' : ''; ?>>Last Year</option>
                                            <option value="last-year-to-date" <?php echo $filter_date === 'last-year-to-date' ? 'selected' : ''; ?>>Last Year-to-date</option>
                                            <option value="since-30-days-ago" <?php echo $filter_date === 'since-30-days-ago' ? 'selected' : ''; ?>>Since 30 Days Ago</option>
                                            <option value="since-60-days-ago" <?php echo $filter_date === 'since-60-days-ago' ? 'selected' : ''; ?>>Since 60 Days Ago</option>
                                            <option value="since-90-days-ago" <?php echo $filter_date === 'since-90-days-ago' ? 'selected' : ''; ?>>Since 90 Days Ago</option>
                                            <option value="since-365-days-ago" <?php echo $filter_date === 'since-365-days-ago' ? 'selected' : ''; ?>>Since 365 Days Ago</option>
                                            <option value="next-week" <?php echo $filter_date === 'next-week' ? 'selected' : ''; ?>>Next Week</option>
                                            <option value="next-4-weeks" <?php echo $filter_date === 'next-4-weeks' ? 'selected' : ''; ?>>Next 4 Weeks</option>
                                            <option value="next-month" <?php echo $filter_date === 'next-month' ? 'selected' : ''; ?>>Next Month</option>
                                            <option value="next-quarter" <?php echo $filter_date === 'next-quarter' ? 'selected' : ''; ?>>Next Quarter</option>
                                            <option value="next-year" <?php echo $filter_date === 'next-year' ? 'selected' : ''; ?>>Next Year</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if (!empty($filter_date) && $filter_date !== 'all-dates' || empty($filter_date)) { ?>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-activity-date-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?php echo $start_date; ?>" id="filter-activity-date-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-activity-date-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?php echo $end_date; ?>" id="filter-activity-date-to">
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="rows-columns"><b>Rows/Columns</b></label>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        <label for="group-by">Group by</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select id="group-by" class="form-control nsm-field">
                                            <option value="none" <?php echo $group_by === 'none' ? 'selected' : ''; ?>>None</option>
                                            <option value="customer" <?php echo empty($group_by) || $group_by === 'customer' ? 'selected' : ''; ?>>Customer</option>
                                            <option value="customer-type" <?php echo $group_by === 'customer-type' ? 'selected' : ''; ?>>Customer Type</option>
                                            <option value="employee" <?php echo $group_by === 'employee' ? 'selected' : ''; ?>>Employee</option>
                                            <option value="product-service" <?php echo $group_by === 'product-service' ? 'selected' : ''; ?>>Product/Service</option>
                                            <option value="day" <?php echo $group_by === 'day' ? 'selected' : ''; ?>>Day</option>
                                            <option value="week" <?php echo $group_by === 'week' ? 'selected' : ''; ?>>Week</option>
                                            <option value="work-week" <?php echo $group_by === 'work-week' ? 'selected' : ''; ?>>Work Week</option>
                                            <option value="month" <?php echo $group_by === 'month' ? 'selected' : ''; ?>>Month</option>
                                            <option value="quarter" <?php echo $group_by === 'quarter' ? 'selected' : ''; ?>>Quarter</option>
                                            <option value="year" <?php echo $group_by === 'year' ? 'selected' : ''; ?>>Year</option>
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
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Time Activities by Customer Detail">
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
                                                    <button class="nsm-button" id="cancel-new-custom-report-group">Cancel</button>
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
                                                    <option value="default" <?php echo empty($sort_by) || $sort_by === 'default' ? 'selected' : ''; ?>>Default</option>
                                                    <option value="activity-date" <?php echo $sort_by === 'activity-date' ? 'selected' : ''; ?>>Activity Date</option>
                                                    <option value="billable" <?php echo $sort_by === 'billable' ? 'selected' : ''; ?>>Billable</option>
                                                    <option value="break" <?php echo $sort_by === 'break' ? 'selected' : ''; ?>>Break</option>
                                                    <option value="create-date" <?php echo $sort_by === 'create-date' ? 'selected' : ''; ?>>Create Date</option>
                                                    <option value="created-by" <?php echo $sort_by === 'created-by' ? 'selected' : ''; ?>>Created By</option>
                                                    <option value="customer" <?php echo $sort_by === 'customer' ? 'selected' : ''; ?>>Customer</option>
                                                    <option value="duration" <?php echo $sort_by === 'duration' ? 'selected' : ''; ?>>Duration</option>
                                                    <option value="employee" <?php echo $sort_by === 'employee' ? 'selected' : ''; ?>>Employee</option>
                                                    <option value="end-time" <?php echo $sort_by === 'end-time' ? 'selected' : ''; ?>>End Time</option>
                                                    <option value="invoice-date" <?php echo $sort_by === 'invoice-date' ? 'selected' : ''; ?>>Invoice Date</option>
                                                    <option value="last-modified" <?php echo $sort_by === 'last-modified' ? 'selected' : ''; ?>>Last Modified</option>
                                                    <option value="last-modified-by" <?php echo $sort_by === 'last-modified-by' ? 'selected' : ''; ?>>Last Modified By</option>
                                                    <option value="memo-desc" <?php echo $sort_by === 'memo-desc' ? 'selected' : ''; ?>>Memo/Description</option>
                                                    <option value="product-service" <?php echo $sort_by === 'product-service' ? 'selected' : ''; ?>>Product/Service</option>
                                                    <option value="rates" <?php echo $sort_by === 'rates' ? 'selected' : ''; ?>>Rates</option>
                                                    <option value="start-time" <?php echo $sort_by === 'start-time' ? 'selected' : ''; ?>>Start Time</option>
                                                    <option value="taxable" <?php echo $sort_by === 'taxable' ? 'selected' : ''; ?>>Taxable</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" value="asc" <?php echo !isset($sort_in) ? 'checked' : ''; ?>>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input" value="desc" <?php echo isset($sort_in) && $sort_in === 'desc' ? 'checked' : ''; ?>>
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button" id="<?php echo is_null($reportNote) ? 'add-notes' : 'edit-notes'; ?>">
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
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#email_report_modal">
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
                                                            <input type="checkbox" name="col_chk" id="col-activity-date" class="form-check-input" <?php echo isset($columns) && in_array('Activity Date', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-activity-date" class="form-check-label">Activity Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-create-date" class="form-check-input" <?php echo isset($columns) && in_array('Create Date', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-create-date" class="form-check-label">Create Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-created-by" class="form-check-input" <?php echo isset($columns) && in_array('Created By', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-created-by" class="form-check-label">Created By</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-last-modified" class="form-check-input" <?php echo isset($columns) && in_array('Last Modified', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-last-modified" class="form-check-label">Last Modified</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-last-modified-by" class="form-check-input" <?php echo isset($columns) && in_array('Last Modified By', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-last-modified-by" class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-customer" class="form-check-input" <?php echo isset($columns) && in_array('Customer', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-customer" class="form-check-label">Customer</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-employee" class="form-check-input" <?php echo isset($columns) && in_array('Employee', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-employee" class="form-check-label">Employee</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-product-service" class="form-check-input" <?php echo isset($columns) && in_array('Product/Service', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-product-service" class="form-check-label">Product/Service</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-memo-desc" class="form-check-input" <?php echo isset($columns) && in_array('Memo/Description', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-memo-desc" class="form-check-label">Memo/Description</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-rates" class="form-check-input" <?php echo isset($columns) && in_array('Rates', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-rates" class="form-check-label">Rates</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-duration" class="form-check-input" <?php echo isset($columns) && in_array('Duration', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-duration" class="form-check-label">Duration</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-start-time" class="form-check-input" <?php echo isset($columns) && in_array('Start Time', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-start-time" class="form-check-label">Start Time</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-end-time" class="form-check-input" <?php echo isset($columns) && in_array('End Time', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-end-time" class="form-check-label">End Time</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-break" class="form-check-input" <?php echo isset($columns) && in_array('Break', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-break" class="form-check-label">Break</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-taxable" class="form-check-input" <?php echo isset($columns) && in_array('Taxable', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-taxable" class="form-check-label">Taxable</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-billable" class="form-check-input" <?php echo isset($columns) && in_array('Billable', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-billable" class="form-check-label">Billable</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-invoice-date" class="form-check-input" <?php echo isset($columns) && in_array('Invoice Date', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-invoice-date" class="form-check-label">Invoice Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-amount" class="form-check-input" <?php echo isset($columns) && in_array('Amount', $columns) || !isset($columns) ? 'checked' : ''; ?>>
                                                            <label for="col-amount" class="form-check-label">Amount</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row <?php echo !isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment; ?>">
                                    <?php if (isset($show_logo)) { ?>
                                    <!-- <div class="position-absolute">
                                        <img src="<?php echo getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px"/>
                                    </div> -->
                                    <?php } ?>
                                    <?php if (!isset($show_company_name)) { ?>
                                    <div class="col-12 grid-mb">
                                        <h4 class="fw-bold"><span class="company-name"><?php echo $company_name; ?></span></h4>
                                    </div>
                                    <?php } ?>
                                    <?php if (!isset($show_report_title)) { ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0 fw-bold"><?php echo $report_title; ?></p>
                                    </div>
                                    <?php } ?>
                                    <?php if (!isset($show_report_period)) { ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0">Activity: <?php echo $report_period; ?></p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Activity Date" >ACTIVITY DATE</td>
                                            <td data-name="Customer" >CUSTOMER</td>
                                            <td data-name="Product/Service" >PRODUCT/SERVICE</td>
                                            <td data-name="Memo/Description" >MEMO/DESCRIPTION</td>
                                            <td data-name="Rates" >RATES</td>
                                            <td data-name="Duration" >DURATION</td>
                                            <td data-name="Billable" >BILLABLE</td>
                                            <td data-name="Amount" >AMOUNT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($activities) > 0) { ?>
                                        <?php foreach ($activities as $index => $activity) { ?>
                                        <?php if ($group_by === 'none') { ?>
                                        <tr>
                                            <td data-name="Activity Date" <?php echo isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['activity_date']; ?></td>
                                            <td data-name="Create Date" <?php echo isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''; ?>><?php echo date('m/d/Y H:i:s A', strtotime($activity['create_date'])); ?></td>
                                            <td data-name="Created By" <?php echo isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['created_by']; ?></td>
                                            <td data-name="Last Modified" <?php echo isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''; ?>><?php echo date('m/d/Y H:i:s A', strtotime($activity['last_modified'])); ?></td>
                                            <td data-name="Last Modified By" <?php echo isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['last_modified_by']; ?></td>
                                            <td data-name="Customer" <?php echo isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['customer']; ?></td>
                                            <td data-name="Employee" <?php echo isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['employee']; ?></td>
                                            <td data-name="Product/Service" <?php echo isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['product_service']; ?></td>
                                            <td data-name="Memo/Description" <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['memo_desc']; ?></td>
                                            <td data-name="Rates" <?php echo isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['rates']; ?></td>
                                            <td data-name="Duration" <?php echo isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['duration']; ?></td>
                                            <td data-name="Start Time" <?php echo isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['start_time']; ?></td>
                                            <td data-name="End Time" <?php echo isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['end_time']; ?></td>
                                            <td data-name="Break" <?php echo isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['break']; ?></td>
                                            <td data-name="Taxable" <?php echo isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['taxable']; ?></td>
                                            <td data-name="Billable" <?php echo isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['billable']; ?></td>
                                            <td data-name="Invoice Date" <?php echo isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['invoice_date']; ?></td>
                                            <td data-name="Amount" <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>><?php echo $activity['amount']; ?></td>
                                        </tr>
                                        <?php } else { ?>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?php echo $index; ?>" class="clickable collapse-row collapsed">
                                            <td colspan="<?php echo isset($columns) ? $total_index : '10'; ?>"><i class="bx bx-fw bx-caret-right"></i> <b><?php echo $activity['name']; ?></b></td>
                                            <td data-name="Duration"><b><?php echo $activity['duration_total']; ?></b></td>
                                            <td data-name="Start Time"></td>
                                            <td data-name="End Time"></td>
                                            <td data-name="Break"></td>
                                            <td data-name="Taxable"></td>
                                            <td data-name="Billable"></td>
                                            <td data-name="Invoice Date"></td>
                                            <td data-name="Amount"><b><?php echo $activity['amount_total']; ?></b></td>
                                        </tr>
                                        <?php foreach ($activity['activities'] as $act) { ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?php echo $index; ?>">
                                            <?php if (isset($columns) && $total_index === 0 && $group_by !== 'none') { ?>
                                            <td data-name=""></td>
                                            <?php } ?>
                                            <td data-name="Activity Date" <?php echo isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['activity_date']; ?></td>
                                            <td data-name="Create Date" <?php echo isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''; ?>><?php echo date('m/d/Y H:i:s A', strtotime($act['create_date'])); ?></td>
                                            <td data-name="Created By" <?php echo isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['created_by']; ?></td>
                                            <td data-name="Last Modified" <?php echo isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''; ?>><?php echo date('m/d/Y H:i:s A', strtotime($act['last_modified'])); ?></td>
                                            <td data-name="Last Modified By" <?php echo isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['last_modified_by']; ?></td>
                                            <td data-name="Customer" <?php echo isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['customer']; ?></td>
                                            <td data-name="Employee" <?php echo isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['employee']; ?></td>
                                            <td data-name="Product/Service" <?php echo isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['product_service']; ?></td>
                                            <td data-name="Memo/Description" <?php echo isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['memo_desc']; ?></td>
                                            <td data-name="Rates" <?php echo isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['rates']; ?></td>
                                            <td data-name="Duration" <?php echo isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['duration']; ?></td>
                                            <td data-name="Start Time" <?php echo isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['start_time']; ?></td>
                                            <td data-name="End Time" <?php echo isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['end_time']; ?></td>
                                            <td data-name="Break" <?php echo isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['break']; ?></td>
                                            <td data-name="Taxable" <?php echo isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['taxable']; ?></td>
                                            <td data-name="Billable" <?php echo isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['billable']; ?></td>
                                            <td data-name="Invoice Date" <?php echo isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['invoice_date']; ?></td>
                                            <td data-name="Amount" <?php echo isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''; ?>><?php echo $act['amount']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr class="clickable collapse-row collapse group-total" id="accordion-<?php echo $index; ?>">
                                            <td colspan="<?php echo isset($columns) ? $total_index : '10'; ?>"><b>Total for <?php echo $activity['name']; ?></b></td>
                                            <td data-name="Duration"><b><?php echo $activity['duration_total']; ?></b></td>
                                            <td data-name="Start Time"></td>
                                            <td data-name="End Time"></td>
                                            <td data-name="Break"></td>
                                            <td data-name="Taxable"></td>
                                            <td data-name="Billable"></td>
                                            <td data-name="Invoice Date"></td>
                                            <td data-name="Amount"><b><?php echo $activity['amount_total']; ?></b></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <tr>
                                            <td colspan="19">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-12 d-none" id="report-note-form">
                                        <textarea name="report_note" id="report-note" maxlength="4000" class="nsm-field form-control mb-3" placeholder="Add notes or include additional info with your report"><?php echo !is_null($reportNote) ? str_replace('<br />', '', $reportNote->notes) : ''; ?></textarea>
                                        <label for="report-note">4000 characters max</label>
                                        <button class="nsm-button primary float-end" id="save-note">Save</button>
                                        <button class="nsm-button float-end" id="cancel-note-update">Cancel</button>
                                    </div>
                                    <div class="col-12 <?php echo is_null($reportNote) ? 'd-none' : ''; ?>" id="report-note-cont">
                                        <?php if (!is_null($reportNote) && !empty($reportNote->notes)) { ?>
                                        <p class="m-0"><b>Note</b></p>
                                        <span><?php echo str_replace("\n", '<br />', $reportNote->notes); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-footer <?php echo !isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment; ?>">
                                <p class="m-0"><?php echo date($prepared_timestamp); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const companyName = "<?php echo $clients->business_name; ?>"
</script>
<?php include viewPath('v2/includes/footer'); ?>