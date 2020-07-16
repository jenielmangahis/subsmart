<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
    <div class="wrapper" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section>
        <div class="container-fluid">
			<div class="page-title-box mx-4">
				<div class="row">
					<div class="col-lg-6 px-0">
						<h2>Reports</h2>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text"><span class="fa fa-search"></span></div>
								</div>
								<input type="text" class="form-control" id="searcReportByName" placeholder="Find report by name">
							</div>
						</div>
					</div>
				</div>
				<div class="row align-items-center pt-3 bg-white">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <div class="banking-tab-container">
                            <div class="rb-01">
                                <ul class="nav nav-tabs border-0">
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab active" data-toggle="tab" href="#standard">Standard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#custom">Custom Reports</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab" data-toggle="tab" href="#management">Management Reports</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content mt-4" >
                            <div class="tab-pane active standard-accordion" id="standard">
								<div id="favorites">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#favoritesCollapse" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Favorites</span></a>
										</div>
										<div id="favoritesCollapse" class="collapse" data-parent="#favorites" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="businessOverview">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#businessOverviewCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Business overview</span></a>
										</div>
										<div id="businessOverviewCollapseOne" class="collapse" data-parent="#businessOverview" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="whoOwesYou">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#whoOwesYouCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Who owes you</span></a>
										</div>
										<div id="whoOwesYouCollapseOne" class="collapse" data-parent="#whoOwesYou" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="salesAndCustomers">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#salesAndCustomersCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Sales and customers</span></a>
										</div>
										<div id="salesAndCustomersCollapseOne" class="collapse" data-parent="#salesAndCustomers" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="whatYouOwe">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#whatYouOweCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">What you owe</span></a>
										</div>
										<div id="whatYouOweCollapseOne" class="collapse" data-parent="#whatYouOwe" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="expensesAndVendors">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#expensesAndVendorsCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Expenses and vendors</span></a>
										</div>
										<div id="expensesAndVendorsCollapseOne" class="collapse" data-parent="#expensesAndVendors" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								  <div id="salesTax">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#salesTaxCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Sales tax</span></a>
										</div>
										<div id="salesTaxCollapseOne" class="collapse" data-parent="#salesTax" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="employees">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#employeesCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Employees</span></a>
										</div>
										<div id="employeesCollapseOne" class="collapse" data-parent="#employees" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="forMyAccountant">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#forMyAccountantCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">For my accountant</span></a>
										</div>
										<div id="forMyAccountantCollapseOne" class="collapse" data-parent="#forMyAccountant" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="payroll">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5" data-toggle="collapse" href="#payrollCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Payroll</span></a>
										</div>
										<div id="payrollCollapseOne" class="collapse" data-parent="#payroll" style="">
											<div class="card-body">
												<ul class="list-unstyled">
													<li>Accounts receivable aging summary</li>
													<li>Balance Sheet</li>
													<li>Profit and Loss</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
                            </div>
                            <div class="tab-pane fade" id="custom">
                                
							</div>
                            <div class="tab-pane fade" id="management">

							</div>
                        </div>
                    </div>

                </div>
				<!-- end row -->
				<div class="row ml-2"></div>
            <!-- end row -->
			</div>
        </div>
        <!-- end container-fluid -->
    </div>
	  <!-- page wrapper end -->
	  <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    </div>

<?php include viewPath('includes/footer_accounting'); ?>