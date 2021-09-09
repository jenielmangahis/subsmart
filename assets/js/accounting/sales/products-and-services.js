let itemFormData = new FormData();
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
	$('#products-services-table thead th input[type="checkbox"]').prop('checked', false).trigger('change');
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
	var form = $('#item-modal form');
	itemFormData = new FormData(document.getElementById(form.attr('id')));
	itemFormData.set('type', type);
	if(form.attr('id').includes('update')) {
		var action = form.attr('action');
		var itemId = action.split('/');
		itemId = itemId[itemId.length - 1];
		itemFormData.set('id', itemId);
	}

	$.get(`/accounting/get-dropdown-modal/item_modal?field=${type}`, function(result) {
		$('#modal-container .full-screen-modal').append(result);

		itemTypeSelection = $('#modal-container .full-screen-modal .modal-right-side:last-child() .modal').find('.modal-content').html();
		$('#modal-container .full-screen-modal .modal-right-side:last-child()').remove();

		$('#modal-container #item-modal .modal-content').html(itemTypeSelection);
	});
}

function removeIcon()
{
	$('.modal-right-side input#icon').val('').trigger('change');
}

function occupyFields(rowData, type, action = 'edit')
{
	var name = action === 'duplicate' ? rowData.name+' - copy' : rowData.name;
	$(`#item-modal #name`).val(name);
	$(`#item-modal #sku`).val(rowData.sku);
	if(rowData.category !== null && rowData.category !== "") {
		$(`#item-modal #category`).append(`<option value="${rowData.category_id}" selected>${rowData.category}</option>`);
	}
	$(`#item-modal #rebate-item`).prop('checked', rowData.rebate === '1');
	$(`#item-modal #asOfDate`).val(rowData.as_of_date);
	$(`#item-modal #reorderPoint`).val(rowData.reorder_point);
	if(rowData.inventory_account !== null && rowData.inventory_account !== "") {
		$(`#item-modal #invAssetAcc`).append(`<option value="${rowData.inventory_account_id}" selected>${rowData.inventory_account}</option>`);
	}
	$(`#item-modal #description`).val(rowData.sales_desc);
	$(`#item-modal #price`).val(rowData.sales_price);
	if(rowData.income_account !== null && rowData.income_account !== "") {
		$(`#item-modal #incomeAccount`).append(`<option value="${rowData.income_account_id}" selected>${rowData.income_account}</option>`);
	}
	if(rowData.sales_tax_cat !== null && rowData.sales_tax_cat !== "") {
		$(`#item-modal #salesTaxCat`).append(`<option value="${rowData.sales_tax_cat_id}" selected>${rowData.sales_tax_cat}</option>`);
	}
	if(rowData.purch_desc !== null && rowData.purch_desc !== "") {
		$(`#item-modal #purchasing`).prop('checked', true).trigger('change');
	}
	$(`#item-modal #purchaseDescription`).val(rowData.purch_desc);
	$(`#item-modal #cost`).val(rowData.cost);
	if(rowData.expense_account !== null && rowData.expense_account !== "") {
		$(`#item-modal #expenseAcc`).append(`<option value="${rowData.expense_account_id}" selected>${rowData.expense_account}</option>`);
	}
	if(rowData.icon !== null && rowData.icon !== "" && action === 'edit') {
		$(`#item-modal img.image-prev`).attr('src', `${rowData.icon}`);
		$(`#item-modal img.image-prev`).parent().addClass('d-flex justify-content-center');
		$(`#item-modal img.image-prev`).parent().removeClass('hide');
		$(`#item-modal img.image-prev`).parent().prev().addClass('hide');
	}

	if(rowData.display_on_print === "1" || rowData.display_on_print === 1) {
		$('#item-modal #displayBundle').prop('checked', true);
	}
	if(rowData.vendor !== null && rowData.vendor !== "") {
		$(`#item-modal #vendor`).append(`<option value="${rowData.vendor_id}" selected>${rowData.vendor}</option>`);
	}

	for(i in rowData.locations) {
		if($($(`#item-modal #storage-locations tbody tr`)[i]).length < 1) {
			$(`#item-modal #storage-locations tbody`).append(`
			<tr>
				<td></td>
				<td></td>
				<td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
			</tr>
			`);
		}
		$($(`#item-modal #storage-locations tbody tr`)[i]).children('td:first-child').html(`<input type="text" name="location_name[]" class="form-control" value="${rowData.locations[i].name}">`);
		$($(`#item-modal #storage-locations tbody tr`)[i]).children('td:nth-child(2)').html(`<input type="number" name="quantity[]" class="text-right form-control" value="${rowData.locations[i].qty}">`);
	}

	for(i in rowData.bundle_items) {
		if($($('#item-modal #bundle-items-table tbody tr')[i]).length > 0 ) {
			$($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-item', `${rowData.bundle_items[i].item_id}`);
			$($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-name', `${rowData.bundle_items[i].name}`);
			$($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-quantity', `${rowData.bundle_items[i].quantity}`);
			$($('#item-modal #bundle-items-table tbody tr')[i]).children('td:first-child').html(`
			<span>${rowData.bundle_items[i].name}</span>
			<input type="hidden" value="${rowData.bundle_items[i].item_id}" name="item_id[]">
			`);
			$($('#item-modal #bundle-items-table tbody tr')[i]).children('td:nth-child(2)').html(`
			<span>${rowData.bundle_items[i].quantity}</span>
			<input type="number" name="quantity[]" class="text-right form-control hide" value="${rowData.bundle_items[i].quantity}">
			`);
		} else {
			$('#item-modal #bundle-items-table tbody').append(`
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
}

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

		$(`#modal-container #item-modal`).modal({
			backdrop: 'static',
			keyboard: true
		});
	});
});

$('select:not(#assign-category)').select2({
	minimumResultsForSearch: -1
});

$('#assign-category').select2({
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
			if(checkedType[0] === 'inventory' || checkedType[0] === 'product') {
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

	Swal.fire({
        title: 'Are you sure?',
        html: `You want to make <b>${rowData.name}</b> inactive?`,
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
				url: `/accounting/products-and-services/inactive/${rowData.id}`,
				type: 'DELETE',
				success: function(result) {
					location.reload();
				}
			});
        }
    });
});

$(document).on('click', '#products-services-table .make-active', function(e) {
	e.preventDefault();

	var row = $(this).parent().parent().parent();
	var rowData = $('#products-services-table').DataTable().row(row).data();

	Swal.fire({
        title: 'Are you sure?',
        html: `You want to make <b>${rowData.name}</b> active?`,
        icon: 'warning',
        showCloseButton: false,
        confirmButtonColor: '#2ca01c',
        confirmButtonText: 'Yes',
        showCancelButton: true,
        cancelButtonText: 'No',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
				url: `/accounting/products-and-services/active/${rowData.id}`,
				type: 'GET',
				success: function(result) {
					location.reload();
				}
			});
        }
    });
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
			$(this).parent().children('td:first-child').children('select').attr('name', 'item[]');
		}

		$(this).parent().find('select').select2({
			ajax: {
				url: '/accounting/get-dropdown-choices',
				dataType: 'json',
				data: function(params) {
					var query = {
						search: params.term,
						type: 'public',
						field: 'item',
					}

					// Query parameters will be ?search=[term]&type=public&field=[type]
					return query;
				}
			},
			templateResult: formatResult,
			templateSelection: optionSelect,
			dropdownParent: $('#modal-container #item-modal')
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

		$('#adjust-starting-value-modal select').each(function() {
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
								modal: 'adjust-starting-value-modal'
							}

							// Query parameters will be ?search=[term]&type=public&field=[type]
							return query;
						}
					},
					templateResult: formatResult,
					templateSelection: optionSelect
				});
			} else {
				var options = $(this).find('option');
				if (options.length > 10) {
					$(this).select2();
				} else {
					$(this).select2({
						minimumResultsForSearch: -1
					});
				}
			}
		});

		$('#adjust-starting-value-modal #asOfDate').datepicker({
			uiLibrary: 'bootstrap'
		});

		$('#adjust-starting-value-modal').modal('show');
	});
});

$(document).on('click', '#products-services-table .duplicate-item', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent().parent();
	rowData = $('#products-services-table').DataTable().row(row).data();
	var type = rowData.type.toLowerCase();

	$.get('/accounting/item-form/'+type, function(result) {
		if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`<div class="full-screen-modal">
				<div class="modal-right-side">
					<div class="modal right fade" tabindex="-1" id="item-modal" role="dialog" aria-labelledby="myModalLabel2">
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
							<div class="modal right fade" tabindex="-1" id="item-modal" role="dialog" aria-labelledby="myModalLabel2">
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

		$(`#item-modal .datepicker input`).datepicker({
			uiLibrary: 'bootstrap'
		});

		$('#item-modal select').each(function() {
			var type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');

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
				var options = $(this).find('option');
				if (options.length > 10) {
					$(this).select2({
						dropdownParent: $('#item-modal')
					});
				} else {
					$(this).select2({
						minimumResultsForSearch: -1,
						dropdownParent: $('#item-modal')
					});
				}
			}
		});

		$('#item-modal #bundle-item-form table thead tr th a').remove();
		occupyFields(rowData, type, 'duplicate');

		$(`#item-modal form`).attr('id', 'duplicate-item-form');

		$(`#item-modal`).modal({
			backdrop: 'static',
			keyboard: true
		});
	});
});

$('.dropdown-item.batch-reoder').on('click', function(e) {
	e.preventDefault();

	var items = [];
	var itemIds = [];
	$('#products-services-table td:first-child input[type="checkbox"]').each(function() {
		if($(this).prop('checked')) {
			var row = $(this).parent().parent();
			var data = $('#products-services-table').DataTable().row(row).data();
			items.push(data);
			itemIds.push($(this).val());
		}
	});

	$.get('/accounting/get-other-modals/purchase_order_modal', function(res) {
		if ($('div#modal-container').length > 0) {
			$('div#modal-container').html(res);
		} else {
			$('body').append(`
				<div id="modal-container"> 
					${res}
				</div>
			`);
		}

		rowCount = 2;
		catDetailsInputs = $(`#purchaseOrderModal table#category-details-table tbody tr:first-child()`).html();
		catDetailsBlank = $(`#purchaseOrderModal table#category-details-table tbody tr:nth-child(2)`).html();

		$(`#purchaseOrderModal table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
		$(`#purchaseOrderModal table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);

		if ($(`#purchaseOrderModal table#category-details-table tbody tr`).length > 2) {
			$(`#purchaseOrderModal table#category-details-table tbody tr:first-child()`).remove();
		}

		for(i in items) {
			var locs = '';
			for(o in items[i].locations) {
				locs += `<option value="${items[i].locations[o].id}">${items[i].locations[o].name}</option>`;
			}

			$('#purchaseOrderModal #item-details-table tbody').append(`
			<tr>
				<td>${items[i].name}<input type="hidden" name="item[]" value="${items[i].id}"></td>
				<td>Product</td>
				<td><select name="location[]" class="form-control" required>${locs}</select></td>
				<td><input type="number" name="quantity[]" class="form-control text-right" required value="0" min="0"></td>
				<td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${items[i].price}"></td>
				<td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="0.00"></td>
				<td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="7.50"></td>
				<td>$<span class="row-total">0.00</span></td>
				<td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
			</tr>
			`);
		}

		$(`#purchaseOrderModal select`).each(function() {
			var type = $(this).attr('id');
			if (type === undefined) {
				type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
			} else {
				type = type.replaceAll('_', '-');

				if (type.includes('transfer')) {
					type = 'transfer-account';
				}
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
								modal: 'purchaseOrderModal'
							}

							// Query parameters will be ?search=[term]&type=public&field=[type]
							return query;
						}
					},
					templateResult: formatResult,
					templateSelection: optionSelect
				});
			} else {
				var options = $(this).find('option');
				if (options.length > 10) {
					$(this).select2();
				} else {
					$(this).select2({
						minimumResultsForSearch: -1
					});
				}
			}
		});

		$('#purchaseOrderModal select#tags').select2({
			placeholder: 'Start typing to add a tag',
			allowClear: true,
			ajax: {
				url: '/accounting/get-job-tags',
				dataType: 'json'
			}
		});

		$(`#purchaseOrderModal .date`).each(function() {
			$(this).datepicker({
				uiLibrary: 'bootstrap'
			});
		});

		var attachmentContId = $(`#purchaseOrderModal .attachments .dropzone`).attr('id');
		var attachments = new Dropzone(`#${attachmentContId}`, {
			url: '/accounting/attachments/attach',
			maxFilesize: 20,
			uploadMultiple: true,
			// maxFiles: 1,
			addRemoveLinks: true,
			init: function() {
				this.on("success", function(file, response) {
					var ids = JSON.parse(response)['attachment_ids'];
					var modal = $(`#purchaseOrderModal`);

					for (i in ids) {
						if (modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
							modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
						}

						modalAttachmentId.push(ids[i]);
					}
					modalAttachedFiles.push(file);
				});
			},
			removedfile: function(file) {
				var ids = modalAttachmentId;
				var index = modalAttachedFiles.map(function(d, index) {
					if (d == file) return index;
				}).filter(isFinite)[0];

				$(`#purchaseOrderModal .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

				//remove thumbnail
				var previewElement;
				return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
			}
		});

		$('#purchaseOrderModal button[data-target="#category-details"]').trigger('click');
		$('#purchaseOrderModal button[data-target="#item-details"]').trigger('click');

		$(`#purchaseOrderModal`).modal('show');
	});
});

$(document).on('click', '#products-services-table .reorder', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent().parent();
	rowData = $('#products-services-table').DataTable().row(row).data();

	$.get('/accounting/get-other-modals/purchase_order_modal', function(res) {
		if ($('div#modal-container').length > 0) {
			$('div#modal-container').html(res);
		} else {
			$('body').append(`
				<div id="modal-container"> 
					${res}
				</div>
			`);
		}

		rowCount = 2;
		catDetailsInputs = $(`#purchaseOrderModal table#category-details-table tbody tr:first-child()`).html();
		catDetailsBlank = $(`#purchaseOrderModal table#category-details-table tbody tr:nth-child(2)`).html();

		$(`#purchaseOrderModal table#category-details-table tbody tr:first-child()`).html(catDetailsBlank);
		$(`#purchaseOrderModal table#category-details-table tbody tr:first-child() td:nth-child(2)`).html(1);

		if ($(`#purchaseOrderModal table#category-details-table tbody tr`).length > 2) {
			$(`#purchaseOrderModal table#category-details-table tbody tr:first-child()`).remove();
		}

		var locs = '';
		for(i in rowData.locations) {
			locs += `<option value="${rowData.locations[i].id}">${rowData.locations[i].name}</option>`;
		}

		$('#purchaseOrderModal #item-details-table tbody').append(`
		<tr>
			<td>${rowData.name}<input type="hidden" name="item[]" value="${rowData.id}"></td>
			<td>Product</td>
			<td><select name="location[]" class="form-control" required>${locs}</select></td>
			<td><input type="number" name="quantity[]" class="form-control text-right" required value="0" min="0"></td>
			<td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="${rowData.price}"></td>
			<td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="0.00"></td>
			<td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01" value="7.50"></td>
			<td>$<span class="row-total">0.00</span></td>
			<td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
		</tr>
		`);

		$(`#purchaseOrderModal select`).each(function() {
			var type = $(this).attr('id');
			if (type === undefined) {
				type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
			} else {
				type = type.replaceAll('_', '-');

				if (type.includes('transfer')) {
					type = 'transfer-account';
				}
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
								modal: 'purchaseOrderModal'
							}

							// Query parameters will be ?search=[term]&type=public&field=[type]
							return query;
						}
					},
					templateResult: formatResult,
					templateSelection: optionSelect
				});
			} else {
				var options = $(this).find('option');
				if (options.length > 10) {
					$(this).select2();
				} else {
					$(this).select2({
						minimumResultsForSearch: -1
					});
				}
			}
		});

		$('#purchaseOrderModal select#tags').select2({
			placeholder: 'Start typing to add a tag',
			allowClear: true,
			ajax: {
				url: '/accounting/get-job-tags',
				dataType: 'json'
			}
		});

		$(`#purchaseOrderModal .date`).each(function() {
			$(this).datepicker({
				uiLibrary: 'bootstrap'
			});
		});

		var attachmentContId = $(`#purchaseOrderModal .attachments .dropzone`).attr('id');
		var attachments = new Dropzone(`#${attachmentContId}`, {
			url: '/accounting/attachments/attach',
			maxFilesize: 20,
			uploadMultiple: true,
			// maxFiles: 1,
			addRemoveLinks: true,
			init: function() {
				this.on("success", function(file, response) {
					var ids = JSON.parse(response)['attachment_ids'];
					var modal = $(`#purchaseOrderModal`);

					for (i in ids) {
						if (modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
							modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
						}

						modalAttachmentId.push(ids[i]);
					}
					modalAttachedFiles.push(file);
				});
			},
			removedfile: function(file) {
				var ids = modalAttachmentId;
				var index = modalAttachedFiles.map(function(d, index) {
					if (d == file) return index;
				}).filter(isFinite)[0];

				$(`#purchaseOrderModal .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

				//remove thumbnail
				var previewElement;
				return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
			}
		});

		$('#purchaseOrderModal button[data-target="#category-details"]').trigger('click');
		$('#purchaseOrderModal button[data-target="#item-details"]').trigger('click');

		$(`#purchaseOrderModal`).modal('show');
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

		$('#inventoryModal #inventory-adjustments-table select[name="product[]"]').append(`<option value="${rowData.id}" selected>${rowData.name}</option>`);
		$('#inventoryModal #inventory-adjustments-table select[name="product[]"]').trigger('change');

		rowCount = $('div#modal-container table tbody tr').length;
		rowInputs = $('div#modal-container table tbody tr:first-child()').html();
		blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();

		$('#inventoryModal select').each(function() {
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

							if(type === 'product') {
								var itemIds = [];
								itemIds.push(rowData.id);
								query.selected = JSON.stringify(itemIds);
							}

							// Query parameters will be ?search=[term]&type=public&field=[type]
							return query;
						}
					},
					templateResult: formatResult,
					templateSelection: optionSelect
				});
			} else {
				var options = $(this).find('option');
				if (options.length > 10) {
					$(this).select2();
				} else {
					$(this).select2({
						minimumResultsForSearch: -1
					});
				}
			}
		});
		$('#inventoryModal').modal('show');
	});
}

$(document).on('click', '#item-modal .adjust-quantity', function(e) {
	e.preventDefault();

	adjustInvQtyModal();
});

$('.dropdown-item.batch-adjust-qty').on('click', function(e) {
	e.preventDefault();

	var items = [];
	var itemIds = [];
	$('#products-services-table td:first-child input[type="checkbox"]').each(function() {
		if($(this).prop('checked')) {
			var row = $(this).parent().parent();
			var data = $('#products-services-table').DataTable().row(row).data();
			items.push(data);
			itemIds.push($(this).val());
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

			$($('#inventory-adjustments-table tbody tr')[i]).find('[name="product[]"]').append(`<option value="${items[i].id}" selected>${items[i].name}</>`);
			$($('#inventory-adjustments-table tbody tr')[i]).find('[name="product[]"]').trigger('change');
		}

		$('#inventoryModal select').each(function() {
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

							if(type === 'product') {
								query.selected = JSON.stringify(itemIds);
							}

							// Query parameters will be ?search=[term]&type=public&field=[type]
							return query;
						}
					},
					templateResult: formatResult,
					templateSelection: optionSelect
				});
			} else {
				var options = $(this).find('option');
				if (options.length > 10) {
					$(this).select2();
				} else {
					$(this).select2({
						minimumResultsForSearch: -1
					});
				}
			}
		});
		$('#inventoryModal').modal('show');
	});
});

$(document).on('click', '#products-services-table .edit-item', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent();
	rowData = $('#products-services-table').DataTable().row(row).data();
	var type = rowData.type.toLowerCase();

	$.get('/accounting/item-form/'+type, function(result) {
		if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`<div class="full-screen-modal">
				<div class="modal-right-side">
					<div class="modal right fade" tabindex="-1" id="item-modal" role="dialog" aria-labelledby="myModalLabel2">
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
							<div class="modal right fade" tabindex="-1" id="item-modal" role="dialog" aria-labelledby="myModalLabel2">
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

		$(`#item-modal .datepicker input`).datepicker({
			uiLibrary: 'bootstrap'
		});

		$('#item-modal select').each(function() {
			var type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');

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
				var options = $(this).find('option');
				if (options.length > 10) {
					$(this).select2({
						dropdownParent: $('#item-modal')
					});
				} else {
					$(this).select2({
						minimumResultsForSearch: -1,
						dropdownParent: $('#item-modal')
					});
				}
			}
		});

		if(type === 'product' || type === 'bundle') {
			$('#item-modal a#select-item-type').remove();
		} else {
			$(`#item-modal a#select-item-type`).attr('onclick', `changeType('${type}')`);
		}

		occupyFields(rowData, type);

		$('#item-modal #storage-locations').next().remove();
		$('#item-modal label[for="asOfDate"]').parent().remove();
		$(`
		<div class="form-group row" style="margin: 0 !important">
			<div class="col-sm-6">
				<label for="" class="m-0">Quantity on hand</label>
				<p class="m-0">Adjust: <a class="text-info adjust-quantity" href="#">Quantity</a> | <a class="text-info" href="#">Starting value</a></p>
			</div>
			<div class="col-sm-6">
				<p class="text-right m-0">${rowData.qty_on_hand}</p>
			</div>
		</div>`).insertAfter('#item-modal #storage-locations');
		$('#item-modal #storage-locations').parent().append(`
		<div class="form-group row" style="margin: 0 !important">
			<div class="col-sm-6">
				<label for="" class="m-0">Quantity on PO</label>
			</div>
			<div class="col-sm-6">
				<p class="text-right m-0">0</p>
			</div>
		</div>
		`);
		$('#item-modal #storage-locations').remove();
		
		$('#item-modal form').attr('id', `update-${type}-form`);
		$(`#item-modal form`).attr('action', `/accounting/products-and-services/update/${type}/${rowData.id}`);
		for(i in rowData.bundle_items) {
			if($($('#item-modal #bundle-items-table tbody tr')[i]).length > 0 ) {
				$($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-id', `${rowData.bundle_items[i].id}`);
				$($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-item', `${rowData.bundle_items[i].item_id}`);
				$($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-name', `${rowData.bundle_items[i].name}`);
				$($('#item-modal #bundle-items-table tbody tr')[i]).attr('data-quantity', `${rowData.bundle_items[i].quantity}`);
				$($('#item-modal #bundle-items-table tbody tr')[i]).children('td:first-child').html(`
				<span>${rowData.bundle_items[i].name}</span>
				<input type="hidden" value="${rowData.bundle_items[i].id}" name="bundle_item_content_id[]">
				<input type="hidden" value="${rowData.bundle_items[i].item_id}" name="item[]">
				`);
				$($('#item-modal #bundle-items-table tbody tr')[i]).children('td:nth-child(2)').html(`
				<span>${rowData.bundle_items[i].quantity}</span>
				<input type="number" name="quantity[]" class="text-right form-control hide" value="${rowData.bundle_items[i].quantity}">
				`);
			} else {
				$('#item-modal #bundle-items-table tbody').append(`
				<tr data-id="${rowData.bundle_items[i].id}" data-item="${rowData.bundle_items[i].item_id}" data-name="${rowData.bundle_items[i].name}" data-quantity="${rowData.bundle_items[i].quantity}">
					<td>
						<span>${rowData.bundle_items[i].name}</span>
						<input type="hidden" value="${rowData.bundle_items[i].id}" name="bundle_item_content_id[]">
						<input type="hidden" value="${rowData.bundle_items[i].item_id}" name="item[]">
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

		$(`#modal-container #item-modal`).modal({
			backdrop: 'static',
			keyboard: true
		});
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

$('#low-stock-cont').on('click', function() {
	if($(this).hasClass('opacity-50') === false && $('#out-of-stock-cont').hasClass('opacity-50') === false) {
		$('#out-of-stock-cont').addClass('opacity-50');
		$('#stock_status').val('low stock').trigger('change');
		$('#type').val('inventory').trigger('change');
		$('#status').val('active').trigger('change');
	} else if($(this).hasClass('opacity-50') === false && $('#out-of-stock-cont').hasClass('opacity-50')) {
		$('#out-of-stock-cont').removeClass('opacity-50');
		$('#stock_status').val('all').trigger('change');
	} else if($(this).hasClass('opacity-50') && $('#out-of-stock-cont').hasClass('opacity-50') === false) {
		$('#out-of-stock-cont').addClass('opacity-50');
		$(this).removeClass('opacity-50');
		$('#stock_status').val('low stock').trigger('change');
		$('#type').val('inventory').trigger('change');
		$('#status').val('active').trigger('change');
	}

	applybtn();
});

$('#out-of-stock-cont').on('click', function() {
	if($(this).hasClass('opacity-50') === false && $('#low-stock-cont').hasClass('opacity-50') === false) {
		$('#low-stock-cont').addClass('opacity-50');
		$('#stock_status').val('out of stock').trigger('change');
		$('#type').val('inventory').trigger('change');
		$('#status').val('active').trigger('change');
	} else if($(this).hasClass('opacity-50') === false && $('#low-stock-cont').hasClass('opacity-50')) {
		$('#low-stock-cont').removeClass('opacity-50');
		$('#stock_status').val('all').trigger('change');
	} else if($(this).hasClass('opacity-50') && $('#low-stock-cont').hasClass('opacity-50') === false) {
		$('#low-stock-cont').addClass('opacity-50');
		$(this).removeClass('opacity-50');
		$('#stock_status').val('out of stock').trigger('change');
		$('#type').val('inventory').trigger('change');
		$('#status').val('active').trigger('change');
	}

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
				if(rowData.status === "1") {
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
									<a class="dropdown-item reorder" href="#">Reorder</a>
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
				} else {
					$(td).html(`
					<div class="btn-group float-right">
						<a href="#" class="btn text-primary d-flex align-items-center justify-content-center make-active">Make active</a>

						<button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Run report</a>
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