$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#tags-filter-dropdown select').each(function() {
    $(this).select2();
});

$('#add-tag-modal #tags-to-add').select2({
    placeholder: 'Start typing to add a tag',
    allowClear: true,
    ajax: {
        url: '/accounting/get-job-tags',
        dataType: 'json'
    }
});

$('#filter-dropdown select').each(function() {
    if($(this).attr('id') !== 'by-contact') {
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
                        field: 'transaction-contact'
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

$('#filter-dropdown input.datepicker').each(function() {
    $(this).datepicker({
        uiLibrary: 'bootstrap'
    });
});

$('#date').on('change', function() {
    switch($(this).val()) {
        case 'all' :
            var from = '';
            var to = '';
        break;
        case 'today' :
            var today = new Date();
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            var date = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            var from = date;
            var to = date;
        break;
        case 'yesterday' :
            var today = new Date();
            today.setDate(today.getDate() - 1);
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            var date = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            var from = date;
            var to = date;
        break;
        case 'this-week' :
            var today = new Date();
            var first = today.getDate() - today.getDay();
            var last = first + 6;

            var from = new Date(today.setDate(first));
            var to = new Date(today.setDate(last));
            from = String(from.getMonth() + 1).padStart(2, '0') + '/' + String(from.getDate()).padStart(2, '0') + '/' + from.getFullYear();
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + to.getFullYear();
        break;
        case 'this-month' :
            var today = new Date();
            var to = new Date(today.getFullYear(), today.getMonth() + 1, 0);

            var from = String(today.getMonth() + 1).padStart(2, '0') + '/01/' + today.getFullYear();
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + today.getFullYear();
        break;
        case 'this-quarter' :
            var today = new Date();
            var year = today.getFullYear();
            var quarters = [
                [1,2,3],
                [4,5,6],
                [7,8,9],
                [10,11,12]
            ];

            var dates = [];
            dates[0] = {
                from: '01/01/'+year,
                to: '03/31/'+year
            };
            dates[1] = {
                from: '04/01/'+year,
                to: '06/30/'+year
            };
            dates[2] = {
                from: '07/01/'+year,
                to: '09/30/'+year
            };
            dates[3] = {
                from: '10/01/'+year,
                to: '12/31/'+year
            };

            var quarter = 0;
            for(var i = 0; i < quarters.length; i++) {
                if(quarters[i].includes(today.getMonth() + 1)) {
                    quarter = i;
                }
            }

            var from = dates[quarter].from;
            var to = dates[quarter].to;
        break;
        case 'this-year' :
            var today = new Date();
            var from = '01/01/'+today.getFullYear();
            var to = '12/31/'+today.getFullYear();
        break;
        case 'last-week' :
            var from = new Date();
            from.setDate(from.getDate() - from.getDay() - 7);
            from = String(from.getMonth() + 1).padStart(2, '0') + '/' + String(from.getDate()).padStart(2, '0') + '/' + from.getFullYear();

            var to = new Date();
            to.setDate(to.getDate() - to.getDay() - 1);
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + to.getFullYear();
        break;
        case 'last-month' :
            var today = new Date();
            var from = new Date();
            from.setMonth(today.getMonth() - 1);
            from.setDate(1);
            var to = new Date(from.getFullYear(), from.getMonth() + 1, 0);
            from = String(from.getMonth() + 1).padStart(2, '0') + '/' + String(from.getDate()).padStart(2, '0') + '/' + from.getFullYear();
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + to.getFullYear();
        break;
        case 'last-quarter' :
            var today = new Date();
            var year = today.getFullYear();
            var lastYear = year - 1;
            var quarters = [
                [1,2,3],
                [4,5,6],
                [7,8,9],
                [10,11,12]
            ];

            var dates = [];
            dates[0] = {
                from: '10/01/'+lastYear,
                to: '12/31/'+lastYear
            };
            dates[1] = {
                from: '01/01/'+year,
                to: '03/31/'+year
            };
            dates[2] = {
                from: '04/01/'+year,
                to: '06/30/'+year
            };
            dates[3] = {
                from: '07/01/'+year,
                to: '09/30/'+year
            };

            var quarter = 0;
            for(var i = 0; i < quarters.length; i++) {
                if(quarters[i].includes(today.getMonth() + 1)) {
                    quarter = i;
                }
            }

            var from = dates[quarter].from;
            var to = dates[quarter].to;
        break;
        case 'last-year' :
            var today = new Date();
            var year = today.getFullYear() - 1;
            var from = '01/01/'+year;
            var to = '12/31/'+year;
        break;
        case 'last-365-days' :
            var to = new Date();
            var fromYear = to.getFullYear() - 1;
            var from = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + fromYear;
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + to.getFullYear();
        break;
        case 'custom' :
            var today = new Date();
            var from = String(today.getMonth() + 1).padStart(2, '0') + '/' + String(today.getDate()).padStart(2, '0') + '/' + today.getFullYear();
            var to = String(today.getMonth() + 1).padStart(2, '0') + '/' + String(today.getDate()).padStart(2, '0') + '/' + today.getFullYear();
        break;
    }

    $('#from-date').val(from);
    $('#to-date').val(to);
});

$('#type').on('change', function() {
    var column = $(this).parent().parent().parent().parent();
    switch($(this).val()) {
        case 'all' :
            $('#money-in').parent().parent().parent().parent().remove();
            $('#money-out').parent().parent().parent().parent().remove();
        break;
        case 'money-in' :
            var options = `<option value="all" selected>All money in</option>
            <option value="invoice">Invoice</option>
            <option value="sales-receipt">Sales receipt</option>
            <option value="estimate">Estimate</option>
            <option value="cc-credit">Credit card credit</option>
            <option value="vendor-credit">Vendor credit</option>
            <option value="credit-memo">Credit memo</option>
            <option value="activity-charge">Activity charge</option>
            <option value="deposit">Deposit</option>`;
            var field = `<div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="money-in">Money in transactions</label>
                            <select id="money-in" class="form-control">
                                ${options}
                            </select>
                        </div>
                    </div>
                </div>
            </div>`;

            if($('#money-out').length > 0) {
                $('#money-out').prev().attr('money-in');
                $('#money-out').prev().html('Money in transactions');
                $('#money-out').html(options);
                $('#money-out').attr('id', 'money-in');
            } else {
                $(field).insertAfter(column);
            }

            $('#money-in').select2({
                minimumResultsForSearch: -1
            });
        break;
        case 'money-out' :
            var options = `<option value="all" selected>All money out</option>
            <option value="expense">Expense</option>
            <option value="bill">Bill</option>
            <option value="credit-memo">Credit memo</option>
            <option value="refund-receipt">Refund receipt</option>
            <option value="cash-purchase">Cash purchase</option>
            <option value="check">Check</option>
            <option value="cc-expense">Credit card expense</option>
            <option value="purchase-order">Purchase order</option>
            <option value="vendor-credit">Vendor credit</option>
            <option value="activity-credit">Activity credit</option>`;
            var field = `<div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="money-out">Money out transactions</label>
                            <select id="money-out" class="form-control">
                                ${options}
                            </select>
                        </div>
                    </div>
                </div>
            </div>`;

            if($('#money-in').length > 0) {
                $('#money-in').prev().attr('money-out');
                $('#money-in').prev().html('Money out transactions');
                $('#money-in').html(options);
                $('#money-in').attr('id', 'money-out');
            } else {
                $(field).insertAfter(column);
            }

            $('#money-out').select2({
                minimumResultsForSearch: -1
            });
        break;
    }
});

$('#tags-filter-dropdown select').on('change', function() {
    var el = $(this);
    var value = el.select2('val');
    var groupName = $(this).prev().html();
    
    var flag = false;
    for(i = 0; i < value.length; i++) {
        if(value[i].includes('all')) {
            flag = true;
        }
    }
    if(flag === true && el.children('option:not(:checked)').length > 0) {
        if(el.attr('id') === 'ungrouped' && value.includes('all') || value.includes(`all-${groupName}-tags`)) {
            var value = [];
            var i = 0;
            el.children('option').each(function() {
                value[i] = $(this).attr('value');

                i++;
            });
        }
    
        el.val(value).change();
    }
});

const columns = [
    {
        orderable: false,
        data: null,
        name: 'id',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            $(td).html(`
            <div class="d-flex justify-content-center">
                <div class="checkbox checkbox-sec m-0">
                    <input type="checkbox" value="${rowData.type.toLowerCase().replace(' ', '_')}-${rowData.id}" id="${rowData.type.toLowerCase().replace(' ', '-')}-${rowData.id}">
                    <label for="${rowData.type.toLowerCase().replace(' ', '-')}-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                </div>
            </div>
            `);
        }
    },
    {
        data: 'date',
        name: 'date'
    },
    {
        orderable: false,
        data: 'from_to',
        name: 'from_to'
    },
    {
        data: 'category',
        name: 'category'
    },
    {
        data: 'memo',
        name: 'memo'
    },
    {
        data: 'type',
        name: 'type'
    },
    {
        orderable: false,
        data: 'amount',
        name: 'amount',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            var amount = '$'+cellData;
            $(td).html(amount.replace('$-', '-$'));
        }
    },
    {
        orderable: false,
        data: 'tags',
        name: 'tags',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            var html = '<h5>';
            for(i = 0; i < cellData.length; i++) {
                var name = cellData[i].name;
                if(cellData[i].group_name !== undefined) {
                    name = `${cellData[i].group_name}: ${cellData[i].name}`;
                }
                html += `<span class="badge badge-light bg-light mr-1">${name}</span>`;
            }
            html += '</h5>'
            $(td).html(html);
        }
    }
];
$('#transactions-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: 150,
    info: false,
	order: [[1, 'desc']],
    ajax: {
		url: '/accounting/tags/load-transactions',
		dataType: 'json',
		contentType: 'application/json',
		type: 'POST',
		data: function(d) {
            d.type = $('#type').val();
            d.money_in = $('#money-in').val();
            d.money_out = $('#money-out').val();
            d.date = $('#date').val();
            d.from = $('#from-date').val();
            d.to = $('#to-date').val();
            d.contact = $('#by-contact').val();
            d.untagged = $('#untagged').prop('checked') ? 1 : 0;
            d.ungrouped = $('#ungrouped').select2('val');
            d.groups = [];

            var i = 0;
            $('#tags-filter-dropdown select:not(#ungrouped)').each(function() {
                d.groups[i] = $(this).select2('val');
                i++;
            });
			return JSON.stringify(d);
		},
		pagingType: 'full_numbers'
	},
	columns: columns
});

$('#reset-filters').on('click', function(e) {
    e.preventDefault();

    $('#type').val('all').trigger('change');
    $('#date').val('last-365-days').trigger('change');
    $('#by-contact').val('').trigger('change');
});

$('#reset-tags').on('click', function(e) {
    e.preventDefault();

    $('#untagged').prop('checked', false);
    $('#tags-filter-dropdown select').each(function() {
        $(this).val([]).change();
    });
});

$('#print-table').on('click', function(e) {
    e.preventDefault();

    var data = new FormData();

    data.set('type', $('#type').val());
    data.set('money_in', $('#money-in').val());
    data.set('money_out', $('#money-out').val());
    data.set('date', $('#date').val());
    data.set('from', $('#from-date').val());
    data.set('to', $('#to-date').val());
    data.set('contact', $('#by-contact').val());
    data.set('untagged', $('#untagged').prop('checked') ? 1 : 0);

    var ungrouped = $('#ungrouped').select2('val');
    for(i = 0; i < ungrouped.length; i++) {
        if(ungrouped[i] !== 'all') {
            data.append('ungrouped[]', ungrouped[i]);
        }
    }

    var tableOrder = $('#transactions-table').DataTable().order();
    data.set('column', columns[tableOrder[0][0]].name);
    data.set('order', tableOrder[0][1]);

    $('#tags-filter-dropdown select:not(#ungrouped)').each(function() {
        var selected = $(this).select2('val');
        
        for(i = 0; i < selected.length; i++) {
            if(selected[i].includes('all') === false) {
                data.append('grouped[]', selected[i]);
            }
        }
    });

    $.ajax({
        url: '/accounting/tags/print-transactions',
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

$('#select-all-transactions').on('change', function() {
    $('#transactions-table tbody input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
});

$(document).on('change', '#transactions-table tbody input[type="checkbox"]', function() {
    var checked = $('#transactions-table tbody input[type="checkbox"]:checked').length;
    var rows = $('#transactions-table tbody tr').length;

    $('#select-all-transactions').prop('checked', checked === rows);

    $('.actions-row .alert strong span').html(checked);
    $('#add-tag-modal .selected-transaction-count').html(checked);
    $('#remove-tags-modal .selected-transaction-count').html(checked);
    if(checked > 0) {
        $('.actions-row').removeClass('hide');
        $('.filters-row').addClass('hide');
    } else {
        $('.actions-row').addClass('hide');
        $('.filters-row').removeClass('hide');
    }
});

$('#actions-alert').on('closed.bs.alert', function() {
    $('#transactions-table input[type="checkbox"]').prop('checked', false);

    $('.actions-row').addClass('hide');
    $('.filters-row').removeClass('hide');
});

var selected = [];
$('#add-tag').on('click', function(e) {
    e.preventDefault();

    selected = [];
    $('#transactions-table tbody input[type="checkbox"]:checked').each(function() {
        selected.push($(this).val());
    });

    $('#add-tag-modal').modal('show');
});

$('#add-tag-modal #apply-tags').on('click', function(e) {
    e.preventDefault();

    var tags = $('#add-tag-modal #tags-to-add').val();
    var data = new FormData();

    for(i = 0; i < selected.length; i++) {
        data.append('transactions[]', selected[i]);
    }

    for(c = 0; c < tags.length; c++) {
        data.append('tags[]', tags[c]);
    }

    $.ajax({
        url: '/accounting/tags/transactions/add-tags',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            $('#add-tag-modal').modal('hide');
            $('#add-tag-modal #tags-to-add').val([]).change();
            $('#transactions-table input').prop('checked', false);
            $('#transactions-table').DataTable().ajax.reload(null, true);
            $('.actions-row').addClass('hide');
            $('.filters-row').removeClass('hide');
        }
    });
});

$('#remove-tags').on('click', function(e) {
    e.preventDefault();

    selected = [];
    $('#transactions-table tbody input[type="checkbox"]:checked').each(function() {
        selected.push($(this).val());
    });

    initialize_remove_tags_table();
    $('#remove-tags-modal').modal('show');
});

function initialize_remove_tags_table() {
    if($.fn.DataTable.isDataTable('#remove-tags-table')) {
        $('#remove-tags-table').DataTable().clear();
        $('#remove-tags-table').DataTable().destroy();
    }

    $('#remove-tags-table').DataTable({
        autoWidth: false,
        searching: false,
        processing: true,
        serverSide: true,
        lengthChange: false,
        pageLength: 50,
        info: false,
        ordering: false,
        ajax: {
            url: '/accounting/tags/transactions/load-tags-to-remove',
            dataType: 'json',
            contentType: 'application/json',
            type: 'POST',
            data: function(d) {
                d.search = $('#remove-tags-modal #search-tag').val();
                var transactions = [];
                for(i = 0; i < selected.length; i++) {
                    transactions.push(selected[i]);
                }
                d.transactions = transactions;

                return JSON.stringify(d);
            },
            pagingType: 'full_numbers'
        },
        columns: [
            {
                orderable: false,
                data: 'name',
                name: 'name',
                fnCreatedCell: function(td, cellData, rowData, row, col) {
                    var id = `${rowData.type}-${rowData.id}`;

                    $(td).html(`
                    <div class="checkbox checkbox-sec my-2">
                        <input type="checkbox" id="${id}">
                        <label for="${id}">${cellData}</label>
                    </div>
                    `);

                    $(td).addClass(rowData.type);

                    if(rowData.type.includes('tag')) {
                        $(td).addClass('d-flex');
                        $(td).addClass('justify-content-between');
                        $(td).addClass('align-items-center');
                        $(td).addClass('pl-5');

                        $(td).append(`<span>${rowData.count} transactions</span>`);
                    }
                }
            },
        ]
    });
}

$(document).on('change', '#remove-tags-modal #remove-tags-table input[type="checkbox"]', function() {
    var el = $(this);
    var row = $(this).parent().parent().parent();
    var index = row.index();
    var rowData = $('#remove-tags-table').DataTable().row(row).data();

    if(rowData.type === 'group' || rowData.type === 'ungrouped-group') {
        for(i = index + 2; i <= $('#remove-tags-table tbody tr').length; i++) {
            var r = $(`#remove-tags-table tbody tr:nth-child(${i})`);
            var rData = $('#remove-tags-table').DataTable().row(r).data();

            if(rData.type === 'group-tag' || rData.type === 'ungrouped-tag') {
                r.find('input[type="checkbox"]').prop('checked', el.prop('checked')).change();
            } else {
                break;
            }
        }
    } else {
        var text = $('#remove-tags-modal #remove-tags-table thead tr th span').html();
        var textSplit = text.split(' ');

        if(el.prop('checked')) {
            var total = parseInt(textSplit[0]) + 1;
        } else {
            var total = parseInt(textSplit[0]) - 1;
        }

        $('#remove-tags-modal #remove').prop('disabled', total < 1);
        $('#remove-tags-modal #remove-tags-table thead tr th span').html(total+' selected');
    }
});

$(document).on('keyup', '#remove-tags-modal #search-tag', function() {
    $('#remove-tags-modal #remove-tags-table thead tr th span').html('0 selected');
    $('#remove-tags-table').DataTable().ajax.reload(null, true);
});

$(document).on('click', '#remove-tags-modal button#remove', function(e) {
    e.preventDefault();

    var data = new FormData();

    for(i = 0; i < selected.length; i++) {
        data.append('transactions[]', selected[i]);
    }

    if($('#remove-tags-modal #remove-tags-table tbody tr input[type="checkbox"]:checked').length > 0) {
        $('#remove-tags-modal #remove-tags-table tbody tr input[type="checkbox"]:checked').each(function() {
            var row = $(this).parent().parent().parent();
            var rowData = $('#remove-tags-table').DataTable().row(row).data();
            if(rowData.type === 'group-tag' || rowData.type === 'ungrouped-tag') {
                data.append('tags[]', rowData.id);
            }
        });
    
        $.ajax({
            url: '/accounting/tags/transactions/remove-tags',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                $('#remove-tags-modal').modal('hide');
                $('#transactions-table input').prop('checked', false);
                $('#transactions-table').DataTable().ajax.reload(null, true);
                $('.actions-row').addClass('hide');
                $('.filters-row').removeClass('hide');
            }
        });
    } else {
        Swal.fire({
            text: "Please selected at least 1 tag to remove.",
            icon: 'error',
            showCloseButton: true,
            confirmButtonColor: '#2ca01c',
            confirmButtonText: 'OK',
            timer: 2000
        })
    }
});

$(document).on('click', '#transactions-table tbody tr td:not(:first-child)', function() {
    var row = $(this).parent();
    var data = $('#transactions-table').DataTable().row(row).data();
    var type = data.type.replace(' ', '-').toLowerCase();

    $.get(`/accounting/view-transaction/${type}/${data.id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        switch(type) {
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
            case 'deposit' :
                rowCount = 8;
                rowInputs = $('#depositModal table tbody tr:first-child()').html();
                blankRow = $('#depositModal table tbody tr:last-child()').html();

                $('#depositModal table.clickable tbody tr:first-child()').remove();
                $('#depositModal table tbody tr:last-child()').remove();

                initModalFields('depositModal', data);

                $('#depositModal').modal('show');
            break;
            case 'purchase-order' :
                initModalFields('purchaseOrderModal', data);

                $('#purchaseOrderModal').modal('show');
            break;
        }
    });
});

function applybtn() {
    $('#transactions-table').DataTable().ajax.reload(null, true);
}