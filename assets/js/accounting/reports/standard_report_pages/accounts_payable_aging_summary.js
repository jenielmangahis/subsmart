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

$('#report-period-date').on('change', function() {
    if($(this).val() === 'all-dates') {
        $(this).parent().next().next().remove();
        $(this).parent().next().remove();
    } else {
        var dates = get_start_and_end_dates($(this).val(), $(this));

        if($(`#report-period-date-to`).length > 0) {
            $(`#report-period-date-to`).val(dates.end_date);
        } else {
            $(`<div class="col-12 col-md-auto d-flex justify-content-center align-items-end">
                <span>as of</span>
            </div>
            <div class="col-12 col-md-4">
                <div class="nsm-field-group calendar">
                    <input type="text" class="nsm-field form-control date" value="${dates.end_date}" id="report-period-date-to">
                </div>
            </div>`).insertAfter($(this).parent());

            $(`#report-period-date-to`).datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        }
    }
});

$('input[name="custom_show_rows"], input[name="custom_show_columns"]').on('change', function() {
    var rows = $('input[name="custom_show_rows"]:checked');
    var columns = $('input[name="custom_show_columns"]:checked');
    var rowsText = rows.next().text();
    var columnsText = columns.next().text();

    var buttonText = rowsText+' Rows/'+columnsText+' Columns';
    $(this).closest('.dropdown-menu').prev().html(buttonText+' <i class="bx bx-fw bx-caret-down"></i>')
});

$('#filter-vendor').on('change', function() {
    if($(this).val() !== 'specified') {
        $(`#allow-filter-vendor`).prop('checked', true);
    } else {
        $(`#allow-filter-vendor`).prop('checked', false);
    }
});

$('#run-report-button').on('click', function() {
    $('#filter-report-period-date').val($('#report-period-date').val()).trigger('change');
    if($('#report-period-date').val() !== 'today') {
        $('#filter-report-period-date-from').val($('#report-period-date-from').val());
        $('#filter-report-period-date-to').val($('#report-period-date-to').val());
    }


    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'today' ? `date=${filterDate}&` : '';
    url += filterDate !== 'today' && filterDate !== 'all-dates' ? `to=${$('#report-period-date-to').val().replaceAll('/', '-')}&` : '';
    url += agingMethod !== 'report-date' ? `aging-method=${agingMethod}` : '';
    url += daysPerAgingPeriod !== '30' ? `days-per-aging-period=${daysPerAgingPeriod}` : '';
    url += numberOfPeriods !== '4' ? `number-of-periods=${numberOfPeriods}` : '';

    var filterDate = $('#report-period-date').val();
    var showRows = $('input[name="custom_show_rows"]:checked').val();
    var showCols = $('input[name="custom_show_columns"]:checked').val();
    var agingMethod = $('input[name="custom_aging_method"]:checked').val();
    var daysPerAgingPeriod = $('#custom-days-per-aging-period').val();
    var numberOfPeriods = $('#custom-number-of-periods').val();

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

    url += $('#divide-by-100').prop('checked') ? `divide-by-100=1&` : '';
    url += $('#without-cents').prop('checked') ? `without-cents=1&` : '';
    url += $('#negative-numbers').val() !== '-100' ? `negative-numbers=${$('#negative-numbers').val()}&` : '';
    url += $('#show-in-red').prop('checked') ? `show-in-red=1&` : '';

    url += $('#allow-filter-vendor').prop('checked') && $('#filter-vendor').val() !== 'specified' ? `vendor=${$('#filter-vendor').val()}&` : '';

    url += $('#show-logo').prop('checked') ? `show-logo=yes&` : '';
    url += $('#show-company-name').prop('checked') ? `` : 'show-company-name=no&';
    url += $('#show-company-name').prop('checked') && $('#company-name').val() !== companyName ? `company-name=${$('#company-name').val()}&` : '';
    url += $('#show-report-title').prop('checked') ? `` : 'show-report-title=no&';
    url += $('#show-report-title').prop('checked') && $('#report-title').val() !== 'Accounts payable aging summary' ? `report-title=${$('#report-title').val()}&` : '';
    url += $('#show-report-period').prop('checked') === false ? `show-report-period=0&` : '';
    url += $('#show-date-prepared').prop('checked') ? `` : 'show-date-prepared=no&';
    url += $('#show-time-prepared').prop('checked') ? `` : 'show-time-prepared=no&';
    url += $('#header-alignment').val() !== 'center' ? `header-alignment=${$('#header-alignment').val()}&` : '';
    url += $('#footer-alignment').val() !== 'center' ? `footer-alignment=${$('#footer-alignment').val()}&` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});

$('#add-new-custom-report-group').on('click', function(e) {
    e.preventDefault();

    $(this).parent().next().removeClass('d-none');
    $(this).addClass('d-none');
});

$('#cancel-new-custom-report-group').on('click', function(e) {
    e.preventDefault();

    $('#custom-group-name').val('');
    $('#add-new-custom-report-group').removeClass('d-none');
    $('#new-custom-report-group').parent().addClass('d-none');
});

$('#new-custom-report-group').on('submit', function(e) {
    e.preventDefault();

    var form = $(this);
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
            $('#add-new-custom-report-group').removeClass('d-none');
            form.parent().addClass('d-none');
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

$('[name="sort_order"]').on('change', function() {
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += sortIn !== 'default' ? `order=${sortIn}&` : '';

    var currentUrl = currUrl.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        var notIncluded = [
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

                if($('#print_report_modal table tfoot tr:first-child p').length > 0) {
                    $('#print_report_modal table tfoot tr:first-child').remove();
                }

                if($('#print_preview_report_modal #report_table_print tfoot tr:first-child p').length > 0) {
                    $('#print_preview_report_modal #report_table_print tfoot tr:first-child').remove();
                }

                $('#report-note-cont').html('');
            } else {
                $('#add-notes, #edit-notes').text('Edit notes');
                $('#add-notes, #edit-notes').attr('id', 'edit-notes');

                if($('#print_preview_report_modal #report_table_print tfoot tr:first-child p').length > 0) {
                    $('#print_report_modal table tfoot tr:first-child td span, #print_preview_report_modal #report_table_print tfoot tr:first-child td span').html(`${$('#report-note').val().trim().replaceAll("\n", "<br />")}`);
                } else {
                    $('#print_report_modal table tfoot, #print_preview_report_modal #report_table_print tfoot').prepend(`<tr>
                        <td colspan="27">
                            <p class="m-0"><b>Note</b></p>
                            <span>${$('#report-note').val().trim().replaceAll("\n", "<br />")}</span>
                        </td>
                    </tr>`);
                }

                if($('#report-note-cont p, #report-note-cont span').length > 0) {
                    $('#report-note-cont span').html($('#report-note').val().trim().replaceAll('\n', '<br>'));
                } else {
                    $('#report-note-cont').append(`<p class="m-0"><b>Note</b></p>`);
                    $('#report-note-cont').append(`<span>${$('#report-note').val().trim().replaceAll('\n', '<br>')}</span>`);
                }
            }

            $('#report-note-form').addClass('d-none');
            $('#report-note-cont').removeClass('d-none');
        }
    });
});

$("#btn_send_report").on("click", function() {
    $('#send-email-form').submit();
});

$('#send-email-form').validate({
    rules: {
        email_to: {
            required: true,
            email: true
        },
        email_subject: 'required',
        email_body: 'required',
        email_file_name: 'required'
    }
});

$('#send-email-form').on('submit', function(e) {
    e.preventDefault();
    var data = new FormData(this);

    if($(this).find('.nsm-field.form-control.error').length < 1) {
        var currentUrl = currUrl.replace('#', '');
        var urlSplit = currentUrl.split('?');
        var query = urlSplit[1];

        var fields = $('#reports-table thead tr td:visible:not(.table-icon)');
        fields.each(function() {
            data.append('fields[]', $(this).attr('data-name'));
        });

        if(query !== undefined) {
            var querySplit = query.split('&');

            $.each(querySplit, function(key, value) {
                var selectedVal = value.split('=');

                data.append(selectedVal[0], selectedVal[1]);
            });
        }

        $.ajax({
            url: `/accounting/reports/${reportId}/email`,
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                Swal.fire({
                    text: res.message,
                    icon: res.success ? 'success' : 'error',
                    showCloseButton: true,
                    showConfirmButton: false,
                    timer: 2000
                });

                $('#email_report_modal').modal('hide');
            }
        });
    }
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

    $('#export-form').submit();
    $('#export-form').remove();
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
            if($(`#${el.attr('id')}-to`).length > 0) {
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