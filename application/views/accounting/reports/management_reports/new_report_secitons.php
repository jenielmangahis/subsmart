
<?php

if($report_pages != null){
    $data_count = 1;
    foreach($report_pages as $page){

?>
<div class="report-section new_report" data-count="<?=$data_count?>">
    <input type="text" name="management_report_report_ids[]" value="<?=$page ->id?>" style="display:none;">
    <input type="text" name="input_report_compare_prev_year[]" value="<?=$page->report_page_compare_prev_year?>" style="display:none;">
    <input type="text" name="input_report_compare_prev_period[]" value="<?=$page->report_page_compare_prev_period?>" style="display:none;">
    <i class="fa fa-pencil report-edit-btn" aria-hidden="true" data-id="<?=$page ->id?>"></i>
    <div class="row">
        <div class="col-md-2">
            <h3 class="report-title"><?=$page->report_page_title?></h3>
        </div>
        <div class="col-md-10">
            <div class="closed-content-view">
                <div class="title"><?=$page->report_page_title?></div>
                <div class="period"><?=$page->report_page_period?></div>
            </div>
            <div class="content-collapse hide">
                <div class="form-group report-period" style="display: none;">
                    <select class="form-control" name="report_type[]" value="<?=$page->report_page_type?>">
                        <option disabled></option>
                        <option <?php if($page->report_page_type == "1099 Contractor Balance Detail"){echo "selected";}?>>1099 Contractor Balance Detail</option>
                        <option <?php if($page->report_page_type == "1099 Contractor Balance Summar"){echo "selected";}?>>1099 Contractor Balance Summary</option>
                        <option <?php if($page->report_page_type == "1099 Transaction Detail Report"){echo "selected";}?>>1099 Transaction Detail Report</option>
                        <option <?php if($page->report_page_type == "A/P Aging Detail"){echo "selected";}?>>A/P Aging Detail</option>
                        <option <?php if($page->report_page_type == "A/P Aging Summary"){echo "selected";}?>>A/P Aging Summary</option>
                        <option <?php if($page->report_page_type == "A/R Aging Detail"){echo "selected";}?>>A/R Aging Detail</option>
                        <option <?php if($page->report_page_type == "A/R Aging Summary"){echo "selected";}?>>A/R Aging Summary</option>
                        <option <?php if($page->report_page_type == "Balance Sheet"){echo "selected";}?>>Balance Sheet</option>
                        <option <?php if($page->report_page_type == "Balance Sheet Comparison"){echo "selected";}?>>Balance Sheet Comparison</option>
                        <option <?php if($page->report_page_type == "Balance Sheet Detail"){echo "selected";}?>>Balance Sheet Detail</option>
                        <option <?php if($page->report_page_type == "Balance Sheet Summary"){echo "selected";}?>>Balance Sheet Summary</option>
                        <option <?php if($page->report_page_type == "Bill Payment List"){echo "selected";}?>>Bill Payment List</option>
                        <option <?php if($page->report_page_type == "Bills and Applied Payments"){echo "selected";}?>>Bills and Applied Payments</option>
                        <option <?php if($page->report_page_type == "Check Detail"){echo "selected";}?>>Check Detail</option>
                        <option <?php if($page->report_page_type == "Collections Report"){echo "selected";}?>>Collections Report</option>
                        <option <?php if($page->report_page_type == "Customer Balance Detail"){echo "selected";}?>>Customer Balance Detail</option>
                        <option <?php if($page->report_page_type == "Customer Balance Summary"){echo "selected";}?>>Customer Balance Summary</option>
                        <option <?php if($page->report_page_type == "Deposit Detail"){echo "selected";}?>>Deposit Detail</option>
                        <option <?php if($page->report_page_type == "Estimates & Progress Invoicing Summary by Customer"){echo "selected";}?>>Estimates & Progress Invoicing Summary by Customer</option>
                        <option <?php if($page->report_page_type == "Estimates by Customer"){echo "selected";}?>>Estimates by Customer</option>
                        <option <?php if($page->report_page_type == "Expenses by Vendor Summary"){echo "selected";}?>>Expenses by Vendor Summary</option>
                        <option <?php if($page->report_page_type == "General Ledger"){echo "selected";}?>>General Ledger</option>
                        <option <?php if($page->report_page_type == "Income by Customer Summary"){echo "selected";}?>>Income by Customer Summary</option>
                        <option <?php if($page->report_page_type == "Inventory Valuation Detail"){echo "selected";}?>>Inventory Valuation Detail</option>
                        <option <?php if($page->report_page_type == "Inventory Valuation Summary"){echo "selected";}?>>Inventory Valuation Summary</option>
                        <option <?php if($page->report_page_type == "Invoice List"){echo "selected";}?>>Invoice List</option>
                        <option <?php if($page->report_page_type == "Journal"){echo "selected";}?>>Journal</option>
                        <option <?php if($page->report_page_type == "Open Invoices"){echo "selected";}?>>Open Invoices</option>
                        <option <?php if($page->report_page_type == "Open Purchase Order List"){echo "selected";}?>>Open Purchase Order List</option>
                        <option <?php if($page->report_page_type == "Open Purchase Orders Detail"){echo "selected";}?>>Open Purchase Orders Detail</option>
                        <option <?php if($page->report_page_type == "Profit and Loss"){echo "selected";}?>>Profit and Loss</option>
                        <option <?php if($page->report_page_type == "Profit and Loss % of Total Income"){echo "selected";}?>>Profit and Loss % of Total Income </option>
                        <option <?php if($page->report_page_type == "Profit and Loss Comparison"){echo "selected";}?>>Profit and Loss Comparison</option>
                        <option <?php if($page->report_page_type == "Profit and Loss Detail"){echo "selected";}?>>Profit and Loss Detail</option>
                        <option <?php if($page->report_page_type == "Profit and Loss YTD Comparison"){echo "selected";}?>>Profit and Loss YTD Comparison</option>
                        <option <?php if($page->report_page_type == "Profit and Loss by Customer"){echo "selected";}?>>Profit and Loss by Customer</option>
                        <option <?php if($page->report_page_type == "Profit and Loss by Month"){echo "selected";}?>>Profit and Loss by Month</option>
                        <option <?php if($page->report_page_type == "Profit and Loss by Tag Group"){echo "selected";}?>>Profit and Loss by Tag Group</option>
                        <option <?php if($page->report_page_type == "Purchases by Product/Service Detail"){echo "selected";}?>>Purchases by Product/Service Detail</option>
                        <option <?php if($page->report_page_type == "Purchases by Vendor Detail"){echo "selected";}?>>Purchases by Vendor Detail</option>
                        <option <?php if($page->report_page_type == "Quarterly Profit and Loss Summary"){echo "selected";}?>>Quarterly Profit and Loss Summary</option>
                        <option <?php if($page->report_page_type == "Recent Automatic Transactions"){echo "selected";}?>>Recent Automatic Transactions</option>
                        <option <?php if($page->report_page_type == "Recent Transactions"){echo "selected";}?>>Recent Transactions</option>
                        <option <?php if($page->report_page_type == "Recurring Template List"){echo "selected";}?>>Recurring Template List</option>
                        <option <?php if($page->report_page_type == "Sales Tax Liability Report"){echo "selected";}?>>Sales Tax Liability Report</option>
                        <option <?php if($page->report_page_type == "Sales by Customer Detail"){echo "selected";}?>>Sales by Customer Detail</option>
                        <option <?php if($page->report_page_type == "Sales by Customer Summary"){echo "selected";}?>>Sales by Customer Summary</option>
                        <option <?php if($page->report_page_type == "Sales by Customer Type Detail"){echo "selected";}?>>Sales by Customer Type Detail</option>
                        <option <?php if($page->report_page_type == ">Sales by Product/Service Detail"){echo "selected";}?>>Sales by Product/Service Detail</option>
                        <option <?php if($page->report_page_type == "Sales by Product/Service Summary"){echo "selected";}?>>Sales by Product/Service Summary</option>
                        <option <?php if($page->report_page_type == "Statement of Cash Flows"){echo "selected";}?>>Statement of Cash Flows</option>
                        <option <?php if($page->report_page_type == "Taxable Sales Detail"){echo "selected";}?>>Taxable Sales Detail</option>
                        <option <?php if($page->report_page_type == "Taxable Sales Summary"){echo "selected";}?>>Taxable Sales Summary</option>
                        <option <?php if($page->report_page_type == "Transaction Detail by Account"){echo "selected";}?>>Transaction Detail by Account</option>
                        <option <?php if($page->report_page_type == "Transaction List by Customer"){echo "selected";}?>>Transaction List by Customer</option>
                        <option <?php if($page->report_page_type == "Transaction List by Date"){echo "selected";}?>>Transaction List by Date</option>
                        <option <?php if($page->report_page_type == "Transaction List by Tag Group"){echo "selected";}?>>Transaction List by Tag Group</option>
                        <option <?php if($page->report_page_type == "Transaction List by Vendor"){echo "selected";}?>>Transaction List by Vendor</option>
                        <option <?php if($page->report_page_type == "Transaction List with Splits"){echo "selected";}?>>Transaction List with Splits</option>
                        <option <?php if($page->report_page_type == "Trial Balance"){echo "selected";}?>>Trial Balance</option>
                        <option <?php if($page->report_page_type == "Unbilled Charges"){echo "selected";}?>>Unbilled Charges</option>
                        <option <?php if($page->report_page_type == "Unpaid Bills"){echo "selected";}?>>Unpaid Bills</option>
                        <option <?php if($page->report_page_type == "Vendor Balance Detail"){echo "selected";}?>>Vendor Balance Detail</option>
                        <option <?php if($page->report_page_type == "Vendor Balance Summary"){echo "selected";}?>>Vendor Balance Summary</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="label">
                        Title
                    </div>
                    <input type="text" class="form-control " name="report_title[]" value="<?=$page->report_page_title?>">
                    <label class="info">100 characters max</label>
                </div>
                <div class="form-group report-period">
                    <div class="label">
                        Report period
                    </div>
                    <select class="form-control" name="report_period[]" value="">
                        <option <?php if($page->report_page_period=="All Dates"){echo "selected";}?>>All Dates</option>
                        <option <?php if($page->report_page_period=="Custom"){echo "selected";}?>>Custom</option>
                        <option <?php if($page->report_page_period=="Today"){echo "selected";}?>>Today </option>
                        <option <?php if($page->report_page_period=="This Week"){echo "selected";}?>>This Week </option>
                        <option <?php if($page->report_page_period=="This Week-to-date"){echo "selected";}?>>This Week-to-date </option>
                        <option <?php if($page->report_page_period=="This Month"){echo "selected";}?>>This Month </option>
                        <option <?php if($page->report_page_period=="This Month-to-date"){echo "selected";}?>>This Month-to-date </option>
                        <option <?php if($page->report_page_period=="This Quarter"){echo "selected";}?>>This Quarter </option>
                        <option <?php if($page->report_page_period=="This Quarter-to-date"){echo "selected";}?>>This Quarter-to-date </option>
                        <option <?php if($page->report_page_period=="This Year"){echo "selected";}?>>This Year </option>
                        <option <?php if($page->report_page_period=="This Year-to-date"){echo "selected";}?>>This Year-to-date </option>
                        <option <?php if($page->report_page_period=="This Year-to-last-month"){echo "selected";}?>>This Year-to-last-month </option>
                        <option <?php if($page->report_page_period=="Yesterday"){echo "selected";}?>>Yesterday </option>
                        <option <?php if($page->report_page_period=="Recent"){echo "selected";}?>>Recent </option>
                        <option <?php if($page->report_page_period=="Last Week"){echo "selected";}?>>Last Week </option>
                        <option <?php if($page->report_page_period=="Last Week-to-date"){echo "selected";}?>>Last Week-to-date </option>
                        <option <?php if($page->report_page_period=="Last Month"){echo "selected";}?>>Last Month </option>
                        <option <?php if($page->report_page_period=="Last Month-to-date"){echo "selected";}?>>Last Month-to-date </option>
                        <option <?php if($page->report_page_period=="Last Quarter"){echo "selected";}?>>Last Quarter </option>
                        <option <?php if($page->report_page_period=="Last Quarter-to-date"){echo "selected";}?>>Last Quarter-to-date </option>
                        <option <?php if($page->report_page_period=="Last Year"){echo "selected";}?>>Last Year </option>
                        <option <?php if($page->report_page_period=="Last Year-to-date"){echo "selected";}?>>Last Year-to-date </option>
                        <option <?php if($page->report_page_period=="Since 30 Days Ago"){echo "selected";}?>>Since 30 Days Ago </option>
                        <option <?php if($page->report_page_period=="Since 60 Days Ago"){echo "selected";}?>>Since 60 Days Ago </option>
                        <option <?php if($page->report_page_period=="Since 90 Days Ago"){echo "selected";}?>>Since 90 Days Ago </option>
                        <option <?php if($page->report_page_period=="Since 365 Days Ago"){echo "selected";}?>>Since 365 Days Ago </option>
                        <option <?php if($page->report_page_period=="Next Week"){echo "selected";}?>>Next Week </option>
                        <option <?php if($page->report_page_period=="Next 4 Weeks"){echo "selected";}?>>Next 4 Weeks </option>
                        <option <?php if($page->report_page_period=="Next Month"){echo "selected";}?>>Next Month </option>
                        <option <?php if($page->report_page_period=="Next Quarter"){echo "selected";}?>>Next Quarter </option>
                        <option <?php if($page->report_page_period=="Next Year"){echo "selected";}?>>Next Year </option>
                    </select>
                </div>
                <div class="form-check" style="padding: 0 12px;">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="checkbox" name="report_compare_prev_year[]" id="report_compare_prev_year_<?=$data_count?>" <?php if($page->report_page_compare_prev_year == 1){echo 'checked="true"';} ?>>
                        <label for="report_compare_prev_year_<?=$data_count?>">Compare previous year</label>
                    </div>
                </div>
                <div class="form-check" style="padding: 0 12px;">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="checkbox" name="report_compare_prev_period[]" id="report_compare_prev_period_<?=$data_count?>" <?php if($page->report_page_compare_prev_period == 1){echo 'checked="true"';} ?>>
                        <label for="report_compare_prev_period_<?=$data_count?>">Compare previous period</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$data_count++;
    }
}else{
    if($data_count == "NaN"){
        $data_count=1;
    }
    ?>
<div class="report-section new_report" data-count="<?=$data_count?>">
    <input type="text" name="management_report_report_ids[]" value="0" style="display:none;">
    <input type="text" name="input_report_compare_prev_year[]" value="1" style="display:none;">
    <input type="text" name="input_report_compare_prev_period[]" value="0" style="display:none;">
    <i class="fa fa-trash-o report-delete-btn" aria-hidden="true" data-id="0"></i>
    <div class="row">
        <div class="col-md-2">
            <h3 class="report-title">New report</h3>
        </div>
        <div class="col-md-10">
            <div class="closed-content-view" style="display: none;">
                <div class="title"></div>
                <div class="period"></div>
            </div>
            <div class="content-collapse show" style="display: block;">
                <div class="form-group report-period">
                    <select class="form-control" name="report_type[]">
                        <option selected></option>
                        <option>1099 Contractor Balance Detail</option>
                        <option>1099 Contractor Balance Summary</option>
                        <option>1099 Transaction Detail Report</option>
                        <option>A/P Aging Detail</option>
                        <option>A/P Aging Summary</option>
                        <option>A/R Aging Detail</option>
                        <option>A/R Aging Summary</option>
                        <option>Balance Sheet</option>
                        <option>Balance Sheet Comparison</option>
                        <option>Balance Sheet Detail</option>
                        <option>Balance Sheet Summary</option>
                        <option>Bill Payment List</option>
                        <option>Bills and Applied Payments</option>
                        <option>Check Detail</option>
                        <option>Collections Report</option>
                        <option>Customer Balance Detail</option>
                        <option>Customer Balance Summary</option>
                        <option>Deposit Detail</option>
                        <option>Estimates & Progress Invoicing Summary by Customer</option>
                        <option>Estimates by Customer</option>
                        <option>Expenses by Vendor Summary</option>
                        <option>General Ledger</option>
                        <option>Income by Customer Summary</option>
                        <option>Inventory Valuation Detail</option>
                        <option>Inventory Valuation Summary</option>
                        <option>Invoice List</option>
                        <option>Journal</option>
                        <option>Open Invoices</option>
                        <option>Open Purchase Order List</option>
                        <option>Open Purchase Orders Detail</option>
                        <option>Profit and Loss</option>
                        <option>Profit and Loss % of Total Income </option>
                        <option>Profit and Loss Comparison</option>
                        <option>Profit and Loss Detail</option>
                        <option>Profit and Loss YTD Comparison</option>
                        <option>Profit and Loss by Customer</option>
                        <option>Profit and Loss by Month</option>
                        <option>Profit and Loss by Tag Group</option>
                        <option>Purchases by Product/Service Detail</option>
                        <option>Purchases by Vendor Detail</option>
                        <option>Quarterly Profit and Loss Summary</option>
                        <option>Recent Automatic Transactions</option>
                        <option>Recent Transactions</option>
                        <option>Recurring Template List</option>
                        <option>Sales Tax Liability Report</option>
                        <option>Sales by Customer Detail</option>
                        <option>Sales by Customer Summary</option>
                        <option>Sales by Customer Type Detail</option>
                        <option>Sales by Product/Service Detail</option>
                        <option>Sales by Product/Service Summary</option>
                        <option>Statement of Cash Flows</option>
                        <option>Taxable Sales Detail</option>
                        <option>Taxable Sales Summary</option>
                        <option>Transaction Detail by Account</option>
                        <option>Transaction List by Customer</option>
                        <option>Transaction List by Date</option>
                        <option>Transaction List by Tag Group</option>
                        <option>Transaction List by Vendor</option>
                        <option>Transaction List with Splits</option>
                        <option>Trial Balance</option>
                        <option>Unbilled Charges</option>
                        <option>Unpaid Bills</option>
                        <option>Vendor Balance Detail</option>
                        <option>Vendor Balance Summary</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="label">
                        Title
                    </div>
                    <input type="text" class="form-control " name="report_title[]">
                    <label class="info">100 characters max</label>
                </div>
                <div class="form-group report-period">
                    <div class="label">
                        Report period
                    </div>
                    <select class="form-control" name="report_period[]">
                        <option>All Dates</option>
                        <option>Custom</option>
                        <option>Today </option>
                        <option>This Week </option>
                        <option>This Week-to-date </option>
                        <option>This Month </option>
                        <option>This Month-to-date </option>
                        <option>This Quarter </option>
                        <option>This Quarter-to-date </option>
                        <option>This Year </option>
                        <option>This Year-to-date </option>
                        <option>This Year-to-last-month </option>
                        <option>Yesterday </option>
                        <option>Recent </option>
                        <option>Last Week </option>
                        <option>Last Week-to-date </option>
                        <option>Last Month </option>
                        <option>Last Month-to-date </option>
                        <option>Last Quarter </option>
                        <option>Last Quarter-to-date </option>
                        <option>Last Year </option>
                        <option>Last Year-to-date </option>
                        <option>Since 30 Days Ago </option>
                        <option>Since 60 Days Ago </option>
                        <option>Since 90 Days Ago </option>
                        <option>Since 365 Days Ago </option>
                        <option>Next Week </option>
                        <option>Next 4 Weeks </option>
                        <option>Next Month </option>
                        <option>Next Quarter </option>
                        <option>Next Year </option>
                    </select>
                </div>
                <div class="form-check" style="padding: 0 12px;">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="checkbox" name="report_compare_prev_year[]" id="report_compare_prev_year_<?=$data_count?>" checked="true">
                        <label for="report_compare_prev_year_<?=$data_count?>">Compare previous year</label>
                    </div>
                </div>
                <div class="form-check" style="padding: 0 12px;">
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="checkbox" name="report_compare_prev_period[]" id="report_compare_prev_period_<?=$data_count?>">
                        <label for="report_compare_prev_period_<?=$data_count?>">Compare previous period</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php
}