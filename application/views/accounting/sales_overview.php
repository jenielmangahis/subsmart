<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
    <div class="wrapper" role="wrapper" >
       
        <!-- page wrapper start -->
        <div wrapper__section>
            <div class="container-fluid w-97">
					<div class="row ml-4 pb-2 mt-3">
						<div class="col-md-12 banking-tab-container">
							<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab-active" style="text-decoration: none">Overview</a>
							<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
							<a href="#" class="banking-tab">Invoices</a>
							<a href="#" class="banking-tab">Customers</a>
							<a href="#" class="banking-tab">Deposits</a>
							<a href="#" class="banking-tab">Products and Services</a>
						</div>
					</div>
					<div class="row ml-4 pt-3">
						<div class="col-lg-12">
							<div class="row bg-white px-3 py-4">
								<div class="col-lg-3">
									<h5 class="text-secondary">INCOME OVER TIME</h5>
									<div class="">
										<h1 class="display-4 pt-4"><strong>$2</strong></h1>
										<h6 class="text-secondary">THIS MONTH</h6>
									</div>
								</div>
								<div class="col-lg-9">
									<div class="dropdown pull-right dropdown-toggle">
									  <button class="btn btn-default border-0 p-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										This Month&ensp;
									  </button>
									  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">This Week</a>
										<a class="dropdown-item" href="#">This Month</a>
										<a class="dropdown-item" href="#">Last Month</a>
										<a class="dropdown-item" href="#">This Quarter</a>
										<a class="dropdown-item" href="#">Last Quarter</a>
										<a class="dropdown-item" href="#">This year by month</a>
										<a class="dropdown-item" href="#">This year by quarter</a>
										<a class="dropdown-item" href="#">Last year by month</a>
										<a class="dropdown-item" href="#">Last year by quarter</a>
									  </div>
									</div>
									<div class="chart w-100 border-left px-3" id="line-chart"  style="height: 250px;">
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