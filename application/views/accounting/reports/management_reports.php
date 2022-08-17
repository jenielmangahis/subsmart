<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/reports_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.
                        </div>
                    </div>
                </div>

                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Created By">CREATED BY</td>
                            <td data-name="Last Modified">LAST MODIFIED</td>
                            <td data-name="Report Period">REPORT PERIOD</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Test Management Report</td>
                            <td>John Doe</td>
                            <td></td>
                            <td>
                                <select name="report_period[]" class="nsm-field form-select">
                                    <option value="all-date">All Dates</option>
                                    <option value="custom">Custom</option>
                                    <option value="today">Today</option>
                                    <option value="this-week">This Week</option>
                                    <option value="this-week-to-date">This Week-to-date</option>
                                    <option value="this-month">This Month</option>
                                    <option value="this-month-to-date">This Month-to-date</option>
                                    <option value="this-quarter">This Quarter</option>
                                    <option value="this-quarter-to-date">This Quarter-to-date</option>
                                    <option value="this-year" selected>This Year</option>
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
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">View</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Send</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Export as PDF</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Export as DOCX</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Copy</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>