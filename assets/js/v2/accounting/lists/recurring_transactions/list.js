$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function(e) {
    e.stopPropagation();
});

$("#transactions-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#transactions-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#filter-template-type, #filter-transaction-type').select2({
    minimumResultsForSearch: -1
});

$('#transaction-type-modal #type').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#transaction-type-modal')
});

$('#apply-button').on('click', function() {
    var templateType = $('#filter-template-type').val();
    var transactionType = $('#filter-transaction-type').val();
    var search = $('#search_field').val();

    var url = `${base_url}accounting/recurring-transactions?`;

    url += search !== '' ? `search=${search}&` : '';
    url += templateType !== 'all' ? `template-type=${templateType}&` : '';
    url += transactionType !== 'all' ? `transaction-type=${transactionType}&` : '';

    if(url.slice(-1) === '#') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$("#btn_print_recurring_transactions").on("click", function() {
    $("#recurring_transactions_table_print").printThis();
});

$('#transaction-type-modal #submit-transaction-type').on('click', function(e) {
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

    $('#transaction-type-modal').modal('hide');

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

$('#transactions-table .edit-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().id;
    var transactionId = row.data().transaction_id;
    var type = row.find('td:nth-child(3)').text().trim();

    var modal = '';
    var modalName = '';
    var transactionType = '';
    switch(type) {
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
        id: transactionId,
        type: transactionType
    };

    $.get(`/accounting/view-transaction/${transactionType}/${transactionId}`, function(res) {
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

        getRowData(id, modalName);

        $(`#${modalName}`).modal('show');
    });
});

$('#transactions-table .use-transaction').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var transactionId = row.data().transaction_id;
    var type = row.find('td:nth-child(3)').text().trim();

    var transactionType = '';
    var modalName = '';
    var centerFooter = '';
    switch(type) {
        case 'Deposit' :
            transactionType = 'deposit';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" onclick="viewPrint(1, 'deposit-summary')" class="text-dark">Print deposit summary</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" onclick="makeRecurring('bank_deposit')" class="text-dark">Make recurring</a></span>
                </div>
            </div>`;
            modalName = 'depositModal';
        break;
        case 'Journal Entry' :
            transactionType = 'journal';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('journal_entry')">Make Recurring</a>`;
            modalName = 'journalEntryModal';
        break;
        case 'Transfer' :
            transactionType = 'transfer';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('transfer')">Make Recurring</a>`;
            modalName = 'transferModal';
        break;
        case 'Expense' :
            transactionType = 'expense';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('expense')">Make Recurring</a>`;
            modalName = 'expenseModal';
        break;
        case 'Check' :
            transactionType = 'check';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="print-check">Print check</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark m-auto" onclick="makeRecurring('check')">Make Recurring</a></span>
                    <span class="mx-3 divider"></span>
                    <span>
                        <div class="dropup">
                            <a href="#" class="text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
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
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('bill')">Make Recurring</a>`;
            modalName = 'billModal';
        break;
        case 'Purchase Order' :
            transactionType = 'purchase-order';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" onclick="makeRecurring('purchase_order')" class="text-dark">Make recurring</a></span>
                </div>
            </div>`;
            modalName = 'purchaseOrderModal';
        break;
        case 'Vendor Credit' :
            transactionType = 'vendor-credit';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('vendor_credit')">Make Recurring</a>`;
            modalName = 'vendorCreditModal';
        break;
        case 'Credit Card Credit' :
            transactionType = 'cc-credit';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('credit_card_credit')">Make Recurring</a>`;
            modalName = 'creditCardCreditModal';
        break;
        case 'Invoice' :
            transactionType = 'invoice';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark" onclick="makeRecurring('invoice')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'invoiceModal';
        break;
        case 'Credit Memo' :
            transactionType = 'credit-memo';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark" onclick="makeRecurring('credit_memo')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'creditMemoModal';
        break;
        case 'Sales Receipt' :
            transactionType = 'sales-receipt';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark" onclick="makeRecurring('sales_receipt')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'salesReceiptModal';
        break;
        case 'Refund' :
            transactionType = 'refund-receipt';
            centerFooter = `<div class="row h-100">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <span><a href="#" class="text-dark" id="save-and-print">Print or Preview</a></span>
                    <span class="mx-3 divider"></span>
                    <span><a href="#" class="text-dark" onclick="makeRecurring('refund_receipt')">Make Recurring</a></span>
                </div>
            </div>`;
            modalName = 'refundReceiptModal';
        break;
        case 'Credit' :
            transactionType = 'delayed-credit';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('delayed_credit')">Make Recurring</a>`;
            modalName = 'delayedCreditModal';
        break;
        case 'Charge' :
            transactionType = 'delayed-charge';
            centerFooter = `<a href="#" class="text-dark m-auto" onclick="makeRecurring('delayed_charge')">Make Recurring</a>`;
            modalName = 'delayedChargeModal';
        break;
    }

    var transactionData = {
        id: transactionId,
        type: transactionType
    };

    $.get(`/accounting/view-transaction/${transactionType}/${transactionId}`, function(res) {
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

$('#transactions-table .duplicate-transaction').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.data().id;
    var transactionId = row.data().transaction_id;
    var type = row.find('td:nth-child(3)').text().trim();

    var transactionType = '';
    var modalName = '';

    switch(type) {
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
        id: transactionId,
        type: transactionType
    };

    $.get(`/accounting/copy-transaction/${transactionType}/${transactionId}`, function(res) {
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

        getRowData(id, modalName);

        $(`#${modalName}`).parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        $(`#${modalName}`).modal('show');
    });
});

$('#transactions-table .delete-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

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
				url: `/accounting/recurring-transactions/delete/${row.data().id}`,
				type: 'DELETE',
				success: function(result) {
                    location.reload();
				}
			});
        }
    });
});

$('#transactions-table .resume-recurring').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');

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
            $.get(`/accounting/recurring-transactions/resume/${row.data().id}`, function(res) {
                var result = JSON.parse(res);

                if(result.success) {
                    location.reload();
                }
            });
        }
    });
});

$('#transactions-table .pause-recurring').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');

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
            $.get(`/accounting/recurring-transactions/pause/${row.data().id}`, function(res) {
                var result = JSON.parse(res);

                if(result.success) {
                    location.reload();
                }
            });
        }
    });
});

$('#transactions-table .skip-next-date').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var nextDate = row.find('td:nth-child(6)').text().trim();

    Swal.fire({
        title: 'Skip Next Date?',
        html: `Are you sure you want to skip the next occurrence on ${nextDate} for this recurring transaction?`,
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Skip next date',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get(`/accounting/recurring-transactions/skip-next-date/${row.data().id}`, function(res) {
                var result = JSON.parse(res);

                if(result.success) {
                    location.reload();
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