$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function(e) {
    e.stopPropagation();
});

$("#transactions-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#transactions-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#filter-template-type, #filter-transaction-type').select2({
    minimumResultsForSearch: -1
});

$('#transaction-type-modal #type').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#transaction-type-modal')
});

$('#apply-button').on('click', function() {
    var templateType = $('#filter-template-type').val();
    var transactionType = $('#filter-transaction-type').val();
    var search = $('#search_field').val();

    var url = `${base_url}accounting/recurring-transactions?`;

    url += search !== '' ? `search=${search}&` : '';
    url += templateType !== 'all' ? `template-type=${templateType}&` : '';
    url += transactionType !== 'all' ? `transaction-type=${transactionType}&` : '';

    if(url.slice(-1) === '#') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$("#btn_print_recurring_transactions").on("click", function() {
    $("#recurring_transactions_table_print").printThis();
});