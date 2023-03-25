const currUrl = window.location.href;
const urlSplit = currUrl.split('/');
const reportId = urlSplit[urlSplit.length - 1].includes('?') ? urlSplit[urlSplit.length - 1].split('?')[0].replace('#', '') : urlSplit[urlSplit.length - 1].replace('#', '');

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

$('#filter-activity-date').on('change', function() {
    if($(this).val() !== 'all-dates') {
        var startDate = '';
        var endDate = '';

        switch($(this).val()) {
            case 'custom' :
                if($('#filter-from').length > 0) {
                    startDate = $('#filter-from').val();
                    endDate = $('#filter-to').val();
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
    
                var from_date = new Date(date.setDate(from - 7));
                var to_date = new Date(date.setDate(date.getDate() + 6));
    
                startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'next-4-weeks' :

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

                from_date.setMonth(from_date.getMonth() - 3);
                to_date.setMonth(to_date.getMonth() - 3);

                if(to_date.getDate() === 1) {
                    to_date.setDate(to_date.getDate() - 1);
                }

                startDate = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
                endDate = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'next-year' :
                var date = new Date();
                date.setFullYear(date.getFullYear() + 1);
    
                var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
            break;
        }

        if($('#filter-from').length > 0) {
            $('#filter-from').val(startDate);
            $('#filter-to').val(endDate);
        } else {
            $(`<div class="row grid-mb">
                <div class="col-12 col-md-6">
                    <label for="filter-from">From</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" class="nsm-field form-control date" value="${startDate}" id="filter-from">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label for="filter-to">To</label>
                    <div class="nsm-field-group calendar">
                        <input type="text" class="nsm-field form-control date" value="${endDate}" id="filter-to">
                    </div>
                </div>
            </div>`).insertAfter($(this).closest('.row'));

            $('#filter-from, #filter-to').datepicker({
                format: 'mm/dd/yyyy',
                orientation: 'bottom',
                autoclose: true
            });
        }
    } else {
        $('#filter-from').closest('.row').remove();
    }
});

$('#filter-from, #filter-to').on('change', function() {
    $('#filter-activity-date').val('custom').trigger('change');
});

$('#run-report').on('click', function(e) {
    e.preventDefault();

    var filterDate = $('#filter-activity-date').val();
    var sortBy = $('#sort-by').val();
    var sortIn = $('input[name="sort_order"]:checked').val();

    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    url += filterDate !== 'all-dates' ? `date=${filterDate}&` : '';
    url += filterDate !== 'all-dates' ? `from=${$('#filter-from').val().replaceAll('/', '-')}&to=${$('#filter-to').val().replaceAll('/', '-')}` : '';
    url += sortBy !== 'default' ? `column=${sortBy}` : '';
    url += sortIn !== 'asc' ? `order=${sortIn}` : '';

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
    url += filterDate !== 'all-dates' ? `date=${filterDate}&` : '';
    url += filterDate !== 'all-dates' ? `from=${$('#filter-from').val().replaceAll('/', '-')}&to=${$('#filter-to').val().replaceAll('/', '-')}` : '';
    url += sortBy !== 'default' ? `column=${sortBy}` : '';
    url += sortIn !== 'asc' ? `order=${sortIn}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
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