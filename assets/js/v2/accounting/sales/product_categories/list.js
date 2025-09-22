$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$("#categories-table").nsmPagination({
    //itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
    itemsPerPage: 10
});

/*$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#categories-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});*/

$('#categories-table .edit-category').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get(`product-categories/get/${row.data().id}`, function(result) {
        var category = JSON.parse(result);

        $('.product-category-modal-title').html('Edit Category');
        $('#addNewCategory form [name="name"]').val(category.name);

        if(category.hasOwnProperty('parent') && category.parent !== null) {
            $('#addNewCategory form #sub-category').prop('checked', true).trigger('change');

            $('#addNewCategory form #parent_account').append(`<option value="${category.parent.item_categories_id}" selected>${category.parent.name}</option>`)
        } else {
            $('#addNewCategory form #sub-category').prop('checked', false).trigger('change');
        }

        $('#addNewCategory form').attr('action', base_url + `accounting/product-categories/update/${category.item_categories_id}`);
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
                    url: base_url + 'accounting/product-categories/get',
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

    $('.product-category-modal-title').html('Add New Category');
    $('#addNewCategory form [name="name"]').val('');
    $('#addNewCategory form #sub-category').prop('checked', false).trigger('change');

    $(`#addNewCategory`).attr('data-bs-backdrop', 'static');
    $('#addNewCategory').modal('show');
});

$('#categories-table .remove-category').on('click', function(e) {
    e.preventDefault();
    var row = $(this).closest('tr');   
    var category_name = $(this).attr('data-name'); 

    /*$.ajax({
        url: base_url + `accounting/product-categories/delete/${row.data().id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });*/

    Swal.fire({
        title: 'Delete Product Category',
        html: `Are you sure you want to delete category <b>${category_name}</b>?`,
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'DELETE',
                url: base_url + `accounting/product-categories/delete/${row.data().id}`,
                dataType: 'json',
                success: function(result) {
                    if (result.is_success == 1) {
                        Swal.fire({
                            title: 'Delete Product Category',
                            text: result.msg,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                                location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'An Error Occured',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //location.reload();
                        });
                    }
                },
                beforeSend: function(){
                    Swal.fire({
                        icon: "info",
                        title: "Processing",
                        html: "Please wait while the process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                }
            });
        }
    });
    
});

$("#btn-delete-product-categories").on("click", function() {

    Swal.fire({
        title: 'Delete All',
        text: "This will delete all selected product categories. Proceed with action?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: base_url + `accounting/product-categories/_delete_selected_product_categories`,
                dataType: 'json',
                data: $('#frm-prod-categories').serialize(),
                success: function(result) {
                    if (result.is_success == 1) {
                        Swal.fire({
                            title: 'Delete Successful!',
                            text: "Product categories is successfully deleted!",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'An Error Occured',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                //location.reload();
                            }
                        });
                    }
                },
            });
        }
    });
});     

$(document).on('click', '#update-category-form #remove-category', function() {
    var split = $('#update-category-form').attr('action').split('/');
    var id = split[split.length - 1];

    $.ajax({
        url: base_url + `accounting/product-categories/delete/${id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });
});


$(".check-input-all-product-category").click(function() {
    $('tr:visible .check-input-product-category').prop('checked', this.checked);  
    let total= $('#categories-table tr:visible input[name="catid[]"]:checked').length;
    if( total > 0 ){
        $('#num-checked').text(`(${total})`);
        $(".dropdown-item-delete").removeClass("disabled");
    }else{
        $('#num-checked').text('');
        $('.dropdown-item-delete').addClass('disabled');
    }
});

$(".check-input-product-category").click(function() {
    let total= $('#categories-table input[name="catid[]"]:checked').length;
    if( total > 0 ){
        $(".dropdown-item-delete").removeClass("disabled");
        $('#num-checked').text(`(${total})`);
    }else{
        $('.dropdown-item-delete').addClass('disabled');
        $('#num-checked').text('');
    }
})
