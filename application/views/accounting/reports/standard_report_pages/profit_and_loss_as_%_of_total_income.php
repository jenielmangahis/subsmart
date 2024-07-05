<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('accounting/reports/reports_assets/report_css'); ?>
<style>
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

                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-7 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" id="collapseButton">
                                                <span>Collapse</span>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <div class="form-check">
                                                    <input type="radio" checked id="sort-default" name="sort_order" class="form-check-input">
                                                    <label for="sort-default" class="form-check-label">Default</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input">
                                                    <label for="sort-asc" class="form-check-label">Total in ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                                    <label for="sort-desc" class="form-check-label">Total in descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button addNotes">
                                                <span>Add notes</span>
                                            </button>                                           
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#emailReportModal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#printPreviewModal" onclick="previewPDF()">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                            <button class="nsm-button border-0 primary" data-bs-toggle="modal" data-bs-target="#reportSettings"><i class="bx bx-fw bx-cog"></i></button>           
                                            
                                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-filter'></i>&nbsp;
                                            </button>    
                                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                                <div class="row">
                                                    <div class="col-12" style="margin-bottom: 10px;">
                                                        <label for="filter-report-period">Report period</label>
                                                        <select class="nsm-field form-select" name="filter_report_period" id="filter-report-period">
                                                            <option value="all-dates">All Dates</option>
                                                            <option value="custom">Custom</option>
                                                            <option value="today" selected>Today</option>
                                                            <option value="this-week">This Week</option>
                                                            <option value="this-week-to-date">This Week-to-date</option>
                                                            <option value="this-month">This Month</option>
                                                            <option value="this-month-to-date">This Month-to-date</option>
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
                                                    <div class="col-12" style="margin-bottom: 10px;">
                                                        <label for="filter-as-of">As of</label>
                                                        <div class="nsm-field-group calendar">
                                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y")?>" id="filter-as-of">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12" style="margin-bottom: 10px;">
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-12" style="margin-bottom: 10px;">
                                                        <label for="" class="w-100">Aging method</label>
                                                        <div class="form-check d-inline-block">
                                                            <input type="radio" id="current-method" class="form-check-input" name="aging_method">
                                                            <label for="current-method" class="form-check-label">Current</label>
                                                        </div>
                                                        <div class="form-check d-inline-block">
                                                            <input type="radio" id="report-date-method" class="form-check-input" name="aging_method" checked>
                                                            <label for="report-date-method" class="form-check-label">Report date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12" style="margin-bottom: 10px;">
                                                        <label for="filter-days-per-aging-period">Days per aging period</label>
                                                        <input type="text" class="nsm-field form-control datepicker" name="filter_days_per_aging_period" value="30" id="filter-days-per-aging-period">
                                                    </div>
                                                </div>
                                                <div class="row grid-mb">
                                                    <div class="col-12" style="margin-bottom: 10px;">
                                                        <label for="filter-number-of-period">Number of periods</label>
                                                        <input type="text" class="nsm-field form-control datepicker" name="filter_number_of_periods" value="4" id="filter-number-of-period">
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
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-12 headerInfo">
                                        <img id="businessLogo" src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
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
                                                    <h3 id="businessName"><?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?></h3>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <h3 id="businessName"><?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?></h3>
                                            <?php } ?>

                                            <?php if( $reportSettings ){ ?>
                                                <?php if( $reportSettings->show_title == 1 ){ ?>
                                                    <h5><strong id="reportName"><?php echo $page->title ?></strong></h5>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <h5><strong id="reportName"><?php echo $page->title ?></strong></h5>
                                            <?php } ?>
                                            <?php if($reportSettings->report_date_from_text != null && $reportSettings->report_date_to_text != null) { ?>
                                                <h5><small id="reportDate"><?php echo date("F j, Y", strtotime($reportSettings->report_date_from_text)) ?> - <?php echo date("F j, Y", strtotime($reportSettings->report_date_to_text)) ?></small></h5>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <?php $is_compact_table = $reportSettings && $reportSettings->is_compact == 1 ? "compact-table" : ""; ?>
                                <table class="nsm-table <?php echo $is_compact_table; ?>" id="profit-and-loss-income">
                                    <thead>
                                        <tr>
                                            <td data-name="Name" rowspan="2"></td>
                                            <td data-name="Total" colspan="2" class="text-center">TOTAL</td>
                                        </tr>
                                        <tr>
                                            <td>Jan 1-<?=date("M d, Y")?></td>
                                            <td>% OF INCOME</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion" class="clickable collapse-row collapsed">
                                            <td><i class="bx bx-fw bx-caret-right"></i> INCOME</td>
                                            <td>$571,265.66</td>
                                            <td>100.00 %</td>
                                        </tr>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion1" class="clickable collapse-row collapse" id="accordion">
                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Current Assets</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion1" class="collapse clickable collapse-row" data-bs-toggle="collapse" data-bs-target="#accordion2">
                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Bank Accounts</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion2" class="collapse">
                                            <td>&emsp;&emsp;&emsp;Checking</td>
                                            <td>305,061.93</td>
                                            <td>10.00 %</td>
                                        </tr>                                        
                                        <tr id="accordion3" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;&emsp; Sub-bank (Cash on hand)</td>
                                            <td>990.00</td>
                                            <td>10.00 %</td>
                                        </tr>
                                        <tr id="accordion3" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;&emsp; <b>Total Test Bank (Cash on hand)</b></td>
                                            <td><b>1,980.77</b></td>
                                            <td>10.00 %</td>
                                        </tr>
                                        <tr id="accordion2" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Test Category</td>
                                            <td>10.00</td>
                                            <td>10.00 %</td>
                                        </tr>
                                        <tr id="accordion2" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;<b>Total Bank Accounts</b></td>
                                            <td><b>$307,052.70</b></td>
                                            <td>100.00 %</td>
                                        </tr>
                                        <tr id="accordion1" class="collapse clickable collapse-row" data-bs-toggle="collapse" data-bs-target="#accordion4">
                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Accounts Receivable</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion4" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Accounts Receivable</td>
                                            <td>205,324.93</td>
                                            <td>100.00 %</td>
                                        </tr>
                                        <tr id="accordion4" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;<b>Total Accounts Receivable</b></td>
                                            <td><b>$205,324.93</b></td>
                                            <td>100.00 %</td>
                                        </tr>
                                        <tr id="accordion1" class="collapse clickable collapse-row" data-bs-toggle="collapse" data-bs-target="#accordion5">
                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Other Current Assets</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Credit Card Receivables</td>
                                            <td>207.95</td>
                                            <td>100.00 %</td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Inventory</td>
                                            <td>25.00</td>
                                            <td>25.00 %</td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                            <td>25,705.75</td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Test OCA</td>
                                            <td>1,000.00</td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                            <td>9,068.80</td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                            <td>16,347.82</td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                            <td><b>$52,355.32</b></td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion1" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;<b>Total Current Assets</b></td>
                                            <td><b>$564,732.95</b></td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion1" class="clickable collapse-row collapse" id="accordion6">
                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Fixed Assets</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;Accumulated Depreciation</td>
                                            <td>-26,176.00</td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;Fixed Asset Computers</td>
                                            <td>6,069.00</td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                            <td>25,289.00</td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;Fixed Asset Phone</td>
                                            <td>1,200.00</td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                            <td><b>$6,382.00</b></td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr  class="clickable collapse-row collapse"  id="accordion">
                                            <td>&emsp;<b>TOTAL INCOME</b></td>
                                            <td><b>$571,114.95</b></td>
                                            <td><b>100.00 %</b></td>
                                        </tr>
                                        <tr>
                                            <td>GROSS PROFIT</td>
                                            <td>$571,114.95</td>
                                            <td>100.00 %</td>
                                        </tr>
                                        <tr>
                                            <td><i class="bx bx-fw bx-caret-right"></i> LIABILITIES AND EQUITY</td>
                                            <td>$571,265.66</td>
                                            <td>$571,265.66</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                            <div class="nsm-card-footer text-center">
                                <p class="m-0">Accrual basis <?=date("l, F j, Y h:i A eP")?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                                              
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableBusinessName" type="checkbox" <?= $reportSettings && $reportSettings->show_company_name == 1 ? 'checked' : ''; ?>></div>
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?= $reportSettings && $reportSettings->company_name != '' ? $reportSettings->company_name : $clients->business_name; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableReportName" type="checkbox" <?= $reportSettings && $reportSettings->show_title == 1 ? 'checked' : ''; ?>></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?= $reportSettings && $reportSettings->title != '' ? $reportSettings->title : 'Profit and Loss as % of total income'; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="from-date">From Date</label>
                                    <div class="">
                                        <input type="date" id="from-date" class="form-control nsm-field date" value="<?= $reportSettings && $reportSettings->report_date_from_text != '' ? date("Y-m-d",strtotime($reportSettings->report_date_from_text)) : date("Y-m-d"); ?>" data-type="filter-date">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="to-date">To Date</label>
                                    <div class="">
                                        <input type="date" id="to-date" class="form-control nsm-field date" value="<?= $reportSettings && $reportSettings->report_date_to_text != '' ? date("Y-m-d",strtotime($reportSettings->report_date_to_text)) : date("Y-m-d"); ?>" data-type="filter-date">
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
                                        <option value="L" <?= $reportSettings && $reportSettings->header_align == 'R' ? 'selected="selected"' : ''; ?>>Right</option>           
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
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                <option value="total" selected>Total</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select" style="margin-left:2px;">
                                                <option value="ASC" <?= $reportSettings && $reportSettings->sort_asc_desc == 'ASC' ? 'selected="selected"' : ''; ?>>ASC</option>
                                                <option value="DESC" <?= $reportSettings && $reportSettings->sort_asc_desc == 'DESC' ? 'selected="selected"' : ''; ?>>DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Display density</label>
                                    <div class="form-check">
                                        <input type="checkbox" <?php echo $reportSettings && $reportSettings->is_compact == 1 ? "checked" : ""; ?>  id="compact-display" name="compact_display" value=1 class="form-check-input compact-display">
                                        <label for="compact-display" class="form-check-label">Compact</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
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
                                <option value="p" selected>Portrait</option>
                                <option value="l">Landscape</option>
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

</div>
<?php include viewPath('accounting/reports/reports_assets/profit_and_loss_as_%_of_total_income_js'); ?>
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
    var isCollapsed = true;

    $("#collapseButton").click(function() {
        if (isCollapsed) {
            $(".collapse").collapse('show');
            $("#collapseButton span").text('Uncollapse');
            updateCarets('show');
        } else {
            $(".collapse").collapse('hide');
            $("#collapseButton span").text('Collapse');
            updateCarets('hide');
        }
        isCollapsed = !isCollapsed;
    });

    $(".collapse-row").click(function() {
        var target = $(this).data("bs-target");
        $(this).find("i").toggleClass("bx-caret-right bx-caret-down");
        $(target).collapse('toggle');
    });

    $("#compact-display").change(function() {
        if ($(this).is(":checked")) {
            $("#reportTable").addClass("compact-table");
        } else {
            $("#reportTable").removeClass("compact-table");
        }
    });

    function updateCarets(action) {
        $(".collapse-row").each(function() {
            var target = $(this).data("bs-target");
            var icon = $(this).find("i");
            if (action === 'show') {
                icon.removeClass("bx-caret-right").addClass("bx-caret-down");
            } else {
                icon.removeClass("bx-caret-down").addClass("bx-caret-right");
            }
        });
    }

    $("#compact-display").change(function() {
        if ($(this).is(":checked")) {
            $("#accounts-receivable-aging-summary").addClass("compact-table");
        } else {
            $("#accounts-receivable-aging-summary").removeClass("compact-table");
        }
    });    
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>