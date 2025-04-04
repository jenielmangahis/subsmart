<?php include viewPath('v2/includes/accounting_header'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<?php include viewPath('v2/includes/accounting/all_sales_modals'); ?>
<style>
.shortcuts-btn a{
    width:100%;
    display:block;
    font-size:16px;
}
</style>
<div class="row page-content g-0">

    <input type="hidden" id="siteurl" value="<?= base_url(); ?>">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            The Sales Overview is available for you to see and track transactions pertaining to sales. This new
                            screen allows you to see at a glance income over a period of time, mobile payment options, pending
                            invoices and upcoming deposits. Each of the areas can be clicked to view details. From invoices to
                            inventory it can be done here.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-7">
                        <div class="nsm-card primary">
                            <div class="row nsm-card-header">
                                <div class="col-md-4 nsm-card-title">
                                    <h4>INCOME OVER TIME </h4> <i class="bx bx-info-circle" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-4">
                                    <div class="duration">
                                        <label for="">Duration:</label>
                                        <select name="duration" id="duration" class="duration">
                                            <option value="This month">This month</option>
                                            <option value="Last month">Last month</option>
                                            <option value="This quarter">This quarter</option>
                                            <option value="Last quarter">Last quarter</option>
                                            <option value="This year by month">This year by month</option>
                                            <option value="This year by quarter">This year by quarter</option>
                                            <option value="Last year by month">Last year by month</option>
                                            <option value="Last year by quarter">Last year by quarter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="compare-prev-year">
                                        <label class="main-label">Compare previous year:</label>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" on class="custom-control-input" id="compare-prev-year">
                                                <label class="custom-control-label" for="compare-prev-year"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="content-monitary-highlight">
                                    <span class="amount" style="font-size:25px;font-weight:bold;" id="income_this_month">$<?= number_format($income_this_month, 2) ?></span>
                                    <span class="label" id="duration_label">This month</span>
                                </div>
                                <div class="monitary-increase" style="color:green;font-weight:bold;">

                                    <span id="income_difference">$<?= number_format($income_this_month - $income_last_month, 2) ?></span>
                                    <span>more than</span> <span id="income_date_difference"><?= date("M d", strtotime("first day of previous month")) ?>
                                        - <?= date("d, Y", strtotime("last day of previous month")) ?></span>
                                </div>
                                <div id="chartContainer11" class="dynamic-graph-container" style="display:none;width: 100%; height:200px;">

                                </div>
                                <canvas id="overview_chart" style="height: 150px; width: 100%;"></canvas>

                            </div>
                        </div>
                        <!-- <div class="nsm-card primary" style="margin-top:10px;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">  </div>
                            </div>
                            <div class="nsm-card-content">
                            </div>
                        </div> -->
                    </div>
                    <div class="col-md-5 mb-3" id="learn_how_payments" style="height:160px">
                        <div class="nsm-card primary">
                            <h4>Learn how to use payments</h4>
                            <p>Learn how to use nSmarTrac Payments to get paid online, in-person, and on the go.</p>
                            <div style="float:right;text-decoration:none;">
                                <button onclick="window.location.href='<?= base_url('accounting/banking') ?>'" class="nsm-button success">Learn More</button>
                            </div>
                        </div>

                        <div class="nsm-card primary h-100 mt-2">
                            <h4 class="mb-3">SHORTCUTS</h4>
                            <div class="row shortcuts-btn">
                                <div class="col-md-6">
                                    <a id="new-invoice" class="nsm-button success"> New Invoice</a>
                                    <a id="new-recurring-invoice" class="nsm-button success">Recurring Invoice</a>
                                </div>
                                <div class="col-md-6">
                                    <a id="new-sales-receipt" class="nsm-button success">New Sale</a>
                                    <a id="new-recurring-sale" class="nsm-button success">Recurring Sale</a>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="nsm-card primary pb-0">
                            <h4>Invoices</h4>
                            <div class="row">
                                <div class="col-md-3 d-flex align-items-start" style="color:red; padding: 5px;">
                                    <i class="fa fa-exclamation-triangle mt-2" aria-hidden="true" style="font-size:40px;"></i>
                                    <div style="padding-left: 10px; font-size:17px;">
                                        <b>Needs Attention <br>$ <?= number_format($unpaid_last_365, 2) ?></b>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <b>$<?= number_format($unpaid_last_365, 2) ?> Unpaid</b>
                                                <h4>$<?= number_format($due_last_365, 2) ?></h4> Overdue
                                            </td>
                                            <td>
                                                <b>Last 365 days</b>
                                                <h4>$<?= number_format($not_due_last_365, 2) ?></h4> Not Due Yet
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <b>$<?= number_format($deposited_last30_days, 2) ?> Deposited </b>
                                                <h4>$<?= number_format($not_deposited_last30_days, 2) ?></h4> Not Deposited
                                            </td>
                                            <td>
                                                <b>Last 30 days</b>
                                                <h4>$<?= number_format($paid_last_30, 2) ?></h4> Paid Last 30 days
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>


<script src="<?php echo $url->assets ?>js/accounting/sales/overview.js"></script>
<script>
    var chart;
    var graph_data = {};
    var graph_data_prev = {};
    var income_per_day;
    var income_per_month;
    var income_per_quarter;
    var last_income_per_day;
    var last_income_per_month;
    var last_income_per_quarter;
    var income_label = "";
    var last_income_label = "";
    var income_month_label = "";
    var income_year_label = "";

    window.onload = function() {
        income_overtime_duration_changed();
    }
</script>