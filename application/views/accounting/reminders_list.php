<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .loader
    {
        display: none !important;
    }
    #reminders-list .btn-group .btn:hover, #reminders-list .btn-group .btn:focus {
        color: unset;
    }
    #reminders-list .btn-group .btn {
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
	#myTabContent .action-bar ul li .dropdown-menu a {
		font-size: 14px;
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
                                    <h3 class="page-title" style="margin: 0 !important">Reminders List</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Reminders List Message</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center pb-3">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/recurring-transactions" class="text-info"><i class="fa fa-chevron-left"></i> Recurring Transactions</a></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right d-none d-md-block">
                                        <a href="#" data-toggle="modal" data-target="#transaction_type_modal" class="btn btn-success" style="padding: 10px 20px !important">
                                            New
                                        </a>
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
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row pb-3">
                                    <div class="col-md-6">
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Filter by name">
                                            </div>
                                            <div class="col-md-4">
                                                <select name="transaction_type" id="transaction-type" class="form-control">
                                                    <option value="all">All</option>
                                                    <option value="bill">Bill</option>
                                                    <option value="npcharge">Non-Posting Charge</option>
                                                    <option value="check">Check</option>
                                                    <option value="npcredit">Non-Posting Credit</option>
                                                    <option value="credit card credit">Credit Card Credit</option>
                                                    <option value="credit memo">Credit Memo</option>
                                                    <option value="deposit">Deposit</option>
                                                    <option value="estimate">Estimate</option>
                                                    <option value="expense">Expense</option>
                                                    <option value="invoice">Invoice</option>
                                                    <option value="journal entry">Journal Entry</option>
                                                    <option value="refund">Refund</option>
                                                    <option value="sales receipt">Sales Receipt</option>
                                                    <option value="transfer">Transfer</option>
                                                    <option value="vendor credit">Vendor Credit</option>
                                                    <option value="purchase order">Purchase Order</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-3">
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
                                                        <a href="#" class="dropdown-item disabled" id="create-batch">Create</a>
                                                        <a href="#" class="dropdown-item disabled" id="skip-batch">Skip</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" id="print-recurring-transactions"><i class="fa fa-print"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="p-padding m-0">Rows</p>
                                                        <p class="p-padding m-0">
                                                            <select name="table_rows" id="table_rows" class="form-control">
                                                                <option value="50" selected>50</option>
                                                                <option value="75">75</option>
                                                                <option value="100">100</option>
                                                                <option value="150">150</option>
                                                                <option value="300">300</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <table id="reminders-list" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th width="2%">
                                                <div class="d-flex justify-content-center">
													<div class="checkbox checkbox-sec m-0">
                                                        <input type="checkbox" id="select-all-reminders">
														<label for="select-all-reminders" class="p-0" style="width: 24px; height: 24px"></label>
													</div>
												</div>
                                            </th>
                                            <th>TEMPLATE NAME</th>
                                            <th>TXN TYPE</th>
                                            <th>INTERVAL</th>
                                            <th>PREVIOUS DATE</th>
                                            <th>NEXT DATE</th>
                                            <th>CUSTOMER/VENDOR</th>
                                            <th>AMOUNT</th>
                                            <th>ACTION</th>
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

    <div class="modal fade" id="transaction_type_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Transaction Type</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Select the type of template to create</p>
                                            <div class="form-group">
                                                <label for="type">Transaction Type</label>
                                                <select name="transaction_type" id="type" class="form-control">
                                                    <option value="bill">Bill</option>
                                                    <option value="non-posting-charge">Non-Posting Charge</option>
                                                    <option value="check">Check</option>
                                                    <option value="non-posting-credit">Non-Posting Credit</option>
                                                    <option value="credit-card-credit">Credit Card Credit</option>
                                                    <option value="credit-memo">Credit Memo</option>
                                                    <option value="deposit">Deposit</option>
                                                    <option value="estimate">Estimate</option>
                                                    <option value="expense">Expense</option>
                                                    <option value="invoice">Invoice</option>
                                                    <option value="journal-entry">Journal Entry</option>
                                                    <option value="refund">Refund</option>
                                                    <option value="sales-receipt">Sales Receipt</option>
                                                    <option value="transfer">Transfer</option>
                                                    <option value="vendor-credit">Vendor Credit</option>
                                                    <option value="purchase-order">Purchase Order</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success btn-rounded border float-right">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include viewPath('includes/footer_accounting'); ?>