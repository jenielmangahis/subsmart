<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php //include viewPath('includes/header'); 
include viewPath('v2/includes/accounting_header'); 
?>
<style>
    /* body {
     background-color: #f9f9fa
 } */

    .flex {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto
    }

    @media (max-width:991.98px) {
        .padding {
            padding: 1.5rem
        }
    }

    @media (max-width:767.98px) {
        .padding {
            padding: 1rem
        }
    }

    .padding {
        padding: 5rem
    }

    .card {
        background: #fff;
        border-width: 0;
        border-radius: .25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
        margin-bottom: 1.5rem
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(19, 24, 44, .125);
        border-radius: .25rem
    }

    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(19, 24, 44, .03);
        border-bottom: 1px solid rgba(19, 24, 44, .125)
    }

    .card-header:first-child {
        border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
    }

    card-footer,
    .card-header {
        background-color: transparent;
        border-color: rgba(160, 175, 185, .15);
        background-clip: padding-box
    }

    .sidebarForm {
        display: none;
    }

    #myChart_ {
        height: 350px !important;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        /* border: 1px solid #ccc;
  background-color: #f1f1f1; */
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }

    /* .updateoverduetable tr td
{
	padding: 3px !important;
} */

    .canvasjs-chart-credit {
        display: none !important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/accounting_dashboard.css">
-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>

<script type="text/javascript" id="js">
    // var tableRows = document.getElementsByTagName('tr');
    // console.dir(tableRows);
</script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?= base_url("assets/css/accounting/accounting.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/css/accounting/accounting_includes/cashflow.css") ?>">


<div class="wrapper" role="wrapper">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
    </div>
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div class="page-content page-container" id="page-content">
                    <!-- <div class="padding">
                        <div class="row">
                            <div class="container-fluid d-flex justify-content-center">
                                <div class="col-sm-8 col-md-12">
                                    <div class="card">
                                        <div class="card-header">Bar chart</div>
                                        <div class="card-body" style="height: 300px">
                                            <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                                </div>
                                            </div> <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row" style="margin-top:3%;">
                        <div class="col-md-12">
                            <h6>CASH FLOW</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Today's balance</h6>
                            <h4>$100,000</h4>
                        </div>
                        <div class="col-md-6">
                            <!-- <div class="tab" align="right" style="text-align:right;">
                                <button class="tablinks" onclick="openCity(event, 'MoneyIn')"
                                    style="border-radius: 12px 0 0 12px;padding:6%;">Money in/out</button>
                                <button class="tablinks" onclick="openCity(event, 'MoneyOut')"
                                    style="border-radius: 0 12px 12px 0;padding:6%;">Cash balance</button>
                            </div> -->
                            <div class="section-above-chart" style="float:right;">
                                <div class="cashflowchart-tab-btns">
                                    <button class="tablinks money_in_out">
                                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                                        Money in/out
                                    </button>
                                    <button class="tablinks cash_balance active">
                                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                        Cash balance
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px;">
                        <div class="col-md-6">
                            <div class="cash-flow-filter">
                                <select name="chart-month-range" class="duration">
                                    <option value="24">24 months [BETA]</option>
                                    <option value="12" selected>12 months</option>
                                    <option value="6">6 months</option>
                                    <option value="3">3 months</option>
                                    <option value="1">This month</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="section-above-chart">
                                <div class="cash_balance_chart_section" style="display: flex;">
                                    <div class="chart-legends">Cash balance</div>
                                    <div class="chart-legends">Projected</div>
                                </div>
                                <div class="money_in_out_chart_section" style="display: flex;display:none;">
                                    <div class="chart-legends">Money in</div>
                                    <div class="chart-legends">Money out</div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="cash-flow-section">
                        <div class="money_in_out_chart_section" style="display: none;">
                            <canvas id="cash_in_out_chart" style="height: 370px; width: 100%;"></canvas>
                        </div>
                        <div class="cash_balance_chart_section">
                            <canvas id="cash_balance_chart" style="height: 370px; width: 100%;"></canvas>
                            <div class="chart-x-label">
                                <div class="right-label">THRESHOLD</div>
                                <ul class="months months-12">
                                    <div class="line-divider"></div>
                                    <li class="moth month-1">JAN</li>
                                    <li class="moth month-2">FEB</li>
                                    <li class="moth month-3">MAR</li>
                                    <li class="moth month-4">APR</li>
                                    <li class="moth month-5">MAY</li>
                                    <li class="moth month-6">JUN</li>
                                    <li class="moth month-7">JUL</li>
                                    <li class="moth month-8">AUG</li>
                                    <li class="moth month-9">SEP</li>
                                    <li class="moth month-10">OCT</li>
                                    <li class="moth month-11">NOV</li>
                                    <li class="moth month-12">DEC</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!-- <p style="border:solid #0098cd 1px;padding:1%;width:80%;color:#0098cd;"><i class="fa fa-info-circle" style="font-size:18px;color:#0098cd"></i> This is a safe place to play with the numbers. Your planner won’t affect the rest of nSmarTrac.</p> -->
                    <br>
                    <div style="border:solid gray 1px;padding:1%;width:100%;color:black;">
                        <a href="#" style="color:blue;float:right;" data-toggle="modal" data-target=".updateoverdue">
                            <h5>Update</h5>
                        </a>
                        <h5>Overdue Transactions</h5>
                        You have <?php echo $totoverdues->totalOverdue; ?> overdue
                        transactions. For a more accurate cash flow picture, update each transaction with a new expected
                        date.
                    </div>
                    <br><br>
                    <div class="row pb-2">
                        <div class="col-md-8 banking-tab-container">
                            <div class="tab">
                                <!-- <button class="tablinks all active" onclick="openCity(event, 'London')">All</button>
                                <button class="tablinks money_in" onclick="openCity(event, 'Paris')">Money in</button>
                                <button class="tablinks money_out" onclick="openCity(event, 'Tokyo')">Money out</button> -->
                                <button class="tablinks all active">All</button>
                                <button class="tablinks money_in">Money in</button>
                                <button class="tablinks money_out">Money out</button>
                                <button class="tablinks overdue_planned">Overdue Planned</button>
                            </div>
                        </div>
                        <div class="col-md-4 banking-tab-container" align="right">
                            <div class="buttons">
                                <a href="<?php echo base_url('accounting/cashflowPDF/') ?>" class="banking-tab btn btn-primary" id="moneyall" style="color:white;">Export as PDF</a>
                                <div class="filter-btn-section">
                                    <button class="btn btn-default filter-btn" type="button">
                                        Filter <span class="fa fa-caret-down"></span></button>
                                    <div class="filter-panel" style="display: none;">
                                        <div class="achor-holder"><img src="<?= base_url("assets/img/accounting/customers/anchor.png") ?>" alt=""></div>

                                        <div class="header" style="display: flex;">
                                            <header><span class="h-title">Filter</span></header><button class="eks"><i class="fa fa-times" aria-hidden="true" style="font-size: 20px;"></i></button>
                                        </div>
                                        <div class="all_items">
                                            <div class="money_choice">
                                                <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                    <input class="colTable" type="checkbox" name="MONEY_IN" value="MONEY_IN" id="MONEY_IN" checked="">
                                                    <label for="MONEY_IN">
                                                        <span class="choices">MONEY IN</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                    <input class="colTable" type="checkbox" name="MONEY_OUT" value="MONEY_OUT" id="MONEY_OUT" checked="">
                                                    <label for="MONEY_OUT">
                                                        <span class="choices">MONEY OUT</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row cols">
                                                <div class="from-your-books col-4">
                                                    <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                        <input class="colTable" type="checkbox" name="fyb" value="fyb" id="fyb" checked="">
                                                        <label for="fyb">
                                                            <span class="items-all">FROM YOUR BOOKS</span>
                                                        </label>
                                                    </div>
                                                    <div class="fyb-items">
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="BILLS" value="BILLS" id="BILLS" checked="">
                                                            <label for="BILLS">
                                                                <span>BILLS</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="EXPENSES" value="EXPENSES" id="EXPENSES" checked="">
                                                            <label for="EXPENSES">
                                                                <span>EXPENSES</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="CHECK" value="CHECK" id="CHECK" checked="">
                                                            <label for="CHECK">
                                                                <span>CHECK</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="INVOICES" value="INVOICES" id="INVOICES" checked="">
                                                            <label for="INVOICES">
                                                                <span>INVOICES</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="CREDIT_CARDS" value="CREDIT_CARDS" id="CREDIT_CARDS" checked="">
                                                            <label for="CREDIT_CARDS">
                                                                <span>CREDIT CARDS</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="PAYCHECKS" value="PAYCHECKS" id="PAYCHECKS" checked="">
                                                            <label for="PAYCHECKS">
                                                                <span>PAYCHECKS</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="ESTIMATES" value="ESTIMATES" id="ESTIMATES" checked="">
                                                            <label for="ESTIMATES">
                                                                <span>ESTIMATES</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="SALES_RECEIPTS" value="SALES_RECEIPTS" id="SALES_RECEIPTS" checked="">
                                                            <label for="SALES_RECEIPTS">
                                                                <span>SALES RECEIPTS</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="prediction col-4">
                                                    <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                        <input class="colTable" type="checkbox" name="PREDICTED" value="PREDICTED" id="PREDICTED" checked="">
                                                        <label for="PREDICTED">
                                                            <span class="items-all">PREDICTED</span>
                                                        </label>
                                                    </div>
                                                    <div class="predicted-items">
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="CREDIT_CARDS1" value="CREDIT_CARDS1" id="CREDIT_CARDS1" checked="">
                                                            <label for="CREDIT_CARDS1">
                                                                <span>CREDIT CARDS</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="EXPENSES1" value="EXPENSES1" id="EXPENSES1" checked="">
                                                            <label for="EXPENSES1">
                                                                <span>EXPENSES</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="PAYROLL1" value="PAYROLL1" id="PAYROLL1" checked="">
                                                            <label for="PAYROLL1">
                                                                <span>PAYROLL</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="SALES_RECEIPTS1" value="SALES_RECEIPTS1" id="SALES_RECEIPTS1" checked="">
                                                            <label for="SALES_RECEIPTS1">
                                                                <span>SALES RECEIPTS</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="added-by-you col-4">
                                                    <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                        <input class="colTable" type="checkbox" name="ADDED_BY_YOU" value="ADDED_BY_YOU" id="ADDED_BY_YOU" checked="">
                                                        <label for="ADDED_BY_YOU">
                                                            <span class="items-all">ADDED BY YOU</span>
                                                        </label>
                                                    </div>
                                                    <div class="aby-items">
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="REPEATING" value="1" id="temp1" checked="">
                                                            <label for="temp1">
                                                                <span>REPEATING</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="MONEY_IN1" value="MONEY_IN1" id="MONEY_IN1" checked="">
                                                            <label for="MONEY_IN1">
                                                                <span>MONEY IN</span>
                                                            </label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec margin-right cash-filter" style="margin-left:60px; margin-top:20px;">
                                                            <input class="colTable" type="checkbox" name="MONEY_OUT1" value="MONEY_OUT1" id="MONEY_OUT1" checked="">
                                                            <label for="MONEY_OUT1">
                                                                <span>MONEY OUT</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="pull-right">
                                            <button class="btn btn-success apply-btn px-4" id="reset" type="button">Reset</button>
                                            <button class="btn btn-success apply-btn px-4" id="Apply" type="button">Apply</button>

                                        </div>
                                    </div>
                                </div>
                                <button class="banking-tab btn btn-success cfp_add_item" style="color:white;">Add
                                    item</button>
                            </div>
                        </div>
                    </div>
                    <!-- form for adding items -->
                    <div style="background-color:#f4f5f8;padding:1.5%;display:none;height: rem;" id="cfp_add_item_area">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" id="date_plan" name="item_date" class="form-control date_plan" placeholder="Date" required>
                            </div>
                            <div class="col-md-6 input-group" style="">
                                <input type="text" name="item_desc" class="form-control merchant_name" style="width: 65%;" placeholder="Merchant name" required> &nbsp;&nbsp;&nbsp;
                                <input type="text" name="item_amt" class="form-control plan_amount" style="width: 30%;" placeholder="$0.00" required>
                            </div>
                            <div class="col-md-2">
                                <label>Planned</label>
                            </div>
                            <div class="col-md-1" align="right">
                                <button" style="font-size:20px;" class="close_add_item"><i class="fa fa-times" aria-hidden="true" style="font-size: 20px;"></i></button>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="radioB">
                                    <div class="row1">
                                        <input type="radio" name="plan_type" id="plan_type" value="moneyin" required>
                                        <label for="money_in">
                                            <span>MONEY IN</span>
                                        </label>
                                    </div>
                                    <div class="row2">
                                        <input type="radio" name="plan_type" id="plan_type" value="moneyout">
                                        <label for="money_out">
                                            <span>MONEY OUT</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="radioS">
                                    <div class="F_row">
                                        <span>ONE-TIME</span>
                                        <div>
                                            <input type="checkbox" name="toggle_switch" id="toggle_switch">
                                            <label for="toggle_switch" id="labelcheck"></label>
                                        </div>
                                        <span>REPEATING</span>
                                    </div>
                                </div>
                                <div class="S_row" id="container_hide" style="display: none;">
                                    <div class="F_col">
                                        <div class="r1ow">
                                            <select name="sched" id="sched">
                                                <option value="daily" selected>DAILY</option>
                                                <option value="weekly">WEEKLY</option>
                                                <option value="monthly">MONTHLY</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="S_col">
                                        <div class="item1">
                                            <p class="finding">Repeats every weekday</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col">
                                <div class="daily_hide" style="display: none;">
                                    <div class="daily1">
                                        <h6>ON</h6>
                                        <div class="r2ow">

                                            <span>Weekdays</span>
                                            <div>
                                                <input type="checkbox" name="toggle_switch1" id="toggle_switch1">
                                                <label for="toggle_switch1" id="labelcheck1"></label>
                                            </div>
                                            <span>Everyday</span>
                                        </div>
                                    </div>
                                    <div class="daily2">
                                        <h6>END</h6>
                                        <div class="item2">
                                            <div class="radio1">
                                                <input type="radio" name="Dend" class="Dend daily_dne" value="does_not_end" id="dneS" checked><span id="dneS" >Does not end</span>
                                            </div>
                                            <div class="radio1">
                                                <input type="radio" name="Dend" class="Dend" value="date" id="dateD"><input type="date" class="daily_date" name="end_date" id="end_date" disabled>
                                            </div>
                                            <div class="radio1">
                                                <input type="radio" name="Dend" class="Dend" value="not" id="notD"><span id="not1">after</span><input type="text" name="number_of_times" class="daily_not" id="not" disabled><span>occurence(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="weekly_hide" style="display: none;">
                                    <div class="weekly1">
                                        <h6>Every</h6>
                                        <input type="text" name="num_weeks" class="num_weeks" required><span>week(s)</span>
                                    </div>
                                    <div class="weekly2">
                                        <h6>ON</h6>
                                        <div class="weekly2_items">
                                            <button class="days color" type="button" id="sun">
                                                S
                                            </button>
                                            <button class="days" type="button" id="mon">
                                                M
                                            </button>
                                            <button class="days" type="button" id="tue">
                                                T
                                            </button>
                                            <button class="days" type="button" id="wed">
                                                W
                                            </button>
                                            <button class="days" type="button" id="thu">
                                                T
                                            </button>
                                            <button class="days" type="button" id="fri">
                                                F
                                            </button>
                                            <button class="days" type="button" id="sat">
                                                S
                                            </button>

                                        </div>
                                    </div>
                                    <div class="weekly3">
                                        <h6>END</h6>
                                        <div class="item2">
                                            <div class="radio1">
                                                <input type="radio" name="Wend" value="does_not_end" id="dne" class="Wend" checked><span id="dneS">Does not end</span>
                                            </div>
                                            <div class="radio1">
                                                <input type="radio" name="Wend" value="date" id="date" class="Wend"> <input type="date" name="end_dateW" class="end_date" id="end_date" disabled>
                                            </div>
                                            <div class="radio1">
                                                <input type="radio" name="Wend" value="not" class="Wend"><span id="not1">after</span><input type="text" class="not" name="number_of_timesW" id="not" disabled><span>occurence(s)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <div class="monthly_hide" style="display: none;">
                                <div class="monthly1">
                                    <h6>Every</h6>
                                    <input type="text" name="num_months" class="num_months" required><span>month(s)</span>
                                </div>
                                <div class="monthly2">
                                    <h6>ON</h6>
                                    <div class="monthly_items">
                                        <div class="m2_item1">
                                            <input type="radio" class="rClass" name="day_sched" id="day_n" value="day" checked><span>day</span><input type="text" name="day_num" id="day_num" required>
                                        </div>
                                        <div class="m2_item2">
                                            <input type="radio" class="rClass" name="day_sched" value="spec_day"><span id="the">the</span>
                                            <select name="day_place" id="day_place" disabled>
                                                <option value="first" selected>FIRST</option>
                                                <option value="Second">SECOND</option>
                                                <option value="third">THIRD</option>
                                                <option value="fourth">FOURTH</option>
                                                <option value="fifth">FRIDAY</option>
                                            </select>
                                            <select name="day_want" id="day_want" disabled>
                                                <option value="SUNDAY" selected>SUNDAY</option>
                                                <option value="MONDAY">MONDAY</option>
                                                <option value="TUESDAY">TUESDAY</option>
                                                <option value="WEDNESDAY">WEDNESDAY</option>
                                                <option value="THURSDAY">THURSDAY</option>
                                                <option value="FRIDAY">FRIDAY</option>
                                                <option value="SATURDAY">SATURDAY</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="monthly3">
                                    <h6>END</h6>
                                    <div class="item2">
                                        <div class="radio1">
                                            <input type="radio" name="Mend" value="does_not_end" class="Mend" id="dne" required checked> <span id="dneS">Does not end</span>
                                        </div>
                                        <div class="radio1">
                                            <input type="radio" name="Mend" value="date" class="Mend" id="date"><input type="date" name="end_dateM" id="end_date" class="close_end" required disabled>
                                        </div>
                                        <div class="radio1">
                                            <input type="radio" name="Mend" class="Mend" value="not"><span id="not1">after</span><input type="text" name="number_of_timesM" id="not" class="close_not" required disabled><span>occurence(s)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                        </div>
                        <hr>
                        <button class="btn btn-warning bton savecashflowplannedForm">Save</button>
                    </div>
                    <!-- end off adding items -->
                    <br><br>

                    <div id="London" class="tabcontent all" style="display: block;">
                        <table class="table" id="cashflowtransactions">
                            <thead>
                                <th>DATE</th>
                                <th>DESCRIPTION</th>
                                <th>AMOUNT</th>
                                <th>TYPE</th>
                                <th></th>
                                <th ></th>
                            </thead>
                            <tbody class="planner_table">
                               
                                
                            </tbody>
                        </table>
                    </div>

                    <div id="Paris" class="tabcontent money_in">
                        <table class="table" id="cashflowmoneyin">
                            <thead>
                                <th>DATE</th>
                                <th>DESCRIPTION</th>
                                <th>AMOUNT</th>
                                <th>TYPE</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody class="moneyin_table">
                                
                            </tbody>
                        </table>

                    </div>
                </div>

                <div id="Tokyo" class="tabcontent money_out">
                    <table class="table" id="cashflowmoneyout">
                        <thead>
                            <th>DATE</th>
                            <th>DESCRIPTION</th>
                            <th>AMOUNT</th>
                            <th>TYPE</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody class="moneyout_table">
                          
                        </tbody>
                    </table>
                </div>

                <div id="England" class="tabcontent overdue_planned">
                    <table class="table" id="cashflow_overdue">
                        <thead>
                            <th>DATE</th>
                            <th>DESCRIPTION</th>
                            <th>AMOUNT</th>
                            <th>TYPE</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody class="overdue_table">
                          
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>

            <div class="modal fade updateoverdue" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div style="padding:3%;">
                            <h2>Overdue Transactions</h2>
                            <p>You have <?php echo $totoverdues->totalOverdue; ?>
                                overdue transactions. For a more accurate cash flow picture, update each transaction
                                with a new expected date.</p>

                            <table class="table table-condensed updateoverduetable" style="border-collapse:collapse;">
                                <thead>
                                    <th>DATE</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th>TYPE</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <!-- <tr>
											<td>08/20/2021</td>
											<td>John Doe</td>
											<td>$1000</td>
											<td>Invoice</td>
											<td><i class="fa fa-toggle-down"></i></td>
										</tr>-->
                                    <!-- <tr data-toggle="collapse" data-target="#demo3">
											<td>09/09/2021</td>
											<td>Jerrell Milton</td>
											<td>$1,980.35</td>
											<td>Invoice</td>
											<td><i class="fa fa-toggle-down"></i></td>
										</tr>
										<tr>
											<td colspan="6" class="hiddenRow" style="background-color: #f4f5f8; padding: 0 8px !important;">
												<div id="demo3" class="collapse">Demo3</div>
											</td>
										</tr>
										<tr data-toggle="collapse" data-target=".demo1">
											<td>09/09/2021</td>
											<td>Ronnie & Lynne Davis</td>
											<td>$1,980.35</td>
											<td>Invoice</td>
											<td><i class="fa fa-toggle-down"></i></td>
										</tr> 
										<tr>
											<td class="hiddenRow" colspan="5" style="background-color: #f4f5f8; padding: 0 8px !important;">
												<div class="collapse demo1">
															<table class="table">
																<tr>
																	<td style="width:20%;"><input type="text" value="09/09/2021" class="form-control"></td>
																	<td colspan="3">Ronnie & Lynne Davi</td>
																	<td style="width:24%;"><input type="text" value="1980.35" class="form-control"></td>
																	<td>Invoice</td>
																</tr>
																<tr>
																	<td colspan="3">
																		<table>
																			<tr>
																				<td>DUE DATE <br> 09/09/2021</td>
																				<td>DUE AMOUNT <br> $1,980.35</td>
																				<td>REF NUMBER <br> <a href="#" style="color: blue;"> 13271 </a></td>
																			</tr>
																		</table>
																	</td>
																	<td colspan="3"> <div align="right"> <a href="#" style="color:#0077c5;" class="btn">Remove</a> &emsp; <button class="btn btn-primary">Update</button> </div></td>
																</tr>
															</table>
												</div>
											</td>
										</tr> -->

                                    <?php foreach ($overdues as $overdue) { ?>

                                        <tr data-toggle="collapse" data-target=".demo<?php echo $overdue->id; ?>">
                                            <td><?php echo $overdue->due_date; ?>
                                            </td>
                                            <td><?php echo get_customer_by_id($overdue->customer_id)->first_name . ' ' . get_customer_by_id($overdue->customer_id)->last_name ?>
                                            </td>
                                            <td>$<?php echo number_format($overdue->grand_total, 2); ?>
                                            </td>
                                            <td>Invoice</td>
                                            <td><i class="fa fa-toggle-down"></i></td>
                                        </tr>
                                        <tr>
                                            <td class="hiddenRow" colspan="5" style="background-color: #f4f5f8; padding: 0 8px !important;">
                                                <div class="collapse demo<?php echo $overdue->id; ?>">
                                                    <!-- <div class="row">
														<div class="col-md-12"> -->
                                                    <table class="table">
                                                        <tr>
                                                            <td style="width:20%;"><input type="text" id="datepickerOD<?php echo $overdue->id; ?>" over-id="<?php echo $overdue->id; ?>" value="<?php echo $overdue->due_date; ?>" class="form-control overdate<?php echo $overdue->id; ?> overdate">
                                                            </td>
                                                            <td colspan="3"><?php echo get_customer_by_id($overdue->customer_id)->first_name . ' ' . get_customer_by_id($overdue->customer_id)->last_name ?>
                                                            </td>
                                                            <td style="width:24%;"><input type="text" value="<?php echo $overdue->grand_total; ?>" class="form-control overtotal<?php echo $overdue->id; ?>">
                                                            </td>
                                                            <td>Invoice</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <table>
                                                                    <tr>
                                                                        <td>DUE DATE <br> <?php echo $overdue->due_date; ?>
                                                                        </td>
                                                                        <td>DUE AMOUNT <br> $<?php echo $overdue->grand_total; ?>
                                                                        </td>
                                                                        <td>REF NUMBER <br> <a href="#" style="color: blue;"> <?php echo $overdue->id; ?>
                                                                            </a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td colspan="3">
                                                                <div align="right"> <a href="#" style="color:#0077c5;" class="btn">Remove</a> &emsp; <a href="#" over-id="<?php echo $overdue->id; ?>" class="btn btn-primary updateOverdue">Update</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- </div>
													</div> -->
                                                </div>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                    <!-- <tr data-toggle="collapse" data-target="#demo2">
											<td>09/09/2021</td>
											<td>Harry Dodich</td>
											<td>$1,980.35</td>
											<td>Invoice</td>
											<td><i class="fa fa-toggle-down"></i></td>
										</tr>
										<tr>
											<td colspan="6" class="hiddenRow" style="background-color: #f4f5f8; padding: 0 8px !important;">
												<div id="demo2" class="collapse">Demo2</div>
											</td>
										</tr> -->
                                </tbody>
                            </table>

                            <input type="submit" class="btn btn-success" value="Done" style="float: right;" data-dismiss="modal">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end container-fluid -->
    <?php //include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>


<script
    src="<?php echo $url->assets ?>js/accounting/accounting/cashflow.js">
</script>
<script>
    
    

    $(document).on("click", "#Apply", function(event) {
        setTimeout(function() {
            $(".filter-btn-section .filter-panel").fadeOut();
        }, 300);

    });
    $(document).on("click", "#reset", function(event) {
        $('input[name=CREDIT_CARDS1]').prop("checked", false);
        $('input[name=EXPENSES1]').prop("checked", false);
        $('input[name=PAYROLL1]').prop("checked", false);
        $('input[name=SALES_RECEIPTS1]').prop("checked", false);
        $('input[name=BILLS]').prop("checked", false);
        $('input[name=EXPENSES]').prop("checked", false);
        $('input[name=CHECK]').prop("checked", false);
        $('input[name=INVOICES]').prop("checked", false);
        $('input[name=CREDIT_CARDS]').prop("checked", false);
        $('input[name=PAYCHECKS]').prop("checked", false);
        $('input[name=ESTIMATES]').prop("checked", false);
        $('input[name=SALES_RECEIPTS]').prop("checked", false);
        $('input[name=REPEATING]').prop("checked", false);
        $('input[name=MONEY_IN1]').prop("checked", false);
        $('input[name=MONEY_OUT1]').prop("checked", false);
        $('input[name=MONEY_OUT]').prop("checked", false);
        $('input[name=MONEY_IN]').prop("checked", false);
        $('input[name=PREDICTED]').prop("checked", false);
        $('input[name=fyb]').prop("checked", false);
        $('input[name=ADDED_BY_YOU]').prop("checked", false);
    });
    $(document).on("click", "#PREDICTED", function(event) {
        if ($('input[name=PREDICTED]').is(":checked")) {
            $('input[name=CREDIT_CARDS1]').prop("checked", true);
            $('input[name=EXPENSES1]').prop("checked", true);
            $('input[name=PAYROLL1]').prop("checked", true);
            $('input[name=SALES_RECEIPTS1]').prop("checked", true);
        } else {
            $('input[name=CREDIT_CARDS1]').prop("checked", false);
            $('input[name=EXPENSES1]').prop("checked", false);
            $('input[name=PAYROLL1]').prop("checked", false);
            $('input[name=SALES_RECEIPTS1]').prop("checked", false);

        }
    });

    $(document).on("click", "#fyb", function(event) {
        if ($('input[name=fyb]').is(":checked")) {
            $('input[name=BILLS]').prop("checked", true);
            $('input[name=EXPENSES]').prop("checked", true);
            $('input[name=CHECK]').prop("checked", true);
            $('input[name=INVOICES]').prop("checked", true);
            $('input[name=CREDIT_CARDS]').prop("checked", true);
            $('input[name=PAYCHECKS]').prop("checked", true);
            $('input[name=ESTIMATES]').prop("checked", true);
            $('input[name=SALES_RECEIPTS]').prop("checked", true);
        } else {
            $('input[name=BILLS]').prop("checked", false);
            $('input[name=EXPENSES]').prop("checked", false);
            $('input[name=CHECK]').prop("checked", false);
            $('input[name=INVOICES]').prop("checked", false);
            $('input[name=CREDIT_CARDS]').prop("checked", false);
            $('input[name=PAYCHECKS]').prop("checked", false);
            $('input[name=ESTIMATES]').prop("checked", false);
            $('input[name=SALES_RECEIPTS]').prop("checked", false);

        }
    })
    $(document).on("click", "#ADDED_BY_YOU", function(event) {
        if ($('input[name=ADDED_BY_YOU]').is(":checked")) {
            $('input[name=REPEATING]').prop("checked", true);
            $('input[name=MONEY_IN1]').prop("checked", true);
            $('input[name=MONEY_OUT1]').prop("checked", true);

        } else {
            $('input[name=REPEATING]').prop("checked", false);
            $('input[name=MONEY_IN1]').prop("checked", false);
            $('input[name=MONEY_OUT1]').prop("checked", false);
        }
    });
    // $(document).on("click", ".savecashflowplanned", function(event) {
    //     var date = $('.addDate').val();
    //     var name = $('.merchant_name').val();
    //     var amount = $('.plan_amount').val();
    // })






    // $(document).on("click", function(event) {
    //     if ($(event.target).closest(".filter-btn-section button.filter-btn").length === 0) {
    //         $(".filter-btn-section .filter-panel").hide();
    //     }
    // });
    <?php
    $data_dates_projected = "[";
    $data_dates = "[";
    $data_labels = "[";

    $data_dates_projected_3m = "[";
    $data_dates_3m = "[";
    $data_labels_3m = "[";
    $date_start = date("Y-m-d", strtotime("- 10 months", strtotime(date("Y-m-01"))));
    $date_end = date("Y-m-t", strtotime("+ 2 months", strtotime(date("Y-m-01"))));
    $total = 0;
    $month = date("m", strtotime($date_start));
    $ctr = 0;
    while ($date_start <= $date_end) {
        $value = rand(rand(1, $ctr + 2), $ctr + 2);
        if ($month == date("m", strtotime($date_start))) {
            $total += $value;
        } else {
            $month = date("m", strtotime($date_start));
            $data_dates .= $total . ",";
            $data_dates_projected .= rand(rand(1, $total), $total + 2) . ",";
            $data_labels .= "'" . strtoupper(date("M", strtotime($date_start))) . "',";
            $total = 0;
        }
        $date_start = date("Y-m-d", strtotime("+ 1 day", strtotime($date_start)));
        $ctr++;
    }
    $data_dates_projected .= "]";
    $data_dates .= "]";
    $data_labels .= "]";

    $data_dates_projected_3m .= "]";
    $data_dates_3m .= "]";
    $data_labels_3m .= "]";
    ?>

    var labels = <?= $data_labels ?>;
    var data = <?= $data_dates ?>;
    var data_projected = <?= $data_dates_projected ?>;

    var labels_3m = <?= $data_labels_3m ?>;
    var data_3m = <?= $data_dates_3m ?>;
    var data_projected_3m = <?= $data_dates_projected_3m ?>;
</script>
<script>
    $('.savecashflowplannedForm').click(function() {
		//   alert('test');
		var date_planDate = $("#date_plan").val();
		var merchant_name = $(".merchant_name").val();
		var plan_amount = $(".plan_amount").val();
		//   plan_type 2x
		var plan_type = $('input[name="plan_type"]:checked').val();

		// alert(plan_type);

		if ($('.plan_repeat').is(':checked')) {
			var plan_repeat = '1';
		} else {
			var plan_repeat = '0';
		}

		//   plan_repeat

		// sucess("Data Added Successfully!");

        // alert($("#date_plan").val());
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>accounting/savecashflowplan",
			dataType: 'json',
			data: {
				date_planDate: date_planDate,
				merchant_name: merchant_name,
				plan_amount: plan_amount,
				plan_type: plan_type,
				plan_repeat: plan_repeat
			},
			success: function(response) {
				sucess("Data Added Successfully!");
			},
		});

		// function sucess(information, $id) {
		// 	Swal.fire({
		// 		title: 'Success!',
		// 		text: information,
		// 		icon: 'success',
		// 		showCancelButton: false,
		// 		confirmButtonColor: '#32243d',
		// 		cancelButtonColor: '#d33',
		// 		confirmButtonText: 'Ok'
		// 	}).then((result) => {
		// 		if (result.value) {
		// 			location.reload();
		// 		}
		// 	});
		// }
	});
</script>

<?php include viewPath('v2/includes/footer'); ?>
<?php //include viewPath('includes/footer_accounting');
      include viewPath('accounting/cashflow_modal');

