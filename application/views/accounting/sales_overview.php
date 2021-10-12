<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">

	<!-- page wrapper start -->
	<div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
		<div class="container-fluid" style="background-color:white;">
			<div class="page-title-box mx-4">
				<div class="col-lg-6 px-0">
					<h3>Sales</h3>
				</div>
				<div
					style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px; display:none;">
					The Sales Overview is available for you to see and track transactions pertaining to sales. This new
					screen allows you to see at a glance income over a period of time, mobile payment options, pending
					invoices and upcoming deposits. Each of the areas can be clicked to view details. From invoices to
					inventory it can be done here.
				</div>
				<div class="row pb-2" style="margin-bottom: 10px;">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>"
							class="banking-tab-active text-decoration-none">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>"
							class="banking-tab">All Sales</a>
						<a href="<?php echo url('/accounting/newEstimateList')?>"
							class="banking-tab">Estimates</a>
						<a href="<?php echo url('/accounting/customers')?>"
							class="banking-tab">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>"
							class="banking-tab">Deposits</a>
						<a href="<?php echo url('/accounting/listworkOrder')?>"
							class="banking-tab">Work Order</a>
						<a href="<?php echo url('/accounting/invoices')?>"
							class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/jobs ')?>"
							class="banking-tab">Jobs</a>
						<!-- <a href="<?php echo url('/accounting/products-and-services')?>"
						class="banking-tab">Products and Services</a> -->
					</div>
				</div>
				<div class="row">
					<div class="col-md-7">
						<div class="overview-widget income-overtime" style="  ">
							<div class="row" style="padding-top: 10px;">
								<div class="col-md-5">
									<div class="widget-title">
										INCOME OVER TIME <i class="fa fa-info-circle" aria-hidden="true"></i>
									</div>
								</div>
								<div class="col-md-7">
									<div class="filter-section">
										<div class="duration">
											<label for="">Duration:</label>
											<select name="duration" class="duration">
												<option value="">This month</option>
												<option value="">Last month</option>
												<option value="">This quarter</option>
												<option value="">Last quarter</option>
												<option value="">This year by month</option>
												<option value="">This year by quarter</option>
												<option value="">Last year by month</option>
												<option value="">Last year by quarter</option>
											</select>
										</div>
										<div class="compare-prev-year">
											<label class="main-label">Compare previous year:</label>
											<div class="form-group">
												<div class="custom-control custom-switch">
													<input type="checkbox" on class="custom-control-input"
														id="compare-prev-year">
													<label class="custom-control-label" for="compare-prev-year"></label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<div class="content-monitary-highlight">
									$<span class="amount"><?=number_format($income_this_month, 2)?></span>
									<span class="label">This month</span>
								</div>
								<div class="monitary-increase">
									$<?=number_format($income_this_month-$income_last_month, 2)?>
									more than <?=date("M d", strtotime("first day of previous month"))?>
									- <?=date("d, Y", strtotime("last day of previous month"))?>
								</div>
								<div id="chartContainer1" class="dynamic-graph-container"
									style="width: 100%; height:200px;">

								</div>
							</div>
						</div>
						<div class="overview-widget">
							<div class="widget-with-counter focused">
								<div class="row">
									<div class="col-md-1">
										<div class="counter">
											2
										</div>
									</div>
									<div class="col-md-7">
										<div class="widget-content">
											<div class="content-title">
												Learn how to use payments
											</div>
											<div class="content-text">
												Learn how to use QuickBooks Payments to get paid online, in-person, and
												on the go.
											</div>
										</div>
									</div>
									<div class="sinking-section">
										<button class="transparent-button">Not now</button>
										<button class="success-button">Learn more</button>
									</div>
								</div>
							</div>
						</div>

						<div class="overview-widget">
							<div class="widget-with-counter">
								<div class="row">
									<div class="col-md-1">
										<div class="counter">
											3
										</div>
									</div>
									<div class="col-md-7">
										<div class="widget-content">
											<div class="content-title">
												Order a card reader
											</div>
											<div class="content-text">
												Download the QuickBooks GoPayment app so you're always ready to get paid
												with credit or debit cards.
											</div>
										</div>
									</div>
								</div>
								<div class="sinking-section">
									<button class="transparent-button">Not now</button>
									<button class="success-button">Download the app</button>
								</div>
							</div>
						</div>
						<div class="overview-widget invoices">
							<div class="row" style="padding-top: 10px;">
								<div class="col-md-5">
									<div class="widget-title">
										INVOICES
									</div>
								</div>
							</div>
							<div class="widget-content" style="padding-bottom:25px ;">
								<div class="row">
									<?php
                                    if ($invoice_needs_attention) {
                                        ?>
									<div class="col-md-3">
										<div class="center-content">
											<div class="items">
												<div class="sigments warning">
													<div class="icon">
														<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
													</div>
													<div class="the-text " style="font-weight: bold;">
														Needs attention $58.04
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
                                    }
                                    ?>
									<div
										class="<?php if ($invoice_needs_attention) {
                                        echo "col-md-9";
                                    } else {
                                        echo "col-md-12";
                                    }?>">
										<div class="row">
											<div class="col-md-6">
												<div class="sigments">
													<div class="last-365days">
														<div class="bold">$<?=number_format($unpaid_last_365, 2)?>
															Unpaid</div>
													</div>
													<div class="text">
														<div class="text" style="padding: 0 10px;">Last 365 days</div>
													</div>
												</div>
												<div style="padding: 20px 0;">
													<div class="row">
														<div class="col-md-6">
															<div class="content-monitary-highlight small">
																$<?=number_format($due_last_365, 2)?>
															</div>
															<div class="text">Overdue</div>
														</div>
														<div class="col-md-6">
															<div class="content-monitary-highlight small"
																style="text-align: right;">
																$<?=number_format($not_due_last_365, 2)?>
															</div>
															<div class="text" style="text-align: right;">Not due yet
															</div>
														</div>
													</div>
												</div>
												<div class="invoices-bars">
													<div class="progress">
														<?php
                                                        if ($due_last_365 == 0 && $not_due_last_365==0) {
                                                            $progress_overdue =50;
                                                            $progress_not_due =50;
                                                        } else {
                                                            $progress_overdue =($due_last_365/($not_due_last_365+$due_last_365))*100;
                                                            $progress_not_due =($not_due_last_365/($not_due_last_365+$due_last_365))*100;
                                                        }
                                                        ?>
														<div class="progress-bar orange" role="progressbar"
															style="width: <?=$progress_overdue?>%"
															aria-valuenow="<?=$progress_overdue?>"
															aria-valuemin="0" aria-valuemax="100">
														</div>
														<div class="progress-bar default" role="progressbar"
															style="width: <?=$progress_not_due?>%"
															aria-valuenow="<?=$progress_not_due?>"
															aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="sigments">
													<div class="last-365days">
														<div class="bold">$<?=number_format($unpaid_last_30, 2)?>
															Unpaid</div>
													</div>
													<div class="text">
														<div class="text" style="padding: 0 10px;">Last 30 days</div>
													</div>
												</div>
												<div style="padding: 20px 0;">
													<div class="row">
														<div class="col-md-6">
															<div class="content-monitary-highlight small">
																$<?=number_format($not_deposited_last30_days, 2)?>
															</div>
															<div class="text">Not deposited</div>
														</div>
														<div class="col-md-6">
															<div class="content-monitary-highlight small"
																style="text-align: right;">
																$<?=number_format($deposited_last30_days, 2)?>
															</div>
															<div class="text" style="text-align: right;">Deposited
															</div>
														</div>
													</div>
												</div>
												<div class="invoices-bars">
													<div class="progress">
														<?php
                                                        if ($deposited_last30_days == 0 && $not_deposited_last30_days==0) {
                                                            $progress_deposited =50;
                                                            $progress_not_deposited =50;
                                                        } else {
                                                            $progress_deposited =($deposited_last30_days/($not_deposited_last30_days+$deposited_last30_days))*100;
                                                            $progress_not_deposited =($not_deposited_last30_days/($not_deposited_last30_days+$deposited_last30_days))*100;
                                                        }
                                                        ?>
														<div class="progress-bar light-success" role="progressbar"
															style="width: <?=$progress_not_deposited?>%"
															aria-valuenow="<?=$progress_not_deposited?>"
															aria-valuemin="0" aria-valuemax="100">
														</div>
														<div class="progress-bar success" role="progressbar"
															style="width: <?=$progress_deposited?>%"
															aria-valuenow="<?=$progress_deposited?>"
															aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="overview-widget deposite">
							<div class="row" style="padding-top: 10px;">
								<div class="col-md-5">
									<div class="widget-title">
										DEPOSITE
									</div>
								</div>
							</div>
							<div class="widget-content">
								<div class="content-monitary-highlight">
									$<?=number_format($deposit_total_amount, 2)?>
								</div>
								<div class="text">
									Expected <?=date("F d, Y", strtotime("monday next week"))?>
								</div>
								<div class="stepper-container">
									<div class="step">
										<div class="icon text-center <?=($deposit_current_status +1 == 0) ? "success" : '';?>">
											<i class="fa fa<?=($deposit_current_status >= 0) ? "-check" : '';?>-circle"
												aria-hidden="true"></i>
										</div>
										<div class="text">
											<div class="top text-center">
												Submitted
											</div>
											<div class="sub text-center">
												<?=$deposit_transaction_count?>
												transaction
											</div>
										</div>
									</div>
									<div class="step">
										<div class="icon text-center <?=($deposit_current_status +1 == 1) ? "success" : '';?>">
											<i class="fa fa<?=($deposit_current_status >= 1) ? "-check" : '';?>-circle"
												aria-hidden="true"></i>
										</div>
										<div class="text">
											<div class="top text-center">
												Approved
											</div>
											<div class="sub text-center">
												<!-- 10/01/21 -->
											</div>
										</div>
									</div>
									<div class="step">
										<div
											class="icon text-center <?=($deposit_current_status +1 == 2) ? "success" : '';?>">
											<i class="fa fa<?=($deposit_current_status >= 2) ? "-check" : '';?>-circle"
												aria-hidden="true"></i>
										</div>
										<div class="text">
											<div class="top text-center">
												Partially Paid
											</div>
											<div class="sub text-center">
												
											</div>
										</div>
									</div>
									<div class="step">
										<div class="icon text-center <?=($deposit_current_status +1 == 3) ? "success" : '';?>">
											<i class="fa fa<?=($deposit_current_status >= 3) ? "-check" : '';?>-circle"
												aria-hidden="true"></i>
										</div>
										<div class="text">
											<div class="top text-center">
												Paid
											</div>
											<div class="sub text-center">

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5 side-bar-widgets">
						<div class="overview-widget">
							<div class="row">
								<div class="col-md-5">
									<div class="widget-title">
										SETUP
									</div>
								</div>
							</div>
							<div class="widget-content">
								<div class="headway">
									<div class="label">
										50% Done
									</div>
									<div class="progress">
										<div class="progress-bar" role="progressbar" style="width: 50%"
											aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="content-checklists">
									<div class="row">
										<div class="col-md-1">
											<div class="checklist-icon success">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="checklist-text">
												Set up ways for customers to pay you
											</div>
										</div>
									</div>
								</div>

								<div class="content-checklists">
									<div class="row">
										<div class="col-md-1">
											<div class="checklist-icon ">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="checklist-text">
												Learn how to use payments
											</div>
										</div>
										<div class="col-md-2">
											<div class="checklist-link">
												<a href="#">Start</a>
											</div>
										</div>
									</div>
								</div>

								<div class="content-checklists">
									<div class="row">
										<div class="col-md-1">
											<div class="checklist-icon ">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="checklist-text">
												Order a card reader
											</div>
										</div>
										<div class="col-md-2">
											<div class="checklist-link">
												<a href="#">Start</a>
											</div>
										</div>
									</div>
								</div>

								<div class="content-checklists">
									<div class="row">
										<div class="col-md-1">
											<div class="checklist-icon success">
												<i class="fa fa-check-circle" aria-hidden="true"></i>
											</div>
										</div>
										<div class="col-md-9">
											<div class="checklist-text">
												Send an invoice that your customer can pay online
											</div>
										</div>
										<div class="col-md-2">
											<div class="checklist-link">
												<a href="#">Edit</a>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="overview-widget discover-more">
							<div class="widget-content">
								<div class="content-title">
									DISCOVER MORE
									<span class="hide-option"><a href="#">Hide</a></span>
								</div>
								<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators">
										<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
										</li>
										<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
									</ol>
									<div class="carousel-inner">
										<div class="carousel-item active">
											<div class="row">
												<div class="col-md-7">
													<div class="content-title">
														Got Feedback?
													</div>
													<div class="path-circle-separator">
														<path
															d="M2.3,0.2c-1.1,0-2,0.9-2,2s0.9,2,2,2h60c1.1,0,2-0.9,2-2s-0.9-2-2-2H2.3z">
														</path>
														<circle cx="70.3" cy="2.2" r="2"></circle>
													</div>
													<div class="content-text" style="margin-bottom: 25px;">
														Help us make this Overview more useful by providing feedback
													</div>
													<button class="transparent-button">Provide feedback</button>
												</div>
												<div class="col-md-5">
													<div class="img">
														<img src="<?=base_url('assets/img/accounting/overview/Lifestyle_Contractor.png')?>"
															alt="">
													</div>
												</div>
											</div>
										</div>
										<div class="carousel-item ">
											<div class="row">
												<div class="col-md-7">
													<div class="content-title">
														Got Feedback?
													</div>
													<div class="path-circle-separator">
														<path class="success"
															d="M2.3,0.2c-1.1,0-2,0.9-2,2s0.9,2,2,2h60c1.1,0,2-0.9,2-2s-0.9-2-2-2H2.3z">
														</path>
														<circle class="success" cx="70.3" cy="2.2" r="2"></circle>
													</div>
													<div class="content-text" style="margin-bottom: 25px;">
														Create and send a link your customers can use to pay you. It’s
														quick, easy, and secure!
													</div>
													<button class="transparent-button">Let's go</button>
												</div>
												<div class="col-md-5">
													<div class="img">
														<img src="<?=base_url('assets/img/accounting/overview/DiscoverMoreIllustration.png')?>"
															alt="">
													</div>
												</div>
											</div>
										</div>
									</div>
									<a class="carousel-control-prev" href="#carouselExampleControls" role="button"
										data-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#carouselExampleControls" role="button"
										data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
							</div>
						</div>
						<div class="overview-widget shortcuts">
							<div class="row">
								<div class="col-md-5">
									<div class="widget-title">
										SHORTCUTS
									</div>
								</div>
							</div>
							<div class="widget-content">
								<div class="img-button-links">
									<div class="row">
										<div class="col-md-6">
											<div class="img">
												<img src="<?=base_url('assets/img/accounting/overview/quick-sale.png')?>"
													alt="">
											</div>
											<div class="text bold">
												Quick sale
											</div>
										</div>
										<div class="col-md-6">
											<div class="img">
												<img src="<?=base_url('assets/img/accounting/overview/payment-link.png')?>"
													alt="">
											</div>
											<div class="text bold">
												Payment link
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="img" onclick="window.location.href='<?=base_url('accounting/addnewInvoice')?>'">
												<img src="<?=base_url('assets/img/accounting/overview/new-invoice.png')?>"
													alt="">
											</div>
											<div class="text bold">
												New invoice
											</div>
										</div>
										<div class="col-md-6">
											<div class="img">
												<img src="<?=base_url('assets/img/accounting/overview/recurring-invoice.png')?>"
													alt="">
											</div>
											<div class="text bold">
												Recurring invoice
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="img">
												<img src="<?=base_url('assets/img/accounting/overview/new-sales-receipt.png')?>"
													alt="" data-toggle="modal" data-target="#addsalesreceiptModal">
											</div>
											<div class="text bold">
												New sales receipt
											</div>
										</div>
										<div class="col-md-6">
											<div class="img">
												<img src="<?=base_url('assets/img/accounting/overview/recurring-sales-receipt.png')?>"
													alt="" data-toggle="modal" data-target="#addsalesreceiptModal" class="recurring-sales-receipt">
											</div>
											<div class="text bold">
												Recurring sales receipt
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style="display:none;">
					<div class="row pt-3">
						<div class="col-lg-12">
							<div class="row bg-white px-3 py-4 rounded">
								<div class="col-lg-3">
									<h5 class="text-secondary">INCOME OVER TIME</h5>
									<div class="">
										<h1 class="display-4 pt-4"><strong>$2</strong></h1>
										<h6 class="text-secondary">THIS MONTH</h6>
									</div>
								</div>
								<div class="col-lg-9">
									<div class="dropdown pull-right dropdown-toggle">
										<button class="btn btn-default border-0 p-2" type="button"
											id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
											aria-expanded="false">
											This Month&ensp;
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="#">This Week</a>
											<a class="dropdown-item" href="#">This Month</a>
											<a class="dropdown-item" href="#">Last Month</a>
											<a class="dropdown-item" href="#">This Quarter</a>
											<a class="dropdown-item" href="#">Last Quarter</a>
											<a class="dropdown-item" href="#">This year by month</a>
											<a class="dropdown-item" href="#">This year by quarter</a>
											<a class="dropdown-item" href="#">Last year by month</a>
											<a class="dropdown-item" href="#">Last year by quarter</a>
										</div>
									</div>
									<div class="chart w-100 border-left px-3" id="line-chart" style="height: 250px;">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-lg-7 pl-0">
							<a
								href="<?php echo url('/accounting/invoices')?>">
								<div class="bg-white p-4 rounded">
									<h5 class="text-secondary mt-0">INVOICES</h5>
									<div class="row px-3">
										<div class="col-sm-12">
											<h6 class="font-weight-normal"><strong>$4 Unpaid</strong><span
													class="pl-3">Last
													365 days</span></h6>
										</div>
										<div class="col-sm-12 mt-0">
											<div class="pull-left">
												<h3 class="mb-0"><strong>$0</strong></h3>
												<h6 class="font-weight-normal text-secondary mt-1">Overdue</h6>
											</div>
											<div class="pull-right">
												<h3 class="mb-0"><strong>$4</strong></h3>
												<h6 class="font-weight-normal text-secondary mt-1">Not due yet</h6>
											</div>
										</div>
										<div class="col-sm-12 mt-1">
											<div class="progress" style="height:30px">
												<div class="progress-bar bg-secondary w-50"></div>
												<div class="progress-bar bg-dark  w-50"></div>
											</div>
										</div>
									</div>
									<div class="row px-3 mt-3 pb-2">
										<div class="col-sm-12">
											<h6 class="font-weight-normal"><strong>$0 Paid</strong><span
													class="pl-3">Last
													30 days</span></h6>
										</div>
										<div class="col-sm-12 mt-0">
											<div class="pull-left">
												<h3 class="mb-0"><strong>$0</strong></h3>
												<h6 class="font-weight-normal text-secondary mt-1">Not deposited</h6>
											</div>
											<div class="pull-right">
												<h3 class="mb-0"><strong>$0</strong></h3>
												<h6 class="font-weight-normal text-secondary mt-1">Deposited</h6>
											</div>
										</div>
										<div class="col-sm-12 mt-1">
											<div class="progress" style="height:30px">
												<div class="progress-bar bg-success w-50"></div>
												<div class="progress-bar bg-info  w-50"></div>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-lg-5 pr-0">
							<div class="bg-white p-4 rounded h-100">
								<h5 class="text-secondary mt-0">SHORTCUTS</h5>
								<div class="row px-2 text-center mt-5 align-items-center">
									<div class="col-sm-6">
										<p class="bg-white border border-dark rounded-circle px-4 py-5 d-inline"><img
												src="<?php echo base_url();?>assets/img/accounting/new-invoice.png"
												class="w-25 img-responsive" /></p>
										<h6 class="pt-3">New Invoice</h6>
									</div>
									<div class="col-sm-6">
										<p class="bg-white border border-dark rounded-circle px-4 py-5 d-inline"><img
												src="<?php echo base_url();?>assets/img/accounting/recurring-invoice.png"
												class="w-25 img-responsive" /></p>
										<h6 class="pt-3">Recurring Invoice</h6>
									</div>
									<div class="col-sm-6 mt-4">
										<p class="bg-white border border-dark rounded-circle px-4 py-5 d-inline"><img
												src="<?php echo base_url();?>assets/img/accounting/new-sale.png"
												class="w-25 img-responsive" /></p>
										<h6 class="pt-3">New Sale</h6>
									</div>
									<div class="col-sm-6 mt-4">
										<p class="bg-white border border-dark rounded-circle px-4 py-5 d-inline"><img
												src="<?php echo base_url();?>assets/img/accounting/recurring-sale.png"
												class="w-25 img-responsive" /></p>
										<h6 class="pt-3">Recurring Sale</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-sm-12 px-0">
							<a
								href="<?php echo url('/accounting/deposits')?>">
								<div class="bg-white p-4 rounded text-secondary">
									<h5 class="text-secondary mt-0">DEPOSITS</h5>
									<h1 class="mb-0 d-block mt-4"><strong>$0.00</strong></h1>
									<h6 class="font-weight-normal text-secondary mt-1 d-block">Deposit for July 10, 2020
									</h6>
									<div class="row">
										<div class="col-md-12">
											<div class="w-100 d-inline-block">
												<ul class="timeline timeline-horizontal text-center">
													<li class="timeline-item">
														<div class="timeline-badge primary"><i
																class="glyphicon glyphicon-check"></i></div>
														<h5 class="timeline-title">Processing</h5>
													</li>
													<li class="timeline-item">
														<div class="timeline-badge primary"><i
																class="glyphicon glyphicon-check"></i></div>
														<h5 class="timeline-title">Batched</h5>
													</li>
													<li class="timeline-item">
														<div class="timeline-badge primary"><i
																class="glyphicon glyphicon-check"></i></div>
														<h5 class="timeline-title">In transit</h5>
													</li>
													<li class="timeline-item">
														<div class="timeline-badge primary"><i
																class="glyphicon glyphicon-check"></i></div>
														<h5 class="timeline-title">Deposited</h5>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end container-fluid -->
	</div>
	<!-- page wrapper end -->
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>

<script>
	window.onload = function() {

		var chart = new CanvasJS.Chart("chartContainer1", {
			animationEnabled: true,
			theme: "light2",
			title: {
				text: ""
			},
			data: [{
				type: "line",
				indexLabelFontSize: 16,
				dataPoints: [{
						y: 450
					},
					{
						y: 414
					},
					{
						y: 520
					},
					{
						y: 460
					},
					{
						y: 450
					},
					{
						y: 500
					},
					{
						y: 480
					},
					{
						y: 480
					},
					{
						y: 410
					},
					{
						y: 500
					},
					{
						y: 480
					},
					{
						y: 510
					}
				]
			}]
		});
		chart.render();

	}
</script>


<?php include viewPath('includes/footer_accounting');
