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
                                <?php if(!empty($filter_date) && $filter_date !== 'this-month-to-date') : ?>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-activity-date-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="filter-activity-date-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-activity-date-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$end_date?>" id="filter-activity-date-to">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="rows-columns"><b>Rows/Columns</b></label>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-center">
                                        <label for="group-by">Group by</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select id="group-by" class="form-control nsm-field">
                                            <option value="none" <?=$group_by === 'none' ? 'selected' : ''?>>None</option>
                                            <option value="customer" <?=$group_by === 'customer' ? 'selected' : ''?>>Customer</option>
                                            <option value="employee" <?=empty($group_by) || $group_by === 'employee' ? 'selected' : ''?>>Employee</option>
                                            <option value="product-service" <?=$group_by === 'product-service' ? 'selected' : ''?>>Product/Service</option>
                                            <option value="day" <?=$group_by === 'day' ? 'selected' : ''?>>Day</option>
                                            <option value="week" <?=$group_by === 'week' ? 'selected' : ''?>>Week</option>
                                            <option value="work-week" <?=$group_by === 'work-week' ? 'selected' : ''?>>Work Week</option>
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
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Time Activities by Employee Detail">
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
                                                    <option value="activity-date" <?=$sort_by === 'activity-date' ? 'selected' : ''?>>Activity Date</option>
                                                    <option value="billable" <?=$sort_by === 'billable' ? 'selected' : ''?>>Billable</option>
                                                    <option value="break" <?=$sort_by === 'break' ? 'selected' : ''?>>Break</option>
                                                    <option value="create-date" <?=$sort_by === 'create-date' ? 'selected' : ''?>>Create Date</option>
                                                    <option value="created-by" <?=$sort_by === 'created-by' ? 'selected' : ''?>>Created By</option>
                                                    <option value="customer" <?=$sort_by === 'customer' ? 'selected' : ''?>>Customer</option>
                                                    <option value="duration" <?=$sort_by === 'duration' ? 'selected' : ''?>>Duration</option>
                                                    <option value="employee" <?=$sort_by === 'employee' ? 'selected' : ''?>>Employee</option>
                                                    <option value="end-time" <?=$sort_by === 'end-time' ? 'selected' : ''?>>End Time</option>
                                                    <option value="invoice-date" <?=$sort_by === 'invoice-date' ? 'selected' : ''?>>Invoice Date</option>
                                                    <option value="last-modified" <?=$sort_by === 'last-modified' ? 'selected' : ''?>>Last Modified</option>
                                                    <option value="last-modified-by" <?=$sort_by === 'last-modified-by' ? 'selected' : ''?>>Last Modified By</option>
                                                    <option value="memo-desc" <?=$sort_by === 'memo-desc' ? 'selected' : ''?>>Memo/Description</option>
                                                    <option value="product-service" <?=$sort_by === 'product-service' ? 'selected' : ''?>>Product/Service</option>
                                                    <option value="rates" <?=$sort_by === 'rates' ? 'selected' : ''?>>Rates</option>
                                                    <option value="start-time" <?=$sort_by === 'start-time' ? 'selected' : ''?>>Start Time</option>
                                                    <option value="taxable" <?=$sort_by === 'taxable' ? 'selected' : ''?>>Taxable</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" value="asc" checked>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input" value="desc">
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
                                                            <input type="checkbox" name="col_chk" id="col-activity-date" class="form-check-input" <?=isset($columns) && in_array('Activity Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-activity-date" class="form-check-label">Activity Date</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-customer" class="form-check-input" <?=isset($columns) && in_array('Customer', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-customer" class="form-check-label">Customer</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-memo-desc" class="form-check-input" <?=isset($columns) && in_array('Memo/Description', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-memo-desc" class="form-check-label">Memo/Description</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-rates" class="form-check-input" <?=isset($columns) && in_array('Rates', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-rates" class="form-check-label">Rates</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-duration" class="form-check-input" <?=isset($columns) && in_array('Duration', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-duration" class="form-check-label">Duration</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-start-time" class="form-check-input" <?=isset($columns) && in_array('Start Time', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-start-time" class="form-check-label">Start Time</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-end-time" class="form-check-input" <?=isset($columns) && in_array('End Time', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-end-time" class="form-check-label">End Time</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-break" class="form-check-input" <?=isset($columns) && in_array('Break', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-break" class="form-check-label">Break</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-taxable" class="form-check-input" <?=isset($columns) && in_array('Taxable', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-taxable" class="form-check-label">Taxable</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-billable" class="form-check-input" <?=isset($columns) && in_array('Billable', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-billable" class="form-check-label">Billable</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-amount" class="form-check-input" <?=isset($columns) && in_array('Amount', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-amount" class="form-check-label">Amount</label>
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
                                        <p class="m-0">Activity: <?=date("F 1-j, Y")?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
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
                                        <?php foreach($activities as $index => $activity) : ?>
                                        <?php if($group_by === 'none') : ?>
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
                                        <?php else : ?>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                            <td><i class="bx bx-fw bx-caret-right"></i> <b><?=$activity['name']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=$activity['duration_total']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=$activity['amount_total']?></b></td>
                                        </tr>
                                        <?php foreach($activity['activities'] as $act) : ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                            <td <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>><?=$act['activity_date']?></td>
                                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($act['create_date']))?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$act['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($act['last_modified']))?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$act['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$act['customer']?></td>
                                            <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$act['employee']?></td>
                                            <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$act['product_service']?></td>
                                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$act['memo_desc']?></td>
                                            <td <?=isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''?>><?=$act['rates']?></td>
                                            <td <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><?=$act['duration']?></td>
                                            <td <?=isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''?>><?=$act['start_time']?></td>
                                            <td <?=isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''?>><?=$act['end_time']?></td>
                                            <td <?=isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''?>><?=$act['break']?></td>
                                            <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$act['taxable']?></td>
                                            <td <?=isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''?>><?=$act['billable']?></td>
                                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$act['invoice_date']?></td>
                                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$act['amount']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                            <td><b>Total for <?=$activity['name']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=$activity['duration_total']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=$activity['amount_total']?></b></td>
                                        </tr>
                                        <?php endif; ?>
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
                                        <!-- <tr data-bs-toggle="collapse" data-bs-target="#accordion" class="clickable collapse-row collapsed">
                                            <td><i class="bx bx-fw bx-caret-right"></i> Test Employee</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>1:00</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>$22,544.77</b></td>
                                        </tr>
                                        <tr class="clickable collapse-row collapse" id="accordion">
                                            <td>&emsp;06/21/2022</td>
                                            <td>Test Customer</td>
                                            <td>Test Service</td>
                                            <td></td>
                                            <td>22,544.77</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>1:00</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Yes</td>
                                            <td></td>
                                            <td></td>
                                            <td>22,544.77</td>
                                        </tr>
                                        <tr class="clickable collapse-row collapse" id="accordion">
                                            <td><b>Total for Test Employee</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>1:00</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>$22,544.77</b></td>
                                        </tr> -->
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