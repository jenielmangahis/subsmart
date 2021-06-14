<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
                            class="banking-tab">Word Order</a>
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
                                    <h3 class="mb-0"><strong>$0.00</strong></h3>
                                    <h6 class="font-weight-normal text-dark mt-1">Overdue</h6>
                                </div>
                                <div class="pull-right">
                                    <h3 class="mb-0"><strong>$4.00</strong></h3>
                                    <h6 class="font-weight-normal text-dark mt-1">Not due yet</h6>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-1">
                                <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-secondary w-50"></div>
                                    <div class="progress-bar bg-dark  w-50"></div>
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
                                    <h3 class="mb-0"><strong>$0</strong></h3>
                                    <h6 class="font-weight-normal text-secondary mt-1">Not deposited</h6>
                                </div>
                                <div class="pull-right">
                                    <h3 class="mb-0"><strong>$0</strong></h3>
                                    <h6 class="font-weight-normal text-secondary mt-1">Deposited</h6>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-1">
                                <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-success w-50"></div>
                                    <div class="progress-bar bg-info  w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12 px-0">
                        <div class="bg-white p-4">
                            <div class="row" style="margin-top:-50px;">
                                <div class="col-md-12" style="text-align:right;padding-bottom:10px;">
                                    <a class="btn btn-primary"
                                        href="<?php echo base_url('accounting/addnewInvoice') ?>"><span
                                            class="fa fa-plus fa-margin-right"></span> Add New Invoice</a>
                                </div>
                            </div>

                            <div class="row margin-bottom-ter align-items-center">
                                <!-- <div class="col-auto">
                                    <p>
                                        Listing all invoices.
                                    </p>
                                </div> -->
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
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
                                </div>
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

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

            <?php if (!empty($invoices)) { ?>
            <table class="table table-hover table-to-list" data-id="work_orders">
                <thead>
                    <tr>
                        <th>
                            <div class="table-name">
                                <div class="checkbox checkbox-sm select-all-checkbox">
                                    <input type="checkbox" name="id_selector" value="0" id="select-all"
                                        class="select-all">
                                    <label for="select-all">Invoice#</label>
                                </div>

                            </div>
                        </th>

                        <th>Date Issued</th>
                        <th>Date Due</th>
                        <th>Job & Customer</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($invoices as $invoice) { ?>
                    <tr>
                        <td>
                            <div class="table-name">
                                <div class="checkbox checkbox-sm">
                                    <input type="checkbox"
                                        name="id[<?php echo $invoice->id ?>]"
                                        value="<?php echo $invoice->id ?>"
                                        class="select-one"
                                        id="invoice_id_<?php echo $invoice->id ?>">
                                    <label
                                        for="invoice_id_<?php echo $invoice->id ?>">
                                        <a class="a-default"
                                            href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>"><?php echo $invoice->invoice_number ?></a></label>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="table-nowrap">
                                <label for=""><?php echo get_format_date($invoice->date_issued) ?></label>
                            </div>
                        </td>
                        <td>
                            <div class="table-nowrap">
                                <label for=""><?php echo get_format_date($invoice->due_date) ?></label>
                            </div>
                        </td>
                        <td>
                            <div class="table-nowrap">
                                <p class="mb-0"> <label for=""><?php echo get_customer_by_id($invoice->customer_id)->contact_name ?></label>
                                </p>
                                <label
                                    for="customer_id_<?php echo $invoice->customer_id ?>">
                                    <a
                                        href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>"><?php echo $invoice->job_name ?></a></label>
                            </div>
                        </td>
                        <td>
                            <div class="table-nowrap">
                                <label><?php echo $invoice->status ?></label>
                            </div>
                        </td>
                        <td>
                            <div class="table-nowrap">
                                <label for="">$<?php echo($invoice->grand_total); ?>
                                </label>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-btn open">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit"
                                    data-toggle="dropdown" aria-expanded="true">
                                    <span class="btn-label">Manage</span>
                                    <span class="caret-holder">
                                        <span class="caret"></span>
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                    aria-labelledby="dropdown-edit">
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1"
                                            href="<?php echo base_url('invoice/send/' . $invoice->id) ?>">
                                            <span class="fa fa-envelope-o icon"></span> Send Invoice</a>
                                    </li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1"
                                            href="<?php echo base_url('accounting/invoice_edit/' . $invoice->id) ?>">
                                            <span class="fa fa-pencil-square-o icon"></span>
                                            Edit
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1"
                                            href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>">
                                            <span class="fa fa-file-text-o icon"></span>
                                            View Invoice
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1"
                                            href="<?php echo base_url('invoice/genview/' . $invoice->id) . "?do=payment_add" ?>">
                                            <span class="fa fa-usd icon"></span>
                                            Record Invoice
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a role="menuitem" class="openConvertToWorkOrder" tabindex="-1"
                                            href="javascript:void(0)" data-toggle="modal"
                                            data-target="#convertToWorkOrder"
                                            data-invoice-number="<?php echo $invoice->invoice_number ?>"
                                            data-id="<?php echo $invoice->id ?>">
                                            <span class="fa fa-file-text-o icon"></span> Convert to Work Order
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a role="menuitem" class="openCloneInvoice" tabindex="-1"
                                            href="javascript:void(0)" data-toggle="modal" data-target="#cloneModal"
                                            data-invoice-number="<?php echo $invoice->invoice_number ?>"
                                            data-id="<?php echo $invoice->id ?>">
                                            <span class="fa fa-files-o icon"></span> Clone Invoice
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a role="menuitem" class="openDeleteInvoice" tabindex="-1"
                                            href="javascript:void(0)" data-toggle="modal" data-target="#cancelModal"
                                            data-invoice-number="<?php echo $invoice->invoice_number ?>"
                                            data-id="<?php echo $invoice->id ?>">
                                            <span class="fa fa-trash-o icon"></span> Delete Invoice
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=pdf') ?>"><span
                                                class="fa fa-file-pdf-o icon"></span> Invoice PDF</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=print') ?>"><span
                                                class="fa fa-print icon"></span> Print Invoice</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
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
                                    You are going create a new work order based on <b>Invoice# <span
                                            id='workOrderInvoiceId'"></span></b>.<br>
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

<?php include viewPath('includes/footer_accounting');
