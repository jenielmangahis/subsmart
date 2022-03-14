<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #draggable { width: 150px; height: 150px; padding: 0.5em; }
</style>
<style>
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
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
                        <div class="card-body hid-desk" >
                            <div class="row margin-bottom-ter align-items-center">
                                <!-- Nav tabs -->
                                <div class="col-auto">
                                    <h2 class="page-title" style="display:inline-block;">Customer Invoice List </h2>
                                    <span style="display:inline-block;color:#4a4a4a;font-size: 28px;margin-left: 9px;">(<i><?= $customer->first_name . ' ' . $customer->last_name; ?></i>)</span>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        An invoice provides customers with a detailed description and cost of the products or services that you have provided. Invoices are required for sales where the customers do not pay you immediately. Our invoices are tracked so that you know how much each customer owes you and when payment is due. This listing and our dashboard widget will help you keep your eyes on your money.
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="banking-tab-container mb-5">
                                        <div class="rb-01">
                                            <?php include_once('cus_module_tabs.php'); ?>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-4" >
                                        <table class="table table-hover" id="invoiceListTable">
                                            <thead>
                                            <tr>
                                                <th style="width:10%;">Invoice#</th>
                                                <th style="width:30%;">Customer</th>
                                                <th>Date Issued</th>
                                                <th>Date Due</th>
                                                <th>Terms</th>                                                
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Balance</th>
                                                <th></th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <?php foreach ($invoices as $invoice) { ?>
                                                <tr>
                                                    <td>
                                                        <a class="a-default" href="<?php echo base_url('invoice/genview/' . $invoice->id) ?>"><?php echo $invoice->invoice_number ?></a>
                                                    </td>
                                                    <td>
                                                        <div class="table-nowrap">
                                                          <label for=""><?php echo $invoice->first_name . ' ' . $invoice->last_name; ?></label>
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
                                                           <label for=""><?php echo $invoice->terms; ?></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-nowrap">
                                                            <label><?php echo $invoice->status ?></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-nowrap">
                                                           <label for="">$<?php echo ($invoice->invoice_totals) ? number_format(unserialize($invoice->invoice_totals)['grand_total'], 2, '.', ',') : '0.00' ?> </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-nowrap">
                                                           <label for="">$<?php echo number_format($invoice->balance,2); ?></label>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active standard-accordion" id="advance">
                            <div class="col-sm-12">
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/adv_cust/js_list'); ?>
<script>
$(document).ready(function () {
    $('#invoiceListTable').DataTable({
        "lengthChange": true,
        "searching": true,
        "pageLength": 10,
        "order": [],
    });
});
</script>
