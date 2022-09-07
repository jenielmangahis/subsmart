$('.dropdown-menu.table-settings, #expense-table-filters').on('click', function(e) {
    e.stopPropagation();
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');
});

$('#expenses-table tbody select[name="expense_account[]"]').each(function() {
    $(this).select2({
        ajax: {
            url: '/accounting/get-dropdown-choices',
            dataType: 'json',
            data: function(params) {
                var query = {
                    search: params.term,
                    type: 'public',
                    field: 'expense-account'
                }

                // Query parameters will be ?search=[term]&type=public&field=[type]
                return query;
            }
        },
        templateResult: formatResult,
        templateSelection: optionSelect
    });
});

$('#expense-table-filters select').each(function() {
    if($(this).attr('id') !== 'filter-payee' && $(this).attr('id') !== 'filter-category') {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    } else {
        var field = $(this).attr('id') === 'filter-payee' ? 'payee' : 'expense-account';
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: field,
                        for: 'filter'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $('#expense-table-filters')
        });
    }
});

$("#btn_print_expenses").on("click", function() {
    $("#expenses_table_print").printThis();
});

$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});