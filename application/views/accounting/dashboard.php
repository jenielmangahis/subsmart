<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1%;">
        <div class="container-fluid" style="background-color:white;">
                    <div style="padding-top:1%;">
						<h3 style="font-family: Sarabun, sans-serif">Accounting Dashboard</h3>
					</div>
            <div class="page-title-box">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="income tile-container" style="height:445px;">
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Income</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content">Last 365 Days</div>
                                                </div>
                                            </div>
                                            <div class="con-inner-container">
                                                <div class="con-bar">
                                                    <div class="open-invoices box-invoices-bar"></div>
                                                    <div class="paid-invoices box-invoices-bar"></div>
                                                </div>
                                                <div class="con-data-label">
                                                    <div class="con-label">3</div>
                                                    <div class="con-sub-label">Open invoices</div>
                                                    <div class="con-label">0</div>
                                                    <div class="con-sub-label">Overdue invoices</div>
                                                    <div class="con-label">0</div>
                                                    <div class="con-sub-label">Paid last 30 days</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="expenses tile-container" style="height:445px;">
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Expenses</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content">
                                                        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                            <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                Last 30 Days&nbsp;<span class="fa fa-caret-down"></span></span>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="#" class="dropdown-item">Last 30 Days</a></li>
                                                                <li><a href="#" class="dropdown-item">This month</a></li>
                                                                <li><a href="#" class="dropdown-item">This quarter</a></li>
                                                                <li><a href="#" class="dropdown-item">This year</a></li>
                                                                <li><a href="#" class="dropdown-item">Last month</a></li>
                                                                <li><a href="#" class="dropdown-item">Last quarter</a></li>
                                                                <li><a href="#" class="dropdown-item">Last year</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="expenses-money-section">
                                                <div class="expenses-money-data">$4,247</div>
                                                <div class="expenses-con-data">This month</div>
                                            </div>
                                            <div class="expenses-donutchart-section">
                                                <div class="donut-chart-container">
                                                   <div id="expensesChart" style="width: 150px;height: 170px;"></div>
                                                    <div id="legendExpenses">
                                                        <div class="legendList">
                                                            <div class="box"></div>
                                                            <div class="amount">74%</div>
                                                            <div class="name">Commission & fees</div>
                                                            <div class="box" style="background: #3980b5;"></div>
                                                            <div class="amount">19%</div>
                                                            <div class="name">Reimburtment</div>
                                                            <div class="box" style="background: #95bbd7;"></div>
                                                            <div class="amount">7%</div>
                                                            <div class="name">Subcontractors</div>
                                                            <div class="box" style="background: #caddeb;"></div>
                                                            <div class="amount">2%</div>
                                                            <div class="name">Bank Charges</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="bank-accounts tile-container" style="height:445px;">
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Bank Accounts</h3>
                                                <a href="" style="float: right;"><i class="fa fa-pencil fa-lg"></i></a>
                                                <div class="header-separator">
                                                    <div class="hs-content">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bankList">
                                                <div class="dgrid-row connectedAccount">
                                                    <div class="bankAccountRowLink bankAccountRow">
                                                        <div class="bankRow">
                                                            <div class="bankRowHeader">
                                                                <div class="qboNameHeader">
                                                                    <div class="qboName">Corporate Account (XXXXXX 5850)</div>
                                                                </div>
                                                                <div class="headerMessage">
                                                                    <div class="pendingTxns">11 to review</div>
                                                                </div>
                                                            </div>
                                                            <div class="bankRowDetail">
                                                                <div class="description">
                                                                    <div class="balanceDescription">Bank balance</div>
                                                                    <div class="nsBalanceDescription">In nSmartrac</div>
                                                                </div>
                                                                <div class="accountDetails">
                                                                    <div class="balance">
                                                                        <div class="bankBalance">$5,741.11</div>
                                                                        <div class="nsBalance">$-7,049.40</div>
                                                                    </div>
                                                                    <div class="count">
                                                                        <div class="lastUpdated line-clamp">Updated 1 day ago</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dgrid-row">
                                                    <div class="bankAccountRowLink bankAccountRow">
                                                        <div class="bankRow">
                                                            <div class="bankRowHeader">
                                                                <div class="qboNameHeader">
                                                                    <div class="qboName">Cash on hand</div>
                                                                </div>
                                                                <div class="headerMessage">
                                                                    <div class="pendingTxns"></div>
                                                                </div>
                                                            </div>
                                                            <div class="bankRowDetail">
                                                                <div class="description">
                                                                    <div class="nsBalanceDescription">In nSmartrac</div>
                                                                </div>
                                                                <div class="accountDetails">
                                                                    <div class="count">
                                                                        <div class="bankBalance" style="display: none">$0</div>
                                                                        <div class="nsBalance">$111,101.00</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dgrid-row">
                                                    <div class="bankAccountRowLink bankAccountRow">
                                                        <div class="bankRow">
                                                            <div class="bankRowHeader">
                                                                <div class="qboNameHeader">
                                                                    <div class="qboName">Corporate Account (XXXXXX 5850)Te</div>
                                                                </div>
                                                                <div class="headerMessage">
                                                                    <div class="pendingTxns"></div>
                                                                </div>
                                                            </div>
                                                            <div class="bankRowDetail">
                                                                <div class="description">
                                                                    <div class="nsBalanceDescription">In nSmartrac</div>
                                                                </div>
                                                                <div class="accountDetails">
                                                                    <div class="count">
                                                                        <div class="bankBalance" style="display: none">$0</div>
                                                                        <div class="nsBalance">$0</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="addFISection">
                                                <a href="#">Connect accounts</a>
                                                <div class="registerLink">
                                                    <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                            <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                Go to register&nbsp;<span class="fa fa-caret-down"></span></span>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#" class="dropdown-item">Corporate Account (XXXXXX 5850)</a></li>
                                                            <li><a href="#" class="dropdown-item">Cash on hand</a></li>
                                                            <li><a href="#" class="dropdown-item">Corporate Account (XXXXXX 5850)Te</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--                        <div class="col-sm-6">-->
                    <!--                            <div class="float-right d-none d-md-block">-->
                    <!--                                <div class="dropdown">-->
                    <!--                                    --><?php ////if (hasPermissions('users_add')): ?>
                    <!--                                        <!-- <a href="--><?php ////echo url('users/add') ?><!--" class="btn btn-primary"-->
                    <!--                                       aria-expanded="false">-->
                    <!--                                        <i class="mdi mdi-settings mr-2"></i> New Employee-->
                    <!--                                    </a> -->
                    <!--                                    --><?php //endif ?>
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->

                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <?php $this->load->view('accounting/shortcuts'); ?>
                    </div>
                    <div class="col-sm-4">
                        <div class="sales tile-container" style="height:445px;">
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Sales</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content">
                                                        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                            <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                Last 30 Days&nbsp;<span class="fa fa-caret-down"></span></span>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="#" class="dropdown-item">Last 30 Days</a></li>
                                                                <li><a href="#" class="dropdown-item">This month</a></li>
                                                                <li><a href="#" class="dropdown-item">This quarter</a></li>
                                                                <li><a href="#" class="dropdown-item">This year</a></li>
                                                                <li><a href="#" class="dropdown-item">Last month</a></li>
                                                                <li><a href="#" class="dropdown-item">Last quarter</a></li>
                                                                <li><a href="#" class="dropdown-item">Last year</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="moduleContent">
                                                <div class="subContainer salesValues" style="height:300px;">
                                                    <div class="paid moneySection">
                                                        <div class="fancyMoney">$4</div>
                                                        <div class="fancyText dataSelection">Last 30 Days</div>
                                                    </div>
                                                    <div id="sales-line-chart" style="height: 200px"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="more tile-container" style="height:445px;">
                            <div class="inner-container">
                                <div class="tileContent">
                                    <div class="clear">
                                        <div class="inner-content">
                                            <div class="header-container">
                                                <h3 class="header-content">Discover More</h3>
                                                <div class="header-separator">
                                                    <div class="hs-content">
                                                        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                            <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i></span>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="#" class="dropdown-item">Close, not relevant</a></li>
                                                                <li><a href="#" class="dropdown-item">Close, show me later</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="discoverMore-container">
                                                <div id="discoverMore" class="carousel slide" data-ride="carousel">
                                                    <!-- The slideshow -->
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <div style="position: relative;display: flex;align-items: center;justify-content: center;width: 280px;height: 85px;">
                                                                <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132646/Energy-Beam_Payroll.svg" alt="Image1" width="100%" height="100%">
                                                            </div>
                                                            <div class="content-container">
                                                                <h3>Keep your signs with the times</h3>
                                                                <div class="sub-header-container">
                                                                    Your team will know their rights. You'll be complaint. Update your labor law posters.
                                                                </div>
                                                                <div class="cta-container">
                                                                    <a href="">Get your posters</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <div class="card-content">
                                                                <h3>Share securely with others</h3>
                                                                <div class="divider-bar green-bar"></div>
                                                                <div class="divider-dot green-dot"></div>
                                                                <div class="sub-header">
                                                                    New present custom roles help you delegate access, only in nSmartrac Online Advance.
                                                                </div>
                                                                <a href="#">See how it works</a>
                                                            </div>
                                                            <div class="card-img">
                                                                <div style="position:relative;display: flex;align-items: center;justify-content: center;">
                                                                    <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/07/09104533/2_new-Bolt_lifestyle_TIPS_ACCOUNTING.svg" alt="Share securely with others" style="max-width: 100%;max-height: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <div class="card-content">
                                                                <h3>Goodbye, paper timesheets!</h3>
                                                                <div class="divider-bar orange-bar"></div>
                                                                <div class="divider-dot orange-dot"></div>
                                                                <div class="sub-header">
                                                                    Employees track time on any device, and it automatically appears in nSmartrac.
                                                                </div>
                                                                <a href="#">Try TSheets for Free</a>
                                                            </div>
                                                            <div class="card-img">
                                                                <div style="position:relative;display: flex;align-items: center;justify-content: center;">
                                                                    <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/07/09104804/2_new-Bolt_lifestyle_TIPS_TIMETRACKING.svg" style="max-width: 100%;max-height: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <div class="card-content">
                                                                <h3>Work even smarter</h3>
                                                                <div class="divider-bar green-bar"></div>
                                                                <div class="divider-dot green-dot"></div>
                                                                <div class="sub-header">
                                                                    Easily track KPI is with automated performance dashboards in nSmartrac Online Advanced.
                                                                </div>
                                                                <a href="#">See how it works</a>
                                                            </div>
                                                            <div class="card-img">
                                                                <div style="position:relative;display: flex;align-items: center;justify-content: center;margin-top: 50px">
                                                                    <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132407/Energy-Beam_QuickBooks.svg" style="max-width: 100%;max-height: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <div style="position: relative;display: flex;align-items: center;justify-content: center;width: 280px;height: 85px;">
                                                                <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132646/Energy-Beam_Payroll.svg" alt="Image1" width="100%" height="100%">
                                                            </div>
                                                            <div class="content-container">
                                                                <h3>Pay worker's comp as you go</h3>
                                                                <div class="sub-header-container">
                                                                    Do you know workers' comp can be automatically paid with payroll?
                                                                </div>
                                                                <div class="cta-container">
                                                                    <a href="">Get started</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <div class="card-content">
                                                                <h3>Find the right insurance</h3>
                                                                <div class="divider-bar gray-bar"></div>
                                                                <div class="divider-dot gray-dot"></div>
                                                                <div class="sub-header">
                                                                    Explore affordable coverage options and protect your business right from nSmartrac.
                                                                </div>
                                                                <a href="#">See coverage option</a>
                                                            </div>
                                                            <div class="card-img">
                                                                <div style="position:relative;display: flex;align-items: center;justify-content: center;margin-top: 50px">
                                                                    <img src="https://plugin.intuitcdn.net/designsystem/assets/2019/03/27132407/Energy-Beam_QuickBooks.svg" style="max-width: 100%;max-height: 100%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Left and right controls -->
                                                    <a class="carousel-control-prev" href="#discoverMore" data-slide="prev">
                                                        <i class="fa fa-chevron-left"></i>
                                                    </a>
                                                    <a class="carousel-control-next" href="#discoverMore" data-slide="next">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </a>
                                                    <!-- Indicators -->
                                                    <ul class="carousel-indicators" id="indicator">
                                                        <li data-target="#discoverMore" data-slide-to="0" class="active"></li>
                                                        <li data-target="#discoverMore" data-slide-to="1"></li>
                                                        <li data-target="#discoverMore" data-slide-to="2"></li>
                                                        <li data-target="#discoverMore" data-slide-to="3"></li>
                                                        <li data-target="#discoverMore" data-slide-to="4"></li>
                                                        <li data-target="#discoverMore" data-slide-to="5"></li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="activity-container">
                    <a href="<?php echo url('/accounting/audit_log') ?>" class="activityLink">See all activity</a>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    $(document).ready(function () {
        // Donut Graph
        var Data = [
            {label:"Commissions & Fees",value:74},
            {label:"Reimburstment",value:19},
            {label:"Subcontractors",value:7},
            {label:"Bank Charges",value:2}
        ];
        var total = 100;
        var donut_chart = Morris.Donut({
            element: 'expensesChart',
            data:Data,
            resize:true,
            formatter: function (value, data) {
            return Math.floor(value/total*100) + '%';
            }
        });
    });
    $(function () {
        "use strict";
        // LINE CHART
        var data=[
            {"date":"Jun 14 - Jun 20","sales":"0"},
            {"date":"Jun 21 - Jun 27","sales":"0"},
            {"date":"Jun 28 - Jul 4","sales":"0"},
            {"date":"Jul 5 - Jul 11","sales":"4"},
            {"date":"Jul 12 - Jul 13","sales":"0"}
        ];

        Morris.Line({
            element: 'sales-line-chart',
            data: data,
            resize:true,
            xkey: ['date'],
            ykeys: ['sales'],
            ymax:12,
            labels: ['Sales'],
            preUnits:'$',
            parseTime : false
        });

    });

</script>
