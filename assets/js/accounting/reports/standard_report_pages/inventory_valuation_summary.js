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

$('#previous-period, #previous-year').on('change', function() {
    if($(this).prop('checked')) {
        $(this).parent().next().find('input').prop('disabled', false);
        $(this).parent().next().find('label').removeClass('text-muted');
    } else {
        $(this).parent().next().find('input').prop('checked', false);
        $(this).parent().next().find('input').prop('disabled', true);
        $(this).parent().next().find('label').addClass('text-muted');
    }
});

$('input[name="show_rows"]').on('change', function() {
    var selectedRow = $('input[name="show_rows"]:checked').attr('id').replace('row-', '');

    switch(selectedRow) {
        case 'active' :
            var row = 'Active rows';
        break;
        case 'all' :
            var row = 'All rows';
        break;
        case 'non-zero' :
            var row = 'Non-zero rows';
        break;
    }

    $(this).parent().parent().prev().html(`${row}&nbsp;&nbsp;<i class="fa fa-caret-down"></i>`);
});