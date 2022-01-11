<div class="report-section new_report" data-count="<?=$data_count?>">
    <i class="fa fa-trash-o report-delete-btn" aria-hidden="true"></i>
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
                        <input type="checkbox" name="report_compare_prev_year[]" id="report_compare_prev_year_<?=$data_count?>">
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