<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/invoice'); ?>
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
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="page-title">Invoices & Payments</h3>

                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <?php if (hasPermissions('WORKORDER_MASTER')): ?>
                                                <a class="btn btn-primary btn-md"
                                                   href="<?php echo url('invoice/add') ?>"><span
                                                            class="fa fa-plus"></span> New Invoice</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-auto">
                                    <p>
                                        Listing all invoices.
                                    </p>
                                </div>
                                <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <form style="display: inline-flex;" class="form-inline form-search"
                                          name="form-search"
                                          action="<?php echo base_url('invoice') ?>"
                                          method="get">
                                        <div class="form-group" style="margin:0 !important;">
                                            <span>Search:</span> &nbsp;
                                            <input style="height:auto !important; font-size: 14px; margin-right:10px;"
                                                   class="form-control form-control-md"
                                                   name="search"
                                                   value="<?php echo (!empty($search)) ? $search : '' ?>"
                                                   type="text"
                                                   placeholder="Search...">
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
                                                aria-expanded="true" href="<?php echo base_url('customer') ?>">Source
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
                                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=created_at-asc') : base_url('invoice?order=created_at-asc') ?>">
                                            Newest First
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu  btn-block" role="menu">
                                            <li class="active" role="presentation">
                                                <a role="menuitem"
                                                   tabindex="-1"
                                                   href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=created_at-desc') : base_url('invoice?order=created_at-desc') ?>">
                                                   Newest First</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=created_at-asc') : base_url('invoice?order=created_at-asc') ?>">
                                                    Oldest First</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=last-invoice_number-asc') : base_url('invoice?order=last-invoice_number-asc') ?>">Number: Asc</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=last-invoice_number-desc') : base_url('invoice?order=last-invoice_number-desc') ?>">Number: Desc</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=amount-asc') : base_url('invoice?order=amount-desc') ?>">Amount: Lowest</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                       href="<?php echo (!empty($type)) ? base_url('invoice?type=' . $type . '&order=amount-desc') : base_url('invoice?order=amount-asc') ?>">Amount: Highest</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" style="padding-bottom:0px;">
                            <div class="row align-items-center">
                                <div class="col-md-12 summary">
                                    <div class="summary-item">
                                        <div class="summary-item-label">THIS YEAR</div>
                                        <div class="summary-item-value" id="total_this_year">$<?php echo get_invoice_amount('year') ?></div>
                                    </div>
                                    <div class="summary-item">
                                        <div class="summary-item-label">PENDING</div>
                                        <div class="summary-item-value" id="pending_total">$<?php echo get_invoice_amount('pending') ?></div>
                                    </div>
                                    <div class="summary-item">
                                        <div class="summary-item-label">PAID</div>
                                        <div class="summary-item-value" id="paid_total">$<?php echo get_invoice_amount('paid') ?></div>
                                    </div>
                                </div>
                            </div>                         
                        </div>                         

                        <div class="tabs">
                            <ul class="clearfix work__order" id="myTab" role="tablist">
                                <li <?php echo ((empty($tab)) || $tab == 1) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('invoice') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">All
                                        (<?php echo get_invoice_count(1) ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab)) && $tab == 2) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab2"
                                       href="<?php echo base_url('invoice/tab/2') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Due
                                        (<?php echo get_invoice_count(2) ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab)) && $tab == 3) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab3"
                                       href="<?php echo base_url('invoice/tab/3') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Overdue
                                        (<?php echo get_invoice_count(3) ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab)) && $tab == 4) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('invoice/tab/4') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Partially Paid
                                        (<?php echo get_invoice_count(4) ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab)) && $tab == 5) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('invoice/tab/5') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Paid
                                        (<?php echo get_invoice_count(5) ?>)</a>
                                </li>
                                <li <?php echo ((!empty($tab)) && $tab == 6) ? "class='active'" : "" ?>>
                                    <a class="nav-link"
                                       id="profile-tab"
                                       data-toggle="tab1"
                                       href="<?php echo base_url('invoice/tab/6') ?>"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Draft
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
                                                        <input type="checkbox" name="id_selector" value="0"
                                                               id="select-all"
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
                                                            <label for="invoice_id_<?php echo $invoice->id ?>"> <a
                                                                        class="a-default"
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
                                                        <p class="mb-0"> <label for=""><?php echo get_customer_by_id($invoice->customer_id)->contact_name ?></label></p>
                                                        <label for="customer_id_<?php echo $invoice->customer_id ?>"> <a href="<?php echo base_url('customer/genview/' . $invoice->customer_id) ?>"><?php echo $invoice->job_name ?></a></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-nowrap">
                                                        <label><?php echo $invoice->status ?></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-nowrap">
                                                       <label for="">$<?php echo number_format(unserialize($invoice->invoice_totals)['grand_total'], 2, '.', ','); ?> </label>
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-btn open">
                                                        <button class="btn btn-default dropdown-toggle" type="button"
                                                                id="dropdown-edit" data-toggle="dropdown"
                                                                aria-expanded="true">
                                                            <span class="btn-label">Manage</span>
                                                            <span class="caret-holder">
                                                                <span class="caret"></span>
                                                            </span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/send/' . $invoice->id) ?>">
                                                                <span class="fa fa-envelope-o icon"></span> Send Invoice</a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/edit/' . $invoice->id) ?>">
                                                                <span class="fa fa-pencil-square-o icon"></span>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>">
                                                                <span class="fa fa-file-text-o icon"></span>
                                                                    View Invoice
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/genview/' . $invoice->id) . "?do=payment_add" ?>">
                                                                <span class="fa fa-usd icon"></span>
                                                                    Record Invoice
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a role="menuitem" class="openConvertToWorkOrder" tabindex="-1"  href="javascript:void(0)" data-toggle="modal" data-target="#convertToWorkOrder" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>">
                                                                    <span class="fa fa-file-text-o icon"></span> Convert to Work Order
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a role="menuitem" class="openCloneInvoice" tabindex="-1" href="javascript:void(0)" data-toggle="modal" data-target="#cloneModal" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>">
                                                                    <span class="fa fa-files-o icon"></span> Clone Invoice
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a role="menuitem" class="openDeleteInvoice" tabindex="-1" href="javascript:void(0)" data-toggle="modal" data-target="#cancelModal" data-invoice-number="<?php echo $invoice->invoice_number ?>" data-id="<?php echo $invoice->id ?>">
                                                                    <span class="fa fa-trash-o icon"></span> Delete Invoice
                                                                </a>
                                                            </li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=pdf') ?>"><span class="fa fa-file-pdf-o icon"></span> Invoice PDF</a></li>
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('invoice/preview/'. $invoice->id . '?format=print') ?>"><span class="fa fa-print icon"></span> Print Invoice</a></li>
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
                                                            You are going create a new work order based on <b>Invoice# <span id='workOrderInvoiceId'"></span></b>.<br>
                                                            The invoice items (e.g. materials, labour) will be copied to this work order.<br>
                                                            You can always edit/delete work order items as you need.
                                                        </p>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" type="button" data-convert-to-work-order-modal="submit">Convert To Work Order</button>
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
                                                            You are going create a new invoice based on Invoice# <span id='cloneInvoiceId'></span>.<br>
                                                            The new invoice will contain the same items (e.g. materials, labour) and you
                                                            will be able to edit and remove the invoice items as you need.
                                                        </p>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                    <a href="#" id="cloneInvoiceBtn">
                                                        <button class="btn btn-primary" type="button" data-clone-modal="submit">Clone Invoice</button>
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
                                                            Are you sure you want to delete the <span class="bold">Invoice# <span id='deleteInvoiceId'></span></span>?
                                                        </p>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                    <a href="#" id="deleteInvoiceBtn">
                                                        <button class="btn btn-primary" type="button" data-cancel-modal="submit">Yes, Delete Invoice</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="page-empty-container">
                                        <h5 class="page-empty-header">There are no invoices</h5>
                                        <p class="text-ter margin-bottom">Manage your invoice.</p>
                                        <a class="btn btn-primary"
                                        href="<?php echo base_url('invoice/add') ?>"><span
                                                    class="fa fa-plus fa-margin-right"></span> Add New Invoice</a>
                                    </div>
                                <?php } ?>
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

<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable({

        columnDefs: [{
            orderable: true,
            className: 'select-checkbox',
            targets: 0,
            checkboxes: {
                selectRow: true
            }
        }],
        select: {
            'style': 'multi'
        },
        order: [[1, 'asc']],
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
    });

</script>