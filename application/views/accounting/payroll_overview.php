<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper" role="wrapper" >
       
        <!-- page wrapper start -->
        <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
            <div class="container-fluid" style="background-color:white;">
				<div class="page-title-box mx-4">
					<div class="col-lg-6 px-0">
						<h3>Payroll Overview</h3>
					</div>
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                        This is Payroll Overview gold band 
                    </div>
					<div class="row pb-2">
						<div class="col-md-12 banking-tab-container">
							<a href="<?php echo url('/accounting/payroll-overview')?>" class="banking-tab-active text-decoration-none">Overview</a>
							<a href="<?php echo url('/accounting/employees')?>" class="banking-tab">Employees</a>
							<a href="<?php echo url('/accounting/contractors')?>" class="banking-tab">Contractors</a>
							<a href="<?php echo url('/accounting/workers-comp')?>"" class="banking-tab">Worker's Comp</a>
							<a href="#" class="banking-tab">Benefits</a>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-lg-7 pl-0">
							<div class="bg-white">
								<div class="row p-4 rounded mx-0">
									<div class="col">
										<h1>It's time to run payroll</h1>
										<a href="#" class="btn btn-success rounded px-4 py-1"><h5>Let's go</h5></a>
									</div>
									
								</div>
								<div class="row align-items-end mx-0 p-4">
									<div class="col">
										<a href="#">View paycheck list</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-5 pr-0">
							<div class="bg-white p-4 rounded h-100">
								<h5 class="text-secondary mt-0">SHORTCUTS</h5>
								<div class="row px-2 text-center mt-4 align-items-center">
									<div class="col-sm-6">
										<p class=""><i class="fa fa-money h2 text-success border border-dark rounded-circle p-4"></i></p>
										<h6>Run Payroll</h6>
									</div>
									<div class="col-sm-6">
										<p class=""><i class="fa fa-user-plus h2 text-success border border-dark rounded-circle p-4"></i></p>
										<h6>Add Employee</h6>
									</div>
									<div class="col-sm-6">
										<p class=""><i class="fa fa-briefcase h2 text-success border border-dark rounded-circle p-4"></i></p>
										<h6>Pay Contractor</h6>
									</div>
									<div class="col-sm-6">
										<p class=""><i class="fa fa-user-plus h2 text-success border border-dark rounded-circle p-4"></i></p>
										<h6>Add Contractor</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- page wrapper end -->
		 <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
   </div>

<?php include viewPath('includes/footer_accounting'); ?>