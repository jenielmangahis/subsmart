<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    .tooltip_ {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .tooltip_ .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        position: absolute;
        z-index: 1;
        bottom: 100%;
        left: 50%;
        margin-left: -60px;
    }

    .tooltip_:hover .tooltiptext {
        visibility: visible;
    }

    .filtering {
        display: inline-block;
    }

    .StepProgress {
        position: relative;
        padding-left: 45px;
        list-style: none;
    }

    .StepProgress::before {
        display: inline-block;
        content: '';
        position: absolute;
        top: 0;
        left: 15px;
        width: 10px;
        height: 100%;
        border-left: 2px solid #CCC;
    }

    .StepProgress-item {
        position: relative;
        counter-increment: list;
    }

    .StepProgress-item:not(:last-child) {
        padding-bottom: 20px;
    }

    .StepProgress-item::before {
        display: inline-block;
        content: '';
        position: absolute;
        left: -30px;
        height: 100%;
        width: 10px;
    }

    .StepProgress-item::after {
        content: '';
        display: inline-block;
        position: absolute;
        top: 0;
        left: -37px;
        width: 12px;
        height: 12px;
        border: 2px solid #CCC;
        border-radius: 50%;
        background-color: #FFF;
    }

    .StepProgress-item.is-done::before {
        border-left: 2px solid green;
    }

    .StepProgress-item.is-done::after {
        content: "";
        font-size: 10px;
        color: #FFF;
        text-align: center;
        border: 2px solid green;
        background-color: green;
    }

    .StepProgress-item.current::before {
        border-left: 2px solid green;
    }

    .StepProgress-item.current::after {
        content: counter(list);
        padding-top: 1px;
        width: 19px;
        height: 18px;
        top: -4px;
        left: -40px;
        font-size: 14px;
        text-align: center;
        color: green;
        border: 2px solid green;
        background-color: white;
    }

    .StepProgress strong {
        display: block;
    }

    /* section{
	padding: 60px 0;
} */

    #accordion-style-1 h1,
    #accordion-style-1 a {
        color: #007b5e;
    }

    #accordion-style-1 .btn-link {
        font-weight: 400;
        color: #007b5e;
        background-color: transparent;
        text-decoration: none !important;
        font-size: 16px;
        font-weight: bold;
        padding-left: 25px;
    }

    #accordion-style-1 .card-body {
        border-top: 2px solid #007b5e;
    }

    #accordion-style-1 .card-header .btn.collapsed .fa.main {
        display: none;
    }

    #accordion-style-1 .card-header .btn .fa.main {
        background: #007b5e;
        padding: 13px 11px;
        color: #ffffff;
        width: 35px;
        height: 41px;
        position: absolute;
        left: -1px;
        top: 10px;
        border-top-right-radius: 7px;
        border-bottom-right-radius: 7px;
        display: block;
    }

    .card {
        padding: 0px !important;
        color: black;
        margin-bottom: 0px !important;
    }

    .card:hover {
        padding: 0px !important;
        color: blue;
    }

    .btn:hover,
    .btn:focus,
    .btn.focus {
        color: #000;
        text-decoration: none;
        border: 1px solid transparent;
        box-shadow: none;
    }
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box mx-4">
                <div class="col-lg-6 px-0">
                    <h3>Invoice</h3>
                </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                    When an invoice is created in our CRM, a statement summary of your customer's account listing recent
                    invoices will display here for you to view. The statement shows per invoice not per items.
                </div>
                <br>
                <div class="row pb-2">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/sales-overview')?>"
                            class="banking-tab">Overview</a>
                        <a href="<?php echo url('/accounting/all-sales')?>"
                            class="banking-tab">All Sales</a>
                        <a href="<?php echo url('/accounting/newEstimateList')?>"
                            class="banking-tab">Estimates</a>
                        <a href="<?php echo url('/accounting/customers')?>"
                            class="banking-tab">Customers</a>
                        <a href="<?php echo url('/accounting/deposits')?>"
                            class="banking-tab">Deposits</a>
                        <a href="<?php echo url('/accounting/listworkOrder')?>"
                            class="banking-tab">Work Order</a>
                        <a href="<?php echo url('/accounting/invoices')?>"
                            class="banking-tab-active text-decoration-none">Invoices</a>
                        <a href="<?php echo url('/accounting/jobs ')?>"
                            class="banking-tab">Jobs</a>
                        <a href="<?php echo url('/accounting/products-and-services')?>"
                            class="banking-tab">Products and Services</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6 px-0">
                        <div class="row px-4">
                            <div class="col-sm-12">
                                <h6 class="font-weight-normal"><strong>$4 Unpaid</strong><span class="pl-3">Last 365
                                        days</span></h6>
                            </div>
                            <div class="col-sm-12 mt-0">
                                <div class="pull-left">
                                    <h3 class="mb-0"><strong>$4.00</strong></h3>
                                    <h6 class="font-weight-normal text-dark mt-1">Overdue</h6>
                                </div>
                                <div class="pull-right">
                                    <h3 class="mb-0"><strong>$4.00</strong></h3>
                                    <h6 class="font-weight-normal text-dark mt-1">Not due yet</h6>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-1">
                                <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-secondary w-50"
                                        style="background-color:#ff8000 !important;"></div>
                                    <div class="progress-bar bg-dark  w-50"
                                        style="background-color:#d4d7dc !important;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 px-0">
                        <div class="row px-4">
                            <div class="col-sm-12">
                                <h6 class="font-weight-normal"><strong>$0 Paid</strong><span class="pl-3">Last 30
                                        days</span></h6>
                            </div>
                            <div class="col-sm-12 mt-0">
                                <div class="pull-left">
                                    <h3 class="mb-0"><strong>$12</strong></h3>
                                    <h6 class="font-weight-normal text-secondary mt-1">Not deposited</h6>
                                </div>
                                <div class="pull-right">
                                    <h3 class="mb-0"><strong>$12</strong></h3>
                                    <h6 class="font-weight-normal text-secondary mt-1">Deposited</h6>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-1">
                                <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-success w-50"
                                        style="background-color:#2ca01c !important;"></div>
                                    <div class="progress-bar bg-info  w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="invoices-page-section">
                        <!-- <div class="filtering" style="padding: 0 20px 0 0;">
                            <select class="form-control" style="width:180px; border-radius:60px;">
                                <option>Batch Actions</option>
                            </select>
                        </div> -->
                        <div class="filtering" style="padding: 0 20px 0 0;">
                            <div class="by-batch-btn">
                                <button class="btn btn-default disabled" type="button" data-toggle="dropdown">
                                    Batch action <span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right by-batch-btn" role="menu">
                                    <li class="print-transaction-btn disabled">
                                        <a href="#">Send</a>
                                    </li>
                                    <li class="send-reminder-btn disabled">
                                        <a href="#">Send reminder</a>
                                    </li>
                                    <li class="print-btn disabled">
                                        <a href="#">Print</a>
                                    </li>
                                    <li class="delete-btn disabled">
                                        <a href="#">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filtering" style="padding: 0 10px 0 0;">
                            Status <br>
                            <select class="form-control status" style="width:180px;">
                                <option>All</option>
                                <option>Draft</option>
                                <option>Partially Paid</option>
                                <option>Paid</option>
                                <option>Due</option>
                                <option>Overdue</option>
                                <option>Submitted</option>
                                <option>Approved</option>
                                <option>Declined</option>
                                <option>Schedule</option>
                            </select>
                        </div>
                        <div class="filtering">
                            Date <br>
                            <select class="form-control date_range" style="width:180px;">
                                <option>This month</option>
                                <option>Last month</option>
                                <option>Last 3 month</option>
                                <option>Last 6 month</option>
                                <option>Last 12 month</option>
                                <option>Year to date</option>
                                <option><?=date("Y")-1?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 px-0">
                        <div class="bg-white p-4">
                            <div class="row" style="margin-top:-60px;float:right;">
                                <div class="col-md-12" style="text-align:right;padding-bottom:10px;">
                                    <a class="btn btn-primary"
                                        href="<?php echo base_url('accounting/addnewInvoice') ?>"><span
                                            class="fa fa-plus fa-margin-right"></span> Create Invoice</a>
                                </div>
                            </div>

                            <div class="row margin-bottom-ter align-items-center">
                                <!-- <div class="col-auto">
                                    <p>
                                        Listing all invoices.
                                    </p>
                                </div> -->
                                <!-- <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                        name="form-search"
                                        action="<?php echo base_url('invoice') ?>"
                                method="get">
                                <div class="form-group" style="margin:0 !important;">
                                    <span>Search:</span> &nbsp;
                                    <input style="height:auto !important; font-size: 14px; margin-right:10px;"
                                        class="form-control form-control-md" name="search"
                                        value="<?php echo (!empty($search)) ? $search : '' ?>"
                                        type="text" placeholder="Search...">
                                    <button class="btn btn-default btn-md" type="submit"><span
                                            class="fa fa-search"></span></button>
                                    <?php if (!empty($search)) { ?>
                                    <a class="btn btn-default btn-md ml-2"
                                        href="<?php echo base_url('invoice') ?>"><span
                                            class="fa fa-times"></span></a>
                                    <?php } ?>
                                </div>
                                </form>
                                <div class="dropdown dropdown-inline margin-right-sec ml-2"><a
                                        class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="true"
                                        href="<?php echo base_url('customer') ?>">Source
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu  btn-block" role="menu">
                                        <li class="active" role="presentation"><a role="menuitem" tabindex="-1"
                                                href="<?php echo base_url('customer') ?>">Source</a>
                                        </li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="<?php echo base_url('customer?type=residential') ?>">Facebook</a>
                                        </li>
                                    </ul>
                                </div>
                                <span>Sort:</span> &nbsp;
                                <div class="dropdown dropdown-inline">
                                    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"
                                        href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=created_at-asc') : base_url('invoice?order=created_at-asc') ?>">
                                        Newest First
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu  btn-block" role="menu">
                                        <li class="active" role="presentation">
                                            <a role="menuitem" tabindex="-1"
                                                href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=created_at-desc') : base_url('invoice?order=created_at-desc') ?>">
                                                Newest First</a>
                                        </li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=created_at-asc') : base_url('invoice?order=created_at-asc') ?>">
                                                Oldest First</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=last-invoice_number-asc') : base_url('invoice?order=last-invoice_number-asc') ?>">Number:
                                                Asc</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=last-invoice_number-desc') : base_url('invoice?order=last-invoice_number-desc') ?>">Number:
                                                Desc</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=amount-asc') : base_url('invoice?order=amount-desc') ?>">Amount:
                                                Lowest</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=amount-desc') : base_url('invoice?order=amount-asc') ?>">Amount:
                                                Highest</a></li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <!-- <div class="card-body" style="padding-bottom:0px;">
                            <div class="row align-items-center">
                                <div class="col-md-12 summary">
                                    <div class="summary-item">
                                        <div class="summary-item-label">THIS YEAR</div>
                                        <div class="summary-item-value" id="total_this_year">$<?php echo get_invoice_amount('year') ?>
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-item-label">PENDING</div>
                <div class="summary-item-value" id="pending_total">$<?php echo get_invoice_amount('pending') ?>
                </div>
            </div>
            <div class="summary-item">
                <div class="summary-item-label">PAID</div>
                <div class="summary-item-value" id="paid_total">$<?php echo get_invoice_amount('paid') ?>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="tabs">
    <ul class="clearfix work__order mobile-invoice-ul" id="myTab" role="tablist">
        <li <?php echo ((empty($tab)) || $tab == 1) ? "class='active'" : "" ?>>
            <a class="nav-link" id="profile-tab" data-toggle="tab1"
                href="<?php echo base_url('invoice') ?>"
                role="tab" aria-controls="profile" aria-selected="false">All
                (<?php echo get_invoice_count(1) ?>)</a>
        </li>
        <li <?php echo ((!empty($tab)) && $tab == 2) ? "class='active'" : "" ?>>
            <a class="nav-link" id="profile-tab" data-toggle="tab2"
                href="<?php echo base_url('invoice/tab/2') ?>"
                role="tab" aria-controls="profile" aria-selected="false">Due
                (<?php echo get_invoice_count(2) ?>)</a>
        </li>
        <li <?php echo ((!empty($tab)) && $tab == 3) ? "class='active'" : "" ?>>
            <a class="nav-link" id="profile-tab" data-toggle="tab3"
                href="<?php echo base_url('invoice/tab/3') ?>"
                role="tab" aria-controls="profile" aria-selected="false">Overdue
                (<?php echo get_invoice_count(3) ?>)</a>
        </li>
        <li <?php echo ((!empty($tab)) && $tab == 4) ? "class='active'" : "" ?>>
            <a class="nav-link" id="profile-tab" data-toggle="tab1"
                href="<?php echo base_url('invoice/tab/4') ?>"
                role="tab" aria-controls="profile" aria-selected="false">Partially Paid
                (<?php echo get_invoice_count(4) ?>)</a>
        </li>
        <li <?php echo ((!empty($tab)) && $tab == 5) ? "class='active'" : "" ?>>
            <a class="nav-link" id="profile-tab" data-toggle="tab1"
                href="<?php echo base_url('invoice/tab/5') ?>"
                role="tab" aria-controls="profile" aria-selected="false">Paid
                (<?php echo get_invoice_count(5) ?>)</a>
        </li>
        <li <?php echo ((!empty($tab)) && $tab == 6) ? "class='active'" : "" ?>>
            <a class="nav-link" id="profile-tab" data-toggle="tab1"
                href="<?php echo base_url('invoice/tab/6') ?>"
                role="tab" aria-controls="profile" aria-selected="false">Draft
                (<?php echo get_invoice_count(6) ?>)</a>
        </li>
    </ul>
</div>

<div class="tab-content invoices-page-section invoices-page-section" id="myTabContent">
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

        <?php if (!empty($invoices)) { ?>
        <form action="#" class="invoice-table-form">
            <table class="table table-hover table-to-list invoices-table" data-id="work_orders">
                <thead>
                    <tr>
                        <th>
                            <!-- <div class="checkbox checkbox-sm select-all-checkbox">
                            <div class="table-name">
                                <div class="checkbox checkbox-sm select-all-checkbox"> -->
                            <!-- <input type="checkbox" name="id_selector" value="0" id="select-all" class="select-all"> -->
                            <!-- <label for="select-all">Invoice#</label>
                                </div>

                            </div> -->
                            <div class="form-check">
                                <div class="checkbox checkbox-sec ">
                                    <input type="checkbox" name="id_selector" id="select-all" class="select-all">
                                    <label for="select-all"><span></span></label>
                                </div>
                            </div>
                        </th>
                        <th></th>
                        <th>Date</th>
                        <th>Invoice No.</th>
                        <!-- <th>Date Due</th> -->
                        <th style="width:30%;">Job & Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </form>
        <div class="modal in" id="convertToWorkOrder" tabindex="-1" role="dialog">
            <div class="modal-dialog" style="max-width:600px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Convert Invoice To Work Order</h4>
                    </div>
                    <div class="modal-body">
                        <div class="validation-error" style="display: none;"></div>
                        <form name="convert-to-work-order-modal-form">
                            <p>
                                You are going create a new work order based on <b>Invoice# <span id='workOrderInvoiceId'"></span></b>.<br>
                                                            The invoice items (e.g. materials, labour) will be copied to this work order.<br>
                                                            You can always edit/delete work order items as you need.
                                                        </p>
                                                    </form>
                                                </div>
                                                <div class=" modal-footer">
                                        <button class="btn btn-default" type="button"
                                            data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="button"
                                            data-convert-to-work-order-modal="submit">Convert To Work Order</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal in" id="cloneModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" style="max-width:600px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Clone Invoice</h4>
                    </div>
                    <div class="modal-body">
                        <div class="validation-error" style="display: none;"></div>
                        <form name="clone-modal-form">
                            <p>
                                You are going create a new invoice based on Invoice# <span
                                    id='cloneInvoiceId'></span>.<br>
                                The new invoice will contain the same items (e.g. materials, labour) and you
                                will be able to edit and remove the invoice items as you need.
                            </p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <a href="#" id="cloneInvoiceBtn">
                            <button class="btn btn-primary" type="button" data-clone-modal="submit">Clone
                                Invoice</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal in" id="cancelModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" style="max-width:600px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Delete Invoice</h4>
                    </div>
                    <div class="modal-body">
                        <div class="validation-error" style="display: none;"></div>
                        <form name="cancel-modal-form">
                            <p>
                                Are you sure you want to delete the <span class="bold">Invoice# <span
                                        id='deleteInvoiceId'></span></span>?
                            </p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <a href="#" id="deleteInvoiceBtn">
                            <button class="btn btn-primary" type="button" data-cancel-modal="submit">Yes, Delete
                                Invoice</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="page-empty-container">
            <h5 class="page-empty-header">There are no invoices</h5>
            <p class="text-ter margin-bottom">Manage your invoice.</p>

        </div>
        <?php } ?>
    </div>
    <!-- </div> -->
    <!-- </div> -->
</div>
</div>
</div>
<!-- end row -->
<div class="row ml-2"></div>
<!-- end row -->
</div>
</div>
<!-- end container-fluid -->
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>

<!--    Modal for creating rules-->
<div class="modal-right-side">
    <div class="modal right fade" id="type-selection-modal" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="width: 25%">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel2"><span id="inv_modal_invNo" style="align:center;"><span>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body p-0">
                    <div class="row" style="padding:5%;">
                        <div class="col-md-12">
                            <i class="fa fa-check-square" style="font-size:24px;color:#108000;"></i> Paid (Deposited)
                        </div>
                        <div class="col-md-12">
                            <br>
                            Total
                            <h2>$ <span id="billing_total"><span></h2>
                        </div>
                        <div class="col-md-12">
                            <h6>Invoice date</h6>
                            <span id="billing_in_date"><span>
                        </div>
                        <div class="col-md-12">
                            <h6>Due date</h6>
                            <span id="billing_due_date"><span>
                        </div>
                    </div>
                    <!-- <hr>
                                                <div class="row" style="padding:1% 5% 1% 5%;">
                                                    <div class="col-md-12">
                                                        <span style="font-size:18px;color:gray;">90 Works (Panama City)</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="wrapper">
                                                    <span style="font-size:18px;color:gray;">Invoice activity</span> 
                                                    <ul class="StepProgress">
                                                    <li class="StepProgress-item is-done"><strong>Opened</strong>4/8/2021</li>
                                                    <li class="StepProgress-item is-done"><strong>Sent</strong>4/9/2021</li> -->
                    <!-- <li class="StepProgress-item current"><strong>Paid</strong>4/19/2021 | Check <br>$2,211.98 <br> <a href="#">View payment #INV-000000002</a></li> -->
                    <!-- <li class="StepProgress-item is-done"><strong>Paid</strong>4/19/2021 | Check <br>$2,211.98 <br> <a href="#">View payment #INV-000000002</a></li>
                                                    <li class="StepProgress-item is-done"><strong>Deposited</strong></li>
                                                    </ul>
                                                </div>
                                                <hr>
                                                <div class="row" style="padding:1% 5% 1% 5%;">
                                                    <div class="col-md-12" align="center">
                                                        <input type="submit" value="More Actions" class="btn btn-primary">
                                                        <input type="submit" value="Edit Invoice" class="btn btn-success">
                                                    </div>
                                                </div>
                                                <hr> -->

                    <!-- <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="width: 100%;">
                                                        <span style="float:left;">Reminder 1 (3 day(s) before due date)</span> 
                                                        <b style="float:right;">On <i class="fa fa-sort-down"></i></b>
                                                        </button>
                                                    </h5>
                                                    </div>

                                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body">
                                                            Test A
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width: 100%;">
                                                        <span style="float:left;">Reminder 2 (On due date)</span> 
                                                        <b style="float:right;">On <i class="fa fa-sort-down"></i></b>
                                                        </button>
                                                    </h5>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                        <div class="card-body">
                                                            Test B
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%;">
                                                            <span style="float:left;">Reminder 3 (3 day(s) after due date)</span> 
                                                            <b style="float:right;">On <i class="fa fa-sort-down"></i></b>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                        <div class="card-body">
                                                            Test C
                                                        </div>
                                                    </div>
                                                </div>

											</div> -->
                    <section>
                        <div class="row">
                            <!-- <div class="col-12">
                                                        <h1 class="text-green mb-4 text-center"></h1>
                                                    </div> -->
                            <div class="col-md-12">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed btn-block text-left" type="button"
                                                    data-toggle="collapse" data-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    <span style="font-size:18px;color:gray;" id="billing_city"></span>
                                                    City <i class='fas fa-angle-right'
                                                        style='font-size:24px;color:gray;float:right;'></i>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse fade" aria-labelledby="headingTwo"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <b>Billing address</b> <br>
                                                <span id="billingName"></span> <br>
                                                <span id="billing_address"></span> <br>
                                                <!-- Panama City, FL  32405 <br> -->
                                                <br>
                                                <span id="billing_customer_email"></span><br>
                                                Phone: <span id="billing_customer_phone"></span> <br>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button"
                                                    data-toggle="collapse" data-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <span style="font-size:18px;color:gray;">Invoice activity</span> <i
                                                        class='fas fa-angle-right'
                                                        style='font-size:24px;color:gray;float:right;'></i>
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse show fade" aria-labelledby="headingOne"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="wrapper">
                                                    <ul class="StepProgress" style="margin-top:-100px;">
                                                        <li class="StepProgress-item is-done">
                                                            <strong>Opened</strong>4/8/2021
                                                        </li>
                                                        <li class="StepProgress-item is-done">
                                                            <strong>Sent</strong>4/9/2021
                                                        </li>
                                                        <li class="StepProgress-item is-done">
                                                            <strong>Viewed</strong>4/10/2021
                                                        </li>
                                                        <li class="StepProgress-item is-done">
                                                            <strong>Paid</strong>4/19/2021 | Check <br>$2,211.98 <br> <a
                                                                href="#">View payment #<span id="inv_modal_invNo2"
                                                                    style="align:center;"><span></a>
                                                        </li>
                                                        <li class="StepProgress-item is-done"><strong>Deposited</strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed btn-block text-left" type="button"
                                                    data-toggle="collapse" data-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    <span style="font-size:18px;color:gray;">Product and services</span>
                                                    <i class='fas fa-angle-right'
                                                        style='font-size:24px;color:gray;float:right;'></i>
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse fade" aria-labelledby="headingThree"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div id="billing_items"></div>
                                                <a href="#" style="color:blue;text-decoration: underline;"><u>More
                                                        details</u></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                </div>
            </div>
        </div>
    </div>
    <!--    end of modal-->
</div>

<div id="share-link-modal">
    <div class="the-modal-body">
        <div class="title">Share invoice link</div>
        <div class="the-content">
            <p> Enable your customers to pay, print and download this invoice</p>
            <div class="form-group">
                <div class="label">
                    Copy and share link through email or SMS
                </div>
                <input type="text" class="form-control " name="shared_invoice_link">
            </div>
        </div>
        <div class="btns">
            <button class="btn btn-default float-left cancel-btn" type="button">
                Cancel
            </button>
            <button class="btn btn-success float-right copy-btn" type="button">
                Copy link and close
            </button>
        </div>
    </div>
</div>

<!-- Modal for add account-->
<div class="full-screen-modal">
    <div id="addreceivepaymentModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Receive Payment
                    </div>
                    <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form
                    action="<?php echo site_url()?>accounting/addReceivePayment"
                    method="post">
                    <div class="modal-body" style="height:1000px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Customer
                                        <select class="form-control" name="customer_id">
                                            <option></option>
                                            <?php foreach ($customers as $customer) : ?>
                                            <option
                                                value="<?php echo $customer->prof_id; ?>">
                                                <?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <input type="button" class="form-control" value="Find by invoice no.">
                                        Don't have an invoice? Create a new sale
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        Payment date
                                        <input type="text" class="form-control" name="payment_date"
                                            id="rp_payment_date">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        Payment method<br>
                                        <select class="form-control" name="payment_method" id="rp_payment_method">
                                            <option></option>
                                            <option value="0">Add New</option>
                                            <?php foreach ($paymethods as $paymethod) { ?>
                                            <option
                                                value="<?php echo $paymethod->payment_method_id ; ?>">
                                                <?php echo $paymethod->quick_name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        Reference no.
                                        <input type="text" class="form-control" name="ref_number">
                                    </div>
                                    <div class="col-md-3">
                                        Deposit to
                                        <select class="form-control" name="deposit_to">
                                            <option></option>
                                            <option value="1">Cash on hand</option>
                                            <option value="2">Cash</option>
                                            <option value="3">Credit</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6" align="right">
                                AMOUNT RECEIVED<h2>$0.00</h2><br>
                                <p style="margin-top:100px;">Amount received</p><br>
                                <input type="text" class="form-control" style="width:200px;text-align:right;"
                                    name="amount" placeholder="0.00">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                Memo<br>
                                <textarea style="height:200px;width:100%;" name="memo"></textarea><br>
                                <div class="file-upload">
                                    <button class="file-upload-btn" type="button"
                                        onclick="$('.file-upload-input').trigger( 'click' )">Attachments</button>

                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type='file' onchange="readURL(this);"
                                            accept="image/*" name="attachments" />
                                        <div class="drag-text">
                                            <i>Drag and drop files here or click the icon</i>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                <span class="image-title">Uploaded File</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <hr>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                    type="button">Cancel</button>

                            </div>
                            <div class="col-md-5" align="center">
                                <div class="middle-links">
                                    <a href="">Print or Preview</a>
                                </div>
                                <div class="middle-links end">
                                    <a href="">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button class="btn btn-dark cancel-button px-4" type="submit">Save</button>
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved"
                                        style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown"
                                        style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved">Save and close</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg"
                            style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and
                        security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>
<div id="invoice-reminder-modal">
    <div class="the-modal-body">
        <h1 class="the-title">Send Invoice <span class="invoice-number"></span></h1>
        <div class="the-close">x</div>
        <div class="the-class-content">
            <form action="#" id="invoice-reminder">
                <input type="text" name="invoice_id" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from">From</label>
                            <select name="from" class="required" required></select>
                        </div>
                        <div class="form-group">
                            <label for="from">To <span class="cc-bcc">Cc/Bcc</span></label>
                            <input type="email" name="to" placeholder="Separate multiple emails with commas"
                                class="required" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="send_me_copy">
                            <label for="send_me_copy" data-user-email="">Send me a copy</label>
                        </div>
                        <div class="cc-bcc-section" style="display: none;">
                            <div class="form-group">
                                <label for="from">Cc</label>
                                <input type="email" name="cc" placeholder="Separate multiple emails with commas">
                            </div>
                            <div class="form-group">
                                <label for="from">Bcc</label>
                                <input type="email" name="bcc" placeholder="Separate multiple emails with commas">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="from">Subject</label>
                            <input type="text" name="subject" value="Reminder: Your payment to ADI is due"
                                class="required" required>
                        </div>
                        <div class="attachment">
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Invoice PDF
                        </div>

                        <div class="form-group">
                            <label for="email-body">Email body</label>
                            <textarea name="email-body" cols="30" rows="10" class="required" required>Dear Betty Fuller,

We're sending a reminder to let you know that invoice [Invoice No.] has not been paid. If you already paid this invoice or have any questions, let us know!

Have a great day!
ADI
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pdf-frame">
                            <iframe
                                src="<?=base_url('assets/pdf/INV-000000011_portalappinv.pdf#toolbar=0')?>"
                                class="the-file" frameborder="0"></iframe>
                        </div>


                    </div>
                </div>
                <div class="the-modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="the-close">Cancel</button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success float-right the-submit">Send</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="batch-print-iframe-section">
<iframe src=""class="the-file" frameborder="0"></iframe>
</div>
<script
    src="<?php echo $url->assets ?>js/accounting/sales/customer_includes/customer_single_modal.js">
</script>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<?php include viewPath('includes/footer_accounting'); ?>

<script>
    // $(document).on('click','#delete_workorder',function(){
    //     // alert('test');

    // });

    // function myFunction() {
    // $('#delete_workorder').on('click', function(){
    $(document).on('click touchstart', '#deleteInvoiceBtnNew', function() {

        var id = $(this).attr('data-id');
        // alert(id);

        var r = confirm("Are you sure you want to delete this Invoice?");

        if (r == true) {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>invoice/deleteInvoiceBtnNew",
                data: {
                    id: id
                },
                success: function(result) {
                    // $('#res').html('Signature Uploaded successfully');
                    // if (confirm('Some message')) {
                    //     alert('Thanks for confirming');
                    // } else {
                    //     alert('Why did you press cancel? You should have confirmed');
                    // }

                    // location.reload();
                    sucess("Data Deleted Successfully!");
                },
            });
        }

    });

    $(document).on('click touchstart', '#inv_number_details', function() {

        var id = $(this).attr('data-id');
        var inv_no = $(this).attr('inv-no');


        $('#type-selection-modal').modal('show');
        $('#inv_modal_invNo').text(inv_no);
        $('#inv_modal_invNo2').text(inv_no);

        // alert(id);

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>accounting/inv_number_details",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                console.log('test ' + response['invoices'].customer_id);
                console.log('test 2 ' + response['customers'].first_name);

                var fullname = response['customers'].first_name + ' ' + response['customers']
                    .last_name;

                // result['invoices'].billingName
                $('#billingName').text(fullname);
                $('#billing_address').text(response['invoices'].billing_address);
                $('#billing_customer_email').text(response['invoices'].customer_email);

                if (response['customers'].phone_h == '') {
                    var phone = response['customers'].phone_m;
                } else {
                    var phone = response['customers'].phone_h;
                }

                $('#billing_customer_phone').text(phone);

                $('#billing_total').text(response['invoices'].grand_total);
                $('#billing_in_date').text(response['invoices'].date_issued);
                $('#billing_due_date').text(response['invoices'].due_date);

                $('#billing_city').text(response['customers'].city);


                var inputs = "";
                $.each(response['items'], function(i, v) {
                    inputs += v.title;

                    console.log('test 3 ' + v.title);

                    markup2 = "<table><tr width=\"10%\" id=\"sss\">" +
                        // "<tr>"+
                        "<td></td>" +
                        "<td>" + v.title + "</td>" +
                        "<td>" + v.quantity + "</td>" +
                        "<td>" + v.iCost + "</td>" +
                        "</tr></table>";
                    sulod = $("#billing_items");
                    sulod.append(markup2);

                });


                // if (confirm('Some message')) {
                //     alert('Thanks for confirming');
                // } else {
                //     alert('Why did you press cancel? You should have confirmed');
                // }

                // location.reload();
                // sucess("Data Deleted Successfully!");
            },
        });
    });


    function sucess(information, $id) {
        Swal.fire({
            title: 'Good job!',
            text: information,
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    }
</script>

<script>
    $(document).on("click", ".share-invoice-link-btn", function(event) {
        // alert('test');
        $.ajax({
            url: baseURL + "/accounting/generate_share_invoice_link",
            type: "POST",
            dataType: "json",
            data: {
                invoice_id: $(this).attr("data-invoice-id")
            },
            success: function(data) {
                $("div#share-link-modal").fadeIn();
                $('div#share-link-modal .the-modal-body .form-group input[name="shared_invoice_link"]')
                    .val(data.shared_link);
            },
        });
    });
</script>