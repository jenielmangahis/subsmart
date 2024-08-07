const accountId = $('#account').val();
let type = $('.page-title').html().replace(' Register', '');
var orderIndex = 0;
var order = 'desc';
var columns = [];

$(document).ready(function() {
    initSingleLineTable();
});

function setColumns() {
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
            data: 'payment',
            name: 'payment',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                if(cellData !== '') {
                    if(cellData.includes('-')) {
                        $(td).html(cellData.replaceAll('-', '-$'));
                    } else {
                        $(td).html(`$${cellData}`);
                    }
                }
            }
        },
        {
            data: 'deposit',
            name: 'deposit',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                if(cellData !== '') {
                    if(cellData.includes('-')) {
                        $(td).html(cellData.replaceAll('-', '-$'));
                    } else {
                        $(td).html(`$${cellData}`);
                    }
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
                    if(cellData.includes('-')) {
                        $(td).html(cellData.replaceAll('-', '-$'));
                    } else {
                        $(td).html(`$${cellData}`);
                    }
                }
            }
        };
    
        columns[7] = {
            data: 'payment',
            name: 'payment',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                if(cellData !== '') {
                    if(cellData.includes('-')) {
                        $(td).html(cellData.replaceAll('-', '-$'));
                    } else {
                        $(td).html(`$${cellData}`);
                    }
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
                    if(cellData.includes('-')) {
                        $(td).html(cellData.replaceAll('-', '-$'));
                    } else {
                        $(td).html(`$${cellData}`);
                    }
                }
            }
        };
    
        columns[7] = {
            data: type === 'Asset' ? 'increase' : 'decrease',
            name: type === 'Asset' ? 'increase' : 'decrease',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                if(cellData !== '') {
                    if(cellData.includes('-')) {
                        $(td).html(cellData.replaceAll('-', '-$'));
                    } else {
                        $(td).html(`$${cellData}`);
                    }
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
}

function initSingleLineTable() {
    setColumns();

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
}

function initDoubleLineTable() {
    $('#registers-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        info: false,
        pageLength: $('#table_rows').val(),
        // order: [[orderIndex, order]],
        ordering: false,
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
                d.order = order;
                d.column = orderIndex;

                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: columns
    });
}

$('#show_in_one_line').on('change', function(e) {
    $('#registers-table').DataTable().destroy();
    $('#registers-table').empty();

    if($(this).prop('checked') === false) {
        $('#myTabContent .action-bar ul li .dropdown-menu input[type="checkbox"]').each(function() {
            if($(this).attr('id').includes('chk_')) {
                $(this).prop('checked', true).trigger('change');
            }
        });

        columns = [
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'ref_no_type',
                name: 'ref_no_type'
            },
            {
                data: 'payee_account',
                name: 'payee_account'
            },
            {
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
                        if(cellData.includes('-')) {
                            $(td).html(cellData.replaceAll('-', '-$'));
                        } else {
                            $(td).html(`$${cellData}`);
                        }
                    }
                }
            },
            {
                data: 'deposit',
                name: 'deposit',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    if(cellData !== '') {
                        if(cellData.includes('-')) {
                            $(td).html(cellData.replaceAll('-', '-$'));
                        } else {
                            $(td).html(`$${cellData}`);
                        }
                    }
                }
            },
            {
                data: 'reconcile_banking_status',
                name: 'reconcile_banking_status',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    $(td).addClass('reconcile_banking_status');
        
                    if($('#chk_reconcile_banking_status').prop('checked') === false) {
                        $(td).addClass('d-none');
                    }
                }
            },
            {
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

        if(type !== 'A/R' && type !== 'A/P') {
            $('.reconcile-status-chk').remove();
            $('.banking-status-chk').addClass('reconcile-banking-status-chk').removeClass('banking-status-chk');
            $('#chk_banking_status').next().html('<p class="m-0">Reconcile and</p><p class="m-0">Banking Status</p>').attr('for', 'chk_reconcile_banking_status');
            $('#chk_banking_status').attr('name', 'chk_reconcile_banking_status').attr('id', 'chk_reconcile_banking_status');

            $('#registers-table').append('<thead><tr></tr></thead>');
            $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">DATE</a></th>');
            $('#registers-table thead tr').append('<th><a href="#" class="w-100">REF NO.</a></th>');
            $('#registers-table thead tr').append('<th><a href="#" class="w-100">PAYEE</a></th>');
            $('#registers-table thead tr').append('<th rowspan="2" class="memo">MEMO</th>');
            switch(type) {
                case 'Asset' :
                    $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">DECREASE</a></th>');
                    $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">INCREASE</a></th>');
                    columns[4].data = 'decrease';
                    columns[4].name = 'decrease';
                    columns[5].data = 'increase';
                    columns[5].name = 'increase';
                break;
                case 'Liability' :
                    $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">INCREASE</a></th>');
                    $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">DECREASE</a></th>');
                    columns[4].data = 'increase';
                    columns[4].name = 'increase';
                    columns[5].data = 'decrease';
                    columns[5].name = 'decrease';
                break;
                case 'Credit Card' :
                    $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">CHARGE</a></th>');
                    $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">PAYMENT</a></th>');
                    columns[4].data = 'charge';
                    columns[4].name = 'charge';
                    columns[5].data = 'payment';
                    columns[5].name = 'payment';
                break;
                default :
                    $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">PAYMENT</a></th>');
                    $('#registers-table thead tr').append('<th rowspan="2"><a href="#" class="w-100">DEPOSIT</a></th>');
                break;
            }
            $('#registers-table thead tr').append(`<th class="reconcile_banking_status">
            <a href="#" class="w-100"><div class="d-flex align-items-center justify-content-center">
                <i class="fa fa-check"></i>
            </div></a></th>`);
            $('#registers-table thead tr').append(`<th class="attachments" rowspan="2">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fa fa-paperclip"></i>
            </div></th>`);
            $('#registers-table thead tr').append('<th rowspan="2" class="tax">TAX</th>');
            $('#registers-table thead tr').append('<th rowspan="2" class="text-right running_balance">BALANCE</th>');

            $('#registers-table thead').append(`
            <tr>
                <th><a href="#" class="w-100">TYPE</a></th>
                <th>ACCOUNT</th>
                <th class="reconcile_banking_status">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fa fa-copy"></i>
                    </div>
                </th>
            </tr>
            `);
        } else {

        }

        initDoubleLineTable();
    } else {
        if(type !== 'A/R' && type !== 'A/P') {
            $(`<div class="checkbox checkbox-sec d-block my-2 reconcile-status-chk">
                <input type="checkbox" name="chk_reconcile_status" id="chk_reconcile_status" onchange="col(this)">
                <label for="chk_reconcile_status">Reconcile Status</label>
            </div>`).insertBefore($('.reconcile-banking-status-chk'));
            $('.reconcile-banking-status-chk').addClass('banking-status-chk').removeClass('reconcile-banking-status-chk');
            $('#chk_reconcile_banking_status').next().html('Banking Status').attr('for', 'chk_banking_status');
            $('#chk_reconcile_banking_status').attr('name', 'chk_banking_status').attr('id', 'chk_banking_status');

            $('#registers-table').append('<thead><tr></tr></thead>');
            $('#registers-table thead tr').append('<th>DATE</th>');
            $('#registers-table thead tr').append('<th>REF NO.</th>');
            $('#registers-table thead tr').append('<th>TYPE</th>');
            $('#registers-table thead tr').append('<th>PAYEE</th>');
            $('#registers-table thead tr').append('<th>ACCOUNT</th>');
            $('#registers-table thead tr').append('<th class="memo d-none">MEMO</th>');
            switch(type) {
                case 'Asset' :
                    $('#registers-table thead tr').append('<th>DECREASE</th>');
                    $('#registers-table thead tr').append('<th>INCREASE</th>');
                break;
                case 'Liability' :
                    $('#registers-table thead tr').append('<th>INCREASE</th>');
                    $('#registers-table thead tr').append('<th>DECREASE</th>');
                break;
                case 'Credit Card' :
                    $('#registers-table thead tr').append('<th>CHARGE</th>');
                    $('#registers-table thead tr').append('<th>PAYMENT</th>');
                break;
                default :
                    $('#registers-table thead tr').append('<th>PAYMENT</th>');
                    $('#registers-table thead tr').append('<th>DEPOSIT</th>');
                break;
            }
            $('#registers-table thead tr').append(`<th class="reconcile_status d-none">
            <div class="d-flex align-items-center justify-content-center">
                <i class="fa fa-check"></i>
            </div>
            </th>`);
            $('#registers-table thead tr').append(`<th class="banking_status d-none">
            <div class="d-flex align-items-center justify-content-center">
                <i class="fa fa-copy"></i>
            </div>
            </th>`);
            $('#registers-table thead tr').append(`<th class="attachments d-none">
            <div class="d-flex align-items-center justify-content-center">
                <i class="fa fa-paperclip"></i>
            </div>
            </th>`);
            $('#registers-table thead tr').append('<th class="tax d-none">TAX</th>');
            $('#registers-table thead tr').append('<th class="text-right running_balance">BALANCE</th>');
        } else {

        }

        $('#myTabContent .action-bar ul li .dropdown-menu input[type="checkbox"]').each(function() {
            if(!$(this).attr('id').includes('chk_running_balance') && !$(this).attr('id').includes('paper_ledger_mode') &&
            !$(this).attr('id').includes('compact') && !$(this).attr('id').includes('show_in_one_line') && !$(this).attr('id').includes('chk_open_balance')) {
                $(this).prop('checked', false).trigger('change');
            }
        });

        initSingleLineTable();
    }
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

$(document).on('click', '#download-transactions', function(e) {
    e.preventDefault();

    var data = new FormData();
    $('#export-transactions-form').append(`<input type="hidden" name="from_date" value="${$('#from').val()}">`);
    $('#export-transactions-form').append(`<input type="hidden" name="to_date" value="${$('#to').val()}">`);
    $('#export-transactions-form').append(`<input type="hidden" name="search" value="${$('#search').val()}">`);
    $('#export-transactions-form').append(`<input type="hidden" name="reconcile_status" value="${$('#reconcile_status').val()}">`);
    $('#export-transactions-form').append(`<input type="hidden" name="transaction_type" value="${$('#transaction_type').val()}">`);
    $('#export-transactions-form').append(`<input type="hidden" name="payee" value="${$('#payee').val()}">`);

    if($('#registers-table thead tr').length > 1) {
        $('#export-transactions-form').append(`<input type="hidden" name="column" value="${columns[orderIndex].name}">`);
        $('#export-transactions-form').append(`<input type="hidden" name="order" value="${order}">`);
    } else {
        var tableOrder = $('#registers-table').DataTable().order();
        $('#export-transactions-form').append(`<input type="hidden" name="column" value="${columns[tableOrder[0][0]].name}">`);
        $('#export-transactions-form').append(`<input type="hidden" name="order" value="${tableOrder[0][1]}">`);
    }

    $('div[aria-labelledby="dropdownMenuLink"] input[type="checkbox"]').each(function() {
        var id = $(this).attr('id');
        $('#export-transactions-form').append(`<input type="hidden" name="${id}" value="${$(this).prop('checked') ? 1 : 0}">`);
    });

    // $.ajax({
	// 	url: `/accounting/chart-of-accounts/view-register/${accountId}/export-table`,
    //     data: data,
    //     type: 'post',
    //     processData: false,
    //     contentType: false,
    //     xhrFields: {
    //         responseType: 'blob'
    //     },
    //     success: function(data) {
	// 		var a = document.createElement('a');
    //         var url = window.URL.createObjectURL(data);
    //         a.href = url;
    //         a.download = 'Register.csv';
    //         document.body.append(a);
    //         a.click();
    //         a.remove();
    //         window.URL.revokeObjectURL(url);
	// 	}
	// });

    $('#export-transactions-form').submit();
});

$('#export-transactions-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).find('input').remove();
});

$(document).on('click', '#print-transactions', function(e) {
    e.preventDefault();

    var data = new FormData();
	data.set('from_date', $('#from').val());
	data.set('to_date', $('#to').val());
	data.set('search', $('#search').val());
	data.set('reconcile_status', $('#reconcile_status').val());
	data.set('transaction_type', $('#transaction_type').val());
	data.set('payee', $('#payee').val());

    if($('#registers-table thead tr').length > 1) {
        data.set('column', columns[orderIndex].name);
        data.set('order', order);
    } else {
        var tableOrder = $('#registers-table').DataTable().order();
        data.set('column', columns[tableOrder[0][0]].name);
        data.set('order', tableOrder[0][1]);
    }

    $('div[aria-labelledby="dropdownMenuLink"] input[type="checkbox"]').each(function() {
        var id = $(this).attr('id');
        data.set(id, $(this).prop('checked') ? 1 : 0);
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

$(document).on('click', '#registers-table thead tr a', function() {
    var rowIndex = $(this).parent().parent().index();
    var index = $(this).parent().index();

    if(type !== 'A/R' && type !== 'A/P') {
        if(rowIndex > 0) {
            index += 1;
            orderIndex = 9 + index;
        } else {
            orderIndex = index;
        }
    }

    if(order === 'desc') {
        order = 'asc';
    } else {
        order = 'desc';
    }

    $('#registers-table').DataTable().ajax.reload();
});

$(document).on('mouseenter', '#registers-table tbody tr', function() {
    if($('#show_in_one_line').prop('checked') === false) {
        if($(this).hasClass('odd')) {
            $(this).next().addClass('hover');
        } else {
            $(this).prev().addClass('hover');
        }
    }
});

$(document).on('mouseleave', '#registers-table tbody tr', function() {
    if($('#show_in_one_line').prop('checked') === false) {
        if($(this).hasClass('odd')) {
            $(this).next().removeClass('hover');
        } else {
            $(this).prev().removeClass('hover');
        }
    }
});

$(document).on('click', '#registers-table tbody tr.action-row #cancel-edit', function() {
    if($('#show_in_one_line').prop('checked')) {
        var rowData = $('#registers-table').DataTable().row($('#registers-table tbody tr.editting')).data();
        $('#registers-table tbody tr.editting td').each(function() {
            var el = $(this);
            $.each(rowData, function(key, value) {
                if(key === columns[el.index()].name) {
                    el.html(value);
                    if(key === 'payment' || key === 'deposit' || key === 'charge' || key === 'increase' || key === 'decrease') {
                        if(value !== '') {
                            if(value.includes('-')) {
                                el.html(value.replaceAll('-', '-$'));
                            } else {
                                el.html(`$${value}`);
                            }
                        }
                    }
                }
            });
        });
    
        $('#registers-table tbody tr.editting').removeClass('editting');
        $('#registers-table tbody tr.action-row').remove();
    } else {
        $('#registers-table tbody tr.editting td').each(function() {
            var el = $(this);
            var rowData = $('#registers-table').DataTable().row($(this).parent()).data();
            $.each(rowData, function(key, value) {
                if(key === columns[el.index()].name) {
                    el.html(value);
                    if(key === 'payment' || key === 'deposit' || key === 'charge' || key === 'increase' || key === 'decrease') {
                        if(value !== '') {
                            if(value.includes('-')) {
                                el.html(value.replaceAll('-', '-$'));
                            } else {
                                el.html(`$${value}`);
                            }
                        }
                    }
                }
            });
        });

        $('#registers-table tbody tr.editting').removeClass('editting');
        $('#registers-table tbody tr.action-row').remove();
    }
});

$(document).on('click', '#registers-table tbody tr.action-row #save-transaction', function() {
    var data = new FormData();
    var row = $('#registers-table tbody tr.editting');
    var rowData = $('#registers-table').DataTable().row(row).data();

    $('#registers-table tbody tr.editting td').each(function() {
        if($(this).find('select').length === 0) {
            var field = $(this).find('input');
        } else {
            var field = $(this).find('select');
        }

        if(field.length > 0) {
            data.set(field.attr('name'), field.val());
        }
    });

    $('#registers-table tbody tr.action-row #attachments-container .attachment-item').each(function() {
        var id = $(this).data('id');
        data.append('attachments[]', id);
    });

    if(rowData.hasOwnProperty('child_id')) {
        data.set('child_id', rowData.child_id);
    }

    $.ajax({
        url: '/accounting/chart-of-accounts/'+accountId+'/save-transaction/'+rowData.id,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            toast(res.success, res.message);

            $('#registers-table').DataTable().ajax.reload(null, true);
        }
    });
});

$(document).on('click', '#registers-table tbody tr.action-row #attachments-container .attachment-item a.view-attachment', function() {
    var attachmentId = $(this).parent().parent().data('id');

    $.get('/accounting/get-attachment-file-path/'+attachmentId, function(res) {
        window.open(res, '_blank');
    });
});

$(document).on('click', '#registers-table tbody tr.action-row #attachments-container .attachment-item a.remove-attachment', function() {
    $(this).parent().parent().remove();

    if($('#registers-table tbody tr.action-row #attachments-container .attachment-item').length < 1) {
        $('#registers-table tbody tr.action-row #attachments-container').html('');
    }
});

$(document).on('click', '#registers-table tbody tr.action-row #add-attachment', function() {
    $('#registers-table tbody tr.action-row input#files').trigger('click');
});

$(document).on('change', '#registers-table tbody tr.action-row input#files', function() {
    var data = new FormData();
    var totalfiles = this.files.length;

    for (var index = 0; index < totalfiles; index++) {
        data.append("files[]", this.files[index]);
    }

    $.ajax({
        url: '/accounting/chart-of-accounts/add-attachment',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var attachments = JSON.parse(result);

            if($('#registers-table tbody tr.action-row #attachments-container div.attachment-item').length < 1) {
                $('#registers-table tbody tr.action-row #attachments-container').append('<h6 class="mt-0">ATTACHMENTS</h6>');
            }

            for(i in attachments) {
                var html = `<div class="d-inline-block px-1 attachment-item" data-id="${attachments[i].id}">
                    <h6 class="m-0"><a class="text-info view-attachment">${attachments[i].name}</a class="text-info">&nbsp;&nbsp;<a href="#" class="text-muted remove-attachment">&times;</a></h6>
                </div>`;
                $('#registers-table tbody tr.action-row #attachments-container').append(html);
            }
        }
    });
});

$(document).on('click', '#registers-table tbody tr', function() {
    if($('#show_in_one_line').prop('checked')) {
        if($(this).find('input').length < 1 && !$(this).hasClass('action-row') && $(this).find('td.dataTables_empty').length < 1) {
            var row = $(this);
            var rowData = $('#registers-table').DataTable().row(row).data();
            if($('#registers-table tbody tr.editting').length > 0) {
                $('#registers-table tbody tr.editting').next().find('#cancel-edit').trigger('click');
            }

            $(this).addClass('editting');
            var colCount = $(this).children('td').length;
            var actionRow = '<tr class="action-row">';
            actionRow += `<td colspan="${colCount}">
                <div class="row">
                    <div class="col">
                        <div id="attachments-container"></div>
                        <input type="file" class="d-none form-control" name="files" id="files" multiple>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="m-0">
                            <i class="fa fa-paperclip"></i> <a href="#" class="text-info" id="add-attachment">Add Attachment</a>
                        </h6>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-success float-right" id="save-transaction">Save</button>
                        <button class="btn btn-transparent float-right mr-1" id="cancel-edit">Cancel</button>
                        <button class="btn btn-transparent float-right mr-1" id="edit-transaction">Edit</button>
                        <button class="btn btn-transparent float-right mr-1" id="delete-transaction">Delete</button>
                    </div>
                </div>
            </td>`;
            actionRow += '</tr>';

            $(actionRow).insertAfter(this);

            if(rowData.type === 'Inventory Starting Value') {
                $('#registers-table tbody tr.action-row #delete-transaction').remove();
            } else if(rowData.type === 'Inventory Qty Adjust') {
                $('#registers-table tbody tr.action-row #save-transaction').remove();
            }

            var noAttachments = [
                'Inventory Starting Value',
                'Inventory Qty Adjust',
                'Credit Card Pmt'
            ];

            if(noAttachments.includes(rowData.type)) {
                $('#registers-table tbody tr.action-row h6').remove();
            }

            $(this).children('td').each(function() {
                var current = $(this).html();

                switch(columns[$(this).index()].name) {
                    case 'date' :
                        $(this).html(`<input type="text" name="date" class="form-control" value="${current}">`);

                        if(rowData.type === 'Inventory Qty Adjust' || rowData.type === 'Bill') {
                            $(this).find('input').prop('disabled', true);
                        }

                        $(this).find('input').datepicker({
                            uiLibrary: 'bootstrap'
                        });
                    break;
                    case 'ref_no' :
                        $(this).html(`<input type="text" name="ref_no" class="form-control" value="${current}" placeholder="Ref No.">`);

                        if(rowData.ref_no_disabled === true) {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'type' :
                        $(this).html(`<input type="text" name="type" class="form-control" value="${current}" disabled>`);
                    break;
                    case 'payee' :
                        $(this).html(`<select class="form-control" name="payee"></select>`);
                        if(current !== "") {
                            if(rowData.type !== "Bill" && rowData.type !== 'Vendor Credit') {
                                $(this).find('select').append(`<option value="${rowData.payee_type+'-'+rowData.payee_id}">${current}</option>`);
                            } else {
                                $(this).find('select').append(`<option value="${rowData.payee_id}">${current}</option>`);
                            }
                        }
                        if(rowData.payee_disabled === true) {
                            $(this).find('select').prop('disabled', true);
                            $(this).find('select').select2({
                                placeholder: 'Payee'
                            });
                        } else {
                            switch(rowData.type) {
                                case 'Expense' :
                                    var fieldName = 'payee';
                                    var modalName = 'expenseModal';
                                break;
                                case 'CC Expense' :
                                    var fieldName = 'payee';
                                    var modalName = 'expenseModal';
                                break;
                                case 'Check' :
                                    var fieldName = 'payee';
                                    var modalName = 'checkModal';
                                break;
                                case 'Bill' :
                                    var fieldName = 'vendor';
                                    var modalName = 'billModal';
                                break;
                                case 'Vendor Credit' :
                                    var fieldName = 'vendor';
                                    var modalName = 'vendorCreditModal';
                                break;
                                case 'CC-Credit' :
                                    var fieldName = 'payee';
                                    var modalName = 'creditCardCreditModal';
                                break;
                                case 'Journal' :
                                    var fieldName = 'names';
                                    var modalName = 'journalEntryModal';
                                break;
                            }
                            $(this).find('select').select2({
                                placeholder: 'Payee',
                                ajax: {
                                    url: '/accounting/get-dropdown-choices',
                                    dataType: 'json',
                                    data: function(params) {
                                        var query = {
                                            search: params.term,
                                            type: 'public',
                                            field: fieldName,
                                            modal: modalName
                                        }

                                        // Query parameters will be ?search=[term]&type=public&field=[type]
                                        return query;
                                    }
                                },
                                templateResult: formatResult,
                                templateSelection: optionSelect
                            });
                        }
                    break;
                    case 'account' :
                        switch(rowData.type) {
                            case 'Transfer' :
                                var fieldName = 'transfer-account';
                                var modalName = 'transferModal';
                            break;
                            case 'Credit Card Pmt' :
                                var fieldName = rowData.account_field;
                                var modalName = 'payDownCreditModal';
                            break;
                            case 'Inventory Starting Value' :
                                var fieldName = rowData.account_field;
                                var modalName = 'adjust-starting-value-modal';
                            break;
                            case 'Deposit' :
                                var fieldName = rowData.account_field;
                                var modalName = 'depositModal';
                            break;
                            case 'Expense' :
                                var fieldName = rowData.account_field;
                                var modalName = 'expenseModal';
                            break;
                            case 'CC Expense' :
                                var fieldName = rowData.account_field;
                                var modalName = 'expenseModal';
                            break;
                            case 'Check' :
                                var fieldName = rowData.account_field;
                                var modalName = 'checkModal';
                            break;
                            case 'CC-Credit' :
                                var fieldName = rowData.account_field;
                                var modalName = 'creditCardCreditModal';
                            break;
                        }

                        $(this).html(`<select class="form-control" name="${fieldName !== undefined ? fieldName.replaceAll('-', '_') : 'account'}" ${current === '-Split-' ? 'disabled' : ''}><option value="${rowData.account_id}">${current}</option></select>`);
                        if(rowData.account_disabled === true) {
                            $(this).find('select').prop('disabled', true);
                            $(this).find('select').select2({
                                placeholder: 'Account'
                            });
                        } else {
                            $(this).find('select').select2({
                                placeholder: 'Account',
                                ajax: {
                                    url: '/accounting/get-dropdown-choices',
                                    dataType: 'json',
                                    data: function(params) {
                                        var query = {
                                            search: params.term,
                                            type: 'public',
                                            field: fieldName,
                                            modal: modalName
                                        }
        
                                        // Query parameters will be ?search=[term]&type=public&field=[type]
                                        return query;
                                    }
                                },
                                templateResult: formatResult,
                                templateSelection: optionSelect
                            });
                        }
                    break;
                    case 'memo' :
                        $(this).html(`<input type="text" name="memo" class="form-control" value="${current}" placeholder="Memo">`);

                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'payment' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="payment" class="form-control font-italic" value="" placeholder="Payment" disabled>`);
                        } else if(rowData.hasOwnProperty('payment_disabled') && rowData.payment_disabled === true) {
                            $(this).html(`<input type="number" name="payment" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Payment" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="payment" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Payment">`);
                        }

                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'charge' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="charge" class="form-control font-italic" value="" placeholder="Charge" disabled>`);
                        } else if(rowData.hasOwnProperty('charge_disabled') && rowData.charge_disabled === true) {
                            $(this).html(`<input type="number" name="charge" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Charge" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="charge" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Charge">`);
                        }

                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'deposit' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="deposit" class="form-control font-italic" value="" placeholder="Deposit" disabled>`);
                        } else if(rowData.hasOwnProperty('deposit_disabled') && rowData.deposit_disabled === true) {
                            $(this).html(`<input type="number" name="deposit" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Deposit" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="deposit" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Deposit">`);
                        }

                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'increase' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="increase" class="form-control font-italic" value="" placeholder="Increase" disabled>`);
                        } else if(rowData.hasOwnProperty('increase_disabled') && rowData.increase_disabled === true) {
                            $(this).html(`<input type="number" name="increase" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Increase" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="increase" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Increase">`);
                        }

                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'decrease' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="decrease" class="form-control font-italic" value="" placeholder="Decrease" disabled>`);
                        } else if(rowData.hasOwnProperty('decrease_disabled') && rowData.decrease_disabled === true) {
                            $(this).html(`<input type="number" name="decrease" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Decrease" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="decrease" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Decrease">`);
                        }

                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'reconcile_status' :
                        $(this).html('');
                    break;
                    case 'banking_status' :
                        $(this).html('');
                    break;
                    case 'attachments' :
                        $(this).html(`<input type="text" class="form-control" value="${current}" disabled>`);
                    break;
                    case 'tax' :
                        $(this).html('');
                    break;
                    case 'balance' :
                        $(this).html(`<input type="number" class="form-control text-right" value="${current.replaceAll('$', '')}" disabled>`);
                    break;
                }
            });
        }
    } else {
        if($(this).find('input').length < 1 && !$(this).hasClass('action-row') && $(this).find('td.dataTables_empty').length < 1) {
            if($('#registers-table tbody tr.editting').length > 0) {
                $('#registers-table tbody tr.editting').next().find('#cancel-edit').trigger('click');
            }
            $(this).addClass('editting');
            if($(this).hasClass('odd')) {
                $(this).next().addClass('editting');
            } else {
                $(this).prev().addClass('editting');
            }
    
            var evenData = $('#registers-table').DataTable().row($('#registers-table tbody tr.editting.even')).data();
    
            var colCount = $(this).children('td').length;
            var actionRow = '<tr class="action-row">';
            actionRow += `<td colspan="${colCount}">
                <div class="row">
                    <div class="col">
                        <div id="attachments-container"></div>
                        <input type="file" class="d-none form-control" name="files" id="files" multiple>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="m-0">
                            <i class="fa fa-paperclip"></i> <a href="#" class="text-info" id="add-attachment">Add Attachment</a>
                        </h6>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-success float-right" id="save-transaction">Save</button>
                        <button class="btn btn-transparent float-right mr-1" id="cancel-edit">Cancel</button>
                        <button class="btn btn-transparent float-right mr-1" id="edit-transaction">Edit</button>
                        <button class="btn btn-transparent float-right mr-1" id="delete-transaction">Delete</button>
                    </div>
                </div>
            </td>`;
            actionRow += '</tr>';
    
            $(actionRow).insertAfter($('#registers-table tbody tr.editting.even'));
    
            if(evenData.type === 'Inventory Starting Value') {
                $('#registers-table tbody tr.action-row #delete-transaction').remove();
            } else if(evenData.type === 'Inventory Qty Adjust') {
                $('#registers-table tbody tr.action-row #save-transaction').remove();
            }
    
            var noAttachments = [
                'Inventory Starting Value',
                'Inventory Qty Adjust',
                'Credit Card Pmt'
            ];
    
            if(noAttachments.includes(evenData.type)) {
                $('#registers-table tbody tr.action-row h6').remove();
            }
    
            $('#registers-table tbody tr.odd.editting td').each(function() {
                var current = $(this).html();
                var rowData = $('#registers-table').DataTable().row($(this)).data();
    
                switch(columns[$(this).index()].name) {
                    case 'date' :
                        $(this).html(`<input type="text" name="date" class="form-control" value="${current}">`);
    
                        if(rowData.type === 'Inventory Qty Adjust' || rowData.type === 'Bill') {
                            $(this).find('input').prop('disabled', true);
                        }
    
                        $(this).find('input').datepicker({
                            uiLibrary: 'bootstrap'
                        });
                    break;
                    case 'ref_no_type' :
                        $(this).html(`<input type="text" name="ref_no" class="form-control" value="${current}" placeholder="Ref No.">`);
    
                        if(rowData.ref_no_disabled === true) {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'payee_account' :
                        $(this).html(`<select class="form-control" name="payee"></select>`);
                        if(current !== "") {
                            if(rowData.type !== "Bill" && rowData.type !== 'Vendor Credit') {
                                $(this).find('select').append(`<option value="${rowData.payee_type+'-'+rowData.payee_id}">${current}</option>`);
                            } else {
                                $(this).find('select').append(`<option value="${rowData.payee_id}">${current}</option>`);
                            }
                        }
                        if(rowData.payee_disabled === true) {
                            $(this).find('select').prop('disabled', true);
                            $(this).find('select').select2({
                                placeholder: 'Payee'
                            });
                        } else {
                            switch(rowData.type) {
                                case 'Expense' :
                                    var fieldName = 'payee';
                                    var modalName = 'expenseModal';
                                break;
                                case 'CC Expense' :
                                    var fieldName = 'payee';
                                    var modalName = 'expenseModal';
                                break;
                                case 'Check' :
                                    var fieldName = 'payee';
                                    var modalName = 'checkModal';
                                break;
                                case 'Bill' :
                                    var fieldName = 'vendor';
                                    var modalName = 'billModal';
                                break;
                                case 'Vendor Credit' :
                                    var fieldName = 'vendor';
                                    var modalName = 'vendorCreditModal';
                                break;
                                case 'CC-Credit' :
                                    var fieldName = 'payee';
                                    var modalName = 'creditCardCreditModal';
                                break;
                                case 'Journal' :
                                    var fieldName = 'names';
                                    var modalName = 'journalEntryModal';
                                break;
                            }
                            $(this).find('select').select2({
                                placeholder: 'Payee',
                                ajax: {
                                    url: '/accounting/get-dropdown-choices',
                                    dataType: 'json',
                                    data: function(params) {
                                        var query = {
                                            search: params.term,
                                            type: 'public',
                                            field: fieldName,
                                            modal: modalName
                                        }
    
                                        // Query parameters will be ?search=[term]&type=public&field=[type]
                                        return query;
                                    }
                                },
                                templateResult: formatResult,
                                templateSelection: optionSelect
                            });
                        }
                    break;
                    case 'memo' :
                        $(this).html(`<input type="text" name="memo" class="form-control" value="${current}" placeholder="Memo">`);
    
                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'payment' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="payment" class="form-control font-italic" value="" placeholder="Payment" disabled>`);
                        } else if(rowData.hasOwnProperty('payment_disabled') && rowData.payment_disabled === true) {
                            $(this).html(`<input type="number" name="payment" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Payment" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="payment" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Payment">`);
                        }
    
                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'charge' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="charge" class="form-control font-italic" value="" placeholder="Charge" disabled>`);
                        } else if(rowData.hasOwnProperty('charge_disabled') && rowData.charge_disabled === true) {
                            $(this).html(`<input type="number" name="charge" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Charge" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="charge" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Charge">`);
                        }
    
                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'deposit' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="deposit" class="form-control font-italic" value="" placeholder="Deposit" disabled>`);
                        } else if(rowData.hasOwnProperty('deposit_disabled') && rowData.deposit_disabled === true) {
                            $(this).html(`<input type="number" name="deposit" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Deposit" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="deposit" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Deposit">`);
                        }
    
                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'increase' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="increase" class="form-control font-italic" value="" placeholder="Increase" disabled>`);
                        } else if(rowData.hasOwnProperty('increase_disabled') && rowData.increase_disabled === true) {
                            $(this).html(`<input type="number" name="increase" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Increase" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="increase" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Increase">`);
                        }
    
                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'decrease' :
                        if(current === '' && rowData.type !== 'Journal') {
                            $(this).html(`<input type="number" name="decrease" class="form-control font-italic" value="" placeholder="Decrease" disabled>`);
                        } else if(rowData.hasOwnProperty('decrease_disabled') && rowData.decrease_disabled === true) {
                            $(this).html(`<input type="number" name="decrease" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Decrease" disabled>`);
                        } else {
                            $(this).html(`<input type="number" name="decrease" class="form-control text-right" step=".01" value="${current.replaceAll('$', '')}" placeholder="Decrease">`);
                        }
    
                        if(rowData.type === 'Inventory Qty Adjust') {
                            $(this).find('input').prop('disabled', true);
                        }
                    break;
                    case 'reconcile_banking_status' :
                        $(this).html('');
                    break;
                    case 'attachments' :
                        $(this).html(`<input type="text" class="form-control" value="${current}" disabled>`);
                    break;
                    case 'tax' :
                        $(this).html('');
                    break;
                    case 'balance' :
                        $(this).html(`<input type="number" class="form-control text-right" value="${current.replaceAll('$', '')}" disabled>`);
                    break;
                }
            });
    
            $('#registers-table tbody tr.even.editting td').each(function() {
                var current = $(this).html();
                var rowData = $('#registers-table').DataTable().row($(this)).data();
    
                switch(columns[$(this).index()].name) {
                    case 'ref_no_type' :
                        $(this).html(`<input type="text" name="type" class="form-control" value="${current}" disabled>`);
                    break;
                    case 'payee_account' :
                        switch(rowData.type) {
                            case 'Transfer' :
                                var fieldName = 'transfer-account';
                                var modalName = 'transferModal';
                            break;
                            case 'Credit Card Pmt' :
                                var fieldName = rowData.account_field;
                                var modalName = 'payDownCreditModal';
                            break;
                            case 'Inventory Starting Value' :
                                var fieldName = rowData.account_field;
                                var modalName = 'adjust-starting-value-modal';
                            break;
                            case 'Deposit' :
                                var fieldName = rowData.account_field;
                                var modalName = 'depositModal';
                            break;
                            case 'Expense' :
                                var fieldName = rowData.account_field;
                                var modalName = 'expenseModal';
                            break;
                            case 'CC Expense' :
                                var fieldName = rowData.account_field;
                                var modalName = 'expenseModal';
                            break;
                            case 'Check' :
                                var fieldName = rowData.account_field;
                                var modalName = 'checkModal';
                            break;
                            case 'CC-Credit' :
                                var fieldName = rowData.account_field;
                                var modalName = 'creditCardCreditModal';
                            break;
                        }
    
                        $(this).html(`<select class="form-control" name="${fieldName !== undefined ? fieldName.replaceAll('-', '_') : 'account'}" ${current === '-Split-' ? 'disabled' : ''}><option value="${rowData.account_id}">${current}</option></select>`);
                        if(rowData.account_disabled === true) {
                            $(this).find('select').prop('disabled', true);
                            $(this).find('select').select2({
                                placeholder: 'Account'
                            });
                        } else {
                            $(this).find('select').select2({
                                placeholder: 'Account',
                                ajax: {
                                    url: '/accounting/get-dropdown-choices',
                                    dataType: 'json',
                                    data: function(params) {
                                        var query = {
                                            search: params.term,
                                            type: 'public',
                                            field: fieldName,
                                            modal: modalName
                                        }
        
                                        // Query parameters will be ?search=[term]&type=public&field=[type]
                                        return query;
                                    }
                                },
                                templateResult: formatResult,
                                templateSelection: optionSelect
                            });
                        }
                    break;
                    case 'reconcile_banking_status' :
                        $(this).html('');
                    break;
                }
            });
        }
    }
});

$(document).on('click', '#registers-table tbody tr.action-row #edit-transaction', function() {
    var row = $('#registers-table tbody tr.editting');
    var data = $('#registers-table').DataTable().row(row).data();
    var transactionType = data.type;
    switch(data.type) {
        case 'CC Expense' :
            transactionType = 'expense';
        break;
        case 'CC Bill Payment' :
            transactionType = 'bill-payment';
        break;
    }
    transactionType = transactionType.replaceAll(' ', '-').toLowerCase();

    $.get(`/accounting/view-transaction/${transactionType}/${data.id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        switch(transactionType) {
            case 'expense' :
                initModalFields('expenseModal', data);

                $('#expenseModal #payee').trigger('change');

                $('#expenseModal').modal('show');
            break;
            case 'check' :
                initModalFields('checkModal', data);

                $('#checkModal #payee').trigger('change');
        
                $('#checkModal').modal('show');
            break;
            case 'journal' :
                initModalFields('journalEntryModal', data);

                $('#journalEntryModal').modal('show');
            break;
            case 'bill' :
                initModalFields('billModal', data);

                $('#billModal').modal('show');
            break;
            case 'cc-credit' :
                initModalFields('creditCardCreditModal', data);

                $('#creditCardCreditModal').modal('show');
            break;
            case 'vendor-credit' :
                initModalFields('vendorCreditModal', data);

                $('#vendorCreditModal').modal('show');
            break;
            case 'bill-payment' :
                $('#billPaymentModal #vendor').trigger('change');

                initModalFields('billPaymentModal', data);
        
                initBillsTable(data);
        
                $('#billPaymentModal .dropdown-menu').on('click', function(e) {
                    e.stopPropagation();
                });
        
                $('#billPaymentModal').modal('show');
            break;
            case 'transfer' :
                initModalFields('transferModal', data);

                $('#transferModal #transfer_from_account').trigger('change');
                $('#transferModal #transfer_to_account').trigger('change');

                $('#transferModal').modal('show');
            break;
            case 'deposit' :
                rowCount = 8;
                rowInputs = $('#depositModal table tbody tr:first-child()').html();
                blankRow = $('#depositModal table tbody tr:last-child()').html();

                $('#depositModal table.clickable tbody tr:first-child()').remove();
                $('#depositModal table tbody tr:last-child()').remove();

                initModalFields('depositModal', data);

                $('#depositModal').modal('show');
            break;
            case 'inventory-qty-adjust' :
                rowInputs = $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html();
                blankRow = $('#inventoryModal table#inventory-adjustments-table tbody tr:nth-child(2)').html();
                rowCount = $('#inventoryModal table#inventory-adjustments-table tbody tr').length;

                $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child()').html(blankRow);
                $('#inventoryModal table#inventory-adjustments-table tbody tr:first-child() td:nth-child(2)').html(1);

                initModalFields('inventoryModal', data);

                $('#inventoryModal').modal('show');
            break;
            case 'inventory-starting-value' :
                initModalFields('adjust-starting-value-modal', data);

		        $('#adjust-starting-value-modal').modal('show');
            break;
            case 'credit-card-pmt' :
                initModalFields('payDownCreditModal', data);

                $('#payDownCreditModal').modal('show');
            break;
        }
    });
});

$(document).on('click', '#registers-table tbody tr.action-row #delete-transaction', function() {
    var html = 'Are you sure you want to delete this transaction?';
    if($('#show_in_one_line').prop('checked')) {
        var data = $('#registers-table').DataTable().row($('#registers-table tbody tr.editting')).data();
        var transactionType = data.type.replaceAll(' ', '-').toLowerCase();

        switch(data.type) {
            case 'CC Expense' :
                transactionType = 'expense';
            break;
            case 'CC Bill Payment' :
                transactionType = 'bill-payment';
            break;
        }

        if(data.account === '-Split-') {
            html = 'This is just one part of a split transaction. Deleting it will remove the whole transaction. Are you sure you want to delete?'
        }
    } else {
        var data = $('#registers-table').DataTable().row($('#registers-table tbody tr.even.editting')).data();
        var transactionType = data.ref_no_type.replaceAll(' ', '-').toLowerCase();

        switch(data.type) {
            case 'CC Expense' :
                transactionType = 'expense';
            break;
            case 'CC Bill Payment' :
                transactionType = 'bill-payment';
            break;
        }

        if(data.payee_account === '-Split-') {
            html = 'This is just one part of a split transaction. Deleting it will remove the whole transaction. Are you sure you want to delete?'
        }
    }

    Swal.fire({
        html: html,
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
                url: `/accounting/delete-transaction/${transactionType}/${data.id}`,
                type: 'DELETE',
                success: function(result) {
                    location.reload();
                }
            });
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