<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
/* Style the tab */
.tab_ {
  /* float: left; */
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 100%;
  height: 100%;
}

/* Style the buttons inside the tab */
.tab_ button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 0 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab_ button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab_ button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 80%;
  border-left: none;
  /* height: 300px; */
}  
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="padding-left:1%;">
        <div class="container-fluid" style="background-color:white;">
                    <div style="padding-top:1%;">
						<!-- <h3 style="font-family: Sarabun, sans-serif">Accounting Dashboard</h3> -->
                        <a class="link-modal-open" href="#" id="" data-toggle="modal" data-target="#account_settings"><h3 style="font-family: Sarabun, sans-serif">Accounting Dashboard</h3></a>
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
                                                <a href="#" data-toggle="modal" data-target="#addAccountModal">Connect accounts</a>
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

    <!-- Modal for add account-->
<div class="full-screen-modal">
    <div id="addAccountModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Connect an account</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container modal-container">
                        <div class="header-modal"><h3>Let's get a picture of your profits</h3></div>
                        <div class="sub-header-modal"><span>Connect your bank or credit card to bring in your transactions.</span></div>
                        <div class="body-modal">
                            <input type="text" class="form-control" placeholder="Enter your bank name or URL" style=" margin: 40px 0 50px 0;">
                            <div class=""><span>Here are some of the most popular ones</span></div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/citibank.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/chase-logo.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/bank-of-america.png') ?>" alt="">

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/Wells_Fargo.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/co-1200.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/us-bank-logo-vector.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/paypal_PNG20.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/pncbank_pms_c.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
    
    <!-- Modal -->
    <div class="full-screen-modal">
    <div id="account_settings" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Account and Settings</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-2" style="background-color:#eceef1;">
                        <!-- <p style="padding:2px;color:#898a8f;"><center>Company</center></p> -->
                        <div class="tab_">
                            <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Company</button>
                            <button class="tablinks" onclick="">Billing & Subscription</button>
                            <button class="tablinks" onclick="openCity(event, 'Paris')">Usage</button>
                            <button class="tablinks" onclick="openCity(event, 'Tokyo')">Sales</button>
                            <button class="tablinks" onclick="openCity(event, 'Expenses')">Expenses</button>
                            <button class="tablinks" onclick="openCity(event, 'payments')">Payments</button>
                            <button class="tablinks" onclick="openCity(event, 'Advanced')">Advanced</button>
                        </div>
                    </div>
                    <div id="London" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">
                            <p style="border:solid #0098cd 1px;padding:1%;width:80%;color:#0098cd;"><i class="fa fa-info-circle" style="font-size:18px;color:#0098cd"></i> You don't currently have permission to edit all company information. Check with your QuickBooks admin if you require access.</p>

                            <table class="table">
                                <tr>
                                    <td style="width:10%;">Company name</td>
                                    <td style="width:16%;padding:3%;">
                                        <p></p>
                                        <p>Company name</p>
                                        <p>Legal name</p>
                                        <p>EIN</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><img src="<?= getCompanyBusinessProfileImage(); ?>" class="invoice-print-logo"  style="max-width: 230px; max-height: 200px;" /></p>
                                        <p><?php echo $clients->business_name; ?></p>
                                        <p><?php echo $clients->business_name; ?></p>
                                        <p>XX-XXX6593</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Company type</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Tax form</p>
                                        <p>Industry</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Limited liability</p>
                                        <p>Information</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Contact info</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Company email</p>
                                        <p>Customer-facing email</p>
                                        <p>Company phone</p>
                                        <p>Website</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->email_address; ?></p>
                                        <p><?php echo $clients->email_address; ?></p>
                                        <p><?php echo $clients->phone_number; ?></p>
                                        <p>-</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Address</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Company address</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Address</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Customer-facing address</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Address</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Legal address</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Communications with Intuit</td>
                                    <td style="width:16%;padding:3%;">
                                        <p><a href="#">Marketing Preferences</a></p>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    

                    <div id="Paris" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">
                            <div style="padding:1%;width:80%;"> 
                                <h2>Usage limits</h2> 
                                <p>These are your usage limits for QuickBooks Online Plus. Need more room?</p>
                                <p>Upgrade to a plan with more capacity.</p>
                                <p><a href="#"><h6>Find out more about usage limits.</h6></a></p>

                                <br><br>
                                <p style="font-size:30px;">Billable Users</p>
                                <p>The limit for your plan is 5.</p>
                                <br><hr><br>
                                <p style="font-size:30px;">Chart of accounts</p>
                                <p>The limit for your plan is 250.</p>
                                <br><hr><br>
                            </div>

                        </div>
                    </div>

                    <div id="Tokyo" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">

                            <table class="table">
                                <tr>
                                    <td style="width:10%;">Customize</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Customize the way forms look to your customers</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><button class="btn btn-success">Customize look and feel</button></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Sales form content</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Preferred invoice terms</p>
                                        <p>Preferred delivery method</p>
                                        <p>Shipping</p>
                                        <p>Custom fields</p>
                                        <p>Custom transaction numbers</p>
                                        <p>Service date</p>
                                        <p>Discount</p>
                                        <p>Deposit </p>
                                        <p>Tips (Gratuity)</p>
                                        <p>Tags</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Net 30</p>
                                        <p>None</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Products and services</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Show Product/Service column on sales forms</p>
                                        <p>Show SKU column</p>
                                        <p>Turn on price rules</p>
                                        <p>Track quantity and price/rate</p>
                                        <p>Track inventory quantity on hand</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>On</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>On</p>
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Progress Invoicing</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>	Create multiple partial invoices from a single estimate</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Messages</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Default email message sent with sales forms</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Reminders</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Default email message for invoice reminders</p>
                                        <p>Automatic invoice reminders</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p> </p>
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Online delivery</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Email options for all sales forms</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Statements</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Show aging table at bottom of statement</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>On</p>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>


                    <div id="Expenses" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">
                            <div style="padding:1%;width:80%;"> 
                                <table class="table">
                                    <!-- <tr>
                                        <td style="width:10%;">Customize</td>
                                        <td style="width:30%;padding:3%;">
                                            <p>Customize the way forms look to your customers</p>
                                        </td>
                                        <td style="padding:3%;">
                                            <p><button class="btn btn-success">Customize look and feel</button></p>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td style="width:10%;">Sales form content</td>
                                        <td style="width:30%;padding:3%;">
                                            <p>Show Items table on expense and purchase forms</p>
                                            <p>Show Tags field on expense and purchase forms </p>
                                            <p>Track expenses and items by customer</p>
                                            <p>Make expenses and items billable</p>
                                            <p>Default bill payment terms</p>
                                            <!-- <p>Service date</p>
                                            <p>Discount</p>
                                            <p>Deposit </p>
                                            <p>Tips (Gratuity)</p>
                                            <p>Tags</p> -->
                                        </td>
                                        <td style="padding:3%;">
                                            <p>On</p>
                                            <p>On</p>
                                            <p>On</p>
                                            <p>On</p>
                                            <p>Net 30</p>
                                            <!-- <p>Off</p>
                                            <p>Off</p>
                                            <p>Off</p>
                                            <p>Off</p>
                                            <p>Off</p>
                                            <p>On</p> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:10%;">Purchase orders</td>
                                        <td style="width:30%;padding:3%;">
                                            <p>Use purchase orders</p>
                                        </td>
                                        <td style="padding:3%;">
                                            <p>On</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:10%;">Messages</td>
                                        <td style="width:30%;padding:3%;">
                                            <p>Default email message sent with sales forms</p>
                                        </td>
                                        <td style="padding:3%;">
                                            <p></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div id="payments" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">

                            <table class="table">
                                <tr>
                                    <td style="width:10%;">Merchant details</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Merchant ID 5247719993753319</p>
                                        <p>Run deposit reports</p>
                                        <p>See transaction details</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><button class="btn btn-success">Manage account</button></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Deposit Speed</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Credit Cards</p>
                                        <p>Bank Transfers</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>1 business day</p>
                                        <p>1 business day</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Deposit accounts</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Standard depositsl</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>TEST BANK (...6001) <a href="#">Change</a></p>
                                        <p>P.O. BOX 681</p>
                                        <p>PLACE, AL 35211</p>
                                        <p>-</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Business Owner info</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Owner's address</p>
                                        <p>Mobile Phone number</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                        <p>(123) 456-7890</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Address</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Customer-facing address</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><?php echo $clients->business_address; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Documents</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Monthly Statements</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>
                                            <select class="form-control">
                                                <option>July 2021</option>
                                            </select>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Chart of Accounts</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Tell us where in QuickBooks to automatically record:</p>
                                        <p>Standard deposits</p>
                                        <p>Processing fees</p>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Payment Methods</td>
                                    <td style="width:16%;padding:3%;">
                                        <p>Cards</p>
                                        <p>Bank Transfer</p>
                                        <p>PayPal</p>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    <div id="Advanced" class="tabcontent">
                        <div class="col-md-10" style="padding:1%;">

                            <table class="table">
                                <!-- <tr>
                                    <td style="width:10%;">Customize</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Customize the way forms look to your customers</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p><button class="btn btn-success">Customize look and feel</button></p>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td style="width:10%;">Accounting</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>First month of fiscal year</p>
                                        <p>First month of income tax year</p>
                                        <p>Accounting method</p>
                                        <p>Close the books</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>January</p>
                                        <p>Same as fiscal year</p>
                                        <p>Accrual</p>
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Chart of accounts</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Enable account numbers </p>
                                        <p>Tips account</p>
                                        <p>Markup income account </p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>OFF</p>
                                        <p> </p>
                                        <p>Markup</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Categories</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Track classes</p>
                                        <p>Track locations</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Off</p>
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Automation</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Pre-fill forms with previously entered content</p>
                                        <p>Automatically apply credits</p>
                                        <p>Automatically invoice unbilled activity</p>
                                        <p>Automatically apply bill payments</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Projects</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Organize all job-related activity in one place</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Time tracking</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Add Service field to timesheets</p>
                                        <p>Make Single-Time Activity Billable to Customer</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>On</p>
                                        <p>On</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Currency</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Home Currency</p>
                                        <p>Multicurrency</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>USD</p>
                                        <p>Off</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;">Other preferences</td>
                                    <td style="width:30%;padding:3%;">
                                        <p>Date format</p>
                                        <p>Number format</p>
                                        <p>Customer label</p>
                                        <p>Warn if duplicate check number is used</p>
                                        <p>Warn me when I enter a bill number that’s already been used for that vendor</p>
                                        <p>Warn if duplicate journal number is used</p>
                                        <p>Sign me out if inactive for</p>
                                    </td>
                                    <td style="padding:3%;">
                                        <p>MM/dd/yyyy</p>
                                        <p>123,456.00</p>
                                        <p>Customers</p>
                                        <p>On</p>
                                        <p>Off</p>
                                        <p>Off</p>
                                        <p>1 hour</p>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>





                </div>

                


                    
                </div>
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
    
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

<script>
    function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
