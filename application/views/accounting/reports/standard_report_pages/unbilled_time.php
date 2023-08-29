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
                                </div>
                                <?php if(!empty($filter_date)) : ?>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="filter-activity-date-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period-to">To</label>
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
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        <label for="group-by">Group by</label>
                                    </div>
                                    <div class="col-12">
                                        <select id="group-by" class="form-control nsm-field">
                                            <option value="none" <?=$group_by === 'none' ? 'selected' : ''?>>None</option>
                                            <option value="account" <?=$group_by === 'account' ? 'selected' : ''?>>Account</option>
                                            <option value="transaction-type" <?=$group_by === 'transaction-type' ? 'selected' : ''?>>Transaction Type</option>
                                            <option value="customer" <?=empty($group_by) || $group_by === 'customer' ? 'selected' : ''?>>Customer</option>
                                            <option value="vendor" <?=$group_by === 'vendor' ? 'selected' : ''?>>Vendor</option>
                                            <option value="employee" <?=$group_by === 'employee' ? 'selected' : ''?>>Employee</option>
                                            <option value="product-service" <?=$group_by === 'product-service' ? 'selected' : ''?>>Product/Service</option>
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
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Unbilled time">
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
                                                    <option value="create-date" <?=$sort_by === 'create-date' ? 'selected' : ''?>>Create Date</option>
                                                    <option value="created-by" <?=$sort_by === 'created-by' ? 'selected' : ''?>>Created By</option>
                                                    <option value="customer" <?=$sort_by === 'customer' ? 'selected' : ''?>>Customer</option>
                                                    <option value="duration" <?=$sort_by === 'duration' ? 'selected' : ''?>>Duration</option>
                                                    <option value="employee" <?=$sort_by === 'employee' ? 'selected' : ''?>>Employee</option>
                                                    <option value="last-modified" <?=$sort_by === 'last-modified' ? 'selected' : ''?>>Last Modified</option>
                                                    <option value="last-modified-by" <?=$sort_by === 'last-modified-by' ? 'selected' : ''?>>Last Modified By</option>
                                                    <option value="memo-desc" <?=$sort_by === 'memo-desc' ? 'selected' : ''?>>Memo/Description</option>
                                                    <option value="posting" <?=$sort_by === 'posting' ? 'selected' : ''?>>Posting</option>
                                                    <option value="product-service" <?=$sort_by === 'product-service' ? 'selected' : ''?>>Product/Service</option>
                                                    <option value="rate" <?=$sort_by === 'rate' ? 'selected' : ''?>>Rate</option>
                                                    <option value="taxable" <?=$sort_by === 'taxable' ? 'selected' : ''?>>Taxable</option>
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
                                                            <input type="checkbox" name="col_chk" id="col-activity-date" class="form-check-input" <?=isset($columns) && in_array('Activity Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-activity-date" class="form-check-label">Activity Date</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-rate" class="form-check-input" <?=isset($columns) && in_array('Rate', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-rate" class="form-check-label">Rate</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-taxable" class="form-check-input" <?=isset($columns) && in_array('Taxable', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-taxable" class="form-check-label">Taxable</label>
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
                                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                            <td data-name=""></td>
                                            <?php endif; ?>
                                            <td data-name="Activity Date" <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>>ACTIVITY DATE</td>
                                            <td data-name="Posting" <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>>POSTING</td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                                            <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>>EMPLOYEE</td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>>RATE</td>
                                            <td data-name="Duration" <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>>DURATION</td>
                                            <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>>TAXABLE</td>
                                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>>BALANCE</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($time_activities) > 0) : ?>
                                        <?php foreach($time_activities as $index => $activity) : ?>
                                        <?php if($group_by === 'none') : ?>
                                        <tr>
                                            <td data-name="Activity Date" <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>><?=$activity['activity_date']?></td>
                                            <td data-name="Posting" <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>><?=$activity['posting']?></td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$activity['create_date']?></td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$activity['created_by']?></td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$activity['last_modified']?></td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$activity['last_modified_by']?></td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$activity['customer']?></td>
                                            <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$activity['employee']?></td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$activity['product_service']?></td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$activity['memo_desc']?></td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$activity['rate']?></td>
                                            <td data-name="Duration" <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><?=$activity['duration']?></td>
                                            <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$activity['taxable']?></td>
                                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$activity['amount']?></td>
                                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$activity['balance']?></td>
                                        </tr>
                                        <?php else : ?>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                            <td colspan="<?=isset($columns) ? $total_index : '11'?>"><i class="bx bx-fw bx-caret-right"></i> <b><?=$activity['name']?></b></td>
                                            <td data-name="Duration" <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><b><?=$activity['duration_total']?></b></td>
                                            <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$activity['amount_total']?></b></td>
                                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) || $columns[0] === 'Balance' ? 'style="display: none"' : ''?>></td>
                                        </tr>
                                        <?php foreach($activity['time_activities'] as $act) : ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                            <td data-name=""></td>
                                            <?php endif; ?>
                                            <td data-name="Activity Date" <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>><?=$act['activity_date']?></td>
                                            <td data-name="Posting" <?=isset($columns) && !in_array('Posting', $columns) ? 'style="display: none"' : ''?>><?=$act['posting']?></td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$act['create_date']?></td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$act['created_by']?></td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$act['last_modified']?></td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$act['last_modified_by']?></td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$act['customer']?></td>
                                            <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$act['employee']?></td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$act['product_service']?></td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$act['memo_desc']?></td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$act['rate']?></td>
                                            <td data-name="Duration" <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><?=$act['duration']?></td>
                                            <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$act['taxable']?></td>
                                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$act['amount']?></td>
                                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) ? 'style="display: none"' : ''?>><?=$act['balance']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="clickable collapse-row collapse group-total" id="accordion-<?=$index?>">
                                            <td colspan="<?=isset($columns) ? $total_index : '11'?>"><b>Total for <?=$activity['name']?></b></td>
                                            <td data-name="Duration" <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><b><?=$activity['duration_total']?></b></td>
                                            <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><b><?=$activity['amount_total']?></b></td>
                                            <td data-name="Balance" <?=isset($columns) && !in_array('Balance', $columns) || $columns[0] === 'Balance' ? 'style="display: none"' : ''?>></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="15">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <p class="m-0"><?=date("l, F j, Y h:i A eP")?></p>
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