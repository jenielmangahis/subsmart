const currUrl = window.location.href;
const urlSplit = currUrl.includes('?') ? currUrl.split('?')[0].split('/') : currUrl.split('/');
const reportId = urlSplit[urlSplit.length - 1].replace('#', '');

$('.date').each(function() {
    $(this).datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});

$('select').each(function() {
    if($(this).closest('.modal').length > 0) {
        $(this).select2({
            minimumResultsForSearch: -1,
            dropdownParent: $(this).closest('.modal')
        });
    } else {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    }

    if($(this).attr('id') === 'custom-report-group') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'custom-report-group'
                    }
        
                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });
    }

    if($(this).attr('id') === 'filter-distribution-account') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-account'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $(this).closest('.modal')
        });
    }

    if($(this).attr('id') === 'filter-account') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-account'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $(this).closest('.modal')
        });
    }

    if($(this).attr('id') === 'filter-name') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-name'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $(this).closest('.modal')
        });
    }

    if($(this).attr('id') === 'filter-payment-method') {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'filter-report-payment-method'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect,
            dropdownParent: $(this).closest('.modal')
        });
    }
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});