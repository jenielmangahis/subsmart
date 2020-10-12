<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section>
        <div class="container-fluid">
			<div class="page-title-box mx-4">
				<div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab-active text-decoration-none">Products and Services</a>
					</div>
				</div>
				
				<div class="row pt-3">
					<div class="col-lg-6 px-0">
						<h2>Products and Services</h2>
					</div>
					<div class="col-lg-6">
						<div class="pull-right">
							<button class="btn btn-success rounded-20" type="button" id="dropNewTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								NEW&ensp;<span class="fa fa-caret-down"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropNewTraaction">
								
								<a class="dropdown-item" href="#">Import</a>
							</div>
						</div>
						<div class="pull-right mr-3">
							<button class="btn btn-default rounded-20" type="button" id="dropImportantTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								MORE&ensp;<span class="fa fa-caret-down"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropImportantTraaction">
								<a class="dropdown-item" href="#">Manage Categories</a>
								<a class="dropdown-item" href="#">Run Report</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-3 bg-white p-3">
					<div class="col pl-0 border-right">
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
					<div class="col pr-0">
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
				<div class="row mt-4">
					<div class="col-lg-12 px-0">
						<div class="bg-white p-4">
							<table id="all_sales_table" class="table table-striped table-bordered w-100">
										<thead>
										<tr>
											<th></th>
											<th>Name</th>
											<th>SKU</th>
											<th>Type</th>
											<th>Sales Description</th>
											<th>Sales Price</th>
											<th>Cost</th>
											<th>Qty On Hand</th>
											<th>Reorder Point</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
											<tr>
												<td><input type="checkbox"></td>
												<td>Credit</td>
												<td></td>
												<td>Service</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><a href="">View</a></td>
											</tr>
											<tr>
												<td><input type="checkbox"></td>
												<td>Discount</td>
												<td></td>
												<td>Service</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><a href="">View</a></td>
											</tr>
											<tr>
												<td><input type="checkbox"></td>
												<td>Hours</td>
												<td></td>
												<td>Service</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><a href="">View</a></td>
											</tr>
											<tr>
												<td><input type="checkbox"></td>
												<td>Installation</td>
												<td></td>
												<td>Service</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><a href="">View</a></td>
											</tr>
											<tr>
												<td><input type="checkbox"></td>
												<td>Labor</td>
												<td></td>
												<td>Service</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><a href="">View</a></td>
											</tr>
										</tbody>
								</table>
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