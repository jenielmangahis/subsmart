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
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab-active text-decoration-none">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div>
				</div>

				<div class="row pt-3">
					<div class="col-lg-6 px-0">
						<h2>Deposits from Payments</h2>
					</div>
					<div class="col-lg-6">
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12 px-0">
						<div class="bg-white p-4">
							<table id="all_sales_table" class="table table-striped table-bordered w-100">
										<thead>
										<tr>
											<th></th>
											<th>Invoice</th>
											<th>Customer</th>
											<th>Date</th>
											<th>Deposited</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><input type="checkbox"></td>
											<td>1234</td>
											<td>John Meyer</td>
											<td>06/29/2020</td>
											<td>$42</td>
											<td>Success</td>
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