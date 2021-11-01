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
    #registers-table .btn-group .btn:hover, #registers-table .btn-group .btn:focus {
        color: unset;
    }
    #registers-table .btn-group .btn {
        padding: 10px;
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
    #myTabContent .action-bar ul li .dropdown-menu.show {
        top: 100% !important;
        left: auto !important;
        right: 0 !important;
        transform: none !important;
    }
    #registers-table tbody tr.hover, #registers-table tbody tr.editting, #registers-table tbody tr.action-row {
        background-color: #f8f9fa;
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
                                <div class="col-sm-6 ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h3 class="page-title" style="margin: 0 !important"><?=$type?> Register</h3>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="account" id="account" class="form-control">
                                                <option value="<?=$account->id?>"><?=$account->name?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="m-0">Bank Balance</p>
                                            <p class="m-0">$0.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-success float-right">Reconcile</button>
                                    <div class="float-right text-right mr-3">
                                        <p class="m-0">ENDING BALANCE</p>
                                        <h3 style="margin: 0 !important;">
                                            <?php
                                                $balance = '$'.number_format(floatval($account->balance), 2, '.', ',');
                                                $balance = str_replace('$-', '-$', $balance);
                                                echo $balance;
                                            ?>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Bank register message</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/chart-of-accounts" class="text-info"><i class="fa fa-chevron-left"></i> Back to Chart of Accounts</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    
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
                                        <div class="dropdown d-inline-block d-flex align-items-center h-100">
                                            <a href="javascript:void(0);" class="dropdown-toggle hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-filter"></i>
                                            </a>

                                            <div class="dropdown-menu p-3 w-auto" aria-labelledby="filterDropdown">
                                                <div class="inner-filter-list">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <label for="search">Find</label>
                                                                <input type="text" name="search" id="search" class="form-control" placeholder="Memo, Ref no., $amt, >$amt, <$amt">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <?php if($type !== 'A/R') : ?>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="reconcile_status">Reconcile Status</label>
                                                                    <select name="reconcile_status" id="reconcile_status" class="form-control">
                                                                        <option value="all" selected>All</option>
                                                                        <option value="reconciled">Reconciled</option>
                                                                        <option value="cleared">Cleared</option>
                                                                        <option value="no-status">No Status</option>
                                                                        <option value="not-reconciled">Not Reconciled</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="transaction_type">Transaction type</label>
                                                                    <select name="transaction_type" id="transaction_type" class="form-control">
                                                                        <option value="all" selected>All</option>
                                                                        <option value="cc-expense">CC Expense</option>
                                                                        <option value="check">Check</option>
                                                                        <option value="invoice">Invoice</option>
                                                                        <option value="receive-payment">Receive payment</option>
                                                                        <option value="journal-entry">Journal Entry</option>
                                                                        <option value="bill">Bill</option>
                                                                        <option value="cc-credit">CC Credit</option>
                                                                        <option value="vendor-credit">Vendor Credit</option>
                                                                        <option value="bill-payment">Bill Payment</option>
                                                                        <option value="cc-bill-payment">CC Bill Payment</option>
                                                                        <option value="transfer">Transfer</option>
                                                                        <option value="deposit">Deposit</option>
                                                                        <option value="cash-expense">Cash Expense</option>
                                                                        <option value="sales-receipt">Sales Receipt</option>
                                                                        <option value="credit-memo">Credit Memo</option>
                                                                        <option value="refund">Refund</option>
                                                                        <option value="inv-qty-adjustment">Inventory Quantity Adjustment</option>
                                                                        <option value="payroll-check">Payroll Check</option>
                                                                        <option value="tax-payment">Tax Payment</option>
                                                                        <option value="payroll-adjustment">Payroll Adjustment</option>
                                                                        <option value="payroll-refund">Payroll Refund</option>
                                                                        <option value="sales-tax-payment">Sales Tax Payment</option>
                                                                        <option value="sales-tax-adjustment">Sales Tax Adjustment</option>
                                                                        <option value="expense">Expense</option>
                                                                        <option value="inv-starting-value">Inventory Starting Value</option>
                                                                        <option value="cc-payment">Credit Card Payment</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="payee">Payee</label>
                                                                    <select name="payee" id="payee"class="form-control">
                                                                        <option value="all" selected>All</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label for="date">Date</label>
                                                                    <select name="date" id="date" class="form-control">
                                                                        <option value="all">All dates</option>
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
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="from">From</label>
                                                                    <input type="text" name="from" id="from" class="form-control">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="to">To</label>
                                                                    <input type="text" name="to" id="to" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="btn-group d-flex justify-content-between">
                                                        <a href="#" class="btn-main" id="reset-filter">Reset</a>
                                                        <a href="#" class="btn-main apply-btn" id="apply-filter">Apply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li><a href="#" id="print-transactions"><i class="fa fa-print"></i></a></li>
                                                <li><a href="#" id="download-transactions"><i class="fa fa-download"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
                                                        <?php if($type !== 'A/R' && $type !== 'A/P') : ?>
                                                        <div class="checkbox checkbox-sec d-block my-2 memo-chk">
                                                            <input type="checkbox" name="chk_memo" id="chk_memo" onchange="col(this)">
                                                            <label for="chk_memo">Memo</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2 reconcile-status-chk">
                                                            <input type="checkbox" name="chk_reconcile_status" id="chk_reconcile_status" onchange="col(this)">
                                                            <label for="chk_reconcile_status">Reconcile Status</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2 banking-status-chk">
                                                            <input type="checkbox" name="chk_banking_status" id="chk_banking_status" onchange="col(this)"> 
                                                            <label for="chk_banking_status">Banking Status</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2 attachments-chk">
                                                            <input type="checkbox" name="chk_attachments" id="chk_attachments" onchange="col(this)">
                                                            <label for="chk_attachments">Attachments</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2 tax-chk">
                                                            <input type="checkbox" name="chk_tax" id="chk_tax" onchange="col(this)">
                                                            <label for="chk_tax">Tax</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2 running-balance-chk">
                                                            <input type="checkbox" checked name="chk_running_balance" id="chk_running_balance" onchange="col(this)">
                                                            <label for="chk_running_balance">Running Balance</label>
                                                        </div>
                                                        <?php else : ?>
                                                        <div class="checkbox checkbox-sec d-block my-2 open-balance-chk">
                                                            <input type="checkbox" name="chk_open_balance" id="chk_open_balance" onchange="col(this)">
                                                            <label for="chk_open_balance">Open Balance</label>
                                                        </div>
                                                        <?php endif; ?>
                                                        <p class="m-0">Other</p>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" id="show_in_one_line" value="1" checked>
                                                            <label for="show_in_one_line">Show in one line</label>
                                                        </div>
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" id="paper_ledger_mode" value="1">
                                                            <label for="paper_ledger_mode">Paper Ledger Mode</label>
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
                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                            <input type="checkbox" id="compact">
                                                            <label for="compact">Compact</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="registers-table" class="table table-bordered table-hover cursor-pointer">
									<thead>
                                        <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                                        <tr>
                                            <th>DATE</th>
                                            <th>REF NO.</th>
                                            <th>TYPE</th>
                                            <th>PAYEE</th>
                                            <th>ACCOUNT</th>
                                            <th class="memo d-none">MEMO</th>
                                            <th>
                                                <?php if($type === 'Asset') : ?>
                                                DECREASE
                                                <?php elseif($type === 'Liability') : ?>
                                                INCREASE
                                                <?php elseif($type === 'Credit Card') : ?>
                                                CHARGE
                                                <?php else : ?>
                                                PAYMENT
                                                <?php endif; ?>
                                            </th>
                                            <th>
                                                <?php if($type === 'Asset') : ?>
                                                INCREASE
                                                <?php elseif($type === 'Liability') : ?>
                                                DECREASE
                                                <?php elseif($type === 'Credit Card') : ?>
                                                PAYMENT
                                                <?php else : ?>
                                                DEPOSIT
                                                <?php endif; ?>
                                            </th>
                                            <th class="reconcile_status d-none">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                            </th>
                                            <th class="banking_status d-none">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-copy"></i>
                                                </div>
                                            </th>
                                            <th class="attachments d-none">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <i class="fa fa-paperclip"></i>
                                                </div>
                                            </th>
                                            <th class="tax d-none">TAX</th>
                                            <th class="text-right running_balance" width="10%">BALANCE</th>
                                        </tr>
                                        <?php else : ?>
                                        <tr>
                                            <th>DATE</th>
                                            <th>REF NO.</th>
                                            <th>
                                                <?php if($type === 'A/R') : ?>
                                                CUSTOMER
                                                <?php else : ?>
                                                VENDOR
                                                <?php endif; ?>
                                            </th>
                                            <?php if($type === 'A/R') : ?>
                                            <th>MEMO</th>
                                            <?php endif; ?>
                                            <th>DUE DATE</th>
                                            <th>
                                                <?php if($type === 'A/R') : ?>
                                                CHARGE/CREDIT
                                                <?php else : ?>
                                                BILLED
                                                <?php endif; ?>
                                            </th>
                                            <th>
                                                <?php if($type === 'A/R') : ?>
                                                PAYMENT
                                                <?php else : ?>
                                                PAID
                                                <?php endif; ?>
                                            </th>
                                            <th class="open_balance d-none">OPEN BALANCE</th>
                                        </tr>
                                        <?php endif; ?>
									</thead>
									<tbody></tbody>
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
<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>