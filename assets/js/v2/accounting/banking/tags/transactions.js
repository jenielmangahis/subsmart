$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');
});

$('select[multiple="multiple"]').select2({
    allowClear: true
});

$('#tags-filter-dropdown select').on('change', function() {
    var el = $(this);
    var value = el.select2('val');

    var flag = false;
    for(i = 0; i < value.length; i++) {
        if(value[i].includes(`all`)) {
            flag = true;
        }
    }
    if(flag === true && el.children('option:not(:checked)').length > 0) {
        if(el.attr('id') === 'filter-ungrouped' && value.includes('all') || value.includes(`all`)) {
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

$('#transactions-filter-dropdown select').each(function() {
    if($(this).attr('id') !== 'filter-contact') {
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

$('#filter-type').on('change', function() {
    var row = $(this).parent().parent();
    switch($(this).val()) {
        case 'all-transactions' :
            $('#filter-money-in').parent().parent().remove();
            $('#filter-money-out').parent().parent().remove();
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
            var field = `<div class="row">
                <div class="col-12 col-md-4 mt-3">
                    <label for="filter-money-in">Money in transactions</label>
                    <select id="filter-money-in" class="form-select nsm-field">
                        ${options}
                    </select>
                </div>
            </div>`;

            if($('#filter-money-out').length > 0) {
                $('#filter-money-out').prev().attr('for', 'filter-money-in');
                $('#filter-money-out').prev().html('Money in transactions');
                $('#filter-money-out').html(options);
                $('#filter-money-out').attr('id', 'filter-money-in');
            } else {
                $(field).insertAfter(row);
            }

            $('#filter-money-in').select2({
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
            var field = `<div class="row">
                <div class="col-4">
                    <label for="filter-money-out">Money out transactions</label>
                    <select id="filter-money-out" class="form-select nsm-field">
                        ${options}
                    </select>
                </div>
            </div>`;

            if($('#filter-money-in').length > 0) {
                $('#filter-money-in').prev().attr('for', 'filter-money-out');
                $('#filter-money-in').prev().html('Money out transactions');
                $('#filter-money-in').html(options);
                $('#filter-money-in').attr('id', 'filter-money-out');
            } else {
                $(field).insertAfter(row);
            }

            $('#filter-money-out').select2({
                minimumResultsForSearch: -1
            });
        break;
    }
});

$('#filter-date').on('change', function() {
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
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            var date = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            var from = date;
            var to = date;
        break;
    }

    $('#filter-from').val(from);
    $('#filter-to').val(to);
});

$('#filter-from, #filter-to').on('change', function() {
    $('#filter-date').val('custom').trigger('change');
});

$('#apply-filters-button').on('click', function() {
    var type = $('#filter-type').val();
    var moneyIn = $('#filter-money-in').val();
    var moneyOut = $('#filter-money-out').val();
    var date = $('#filter-date').val();
    var from = $('#filter-from').val();
    var to = $('#filter-to').val();
    var contact = $('#filter-contact').val();
    var untagged = $('#show_untagged_transactions').prop('checked');

    var url = `${base_url}accounting/tags/transactions?`;

    url += type !== 'all-transactions' ? `type=${type}&` : '';
    url += type === 'money-in' && moneyIn !== 'all' ? `money-in=${moneyIn}&` : '';
    url += type === 'money-out' && moneyOut !== 'all' ? `money-out=${moneyOut}&` : '';
    url += date !== 'last-365-days' ? `date=${date}&` : '';
    url += date !== 'last-365-days' && from !== '' ? `from=${from}&` : '';
    url += date !== 'last-365-days' && to !== '' ? `to=${to}&` : '';
    url += contact !== 'all-contacts' ? `contact=${contact}&` : '';
    url += untagged ? `untagged=${untagged}` : '';

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

$('#reset-filters-button').on('click', function() {
    $('#filter-type').val('all-transactions').trigger('change');
    $('#filter-date').val('last-365-days').trigger('change');
    $('#filter-contact').html('<option value="all-contacts" selected>All contacts</option>').trigger('change');

    $('#apply-filters-button').trigger('click');
});

$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});