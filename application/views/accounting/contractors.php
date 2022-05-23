<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper accounting-sales" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section>
        <div class="container-fluid">
			<div class="page-title-box mx-4">
				<div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
						<a href="<?php echo url('/accounting/employees')?>" class="banking-tab">Employees</a>
						<a href="<?php echo url('/accounting/contractors')?>" class="banking-tab-active text-decoration-none">Contractors</a>
						<a href="<?php echo url('/accounting/workers-comp')?>"" class="banking-tab">Worker's Comp</a>
						<a href="#" class="banking-tab">Benefits</a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-6 px-0">
						<h2>Contractors</h2>
					</div>
					<div class="col-lg-6">
						<div class="pull-right">
							<button class="btn btn-success rounded-20" type="button">
								Add Contractor
							</button>
						</div>
						<div class="pull-right mr-3">
							<button class="btn btn-default rounded-20" type="button">
								Prepare 1099s
							</button>
						</div>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12 px-0">
						<div class="bg-white p-4">
							<table id="all_sales_table" class="table table-striped table-bordered w-100">
										<thead>
										<tr>
											<th>Customer/Company</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
											<tr>
												<td>John Meyer</td>
												<td><a href="#">Write Check</a></td>
											</tr>
											<tr>
												<td>John Meyer</td>
												<td><a href="#">Write Check</a></td>
											</tr>
											<tr>
												<td>John Meyer</td>
												<td><a href="#">Write Check</a></td>
											</tr>
											<tr>
												<td>John Meyer</td>
												<td><a href="#">Write Check</a></td>
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