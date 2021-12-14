$('#table_rows').on('change', function() {
    $('#product-categories-table').DataTable().ajax.reload();
});
$('.action-bar .dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});
$('#table_rows').select2({
    minimumResultsForSearch: -1
});
$('#product-categories-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: $('#table_rows').val(),
    info: false,
    ajax: {
        url: 'product-categories/load/',
        dataType: 'json',
        contentType: 'application/json', 
        type: 'POST',
        data: function(d) {
            d.length = $('#table_rows').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers',
    },
    columns: [
        {
            data: 'name',
            name: 'name'
        },
        {
            data: null,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`
                <div class="btn-group float-right">
                    <a href="#" class="edit-category btn text-primary d-flex align-items-center justify-content-center">Edit</a>

                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item delete-category" href="#">Remove</a>
                    </div>
                </div>
                `);
            }
        }
    ]
});
$('#sub-category').on('change', function(){
    if($(this).prop('checked')) {
        if($(this).parent().parent().find('#parent_account').length === 0) {
            $(this).parent().parent().append(`
            <div class="form-group">
                <select class="form-control" name="parent_id" id="parent_account">
                    <option></option>
                </select>
            </div>
            `);

            $('#parent_account').select2({
                ajax: {
                    url: '/accounting/product-categories/get',
                    dataType: 'json'
                }
            });
        }
    } else {
        $(this).parent().next().remove();
    }
});
$('#add-category').on('click', function(e) {
    e.preventDefault();

    $('#addNewCategory form').attr('action', `/accounting/product-categories/create`);
    $('#addNewCategory form').attr('id', 'create-category-form');
    $('#addNewCategory form [name="name"]').val('');
    $('#addNewCategory form #sub-category').prop('checked', false).trigger('change');

    $('#addNewCategory').modal('show');
});
$(document).on('click', '.edit-category', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent();
    var rowData = $('#product-categories-table').DataTable().row(row).data();

    $.get(`product-categories/get/${rowData.id}`, function(result) {
        var category = JSON.parse(result);

        $('#addNewCategory form [name="name"]').val(category.name);

        if(category.hasOwnProperty('parent')) {
            $('#addNewCategory form #sub-category').prop('checked', true).trigger('change');

            $('#addNewCategory form #parent_account').append(`<option value="${category.parent.item_categories_id}" selected>${category.parent.name}</option>`)
        } else {
            $('#addNewCategory form #sub-category').prop('checked', false).trigger('change');
        }

        $('#addNewCategory form').attr('action', `/accounting/product-categories/update/${category.item_categories_id}`);
        $('#addNewCategory form').attr('id', `update-category-form`);

        $('#addNewCategory').modal('show');
    });
});
$(document).on('click', '.delete-category', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var rowData = $('#product-categories-table').DataTable().row(row).data();
    
    $.ajax({
        url: `/accounting/product-categories/delete/${rowData.id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });
});