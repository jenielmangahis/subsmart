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
        $(this).html('<i class="fa fa-caret-down text-info"></i> Show More');

        $(this).parent().prev().hide();
    }
});

$('input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#reports-table thead td[data-name="${dataName}"]`).index();
    $(`#reports-table tr:not([data-bs-toggle="collapse"], .group-total)`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#reports-table tr[data-bs-toggle="collapse"], #reports-table tr.group-total`).each(function() {
        if(index > 9) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 9]).show();
            } else {
                $($(this).find('td')[index - 9]).hide();
            }
        } else {
            var colspan = $(this).children('td:first-child').attr('colspan');
            if(chk.prop('checked')) {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) + 1);
            } else {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) - 1);
            }
        }
    });

    $(`#print_report_modal table tr:not(.group-header, .group-total)`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_report_modal table tr.group-header, #print_report_modal table tr.group-total`).each(function() {
        if(index > 9) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 9]).show();
            } else {
                $($(this).find('td')[index - 9]).hide();
            }
        } else {
            var colspan = $(this).children('td:first-child').attr('colspan');
            if(chk.prop('checked')) {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) + 1);
            } else {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) - 1);
            }
        }
    });

    $(`#print_preview_report_modal #report_table_print tr:not(.group-header, .group-total)`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_preview_report_modal #report_table_print tr.group-header, #print_preview_report_modal #report_table_print tr.group-total`).each(function() {
        if(index > 9) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 9]).show();
            } else {
                $($(this).find('td')[index - 9]).hide();
            }
        } else {
            var colspan = $(this).children('td:first-child').attr('colspan');
            if(chk.prop('checked')) {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) + 1);
            } else {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) - 1);
            }
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

$('#sort-by, [name="sort_order"]').on('change', function() {
    var filterDate = $('#filter-activity-date').val();
    var sortBy = $('#sort-by').val();
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'this-month-to-date' ? `date=${filterDate}&` : '';
    url += filterDate !== 'this-month-to-date' && filterDate !== 'all-dates' ? `from=${$('#filter-from').val().replaceAll('/', '-')}&to=${$('#filter-to').val().replaceAll('/', '-')}` : '';
    url += sortBy !== 'default' ? `column=${sortBy}` : '';
    url += sortIn !== 'asc' ? `order=${sortIn}` : '';

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

$("#btn_print_report").on("click", function() {
    $("#report_table_print").printThis();
});