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

$('#show-cols').on('click', function(e) {
    e.preventDefault();$(function() {
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            orientation: 'bottom',
            autoclose: true
        });
    });
    
    $('.dropdown-menu:not(.export-dropdown)').on('click', function(e) {
        e.stopPropagation();
    });
    

    if($(this).text().trim().replace('Show ', '') === 'More') {
        $(this).html('<i class="fa fa-caret-up text-info"></i> Show Less');

        $(this).parent().prev().show();
    } else {
        $(this).html('<i class="fa fa-caret-down text-info"></i> Show More');

        $(this).parent().prev().hide();
    }
});