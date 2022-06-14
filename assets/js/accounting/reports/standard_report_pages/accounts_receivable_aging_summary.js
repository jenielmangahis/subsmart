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

$('input[name="show_rows"], input[name="show_cols"]').on('change', function() {
    var selectedRow = $('input[name="show_rows"]:checked').attr('id').replace('row-', '');
    var selectedCol = $('input[name="show_cols"]:checked').attr('id').replace('col-', '');

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

    switch(selectedCol) {
        case 'active' :
            var col = 'active columns';
        break;
        case 'all' :
            var col = 'all columns';
        break;
        case 'non-zero' :
            var col = 'Non-zero columns';
        break;
    }

    $(this).parent().parent().prev().html(`${row}/${col}&nbsp;&nbsp;<i class="fa fa-caret-down"></i>`);
});