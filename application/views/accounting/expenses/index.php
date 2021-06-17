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
    .action-bar .dropdown-menu a:hover {
        background: none !important;
    }
    .dropdown-menu .dropdown-item.disabled {
        cursor: default;
        opacity: 0.50;
        pointer-events: none;
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
                                    <h3 class="page-title" style="margin: 0 !important">Expense Transactions</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">An expense is generally anything that your company spends money on to keep it up and running. Examples of expenses are rent, phone bills, website hosting fees, office supplies, accountant fees, trash service, janitorial fees, etc. Simply click new transaction and you will see you will see a list of options to chose from. Once you choose the type of transactions; just enter the information and click save new.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/expenses')?>" class="banking-tab-active" style="text-decoration: none">Expenses</a>
                                    <a href="<?php echo url('/accounting/vendors')?>" class="banking-tab">Vendors</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <!-- <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6> -->
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <div class="float-right">
                                                <button type="button" class="btn btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    New transaction &nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" id="new-time-activity">Time activity</a>
                                                    <a class="dropdown-item" href="#" id="new-bill-transaction">Bill</a>
                                                    <a class="dropdown-item" href="#" id="new-expense-transaction">Expense</a>
                                                    <a class="dropdown-item" href="#" id="new-check-transaction">Check</a>
                                                    <a class="dropdown-item" href="#" id="new-purchase-order-transaction">Purchase order</a>
                                                    <a class="dropdown-item" href="#" id="new-vendor-credit-transaction">Vendor Credit</a>
                                                    <a class="dropdown-item" href="#" id="new-credit-card-pmt">Pay down credit card</a>
                                                </div>
                                            </div>
                                            <div class="btn-group float-right mr-2">
                                                <button type="button" class="btn btn-transparent d-flex align-items-center justify-content-center">
                                                    Print checks
                                                </button>
                                                <button type="button" class="btn btn-transparent dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" id="pay-bills">Pay bills</a>
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
                                <div class="row my-3">
                                    <div class="col-md-12 pb-3">
                                        <div class="dropdown d-inline-block d-flex align-items-center h-100">
                                            <a href="javascript:void(0);" class="btn btn-transparent dropdown-toggle hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter &nbsp;&nbsp;<span class="fa fa-caret-down"></span></a>

                                            <div class="dropdown-menu p-3" aria-labelledby="filterDropdown" style="max-width: 650px">
                                                <div class="inner-filter-list">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <label for="type">Type</label>
                                                                <select id="type" class="form-control">
                                                                    <option value="all">All transaction</option>
                                                                    <option value="expenses">Expenses</option>
                                                                    <option value="bill">Bill</option>
                                                                    <option value="bill-payments">Bill payments</option>
                                                                    <option value="check">Check</option>
                                                                    <option value="purchase-order">Purchase order</option>
                                                                    <option value="recently-paid">Recently paid</option>
                                                                    <option value="vendor-credit">Vendor credit</option>
                                                                    <option value="credit-card-payment">Credit Card Payment</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select id="status" class="form-control">
                                                                    <option value="all">All statuses</option>
                                                                    <option value="open">Open</option>
                                                                    <option value="overdue">Overdue</option>
                                                                    <option value="paid">Paid</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="del-method">Delivery Method</label>
                                                                <select id="del-method" class="form-control">
                                                                    <option value="any">Any</option>
                                                                    <option value="print-later">Print later</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="date">Date</label>
                                                                <select id="date" class="form-control">
                                                                    <option value="last-365-days">Last 365 days</option>
                                                                    <option value="custom">Custom</option>
                                                                    <option value="today">Today</option>
                                                                    <option value="yesterday">Yesterday</option>
                                                                    <option value="this-week">This week</option>
                                                                    <option value="this-month">This month</option>
                                                                    <option value="this-quarter">This quarter</option>
                                                                    <option value="this-year">This year</option>
                                                                    <option value="last-week">Last week</option>
                                                                    <option value="last-month">Last month</option>
                                                                    <option value="last-quarter">Last quarter</option>
                                                                    <option value="last-year">Last year</option>
                                                                    <option value="">All dates</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="from-date">From</label>
                                                                <input type="text" id="from-date" class="form-control datepicker" value="<?=date("m/d/Y")?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="to-date">To</label>
                                                                <input type="text" id="to-date" class="form-control datepicker">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label for="payee">Payee</label>
                                                                <select id="payee" class="form-control">
                                                                    <option value="all">All</option>
                                                                    <?php if(count($dropdown['vendors']) > 0) : ?>
                                                                    <optgroup label="Vendors">
                                                                    <?php foreach($dropdown['vendors'] as $vendor) : ?>
                                                                        <option value="vendor-<?=$vendor->id?>"><?=$vendor->display_name?></option>
                                                                    <?php endforeach; ?>
                                                                    </optgroup>
                                                                    <?php endif; ?>
                                                                    <?php if(count($dropdown['customers']) > 0) : ?>
                                                                    <optgroup label="Customers">
                                                                    <?php foreach($dropdown['customers'] as $customer) : ?>
                                                                        <option value="customer-<?=$customer->prof_id?>"><?=$customer->first_name . ' ' . $customer->last_name?></option>
                                                                    <?php endforeach; ?>
                                                                    </optgroup>
                                                                    <?php endif; ?>
                                                                    <?php if(count($dropdown['employees']) > 0) : ?>
                                                                    <optgroup label="Employees">
                                                                    <?php foreach($dropdown['employees'] as $employee) : ?>
                                                                        <option value="employee-<?=$employee->id?>"><?=$employee->FName . ' ' . $employee->LName?></option>
                                                                    <?php endforeach; ?>
                                                                    </optgroup>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="category">Category</label>
                                                                <select id="category" class="form-control">
                                                                    <option value="all">All</option>
                                                                    <?php foreach($dropdown['categories'] as $accType => $accounts) : ?>
                                                                        <optgroup label="<?=$accType?>">
                                                                            <?php foreach($accounts as $account) : ?>
                                                                                <option value="<?=$account->id?>"><?=$account->name?></option>

                                                                                <?php if(count($account->childAccs) > 0) : ?>
                                                                                    <optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                                                        <?php foreach($account->childAccs as $childAcc) : ?>
                                                                                            <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </optgroup>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="btn-group d-block">
                                                        <a href="#" class="btn-main" onclick="resetbtn()">Reset</a>
                                                        <a href="#" id="apply-btn" class="btn-main apply-btn" onclick="applybtn()">Apply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-sm-3 d-flex align-items-end justify-content-center">
                                                <div class="arrow-level-down m-0">
                                                    <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                                </div>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-transparent" type="button" id="statusDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Batch actions&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                                        <a href="#" class="dropdown-item disabled" id="print-transactions">Print transactions</a>
                                                        <a href="#" class="dropdown-item disabled" id="categorize-selected">Categorize selected</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                                <li><a href="#"><i class="fa fa-download"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_type" checked> Type</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_number" checked> No.</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_payee" checked> Payee</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_method" checked> Method</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_source" checked> Source</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_category" checked> Category</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_memo" checked> Memo</p>
														<div class="show-more hide">
                                                            <p class="m-0"><input type="checkbox" id="trans_due_date" checked> Due date</p>
                                                            <p class="m-0"><input type="checkbox" id="trans_balance" checked> Balance</p>
                                                            <p class="m-0"><input type="checkbox" id="trans_status" checked> Status</p>
                                                            <p class="m-0"><input type="checkbox" id="trans_attachments" checked> Attachments</p>
                                                        </div>
														<a href="#" class="text-info text-center show-more-button"><i class="fa fa-caret-down text-info"></i> &nbsp;Show more</a>
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
                                                        <p class="m-0"><input type="checkbox" id="compact-table"> Compact</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="transactions-table" class="table table-bordered table-hover" style="width:100%">
									<thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex justify-content-center">
                                                    <input type="checkbox" id="select-all-transactions">
                                                </div>
                                            </th>
                                            <th>DATE</th>
                                            <th class="type">TYPE</th>
                                            <th class="number">NO.</th>
                                            <th class="payee">PAYEE</th>
                                            <th class="method">METHOD</th>
                                            <th class="source">SOURCE</th>
                                            <th class="category">CATEGORY</th>
                                            <th class="memo">MEMO</th>
                                            <th class="due_date">DUE DATE</th>
                                            <th class="balance">BALANCE</th>
                                            <th>TOTAL</th>
                                            <th class="status">STATUS</th>
                                            <th class="text-center attachments"><i class="fa fa-paperclip"></i></th>
                                            <th class="text-right">ACTION</th>
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

            
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-modal">
    <!--    Add vendor modal-->
    <div id="new-vendor-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg m-auto">
            <!-- Modal content-->
            <form action="/accounting/vendors/add" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
            <div class="modal-content max-width">
                <div class="modal-header" style="border-bottom: 0">
                    <div class="modal-title">Vendor Information</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col-sm-2">
                                                        <div class="form-ib">
                                                            <label for="title">Title</label>
                                                            <input type="text" name="title" id="title" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="f_name">First name</label>
                                                            <input type="text" name="f_name" id="f_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="m_name">Middle name</label>
                                                            <input type="text" name="m_name" id="m_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="l_name">Last name</label>
                                                            <input type="text" name="l_name" id="l_name" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-ib">
                                                            <label for="suffix">Suffix</label>
                                                            <input type="text" name="suffix" id="suffix" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="company">Company</label>
                                                            <input type="text" name="company" id="company" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="display_name"><span class="text-danger">*</span> Display name as</label>
                                                            <input type="text" name="display_name" id="display_name" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="print_on_check_name" style="margin-right: 10px">Print on check as </label>
                                                            <input type="checkbox" value="1" name="use_display_name" id="use_display_name" checked><label for="use_display_name" class="ml-3">Use display name</label>
                                                            <input type="text" name="print_on_check_name" id="print_on_check_name" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col-12">
                                                        <div class="form-ib">
                                                            <label for="street" style="margin-right: 10px">Address</label>
                                                            <a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                                            <textarea name="street" id="street" cols="30" rows="2" class="form-control" placeholder="Street" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-ib mt-1">
                                                            <input name="city" type="text" class="form-control" placeholder="City/Town" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-ib mt-1">
                                                            <input name="state" type="text" class="form-control" placeholder="State/Province" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-ib mt-1">
                                                            <input name="zip" type="text" class="form-control" placeholder="ZIP Code" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-ib mt-1">
                                                            <input name="country" type="text" class="form-control" placeholder="Country" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="notes">Notes</label>
                                                            <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                            <span>Maximum size: 20MB</span>
                                                            <div id="vendorAttachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                                <div class="dz-message" style="margin: 20px;border">
                                                                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                    <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <h4>Get custom fields with Advanced</h4>
                                                <p>Custom fields let you add more detailed info about your customers and transactions.
                                                    Sort, track, and report info that's important to you.
                                                </p>
                                                <a href="#" style="color: #0b97c4;">Learn more</a>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control" name="email" id="email" placeholder="Separate multiple emails with commas">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" name="phone" id="phone" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="mobile">Mobile</label>
                                                            <input type="text" name="mobile" id="mobile" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="fax">Fax</label>
                                                            <input type="text" name="fax" id="fax" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="website">Website</label>
                                                            <input type="text" name="website" id="website" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="billing_rate">Billing rate (/hr)</label>
                                                            <input type="text" name="billing_rate" id="billing_rate" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="terms">Terms</label>
                                                            <select class="form-control" name="terms" id="terms">
                                                                <option value="" selected disabled>&nbsp;</option>
                                                                <option value="add-new">&plus; Add new</option>
                                                                <?php if(count($terms) > 0) : ?>
                                                                <?php foreach($terms as $term) : ?>
                                                                    <option value="<?=$term->id?>"><?=$term->name?></option>
                                                                <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="opening_balance">Opening balance</label>
                                                            <input type="text" name="opening_balance" id="opening_balance" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="opening_balance_as_of_date">as of</label>
                                                            <input type="text" name="opening_balance_as_of_date" id="opening_balance_as_of_date" class="form-control datepicker" value="<?=date("m/d/Y")?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="account_number">Account no.</label>
                                                            <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Appears in the memo of all payment" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="">Business ID No. / Social Security No.</label>
                                                            <input type="text" name="tax_id" id="tax_id" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="expense_account">Default expense account</label>
                                                            <select name="default_expense_account" id="expense_account" class="form-control">
                                                                <option value="" selected disabled>Choose Account</option>
                                                                <?php if(count($expenseAccs) > 0) : ?>
                                                                    <optgroup label="Expenses">
                                                                    <?php foreach($expenseAccs as $expenseAcc) : ?>
                                                                        <option value="<?=$expenseAcc->id?>"><?=$expenseAcc->name?></option>

                                                                        <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($expenseAcc->id); ?>
                                                                        <?php if(count($childAccs) > 0) : ?>
                                                                            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$expenseAcc->name?>">
                                                                            <?php foreach($childAccs as $childAcc) : ?>
                                                                                <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                            <?php endforeach; ?>
                                                                            </optgroup>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                    </optgroup>
                                                                <?php endif; ?>
                                                                <?php if(count($otherExpenseAccs) > 0) : ?>
                                                                    <optgroup label="Other Expenses">
                                                                    <?php foreach($otherExpenseAccs as $otherExpenseAcc) : ?>
                                                                        <option value="<?=$otherExpenseAcc->id?>"><?=$otherExpenseAcc->name?></option>

                                                                        <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($otherExpenseAcc->id); ?>
                                                                        <?php if(count($childAccs) > 0) : ?>
                                                                            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$otherExpenseAcc->name?>">
                                                                            <?php foreach($childAccs as $childAcc) : ?>
                                                                                <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                            <?php endforeach; ?>
                                                                            </optgroup>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                    </optgroup>
                                                                <?php endif; ?>
                                                                <?php if(count($cogsAccs) > 0) : ?>
                                                                    <optgroup label="Cost of Goods Sold">
                                                                    <?php foreach($cogsAccs as $cogsAcc) : ?>
                                                                        <option value="<?=$cogsAcc->id?>">&nbsp;<?=$cogsAcc->name?></option>

                                                                        <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($cogsAcc->id); ?>
                                                                        <?php if(count($childAccs) > 0) : ?>
                                                                            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$cogsAcc->name?>">
                                                                            <?php foreach($childAccs as $childAcc) : ?>
                                                                                <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                            <?php endforeach; ?>
                                                                            </optgroup>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                    </optgroup>
                                                                <?php endif; ?>
                                                            </select>
                                                            <!-- <input type="text" name="default_expense_amount" id="expense_account" class="form-control" placeholder="Choose Account" required> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-6"><button type="button" class="btn btn-transparent" data-dismiss="modal">Cancel</button></div>
                        <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!--    end of modal-->

    <!-- Add payment term modal -->
    <div class="modal fade" id="payment_term_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Term</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form id="payment-term-form">
                <div class="modal-body" style="max-height: 400px;">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px; padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="type" id="type1" value="1" checked>
                                                <label class="form-check-label" for="type1">
                                                    Due in fixed number of days
                                                </label>
                                            </div>
                                            <div class="form-group row m-0">
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="net_due_days" name="net_due_days">
                                                </div>
                                                <div class="col-sm-9 d-flex align-items-center pl-0">
                                                    <label for="net_due_days">days</label>
                                                </div>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="type" id="type2" value="2">
                                                <label class="form-check-label" for="type2">
                                                    Due by certain day of the month
                                                </label>
                                            </div>
                                            <div class="form-group row m-0">
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="day_of_month_due" name="day_of_month_due" disabled>
                                                </div>
                                                <div class="col-sm-9 d-flex align-items-center pl-0">
                                                    <label for="day_of_month_due">day of month</label>
                                                </div>
                                            </div>
                                            <div class="form-group row m-0">
                                                <div class="col-sm-12">
                                                    <p>Due the next month if issued within</p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="minimum_days_to_pay" name="minimum_days_to_pay" disabled>
                                                </div>
                                                <div class="col-sm-9 d-flex align-items-center pl-0">
                                                    <label for="minimum_days_to_pay">days of due date</label>
                                                </div>
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
                        <button type="submit" class="btn btn-success btn-rounded border float-right">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end add payment term modal -->
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>