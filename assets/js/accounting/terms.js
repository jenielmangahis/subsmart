$('#table_rows, #inc_inactive').on('change', function() {
    $('#terms_table').DataTable().ajax.reload();
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#search').on('keyup', function() {
    $('#terms_table').DataTable().ajax.reload();
});

$('#table_rows').select2({
    minimumResultsForSearch: -1
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

$(document).on('click', '#terms_table .make-inactive', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = table.row(row).data();

    Swal.fire({
        title: 'Are you sure?',
        html: `You want to make <b>${data.name}</b> inactive?`,
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
                url: `/accounting/terms/delete/${data.id}`,
                type:"DELETE",
                success:function (result) {
                    location.reload();
                }
            });
        }
    });
});

$(document).on('click', '#terms_table .make-active', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent();
    var data = table.row(row).data();

    Swal.fire({
        title: 'Are you sure?',
        html: `You want to make <b>${data.name}</b> active?`,
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
                url: `/accounting/terms/activate/${data.id}`,
                type:"GET",
                success:function (result) {
                    location.reload();
                }
            });
        }
    });
});

$(document).on('click', '#terms_table .edit-term', function(e) {
    e.preventDefault();

    var row = $(this).parent().parent().parent().parent();
    var data = table.row(row).data();

    $.get(`/accounting/terms/edit/${data.id}`, function(result) {
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

        $('#modal-container #term-modal').modal('show');
    });
});

$(document).on('click', '#new-payment-term', function(e) {
    e.preventDefault();

    $.get(`/accounting/get-dropdown-modal/term_modal`, function(result) {
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

        $(`#modal-container #term-modal`).modal('show');
    });
});

$(document).on('click', '#print-terms', function(e) {
    e.preventDefault();
    var data = new FormData();
    
    data.set('inactive', $('#inc_inactive').prop('checked') === true ? 1 : 0);
    data.set('search', $('input#search').val());

    var tableOrder = $('#terms_table').DataTable().order();
    data.set('order', tableOrder[0][1]);

    $.ajax({
		url: '/accounting/terms/print',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
			let pdfWindow = window.open("");
			pdfWindow.document.write(`<h3>Terms</h3>`);
			pdfWindow.document.write(result);
			$(pdfWindow.document).find('body').css('padding', '0');
			$(pdfWindow.document).find('body').css('margin', '0');
			$(pdfWindow.document).find('iframe').css('border', '0');
			pdfWindow.print();
		}
	});
});