<div class="modal-header">
    <h3 class="modal-title" id="myModalLabel2" >Product/Service information</h3>
    <button type="button" class="close close-item-modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<form id="product-item-form" action="<?=url('accounting/products-and-services/product/create')?>" method="post" enctype="multipart/form-data">
<div class="modal-body">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <div class="row" style="height: 68.5px;">
                        <div class="col-sm-2">
                            <div class="type-icon" style="background-image: url('/assets/img/accounting/inventory.png')"></div>
                        </div>
                        <div class="col-sm-10 d-flex align-items-center">
                            <h5><span>Inventory</span></h5> &nbsp;&nbsp; <a href="#" class="text-info" id="select-item-type"><span>Change type</span></a>
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group" style="margin-bottom: 12px !important">
                                <label for="name">Name *</label>
                                <textarea name="name" id="name" class="form-control" required></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 12px !important">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" id="sku" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <input type="file" name="icon" id="icon" class="hide">
                            <div class="icon-preview h-75">
                                <div class="no-icon border" onclick="document.getElementById('icon').click()"></div>
                                <div class="preview-uploaded border hide" onclick="document.getElementById('icon').click()">
                                    <img src="" alt="Preview image" class="image-prev w-100">
                                </div>
                            </div>
                            <div class="action-bar h-25 d-flex align-items-center justify-content-center">
                                <ul>
                                    <li><a href="#" onclick="document.getElementById('icon').click()"><i class="fa fa-pencil"></i></a></li>
                                    <li><a href="#" id="remove-item-icon"><i class="fa fa-trash-o"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" style="margin-bottom: 12px !important">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-check p-0" style="margin-bottom: 0 !important">
                                <div class="checkbox checkbox-sec m-0">
                                    <input type="checkbox" name="rebate_item" id="rebate-item" class="form-check-input" value="1">
                                    <label for="rebate-item" class="form-check-lable">Rebate Item</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered table-hover" id="storage-locations">
                        <thead>
                            <tr>
                                <th width="70%">LOCATION</th>
                                <th>QTY</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="cursor-pointer">
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
                        </tbody>
                    </table>
                    <a href="#" class="text-info" id="addLocationLine"><i class="fa fa-plus"></i> Add lines</a>
                    <div class="form-group row" style="margin: 0 !important">
                        <label for="asOfDate" class="col-sm-6 col-form-label">As of date*</label>
                        <div class="col-sm-6">
                            <div class="datepicker">
                                <input type="text" class="form-control" id="asOfDate" name="as_of_date" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" style="margin: 0 !important">
                        <label for="reorderPoint" class="col-sm-6 col-form-label">Reorder point</label>
                        <div class="col-sm-6">
                            <input type="number" class="text-right form-control" id="reorderPoint" name="reorder_point">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <label for="inv_asset_account">Inventory asset account</label>
                                <select name="inv_asset_account" id="inv_asset_account" class="form-control" required></select>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" placeholder="Description on sales forms" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <label for="price">Sales price/rate</label>
                                <input type="number" name="price" id="price" step="0.01" class="form-control text-right" onchange="convertToDecimal(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <label for="income_account">Income account</label>
                                <select name="income_account" id="income_account" class="form-control" required></select>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <label for="sales_tax_category">Sales tax category</label>
                                <select name="sales_tax_category" id="sales_tax_category" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Purchasing information</label>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <textarea name="purchase_description" id="purchaseDescription" placeholder="Description on purchase forms" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <label for="cost">Cost</label>
                                <input type="number" name="cost" id="cost" class="form-control text-right" onchange="convertToDecimal(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <label for="item_expense_account">Expense account</label>
                                <select name="item_expense_account" id="item_expense_account" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group" style="margin-bottom: 0 !important">
                                <label for="vendor">Preferred vendor</label>
                                <select name="vendor" id="vendor" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <div class="btn-group dropup float-right">
        <button type="button" class="btn btn-success" id="save-and-close">
            Save and close
        </button>
        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#" id="save-and-new">Save and new</a>
        </div>
    </div>
</div>
</form>