$('#registers-table').DataTable({
    searching: false,
    lengthChange: false,
});

$('select').select2({
    templateResult: formatResult,
    templateSelection: optionSelect
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});