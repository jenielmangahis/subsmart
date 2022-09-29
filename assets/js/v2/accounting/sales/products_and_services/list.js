$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function(e) {
    e.stopPropagation();
});

$("#items-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#items-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('#filter-status, #filter-type, #filter-stock-status').select2({
    minimumResultsForSearch: -1
});

$('#filter-category').select2({
	allowClear: true
});

$('#category-id').select2({
	placeholder: "Assign category",
	ajax: {
		url: '/accounting/get-dropdown-choices',
		dataType: 'json',
		data: function(params) {
			var query = {
				search: params.term,
				type: 'public',
				field: 'category',
				field_id: 'assign-category'
			}

			// Query parameters will be ?search=[term]&type=public&field=[type]
			return query;
		}
	},
	templateResult: formatResult,
	templateSelection: optionSelect,
    dropdownParent: $('#assign_category_modal')
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#items-table thead td[data-name="${dataName}"]`).index();
    $(`#items-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_items_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_items_modal #items_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_items").on("click", function() {
    $("#items_table_print").printThis();
});

$('#apply-button').on('click', function() {
    var filterStatus = $('#filter-status').val();
    var filterType = $('#filter-type').val();
    var filterCategory = $('#filter-category').val();
    var filterStockStat = $('#filter-stock-status').val();

    var url = `${base_url}accounting/products-and-services?`;

    url += filterStatus !== 'active' ? `status=${filterStatus}&` : '';
    url += filterType !== 'all' ? `type=${filterType}&` : '';
    url += $('#filter-category option').length !== $('#filter-category option:selected').length && $('#filter-category option:selected').length > 0 ? `category=${filterCategory}&` : '';
    url += filterStockStat !== 'all' ? `stock-status=${filterStockStat}` : '';

    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }

    location.href = url;
});

$('#reset-button').on('click', function() {
    location.href = `${base_url}accounting/products-and-services`;
});

$('#items-table thead .select-all').on('change', function() {
    $('#items-table tbody tr:visible .select-one').prop('checked', $(this).prop('checked')).trigger('change');
});

$(document).on('change', '#items-table tbody tr:visible .select-one', function() {
    var checked = $('#items-table tbody tr:visible input.select-one:checked');
    var totalrows = $('#items-table tbody tr:visible input.select-one').length;

    $('#items-table thead .select-all').prop('checked', checked.length === totalrows);

    if(checked.length < 1) {
        $('.batch-actions li a.dropdown-item').addClass('disabled');
    } else {
        var inactiveChecked = $('#items-table tbody tr:visible[data-status="0"] input.select-one:checked').length;

        if(inactiveChecked < 1) {
            $('.batch-actions li a#assign-category').removeClass('disabled');
            $('.batch-actions li a#make-inactive').removeClass('disabled');

            var activeChecked = $('#items-table tbody tr:visible[data-status="1"] input.select-one:checked');

            var allNonInv = true;
            var allService = true;
            var allInv = true;
            activeChecked.each(function() {
                var row = $(this).closest('tr');
                var type = row.find('td:nth-child(4)').html().trim();

                if(type !== 'Non-inventory') {
                    allNonInv = false;
                }

                if(type !== 'Service') {
                    allService = false;
                }

                if(type !== 'Product') {
                    allInv = false;
                }
            });

            if(allNonInv) {
                $('.batch-actions li a#make-service').removeClass('disabled');
            } else {
                $('.batch-actions li a#make-service').addClass('disabled');
            }

            if(allService) {
                $('.batch-actions li a#make-non-inventory').removeClass('disabled');
            } else {
                $('.batch-actions li a#make-non-inventory').addClass('disabled');
            }

            if(allInv) {
                $('.batch-actions li a#adjust-quantity').removeClass('disabled');
                $('.batch-actions li a#reorder').removeClass('disabled');
            } else {
                $('.batch-actions li a#adjust-quantity').addClass('disabled');
                $('.batch-actions li a#reorder').addClass('disabled');
            }
        } else {
            $('.batch-actions li a.dropdown-item').addClass('disabled');
        }
    }
});

$('#assign-category').on('click', function(e) {
    e.preventDefault();

    $('#assign_category_modal').modal('show');
});

$(document).on('submit', '#assign-category-form', function(e) {
    e.preventDefault();

    var data = new FormData();

    $('#items-table tbody tr:visible input.select-one:checked').each(function() {
        var row = $(this).closest('tr');

        data.append('items[]', $(this).val());
    });

    $.ajax({
        url: `/accounting/products-and-services/assign-category/${$('#category-id').val()}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('#reorder').on('click', function(e) {
    e.preventDefault();

    var data = new FormData();
    $('#items-table tbody tr:visible .select-one:checked').each(function() {
        data.append('items[]', $(this).val());
    });

    $.ajax({
        url: '/accounting/products-and-services/reorder-items',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            initModalFields('purchaseOrderModal');

		    $(`#purchaseOrderModal`).modal('show');
        }
    })
});

$('#adjust-quantity').on('click', function(e) {
    e.preventDefault();

    $.get('/accounting/get-other-modals/inventory_qty_modal', function(res) {
		if ($('div#modal-container').length > 0) {
			$('div#modal-container').html(res);
		} else {
			$('body').append(`
				<div id="modal-container"> 
					${res}
				</div>
			`);
		}

        initModalFields('inventoryModal');

        var count = 1;
        $('#items-table tbody tr:visible .select-one:checked').each(function() {
            if($(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count})`).length < 1) {
                $(`#inventoryModal #inventory-adjustments-table tbody`).append('<tr></tr>');   
            }

            $(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count})`).html(rowInputs);
            $(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count}) td:nth-child(1)`).html(count);

            $(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count})`).find('select[name="product[]"]').html(`<option value="${$(this).val()}">${$(this).closest('tr').find('td:nth-child(2)').html().trim()}</option>`).trigger('change');

            $(`#inventoryModal #inventory-adjustments-table tbody tr:nth-child(${count})`).find('select').each(function() {
                var type = $(this).attr('id');
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
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: 'inventoryModal'
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
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

$('#make-non-inventory, #make-service, #make-inactive').on('click', function(e) {
    e.preventDefault();

    var action = $(this).attr('id');

    var data = new FormData();

	var items = [];
    $('#items-table tbody tr:visible .select-one:checked').each(function() {
        items.push($(this).val());
    });

	data.append('items', JSON.stringify(items));

    $.ajax({
		url: `products-and-services/batch-action/${action}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
		success: function(result) {
			location.reload();
		}
	});
});

$('.export-items').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append('<form action="/accounting/products-and-services/export-table" method="post" id="export-form"></form>');
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('_chk', '')}">`);
    });

    $('#export-form').append(`<input type="hidden" name="search" value="${$('#search_field').val()}">`);
    $('#export-form').append(`<input type="hidden" name="status" value="${$('#filter-status').val()}">`);
    $('#export-form').append(`<input type="hidden" name="type" value="${$('#filter-type').val()}">`);
    $('#export-form').append(`<input type="hidden" name="stock_status" value="${$('#filter-stock-status').val()}">`);

    $.each($('#filter-category').val(), function(key, value) {
        $('#export-form').append(`<input type="hidden" name="category[]" value="${value}">`);
    });

    $('#export-form').append(`<input type="hidden" name="column" value="name">`);
    $('#export-form').append(`<input type="hidden" name="order" value="asc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$('.nsm-counter').on('click', function() {
    if($(this).hasClass('selected')) {
        $('#filter-stock-status').val('all').trigger('change');
    } else {
        $('#filter-stock-status').val($(this).attr('id')).trigger('change');
    }

    $('#apply-button').trigger('click');
});

$('#add-item-button').on('click', function(e) {
    e.preventDefault();

    $.get(`/accounting/get-dropdown-modal/item_modal?field=product`, function(result) {
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

        $(`#modal-container #item-modal`).attr('data-bs-backdrop', 'static');
        $(`#modal-container #item-modal`).attr('data-bs-keyboard', 'true');

		$(`#modal-container #item-modal`).modal('show');
	});
});