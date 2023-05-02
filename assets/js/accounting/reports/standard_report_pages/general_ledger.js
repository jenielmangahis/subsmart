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

    // if($(this).attr('id') === 'filter-account') {
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
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#reports-table thead td[data-name="${dataName}"]`).index();
    $(`#reports-table tr:not([data-bs-toggle="collapse"], .group-total, .starting-balance-row)`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#reports-table tr[data-bs-toggle="collapse"], #reports-table tr.group-total`).each(function() {
        if(index > 22) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 22]).show();
            } else {
                $($(this).find('td')[index - 22]).hide();
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

    $('#reports-table tr.starting-balance-row').each(function() {
        if(index > 26) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 26]).show();
            } else {
                $($(this).find('td')[index - 26]).hide();
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

    $(`#print_report_modal table tr:not(.group-header, .group-total, .starting-balance-row)`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_report_modal table tr.group-header, #print_report_modal table tr.group-total`).each(function() {
        if(index > 22) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 22]).show();
            } else {
                $($(this).find('td')[index - 22]).hide();
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

    $(`#print_report_modal table tr.starting-balance-row`).each(function() {
        if(index > 26) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 26]).show();
            } else {
                $($(this).find('td')[index - 26]).hide();
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

    $(`#print_preview_report_modal #report_table_print tr:not(.group-header, .group-total, .starting-balance-row)`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_preview_report_modal #report_table_print tr.group-header, #print_preview_report_modal #report_table_print tr.group-total`).each(function() {
        if(index > 22) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 22]).show();
            } else {
                $($(this).find('td')[index - 22]).hide();
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

    $(`#print_preview_report_modal #report_table_print tr.starting-balance-row`).each(function() {
        if(index > 26) {
            if(chk.prop('checked')) {
                $($(this).find('td')[index - 26]).show();
            } else {
                $($(this).find('td')[index - 26]).hide();
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

$("#btn_print_report").on("click", function() {
    $("#report_table_print").printThis();
});