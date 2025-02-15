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
    #chart-of-accounts-table .btn-group .btn:hover, #chart-of-accounts-table .btn-group .btn:focus {
        color: unset;
    }
    #chart-of-accounts-table .btn-group .btn {
        padding: 10px;
    }
    #myTabContent .action-bar ul li a:after {
        width: 0;
    }
    #myTabContent .action-bar ul li a {
    font-size: 20px;
    }
    #myTabContent .action-bar ul li {
        margin-right: 5px;
    }
    #myTabContent .action-bar ul li #cancel-edit-btn {
        color: #6B6C72;
        border: 0;
    }
    #myTabContent .action-bar ul li #cancel-edit-btn:hover {
        background: transparent;
    }
    .btn-transparent:hover {
        background: #d4d7dc !important;
        border-color: #6B6C72 !important;
    }
    .btn-transparent {
        color: #6B6C72 !important;
    }
    .btn-transparent:focus {
        border-color: #6B6C72 !important;
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
                                    <h3 class="page-title" style="margin: 0 !important">Chart of Accounts List</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">When you create your company file, our accounting software automatically customizes your chart of accounts based on your industry. You can add more accounts any time you need to track other types of transactions. It is very simple to add more accounts to your chart of accounts. Structuring and setting up the chart of accounts will eliminate the guesswork which in-turn can help run your business smoothly.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/chart_of_accounts')?>" class="banking-tab-active text-decoration-none">Chart of Accounts</a>
                                    <a href="<?php echo url('/accounting/reconcile')?>" class="banking-tab">Reconcile</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <a href="#" class="btn btn-secondary mr-2"
                                                aria-expanded="false" style="padding: 10px 12px !important">
                                                    Run Report
                                            </a>
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" id="add-new-account-button" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    Add New
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <div class="row my-3 d-none" id="edit-accounts-buttons">
                                    <div class="col">
                                        <div class="action-bar h-100 align-items-center">
											<ul class="ml-auto" style="min-width: 50%">
												<li>
													<button class="btn btn-transparent" id="cancel-edit-btn">Cancel</button>
												</li>
                                                <li>
                                                    <button class="btn btn-success" id="save-table-btn">Save</button>
                                                </li>
											</ul>
										</div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="col-2 d-flex align-items-end">
                                                <div class="arrow-level-down ml-auto">
                                                    <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                                </div>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-transparent" type="button"
                                                        id="statusDropdownButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Batch actions&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                                        <a href="#" class="dropdown-item disabled" id="make-inactive-batch">Make inactive</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Filter by name">
                                            </div>
                                            <!-- <div class="col-3">
                                                <select name="" id="type" class="form-control">
                                                    <option value="all">All</option>
                                                    <option value="ctl">Counts toward limits</option>
                                                </select>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" id="edit-accounts"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="#" id="print-accounts"><i class="fa fa-print"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" onchange="col_type()" name="chk_type" id="chk_type">
                                                            <label for="chk_type">Type</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" onchange="col_detailtype()" name="chk_detail_type" id="chk_detail_type">
                                                            <label for="chk_detail_type">Detail Type</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" onchange="col_nbalance()" name="chk_nsmart_balance" id="chk_nsmart_balance"> 
                                                            <label for="chk_nsmart_balance">nSmarTrac Balance</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" checked="checked" onchange="col_bank_balance()" name="chk_bank_balance" id="chk_bank_balance">
                                                            <label for="chk_bank_balance">Balance</label>
                                                        </div>
											            <p class="m-0">Other</p>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" id="inc_inactive" value="1">
                                                            <label for="inc_inactive">Include Inactive</label>
                                                        </div>
                                                        <p class="m-0">Rows</p>
                                                        <p class="m-0">
                                                            <select name="table_rows" id="table_rows" class="form-control">
                                                                <option value="50">50</option>
                                                                <option value="75">75</option>
                                                                <option value="100">100</option>
                                                                <option value="150" selected>150</option>
                                                                <option value="300">300</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="chart-of-accounts-table" class="table table-bordered table-hover">
									<thead>
                                        <tr>
                                            <th width="2%">
                                                <div class="d-flex justify-content-center">
													<div class="checkbox checkbox-sec m-0">
                                                        <input type="checkbox" id="select-all-accounts">
														<label for="select-all-accounts" class="p-0" style="width: 24px; height: 24px"></label>
													</div>
												</div>
                                            </th>
                                            <th>NAME</th>
                                            <th class="type">TYPE</th>
                                            <th class="detailtype">DETAIL TYPE</th>
                                            <th class="nbalance">NSMARTRAC BALANCE</th>
                                            <th class="bank_balance">BANK BALANCE</th>
                                            <th class="text-right" width="10%">ACTION</th>
                                        </tr>
									</thead>
									<tbody></tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-edit-account"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>