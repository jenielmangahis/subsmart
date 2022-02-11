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

// $('#transaction_type_modal .modal-footer .btn-success').on('click', function(e) {
//     e.preventDefault();

//     var modal = '';
//     var view = '';
//     var modalName = $('select#type').val();

//     switch(modalName) {
//         case 'depositModal' : 
//             modal = 'bank_deposit';
//             view = 'bank_deposit_modal';
//         break;
//         case 'journalEntryModal' :
//             modal = 'journal_entry';
//             view = 'journal_entry_modal';
//         break;
//         case 'transferModal' : 
//             modal ='transfer';
//             view = 'transfer_modal';
//         break;
//     }

//     append_modal(view, modalName, modal, 'create');

//     $('#transaction_type_modal').modal('hide');
// });

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
    // var view = '';
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

    // append_modal(view, modalName, modal, 'edit', rowData.id);
});

function append_modal(view, modalName, modal, method, id)
{
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

        $(`#${modalName} select`).select2();

        makeRecurring(modal);

        if($(`#${modalName} .date`).length > 0) {
            $(`#${modalName} .date`).each(function(){
                $(this).datepicker({
                    uiLibrary: 'bootstrap'
                });
            });
        }

        if(method === 'edit') {
            getRowData(id, modalName);
        }

        $(`#${modalName}`).modal('show');
    });
}

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
    var txnType = data.txn_type.replace(" ", "-");
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