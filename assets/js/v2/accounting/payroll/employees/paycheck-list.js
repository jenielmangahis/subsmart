$('.date').datepicker({
    format: 'mm/dd/yyyy',
    orientation: 'bottom',
    autoclose: true
});

$('#table-filters').on('click', function(e) {
    e.stopPropagation();
});

$('#filter-employee').select2({
    ajax: {
        url: '/accounting/get-dropdown-choices',
        dataType: 'json',
        data: function(params) {
            var query = {
                search: params.term,
                type: 'public',
                field: 'paycheck-employee'
            }

            // Query parameters will be ?search=[term]&type=public&field=[type]
            return query;
        }
    },
    templateResult: formatResult,
    templateSelection: optionSelect,
});

$('#filter-date-range').select2({
    minimumResultsForSearch: -1
});

$('#filter-date-range').on('change', function(e) {
    var dates = get_start_and_end_dates($(this).val());

    $('#date-range-start').val(dates.start_date);
    $('#date-range-end').val(dates.end_date);
});

$('#date-range-start, #date-range-end').on('change', function(e) {
    $('#filter-date-range').val('custom').trigger('change');
});

$('#apply-filter').on('click', function(e) {
    e.preventDefault();

    var filterDate = $('#filter-date-range').val();
    var filterEmployee = $('#filter-employee').val();
    var url = `${base_url}accounting/employees/paycheck-list?`;

    url += filterEmployee !== 'all' ? `employee=${filterEmployee}&` : '';
    url += filterDate !== 'last-pay-date' ? `date=${filterDate}&` : '';
    url += filterDate !== 'last-pay-date' ? `from=${$('#date-range-start').val().replaceAll('/', '-')}&to=${$('#date-range-end').val().replaceAll('/', '-')}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});

$('#reset-filter').on('click', function(e) {
    e.preventDefault();

    var url = `${base_url}accounting/employees/paycheck-list`;

    location.href = url;
});

$('#export-to-excel').on('click', function(e) {
    e.preventDefault();

    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/employees/paycheck-list/export" method="post" id="export-form"></form>`);
    }

    $('#export-form').append(`<input type="hidden" name="type" value="excel">`);

    var url = window.location.href;
    var currentUrl = url.replace('#', '');
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

$('#print-save-pdf-modal #save-as-pdf').on('click', function(e) {
    e.preventDefault();

    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/employees/paycheck-list/export" method="post" id="export-form"></form>`);
    }

    $('#export-form').append(`<input type="hidden" name="type" value="pdf">`);

    var url = window.location.href;
    var currentUrl = url.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        $.each(querySplit, function(key, value) {
            var selectedVal = value.split('=');
            $('#export-form').append(`<input type="hidden" name="${selectedVal[0]}" value="${selectedVal[1]}">`);
        });
    }

    $('#export-form').append(`<input type="hidden" name="orientation" value="${$('#print-save-pdf-modal input[name="pdf_orientation"]:checked').val()}">`);

    $('#export-form').submit();
    $('#export-form').remove();
});

$('#print-save-pdf-modal input[name="pdf_orientation"]').on('change', function() {
    var data = new FormData();

    var url = window.location.href;
    var currentUrl = url.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        $.each(querySplit, function(key, value) {
            var selectedVal = value.split('=');
            data.append(selectedVal[0], selectedVal[1]);
            // $('#export-form').append(`<input type="hidden" name="${selectedVal[0]}" value="${selectedVal[1]}">`);
        });
    }

    data.append('orientation', $('#print-save-pdf-modal input[name="pdf_orientation"]:checked').val());

    $.ajax({
        url: '/accounting/employees/paycheck-list/change-orientation',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            $('#print-save-pdf-modal #paychecks-pdf').attr('src', res);
        }
    });
});

$('#print-save-pdf-modal #print-pdf').on('click', function(e) {
    e.preventDefault();

    let pdfWindow = window.open("");
    pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#print-save-pdf-modal iframe#paychecks-pdf').attr('src')}"></iframe>`);
    $(pdfWindow.document).find('body').css('padding', '0');
    $(pdfWindow.document).find('body').css('margin', '0');
    $(pdfWindow.document).find('iframe').css('border', '0');
});

$('#paycheck-table .select-all').on('change', function() {
    $('#paycheck-table .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$('#paycheck-table .select-one').on('change', function() {
    $('#paycheck-table .select-all').prop('checked', $('#paycheck-table .select-one:checked').length === $('#paycheck-table .select-one').length);

    if($('#paycheck-table .select-one:checked').length > 0) {
        $('.print-paychecks-button').attr('id', 'print-paychecks');
        $('.print-paychecks-button').prop('disabled', false);
    } else {
        $('.print-paychecks-button').removeAttr('id');
        $('.print-paychecks-button').prop('disabled', true);
    }
});

$(document).on('click', '#print-paychecks', function(e) {
    e.preventDefault();

    if($('#print-paycheck-form').length < 1) {
        $('body').append(`<form action="/accounting/employees/paycheck-list/print-multiple" method="post" id="print-paycheck-form" target="_blank"></form>`);
    }

    $('#paycheck-table .select-one:checked').each(function() {
        var row = $(this).closest('tr');
        var id = row.find('.select-one').val();

        $('#print-paycheck-form').append(`<input type="hidden" name="paycheck_id[]" value="${id}">`);
    });

    $('#print-paycheck-form').submit();
    $('#print-paycheck-form').remove();
});

$('#paycheck-table [name="check_number[]"]').on('change', function() {
    var checkNum = $(this).val();
    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    var data = new FormData();
    data.set('check_number', checkNum);

    $.ajax({
        url: `/accounting/employees/paycheck-list/update-paycheck-num/${id}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            
        }
    });
});

$('#paycheck-table .print-paycheck').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    if($('#print-paycheck-form').length < 1) {
        $('body').append(`<form action="/accounting/employees/paycheck-list/print" method="post" id="print-paycheck-form" target="_blank"></form>`);
    }

    $('#print-paycheck-form').append(`<input type="hidden" name="paycheck_id" value="${id}">`);

    $('#print-paycheck-form').submit();
    $('#print-paycheck-form').remove();
});

$('#paycheck-table .delete-paycheck').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    $.get(`/accounting/employees/paycheck-list/delete/${id}`, function(res) {
        var result = JSON.parse(res);
        Swal.fire({
            title: result.success ? 'Delete Successful!' : 'Failed!',
            text: result.success ? 'Paycheck has been successfully deleted.' : 'Something is wrong in the process.',
            icon: result.success ? 'success' : 'error',
            showCancelButton: false,
            confirmButtonText: 'Okay'
        }).then((r) => {
            if(r.value) {
                if(result.success) {
                    location.reload();
                }
            }
        });
    });
});

$('#paycheck-table .void-paycheck').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();

    $.get(`/accounting/employees/paycheck-list/void/${id}`, function(res) {
        var result = JSON.parse(res);
        Swal.fire({
            title: result.success ? 'Void Successful!' : 'Failed!',
            text: result.success ? 'Paycheck has been successfully voided.' : 'Something is wrong in the process.',
            icon: result.success ? 'success' : 'error',
            showCancelButton: false,
            confirmButtonText: 'Okay'
        }).then((r) => {
            if(r.value) {
                if(result.success) {
                    location.reload();
                }
            }
        });
    });
});

$('#paycheck-table .edit-paycheck').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.find('.select-one').val();
});

function get_start_and_end_dates(val)
{
    switch(val) {
        case 'custom' :
            startDate = $(`#date-range-start`).val();
            endDate = $(`#date-range-end`).val();
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
        case 'fourth-quarter' :
            var date = new Date();

            startDate = '10/01/' + date.getFullYear();
            endDate = '12/31/'+ date.getFullYear();
        break;
    }

    return {
        start_date : startDate,
        end_date : endDate
    };
}