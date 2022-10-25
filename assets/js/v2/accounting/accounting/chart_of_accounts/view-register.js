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