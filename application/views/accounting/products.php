<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .loader
    {
        display: none !important;
    }
    .hide-toggle::after {
        display: none !important;
    }
	.action-bar .dropdown-menu a:hover {
		background: none !important;
	}
	#products-services-table .btn-group .btn:hover, #products-services-table .btn-group .btn:focus {
        color: unset;
    }
    #products-services-table .btn-group .btn {
        padding: 10px;
    }
	#products-services-table img {
		max-height: 52px;
	}
	.type-icon {
		height: 100%;
		background-position: center;
    	border-radius: 100%;
		background-repeat: no-repeat;
		background-color: #0077c5;
	}
	#types-table.table-hover tr:hover {
		background-color: #fff;
	}
	#types-table tr:last-child td {
		border-bottom: 1px solid #dee2e6; 
	}
	#types-table tr td {
		padding: 12px 30px;
	}
	.no-icon {
		background-image: url('/uploads/accounting/attachments/default-item.png');
		height: 100%;
		background-repeat: no-repeat;
		background-position: center;
	}
	.no-icon:hover, .preview-uploaded:hover {
		cursor: pointer;
		border-color: #8d9096 !important;
	}
	.preview-uploaded {
		height: 100%;
	}
	.modal .modal-footer .btn-group .btn:not(:first-child) {
		border-top-left-radius: 0 !important;
    	border-bottom-left-radius: 0 !important;
	}
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Products and Services</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">If you are not enrolled in our inventory management system, you may want to consider this feature.  With this powerful feature means being able to track the products you sell and the services you provide per location.  This feature means less shrinkage and more profitability.</span>
                                    </div>
                                </div>
                            </div>
							<div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
									<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
									<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
									<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
									<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
									<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
									<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab-active text-decoration-none">Products and Services</a>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
									<h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-sm-6">
									<div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
											<div class="btn-group mr-2">
												<button type="button" class="btn btn-secondary dropdown-toggle hide-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													More&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="/accounting/product-categories">Manage categories</a>
													<a class="dropdown-item" href="#">Run Report</a>
												</div>
											</div>
                                            <div class="btn-group float-right">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#type-selection-modal" class="btn btn-success d-flex align-items-center justify-content-center">
                                                    New
                                                </a>
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Import</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-6 pl-0 border-right">
									<div class="row align-items-center">
										<div class="col-sm-3 offset-sm-6">
											<p class="mb-0 bg-warning border border-dark rounded-circle p-4"><img src="<?php echo base_url();?>assets/img/accounting/low-stock.png" class="w-100 img-responsive"></p>
										</div>
										<div class="col-sm-3">
											<h1 class="text-warning">0</h1>
											<h5>LOW STOCK</h5>
										</div>
									</div>
								</div>
								<div class="col-sm-6 pr-0">
									<div class="row  pl-3 align-items-center">
										<div class="col-sm-3">
											<p class="mb-0 bg-danger border border-dark rounded-circle p-3"><img src="<?php echo base_url();?>assets/img/accounting/out-of-stock.png" class="w-100 img-responsive"></p>
										</div>
										<div class="col-sm-4">
											<h1 class="text-danger">0</h1>
											<h5>OUT OF STOCK</h5>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                        <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-6">
										<div class="form-row">
                                            <div class="col-4">
                                                <input type="text" name="search" id="search" class="form-control" placeholder="Find products and services">
                                            </div>
                                            <div class="col">
												<div class="dropdown d-inline-block d-flex align-items-center h-100">
													<a href="javascript:void(0);" class="dropdown-toggle hide-toggle" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter"></i></a>

													<div class="dropdown-menu p-3 w-auto" aria-labelledby="filterDropdown">
														<div class="inner-filter-list">
															<div class="row">
																<div class="col-sm-6">
																	<div class="form-group">
																		<label for="status">Status</label>
																		<select name="status" id="status" class="form-control">
																			<option value="active" selected>Active</option>
																			<option value="inactive">Inactive</option>
																			<option value="all">All</option>
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="type">Type</label>
																		<select name="type" id="type" class="form-control">
																			<option value="all" selected>All</option>
																			<option value="inventory">Inventory</option>
																			<option value="non-inventory">Non-inventory</option>
																			<option value="service">Service</option>
																			<option value="bundle">Bundle</option>
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="category">Category</label>
																		<select name="category[]" id="category" class="form-control" multiple="multiple">
																			<?php foreach($this->items_model->getItemCategories() as $category) : ?>
																				<option value="<?=$category->item_categories_id?>" selected><?=$category->name?></option>
																			<?php endforeach; ?>
																			<option value="0" selected>Uncategorized</option>
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="stock_status">Stock status</label>
																		<select name="stock_status" id="stock_status" class="form-control">
																			<option value="all">All</option>
																			<option value="low stock">Low stock</option>
																			<option value="out of stock">Out of stock</option>
																		</select>
																	</div>
																</div>
															</div>

															<div class="btn-group">
																<a href="#" class="btn-main" onclick="resetbtn()">Reset</a>
																<a href="#" id="apply-btn" class="btn-main apply-btn" onclick="applybtn()">Apply</a>
															</div>
														</div>
													</div>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
												<li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
												<li><a href="#"><i class="fa fa-download"></i></a></li>
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Columns</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_income_account"> Income account</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_expense_account"> Expense account</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_inventory_account"> Inventory account</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_purch_desc"> Purchase description</p>
														<p class="m-0"><input type="checkbox" onchange="col(this)" id="chk_qty_po"> Qty on PO</p>
														<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_sku"> SKU</p>
														<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_type"> Type</p>
														<div class="show-more hide">
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_sales_desc"> Sales description</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_sales_price"> Sales price</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_cost"> Cost</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_taxable"> Taxable</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_qty_on_hand"> Qty on hand</p>
															<p class="m-0"><input type="checkbox" checked="checked" onchange="col(this)" id="chk_reorder_point"> Reorder point</p>
														</div>
														<a href="#" class="text-info text-center show-more-button"><i class="fa fa-caret-down text-info"></i> &nbsp;Show more</a>
                                                        <p class="m-0">Rows</p>
                                                        <p class="m-0">
                                                            <select name="table_rows" id="table_rows" class="form-control">
                                                                <option value="50">50</option>
                                                                <option value="75">75</option>
                                                                <option value="100">100</option>
                                                                <option value="150" selected>150</option>
                                                                <option value="300">300</option>
                                                            </select>
                                                        </p>
														<p class="m-0"><input type="checkbox" id="compact"> Compact</p>
														<p class="m-0"><input type="checkbox" checked="checked" id="group_by_category" value="1"> Group by category</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <table id="products-services-table" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
											<th></th>
											<th>NAME</th>
											<th class="sku">SKU</th>
											<th class="type">TYPE</th>
											<th class="sales_desc">SALES DESCRIPTION</th>
											<th class="income_account hide">INCOME ACCOUNT</th>
											<th class="expense_account hide">EXPENSE ACCOUNT</th>
											<th class="inventory_account hide">INVENTORY ACCOUNT</th>
											<th class="purch_desc hide">PURCHASE DESCRIPTION</th>
											<th class="sales_price">SALES PRICE</th>
											<th class="cost">COST</th>
											<th class="taxable">TAXABLE</th>
											<th class="qty_on_hand">QTY ON HAND</th>
											<th class="qty_po hide">QTY ON PO</th>
											<th class="reorder_point">REORDER POINT</th>
											<th>ACTION</th>
                                        </tr>
									</thead>
									<tbody></tbody>
								</table>
                            </div>

							<!--    Modal for creating rules-->
                            <div class="modal-right-side">
                                <div class="modal right fade" id="type-selection-modal" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel2" >Product/Service information</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
											<div class="modal-body p-0">
												<table class="table table-hover cursor-pointer" id="types-table">
													<tbody>
														<tr data-href="inventory">
															<td>
																<div class="row" style="height: 117px">
																	<div class="col-sm-3">
																		<div class="type-icon" style="background-image: url('/assets/img/accounting/inventory.png')"></div>
																	</div>
																	<div class="col-sm-9 d-flex align-items-center">
																		<div class="type-description">
																			<h5 class="m-0">Inventory</h5>
																			<span>Products you buy and/or sell and that you track quantities of.</span>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														<tr data-href="non-inventory">
															<td>
																<div class="row" style="height: 117px">
																	<div class="col-sm-3">
																		<div class="type-icon" style="background-image: url('/assets/img/accounting/non-inventory.png')"></div>
																	</div>
																	<div class="col-sm-9 d-flex align-items-center">
																		<div class="type-description">
																			<h5 class="m-0">Non-inventory</h5>
																			<span>Products you buy and/or sell but don’t need to (or can’t) track quantities of, for example, nuts and bolts used in an installation.</span>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														<tr data-href="service">
															<td>
																<div class="row" style="height: 117px">
																	<div class="col-sm-3">
																		<div class="type-icon" style="background-image: url('/assets/img/accounting/service.png')"></div>
																	</div>
																	<div class="col-sm-9 d-flex align-items-center">
																		<div class="type-description">
																			<h5 class="m-0">Service</h5>
																			<span>Services that you provide to customers, for example, landscaping or tax preparation services.</span>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
														<tr data-href="bundle">
															<td>
																<div class="row" style="height: 117px">
																	<div class="col-sm-3">
																		<div class="type-icon" style="background-image: url('/assets/img/accounting/bundle.png')"></div>
																	</div>
																	<div class="col-sm-9 d-flex align-items-center">
																		<div class="type-description">
																			<h5 class="m-0">Bundle</h5>
																			<span>A collection of products and/or services that you sell together, for example, a gift basket of fruit, cheese, and wine.</span>
																		</div>
																	</div>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--    end of modal-->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="modal-form-container"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>

<script>
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
	$('#type-selection-modal').modal('show');
}

function removeIcon()
{
	$('.modal-right-side input#icon').val('').trigger('change');
}

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

$(document).on('click', '#update-bundle-form #bundle-items-table tbody tr td:not(:last-child)', function() {
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

$(document).on('change', '#update-bundle-form #bundle-items-table tbody select', function() {
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

$(document).on('click', '#products-services-table .edit-item', function(e) {
	e.preventDefault();
	var row = $(this).parent().parent().parent();
	var rowData = $('#products-services-table').DataTable().row(row).data();
	var type = rowData.type.toLowerCase();

	$.get('products-and-services/item-form/'+type, function(result) {
		$('.modal-form-container').html(result);

		if(type === 'inventory' || type === 'bundle') {
			$('#inventory-form-modal table thead tr th a').remove();
			$('#bundle-form-modal table thead tr th a').remove();
		}
		$(`#${type}-form-modal #name`).val(rowData.name);
		$(`#${type}-form-modal #sku`).val(rowData.sku);
		$(`#${type}-form-modal #category`).val(rowData.category_id);
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
		$(`#${type}-form-modal #invAssetAcc option`).each(function() {
			if($(this).html() === rowData.inventory_account) {
				$(this).parent().val($(this).attr('value'));
			}
		});
		if(rowData.icon !== null && rowData.icon !== "") {
			$(`#${type}-form-modal img.image-prev`).attr('src', `/uploads/${rowData.icon}`);
			$(`#${type}-form-modal img.image-prev`).parent().addClass('d-flex justify-content-center');
			$(`#${type}-form-modal img.image-prev`).parent().removeClass('hide');
			$(`#${type}-form-modal img.image-prev`).parent().prev().addClass('hide');
		}

		$('#inventory-form-modal #storage-locations').next().remove();
		$('#inventory-form-modal label[for="asOfDate"]').parent().remove();
		$(`
		<div class="form-group row" style="margin: 0 !important">
			<div class="col-sm-6">
				<label for="" class="m-0">Quantity on hand</label>
				<p class="m-0">Adjust: <a class="text-info" href="#">Quantity</a> | <a class="text-info" href="#">Starting value</a></p>
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
		if(rowData.display_on_print === "1" || rowData.display_on_print === 1) {
			$('#bundle-form-modal #displayBundle').prop('checked', true);
		}
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

		if(type !== 'bundle') {
			$(`#${type}-form-modal select`).select2();
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
					$(td).html('<input type="checkbox">');
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
						$(td).children('div').prepend(`<img src="/uploads/${rowData.icon}">`);
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
								<a class="dropdown-item" href="#">Duplicate</a>
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
								<a class="dropdown-item" href="#">Duplicate</a>
								<a class="dropdown-item" href="#">Adjust quantity</a>
								<a class="dropdown-item" href="#">Adjust starting value</a>
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
							<a class="dropdown-item" href="#">Duplicate</a>
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
</script>