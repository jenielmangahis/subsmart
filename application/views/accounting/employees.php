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
						<a href="<?php echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
						<a href="<?php echo url('/accounting/employees')?>" class="banking-tab-active text-decoration-none">Employees</a>
						<a href="#" class="banking-tab">Contractors</a>
						<a href="#" class="banking-tab">Worker's Comp</a>
						<a href="#" class="banking-tab">Benefits</a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-6 px-0">
						<h2>Employees</h2>
					</div>
					<div class="col-lg-6">
						<div class="dropdown pull-right rounded-circle">
							<button class="btn btn-success rounded" type="button" id="dropNewTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Run Payroll&ensp;&#9660;
							</button>
							<div class="dropdown-menu" aria-labelledby="dropNewTraaction">
								<a class="dropdown-item" href="#">Bonus Only</a>
								<a class="dropdown-item" href="#">Commission Only</a>
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
											<th>Name</th>
											<th>Pay Rate</th>
											<th>Pay Method</th>
											<th>Pay Schedule</th>
											<th>Status</th>
										</tr>
										</thead>
										<tbody>
											<tr>
												<td>John Meyer</td>
												<td>$32</td>
												<td>Paypal</td>
												<td>Every Monday</td>
												<td><a href="">Active</a></td>
											</tr>
											<tr>
												<td>Chris Worth</td>
												<td>$52</td>
												<td>Check</td>
												<td>Every Friday</td>
												<td><a href="">Active</a></td>
											</tr>
											<tr>
												<td>Tina Burns</td>
												<td>$35</td>
												<td>Check</td>
												<td>Every Saturday</td>
												<td><a href="">Active</a></td>
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