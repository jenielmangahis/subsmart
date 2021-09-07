<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    tr.hide-table-padding td {
        padding: 0;
    }
    svg#svg-sprite-menu-close {
      position: relative;
      bottom: 178px !important;
    }
    .nav-close {
        margin-top: 52% !important;
    }
	.bank-img-container img{
		width:auto !important;
	}
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper" style="">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <div style="background-color:white;height:80%;padding:2%;margin-top:1.3%;">
                <!-- <h3 style="font-family: Sarabun, sans-serif">&nbsp;Bank and Credit Cards</h3> -->
                    <div class="col-sm-12">
                          <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Bank and Credit Cards</h3>
                    </div>
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-4">
                        <!-- <h2>Bank and Credit Cards</h2> -->

                        <!-- <div class="row"> -->
                            <div class="col-md-12 banking-tab-container" style="padding-top:2%;width:350px;">
                                <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="link_bank")?:'-active';?>" style="text-decoration: none">Banking</a>
                                <a href="<?php echo url('/accounting/rules')?>" class="banking-tab">Rules</a>
                                <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab">Receipts</a>
                                <a href="<?php echo url('/accounting/tags')?>" class="banking-tab">Tags</a>
                            </div>
                        <!-- </div> -->

                    </div>
                    <div class="col-md-4" style="position: relative;display: inline-block;vertical-align: text-bottom;">
                        <div class="dropdown bank-account-picker" style="vertical-align: text-bottom;">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" style="text-decoration: none; color: #393a3d;font-size: 18px;background-color: transparent;border: 0;">
                                <div class="account-logo">
                                    <div class="hi">
                                        <i class="fa fa-credit-card"></i>
                                    </div>
                                </div>
                                Corporate Account (XXXXXX 5850) <i class="fa fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu bank-account-dd">
                                <li class="bank-account-view">
                                    <div class="account-logo">
                                        <div class="hi">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                    </div>
                                    <div class="subcolumn expand">
                                        <div class="subrow space-between">
                                            <div class="account-name">
                                                Region Bank - Corporate Account (XXXXXX 5850)
                                            </div>
                                        </div>
                                        <div class="subrow">
                                            <div>
                                                <div class="bank-balance-text">
                                                    Bank balance:&nbsp;<span>6,041.11</span>$
                                                </div>
                                            </div>
                                        </div>
                                        <div class="subrow">
                                            <div>
                                                <div class="num-transaction-text">
                                                    10&nbsp;Transactions
                                                </div>
                                            </div>
                                        </div>
                                        <div class="subcontent pull-right">
                                            Updated 1 day ago
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4" style="text-align: right">
                        <div style="float: right;position: relative;display: inline-block; margin-left: 10px">
                            <a href="<?= base_url('accounting/bank_connect') ?>">
                                <button class="btn btn-success"  style="border-radius: 20px 20px 20px 20px;">Add account</button>
                            </a>
                        </div>
                        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                            <button type="button" class="btn btn-default"  style="border-radius: 20px 0 0 20px">Update</button>
                            <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target="#fileUpload">File Upload</a></li>
                                <li><a href="#">Order Checks</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:28px;margin-top:13px;">
                When you connect an account, accounting will automatically downloads and categorizes bank and credit card transactions for you. It enters the details so you don't have to enter transactions manually.  All you have to do is approve the work.
                </div>
                <!-- <br> -->
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <div class="banking-tab-container">
                            <div class="rb-01">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item banking-sub-active">
                                        <a class="nav-link active banking-sub-tab" data-toggle="tab" href="#forReview">For Review</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link banking-sub-tab" data-toggle="tab" href="#reviewed">Reviewed</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link banking-sub-tab" data-toggle="tab" href="#excluded">Excluded</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="rb-02">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#"  data-toggle="modal" data-target="#takeAtour"><i class="fa fa-map-signs" style="margin-right: 10px"></i>Take a tour</a></li>
                                    <li class="nav-item">|</li>
                                    <li class="nav-item"><a href="#">Go to Register</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="forReview" style="background: #ffffff; padding: 10px">
                                <div class="dropdown" style="position: relative;display: inline-block;margin: 15px 10px 10px 10px;">
                                    <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;">
                                        Batch actions&nbsp;<i class="fa fa-angle-down fa-lg"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" class="dropdown-item disabled">Accept selected</a></li>
                                        <li><a href="#" class="dropdown-item disabled" >Excluded selected</a></li>
                                        <li><a href="#" class="dropdown-item disabled" >Modify selected</a></li>
                                    </ul>
                                </div>
                                <div class="filterFunnel">
                                    <a href="#" data-toggle="dropdown"><i class="fa fa-filter fa-2x">&nbsp;<i class="fa fa-caret-down"></i></i></a>
                                    <ul class="dropdown-menu">
                                        <li style="padding:30px">
                                            <form action="" method="" class="">
                                                <div>
                                                    <div style="width: 180px;position:relative; display: inline-block;">
                                                        <label for="type">Dates</label>
                                                        <select name="type" id="type" class="form-control" >
                                                            <option value="">All dates</option>
                                                            <option value="">Customs</option>
                                                            <option value="">Today</option>
                                                            <option value="">Yesterday</option>
                                                            <option value="">This week</option>
                                                            <option value="">This month</option>
                                                            <option value="">This quarter</option>
                                                            <option value="">This year</option>
                                                            <option value="">Last month</option>
                                                            <option value="">Last quarter</option>
                                                            <option value="">Last year</option>
                                                        </select>
                                                    </div>
                                                    <div style="position: relative; display: inline-block;width: 120px;">
                                                        <label for="">From</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div style="position:relative; display: inline-block;margin-left: 10px;width: 120px;">
                                                        <label for="">To</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div style="margin-top: 20px">
                                                    <button class="btn btn-default" type="reset" style="border-radius: 36px">Reset</button>
                                                    <button class="btn btn-success" type="submit" style="border-radius: 36px; float: right;">Apply</button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <span style="display: inline-block;margin-left: 10px;">All</span>
                                <div class="sortAll">
                                    All(19)
                                </div>
                                <div class="sortRecognized">
                                    Recognized(3)
                                </div>
                                <div class="icon-settings-container" style="margin-top: 45px">
                                    <i class="fa fa-print"></i>
                                    <i class="fa fa-upload"></i>
                                    <i class="fa fa-cog"></i>
                                </div>
                                <table id="forReview_table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" class=""></th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Payee</th>
                                    <th>Category or Match</th>
                                    <th>Spent</th>
                                    <th>Received</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>06/29/2020</td>
                                    <td>CHECK #2701</td>
                                    <td>Mike Bell Jr</td>
                                    <td></td>
                                    <td>$320</td>
                                    <td></td>
                                    <td><a href="#collapseOne" class="accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" >View</a></td>
                                </tr>
                                <tr class="hide-table-padding collapse in p-3" id="collapseOne" >
                                    <td></td>
                                    <td colspan="6">
                                        <div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="radio-inline"><input type="radio" name="optradio" checked>Add</label>
                                                    <label class="radio-inline"><input type="radio" name="optradio">Match</label>
                                                    <label class="radio-inline"><input type="radio" name="optradio">Record transfer</label>
                                                    <a href="#">Not sure?</a>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top: 20px;">
                                                <div class="col-md-6" style="border-right: 1px solid #8d9096;">
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio" checked> Check 2716 07/13/2020 $300.00 Frank Gianino</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio"> Check 2685 06/15/2020 $300.00 Kyle Nguyen</label>
                                                    </div>
                                                    <div class="radio ">
                                                        <label><input type="radio" name="optradio"> Check 2711 07/06/2020 $300.00 Mike Bell Jr</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio"> Check 2711 07/06/2020 $300.00 Mike Bell Jr</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio"> Check 2711 07/06/2020 $300.00 Mike Bell Jr</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio"> Check 2711 07/06/2020 $300.00 Mike Bell Jr</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio"> Check 2711 07/06/2020 $300.00 Mike Bell Jr</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-5" style="vertical-align: middle;">
                                                    <button class="btn btn-default btn-findOthersRecords">Find other records</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="reviewed" style="background: #ffffff; padding: 10px">
                                <div class="filterFunnel">
                                    <a href="#" data-toggle="dropdown"><i class="fa fa-filter fa-2x">&nbsp;<i class="fa fa-caret-down"></i></i></a>
                                    <ul class="dropdown-menu">
                                        <li style="padding:30px">
                                            <form action="" method="" class="">
                                                <div style="width: 180px;">
                                                    <label for="">Rules</label>
                                                    <select name="type" id="type" class="form-control" >
                                                        <option value="">All dates</option>
                                                        <option value="">Customs</option>
                                                        <option value="">Today</option>
                                                        <option value="">Yesterday</option>
                                                        <option value="">This week</option>
                                                        <option value="">This month</option>
                                                        <option value="">This quarter</option>
                                                        <option value="">This year</option>
                                                        <option value="">Last month</option>
                                                        <option value="">Last quarter</option>
                                                        <option value="">Last year</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <div style="width: 180px;position:relative; display: inline-block;">
                                                        <label for="type">Dates</label>
                                                        <select name="type" id="type" class="form-control" >
                                                            <option value="">All dates</option>
                                                            <option value="">Customs</option>
                                                            <option value="">Today</option>
                                                            <option value="">Yesterday</option>
                                                            <option value="">This week</option>
                                                            <option value="">This month</option>
                                                            <option value="">This quarter</option>
                                                            <option value="">This year</option>
                                                            <option value="">Last month</option>
                                                            <option value="">Last quarter</option>
                                                            <option value="">Last year</option>
                                                        </select>
                                                    </div>
                                                    <div style="position: relative; display: inline-block;width: 120px;">
                                                        <label for="">From</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div style="position:relative; display: inline-block;margin-left: 10px;width: 120px;">
                                                        <label for="">To</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div style="margin-top: 20px">
                                                    <button class="btn btn-default" type="reset" style="border-radius: 36px">Reset</button>
                                                    <button class="btn btn-success" type="submit" style="border-radius: 36px; float: right;">Apply</button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <span style="display: inline-block;margin-left: 10px;">All</span>
                                <div class="icon-settings-container">
                                    <i class="fa fa-print"></i>
                                    <i class="fa fa-upload"></i>
                                    <i class="fa fa-cog"></i>
                                </div>
                                <table id="reviewedTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" class=""></th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Added or Matched</th>
                                        <th>Rule</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>07/02/2020</td>
                                        <td>CHECK #2702 2702</td>
                                        <td>$-300.00</td>
                                        <td>Matched to: </td>
                                        <td><a href="">View</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="excluded" style="background: #ffffff; padding: 10px">
                                <div style="display: inline-block;margin-top: 50px">
                                    <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                </div>
                                <div class="dropdown" style="position: relative;display: inline-block;margin: 15px 10px 10px 10px;">
                                    <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;">
                                        Batch actions&nbsp;<i class="fa fa-angle-down fa-lg"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" class="dropdown-item disabled">Undo</a></li>
                                        <li><a href="#" class="dropdown-item disabled" >Delete</a></li>
                                    </ul>
                                </div>
                                <div class="icon-settings-container">
                                    <i class="fa fa-print"></i>
                                    <i class="fa fa-cog"></i>
                                </div>
                                <table id="reviewedTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" class=""></th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->

</div>
<?php include viewPath('includes/footer_accounting'); ?>


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
                    <div class="container modal-container accounts-list">
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
                                    <div class="bank-img-container clk-paypal">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/paypal_PNG20.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/pncbank_pms_c.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
							<div class="row justify-content-md-center align-items-center">
								<div class="col-sm-3">
                                    <div class="bank-img-container clk-stripe">
                                        <img class="banks-img w-auto" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="container modal-container paypal-container" style="display:none">
						<form id="save-paypal-account">
							<div class="row justify-content-md-center align-items-center pt-3">
								<div class="col-md-5 col-sm-6 col-xs-12">
									<h5 class="close-paypal-container text-right text-secondary" style="cursor:pointer;"><i class="fa fa-times fa-lg"></i></h5>
									<p class="text-center"><img class="banks-img img-fluid mx-auto" style="width:125px" src="<?php echo base_url('assets/img/accounting/paypal_PNG20.png') ?>" alt=""></p>
									
									<div class="header-modal text-center"><h3>Add PayPal Credentials</h3></div>
									<div class="form-group pt-3">
										<label for="paypal_email">PayPal Email</label>
										<input type="text" class="form-control" name="paypal_email" id="paypal_email" required="" placeholder="Enter Your PayPal Email" autofocus="">
									</div>
								</div>
							</div>
							<div class="row justify-content-md-center align-items-center pb-5">
								<div class="col-md-3 col-sm-4 col-xs-12">
									<button type="submit" name="save" class="btn btn-success btn-block">Save</button>
								</div>
							</div>
						</form>
                    </div>
					<div class="container modal-container stripe-container" style="display:none">
						<form id="save-stripe-account">
							<div class="row justify-content-md-center align-items-center pt-3">
								<div class="col-md-5 col-sm-6 col-xs-12">
									<h5 class="close-stripe-container text-right text-secondary" style="cursor:pointer;"><i class="fa fa-times fa-lg"></i></h5>
									<p class="text-center"><img class="banks-img img-fluid mx-auto" style="width:150px" src="<?php echo base_url('assets/img/accounting/stripe.png') ?>" alt=""></p>
									
									<div class="header-modal text-center"><h3>Add Stripe Credentials</h3></div>
									<div class="form-group pt-3">
										<label for="stripe_email">Stripe Email</label>
										<input type="text" class="form-control" name="stripe_email" id="stripe_email" required="" placeholder="Enter Your Stripe Email" autofocus="">
									</div>
									<div class="form-group">
										<label for="publish_key">Stripe Publish Key</label>
										<input type="text" class="form-control" name="publish_key" id="publish_key" required="" placeholder="Enter Your Publish Key" autofocus="">
									</div>
									<div class="form-group">
										<label for="secret_key">Stripe Secret Key</label>
										<input type="text" class="form-control" name="secret_key" id="secret_key" required="" placeholder="Enter Your Secret Key" autofocus="">
									</div>
								</div>
							</div>
							<div class="row justify-content-md-center align-items-center pb-5">
								<div class="col-md-3 col-sm-4 col-xs-12">
									<button type="submit" name="save" class="btn btn-success btn-block">Save</button>
								</div>
							</div>
						</form>
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
</div>

<div class="full-screen-modal">
    <!--Modal for file upload-->
    <div id="fileUpload" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0;">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-2x"></i></button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title" style="text-align: center;font-size: 46px;">Bring your info into nSmartrac</h1>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="modal-container box-bank-container" style="width: 100%">
                                <div class="centered-container">
                                    <img src="<?php echo base_url('assets/img/accounting/Artboard_230-512.png') ?>" alt="">
                                </div>
                                <div style="margin-top: 70px;">
                                    <h4 style="margin: 20px 20px 30px 20px; ">Get your info from your bank</h4>
                                    <ol>
                                        <li>Open a new tab and sign in to your bank.</li>
                                        <li>Download transactions: CSV, QFX, QBO, OFX or TXT format only.</li>
                                        <li>Close the tab and return to nSmartrac.</li>
                                    </ol>
                                </div>
                                <div>
                                    <h5 style="margin: 20px 20px 30px 20px;">Select a file to upload</h5>
                                    <form style="margin: 20px 20px 30px 20px;">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2" style="padding-top: 250px;"><h1 class="modal-title" style="text-align: center;font-size: 46px;">OR</h1></div>
                        <div class="col-sm-5">
                            <div class="modal-container box-bank-container" style="width: 100%">
                                <div class="centered-container">
                                    <img src="<?php echo base_url('assets/img/accounting/bank-security-system-621346.png') ?>" alt="">
                                </div>
                                <div style="margin-top: 70px;">
                                    <h4 style="margin: 20px 20px 30px 20px; ">Securely connect your bank</h4>
                                    <ol>
                                        <li>More secure. No need to share files with bank data.</li>
                                        <li>No work. Transactions come in from your bank automatically.</li>
                                    </ol>
                                </div>
                                <div style="display: flex;justify-content: center;margin-top: 70px">
                                    <button class="btn btn-success" style="border-radius: 20px 20px 20px 20px;">Connect</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer-upload-file">
                    <button class="btn btn-dark" style="float: left;border-radius: 20px 20px 20px 20px;">Cancel</button>
                    <button class="btn btn-success" style="float: right;border-radius: 20px 20px 20px 20px">Next</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal for Take a tour -->
<div class="centered-modal">
    <div id="takeAtour" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="header">
                        <h3>Keep your books organized all year</h3>
                        <p>Check out these resources to learn how</p>
                    </div>
                    <div class="take-a-tour-box">
                        <div class="tat-container">
                            <i class="fa fa-laptop fa-5x"></i>
                        </div>
                        <h4>Get on overview</h4>
                        <p>Watch a quick video</p>
                    </div>
                    <div class="take-a-tour-box" style="margin-left: 20px">
                        <div class="tat-container">
                            <i class="fa fa-map-signs fa-5x"></i>
                        </div>
                        <h4>Take a guide tour</h4>
                        <p>Step-by-step guidance</p>
                    </div>
                    <div class="path"></div>
                    <div class="help-link-container">
                        <div class="more-info">Tips & Resource</div>
                        <a href="" class="helpLink">How to import transactions automatically from bank</a>
                        <a href="" class="helpLink">How to enter, edit, delete expenses</a>
                        <a href="" class="helpLink">When and why to enter an expense vs. a bill</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<script>
    // DataTable JS
    $(document).ready(function() {
        //$('#addAccountModal').modal('show');

        $('#forReview_table').DataTable({
            "paging": false,
            "filter":false
        });
    } );
    $(document).ready(function() {
        $('#reviewedTable').DataTable({
            "paging": false,
            "filter":false
        });
    } );
    $('.banking-sub-tab').click(function(){
        $(this).parent().addClass('banking-sub-active').siblings().removeClass('banking-sub-active')
    });
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    // Expand row table
    $(document).ready(function () {
        $(document).on("click","#btnView",function () {
            $(this).parents('tr').after();
        });
    });
</script>
