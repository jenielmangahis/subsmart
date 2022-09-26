$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function(e) {
    e.stopPropagation();
});

$("#items-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#items-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('#filter-status, #filter-type, #filter-stock-status').select2({
    minimumResultsForSearch: -1
});

$('#filter-category').select2({
	allowClear: true
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#items-table thead td[data-name="${dataName}"]`).index();
    $(`#items-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    // $(`#print_vendors_modal table tr`).each(function() {
    //     if(chk.prop('checked')) {
    //         $($(this).find('td')[index - 1]).show();
    //     } else {
    //         $($(this).find('td')[index - 1]).hide();
    //     }
    // });

    // $(`#print_preview_vendors_modal #vendors_table_print tr`).each(function() {
    //     if(chk.prop('checked')) {
    //         $($(this).find('td')[index - 1]).show();
    //     } else {
    //         $($(this).find('td')[index - 1]).hide();
    //     }
    // });
});