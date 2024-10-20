const currUrl = window.location.href;
const urlSplit = currUrl.includes('?') ? currUrl.split('?')[0].split('/') : currUrl.split('/');
const reportId = urlSplit[urlSplit.length - 1].replace('#', '');

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

$("#btn_print_report").on("click", function() {
    $("#report_table_print").printThis();
});

$('input[name="select_columns"]').on('change', function(e) {
    if($('input[name="select_columns"]:checked').length === $('input[name="select_columns"]').length) {
        $('#select-all-columns').html('Unselect all');
        $('#select-all-columns').attr('id', 'unselect-all-columns');
    } else {
        $('#unselect-all-columns').html('Select All');
        $('#unselect-all-columns').attr('id', 'select-all-columns');
    }
});

$(document).on('click', '#select-all-columns', function(e) {
    e.preventDefault();

    $('input[name="select_columns"]').prop('checked', true);

    $(this).html('Unselect all');
    $(this).attr('id', 'unselect-all-columns');
});

$(document).on('click', '#unselect-all-columns', function(e) {
    e.preventDefault();

    $('input[name="select_columns"]').prop('checked', false);

    $(this).html('Select all');
    $(this).attr('id', 'select-all-columns');
});

$('#run-report-button').on('click', function() {
    var url = `${base_url}accounting/reports/view-report/${reportId}?`;
    var currentUrl = currUrl.replace('#', '');
    var urlSplit = currentUrl.split('?');
    var query = urlSplit[1];

    if(query !== undefined) {
        var querySplit = query.split('&');

        var notIncluded = [
            'status',
            'columns'
        ];
        $.each(querySplit, function(key, value) {
            var selectedVal = value.split('=');
            if(notIncluded.includes(selectedVal[0]) === false) {
                url += value+'&';
            }
        });
    }

    url += $('#filter-employee').val() !== 'all' ? `status=${$('#filter-employee').val()}&` : '';
    var columns = [];
    $('input[name="select_columns"]:checked').each(function() {
        columns.push($(this).next().text().trim());
    });

    if(columns.length < $('input[name="select_columns"]').length) {
        url += `columns=${columns}&`;
    }

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