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

    if($(this).attr('id') === 'custom-report-group') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'custom-report-group'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });
    }

    if($(this).attr('id') === 'filter-vendor') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-vendor'
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

    if($(this).attr('id') === 'filter-terms') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-terms'
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

$('#filter-report-period').on('change', function() {
    if($(this).val() !== 'all-dates') {
        var dates = get_start_and_end_dates($(this).val(), $(this));

        if($('#filter-report-period-to').length > 0) {
            $('#filter-report-period-to').val(dates.end_date);
        } else {
            $(`<div class="col-12 col-md-auto d-flex justify-content-center align-items-end">
                <span>as of</span>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-center align-items-end">
                <div class="nsm-field-group calendar">
                    <input type="text" class="nsm-field form-control date" value="${dates.end_date}" id="filter-report-period-to">
                </div>
            </div>`).insertAfter($(this).closest('.col-12'));

            $('#filter-report-period-to').datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        }
    } else {
        $(this).parent().next().next().remove();
        $(this).parent().next().remove();
    }
});

$('input[name="show_rows"], input[name="show_columns"]').on('change', function() {
    var rows = $('input[name="show_rows"]:checked');
    var columns = $('input[name="show_columns"]:checked');
    var rowsText = rows.next().text();
    var columnsText = columns.next().text();

    var buttonText = rowsText+' Rows/'+columnsText+' Columns';
    $(this).closest('.dropdown-menu').prev().html(buttonText+' <i class="bx bx-fw bx-caret-down"></i>')
});

$('#run-report').on('click', function(e) {
    e.preventDefault();

    var filterDate = $('#filter-report-period').val();
    var showRows = $('input[name="show_rows"]:checked').val();
    var showCols = $('input[name="show_columns"]:checked').val();
    var agingMethod = $('input[name="filter_aging_method"]:checked').val();
    var daysPerAgingPeriod = $('#filter-days-per-aging-period').val();
    var numberOfPeriods = $('#filter-number-of-periods').val();

    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'today' ? `date=${filterDate}&` : '';
    url += filterDate !== 'today' && filterDate !== 'all-dates' ? `to=${$('#filter-report-period-to').val().replaceAll('/', '-')}&` : '';
    url += showRows !== 'active' ? `show-rows=${showRows}&` : '';
    url += showCols !== 'active' ? `show-columns=${showCols}&` : '';
    url += agingMethod !== 'report-date' ? `aging-method=${agingMethod}` : '';
    url += daysPerAgingPeriod !== '30' ? `days-per-aging-period=${daysPerAgingPeriod}` : '';
    url += numberOfPeriods !== '4' ? `number-of-periods=${numberOfPeriods}` : '';
    url += sortIn !== 'default' ? `order=${sortIn}&` : '';

    var currentUrl = currUrl.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        var notIncluded = [
            'date',
            'to',
            'show-rows',
            'show-columns',
            'aging-method',
            'days-per-aging-period',
            'number-of-periods'
        ];
        $.each(querySplit, function(key, value) {
            var selectedVal = value.split('=');
            if(notIncluded.includes(selectedVal[0]) === false) {
                url += value+'&';
            }
        });
    }

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});