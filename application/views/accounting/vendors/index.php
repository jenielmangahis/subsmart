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
    #vendors-table tbody td:nth-child(2) a:hover {
        text-decoration: underline;
        color: #38a4f8 !important;
    }
    #vendors-table .btn-group .btn:hover, #vendors-table .btn-group .btn:focus {
        color: unset;
    }
    #vendors-table .btn-group .btn {
        padding: 10px;
    }
    #vendors-table tbody tr td:first-child {
        padding-left: 18px;
        padding-right: 18px;
    }
    #vendors-table thead tr th:first-child {
        width: 1;
    }
    #vendors-table .view-attachment:hover {
        background-color: #365ebf;
        color: #fff;
    }
    .open-purchase-orders-cont, .open-bills-cont, .payments-cont {
        color: #fff;
        cursor: pointer;
    }
    .open-purchase-orders-cont p, .open-bills-cont p, .payments-cont p {
        margin-bottom: 10px;
    }
    .open-purchase-orders-cont .row .col-12 {
        background-color: #0077C5;
    }
    .open-bills-cont .row .col-6:first-child {
        background-color: #FF8000;
    }
    .open-bills-cont .row .col-6:nth-child(2) {
        background-color: #BABEC5;
    }
    .payments-cont .row .col-12 {
        background-color: #7FD000;
    }
    .open-purchase-orders-cont, .open-bills-cont,
    .payments-cont
    {
        max-height: 80px;
        height: 80px;
    }
    .open-purchase-orders-cont.hovered .row .col-12,
    .overdue-bills.hovered,
    .open-bills.hovered,
    .payments-cont.hovered .row .col-12,
    .open-purchase-orders-cont.selected .row .col-12,
    .overdue-bills.selected,
    .overdue-bills.co-selected,
    .open-bills.selected,
    .payments-cont.selected .row .col-12
    {
        border-bottom: 6px solid rgba(0,0,0,.35);
        transform: translateY(-7px);
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
                                    <h3 class="page-title" style="margin: 0 !important">Vendors</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Vendors are people or companies that you owe money to or subcontractors that work for you.  You can use the vendors tab to add and track them.  Here's how.  Select Expenses, then Vendors.  Select New Vendor.  Complete the fields in the Vendor Information window.  Select Save and close.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/expenses')?>" class="banking-tab" style="text-decoration: none">Expenses</a>
                                    <a href="<?php echo url('/accounting/vendors')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="vendors")?:'-active';?>">Vendors</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <!-- <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6> -->
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#new-vendor-modal" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    New vendor
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Import vendors</a>
                                                </div>
                                            </div>
                                            <div class="btn-group float-right mr-2">
                                                <a href="javascript:void(0);" class="btn btn-transparent d-flex align-items-center justify-content-center">
                                                    Prepare 1099s
                                                </a>
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
                                <div class="col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Unbilled Last 365 Days</p>
                                            <div class="open-purchase-orders-cont" id="purchase-orders">
                                                <div class="row mr-0">
                                                    <div class="col-12">
                                                        <h4><?=$purchaseOrders?></h4>
                                                        <p>PURCHASE ORDERS</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Unpaid Last 365 Days</p>
                                            <div class="open-bills-cont">
                                                <div class="row mr-0">
                                                    <div class="col-6 overdue-bills" id="overdue-bills">
                                                        <h4><?=$overdueBills?></h4>
                                                        <p>OVERDUE</p>
                                                    </div>
                                                    <div class="col-6 open-bills" id="open-bills">
                                                        <h4><?=$openBills?></h4>
                                                        <p>OPEN BILLS</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Paid</p>
                                            <div class="payments-cont" id="payments">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h4><?=$paidTransactions?></h4>
                                                        <p>PAID LAST 30 DAYS</p>
                                                    </div>
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
                                                        <a href="mailto:" class="dropdown-item" id="email-vendor">Email</a>
                                                        <a href="#" class="dropdown-item" id="make-inactive">Make inactive</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Find a vendor on company">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" id="print-vendors"><i class="fa fa-print"></i></a></li>
                                                <li>
                                                    <form action="/accounting/vendors/export-vendors" method="post" id="export-form">
                                                        <a href="#" id="export-vendors"><i class="fa fa-download"></i></a>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" id="address_chk">
                                                            <label for="address_chk">Address</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" id="attachments_chk">
                                                            <label for="attachments_chk">Attachments</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" id="phone_chk" checked>
                                                            <label for="phone_chk">Phone</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" id="email_chk" checked>
                                                            <label for="email_chk">Email</label>
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
                                <table id="vendors-table" class="table table-bordered table-hover" style="width:100%">
									<thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex justify-content-center">
													<div class="checkbox checkbox-sec m-0">
                                                        <input type="checkbox" id="select-all-vendors">
														<label for="select-all-vendors" class="p-0" style="width: 24px; height: 24px"></label>
													</div>
												</div>
                                            </th>
                                            <th>Vendor/Company</th>
                                            <th class="hide address">Address</th>
                                            <th class="phone">Phone</th>
                                            <th class="email">Email</th>
                                            <th class="text-center hide attachments"><i class="fa fa-paperclip"></i></th>
                                            <th>Open Balance</th>
                                            <th class="text-right">Action</th>
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