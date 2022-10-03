$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$("#categories-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#categories-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('#categories-table .edit-category').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get(`product-categories/get/${row.data().id}`, function(result) {
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
        $('#addNewCategory .modal-footer').prepend('<button type="button" id="remove-category" class="nsm-button">Remove</button>');

        $(`#addNewCategory`).attr('data-bs-backdrop', 'static');

        $('#addNewCategory').modal('show');
    });
});

$('#sub-category').on('change', function(){
    if($(this).prop('checked')) {
        if($(this).parent().parent().find('#parent_account').length === 0) {
            $('#addNewCategory .modal-body').append(`
            <div class="mb-2">
                <select class="form-control nsm-field" name="parent_id" id="parent_account"></select>
            </div>`);

            $('#parent_account').select2({
                ajax: {
                    url: '/accounting/product-categories/get',
                    dataType: 'json'
                },
                dropdownParent: $('#addNewCategory')
            });
        }
    } else {
        $(this).parent().next().remove();
    }
});

$('#new-category-button').on('click', function(e) {
    e.preventDefault();

    $(`#addNewCategory`).attr('data-bs-backdrop', 'static');

    $('#addNewCategory').modal('show');
});

$('#categories-table .remove-category').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');
    
    $.ajax({
        url: `/accounting/product-categories/delete/${row.data().id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });
});

$(document).on('click', '#update-category-form #remove-category', function() {
    var split = $('#update-category-form').attr('action').split('/');
    var id = split[split.length - 1];

    $.ajax({
        url: `/accounting/product-categories/delete/${id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });
});