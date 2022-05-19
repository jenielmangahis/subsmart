$('#table_rows, #inc_inactive').on('change', function() {
    $('#terms_table').DataTable().ajax.reload();
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#search').on('keyup', function() {
    $('#terms_table').DataTable().ajax.reload();
});

var table = $('#terms_table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: $('#table_rows').val(),
    info: false,
    ajax: {
        url: 'terms/load-terms/',
        dataType: 'json',
        contentType: 'application/json', 
        type: 'POST',
        data: function(d) {
            d.length = $('#table_rows').val();
            d.inactive = $('#inc_inactive').prop('checked') === true ? 1 : 0;
            d.columns[0].search.value = $('input#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers',
    },
    columns: [
        {
            data: 'name',
            name: 'name',
            fnCreatedCell: function (td, cellData, rowData, row, col) {
                if(rowData.status === 0 || rowData.status === '0') {
                    $(td).html(cellData + ' (deleted)');
                } else {
                    $(td).html(cellData);
                }
            }
        },
        {
            data: null,
            name: 'actions',
            orderable: false,
            searchable: false,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                if(rowData.status === '1' || rowData.status === 1) {
                    $(td).html(`
                    <div class="btn-group float-right">
                        <a href="#" class="btn text-primary d-flex align-items-center justify-content-center">Run Report</a>

                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit-term" href="#">Edit</a>
                            <a class="dropdown-item make-inactive" href="#">Make inactive</a>
                        </div>
                    </div>
                    `);
                } else {
                    $(td).html(`
                    <div class="btn-group float-right">
                        <a href="#" class="make-active btn text-primary d-flex align-items-center justify-content-center">Make active</a>

                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit-method" href="#"">Run report</a>
                        </div>
                    </div>
                    `);
                }
            }
        }
    ],
    language: {
        emptyTable: "There are no terms that match the criteria."
    }
});

$('a[data-target="#payment_term_modal"]').on('click', function() {
    $('#payment_term_modal h4.modal-title').html('New Term');

    $('#payment_term_modal input[name="id"]').remove();
    $('#payment_term_modal input[name="type"][value="1"]').trigger('click');
    $('#payment-term-form input[type="text"], #payment-term-form input[type="number"]').val('');
});

$('#payment_term_modal .form-check label').on('click', function() {
    $(this).prev().trigger('click');
});

$('input[name="type"]').on('change', function() {
    if($(this).val() === "1" || $(this).val() === 1) {
        $('#payment_term_modal #net_due_days').prop('disabled', false);

        $('#day_of_month_due, #minimum_days_to_pay').prop('disabled', true);
        $('#day_of_month_due, #minimum_days_to_pay').val('');
    } else if($(this).val() === "2" || $(this).val() === 2) {
        $('#payment_term_modal #net_due_days').val('');
        $('#payment_term_modal #net_due_days').prop('disabled', true);

        $('#day_of_month_due, #minimum_days_to_pay').prop('disabled', false);
    }
});

$(document).on('click', '#terms_table .make-inactive', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = table.row(row).data();

    $('#inactive_term .modal-footer .btn-success').attr('data-id', data.id);
    $('#inactive_term span.term-name').html(data.name);

    $('#inactive_term').modal('show');
});

$(document).on('click', '#terms_table .make-active', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent();
    var data = table.row(row).data();

    $('#active_term .modal-footer .btn-success').attr('data-id', data.id);
    $('#active_term span.term-name').html(data.name);

    $('#active_term').modal('show');
});

$(document).on('click', '#inactive_term .modal-footer .btn-success', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;

    $.ajax({
        url: `/accounting/terms/delete/${id}`,
        type:"DELETE",
        success:function (result) {
            location.reload();
        }
    });
});

$(document).on('click', '#active_term .modal-footer .btn-success', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;

    $.ajax({
        url: `/accounting/terms/activate/${id}`,
        type:"GET",
        success:function (result) {
            location.reload();
        }
    });
});

$(document).on('click', '#terms_table .edit-term', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = table.row(row).data();

    $('#payment-term-form').prop('action', `/accounting/terms/update/${data.id}`);

    if(data.name !== null && data.name !== "null") {
        $('#payment-term-form #name').val(data.name);
    }

    $(`input[name="type"][value="${data.type}"]`).trigger('click');
    
    if(data.type === 1 || data.type === "1") {
        $('#payment_term_modal #net_due_days').val(data.net_due_days);
    } else if(data.type === 2 || data.type === "2") {
        $('#payment_term_modal #day_of_month_due').val(data.day_of_month_due);
        $('#payment_term_modal #minimum_days_to_pay').val(data.minimum_days_to_pay);
    }

    $('#payment_term_modal h4.modal-title').html('Edit Term');
    $('#payment_term_modal').modal('show');
});