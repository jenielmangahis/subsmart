<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .signature_mobile {
        display: none;
    }

    .show_mobile_view {
        display: none;
    }

    @media only screen and (max-device-width: 600px) {
        .label-element {
            position: absolute;
            top: -8px;
            left: 25px;
            font-size: 12px;
            color: #666;
        }

        .input-element {
            padding: 30px 5px 10px 8px;
            width: 100%;
            height: 55px;
            /* border:1px solid #CCC; */
            font-weight: bold;
            margin-top: -15px;
        }

        .mobile_qty {
            background: transparent !important;
            border: none !important;
            outline: none !important;
            padding: 0px 0px 0px 0px !important;
            text-align: center;
        }

        .select-wrap {
            border: 2px solid #e0e0e0;
            /* border-radius: 4px; */
            margin-top: -10px;
            /* margin-bottom: 10px; */
            padding: 0 5px 5px;
            width: 100%;
            /* background-color:#ebebeb; */
        }

        .select-wrap label {
            font-size: 10px;
            text-transform: uppercase;
            color: #777;
            padding: 2px 8px 0;
        }

        .m_select {
            /* background-color: #ebebeb;
    border:0px; */
            border-color: white !important;
            border: 0px !important;
            outline: 0px !important;
        }

        .select2 .select2-container .select2-container--default {
            /* background-color: #ebebeb;
    border:0px; */
            border-color: white !important;
            border: 0px !important;
            outline: 0px !important;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #fff !important;
            border-radius: 4px;
        }

        .sub_label {
            font-size: 12px !important;
        }

        .signature_web {
            display: none;
        }

        .signature_mobile {
            display: block;
        }

        .hidden_mobile_view {
            display: none;
        }

        .show_mobile_view {
            display: block;
        }

        .table_mobile {
            font-size: 14px;
        }

        div.dropdown-wrapper select {
            width: 115%
                /* This hides the arrow icon */
            ;
            background-color: transparent
                /* This hides the background */
            ;
            background-image: none;
            -webkit-appearance: none
                /* Webkit Fix */
            ;
            border: none;
            box-shadow: none;
            padding: 0.3em 0.5em;
            font-size: 13px;
        }

        .signature-pad-canvas-wrapper {
            margin: 15px 0 0;
            border: 1px solid #cbcbcb;
            border-radius: 3px;
            overflow: hidden;
            position: relative;
        }

        .signature-pad-canvas-wrapper::after {
            content: 'Name';
            border-top: 1px solid #cbcbcb;
            color: #cbcbcb;
            width: 100%;
            margin: 0 15px;
            display: inline-flex;
            position: absolute;
            bottom: 10px;
            font-size: 13px;
            z-index: -1;
        }

        .tabs {
            list-style: none;
        }

        .tabs li {
            display: inline;
        }

        .tabs li a {
            color: black;
            float: left;
            display: block;
            /* padding: 4px 10px;  */
            /* margin-left: -1px;  */
            position: relative;
            /* left: 1px;  */
            background: #a2a5a3;
            text-decoration: none;
        }

        .tabs li a:hover {
            background: #ccc;
        }

        .group:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }

        .box-wrap {
            position: relative;
            min-height: 250px;
        }

        .tabbed-area div div {
            background: white;
            padding: 20px;
            min-height: 250px;
            position: absolute;
            top: -1px;
            left: 0;
            width: 100%;
        }

        .tabbed-area div div,
        .tabs li a {
            border: 1px solid #ccc;
        }

        #box-one:target,
        #box-two:target,
        #box-three:target {
            z-index: 1;
        }

        .group li.active a,
        .group li a:hover,
        .group li.active a:focus,
        .group li.active a:hover {
            background-color: #52cc6e;
            color: black;
        }
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper accounting-sales" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box mx-4">
                <div class="col-lg-6 px-0">
                    <h3>Sales Transactions</h3>
                </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                    The Sales page gives you a great at-a-glance view of the status of sales transactions, open
                    invoices, and paid invoices.
                </div>
                <!-- <br> -->
                <!-- <div class="row pb-2"> -->
                <!-- <div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>"
                class="banking-tab">Overview</a>
                <a href="<?php echo url('/accounting/all-sales')?>"
                    class="banking-tab-active text-decoration-none">All Sales</a>
                <a href="<?php echo url('/accounting/invoices')?>"
                    class="banking-tab">Invoices</a>
                <a href="<?php echo url('/accounting/customers')?>"
                    class="banking-tab">Customers</a>
                <a href="<?php echo url('/accounting/deposits')?>"
                    class="banking-tab">Deposits</a>
                <a href="<?php echo url('/accounting/products-and-services')?>"
                    class="banking-tab">Products and Services</a>
            </div>
        </div> -->
        <br>
        <div class="row pb-2">
            <div class="col-md-12 banking-tab-container">
                <a href="<?php echo url('/accounting/sales-overview')?>"
                    class="banking-tab">Overview</a>
                <a href="<?php echo url('/accounting/all-sales')?>"
                    class="banking-tab-active text-decoration-none">All Sales</a>
                <a href="<?php echo url('/accounting/newEstimateList')?>"
                    class="banking-tab">Estimates</a>
                <a href="<?php echo url('/accounting/customers')?>"
                    class="banking-tab">Customers</a>
                <a href="<?php echo url('/accounting/deposits')?>"
                    class="banking-tab">Deposits</a>
                <a href="<?php echo url('/accounting/listworkOrder')?>"
                    class="banking-tab">Work Order</a>
                <a href="<?php echo url('/accounting/invoices')?>"
                    class="banking-tab">Invoices</a>
                <a href="<?php echo url('/accounting/jobs ')?>"
                    class="banking-tab">Jobs</a>
                <a href="<?php echo url('/accounting/products-and-services')?>"
                    class="banking-tab">Products and Services</a>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-lg-6 px-0">
                <!-- <h2>Sales Transactions</h2> -->
            </div>
            <div class="col-lg-6">
                <div class="pull-right">
                    <button class="btn btn-success rounded-20" type="button" id="dropNewTraaction"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        New Transaction&ensp;<span class="fa fa-caret-down"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropNewTraaction">
                        <a class="dropdown-item"
                            href="<?php echo base_url('accounting/addnewInvoice') ?>">Invoice</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#receive-payment">Payment</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#newJobModal">Estimate</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addsalesreceiptModal">Sales
                            Receipt</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#credit-memo">Credit Memo</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delayed-charge">Delayed
                            Charge</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sales-time-activity">Time
                            Activity</a>
                    </div>
                </div>

				<!-- end row -->
				<div class="row ml-2"></div>
            <!-- end row -->
			</div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="row pt-3 align-items-end mr-1">
                    <div class="col px-0">
                        <div class="bg-info px-3 py-2" style="height:100px !important;">
                            <h4 class="text-white"><?php $estimateCount = 0; foreach ($estimates as $estimate){ $estimateCount++; } echo $estimateCount;  ?></h4>
                            <h6 class="text-white">ESTIMATES</h6>
                        </div>
                    </div>
                    <div class="col px-0">
                        <p class="text-primary mb-1">Unbilled Last 365 Days</p>
                        <div class="bg-primary px-3 py-2" style="height:100px !important;">
                            <h4 class="text-white">0</h4>
                            <h6 class="text-white">UNBILLED ACTIVITY</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="row pt-3 align-items-end mr-1">
                    <div class="col px-0">
                        <p class="text-primary mb-1">Unpaid Last 365 Days</p>
                        <div class="bg-warning px-3 py-2" style="height:100px !important;">
                            <h4 class="text-white"><?php $Over = 0; foreach ($InvOverdue as $InvOver){ $Over++; } echo $Over;  ?></h4>
                            <h6 class="text-white">OVERDUE</h6>
                        </div>
                    </div>
                    <div class="col px-0">
                        <div class="bg-secondary px-3 py-2" style="height:100px !important;">
                            <h4 class="text-white"><?php $OpenInv = 0; foreach ($OpenInvoices as $OpenInvoice){ $OpenInv++; } echo $OpenInv;  ?></h4>
                            <h6 class="text-white">OPEN INVOICES</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="row pt-3 align-items-end">
                    <div class="col px-0">
                        <p class="text-primary mb-1">Paid</p>
                        <div class="bg-success px-3 py-2" style="height:100px !important;">
                            <h4 class="text-white"><?php $InvPaid = 0; foreach ($getAllInvPaid as $getAllInvPaid){ $InvPaid++; } echo $InvPaid;  ?></h4>
                            <h6 class="text-white">PAID LAST 30 DAYS</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <a class="btn btn-primary link-modal-open" href="#" id="add_another_items" data-toggle="modal"
                    data-target="#filterBY">Filter</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 px-0">
                <div class="bg-white p-4">
                    <table id="all_sales_table" class="table table-striped table-bordered w-100">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>No.</th>
                                <th>Customer</th>
                                <th>Due Date</th>
                                <th>Balance</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoices as $inv):?>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->date_issued)); ?>
                                </td>
                                <td><?php echo 'Invoice'; ?>
                                </td>
                                <td><?php echo $inv->invoice_number; ?>
                                </td>
                                <td><?php echo $inv->contact_name . '' . $inv->first_name."&nbsp;".$inv->last_name;?>
                                </td>
                                <td><?php  echo date('m'.'/'.'d'.'/'. 'Y', strtotime($inv->due_date)); ?>
                                </td>
                                <td><?php echo $inv->balance; ?>
                                </td>
                                <td><?php echo $inv->total_due; ?>
                                </td>
                                <td><?php echo $inv->INV_status; ?>
                                </td>
                                <td class="text-right" style="padding-right:20px;">
                                    <!-- <a href="">View</a> -->

                                    <div class="dropdown dropdown-btn">
                                            <!-- <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                            </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                            aria-labelledby="dropdown-edit">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span
                                                        class="fa fa-file-text-o icon"></span>Send</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href=""><span
                                                        class="fa fa-envelope-o icon"></span>Share Invoice Link</a>
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#"
                                                    data-toggle="modal" data-target="#modalCloneWorkorder" data-id=""
                                                    data-name="WO-00433"> <span class="fa fa-print icon"></span>Print
                                                    Packing Slip</a> </li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#"
                                                    data-toggle="modal" data-target="#add-invoice"
                                                    data-convert-to-invoice-modal="open" data-id="161983"
                                                    data-name="WO-00433"><span
                                                        class="fa fa-pencil-square-o icon"></span>View/Edit</a> </li>
                                            <li role="presentation"> <a role="menuitem" href="#" class=""><span
                                                        class="fa fa-files-o icon clone-workorder"></span>Copy</a></li>
                                            <li role="presentation"> <a role="menuitem" target="_new" href="#" class="">
                                                    <span class="fa fa-trash-o icon"></span>Delete</a></li>
                                            <li role="presentation"> <a role="menuitem" href="javascript:void(0);"
                                                    class="btn-send-customer" data-id=""> <span
                                                        class="fa fa-envelope-open-o icon"></span>Void</a></li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            </li>
                                        </ul> -->
                                        <?php if($inv->INV_status == 'Paid'){ ?>
                                            <a href="<?php echo base_url('accounting/invoice_edit/' . $inv->id) ?>" style="color:gray;"><i class="fa fa-pencil" aria-hidden="true"></i></a> &emsp; <a href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>" style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a> &emsp;
                                        <?php }else{ ?>
                                            <a href="<?php echo base_url('accounting/invoice_edit/' . $inv->id) ?>" style="color:gray;"><i class="fa fa-pencil" aria-hidden="true"></i></a> &emsp; 
                                            <!-- <a href="#" style="color:#3a96d2;" data-toggle="modal" data-target="#addreceivepaymentModal">Receive payment</a>  -->
                                            <a href="" style="color:#3a96d2;font-weight:bold;" class="first-option customer_receive_payment_btn" data-customer-id="<?=$inv->customer_id?>">Receive payment </a>
                                            &emsp;
                                        <?php } ?>

                                        <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                                            data-toggle="dropdown" aria-expanded="true">
                                            <span class="btn-label"></span>
                                            <span class="caret-holder">
                                                <span class="caret"></span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"
                                            aria-labelledby="dropdown-edit">
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                    href="<?php echo base_url('invoice/send/' . $inv->id) ?>">
                                                    <span class="fa fa-envelope-o icon"></span> Send Invoice</a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                    href="<?php echo base_url('accounting/invoice_edit/' . $inv->id) ?>">
                                                    <span class="fa fa-pencil-square-o icon"></span>
                                                    Edit
                                                </a>
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                    href="<?php echo base_url('invoice/genview/' . $inv->id) ?>">
                                                    <span class="fa fa-file-text-o icon"></span>
                                                    View Invoice
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" tabindex="-1"
                                                    href="<?php echo base_url('invoice/genview/' . $inv->id) . "?do=payment_add" ?>">
                                                    <span class="fa fa-usd icon"></span>
                                                    Record Invoice
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <!-- <a role="menuitem" class="openConvertToWorkOrder" tabindex="-1"
                                                    href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#convertToWorkOrder"
                                                    data-invoice-number="<?php echo $inv->invoice_number ?>"
                                                    data-id="<?php echo $inv->id ?>">
                                                    <span class="fa fa-file-text-o icon"></span> Convert to Work Order
                                                </a> -->
                                                <a role="menuitem" tabindex="-1"
                                                                                    href="<?php echo base_url('workorder/invoice_workorder/' . $inv->id) ?>"
                                                                                    data-convert-to-invoice-modal="open"
                                                                                    data-id="<?php echo $inv->id ?>"
                                                                                    data-invoice-number="<?php echo $inv->invoice_number ?>">
                                                                            <span class="fa fa-file-text-o icon"></span> Convert to Work Order
                                                                        </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" class="openCloneInvoice" tabindex="-1"
                                                    href="javascript:void(0)" data-toggle="modal" data-target="#cloneModal"
                                                    data-invoice-number="<?php echo $inv->invoice_number ?>"
                                                    data-id="<?php echo $inv->id ?>">
                                                    <span class="fa fa-files-o icon"></span> Clone Invoice
                                                </a>
                                            </li>
                                            <li class="share-invoice-link-btn"
                                                data-invoice-id="<?=$inv->id?>">
                                                <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                                                <span class="fa fa-share icon" aria-hidden="true"></span>
                                                    Share invoice link
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a role="menuitem" class="openDeleteInvoice" tabindex="-1"
                                                    href="javascript:void(0)"
                                                    data-invoice-number="<?php echo $inv->invoice_number ?>"
                                                    data-id="<?php echo $inv->id ?>"
                                                    id="deleteInvoiceBtnNew">
                                                    <span class="fa fa-trash-o icon"></span> Delete Invoice
                                                </a>
                                                <!-- <a href="#" work-id="<?php //echo $workorder->id; ?>" id="delete_workorder"><span class="fa fa-trash-o icon"></span> Delete </a> -->
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=pdf') ?>"><span
                                                        class="fa fa-file-pdf-o icon"></span> Invoice PDF</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>"><span
                                                        class="fa fa-print icon"></span> Print Invoice</a></li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php foreach ($estimates as $estimate) { ?>
                                        <tr>
                                        <td><input type="checkbox"></td>
                                            <td>
                                                <div class="table-nowrap">
                                                    <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($estimate->estimate_date)) ?>
                                                </div>
                                            </td>
                                            <td>
                                            <?php echo 'Estimate'; ?></td>
                                            <td>
                                                <a class="a-default"
                                                href="#">
                                                    <?php echo $estimate->estimate_number; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <div><a href="#"><?php echo $estimate->job_name; ?></a></div>
                                                <a href="<?php echo base_url('customer/view/' . $estimate->customer_id) ?>">
                                                    <?php echo get_customer_by_id($estimate->customer_id)->first_name .' '. get_customer_by_id($estimate->customer_id)->last_name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($estimate->expiry_date)); ?>
                                            </td>
                                            <td>
                                                <?php if (is_serialized($estimate->estimate_eqpt_cost)) { ?>
                                                    $<?php echo unserialize($estimate->estimate_eqpt_cost)['eqpt_cost'] ?>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $estimate->grand_total; ?></td>
                                            <td>
                                            <?php
                                                if( $estimate->is_mail_open == 1 ){
                                                echo "<i class='fa fa-eye'></i>  ";
                                                }
                                                echo $estimate->status;
                                            ?>
                                            </td>
                                            <td class="text-right" style="padding-right:20px;">
                                                <div class="dropdown dropdown-btn">
                                                    <a role="menuitem" tabindex="-1" href="<?php echo base_url('estimate/view/' . $estimate->id) ?>" style="color:#3a96d2;font-weight:bold;">Create invoice</a> &emsp;

                                                    <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label"></span>
                                                        <span class="caret-holder">
                                                            <span class="caret"></span>
                                                        </span>
                                                    </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" target="_new" href="<?php echo base_url('estimate/print/' . $estimate->id) ?>" class="">
                                                                <span class="fa fa-print icon"></span>  Print</a></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Send</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Update status</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Copy</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                        </ul>
                                                </div>
                                                <!-- <div class="dropdown dropdown-btn">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                href="<?php echo base_url('estimate/view/' . $estimate->id) ?>"><span
                                                                        class="fa fa-file-text-o icon"></span> View Estimate</a></li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>"><span
                                                                        class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                        </li>
                                                        <li role="separator" class="divider"></li>
                                                        <li role="presentation"><a role="menuitem"
                                                                                tabindex="-1"
                                                                                href="#"
                                                                                data-toggle="modal"
                                                                                data-target="#modalCloneWorkorder"
                                                                                data-id="<?php echo $estimate->id ?>"
                                                                                data-name="WO-00433"><span
                                                                        class="fa fa-files-o icon clone-workorder">

                                                            </span> Clone Estimate</a>
                                                        </li>
                                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                                href="<?php echo base_url('invoice') ?>"
                                                                                data-convert-to-invoice-modal="open"
                                                                                data-id="161983"
                                                                                data-name="WO-00433"><span
                                                                        class="fa fa-money icon"></span> Convert to Invoice</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>" class="">
                                                            <span class="fa fa-file-pdf-o icon"></span>  View PDF</a></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" target="_new" href="<?php echo base_url('estimate/print/' . $estimate->id) ?>" class="">
                                                            <span class="fa fa-print icon"></span>  Print</a></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                            <span class="fa fa-envelope-open-o icon"></span>  Send to Customer</a></li>
                                                        <li><div class="dropdown-divider"></div></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" href="<?php echo base_url('estimate/delete/' . $estimate->id) ?>>" onclick="return confirm('Do you really want to delete this item ?')" data-delete-modal="open"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div> -->
                                            </td>
                                        </tr>
                                    <?php } //print_r($sales_receipts); ?>

                                    <?php foreach ($sales_receipts as $salesReceipts) { ?>
                                        <tr>
                                        <td><input type="checkbox"></td>
                                            <td>
                                                <div class="table-nowrap">
                                                    <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($salesReceipts->sales_receipt_date)) ?>
                                                </div>
                                            </td>
                                            <td>
                                            <?php echo 'Sales Receipt'; ?></td>
                                            <td>
                                                <a class="a-default"
                                                href="#">
                                                    <?php echo $salesReceipts->id; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('customer/view/' . $salesReceipts->customer_id) ?>">
                                                    <?php echo get_customer_by_id($salesReceipts->customer_id)->first_name .' '. get_customer_by_id($salesReceipts->customer_id)->last_name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td><?php echo $salesReceipts->grand_total; ?></td>
                                            <td>
                                            <?php
                                                echo "Paid";
                                            ?>
                                            </td>
                                            <td class="text-right" style="padding-right:20px;">
                                                <div class="dropdown dropdown-btn">
                                                    <a href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>" style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

                                                    <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label"></span>
                                                        <span class="caret-holder">
                                                            <span class="caret"></span>
                                                        </span>
                                                    </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Send</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" target="_new" href="<?php echo base_url('estimate/print/' . $estimate->id) ?>" class="">
                                                                <span class="fa fa-print icon"></span>  Print packing slip</a></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  View/Edit</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Copy</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Delete</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $estimate->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Void</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                        </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } //print_r($sales_receipts); ?>

                                    <?php foreach ($credit_memo as $credit) { ?>
                                        <tr>
                                        <td><input type="checkbox"></td>
                                            <td>
                                                <div class="table-nowrap">
                                                    <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($credit->credit_memo_date)) ?>
                                                </div>
                                            </td>
                                            <td>
                                            <?php echo 'Credit Memo'; ?></td>
                                            <td>
                                                <a class="a-default"
                                                href="#">
                                                    <?php echo $credit->id; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('customer/view/' . $credit->customer_id) ?>">
                                                    <?php echo get_customer_by_id($credit->customer_id)->first_name .' '. get_customer_by_id($credit->customer_id)->last_name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td><?php echo $credit->grand_total; ?></td>
                                            <td>
                                            <?php
                                                //echo "Paid";
                                            ?>
                                            </td>
                                            <td class="text-right" style="padding-right:20px;">
                                                <div class="dropdown dropdown-btn">
                                                    <a href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>" style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

                                                    <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label"></span>
                                                        <span class="caret-holder">
                                                            <span class="caret"></span>
                                                        </span>
                                                    </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $credit->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Send</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" target="_new" href="<?php echo base_url('estimate/print/' . $credit->id) ?>" class="">
                                                                <span class="fa fa-print icon"></span>  Print packing slip</a></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $credit->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  View/Edit</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $credit->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Copy</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $credit->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Delete</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $credit->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Void</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                        </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } //print_r($sales_receipts); ?>

                                    <?php foreach ($statements as $statement) { ?>
                                        <tr>
                                        <td><input type="checkbox"></td>
                                            <td>
                                                <div class="table-nowrap">
                                                    <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($statement->credit_memo_date)) ?>
                                                </div>
                                            </td>
                                            <td>
                                            <?php echo 'Statements'; ?></td>
                                            <td>
                                                <a class="a-default"
                                                href="#">
                                                    <?php echo $statement->id; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('customer/view/' . $statement->customer_id) ?>">
                                                    <?php echo get_customer_by_id($statement->customer_id)->first_name .' '. get_customer_by_id($statement->customer_id)->last_name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td><?php echo $statement->balance; ?></td>
                                            <td>
                                            <?php
                                                //echo "Paid";
                                            ?>
                                            </td>
                                            <td class="text-right" style="padding-right:20px;">
                                                <div class="dropdown dropdown-btn">
                                                    <a href="<?php echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>" style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

                                                    <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label"></span>
                                                        <span class="caret-holder">
                                                            <span class="caret"></span>
                                                        </span>
                                                    </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="<?= $statement->id; ?>">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Send</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                        </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } //print_r($sales_receipts); ?>

                                    <?php foreach ($rpayments as $rpayment) { ?>
                                        <tr>
                                        <td><input type="checkbox"></td>
                                            <td>
                                                <div class="table-nowrap">
                                                    <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($rpayment->payment_date)) ?>
                                                </div>
                                            </td>
                                            <td>
                                            <?php echo 'Payment'; ?></td>
                                            <td>
                                                <a class="a-default"
                                                href="#">
                                                    <?php echo $rpayment->id; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('customer/view/' . $rpayment->customer_id) ?>">
                                                    <?php echo get_customer_by_id($rpayment->customer_id)->first_name .' '. get_customer_by_id($rpayment->customer_id)->last_name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td><?php echo $rpayment->amount; ?></td>
                                            <td>
                                            <?php
                                                //echo "Paid";
                                            ?>
                                            </td>
                                            <td class="text-right" style="padding-right:20px;">
                                                <!-- <div class="dropdown dropdown-btn">
                                                    <a href="<?php //echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>" style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

                                                    <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label"></span>
                                                        <span class="caret-holder">
                                                            <span class="caret"></span>
                                                        </span>
                                                    </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Send</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                        </ul>
                                                </div> -->
                                            </td>
                                        </tr>
                                    <?php } //print_r($sales_receipts); ?>

                                    <?php foreach ($checks as $check) { ?>
                                        <tr>
                                        <td><input type="checkbox"></td>
                                            <td>
                                                <div class="table-nowrap">
                                                    <?php echo  date('m'.'/'.'d'.'/'. 'Y', strtotime($check->payment_date)) ?>
                                                </div>
                                            </td>
                                            <td>
                                            <?php echo 'Check'; ?></td>
                                            <td>
                                                <a class="a-default"
                                                href="#">
                                                    <?php echo $check->id; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <!-- <a href="<?php //echo base_url('customer/view/' . $rpayment->customer_id) ?>"> -->
                                                    <?php 
                                                        // if($check->payee_id == 'customer'){
                                                        //     echo get_customer_by_id($check->payee_id)->first_name .' '. get_customer_by_id($check->payee_id)->last_name;
                                                        // }
                                                        // elseif($check->payee_id == 'vendor')
                                                        // {

                                                        // }
                                                        // else{

                                                        // }

                                                        switch($check->payee_type) {
                                                            case 'vendor' :
                                                                $vendor = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                                                // echo $vendor->display_name;
                                                                print_r('test'.$vendor);
                                                            break;
                                                            case 'customer' :
                                                                $customer = $this->accounting_customers_model->get_customer_by_id($check->payee_id);
                                                                echo $customer->first_name . ' ' . $customer->last_name;
                                                            break;
                                                            case 'employee' :
                                                                $employee = $this->users_model->getUser($check->payee_id);
                                                                echo $employee->FName . ' ' . $employee->LName;
                                                            break;
                                                        }
                                                        
                                                        ?>
                                                <!-- </a> -->
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td>
                                                <!-- na -->
                                            </td>
                                            <td><?php echo $check->total_amount; ?></td>
                                            <td>
                                            <?php
                                                //echo "Paid";
                                            ?>
                                            </td>
                                            <td class="text-right" style="padding-right:20px;">
                                                <!-- <div class="dropdown dropdown-btn">
                                                    <a href="<?php //echo base_url('invoice/preview/'. $inv->id . '?format=print') ?>" style="color:#3a96d2;font-weight:bold;" target="_blank">Print</a>

                                                    <button class="dropdown-toggle" type="button" id="dropdown-edit" style="height: 25px;"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                        <span class="btn-label"></span>
                                                        <span class="caret-holder">
                                                            <span class="caret"></span>
                                                        </span>
                                                    </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation">
                                                                <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id="">
                                                                <span class="fa fa-envelope-open-o icon"></span>  Send</a></li>
                                                            <li><div class="dropdown-divider"></div></li>
                                                        </ul>
                                                </div> -->
                                            </td>
                                        </tr>
                                    <?php } //print_r($sales_receipts); ?>
                        </tbody>
                    </table>
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
<!--    Create Invoice Modal-->
<div class="full-screen-modal">
    <div id="add-invoice" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Update Invoice<span id="checkNUmberHeader"></span>
                    </div>
                    <button type="button" class="close" id="closeAddInvoiceModal"><i
                            class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="container-fluid" style="background-color:white;">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <!-- <div class="col-sm-6">
                        <h3 style="font-family: Sarabun, sans-serif"> &nbsp; New Invoice</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">&emsp; &emsp; Complete the fields below to create a new invoice.</li>
                        </ol>
                    </div> -->
                            <div class="col-sm-6">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                        <a href="<?php echo base_url('invoice') ?>"
                                            class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to Invoices
                                        </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="validation-error" id="estimate-error" style="display: none;">You selected
                                    Credit Card Payments as payment method for this invoice. Please configure the <a
                                        href="https://www.markate.com/pro/settings/payments/main">Online Payment
                                        processor</a> first to accept cart payments.</div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <?php echo form_open_multipart('Invoice/addNewInvoice', ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>

                    <div class="row ">
                        <div class="col-xl-12">
                            <div class="card2">
                                <div class="card-body">
                                    <div class="row" style="background-color:white;">
                                        <div class="col-md-5 form-group">
                                            <label for="invoice_customer">Customer</label>
                                            <!-- <select id="invoice_customer" name="customer_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select customer">
                                    </select> -->
                                            <select name="customer_id" id="sel-customer" class="form-control" required>
                                                <option>Select a customer</option>
                                                <?php foreach ($customers as $customer):?>
                                                <option
                                                    value="<?php echo $customer->prof_id?>">
                                                    <?php echo $customer->first_name."&nbsp;".$customer->last_name;?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <p>&nbsp;</p>
                                            <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                                data-target="#modalNewCustomer" style="color:#02A32C;"><span
                                                    class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New
                                                Customer</a>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <label for="job_location">Job Location <small
                                                    class="help help-sm">(optional)</small></label>

                                            <input type="text" class="form-control" name="jobs_location"
                                                id="invoice_jobs_location" />
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <!-- <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewLocationAddress" style="color:#02A32C;"><span
                                                class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Location Address</a> -->
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <label for="job_name">Job Name <small
                                                    class="help help-sm">(optional)</small></label>
                                            <input type="text" class="form-control" name="job_name" id="job_name" />
                                        </div>
                                    </div>

                                    <div class="row" style="background-color:white;">
                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <div class="col-md-3">
                                                    <label>Terms</label>
                                                    <select class="form-control" name="terms" id="addNewTermsInvoice">
                                                        <option></option>
                                                        <option value="0">Add New</option>
                                                        <?php foreach ($terms as $term) : ?>
                                                        <option
                                                            value="<?php echo $term->id; ?>">
                                                            <?php echo $term->name . ' ' . $term->net_due_days; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Customer email</label>
                                                    <input type="email" class="form-control" name="customer_email"
                                                        id="customer_email">
                                                    <p><input type="checkbox"> Send later </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Location of sale</label>
                                                    <input type="text" class="form-control" name="location_scale">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Tracking no.</label>
                                                    <input type="text" class="form-control" name="tracking_number">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-3">
                                                    <label>Ship via</label>
                                                    <input type="text" class="form-control" name="ship_via">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Shipping date</label>
                                                    <input type="date" class="form-control" name="shipping_date">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Tags</label> <span class="float-right"><a href="#"
                                                            class="text-info" data-toggle="modal"
                                                            data-target="#tags-modal" id="open-tags-modal">Manage
                                                            tags</a></span>
                                                    <input type="text" class="form-control" name="tags">
                                                </div>
                                                <!-- </div>
                                    <div class="row form-group"> -->
                                                <div class="col-md-3">
                                                    <label>Billing address</label>
                                                    <textarea class="form-control" style="width:100%;"
                                                        name="billing_address" id="billing_address"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row" style="background-color:white;">
                                        <div class="col-md-3 form-group">
                                            <label for="estimate_date">Invoice Type <span
                                                    style="color:red;">*</span></label>
                                            <select name="invoice_type" class="form-control">
                                                <option value="Deposit">Deposit</option>
                                                <option value="Partial Payment">Partial Payment</option>
                                                <option value="Final Payment">Final Payment</option>
                                                <option value="Total Due" selected="selected">Total Due</option>
                                            </select>
                                        </div>


                                        <div class="col-md-3 form-group">
                                            <label for="work_order">Job# <small
                                                    class="help help-sm">(optional)</small></label>
                                            <span class="fa fa-question-circle text-ter" data-toggle="popover"
                                                data-placement="top" data-trigger="hover"
                                                data-content="Field is auto-populated on create Invoice from a Work Order."
                                                data-original-title="" title=""></span>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="work_order_number"
                                                    name="work_order_number">
                                            </div>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="purchase_order">Purchase Order# <small
                                                    class="help help-sm">(optional)</small></label>
                                            <span class="fa fa-question-circle text-ter" data-toggle="popover"
                                                data-placement="top" data-trigger="hover"
                                                data-content="Optional if you want to display the purchase order number on invoice."
                                                data-original-title="" title=""></span>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="purchase_order"
                                                    id="purchase_order">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Shipping to</label>
                                            <textarea class="form-control" style="width:100%;"
                                                name="shipping_to_address" id="shipping_address"></textarea>
                                        </div>

                                        <!-- <div class="col-md-3 form-group">
                                </div> -->

                                        <div class="col-md-3 form-group">
                                            <label for="invoice_number">Invoice#</label>
                                            <!-- <input type="text" class="form-control" name="invoice_number"
                                           id="invoice_number" value="<?php echo "INV-".date("YmdHis"); ?>"
                                            required placeholder="Enter Invoice#"
                                            autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                            -->
                                            <!-- <input type="text" class="form-control" name="invoice_number"
                                           id="invoice_number" value="<?php echo "INV-".date("YmdHis"); ?>"
                                            required placeholder="Enter Invoice#"
                                            onChange="jQuery('#customer_id').text(jQuery(this).val());"/> -->
                                            <input type="text" class="form-control" name="invoice_number"
                                                id="invoice_number" value="<?php
                                    // echo "INV-";
                                    //        foreach ($number as $num):
                                    //             $next = $num->invoice_number;
                                    //             $arr = explode("-", $next);
                                    //             $date_start = $arr[0];
                                    //             $nextNum = $arr[1];
                                    //         //    echo $number;
                                    //        endforeach;
                                    //        $val = $nextNum + 1;
                                    //        echo str_pad($val,9,"0",STR_PAD_LEFT);
                                           ?>" required />
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="date_issued">Date Issued <span
                                                    style="color:red;">*</span></label>
                                            <input type="date" class="form-control" id="start_date_" name="date_issued"
                                                required />
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="due_date">Due Date <span style="color:red;">*</span></label>
                                            <input type="date" class="form-control" id="end_date_" name="due_date"
                                                required />
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="status">Status</label><br />
                                            <!-- <input type="text" name="status" class="form-control"> -->
                                            <select name="status" class="form-control">
                                                <option value="Draft">Draft</option>
                                                <option value="Submitted">Submitted</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Declined">Declined</option>
                                                <option value="Schedule">Schedule</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row" id="plansItemDiv" style="background-color:white;">
                                        <div class="col-md-10 pt-2">
                                            <label for="">Manage invoice items</label>
                                        </div>
                                        <div class="col-md-2 row pr-0">
                                            <label for="" class="pt-2">Show qty as: </label>
                                            <select name="qty_type[]" id="show_qty_type" class="form-control mb-2"
                                                style="display:inline-block; width: 135px;">
                                                <option value="Quantity">Quantity</option>
                                                <option value="Hours">Hours</option>
                                                <option value="Square Feet">Square Feet</option>
                                                <option value="Rooms">Rooms</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-hover">
                                                <input type="hidden" name="count" value="0" id="count">
                                                <thead style="background-color:#E9E8EA;">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Group</th>
                                                        <!-- <th>Description</th> -->
                                                        <th width="150px">Quantity</th>
                                                        <!-- <th>Location</th> -->
                                                        <th width="150px">Price</th>
                                                        <th class="hidden_mobile_view" width="150px">Discount</th>
                                                        <th class="hidden_mobile_view" width="150px">Tax (Change in %)
                                                        </th>
                                                        <th class="hidden_mobile_view">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="jobs_items_table_body">
                                                    <tr>
                                                        <td width="30%">
                                                            <input type="text" class="form-control getItems"
                                                                onKeyup="getItems(this)" name="items[]">
                                                            <ul class="suggestions"></ul>
                                                            <div class="show_mobile_view"><span
                                                                    class="getItems_hidden"></span></div>
                                                            <input type="hidden" name="itemid[]" id="itemid"
                                                                class="itemid">
                                                        </td>
                                                        <td width="20%">
                                                            <div class="dropdown-wrapper">
                                                                <select name="item_type[]" id="item_typeid"
                                                                    class="form-control">
                                                                    <option value="product">Product</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="service">Service</option>
                                                                    <option value="fee">Fee</option>
                                                                </select>
                                                            </div>

                                                            <!-- <div class="show_mobile_view" style="color:green;"><span>Product</span></div> -->
                                                        </td>
                                                        <td width="10%"><input type="number"
                                                                class="form-control quantity mobile_qty"
                                                                name="quantity[]" data-counter="0" id="quantity_0"
                                                                value="1"></td>
                                                        <td width="10%"><input type="number"
                                                                class="form-control price hidden_mobile_view"
                                                                name="price[]" data-counter="0" id="price_0" min="0"
                                                                value="0"> <input type="hidden" class="priceqty"
                                                                id="priceqty_0">
                                                            <div class="show_mobile_view"><span class="price">0</span>
                                                                <!-- <input type="hidden" class="form-control price" name="price[]" data-counter="0" id="priceM_0" min="0" value="0"> -->
                                                            </div><input id="priceM_qty0" value="" type="hidden"
                                                                name="price_qty[]"
                                                                class="form-control hidden_mobile_view price_qty">
                                                        </td>
                                                        <td width="10%" class="hidden_mobile_view"><input type="number"
                                                                class="form-control discount" name="discount[]"
                                                                data-counter="0" id="discount_0" min="0" value="0"
                                                                readonly></td>
                                                        <td width="10%" class="hidden_mobile_view"><input type="text"
                                                                class="form-control tax_change" name="tax[]"
                                                                data-counter="0" id="tax1_0" min="0" value="0">
                                                            <!-- <span id="span_tax_0">0.0</span> -->
                                                        </td>
                                                        <td width="10%" class="hidden_mobile_view"><input type="hidden"
                                                                class="form-control " name="total[]" data-counter="0"
                                                                id="item_total_0" min="0" value="0">
                                                            $<span id="span_total_0">0.00</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="row lamesa">
                                                <!-- <a class="link-modal-open pt-1 pl-2" href="#" id="add_another_new_invoice" style="color:#02A32C;"><span
                                                    class="fa fa-plus-square fa-margin-right" style="color:#02A32C;"></span>Add Items</a> -->
                                                <!-- <a href="#" id="add_another_new_invoice2" style="color:#02A32C;" data-toggle="modal" data-target="#item_list"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line </a> -->
                                                <a class="link-modal-open" href="#" id="add_another_items"
                                                    data-toggle="modal" data-target="#item_list_allsales"><span
                                                        class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                                &emsp;
                                                <a class="link-modal-open" href="#" id="add_package" data-toggle="modal"
                                                    data-target=".bd-example-modal-lgallsales"><span
                                                        class="fa fa-plus-square fa-margin-right"></span>Add Package</a>
                                                <hr style="display:inline-block; width:91%">
                                            </div>
                                            <!-- <div class="row">
                                        <div class="col-md-7">
                                        &nbsp;
                                        </div>
                                        <div class="col-md-5 row pr-0">
                                            <div class="col-sm-5">
                                                <label style="padding: 0 .75rem;">Subtotal</label>
                                            </div>
                                            <div class="col-sm-6 text-right pr-3">
                                                $ <span id="item_total_text">0.00</span>
                                                <input type="hidden" name="sub_total" id="item_total">
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:100%; display:inline; border: 1px dashed #d1d1d1">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" name="adjustment_input" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </div>
                                            <div class="col-sm-3 text-right pt-2">
                                                <label id="adjustment_amount">0.00</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-sm-5">
                                                <label style="padding: .375rem .75rem;">Grand Total ($)</label>
                                            </div>
                                            <div class="col-sm-6 text-right pr-3">
                                            <input type="hidden" name="adjustment_value" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block"><input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                <span id="grand_total">0.00</span>
                                                <input type="hidden" name="grand_total" id="grand_total_input" value='0'>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                        </div>
                                    </div> -->
                                            <div class="row" style="background-color:white;font-size:16px;">
                                                <div class="col-md-7">
                                                </div>
                                                <div class="col-md-5">
                                                    <table class="table" style="text-align:left;">
                                                        <tr>
                                                            <td>Subtotal</td>
                                                            <td></td>
                                                            <td>$ <span id="item_total_text">0.00</span>
                                                                <input type="hidden" name="sub_total" id="item_total">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Taxes</td>
                                                            <td></td>
                                                            <td>$ <span id="total_tax_">0.00</span><input type="hidden"
                                                                    name="taxes" id="total_tax_input"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:250px;"><input type="text"
                                                                    name="adjustment_name" id="adjustment_name"
                                                                    placeholder="Adjustment Name" class="form-control"
                                                                    style="width:200px; display:inline; border: 1px dashed #d1d1d1">
                                                            </td>
                                                            <td style="width:150px;">
                                                                <input type="number" name="adjustment_value"
                                                                    id="adjustment_input" value="0"
                                                                    class="form-control adjustment_input"
                                                                    style="width:100px; display:inline-block">
                                                                <span class="fa fa-question-circle"
                                                                    data-toggle="popover" data-placement="top"
                                                                    data-trigger="hover"
                                                                    data-content="Optional it allows you to adjust the total amount Eg. +10 or -10."
                                                                    data-original-title="" title=""></span>
                                                            </td>
                                                            <td>0.00</td>
                                                        </tr>
                                                        <input type="hidden" name="markup_input_form"
                                                            id="markup_input_form" class="markup_input" value="0">
                                                        <tr style="color:blue;font-weight:bold;font-size:18px;">
                                                            <td><b>Grand Total ($)</b></td>
                                                            <td></td>
                                                            <td><b><span id="grand_total">0.00</span>
                                                                    <input type="hidden" name="grand_total"
                                                                        id="grand_total_input" value='0'></b></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row" style="background-color:white;">
                                        <div class="col-md-12">
                                            <h5>Request a Deposit</h5>
                                            <span class="help help-sm help-block">You can request an upfront payment on
                                                accept estimate.</span>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <select name="deposit_request_type" class="form-control">
                                                <option value="$" selected="selected">Deposit amount $</option>
                                                <option value="%">Percentage %</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="input-group">
                                                <input type="text" name="deposit_amount" value="0" class="form-control"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="background-color:white;">
                                        <div class="col-md-12">
                                            <h5>Payment Schedule</h5>
                                            <span class="help help-sm help-block">Split the balance into multiple
                                                payment milestones.</span>
                                            <p><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus-square"
                                                        aria-hidden="true"></i> Manage payment schedule </a></p>
                                        </div>
                                    </div>

                                    <div class="row" style="background-color:white;">
                                        <div class="col-md-12">
                                            <h5>Accepted payment methods</h5>
                                            <span class="help help-sm help-block">Select the payment methods that will
                                                appear on this invoice.</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                <input type="checkbox" name="credit_card_payments" value="1" checked
                                                    id="credit_card_payments">
                                                <label for="credit_card_payments"><span>Credit Card Payments
                                                        ()</span></label>
                                            </div>
                                            <span class="help help-sm help-block">Your client can pay your invoice using
                                                credit card or bank account online. You will be notified when your
                                                client makes a payment and the money will be transferred to your bank
                                                account automatically. </span>
                                            <div class="float-left mini-stat-img mr-4"><img
                                                    src="<?php echo $url->assets ?>frontend/images/credit_cards.png"
                                                    alt=""></div>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="help help-sm help-block">Your payment processor is not set up
                                                <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#modalNewCustomer">setup payment</a></span>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                <input type="checkbox" name="bank_transfer" value="1" checked
                                                    id="bank_transfer">
                                                <label for="bank_transfer"><span>Bank Transfer</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                <input type="checkbox" name="instapay" value="1" checked id="instapay">
                                                <label for="instapay"><span>Instapay</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                <input type="checkbox" name="check" value="1" checked id="check">
                                                <label for="check"><span>Check</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                <input type="checkbox" name="cash" value="1" checked id="cash">
                                                <label for="cash"><span>Cash</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                                <input type="checkbox" name="deposit" value="1" checked id="deposit">
                                                <label for="deposit"><span>Deposit</span></label>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="row" style="background-color:white;">
                                            <div class="col-md-12">
                                                <h5>Message to Customer</h5>
                                                <span class="help help-sm help-block">Add a message that will be
                                                    displayed on the invoice.</span>
                                                <textarea name="message_to_customer" cols="40" rows="2"
                                                    class="form-control">Thank you for your business.</textarea>
                                            </div>
                                            <br>
                                            <div class="col-md-12">
                                                <h5>Terms &amp; Conditions</h5>
                                                <span class="help help-sm help-block">Mention your company's T&amp;C
                                                    that will appear on the invoice.</span>
                                                <textarea name="terms_and_conditions" cols="40" rows="2"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="background-color:white;">
                                        <div class="col-md-12">
                                            <h5>Attachments</h5>
                                            <div class="help help-sm help-block margin-bottom-sec">Optionally attach
                                                files to this invoice. Allowed type: pdf, doc, docx, png, jpg, gif.
                                            </div>

                                            <ul class="attachments" data-fileupload="attachment-list">
                                            </ul>
                                            <script async="" src="https://www.google-analytics.com/analytics.js">
                                            </script>
                                            <script type="text/template" data-fileupload="attachment-list-template">
                                                <li data-attach-to-invoice="0">
                                            <a class="a-default" target="_blank" href="{{url}}"><span class="fa fa-{{icon}}"></span> {{name_original}}</a>
                                            <a class="attachments__delete a-default margin-left-sec" data-id="{{id}}" data-fileupload="attachment-delete" href="#"><span class="fa fa-trash-o icon"></span></a>
                                                        <input type="hidden" name="attachment_id[]" value="{{id}}">
                                                    </li>
                                        </script>
                                            <div class="alert alert-danger" data-fileupload="attachment-error"
                                                role="alert" style="display: none;"></div>
                                            <div class="" data-fileupload="attachment-progressbar"
                                                style="display: none;">
                                                <div class="text">Uploading</div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <span class="btn btn-default btn-md fileinput-button vertical-top"><span
                                                    class="fa fa-upload"></span> Upload File <input
                                                    data-fileupload="attachment-file" name="attachment-file"
                                                    type="file"></span>
                                        </div>
                                    </div>

                                    <div class="row" style="background-color:white;">
                                        <div class="col-md-12 form-group">
                                            <button class="btn btn-light but"
                                                style="border-radius: 0 !important;border:solid gray 1px;"
                                                data-action="update">Save as Draft</button>
                                            <button class="btn btn-success but" style="border-radius: 0 !important;"
                                                data-action="send">Preview</button>
                                            <a href="<?php echo url('invoice') ?>"
                                                class="btn but-red">cancel this</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>

                    <?php echo form_close(); ?>

                </div>

            </div>
        </div>
    </div>
    <!--    end of modal-->

    <!-- Modal -->
    <div class="modal fade" id="filterBY" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newcustomerLabel">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            Type
                            <select class="form-control">
                                <option>All Transactions</option>
                                <option>Estimates</option>
                                <option>Invoices</option>
                                <option>Sales Receipt</option>
                                <option>Credit Memo</option>
                                <option>Unbilled Income</option>
                                <option>Recently Paid</option>
                                <option>Money Received</option>
                                <option>Statements</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            Status
                            <select class="form-control">
                                <option>All Statuses</option>
                                <option>Open</option>
                                <option>Overdue</option>
                                <option>Paint</option>
                                <option>Pending</option>
                                <option>Accepted</option>
                                <option>Closed</option>
                                <option>Rejected</option>
                                <option>Expired</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            Delivery method
                            <select class="form-control">
                                <option>Any</option>
                                <option>Print Later</option>
                                <option>Send Later</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            Date
                            <select class="form-control">
                                <option>Last 365 Days</option>
                                <option>Custom</option>
                                <option>Today</option>
                                <option>Yesterday</option>
                                <option>This week</option>
                                <option>This Month</option>
                                <option>Recently Paid</option>
                                <option>This quarter</option>
                                <option>This year</option>
                                <option>Last Week</option>
                                <option>Last Month</option>
                                <option>Last quarter</option>
                                <option>Last Year</option>
                                <option>All dates</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            From
                            <input type="text" class="form-control" id="filter_from">
                        </div>
                        <div class="col-md-3">
                            To
                            <input type="text" class="form-control" id="filter_to">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            Customer
                            <select class="form-control">
                                <option>All</option>
                                <?php foreach ($customers as $customer):?>
                                <option
                                    value="<?php echo $customer->prof_id?>">
                                    <?php echo $customer->first_name."&nbsp;".$customer->last_name;?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-detail">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Reset</button>
                    </div>
                    <div class="button-modal-list" style="float:left !important;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                class="fa fa-remove"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Service Address -->
    <div class="modal fade" id="modalServiceAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal New Customer -->
    <div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0 pl-3 pb-3"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--    Modal for creating rules-->
    <div class="modal-right-side">
        <div class="modal right fade" id="createTagGroup" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel2">Create New Group</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body pt-3">
                        <!-- <div class="subheader">Rules only apply to unreviewed transactions.</div> -->
                        <form class="mb-3" id="tags_group_form">
                            <div class="form-row mb-3">
                                <div class="col-md-8">
                                    <label for="tag-group-name">Group name</label>
                                    <input type="text" name="tags_group_name" id="tag-group-name" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">&nbsp;</label>
                                    <select id="e2" class="form-control" name="group_color"
                                        style="background-color: green; color: white">
                                        <option value="green" style="background-color:green">Green</option>
                                        <option value="yellow" style="background-color:yellow; color: black">Yellow
                                        </option>
                                        <option value="red" style="background-color:red">Red</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Save</button>
                        </form>
                        <table id="tags-group" class="table table-bordered mb-3 hide">
                            <tbody></tbody>
                        </table>
                        <h6>Add tags to this group</h6>
                        <form class="mb-3" id="tags_form">
                            <div class="form-row mb-3">
                                <div class="col-md-8">
                                    <label for="tag_name">Tag name</label>
                                    <input type="text" name="tag_name" id="tag_name" class="form-control">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button class="btn btn-success w-100">Add</button>
                                </div>
                            </div>
                        </form>
                        <table id="group-tags" class="table table-bordered mb-3 hide">
                            <tbody></tbody>
                        </table>
                        <hr>
                        <div class="form-group">
                            <label for="" style="position: relative;display: inline-block;">Put similar tags in the same
                                group to get better reports. <a href="#">Find out more</a></label>
                            <p><a href="#">Show me examples of groups</a></p>
                        </div>
                        <div class="form-group modaldivision">
                            <div class="row">
                                <div class="col-md-6">
                                    I have a clothing store. I want to see which seasonal collection sells the best.
                                </div>
                                <div class="col-md-6">
                                    Group: Collection
                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                        <div class="sc-krvtoX bjibjm">
                                            <div class="sc-fYiAbW etmaub">
                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Collection</span>:
                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Spring</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                        <div class="sc-krvtoX bjibjm">
                                            <div class="sc-fYiAbW etmaub">
                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Collection</span>:
                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Summer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group modaldivision">
                            <div class="row">
                                <div class="col-md-6">
                                    I run a gym. I want to see which fitness classes and instructors make the most
                                    money.
                                </div>
                                <div class="col-md-6">
                                    <p>Group: Fitness class</p>
                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                        <div class="sc-krvtoX bjibjm">
                                            <div class="sc-fYiAbW etmaub">
                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>:
                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Yoga</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                        <div class="sc-krvtoX bjibjm">
                                            <div class="sc-fYiAbW etmaub">
                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>:
                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Rowing</span>
                                            </div>
                                        </div>
                                    </div>

                                    <p>Group: Instructor</p>
                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                        <div class="sc-krvtoX bjibjm">
                                            <div class="sc-fYiAbW etmaub">
                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>:
                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Daniel</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                        <div class="sc-krvtoX bjibjm">
                                            <div class="sc-fYiAbW etmaub">
                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>:
                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Maria</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    end of modal-->



    <div class="modal right fade" id="tags-modal" tabindex="-1" role="dialog" aria-labelledby="tags-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="tags-list">
                <div class="modal-header">
                    <h4 class="modal-title">Manage your tags</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="row">
                        <div class="col-6 d-flex">
                            <button type="button" class="btn btn-outline-secondary m-auto"
                                onclick="getTagForm({}, 'create')">Create Tag</button>
                        </div>
                        <div class="col-6 d-flex">
                            <button type="button" class="btn btn-outline-secondary m-auto"
                                onclick="getGroupTagForm()">Create Group</button>
                        </div>
                        <div class="col-12 py-3">
                            <input type="text" name="search_tag" id="search-tag" class="form-control"
                                placeholder="Find tag by name">
                        </div>
                        <div class="col-12">
                            <table id="tags-table" class="table table-bordered table-hover">
                                <thead>
                                    <th>Tags</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Source</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_add_new_source" name="modal-form" method="post">
                        <div class="validation-error" style="display: none;"></div>
                        <div class="form-group">
                            <label>Source Name</label> <span class="form-required">*</span>
                            <input type="text" name="title" value="" class="form-control" autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <!-- </div> -->

    <div class="modal fade bd-example-modal-lgallsales" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0 pl-3 pb-3">
                    <table id="items_table_newWorkorder" class="table table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <td> Name</td>
                                <td> Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($packages as $package) { // print_r($item);?>
                            <tr>
                                <td><?php echo $package->name; ?>
                                </td>
                                <td>
                                    <button
                                        id="<?= $package->item_categories_id ; ?>"
                                        type="button" data-dismiss="modal"
                                        class="btn btn-sm btn-default select_package"><span class="fa fa-plus"></span>
                                    </button>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="item_list_allsales" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="items_table_estimate" class="table table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td> Name</td>
                                        <td> Rebatable</td>
                                        <td> Qty</td>
                                        <td> Price</td>
                                        <td> Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item) { // print_r($item);?>
                                    <tr>
                                        <td><?php echo $item->title; ?>
                                        </td>
                                        <td><?php if ($item->rebate == 1) { ?>
                                            <!-- <label class="switch">
                                                    <input type="checkbox" id="rebatable_toggle" checked>
                                                    <span class="slider round"></span> -->
                                            <input type="checkbox" class="toggle_checkbox" id="rebatable_toggle"
                                                item-id="<?php echo $item->id; ?>"
                                                value="1" data-toggle="toggle" data-size="xs" checked>
                                            </label>
                                            <?php } else { ?>
                                            <!-- <label class="switch">
                                                    <input type="checkbox">
                                                    <span class="slider round"></span>
                                                    </label> -->

                                            <!-- <input type="checkbox" data-toggle="toggle" data-size="xs"> -->
                                            <input type="checkbox" class="toggle_checkbox" id="rebatable_toggle"
                                                item-id="<?php echo $item->id; ?>"
                                                value="0" data-toggle="toggle" data-size="xs">

                                            <?php  } ?>
                                        </td>
                                        <td></td>
                                        <td><?php echo $item->price; ?>
                                        </td>
                                        <td><button
                                                id="<?= $item->id; ?>"
                                                data-quantity="<?= $item->units; ?>"
                                                data-itemname="<?= $item->title; ?>"
                                                data-price="<?= $item->price; ?>"
                                                type="button" data-dismiss="modal"
                                                class="btn btn-sm btn-default select_item">
                                                <span class="fa fa-plus"></span>
                                            </button></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-detail">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                class="fa fa-remove"></span> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    Create Invoice Modal-->
    <div class="full-screen-modal">
        <div id="receive-payment" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Receive Payment<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeReceivePaymentModal"><i
                                class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Customer</label>
                                    <input type="hidden" name="check_id" id="checkID" value="">
                                    <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                    <input type="hidden" id="checkType" class="expenseType" value="Check">
                                    <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                        <option>Select a customer</option>
                                        <?php foreach ($vendors as $vendor):?>
                                        <option
                                            value="<?php echo $vendor->vendor_id?>">
                                            <?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-default">Find by invoice no.</button>
                                    <p>Don't have an invoice? <a href="#">Create new sale</a></p>
                                </div>

                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-2">
                                    <label for="">Payment Date</label>
                                    <input type="date" name="payment_date" id="payment_date" class="form-control">
                                </div>
                            </div>

                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-2">
                                    <label for="">Payment method </label>
                                    <select name="terms" id="billTerms" class="form-control select2-bill-terms">
                                        <option></option>
                                        <option>Cash</option>
                                        <option>Check</option>
                                        <option>Credit Card</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Referene no.</label>
                                        <input type="text" name="reference_num" id="reference_num" class="form-control"
                                            value="1">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Deposit to</label>
                                    <select name="terms" id="billTerms" class="form-control select2-bill-terms">
                                        <option></option>
                                        <option>Due on receipt</option>
                                        <option>Net 15</option>
                                        <option>Net 30</option>
                                        <option>Net 60</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Amount received</label>
                                        <input type="text" name="amoun_received" id="amoun_received"
                                            class="form-control" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Memo</label>
                                <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="Note"
                                    style="width: 350px;resize: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                        <span>Maximum size: 20MB</span>
                                        <div id="checkAttachment" class="dropzone"
                                            style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                            <div class="dz-message" style="margin: 20px;">
                                                <span
                                                    style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag
                                                    and drop files here or</span>
                                                <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="padding-top: 30px;">
                                        <div class="file-container-list" id="file-list-check"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="show-existing-file">
                                    <a href="#" id="showExistingFile">Show existing file</a>
                                </div>
                            </div>
                            <div class="privacy">
                                <a href="#">Privacy</a>
                            </div>
                        </div>
                        <div class="modal-footer-check">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                        type="button">Cancel</button>

                                </div>
                                <div class="col-md-5">
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
                                        <button type="button" class="btn btn-success" data-dismiss="modal"
                                            id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
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
                </div>

            </div>
        </div>
    </div>
    <!--    end of modal-->
    <!--    Create Estimate Modal-->
    <div class="full-screen-modal">
        <div id="add-estimate" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Estimate<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeAddEstimateModal"><i
                                class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Customer</label>
                                    <input type="hidden" name="check_id" id="checkID" value="">
                                    <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                    <input type="hidden" id="checkType" class="expenseType" value="Check">
                                    <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                        <option>Select a customer</option>
                                        <?php foreach ($vendors as $vendor):?>
                                        <option
                                            value="<?php echo $vendor->vendor_id?>">
                                            <?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Customer Email</label>
                                    <input type="text" class="form-control" placeholder="Separate emails with a comma">

                                    <div class="form-group mt-2">
                                        <input type="checkbox" name="send_later" id="send_later" value="1">
                                        <label for="">Send later</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3" style="text-align: right">
                                    <div>AMOUNT</div>
                                    <div>
                                        <h1 id="h1_amount-check">$0.00</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-3">
                                    <label for="">Billing address</label>
                                    <textarea name="billing_address" id="billing_address" cols="30" rows="4"
                                        placeholder="" style="resize: none;"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Estimate Date</label>
                                    <input type="date" name="estimate_date" id="estimate_date" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Expiration Date</label>
                                    <input type="date" name="invoice_date" id="expiration_date" class="form-control">
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Location of sale</label>
                                        <input type="text" name="location_sale" id="location_sale" class="form-control"
                                            value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="table-container mt-5">
                                <div class="table-loader">
                                    <p class="loading-text">Loading records</p>
                                </div>
                                <!--                        DataTables-->
                                <table id="expensesCheckTable" class="table table-striped table-bordered"
                                    style="width:100%;margin-top: 20px;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>PRODUCT/SERVICE</th>
                                            <th>DESCRIPTION</th>
                                            <th>QTY</th>
                                            <th>RATE</th>
                                            <th>AMOUNT</th>
                                            <th>TAX</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-check">
                                        <tr id="tableLine">
                                            <td></td>
                                            <td><span id="line-counter">1</span></td>
                                            <td>
                                                <div id="" style="display:none;">
                                                    <input type="hidden" id="prevent_process" value="true">
                                                    <select name="category[]" id=""
                                                        class="form-control checkCategory select2-check-category">
                                                        <option></option>
                                                        <?php foreach ($list_categories as $list): ?>
                                                        <option
                                                            value="<?php echo $list->id?>">
                                                            <?php echo $list->category_name;?>
                                                        </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><input type="text" name="description[]"
                                                    class="form-control checkDescription" id="tbl-input"
                                                    style="display: none;"></td>
                                            <td><input type="text" name="qty[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="rate[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="amount[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="tax[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td style="text-align: center"><a href="#" id="delete-line-row"><i
                                                        class="fa fa-trash"></i></a></td>
                                        </tr>
                                        <tr id="tableLine">
                                            <td></td>
                                            <td><span id="line-counter">2</span></td>
                                            <td>
                                                <div id="" style="display:none;">
                                                    <input type="hidden" id="prevent_process" value="true">
                                                    <select name="category[]" id=""
                                                        class="form-control checkCategory select2-check-category">
                                                        <option></option>
                                                        <?php foreach ($list_categories as $list): ?>
                                                        <option
                                                            value="<?php echo $list->id?>">
                                                            <?php echo $list->category_name;?>
                                                        </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><input type="text" name="description[]"
                                                    class="form-control checkDescription" id="tbl-input"
                                                    style="display: none;"></td>
                                            <td><input type="text" name="qty[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="rate[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="amount[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="tax[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td style="text-align: center"><a href="#" id="delete-line-row"><i
                                                        class="fa fa-trash"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="addAndRemoveRow">
                                <div class="total-amount-container">
                                    <p>
                                        <span style="margin-right: 200px;font-size: 20px">Subtotal</span>
                                        $<span id="total-amount-check">0.00</span>
                                    </p>
                                    <p>
                                        <span style="margin-right: 200px;font-size: 20px">Taxable subtotal $0.00</span>
                                    </p>
                                    <p>
                                        <span style="margin-right: 200px;font-size: 20px">Total</span>
                                        $<span id="total-amount-check">0.00</span>
                                    </p>
                                    <p>
                                        <span style="margin-right: 200px;font-size: 20px">Balance due</span>
                                        $ 0.00
                                    </p>
                                </div>
                                <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                                <button type="button" class="add-remove-line" id="clear-all-line">Clear all
                                    lines</button>
                            </div>
                            <div class="form-group">
                                <label for="">Message displayed on estimate</label>
                                <textarea name="name" id="checkMemo" cols="30" rows="3"
                                    placeholder="This will show up on the invoice"
                                    style="width: 350px;resize: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Message displated on statement</label>
                                <textarea name="name" id="checkMemo" cols="30" rows="3"
                                    placeholder="If you convert an estimate into an invoice and send a statement, this will show up as the description for the invoice."
                                    style="width: 350px;resize: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                        <span>Maximum size: 20MB</span>
                                        <div id="checkAttachment" class="dropzone"
                                            style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                            <div class="dz-message" style="margin: 20px;">
                                                <span
                                                    style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag
                                                    and drop files here or</span>
                                                <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="padding-top: 30px;">
                                        <div class="file-container-list" id="file-list-check"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="show-existing-file">
                                    <a href="#" id="showExistingFile">Show existing file</a>
                                </div>
                            </div>
                            <div class="privacy">
                                <a href="#">Privacy</a>
                            </div>
                        </div>
                        <div class="modal-footer-check">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                        type="button">Cancel</button>

                                </div>
                                <div class="col-md-5">
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
                                        <button type="button" class="btn btn-success" data-dismiss="modal"
                                            id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
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
                </div>

            </div>
        </div>
    </div>
    <!--    end of modal-->
    <!--    Create Sales Receipt Modal-->
    <div class="full-screen-modal">
        <div id="sales-receipt" class="all_sales_modal modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Sales Receipt<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeSalesReceiptModal"><i
                                class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Customer</label>
                                    <input type="hidden" name="check_id" id="checkID" value="">
                                    <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                    <input type="hidden" id="checkType" class="expenseType" value="Check">
                                    <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                        <option>Select a customer</option>
                                        <?php foreach ($vendors as $vendor):?>
                                        <option
                                            value="<?php echo $vendor->vendor_id?>">
                                            <?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Customer Email</label>
                                    <input type="text" class="form-control" placeholder="Separate emails with a comma">

                                    <div class="form-group mt-2">
                                        <input type="checkbox" name="send_later" id="send_later" value="1">
                                        <label for="">Send later</label>
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: right">
                                    <div>AMOUNT</div>
                                    <div>
                                        <h1 id="h1_amount-check">$0.00</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-3">
                                    <label for="">Billing address</label>
                                    <textarea name="billing_address" id="billing_address" cols="30" rows="4"
                                        placeholder="" style="resize: none;"></textarea>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="">Sales Receipt Date</label>
                                            <input type="date" name="sales_receipt_date" id="sales_receipt_date"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <label for="">Ship Via</label>
                                            <input type="text" name="ship_via" id="ship_via" class="form-control">
                                        </div>
                                        <div class="col-4">
                                            <label for="">Shipping Date</label>
                                            <input type="date" name="shipping_date" id="shipping_date"
                                                class="form-control">
                                        </div>
                                        <div class="col-4">
                                            <label for="">Tracking No.</label>
                                            <input type="text" name="tracking_no" id="tracking_no" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Location of sale</label>
                                    <input type="text" name="location_sale" id="location_sale" class="form-control"
                                        value="1">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-3">
                                    <label for="">Shipping to</label>
                                    <textarea name="shipping_to_address" id="shipping_to_address" cols="30" rows="4"
                                        placeholder="" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-2">
                                    <label for="">Payment method</label>
                                    <select name="payment_method" id="payment_method"
                                        class="form-control select2-bill-terms">
                                        <option></option>
                                        <option>Cash</option>
                                        <option>Check</option>
                                        <option>Credit Card</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Referene No.</label>
                                    <input type="text" name="reference_no" id="reference_no" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Deposit to</label>
                                    <select name="payment_method" id="payment_method"
                                        class="form-control select2-bill-terms">
                                        <option></option>
                                        <option>Cash on hand</option>
                                        <option>Corporate Account</option>
                                        <option>Inventory Asset</option>
                                        <option>Payroll Refunds</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-container mt-5">
                                <div class="table-loader">
                                    <p class="loading-text">Loading records</p>
                                </div>
                                <!--                        DataTables-->
                                <table id="expensesCheckTable" class="table table-striped table-bordered"
                                    style="width:100%;margin-top: 20px;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>PRODUCT/SERVICE</th>
                                            <th>DESCRIPTION</th>
                                            <th>QTY</th>
                                            <th>RATE</th>
                                            <th>AMOUNT</th>
                                            <th>TAX</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="line-container-check">
                                        <tr id="tableLine">
                                            <td></td>
                                            <td><span id="line-counter">1</span></td>
                                            <td>
                                                <div id="" style="display:none;">
                                                    <input type="hidden" id="prevent_process" value="true">
                                                    <select name="category[]" id=""
                                                        class="form-control checkCategory select2-check-category">
                                                        <option></option>
                                                        <?php foreach ($list_categories as $list): ?>
                                                        <option
                                                            value="<?php echo $list->id?>">
                                                            <?php echo $list->category_name;?>
                                                        </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><input type="text" name="description[]"
                                                    class="form-control checkDescription" id="tbl-input"
                                                    style="display: none;"></td>
                                            <td><input type="text" name="qty[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="rate[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="amount[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="tax[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td style="text-align: center"><a href="#" id="delete-line-row"><i
                                                        class="fa fa-trash"></i></a></td>
                                        </tr>
                                        <tr id="tableLine">
                                            <td></td>
                                            <td><span id="line-counter">2</span></td>
                                            <td>
                                                <div id="" style="display:none;">
                                                    <input type="hidden" id="prevent_process" value="true">
                                                    <select name="category[]" id=""
                                                        class="form-control checkCategory select2-check-category">
                                                        <option></option>
                                                        <?php foreach ($list_categories as $list): ?>
                                                        <option
                                                            value="<?php echo $list->id?>">
                                                            <?php echo $list->category_name;?>
                                                        </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td><input type="text" name="description[]"
                                                    class="form-control checkDescription" id="tbl-input"
                                                    style="display: none;"></td>
                                            <td><input type="text" name="qty[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="rate[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="amount[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td><input type="text" name="tax[]" class="form-control checkAmount"
                                                    id="tbl-input" style="display: none;"></td>
                                            <td style="text-align: center"><a href="#" id="delete-line-row"><i
                                                        class="fa fa-trash"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="addAndRemoveRow">
                                <div class="total-amount-container">
                                    <p>
                                        <span style="margin-right: 200px;font-size: 20px">Subtotal</span>
                                        $<span id="total-amount-check">0.00</span>
                                    </p>
                                    <p>
                                        <span style="margin-right: 200px;font-size: 20px">Taxable subtotal $0.00</span>
                                    </p>
                                    <p>
                                        <span style="margin-right: 200px;font-size: 20px">Total</span>
                                        $<span id="total-amount-check">0.00</span>
                                    </p>
                                    <p>
                                        <span style="margin-right: 200px;font-size: 20px">Balance due</span>
                                        $ 0.00
                                    </p>
                                </div>
                                <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                                <button type="button" class="add-remove-line" id="clear-all-line">Clear all
                                    lines</button>
                            </div>
                            <div class="form-group">
                                <label for="">Message displayed on sales receipt</label>
                                <textarea name="name" id="checkMemo" cols="30" rows="3"
                                    placeholder="This will show up on the invoice"
                                    style="width: 350px;resize: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Message displayed on statement</label>
                                <textarea name="name" id="checkMemo" cols="30" rows="3"
                                    placeholder="If you send statements to customers, this will show up as the description for this invoice."
                                    style="width: 350px;resize: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                        <span>Maximum size: 20MB</span>
                                        <div id="checkAttachment" class="dropzone"
                                            style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                            <div class="dz-message" style="margin: 20px;">
                                                <span
                                                    style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag
                                                    and drop files here or</span>
                                                <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="padding-top: 30px;">
                                        <div class="file-container-list" id="file-list-check"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="show-existing-file">
                                    <a href="#" id="showExistingFile">Show existing file</a>
                                </div>
                            </div>
                            <div class="privacy">
                                <a href="#">Privacy</a>
                            </div>
                        </div>
                        <div class="modal-footer-check">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                        type="button">Cancel</button>

                                </div>
                                <div class="col-md-5">
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
                                        <button type="button" class="btn btn-success" data-dismiss="modal"
                                            id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
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
                </div>

            </div>
        </div>
    </div>
    <!--    end of modal-->
    <!--    Create Credit Memo Modal-->
    <div class="full-screen-modal">
        <div id="credit-memo" class="all_sales_modal modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <div class="modal-title">
                    <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                    Credit Memo
                </div>
                <button type="button" class="close" id="closeModalExpense" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form action="<?php echo site_url()?>accounting/addCreditMemo" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Customer
                                        <select class="form-control" name="customer_id" id="sel-customer">
                                            <option></option>
                                            <?php foreach($customers as $customer) : ?>
                                                <option value="<?php echo $customer->prof_id; ?>"><?php echo $customer->first_name . ' ' . $customer->last_name; ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        Email
                                        <input type="email" class="form-control" name="email"  id="email">
                                        <input type="checkbox"> Send later
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        Billing address
                                        <textarea style="height:100px;width:100%;" name="billing_address" id="billing_address"></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        Credit Memo Date<br>
                                        <input type="text" class="form-control" id="datepickerinv7" name="credit_memo_date">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="col-md-6" align="right">
                                AMOUNT<h2><span id="grand_total_cm_t">0.00</span></h2><br>
                                Location of sale<br>
                                <input type="text" class="form-control" style="width:200px;" name="location_scale">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="reportstable">
                                    <thead>
                                        <!-- <th></th>
                                        <th>#</th>
                                        <th>PRODUCT/SERVICE</th>
                                        <th>DESCRIPTION</th>
                                        <th>QTY</th>
                                        <th>RATE</th>
                                        <th>AMOUNT</th>
                                        <th>TAX</th>
                                        <th></th> -->
                                        <th>Name</th>
                                                <th>Type</th>
                                                <!-- <th>Description</th> -->
                                                <th width="150px">Quantity</th>
                                                <!-- <th>Location</th> -->
                                                <th width="150px">Price</th>
                                                <th width="150px">Discount</th>
                                                <th width="150px">Tax (Change in %)</th>
                                                <th>Total</th>
                                    </thead>
                                    <tbody id="items_table_body_credit_memo">
                                    <tr>
                                                <td>
                                                    <input type="text" class="form-control getItemsCM"
                                                        onKeyup="getItemscm(this)" name="items[]">
                                                    <ul class="suggestions"></ul>
                                                </td>
                                                <td><select name="item_type[]" class="form-control">
                                                        <option value="product">Product</option>
                                                        <option value="material">Material</option>
                                                        <option value="service">Service</option>
                                                        <option value="fee">Fee</option>
                                                    </select></td>
                                                <td width="150px"><input type="number" class="form-control quantitycm" name="quantity[]"
                                                        data-counter="0" id="quantity_0" value="1"></td>
                                                <td width="150px"><input type="number" class="form-control pricecm" name="price[]"
                                                        data-counter="0" id="price_0" min="0" value="0"></td>
                                                <td width="150px"><input type="number" class="form-control discountcm" name="discount[]"
                                                        data-counter="0" id="discount_0" min="0" value="0" ></td>
                                                <td width="150px"><input type="text" class="form-control tax_change" name="tax[]"
                                                        data-counter="0" id="tax1_0" min="0" value="0">
                                                        <!-- <span id="span_tax_0">0.0</span> -->
                                                        </td>
                                                <td width="150px"><input type="hidden" class="form-control " name="total[]"
                                                        data-counter="0" id="item_total_0" min="0" value="0">
                                                        $<span id="span_total_0">0.00</span></td>
                                            </tr>
                                    </tr>
                                    </tbody>
                                </table>
                            <div>
                        </div>
                        <hr>
                    
                        <div class="row">
                            <div class="col-md-1">
                            <!-- <button class="btn1">Add lines</button> -->
                            <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                            </div>
                            <!-- <div class="col-md-1">
                            <button class="btn1">Clear all lines</button>
                            </div>
                            <div class="col-md-1">
                            <button class="btn1">Add subtotal</button>
                            </div>
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-1">
                                <b>Subtotal</b>
                            </div>
                            <div class="col-md-1">
                                <b>$0.00</b>
                            </div> -->
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-3">
                                Message on invoice<br>
                                <textarea style="height:100px;width:100%;" name="message_displayed_on_credit_memo"></textarea><br>
                                Message on statement<br>
                                <textarea style="height:100px;width:100%;" name="message_on_statement"></textarea>
                            </div>
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-4">
                                <!-- Taxable subtotal <b>$0.00</b><br>
                                <table class="table table-borderless">
                                    <tr>
                                        <td>
                                            <select class="form-control" name="tax_rate">
                                                <option value="1">Based on location</option>
                                            </select>
                                        </td>
                                        <td><b>$0.00</b><br><a href="">See the math</a></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Tax on shipping</td>
                                        <td>0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Balance due</td>
                                        <td>$0.00</td>
                                    </tr>
                                </table> -->

                                <table class="table" style="text-align:left;">
                                            <tr>
                                                <td>Subtotal</td>
                                                <td></td>
                                                <td align="right">$ <span id="span_sub_total_cm">0.00</span>
                                                    <input type="hidden" name="subtotal" id="item_total"></td>
                                            </tr>
                                            <tr>
                                                <td>Taxes</td>
                                                <td></td>
                                                <td align="right">$ <span id="total_tax_">0.00</span><input type="hidden" name="taxes" id="total_tax_input"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:250px;"><input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1"></td>
                                                <td style="width:150px;">
                                                <input type="number" name="adjustment_value" id="adjustment_input_cm" value="0" class="form-control adjustment_input_cm_c" style="width:100px; display:inline-block">
                                                    <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                </td>
                                                <td align="right">$<span id="adjustment_area">0.00</span></td>
                                            </tr>
                                            <!-- <tr>
                                                <td>Markup $<span id="span_markup"></td> -->
                                                <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                                <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                            <!-- </tr> -->
                                            <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                                <td>Amount Saved</td>
                                                <td></td>
                                                <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input"></td>
                                            </tr>
                                            <tr style="color:blue;font-weight:bold;font-size:18px;">
                                                <td><b>Grand Total ($)</b></td>
                                                <td></td>
                                                <td align="right"><b><span id="grand_total_cm">0.00</span>
                                                    <input type="hidden" name="grand_total" id="grand_total_input" value='0'></b></td>
                                            </tr>
                                        </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="file-upload">
                                    <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                        <div class="drag-text">
                                        <i>Drag and drop files here or click the icon</i>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded File</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                            </div>
                        </div>
                    </div>
                            <hr>
                            <div class="modal-footer-check">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                        
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
                                            <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                            <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                                <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                </form>

                <!-- Modal -->
                <div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document" style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="items_table_credit_memo" class="table table-hover" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <td> Name</td>
                                                <td> Qty</td>
                                                <td> Price</td>
                                                <td> Action</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($items as $item){ // print_r($item); ?>
                                                <tr>
                                                    <td><?php echo $item->title; ?></td>
                                                    <td></td>
                                                    <td><?php echo $item->price; ?></td>
                                                    <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_itemcm">
                                                    <span class="fa fa-plus"></span>

                                                </button></td>
                                                </tr>
                                                
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    <div style="margin: auto;">
                        <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                    </div>
                    <div style="margin: auto">
                        <a href="" style="text-align: center">Privacy</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--    end of modal-->
    <!--    Create Delayed Charge Modal-->
    <div class="full-screen-modal">
        <div id="delayed-charge" class="all_sales_modal modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Delayed Charge<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeDelayedChargeModal"><i
                                class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    Customer
                                    <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                        <option value="0">- none -</option>
                                        <?php foreach($customers as $c){ ?>
                                            <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    Delayed Credit date<br>
                                    <input type="text" class="form-control" name="charge_date" id="datepickerinv12">
                                </div>                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    Tags <a href="#" style="float:right">Manage tags</a>
                                    <input type="text" class="form-control" name="tags">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6" align="right">
                            AMOUNT<h2><span id="grand_total_dch_total">0.00</span></h2><br>
                            <input type="hidden" name="grand_total_amount" id="grand_total_dc_total_val_dc">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-bordered" id="reportstable">
                                <thead>
                                    <!-- <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
                                    <th></th> -->
                                    <th>Name</th>
                                            <th>Type</th>
                                            <!-- <th>Description</th> -->
                                            <th width="150px">Quantity</th>
                                            <!-- <th>Location</th> -->
                                            <th width="150px">Price</th>
                                            <th width="150px">Discount</th>
                                            <th width="150px">Tax (Change in %)</th>
                                            <th>Total</th>
                                </thead>
                                <tbody id="items_table_body_delayed_charge">
                                <tr>
                                            <td>
                                                <input type="text" class="form-control getItemCharge"
                                                       onKeyup="getItemCharge_k(this)" name="items[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="product">Product</option>
                                                    <option value="material">Material</option>
                                                    <option value="service">Service</option>
                                                    <option value="fee">Fee</option>
                                                </select></td>
                                            <td width="150px"><input type="number" class="form-control quantitydch" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <td width="150px"><input type="number" class="form-control pricedch" name="price[]"
                                                       data-counter="0" id="price_dch_0" min="0" value="0"></td>
                                            <td width="150px"><input type="number" class="form-control discountdch" name="discount[]"
                                                       data-counter="0" id="discount_dch_0" min="0" value="0" ></td>
                                            <td width="150px"><input type="text" class="form-control tax_change" name="tax[]"
                                                       data-counter="0" id="tax1_dch_0" min="0" value="0">
                                                       <!-- <span id="span_tax_0">0.0</span> -->
                                                       </td>
                                            <td width="150px"><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_dch_0" min="0" value="0">
                                                       $<span id="span_total_charge_0">0.00</span></td>
                                        </tr>
                                </tr>
                                </tbody>
                            </table>
                            </table>
                        <div>
                    </div>
                    <hr>
                
                    <div class="row">
                        <div class="col-md-1">
                           <!-- <button class="btn1">Add lines</button> -->
                           <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list_delayed_charge"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                        </div>

                                        <input type="hidden" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1">
                                        <input type="hidden" name="adjustment_value" id="adjustment_input_dch" value="0" class="form-control adjustment_input_dch" style="width:100px; display:inline-block">
                                        <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                        <input type="hidden" name="voucher_value" id="offer_cost_input">
                                        <input type="hidden" name="grand_total" id="grand_total_dch" value='0'>
                        <!-- <div class="col-md-1">
                           <button class="btn1">Clear all lines</button>
                        </div>
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-1">
                            <b>Subtotal</b>
                        </div>
                        <div class="col-md-1">
                            <b><input type="text" class="form-control" style="font-size:36px;border: 0px;background: transparent;text-align:right;" name="sub_total" value="0.00" readonly></b>
                        </div> -->
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-2">
                            Memo<br>
                            <textarea style="height:100px;width:100%;" name="memo"></textarea><br>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                                    <div class="drag-text">
                                    <i>Drag and drop files here or click the icon</i>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded File</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                        </div>
                    </div>
                    <hr>


                </div>
                        <div class="modal-footer-check">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                        type="button">Cancel</button>

                                </div>
                                <div class="col-md-5">
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
                                        <button type="button" class="btn btn-success" data-dismiss="modal"
                                            id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
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
                </div>

            </div>
        </div>
    </div>
    <!--    end of modal-->
    <!--    Create Time Activity Modal-->
    <div class="full-screen-modal">
        <div id="sales-time-activity" class="all_sales_modal modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content h-100">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Time Activity<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeSalesTimeActivityModal"><i
                                class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <table class="form-inline-group">
                                        <tr>
                                            <td><label for="">Date</label></td>
                                            <td>
                                                <input type="date" name="date" class="form-inline" style="width: 45%">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Name</label></td>
                                            <td>
                                                <input type="text" name="name" class="form-inline">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Customer</label></td>
                                            <td>
                                                <input type="text" name="customer" class="form-inline">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Service</label></td>
                                            <td>
                                                <select name="service" id="" class="form-inline">
                                                    <option disabled selected>Chose the service worked on</option>
                                                    <option>Credit</option>
                                                    <option>Discount</option>
                                                    <option>Hours</option>
                                                    <option>Installation</option>
                                                    <option>Labor</option>
                                                    <option>Material</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="checkbox" id="billable" value="1">
                                                <span>Billable (/hr)</span>
                                                <input type="hidden" class="form-control" name="billable"
                                                    id="hideTextBox"
                                                    style="display: inline-block; width: 60px;height: 36px">
                                                <div style="display: none;" id="hideTaxable">
                                                    <input type="checkbox" name="taxable">
                                                    <span>Taxable</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-5">
                                    <table class="form-inline-group">
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="checkbox" name="start_end_times" id="start_end_times"
                                                    value="1">
                                                <span>Enter Start and End Times</span>
                                            </td>
                                        </tr>
                                        <tr id="timeRow">
                                            <td><label for="">Time</label></td>
                                            <td>
                                                <input type="time" name="time" class="form-inline" id="time"
                                                    placeholder="hh:mm" style="width: 35%">

                                            </td>
                                        </tr>
                                        <tr id="startEndRow" style="display: none;">
                                            <td><label for="">Time</label></td>
                                            <td>
                                                <div>
                                                    <input type="time" name="start_time" class="form-control"
                                                        style="width: 25%;display: inline-block;margin-bottom: 10px">
                                                    <span>Start time</span>
                                                </div>
                                                <div>
                                                    <input type="time" name="end_time" class="form-control"
                                                        style="width: 25%;display: inline-block;margin-bottom: 10px">
                                                    <span>End time</span>
                                                </div>
                                                <div>
                                                    <input type="time" name="break" class="form-control"
                                                        style="width: 30%;display: inline-block;" placeholder="hh:mm">
                                                    <span>Break</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="">Description</label></td>
                                            <td>
                                                <textarea name="description" id="" cols="60" rows="5"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-2"></div>
                            </div>

                            <div class="privacy">
                                <a href="#">Privacy</a>
                            </div>
                        </div>
                </div>
                <div class="modal-footer-check">
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                type="button">Cancel</button>

                        </div>
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-3">
                            <div class="dropdown" style="float: right">
                                <button class="btn btn-dark px-4" type="submit">Save</button>
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
            </div>

        </div>
    </div>
</div>
<!--    end of modal-->

<div class="modal fade" id="newEstimateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Estimate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body text-center">
        <p class="text-lg margin-bottom">
            What type of estimate you want to create
        </p>
        <div class="margin-bottom">
            <div class="help help-sm">Create a regular estimate with items</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('estimate/add') ?>"><span
                class="fa fa-file-text-o"></span> Standard Estimate</a>
        </div>
        <div class="margin-bottom">
            <div class="help help-sm">Customers can select all or only certain options</div>
            <a class="btn btn-primary add-modal__btn-primary"
                href="<?php echo base_url('estimate/add?type=2') ?>"><span
                    class="fa fa-list-ul fa-margin-right"></span> Options Estimate</a>
        </div>
        <div>
            <div class="help help-sm">Customers can select only one package</div>
            <a class="btn btn-primary add-modal__btn-primary"
                href="<?php echo base_url('estimate/add?type=3') ?>"><span
                    class="fa fa-cubes"></span> Packages Estimate</a>
        </div>
    </div> -->
    <div class="modal-body text-center">
        <p class="text-lg margin-bottom">
            What type of estimate you want to create
        </p>
        <center>
            <div class="margin-bottom text-center" style="width:60%;">
                <div class="help help-sm">Create a regular estimate with items</div>
                <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important"
                    href="<?php echo base_url('estimate/add') ?>"><span
                        class="fa fa-file-text-o"></span> Standard Estimate</a>
            </div>
            <div class="margin-bottom" style="width:60%;">
                <div class="help help-sm">Customers can select all <br>or only certain options</div>
                <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important"
                    href="<?php echo base_url('estimate/addoptions?type=2') ?>"><span
                        class="fa fa-list-ul fa-margin-right"></span> Options Estimate</a>
            </div>
            <div class="margin-bottom" style="width:60%;">
                <div class="help help-sm">Customers can select both Bundle Packages to obtain an overall discount</div>
                <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important"
                    href="<?php echo base_url('estimate/addbundle?type=3') ?>"><span
                        class="fa fa-cubes"></span> Bundle Estimate</a>
            </div>
        </center>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
</div>

<?php include viewPath('includes/footer_accounting'); ?>
<?php include viewPath('accounting/estimate_one_modal'); ?>
<div><?php include viewPath('accounting/customer_sales_receipt_modal'); ?>
</div>

<script>
    function setitem(obj, title, price, discount, itemid) {
        // var total = price * 1;
        jQuery(obj).parent().parent().find(".getItems").val(title);
        jQuery(obj).parent().parent().find(".getItems_hidden").text(title);
        jQuery(obj).parent().parent().parent().find(".price").val(price);
        jQuery(obj).parent().parent().parent().find(".priceqty").val(price);
        jQuery(obj).parent().parent().parent().find(".price").text(price);
        jQuery(obj).parent().parent().parent().find(".discount").val(discount);
        jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
        var counter = jQuery(obj)
            .parent()
            .parent()
            .parent()
            .find(".price")
            .data("counter");
        jQuery(obj).parent().empty();

        //   calculation(counter);
        var idd = itemid;

        var in_id = idd;
        var price = $("#price_" + in_id).val();
        var quantity = $("#quantity_" + in_id).val();
        var discount = $("#discount_" + in_id).val();
        var tax = (parseFloat(price) * 7.5) / 100;
        var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
            2
        );
        if (discount == '') {
            discount = 0;
        }

        var total = (
            (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
            parseFloat(discount)
        ).toFixed(2);

        // alert( 'yeah' + total);

        $("#span_total_" + in_id).text(total);
        $("#tax_1_" + in_id).text(tax1);
        $("#tax1_" + in_id).val(tax1);
        $("#discount_" + in_id).val(discount);

        if ($('#tax_1_' + in_id).length) {
            $('#tax_1_' + in_id).val(tax1);
        }

        if ($('#item_total_' + in_id).length) {
            $('#item_total_' + in_id).val(total);
        }

        var eqpt_cost = 0;
        var cnt = $("#count").val();
        var total_discount = 0;
        for (var p = 0; p <= cnt; p++) {
            var prc = $("#price_" + p).val();
            var quantity = $("#quantity_" + p).val();
            var discount = $("#discount_" + p).val();
            // var discount= $('#discount_' + p).val();
            // eqpt_cost += parseFloat(prc) - parseFloat(discount);
            eqpt_cost += parseFloat(prc) * parseFloat(quantity);
            total_discount += parseFloat(discount);
        }
        //   var subtotal = 0;
        // $( total ).each( function(){
        //   subtotal += parseFloat( $( this ).val() ) || 0;
        // });

        eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
        total_discount = parseFloat(total_discount).toFixed(2);
        // var test = 5;

        var subtotal = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="span_total_"]').each(function() {
            subtotal += parseFloat($(this).text());
        });
        // $('#sum').text(subtotal);

        var subtotaltax = 0;
        // $("#span_total_0").each(function(){
        $('*[id^="tax_1_"]').each(function() {
            subtotaltax += parseFloat($(this).text());
        });

        // alert(subtotaltax);

        $("#eqpt_cost").val(eqpt_cost);
        $("#total_discount").val(total_discount);
        $("#span_sub_total_0").text(total_discount);
        $("#span_sub_total_invoice").text(subtotal.toFixed(2));
        $("#item_total").val(subtotal.toFixed(2));

        var s_total = subtotal.toFixed(2);
        var adjustment = $("#adjustment_input").val();
        var grand_total = s_total - parseFloat(adjustment);
        var markup = $("#markup_input_form").val();
        var grand_total_w = grand_total + parseFloat(markup);

        $("#total_tax_").text(subtotaltax.toFixed(2));
        $("#total_tax_").val(subtotaltax.toFixed(2));


        $("#grand_total").text(grand_total_w.toFixed(2));
        $("#grand_total_input").val(grand_total_w.toFixed(2));
        $("#grand_total_inputs").val(grand_total_w.toFixed(2));

        var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
        sls = parseFloat(sls).toFixed(2);
        $("#sales_tax").val(sls);
        cal_total_due();
    }
</script>

<script>
    var price = $("#price2_" + counter).val();
    var quantity = $("#quantity2_" + counter).val();
    var discount = $("#discount2_" + counter).val();
    var tax = (parseFloat(price) * 7.5) / 100;
    var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
        2
    );
    if (discount == '') {
        discount = 0;
    }

    var total = (
        (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
        parseFloat(discount)
    ).toFixed(2);

    // alert( 'yeah' + total);

    $("#span_total2_" + counter).text(total);
    $("#tax2_" + counter).text(tax1);
    $("#discount2_" + counter).val(discount);

    if ($('#tax2_' + counter).length) {
        $('#tax2_' + counter).val(tax1);
    }

    if ($('#item_total2_' + counter).length) {
        $('#item_total2_' + counter).val(total);
    }

    var eqpt_cost = 0;
    var cnt = $("#count2").val();
    var total_discount = 0;
    for (var p = 0; p <= cnt; p++) {
        var prc = $("#price2_" + p).val();
        var quantity = $("#quantity2_" + p).val();
        var discount = $("#discount2_" + p).val();
        // var discount= $('#discount_' + p).val();
        // eqpt_cost += parseFloat(prc) - parseFloat(discount);
        eqpt_cost += parseFloat(prc) * parseFloat(quantity);
        total_discount += parseFloat(discount);
    }
    //   var subtotal = 0;
    // $( total ).each( function(){
    //   subtotal += parseFloat( $( this ).val() ) || 0;
    // });

    eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
    total_discount = parseFloat(total_discount).toFixed(2);
    // var test = 5;

    var subtotal = 0;
    // $("#span_total_0").each(function(){
    $('*[id^="span_total2_"]').each(function() {
        subtotal += parseFloat($(this).text());
    });
    // $('#sum').text(subtotal);

    var subtotaltaxx = 0;
    // $("#span_total_0").each(function(){
    $('*[id^="tax2_0"]').each(function() {
        subtotaltaxx += parseFloat($(this).val());
    });

    // alert(subtotaltaxx);

    // alert('dri');

    $("#eqpt_cost").val(eqpt_cost);
    $("#total_discount").val(total_discount);
    $("#span_sub_total_0").text(total_discount);
    $("#span_sub_total_invoice2").text(subtotal.toFixed(2));
    $("#item_total2").val(subtotal.toFixed(2));

    var s_total = subtotal.toFixed(2);
    var adjustment = $("#adjustment_input").val();
    var grand_total = s_total - parseFloat(adjustment);
    var markup = $("#markup_input_form").val();
    var grand_total_w = grand_total + parseFloat(markup);

    $("#total_tax2_").text(subtotaltaxx.toFixed(2));
    $("#total_tax2_input").val(subtotaltaxx.toFixed(2));


    $("#grand_total2").text(grand_total_w.toFixed(2));
    $("#grand_total_input2").val(grand_total_w.toFixed(2));
    $("#grandtotal_input").val(grand_total_w.toFixed(2));

    if ($("#grand_total").length && $("#grand_total").val().length) {
        // console.log('none');
        // alert('none');
    } else {
        $("#grand_total").text(grand_total_w.toFixed(2));
        $("#grand_total_input").val(grand_total_w.toFixed(2));
        $("#grand_total_inputs").val(grand_total_w.toFixed(2));

        var bundle1_total = $("#grand_total").text();
        var bundle2_total = $("#grand_total2").text();
        var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);
    }

    var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
    sls = parseFloat(sls).toFixed(2);
    $("#sales_tax").val(sls);
    cal_total_due();
</script>
<script>
    // $('#addcreditmemoModal').modal({
    //     backdrop: 'static',
    //     keyboard: false
    // });
</script>

<script>
    $(".select_package").click(function() {
        var idd = this.id;
        console.log(idd);
        console.log($(this).data('itemname'));
        var title = $(this).data('itemname');
        var price = $(this).data('price');

        if (!$(this).data('quantity')) {
            // alert($(this).data('quantity'));
            var qty = 0;
        } else {
            // alert('0');
            var qty = $(this).data('quantity');
        }


        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>workorder/select_package",
            data: {
                idd: idd
            },
            dataType: 'json',
            success: function(response) {
                // alert('Successfully Change');
                console.log(response['items']);

                // var objJSON = JSON.parse(response['items'][0].title);
                var inputs = "";
                $.each(response['items'], function(i, v) {
                    inputs += v.title;
                    var total_pu = v.price * v.units;
                    var total_tax = (v.price * v.units) * 7.5 / 100;
                    var total_temp = total_pu + total_tax;
                    var total = total_temp.toFixed(2);


                    markup = "<tr id=\"ss\">" +
                        "<td width=\"35%\"><input value='" + v.title +
                        "' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='" +
                        v.id +
                        "' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">" +
                        v.title + "</span></div></td>\n" +
                        "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        "<td width=\"10%\"><input data-itemid='" + v.id +
                        "' id='quantity_" + v.id + "' value='" + v.units +
                        "' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
                        "<td width=\"10%\"><input id='price_" + v.id + "' value='" + v
                        .price +
                        "'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_" +
                        v.id + "' value='" + total_pu +
                        "'><div class=\"show_mobile_view\"><span class=\"price\">" + v
                        .price +
                        "</span><input type=\"hidden\" class=\"form-control price\" name=\"price[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='" +
                        v.price + "'></div></td>\n" +
                        //   "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter=\"0\" id=\"discount_0\" value=\"0\" ></td>\n" +
                        // //  "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                        "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_" +
                        v.id + "' value=\"0\"></td>\n" +
                        // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                        "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='" +
                        v.id +
                        "' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_" +
                        v.id + "' min=\"0\" value='" + total_tax + "'></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='" +
                        total + "' id='span_total_" + v.id + "' class=\"total_per_item\">" +
                        total +
                        // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text" +
                        v.id + "' value='" + total + "'></td>" +
                        "<td>\n" +
                        '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                        "</td>\n" +
                        "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                    markup2 = "<tr id=\"sss\">" +
                        "<td >" + v.title + "</td>\n" +
                        "<td ></td>\n" +
                        "<td ></td>\n" +
                        "<td >" + v.price + "</td>\n" +
                        "<td ></td>\n" +
                        "<td >" + v.units + "</td>\n" +
                        "<td ></td>\n" +
                        "<td ></td>\n" +
                        "<td >0</td>\n" +
                        "<td ></td>\n" +
                        "<td ></td>\n" +
                        "</tr>";

                });
                // $("#input_container").html(inputs);

                tableBody2 = $("#device_audit_datas");
                tableBody2.append(markup2);
                // alert(inputs);

                var in_id = idd;
                var price = $("#price_" + in_id).val();
                var quantity = $("#quantity_" + in_id).val();
                var discount = $("#discount_" + in_id).val();
                var tax = (parseFloat(price) * 7.5) / 100;
                var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
                    2
                );
                if (discount == '') {
                    discount = 0;
                }

                var total = (
                    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
                    parseFloat(discount)
                ).toFixed(2);

                var total_wo_tax = price * quantity;

                // alert( 'yeah' + total);


                $("#priceqty_" + in_id).val(total_wo_tax);
                $("#span_total_" + in_id).text(total);
                $("#sub_total_text" + in_id).val(total);
                $("#tax_1_" + in_id).text(tax1);
                $("#tax1_" + in_id).val(tax1);
                $("#discount_" + in_id).val(discount);

                if ($('#tax_1_' + in_id).length) {
                    $('#tax_1_' + in_id).val(tax1);
                }

                if ($('#item_total_' + in_id).length) {
                    $('#item_total_' + in_id).val(total);
                }

                var eqpt_cost = 0;
                var total_costs = 0;
                var cnt = $("#count").val();
                var total_discount = 0;
                var pquantity = 0;
                for (var p = 0; p <= cnt; p++) {
                    var prc = $("#price_" + p).val();
                    var quantity = $("#quantity_" + p).val();
                    var discount = $("#discount_" + p).val();
                    var pqty = $("#priceqty_" + p).val();
                    // var discount= $('#discount_' + p).val();
                    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
                    pquantity += parseFloat(pqty);
                    total_costs += parseFloat(prc);
                    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
                    total_discount += parseFloat(discount);
                }
                //   var subtotal = 0;
                // $( total ).each( function(){
                //   subtotal += parseFloat( $( this ).val() ) || 0;
                // });

                var total_cost = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="price_"]').each(function() {
                    total_cost += parseFloat($(this).val());
                });

                // var totalcosting = 0;
                // $('*[id^="span_total_"]').each(function(){
                //   totalcosting += parseFloat($(this).val());
                // });


                // alert(total_cost);

                var tax_tot = 0;
                $('*[id^="tax1_"]').each(function() {
                    tax_tot += parseFloat($(this).val());
                });

                over_tax = parseFloat(tax_tot).toFixed(2);
                // alert(over_tax);

                $("#sales_taxs").val(over_tax);
                $("#total_tax_input").val(over_tax);
                $("#total_tax_").text(over_tax);


                eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
                total_discount = parseFloat(total_discount).toFixed(2);
                stotal_cost = parseFloat(total_cost).toFixed(2);
                priceqty = parseFloat(pquantity).toFixed(2);
                // var test = 5;

                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function() {
                    subtotal += parseFloat($(this).text());
                });
                // $('#sum').text(subtotal);

                var subtotaltax = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="tax_1_"]').each(function() {
                    subtotaltax += parseFloat($(this).text());
                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function() {
                    priceqty2 += parseFloat($(this).val());
                });

                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
                // $("#span_sub_total_invoice").text(priceqty);

                $("#eqpt_cost").val(eqpt_cost);
                $("#total_discount").val(total_discount);
                $("#span_sub_total_0").text(total_discount);
                // $("#span_sub_total_invoice").text(stotal_cost);
                // $("#item_total").val(subtotal.toFixed(2));
                $("#item_total").val(priceqty2.toFixed(2));

                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);

                // $("#total_tax_").text(subtotaltax.toFixed(2));
                // $("#total_tax_").val(subtotaltax.toFixed(2));




                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));

                var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
                sls = parseFloat(sls).toFixed(2);
                $("#sales_tax").val(sls);
                cal_total_due();


            },
            error: function(response) {
                alert('Error' + response);

        }
});

});
</script>

<script>
    $(document).ready(function() {

        $('#sel-customer').change(function() {
            var id = $(this).val();
            // alert(id);

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>accounting/addLocationajax",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // alert('success');
                    // console.log(response['customer']);
                    // $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);
                    $("#job_location").val(response['customer'].mail_add);
                    $("#email").val(response['customer'].email);
                    $("#date_of_birth").val(response['customer'].date_of_birth);
                    $("#phone_no").val(response['customer'].phone_h);
                    $("#mobile_no").val(response['customer'].phone_m);
                    $("#city").val(response['customer'].city);
                    $("#state").val(response['customer'].state);
                    $("#zip").val(response['customer'].zip_code);
                    $("#cross_street").val(response['customer'].cross_street);

                },
                error: function(response) {
                    alert('Error' + response);

                }
            });
        });


        $(document).on('click', '.setmarkup', function() {
            // alert('yeah');
            var markup_amount = $('#markup_input').val();

            $("#markup_input_form").val(markup_amount);
            $("#span_markup_input_form").text(markup_amount);
            $("#span_markup").text(markup_amount);

            $('#modalSetMarkup').modal('toggle');
        });
    });
</script>

<script>
$(document).ready(function() {
     
	$('#filter_from').datepicker({
		 dateFormat: 'mm/dd/yy',
		 minDate: 0,
			 
	});

    $('#filter_to').datepicker({
		 dateFormat: 'mm/dd/yy',
		 minDate: 0,
			 
	});
});

</script>
<script>

function getItemCharge_k(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitem_Charge",
    data: { sk: sk },
    type: "GET",
    success: function (data) {
      /* alert(data); */
      jQuery(obj).parent().find(".suggestions").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}
over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

function setitemCharge(obj, title, price, discount, itemid) {
  // alert( 'yeah');
// alert('setitemCM');
  jQuery(obj).parent().parent().find(".getItemCharge").val(title);
  jQuery(obj).parent().parent().parent().find(".pricedch").val(price);
  jQuery(obj).parent().parent().parent().find(".discountdch").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".pricedch")
    .data("counter");
  jQuery(obj).parent().empty();
  calculationCharge(counter);
}

$(document).on("focusout", ".pricedch", function () {
  var counter = $(this).data("counter");
  calculationCharge(counter);
});

// $(document).on("focusout", ".quantitycm", function () {
//   var counter = $(this).data("counter");
//   calculationcm(counter);
// });
$(document).on("focusout", ".discountdch", function () {
  var counter = $(this).data("counter");
  calculationCharge(counter);
});


$(document).on("focusout", ".quantitydch2", function () {
  // var counter = $(this).data("counter");
//   calculationcm(counter);
// var idd = this.id;
var idd = $(this).attr('data-itemid');
var in_id = idd;
  var price = $("#price_dch_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_dch_" + in_id).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }

  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

//   alert( 'yeah' + total);

  $("#span_total_charge_" + in_id).text(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax1_dch_" + in_id).val(tax1);
  $("#discount_dch_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_dch_'+ in_id).length ){
    $('#item_total_dch_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_dch_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_dch_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotaldch = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_charge_"]').each(function(){
    subtotaldch += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotalcm);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_dch").text(subtotal.toFixed(2));
  $("#item_total_dch").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_dch").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_dch_").text(subtotaltax.toFixed(2));
  $("#total_tax_dch_").val(subtotaltax.toFixed(2));


  $("#grand_total_dch").text(grand_total_w.toFixed(2));
  $("#grand_total_dch_total").text(grand_total_w.toFixed(2));
  $("#grand_total_dc_total_val_dc").val(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

function calculationCharge(counter) {
  // alert( 'yeah');
  var price = $("#price_dch_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_dch_" + counter).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }

  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // console.log( 'yeah' + total);

  $("#span_total_charge_" + counter).text(total);
  $("#tax_1_" + counter).text(tax1);
  $("#tax_111_" + counter).text(tax1);
  $("#tax_1_" + counter).val(tax1);
  $("#discount_dch_" + counter).val(discount);
  $("#tax1_dch_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_1_'+ counter).length ){
    $('#tax_1_'+counter).val(tax1);
  }

  if( $('#item_total_dch_'+ counter).length ){
    $('#item_total_dch_'+counter).val(total);
  }

  // alert('dri');

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_dch_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_dch_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_charge_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);
  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

//   alert(subtotal);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_dch").text(subtotal.toFixed(2));
  $("#item_total_dch").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_dch").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_dch_").text(subtotaltax.toFixed(2));
  $("#total_tax_input_dch").val(subtotaltax.toFixed(2));


  $("#grand_total_dch").text(grand_total_w.toFixed(2));
  $("#grand_total_dch_total").text(grand_total_w.toFixed(2));
  $("#grand_total_dc_total_val_dc").val(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));
  // alert(grand_total_w);

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total_dch").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}

</script>
<script>


$(".select_item_dch").click(function () {
            var idd = this.id;
            console.log(idd);
            console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            
            if(!$(this).data('quantity')){
              // alert($(this).data('quantity'));
              var qty = 0;
            }else{
              // alert('0');
              var qty = $(this).data('quantity');
            }

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * qty;
            var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
            var taxes_t = parseFloat(tax_).toFixed(2);
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';
            // console.log(total);
            // alert(total);
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"></td>\n" +
                "<td width=\"20%\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest\"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input id='price_dch_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_dch_"+idd+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_dch_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_charge_"+idd+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
                "</tr>";
            tableBody = $("#items_table_body_delayed_charge");
            tableBody.append(markup);
            markup2 = "<tr id=\"sss\">" +
                "<td >"+title+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >"+price+"</td>\n" +
                "<td ></td>\n" +
                "<td >"+qty+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >0</td>\n" +
                "<td ></td>\n" +
                "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
                "</tr>";
            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            // calculate_subtotal();
            // var counter = $(this).data("counter");
            // calculation(idd);

  var in_id = idd;
  var price = $("#price_dch_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_dch_" + in_id).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_charge_" + in_id).text(total);
  $("#sub_total_text" + in_id).val(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax1_dch_" + in_id).val(tax1);
  $("#discount_dch_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_dch_'+ in_id).length ){
    $('#item_total_dch_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  // var total_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_dch_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_dch_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    // total_cost += parseFloat(prc);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

var total_cost = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="price_dch_"]').each(function(){
      total_cost += parseFloat($(this).val());
  });

var tax_tot = 0;
$('*[id^="tax1_dch_"]').each(function(){
  tax_tot += parseFloat($(this).val());
});

over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

$("#sales_taxs").val(over_tax);
$("#total_tax_input_dch").val(over_tax);
$("#total_tax_dch_").text(over_tax);


  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  stotal_cost = parseFloat(total_cost).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_charge_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice_dch").text(subtotal.toFixed(2));
  // $("#item_total").val(subtotal.toFixed(2));
  $("#item_total_dch").val(stotal_cost);
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_dch").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  // $("#total_tax_").text(subtotaltax.toFixed(2));
  // $("#total_tax_").val(subtotaltax.toFixed(2));
  
  
  

  $("#grand_total_dch").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grand_total_dch_total").text(grand_total_w.toFixed(2));
  $("#grand_total_dc_total_val_dc").val(grand_total_w.toFixed(2));
  $("#grand_total_dch").text(grand_total_w.toFixed(2));
  $("#span_sub_total_dch").text(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
        });
</script>

<script>
    jQuery(document).ready(function() {
        $('#all_sales_table').DataTable({
            order: [[ 1, 'desc' ]],
        });
    });
</script>

<script>
$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel .btn-success.apply-btn", function(event) {
    single_customer_get_transaction_lists($("#customer-single-modal input[name='customer_id']").val());
});

function single_customer_get_transaction_lists(customer_id) {
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th input[name='customer_checkbox_all']").prop("checked", false);
    var filter_type = $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_type']").val();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody").html("<tr><td colspan='18' style='text-align:center;color: #C7C7C7;'><center><img src='" + baseURL + "assets/img/accounting/customers/loader.gif' style='width:50px;' /></center></td></tr>");
    $.ajax({
        url: baseURL + "/accounting/single_customer_get_transaction_lists",
        type: "POST",
        dataType: "json",
        data: {
            customer_id: customer_id,
            filter_type: filter_type,
            filter_date: $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_date']").val(),
        },
        success: function(data) {
            if (data.tbody_html == "") {
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody").html("<tr><td colspan='18' style='text-align:center;color: #C7C7C7;'>No transaction list found.</td></tr>");
            } else {
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody").html(data.tbody_html);
            }
            single_customer_table_columns_changed();
            single_customer_sortTable();
            table_viewing_affected(filter_type);
            $("#loader-modal").hide();
        },
    });

}
</script>

<script>

function getItemscm(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitems_cm",
    data: { sk: sk },
    type: "GET",
    success: function (data) {
      /* alert(data); */
      jQuery(obj).parent().find(".suggestions").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}
over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

function setitemCM(obj, title, price, discount, itemid) {

// alert('setitemCM');
  jQuery(obj).parent().parent().find(".getItemsCM").val(title);
  jQuery(obj).parent().parent().parent().find(".pricecm").val(price);
  jQuery(obj).parent().parent().parent().find(".discountcm").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".pricecm")
    .data("counter");
  jQuery(obj).parent().empty();
  calculationcm(counter);
}

$(document).on("focusout", ".pricecm", function () {
  var counter = $(this).data("counter");
  calculationcm(counter);
});

// $(document).on("focusout", ".quantitycm", function () {
//   var counter = $(this).data("counter");
//   calculationcm(counter);
// });
$(document).on("focusout", ".discountcm", function () {
  var counter = $(this).data("counter");
  calculationcm(counter);
});


$(document).on("focusout", ".quantitycm2", function () {
  // var counter = $(this).data("counter");
//   calculationcm(counter);
// var idd = this.id;
var idd = $(this).attr('data-itemid');
var in_id = idd;
  var price = $("#price_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_" + in_id).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }

  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

//   alert( 'yeah' + total);

  $("#span_total_" + in_id).text(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax1_" + in_id).val(tax1);
  $("#discount_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_'+ in_id).length ){
    $('#item_total_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotalcm = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotalcm += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotalcm);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_cm").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_cm").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_").val(subtotaltax.toFixed(2));


  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

function calculationcm(counter) {
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }

  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_" + counter).text(total);
  $("#tax_1_" + counter).text(tax1);
  $("#tax_111_" + counter).text(tax1);
  $("#tax_1_" + counter).val(tax1);
  $("#discount_" + counter).val(discount);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_1_'+ counter).length ){
    $('#tax_1_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  // alert('dri');

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);
  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

//   alert(subtotal);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_cm").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_cm").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_input").val(subtotaltax.toFixed(2));


  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total_cm").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}

</script>
<script>


$(".select_itemcm").click(function () {
            var idd = this.id;
            console.log(idd);
            console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            
            if(!$(this).data('quantity')){
              // alert($(this).data('quantity'));
              var qty = 0;
            }else{
              // alert('0');
              var qty = $(this).data('quantity');
            }

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * qty;
            var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
            var taxes_t = parseFloat(tax_).toFixed(2);
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';
            // console.log(total);
            // alert(total);
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"></td>\n" +
                "<td width=\"20%\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest\"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+idd+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
                "</tr>";
            tableBody = $("#items_table_body_credit_memo");
            tableBody.append(markup);
            markup2 = "<tr id=\"sss\">" +
                "<td >"+title+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >"+price+"</td>\n" +
                "<td ></td>\n" +
                "<td >"+qty+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >0</td>\n" +
                "<td ></td>\n" +
                "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
                "</tr>";
            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            // calculate_subtotal();
            // var counter = $(this).data("counter");
            // calculation(idd);

  var in_id = idd;
  var price = $("#price_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_" + in_id).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_" + in_id).text(total);
  $("#sub_total_text" + in_id).val(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax1_" + in_id).val(tax1);
  $("#discount_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_'+ in_id).length ){
    $('#item_total_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  // var total_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    // total_cost += parseFloat(prc);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

var total_cost = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="price_"]').each(function(){
      total_cost += parseFloat($(this).val());
  });

var tax_tot = 0;
$('*[id^="tax1_"]').each(function(){
  tax_tot += parseFloat($(this).val());
});

over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

$("#sales_taxs").val(over_tax);
$("#total_tax_input").val(over_tax);
$("#total_tax_").text(over_tax);


  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  stotal_cost = parseFloat(total_cost).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice").text(subtotal.toFixed(2));
  // $("#item_total").val(subtotal.toFixed(2));
  $("#item_total").val(stotal_cost);
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_cm").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  // $("#total_tax_").text(subtotaltax.toFixed(2));
  // $("#total_tax_").val(subtotaltax.toFixed(2));
  
  
  
  $("#item_total").val(grand_total_w.toFixed(2));
  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#span_sub_total_cm").text(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
        });
</script>