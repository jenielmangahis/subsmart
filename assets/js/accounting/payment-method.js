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
                    <div class="checkbox checkbox-sec d-flex justify-content-center">
                        <input type="checkbox" name="is_credit_${rowData.id}" id="is_credit_${rowData.id}" disabled checked>
                        <label for="is_credit_${rowData.id}"></label>
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

$('#table_rows').select2({
    minimumResultsForSearch: -1
});

$(document).on('click', '#payment_methods .edit-method', function(e) {
    e.preventDefault();

    var data = e.currentTarget.dataset;

    $.get(`/accounting/payment-methods/edit/${data.id}`, function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`<div class="full-screen-modal">${result}</div>`);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    <div class="full-screen-modal">
                        ${result}
                    </div>
                </div>
            `);
        }

        $('#modal-container #payment-method-modal').modal('show');
    });
});

$(document).on('click', '#payment_methods .make-inactive', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;

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

$(document).on('click', '#payment_methods .make-active', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;

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

$(document).on('click', '#new-payment-method', function(e) {
    e.preventDefault();

    $.get(`/accounting/get-dropdown-modal/payment_method_modal`, function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`<div class="full-screen-modal">${result}</div>`);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    <div class="full-screen-modal">
                        ${result}
                    </div>
                </div>
            `);
        }

        $('#modal-container #payment-method-modal').modal('show');
    });
});

$(document).on('click', '#print-payment-methods', function(e) {
    e.preventDefault();

    var data = new FormData();
    data.set('credit_card', $('#col_credit').prop('checked') === true ? 1 : 0);
    data.set('inactive', $('#inc_inactive').prop('checked') === true ? 1 : 0);
    data.set('search', $('input#search').val());

    var tableOrder = $('#payment_methods').DataTable().order();
    data.set('order', tableOrder[0][1]);

    $.ajax({
		url: '/accounting/payment-methods/print',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
			let pdfWindow = window.open("");
			pdfWindow.document.write(`<h3>Payment Methods</h3>`);
			pdfWindow.document.write(result);
			$(pdfWindow.document).find('body').css('padding', '0');
			$(pdfWindow.document).find('body').css('margin', '0');
			$(pdfWindow.document).find('iframe').css('border', '0');
			pdfWindow.print();
		}
	});
});