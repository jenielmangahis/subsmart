$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});

$('.dropdown-menu.table-settings, .dropdown-menu.table-filters').on('click', function(e) {
    e.stopPropagation();
});

$("#accounts-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#registers-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('select').each(function() {
    var dropdownType = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
    dropdownType = dropdownType.replace('filter-', '');

    if(dropdownType === 'account') {
        dropdownType = 'register-account';
    }

    if($(this).find('option').length > 1) {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    } else {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: dropdownType
                    }
    
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });
    }
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#registers-table thead td[data-name="${dataName}"]`).index();
    $(`#registers-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_registers_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_registers_modal #registers_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$('#account').on('change', function() {
    location.href = `/accounting/chart-of-accounts/view-register/${$(this).val()}`
});

$('#reset-button').on('click', function() {
    location.href = `${base_url}accounting/chart-of-accounts/view-register/${$('#account').val()}`;
});

$('#apply-button').on('click', function() {
    var url = `${base_url}accounting/chart-of-accounts/view-register/${$('#account').val()}?`;

    url += $('#filter-find').val() !== '' ? `search=${$('#filter-find').val()}&` : '';
    url += $('#filter-reconcile-status').val() !== 'all' ? `reconcile-status=${$('#filter-reconcile-status').val()}&` : '';
    url += $('#filter-transaction-type').val() !== 'all' ? `transaction-type=${$('#filter-transaction-type').val()}&` : '';
    url += $('#filter-payee').val() !== 'all' ? `payee=${$('#filter-payee').val()}&` : '';
    url += $('#filter-date').val() !== 'all' ? `date=${$('#filter-date').val()}&` : '';
    url += $('#filter-from').val() !== '' ? `from=${$('#filter-from').val()}&` : '';
    url += $('#filter-to').val() !== '' ? `to=${$('#filter-to').val()}&` : '';
    url += $('#chk_show_in_one_line').prop('checked') === false ? `single-line=0&` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }
    location.href = url;
});

$('#filter-date').on('change', function() {
    switch($(this).val()) {
        case 'all' :
            $('#filter-from, #filter-to').val('');
        break;
        case 'today' :
            var today = new Date();
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            today = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            $('#filter-from, #filter-to').val(today);
        break;
        case 'yesterday' :
            var yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);
            var yesterdayDate = String(yesterday.getDate()).padStart(2, '0');
            var yesterdayMonth = String(yesterday.getMonth() + 1).padStart(2, '0');
            yesterday = yesterdayMonth + '/' + yesterdayDate + '/' + yesterday.getFullYear();

            $('#filter-from, #filter-to').val(yesterday);
        break;
        case 'this-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();
            var to = from + 6;

            var from_date = new Date(date.setDate(from));
            var to_date = new Date(date.setDate(to));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'this-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'this-quarter' :
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);
                
            switch(currQuarter) {
                case 1 :
                    var from_date = '01/01/' + date.getFullYear();
                    var to_date = '03/31/'+ date.getFullYear();
                break;
                case 2 :
                    var from_date = '04/01/' + date.getFullYear();
                    var to_date = '06/30/'+ date.getFullYear();
                break;
                case 3 :
                    var from_date = '07/01/' + date.getFullYear();
                    var to_date = '09/30/'+ date.getFullYear();
                break;
                case 4 :
                    var from_date = '10/01/' + date.getFullYear();
                    var to_date = '12/31/'+ date.getFullYear();
                break;
            }

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'this-year' :
            var date = new Date();
            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'last-week' :
            var date = new Date();
            var from = date.getDate() - date.getDay();

            var from_date = new Date(date.setDate(from - 7));
            var to_date = new Date(date.setDate(date.getDate() + 6));

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'last-month' :
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            from_date = String(date.getMonth()).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
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

            from_date = String(from_date.getMonth() + 1).padStart(2, '0') + '/' + String(from_date.getDate()).padStart(2, '0') + '/' + from_date.getFullYear();
            to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
        case 'last-year' :
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
            var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();

            $('#filter-from').val(from_date);
            $('#filter-to').val(to_date);
        break;
    }
});

$('#btn_print_registers').on('click', function() {
    $("#registers_table_print").printThis();
});

$('.export-items').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append(`<form action="/accounting/chart-of-accounts/view-register/${$('#account').val()}/export-table" method="post" id="export-form"></form>`);
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('chk_', '')}">`);
    });

    var url = window.location.href;
    var filtersString = url.replace(`${base_url}accounting/chart-of-accounts/view-register/${$('#account').val()}`, '');
    if(filtersString.charAt(0) === '?') {
        filtersString = filtersString.slice(1);
    }

    $('#export-form').append(`<input type="hidden" name="search" value="${$('#filter-find').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="reconcile_status" value="${$('#filter-reconcile-status').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="type" value="${$('#filter-transaction-type').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="payee" value="${$('#filter-payee').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="from_date" value="${$('#filter-from').attr('data-applied')}">`);
    $('#export-form').append(`<input type="hidden" name="to_date" value="${$('#filter-to').attr('data-applied')}">`);

    $('#export-form').append(`<input type="hidden" name="column" value="date">`);
    $('#export-form').append(`<input type="hidden" name="order" value="desc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$('#registers-table tbody tr').on('click', function() {
    if($('#chk_show_in_one_line').prop('checked')) {

    } else {
        if($(this).find('input').length < 1 && !$(this).hasClass('action-row') && $(this).find('.nsm-empty').length < 1) {
            if($('#registers-table tbody tr.editting').length > 0) {
                $('#registers-table tbody tr.editting').next().find('#cancel-edit').trigger('click');
            }
            $(this).addClass('editting');
            // if($(this).hasClass('odd')) {
            //     $(this).next().addClass('editting');
            // } else {
            //     $(this).prev().addClass('editting');
            // }
        }
    }
});