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

$('#previous-period, #previous-year, #year-to-date').on('change', function() {
    if($(this).prop('checked')) {
        $(this).parent().next().find('input').prop('disabled', false);
        $(this).parent().next().find('label').removeClass('text-muted');
    } else {
        $(this).parent().next().find('input').prop('checked', false);
        $(this).parent().next().find('input').prop('disabled', true);
        $(this).parent().next().find('label').addClass('text-muted');
    }
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

$('input[name="selected_period"]').on('change', function() {
    var selected = $('input[name="selected_period"]:checked');

    var label = '';
    if(selected.length > 1) {
        var flag = true;
        selected.each(function() {
            var name = selected.next().html().replace(' (PP)', '');
            name = name.replace(' (PY)', '');
            name = name.replace(' (YTD)', '');
            name = name.replace(' (PY YTD)', '');
            name = name.replace(' of Row', '');
            name = name.replace(' of Column', '');
            name = name.replace(' of Income', '');
            name = name.replace(' of Expense', '');

            if(name !== '%') {
                flag = false;
            }
        });

        if(flag) {
            label = '% comparison';
        } else {
            label = 'Multiple';
        }
    } else {
        if(selected.length === 1) {
            var name = selected.next().html().replace(' (PP)', '');
            name = name.replace(' (PY)', '');
            name = name.replace(' (YTD)', '');
            name = name.replace(' (PY YTD)', '');
            name = name.replace(' of Row', '');
            name = name.replace(' of Column', '');
            name = name.replace(' of Income', '');
            name = name.replace(' of Expense', '');

            if(name === '%') {
                name += ' comparison';
            }

            label = name;
        } else {
            label = 'Select period';
        }
    }

    $(this).parent().parent().prev().html(`${label}&nbsp;&nbsp;<i class="fa fa-caret-down"></i>`);
});