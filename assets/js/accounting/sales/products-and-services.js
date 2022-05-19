let form = new FormData();
let rowData = {};
function col(el)
{
	var className = $(el).attr('id');
	className = className.replace('chk_', '');

	if($(el).prop('checked') === true) {
		$(`#products-services-table .${className}`).show();
	} else {
		$(`#products-services-table .${className}`).hide();
	}
}

function applybtn()
{
	$('#products-services-table').DataTable().ajax.reload();
}

function resetbtn()
{
	$('#status').val('active');
	$('#type').val('all');
	$('#category option').each(function() {
		$(this).prop('selected', true);
	});
	$('#category').trigger('change');
	$('#stock_status').val('all');

	applybtn();
}

function selectType(type)
{
	$(`#${type}-form-modal`).modal('hide');
	$('#type-selection-modal table tbody tr:last-child').show();
	$('#type-selection-modal').modal('show');
}

function changeType(type)
{
	var action = $(`#${type}-item-form`).attr('action');
	var formId = $(`#${type}-item-form`).attr('id');
	form = new FormData(document.getElementById(`${type}-item-form`));
	$(`#${type}-form-modal`).modal('hide');
	$('#type-selection-modal').modal('show');
	$('#type-selection-modal table tbody tr:last-child').hide();

	$(document).on('show.bs.modal', '#inventory-form-modal, #non-inventory-form-modal, #service-form-modal', function() {
		var modalId = $(this).attr('id');
		switch(modalId) {
			case 'inventory-form-modal' :
				action = action.replace('/'+type, '/inventory');
				type = 'inventory';
			break;
			case 'non-inventory-form-modal' :
				action = action.replace('/'+type, '/non-inventory');
				type = 'non-inventory';
			break;
			case 'service-form-modal' :
				action = action.replace('/'+type, '/service');
				type = 'service';
			break;
		}

		$(this).find('form').attr('action', action);
		$(this).find('form').attr('id', `${type}-item-form`);
		if(form.has('name')) {
			for(var data  of form.entries()) {
				if(data[0] !== 'icon') {
					$(this).find(`[name="${data[0]}"]`).val(data[1]).trigger('change');
				} else {
					if(rowData.icon !== null && rowData.icon !== "") {
						$(this).find('img.image-prev').attr('src', `/uploads/${rowData.icon}`);
						$(this).find('img.image-prev').parent().addClass('d-flex justify-content-center');
						$(this).find('img.image-prev').parent().removeClass('hide');
						$(this).find('img.image-prev').parent().prev().addClass('hide');
					}
				}
			}

			if(form.has('selling')) {
				$(this).find('#selling').prop('checked', true).trigger('change');
			}

			if(form.has('purchasing')) {
				$(this).find('#purchasing').prop('checked', true).trigger('change');
			}
		}

		form = new FormData();
	});
}

function removeIcon()
{
	$('.modal-right-side input#icon').val('').trigger('change');
}

function occupyFields(rowData, type, action = 'edit')
{
	var name = action === 'duplicate' ? rowData.name+' - copy' : rowData.name;
	$(`#${type}-form-modal #name`).val(name);
	$(`#${type}-form-modal #sku`).val(rowData.sku);
	$(`#${type}-form-modal #category`).val(rowData.category_id);
	$(`#${type}-form-modal #rebate-item`).prop('checked', rowData.rebate === '1');
	$(`#${type}-form-modal #reorderPoint`).val(rowData.reorder_point);
	$(`#${type}-form-modal #description`).val(rowData.sales_desc);
	$(`#${type}-form-modal #price`).val(rowData.sales_price);
	if(rowData.purch_desc !== null && rowData.purch_desc !== "") {
		$(`#${type}-form-modal #purchasing`).prop('checked', true).trigger('change');
	}
	$(`#${type}-form-modal #purchaseDescription`).val(rowData.purch_desc);
	$(`#${type}-form-modal #cost`).val(rowData.cost);
	$(`#${type}-form-modal #vendor`).val(rowData.vendor_id);
	$(`#${type}-form-modal #salesTaxCat`).val(rowData.sales_tax_cat).trigger('change');
	$(`#${type}-form-modal #incomeAccount option`).each(function() {
		if($(this).html() === rowData.income_account) {
			$(this).parent().val($(this).attr('value'));
		}
	});
	$(`#${type}-form-modal #expenseAcc option`).each(function() {
		if($(this).html() === rowData.expense_account) {
			$(this).parent().val($(this).attr('value'));
		}
	});
	$(`#${type}-form-modal #invAssetAcc option`).each(function() {
		if($(this).html() === rowData.inventory_account) {
			$(this).parent().val($(this).attr('value'));
		}
	});
	if(rowData.icon !== null && rowData.icon !== "" && action === 'edit') {
		$(`#${type}-form-modal img.image-prev`).attr('src', `${rowData.icon}`);
		$(`#${type}-form-modal img.image-prev`).parent().addClass('d-flex justify-content-center');
		$(`#${type}-form-modal img.image-prev`).parent().removeClass('hide');
		$(`#${type}-form-modal img.image-prev`).parent().prev().addClass('hide');
	}

	if(rowData.display_on_print === "1" || rowData.display_on_print === 1) {
		$('#bundle-form-modal #displayBundle').prop('checked', true);
	}

	if(type !== 'bundle') {
		$(`#${type}-form-modal select`).select2();
	}
}

$('#type-selection-modal').on('show.bs.modal', function (event) {
	var triggerElement = $(event.relatedTarget); // Button that triggered the modal
	if(triggerElement.length > 0) {
		$('#type-selection-modal table tbody tr:last-child').show();
	}
});

$('#assign-category').select2({
	placeholder: "Assign category"
});

$(document).on('change', '#assign-category', function() {
	var data = new FormData();

	var items = [];
	$('#products-services-table td:first-child input[type="checkbox"]').each(function() {
		if($(this).prop('checked')) {
			items.push($(this).val());
		}
	});

	data.append('items', JSON.stringify(items));

	$.ajax({
		url: `products-and-services/assign-category/${$(this).val()}`,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
		success: function(result) {
			location.reload();
		}
	});
});

$(document).on('change', '#products-services-table td:first-child input[type="checkbox"], #products-services-table th input[type="checkbox"]', function() {
	if($(this).val() === 'all') {
		if($(this).prop('checked')) {
			$('#products-services-table td:first-child input[type="checkbox"]').prop('checked', true);
		} else {
			$('#products-services-table td:first-child input[type="checkbox"]').prop('checked', false);
		}
	} else {
		var flag = true;
		$('#products-services-table tbody input[type="checkbox"]').each(function() {
			if($(this).prop('checked') === false) {
				flag = false;
			}
		});

		$('#products-services-table thead input[type="checkbox"]').prop('checked', flag);
	}

	var hasChecked = false;
	var checkedType = [];

	$('#products-services-table tbody td:first-child input[type="checkbox"]').each(function() {
		var row = $(this).parent().parent();
		rowData = $('#products-services-table').DataTable().row(row).data();

		if($(this).prop('checked')) {
			hasChecked = true;

			if(!checkedType.includes(rowData.type.toLowerCase())) {
				checkedType.push(rowData.type.toLowerCase());
			}
		}
	});

	if(hasChecked) {
		$($('.action-bar')[1]).removeClass('d-flex');
		$($('.action-bar')[1]).addClass('d-none');
		$($('.action-bar')[0]).addClass('d-flex');
		$($('.action-bar')[0]).removeClass('d-none');

		if(checkedType.length === 1) {
			if(checkedType[0] === 'inventory') {
				$('.batch-reoder, .batch-adjust-qty').removeClass('disabled');
				$('.batch-change-type').addClass('disabled');
			} else if(checkedType[0] === 'non-inventory') {
				$('.batch-reoder, .batch-adjust-qty').addClass('disabled');
				$($('.batch-change-type')[0]).addClass('disabled');
				$($('.batch-change-type')[1]).removeClass('disabled');
			} else if(checkedType[0] === 'service') {
				$('.batch-reoder, .batch-adjust-qty').addClass('disabled');
				$($('.batch-change-type')[1]).addClass('disabled');
				$($('.batch-change-type')[0]).removeClass('disabled');
			}
		} else {
			$('.batch-reoder, .batch-adjust-qty, .batch-change-type').addClass('disabled');
		}
	} else {
		$($('.action-bar')[0]).removeClass('d-flex');
		$($('.action-bar')[0]).addClass('d-none');
		$($('.action-bar')[1]).addClass('d-flex');
		$($('.action-bar')[1]).removeClass('d-none');
	}
});

$('.dropdown-item.batch-change-type, .dropdown-item.batch-make-inactive').on('click', function(e) {
	e.preventDefault();
	var action = '';
	if($(this).hasClass('batch-make-inactive')) {
		action = 'make-inactive';
	} else {
		action = this.outerText.replace(' ', '-').toLowerCase();
	}

	var data = new FormData();

	var items = [];
	$('#products-services-table td:first-child input[type="checkbox"]').each(function() {
		if($(this).prop('checked')) {
			items.push($(this).val());
		}
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

$(document).on('click', '#products-services-table .make-inactive', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent().parent();
	var rowData = $('#products-services-table').DataTable().row(row).data();

	$.ajax({
        url: `/accounting/products-and-services/inactive/${rowData.id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });
});

$(document).on('change', '.modal-right-side input#icon', function() {
	if($(this)[0].files && $(this)[0].files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('img.image-prev').attr('src', e.target.result);
		}

		reader.readAsDataURL($(this)[0].files[0]);

		$('img.image-prev').parent().addClass('d-flex justify-content-center');
		$('img.image-prev').parent().removeClass('hide');
		$('img.image-prev').parent().prev().addClass('hide');
	} else {
		$('img.image-prev').parent().removeClass('d-flex justify-content-center');
		$('img.image-prev').parent().addClass('hide');
		$('img.image-prev').parent().prev().removeClass('hide');
	}
});

$(document).on('click', '#bundle-item-form #bundle-items-table tbody tr td:not(:last-child)', function() {
	if($(this).parent().find('select[name="item_id[]"]').length < 1) {
		$(this).parent().children('td:first-child').append('<select name="item_id[]" class="form-control"></select>');
		$(this).parent().children('td:nth-child(2)').append('<input type="number" name="quantity[]" class="text-right form-control">');

		$(this).parent().find('select[name="item_id[]"]').select2({
			ajax: {
				url: 'products-and-services/items-dropdown',
				dataType: 'json'
			}
		});
	}
});

$(document).on('click', '#update-bundle-form #bundle-items-table tbody tr td:not(:last-child), #duplicate-item-form #bundle-items-table tbody tr td:not(:last-child)', function() {
	var data = $(this).parent()[0].dataset;
	if($(this).parent().find('select').length === 0) {
		$(this).parent().children('td:first-child, td:nth-child(2)').children('span').hide();
		$(this).parent().children('td:first-child').append(`<select class="form-control"></select>`);

		if($(this).parent().children('td:nth-child(2)').children('input').length > 0) {
			$(this).parent().children('td:nth-child(2)').children('input').removeClass('hide');
		} else {
			$(this).parent().children('td:nth-child(2)').append('<input type="number" name="quantity[]" class="text-right form-control">');
		}

		if(data.item !== undefined) {
			$(this).parent().children('td:first-child').children('select').append(`<option value="${data.item}">${data.name}</option>`);
		} else {
			$(this).parent().children('td:first-child').children('select').attr('name', 'item_id[]');
		}

		$(this).parent().find('select').select2({
			ajax: {
				url: 'products-and-services/items-dropdown',
				dataType: 'json'
			}
		});
	}
});

$(document).on('change', '#update-bundle-form #bundle-items-table tbody select, #duplicate-item-form #bundle-items-table tbody select', function() {
	$(this).prev().val($(this).val());
});

$(document).on('click', '#bundle-form-modal #addBundleItem, #inventory-form-modal #addLocationLine', function(e) {
	e.preventDefault();
	$(this).prev().children('tbody').append(`
	<tr>
		<td></td>
		<td></td>
		<td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
	</tr>
	`);
});

$(document).on('click', '#storage-locations tbody tr td:not(:last-child)', function() {
	if($(this).parent().find('input[name="location_name[]"]').length < 1) {
		$(this).parent().children('td:first-child').append('<input type="text" name="location_name[]" class="form-control">');
		$(this).parent().children('td:nth-child(2)').append('<input type="number" name="quantity[]" class="text-right form-control">');
	}
});

$(document).on('click', '#bundle-form-modal #bundle-items-table .deleteRow, #inventory-form-modal #storage-locations .deleteRow', function(e) {
	e.preventDefault();

	if($(this).parent().parent().parent().children('tr').length > 2) {
		$(this).parent().parent().remove();
	} else {
		$(this).parent().parent().children('td:not(:last-child)').html('');
	}
});

$(document).on('change', '.modal-right-side .modal #selling, .modal-right-side .modal #purchasing', function() {
	if($(this).prop('checked') === false) {
		$(this).parent().parent().parent().children('div:not(:first-child)').addClass('hide');

		if($(this).attr('id') === 'selling') {
			$(this).parent().parent().parent().parent().parent().next().addClass('hide');

			if($('.modal-right-side .modal #purchasing').prop('checked') === false) {
				$('.modal-right-side .modal #purchasing').prop('checked', true).trigger('change');
			}
		} else {
			if($('.modal-right-side .modal #selling').prop('checked') === false) {
				$('.modal-right-side .modal #selling').prop('checked', true).trigger('change');
			}
		}
	} else {
		$(this).parent().parent().parent().children('div:not(:first-child)').removeClass('hide');

		if($(this).attr('id') === 'selling') {
			$(this).parent().parent().parent().parent().parent().next().removeClass('hide');
		}
	}
});

$('#types-table tr').on('click', function(e) {
	var type = e.currentTarget.dataset.href;
	$('#type-selection-modal').modal('hide');

	$.get('products-and-services/item-form/'+type, function(result) {
		$('.modal-form-container').html(result);

		$(`#${type}-form-modal .datepicker input`).datepicker({
			uiLibrary: 'bootstrap'
		});

		$(`#${type}-form-modal select`).select2();

		$(`#${type}-form-modal`).modal('show');
	});
});

$(document).on('click', '#products-services-table .adjust-starting-value', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent().parent();
	rowData = $('#products-services-table').DataTable().row(row).data();

	$.get('adjust-starting-value-form/'+rowData.id, function(result) {
		if ($('div#modal-container').length > 0) {
			$('div#modal-container').html(result);
		} else {
			$('body').append(`
				<div id="modal-container"> 
					${result}
				</div>
			`);
		}
		$('#adjust-starting-value-modal').modal('show');

		$('#adjust-starting-value-modal select').select2();
		$('#adjust-starting-value-modal #asOfDate').datepicker({
			uiLibrary: 'bootstrap'
		});
	});
});

$(document).on('click', '#products-services-table .duplicate-item', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent().parent();
	rowData = $('#products-services-table').DataTable().row(row).data();
	var type = rowData.type.toLowerCase();

	$.get('products-and-services/item-form/'+type, function(result) {
		$('.modal-form-container').html(result);

		$('#bundle-form-modal table thead tr th a').remove();
		occupyFields(rowData, type, 'duplicate');

		for(i in rowData.bundle_items) {
			if($($('#bundle-form-modal #bundle-items-table tbody tr')[i]).length > 0 ) {
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).attr('data-item', `${rowData.bundle_items[i].item_id}`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).attr('data-name', `${rowData.bundle_items[i].name}`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).attr('data-quantity', `${rowData.bundle_items[i].quantity}`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).children('td:first-child').html(`
				<span>${rowData.bundle_items[i].name}</span>
				<input type="hidden" value="${rowData.bundle_items[i].item_id}" name="item_id[]">
				`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).children('td:nth-child(2)').html(`
				<span>${rowData.bundle_items[i].quantity}</span>
				<input type="number" name="quantity[]" class="text-right form-control hide" value="${rowData.bundle_items[i].quantity}">
				`);
			} else {
				$('#bundle-form-modal #bundle-items-table tbody').append(`
				<tr data-item="${rowData.bundle_items[i].item_id}" data-name="${rowData.bundle_items[i].name}" data-quantity="${rowData.bundle_items[i].quantity}">
					<td>
						<span>${rowData.bundle_items[i].name}</span>
						<input type="hidden" value="${rowData.bundle_items[i].item_id}" name="item_id[]">
					</td>
					<td>
						<span>${rowData.bundle_items[i].quantity}</span>
						<input type="number" name="quantity[]" class="text-right form-control hide" value="${rowData.bundle_items[i].quantity}">
					</td>
					<td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
				</tr>
				`);
			}
		}

		$(`#${type}-form-modal form`).attr('id', 'duplicate-item-form');

		$(`#${type}-form-modal`).modal('show');
	});
});

$(document).on('click', '#products-services-table .adjust-quantity', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent().parent();
	rowData = $('#products-services-table').DataTable().row(row).data();

	adjustInvQtyModal();
});

function adjustInvQtyModal() {
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

		$('#inventoryModal #inventory-adjustments-table select[name="product[]"]').val(rowData.id).trigger('change');
		$(`#inventoryModal #inventory-adjustments-table select[name="product[]"] option:not([value="${rowData.id}"],:disabled)`).remove();

		rowCount = $('div#modal-container table tbody tr').length;
		rowInputs = $('div#modal-container table tbody tr:first-child()').html();
		blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();

		$('#inventoryModal select').select2();
		$('#inventoryModal').modal('show');
	});
}

$(document).on('click', '#inventory-form-modal .adjust-quantity', function(e) {
	e.preventDefault();

	adjustInvQtyModal();
});

$('.dropdown-item.batch-adjust-qty').on('click', function(e) {
	e.preventDefault();

	var items = [];
	$('#products-services-table td:first-child input[type="checkbox"]').each(function() {
		if($(this).prop('checked')) {
			items.push($(this).val());
		}
	});

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

		$('#inventory-adjustments-table select[name="product[]"] option:not(:selected)').each(function() {
			if(!items.includes($(this).attr('value'))) {
				$(this).remove();
			}
		});

		rowCount = $('div#modal-container table tbody tr').length;
		rowInputs = $('div#modal-container table tbody tr:first-child()').html();
		blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();

		for(i in items) {
			if($($('#inventory-adjustments-table tbody tr')[i]).length > 0) {
				if($($('#inventory-adjustments-table tbody tr')[i]).find('[name="product[]"]').length === 0) {
					$($('#inventory-adjustments-table tbody tr')[i]).trigger('click');
				}
			} else {
				$('#inventory-adjustments-table tbody').append('<tr></tr>');
				$($('#inventory-adjustments-table tbody tr')[i]).append(rowInputs);
				$($('#inventory-adjustments-table tbody tr')[i]).children(':nth-child(2)').html(parseInt(i) + 1);
			}

			$($('#inventory-adjustments-table tbody tr')[i]).find('[name="product[]"]').val(items[i]).trigger('change');
		}

		$('#inventoryModal select').select2();
		$('#inventoryModal').modal('show');
	});
});

$(document).on('click', '#products-services-table .edit-item', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent();
	rowData = $('#products-services-table').DataTable().row(row).data();
	var type = rowData.type.toLowerCase();

	$.get('products-and-services/item-form/'+type, function(result) {
		$('.modal-form-container').html(result);

		if(type === 'inventory' || type === 'bundle') {
			$('#inventory-form-modal table thead tr th a').remove();
			$('#bundle-form-modal table thead tr th a').remove();
		} else {
			$(`#${type}-form-modal table thead tr th a`).attr('onclick', `changeType('${type}')`);
		}

		occupyFields(rowData, type);

		$('#inventory-form-modal #storage-locations').next().remove();
		$('#inventory-form-modal label[for="asOfDate"]').parent().remove();
		$(`
		<div class="form-group row" style="margin: 0 !important">
			<div class="col-sm-6">
				<label for="" class="m-0">Quantity on hand</label>
				<p class="m-0">Adjust: <a class="text-info adjust-quantity" href="#">Quantity</a> | <a class="text-info" href="#">Starting value</a></p>
			</div>
			<div class="col-sm-6">
				<p class="text-right m-0">${rowData.qty_on_hand}</p>
			</div>
		</div>`).insertAfter('#inventory-form-modal #storage-locations');
		$('#inventory-form-modal #storage-locations').parent().append(`
		<div class="form-group row" style="margin: 0 !important">
			<div class="col-sm-6">
				<label for="" class="m-0">Quantity on PO</label>
			</div>
			<div class="col-sm-6">
				<p class="text-right m-0">0</p>
			</div>
		</div>
		`);
		$('#inventory-form-modal #storage-locations').remove();
		
		$('#bundle-form-modal form').attr('id', 'update-bundle-form');
		$(`#${type}-form-modal form`).attr('action', `/accounting/products-and-services/update/${type}/${rowData.id}`);
		for(i in rowData.bundle_items) {
			if($($('#bundle-form-modal #bundle-items-table tbody tr')[i]).length > 0 ) {
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).attr('data-id', `${rowData.bundle_items[i].id}`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).attr('data-item', `${rowData.bundle_items[i].item_id}`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).attr('data-name', `${rowData.bundle_items[i].name}`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).attr('data-quantity', `${rowData.bundle_items[i].quantity}`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).children('td:first-child').html(`
				<span>${rowData.bundle_items[i].name}</span>
				<input type="hidden" value="${rowData.bundle_items[i].id}" name="bundle_item_content_id[]">
				<input type="hidden" value="${rowData.bundle_items[i].item_id}" name="item_id[]">
				`);
				$($('#bundle-form-modal #bundle-items-table tbody tr')[i]).children('td:nth-child(2)').html(`
				<span>${rowData.bundle_items[i].quantity}</span>
				<input type="number" name="quantity[]" class="text-right form-control hide" value="${rowData.bundle_items[i].quantity}">
				`);
			} else {
				$('#bundle-form-modal #bundle-items-table tbody').append(`
				<tr data-id="${rowData.bundle_items[i].id}" data-item="${rowData.bundle_items[i].item_id}" data-name="${rowData.bundle_items[i].name}" data-quantity="${rowData.bundle_items[i].quantity}">
					<td>
						<span>${rowData.bundle_items[i].name}</span>
						<input type="hidden" value="${rowData.bundle_items[i].id}" name="bundle_item_content_id[]">
						<input type="hidden" value="${rowData.bundle_items[i].item_id}" name="item_id[]">
					</td>
					<td>
						<span>${rowData.bundle_items[i].quantity}</span>
						<input type="number" name="quantity[]" class="text-right form-control hide" value="${rowData.bundle_items[i].quantity}">
					</td>
					<td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
				</tr>
				`);
			}
		}

		$(`#${type}-form-modal`).modal('show');
	});
});

$('#category').select2({
	allowClear: true,
});

$('#compact').on('change', function() {
	if($(this).prop('checked') === false) {
		$('#products-services-table tbody tr td:nth-child(2) div img').show();
	} else {
		$('#products-services-table tbody tr td:nth-child(2) div img').hide();
	}
});

$('.action-bar .dropdown-menu .show-more-button').on('click', function(e) {
	e.preventDefault();

	if($(this).prev().hasClass('hide')) {
		$(this).prev().removeClass('hide');
		$(this).html('<i class="fa fa-caret-up text-info"></i> &nbsp; Show less');
	} else {
		$(this).prev().addClass('hide');
		$(this).html('<i class="fa fa-caret-down text-info"></i> &nbsp; Show more');
	}
});

$('.dropopenbx').on('click', function(){
	$(this).next().toggleClass('dropopn');
});

$('.dropdown-menu').on('click', function(e) {
	e.stopPropagation();
});

$('#search').on('keyup', function() {
	applybtn();
});

$('#table_rows, #group_by_category').on('change', function() {
	applybtn();
});

$(`#products-services-table`).DataTable({
	autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: $('#table_rows').val(),
    info: false,
	order: [[1, 'asc']],
	ajax: {
		url: 'products-and-services/load/',
		dataType: 'json',
		contentType: 'application/json',
		type: 'POST',
		data: function(d) {
			// d.inactive = $('#inc_inactive').prop('checked') === true ? 1 : 0;
			d.status = $('#status').val();
			d.type = $('#type').val();
			d.category = $('#category').select2('val');
			d.stock_status = $('#stock_status').val();
			d.group_by_category = $('#group_by_category').prop('checked') ? 1 : 0;
			d.length = $('#table_rows').val();
			d.columns[0].search.value = $('input#search').val();
			return JSON.stringify(d);
		},
		pagingType: 'full_numbers'
	},
	columns: [
		{
			orderable: false,
			data: null,
			name: 'checkbox',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				if(!rowData.hasOwnProperty('is_category') && rowData.type !== "Bundle") {
					$(td).html(`<input type="checkbox" value="${rowData.id}">`);
				} else {
					$(td).html('');
				}
			}
		},
		{
			data: 'name',
			name: 'name',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).html(`
				<div class="item-name-cell d-flex align-items-center">
					<span class="ml-2">${cellData}</span>
				</div>
				`);

				if(!rowData.hasOwnProperty('is_category')) {
					if(rowData.icon === null || rowData.icon === "") {
						$(td).children('div').prepend('<img src="/uploads/accounting/attachments/default-item.png">');
					} else {
						$(td).children('div').prepend(`<img src="${rowData.icon}">`);
					}
				} else {
					$(td).attr('colspan', '15');
				}

				if($('#compact').prop('checked') === true) {
					$(td).find('img').hide();
				}
			}
		},
		{
			data: 'sku',
			name: 'sku',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('sku');
				if($('#chk_sku').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'type',
			name: 'type',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('type');
				if($('#chk_type').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'sales_desc',
			name: 'sales_desc',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('sales_desc');
				if($('#chk_sales_desc').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'income_account',
			name: 'income_account',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('income_account');
				if($('#chk_income_account').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'expense_account',
			name: 'expense_account',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('expense_account');
				if($('#chk_expense_account').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'inventory_account',
			name: 'inventory_account',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('inventory_account');
				if($('#chk_inventory_account').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'purch_desc',
			name: 'purch_desc',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('purch_desc');
				if($('#chk_purch_desc').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'sales_price',
			name: 'sales_price',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('sales_price');
				if($('#chk_sales_price').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'cost',
			name: 'cost',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('cost');
				if($('#chk_cost').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			orderable: false,
			data: 'taxable',
			name: 'taxable',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('taxable');
				if(cellData !== "0") {
					$(td).html('<input type="checkbox" disabled class="m-auto" checked>');
				} else {
					$(td).html('');
				}
				if($('#chk_taxable').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'qty_on_hand',
			name: 'qty_on_hand',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('qty_on_hand');
				if(rowData.type !== 'Product' && rowData.type !== 'Inventory') {
					$(td).html('');
				}
				if($('#chk_qty_on_hand').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'qty_po',
			name: 'qty_po',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('qty_po');
				if($('#chk_qty_po').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			data: 'reorder_point',
			name: 'reorder_point',
			fnCreatedCell: function(td, cellData, rowData, row, col) {
				$(td).addClass('reorder_point');
				if($('#chk_reorder_point').prop('checked') === false) {
					$(td).hide();
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		},
		{
			orderable: false,
			data: null,
			name: 'action',
			fnCreatedCell: function(td, cellData, rowData,row, col) {
				if(rowData.type !== "Bundle") {
					if(rowData.type !== "Inventory" && rowData.type !== "Product") {
						$(td).html(`
						<div class="btn-group float-right">
							<a href="#" class="edit-item btn text-primary d-flex align-items-center justify-content-center">Edit</a>

							<button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item make-inactive" href="#">Make inactive</a>
								<a class="dropdown-item" href="#">Run report</a>
								<a class="dropdown-item duplicate-item" href="#">Duplicate</a>
							</div>
						</div>
						`);
					} else {
						$(td).html(`
						<div class="btn-group float-right">
							<a href="#" class="edit-item btn text-primary d-flex align-items-center justify-content-center">Edit</a>

							<button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item make-inactive" href="#">Make inactive</a>
								<a class="dropdown-item" href="#">Run report</a>
								<a class="dropdown-item duplicate-item" href="#">Duplicate</a>
								<a class="dropdown-item adjust-quantity" href="#">Adjust quantity</a>
								<a class="dropdown-item adjust-starting-value" href="#">Adjust starting value</a>
								<a class="dropdown-item" href="#">Reorder</a>
							</div>
						</div>
						`);
					}
				} else {
					$(td).html(`
					<div class="btn-group float-right">
						<a href="#" class="edit-item btn text-primary d-flex align-items-center justify-content-center">Edit</a>

						<button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item make-inactive" href="#">Make inactive</a>
							<a class="dropdown-item duplicate-item" href="#">Duplicate</a>
						</div>
					</div>
					`);
				}

				if(rowData.hasOwnProperty('is_category')) {
					$(td).remove();
				}
			}
		}
	]
});