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
    #transactions-table .btn-group .btn:hover, #transactions-table .btn-group .btn:focus {
        color: unset;
    }
    #transactions-table .btn-group .btn {
        padding: 10px;
    }
    #transactions-table .view-attachment:hover {
        background-color: #365ebf;
        color: #fff;
    }
    #myTabContent .tab-pane {
        padding: 15px;
    }
    #myTabContent #details .card:hover {
        border-color: #498002 !important;
    }
    #myTabContent #details .card h5.edit-icon {
        display: none;
        color: #498002;
        margin: 0;
    }
    #myTabContent #details .card:hover h5.edit-icon {
        display: block;
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
    .notes-container {
        border-radius: 5px;
        border: 1px solid transparent;
    }
    .notes-container:hover {
        border-color: #dee2e6;
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
                                    <h3 class="page-title" style="margin: 0 !important">
                                        <span id="vendor-display-name"><?=$vendorDetails->display_name?></span>
                                        <?php if($vendorDetails->email !== "" && $vendorDetails->email !== null) : ?>
                                            <small><a href="mailto: <?=$vendorDetails->email?>"><i class="fa fa-envelope-o"></i></a></small>
                                        <?php endif; ?>
                                    </h3>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">See how easy paying and tracking contractors can be. This accounting features makes it easy to pay contractors today & W-2 employees tomorrow.  Get started by adding a Contractor.</span>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/vendors" class="text-info"><i class="fa fa-chevron-left"></i> Vendors</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <button class="btn btn-transparent px-4 mr-2 edit-vendor">Edit</button>
                                            <div class="btn-group float-right">
                                                <button type="button" class="btn btn-success dropdown-toggle hide-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    New transaction &nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" id="new-time-activity">Time activity</a>
                                                    <a class="dropdown-item" href="#" id="new-bill-transaction">Bill</a>
                                                    <a class="dropdown-item" href="#" id="new-expense-transaction">Expense</a>
                                                    <a class="dropdown-item" href="#" id="new-check-transaction">Check</a>
                                                    <a class="dropdown-item" href="#" id="new-purchase-order-transaction">Purchase order</a>
                                                    <a class="dropdown-item" href="#" id="new-vendor-credit-transaction">Vendor credit</a>
                                                    <a class="dropdown-item" href="#" id="new-credit-card-pmt">Pay down credit card</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 my-5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row h-100">
                                                <div class="col-md-6">
                                                    <p><?=$vendorDetailsAddress?></p>
                                                    <div class="cursor-pointer h-75 p-3 notes-container">
                                                        <?=$vendorDetails->notes !== null && $vendorDetails->notes !== "" ? $vendorDetails->notes : "No notes available. Please click to add note"?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="total-pays float-right">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="open-pay-color" style="border-color: #f2b835; background: #f2b835; width: 5px; height: 45px;"></div>
                                                    <div class="open-pay ml-2">
                                                        <h4 class="m-0">$<span id="total-open-pay"><?=number_format($openBalance, 2, '.', ',')?></span></h4>
                                                        <p class="m-0">OPEN</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="overdue-color" style="border-color: #ce5133; background: #ce5133; width: 5px; height: 45px;"></div>
                                                    <div class="overdue-pay ml-2">
                                                        <h4 class="m-0">$<span id="total-overdue-pay"><?=number_format($overdueBalance, 2, '.', ',')?></span></h4>
                                                        <p class="m-0">OVERDUE</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
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
                                </div>
                                <div class="col-md-12 banking-tab-container">
                                    <a href="#transaction-list" role="tab" aria-controls="transaction-list" aria-selected="true" data-toggle="tab" class="banking-tab">Transaction List</a>
                                    <a href="#vendor-details" role="tab" aria-controls="vendor-details" aria-selected="false" data-toggle="tab" class="banking-tab-active text-decoration-none">Vendor Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="transaction-list" role="tabpanel" aria-labelledby="transaction-list-tab">
                                <input type="hidden" name="vendor_id" id="vendor-id" value="<?=$vendorDetails->id?>">
                                <div class="card p-0">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-3 d-flex align-items-end justify-content-center pr-0">
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
                                                    <div class="col pl-0">
                                                        <div class="dropdown d-inline-block">
                                                            <button class="dropdown-toggle btn btn-transparent hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter&nbsp;&nbsp;<i class="fa fa-caret-down"></i></button>

                                                            <div class="dropdown-menu p-3" aria-labelledby="filterDropdown">
                                                                <div class="inner-filter-list">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="type">Type</label>
                                                                                <select name="template_type" id="template-type" class="form-control">
                                                                                    <option value="all">All transactions</option>
                                                                                    <option value="expenses">Expenses</option>
                                                                                    <option value="all-bills">All bills</option>
                                                                                    <option value="open-bills">Open bills</option>
                                                                                    <option value="overdue-bills">Overdue bills</option>
                                                                                    <option value="bill-payments">Bill payments</option>
                                                                                    <option value="checks">Checks</option>
                                                                                    <option value="purchase-orders">Purchase orders</option>
                                                                                    <option value="recently-paid">Recently paid</option>
                                                                                    <option value="vendor-credits">Vendor credits</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="date">Date</label>
                                                                                <select name="date" id="date" class="form-control">
                                                                                    <option value="all-dates">All dates</option>
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
                                                                                    <option value="last-365-days">Last 365 days</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="btn-group">
                                                                        <!-- <a href="#" class="btn-main" onclick="resetbtn()">Reset</a> -->
                                                                        <a href="#" id="" class="btn-main apply-btn btn btn-success" onclick="applybtn()">Apply</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="action-bar h-100 d-flex align-items-center">
                                                    <ul class="ml-auto">
                                                        <li><a href="#" id="print-transactions"><i class="fa fa-print"></i></a></li>
                                                        <li>
                                                            <form action="/accounting/vendors/<?=$vendorDetails->id?>/export" method="post" id="export-transactions-form">
                                                                <a href="#" id="export-vendor-transactions"><i class="fa fa-download"></i></a>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-cog"></i>
                                                            </a>
                                                            <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                                <p class="m-0">Columns</p>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="method_chk" onchange="showCol(this)">
                                                                    <label for="method_chk">Method</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="source_chk" onchange="showCol(this)">
                                                                    <label for="source_chk">Source</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="due_date_chk" onchange="showCol(this)">
                                                                    <label for="due_date_chk">Due date</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="balance_chk" onchange="showCol(this)">
                                                                    <label for="balance_chk">Balance</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="status_chk" onchange="showCol(this)">
                                                                    <label for="status_chk">Status</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="attachments_chk" onchange="showCol(this)">
                                                                    <label for="attachments_chk">Attachments</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="type_chk" onchange="showCol(this)" checked>
                                                                    <label for="type_chk">Type</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="number_chk" onchange="showCol(this)" checked>
                                                                    <label for="number_chk">No.</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="payee_chk" onchange="showCol(this)" checked>
                                                                    <label for="payee_chk">Payee</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="category_chk" onchange="showCol(this)" checked>
                                                                    <label for="category_chk">Category</label>
                                                                </div>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="memo_chk" onchange="showCol(this)" checked>
                                                                    <label for="memo_chk">Memo</label>
                                                                </div>
                                                                <p class="m-0">Rows</p>
                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                    <input type="checkbox" id="compact_chk">
                                                                    <label for="compact_chk">Compact</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 pt-2">
                                                <table id="transactions-table" class="table table-bordered table-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th width="3%">
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="checkbox checkbox-sec m-0">
                                                                        <input type="checkbox" id="select-all-transactions">
                                                                        <label for="select-all-transactions" class="p-0" style="width: 24px; height: 24px"></label>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th>Date</th>
                                                            <th class="type">Type</th>
                                                            <th class="number">No.</th>
                                                            <th class="payee">Payee</th>
                                                            <th class="method hide">Method</th>
                                                            <th class="source hide">Source</th>
                                                            <th class="category">Category</th>
                                                            <th class="memo">Memo</th>
                                                            <th class="due_date hide">Due date</th>
                                                            <th class="balance hide">Balance</th>
                                                            <th>Total</th>
                                                            <th class="status hide">Status</th>
                                                            <th width="3%" class="attachments hide"><i class="fa fa-paperclip"></i></th>
                                                            <th width="5%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="cursor-pointer"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="vendor-details" role="tabpanel" aria-labelledby="vendor-details-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-transparent px-4 float-right edit-vendor">Edit</button>
                                    </div>
                                    <div class="col-sm-11">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Vendor</td>
                                                            <td><?=$vendorDetails->display_name?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><?=$vendorDetails->email?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone</td>
                                                            <td><?=$vendorDetails->phone?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mobile</td>
                                                            <td><?=$vendorDetails->mobile?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fax</td>
                                                            <td><?=$vendorDetails->fax?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Website</td>
                                                            <td><?=$vendorDetails->website?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0"></td>
                                                            <td class="p-0"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="attachments-container w-50">
                                                    <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                    <span>Maximum size: 20MB</span>
                                                    <div id="previewVendorAttachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                        <div class="dz-message" style="margin: 20px;border">
                                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                            <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="#" id="show-existing-attachments" class="text-info">Show existing</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Billing address</td>
                                                            <td>
                                                                <p class="m-0"><?=$vendorDetails->street?></p>
                                                                <p class="m-0"><?=$vendorDetails->city?>,<?=$vendorDetails->state?></p>
                                                                <p class="m-0"><?=$vendorDetails->zip?></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Terms</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Company</td>
                                                            <td><?=$vendorDetails->company?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Notes</td>
                                                            <td>
                                                                <div class="notes-container w-50">
                                                                    <textarea name="notes" class="form-control cursor-pointer" disabled><?=$vendorDetails->notes === '' || $vendorDetails->notes === null ? 'No notes available. Please click to add notes.' : $vendorDetails->notes?></textarea>                              
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0"></td>
                                                            <td class="p-0"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <!-- Select category modal -->
    <div class="modal fade" id="select_category_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Categorize Selected</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form id="categorize-selected-form">
                <div class="modal-body" style="max-height: 400px;">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px; padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" style="margin-bottom: 0 !important">
                                                <select name="category_id" id="category-id" class="form-control" required>
                                                    <option value="" selected disabled>Select category</option>
                                                    <?php foreach($categoryAccs as $accType => $accounts) : ?>
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
                        <button type="submit" class="btn btn-success btn-rounded border float-right">Apply</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end select category modal -->
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>