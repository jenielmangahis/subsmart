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
    var view = '';
    var transaction = $('select#type').val();
    var modalName = '';

    switch(transaction) {
        case 'deposit' : 
            modal = 'bank_deposit';
            view = 'bank_deposit_modal';
            modalName = 'depositModal';
        break;
        case 'journal-entry' :
            modal = 'journal_entry';
            view = 'journal_entry_modal';
            modalName = 'journalEntryModal';
        break;
        case 'transfer' : 
            modal ='transfer';
            view = 'transfer_modal';
            modalName = 'transferModal';
        break;
        case 'expense' :
            modal ='expense';
            view = 'expense_modal';
            modalName = 'expenseModal';
        break;
        case 'check' :
            modal ='check';
            view = 'check_modal';
            modalName = 'checkModal';
        break;
        case 'bill' :
            modal ='bill';
            view = 'bill_modal';
            modalName = 'billModal';
        break;
        case 'purchase-order' :
            modal ='purchase_order';
            view = 'purchase_order_modal';
            modalName = 'purchaseOrderModal';
        break;
        case 'vendor-credit' :
            modal ='vendor_credit';
            view = 'vendor_credit_modal';
            modalName = 'vendorCreditModal';
        break;
        case 'credit-card-credit' :
            modal ='credit_card_credit';
            view = 'credit_card_credit_modal';
            modalName = 'creditCardCreditModal';
        break;
        case 'invoice' :
            modal ='invoice';
            view = 'invoice_modal';
            modalName = 'invoiceModal';
        break;
        case 'credit-memo' :
            modal ='credit_memo';
            view = 'credit_memo_modal';
            modalName = 'creditMemoModal';
        break;
        case 'sales-receipt' :
            modal ='sales_receipt';
            view = 'sales_receipt_modal';
            modalName = 'salesReceiptModal';
        break;
        case 'refund-receipt' :
            modal ='refund_receipt';
            view = 'refund_receipt_modal';
            modalName = 'refundReceiptModal';
        break;
        case 'non-posting-credit' :
            modal ='delayed_credit';
            view = 'delayed_credit_modal';
            modalName = 'delayedCreditModal';
        break;
        case 'non-posting-charge' :
            modal ='delayed_charge';
            view = 'delayed_charge_modal';
            modalName = 'delayedChargeModal';
        break;
    }

    $('#transaction_type_modal').modal('hide');

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

        initModalFields(modalName);

        makeRecurring(modal);

        $(`#${modalName}`).modal('show');
    });
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

$('select').select2({
    minimumResultsForSearch: -1
});

const columns = [
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
            if(rowData.status === "2") {
                $(td).html(`
                <div class="btn-group float-right">
                    <a href="#" class="edit-recurring btn text-primary d-flex align-items-center justify-content-center">Edit</a>

                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item use-transaction" href="#">Use</a>
                        <a class="dropdown-item duplicate-transaction" href="#">Duplicate</a>
                        <a class="dropdown-item resume-recurring" href="#">Resume</a>
                        <a class="dropdown-item delete-recurring" href="#">Delete</a>
                    </div>
                </div>
                `);
            } else {
                $(td).html(`
                <div class="btn-group float-right">
                    <a href="#" class="edit-recurring btn text-primary d-flex align-items-center justify-content-center">Edit</a>

                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item use-transaction" href="#">Use</a>
                        <a class="dropdown-item duplicate-transaction" href="#">Duplicate</a>
                        <a class="dropdown-item pause-recurring" href="#">Pause</a>
                        <a class="dropdown-item skip-next-date" href="#">Skip next date</a>
                        <a class="dropdown-item delete-recurring" href="#">Delete</a>
                    </div>
                </div>
                `);
            }
        }
    }
];

var table = $('#recurring_transactions').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: $('#table_rows').val(),
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
    columns: columns
});

$(document).on('click', '#recurring_transactions .delete-recurring', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent();
    var rowData = table.row(row).data();

    Swal.fire({
        title: 'Are you sure you want to delete this?',
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
				url: `/accounting/recurring-transactions/delete/${rowData.id}`,
				type: 'DELETE',
				success: function(result) {
                    $('#recurring_transactions').DataTable().ajax.reload();
				}
			});
        }
    });
});

$(document).on('click', '#recurring_transactions .edit-recurring', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent();
    var rowData = table.row(row).data();
    var modal = '';
    var modalName = '';
    var transactionType = '';

    switch(rowData.txn_type) {
        case 'Deposit' :
            transactionType = 'deposit';
            modal = 'bank_deposit';
            modalName = 'depositModal';
        break;
        case 'Journal Entry' :
            transactionType = 'journal';
            modal = 'journal_entry';
            modalName = 'journalEntryModal';
        break;
        case 'Transfer' :
            transactionType = 'transfer';
            modal = 'transfer';
            modalName = 'transferModal';
        break;
        case 'Expense' :
            transactionType = 'expense';
            modal = 'expense';
            modalName = 'expenseModal';
        break;
        case 'Check' :
            transactionType = 'check';
            modal = 'check';
            modalName = 'checkModal';
        break;
        case 'Bill' :
            transactionType = 'bill';
            modal = 'bill';
            modalName = 'billModal';
        break;
        case 'Purchase Order' :
            transactionType = 'purchase-order';
            modal = 'purchase_order';
            modalName = 'purchaseOrderModal';
        break;
        case 'Vendor Credit' :
            transactionType = 'vendor-credit';
            modal = 'vendor_credit';
            modalName = 'vendorCreditModal';
        break;
        case 'Credit Card Credit' :
            transactionType = 'cc-credit';
            modal = 'credit_card_credit';
            modalName = 'creditCardCreditModal';
        break;
        case 'Invoice' :
            transactionType = 'invoice';
            modal = 'invoice';
            modalName = 'invoiceModal';
        break;
        case 'Credit Memo' :
            transactionType = 'credit-memo';
            modal = 'credit_memo';
            modalName = 'creditMemoModal';
        break;
        case 'Sales Receipt' :
            transactionType = 'sales-receipt';
            modal = 'sales_receipt';
            modalName = 'salesReceiptModal';
        break;
        case 'Refund' :
            transactionType = 'refund-receipt';
            modal = 'refund_receipt';
            modalName = 'refundReceiptModal';
        break;
        case 'Credit' :
            transactionType = 'delayed-credit';
            modal = 'delayed_credit';
            modalName = 'delayedCreditModal';
        break;
        case 'Charge' :
            transactionType = 'delayed-charge';
            modal = 'delayed_charge';
            modalName = 'delayedChargeModal';
        break;
    }

    var transactionData = {
        id: rowData.txn_id,
        type: transactionType
    };

    $.get(`/accounting/view-transaction/${transactionType}/${rowData.txn_id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields(modalName, transactionData);

        makeRecurring(modal);

        getRowData(rowData.id, modalName);

        $(`#${modalName}`).modal('show');
    });
});

$(document).on('click', '#recurring_transactions .use-transaction', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var rowData = table.row(row).data();
    var transactionType = '';
    var modalName = '';
    var centerFooter = '';

    switch(rowData.txn_type) {
        case 'Deposit' :
            transactionType = 'deposit';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" onclick="viewPrint(1, 'deposit-summary')" class="text-white">Print deposit summary</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" onclick="makeRecurring('bank_deposit')" class="text-white">Make recurring</a></span>
                </div>
            </div>`;
            modalName = 'depositModal';
        break;
        case 'Journal Entry' :
            transactionType = 'journal';
            centerFooter = `<a href="#" class="text-white m-auto" onclick="makeRecurring('journal_entry')">Make Recurring</a>`;
            modalName = 'journalEntryModal';
        break;
        case 'Transfer' :
            transactionType = 'transfer';
            centerFooter = `<a href="#" class="text-white m-auto" onclick="makeRecurring('transfer')">Make Recurring</a>`;
            modalName = 'transferModal';
        break;
        case 'Expense' :
            transactionType = 'expense';
            centerFooter = `<a href="#" class="text-white m-auto" onclick="makeRecurring('expense')">Make Recurring</a>`;
            modalName = 'expenseModal';
        break;
        case 'Check' :
            transactionType = 'check';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-white" id="print-check">Print check</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-white m-auto" onclick="makeRecurring('check')">Make Recurring</a></span>
                    <span class="mx-3 divider"></span>
                    <span>
                        <div class="dropup">
                            <a href="#" class="text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                            <div class="dropdown-menu dropdown-menu-align-right">
                                <a class="dropdown-item" href="#" onclick="saveAndVoid(event)" id="save-and-void">Void</a>
                            </div>
                        </div>
                    </span>
                </div>
            </div>`;
            modalName = 'checkModal';
        break;
        case 'Bill' :
            transactionType = 'bill';
            centerFooter = `<a href="#" class="text-white m-auto" onclick="makeRecurring('bill')">Make Recurring</a>`;
            modalName = 'billModal';
        break;
        case 'Purchase Order' :
            transactionType = 'purchase-order';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-white" id="save-and-print">Print</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" onclick="makeRecurring('purchase_order')" class="text-white">Make recurring</a></span>
                </div>
            </div>`;
            modalName = 'purchaseOrderModal';
        break;
        case 'Vendor Credit' :
            transactionType = 'vendor-credit';
            centerFooter = `<a href="#" class="text-white m-auto" onclick="makeRecurring('vendor_credit')">Make Recurring</a>`;
            modalName = 'vendorCreditModal';
        break;
        case 'Credit Card Credit' :
            transactionType = 'cc-credit';
            centerFooter = `<a href="#" class="text-white m-auto" onclick="makeRecurring('credit_card_credit')">Make Recurring</a>`;
            modalName = 'creditCardCreditModal';
        break;
        case 'Invoice' :
            transactionType = 'invoice';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-white" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-white" onclick="makeRecurring('invoice')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'invoiceModal';
        break;
        case 'Credit Memo' :
            transactionType = 'credit-memo';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-white" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-white" onclick="makeRecurring('credit_memo')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'creditMemoModal';
        break;
        case 'Sales Receipt' :
            transactionType = 'sales-receipt';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-white" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-white" onclick="makeRecurring('sales_receipt')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'salesReceiptModal';
        break;
        case 'Refund' :
            transactionType = 'refund-receipt';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-white" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-white" onclick="makeRecurring('refund_receipt')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'refundReceiptModal';
        break;
        case 'Credit' :
            transactionType = 'delayed-credit';
            centerFooter = `<a href="#" class="text-white m-auto" onclick="makeRecurring('delayed_credit')">Make Recurring</a>`;
            modalName = 'delayedCreditModal';
        break;
        case 'Charge' :
            transactionType = 'delayed-charge';
            centerFooter = `<a href="#" class="text-white m-auto" onclick="makeRecurring('delayed_charge')">Make Recurring</a>`;
            modalName = 'delayedChargeModal';
        break;
    }

    var transactionData = {
        id: rowData.txn_id,
        type: transactionType
    };

    $.get(`/accounting/view-transaction/${transactionType}/${rowData.txn_id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields(modalName, transactionData);

        $('#billModal .payee-details .transaction-total-amount').parent().next().remove();
        $(`#${modalName} .modal-footer .row .col-md-4:nth-child(2)`).html(centerFooter);

        if($(`#${modalName} .modal-footer .row .col-md-4:nth-child(2)`).children('div:first-child()').hasClass('row') === false) {
            $(`#${modalName} .modal-footer .row .col-md-4:nth-child(2)`).addClass('d-flex');
        }

        $(`#${modalName} .modal-header .modal-title span`).html('');
        $(`#${modalName}`).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        $(`#${modalName}`).modal('show');
    });
});

$(document).on('click', '#recurring_transactions .duplicate-transaction', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var rowData = table.row(row).data();
    var transactionType = '';
    var modalName = '';

    switch(rowData.txn_type) {
        case 'Deposit' :
            transactionType = 'deposit';
            modal = 'bank_deposit';
            modalName = 'depositModal';
        break;
        case 'Journal Entry' :
            transactionType = 'journal';
            modal = 'journal_entry';
            modalName = 'journalEntryModal';
        break;
        case 'Transfer' :
            transactionType = 'transfer';
            modal = 'transfer';
            modalName = 'transferModal';
        break;
        case 'Expense' :
            transactionType = 'expense';
            modal = 'expense';
            modalName = 'expenseModal';
        break;
        case 'Check' :
            transactionType = 'check';
            modal = 'check';
            modalName = 'checkModal';
        break;
        case 'Bill' :
            transactionType = 'bill';
            modal = 'bill';
            modalName = 'billModal';
        break;
        case 'Purchase Order' :
            transactionType = 'purchase-order';
            modal = 'purchase_order';
            modalName = 'purchaseOrderModal';
        break;
        case 'Vendor Credit' :
            transactionType = 'vendor-credit';
            modal = 'vendor_credit';
            modalName = 'vendorCreditModal';
        break;
        case 'Credit Card Credit' :
            transactionType = 'cc-credit';
            modal = 'credit_card_credit';
            modalName = 'creditCardCreditModal';
        break;
        case 'Invoice' :
            transactionType = 'invoice';
            modal = 'invoice';
            modalName = 'invoiceModal';
        break;
        case 'Credit Memo' :
            transactionType = 'credit-memo';
            modal = 'credit_memo';
            modalName = 'creditMemoModal';
        break;
        case 'Sales Receipt' :
            transactionType = 'sales-receipt';
            modal = 'sales_receipt';
            modalName = 'salesReceiptModal';
        break;
        case 'Refund' :
            transactionType = 'refund-receipt';
            modal = 'refund_receipt';
            modalName = 'refundReceiptModal';
        break;
        case 'Credit' :
            transactionType = 'delayed-credit';
            modal = 'delayed_credit';
            modalName = 'delayedCreditModal';
        break;
        case 'Charge' :
            transactionType = 'delayed-charge';
            modal = 'delayed_charge';
            modalName = 'delayedChargeModal';
        break;
    }

    var transactionData = {
        id: rowData.txn_id,
        type: transactionType
    };

    $.get(`/accounting/copy-transaction/${transactionType}/${rowData.txn_id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        initModalFields(modalName, transactionData);

        makeRecurring(modal);

        getRowData(rowData.id, modalName);

        $(`#${modalName}`).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        $(`#${modalName}`).modal('show');
    });
});

$(document).on('click', '#recurring_transactions .skip-next-date', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var rowData = table.row(row).data();

    Swal.fire({
        title: 'Skip Next Date?',
        html: `Are you sure you want to skip the next occurrence on ${rowData.next_date} for this recurring transaction?`,
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Skip next date',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get(`/accounting/recurring-transactions/skip-next-date/${rowData.id}`, function(res) {
                var result = JSON.parse(res);

                if(result.success) {
                    table.ajax.reload(null, true);
                }
            });
        }
    });
});

$(document).on('click', '#recurring_transactions .pause-recurring', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var rowData = table.row(row).data();

    Swal.fire({
        title: 'Pause Recurring Transaction',
        html: `Are you sure you want to pause this recurring transaction?`,
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Pause',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get(`/accounting/recurring-transactions/pause/${rowData.id}`, function(res) {
                var result = JSON.parse(res);

                if(result.success) {
                    table.ajax.reload(null, true);
                }
            });
        }
    });
});

$(document).on('click', '#recurring_transactions .resume-recurring', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var rowData = table.row(row).data();

    Swal.fire({
        title: 'Resume Recurring Transaction',
        html: `Are you sure you want to resume this recurring transaction?`,
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Resume',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get(`/accounting/recurring-transactions/resume/${rowData.id}`, function(res) {
                var result = JSON.parse(res);

                if(result.success) {
                    table.ajax.reload(null, true);
                }
            });
        }
    });
});

function getRowData(id, modalName)
{
    $.get(`/accounting/recurring-transactions/get-details/${id}`, function(res) {
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
        }
    });
}

function set_modal_data(data, modalName)
{
    var txnType = data.txn_type.replaceAll(" ", "-");
    $(`#${modalName}`).parent('form').removeAttr('onsubmit').attr('id', 'update-recurring-form').attr('data-href', `/accounting/recurring-transactions/update/${txnType}/${data.id}`);

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
}

$(document).on('submit', '#update-recurring-form', function(e) {
    e.preventDefault();

    var data = new FormData(this);

    switch($(this).children('.modal').attr('id')) {
        case 'journalEntryModal' :
            data.delete('names[]');

            $('#journalEntryModal #journal-table tbody tr select[name="names[]"]').each(function() {
                if(data.has('names[]') === false) {
                    data.set('names[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('names[]', $(this).val() === null ? '' : $(this).val());
                }
            });
        break;
        case 'depositModal' :
            data.delete('received_from[]');
            data.delete('payment_method[]');
    
            $('#depositModal #bank-deposit-table tbody tr select[name="received_from[]"]').each(function() {
                if(data.has('received_from[]') === false) {
                    data.set('received_from[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('received_from[]', $(this).val() === null ? '' : $(this).val());
                }
            });
    
            $('#depositModal #bank-deposit-table tbody tr select[name="payment_method[]"]').each(function() {
                if(data.has('payment_method[]') === false) {
                    data.set('payment_method[]', $(this).val() === null ? '' : $(this).val());
                } else {
                    data.append('payment_method[]', $(this).val() === null ? '' : $(this).val());
                }
            });
        break;
    }

    if(customerModals.includes('#'+$(this).children('.modal').attr('id'))) {
        data.delete('item[]');
        data.delete('package[]');
        data.delete('location[]');
        data.delete('quantity[]');
        data.delete('item_amount[]');
        data.delete('discount[]');
        data.delete('item_tax[]');
        $(this).children('.modal').find(`table#item-table tbody:not(#package-items-table) tr:not(.package-items, .package-item, .package-item-header)`).each(function() {
            if(data.has('item_total[]')) {
                if($(this).hasClass('package')) {
                    data.append('item[]', 'package-'+$(this).find('input[name="package[]"]').val());
                    data.append('location[]', null);
                    data.append('item_amount[]', $(this).find('span.item-amount').html());
                    data.append('discount[]', null);
                } else {
                    data.append('item[]', 'item-'+$(this).find('input[name="item[]"]').val());
                    data.append('location[]', $(this).find('select[name="location[]"]').val());
                    data.append('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.append('discount[]', $(this).find('input[name="discount[]"]').val());
                }
                data.append('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                data.append('quantity[]', $(this).find('input[name="quantity[]"]').val());
                data.append('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
            } else {
                if($(this).hasClass('package')) {
                    data.set('item[]', 'package-'+$(this).find('input[name="package[]"]').val());
                    data.set('location[]', null);
                    data.set('item_amount[]', $(this).find('span.item-amount').html());
                    data.set('discount[]', null);
                } else {
                    data.set('item[]', 'item-'+$(this).find('input[name="item[]"]').val());
                    data.set('location[]', $(this).find('select[name="location[]"]').val());
                    data.set('item_amount[]', $(this).find('input[name="item_amount[]"]').val());
                    data.set('discount[]', $(this).find('input[name="discount[]"]').val());
                }
                data.set('item_tax[]', $(this).find('input[name="item_tax[]"]').val());
                data.set('quantity[]', $(this).find('input[name="quantity[]"]').val());
                data.set('item_total[]', $(this).find('span.row-total').html().replace('$', ''));
            }
        });

        data.set('total_amount', $(this).children('.modal').find(`.transaction-grand-total:first-child`).html().replace('$', '').trim());
        data.set('subtotal', $(this).children('.modal').find(`.transaction-subtotal:first-child`).html().replace('$', '').trim());
        data.set('tax_total', $(this).children('.modal').find(`.transaction-taxes:first-child`).html().replace('$', '').trim());
        data.set('discount_total', $(this).children('.modal').find(`.transaction-discounts:first-child`).html().replace('$', '').trim());
    }

    if(vendorModals.includes('#'+$(this).children('.modal').attr('id'))) {
        var count = 0;
        var totalAmount = $(this).children('.modal').find(`span.transaction-total-amount`).html().replace('$', '');
        data.append('total_amount', totalAmount);

        $(this).children('.modal').find(`table#category-details-table tbody tr`).each(function() {
            var billable = $(this).find('input[name="category_billable[]"]');
            var tax = $(this).find('input[name="category_tax[]"]');

            if(billable.length > 0 && tax.length > 0) {
                if(count === 0) {
                    data.set('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.set('category_tax[]', tax.prop('checked') ? "1" : "0");
                    data.set('category_linked[]', $(this).find('i.fa.fa-link').length > 0);
                } else {
                    data.append('category_billable[]', billable.prop('checked') ? "1" : "0");
                    data.append('category_tax[]', tax.prop('checked') ? "1" : "0");
                    data.append('category_linked[]', $(this).find('i.fa.fa-link').length > 0);
                }
            }

            count++;
        });

        count = 0;
        $(this).children('.modal').find(`table#item-details-table tbody tr`).each(function() {
            if(count === 0) {
                data.set('item_total[]', $(this).find('td span.row-total').html().replace('$', ''));
                data.set('item_linked[]', $(this).find('i.fa.fa-link').length > 0);
            } else {
                data.append('item_total[]', $(this).find('td span.row-total').html().replace('$', ''));
                data.append('item_linked[]', $(this).find('i.fa.fa-link').length > 0);
            }

            count++;
        });
    }

    $.ajax({
        url: $(this).attr('data-href'),
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

$(document).on('click', '#print-recurring-transactions', function(e) {
    e.preventDefault();

    var data = new FormData();

    data.set('type', $('#template-type').val());
    data.set('transaction_type', $('#transaction-type').val());
    data.set('search', $('input#search').val());

    var tableOrder = $('#recurring_transactions').DataTable().order();
    data.set('column', columns[tableOrder[0][0]].name);
    data.set('order', tableOrder[0][1]);

    $.ajax({
        url: '/accounting/recurring-transactions/print-recurring-transactions',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            let pdfWindow = window.open("");
			pdfWindow.document.write(`<h3>Recurring Transactions</h3>`);
            pdfWindow.document.write(result);
            $(pdfWindow.document).find('body').css('padding', '0');
            $(pdfWindow.document).find('body').css('margin', '0');
            $(pdfWindow.document).find('iframe').css('border', '0');
            pdfWindow.print();
        }
    });
});