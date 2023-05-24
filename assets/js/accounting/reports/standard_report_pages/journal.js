$('.date').each(function() {
    $(this).datepicker({
        uiLibrary: 'bootstrap'
    });
});

$('select').select2({
    minimumResultsForSearch: -1
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
        $('#filter-report-period-from').closest('.row').remove();
    }
});

$('#report-period-date').on('change', function() {
    if($(this).val() === 'all-dates') {
        $(this).parent().next().next().remove();
        $(this).parent().next().remove();
    } else {
        var dates = get_start_and_end_dates($(this).val(), $(this));

        if($(`#${$(this).attr('id')}-from`).length > 0) {
            $(`#${$(this).attr('id')}-from`).val(dates.start_date);
            $(`#${$(this).attr('id')}-to`).val(dates.end_date);
        } else {
            $(`<div class="col-12 col-md-4">
                <label for="${$(this).attr('id')}-from">From</label>
                <div class="nsm-field-group calendar">
                    <input type="text" class="nsm-field form-control date" value="${dates.start_date}" id="${$(this).attr('id')}-from">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <label for="${$(this).attr('id')}-to">To</label>
                <div class="nsm-field-group calendar">
                    <input type="text" class="nsm-field form-control date" value="${dates.end_date}" id="${$(this).attr('id')}-to">
                </div>
            </div>`).insertAfter($(this).parent());

            $(`#${$(this).attr('id')}-from, #${$(this).attr('id')}-to`).datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        }
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

$("#btn_print_report").on("click", function() {
    $("#report_table_print").printThis();
});

$('#export-to-excel').on('click', function(e) {
    e.preventDefault();

    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/reports/${reportId}/export" method="post" id="export-form"></form>`);
    }

    $('#export-form').append(`<input type="hidden" name="type" value="excel">`);

    var fields = $('#reports-table thead tr td:visible');
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

    $('#export-form').append(`<input type="hidden" name="column" value="${$('#sort-by').val()}">`);
    $('#export-form').append(`<input type="hidden" name="order" value="${$('input[name="sort_order"]:checked').val()}">`);

    $('#export-form').submit();
    $('#export-form').remove();
});

$('#export-to-pdf').on('click', function(e) {
    e.preventDefault();

    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/reports/${reportId}/export" method="post" id="export-form"></form>`);
    }

    $('#export-form').append(`<input type="hidden" name="type" value="pdf">`);

    var fields = $('#reports-table thead tr td:visible');
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

    $('#export-form').append(`<input type="hidden" name="column" value="${$('#sort-by').val()}">`);
    $('#export-form').append(`<input type="hidden" name="order" value="${$('input[name="sort_order"]:checked').val()}">`);

    $('#export-form').submit();
    $('#export-form').remove();
});

$('#sort-by, [name="sort_order"]').on('change', function() {
    var sortBy = $('#sort-by').val();
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += sortBy !== 'default' ? `column=${sortBy}&` : '';
    url += sortIn !== 'asc' ? `order=${sortIn}&` : '';

    var currentUrl = currUrl.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        var notIncluded = [
            'column',
            'order'
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

$('#run-report').on('click', function(e) {
    e.preventDefault();

    var filterDate = $('#filter-report-period').val();
    var sortBy = $('#sort-by').val();
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'this-month-to-date' ? `date=${filterDate}&` : '';
    url += filterDate !== 'this-month-to-date' && filterDate !== 'all-dates' ? `from=${$('#filter-report-period-from').val().replaceAll('/', '-')}&to=${$('#filter-report-period-to').val().replaceAll('/', '-')}&` : '';
    url += sortBy !== 'default' ? `column=${sortBy}&` : '';
    url += sortIn !== 'asc' ? `order=${sortIn}&` : '';

    var currentUrl = currUrl.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        var notIncluded = [
            'date',
            'from',
            'to',
            'column',
            'order'
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

$('#run-report-button').on('click', function() {
    var date = $('#report-period-date').val();
    var sortBy = $('#sort-by').val();
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += date !== 'this-month-to-date' ? `date=${date}&` : '';
    url += date !== 'this-month-to-date' && date !== 'all-dates' ? `from=${$('#report-period-date-from').val().replaceAll('/', '-')}&to=${$('#report-period-date-to').val().replaceAll('/', '-')}&` : '';
    url += sortBy !== 'default' ? `column=${sortBy}&` : '';
    url += sortIn !== 'asc' ? `order=${sortIn}&` : '';

    url += $('#divide-by-100').prop('checked') ? `divide-by-100=1&` : '';
    url += $('#without-cents').prop('checked') ? `without-cents=1&` : '';
    url += $('#negative-numbers').val() !== '-100' ? `negative-numbers=${$('#negative-numbers').val()}&` : '';
    url += $('#show-in-red').prop('checked') ? `show-in-red=1&` : '';

    var columns = [];
    $('input[name="select_columns"]:checked').each(function() {
        columns.push($(this).next().text().trim());
    });

    if(columns.length < $('#reports-table thead tr td').length) {
        url += `columns=${columns}&`;
    }

    url += $('#allow-filter-transaction-type').prop('checked') && $('#filter-transaction-type').val() !== 'all' ? `transaction-type=${$('#filter-transaction-type').val()}&` : '';
    url += $('#allow-filter-account').prop('checked') && $('#filter-account').val() !== 'all' ? `account=${$('#filter-account').val()}&` : '';
    url += $('#allow-filter-name').prop('checked') && $('#filter-name').val() !== 'all' ? `name=${$('#filter-name').val()}&` : '';
    url += $('#allow-filter-check-printed').prop('checked') && $('#filter-check-printed').val() !== 'all' ? `check-printed=${$('#filter-check-printed').val()}&` : '';
    url += $('#allow-filter-num').prop('checked') && $('#filter-num').val() !== 'all' ? `num=${$('#filter-num').val()}&` : '';

    url += $('#show-logo').prop('checked') ? `show-logo=yes&` : '';
    url += $('#show-company-name').prop('checked') ? `` : 'show-company-name=no&';
    url += $('#show-company-name').prop('checked') && $('#company-name').val() !== companyName ? `company-name=${$('#company-name').val()}&` : '';
    url += $('#show-report-title').prop('checked') ? `` : 'show-report-title=no&';
    url += $('#show-report-title').prop('checked') && $('#report-title').val() !== 'Journal' ? `report-title=${$('#report-title').val()}&` : '';
    url += $('#show-date-prepared').prop('checked') ? `` : 'show-date-prepared=no&';
    url += $('#show-time-prepared').prop('checked') ? `` : 'show-time-prepared=no&';
    url += $('#header-alignment').val() !== 'center' ? `header-alignment=${$('#header-alignment').val()}&` : '';
    url += $('#footer-alignment').val() !== 'center' ? `footer-alignment=${$('#footer-alignment').val()}&` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});

$('#filter-transaction-type, #filter-account, #filter-name, #filter-check-printed').on('change', function() {
    if($(this).val() !== 'all') {
        $(`#allow-${$(this).attr('id')}`).prop('checked', true);
    } else {
        $(`#allow-${$(this).attr('id')}`).prop('checked', false);
    }
});

$('#filter-num').on('change', function() {
    if($(this).val() !== '') {
        $('#allow-filter-num').prop('checked', true);
    } else {
        $('#allow-filter-num').prop('checked', false);
    }
});

$('#reset-columns-to-default').on('click', function(e) {
    e.preventDefault();

    $('input[name="select_columns"]').prop('checked', true);
});

$(document).on('click', '#change-columns', function(e) {
    e.preventDefault();

    $(this).parent().prev().removeClass('d-none');
    $(this).html('Hide change columns');
    $(this).attr('id', 'hide-change-columns');
});

$(document).on('click', '#hide-change-columns', function(e) {
    e.preventDefault();

    $(this).parent().prev().addClass('d-none');
    $(this).html('Change columns');
    $(this).attr('id', 'change-columns');
});

$('#add-notes').on('click', function(e) {
    e.preventDefault();

    $('#report-note-form').removeClass('d-none');
});

$('#edit-notes').on('click', function(e) {
    e.preventDefault();

    $('#report-note-form').removeClass('d-none');
    $('#report-note-cont').addClass('d-none');
});

$('#cancel-note-update').on('click', function(e) {
    e.preventDefault();

    $('#report-note-form').addClass('d-none');
    $('#report-note-cont').removeClass('d-none');

    $('#report-note').val($('#report-note-cont').html().trim().replaceAll('<br>', ''));
});

$('#save-note').on('click', function(e) {
    e.preventDefault();

    var data = new FormData();
    data.set('note', $('#report-note').val());
   
    $.ajax({
        url: `/accounting/reports/${reportId}/update-note`,
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

            if($('#report-note').val().trim() === '') {
                $('#add-notes, #edit-notes').text('Add notes');
                $('#add-notes, #edit-notes').attr('id', 'add-notes');
            } else {
                $('#add-notes, #edit-notes').text('Edit notes');
                $('#add-notes, #edit-notes').attr('id', 'edit-notes');
            }

            $('#report-note-cont').html($('#report-note').val().trim().replaceAll('\n', '<br>'));
            $('#report-note-form').addClass('d-none');
            $('#report-note-cont').removeClass('d-none');
        }
    });
});

$('#add-new-custom-report-group').on('click', function(e) {
    e.preventDefault();

    $(this).parent().next().removeClass('d-none');
});

$('#new-custom-report-group').on('submit', function(e) {
    e.preventDefault();

    var data = new FormData();
    data.set('name', $('#custom-group-name').val());

    $.ajax({
        url: `/accounting/reports/add-custom-report-group`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            $('#custom-report-group').append(`<option value="${res.data}" selected>${res.name}</option>`);
            $('#custom-group-name').val('');
        }
    });
});

$('#save-custom-report').on('click', function(e) {
    e.preventDefault();

    var data = new FormData();
    data.set('name', $('#custom-report-name').val());

    $.ajax({
        url: `/accounting/reports/check-custom-report-name`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            if(res.exists) {
                Swal.fire({
                    // title: 'Delete Invoice',
                    text: 'A custom report with this name already exists. Enter a new name, or click Replace to replace the existing report.',
                    icon: 'warning',
                    confirmButtonText: 'Replace',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonColor: '#2ca01c',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if(result.isConfirmed) {
                        save_custom_report(res.data);
                    }
                });
            } else {
                save_custom_report();
            }
        }
    });
});

function save_custom_report(customReport = {})
{
    var data = new FormData();
    data.set('name', $('#custom-report-name').val());
    data.set('report_id', reportId);
    data.set('custom_report_group_id', $('#custom-report-group').val());
    data.set('share_with', $('#share-with').val());

    var currentUrl = currUrl.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        $.each(querySplit, function(key, value) {
            var selectedVal = value.split('=');
            if(selectedVal[0] !== 'date') {
                data.append(`settings[${selectedVal[0]}]`, selectedVal[1]);
            } else {
                data.set('date_range', selectedVal[1]);
            }
        });
    }

    if(data.has('date_range') === false) {
        data.set('date_range', $('#report-period-date').find('option:selected').text().trim());
    }

    if(Object.keys(customReport).length > 0) {
        data.append('custom_report_id', customReport.id);
    }

    $.ajax({
        url: `/accounting/reports/save-custom-report`,
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
}

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

        $(this).parent().prev().hide();
    }
});