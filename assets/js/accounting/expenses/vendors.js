$('#address_chk, #attachments_chk, #phone_chk, #email_chk').on('change', function() {
    var elementId = $(this).attr('id');
    var column = elementId.replace('_chk', '');

    if($(this).prop('checked')) {
        $(`#vendors-table .${column}`).removeClass('hide');
    } else {
        $(`#vendors-table .${column}`).addClass('hide');
    }
});

$(document).on('click', '#vendors-table tbody tr td:not(:first-child,:last-child)', function() {
    var data = table.row($(this).parent()).data();
    
    window.location.href = '/accounting/vendors/view/'+data.id;
});

var table = $('#vendors-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: $('#table_rows').val(),
    order: [[0, 'asc']],
    ajax: {
        url: 'vendors/load/',
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.inactive = $('#inc_inactive').prop('checked') === true ? 1 : 0;
            d.length = $('#table_rows').val();
            d.columns[0].search.value = $('input#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: [
        {
			data: null,
			name: 'checkbox',
            orderable: false,
			fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`<input type="checkbox" value="${rowData.id}">`);
			}
		},
        {
            data: 'name',
            name: 'name',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`<a href="/accounting/vendors/view/${rowData.id}">${cellData}</a>`);

                if(rowData.company_name !== "") {
                    $(td).append(`<p class="m-0 text-muted">${rowData.company_name}</p>`);
                }
            }
        },
        {
            data: 'address',
            name: 'address',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('address');
                if($('#address_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'phone',
            name: 'phone',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('phone');
                if($('#phone_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'email',
            name: 'email',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('email');
                if($('#email_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'attachments',
            name: 'attachments',
            orderable: false,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).addClass('attachments');
                if($('#attachments_chk').prop('checked') === false) {
                    $(td).addClass('hide');
                }
            }
        },
        {
            data: 'open_balance',
            name: 'open_balance'
        },
        {
            orderable: false,
			data: null,
			name: 'action',
			fnCreatedCell: function(td, cellData, rowData,row, col) {
                $(td).html(`
                <div class="btn-group float-right">
                    <button class="btn d-flex align-items-center justify-content-center text-info">
                        Create bill
                    </button>

                    <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                        <a class="dropdown-item" href="#">Create expense</a>
                        <a class="dropdown-item" href="#">Write check</a>
                        <a class="dropdown-item" href="#">Create purchase order</a>
                        <a class="dropdown-item" href="#">Make inactive</a>
                    </div>
                </div>
                `);
            }
        }
    ]
});