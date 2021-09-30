const accountId = $('#account').val();
let type = $('.page-title').html().replace(' Register', '');
var columns = [
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
        name: 'payment',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData !== '') {
                $(td).html(`$${cellData}`);
            }
        }
    },
    {
        data: 'deposit',
        name: 'deposit',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData !== '') {
                $(td).html(`$${cellData}`);
            }
        }
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
];

if(type === 'Asset') {
    columns = [
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
            data: 'decrease',
            name: 'decrease'
        },
        {
            data: 'increase',
            name: 'increase'
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
    ];
}

if(type === 'A/R' || type === 'A/P') {
    columns = [
        {
            orderable: false,
            data: 'date',
            name: 'date'
        },
        {
            orderable: false,
            data: 'ref_no',
            name: 'ref_no'
        },
        {
            orderable: false,
            data: 'customer',
            name: 'customer'
        },
        {
            orderable: false,
            data: 'memo',
            name: 'memo'
        },
        {
            orderable: false,
            data: 'due_date',
            name: 'due_date'
        },
        {
            orderable: false,
            data: 'charge_credit',
            name: 'charge_credit'
        },
        {
            orderable: false,
            data: 'payment',
            name: 'payment'
        },
        {
            orderable: false,
            data: 'open_balance',
            name: 'open_balance',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('open_balance');
    
                if($('#chk_open_balance').prop('checked') === false) {
                    $(td).addClass('d-none');
                }
            }
        }
    ];

    if(type === 'A/P') {
        columns[2] = {
            orderable: false,
            data: 'vendor',
            name: 'vendor'
        };
        columns[5] = {
            orderable: false,
            data: 'billed',
            name: 'billed'
        };
        columns[6] = {
            orderable: false,
            data: 'paid',
            name: 'paid'
        };
    }
}

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
    columns: columns
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

$('#date').on('change', function() {
    switch($(this).val()) {
        case 'today' :
            var today = new Date();
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            today = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            $('#from, #to').val(today);
        break;
        case 'yesterday' :
            var yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);
            var yesterdayDate = String(yesterday.getDate()).padStart(2, '0');
            var yesterdayMonth = String(yesterday.getMonth() + 1).padStart(2, '0');
            yesterday = yesterdayMonth + '/' + yesterdayDate + '/' + yesterday.getFullYear();

            $('#from, #to').val(yesterday);
        break;
        default :
            $('#from, #to').val('');
        break;
    }
});

$('#reset-filter').on('click', function(e) {
    e.preventDefault();

    $('#search').val('');
    $('#reconcile_status').val('all').trigger('change');
    $('#transaction_type').val('all').trigger('change');
    $('#payee').val('all').trigger('change');
    $('#date').val('all').trigger('change');
    $('#from, #to').val('');

    $('#apply-filter').trigger('click');
});

$('#apply-filter').on('click', function(e) {
    e.preventDefault();

    $('#registers-table').DataTable().ajax.reload(null, true);
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