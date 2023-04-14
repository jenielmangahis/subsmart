const currUrl = window.location.href;
const urlSplit = currUrl.includes('?') ? currUrl.split('?')[0].split('/') : currUrl.split('/');
const reportId = urlSplit[urlSplit.length - 1].replace('#', '');

$('.date').each(function() {
    $(this).datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});

$('select').each(function() {
    if($(this).closest('.modal').length > 0) {
        $(this).select2({
            minimumResultsForSearch: -1,
            dropdownParent: $(this).closest('.modal')
        });
    } else {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    }

    if($(this).attr('id') === 'filter-customer') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-customer'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $(this).closest('.modal')
        });
    }

    if($(this).attr('id') === 'filter-employee') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-employee'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $(this).closest('.modal')
        });
    }

    if($(this).attr('id') === 'filter-product-service') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-item'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $(this).closest('.modal')
        });
    }
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#show-cols').on('click', function(e) {
    e.preventDefault();

    if($(this).text().trim().replace('Show ', '') === 'More') {
        $(this).html('<i class="fa fa-caret-up text-info"></i> Show Less');

        $(this).parent().prev().show();
    } else {
        $(this).html('<i class="fa fa-caret-down text-info"></i> Show More');

        $(this).parent().prev().hide();
    }
});

$('input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#reports-table thead td[data-name="${dataName}"]`).index();
    $(`#reports-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_report_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_preview_report_modal #report_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });
});

$('#run-report').on('click', function(e) {
    e.preventDefault();

    var filterDate = $('#filter-activity-date').val();
    var groupBy = $('#group-by').val();
    var sortBy = $('#sort-by').val();
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'this-month-to-date' ? `date=${filterDate}&` : '';
    url += filterDate !== 'this-month-to-date' && filterDate !== 'all-dates' ? `from=${$('#filter-activity-date-from').val().replaceAll('/', '-')}&to=${$('#filter-activity-date-to').val().replaceAll('/', '-')}&` : '';
    url += groupBy !== 'employee' ? `group-by=${groupBy}&` : '';
    url += sortBy !== 'default' ? `column=${sortBy}&` : '';
    url += sortIn !== 'asc' ? `order=${sortIn}&` : '';

    url += $('#divide-by-100').prop('checked') ? `divide-by-100=1&` : '';
    url += $('#without-cents').prop('checked') ? `without-cents=1&` : '';
    url += $('#negative-numbers').val() !== '-100' ? `negative-numbers=${$('#negative-numbers').val()}&` : '';
    url += $('#show-in-red').prop('checked') ? `show-in-red=1&` : '';

    url += $('#allow-filter-customer').prop('checked') && $('#filter-customer').val() !== 'all' ? `customer=${$('#filter-customer').val()}&` : '';
    url += $('#allow-filter-product-service').prop('checked') && $('#filter-product-service').val() !== 'all' ? `product-service=${$('#filter-product-service').val()}&` : '';
    url += $('#allow-filter-employee').prop('checked') && $('#filter-employee').val() !== 'all' ? `employee=${$('#filter-employee').val()}&` : '';
    url += $('#allow-filter-create-date').prop('checked') && $('#filter-create-date').val() !== 'all-dates' ? `create-date=${$('#filter-create-date').val()}&` : '';
    url += $('#allow-filter-create-date').prop('checked') && $('#filter-create-date').val() !== 'all-dates' ? `create-date-from=${$('#filter-create-date-from').val().replaceAll('/', '-')}&` : '';
    url += $('#allow-filter-create-date').prop('checked') && $('#filter-create-date').val() !== 'all-dates' ? `create-date-to=${$('#filter-create-date-to').val().replaceAll('/', '-')}&` : '';
    url += $('#allow-filter-last-modified-date').prop('checked') && $('#filter-last-modified-date').val() !== 'all-dates' ? `last-modified-date=${$('#filter-last-modified-date').val()}&` : '';
    url += $('#allow-filter-last-modified-date').prop('checked') && $('#filter-last-modified-date').val() !== 'all-dates' ? `last-modified-date-from=${$('#filter-last-modified-date-from').val().replaceAll('/', '-')}&` : '';
    url += $('#allow-filter-last-modified-date').prop('checked') && $('#filter-last-modified-date').val() !== 'all-dates' ? `last-modified-date-to=${$('#filter-last-modified-date-to').val().replaceAll('/', '-')}&` : '';
    url += $('#allow-filter-billable').prop('checked') && $('#filter-billable').val() !== 'all' ? `billable=${$('#filter-billable').val()}&` : '';
    url += $('#allow-filter-memo').prop('checked') && $('#filter-memo').val().trim() !== '' ? `memo=${$('#filter-memo').val().trim()}&` : '';

    url += $('#show-logo').prop('checked') ? `show-logo=yes&` : '';
    url += $('#show-company-name').prop('checked') ? `` : 'show-company-name=no&';
    url += $('#show-company-name').prop('checked') && $('#company-name').val() !== companyName ? `company-name=${$('#company-name').val()}&` : '';
    url += $('#show-report-title').prop('checked') ? `` : 'show-report-title=no&';
    url += $('#show-report-title').prop('checked') && $('#report-title').val() !== 'Time Activities by Employee Detail' ? `report-title=${$('#report-title').val()}&` : '';
    url += $('#show-report-period').prop('checked') ? `show-report-period=1&` : '';
    url += $('#show-date-prepared').prop('checked') ? `` : 'show-date-prepared=no&';
    url += $('#show-time-prepared').prop('checked') ? `` : 'show-time-prepared=no&';
    url += $('#header-alignment').val() !== 'center' ? `header-alignment=${$('#header-alignment').val()}&` : '';
    url += $('#footer-alignment').val() !== 'center' ? `footer-alignment=${$('#footer-alignment').val()}&` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});