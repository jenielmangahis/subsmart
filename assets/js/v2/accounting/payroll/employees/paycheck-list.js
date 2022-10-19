$('.date').datepicker({
    format: 'mm/dd/yyyy',
    orientation: 'bottom',
    autoclose: true
});

$('#table-filters').on('click', function(e) {
    e.stopPropagation();
});

$('#filter-employee, #filter-date-range').select2({
    minimumResultsForSearch: -1
});