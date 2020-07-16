<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none;
    }
    .show>.btn-primary.dropdown-toggle {
    background-color: #32243D;
    border: 1px solid #32243D;
}
    .p-padding{
        padding-left: 10%;
    }
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box mx-4">
				<div class="row pb-2">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/chart_of_accounts')?>" class="banking-tab-active text-decoration-none">Chart of Accounts</a>
                        <a href="#" class="banking-tab">Reconcile</a>
                    </div>
                </div>
                <div class="row align-items-center pt-3">
					<div class="col-lg-6 px-0">
						<h2 class="mb-0">Chart of Accounts</h2>
						<ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Chart of Accounts</li>
                        </ol>
					</div>
                    <div class="col-sm-6 px-0">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown show">
                            
                            <a href="#" class="btn btn-success rounded"
                                   aria-expanded="false">
                                    Run Report
                            </a>
                             <a href="<?php echo url('/accounting/chart_of_accounts/create') ?>" class="btn btn-success rounded"
                                   aria-expanded="false">
                                    Add New
                              </a>
                              <a class="btn btn-primary hide-toggle dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-chevron-down"></i>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Import</a>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
            	<div class="col-md-12">
            		<?php if($this->session->flashdata('success')){ ?>
            		<div class="alert alert-success alert-dismissible">
            		   <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } if($this->session->flashdata('error')){ ?>
					<div class="alert alert-danger alert-dismissible">
					   <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php } ?>
            	</div>
            </div>
				<?php echo form_open_multipart('accounting/chart_of_accounts/add', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
				<div class="row pt-2">
					<div class="col-xl-12 px-0">
						<div class="card p-0">
							<div class="card-body px-4 py-3">
								<div class="row mb-3">
									<div class="col-md-10"></div>
									 <div class="col-md-2">
										 <div class="dropdown">
											<a href="" ><i class="fa fa-edit"></i></a>
											<a href="" ><i class="fa fa-print"></i></a>
										   <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-cog"></i>
										  </a>
										  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											Columns<br/>
											<p class="p-padding"><input type="checkbox" name="chk_type" id="chk_type"> Type</p>
											<p class="p-padding"><input type="checkbox" name="chk_detail_type" id="chk_detail_type"> Detail Type</p>
											<p class="p-padding"><input type="checkbox" name="chk_nsmart_balance" id="chk_nsmart_balance"> Nsmart Balance</p>
											<p class="p-padding"><input type="checkbox" name="chk_balance" id="chk_balance"> Balance</p>
											<br/>
											<p class="p-padding"><input type="checkbox" name="chk_other" id="chk_other"> Other</p>
										  </div>
										</div>
									 </div>
								 </div>
								<table id="charts_of_account_table" class="table table-striped table-bordered" style="width:100%">
									<thead>
									<tr>
										<th></th>
										<th>NAME</th>
										<th>TYPE</th>
										<th>DETAIL TYPE</th>
										<th>NSMARTRAC BALANCE</th>
										<th>BANK BALANCE</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td><input type="checkbox"></td>
										<td contenteditable="true">Cash on hand</td>
										<td>Bank</td>
										<td>Cash on hand</td>
										<td>111,111.00</td>
										<td></td>
										<td>
										<div class="dropdown show">
										  <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										   View Register
										  </a>

										  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" href="#">Connect Bank</a>
											<a class="dropdown-item" href="<?php echo url('/accounting/chart_of_accounts/edit') ?>">Edit</a>
											<a class="dropdown-item" href="#">Make Inactive (Reduce usage)</a>
											<a class="dropdown-item" href="#">Run Report</a>
										  </div> 
										</div>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- end card -->
					</div>
				</div>
            </div>
            <!-- end row -->
			<?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php /*include viewPath('includes/footer');*/ ?>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    $(document).ready(function() {
        $('#charts_of_account_table').DataTable();
    } );
</script>