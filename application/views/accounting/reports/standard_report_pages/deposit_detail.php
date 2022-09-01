<?php include viewPath('v2/includes/accounting_header'); ?>
<style>
    .modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
        border-radius: 50px !important;
	}
        
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
	}
    .czLabel {
        cursor: pointer;
    }
    .czLabel i {
        color: black !important;
        font-size: 13px;
    }
    #general{
        display: none;
    }
    #column{
        display: none;
    }
    .column{
        margin-top: 20px;
    }
    .head_foot{
        display: none;
    }
    .header-footer{
        margin-top: 20px;
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
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period">Report period</label>
                                        <select class="nsm-field form-select" name="filter_report_period" id="filter-report-period">
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
                                    <div class="col-12 col-md-6">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/01/Y")?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y")?>" id="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <p class="m-0">Rows/columns</p>
                                <div class="row grid-mb">
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
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <a type="button" class="nsm-button demo" data-bs-toggle="modal" data-bs-target="#customizeModal">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </a>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-12 offset-md-12">
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
                                                    <option value="default" selected>Default</option>
                                                    <option value="account">Account</option>
                                                    <option value="created">Created</option>
                                                    <option value="created-by">Created By</option>
                                                    <option value="date">Date</option>
                                                    <option value="last-modified">Last Modified</option>
                                                    <option value="last-modified-by">Last Modified By</option>
                                                    <option value="payment-method">Payment Method</option>
                                                    <option value="transaction-type">Transaction Type</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" checked>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button">
                                                <span>Add notes</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
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
                                                            <input type="checkbox" id="col-date" class="form-check-input" checked>
                                                            <label for="col-date" class="form-check-label">Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-transaction-type" class="form-check-input" checked>
                                                            <label for="col-transaction-type" class="form-check-label">Transaction Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-num" class="form-check-input" checked>
                                                            <label for="col-num" class="form-check-label">Num</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-created" class="form-check-input">
                                                            <label for="col-created" class="form-check-label">Created</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-created-by" class="form-check-input">
                                                            <label for="col-created-by" class="form-check-label">Created By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified" class="form-check-input">
                                                            <label for="col-last-modified" class="form-check-label">Last Modified</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified-by" class="form-check-input">
                                                            <label for="col-last-modified-by" class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-customer" class="form-check-input" checked>
                                                            <label for="col-customer" class="form-check-label">Customer</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-vendor" class="form-check-input" checked>
                                                            <label for="col-vendor" class="form-check-label">Vendor</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-employee" class="form-check-input">
                                                            <label for="col-employee" class="form-check-label">Employee</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-memo-desc" class="form-check-input" checked>
                                                            <label for="col-memo-desc" class="form-check-label">Memo/Description</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-account" class="form-check-input">
                                                            <label for="col-account" class="form-check-label">Account</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-payment-method" class="form-check-input">
                                                            <label for="col-payment-method" class="form-check-label">Payment Method</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-clr" class="form-check-input" checked>
                                                            <label for="col-clr" class="form-check-label">Clr</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-amount" class="form-check-input" checked>
                                                            <label for="col-amount" class="form-check-label">Amount</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-taxable" class="form-check-input">
                                                            <label for="col-taxable" class="form-check-label">Taxable</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-online-banking" class="form-check-input">
                                                            <label for="col-online-banking" class="form-check-label">Online Banking</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <h4 class="text-center fw-bold"><span class="company-name"><?=$clients->business_name?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb text-center">
                                        <p class="m-0 fw-bold">Deposit Detail</p>
                                        <p><?=date("F 1-j, Y")?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <td>Payment</td>
                                            <td>Customer</td>
                                            <td>Payment Method</td>
                                            <td>Reference No.</td>
                                            <td>nSmartrac Record</td>
                                            <td>Fees</td>
                                            <td>Amount</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($invoices as $invoice): ?>
                                            <tr>
                                                <td><?= $invoice->payment_date ?></td>
                                                <td><?= $invoice->first_name .' '. $invoice->last_name; ?></td>
                                                <td><?= $invoice->payment_method; ?></td>
                                                <td><?= $invoice->reference_number; ?></td>
                                                <td><a target="_blank" href="<? base_url('invoice/genview/' . $invoice->id) ?>" style="color:blue;">Invoice</a></td>
                                                <td>Tip: $<?= number_format($invoice->invoice_tip,2); ?></td>
                                                <td>$<?= number_format($invoice->invoice_amount,2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
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

<?php include viewPath('v2/includes/footer'); ?>

<script>
    function general(){
        var class_name = document.getElementById('gen').className;
        var genHeader = document.getElementById('gen');
        var genLabel = document.getElementById('genLabel');
        var genDiv = document.getElementById('general');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            genHeader.classList.remove("bxs-right-arrow");
            genHeader.classList.add("bxs-down-arrow");
            genLabel.classList.add("fw-bold");
            genLabel.style.color = "#6a4a86";
            genDiv.style.display = 'inline';
        }else{
            genHeader.classList.add("bxs-right-arrow");
            genHeader.classList.remove("bxs-down-arrow");
            genLabel.classList.remove("fw-bold");
            genLabel.style.color = "black";
            genDiv.style.display = 'none';

        }
    }
    function column(){
        var class_name = document.getElementById('custom_row_col').className;
        var colHeader = document.getElementById('custom_row_col');
        var colLabel = document.getElementById('custom_row_col_label');
        var colDiv = document.getElementById('column');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            colHeader.classList.remove("bxs-right-arrow");
            colHeader.classList.add("bxs-down-arrow");
            colLabel.classList.add("fw-bold");
            colLabel.style.color = "#6a4a86";
            colDiv.style.display = 'inline';
        }else{
            colHeader.classList.add("bxs-right-arrow");
            colHeader.classList.remove("bxs-down-arrow");
            colLabel.classList.remove("fw-bold");
            colLabel.style.color = "black";
            colDiv.style.display = 'none';

        }
    }
    function headerFooter(){
        var class_name = document.getElementById('header_footer').className;
        var headFootHeader = document.getElementById('header_footer');
        var headFootLabel = document.getElementById('header_footer_label');
        var headFootDiv = document.getElementById('head_foot');
        if(class_name == 'bx bx-fw bxs-right-arrow'){
            headFootHeader.classList.remove("bxs-right-arrow");
            headFootHeader.classList.add("bxs-down-arrow");
            headFootLabel.classList.add("fw-bold");
            headFootLabel.style.color = "#6a4a86";
            headFootDiv.style.display = 'inline';
        }else{
            headFootHeader.classList.add("bxs-right-arrow");
            headFootHeader.classList.remove("bxs-down-arrow");
            headFootLabel.classList.remove("fw-bold");
            headFootLabel.style.color = "black";
            headFootDiv.style.display = 'none';

        }
    }

    function dates(){
        var filter_report_period = document.getElementById('filter_report_period').value;
        var date_filter_from = document.getElementById('date_filter_from');
        var date_filter_to = document.getElementById('date_filter_to');
        var filter_to = document.getElementById('filter_to');
        var filter_from = document.getElementById('filter_from');
        const D = new Date(); 
        var month = D.getMonth() + 1;  // 10 (PS: +1 since Month is 0-based)
        var day = D.getDate();       // 30
        var year = D.getFullYear(); // 2022

        if(filter_report_period == 'all-dates'){
            date_filter_from.style.display = 'none';
            date_filter_to.style.display = 'none';
        }else if(filter_report_period == 'this-week'){
            var numberOfDaysToAdd = 7;
            var result = D.setDate(D.getDate() + numberOfDaysToAdd);
            var week = new Date(result);
            filter_from.value = month+"/"+day+"/"+year;
            filter_to.value = (week.getMonth() + 1)+"/"+week.getDate()+"/"+week.getFullYear();
        }else if(filter_report_period == 'this-month'){
            var numberOfDaysToAdd = 30;
            var result = D.setDate(D.getDate() + numberOfDaysToAdd);
            var res_month = new Date(result);
            filter_from.value = month+"/"+day+"/"+year;
            filter_to.value = (res_month.getMonth() + 1)+"/"+res_month.getDate()+"/"+res_month.getFullYear();
        }else{
            date_filter_from.style.display = 'inline';
            date_filter_to.style.display = 'inline';
        }
    }
</script>