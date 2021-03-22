<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .loader
    {
        display: none !important;
    }
    .hide-toggle::after {
        display: none !important;
    }
	.action-bar .dropdown-menu a:hover {
		background: none !important;
	}
	#products-services-table .btn-group .btn:hover, #products-services-table .btn-group .btn:focus {
        color: unset;
    }
    #products-services-table .btn-group .btn {
        padding: 10px;
    }
	#products-services-table img {
		max-height: 52px;
	}
	#products-services-table tbody tr td:first-child {
		padding: 10px 18px;
	}
	.type-icon {
		height: 100%;
		background-position: center;
    	border-radius: 100%;
		background-repeat: no-repeat;
		background-color: #0077c5;
	}
	#types-table.table-hover tr:hover {
		background-color: #fff;
	}
	#types-table tr:last-child td {
		border-bottom: 1px solid #dee2e6; 
	}
	#types-table tr td {
		padding: 12px 30px;
	}
	.no-icon {
		background-image: url('/uploads/accounting/attachments/default-item.png');
		height: 100%;
		background-repeat: no-repeat;
		background-position: center;
	}
	.no-icon:hover, .preview-uploaded:hover {
		cursor: pointer;
		border-color: #8d9096 !important;
	}
	.preview-uploaded {
		height: 100%;
	}
	.modal .modal-footer .btn-group .btn:not(:first-child) {
		border-top-left-radius: 0 !important;
    	border-bottom-left-radius: 0 !important;
	}
	.action-bar .select2.select2-container {
		text-align: left;
	}
	.dropdown-item.disabled {
		color: #6c757d !important
	}
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Products and Services</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">If you are not enrolled in our inventory management system, you may want to consider this feature.  With this powerful feature means being able to track the products you sell and the services you provide per location.  This feature means less shrinkage and more profitability.</span>
                                    </div>
                                </div>
                            </div>
							<div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
									<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
									<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
									<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
									<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
									<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
									<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab-active text-decoration-none">Products and Services</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
									<h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-sm-6">
									<div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
											<div class="btn-group mr-2">
												<button type="button" class="btn btn-secondary dropdown-toggle hide-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													More&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="/accounting/product-categories">Manage categories</a>
													<a class="dropdown-item" href="#">Run Report</a>
												</div>
											</div>
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#type-selection-modal" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    New
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-6 pl-0 border-right">
									<div class="row align-items-center">
										<div class="col-sm-3 offset-sm-6">
											<p class="mb-0 bg-warning border border-dark rounded-circle p-4"><img src="<?php echo base_url();?>assets/img/accounting/low-stock.png" class="w-100 img-responsive"></p>
										</div>
										<div class="col-sm-3">
											<h1 class="text-warning">0</h1>
											<h5>LOW STOCK</h5>
										</div>
									</div>
								</div>
								<div class="col-sm-6 pr-0">
									<div class="row  pl-3 align-items-center">
										<div class="col-sm-3">
											<p class="mb-0 bg-danger border border-dark rounded-circle p-3"><img src="<?php echo base_url();?>assets/img/accounting/out-of-stock.png" class="w-100 img-responsive"></p>
										</div>
										<div class="col-sm-4">
											<h1 class="text-danger">0</h1>
											<h5>OUT OF STOCK</h5>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                        <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-6">
										<div class="form-row">
                                            <div class="col-4">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Find products and services">
                                            </div>
                                            <div class="col">
												<div class="dropdown d-inline-block d-flex align-items-center h-100">
													<a href="javascript:void(0);" class="dropdown-toggle hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter"></i></a>

													<div class="dropdown-menu p-3 w-auto" aria-labelledby="filterDropdown">
														<div class="inner-filter-list">
															<div class="row">
																<div class="col-sm-6">
																	<div class="form-group">
																		<label for="status">Status</label>
																		<select name="status" id="status" class="form-control">
																			<option value="active" selected>Active</option>
																			<option value="inactive">Inactive</option>
																			<option value="all">All</option>
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="type">Type</label>
																		<select name="type" id="type" class="form-control">
																			<option value="all" selected>All</option>
																			<option value="inventory">Inventory</option>
																			<option value="non-inventory">Non-inventory</option>
																			<option value="service">Service</option>
																			<option value="bundle">Bundle</option>
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="category">Category</label>
																		<select name="category[]" id="category" class="form-control" multiple="multiple">
																			<?php foreach($this->items_model->getItemCategories() as $category) : ?>
																				<option value="<?=$category->item_categories_id?>" selected><?=$category->name?></option>
																			<?php endforeach; ?>
																			<option value="0" selected>Uncategorized</option>
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="stock_status">Stock status</label>
																		<select name="stock_status" id="stock_status" class="form-control">
																			<option value="all">All</option>
																			<option value="low stock">Low stock</option>
																			<option value="out of stock">Out of stock</option>
																		</select>
																	</div>
																</div>
															</div>

															<div class="btn-group">
																<a href="#" class="btn-main" onclick="resetbtn()">Reset</a>
																<a href="#" id="apply-btn" class="btn-main apply-btn" onclick="applybtn()">Apply</a>
															</div>
														</div>
													</div>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
										<div class="action-bar h-100 d-none align-items-center">
											<ul class="ml-auto" style="min-width: 50%">
												<li class="d-flex align-items-center">
													<select id="assign-category" class="form-control">
													<option></option>
													<option value="0">Uncategorized</option>
													<?php foreach($this->items_model->getItemCategories() as $category) : ?>
														<option value="<?=$category->item_categories_id?>"><?=$category->name?></option>
													<?php endforeach; ?>
													</select>

													<div class="ml-2 btn-group">
														<button type="button" class="btn btn-secondary dropdown-toggle hide-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Batch actions&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item batch-make-inactive" href="#">Make inactive</a>
															<a class="dropdown-item batch-adjust-qty disabled" href="#">Adjust quantity</a>
															<a class="dropdown-item batch-reoder disabled" href="#">Reorder</a>
															<a class="dropdown-item batch-change-type disabled" href="#">Make non-inventory</a>
															<a class="dropdown-item batch-change-type disabled" href="#">Make service</a>
														</div>
													</div>
												</li>
											</ul>
										</div>
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
												<li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
												<li><a href="#"><i class="fa fa-download"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_income_account"> Income account</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_expense_account"> Expense account</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_inventory_account"> Inventory account</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_purch_desc"> Purchase description</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_qty_po"> Qty on PO</p>
														<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_sku"> SKU</p>
														<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_type"> Type</p>
														<div class="show-more hide">
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_sales_desc"> Sales description</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_sales_price"> Sales price</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_cost"> Cost</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_taxable"> Taxable</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_qty_on_hand"> Qty on hand</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_reorder_point"> Reorder point</p>
														</div>
														<a href="#" class="text-info text-center show-more-button"><i class="fa fa-caret-down text-info"></i> &nbsp;Show more</a>
                                                        <p class="m-0">Rows</p>
                                                        <p class="m-0">
                                                            <select name="table_rows" id="table_rows" class="form-control">
                                                                <option value="50">50</option>
                                                                <option value="75">75</option>
                                                                <option value="100">100</option>
                                                                <option value="150" selected>150</option>
                                                                <option value="300">300</option>
                                                            </select>
                                                        </p>
														<p class="m-0"><input type="checkbox" id="compact"> Compact</p>
														<p class="m-0"><input type="checkbox" checked="checked" id="group_by_category" value="1"> Group by category</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="products-services-table" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
											<th><input type="checkbox" value="all"></th>
											<th>NAME</th>
											<th class="sku">SKU</th>
											<th class="type">TYPE</th>
											<th class="sales_desc">SALES DESCRIPTION</th>
											<th class="income_account hide">INCOME ACCOUNT</th>
											<th class="expense_account hide">EXPENSE ACCOUNT</th>
											<th class="inventory_account hide">INVENTORY ACCOUNT</th>
											<th class="purch_desc hide">PURCHASE DESCRIPTION</th>
											<th class="sales_price">SALES PRICE</th>
											<th class="cost">COST</th>
											<th class="taxable">TAXABLE</th>
											<th class="qty_on_hand">QTY ON HAND</th>
											<th class="qty_po hide">QTY ON PO</th>
											<th class="reorder_point">REORDER POINT</th>
											<th>ACTION</th>
                                        </tr>
									</thead>
									<tbody></tbody>
								</table>
                            </div>

							<!--    Modal for creating rules-->
                            <div class="modal-right-side">
                                <div class="modal right fade" id="type-selection-modal" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel2" >Product/Service information</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
											<div class="modal-body p-0">
												<table class="table table-hover cursor-pointer" id="types-table">
													<tbody>
														<tr data-href="inventory">
															<td>
																<div class="row" style="height: 117px">
																	<div class="col-sm-3">
																		<div class="type-icon" style="background-image: url('/assets/img/accounting/inventory.png')"></div>
																	</div>
																	<div class="col-sm-9 d-flex align-items-center">
																		<div class="type-description">
																			<h5 class="m-0">Inventory</h5>
																			<span>Products you buy and/or sell and that you track quantities of.</span>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														<tr data-href="non-inventory">
															<td>
																<div class="row" style="height: 117px">
																	<div class="col-sm-3">
																		<div class="type-icon" style="background-image: url('/assets/img/accounting/non-inventory.png')"></div>
																	</div>
																	<div class="col-sm-9 d-flex align-items-center">
																		<div class="type-description">
																			<h5 class="m-0">Non-inventory</h5>
																			<span>Products you buy and/or sell but don’t need to (or can’t) track quantities of, for example, nuts and bolts used in an installation.</span>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														<tr data-href="service">
															<td>
																<div class="row" style="height: 117px">
																	<div class="col-sm-3">
																		<div class="type-icon" style="background-image: url('/assets/img/accounting/service.png')"></div>
																	</div>
																	<div class="col-sm-9 d-flex align-items-center">
																		<div class="type-description">
																			<h5 class="m-0">Service</h5>
																			<span>Services that you provide to customers, for example, landscaping or tax preparation services.</span>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														<tr data-href="bundle">
															<td>
																<div class="row" style="height: 117px">
																	<div class="col-sm-3">
																		<div class="type-icon" style="background-image: url('/assets/img/accounting/bundle.png')"></div>
																	</div>
																	<div class="col-sm-9 d-flex align-items-center">
																		<div class="type-description">
																			<h5 class="m-0">Bundle</h5>
																			<span>A collection of products and/or services that you sell together, for example, a gift basket of fruit, cheese, and wine.</span>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--    end of modal-->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="modal-form-container"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>