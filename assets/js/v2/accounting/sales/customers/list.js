$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function(e) {
    e.stopPropagation();
});

$("#customers-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#customers-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('#customers-table thead .select-all').on('change', function() {
    $('#customers-table tbody tr:visible .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$(document).on('change', '#customers-table tbody tr:visible .select-one', function() {
    var checked = $('#customers-table tbody tr:visible input.select-one:checked');
    var totalrows = $('#customers-table tbody tr:visible input.select-one').length;

    $('#customers-table thead .select-all').prop('checked', checked.length === totalrows);

    if(checked.length < 1) {
        $('.batch-actions li a.dropdown-item').addClass('disabled');
    } else {
        $('.batch-actions li a.dropdown-item').removeClass('disabled');
    }
});

$(document).on('change', '.dropdown-menu.table-settings input[name="col_chk"]', function() {
    var chk = $(this);
    var dataName = $(this).next().text().trim();

    var index = $(`#customers-table thead td[data-name="${dataName}"]`).index();
    $(`#customers-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    console.log(1231231232);

    // $(`#print_items_modal table tr`).each(function() {
    //     if(chk.prop('checked')) {
    //         $($(this).find('td')[index - 1]).show();
    //     } else {
    //         $($(this).find('td')[index - 1]).hide();
    //     }
    // });

    // $(`#print_preview_items_modal #items_table_print tr`).each(function() {
    //     if(chk.prop('checked')) {
    //         $($(this).find('td')[index - 1]).show();
    //     } else {
    //         $($(this).find('td')[index - 1]).hide();
    //     }
    // });
});