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

$('#filter-report-period-from, #filter-report-period-to').on('change', function() {
    $('#filter-report-period').val('custom').trigger('change');
});

$('#run-report').on('click', function(e) {
    e.preventDefault();

    var filterDate = $('#filter-report-period').val();
    var groupBy = $('#group-by').val();
    var sortBy = $('#sort-by').val();
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'all-dates' ? `date=${filterDate}&` : '';
    url += filterDate !== 'all-dates' ? `from=${$('#filter-report-period-from').val().replaceAll('/', '-')}&to=${$('#filter-report-period-to').val().replaceAll('/', '-')}&` : '';
    url += groupBy !== 'vendor' ? `group-by=${groupBy}&` : '';
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
            'group-by',
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

$('#filter-create-date, #filter-last-modified-date, #filter-due-date').on('change', function() {
    $(this).parent().prev().find('input[type="checkbox"]').prop('checked', true);

    if($(this).val() === 'all-dates') {
        $(`#allow-${$(this).attr('id')}`).prop('checked', false);
        $(this).parent().next().next().remove();
        $(this).parent().next().remove();
    } else {
        $(`#allow-${$(this).attr('id')}`).prop('checked', true);
        var dates = get_start_and_end_dates($(this).val(), $(this));

        if($(`#${$(this).attr('id')}-from`).length > 0) {
            $(`#${$(this).attr('id')}-from`).val(dates.start_date);
            $(`#${$(this).attr('id')}-to`).val(dates.end_date);
        } else {
            $(`<div class="col-12 col-md-6">
                <label for="${$(this).attr('id')}-from">From</label>
                <div class="nsm-field-group calendar">
                    <input type="text" class="nsm-field form-control date" value="${dates.start_date}" id="${$(this).attr('id')}-from">
                </div>
            </div>
            <div class="col-12 col-md-6">
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

$('#filter-account, #filter-vendor, #filter-check-printed').on('change', function() {
    if($(this).val() !== 'all') {
        $(`#allow-${$(this).attr('id')}`).prop('checked', true);
    } else {
        $(`#allow-${$(this).attr('id')}`).prop('checked', false);
    }
});

$('#filter-memo, #filter-num, #filter-amount, #ship-via').on('change', function() {
    if($(this).val().trim() !== '') {
        $(`#allow-${$(this).attr('id')}`).prop('checked', true);
    } else {
        $(`#allow-${$(this).attr('id')}`).prop('checked', false);
    }
});

$('#run-report-button').on('click', function() {
    $('#filter-report-period-date').val($('#report-period-date').val()).trigger('change');
    if($('#report-period-date').val() !== 'all-dates') {
        $('#filter-report-period-date-from').val($('#report-period-date-from').val());
        $('#filter-report-period-date-to').val($('#report-period-date-to').val());
    }

    var filterDate = $('#report-period-date').val();
    var sortBy = $('#sort-by').val();
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'all-dates' ? `date=${filterDate}&` : '';
    url += filterDate !== 'all-dates' ? `from=${$('#report-period-date-from').val().replaceAll('/', '-')}&to=${$('#report-period-date-to').val().replaceAll('/', '-')}&` : '';
    url += sortBy !== 'default' ? `column=${sortBy}&` : '';
    url += sortIn !== 'asc' ? `order=${sortIn}&` : '';

    url += $('#divide-by-100').prop('checked') ? `divide-by-100=1&` : '';
    url += $('#without-cents').prop('checked') ? `without-cents=1&` : '';
    url += $('#negative-numbers').val() !== '-100' ? `negative-numbers=${$('#negative-numbers').val()}&` : '';
    url += $('#show-in-red').prop('checked') ? `show-in-red=1&` : '';
    url += $('#custom-group-by').val() !== 'vendor' ? `group-by=${$('#custom-group-by').val()}&` : '';

    var columns = [];
    if($('input[name="select_columns"]:checked').length < $('input[name="select_columns"]').length) {
        $('input[name="select_columns"]:checked').each(function() {
            columns.push($(this).next().text().trim().replace('#', 'No.'));
        });

        url += `columns=${columns}&`;
    }

    url += $('#allow-filter-account').prop('checked') && $('#filter-account').val() !== 'all' ? `account=${$('#filter-account').val()}&` : '';
    url += $('#allow-filter-vendor').prop('checked') && $('#filter-vendor').val() !== 'specified' ? `vendor=${$('#filter-vendor').val()}&` : '';
    url += $('#allow-filter-create-date').prop('checked') && $('#filter-create-date').val() !== 'all-dates' ? `create-date=${$('#filter-create-date').val()}&` : '';
    url += $('#allow-filter-create-date').prop('checked') && $('#filter-create-date').val() !== 'all-dates' ? `create-date-from=${$('#filter-create-date-from').val().replaceAll('/', '-')}&` : '';
    url += $('#allow-filter-create-date').prop('checked') && $('#filter-create-date').val() !== 'all-dates' ? `create-date-to=${$('#filter-create-date-to').val().replaceAll('/', '-')}&` : '';
    url += $('#allow-filter-last-modified-date').prop('checked') && $('#filter-last-modified-date').val() !== 'all-dates' ? `last-modified-date=${$('#filter-last-modified-date').val()}&` : '';
    url += $('#allow-filter-last-modified-date').prop('checked') && $('#filter-last-modified-date').val() !== 'all-dates' ? `last-modified-date-from=${$('#filter-last-modified-date-from').val().replaceAll('/', '-')}&` : '';
    url += $('#allow-filter-last-modified-date').prop('checked') && $('#filter-last-modified-date').val() !== 'all-dates' ? `last-modified-date-to=${$('#filter-last-modified-date-to').val().replaceAll('/', '-')}&` : '';
    url += $('#allow-filter-cleared').prop('checked') && $('#filter-cleared').val() !== 'all' ? `cleared=${$('#filter-cleared').val()}&` : '';
    url += $('#allow-filter-memo').prop('checked') && $('#filter-memo').val().trim() !== '' ? `memo=${$('#filter-memo').val().trim()}&` : '';
    url += $('#allow-filter-num').prop('checked') && $('#filter-num').val().trim() !== '' ? `num=${$('#filter-num').val().trim()}&` : '';
    url += $('#allow-filter-amount').prop('checked') && $('#filter-amount').val().trim() !== '' ? `amount=${$('#filter-amount').val().trim()}&` : '';
    url += $('#allow-filter-ship-via').prop('checked') && $('#filter-ship-via').val().trim() !== '' ? `ship-via=${$('#filter-ship-via').val().trim()}&` : '';

    url += $('#show-logo').prop('checked') ? `show-logo=yes&` : '';
    url += $('#show-company-name').prop('checked') ? `` : 'show-company-name=no&';
    url += $('#show-company-name').prop('checked') && $('#company-name').val() !== companyName ? `company-name=${$('#company-name').val()}&` : '';
    url += $('#show-report-title').prop('checked') ? `` : 'show-report-title=no&';
    url += $('#show-report-title').prop('checked') && $('#report-title').val() !== 'Open Purchase Order List' ? `report-title=${$('#report-title').val()}&` : '';
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
                        <td colspan="20">
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

    $('#export-form').append(`<input type="hidden" name="column" value="${$('#sort-by').val()}">`);
    $('#export-form').append(`<input type="hidden" name="order" value="${$('input[name="sort_order"]:checked').val()}">`);

    $('#export-form').submit();
    $('#export-form').remove();
});

$('#export-to-pdf').on('click', function(e) {
    e.preventDefault();

    if($(this).text().trim().replace('Show ', '') === 'More') {
        $(this).html('<i class="fa fa-caret-up text-info"></i> Show Less');

        $(this).parent().prev().show();
    } else {
        $(this).html('<i class="fa fa-caret-down text-info"></i> Show More');

        $(this).parent().prev().hide();
    }
});