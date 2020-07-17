<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
    <div class="wrapper reports-page" role="wrapper" >
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
								<div class="input-group-prepend bg-white border-top border-left border-bottom border-secondary rounded">
									<div class="input-group-text bg-white border-0"><span class="fa fa-search"></span></div>
								</div>
								<input type="text" class="form-control border-left-0 border-top border-right border-bottom border-secondary rounded-right" id="searcReportByName" placeholder="Find report by name">
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
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#favoritesCollapse" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Favorites</span></a>
										</div>
										<div id="favoritesCollapse" class="collapse" data-parent="#favorites" style="">
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled" id="favorites-reports">
													
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="businessOverview" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#businessOverviewCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Business overview</span></a>
										</div>
										<div id="businessOverviewCollapseOne" class="collapse" data-parent="#businessOverview" style="">
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Audit Log</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Audit Log" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Balance Sheet Comparison</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Balance Sheet Comparison" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Balance Sheet Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Balance Sheet Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Balance Sheet Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Balance Sheet Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Balance Sheet</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Balance Sheet" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Business Snapshot</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Business Snapshot" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Profit and Loss as % of total income</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Profit and Loss as % of total income" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Profit and Loss Comparison</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Profit and Loss Comparison" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Profit and Loss Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Profit and Loss Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Profit and Loss year-to-date comparison</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Profit and Loss year-to-date comparison" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Profit and Loss by Customer</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Profit and Loss by Customer" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Profit and Loss by Month</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Profit and Loss by Month" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Profit and Loss</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Profit and Loss" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Quarterly Profit and Loss Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Quarterly Profit and Loss Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Statement of Cash Flows</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Statement of Cash Flows" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
								 <div id="whoOwesYou" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#whoOwesYouCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Who owes you</span></a>
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
								 <div id="salesAndCustomers" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#salesAndCustomersCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Sales and customers</span></a>
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
								 <div id="whatYouOwe" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#whatYouOweCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">What you owe</span></a>
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
								 <div id="expensesAndVendors" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#expensesAndVendorsCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Expenses and vendors</span></a>
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
								  <div id="salesTax" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#salesTaxCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Sales tax</span></a>
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
								 <div id="employees" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#employeesCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Employees</span></a>
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
								 <div id="forMyAccountant" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#forMyAccountantCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">For my accountant</span></a>
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
								 <div id="payroll" class="menu-reports">
									<div class="card p-0">
										<div class="card-header p-4">
											<a class="card-link collapsed h5 text-dark" data-toggle="collapse" href="#payrollCollapseOne" aria-expanded="false"><span class="fa fa-chevron-right rotate-icon"></span><span class="pl-3">Payroll</span></a>
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