$(function() {
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});

$('.dropdown-menu:not(.export-dropdown)').on('click', function(e) {
    e.stopPropagation();
});

$('#previous-period, #previous-year').on('change', function() {
    if($(this).prop('checked')) {
        $(this).parent().next().find('input').prop('disabled', false);
    } else {
        $(this).parent().next().find('input').prop('checked', false);
        $(this).parent().next().find('input').prop('disabled', true);
    }
});

$('input[name="show_rows"], input[name="show_cols"]').on('change', function() {
    var selectedRow = $('input[name="show_rows"]:checked').attr('id').replace('-rows', '');
    var selectedCol = $('input[name="show_cols"]:checked').attr('id').replace('-columns', '');

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

    $(this).parent().parent().prev().find('span').html(`${row}/${col}`);
});

$('input[name="selected_period"]').on('change', function() {
    var selected = $('input[name="selected_period"]:checked');

    var label = '';
    if(selected.length > 1) {
        if(selected.length > 2) {
            label = 'Multiple';
        } else {
            var flag = true;
            selected.each(function() {
                var name = selected.next().html().replace(' (PP)', '').replace(' (PY)', '').replace(' of Row', '').replace(' of Column', '');
                
                if(name !== '%') {
                    flag = false;
                }
            });

            if(flag) {
                label = '% comparison';
            } else {
                label = 'Multiple';
            }
        }
    } else {
        if(selected.length === 1) {
            var name = selected.next().html().replace(' (PP)', '').replace(' (PY)', '').replace(' of Row', '').replace(' of Column', '');

            if(name === '%') {
                name += ' comparison';
            }

            label = name;
        } else {
            label = 'Select period';
        }
    }

    $(this).parent().parent().prev().find('span').html(label);
});