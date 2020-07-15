<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
    <div class="wrapper accounting-sales" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section>
        <div class="container-fluid">
			<div class="page-title-box mx-4">
				<div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab-active text-decoration-none">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-6 px-0">
						<h2>Sales Transactions</h2>
					</div>
					<div class="col-lg-6">
						<div class="pull-right">
							<button class="btn btn-success rounded-20" type="button" id="dropNewTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								New Transaction&ensp;<span class="fa fa-caret-down"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropNewTraaction">
								<a class="dropdown-item" href="#">Invoice</a>
								<a class="dropdown-item" href="#">Payment</a>
								<a class="dropdown-item" href="#">Estimate</a>
								<a class="dropdown-item" href="#">Sales Receipt</a>
								<a class="dropdown-item" href="#">Credit Memo</a>
								<a class="dropdown-item" href="#">Delayed Charge</a>
								<a class="dropdown-item" href="#">Time Activity</a>
							</div>
						</div>
						<div class="pull-right mr-3">
							<button class="btn btn-default rounded-20" type="button" id="dropImportantTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Important Transaction&ensp;<span class="fa fa-caret-down"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropImportantTraaction">
								<a class="dropdown-item" href="#">Square</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2 align-items-end">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="row pt-3 align-items-end mr-1">
							<div class="col px-0">
								<div class="bg-info px-3 py-2">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">ESTIMATES</h6>
								</div>
							</div>
							<div class="col px-0">
								<p class="text-primary mb-1">Unbilled Last 365 Days</p>
								<div class="bg-primary px-3 py-2">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">UNBILLED ACTIVITY</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="row pt-3 align-items-end mr-1">
							<div class="col px-0">
								<p class="text-primary mb-1">Unpaid Last 365 Days</p>
								<div class="bg-warning px-3 py-2">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">OVERDUE</h6>
								</div>
							</div>
							<div class="col px-0">
								<div class="bg-secondary px-3 py-2">
									<h4 class="text-white">3</h4>
									<h6 class="text-white">OPEN INVOICES</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="row pt-3 align-items-end">
							<div class="col px-0">
								<p class="text-primary mb-1">Paid</p>
								<div class="bg-success px-3 py-2">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">PAID LAST 30 DAYS</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row mt-5">
					<div class="col-lg-12 px-0">
						<div class="bg-white p-4">
							<table id="all_sales_table" class="table table-striped table-bordered w-100">
										<thead>
										<tr>
											<th></th>
											<th>Date</th>
											<th>Type</th>
											<th>No.</th>
											<th>Customer</th>
											<th>Due Date</th>
											<th>Balance</th>
											<th>Total</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><input type="checkbox"></td>
											<td>06/29/2020</td>
											<td>Invoice</td>
											<td>1002</td>
											<td>John Meyer</td>
											<td>06/29/2020</td>
											<td>$32</td>
											<td>$42</td>
											<td>Open</td>
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