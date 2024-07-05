<link rel="icon" href="data:;base64,iVBORw0KGgo=" hidden>

<style>
    .top-button {
        height: 30px;
    }

    .icon-top {
        margin-bottom: -3px;
    }
    #balance-summary{
        font-weight: bold;
        font-size: 18px;
        float: right;
        margin-bottom: 58px;
    }
</style>

<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('accounting/reports/reports_assets/report_css'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="nsm-callout primary"><button><i class="bx bx-x"></i></button><?php echo $page->description ?></div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="nsm-card primary">
                        <div class="nsm-card-header">
                            <div class="col-lg-12">
                                <span class="float-start">
                                    <button class="nsm-button addNotes">Add Notes</button>
                                </span>
                                <span class="float-end">
                                    <button data-bs-toggle="modal" data-bs-target="#emailReportModal" class="nsm-button border-0 top-button"><i class="bx bx-fw bx-envelope icon-top"></i></button>
                                    <button class="nsm-button border-0 top-button" data-bs-toggle="dropdown"><i class="bx bx-fw bx-export icon-top"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end export-dropdown" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="exportToXLSX">Export to Excel</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="exportToPDF" download>Export to PDF</a></li>
                                    </ul>
                                    <button data-bs-toggle="modal" data-bs-target="#printPreviewModal" class="nsm-button border-0 top-button"><i class="bx bx-fw bx-printer icon-top"></i></button>
                                    <button class="nsm-button border-0 primary top-button" data-bs-toggle="modal" data-bs-target="#reportSettings"><i class="bx bx-fw bx-cog icon-top"></i></button>
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-filter'></i>&nbsp;
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
                                                    <option value="this-month-to-date">This Month-to-date</option>
                                                    <option value="this-quarter">This Quarter</option>
                                                    <option value="this-quarter-to-date">This Quarter-to-date</option>
                                                    <option value="this-year">This Year</option>
                                                    <option value="this-year-to-date" selected>This Year-to-date</option>
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
                                            <div class="col-12 col-md-6">
                                                <label for="filter-display-columns-by">Display columns by</label>
                                                <select class="nsm-field form-select" name="filter_display_columns_by" id="filter-display-columns-by">
                                                    <option value="total-only" selected>Total Only</option>
                                                    <option value="days">Days</option>
                                                    <option value="weeks">Weeks</option>
                                                    <option value="months">Months</option>
                                                    <option value="quarters">Quarters</option>
                                                    <option value="years">Years</option>
                                                    <option value="customers">Customers</option>
                                                    <option value="vendors">Vendors</option>
                                                    <option value="products-services">Products/Services</option>
                                                </select>
                                            </div>                                    
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="filter-from">From</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" style="" class="nsm-field form-control datepicker" value="<?=date("01/01/Y")?>" id="filter-from">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-to">To</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y")?>" id="filter-to">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="filter-display-columns-by">Show non-zero or active only</label>
                                                <div class="dropdown">
                                                    <button type="button" class="dropdown-toggle nsm-button w-100 m-0" data-bs-toggle="dropdown" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                                        <span>
                                                            Active rows/active columns
                                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end p-3 w-100">
                                                        <p class="m-0">Show rows</p>
                                                        <div class="form-check">
                                                            <input type="radio" checked id="active-rows" name="show_rows" class="form-check-input">
                                                            <label for="active-rows" class="form-check-label">Active</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" id="all-rows" name="show_rows" class="form-check-input">
                                                            <label for="all-rows" class="form-check-label">All</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" id="non-zero-rows" name="show_rows" class="form-check-input">
                                                            <label for="non-zero-rows" class="form-check-label">Non-zero</label>
                                                        </div>
                                                        <p class="m-0">Show columns</p>
                                                        <div class="form-check">
                                                            <input type="radio" checked id="active-columns" name="show_cols" class="form-check-input">
                                                            <label for="active-columns" class="form-check-label">Active</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" id="all-columns" name="show_cols" class="form-check-input">
                                                            <label for="all-columns" class="form-check-label">All</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" id="non-zero-columns" name="show_cols" class="form-check-input">
                                                            <label for="non-zero-columns" class="form-check-label">Non-zero</label>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="filter-display-columns-by">Compare another period</label>
                                                <div class="dropdown">
                                                    <button type="button" class="dropdown-toggle nsm-button w-100 m-0" data-bs-toggle="dropdown">
                                                        <span>
                                                            Select period
                                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end p-3 w-100">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="previous-period" name="selected_period" class="form-check-input">
                                                            <label for="previous-period" class="form-check-label">Previous period (PP)</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-check d-inline-block">
                                                                    <input type="checkbox" id="previous-period-dollar-change" class="form-check-input" disabled>
                                                                    <label for="previous-period-dollar-change" class="form-check-label">$ change</label>
                                                                </div>
                                                                <div class="form-check d-inline-block">
                                                                    <input type="checkbox" id="previous-period-percent-change" class="form-check-input" disabled>
                                                                    <label for="previous-period-percent-change" class="form-check-label">% change</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" id="previous-year" name="selected_period" class="form-check-input">
                                                            <label for="previous-year" class="form-check-label">Previous year (PY)</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-check d-inline-block">
                                                                    <input type="checkbox" id="previous-year-dollar-change" class="form-check-input" disabled>
                                                                    <label for="previous-year-dollar-change" class="form-check-label">$ change</label>
                                                                </div>
                                                                <div class="form-check d-inline-block">
                                                                    <input type="checkbox" id="previous-year-percent-change" class="form-check-input" disabled>
                                                                    <label for="previous-year-percent-change" class="form-check-label">% change</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" id="year-to-date" name="selected_period" class="form-check-input">
                                                            <label for="year-to-date" class="form-check-label">Year-to-date (YTD)</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-check d-inline-block">
                                                                    <input type="checkbox" id="ytd-percent" class="form-check-input" disabled>
                                                                    <label for="ytd-percent" class="form-check-label">% of YTD</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" id="percent-of-row" name="selected_period" class="form-check-input">
                                                            <label for="percent-of-row" class="form-check-label">% of Row</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" id="percent-of-col" name="selected_period" class="form-check-input">
                                                            <label for="percent-of-col" class="form-check-label">% of Column</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" id="percent-of-income" name="selected_period" class="form-check-input">
                                                            <label for="percent-of-income" class="form-check-label">% of Income</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" id="percent-of-expense" name="selected_period" class="form-check-input">
                                                            <label for="percent-of-expense" class="form-check-label">% of Expense</label>
                                                        </div>
                                                        <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                                    </ul>
                                                </div>
                                            </div>                                    
                                        </div>
                                        <div class="row" style="text-align: center; margin-top: 5px; margin-bottom: 5px;">
                                            <div class="col-12 col-md-12">
                                                <label for="" class="w-100">Accounting method</label>
                                                <div class="form-check d-inline-block">
                                                    <input type="radio" id="cash-method" class="form-check-input" name="accounting_method">
                                                    <label for="cash-method" class="form-check-label">Cash</label>
                                                </div>
                                                <div class="form-check d-inline-block">
                                                    <input type="radio" id="accrual-method" class="form-check-input" name="accounting_method" checked>
                                                    <label for="accrual-method" class="form-check-label">Accrual</label>
                                                </div>
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
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="nsm-card-content">
                            <div class="row mb-4">
                                <div class="col-lg-12 headerInfo">
                                    <?php if( $reportSettings ){ ?>
                                        <?php if( $reportSettings->show_logo == 1 ){ ?>
                                            <img id="businessLogo" src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <img id="businessLogo" src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
                                    <?php } ?>
                                    <?php 
                                        $header_css = '';
                                        if( $reportSettings ){
                                            if( $reportSettings->header_align == 'C' ){
                                                $header_css = 'text-align:center;';
                                            }elseif( $reportSettings->header_align == 'L' ){
                                                $header_css = 'text-align:left;margin-left:115px;';
                                            }elseif( $reportSettings->header_align == 'R' ){
                                                $header_css = 'text-align:right;';
                                            }
                                        }
                                    ?>
                                    <div class="reportTitleInfo" style="<?= $header_css; ?>">
                                        <?php if( $reportSettings ){ ?>
                                            <?php if( $reportSettings->show_company_name == 1 ){ ?>
                                                <h3 id="businessName"><?= $reportSettings && $reportSettings->company_name != '' ? $reportSettings->company_name : $clients->business_name; ?></h3>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <h3 id="businessName"><?= $clients->business_name; ?></h3>
                                        <?php } ?>

                                        <?php if( $reportSettings ){ ?>
                                            <?php if( $reportSettings->show_title == 1 ){ ?>
                                                <h5><strong id="reportName"><?= $reportSettings && $reportSettings->title != '' ? $reportSettings->title : 'Profit and Loss'; ?></strong></h5>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <h5><strong id="reportName">Profit and Loss</strong></h5>
                                        <?php } ?>
                                        <h5><small id="reportDate">                                            
                                            <span id="date_from_text"><?= $reportSettings && strtotime($reportSettings->report_date_from_text) > 0 ? date('F d, Y', strtotime($reportSettings->report_date_from_text)) : date('F d, Y'); ?></span> &mdash; 
                                            <span id="date_to_text"><?= $reportSettings && strtotime($reportSettings->report_date_to_text) > 0 ? date('F d, Y', strtotime($reportSettings->report_date_to_text)) : date('F d, Y'); ?></span></small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <?php 
                                    $tableID = "profit_loss_table"; 
                                    $reportCategory = "profit_and_loss"; 
                                    ?>                                                                        
                                    <table id="<?php echo $tableID; ?>" class="nsm-table w-100 border-0">
                                        <thead>
                                            <tr>
                                                <td data-name="Name"></td>
                                                <td data-name="Total">TOTAL</td>
                                            </tr>
                                        </thead>
                                        <tbody id="reportTable">
                                            <tr data-bs-toggle="collapse" data-bs-target="#accordion" class="clickable collapse-row collapsed">
                                                <td><i class="bx bx-fw bx-caret-right"></i> INCOME</td>
                                                <td>$571,265.66</td>
                                            </tr>
                                            <tr data-bs-toggle="collapse" data-bs-target="#accordion1" class="clickable collapse-row collapse" id="accordion">
                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Current Assets</td>
                                                <td></td>
                                            </tr>
                                            <tr id="accordion1" class="collapse clickable collapse-row" data-bs-toggle="collapse" data-bs-target="#accordion2">
                                                <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Bank Accounts</td>
                                                <td></td>
                                            </tr>
                                            <tr id="accordion2" class="collapse">
                                                <td>&emsp;&emsp;&emsp;Checking</td>
                                                <td>305,061.93</td>
                                            </tr>                                        
                                            <tr id="accordion3" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;&emsp; Sub-bank (Cash on hand)</td>
                                                <td>990.00</td>
                                            </tr>
                                            <tr id="accordion3" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;&emsp; <b>Total Test Bank (Cash on hand)</b></td>
                                                <td><b>1,980.77</b></td>
                                            </tr>
                                            <tr id="accordion2" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;Test Category</td>
                                                <td>10.00</td>
                                            </tr>
                                            <tr id="accordion2" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;<b>Total Bank Accounts</b></td>
                                                <td><b>$307,052.70</b></td>
                                            </tr>
                                            <tr id="accordion1" class="collapse clickable collapse-row" data-bs-toggle="collapse" data-bs-target="#accordion4">
                                                <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Accounts Receivable</td>
                                                <td></td>
                                            </tr>
                                            <tr id="accordion4" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;Accounts Receivable</td>
                                                <td>205,324.93</td>
                                            </tr>
                                            <tr id="accordion4" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;<b>Total Accounts Receivable</b></td>
                                                <td><b>$205,324.93</b></td>
                                            </tr>
                                            <tr id="accordion1" class="collapse clickable collapse-row" data-bs-toggle="collapse" data-bs-target="#accordion5">
                                                <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Other Current Assets</td>
                                                <td></td>
                                            </tr>
                                            <tr id="accordion5" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;Credit Card Receivables</td>
                                                <td>207.95</td>
                                            </tr>
                                            <tr id="accordion5" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;Inventory</td>
                                                <td>25.00</td>
                                            </tr>
                                            <tr id="accordion5" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                                <td>25,705.75</td>
                                            </tr>
                                            <tr id="accordion5" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;Test OCA</td>
                                                <td>1,000.00</td>
                                            </tr>
                                            <tr id="accordion5" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                                <td>9,068.80</td>
                                            </tr>
                                            <tr id="accordion5" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                                <td>16,347.82</td>
                                            </tr>
                                            <tr id="accordion5" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                                <td><b>$52,355.32</b></td>
                                            </tr>
                                            <tr id="accordion1" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;<b>Total Current Assets</b></td>
                                                <td><b>$564,732.95</b></td>
                                            </tr>
                                            <tr data-bs-toggle="collapse" data-bs-target="#accordion1" class="clickable collapse-row collapse" id="accordion6">
                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Fixed Assets</td>
                                                <td></td>
                                            </tr>
                                            <tr id="accordion6" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;Accumulated Depreciation</td>
                                                <td>-26,176.00</td>
                                            </tr>
                                            <tr id="accordion6" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;Fixed Asset Computers</td>
                                                <td>6,069.00</td>
                                            </tr>
                                            <tr id="accordion6" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                                <td>25,289.00</td>
                                            </tr>
                                            <tr id="accordion6" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;Fixed Asset Phone</td>
                                                <td>1,200.00</td>
                                            </tr>
                                            <tr id="accordion6" class="collapse clickable collapse-row">
                                                <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                                <td><b>$6,382.00</b></td>
                                            </tr>
                                            <tr  class="clickable collapse-row collapse"  id="accordion">
                                                <td>&emsp;<b>TOTAL INCOME</b></td>
                                                <td><b>$571,114.95</b></td>
                                            </tr>
                                            <tr>
                                                <td>GROSS PROFIT</td>
                                                <td>$571,114.95</td>
                                            </tr>
                                            <tr>
                                                <td><i class="bx bx-fw bx-caret-right"></i> LIABILITIES AND EQUITY</td>
                                                <td>$571,265.66</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <span id="notesContent" class="text-muted">Loading Notes...</span>
                                    <form id="addNotesForm" method="POST" style="display: none;">
                                        <div class="row">
                                            <div class="col-sm-12 mt-1 mb-3">
                                                <div class="form-group">
                                                    <textarea id="NOTES" class="form-control" maxlength="4000"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="float-start noteCharMax">
                                                    4000 characters max
                                                </div>
                                                <div class="float-end">
                                                    <button type="button" id="cancelNotes" class="nsm-button">Cancel</button>
                                                    <button type="submit" class="nsm-button primary noteSaveButton">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php 
                                $footer_css = '';
                                if( $reportSettings ){
                                    if( $reportSettings->footer_align == 'C' ){
                                        $footer_css = 'text-align:center;';
                                    }elseif( $reportSettings->footer_align == 'L' ){
                                        $footer_css = 'text-align:left;';
                                    }elseif( $reportSettings->footer_align == 'R' ){
                                        $footer_css = 'text-align:right;';
                                    }
                                }
                            ?>
                            <div class="row footerInfo" style="<?= $footer_css; ?>">
                                <span class=""><?php echo date("l, F j, Y h:i A eP") ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>

<!-- START: MODALS -->
<!-- Modal for Report Settings -->
<div class="modal fade" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Report Settings</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="reportSettingsForm" method="POST">
                    <div class="row">
                        <div class="col-lg-12">                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableBusinessName" type="checkbox" checked></div>
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?= $reportSettings && $reportSettings->company_name != '' ? $reportSettings->company_name : $clients->business_name; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableReportName" type="checkbox" checked></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?= $reportSettings && $reportSettings->title != '' ? $reportSettings->title : 'Profit and Loss'; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Logo</label>
                                    <select id="showHideLogo" name="showHideLogo" class="nsm-field form-select">
                                        <option value="1" <?= $reportSettings && $reportSettings->show_logo == 1 ? 'selected="selected"' : ''; ?> selected>Show</option>
                                        <option value="0" <?= $reportSettings && $reportSettings->show_logo == 0 ? 'selected="selected"' : ''; ?>>Hide</option>
                                    </select>
                                </div>  
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Header Align</label>
                                    <select name="header_align" id="header-align" class="nsm-field form-select">
                                        <option value="C" <?= $reportSettings && $reportSettings->header_align == 'C' ? 'selected="selected"' : ''; ?>>Center</option>
                                        <option value="L" <?= $reportSettings && $reportSettings->header_align == 'L' ? 'selected="selected"' : ''; ?>>Left</option>           
                                        <option value="R" <?= $reportSettings && $reportSettings->header_align == 'R' ? 'selected="selected"' : ''; ?>>Right</option>           
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Footer Align</label>
                                    <select name="footer_align" id="footer-align" class="nsm-field form-select">
                                        <option value="C" <?= $reportSettings && $reportSettings->footer_align == 'C' ? 'selected="selected"' : ''; ?>>Center</option>
                                        <option value="L" <?= $reportSettings && $reportSettings->footer_align == 'L' ? 'selected="selected"' : ''; ?>>Left</option>                                        
                                        <option value="R" <?= $reportSettings && $reportSettings->footer_align == 'R' ? 'selected="selected"' : ''; ?>>Right</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Page Size</label>
                                    <select name="page_size" id="page-size" class="nsm-field form-select">
                                        <option value="10" <?= $reportSettings && $reportSettings->page_size == 10 ? 'selected="selected"' : ''; ?>>10</option>
                                        <option value="25" <?= $reportSettings && $reportSettings->page_size == 25 ? 'selected="selected"' : ''; ?>>25</option>
                                        <option value="50" <?= $reportSettings && $reportSettings->page_size == 50 ? 'selected="selected"' : ''; ?>>50</option>
                                        <option value="100" <?= $reportSettings && $reportSettings->page_size == 100 ? 'selected="selected"' : ''; ?>>100</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort-by" class="nsm-field form-select">                                                                                                
                                                <option value="customer" <?= $reportSettings && $reportSettings->sort_by == 'customer' ? 'selected="selected"' : ''; ?>>Customer</option>
                                                <option value="balance" <?= $reportSettings && $reportSettings->sort_by == 'balance' ? 'selected="selected"' : ''; ?>>Balance</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select" style="margin-left:2px;">
                                                <option value="ASC" <?= $reportSettings && $reportSettings->sort_asc_desc == 'ASC' ? 'selected="selected"' : ''; ?>>ASC</option>
                                                <option value="DESC" <?= $reportSettings && $reportSettings->sort_asc_desc == 'DESC' ? 'selected="selected"' : ''; ?>>DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="mb-1 fw-xnormal">Date Range <small class="text-muted">(From &mdash; To)</small></label>
                                    <div class="input-group">
                                        <input name="date_from" class="form-control mt-0" style="margin-right:10px;" type="date" value="<?= $reportSettings && strtotime($reportSettings->report_date_from_text) > 0 ? date('Y-m-d', strtotime($reportSettings->report_date_from_text)) : date("Y-m-01"); ?>">
                                        <input name="date_to" class="form-control mt-0" type="date" value="<?= $reportSettings && strtotime($reportSettings->report_date_to_text) > 0 ? date('Y-m-d', strtotime($reportSettings->report_date_to_text)) : date("Y-m-t"); ?>">
                                    </div> 
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Display density</label>
                                    <div class="form-check">
                                        <input type="checkbox" checked id="compact-display" class="form-check-input compact-display">
                                        <label for="compact-display" class="form-check-label">Compact</label>
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
                                <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Report Settings -->

<!-- Modal for Appointment and Job Preview -->
<div class="modal" id="historyPreviewModal" role="dialog" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title historyPreviewModalTitle" style="font-size: 17px;"></span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body historyPreviewModalBody">Fetching Result...</div>
        </div>
    </div>
</div>
<!-- Modal for Appointment and Job Preview -->
<!-- START: PRINT/SAVE MODAL -->
<div class="modal fade" id="printPreviewModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Print or save as PDF</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 mt-1 mb-3">
                        <h6>Report print settings</h6>
                        <hr>
                        <div class="form-group mb-2">
                            <label>Orientation</label>
                            <select id="pageOrientation" name="pageOrientation" class="form-select">
                                <option value="P" selected>Portrait</option>
                                <option value="L">Landscape</option>
                            </select>
                        </div>
                        <!-- <div class="form-check">
                            <input id="pageHeaderRepeat" name="pageHeaderRepeat" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="pageHeaderRepeat">Repeat Page Header</label>
                        </div> -->
                    </div>
                    <div class="col-sm-9">
                        <iframe id="pdfPreview" class="border-0" width="100%" height="450px"></iframe>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start">
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="float-end">
                            <button type="button" class="nsm-button primary savePDF">Save as PDF</button>
                            <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: PRINT/SAVE MODAL -->
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
                                <!-- <input id="emailSubject" class="form-control" type="text" value="<?php echo $companyInfo ? strtoupper($companyInfo->business_name) : ''; ?>: <?php echo $page->title; ?>" required> -->
                                <input id="emailSubject" class="form-control" type="text" value="<?php echo $page->title; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <div id="emailBody">Hello,<br><br>Attached here is the <?php echo $page->title ?> from <?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?>.<br><br>Regards,<br><?php echo "$users->FName $users->LName"; ?></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Attachment</h6>
                                <div class="row">
                                    <div class="input-group borderRadius0 pdfAttachment">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox" type="checkbox"></div>
                                        <input id="pdfReportFilename" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".pdf" style="max-width: 60px;">
                                    </div>
                                    <div class="input-group borderRadius0">
                                        <div class="input-group-text"><input class="form-check-input mt-0 xlsxAttachmentCheckbox" type="checkbox"></div>
                                        <input id="xlsxReportFileName" class="form-control" type="text" value="<?php echo $page->title ?>" required>
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
<!-- END: EMAIL REPORT MODAL -->
<!-- END: MODALS -->
<?php include viewPath('accounting/reports/reports_assets/customer_balance_summary_js'); ?>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){

});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>