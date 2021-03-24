function col(el)
{
    if($(el).prop('checked'))
    {
        $('.credit-card').removeClass('hide');
    }
    else
    {
        $('.credit-card').addClass('hide');
    }
}

$('#payment_methods').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: $('#table_rows').val(),
    info: false,
    ajax: {
        url: 'payment-methods/load-payment-methods/',
        dataType: 'json',
        contentType: 'application/json', 
        type: 'POST',
        data: function(d) {
            d.inactive = $('#inc_inactive').prop('checked') === true ? 1 : 0;
            d.length = $('#table_rows').val();
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
            data: 'credit_card',
            name: 'credit_card',
            orderable: false,
            searchable: false,
            fnCreatedCell: function (td, cellData, rowData, row, col) {
                $(td).addClass('credit-card');

                if(cellData === '1' || cellData === 1) {
                    $(td).html(`
                    <div class="form-group d-flex" style="margin-bottom: 0 !important">
                        <input class="m-auto" type="checkbox" checked disabled>
                    </div>
                    `);
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
                            <a class="dropdown-item edit-method" href="#" data-name="${rowData.name}" data-credit_card="${rowData.credit_card}" data-id="${rowData.id}">Edit</a>
                            <a class="dropdown-item make-inactive" href="#" data-id="${rowData.id}" data-name="${rowData.name}">Make inactive</a>
                        </div>
                    </div>
                    `);
                } else {
                    $(td).html(`
                    <div class="btn-group float-right">
                        <a href="#" data-id="${rowData.id}" data-name="${rowData.name}" class="make-active btn text-primary d-flex align-items-center justify-content-center">Make active</a>

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
        emptyTable: "There are no payment methods that match the criteria."
    }
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#search').on('keyup', function() {
    $('#payment_methods').DataTable().ajax.reload();
});

$('#table_rows, #inc_inactive').on('change', function() {
    $('#payment_methods').DataTable().ajax.reload();
});

$(document).on('click', '#payment_methods .edit-method', function(e) {
    e.preventDefault();

    var data = e.currentTarget.dataset;

    $('#payment-method-form').prop(`action`, `/accounting/payment-methods/update/${data.id}`);

    if(data.name !== null && data.name !== "null") {
        $('#payment-method-form #name').val(data.name);
    }

    if(data.credit_card === '1' || data.credit_card === 1) {
        $('#payment-method-form #credit_card').prop('checked', true);
    } else {
        $('#payment-method-form #credit_card').prop('checked', false);
    }

    $('#payment_method_modal h4.modal-title').html('Edit Payment Method');
    $('#payment_method_modal').modal('show');
});

$('a[data-target="#payment_method_modal"]').on('click', function() {
    $('#payment-method-form').prop('action', '/accounting/payment-methods/add');

    $('#payment-method-form #name').val('');
    $('#payment-method-form #credit_card').prop('checked', false);
    $('#payment_method_modal h4.modal-title').html('New Payment Method');
});

$(document).on('click', '#payment_methods .make-inactive', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;

    $('#inactive_payment_method .modal-footer .btn-success').attr('data-id', id);
    $('#inactive_payment_method span.method-name').html(name);

    $('#inactive_payment_method').modal('show');
});

$(document).on('click', '#inactive_payment_method .modal-footer .btn-success', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;

    $.ajax({
        url: `/accounting/payment-methods/delete/${id}`,
        type:"DELETE",
        success:function (result) {
            location.reload();
        }
    });
});

$(document).on('click', '#payment_methods .make-active', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;

    $('#active_payment_method .modal-footer .btn-success').attr('data-id', id);
    $('#active_payment_method span.method-name').html(name);

    $('#active_payment_method').modal('show');
});

$(document).on('click', '#active_payment_method .modal-footer .btn-success', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;

    $.ajax({
        url: `/accounting/payment-methods/activate/${id}`,
        type:"GET",
        success:function (result) {
            location.reload();
        }
    });
});