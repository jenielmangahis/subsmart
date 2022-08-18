$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#accounts-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#accounts-table thead td[data-name="${dataName}"]`).index();
    $(`#accounts-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_accounts_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_accounts_modal #accounts_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$('#inc_inactive').on('change', function() {
    if($(this).prop('checked')) {
        location.href='chart-of-accounts?status=all';
    } else {
        location.href='chart-of-accounts';
    }
});

$("#accounts-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#accounts-table input.select-all').on('change', function() {
    $('#accounts-table tbody tr input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
});

$('#accounts-table tbody tr input[type="checkbox"]').on('change', function() {
    $('#selected-checks').html($('#accounts-table tbody tr input[type="checkbox"]:checked').length);

    var notChecked = $('#accounts-table tbody tr input[type="checkbox"]:not(:checked)').length;
    $('#accounts-table input.select-all').prop('checked', notChecked === 0);

    if($('#accounts-table tbody tr input[type="checkbox"]:checked').length > 0) {
        $('#make-inactive').removeClass('disabled');
    } else {
        $('#make-inactive').addClass('disabled');
    }
});

$('#make-inactive').on('click', function(e) {
    e.preventDefault();
    if($(this).hasClass('disabled') === false) {
        var data = new FormData();

        $('#accounts-table tbody tr input.select-one:checked').each(function() {
            data.append('ids[]', $(this).val());
        });

        $.ajax({
            url:"/accounting/chart-of-accounts/inactive-batch",
            method:"post",
            data: data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                $('#accounts-table tbody tr input.select-one:checked').each(function() {
                    if($('#inc_inactive').prop('checked')) {
                        $(this).closest('tr').find('td:nth-child(2)').html($(this).closest('tr').find('td:nth-child(2)').text() + ' (deleted)');
                    } else {
                        $(this).closest('tr').remove();
                    }
                });
            }
        });

        $('#accounts-table thead .select-all').prop('checked', false);
    }
});

$("#btn_print_accounts").on("click", function() {
    $("#accounts_table_print").printThis();
});

$(document).on('click', '#add-account-button', function(e) {
    e.preventDefault();

    $.get('/accounting/get-dropdown-modal/account_modal', function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`${result}`);
        } else {
            $('body').append(`
                <div id="modal-container">
                    ${result}
                </div>
            `);
        }

        initAccountModal();
    });
});

$("#accounts-table tbody .edit-account").on("click", function() {
    var id = $(this).closest('tr').find('.select-one').val();
    $.get('/accounting/chart-of-accounts/edit/'+id, function(html) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`${html}`);
        } else {
            $('body').append(`
                <div id="modal-container">
                    ${html}
                </div>
            `);
        }

        initAccountModal();
    });
});