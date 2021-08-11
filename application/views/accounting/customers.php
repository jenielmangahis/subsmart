<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
	.swal2-image {
		border-radius: 0 !important;
	}
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper accounting-sales" role="wrapper">
	<!-- page wrapper start -->
	<div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
		<div class="container-fluid" style="background-color:white;">
			<div style="padding-top:1%;">
				<h3 style="font-family: Sarabun, sans-serif">Customers</h3>
			</div>
			<div class="page-notification-section"
				style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
				As your business grows, it's important to stay organized and keep track of your customers. You can add
				customer profiles so you can quickly add them to transactions or invoices. Here's how to add customers
				and keep your customer list up-to-date. <br>
				Select New Customer.<br>
				Enter your customer’s info.<br>
				Select Save. <br>
			</div>
			<div class="page-title-box mx-4">
				<!-- <div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>"
				class="banking-tab">Overview</a>
				<a href="<?php echo url('/accounting/all-sales')?>"
					class="banking-tab">All Sales</a>
				<a href="<?php echo url('/accounting/invoices')?>"
					class="banking-tab">Invoices</a>
				<a href="<?php echo url('/accounting/customers')?>"
					class="banking-tab-active text-decoration-none">Customers</a>
				<a href="<?php echo url('/accounting/deposits')?>"
					class="banking-tab">Deposits</a>
				<a href="<?php echo url('/accounting/products-and-services')?>"
					class="banking-tab">Products and Services</a>
			</div>
		</div> -->
		<div class="col-md-12 banking-tab-container" style="background-color:white;z-index:2;">
			<a href="<?php echo url('/accounting/sales-overview')?>"
				class="banking-tab">Overview</a>
			<a href="<?php echo url('/accounting/all-sales')?>"
				class="banking-tab">All Sales</a>
			<a href="<?php echo url('/accounting/newEstimateList')?>"
				class="banking-tab">Estimates</a>
			<a href="<?php echo url('/accounting/customers')?>"
				class="banking-tab-active text-decoration-none">Customers</a>
			<a href="<?php echo url('/accounting/deposits')?>"
				class="banking-tab">Deposits</a>
			<a href="<?php echo url('/accounting/listworkOrder')?>"
				class="banking-tab">Work Order</a>
			<a href="<?php echo url('/accounting/invoices')?>"
				class="banking-tab">Invoices</a>
			<a href="<?php echo url('/accounting/jobs ')?>"
				class="banking-tab">Jobs</a>
			<a href="<?php echo url('/accounting/products-and-services')?>"
				class="banking-tab">Products and Services</a>
		</div>
		<div class="row pt-3">
			<div class="col-lg-6 px-0">
				<!-- <h2>Customers</h2> -->
			</div>
			<div class="col-lg-6">
				<div class="pull-right">
					<button type="submit" data-submit-type="save-send" class="btn btn-success"
						data-target="#modalNewCustomer" data-toggle="modal" style="border-radius: 20px 0 0 20px">New
						Customer</button>
					<button class="btn btn-success" type="button" data-toggle="dropdown"
						style="border-radius: 0 20px 20px 0;margin-left: -5px;">
						<span class="fa fa-caret-down"></span></button>
					<ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
						<li>
							<button type="submit" data-submit-type="save-close" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Import Customers</button>
						</li>
					</ul>
				</div>
				<div class="pull-right mr-3">
					<button class="btn btn-default rounded-20" type="button" data-target="#customer_type_modal"
						data-toggle="modal">
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
					<div class="section-above-table">
						<div class="batch-actiom-icon-holder">
							<img src="<?=base_url('assets/img/trac360/batch_arrow_down.png')?>"
								class="batch-actiom-icon">
						</div>
						<div class="dropdown-holder">
							<button class="btn btn-default rounded-20" type="button" id="dropNewTraaction"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Batch action <span class="fa fa-caret-down"></span>
							</button>
							<ul class="dropdown-menu dropdown-menu-right" role="menu"
								aria-labelledby="dropNewTraaction">
								<li class="disabled">
									<a href="javascript:void(0)" class="created-statement-btn"
										data-statement-modal-type="by-batch" data-toggle="modal"
										data-target="#create_statement_modal">
										Create statement
									</a>
								</li>
								<li class="disabled">
									<a href="javascript:void(0)" class="email-by-batch">
										Email
									</a>
								</li>
								<li class="disabled">
									<a href="javascript:void(0)" class="make-customer-inactive-by-batch">
										Make inactive
									</a>
								</li>
								<li class="disabled">
									<a href="javascript:void(0)" class="slect-customer-type-by-batch">
										Select customer type
									</a>
								</li>
								<li role="separator" class="divider"></li>
							</ul>
						</div>
						<div class="search-holder">
							<div class="search-field">
								<input type="text" class="search" name="filter_customers_table"
									placeholder="Find a customer or company">
								<i class="fa fa-search" aria-hidden="true"></i>
							</div>
							<div class="search-result">
								<ul class="dropdown-menu dropdown-menu-right overflow-auto" role="menu"
									aria-labelledby="dropNewTraaction">
								</ul>
							</div>
						</div>
					</div>

					<table id="customers_table" class="table table-striped table-bordered w-100">
						<thead>
							<tr>
								<th class="center"><input type="checkbox" id="checkbox-all-action"></th>
								<th>Customer/Company</th>
								<th>Phone</th>
								<th class="text-right">Open Balance</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>

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
<!-- end container-fluid --><?php include viewPath('accounting/customer_includes/customer_single_modal/customer_single_modal'); ?>
</div>
<!-- page wrapper end -->

<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	data-keyboard="false" style="z-index: 1050 !important;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-0 pl-3 pb-3"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<?php include viewPath('accounting/customer_includes/send_reminder'); ?>
<?php include viewPath('accounting/customer_includes/customer_type/select_customer_type'); ?>
<?php include viewPath('accounting/customer_includes/customer_type/customer_types_modal'); ?>
<?php include viewPath('accounting/customer_includes/create_statement/create_statement_modal'); ?>
<?php include viewPath('accounting/customer_includes/time_activity/time_activity'); ?>

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script>
	var customer_length = <?=count($customers)?> ;
</script>

<?php include viewPath('includes/footer_accounting');
