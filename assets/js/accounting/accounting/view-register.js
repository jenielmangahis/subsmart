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

if(type === 'Credit Card') {
    columns[6] = {
        data: 'charge',
        name: 'charge',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData !== '') {
                $(td).html(`$${cellData}`);
            }
        }
    };

    columns[7] = {
        data: 'payment',
        name: 'payment',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData !== '') {
                $(td).html(`$${cellData}`);
            }
        }
    };
}

if(type === 'Asset' || type === 'Liability') {
    columns[6] = {
        data: type === 'Asset' ? 'decrease' : 'increase',
        name: type === 'Asset' ? 'decrease' : 'increase',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData !== '') {
                $(td).html(`$${cellData}`);
            }
        }
    };

    columns[7] = {
        data: type === 'Asset' ? 'increase' : 'decrease',
        name: type === 'Asset' ? 'increase' : 'decrease',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            if(cellData !== '') {
                $(td).html(`$${cellData}`);
            }
        }
    };
}

if(type === 'A/R' || type === 'A/P') {
    columns[0].orderable = false;
    columns[1].orderable = false;
    columns.splice(3, 2);
    columns[4] = {
        orderable: false,
        data: 'due_date',
        name: 'due_date'
    };

    if(type === 'A/R') {
        columns[2] = {
            orderable: false,
            data: 'customer',
            name: 'customer'
        };
        columns[5] = {
            orderable: false,
            data: 'charge_credit',
            name: 'charge_credit'
        };
        columns[6] = {
            orderable: false,
            data: 'payment',
            name: 'payment'
        };
    } else {
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
    columns[7] = {
        orderable: false,
        data: 'open_balance',
        name: 'open_balance',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            $(td).addClass('open_balance');

            if($('#chk_open_balance').prop('checked') === false) {
                $(td).addClass('d-none');
            }
        }
    };

    columns.splice(8, 3);
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
            d.single_line = $('#show_in_one_line').prop('checked') ? 1 : 0;
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

$('#show_in_one_line').on('change', function(e) {
    if($(this).prop('checked') === false) {
        $('#myTabContent .action-bar ul li .dropdown-menu input[type="checkbox"]').each(function() {
            if($(this).attr('id').includes('chk_')) {
                $(this).prop('checked', true).trigger('change');
            }
        });

        $('.reconcile-status-chk').remove();
        $('.banking-status-chk').addClass('reconcile-banking-status-chk').removeClass('banking-status-chk');
        $('#chk_banking_status').next().html('<p class="m-0">Reconcile and</p><p class="m-0">Banking Status</p>').attr('for', 'chk_reconcile_banking_status');
        $('#chk_banking_status').attr('name', 'chk_reconcile_banking_status').attr('id', 'chk_reconcile_banking_status');
    } else {
        $(`<div class="checkbox checkbox-sec d-block my-2 reconcile-status-chk">
            <input type="checkbox" name="chk_reconcile_status" id="chk_reconcile_status" onchange="col(this)">
            <label for="chk_reconcile_status">Reconcile Status</label>
        </div>`).insertBefore($('.reconcile-banking-status-chk'));
        $('.reconcile-banking-status-chk').addClass('banking-status-chk').removeClass('reconcile-banking-status-chk');
        $('#chk_reconcile_banking_status').next().html('Banking Status').attr('for', 'chk_banking_status');
        $('#chk_reconcile_banking_status').attr('name', 'chk_banking_status').attr('id', 'chk_banking_status');

        $('#myTabContent .action-bar ul li .dropdown-menu input[type="checkbox"]').each(function() {
            if(!$(this).attr('id').includes('chk_running_balance') && !$(this).attr('id').includes('paper_ledger_mode') &&
            !$(this).attr('id').includes('compact') && !$(this).attr('id').includes('show_in_one_line')) {
                $(this).prop('checked', false).trigger('change');
            }
        });
    }

    $('#registers-table').DataTable().ajax.reload(null, true);
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

$('#search').on('keyup', function(e) {
    var search = $(this).val();

    if(search.includes('<') && search.includes('>')) {
        $(this).addClass('border-danger');
    } else {
        $(this).removeClass('border-danger');
    }
});

$('#print-transactions').on('click', function(e) {
    e.preventDefault();

    var data = new FormData();
	data.set('from_date', $('#from').val());
	data.set('to_date', $('#to').val());
	data.set('search', $('#search').val());
	data.set('reconcile_status', $('#reconcile_status').val());
	data.set('transaction_type', $('#transaction_type').val());
	data.set('payee', $('#payee').val());

    var order = $('#registers-table').DataTable().order();
    data.set('column', columns[order[0][0]].name);
    data.set('order', order[0][1]);

    $('div[aria-labelledby="dropdownMenuLink"] input[type="checkbox"]').each(function() {
        var id = $(this).attr('id');
        if(id.includes('chk_')) {
            data.set(id, $(this).prop('checked') ? 1 : 0);
        }
    });

    $.ajax({
		url: `/accounting/chart-of-accounts/view-register/${accountId}/print-transactions`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
			let pdfWindow = window.open("");
			pdfWindow.document.write(result);
			$(pdfWindow.document).find('body').css('padding', '0');
			$(pdfWindow.document).find('body').css('margin', '0');
			$(pdfWindow.document).find('iframe').css('border', '0');
			pdfWindow.print();
		}
	});
});

function col(el) {
    var el = $(el);
    var col = el.attr('id').replace('chk_', '');

    if(el.prop('checked')) {
        $(`#registers-table .${col}`).removeClass('d-none');

        if($('#registers-table tbody tr td.dataTables_empty').length > 0) {
            var colspan = $('#registers-table tbody tr td.dataTables_empty').attr('colspan');
            $('#registers-table tbody tr td.dataTables_empty').prop('colspan', parseInt(colspan) + 1);
        }
    } else {
        $(`#registers-table .${col}`).addClass('d-none');
    }
}