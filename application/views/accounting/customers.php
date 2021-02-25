<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper accounting-sales" role="wrapper" >
        <!-- page wrapper start -->
		<div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
					<div style="padding-top:1%;">
						<h3 style="font-family: Sarabun, sans-serif">Customers</h3>
					</div>
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
					As your business grows, it's important to stay organized and keep track of your customers.  You can add customer profiles so you can quickly add them to transactions or invoices. Here's how to add customers and keep your customer list up-to-date. <br>
					Select New Customer.<br>
					Enter your customer’s info.<br>
					Select Save.  <br>
                    </div>
			<div class="page-title-box mx-4">
				<!-- <div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab-active text-decoration-none">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div>
				</div> -->
					<div class="col-md-12 banking-tab-container" style="background-color:white;">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab-active text-decoration-none">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div>
				<div class="row pt-3">
					<div class="col-lg-6 px-0">
						<!-- <h2>Customers</h2> -->
					</div>
					<div class="col-lg-6">
						<div class="pull-right">
							<button class="btn btn-success rounded-20" type="button" id="dropNewTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								New Customer&ensp;<span class="fa fa-caret-down"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropNewTraaction">
								<a class="dropdown-item" href="#">Import Customers</a>
							</div>
						</div>
						<div class="pull-right mr-3">
							<button class="btn btn-default rounded-20" type="button">
								Customer Types
							</button>
						</div>
					</div>
				</div>
				<div class="row mt-2 align-items-end">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="row pt-3 align-items-end mr-1">
							<div class="col px-0">
								<div class="bg-info px-3 py-2" style="height:100px;">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">ESTIMATES</h6>
								</div>
							</div>
							<div class="col px-0">
								<p class="text-primary mb-1">Unbilled Last 365 Days</p>
								<div class="bg-primary px-3 py-2" style="height:100px;">
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
								<div class="bg-warning px-3 py-2" style="height:100px;">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">OVERDUE</h6>
								</div>
							</div>
							<div class="col px-0">
								<div class="bg-secondary px-3 py-2" style="height:100px;">
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
								<div class="bg-success px-3 py-2" style="height:100px;">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">PAID LAST 30 DAYS</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row pt-3">
					<div class="col-lg-12 px-0">
						<div class="bg-white p-4">
							<table id="all_sales_table" class="table table-striped table-bordered w-100">
										<thead>
										<tr>
											<th></th>
											<th>Customer/Company</th>
											<th>Phone</th>
											<th>Open Balance</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<!-- <tr>
											<td><input type="checkbox"></td>
											<td>John Meyer</td>
											<td>1234567890</td>
											<td>$32</td>
											<td><a href="">View</a></td>
										</tr> -->
										<?php foreach($customers as $cus) : ?>
										<tr>
											<td><input type="checkbox"></td>
											<td><?php echo $cus->first_name .' '.  $cus->middle_name .' '. $cus->last_name ?></td>
											<td><?php echo $cus->phone_h; ?></td>
											<td><?php //echo $cus->created_at; ?></td>
											<td><a href="" class="btn btn-info">View</a></td>
										</tr>
										<?php endforeach; ?>
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