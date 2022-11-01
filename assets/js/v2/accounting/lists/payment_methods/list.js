$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$("#payment-methods-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#payment-methods-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('#inc_inactive').on('change', function() {
    var currUrl = window.location.href;
    var urlSplit = currUrl.split('/');

    if(currUrl.slice(-1) === '#') {
        currUrl = currUrl.slice(0, -1); 
    }

    if($(this).prop('checked')) {
        if(urlSplit[urlSplit.length - 1] === 'payment-methods') {
            location.href='payment-methods?inactive=1';
        } else {
            location.href = currUrl+'&inactive=1';
        }
    } else {
        if(currUrl.includes('&inactive=1')) {
            location.href=currUrl.replace('&inactive=1', '');
        } else {
            location.href=currUrl.replace('inactive=1', '');
        }
    }
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#payment-methods-table thead td[data-name="${dataName}"]`).index();
    $(`#payment-methods-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_payment_methods_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_preview_payment_methods_modal #payment_methods_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });
});

$("#btn_print_payment_methods").on("click", function() {
    $("#payment_methods_table_print").printThis();
});

$('#add-payment-method-button').on('click', function(e) {
    e.preventDefault();

    $.get(`/accounting/get-dropdown-modal/payment_method_modal`, function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(result);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${result}
                </div>
            `);
        }

        $('#modal-container #payment-method-modal').modal('show');
    });
});

$('#payment-methods-table .edit-payment-method').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().id;

    $.get(`/accounting/payment-methods/edit/${id}`, function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(result);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${result}
                </div>
            `);
        }

        $('#modal-container #payment-method-modal').modal('show');
    });
});

$('#payment-methods-table .make-inactive').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().id;
    var name = row.find('td:first-child').text().trim();

    Swal.fire({
        title: 'Are you sure?',
        html: `You want to make <b>${name}</b> inactive?`,
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: `/accounting/payment-methods/delete/${id}`,
                type:"DELETE",
                success:function (result) {
                    location.reload();
                }
            });
        }
    });
});

$('#payment-methods-table .make-active').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var id = row.data().id;
    var name = row.find('td:first-child').text().trim();

    Swal.fire({
        title: 'Are you sure?',
        html: `You want to make <b>${name}</b> active?`,
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: `/accounting/payment-methods/activate/${id}`,
                type:"GET",
                success:function (result) {
                    location.reload();
                }
            });
        }
    });
});