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
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Accounts receivable aging detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Accounts receivable aging detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Accounts receivable aging summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Accounts receivable aging summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Collections Report</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Collections Report" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Customer Balance Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Customer Balance Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Customer Balance Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Customer Balance Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Invoice List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Invoice List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Invoices and Received Payments</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Invoices and Received Payments" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Open Invoices</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Open Invoices" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Statement List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Statement List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Terms List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Terms List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Unbilled charges</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Unbilled charges" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Unbilled time</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Unbilled time" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
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
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Customer Contact List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Customer Contact List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Deposit Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Deposit Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Estimates & Progress Invoicing Summary by Customer</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Estimates & Progress Invoicing Summary by Customer" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Estimates by Customer</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Estimates by Customer" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Income by Customer Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Income by Customer Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Inventory Valuation Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Inventory Valuation Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Inventory Valuation Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Inventory Valuation Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payment Method List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payment Method List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Physical Inventory Worksheet</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Physical Inventory Worksheet" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Product/Service List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Product/Service List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Sales by Customer Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Sales by Customer Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Sales by Customer Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Sales by Customer Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Sales by Customer Type Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Sales by Customer Type Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Sales by Product/Service Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Sales by Product/Service Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Sales by Product/Service Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Sales by Product/Service Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Time Activities by Customer Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Time Activities by Customer Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Transaction List by Customer</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Transaction List by Customer" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
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
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">1099 Contractor Balance Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="1099 Contractor Balance Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">1099 Contractor Balance Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="1099 Contractor Balance Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Accounts payable aging detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Accounts payable aging detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Accounts payable aging summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Accounts payable aging summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Bill Payment List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Bill Payment List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Bills and Applied Payments</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Bills and Applied Payments" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Unpaid Bills</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Unpaid Bills" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Vendor Balance Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Vendor Balance Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Vendor Balance Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Vendor Balance Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
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
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">1099 Transaction Detail Report
</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="1099 Transaction Detail Report" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Check Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Check Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Expenses by Vendor Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Expenses by Vendor Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Transaction List by Vendor</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Transaction List by Vendor" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Vendor Contact List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Vendor Contact List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
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
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Sales Tax Liability Report</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Sales Tax Liability Report" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Taxable Sales Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Taxable Sales Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Taxable Sales Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Taxable Sales Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
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
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Recent/Edited Time Activities</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Recent/Edited Time Activities" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Time Activities by Employee Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Time Activities by Employee Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
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
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Account List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Account List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
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
														<a href="#" class="h5 mb-0 font-weight-normal">General Ledger</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="General Ledger" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Journal</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Journal" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
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
														<a href="#" class="h5 mb-0 font-weight-normal">Recent Transactions</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Recent Transactions" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Reconciliation Reports</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Reconciliation Reports" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Recurring Template List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Recurring Template List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
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
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Transaction Detail by Account</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Transaction Detail by Account" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Transaction List by Date</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Transaction List by Date" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Transaction List with Splits</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Transaction List with Splits" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Trial Balance</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Trial Balance" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
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
											<div class="col-sm-5 card-body py-4 pl-5">
												<ul class="list-unstyled">
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Employee Details</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Employee Details" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Employee Directory</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Employee Directory" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Multiple Worksites</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Multiple Worksites" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Paycheck List</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Paycheck List" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payroll Billing Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payroll Billing Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payroll Deductions/Contributions</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payroll Deductions/Contributions" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payroll Details</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payroll Details" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payroll Summary by Employee</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payroll Summary by Employee" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payroll Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payroll Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payroll Tax Liability</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payroll Tax Liability" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payroll Tax Payments</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payroll Tax Payments" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Payroll Tax and Wage Summary</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Payroll Tax and Wage Summary" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Recent/Edited Time Activities</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Recent/Edited Time Activities" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Retirement Plans</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Retirement Plans" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Time Activities by Employee Detail</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Time Activities by Employee Detail" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Total Pay</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Total Pay" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Total Payroll Cost</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Total Payroll Cost" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Vacation and Sick Leave</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Vacation and Sick Leave" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
													<li class="border-bottom p-3 cursor-pointer">
														<a href="#" class="h5 mb-0 font-weight-normal">Workers' Compensation</a>
														<a href="#" class="pl-1 text-secondary h6 position-relative top-1"><i class="fa fa-question-circle-o "></i></a>
														<div class="dropdown pull-right d-inline-block">
                                                            <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v fa-lg"></i>
															</span>
                                                            <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                <li><a href="#" class="dropdown-item">Customize</a></li>
                                                            </ul>
                                                        </div>
														<a href="#" onclick="addToFavorites(this)" data-name="Workers' Compensation" data-link="#" class="pr-4 text-secondary h6 pull-right"><i class="fa fa-star-o fa-lg"></i></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								 </div>
                            </div>
                            <div class="tab-pane fade" id="custom">
                                <div class="px-4 pb-4">
									<table id="all_sales_table" class="table table-striped table-bordered w-100">
											<thead>
											<tr>
												<th>NAME</th>
												<th>CREATED</th>
												<th>DATE RANGE</th>
												<th>EMAIL</th>
												<th>ACTION</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td>John Meyer</td>
												<td>01-01-01</td>
												<td>09-09-09</td>
												<td>test@gmail.com</td>
												<td><a href="">View</a></td>
											</tr>
											</tbody>
									</table>
								</div>
							</div>
                            <div class="tab-pane fade" id="management">
								<div class="px-4 pb-4">
									<table id="manage_reports_table" class="table table-striped table-bordered w-100">
											<thead>
											<tr>
												<th>NAME</th>
												<th>CREATED BY</th>
												<th>LAST MODIFIED</th>
												<th>REPORT PERIOD</th>
												<th>ACTION</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td>John Meyer</td>
												<td>Anne Mae</td>
												<td>09-09-09</td>
												<td></td>
												<td><a href="">View</a></td>
											</tr>
											</tbody>
									</table>
								</div>
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