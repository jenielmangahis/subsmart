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

    // if($(this).attr('id') === 'filter-distribution-account') {
    //     $(this).select2({
    //         ajax: {
    //             url: '/accounting/get-dropdown-choices',
    //             dataType: 'json',
    //             data: function(params) {
    //                 var query = {
    //                     search: params.term,
    //                     type: 'public',
    //                     field: 'filter-report-account'
    //                 }

    //                 // Query parameters will be ?search=[term]&type=public&field=[type]
    //                 return query;
    //             }
    //         },
    //         templateResult: formatResult,
    //         templateSelection: optionSelect,
    //         dropdownParent: $(this).closest('.modal')
    //     });
    // }

    if($(this).attr('id') === 'filter-account') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-account'
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
        case 'today' :
            var date = new Date();
            startDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'this-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();
            var to = from + 6;

            var from_date = new Date(date.setDate(from));
            var to_date = new Date(date.setDate(to));

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-week-to-date' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            var from = date.getDate() - date.getDay();
            var from_date = new Date(date.setDate(from));

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
        break;
        case 'this-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            startDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'this-month-to-date' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            startDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
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
        case 'this-quarter-to-date' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            switch(currQuarter) {
                case 1 :
                    startDate = '01/01/' + date.getFullYear();
                break;
                case 2 :
                    startDate = '04/01/' + date.getFullYear();
                break;
                case 3 :
                    startDate = '07/01/' + date.getFullYear();
                break;
                case 4 :
                    startDate = '10/01/' + date.getFullYear();
                break;
            }
        break;
        case 'this-year' :
            var date = new Date();

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'this-year-to-date' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'this-year-to-last-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'yesterday' :
            var date = new Date();
            date.setDate(date.getDate() - 1);
            startDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'recent' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            var from_date = new Date(date.setDate(date.getDate() - 4));

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
        break;
        case 'last-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();

            var from_date = new Date(date.setDate(from - 7));
            var to_date = new Date(date.setDate(date.getDate() + 6));

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-week-to-date' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            var from = date.getDate() - date.getDay();
            var from_date = new Date(date.setDate(from - 7));
            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
        break;
        case 'last-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            startDate = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'last-month-to-date' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            startDate = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
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
        case 'last-quarter-to-date' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
            switch(currQuarter) {
                case 1 :
                    var from_date = new Date('01/01/' + date.getFullYear());
                break;
                case 2 :
                    var from_date = new Date('04/01/' + date.getFullYear());
                break;
                case 3 :
                    var from_date = new Date('07/01/' + date.getFullYear());
                break;
                case 4 :
                    var from_date = new Date('10/01/' + date.getFullYear());
                break;
            }

            from_date.setMonth(from_date.getMonth() - 3);
            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
        break;
        case 'last-year' :
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'last-year-to-date' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            date.setFullYear(date.getFullYear() - 1);

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
        break;
        case 'since-30-days-ago' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            var from_date = new Date(date.setDate(date.getDate() - 30));
            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
        break;
        case 'since-60-days-ago' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            var from_date = new Date(date.setDate(date.getDate() - 60));
            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
        break;
        case 'since-90-days-ago' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();

            var from_date = new Date(date.setDate(date.getDate() - 90));
            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
        break;
        case 'since-365-days-ago' :
            var date = new Date();
            endDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(date.getDate()).padStart(2, '0') + '/' + date.getFullYear();
            
            var from_date = new Date(date.setDate(date.getDate() - 365));
            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
        break;
        case 'next-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();

            var from_date = new Date(date.setDate(from + 7));
            var to_date = new Date(date.setDate(date.getDate() + 6));

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'next-4-weeks' :
            var date = new Date();
            var from = date.getDate() - date.getDay();

            var from_date = new Date(date.setDate(from + 7));
            var to_date = new Date(date.setDate(date.getDate() + 27));

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'next-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            startDate = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'next-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);

            switch(currQuarter + 1) {
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

            if(to_date.getDate() === 1) {
                to_date.setDate(to_date.getDate() - 1);
            }

            startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
        break;
        case 'next-year' :
            var date = new Date();
            date.setFullYear(date.getFullYear() + 1);

            startDate = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            endDate = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
        break;
    }

    return {
        start_date : startDate,
        end_date : endDate
    };
}