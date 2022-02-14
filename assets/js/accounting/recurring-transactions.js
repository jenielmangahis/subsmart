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
    var modalName = $('select#type').val();

    switch(modalName) {
        case 'depositModal' : 
            modal = 'bank_deposit';
            view = 'bank_deposit_modal';
        break;
        case 'journalEntryModal' :
            modal = 'journal_entry';
            view = 'journal_entry_modal';
        break;
        case 'transferModal' : 
            modal ='transfer';
            view = 'transfer_modal';
        break;
        case 'expenseModal' :
            modal ='expense';
            view = 'expense_modal';
        break;
        case 'checkModal' :
            modal ='check';
            view = 'check_modal';
        break;
        case 'billModal' :
            modal ='bill';
            view = 'bill_modal';
        break;
        case 'purchaseOrderModal' :
            modal ='purchase_order';
            view = 'purchase_order_modal';
        break;
        case 'vendorCreditModal' :
            modal ='vendor_credit';
            view = 'vendor_credit_modal';
        break;
        case 'creditCardCreditModal' :
            modal ='credit_card_credit';
            view = 'credit_card_credit_modal';
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
    }

    rowData.type = transactionType;

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

        initModalFields(modalName, rowData);

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
    }

    rowData.type = transactionType;

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

        initModalFields(modalName, rowData);

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
    }

    rowData.type = transactionType;

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

        initModalFields(modalName, rowData);

        makeRecurring(modal);

        getRowData(rowData.id, modalName);

        $(`#${modalName}`).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        $(`#${modalName}`).modal('show');
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

    if(vendorModals.includes('#'+$(this).children('.modal').attr('id'))) {
        var count = 0;
        var totalAmount = $(`#update-recurring-form .modal span.transaction-total-amount`).html().replace('$', '');
        data.append('total_amount', totalAmount);

        $(`#update-recurring-form .modal table#category-details-table tbody tr`).each(function() {
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
        $(`#update-recurring-form .modal table#item-details-table tbody tr`).each(function() {
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