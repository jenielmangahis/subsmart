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
    span.select2-selection.select2-selection--single {
        min-width: unset !important;
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
                                <!-- <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">See how easy paying and tracking contractors can be. This accounting features makes it easy to pay contractors today & W-2 employees tomorrow.  Get started by adding a Contractor.</span>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row pb-3">
                                <!-- <div class="col-md-12 banking-tab-container">
									<a href="<?php //echo url('/accounting/payroll-overview')?>" class="banking-tab ">Overview</a>
									<a href="<?php //echo url('/accounting/employees')?>" class="banking-tab">Employees</a>
									<a href="<?php //echo url('/accounting/contractors')?>" class="banking-tab-active text-decoration-none">Contractors</a>
									<a href="<?php //echo url('/accounting/workers-comp')?>" class="banking-tab">Worker's Comp</a>
									<a href="#" class="banking-tab">Benefits</a>
                                </div> -->
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/vendors" class="text-info"><i class="fa fa-chevron-left"></i> Vendors</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <button class="btn btn-transparent px-4 mr-2">Edit</button>
                                            <div class="btn-group float-right">
                                                <button type="button" class="btn btn-success dropdown-toggle hide-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    New transaction &nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Time activity</a>
                                                    <a class="dropdown-item" href="#">Bill</a>
                                                    <a class="dropdown-item" href="#">Expense</a>
                                                    <a class="dropdown-item" href="#">Check</a>
                                                    <a class="dropdown-item" href="#">Purchase order</a>
                                                    <a class="dropdown-item" href="#">Vendor credit</a>
                                                    <a class="dropdown-item" href="#">Pay down credit card</a>
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
                                                    <div class="cursor-pointer h-100 p-3 notes-container">
                                                        No notes available. Please click to add note
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="total-pays float-right">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="open-pay-color" style="border-color: #f2b835; background: #f2b835; width: 5px; height: 45px;"></div>
                                                    <div class="open-pay ml-2">
                                                        <h4 class="m-0">$<span id="total-open-pay">0.00</span></h4>
                                                        <p class="m-0">OPEN</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="overdue-color" style="border-color: #ce5133; background: #ce5133; width: 5px; height: 45px;"></div>
                                                    <div class="overdue-pay ml-2">
                                                        <h4 class="m-0">$<span id="total-overdue-pay">0.00</span></h4>
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
                                <input type="hidden" name="vendor_id" id="vendor-id" value="<?=$vendor->id?>">
                                <div class="card">
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
                                                                <a href="#" class="dropdown-item">Print transactions</a>
                                                                <a href="#" class="dropdown-item">Categorize selected</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0">
                                                        <div class="dropdown d-inline-block">
                                                            <button class="dropdown-toggle btn btn-transparent hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter&nbsp;&nbsp;<i class="fa fa-caret-down"></i></button>

                                                            <div class="dropdown-menu p-3" aria-labelledby="filterDropdown">
                                                                <div class="inner-filter-list">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
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
                                                                <p class="m-0"><input type="checkbox"> Method</p>
                                                                <p class="m-0"><input type="checkbox"> Source</p>
                                                                <p class="m-0"><input type="checkbox"> Due date</p>
                                                                <p class="m-0"><input type="checkbox"> Balance</p>
                                                                <p class="m-0"><input type="checkbox"> Status</p>
                                                                <p class="m-0"><input type="checkbox"> Attachments</p>
                                                                <p class="m-0"><input type="checkbox"checked> Type</p>
                                                                <p class="m-0"><input type="checkbox"checked> No.</p>
                                                                <p class="m-0"><input type="checkbox"checked> Payee</p>
                                                                <p class="m-0"><input type="checkbox"checked> Category</p>
                                                                <p class="m-0"><input type="checkbox"checked> Memo</p>
                                                                <p class="m-0">Other</p>
                                                                <p class="m-0"><input type="checkbox" id="inc_inactive" value="1"> Include Inactive</p>
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
                                                            <th width="3"><input type="checkbox"></th>
                                                            <th>Date</th>
                                                            <th class="type">Type</th>
                                                            <th class="number">No.</th>
                                                            <th class="payee">Payee</th>
                                                            <th class="method hide">Method</th>
                                                            <th class="source hide">Source</th>
                                                            <th class="category">Category</th>
                                                            <th class="memo">Memo</th>
                                                            <th class="due-date hide">Due date</th>
                                                            <th class="balance hide">Balance</th>
                                                            <th>Total</th>
                                                            <th class="status hide">Status</th>
                                                            <th class="attachments hide">Attachments</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="vendor-details" role="tabpanel" aria-labelledby="vendor-details-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-transparent px-4 float-right">Edit</button>
                                    </div>
                                    <div class="col-sm-11">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Vendor</td>
                                                            <td><?=$vendor->display_name?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><?=$vendor->email?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone</td>
                                                            <td><?=$vendor->phone?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mobile</td>
                                                            <td><?=$vendor->mobile?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fax</td>
                                                            <td><?=$vendor->fax?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Website</td>
                                                            <td><?=$vendor->website?></td>
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
                                                    <div id="employeeProfilePhoto" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                                                <p class="m-0"><?=$vendor->street?></p>
                                                                <p class="m-0"><?=$vendor->city?>,<?=$vendor->state?></p>
                                                                <p class="m-0"><?=$vendor->zip?></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Terms</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Company</td>
                                                            <td><?=$vendor->company?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Notes</td>
                                                            <td>
                                                                <textarea name="notes" id="notes" class="form-control w-50" disabled><?=$vendor->notes === '' || $vendor->notes === null ? 'No notes available. Please click to add notes.' : $vendor->notes?></textarea>
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

<div class="append-modal"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>