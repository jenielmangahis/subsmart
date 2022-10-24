$('#status-filter li a.dropdown-item').on('click', function(e) {
    e.preventDefault();
    var search = $('#search_field').val();

    var status = $(this).attr('id');

    var url = `${base_url}accounting/contractors?`;

    url += search !== '' ? `search=${search}&` : '';
    url += status !== 'active' ? `status=${status}` : '';

    if(url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#contractors-table .write-check').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    
    $.get('/accounting/get-other-modals/check_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#checkModal #payee').append(`<option value="vendor-${row.data().id}">${row.data().name}</option>`);

        initModalFields('checkModal');

        $('#checkModal').modal('show');
    });
});

$('#contractors-table .create-expense').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/expense_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#expenseModal #payee').append(`<option value="vendor-${row.data().id}">${row.data().name}</option>`);

        initModalFields('expenseModal');

        $('#expenseModal').modal('show');
    });
});

$('#contractors-table .create-bill').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/bill_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal #vendor').append(`<option value="${row.data().id}">${row.data().name}</option>`);

        initModalFields('billModal');

        $('#billModal').modal('show');
    });
});