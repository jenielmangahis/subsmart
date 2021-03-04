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
                                        <span style="color:black;">A recurring transaction is an agreement between a cardholder and a company providing goods/services that essentially authorizes the charging of periodic, automatic payments during a set amount of time.  The transaction can be charged on a weekly, monthly, or yearly basis.</span>
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
                                                                        <option value="journal entry">Journal Entry</option>
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

    <div class="modal fade" id="delete_recurring_transaction" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Are you sure you want to delete this?</p>
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
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">No</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success btn-rounded border float-right">Yes</button>
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

    switch(modalName) {
        case 'depositModal' : 
            modal = 'bank_deposit';
        break;
        case 'journalEntryModal' :
            modal = 'journal_entry';
        break;
        case 'transferModal' : 
            modal ='transfer';
        break;
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
    $('#recurring_transactions').DataTable().ajax.reload();
});

var table = $('#recurring_transactions').DataTable({
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
                    <a href="#" class="edit-recurring btn text-primary d-flex align-items-center justify-content-center">Edit</a>

                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Use</a>
                        <a class="dropdown-item" href="#">Duplicate</a>
                        <a class="dropdown-item" href="#">Pause</a>
                        <a class="dropdown-item" href="#">Skip next date</a>
                        <a class="dropdown-item delete-recurring" href="#">Delete</a>
                    </div>
                </div>
                `);
            }
        }
    ]
});

$(document).on('click', '#recurring_transactions .delete-recurring', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent();
    var rowData = table.row(row).data();

    $('#delete_recurring_transaction .modal-footer .btn-success').attr('data-id', rowData.id);

    $('#delete_recurring_transaction').modal('show');
});

$(document).on('click', '#delete_recurring_transaction .modal-footer .btn-success', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;

    $.ajax({
        url: `/accounting/recurring-transactions/delete/${id}`,
        type:"DELETE",
        success:function (result) {
            var res = JSON.parse(result);

            $.toast({
                icon: res.success ? 'success' : 'error',
                heading: res.success ? 'Success' : 'Error',
                text: res.message,
                showHideTransition: 'fade',
                hideAfter: 3000,
                allowToastClose: true,
                position: 'top-center',
                stack: false,
                loader: false,
            });

            $('#delete_recurring_transaction').modal('hide');

            $('#recurring_transactions').DataTable().ajax.reload();
        }
    });
});

$(document).on('click', '#recurring_transactions .edit-recurring', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent();
    var rowData = table.row(row).data();
    var modal = '';
    var modalName = '';
    var view = '';

    switch(rowData.txn_type) {
        case 'Deposit' :
            modal = 'bank_deposit';
            modalName = 'depositModal';
            view = 'bank_deposit_modal';
        break;
        case 'Journal Entry' :
            modal = 'journal_entry';
            modalName = 'journalEntryModal';
            view = 'journal_entry_modal';
        break;
        case 'Transfer' :
            modal = 'transfer';
            modalName = 'transferModal';
            view = 'transfer_modal';
        break;
    }

    append_modal(view, modalName, modal);

    $.get(`/accounting/recurring-transactions/get-details/${rowData.id}`, function(res) {
        var result = JSON.parse(res);

        if(result.success === false) {
            $.toast({
                icon: result.success ? 'success' : 'error',
                heading: result.success ? 'Success' : 'Error',
                text: result.message,
                showHideTransition: 'fade',
                hideAfter: 3000,
                allowToastClose: true,
                position: 'top-center',
                stack: false,
                loader: false,
            });
        } else {
            var data = result.data;

            set_modal_data(data, modalName);

            $(`#${modalName}`).modal('show');
        }
    });
});

function append_modal(view, modalName, modal) {
    $.get(GET_OTHER_MODAL_URL+view, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        if($('div#modal-container table').length > 0) {
            rowCount = $('div#modal-container table tbody tr').length;
            rowInputs = $('div#modal-container table tbody tr:first-child()').html();
            blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();

            $('div#modal-container table.clickable tbody tr:first-child()').html(blankRow);
            $('div#modal-container table.clickable tbody tr:first-child() td:nth-child(2)').html(1);
        }

        if(modalName === 'depositModal') {
            $('div#depositModal select#tags').select2({
                placeholder: 'Start typing to add a tag',
                allowClear: true,
                ajax: {
                    url: '/accounting/get-job-tags',
                    dataType: 'json'
                }
            });
        }

        makeRecurring(modal);

        if($(`#${modalName} .date`).length > 0) {
            $(`#${modalName} .date`).each(function(){
                $(this).datepicker({
                    uiLibrary: 'bootstrap'
                });
            });
        }
    });
}

function set_modal_data(data, modalName) {
    var txnType = data.txn_type.replace(" ", "_");
    $(`#${modalName}`).parent('form').removeAttr('onsubmit').attr('id', 'update-recurring-form').addClass(`update-recurring-${txnType}-${data.id}`);
    switch(modalName) {
        case 'depositModal' :
            $(`#depositModal #memo`).val(data.transaction.memo);
            $(`#depositModal #cashBackTarget`).val(data.transaction.cash_back_account_key+'-'+data.transaction.cash_back_account_id);
            $(`#depositModal #cashBackMemo`).val(data.transaction.cash_back_memo);

            if(data.transaction.cash_back_amount !== 0 && data.transaction.cash_back_amount !== "0") {
                $(`#depositModal #cashBackAmount`).val(data.transaction.cash_back_amount).trigger('change');
            }

            var tags = JSON.parse(data.transaction.tags);

            for(i in tags) {
                $(`#depositModal #tags`).append(`<option value="${tags[i]['id']}" selected>${tags[i]['name']}</option>`);
            }

            var items = data.transaction.items;
            for(i in items) {
                if($($(`#depositModal #bank-deposit-table tbody tr`)[i]).length === 0) {
                    $(`#depositModal #bank-deposit-table tbody`).append(`
                        <tr>
                            <td></td>
                            <td>${parseInt(i)+1}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    `)
                }

                $($(`#depositModal #bank-deposit-table tbody tr`)[i]).trigger('click');
                $($(`#depositModal #bank-deposit-table tbody tr`)[i]).find('[name="received_from[]"]').val(items[i].received_from_key+'-'+items[i].received_from_id);
                $($(`#depositModal #bank-deposit-table tbody tr`)[i]).find('[name="account[]"]').val(items[i].received_from_account_key+'-'+items[i].received_from_account_id);
                $($(`#depositModal #bank-deposit-table tbody tr`)[i]).find('[name="description[]"]').val(items[i].description);
                $($(`#depositModal #bank-deposit-table tbody tr`)[i]).find('[name="payment_method[]"]').val(items[i].payment_method);
                $($(`#depositModal #bank-deposit-table tbody tr`)[i]).find('[name="reference_no[]"]').val(items[i].ref_no);
                $($(`#depositModal #bank-deposit-table tbody tr`)[i]).find('[name="amount[]"]').val(items[i].amount).trigger('change');
            }
        break;
        case 'transferModal' :
            $(`#transferModal #transferFrom`).val(data.transaction.transfer_from_account_key+'-'+data.transaction.transfer_from_account_id).trigger('change');
            $(`#transferModal #transferTo`).val(data.transaction.transfer_to_account_key+'-'+data.transaction.transfer_to_account_id).trigger('change');
            $(`#transferModal #transferAmount`).val(data.transaction.transfer_amount).trigger('change');
            $(`#transferModal #memo`).val(data.transaction.transfer_memo);
        break;
        case 'journalEntryModal' :
            $(`#journalEntryModal #memo`).val(data.transaction.memo);

            var items = data.transaction.items;
            for(i in items) {
                if($($(`#journalEntryModal #bank-deposit-table tbody tr`)[i]).length === 0) {
                    $(`#journalEntryModal #journal-table tbody`).append(`
                        <tr>
                            <td></td>
                            <td>${parseInt(i)+1}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    `);
                }

                $($(`#journalEntryModal #journal-table tbody tr`)[i]).trigger('click');
                $($(`#journalEntryModal #journal-table tbody tr`)[i]).find('[name="accounts[]"]').val(`${items[i].account_key}-${items[i].account_id}`);

                if(items[i].debit !== null & items[i].debit !== "" && items[i].debit !== 0 && items[i].debit !== "0") {
                    $($(`#journalEntryModal #journal-table tbody tr`)[i]).find('[name="debits[]"]').val(items[i].debit).trigger('change');
                }

                if(items[i].credit !== null & items[i].credit !== "" && items[i].credit !== 0 && items[i].credit !== "0") {
                    $($(`#journalEntryModal #journal-table tbody tr`)[i]).find('[name="credits[]"]').val(items[i].credit).trigger('change');
                }
                $($(`#journalEntryModal #journal-table tbody tr`)[i]).find('[name="descriptions[]"]').val(items[i].description);

                if(items[i].name_id !== null) {
                    $($(`#journalEntryModal #journal-table tbody tr`)[i]).find('[name="names[]"]').val(`${items[i].name_key}-${items[i].name_id}`);
                }
            }
        break;
    }

    $(document).on('shown.bs.modal', `#${modalName}`, function(e) {
        $(`#${modalName} .recurring-bank-account #bankAccount`).val(`${data.transaction.account_key}-${+data.transaction.account_id}`);
        $(`#${modalName} #templateName`).val(data.template_name);
        $(`#${modalName} #recurringType`).val(data.recurring_type).trigger('change');
        $(`#${modalName} #dayInAdvance`).val(data.days_in_advance);

        if(data.recurring_interval !== null) {
            $(`#${modalName} #recurringInterval`).val(data.recurring_interval).trigger('change');
        }

        if(data.recurring_week !== null) {
            $(`#${modalName} select[name="recurring_week"]`).val(data.recurring_week).trigger('change');
        }

        if(data.recurring_day !== null) {
            $(`#${modalName} select[name="recurring_day"]`).val(data.recurring_day);
        }

        if(data.recurring_month !== null) {
            $(`#${modalName} select[name="recurring_month"]`).val(data.recurring_month);
        }

        if(data.recurr_every !== null) {
            $(`#${modalName} input[name="recurr_every"]`).val(data.recurr_every);
        }

        if(data.start_date !== null && data.start_date !== "") {
            var start_date = new Date(data.start_date);
            $(`#${modalName} #startDate`).val(`${String(start_date.getMonth() + 1).padStart(2, '0')}/${String(start_date.getDate()).padStart(2, '0')}/${start_date.getFullYear()}`);
        }

        if(data.end_type !== null) {
            $(`#${modalName} #endType`).val(data.end_type).trigger('change');
        }

        if(data.end_by !== null && data.end_type === 'by') {
            var end_date = new Date(data.end_date);
            $(`#${modalName} #endDate`).val(`${String(end_date.getMonth() + 1).padStart(2, '0')}/${String(end_date.getDate()).padStart(2, '0')}/${end_date.getFullYear()}`);
        }

        if(data.max_occurences !== null && data.end_type === 'after') {
            $(`#${modalName} #maxOccurence`).val(data.max_occurences);
        }
    });
}

$(document).on('submit', '#update-recurring-form', function(e) {
    e.preventDefault();

    var c = this.className;
    var split = c.split("-");
    var id = split[split.length - 1];
    var type = split[split.length - 2];

    var data = new FormData(this);

    $.ajax({
        url: `recurring-transactions/update/${type}/${id}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            var result = JSON.parse(res);
            $('.modal').modal('hide');

            $.toast({
                icon: result.success ? 'success' : 'error',
                heading: result.success ? 'Success' : 'Error',
                text: result.message,
                showHideTransition: 'fade',
                hideAfter: 3000,
                allowToastClose: true,
                position: 'top-center',
                stack: false,
                loader: false,
            });

            $('#recurring_transactions').DataTable().ajax.reload();
        }
    });
});
</script>