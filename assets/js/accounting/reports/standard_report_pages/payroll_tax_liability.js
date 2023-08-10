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
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#filter-report-period').on('change', function() {
    if($(this).val() !== 'all-dates') {
        var dates = get_start_and_end_dates($(this).val(), $(this));

        if($('#filter-report-period-from').length > 0) {
            $('#filter-report-period-from').val(dates.start_date);
            $('#filter-report-period-to').val(dates.end_date);
        } else {
            $(`<div class="row grid-mb">
                <div class="col-12 col-md-6">
                    <label for="filter-report-period-from">From</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" class="nsm-field form-control date" value="${dates.start_date}" id="filter-report-period-from">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label for="filter-report-period-to">To</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" class="nsm-field form-control date" value="${dates.end_date}" id="filter-report-period-to">
                    </div>
                </div>
            </div>`).insertAfter($(this).closest('.row'));

            $('#filter-report-period-from, #filter-report-period-to').datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        }
    } else {
        $('#filter-report-period-from').closest('.row').remove();
    }
});

$('#run-report').on('click', function(e) {
    e.preventDefault();

    var filterDate = $('#filter-report-period').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'last-pay-date' ? `date=${filterDate}&` : '';
    url += filterDate !== 'last-pay-date' ? `from=${$('#filter-report-period-from').val().replaceAll('/', '-')}&to=${$('#filter-report-period-to').val().replaceAll('/', '-')}&` : '';

    // var currentUrl = currUrl.replace('#', '');
    // var urlSplit = currentUrl.split('?');
    // var query = urlSplit[1];

    // if(query !== undefined) {
    //     var querySplit = query.split('&');

    //     var notIncluded = [
    //         'date',
    //         'from',
    //         'to',
    //     ];
    //     $.each(querySplit, function(key, value) {
    //         var selectedVal = value.split('=');
    //         if(notIncluded.includes(selectedVal[0]) === false) {
    //             url += value+'&';
    //         }
    //     });
    // }

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});

$("#btn_print_report").on("click", function() {
    $("#report_table_print").printThis();
});

$('#export-to-excel').on('click', function(e) {
    e.preventDefault();

    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/reports/${reportId}/export" method="post" id="export-form"></form>`);
    }

    $('#export-form').append(`<input type="hidden" name="type" value="excel">`);

    var fields = $('#reports-table thead tr td:visible:not(.table-icon)');
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

    $('#export-form').submit();
    $('#export-form').remove();
});

$('#export-to-pdf').on('click', function(e) {
    e.preventDefault();

    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/reports/${reportId}/export" method="post" id="export-form"></form>`);
    }

    $('#export-form').append(`<input type="hidden" name="type" value="pdf">`);

    var fields = $('#reports-table thead tr td:visible:not(.table-icon)');
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

    $('#export-form').submit();
    $('#export-form').remove();
});

function get_start_and_end_dates(val, el)
{
    switch(val) {
        case 'custom' :
            if($(`#${el.attr('id')}-from`).length > 0) {
                startDate = $(`#${el.attr('id')}-from`).val();
                endDate = $(`#${el.attr('id')}-to`).val();
            } else {
                startDate = '';
                endDate = '';
            }
        break;
        case 'this-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            startDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            
            switch(currQuarter) {
                case 1 :
                    startDate = '01/01/' + date.getFullYear();
                    endDate = '03/31/'+ date.getFullYear();
                break;
                case 2 :
                    startDate = '04/01/' + date.getFullYear();
                    endDate = '06/30/'+ date.getFullYear();
                break;
                case 3 :
                    startDate = '07/01/' + date.getFullYear();
                    endDate = '09/30/'+ date.getFullYear();
                break;
                case 4 :
                    startDate = '10/01/' + date.getFullYear();
                    endDate = '12/31/'+ date.getFullYear();
                break;
            }
        break;
        case 'this-year' :
            var date = new Date();

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'last-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            startDate = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
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

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-year' :
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'first-quarter' :
            var date = new Date();

            startDate = '01/01/' + date.getFullYear();
            endDate = '03/31/'+ date.getFullYear();
        break;
        case 'second-quarter' :
            var date = new Date();

            startDate = '04/01/' + date.getFullYear();
            endDate = '06/30/'+ date.getFullYear();
        break;
        case 'third-quarter' :
            var date = new Date();

            startDate = '07/01/' + date.getFullYear();
            endDate = '09/30/'+ date.getFullYear();
        break;
    }

    return {
        start_date : startDate,
        end_date : endDate
    };
}