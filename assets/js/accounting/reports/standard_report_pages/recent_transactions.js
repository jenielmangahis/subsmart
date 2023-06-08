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

    if($(this).attr('id') === 'filter-name') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-name'
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

    if($(this).attr('id') === 'filter-payment-method') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-payment-method'
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

$('input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text().replace('#', 'No.');

    var index = $(`#reports-table thead td[data-name="${dataName}"]`).index();

    $(`#reports-table tr:not([data-bs-toggle="collapse"], .group-total)`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    var newIndex = $('#reports-table thead tr td[data-name=""]').length > 0 ? 28 : 27;
    $(`#reports-table tr[data-bs-toggle="collapse"], #reports-table tr.group-total`).each(function() {
        if(index > newIndex) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - newIndex]).show();
            } else {
                $($(this).find('td')[index - newIndex]).hide();
            }
        } else {
            var colspan = $(this).children('td:first-child').attr('colspan');
            if(chk.prop('checked')) {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) + 1);
                $(this).children('td:first-child').show();
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
        if(index > newIndex) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - newIndex]).show();
            } else {
                $($(this).find('td')[index - newIndex]).hide();
            }
        } else {
            var colspan = $(this).children('td:first-child').attr('colspan');
            if(chk.prop('checked')) {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) + 1);
                $(this).children('td:first-child').show();
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
        if(index > newIndex) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - newIndex]).show();
            } else {
                $($(this).find('td')[index - newIndex]).hide();
            }
        } else {
            var colspan = $(this).children('td:first-child').attr('colspan');
            if(chk.prop('checked')) {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) + 1);
                $(this).children('td:first-child').show();
            } else {
                $(this).children('td:first-child').attr('colspan', parseInt(colspan) - 1);
            }
        }
    });

    var totalColumns = [
        'Amount',
        'Debit',
        'Credit',
        'Tax Amount',
        'Taxable Amount'
    ];

    if($($('#reports-table thead tr td:visible')[0]).data().name === '') {
        if($($('#reports-table thead tr td:visible')[1]).data().name === 'Open Balance' || $($('#reports-table thead tr td:visible')[1]).data().name === 'Online Banking' ||
        totalColumns.includes($($('#reports-table thead tr td:visible')[0]).data().name) === false && $($('#reports-table thead tr td:visible')[1]).data().name !== 'Open Balance' && $($('#reports-table thead tr td:visible')[1]).data().name !== 'Online Banking') {
            $('#reports-table thead tr td[data-name=""]').remove();
            $('#reports-table tbody tr:not([data-bs-toggle="collapse"], .group-total).collapse td:first-child').remove();
            $(`#print_report_modal table thead td[data-name=""]`).remove();
            $('#print_report_modal table tbody tr:not(.group-header, .group-total) td:first-child').remove();
            $(`#print_preview_report_modal #report_table_print thead td[data-name=""]`).remove();
            $(`#print_preview_report_modal #report_table_print tr:not(.group-header, .group-total) td:first-child`).remove();

            var colspan = 0;
            $('#reports-table thead tr td:visible').each(function() {
                colspan = $(this).index() < 28 && $(this).data().name !== '' ? colspan + 1 : colspan;
            });
            $('#reports-table tbody tr[data-bs-toggle="collapse"] td:first-child, #reports-table tbody tr.group-total td:first-child').attr('colspan', colspan);
        }
    }

    if(totalColumns.includes($($('#reports-table thead tr td:visible')[0]).data().name) && $('#reports-table thead tr td[data-name=""]').length < 1) {
        $('#reports-table thead tr').prepend(`<td data-name=""></td>`);
        $('#reports-table tbody tr:not([data-bs-toggle="collapse"], .group-total).collapse').prepend(`<td></td>`);

        $('#print_report_modal table thead tr').prepend(`<td data-name=""></td>`);
        $('#print_report_modal table tbody tr:not(.group-header, .group-total).collapse').prepend(`<td></td>`);
        $('#print_preview_report_modal #report_table_print thead tr').prepend(`<td data-name=""></td>`);
        $('#print_preview_report_modal #report_table_print tbody tr:not(.group-header, .group-total)').prepend(`<td></td>`);

        $('#reports-table tbody tr[data-bs-toggle="collapse"] td:first-child, #reports-table tbody tr.group-total td:first-child').attr('colspan', 0);
    }
});