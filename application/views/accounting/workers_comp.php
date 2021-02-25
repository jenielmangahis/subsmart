<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper accounting-payroll" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid">
			<div class="page-title-box mx-4">
					<div class="col-lg-6 px-0">
						<h3>Workers' Comp</h3>
					</div>
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
					It's the law in every state except Texas. Take care of your employees if they get hurt on the job and protect your business from lawsuits and penalties.
                    </div>
					<br>
				<div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
						<a href="<?php echo url('/accounting/employees')?>" class="banking-tab">Employees</a>
						<a href="<?php echo url('/accounting/contractors')?>" class="banking-tab">Contractors</a>
						<a href="<?php echo url('/accounting/workers-comp')?>" class="banking-tab-active text-decoration-none">Worker's Comp</a>
						<a href="#" class="banking-tab">Benefits</a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12">
						<h1>49 states require workers' comp insurance</h1>
						<!-- <h5 class="font-weight-normal">It's the law in every state except Texas. Take care of your employees if they get hurt on<br>the job and protect your business from lawsuits and penalties.</h5> -->
					</div>
				</div>
				<div class="row pt-3 align-items-center">
					<div class="col-sm-3 col-xs-12">
						<p class="mb-0 text-center"><img src="<?php echo base_url();?>assets/img/accounting/computer_2.png" class="img-responsive max-85" /></p>
					</div>
					<div class="col-sm-9 col-xs-12">
						<ul class="list-unstyled">
							<li class="h5 font-weight-normal pt-2"><span class="fa fa-check text-success pr-3"></span>Get a quick online quote from our partner, AP Intego</li>
							<li class="h5 font-weight-normal pt-2"><span class="fa fa-check text-success pr-3"></span>Automatically pay what you owe when you run payroll</li>
							<li class="h5 font-weight-normal pt-2"><span class="fa fa-check text-success pr-3"></span>Manage workers' comp and payroll right in nSmarTrac</li>
						</ul>
						<a href="#" class="btn btn-success rounded-20 px-3 py-0"><h5>Get a quote</h5></a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12">
						<h3>Already have a workers' comp policy?</h3>
						<h5 class="font-weight-normal">Connect your policy to nSmarTrac and reap the benefits of simplification.</h5>
						<a href="#" class="btn btn-default rounded-20 px-3 py-0 mt-3"><h5>Connect my policy</h5></a>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-lg-12">
						<hr>
						<p class="pt-3">By selecting Get a quoteor Connect my policy, you agree for nSmarTrac to <a href="#">share your data</a> with our partner, AP Intego. Their use of your data is subject to their <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a></p>
						<p>The information on this and related pages is provided to you by Intuit Insurance Services Inc. and AP Intego. <a href="#">View Licenses</a></p>
					</div>
				</div>
            <!-- end row -->
			</div>
        </div>
        <!-- end container-fluid -->
    </div>
	  <!-- page wrapper end -->
	  <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    </div>

<?php include viewPath('includes/footer_accounting'); ?>