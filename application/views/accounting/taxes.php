<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php /*include viewPath('includes/sidebars/accounting/taxes');*/ ?>
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
               <!-- Add Agency Sidebar -->
    <!-- Add Agency Sidebar -->
    <div id="overlay-adjustment" class=""></div>
    <div id="side-menu-adjustment" class="main-side-nav">
        <div class="side-title">
            <h4>Add an adjustment</h4>
            <a id="close-menu" class="menuCloseButton" onclick="closeSideNav4()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <p class="sinot">An adjustment is an increase or decrease to the sales tax, including credits discounts, interest, penalties and corrections.</p>
        <div class="mainMenu nav">
            <div class="add-frm">
                <div class="form-group">
                    <label>Reason</label>
                    <select class="form-control">
                        <option></option>
                        <option>Credit</option>
                        <option>Pre Payments</option>
                        <option>Others</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account</label>
                    <select class="form-control">
                        <option>Sales</option>
                        <option>Gross Receipt</option>
                        <option>Services</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" name="" placeholder="Enter Amount" class="form-control">
                </div>
            </div>
        </div>

        <div class="save-act">
            <button class="savebtn">ADD</button>
        </div>
    </div>
    <!-- End Add Agency Sidebar -->

    <!-- Recived Taxs -->
    <div class="modal" id="revice-taxs">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reci-block">
                    <h3>Review your sales tax <button type="button" class="close" data-dismiss="modal">&times;</button></h3>   

                    <div class="tax-invoice-box">
                        <div class="tax-block">
                            <div class="tax-left-dt">
                                <h4>Alabama Department of Revenue</h4>
                                <h6>Tax Period: April to June 2020</h6>
                                <h5>Due date:  <span>Due July 20</span></h5>
                            </div>
                            <div class="tax-right-dt">
                                <h4>ADI</h4>
                                <h5>6055 Born Court <span>Pensacola, FL 32504</span></h5>
                            </div>
                        </div>

                        <div class="tax-ttl">
                            <div class="tax-head">
                                <div class="tax-left-bx">
                                    <h5>Tax owed</h5>
                                </div>
                                <div class="tax-right-bx">
                                    <h5>$0.00</h5>
                                </div>
                            </div>

                            <div class="tax-head tx-dt">
                                <div class="tax-left-bx">
                                    <p>Gross sales</p>
                                </div>
                                <div class="tax-right-bx">
                                    <p>$0.00</p>
                                </div>
                            </div>

                            <div class="tax-head tx-dt">
                                <div class="tax-left-bx">
                                    <p>Gross sales</p>
                                </div>
                                <div class="tax-right-bx">
                                    <p>Taxable sales</p>
                                </div>
                            </div>
                        </div>

                        <div class="add-link">
                            <a href="javascript:void(0);" id="menuButton" onclick="openSideNav4()">+ Add an adjustment</a>
                        </div>

                        <div class="main-totl-bx">
                            <div class="tax-left-bx">
                                <h3>Tax due</h3>
                            </div>
                            <div class="tax-right-bx">
                                <h3>$0.00</h3>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn-main" data-dismiss="modal">Cancel</a>
                        <a href="javascript:void(0);" data-dismiss="modal" data-toggle="modal" data-target="#rcdpay" class="btn-main rcbtn">Record payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Recived Taxs -->

    <!-- Record Payment -->
    <div class="modal" id="rcdpay">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="reci-block">
                    <h3>Review your sales tax <button type="button" class="close" data-dismiss="modal">&times;</button></h3>   

                    <div class="sale-tax-wrp">
                        <h4>File your sales tax</h4>

                        <div class="tax-ttl">
                            <div class="tax-head tx-dt">
                                <div class="tax-left-bx">
                                    <p>Total tax payment</p>
                                </div>
                                <div class="tax-right-bx">
                                    <p>$0.00</p>
                                </div>
                            </div>
                        </div>

                        <div class="main-totl-bx">
                            <div class="tax-left-bx">
                                <h3>Tax due</h3>
                            </div>
                            <div class="tax-right-bx">
                                <h3>$0.00</h3>
                            </div>
                        </div>

                        <div class="step-taxa">
                            <ul>
                                <li>1. Download your full <a href="#">report</a>.</li>
                                <li>2. Fill out the tax form on your tax agency's <a href="#">website</a>.</li>
                                <li>3. Send the form and payment to your agency.</li>
                                <li>4. Don't forget to record the payment!</li>
                            </ul>
                        </div>

                        <div class="rcor-paybx">
                            <h4>Record payment</h4>

                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label>Tax amount</label>
                                        <input type="text" name="" placeholder="0.00" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label>Payment date</label>
                                        <input type="date" name="" placeholder="0.00" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label>Bank account</label>
                                        <select class="form-control">
                                            <option>Sales</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="cus-check">
                              <input type="checkbox" id="html">
                              <label for="html">Print check</label>
                            </div>

                            <div class="btn-group">
                                <a href="javascript:void(0);" class="btn-main" data-dismiss="modal">Cancel</a>
                                <a href="javascript:void(0);" data-dismiss="modal" data-toggle="modal" data-target="#rcdpay" class="btn-main rcbtn">Record payment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Record Payment -->

    <!-- Taxs -->
    <section class="taxs-wrp">
        <div class="taxs-tabs">
            <div class="container-fluid">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tax1">Sales Tax</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tax2">Payroll Tax</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="tab-content">
            <div class="tab-pane active" id="tax1">
                <div class="tax-iner-wrp">
                    <div class="container-fluid">
                        <div class="taxs-header">
                            <div class="row">
                                <div class="col-md-7 col-sm-7">
                                    <div class="left-taxs">
                                        <h1>$0.00</h1>
                                        <h6>SALES TAX DUE <a href="#"><i class="fas fa-question-circle"></i></a></h6>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <div class="action-bar">
                                        <ul>
                                            <li><a data-toggle="tab" href="#tax-history">History</a></li>
                                            <li><a href="#">Sales tax settings</a></li>
                                            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Reports <i class="far fa-chevron-down"></i></a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="tax-liability-report.html">Tax liability report</a>
                                                    <a class="dropdown-item" href="taxable-customer-report.html">Taxable customer report</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="taxs-lisitng">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-8">
                                    <div class="filter-search">
                                        <div class="form-group">
                                            <label>From</label>
                                            <select class="form-control">
                                                <option>July 2020</option>
                                                <option>August 2020</option>
                                                <option>November 2020</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>To</label>
                                            <select class="form-control">
                                                <option>July 2020</option>
                                                <option>August 2020</option>
                                                <option>November 2020</option>
                                            </select>
                                        </div>
                                        <button class="btn-refresh">Refresh</button>
                                    </div>

                                    <div class="taxs-listing-block">
                                        <h6>Due</h6>

                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-6">
                                                        <div class="tax-dt">
                                                            <h6>April to June 2020</h6>
                                                            <h5>Alabama</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="tax-dt tax-limit">
                                                            <h6><i class="far fa-clock"></i> Due July 20</h6>
                                                            <h5>$0.00</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#revice-taxs" class="btn-main">View return</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-6">
                                                        <div class="tax-dt">
                                                            <h6>June 2020</h6>
                                                            <h5>Banks City, AL</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="tax-dt tax-limit">
                                                            <h6><i class="far fa-clock"></i> Due July 20</h6>
                                                            <h5>$0.00</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#revice-taxs" class="btn-main">View return</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-6">
                                                        <div class="tax-dt">
                                                            <h6>June 2020</h6>
                                                            <h5>Calera City, AL</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="tax-dt tax-limit">
                                                            <h6><i class="far fa-clock"></i> Due July 20</h6>
                                                            <h5>$0.00</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#revice-taxs" class="btn-main">View return</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-6">
                                                        <div class="tax-dt">
                                                            <h6>June 2020</h6>
                                                            <h5>Florida</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="tax-dt tax-limit">
                                                            <h6><i class="far fa-clock"></i> Due July 20</h6>
                                                            <h5>$0.00</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#revice-taxs" class="btn-main">View return</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="taxs-listing-block">
                                        <h6>Upcoming</h6>

                                        <ul>
                                            <li class="disabled">
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-10">
                                                        <div class="tax-dt">
                                                            <h6>April to June 2020</h6>
                                                            <h5>Alabama</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="tax-dt tax-limit">
                                                            <h6>Accruing</h6>
                                                            <h5>$0.00</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="disabled">
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-10">
                                                        <div class="tax-dt">
                                                            <h6>June 2020</h6>
                                                            <h5>Banks City, AL</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="tax-dt tax-limit">
                                                            <h6>Accruing</h6>
                                                            <h5>$0.00</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="disabled">
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-10">
                                                        <div class="tax-dt">
                                                            <h6>June 2020</h6>
                                                            <h5>Calera City, AL</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="tax-dt tax-limit">
                                                            <h6>Accruing</h6>
                                                            <h5>$0.00</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="disabled">
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-10">
                                                        <div class="tax-dt">
                                                            <h6>June 2020</h6>
                                                            <h5>Florida</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="tax-dt tax-limit">
                                                            <h6>Accruing</h6>
                                                            <h5>$0.00</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <div class="shortcuts-box">
                                        <h3>SHORTCUTS</h3>

                                        <ul>
                                            <li><a href="#">
                                                <div class="sor-ic">
                                                    <img src="img/download.svg" alt="">
                                                </div>
                                                <div class="sor-dt">
                                                    <h4>Tell us where you collect tax</h4>
                                                    <p>Make sure you're only charging tax in the right states.</p>
                                                </div>
                                            </a></li>
                                             <li><a href="#">
                                                <div class="sor-ic">
                                                    <img src="img/short-ic5.svg" alt="">
                                                </div>
                                                <div class="sor-dt">
                                                    <h4>Tell us where you collect tax</h4>
                                                    <p>Make sure you're only charging tax in the right states.</p>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="sor-ic">
                                                    <img src="img/short-ic2.svg" alt="">
                                                </div>
                                                <div class="sor-dt">
                                                    <h4>Tell us where you collect tax</h4>
                                                    <p>Make sure you're only charging tax in the right states.</p>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="sor-ic">
                                                    <img src="img/short-ic3.svg" alt="">
                                                </div>
                                                <div class="sor-dt">
                                                    <h4>Tell us where you collect tax</h4>
                                                    <p>Make sure you're only charging tax in the right states.</p>
                                                </div>
                                            </a></li>
                                            <li><a href="#">
                                                <div class="sor-ic">
                                                    <img src="img/short-ic4.svg" alt="">
                                                </div>
                                                <div class="sor-dt">
                                                    <h4>Tell us where you collect tax</h4>
                                                    <p>Make sure you're only charging tax in the right states.</p>
                                                </div>
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tax2">
                <div class="payroll-tax-wrp">
                    <div class="container-fluid">
                        <div class="titlebar">
                            <h2>Payroll Tax Center</h2>
                        </div>
                    </div>

                    <div class="payrol-tx-wrp">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-5 col-sm-5">
                                    <div class="taxs-listing">
                                        <h4>Taxes</h4>

                                        <a href="#" class="paytx-btn">Pay Taxes</a>

                                        <h6>You may also want to:</h6>

                                        <ul>
                                            <li><a href="#">Edit your e-file and e-pay setup</a></li>
                                            <li><a href="#">Edit your tax setup</a></li>
                                            <li><a href="#">View your Tax Liability report</a></li>
                                            <li><a href="#">View tax payments you have made</a></li>
                                            <li><a href="#">Enter prior tax history</a></li>
                                            <li><a href="#">Order tax forms</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    <div class="form-listing">
                                        <h4>Forms</h4>

                                        <ul>
                                            <li>
                                                <div class="frm-ic">
                                                    <img src="img/form_icon.png" alt="">
                                                </div>
                                                <div class="frm-dwn">
                                                    <a href="#">Quarterly Forms</a>
                                                    <p>Completed quarterly tax forms, ready for you to print and mail.</p>
                                                    <a href="#">View and Print Archived Forms >></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="frm-ic">
                                                    <img src="img/form_icon.png" alt="">
                                                </div>
                                                <div class="frm-dwn">
                                                    <a href="#">Quarterly Forms</a>
                                                    <p>Completed quarterly tax forms, ready for you to print and mail.</p>
                                                    <a href="#">View and Print Archived Forms >></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="frm-ic">
                                                    <img src="img/form_icon.png" alt="">
                                                </div>
                                                <div class="frm-dwn">
                                                    <a href="#">Quarterly Forms</a>
                                                    <p>Completed quarterly tax forms, ready for you to print and mail.</p>
                                                    <a href="#">View and Print Archived Forms >></a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="frm-ic">
                                                    <img src="img/form_icon.png" alt="">
                                                </div>
                                                <div class="frm-dwn">
                                                    <a href="#">Quarterly Forms</a>
                                                    <p>Completed quarterly tax forms, ready for you to print and mail.</p>
                                                    <a href="#">View and Print Archived Forms >></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tax-history">
                <div class="tax-iner-wrp">
                    <div class="container-fluid">
                        <div class="taxs-header">
                            <div class="row">
                                <div class="col-md-7 col-sm-7">
                                    <div class="left-taxs">
                                        <a data-toggle="tab" href="#tax1" class="backstep"><i class="fal fa-chevron-left"></i> Back to sales tax</a>
                                        <h1>$0.00</h1>
                                        <h6>SALES TAX DUE <a href="#"><i class="fas fa-question-circle"></i></a></h6>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="not-found-block">
                            <h4>Your returns are still in the works</h4>
                            <p>Come back here after you've filed to look at your past returns.</p>

                            <div class="not-fount-img">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Taxs -->   
            <!-- end row -->
            <div class="row">
                
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>