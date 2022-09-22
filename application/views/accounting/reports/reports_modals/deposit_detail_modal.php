<form method="POST" action="<?= base_url('/accounting/reports/view-report/'.$reportTypeId); ?>">
    <div class="modal right fade" id="customizeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="customizeModalLabel">Customize Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <div class="general">
                        <h6 onclick="general()" class="czLabel" id="genLabel"><i class='bx bx-fw bxs-right-arrow' id="gen"></i>General</h6>
                        <div class="col-lg-12 general" id="general">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="filter-report-period">Report period</label>
                                    <select class="nsm-field form-select" name="filter_report_period" id="filter_report_period" onchange="dates()">
                                        <option value="all-dates">All Dates</option>
                                        <option value="custom">Custom</option>
                                        <option value="today">Today</option>
                                        <option value="this-week">This Week</option>
                                        <option value="this-week-to-date">This Week-to-date</option>
                                        <option value="this-month">This Month</option>
                                        <option value="this-month-to-date" selected>This Month-to-date</option>
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
                                        <option value="next-week">Next Week</option>
                                        <option value="next-4-weeks">Next 4 Weeks</option>
                                        <option value="next-month">Next Month</option>
                                        <option value="next-quarter">Next Quarter</option>
                                        <option value="next-year">Next Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" id="date_filter_from">
                                    <label for="filter-from">From</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" class="nsm-field form-control datepicker" value="" id="filter_from">
                                    </div>
                                </div>
                                <div class="col-md-6" id="date_filter_to">
                                    <label for="filter-to">To</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" class="nsm-field form-control datepicker" value="" id="filter_to">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <h6 onclick="column()" class="czLabel" id="custom_row_col_label"><i class='bx bx-fw bxs-right-arrow' id="custom_row_col"></i>Rows/Columns</h6>
                        <div class="col-lg-12 column" id="column">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="filter-group-by">Group by</label>
                                    <select class="nsm-field form-select" name="filter_group_by" id="filter-group-by">
                                        <option value="none" selected>None</option>
                                        <option value="shipping-city">Shipping City</option>
                                        <option value="shipping-state">Shipping State</option>
                                        <option value="shipping-zip">Shipping ZIP</option>
                                        <option value="billing-city">Billing City</option>
                                        <option value="billing-state">Billing State</option>
                                        <option value="billing-zip">Billing ZIP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-footer">
                        <h6 onclick="headerFooter()" class="czLabel" id="header_footer_label"><i class='bx bx-fw bxs-right-arrow' id="header_footer"></i>Header/Footer</h6>
                        <div class="head_foot" id="head_foot">
                            <h6 class="fw-bold" style="margin-top: 20px;">Header</h6>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="sort-asc" name="header[]" value="isLogo" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Show Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="changeCompany1" name="header[]" value="isCompany" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Company Name</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" onchange="changeCompany()" value="<?=$clients->business_name?>" name="header[company]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="changeReport1" name="header[]" value="isReport" class="form-check-input" >
                                        <label for="sort-asc" class="form-check-label">Report Title</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="sort-asc" onchange="changeReport()" name="header[report]" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h6 class="fw-bold" style="margin-top: 20px;">Footer</h6>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="sort-asc" name="header[]" value="isDate" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Date Prepared</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-5">
                                        <input type="checkbox" id="sort-asc" name="header[]" value="isTime" class="form-check-input">
                                        <label for="sort-asc" class="form-check-label">Time Prepared</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="nsm-button success">Run Report</button>
                </div>
            </div>
        </div>
    </div>
</form>