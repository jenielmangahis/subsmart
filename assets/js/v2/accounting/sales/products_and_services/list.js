$('.dropdown-menu.table-settings, .dropdown-menu.table-filter').on('click', function (e) {
    e.stopPropagation();
});

$("#items-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function () {
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
        data: function (params) {
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

$("#search_field").on("input", debounce(function () {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function () {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#items-table thead td[data-name="${dataName}"]`).index();
    $(`#items-table tr`).each(function () {
        if (chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_items_modal table tr`).each(function () {
        if (chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_items_modal #items_table_print tr`).each(function () {
        if (chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_items").on("click", function () {
    $("#items_table_print").printThis();
});

$('#apply-button').on('click', function () {
    var filterStatus = $('#filter-status').val();
    var filterType = $('#filter-type').val();
    var filterCategory = $('#filter-category').val();
    var filterStockStat = $('#filter-stock-status').val();
    var groupByCat = $('#group-by-category');
    var search = $('#search_field').val();

    var url = `${base_url}accounting/products-and-services?`;

    url += search !== '' ? `search=${search}&` : '';
    url += filterStatus !== 'active' ? `status=${filterStatus}&` : '';
    url += filterType !== 'all' ? `type=${filterType}&` : '';
    if (filterCategory && filterCategory.length > 0) {
        var categoryNames = filterCategory.map(function (categoryId) {
            var categoryName = $('#filter-category option[value="' + categoryId + '"]').text().trim();
            return encodeURIComponent(categoryName);
        });

        url += `category=${categoryNames.join(',')}&`;

        if ($('#filter-category option').length !== $('#filter-category option:selected').length && $('#filter-category option:selected').length > 0) {
            var categoryFilter = filterCategory.join(',');
            url += `category=${encodeURIComponent(categoryFilter)}&`;
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
});

$(document).on('change', '#items-table tbody tr:visible .select-one', function () {
    var checked = $('#items-table tbody tr:visible input.select-one:checked');
    var totalrows = $('#items-table tbody tr:visible input.select-one').length;

    $('#items-table thead .select-all').prop('checked', checked.length === totalrows);

    if (checked.length < 1) {
        $('.batch-actions li a.dropdown-item').addClass('disabled');
    } else {
        var inactiveChecked = $('#items-table tbody tr:visible[data-status="0"] input.select-one:checked').length;

        if (inactiveChecked < 1) {
            $('.batch-actions li a#assign-category').removeClass('disabled');
            $('.batch-actions li a#make-inactive').removeClass('disabled');

            var activeChecked = $('#items-table tbody tr:visible[data-status="1"] input.select-one:checked');

            var allNonInv = true;
            var allService = true;
            var allInv = true;
            activeChecked.each(function () {
                var row = $(this).closest('tr');
                var type = row.find('td:nth-child(4)').html().trim();

                if (type !== 'Non-inventory') {
                    allNonInv = false;
                }

                if (type !== 'Service') {
                    allService = false;
                }

                if (type !== 'Product') {
                    allInv = false;
                }
            });

            if (allNonInv) {
                $('.batch-actions li a#make-service').removeClass('disabled');
            } else {
                $('.batch-actions li a#make-service').addClass('disabled');
            }

            if (allService) {
                $('.batch-actions li a#make-non-inventory').removeClass('disabled');
            } else {
                $('.batch-actions li a#make-non-inventory').addClass('disabled');
            }

            if (allInv) {
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

$('#assign-category').on('click', function (e) {
    e.preventDefault();

    $('#assign_category_modal').modal('show');
});

$(document).on('submit', '#assign-category-form', function (e) {
    e.preventDefault();

    var data = new FormData();

    $('#items-table tbody tr:visible input.select-one:checked').each(function () {
        var row = $(this).closest('tr');

        data.append('items[]', $(this).val());
    });

    $.ajax({
        url: `/accounting/products-and-services/assign-category/${$('#category-id').val()}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (result) {
            location.reload();
        }
    });
});

$('#reorder').on('click', function (e) {
    e.preventDefault();

    var data = new FormData();
    $('#items-table tbody tr:visible .select-one:checked').each(function () {
        data.append('items[]', $(this).val());
    });

    $.ajax({
        url: '/accounting/products-and-services/reorder-items',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function (res) {
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

$('#adjust-quantity').on('click', function (e) {
    e.preventDefault();


    $.get(`${base_url}accounting/get-other-modals/inventory_qty_modal`, function (res) {

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

$('#make-non-inventory, #make-service, #make-inactive').on('click', function (e) {
    e.preventDefault();

    var action = $(this).attr('id');
    var actionText = '';

    switch (action) {
        case 'make-non-inventory':
            actionText = 'make non-inventory';
            break;
        case 'make-service':
            actionText = 'make service';
            break;
        case 'make-inactive':
            actionText = 'make inactive';
            break;
    }

    var checkedItems = $('#items-table tbody tr:visible .select-one:checked');

    Swal.fire({
        title: 'Are you sure?',
        text: `This action will ${actionText} for selected items.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6a4a86',
        confirmButtonText: `Yes, ${actionText}`
    }).then((result) => {
        if (result.isConfirmed) {
            var data = new FormData();
            var items = [];

            checkedItems.each(function () {
                items.push($(this).val());
            });

            data.append('items', JSON.stringify(items));

            $.ajax({
                url: `products-and-services/batch-action/${action}`,
                data: data,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (result) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});

$('.export-items').on('click', function () {
    if ($('#export-form').length < 1) {
        $('body').append('<form action="/accounting/products-and-services/export-table" method="post" id="export-form"></form>');
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function () {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('_chk', '')}">`);
    });

    $('#export-form').append(`<input type="hidden" name="search" value="${$('#search_field').val()}">`);
    $('#export-form').append(`<input type="hidden" name="status" value="${$('#filter-status').val()}">`);
    $('#export-form').append(`<input type="hidden" name="type" value="${$('#filter-type').val()}">`);
    $('#export-form').append(`<input type="hidden" name="stock_status" value="${$('#filter-stock-status').val()}">`);

    $.each($('#filter-category').val(), function (key, value) {
        $('#export-form').append(`<input type="hidden" name="category[]" value="${value}">`);
    });

    $('#export-form').append(`<input type="hidden" name="column" value="name">`);
    $('#export-form').append(`<input type="hidden" name="order" value="asc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function (e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$('.nsm-counter').on('click', function () {
    if ($(this).hasClass('selected')) {
        $('#filter-stock-status').val('all').trigger('change');
    } else {
        $('#filter-stock-status').val($(this).attr('id')).trigger('change');
    }

    $('#apply-button').trigger('click');
});

$('#add-item-button').on('click', function (e) {
    e.preventDefault();

    $.get(`${base_url}accounting/get-dropdown-modal/item_modal?field=product`, function (result) {
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

$('#group-by-category').on('change', function () {
    var currUrl = window.location.href;

    if ($(this).prop('checked')) {
        if (currUrl.slice(-1) === '#') {
            currUrl = currUrl.slice(0, -1);
        }

        var urlSplit = currUrl.split('/');
        var queries = urlSplit[urlSplit.length - 1].split('?');

        if (queries.length > 1) {
            queries = queries[queries.length - 1];

            if (queries.slice(-1) === '#') {
                queries = queries.slice(0, -1);
            }

            if (queries.slice(-1) === '&') {
                queries = queries.slice(0, -1);
            }

            queries += '&group-by-category=1';

            var url = `${base_url}accounting/products-and-services?${queries}`;
        } else {
            var url = `${base_url}accounting/products-and-services?group-by-category=1`;
        }
    } else {
        var url = currUrl.replace('group-by-category=1', '');

        if (url.slice(-1) === '#') {
            url = url.slice(0, -1);
        }

        if (url.slice(-1) === '&') {
            url = url.slice(0, -1);
        }

        if (url.slice(-1) === '?') {
            url = url.slice(0, -1);
        }
    }

    location.href = url;
});

$('#items-table .make-active').on('click', function (e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var name = row.find('td:nth-child(2)').html().trim();
    var type = row.find('td:nth-child(4)').html().trim();

    Swal.fire({
        title: 'Are you sure?',
        html: `You want to make <b>${name}</b> active?`,
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
                url: `${base_url}/accounting/products-and-services/active/${type.toLowerCase()}/${row.find('.select-one').val()}`,
                type: 'GET',
                success: function (result) {
                    location.reload();
                }
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
        title: 'Are you sure?',
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
                    location.reload();
                }
            });
        }
    });
});

$('#items-table .duplicate').on('click', function (e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var type = row.find('td:nth-child(4)').html().trim();
    type = type.toLowerCase();

    $.get('/accounting/item-form/' + type, function (result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`<div class="full-screen-modal">
				<div class="modal-right-side">
                    <div class="modal right fade nsm-modal" tabindex="-1" id="item-modal" role="dialog">
						<div class="modal-dialog" role="document" style="width: 25%">
							<div class="modal-content">
								${result}
							</div>
						</div>
					</div>
				</div>
			</div>`);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    <div class="full-screen-modal">
						<div class="modal-right-side">
                            <div class="modal right fade nsm-modal" tabindex="-1" id="item-modal" role="dialog">
								<div class="modal-dialog" role="document" style="width: 25%">
									<div class="modal-content">
                        				${result}
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            `);
        }

        $(`#item-modal a#select-item-type`).attr('onclick', `changeType('')`);

        $('#modal-container #item-modal .date').datepicker({
            format: 'mm/dd/yyyy',
            orientation: 'bottom',
            autoclose: true
        });

        $('#item-modal select').each(function () {
            var dropdownType = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');

            if (dropdownFields.includes(dropdownType)) {
                $(this).select2({
                    ajax: {
                        url: `${base_url}/accounting/get-dropdown-choices`,
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: dropdownType,
                                modal: 'item-modal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#item-modal')
                });
            } else {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#item-modal')
                });
            }
        });

        occupyFields(row.data().id, type, 'duplicate');

        $(`#item-modal form`).attr('id', 'duplicate-item-form');

        $(`#modal-container #item-modal`).attr('data-bs-backdrop', 'static');
        $(`#modal-container #item-modal`).attr('data-bs-keyboard', 'false');

        $(`#modal-container #item-modal`).modal('show');
    });
});

$('#items-table .edit-item').on('click', function (e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var type = row.find('td:nth-child(4)').html().trim();
    type = type.toLowerCase();

    $.get(base_url + 'accounting/item-form/' + type, function (result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`<div class="full-screen-modal">
				<div class="modal-right-side">
                    <div class="modal right fade nsm-modal" tabindex="-1" id="item-modal" role="dialog">
						<div class="modal-dialog" role="document" style="width: 25%">
							<div class="modal-content">
								${result}
							</div>
						</div>
					</div>
				</div>
			</div>`);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    <div class="full-screen-modal">
						<div class="modal-right-side">
                            <div class="modal right fade nsm-modal" tabindex="-1" id="item-modal" role="dialog">
								<div class="modal-dialog" role="document" style="width: 25%">
									<div class="modal-content">
                        				${result}
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            `);
        }

        $('#modal-container #item-modal .date').datepicker({
            format: 'mm/dd/yyyy',
            orientation: 'bottom',
            autoclose: true
        });

        $('#item-modal select').each(function () {
            var dropdownType = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');

            if (dropdownFields.includes(dropdownType)) {
                $(this).select2({
                    ajax: {
                        url: '/accounting/get-dropdown-choices',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                search: params.term,
                                type: 'public',
                                field: dropdownType,
                                modal: 'item-modal'
                            }

                            // Query parameters will be ?search=[term]&type=public&field=[type]
                            return query;
                        }
                    },
                    templateResult: formatResult,
                    templateSelection: optionSelect,
                    dropdownParent: $('#item-modal')
                });
            } else {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    dropdownParent: $('#item-modal')
                });
            }
        });

        if (type === 'product' || type === 'bundle') {
            $('#item-modal a#select-item-type').remove();
        } else {
            $(`#item-modal a#select-item-type`).attr('onclick', `changeType('${type}')`);
        }

        occupyFields(row.data().id, type);

        $('#item-modal label[for="asOfDate"]').parent().parent().remove();

        var qtyPo = parseInt($('#qty_po').text().trim() || '0');
        // var qtyPo = row.find('td:nth-child(14)').html().trim() !== '' ? row.find('td:nth-child(14)').html().trim() : 0;

        $(`<div class="row">
			<div class="col-6">
				<label for="">Quantity on hand</label>
				<p class="m-0">Adjust: <a class="text-decoration-none adjust-quantity" href="#">Quantity</a> | <a class="text-decoration-none adjust-starting-value" href="#">Starting value</a></p>
			</div>
			<div class="col-6">
				<p class="text-end m-0">${row.find('td:nth-child(13)').html()}</p>
			</div>
		</div>`).insertAfter('#item-modal #storage-locations');
        $('#item-modal #storage-locations').parent().append(`<div class="row">
			<div class="col-6">
				<label for="">Quantity on PO</label>
			</div>
			<div class="col-6">
				<p class="text-end m-0">${qtyPo}</p>
			</div>
		</div>`);
        $('#item-modal #storage-locations').remove();

        $('#item-modal form').attr('id', `update-${type}-form`);
        $(`#item-modal form`).attr('action', `${base_url}/accounting/products-and-services/update/${type}/${row.find('.select-one').val()}`);

        $(`#modal-container #item-modal`).attr('data-bs-backdrop', 'static');
        $(`#modal-container #item-modal`).attr('data-bs-keyboard', 'false');

        $(`#modal-container #item-modal`).modal('show');
    });
});

function occupyFields(id, type, action = 'edit') {
    $.get(`${base_url}accounting/products-and-services/get-item-details/${type}/${id}`, function (result) {
        var item = JSON.parse(result);

        var name = action === 'duplicate' ? item.name + ' - copy' : item.name;
        $(`#item-modal #name`).val(name);
        $(`#item-modal #sku`).val(item.sku);
        $(`#item-modal #upc`).val(item.upc);

        if (item.category !== null && item.category !== "") {
            $(`#item-modal #category`).append(`<option value="${item.category_id}" selected>${item.category}</option>`);
        }

        $(`#item-modal #rebate-item`).prop('checked', item.rebate === '1');
        $(`#item-modal #asOfDate`).val(item.as_of_date);
        $(`#item-modal #reorderPoint`).val(item.reorder_point);

        if (item.inventory_account !== null && item.inventory_account !== "") {
            $(`#item-modal #inv_asset_account`).append(`<option value="${item.inventory_account_id}" selected>${item.inventory_account}</option>`);
        }

        $(`#item-modal #description`).val(item.sales_desc);
        $(`#item-modal #price`).val(item.sales_price);

        if (item.income_account !== null && item.income_account !== "") {
            $(`#item-modal #income_account`).append(`<option value="${item.income_account_id}" selected>${item.income_account}</option>`);
        }

        if (item.sales_tax_cat !== null && item.sales_tax_cat !== "") {
            $(`#item-modal #sales_tax_category`).append(`<option value="${item.sales_tax_cat_id}" selected>${item.sales_tax_cat}</option>`);
        }

        if (item.expense_account_id !== "") {
            $(`#item-modal #purchasing`).prop('checked', true).trigger('change');
        }

        $(`#item-modal #purchaseDescription`).val(item.purch_desc);
        $(`#item-modal #cost`).val(item.cost);

        if (item.expense_account !== null && item.expense_account !== "") {
            $(`#item-modal #item_expense_account`).append(`<option value="${item.expense_account_id}" selected>${item.expense_account}</option>`);
        }

        if (item.icon !== null && item.icon !== "" && action === 'edit') {
            $(`#item-modal img.image-prev`).attr('src', `${item.icon}`);
            $(`#item-modal img.image-prev`).parent().addClass('d-flex justify-content-center');
            $(`#item-modal img.image-prev`).parent().removeClass('d-none');
            $(`#item-modal img.image-prev`).parent().prev().addClass('d-none');
        }

        if (item.display_on_print === "1" || item.display_on_print === 1) {
            $('#item-modal #displayBundle').prop('checked', true);
        }

        if (item.vendor !== null && item.vendor !== "") {
            $(`#item-modal #vendor`).append(`<option value="${item.vendor_id}" selected>${item.vendor}</option>`);
        }

        for (i in item.locations) {
            if ($($(`#item-modal #storage-locations tbody tr`)[i]).length < 1) {
                $(`#item-modal #storage-locations tbody`).append(`
                <tr>
                    <td></td>
                    <td></td>
                    <td><button type="button" class="nsm-button delete-location"><i class='bx bx-fw bx-trash'></i></button></td>
                </tr>
                `);
            }
            $($(`#item-modal #storage-locations tbody tr`)[i]).children('td:first-child').html(`<input type="text" name="location_name[]" class="form-control nsm-field" value="${item.locations[i].name}">`);
            $($(`#item-modal #storage-locations tbody tr`)[i]).children('td:nth-child(2)').html(`<input type="number" name="quantity[]" class="text-end form-control nsm-field" value="${item.locations[i].qty}">`);
        }

        for (i in item.bundle_items) {
            if ($($('#item-modal #bundle-items-table tbody tr')[i]).length > 0) {
                $($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-item', `${item.bundle_items[i].item_id}`);
                $($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-name', `${item.bundle_items[i].name}`);
                $($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-quantity', `${item.bundle_items[i].quantity}`);
                $($('#item-modal #bundle-items-table tbody tr')[i]).children('td:first-child').html(`
                <span>${item.bundle_items[i].name}</span>
                <input type="hidden" value="${item.bundle_items[i].item_id}" name="item_id[]">
                `);
                $($('#item-modal #bundle-items-table tbody tr')[i]).children('td:nth-child(2)').html(`
                <span>${item.bundle_items[i].quantity}</span>
                <input type="number" name="quantity[]" class="text-end form-control nsm-field d-none" value="${item.bundle_items[i].quantity}">
                `);
            } else {
                $('#item-modal #bundle-items-table tbody').append(`
                <tr data-item="${item.bundle_items[i].item_id}" data-name="${item.bundle_items[i].name}" data-quantity="${item.bundle_items[i].quantity}">
                    <td>
                        <span>${item.bundle_items[i].name}</span>
                        <input type="hidden" value="${item.bundle_items[i].item_id}" name="item_id[]">
                    </td>
                    <td>
                        <span>${item.bundle_items[i].quantity}</span>
                        <input type="number" name="quantity[]" class="text-end form-control nsm-field d-none" value="${item.bundle_items[i].quantity}">
                    </td>
                    <td><button type="button" class="nsm-button delete-item"><i class='bx bx-fw bx-trash'></i></button></td>
                </tr>
                `);
            }
        }
    });
}

$('#items-table .see-item-locations').on('click', function (e) {
    e.preventDefault();

    var itemId = $(this).closest('tr').find('.select-one').val();

    $.get(`${base_url}accounting/products-and-services/get-item-locations/${itemId}`, function (result) {
        var locations = JSON.parse(result);

        $('#item-locations-modal #item-locations-table tbody').empty();

        if (locations.length > 0) {
            for (var i = 0; i < locations.length; i++) {
                var location = locations[i];

                $('#item-locations-modal #item-locations-table tbody').append(`
                    <tr>
                        <td class="d-none">${itemId}</td>
                        <td>${location.name}</td>
                        <td>${location.qty}</td>
                    </tr>
                `);
            }
        } else {
            $('#item-locations-modal #item-locations-table tbody').append(`
                <tr>
                    <td colspan="3">
                        <div class="nsm-empty">
                            <span>No results found.</span>
                        </div>
                    </td>
                </tr>
            `);
        }

        $('#item-locations-modal').modal('show');
    });
});

$('#item-locations-modal').on('hidden.bs.modal', function () {
    $(this).find('#item-locations-table').find('tbody').html(`<tr>
        <td colspan="3">
            <div class="nsm-empty">
                <span>No results found.</span>
            </div>
        </td>
    </tr>`);
});

const $overlay = document.getElementById('overlay');
$("#import-items-modal #file-upload").change(function () {
    const formData = new FormData();
    const fileInput = document.getElementById('file-upload');
    formData.append('file', fileInput.files[0]);

    if ($overlay) $overlay.style.display = "flex";
    fetch(base_url + 'accounting/products-and-services/get-import-data', {
        method: 'POST',
        body: formData
    }).then(response => response.json()).then(response => {
        var { data, headers, success, message } = response;
        if ($overlay) $overlay.style.display = "none";
        if (!success) {
            sweetAlert('Sorry!', 'error', message);
        } else {
            $.each(headers, function (i, o) {
                $('#import-items-modal .headersSelector').append(
                    '<option value="' + i + '">' + o + '</option>'
                );
                $('#import-items-modal #tableHeader').append(
                    '<th><strong>' + o + '</strong></th>'
                );
            });
            csvHeaders = headers;
            itemsData = data; // save customer array data
            // process mapping preview
            $.each(data, function (i, o) {
                var toAppend = '';
                $.each(o, function (index, data) {
                    toAppend += '<td>' + data + '</td>';
                });
                $('#import-items-modal #imported_items').append(
                    '<tr>' + toAppend + '</tr>'
                );
            });

            $('#import-items-modal #nextBtn1').prop("disabled", false);
        }
    }).catch((error) => {
        console.log('Error:', error);
    });
});

$(document).on('click', "#import-items-modal .step", function () {
    $(this).addClass("active").prevAll().addClass("active");
    $(this).nextAll().removeClass("active");
});

$(document).on('click', "#import-items-modal .step01", function () {
    $("#import-items-modal #line-progress").css("width", "8%");
    $("#import-items-modal .step1").addClass("active").siblings().removeClass("active");
});

$(document).on('click', "#import-items-modal .step02", function () {
    $("#import-items-modal #line-progress").css("width", "50%");
    $("#import-items-modal .step2").addClass("active").siblings().removeClass("active");

    $('#import-items-modal .modal-footer').html(`<button type="button" class="nsm-button step01">Back</button>
    <button type="button" class="nsm-button primary step03">Next</button>`);
});

$(document).on('click', "#import-items-modal .step03", function () {
    $("#import-items-modal #line-progress").css("width", "100%");
    $("#import-items-modal .step3").addClass("active").siblings().removeClass("active");

    $('#import-items-modal .modal-footer').html(`<button type="button" class="nsm-button step02">Back</button>
    <button type="button" class="nsm-button primary" id="importItem">Import</button>`);
});

$(document).on('click', "#import-items-modal #importItem", function (e) {
    // prepare form data to be posted

    var selectedHeader = [];
    $('#import-items-modal select[name="headers[]"]').each(function () {
        selectedHeader.push(this.value);
    });

    const formData = new FormData();
    formData.append('items', JSON.stringify(itemsData));
    formData.append('mapHeaders', JSON.stringify(selectedHeader));
    formData.append('csvHeaders', JSON.stringify(csvHeaders));

    if ($overlay) $overlay.style.display = "flex";
    // perform post request
    fetch(base_url + 'accounting/products-and-services/import-items-data', {
        method: 'POST',
        body: formData,
    }).then(response => response.json()).then(response => {
        if ($overlay) $overlay.style.display = "none";
        var { customer, csv, mapping, fields, dataValue, office, billing, profile, message, success } = response;
        if (success) {
            sweetAlert('Awesome!', 'success', message, 1);
        } else {
            sweetAlert('Sorry!', 'error', message);
        }

        console.log(response);
    }).catch((error) => {
        console.log('Error:', error);
    });
});

function sweetAlert(title, icon, information, is_reload) {
    Swal.fire({
        title: title,
        text: information,
        icon: icon,
        showCancelButton: false,
        confirmButtonColor: '#6a4a86',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (is_reload === 1) {
            if (result.value) {
                window.location.reload();
            }
        }
    });
}

function test() {
    var selectedHeader = [];
    var head = [];
    $('#import-items-modal select[name="headers[]"]').each(function () {
        selectedHeader.push(this.value);
    });
    var ar = selectedHeader.length;
    for (var x = 0; x < ar; x++) {
        head.push(x);
    }

    var arHead = head.length;

    for (var x = 0; x < ar; x++) {
        if (selectedHeader[x] != "") {
            document.getElementById('headersSelector' + x).value = selectedHeader[x];
            var text = "headersSelector" + x + "";
            for (var i = 0; i < arHead; i++) {
                var text1 = "headersSelector" + i + "";
                if (text != text1) {
                    $("#headersSelector" + i + " option[value='" + selectedHeader[x] + "'").remove();
                }
            }
        }
    }
}

function changeType(type) {
    var form = $('#item-modal form');
    itemFormData = new FormData(document.getElementById(form.attr('id')));
    itemFormData.set('type', type);
    if (form.attr('id').includes('update')) {
        var action = form.attr('action');
        var itemId = action.split('/');
        itemId = itemId[itemId.length - 1];
        itemFormData.set('id', itemId);
    }

    $.get(`${base_url}accounting/get-dropdown-modal/item_modal?field=${type}`, function (result) {
        $('#modal-container .full-screen-modal').append(result);

        itemTypeSelection = $('#modal-container .full-screen-modal .modal-right-side:last-child() .modal').find('.modal-content').html();
        $('#modal-container .full-screen-modal .modal-right-side:last-child()').remove();

        $('#modal-container #item-modal .modal-content').html(itemTypeSelection);
    });
}