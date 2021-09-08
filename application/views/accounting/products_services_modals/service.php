<div class="modal-header">
    <h3 class="modal-title" id="myModalLabel2" >Product/Service information</h3>
    <button type="button" class="close close-item-modal" aria-label="Close">&times;</button>
</div>
<form id="service-item-form" action="<?=url('accounting/products-and-services/service/create')?>" method="post" enctype="multipart/form-data">
<div class="modal-body">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <div class="row" style="height: 68.5px;">
                        <div class="col-sm-2">
                            <div class="type-icon" style="background-image: url('/assets/img/accounting/service.png')"></div>
                        </div>
                        <div class="col-sm-10 d-flex align-items-center">
                            <h5><span>Service</span></h5> &nbsp;&nbsp; <a href="#" class="text-info" id="select-item-type"><span>Change type</span></a>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="description">Description</label>
                            <div class="form-check p-0">
                                <div class="checkbox checkbox-sec">
                                    <input class="form-check-input" type="checkbox" id="selling" name="selling" value="1" checked>
                                    <label class="form-check-label" for="selling">
                                        I sell this product/service to my customers.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group" style="margin: 0 !important">                                                
                                <textarea name="description" id="description" placeholder="Description on sales forms" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="margin: 0 !important">
                                <label for="price">Sales price/rate</label>
                                <input type="number" name="price" id="price" step="0.01" class="form-control text-right" onchange="convertToDecimal(this)">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="margin: 0 !important">
                                <label for="incomeAccount">Income account</label>
                                <select name="income_account" class="form-control" required></select>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" style="margin: 0 !important">
                                <label for="salesTaxCat">Sales tax category</label>
                                <select name="sales_tax_category" class="form-control"></select>
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
                            <div class="form-check p-0">
                                <div class="checkbox checkbox-sec">
                                    <input class="form-check-input" type="checkbox" id="purchasing" name="purchasing" value="1">
                                    <label class="form-check-label" for="purchasing">
                                        I purchase this product/service from a vendor.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 hide">
                            <div class="form-group" style="margin: 0 !important">
                                <textarea name="purchase_description" id="purchaseDescription" placeholder="Description on purchase forms" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 hide">
                            <div class="form-group" style="margin: 0 !important">
                                <label for="cost">Cost</label>
                                <input type="number" name="cost" id="cost" class="form-control text-right" onchange="convertToDecimal(this)">
                            </div>
                        </div>
                        <div class="col-sm-6 hide">
                            <div class="form-group" style="margin: 0 !important">
                                <label for="expenseAcc">Expense account</label>
                                <select name="item_expense_account" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-sm-12 hide">
                            <div class="form-group" style="margin: 0 !important">
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