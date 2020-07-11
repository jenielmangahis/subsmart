<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
    <div class="wrapper" role="wrapper" >
       
        <!-- page wrapper start -->
        <div wrapper__section>
            <div class="container-fluid">
				<div class="page-title-box mx-4">
					<div class="row pb-2">
						<div class="col-md-12 banking-tab-container">
							<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab-active text-decoration-none">Overview</a>
							<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
							<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
							<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
							<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
							<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
						</div>
					</div>
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
									  <button class="btn btn-default border-0 p-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
									<div class="chart w-100 border-left px-3" id="line-chart"  style="height: 250px;">
									</div>
								</div>
							</div>
                        </div>
					</div>
					<div class="row pt-3">
						<div class="col-lg-7 pl-0">
							<div class="bg-white p-4 rounded">
								<h5 class="text-secondary mt-0">INVOICES</h5>
								<div class="row px-3">
									<div class="col-sm-12">
										<h6 class="font-weight-normal"><strong>$4 Unpaid</strong><span class="pl-3">Last 365 days</span></h6>
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
										<h6 class="font-weight-normal"><strong>$0 Paid</strong><span class="pl-3">Last 30 days</span></h6>
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
						</div>
						<div class="col-lg-5 pr-0">
							<div class="bg-white p-4 rounded h-100">
								<h5 class="text-secondary mt-0">SHORTCUTS</h5>
								<div class="row px-2 text-center mt-4 align-items-center">
									<div class="col-sm-6">
										<p class=""><i class="fa fa-file h2 text-success border border-dark rounded-circle p-4"></i></p>
										<h6>New Invoice</h6>
									</div>
									<div class="col-sm-6">
										<p class=""><i class="fa fa-file-o h2 text-success border border-dark rounded-circle p-4"></i></p>
										<h6>Recurring Invoice</h6>
									</div>
									<div class="col-sm-6">
										<p class=""><i class="fa fa-file-text h2 text-success border border-dark rounded-circle p-4"></i></p>
										<h6>New Sale</h6>
									</div>
									<div class="col-sm-6">
										<p class=""><i class="fa fa-files-o h2 text-success border border-dark rounded-circle p-4"></i></p>
										<h6>Recurring Sale</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-sm-12 px-0">
							<div class="bg-white p-4 rounded text-secondary">
								<h5 class="text-secondary mt-0">DEPOSITS</h5>
								<h1 class="mb-0 d-block mt-4"><strong>$0.00</strong></h1>
								<h6 class="font-weight-normal text-secondary mt-1 d-block">Deposit for July 10, 2020</h6>
								<div class="row">
									<div class="col-md-12">
										<div class="w-100 d-inline-block">
											<ul class="timeline timeline-horizontal text-center">
												<li class="timeline-item">
													<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>
													<h5 class="timeline-title">Processing</h5>
												</li>
												<li class="timeline-item">
													<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>
													<h5 class="timeline-title">Batched</h5>
												</li>
												<li class="timeline-item">
													<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>
													<h5 class="timeline-title">In transit</h5>
												</li>
												<li class="timeline-item">
													<div class="timeline-badge primary"><i class="glyphicon glyphicon-check"></i></div>
													<h5 class="timeline-title">Deposited</h5>
												</li>
											</ul>
										</div>
									</div>
								</div>
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

<?php include viewPath('includes/footer_accounting'); ?>