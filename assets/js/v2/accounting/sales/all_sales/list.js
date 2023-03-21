const currUrl = window.location.href;

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

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#transactions-table thead td[data-name="${dataName}"]`).index();
    $(`#transactions-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    // $(`#print_customer_transactions_modal table tr`).each(function() {
    //     if(chk.prop('checked')) {
    //         $($(this).find('td')[index - 1]).show();
    //     } else {
    //         $($(this).find('td')[index - 1]).hide();
    //     }
    // });

    // $(`#print_preview_customer_transactions_modal #customer_transactions_table_print tr`).each(function() {
    //     if(chk.prop('checked')) {
    //         $($(this).find('td')[index - 1]).show();
    //     } else {
    //         $($(this).find('td')[index - 1]).hide();
    //     }
    // });
});

$('.table-filter select:not(#filter-customer)').select2({
    minimumResultsForSearch: -1
});

$('#filter-customer').select2({
    ajax: {
        url: '/accounting/get-dropdown-choices',
        dataType: 'json',
        data: function(params) {
            var query = {
                search: params.term,
                type: 'public',
                field: 'customer',
                for: 'filter'
            }

            // Query parameters will be ?search=[term]&type=public&field=[type]
            return query;
        }
    },
    templateResult: formatResult,
    templateSelection: optionSelect
});

$('.dropdown-menu.table-filter .date').datepicker({
    format: 'mm/dd/yyyy',
    orientation: 'bottom',
    autoclose: true
});

$('.dropdown-menu.table-settings, .dropdown-menu.p-3').on('click', function(e) {
    e.stopPropagation();
});

$('#reset-button').on('click', function() {
    var url = `${base_url}accounting/all-sales`;
    location.href = url;
});

$('#apply-button').on('click', function() {
    const noDate = [
        'unbilled-income',
        'recently-paid'
    ];

    var selected = $('.nsm-counter.selected');

    var filterType = $('#filter-type').val();
    var filterStatus = $('#filter-status');
    var filterDeliveryMethod = $('#filter-delivery-method');
    var filterDate = $('#filter-date').val();
    var filterFrom = $('#filter-from').val();
    var filterTo = $('#filter-to').val();
    var filterCustomer = $('#filter-customer').val();
    var filterAsOf = $('#filter-as-of').val();

    var url = `${base_url}accounting/all-sales?`;

    url += filterType !== 'all-transactions' ? `type=${filterType}&` : '';
    url += filterStatus.length > 0 && filterStatus.val() !== 'all-statuses' ? `status=${filterStatus.val()}&` : '';
    url += filterDeliveryMethod.length > 0 && filterDeliveryMethod.val() !== 'any' ? `delivery-method=${filterDeliveryMethod.val()}&` : '';
    url += noDate.includes(filterType) === false && filterDate !== 'last-365-days' ? `date=${filterDate}&` : '';
    url += filterType === 'unbilled-income' ? `date=${filterAsOf.replaceAll('/', '-')}&` : '';
    url += filterType !== 'unbilled-income' && filterType !== 'recently-paid' && filterDate !== 'last-365-days' ? `from=${filterFrom.replaceAll('/', '-')}&` : '';
    url += filterType !== 'unbilled-income' && filterType !== 'recently-paid' && filterDate !== 'last-365-days' ? `to=${filterTo.replaceAll('/', '-')}&` : '';
    url += filterType !== 'unbilled-income' && filterCustomer !== 'all' ? `customer=${filterCustomer}&` : '';
    url += selected.length > 0 ? `transaction=${selected.attr('id')}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }
    location.href = url;
});

$('#filter-type').on('change', function() {
    switch($(this).val()) {
        case 'unbilled-income' :
            $(this).closest('.row').siblings(':not(.mt-3)').remove();
            $(this).parent().addClass('col-12').removeClass('col-5');

            var date = new Date();
            var dd = String(date.getDate()).padStart(2, '0');
            var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = date.getFullYear();

            date = mm + '/' + dd + '/' + yyyy;

            $(`<div class="row">
                <div class="col">
                    <label for="filter-as-of">Unbilled Income As Of</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" name="filter_as_of_date" id="filter-as-of" class="form-control nsm-field date" value="${date}">
                    </div>
                </div>
            </div>`).insertAfter($(this).closest('.row'));

            $('#filter-as-of').datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        break;
        case 'recently-paid' :
            $(this).closest('.row').siblings(':not(.mt-3)').remove();
            $(this).parent().addClass('col-12').removeClass('col-5');

            $(`<div class="row">
                <div class="col-12">
                    <label for="filter-customer">Customer</label>
                    <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                        <option value="all" selected="selected">All</option>
                    </select>
                </div>
            </div>`).insertAfter($(this).closest('.row'));
        break;
        case 'estimates' :
            if($('#filter-date').length < 1) {
                $(this).closest('.row').siblings(':not(.mt-3)').remove();
                $(this).parent().addClass('col-5').removeClass('col-12');
    
                $(`<div class="row">
                    <div class="col-12">
                        <label for="filter-customer">Customer</label>
                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                            <option value="all" selected="selected">All</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-date">Date</label>
                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                            <option value="last-365-days" selected="selected">Last 365 days</option>
                            <option value="custom">Custom</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this-week">This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year">This year</option>
                            <option value="last-week">Last week</option>
                            <option value="last-month">Last month</option>
                            <option value="last-quarter">Last quarter</option>
                            <option value="last-year">Last year</option>
                            <option value="all-dates">All dates</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="filter-from">From</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-from">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="filter-to">To</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-to">
                        </div>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-status">Status</label>
                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                            <option value="all-statuses" selected>All statuses</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="draft">Draft</option>
                            <option value="submitted">Submitted</option>
                            <option value="accepted">Accepted</option>
                            <option value="invoiced">Invoiced</option>
                            <option value="lost">Lost</option>
                            <option value="declined-by-customer">Declined By Customer</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="filter-delivery-method">Delivery method</label>
                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                            <option value="any" selected="selected">Any</option>
                            <option value="print-later">Print later</option>
                            <option value="send-later">Send later</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $('.table-filter .date').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
    
                $('#filter-date').trigger('change');   
            } else {
                $('#filter-status').html(`<option value="all-statuses" selected>All statuses</option>
                <option value="open">Open</option>
                <option value="closed">Closed</option>
                <option value="draft">Draft</option>
                <option value="submitted">Submitted</option>
                <option value="accepted">Accepted</option>
                <option value="invoiced">Invoiced</option>
                <option value="lost">Lost</option>
                <option value="declined-by-customer">Declined By Customer</option>
                <option value="expired">Expired</option>`);
            }

            if($('#filter-customer').parent().hasClass('col-12')) {
                $('#filter-customer').parent().removeClass('col-12').addClass('col-5');
            }
        break;
        case 'invoices' :
            if($('#filter-date').length < 1) {
                $(this).closest('.row').siblings(':not(.mt-3)').remove();
                $(this).parent().addClass('col-5').removeClass('col-12');
    
                $(`<div class="row">
                    <div class="col-12">
                        <label for="filter-customer">Customer</label>
                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                            <option value="all" selected="selected">All</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-date">Date</label>
                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                            <option value="last-365-days" selected="selected">Last 365 days</option>
                            <option value="custom">Custom</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this-week">This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year">This year</option>
                            <option value="last-week">Last week</option>
                            <option value="last-month">Last month</option>
                            <option value="last-quarter">Last quarter</option>
                            <option value="last-year">Last year</option>
                            <option value="all-dates">All dates</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="filter-from">From</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-from">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="filter-to">To</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-to">
                        </div>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-status">Status</label>
                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                            <option value="all-statuses" selected="selected">All statuses</option>
                            <option value="open">Open</option>
                            <option value="overdue">Overdue</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="filter-delivery-method">Delivery method</label>
                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                            <option value="any" selected="selected">Any</option>
                            <option value="print-later">Print later</option>
                            <option value="send-later">Send later</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $('.table-filter .date').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
    
                $('#filter-date').trigger('change');   
            } else {
                $('#filter-status').html(`<option value="all-statuses" selected="selected">All statuses</option>
                <option value="open">Open</option>
                <option value="overdue">Overdue</option>
                <option value="paid">Paid</option>`);
            }

            if($('#filter-customer').parent().hasClass('col-12')) {
                $('#filter-customer').parent().removeClass('col-12').addClass('col-5');
            }
        break;
        case 'sales-receipts' :
            if($('#filter-date').length < 1) {
                $(this).closest('.row').siblings(':not(.mt-3)').remove();
                $(this).parent().addClass('col-5').removeClass('col-12');
    
                $(`<div class="row">
                    <div class="col-12">
                        <label for="filter-customer">Customer</label>
                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                            <option value="all" selected="selected">All</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-date">Date</label>
                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                            <option value="last-365-days" selected="selected">Last 365 days</option>
                            <option value="custom">Custom</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this-week">This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year">This year</option>
                            <option value="last-week">Last week</option>
                            <option value="last-month">Last month</option>
                            <option value="last-quarter">Last quarter</option>
                            <option value="last-year">Last year</option>
                            <option value="all-dates">All dates</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="filter-from">From</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-from">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="filter-to">To</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-to">
                        </div>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-status">Status</label>
                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                            <option value="all-statuses" selected="selected">All statuses</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="filter-delivery-method">Delivery method</label>
                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                            <option value="any" selected="selected">Any</option>
                            <option value="print-later">Print later</option>
                            <option value="send-later">Send later</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $('.table-filter .date').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
    
                $('#filter-date').trigger('change');   
            } else {
                $('#filter-status').children(':not([value="all-statuses"])').remove();
            }

            if($('#filter-customer').parent().hasClass('col-12')) {
                $('#filter-customer').parent().removeClass('col-12').addClass('col-5');
            }
        break;
        case 'credit-memos' :
            if($('#filter-date').length < 1) {
                $(this).closest('.row').siblings(':not(.mt-3)').remove();
                $(this).parent().addClass('col-5').removeClass('col-12');
    
                $(`<div class="row">
                    <div class="col-12">
                        <label for="filter-customer">Customer</label>
                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                            <option value="all" selected="selected">All</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-date">Date</label>
                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                            <option value="last-365-days" selected="selected">Last 365 days</option>
                            <option value="custom">Custom</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this-week">This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year">This year</option>
                            <option value="last-week">Last week</option>
                            <option value="last-month">Last month</option>
                            <option value="last-quarter">Last quarter</option>
                            <option value="last-year">Last year</option>
                            <option value="all-dates">All dates</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="filter-from">From</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-from">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="filter-to">To</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-to">
                        </div>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-status">Status</label>
                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                            <option value="all-statuses" selected="selected">All statuses</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="filter-delivery-method">Delivery method</label>
                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                            <option value="any" selected="selected">Any</option>
                            <option value="print-later">Print later</option>
                            <option value="send-later">Send later</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $('.table-filter .date').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
    
                $('#filter-date').trigger('change');   
            } else {
                $('#filter-status').children(':not([value="all-statuses"])').remove();
            }

            if($('#filter-customer').parent().hasClass('col-12')) {
                $('#filter-customer').parent().removeClass('col-12').addClass('col-5');
            }
        break;
        case 'money-received' :
            if($('#filter-date').length < 1) {
                $(this).closest('.row').siblings(':not(.mt-3)').remove();
                $(this).parent().addClass('col-5').removeClass('col-12');
    
                $(`<div class="row">
                    <div class="col-12">
                        <label for="filter-customer">Customer</label>
                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                            <option value="all" selected="selected">All</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-date">Date</label>
                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                            <option value="last-365-days" selected="selected">Last 365 days</option>
                            <option value="custom">Custom</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this-week">This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year">This year</option>
                            <option value="last-week">Last week</option>
                            <option value="last-month">Last month</option>
                            <option value="last-quarter">Last quarter</option>
                            <option value="last-year">Last year</option>
                            <option value="all-dates">All dates</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="filter-from">From</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-from">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="filter-to">To</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-to">
                        </div>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-status">Status</label>
                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                            <option value="all-statuses" selected="selected">All statuses</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $('.table-filter .date').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
    
                $('#filter-date').trigger('change');   
            } else {
                $('#filter-status').children(':not([value="all-statuses"])').remove();
                $('#filter-delivery-method').parent().remove();
            }

            if($('#filter-customer').parent().hasClass('col-12')) {
                $('#filter-customer').parent().removeClass('col-12').addClass('col-5');
            }
        break;
        case 'statements' :
            if($('#filter-date').length < 1) {
                $(this).closest('.row').siblings(':not(.mt-3)').remove();
                $(this).parent().addClass('col-5').removeClass('col-12');
    
                $(`<div class="row">
                    <div class="col-12">
                        <label for="filter-customer">Customer</label>
                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                            <option value="all" selected="selected">All</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-date">Date</label>
                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                            <option value="last-365-days" selected="selected">Last 365 days</option>
                            <option value="custom">Custom</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this-week">This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year">This year</option>
                            <option value="last-week">Last week</option>
                            <option value="last-month">Last month</option>
                            <option value="last-quarter">Last quarter</option>
                            <option value="last-year">Last year</option>
                            <option value="all-dates">All dates</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="filter-from">From</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-from">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="filter-to">To</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-to">
                        </div>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $('.table-filter .date').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
    
                $('#filter-date').trigger('change');   
            } else {
                $('#filter-status').closest('.row').remove();
            }

            if($('#filter-customer').parent().hasClass('col-12')) {
                $('#filter-customer').parent().removeClass('col-12').addClass('col-5');
            }
        break;
        default :
            if($('#filter-date').length < 1) {
                $(this).closest('.row').siblings(':not(.mt-3)').remove();
                $(this).parent().addClass('col-5').removeClass('col-12');
    
                $(`<div class="row">
                    <div class="col-12">
                        <label for="filter-customer">Customer</label>
                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                            <option value="all" selected="selected">All</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-date">Date</label>
                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                            <option value="last-365-days" selected="selected">Last 365 days</option>
                            <option value="custom">Custom</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="this-week">This week</option>
                            <option value="this-month">This month</option>
                            <option value="this-quarter">This quarter</option>
                            <option value="this-year">This year</option>
                            <option value="last-week">Last week</option>
                            <option value="last-month">Last month</option>
                            <option value="last-quarter">Last quarter</option>
                            <option value="last-year">Last year</option>
                            <option value="all-dates">All dates</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="filter-from">From</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-from">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="filter-to">To</label>
                        <div class="nsm-field-group calendar">
                            <input type="text" class="nsm-field form-control date" value="" id="filter-to">
                        </div>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $(`<div class="row">
                    <div class="col-4">
                        <label for="filter-status">Status</label>
                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                            <option value="all-statuses" selected="selected">All statuses</option>
                            <option value="open">Open</option>
                            <option value="overdue">Overdue</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="accepted">Accepted</option>
                            <option value="closed">Closed</option>
                            <option value="rejected">Rejected</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="filter-delivery-method">Delivery method</label>
                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                            <option value="any" selected="selected">Any</option>
                            <option value="print-later">Print later</option>
                            <option value="send-later">Send later</option>
                        </select>
                    </div>
                </div>`).insertAfter($(this).closest('.row'));
    
                $('.table-filter .date').datepicker({
                    format: 'mm/dd/yyyy',
                    orientation: 'bottom',
                    autoclose: true
                });
    
                $('#filter-date').trigger('change');   
            } else {
                $('#filter-status').html(`<option value="all-statuses" selected="selected">All statuses</option>
                <option value="open">Open</option>
                <option value="overdue">Overdue</option>
                <option value="paid">Paid</option>
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="closed">Closed</option>
                <option value="rejected">Rejected</option>
                <option value="expired">Expired</option>`);
            }

            if($('#filter-customer').parent().hasClass('col-12')) {
                $('#filter-customer').parent().removeClass('col-12').addClass('col-5');
            }
        break;
    }
});

$(document).on('change', '#filter-from, #filter-to', function() {
    $('#filter-date').val('custom').trigger('change');
});

$(document).on('change', '#filter-date', function() {
    switch($(this).val()) {
        case 'last-365-days' :
            var date = new Date();
            date.setDate(date.getDate() - 365);

            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = '';
        break;
        case 'custom' :
            var from_date = $('#filter-from').val();
            var to_date = $('#filter-to').val();
        break;
        case 'today' :
            var date = new Date();
            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'yesterday' :
            var date = new Date();
            date.setDate(date.getDate() - 1);
            var from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'this-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();
            var to = from + 6;

            var from_date = new Date(date.setDate(from));
            var to_date = new Date(date.setDate(to));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            
            switch(currQuarter) {
                case 1 :
                    var from_date = '01/01/' + date.getFullYear();
                    var to_date = '03/31/'+ date.getFullYear();
                break;
                case 2 :
                    var from_date = '04/01/' + date.getFullYear();
                    var to_date = '06/30/'+ date.getFullYear();
                break;
                case 3 :
                    var from_date = '07/01/' + date.getFullYear();
                    var to_date = '09/30/'+ date.getFullYear();
                break;
                case 4 :
                    var from_date = '10/01/' + date.getFullYear();
                    var to_date = '12/31/'+ date.getFullYear();
                break;
            }
        break;
        case 'this-year' :
            var date = new Date();

            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'last-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();

            var from_date = new Date(date.setDate(from - 7));
            var to_date = new Date(date.setDate(date.getDate() + 6));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            from_date = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            
            switch(currQuarter) {
                case 1 :
                    var from_date = new Date('01/01/' + date.getFullYear());
                    var to_date = new Date('03/31/'+ date.getFullYear());
                break;
                case 2 :
                    var from_date = new Date('04/01/' + date.getFullYear());
                    var to_date = new Date('06/30/'+ date.getFullYear());
                break;
                case 3 :
                    var from_date = new Date('07/01/' + date.getFullYear());
                    var to_date = new Date('09/30/'+ date.getFullYear());
                break;
                case 4 :
                    var from_date = new Date('10/01/' + date.getFullYear());
                    var to_date = new Date('12/31/'+ date.getFullYear());
                break;
            }

            from_date.setMonth(from_date.getMonth() - 3);
            to_date.setMonth(to_date.getMonth() - 3);

            if(to_date.getDate() === 1) {
                to_date.setDate(to_date.getDate() - 1);
            }

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-year' :
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        default :
            var from_date = '';
            var to_date = '';
        break;
    }

    $('#filter-from').val(from_date);
    $('#filter-to').val(to_date);
});

$('.nsm-counter').on('click', function() {
    var id = $(this).attr('id');
    var val = id.includes('-invoices') ? 'invoices' : id;

    if($(this).hasClass('selected')) {
        $('#filter-type').val('all-transactions').trigger('change');
        $(this).removeClass('selected');

        if(id === 'open-invoices') {
            $('#overdue-invoices').removeClass('co-selected');
        }
    } else {
        $('.nsm-counter').removeClass('selected');
        $('.nsm-counter').removeClass('co-selected');

        $('#filter-type').val(val).trigger('change');

        switch(id) {
            case 'estimates' :
                $('#filter-status').val('open').trigger('change');
            break;
            case 'overdue-invoices' :
                $('#filter-status').val('overdue').trigger('change');
            break;
            case 'open-invoices' :
                $('#filter-status').val('open').trigger('change');

                $('.nsm-counter#overdue-invoices').addClass('co-selected');
            break;
        }

        $('#filter-date').val('last-365-days').trigger('change');
        $('#filter-customer').html('<option value="all">All</option>').trigger('change');

        $(this).addClass('selected');
    }

    $('#apply-button').trigger('click');
});

$('#new-invoice').on('click', function() {
    $.get('/accounting/get-other-modals/invoice_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#invoiceModal';
        initModalFields('invoiceModal');

        $('#invoiceModal').modal('show');
    });
});

$('#new-payment').on('click', function() {
    $.get('/accounting/get-other-modals/receive_payment_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#receivePaymentModal';
        initModalFields('receivePaymentModal');

        $('#receivePaymentModal').modal('show');
    });
});

$('#new-sales-receipt').on('click', function() {
    $.get('/accounting/get-other-modals/sales_receipt_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#salesReceiptModal';
        initModalFields('salesReceiptModal');

        $('#salesReceiptModal').modal('show');
    });
});

$('#new-credit-memo').on('click', function() {
    $.get('/accounting/get-other-modals/credit_memo_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#creditMemoModal';
        initModalFields('creditMemoModal');

        $('#creditMemoModal').modal('show');
    });
});

$('#new-delayed-charge').on('click', function() {
    $.get('/accounting/get-other-modals/delayed_charge_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#delayedChargeModal';
        initModalFields('delayedChargeModal');

        $('#delayedChargeModal').modal('show');
    });
});

$('#new-time-activity').on('click', function() {
    $.get('/accounting/get-other-modals/single_time_activity_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#singleTimeModal';
        initModalFields('singleTimeModal');

        $('#singleTimeModal').modal('show');
    });
});

$('#new-standard-estimate').on('click', function() {
    $.get('/accounting/get-other-modals/standard_estimate_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#standard-estimate-modal';
        initModalFields('standard-estimate-modal');

        $('#standard-estimate-modal').modal('show');
    });
});

$('#new-options-estimate').on('click', function() {
    $.get('/accounting/get-other-modals/options_estimate_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#options-estimate-modal';
        initModalFields('options-estimate-modal');

        $('#options-estimate-modal').modal('show');
    });
});

$('#new-bundle-estimate').on('click', function() {
    $.get('/accounting/get-other-modals/bundle_estimate_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#bundle-estimate-modal';
        initModalFields('bundle-estimate-modal');

        $('#bundle-estimate-modal').modal('show');
    });
});

$("#btn_print_all_sales_transactions").on("click", function() {
    $("#all_sales_transactions_table_print").printThis();
});

$(document).on('click', '#transactions-table .view-edit-time-charge', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/time-activity/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#singleTimeModal';
        initModalFields('singleTimeModal', data);

        $('#singleTimeModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-billable-expense', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/billable-expense/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#billableExpenseModal';
        initModalFields('billableExpenseModal', data);

        $('#billableExpenseModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-invoice', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/invoice/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#invoiceModal';
        initModalFields('invoiceModal', data);

        $('#invoiceModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-estimate', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/estimate/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        if($('#modal-container #standard-estimate-modal').length > 0) {
            modalName = '#standard-estimate-modal';
        }

        if($('#modal-container #options-estimate-modal').length > 0) {
            modalName = '#options-estimate-modal';
        }

        if($('#modal-container #bundle-estimate-modal').length > 0) {
            modalName = '#bundle-estimate-modal';
        }

        initModalFields(modalName.replace('#', ''), data);
        CKEDITOR.replace('estimate-terms-and-conditions');
        CKEDITOR.replace('estimate-message-to-customer');
        CKEDITOR.replace('estimate-instructions');

        $(modalName).modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-credit-memo', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/credit-memo/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#creditMemoModal';
        initModalFields('creditMemoModal', data);

        $('#creditMemoModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-sales-receipt', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/sales-receipt/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#salesReceiptModal';
        initModalFields('salesReceiptModal', data);

        $('#salesReceiptModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-refund-receipt', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/refund-receipt/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#refundReceiptModal';
        initModalFields('refundReceiptModal', data);

        $('#refundReceiptModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-delayed-credit', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/delayed-credit/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#delayedCreditModal';
        initModalFields('delayedCreditModal', data);

        $('#delayedCreditModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-delayed-charge', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get('/accounting/view-transaction/delayed-charge/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#delayedChargeModal';
        initModalFields('delayedChargeModal', data);

        $('#delayedChargeModal').modal('show');
    });
});

$(document).on('click', '#transactions-table .view-edit-payment', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = {
        id: id,
        type: 'Receive Payment'
    };

    $.get('/accounting/view-transaction/receive-payment/'+id, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#receivePaymentModal';
        initModalFields('receivePaymentModal', data);

        loadPaymentInvoices(data);
        loadPaymentCredits(data);

        $('#receivePaymentModal').modal('show');
    });
});

$('#transactions-table .copy-transaction').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
    var transactionType = row.find('td:nth-child(3)').text().trim();
    transactionType = transactionType.replaceAll(' ', '-');
    transactionType = transactionType.toLowerCase();

    var data = {
        id: id,
        type: row.find('td:nth-child(3)').text().trim()
    };

    $.get(`/accounting/copy-transaction/${transactionType}/${id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#modal-container form .modal').parent().attr('onsubmit', 'submitModalForm(event, this)').removeAttr('data-href');

        modalName = '#'+$('#modal-container form .modal').attr('id');
        initModalFields($('#modal-container form .modal').attr('id'), data);

        $(modalName).modal('show');
    });
});

$('#transactions-table .delete-invoice').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Delete Invoice',
        text: 'Are you sure you want to delete this invoice?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: `/accounting/delete-transaction/invoice/${id}`,
                type: 'DELETE',
                success: function(result) {
                    location.reload();
                }
            });
        }
    });
});

$('#transactions-table .void-invoice').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Void Invoice',
        text: 'Are you sure you want to void this invoice?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get('/accounting/void-transaction/invoice/'+id, function(res) {
                location.reload();
            });
        }
    });
});

$('#transactions-table .void-credit-memo').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Void Credit Memo',
        text: 'Are you sure you want to void this credit memo?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get('/accounting/void-transaction/credit-memo/'+id, function(res) {
                location.reload();
            });
        }
    });
});

$('#transactions-table .delete-sales-receipt').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Delete Sales Receipt',
        text: 'Are you sure you want to delete this sales-receipt?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: `/accounting/delete-transaction/sales-receipt/${id}`,
                type: 'DELETE',
                success: function(result) {
                    location.reload();
                }
            });
        }
    });
});

$('#transactions-table .void-sales-receipt').on('click', function(e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();

    Swal.fire({
        title: 'Void Sales Receipt',
        text: 'Are you sure you want to void this sales-receipt?',
        icon: 'question',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.get('/accounting/void-transaction/sales-receipt/'+id, function(res) {
                location.reload();
            });
        }
    });
});

$('#transactions-table .create-invoice').on('click', function (e) {
    e.preventDefault();

    var id = $(this).closest('tr').find('.select-one').val();
    var type = $(this).closest('tr').find('td:nth-child(3)').text().trim();
    
    $.get(`/accounting/customers/create-invoice/${type.toLowerCase().replaceAll(' ', '-')}/${id}`, function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        modalName = '#invoiceModal';
        initModalFields('invoiceModal');

        $('#invoiceModal #customer').trigger('change');
        $('#invoiceModal input[name="quantity[]"]:first-child').trigger('change');

        $(modalName).modal('show');
    });
});

$('#transactions-table .send-estimate').on("click", function(e) {
    e.preventDefault();
    var refnumIndex = $('#transactions-table thead tr td[data-name="No."]').index();
    var emailIndex = $('#transactions-table thead tr td[data-name="Email"]').index();
    var customerIndex = $('#transactions-table thead tr td[data-name="Customer"]').index();

    var row = $(this).closest('tr');
    var ref_no = $(row.find('td')[refnumIndex]).text().trim();
    var id = row.find('.select-one').val();
    var email = $(row.find('td')[emailIndex]).text().trim();
    var customerName = $(row.find('td')[customerIndex]).text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`Estimate ${ref_no} from ${companyName}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Please review the estimate below.  Feel free to contact us if you have any questions.
We look forward to working with you.

Thanks for your business!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/estimate/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$(document).on('click', '#transactions-table .update-estimate-status', function(e) {
    e.preventDefault();
    var estimateId = $(this).closest('tr').find('.select-one').val();
    var url = `/accounting/customers/update-estimate-status/${estimateId}`;

    $('#update-status-modal #update-estimate-status-form').attr('action', url).attr('method', 'post');
    $('#update-status-modal #status').val($(this).closest('tr').find('td:nth-child(16)').text().trim()).trigger('change');

    $('#update-status-modal').modal('show');
});

$('#update-status-modal').on('hidden.bs.modal', function() {
    $('#update-status-modal #update-estimate-status-form').removeAttr('action').removeAttr('method');
    $('#update-status-modal #status').val('Draft').trigger('change');
});

$('#update-status-modal #status').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#update-status-modal')
});

$('#update-status-modal #status').on('change', function() {
    if($(this).val() === 'Accepted') {
        $(this).closest('.row').parent().append(`<div class="row grid-mb">
            <div class="col-12">
                <label for="accepted-date">Accepted Date</label>
                <div class="nsm-field-group calendar">
                    <input type="text" class="nsm-field form-control" value="" id="accepted-date" name="accepted_date">
                </div>
            </div>
        </div>`);

        $('#update-status-modal #accepted-date').datepicker({
            format: 'mm/dd/yyyy',
            orientation: 'bottom',
            autoclose: true
        });
    } else {
        $('#update-status-modal #accepted-date').closest('.row').remove();
    }
});

$('#transactions-table .send-invoice').on('click', function(e) {
    e.preventDefault();
    var refnumIndex = $('#transactions-table thead tr td[data-name="No."]').index();
    var emailIndex = $('#transactions-table thead tr td[data-name="Email"]').index();
    var customerIndex = $('#transactions-table thead tr td[data-name="Customer"]').index();

    var row = $(this).closest('tr');
    var ref_no = $(row.find('td')[refnumIndex]).text().trim();
    var id = row.find('.select-one').val();
    var email = $(row.find('td')[emailIndex]).text().trim();
    var customerName = $(row.find('td')[customerIndex]).text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`New payment request from ${companyName} - invoice ${ref_no}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Here's your invoice! We appreciate your prompt payment.

Thanks for your business!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/invoice/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('#transactions-table .send-credit-memo').on('click', function(e) {
    e.preventDefault();
    var refnumIndex = $('#transactions-table thead tr td[data-name="No."]').index();
    var emailIndex = $('#transactions-table thead tr td[data-name="Email"]').index();
    var customerIndex = $('#transactions-table thead tr td[data-name="Customer"]').index();

    var row = $(this).closest('tr');
    var ref_no = $(row.find('td')[refnumIndex]).text().trim();
    var id = row.find('.select-one').val();
    var email = $(row.find('td')[emailIndex]).text().trim();
    var customerName = $(row.find('td')[customerIndex]).text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`Credit Memo #${ref_no} from ${companyName}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Your credit memo is attached.  We have reduced your account balance by the amount shown on the credit memo.

Have a great day!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/credit-memo/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('#transactions-table .send-sales-receipt').on('click', function(e) {
    e.preventDefault();
    var refnumIndex = $('#transactions-table thead tr td[data-name="No."]').index();
    var emailIndex = $('#transactions-table thead tr td[data-name="Email"]').index();
    var customerIndex = $('#transactions-table thead tr td[data-name="Customer"]').index();

    var row = $(this).closest('tr');
    var ref_no = $(row.find('td')[refnumIndex]).text().trim();
    var id = row.find('.select-one').val();
    var email = $(row.find('td')[emailIndex]).text().trim();
    var customerName = $(row.find('td')[customerIndex]).text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`Sales Receipt #${ref_no} from ${companyName}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Please review the sales receipt below.
We appreciate it very much.

Thanks for your business!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/sales-receipt/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('#transactions-table .send-refund-receipt').on('click', function(e) {
    e.preventDefault();
    var refnumIndex = $('#transactions-table thead tr td[data-name="No."]').index();
    var emailIndex = $('#transactions-table thead tr td[data-name="Email"]').index();
    var customerIndex = $('#transactions-table thead tr td[data-name="Customer"]').index();

    var row = $(this).closest('tr');
    var ref_no = $(row.find('td')[refnumIndex]).text().trim();
    var id = row.find('.select-one').val();
    var email = $(row.find('td')[emailIndex]).text().trim();
    var customerName = $(row.find('td')[customerIndex]).text().trim();

    $('#send-transaction-email span.modal-title').html('Send email for '+ref_no);
    $('#send-transaction-email #email-to').val(email);
    $('#send-transaction-email #email-subject').val(`Refund Receipt from ${companyName}`);
    $('#send-transaction-email #email-message').val(`Dear ${customerName.trim()},

Please find your refund receipt attached to this email.

Thank you.

Have a great day!
${companyName}`);

    $('#send-transaction-email #send-transaction-form').attr('action', `/accounting/customers/send-transaction/refund-receipt/${id}`);
    $('#send-transaction-email #send-transaction-form').attr('method', `post`);
    $('#send-transaction-email').modal('show');
});

$('.export-transactions').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/all-sales/export" method="post" id="export-form"></form>`);
    }

    var fields = $('#transactions-table thead tr td:not(:first-child, :last-child)');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('data-name')}">`);
    });

    var currentUrl = currUrl.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        $.each(querySplit, function(key, value) {
            var selectedVal = value.split('=');
            $('#export-form').append(`<input type="hidden" name="${selectedVal[0]}" value="${selectedVal[1]}">`);
        });
    }

    $('#export-form').append(`<input type="hidden" name="column" value="date">`);
    $('#export-form').append(`<input type="hidden" name="order" value="desc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$('#transactions-table thead .select-all').on('change', function() {
    $('#transactions-table tbody tr:visible .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$('#transactions-table tbody tr:visible .select-one').on('change', function() {
    var checked = $('#transactions-table tbody tr:visible .select-one:checked').length;
    var rows = $('#transactions-table tbody tr:visible .select-one').length;

    $('#transactions-table thead .select-all').prop('checked', checked === rows);

    var printable = true;
    var sendableReminder = true;

    var printableTypes = [
        'Invoice',
        'Estimate',
        'Credit Memo',
        'Sales Receipt',
        'Refund'
    ];

    var invoiceOpenNotStatus = [
        'Draft',
        'Declined',
        'Paid'
    ];

    $('#transactions-table tbody tr:visible .select-one:checked').each(function() {
        var statusIndex = $('#transactions-table thead tr td[data-name="Status"]').index();
        var row = $(this).closest('tr');
        var type = row.find('td:nth-child(3)').text().trim();
        var status = $(row.find('td')[statusIndex]).text().trim();

        if(printableTypes.includes(type) === false) {
            printable = false;
        }

        if(type === 'Invoice' && invoiceOpenNotStatus.includes(status) || type !== 'Invoice') {
            sendableReminder = false;
        }
    });

    if(printable && checked > 0) {
        $('#print-transactions').removeClass('disabled');
        $('#send-transactions').removeClass('disabled');
    } else {
        $('#print-transactions').addClass('disabled');
        $('#send-transactions').addClass('disabled');
    }

    if(sendableReminder && checked > 0) {
        $('#send-reminders').removeClass('disabled');
    } else {
        $('#send-reminders').addClass('disabled');
    }
});

$('#send-transactions').on('click', function(e) {
    var data = new FormData();

    $('#transactions-table tbody .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var id = $(this).val();
        var typeIndex = $('#transactions-table thead tr td[data-name="Type"]').index();
        var type = $(row.find('td')[typeIndex]).text().trim().toLowerCase();

        data.append('transactions[]', `${type.replaceAll(' ', '_')}-${id}`);
    });

    $.ajax({
        url: `/accounting/send-sales-transactions`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            Swal.fire({
                text: res.message,
                icon: res.success ? 'success' : 'error',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 1500
            })
        }
    });
});

$('#print-transactions').on('click', function(e) {
    if($('#print-transactions-form').length < 1) {
        $('body').append(`<form action="/accounting/print-sales-transactions" method="post" id="print-transactions-form" target="_blank"></form>`);
    }

    $('#transactions-table tbody .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var id = $(this).val();
        var typeIndex = $('#transactions-table thead tr td[data-name="Type"]').index();
        var type = $(row.find('td')[typeIndex]).text().trim().toLowerCase();

        $('#print-transactions-form').append(`<input type="hidden" name="transactions[]" value="${type.replaceAll(' ', '_')}-${id}">`);
    });

    $('#print-transactions-form').submit();
    $('#print-transactions-form').remove();
});

$('#send-reminders').on('click', function(e) {
    var data = new FormData();

    $('#transactions-table tbody .select-one:checked').each(function() {
        var id = $(this).val();

        data.append('invoices[]', id);
    });

    $.ajax({
        url: `/accounting/send-invoice-reminders`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            Swal.fire({
                text: res.message,
                icon: res.success ? 'success' : 'error',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 1500
            })
        }
    });
});