<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .loader
    {
        display: none !important;
    }
    #filterDropdown {
        padding: 10px 12px !important;
    }
    #filterDropdown:after {
        display: none;
    }
    #recurring_transactions .btn-group .btn:hover, #recurring_transactions .btn-group .btn:focus {
        color: unset;
    }
    #recurring_transactions .btn-group .btn {
        padding: 10px;
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
                                    <h3 class="page-title" style="margin: 0 !important">Recurring Transactions</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Recurring transactions message</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center pb-3">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <div class="btn-group mr-2">
                                                <a href="#" class="btn btn-secondary d-flex align-items-center justify-content-center">
                                                    Reminder List
                                                </a>
                                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Run Report</a>
                                                </div>
                                            </div>
                                            <a href="#" data-toggle="modal" data-target="#transaction_type_modal" class="btn btn-success" style="padding: 10px 20px !important">
                                                New
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 p-0">
                                            <input type="text" name="search" id="search" class="form-control" placeholder="Filter by name">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="dropdown d-inline-block">
                                                <a href="#" class="dropdown-toggle btn btn-secondary" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter&nbsp;&nbsp;<i class="fa fa-caret-down"></i></a>

                                                <div class="dropdown-menu p-3" aria-labelledby="filterDropdown">
                                                    <div class="inner-filter-list">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>Recurring transactions</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="template-type">Template Type</label>
                                                                    <select name="template_type" id="template-type" class="form-control">
                                                                        <option value="all">All</option>
                                                                        <option value="scheduled">Scheduled</option>
                                                                        <option value="reminder">Reminder</option>
                                                                        <option value="unscheduled">Unscheduled</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="transaction-type">Transaction Type</label>
                                                                    <select name="transaction_type" id="transaction-type" class="form-control">
                                                                        <option value="all">All</option>
                                                                        <option value="bill">Bill</option>
                                                                        <option value="npcharge">Non-Posting Charge</option>
                                                                        <option value="check">Check</option>
                                                                        <option value="npcredit">Non-Posting Credit</option>
                                                                        <option value="cccredit">Credit Card Credit</option>
                                                                        <option value="credit-memo">Credit Memo</option>
                                                                        <option value="deposit">Deposit</option>
                                                                        <option value="estimate">Estimate</option>
                                                                        <option value="expense">Expense</option>
                                                                        <option value="invoice">Invoice</option>
                                                                        <option value="journal-entry">Journal Entry</option>
                                                                        <option value="refund">Refund</option>
                                                                        <option value="sales-receipt">Sales Receipt</option>
                                                                        <option value="transfer">Transfer</option>
                                                                        <option value="vendor-credit">Vendor Credit</option>
                                                                        <option value="purchase-order">Purchase Order</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="btn-group">
                                                            <a href="#" class="btn-main" onclick="resetbtn()">Reset</a>
                                                            <a href="#" id="" class="btn-main apply-btn btn btn-success" onclick="applybtn()">Apply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="action-bar h-100 d-flex align-items-center">
                                        <ul class="ml-auto">
                                            <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                            <li>
                                                <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                    <p class="p-padding m-0">Rows</p>
                                                    <p class="p-padding m-0">
                                                        <select name="table_rows" id="table_rows" class="form-control">
                                                            <option value="50">50</option>
                                                            <option value="75">75</option>
                                                            <option value="100">100</option>
                                                            <option value="150" selected>150</option>
                                                            <option value="300">300</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
            		    <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <table id="recurring_transactions" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th>TEMPLATE NAME</th>
                                            <th>TYPE</th>
                                            <th>TXN TYPE</th>
                                            <th>INTERVAL</th>
                                            <th>PREVIOUS DATE</th>
                                            <th>NEXT DATE</th>
                                            <th>CUSTOMER/VENDOR</th>
                                            <th>AMOUNT</th>
                                            <th>ACTION</th>
                                        </tr>
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

    <div class="modal fade" id="transaction_type_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Transaction Type</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Select the type of template to create</p>
                                            <div class="form-group">
                                                <label for="type">Transaction Type</label>
                                                <select name="transaction_type" id="type" class="form-control">
                                                        <option value="bill">Bill</option>
                                                        <option value="npcharge">Non-Posting Charge</option>
                                                        <option value="check">Check</option>
                                                        <option value="npcredit">Non-Posting Credit</option>
                                                        <option value="cccredit">Credit Card Credit</option>
                                                        <option value="credit-memo">Credit Memo</option>
                                                        <option value="depositModal">Deposit</option>
                                                        <option value="estimate">Estimate</option>
                                                        <option value="expense">Expense</option>
                                                        <option value="invoice">Invoice</option>
                                                        <option value="journalEntryModal">Journal Entry</option>
                                                        <option value="refund">Refund</option>
                                                        <option value="sales-receipt">Sales Receipt</option>
                                                        <option value="transferModal">Transfer</option>
                                                        <option value="vendor-credit">Vendor Credit</option>
                                                        <option value="purchase-order">Purchase Order</option>
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
                        <button type="button" class="btn btn-success btn-rounded border float-right">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer_accounting'); ?>

<script>
function applybtn()
{
    $('#recurring_transactions').DataTable().ajax.reload();
    $('.inner-filter-list').parent().toggleClass('show');
}

function resetbtn()
{
    $('#template-type').val('all');
    $('#transaction-type').val('all');
    applybtn();
}

$('#transaction_type_modal .modal-footer .btn-success').on('click', function(e) {
    e.preventDefault();

    var modal = '';
    var modalName = $('select#type').val();
    $(`a[data-target="#${modalName}"]`).trigger('click');

    if(modalName === 'depositModal') {
        modal = 'bank_deposit';
    } else if(modalName === 'journalEntryModal') {
        modal = 'journal_entry';
    } else if(modalName === 'transferModal') {
        modal = 'transfer';
    }

    makeRecurring(modal);

    $('#transaction_type_modal').modal('hide');
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#table_rows').on('change', function() {
    $('#recurring_transactions').DataTable().ajax.reload();
});

$('#search').on('keyup', function() {
    $('#payment_methods').DataTable().ajax.reload();
});

$('#recurring_transactions').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    ajax: {
        url: 'recurring-transactions/load-recurring-transactions/',
        dataType: 'json',
        contentType: 'application/json', 
        type: 'POST',
        data: function(d) {
            d.type = $('#template-type').val();
            d.transaction_type = $('#transaction-type').val();
            d.length = $('#table_rows').val();
            d.columns[0].search.value = $('input#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers',
    },
    columns: [
        {
            data: 'template_name',
            name: 'template_name'
        },
        {
            data: 'recurring_type',
            name: 'recurring_type'
        },
        {
            data: 'txn_type',
            name: 'txn_type'
        },
        {
            data: 'recurring_interval',
            name: 'recurring_interval'
        },
        {
            data: 'previous_date',
            name: 'previous_date'
        },
        {
            data: 'next_date',
            name: 'next_date'
        },
        {
            data: 'customer_vendor',
            name: 'customer_vendor'
        },
        {
            data: 'amount',
            name: 'amount'
        },
        {
            data: null,
            name: 'actions',
            orderable: false,
            searchable: false,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`
                <div class="btn-group float-right">
                    <a href="#" class="btn text-primary d-flex align-items-center justify-content-center">Edit</a>

                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Use</a>
                        <a class="dropdown-item" href="#">Duplicate</a>
                        <a class="dropdown-item" href="#">Pause</a>
                        <a class="dropdown-item" href="#">Skip next date</a>
                        <a class="dropdown-item" href="#">Delete</a>
                    </div>
                </div>
                `);
            }
        }
    ]
});
</script>