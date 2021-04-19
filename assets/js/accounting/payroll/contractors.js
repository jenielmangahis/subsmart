$('#contractor-status').select2({
    minimumResultsForSearch: -1
});

$('#contractor-status').on('change', function() {
    table.ajax.reload();
});

$('input#search').on('keyup', function() {
    table.ajax.reload();
});

$(document).on('click', '#contractors-table tbody tr', function() {
    var data = table.row(this).data();

    window.location.href = `/accounting/contractors/view/${data.id}`;
});

var table = $('#contractors-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: 50,
    order: [[0, 'asc']],
    ajax: {
        url: 'contractors/load/',
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        data: function(d) {
            d.status = $('#contractor-status').val();
            d.columns[0].search.value = $('input#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers'
    },
    columns: [
        {
            data: 'name',
            name: 'name',
            orderable: false,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(cellData);
                if(rowData.status === "0") {
                    $(td).append(' (deleted)');
                }
            }
        },
        {
            data: null,
            name: 'action',
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`
                <div class="btn-group float-right">
                    <button class="btn d-flex align-items-center justify-content-center text-info">
                        Write check
                    </button>

                    <button type="button" id="statusDropdownButton" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="statusDropdownButton">
                        <a class="dropdown-item" href="#">Create expense</a>
                        <a class="dropdown-item" href="#">Create bill</a>
                    </div>
                </div>
                `);
            }
        }
    ]
});