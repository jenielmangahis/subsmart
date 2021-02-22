<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper accounting-sales" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
			<div class="page-title-box mx-4">
					<div class="col-lg-6 px-0">
						<h3>Employees</h3>
					</div>
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
                        This is employee gold band 
                    </div>
				<div class="row pb-2">
					<div class="col-md-8 banking-tab-container">
						<a href="<?php echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
						<a href="<?php echo url('/accounting/employees')?>" class="banking-tab-active text-decoration-none">Employees</a>
						<a href="<?php echo url('/accounting/contractors')?>" class="banking-tab">Contractors</a>
						<a href="<?php echo url('/accounting/workers-comp')?>" class="banking-tab">Worker's Comp</a>
						<a href="#" class="banking-tab">Benefits</a>
					</div>
					<div class="col-md-4">
						<div class="pull-right">
							<button class="btn btn-success rounded-20" type="button" id="dropNewTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Run Payroll&ensp;<span class="fa fa-caret-down"></span>
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
												<?php foreach($employees as $employee) : ?>
											<tr>
	                                            <td><?php echo $employee->FName .' '.$employee->LName; ?></td>
												<td>100</td>
												<td>Paypal</td>
												<td>Monday</td>
												<td><a href="">Active</a></td>
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