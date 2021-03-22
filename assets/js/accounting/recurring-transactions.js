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