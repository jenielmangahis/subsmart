<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
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

    #transactions-table .btn-group .btn:hover,
    #transactions-table .btn-group .btn:focus {
        color: #38a4f8 !important;
    }

    #transactions-table .btn-group .btn.dropdown-toggle:hover,
    #transactions-table .btn-group .btn.dropdown-toggle:focus {
        color: unset !important;
    }

    #transactions-table .btn-group .btn {
        padding: 10px;
    }

    #transactions-table .view-attachment:hover {
        background-color: #365ebf;
        color: #fff;
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
                                        <span style="color:black;">An expense is generally anything that your company
                                            spends money on to keep it up and running. Examples of expenses are rent,
                                            phone bills, website hosting fees, office supplies, accountant fees, trash
                                            service, janitorial fees, etc. Simply click new transaction and you will see
                                            you will see a list of options to chose from. Once you choose the type of
                                            transactions; just enter the information and click save new.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/expenses')?>"
                                        class="banking-tab-active" style="text-decoration: none">Expenses</a>
                                    <a href="<?php echo url('/accounting/vendors')?>"
                                        class="banking-tab">Vendors</a>
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
                                                <button type="button" class="btn btn-success" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    New transaction &nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" id="new-time-activity">Time
                                                        activity</a>
                                                    <a class="dropdown-item" href="#" id="new-bill-transaction">Bill</a>
                                                    <a class="dropdown-item" href="#"
                                                        id="new-expense-transaction">Expense</a>
                                                    <a class="dropdown-item" href="#"
                                                        id="new-check-transaction">Check</a>
                                                    <a class="dropdown-item" href="#"
                                                        id="new-purchase-order-transaction">Purchase order</a>
                                                    <a class="dropdown-item" href="#"
                                                        id="new-vendor-credit-transaction">Vendor Credit</a>
                                                    <a class="dropdown-item" href="#" id="new-credit-card-pmt">Pay down
                                                        credit card</a>
                                                </div>
                                            </div>
                                            <div class="btn-group float-right mr-2">
                                                <button type="button"
                                                    class="btn btn-transparent d-flex align-items-center justify-content-center">
                                                    Print checks
                                                </button>
                                                <button type="button"
                                                    class="btn btn-transparent dropdown-toggle dropdown-toggle-split"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif ($this->session->flashdata('error')) : ?>
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
                                            <a href="javascript:void(0);"
                                                class="btn btn-transparent dropdown-toggle hide-toggle"
                                                id="filterDropdown" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Filter &nbsp;&nbsp;<span
                                                    class="fa fa-caret-down"></span></a>

                                            <div class="dropdown-menu p-3" aria-labelledby="filterDropdown"
                                                style="max-width: 650px">
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
                                                                    <option value="purchase-order">Purchase order
                                                                    </option>
                                                                    <option value="recently-paid">Recently paid</option>
                                                                    <option value="vendor-credit">Vendor credit</option>
                                                                    <option value="credit-card-payment">Credit Card
                                                                        Payment</option>
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
                                                                <input type="text" id="from-date"
                                                                    class="form-control datepicker"
                                                                    value="<?=date("m/d/Y")?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="to-date">To</label>
                                                                <input type="text" id="to-date"
                                                                    class="form-control datepicker">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label for="payee">Payee</label>
                                                                <select id="payee" class="form-control">
                                                                    <option value="all">All</option>
                                                                    <?php if (count($dropdown['vendors']) > 0) : ?>
                                                                    <optgroup label="Vendors">
                                                                        <?php foreach ($dropdown['vendors'] as $vendor) : ?>
                                                                        <option
                                                                            value="vendor-<?=$vendor->id?>">
                                                                            <?=$vendor->display_name?>
                                                                        </option>
                                                                        <?php endforeach; ?>
                                                                    </optgroup>
                                                                    <?php endif; ?>
                                                                    <?php if (count($dropdown['customers']) > 0) : ?>
                                                                    <optgroup label="Customers">
                                                                        <?php foreach ($dropdown['customers'] as $customer) : ?>
                                                                        <option
                                                                            value="customer-<?=$customer->prof_id?>">
                                                                            <?=$customer->first_name . ' ' . $customer->last_name?>
                                                                        </option>
                                                                        <?php endforeach; ?>
                                                                    </optgroup>
                                                                    <?php endif; ?>
                                                                    <?php if (count($dropdown['employees']) > 0) : ?>
                                                                    <optgroup label="Employees">
                                                                        <?php foreach ($dropdown['employees'] as $employee) : ?>
                                                                        <option
                                                                            value="employee-<?=$employee->id?>">
                                                                            <?=$employee->FName . ' ' . $employee->LName?>
                                                                        </option>
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
                                                                    <?php foreach ($dropdown['categories'] as $accType => $accounts) : ?>
                                                                    <optgroup
                                                                        label="<?=$accType?>">
                                                                        <?php foreach ($accounts as $account) : ?>
                                                                        <option
                                                                            value="<?=$account->id?>">
                                                                            <?=$account->name?>
                                                                        </option>

                                                                        <?php if (count($account->childAccs) > 0) : ?>
                                                                    <optgroup
                                                                        label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                                        <?php foreach ($account->childAccs as $childAcc) : ?>
                                                                        <option
                                                                            value="<?=$childAcc->id?>">
                                                                            &nbsp;&nbsp;&nbsp;<?=$childAcc->name?>
                                                                        </option>
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
                                                        <a href="#" id="apply-btn" class="btn-main apply-btn"
                                                            onclick="applybtn()">Apply</a>
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
                                                    <button class="btn btn-transparent" type="button"
                                                        id="statusDropdownButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Batch actions&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                                                        <a href="#" class="dropdown-item disabled"
                                                            id="print-transactions">Print transactions</a>
                                                        <a href="#" class="dropdown-item disabled"
                                                            id="categorize-selected">Categorize selected</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" onclick="window.print()"><i class="fa fa-print"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-download"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_type" checked>
                                                            Type</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_number" checked>
                                                            No.</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_payee" checked>
                                                            Payee</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_method" checked>
                                                            Method</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_source" checked>
                                                            Source</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_category"
                                                                checked> Category</p>
                                                        <p class="m-0"><input type="checkbox" id="trans_memo" checked>
                                                            Memo</p>
                                                        <div class="show-more hide">
                                                            <p class="m-0"><input type="checkbox" id="trans_due_date"
                                                                    checked> Due date</p>
                                                            <p class="m-0"><input type="checkbox" id="trans_balance"
                                                                    checked> Balance</p>
                                                            <p class="m-0"><input type="checkbox" id="trans_status"
                                                                    checked> Status</p>
                                                            <p class="m-0"><input type="checkbox" id="trans_attachments"
                                                                    checked> Attachments</p>
                                                        </div>
                                                        <a href="#" class="text-info text-center show-more-button"><i
                                                                class="fa fa-caret-down text-info"></i> &nbsp;Show
                                                            more</a>
                                                        <p class="m-0">Rows</p>
                                                        <p class="m-0">
                                                            <select name="table_rows" id="table_rows"
                                                                class="form-control">
                                                                <option value="50">50</option>
                                                                <option value="75">75</option>
                                                                <option value="100">100</option>
                                                                <option value="150" selected>150</option>
                                                                <option value="300">300</option>
                                                            </select>
                                                        </p>
                                                        <p class="m-0"><input type="checkbox" id="compact-table">
                                                            Compact</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="transactions-table" class="table table-bordered table-hover"
                                    style="width:100%">
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
                                            <th class="text-right" width="10%">ACTION</th>
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
                                                    <select name="category_id" id="category-id" class="form-control"
                                                        required>
                                                        <option value="" selected disabled>Select category</option>
                                                        <?php foreach ($categoryAccs as $accType => $accounts) : ?>
                                                        <optgroup
                                                            label="<?=$accType?>">
                                                            <?php foreach ($accounts as $account) : ?>
                                                            <option
                                                                value="<?=$account->id?>">
                                                                <?=$account->name?>
                                                            </option>

                                                            <?php if (count($account->childAccs) > 0) : ?>
                                                        <optgroup
                                                            label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                            <?php foreach ($account->childAccs as $childAcc) : ?>
                                                            <option
                                                                value="<?=$childAcc->id?>">
                                                                &nbsp;&nbsp;&nbsp;<?=$childAcc->name?>
                                                            </option>
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
                            <button type="button" class="btn btn-secondary btn-rounded border"
                                data-dismiss="modal">Close</button>
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
<?php include viewPath('includes/footer_accounting');
