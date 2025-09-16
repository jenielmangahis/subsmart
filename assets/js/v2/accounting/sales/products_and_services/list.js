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
    }
    url += filterStockStat !== 'all' ? `stock-status=${filterStockStat}&` : '';
    url += groupByCat.prop('checked') ? 'group-by-category=1' : '';

    if (url.slice(-1) === '#') {
        url = url.slice(0, -1);
    }

    if (url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if (url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$('#reset-button').on('click', function () {
    var url = `${base_url}accounting/products-and-services?`;

    if ($('#search_field').val() !== '') {
        url += `search=${$('#search_field').val()}&`;
    }

    if ($('#group-by-category').prop('checked')) {
        url += `group-by-category=1`;
    }

    if (url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if (url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$('#items-table thead .select-all').on('change', function () {
    $('#items-table tbody tr:visible .select-one').prop('checked', $(this).prop('checked')).trigger('change');
    let total= $('#items-table tbody tr:visible .table-select:checked').length;
    if( total > 0 ){
        $('#num-checked').text(`(${total})`);
    }else{
        $('#num-checked').text('');
    }
});

$(document).on('change', '.table-select', function(){
    let total= $('#items-table tbody tr:visible .table-select:checked').length;
    if( total > 0 ){
        $('#num-checked').text(`(${total})`);
    }else{
        $('#num-checked').text('');
    }
});

// $(document).on('change', '#items-table tbody tr:visible .select-one', function () {
//     var checked = $('#items-table tbody tr:visible input.select-one:checked');
//     var totalrows = $('#items-table tbody tr:visible input.select-one').length;

//     $('#items-table thead .select-all').prop('checked', checked.length === totalrows);

//     if (checked.length < 1) {
//         $('.batch-actions li a.dropdown-item').addClass('disabled');
//     } else {
//         var inactiveChecked = $('#items-table tbody tr:visible[data-status="0"] input.select-one:checked').length;

//         if (inactiveChecked < 1) {
//             $('.batch-actions li a#assign-category').removeClass('disabled');
//             $('.batch-actions li a#make-inactive').removeClass('disabled');

//             var activeChecked = $('#items-table tbody tr:visible[data-status="1"] input.select-one:checked');

//             var allNonInv = true;
//             var allService = true;
//             var allInv = true;
//             activeChecked.each(function () {
//                 var row = $(this).closest('tr');
//                 var type = row.find('td:nth-child(4)').html().trim();

//                 if (type !== 'Non-inventory') {
//                     allNonInv = false;
//                 }

//                 if (type !== 'Service') {
//                     allService = false;
//                 }

//                 if (type !== 'Product') {
//                     allInv = false;
//                 }
//             });

//             if (allNonInv) {
//                 $('.batch-actions li a#make-service').removeClass('disabled');
//             } else {
//                 $('.batch-actions li a#make-service').addClass('disabled');
//             }

//             if (allService) {
//                 $('.batch-actions li a#make-non-inventory').removeClass('disabled');
//             } else {
//                 $('.batch-actions li a#make-non-inventory').addClass('disabled');
//             }

//             if (allInv) {
//                 $('.batch-actions li a#adjust-quantity').removeClass('disabled');
//                 $('.batch-actions li a#reorder').removeClass('disabled');
//             } else {
//                 $('.batch-actions li a#adjust-quantity').addClass('disabled');
//                 $('.batch-actions li a#reorder').addClass('disabled');
//             }
//         } else {
//             $('.batch-actions li a.dropdown-item').addClass('disabled');
//         }
//     }
// });

$(document).on('change', '#items-table tbody tr:visible .select-one', function () {
    var checked = $('#items-table tbody tr:visible input.select-one:checked');
    var totalrows = $('#items-table tbody tr:visible input.select-one').length;

    $('#items-table thead .select-all').prop('checked', checked.length === totalrows);

    if (checked.length < 1) {
        $('.batch-actions li a.dropdown-item').addClass('disabled');
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

    /*$.ajax({
        url: base_url + `accounting/product-categories/delete/${row.data().id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }

        initModalFields('inventoryModal');

        var count = 1;
        $('#items-table tbody tr:visible .select-one:checked').each(function () {
            if ($(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count})`).length < 1) {
                $(`#inventoryModal #inventory-adjustments-table tbody`).append('<tr></tr>');
            }

            $(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count})`).html(rowInputs);
            $(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count}) td:nth-child(1)`).html(count);

            $(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count})`).find('select[name="product[]"]').html(`<option value="${$(this).val()}">${$(this).closest('tr').find('td:nth-child(2)').html().trim()}</option>`).trigger('change');

            $(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count})`).find('select').each(function () {
                var type = $(this).attr('id');
                console.log('id', type);
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function (params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: 'inventoryModal'
                                }

                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect,
                        dropdownParent: $('#inventoryModal')
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#inventoryModal')
                    });
                }
            });

            count++;
        });

        $('#inventoryModal').modal('show');
    });
});

$('#make-non-inventory, #make-service, #make-inactive, #make-active').on('click', function (e) {
    e.preventDefault();

    var action = $(this).attr('id');
    var actionText = '';
    var actionTitle = '';

    switch (action) {
        case 'make-non-inventory':
            actionTitle = 'Change to Non-Inventory';
            actionText = 'make non-inventory';
            break;
        case 'make-service':
            actionTitle = 'Change to Services';
            actionText = 'make service';
            break;
        case 'make-inactive':
            actionTitle = 'Change to Inactive';
            actionText = 'make inactive';
            break;
        case 'make-active':
            actionTitle = 'Change to Active';
            actionText = 'make active';
            break;
    }

    var checkedItems = $('#items-table tbody tr:visible .select-one:checked');

    Swal.fire({
        title: actionTitle,
        text: `This action will ${actionText} for selected items.`,
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: `products-and-services/batch-action/${action}`,
                data: data,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (result) {
                    Swal.fire({
                        title: actionTitle,
                        text: "Data was successfully updated!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
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

$('#items-table .make-inactive').on('click', function (e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var name = row.find('td:nth-child(2)').html().trim();
    var type = row.find('td:nth-child(4)').html().trim();

    Swal.fire({
        title: 'Change to Inactive',
        html: `You want to make <b>${name}</b> inactive?`,
        icon: 'question',
        showCloseButton: false,
        confirmButtonColor: '#6a4a86',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${base_url}/accounting/products-and-services/inactive/${type.toLowerCase()}/${row.find('.select-one').val()}`,
                type: 'DELETE',
                success: function (result) {
                    Swal.fire({
                        title: 'Change to Inactive',
                        html: "Data was successfully updated!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });                    
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

$('#items-table .duplicate').on('click', function (e) {
    e.preventDefault();

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
    if (this.checked) {
        $('.check-input-product-category').each(function() {
            this.checked = true;
        });
        $(".dropdown-item-delete").removeClass("disabled");
    } else {
        $('.check-input-product-category').each(function() {
            this.checked = false;
        });
        $('.dropdown-item-delete').addClass('disabled');
    }
});

$(".check-input-product-category").click(function() {
    var count_list_check = $('.check-input-product-category').filter(':checked').length;
    if (count_list_check > 0) {
        $(".dropdown-item-delete").removeClass("disabled");
    } else {
        $('.dropdown-item-delete').addClass('disabled');
    }
    $('.check-input-all-product-category').each(function() {
        this.checked = false;
    });    
      
})
