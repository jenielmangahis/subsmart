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
            // fnCreatedCell: function(td, cellData, rowData, row, col) {
            //     $(td).html(cellData);
            // }
        },
        {
            data: 'address',
            name: 'address',
            // fnCreatedCell: function(td, cellData, rowData, row, col) {
                
            // }
        },
        {
            data: 'phone',
            name: 'phone'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'attachments',
            name: 'attachments'
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
                $(td).html(`<a href="#" class="text-link float-right">Create bill</a>`);
            }
        }
    ]
});