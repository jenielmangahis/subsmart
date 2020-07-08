<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
    <div class="wrapper" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section>
        <div class="container-fluid w-97">
			<div class="row">
				<div class="col-lg-6">
					<h2>Sales Transactions</h2>
				</div>
				<div class="col-lg-6">
					<div class="dropdown pull-right rounded-circle">
						<button class="btn btn-success rounded" type="button" id="dropNewTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							New Transaction&ensp;&#9660;
						</button>
						<div class="dropdown-menu" aria-labelledby="dropNewTraaction">
							<a class="dropdown-item" href="#">Invoice</a>
							<a class="dropdown-item" href="#">Payment</a>
							<a class="dropdown-item" href="#">Estimate</a>
							<a class="dropdown-item" href="#">Sales Receipt</a>
							<a class="dropdown-item" href="#">Credit Memo</a>
							<a class="dropdown-item" href="#">Delayed Charge</a>
							<a class="dropdown-item" href="#">Time Activity</a>
						</div>
					</div>
					<div class="dropdown pull-right rounded-circle mr-3">
						<button class="btn btn-default rounded" type="button" id="dropImportantTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Important Transaction&ensp;&#9660;
						</button>
						<div class="dropdown-menu" aria-labelledby="dropImportantTraaction">
							<a class="dropdown-item" href="#">Square</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="bg-white p-4">
						<table id="all_sales_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>No.</th>
                                        <th>Customer</th>
                                        <th>Due Date</th>
                                        <th>Balance</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>06/29/2020</td>
                                        <td>Invoice</td>
                                        <td>1002</td>
                                        <td>John Meyer</td>
                                        <td>06/29/2020</td>
                                        <td>$32</td>
                                        <td>$42</td>
                                        <td>Open</td>
                                        <td><a href="">View</a></td>
                                    </tr>
                                    </tbody>
							</table>
						</div>
					</div>
				</div>
			<!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
	  <!-- page wrapper end -->
	  <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    </div>

<?php include viewPath('includes/footer_accounting'); ?>