$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$("#vendors-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#vendors-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#vendors-table thead td[data-name="${dataName}"]`).index();
    $(`#vendors-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_vendors_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_vendors_modal #vendors_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_vendors").on("click", function() {
    $("#vendors_table_print").printThis();
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#inc_inactive').on('change', function() {
    var currUrl = window.location.href;
    var urlSplit = currUrl.split('/');
    
    if($(this).prop('checked')) {
        if(urlSplit[urlSplit.length - 1] === 'vendors') {
            location.href='vendors?status=all';
        } else {
            location.href = currUrl+'&status=all';
        }
    } else {
        if(currUrl.includes('&status=all')) {
            location.href=currUrl.replace('&status=all', '');
        } else {
            location.href=currUrl.replace('status=all', '');
        }
    }
});

$('.export-items').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append('<form action="/accounting/vendors/export-vendors" method="post" id="export-form"></form>');
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('_chk', '')}">`);
    });

    $('#export-form').append(`<input type="hidden" name="inactive" value="${$('#inc_inactive').prop('checked') ? 1 : 0}">`);
    $('#export-form').append(`<input type="hidden" name="search" value="${$('#search_field').val()}">`);

    if($('.nsm-counter.selected').length > 0) {
        $('#export-form').append(`<input type="hidden" name="transaction" value="${$('.nsm-counter.selected').attr('id')}">`);
    }

    $('#export-form').append(`<input type="hidden" name="column" value="name">`);
    $('#export-form').append(`<input type="hidden" name="order" value="asc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});