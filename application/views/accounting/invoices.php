<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
			<div class="page-title-box mx-4">
				<div class="col-lg-6 px-0">
						<h3>Invoice</h3>
					</div>
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                        This is Invoice gold band 
                    </div>
					<br>
				<div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab-active text-decoration-none">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-sm-6 px-0">
						<div class="row px-4">
							<div class="col-sm-12">
								<h6 class="font-weight-normal"><strong>$4 Unpaid</strong><span class="pl-3">Last 365 days</span></h6>
							</div>
							<div class="col-sm-12 mt-0">
								<div class="pull-left">
									<h3 class="mb-0"><strong>$0.00</strong></h3>
									<h6 class="font-weight-normal text-dark mt-1">Overdue</h6>
								</div>
								<div class="pull-right">
									<h3 class="mb-0"><strong>$4.00</strong></h3>
									<h6 class="font-weight-normal text-dark mt-1">Not due yet</h6>
								</div>
							</div>
							<div class="col-sm-12 mt-1">
								<div class="progress" style="height:30px">
									<div class="progress-bar bg-secondary w-50"></div>
									<div class="progress-bar bg-dark  w-50"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 px-0">
						<div class="row px-4">
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
				<div class="row mt-5">
					<div class="col-lg-12 px-0">
						<div class="bg-white p-4">
							<table id="all_sales_table" class="table table-striped table-bordered w-100">
										<thead>
										<tr>
											<th></th>
											<th>Invoice</th>
											<th>Customer</th>
											<th>Date</th>
											<th>Due Date</th>
											<th>Balance</th>
											<th>Total</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<!-- <tr>
											<td><input type="checkbox"></td>
											<td>1234</td>
											<td>John Meyer</td>
											<td>06/29/2020</td>
											<td>06/29/2020</td>
											<td>$32</td>
											<td>$42</td>
											<td>Open</td>
											<td><a href="">View</a></td>
										</tr> -->
										<?php foreach($invoices as $invoice) : ?>
										<tr>
											<td><input type="checkbox"></td>
											<td><?php echo $invoice->id; ?></td>
											<td><?php echo $invoice->customer_id; ?></td>
											<td><?php echo $invoice->created_at; ?></td>
											<td><?php echo $invoice->due_date; ?></td>
											<td><?php echo $invoice->id; ?></td>
											<td><?php //echo $invoice->amoungt; ?></td>
											<td><?php echo $invoice->status; ?></td>
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