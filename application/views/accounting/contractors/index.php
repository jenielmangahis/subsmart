<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }
    .show>.btn-primary.dropdown-toggle {
        background-color: #32243D;
        border: 1px solid #32243D;
    }
    .action-bar ul li {
        margin-right: 0 !important;
    }
	.action-bar ul li button.btn-transparent {
        color: #6B6C72 !important;
    }
    .action-bar ul li button.btn-transparent:hover {
        background: #d4d7dc !important;
        border-color: #6B6C72 !important;
    }
	#contractors-table .btn-group .btn:hover, #contractors-table .btn-group .btn:focus {
        color: unset;
    }
    #contractors-table .btn-group .btn {
        padding: 10px;
    }
    #modalAddContractor .card-body {
        padding-bottom: 1.25rem;
    }
    #modalAddContractor label {
        font-weight: 600;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Contractors</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">See how easy paying and tracking contractors can be. This accounting features makes it easy to pay contractors today & W-2 employees tomorrow.  Get started by adding a Contractor.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
									<a href="<?php echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
									<a href="<?php echo url('/accounting/employees')?>" class="banking-tab">Employees</a>
									<a href="<?php echo url('/accounting/contractors')?>" class="banking-tab-active text-decoration-none">Contractors</a>
									<a href="<?php echo url('/accounting/workers-comp')?>" class="banking-tab">Worker's Comp</a>
									<a href="#" class="banking-tab">Benefits</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <!-- <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6> -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" id="run-payroll-button" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    Run payroll
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" id="bonus-only">Bonus only</a>
                                                    <a class="dropdown-item" href="#" id="commission-only">Commision only</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
            		    <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="col-3">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Find a contractor">
                                            </div>
                                            <div class="col-4">
                                                <select name="" id="contractor-status" class="form-control">
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="all">All</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><button class="btn btn-transparent" type="button">Prepare 1099s</button></li>
                                                <li><button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalAddContractor">Add a contractor</button></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="contractors-table" class="table table-bordered table-hover" style="width:100%">
									<thead>
                                        <tr>
											<th>Contractor</th>
											<th width="15%" class="text-right">Action</th>
                                        </tr>
									</thead>
									<tbody class="cursor-pointer"></tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

            <!-- add contractor modal -->
            <div class="modal fade" id="modalAddContractor" tabindex="-1" role="dialog" aria-labelledby="addContractorLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg w-25 m-auto" role="document">
                    <div class="modal-content">
                        <form action="/accounting/contractors/add" method="post" class="form-validate" novalidate="novalidate">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addContractorLabel">Add a contractor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                            </div>
                            <div class="modal-body" style="max-height: 25%;">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card p-0 m-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Name *</label>
                                                            <input type="text" class="form-control" name="name" id="name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email *</label>
                                                            <input type="email" class="form-control" name="email" id="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                            </div>
                            <!-- end modal-body -->
                            <div class="modal-footer">
                                <div class="row w-100">
                                    <div class="col-md-6"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div>
                                    <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end add contractor modal -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-modal"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>