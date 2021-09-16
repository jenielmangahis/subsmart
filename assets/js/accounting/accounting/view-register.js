const accountId = $('#account').val();

$('#registers-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: $('#table_rows').val(),
    order: [[0, 'desc']],
    ajax: {
        url: `/accounting/chart-of-accounts/${accountId}/load-registers`,
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.reconcile_status = $('#reconcile_status').val();
            d.transaction_type = $('#transaction_type').val();
            d.payee = $('#payee').val();
            d.from_date = $('#from').val();
            d.to_date = $('#to').val();
            d.length = $('#table_rows').val();
            d.columns[0].search.value = $('input#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: [
        {
            data: 'date',
            name: 'date'
        },
        {
            data: 'ref_no',
            name: 'ref_no'
        },
        {
            data: 'type',
            name: 'type'
        },
        {
            data: 'payee',
            name: 'payee'
        },
        {
            orderable: false,
            data: 'account',
            name: 'account'
        },
        {
            orderable: false,
            data: 'memo',
            name: 'memo',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('memo');

                if($('#chk_memo').prop('checked') === false) {
                    $(td).addClass('d-none');
                }
            }
        },
        {
            data: 'payment',
            name: 'payment'
        },
        {
            data: 'deposit',
            name: 'deposit'
        },
        {
            data: 'reconcile_status',
            name: 'reconcile_status',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('reconcile_status');

                if($('#chk_reconcile_status').prop('checked') === false) {
                    $(td).addClass('d-none');
                }
            }
        },
        {
            orderable: false,
            data: 'banking_status',
            name: 'banking_status',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('banking_status');

                if($('#chk_banking_status').prop('checked') === false) {
                    $(td).addClass('d-none');
                }
            }
        },
        {
            orderable: false,
            data: 'attachments',
            name: 'attachments',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('attachments');

                if($('#chk_attachments').prop('checked') === false) {
                    $(td).addClass('d-none');
                }
            }
        },
        {
            orderable: false,
            data: 'tax',
            name: 'tax',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('tax');

                if($('#chk_tax').prop('checked') === false) {
                    $(td).addClass('d-none');
                }
            }
        },
        {
            orderable: false,
            data: 'balance',
            name: 'balance',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('running_balance');

                if($('#chk_running_balance').prop('checked') === false) {
                    $(td).addClass('d-none');
                }
            }
        }
    ]
});

$('select').each(function() {
    var dropdownType = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');

    if(dropdownType === 'account') {
        dropdownType = 'register-account';
    }

    if($(this).find('option').length > 1) {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    } else {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: dropdownType
                    }
    
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });
    }
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#from').datepicker({
    uiLibrary: 'bootstrap'
});

$('#to').datepicker({
    uiLibrary: 'bootstrap'
});

$('#account').on('change', function() {
    location.href = `/accounting/chart-of-accounts/view-register/${$(this).val()}`
});

function col(el) {
    var el = $(el);
    var col = el.attr('id').replace('chk_', '');

    if(el.prop('checked')) {
        $(`#registers-table .${col}`).removeClass('d-none');
    } else {
        $(`#registers-table .${col}`).addClass('d-none');
    }
}