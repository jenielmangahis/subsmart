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
                                            <button class="btn btn-transparent px-4 mr-2" data-toggle="modal" data-target="#edit-vendor-modal">Edit</button>
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
                                                        <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-download"></i></a></li>
                                                        <li>
                                                            <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-cog"></i>
                                                            </a>
                                                            <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                                <p class="m-0">Columns</p>
                                                                <p class="m-0"><input type="checkbox" id="method_chk" onchange="showCol(this)"> Method</p>
                                                                <p class="m-0"><input type="checkbox" id="source_chk" onchange="showCol(this)"> Source</p>
                                                                <p class="m-0"><input type="checkbox" id="due_date_chk" onchange="showCol(this)"> Due date</p>
                                                                <p class="m-0"><input type="checkbox" id="balance_chk" onchange="showCol(this)"> Balance</p>
                                                                <p class="m-0"><input type="checkbox" id="status_chk" onchange="showCol(this)"> Status</p>
                                                                <p class="m-0"><input type="checkbox" id="attachments_chk" onchange="showCol(this)"> Attachments</p>
                                                                <p class="m-0"><input type="checkbox" id="type_chk" onchange="showCol(this)" checked> Type</p>
                                                                <p class="m-0"><input type="checkbox" id="number_chk" onchange="showCol(this)" checked> No.</p>
                                                                <p class="m-0"><input type="checkbox" id="payee_chk" onchange="showCol(this)" checked> Payee</p>
                                                                <p class="m-0"><input type="checkbox" id="category_chk" onchange="showCol(this)" checked> Category</p>
                                                                <p class="m-0"><input type="checkbox" id="memo_chk" onchange="showCol(this)" checked> Memo</p>
                                                                <p class="m-0">Rows</p>
                                                                <p class="m-0"><input type="checkbox" id="compact_chk"> Compact</p>
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
                                                                    <input type="checkbox">
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
                                        <button class="btn btn-transparent px-4 float-right" data-toggle="modal" data-target="#edit-vendor-modal">Edit</button>
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
    <!--    Add vendor modal-->
    <div id="edit-vendor-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg m-auto">
            <!-- Modal content-->
            <form action="/accounting/vendors/<?=$vendorDetails->id?>/update" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
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
                                                            <input type="text" name="title" id="title" class="form-control" value="<?=$vendorDetails->title?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="f_name">First name</label>
                                                            <input type="text" name="f_name" id="f_name" class="form-control" value="<?=$vendorDetails->f_name?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="m_name">Middle name</label>
                                                            <input type="text" name="m_name" id="m_name" class="form-control" value="<?=$vendorDetails->m_name?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="l_name">Last name</label>
                                                            <input type="text" name="l_name" id="l_name" class="form-control" value="<?=$vendorDetails->l_name?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-ib">
                                                            <label for="suffix">Suffix</label>
                                                            <input type="text" name="suffix" id="suffix" class="form-control" value="<?=$vendorDetails->suffix?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="company">Company</label>
                                                            <input type="text" name="company" id="company" class="form-control" value="<?=$vendorDetails->company?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="display_name"><span class="text-danger">*</span> Display name as</label>
                                                            <input type="text" name="display_name" id="display_name" class="form-control" required value="<?=$vendorDetails->display_name?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="print_on_check_name" style="margin-right: 10px">Print on check as </label>
                                                            <input type="checkbox" value="1" name="use_display_name" id="use_display_name" <?=$vendorDetails->to_display === "1" ? "checked" : ""?>><label for="use_display_name" class="ml-3">Use display name</label>
                                                            <input type="text" name="print_on_check_name" id="print_on_check_name" class="form-control" <?=$vendorDetails->to_display === "1" ? "disabled" : ""?> value="<?=$vendorDetails->print_on_check_name?>">
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
                                                            <textarea name="street" id="street" cols="30" rows="2" class="form-control" placeholder="Street" required><?=$vendorDetails->street?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-ib mt-1">
                                                            <input name="city" type="text" class="form-control" placeholder="City/Town" required value="<?=$vendorDetails->city?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-ib mt-1">
                                                            <input name="state" type="text" class="form-control" placeholder="State/Province" required value="<?=$vendorDetails->state?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-ib mt-1">
                                                            <input name="zip" type="text" class="form-control" placeholder="ZIP Code" required value="<?=$vendorDetails->zip?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-ib mt-1">
                                                            <input name="country" type="text" class="form-control" placeholder="Country" required value="<?=$vendorDetails->country?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="notes">Notes</label>
                                                            <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"><?=$vendorDetails->notes?></textarea>
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
                                                            <?php if($vendorDetails->attachments !== null && $vendorDetails->attachments !== "") : ?>
                                                                <?php foreach(json_decode($vendorDetails->attachments, true) as $attachment) : ?>
                                                                    <input type="hidden" name="attachments[]" value="<?=$attachment?>">
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
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
                                                            <input type="text" class="form-control" name="email" id="email" placeholder="Separate multiple emails with commas" value="<?=$vendorDetails->email?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" name="phone" id="phone" class="form-control" value="<?=$vendorDetails->phone?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="mobile">Mobile</label>
                                                            <input type="text" name="mobile" id="mobile" class="form-control" value="<?=$vendorDetails->mobile?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="fax">Fax</label>
                                                            <input type="text" name="fax" id="fax" class="form-control" value="<?=$vendorDetails->fax?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="website">Website</label>
                                                            <input type="text" name="website" id="website" class="form-control" value="<?=$vendorDetails->website?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="billing_rate">Billing rate (/hr)</label>
                                                            <input type="text" name="billing_rate" id="billing_rate" class="form-control" value="<?=$vendorDetails->billing_rate?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="terms">Terms</label>
                                                            <select class="form-control" name="terms" id="terms">
                                                                <option value="" <?=in_array($vendorDetails->terms, ['', "0", null]) ? 'selected' : ''?> disabled>&nbsp;</option>
                                                                <option value="add-new">&plus; Add new</option>
                                                                <?php if(count($terms) > 0) : ?>
                                                                <?php foreach($terms as $term) : ?>
                                                                    <option value="<?=$term->id?>" <?=$vendorDetails->terms === $term->id ? 'selected' : ''?>><?=$term->name?></option>
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
                                                            <input type="text" name="opening_balance" id="opening_balance" class="form-control" value="<?=$vendorDetails->opening_balance !== null && $vendorDetails->opening_balance !== "" ? number_format(floatval($vendorDetails->opening_balance), 2, '.', ',') : ""?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="opening_balance_as_of_date">as of</label>
                                                            <input type="text" name="opening_balance_as_of_date" id="opening_balance_as_of_date" class="form-control datepicker" value="<?=date("m/d/Y", strtotime($vendorDetails->opening_balance_as_of_date))?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="account_number">Account no.</label>
                                                            <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Appears in the memo of all payment" value="<?=$vendorDetails->account_number?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-ib-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-ib">
                                                            <label for="">Business ID No. / Social Security No.</label>
                                                            <input type="text" name="tax_id" id="tax_id" class="form-control" required value="<?=$vendorDetails->tax_id?>">
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
                                                                        <option value="<?=$expenseAcc->id?>" <?=$expenseAcc->id === $vendorDetails->default_expense_account ? 'selected' : ''?>><?=$expenseAcc->name?></option>

                                                                        <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($expenseAcc->id); ?>
                                                                        <?php if(count($childAccs) > 0) : ?>
                                                                            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$expenseAcc->name?>">
                                                                            <?php foreach($childAccs as $childAcc) : ?>
                                                                                <option value="<?=$childAcc->id?>" <?=$childAcc->id === $vendorDetails->default_expense_account ? 'selected' : ''?>>&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                            <?php endforeach; ?>
                                                                            </optgroup>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                    </optgroup>
                                                                <?php endif; ?>
                                                                <?php if(count($otherExpenseAccs) > 0) : ?>
                                                                    <optgroup label="Other Expenses">
                                                                    <?php foreach($otherExpenseAccs as $otherExpenseAcc) : ?>
                                                                        <option value="<?=$otherExpenseAcc->id?>" <?=$otherExpenseAcc->id === $vendorDetails->default_expense_account ? 'selected' : ''?>><?=$otherExpenseAcc->name?></option>

                                                                        <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($otherExpenseAcc->id); ?>
                                                                        <?php if(count($childAccs) > 0) : ?>
                                                                            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$otherExpenseAcc->name?>">
                                                                            <?php foreach($childAccs as $childAcc) : ?>
                                                                                <option value="<?=$childAcc->id?>" <?=$childAcc->id === $vendorDetails->default_expense_account ? 'selected' : ''?>>&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                            <?php endforeach; ?>
                                                                            </optgroup>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                    </optgroup>
                                                                <?php endif; ?>
                                                                <?php if(count($cogsAccs) > 0) : ?>
                                                                    <optgroup label="Cost of Goods Sold">
                                                                    <?php foreach($cogsAccs as $cogsAcc) : ?>
                                                                        <option value="<?=$cogsAcc->id?>" <?=$cogsAcc->id === $vendorDetails->default_expense_account ? 'selected' : ''?>>&nbsp;<?=$cogsAcc->name?></option>

                                                                        <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($cogsAcc->id); ?>
                                                                        <?php if(count($childAccs) > 0) : ?>
                                                                            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$cogsAcc->name?>">
                                                                            <?php foreach($childAccs as $childAcc) : ?>
                                                                                <option value="<?=$childAcc->id?>" <?=$childAcc->id === $vendorDetails->default_expense_account ? 'selected' : ''?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
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