$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#tags-filter-dropdown select').each(function() {
    $(this).select2();
});

$('#filter-dropdown select').each(function() {
    if($(this).attr('id') !== 'by-contact') {
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
                        field: 'transaction-contact'
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

$('#filter-dropdown input.datepicker').datepicker({
    uiLibrary: 'bootstrap'
});

$('#transactions-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: false,//
    lengthChange: false,
    pageLength: 150,
    info: false,
	order: [[1, 'asc']],
});