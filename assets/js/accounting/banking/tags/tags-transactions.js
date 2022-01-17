$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#tags-filter-dropdown select').each(function() {
    $(this).select2();
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
            column.next().remove();
        break;
        case 'money-in' :
            var field = `<div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="money-in">Money in transactions</label>
                            <select id="money-in" class="form-control">
                                <option value="all" selected>All money in</option>
                                <option value="invoice">Invoice</option>
                                <option value="sales-receipt">Sales receipt</option>
                                <option value="estimate">Estimate</option>
                                <option value="cc-credit">Credit card credit</option>
                                <option value="vendor-credit">Vendor credit</option>
                                <option value="credit-memo">Credit memo</option>
                                <option value="activity-charge">Activity charge</option>
                                <option value="deposit">Deposit</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>`;

            if($('#money-out').length > 0) {
                $('#money-out').prev().attr('money-in');
                $('#money-out').prev().html('Money in transactions');
                $('#money-out').html(`
                <option value="all" selected>All money in</option>
                <option value="invoice">Invoice</option>
                <option value="sales-receipt">Sales receipt</option>
                <option value="estimate">Estimate</option>
                <option value="cc-credit">Credit card credit</option>
                <option value="vendor-credit">Vendor credit</option>
                <option value="credit-memo">Credit memo</option>
                <option value="activity-charge">Activity charge</option>
                <option value="deposit">Deposit</option>
                `);
                $('#money-out').attr('id', 'money-in');
            } else {
                $(field).insertAfter(column);
            }

            $('#money-in').select2({
                minimumResultsForSearch: -1
            });
        break;
        case 'money-out' :
            var field = `<div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="money-out">Money out transactions</label>
                            <select id="money-out" class="form-control">
                                <option value="all" selected>All money out</option>
                                <option value="expense">Expense</option>
                                <option value="bill">Bill</option>
                                <option value="credit-memo">Credit memo</option>
                                <option value="refund-receipt">Refund receipt</option>
                                <option value="cash-purchase">Cash purchase</option>
                                <option value="check">Check</option>
                                <option value="cc-expense">Credit card expense</option>
                                <option value="purchase-order">Purchase order</option>
                                <option value="vendor-credit">Vendor credit</option>
                                <option value="activity-credit">Activity credit</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>`;

            if($('#money-in').length > 0) {
                $('#money-in').prev().attr('money-out');
                $('#money-in').prev().html('Money out transactions');
                $('#money-in').html(`
                <option value="all" selected>All money out</option>
                <option value="expense">Expense</option>
                <option value="bill">Bill</option>
                <option value="credit-memo">Credit memo</option>
                <option value="refund-receipt">Refund receipt</option>
                <option value="cash-purchase">Cash purchase</option>
                <option value="check">Check</option>
                <option value="cc-expense">Credit card expense</option>
                <option value="purchase-order">Purchase order</option>
                <option value="vendor-credit">Vendor credit</option>
                <option value="activity-credit">Activity credit</option>
                `);
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
                    <input type="checkbox" value="${rowData.id}" id="account-${rowData.id}">
                    <label for="account-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
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
        data: 'amount',
        name: 'amount'
    },
    {
        data: 'tags',
        name: 'tags'
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
	order: [[1, 'asc']],
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

function applybtn() {
    $('#transactions-table').DataTable().ajax.reload(null, true);
}