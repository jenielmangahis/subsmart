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
                                    <div class="col-12">
                                        <select id="group-by" class="form-control nsm-field">
                                            <option value="none" <?=$group_by === 'none' ? 'selected' : ''?>>None</option>
                                            <option value="account" <?=$group_by === 'account' ? 'selected' : ''?>>Account</option>
                                            <option value="vendor" <?=$group_by === 'vendor' ? 'selected' : ''?>>Vendor</option>
                                            <option value="product-service" <?=empty($group_by) || $group_by === 'product-service' ? 'selected' : ''?>>Product/Service</option>
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
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Open Purchase Order Detail">
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
                                                    <option value="default" <?=empty($sort_by) || $sort_by === 'default' ? 'selected' : ''?>>Default</option>
                                                    <option value="account" <?=$sort_by === 'account' ? 'selected' : ''?>>Account</option>
                                                    <option value="client-vendor-message" <?=$sort_by === 'client-vendor-message' ? 'selected' : ''?>>Client/Vendor Message</option>
                                                    <option value="create-date" <?=$sort_by === 'create-date' ? 'selected' : ''?>>Create Date</option>
                                                    <option value="created-by" <?=$sort_by === 'created-by' ? 'selected' : ''?>>Created By</option>
                                                    <option value="date" <?=$sort_by === 'date' ? 'selected' : ''?>>Date</option>
                                                    <option value="last-modified" <?=$sort_by === 'last-modified' ? 'selected' : ''?>>Last Modified</option>
                                                    <option value="last-modified-by" <?=$sort_by === 'last-modified-by' ? 'selected' : ''?>>Last Modified By</option>
                                                    <option value="memo-description" <?=$sort_by === 'memo-description' ? 'selected' : ''?>>Memo/Description</option>
                                                    <option value="num" <?=$sort_by === 'num' ? 'selected' : ''?>>Num</option>
                                                    <option value="product-service" <?=$sort_by === 'product-service' ? 'selected' : ''?>>Product/Service</option>
                                                    <option value="qty" <?=$sort_by === 'qty' ? 'selected' : ''?>>Qty</option>
                                                    <option value="rate" <?=$sort_by === 'rate' ? 'selected' : ''?>>Rate</option>
                                                    <option value="sku" <?=$sort_by === 'sku' ? 'selected' : ''?>>SKU</option>
                                                    <option value="tax-amount" <?=$sort_by === 'tax-amount' ? 'selected' : ''?>>Tax Amount</option>
                                                    <option value="tax-name" <?=$sort_by === 'tax-name' ? 'selected' : ''?>>Tax Name</option>
                                                    <option value="taxable-amount" <?=$sort_by === 'taxable-amount' ? 'selected' : ''?>>Taxable Amount</option>
                                                    <option value="vendor" <?=$sort_by === 'vendor' ? 'selected' : ''?>>Vendor</option>
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
                                                            <input type="checkbox" name="col_chk" id="col-date" class="form-check-input" <?=isset($columns) && in_array('Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-date" class="form-check-label">Date</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-product-service" class="form-check-input" <?=isset($columns) && in_array('Product/Service', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-product-service" class="form-check-label">Product/Service</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-sku" class="form-check-input" <?=isset($columns) && in_array('SKU', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-sku" class="form-check-label">SKU</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-account" class="form-check-input" <?=isset($columns) && in_array('Account', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-account" class="form-check-label">Account</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-client-vendor-message" class="form-check-input" <?=isset($columns) && in_array('Client/Vendor Message', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-client-vendor-message" class="form-check-label">Client/Vendor Message</label>
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
                                                            <input type="checkbox" name="col_chk" id="col-qty" class="form-check-input" <?=isset($columns) && in_array('Qty', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-qty" class="form-check-label">Qty</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-received-qty" class="form-check-input" <?=isset($columns) && in_array('Received Qty', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-received-qty" class="form-check-label">Received Qty</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-back-ordered-qty" class="form-check-input" <?=isset($columns) && in_array('Backordered Qty', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-back-ordered-qty" class="form-check-label">Backordered Qty</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-total-amt" class="form-check-input" <?=isset($columns) && in_array('Total Amt', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-total-amt" class="form-check-label">Total Amt</label>
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

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-received-amt" class="form-check-input" <?=isset($columns) && in_array('Received Amt', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-received-amt" class="form-check-label">Received Amt</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="col_chk" id="col-open-balance" class="form-check-input" <?=isset($columns) && in_array('Open Balance', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label for="col-open-balance" class="form-check-label">Open Balance</label>
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
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>>VENDOR</td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                                            <td data-name="SKU" <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>>SKU</td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                                            <td data-name="Client/Vendor Message" <?=isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''?>>CLIENT/VENDOR MESSAGE</td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>>RATE</td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>>QTY</td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>>RECEIVED QTY</td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>>BACKORDERED QTY</td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>>TOTAL AMT</td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>>TAX NAME</td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>>TAX AMOUNT</td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>>TAXABLE AMOUNT</td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>>RECEIVED AMT</td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($purchaseOrders) > 0) : ?>
                                        <?php foreach($purchaseOrders as $index => $purchaseOrder) : ?>
                                        <?php if($group_by === 'none') : ?>
                                        <tr>
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['date']?></td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['num']?></td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['customer']?></td>
                                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['vendor']?></td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['product_service']?></td>
                                            <td data-name="SKU" <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['sku']?></td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['create_date']?></td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['created_by']?></td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['last_modified']?></td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['last_modified_by']?></td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['account']?></td>
                                            <td data-name="Client/Vendor Message" <?=isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['client_vendor_message']?></td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['memo_description']?></td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['rate']?></td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['qty']?></td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['received_qty']?></td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['backordered_qty']?></td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['total_amt']?></td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['tax_name']?></td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['tax_amount']?></td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['taxable_amount']?></td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['received_amt']?></td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['open_balance']?></td>
                                        </tr>
                                        <?php else : ?>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                            <td colspan="<?=isset($columns) ? $total_index : '14'?>"><i class="bx bx-fw bx-caret-right"></i> <b><?=$purchaseOrder['name']?></b></td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['qty_total']?></b></td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['received_qty_total']?></b></td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['backordered_qty_total']?></b></td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['total_amt_total']?></b></td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['received_amt_total']?></b></td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['open_balance_total']?></b></td>
                                        </tr>
                                        <?php foreach($purchaseOrder['purchase_orders'] as $po) : ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                            <td data-name=""></td>
                                            <?php endif; ?>
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$po['date']?></td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$po['num']?></td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$po['customer']?></td>
                                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$po['vendor']?></td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$po['product_service']?></td>
                                            <td data-name="SKU" <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>><?=$po['sku']?></td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$po['create_date']?></td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$po['created_by']?></td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$po['last_modified']?></td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$po['last_modified_by']?></td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$po['account']?></td>
                                            <td data-name="Client/Vendor Message" <?=isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$po['client_vendor_message']?></td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$po['memo_description']?></td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$po['rate']?></td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$po['qty']?></td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>><?=$po['received_qty']?></td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>><?=$po['backordered_qty']?></td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>><?=$po['total_amt']?></td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$po['tax_name']?></td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$po['tax_amount']?></td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$po['taxable_amount']?></td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>><?=$po['received_amt']?></td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$po['open_balance']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="clickable collapse-row collapse group-total" id="accordion-<?=$index?>">
                                            <td colspan="<?=isset($columns) ? $total_index : '14'?>"><b>Total for <?=$purchaseOrder['name']?></b></td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['qty_total']?></b></td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['received_qty_total']?></b></td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['backordered_qty_total']?></b></td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['total_amt_total']?></b></td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['received_amt_total']?></b></td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['open_balance_total']?></b></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="23">
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
                                        <?php if(!is_null($reportNote) && !empty($reportNote->notes)) : ?>
                                        <p class="m-0"><b>Note</b></p>
                                        <span><?=str_replace("\n", "<br />", $reportNote->notes)?></span>
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