<div class="modal-header">
    <span class="modal-title content-title">Product/Service information</span>
    <button type="button" aria-label="Close" class="close-item-modal"><i class="bx bx-fw bx-x m-0"></i></button>
</div>
<form id="non-inventory-item-form" class="h-100" action="<?=url('accounting/products-and-services/non-inventory/create')?>" method="post" enctype="multipart/form-data">
<div class="modal-body">
    <table class="table">
        <thead>
            <tr>
                <th>
                    <div class="row" style="height: 68.5px;">
                        <div class="col-12 col-sm-2">
                            <div class="type-icon" style="width: 72px;  background-image: url('<?php echo base_url(); ?>assets/img/accounting/non-inventory.png')"></div>
                        </div>
                        <div class="col-12 col-sm-10 d-flex align-items-center">
                            <h5><span>Non-inventory</span></h5> &nbsp;&nbsp; <a href="#" class="text-decoration-none" id="select-item-type"><span>Change type</span></a>
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="mb-2">
                                <label for="name">Name *</label>
                                <textarea name="name" id="name" class="form-control nsm-field" required></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" id="sku" class="form-control nsm-field" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="file" name="icon" id="icon" class="d-none">
                            <div class="icon-preview h-75">
                                <div class="no-icon border" onclick="document.getElementById('icon').click()"></div>
                                <div class="preview-uploaded border d-none" onclick="document.getElementById('icon').click()">
                                    <img src="" alt="Preview image" class="image-prev w-100">
                                </div>
                            </div>
                            <ul class="h-25 d-flex justify-content-around list-unstyled">
                                <li class="d-flex align-items-center"><a href="#" onclick="document.getElementById('icon').click()" class="text-muted"><i class="bx bx-fw bx-pencil"></i></a></li>
                                <li class="d-flex align-items-center"><a href="#" id="remove-item-icon" class="text-muted"><i class="bx bx-fw bx-trash"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control nsm-field"></select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" name="rebate_item" id="rebate-item" class="form-check-input" value="1">
                                <label for="rebate-item" class="form-check-lable">Rebate Item</label>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="description">Description</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selling" name="selling" value="1" checked>
                                <label class="form-check-label" for="selling">I sell this product/service to my customers.</label>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <textarea name="description" id="description" placeholder="Description on sales forms" class="form-control nsm-field"></textarea>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label for="price">Sales price/rate</label>
                            <input type="number" name="price" id="price" required step="0.01" class="form-control nsm-field text-end" onchange="convertToDecimal(this)">
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label for="income_account">Income account</label>
                            <select name="income_account" id="income_account" class="form-control nsm-field" required></select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <label for="sales_tax_category">Sales tax category</label>
                            <select name="sales_tax_category" id="sales_tax_category" class="form-control nsm-field"></select>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <label>Purchasing information</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="purchasing" name="purchasing" value="1">
                                <label class="form-check-label" for="purchasing">I purchase this product/service from a vendor.</label>
                            </div>
                        </div>
                        <div class="col-12 mb-2 d-none">
                            <textarea name="purchase_description" id="purchaseDescription" placeholder="Description on purchase forms" class="form-control nsm-field"></textarea>
                        </div>
                        <div class="col-12 col-md-6 mb-2 d-none">
                            <label for="cost">Cost</label>
                            <input type="number" name="cost" id="cost" class="form-control nsm-field text-end" onchange="convertToDecimal(this)">
                        </div>
                        <div class="col-12 col-sm-6 mb-2 d-none">
                            <label for="item_expense_account">Expense account</label>
                            <select name="item_expense_account" id="item_expense_account" class="form-control nsm-field"></select>
                        </div>
                        <div class="col-12 d-none">
                            <label for="vendor">Preferred vendor</label>
                            <select name="vendor" id="vendor" class="form-control nsm-field"></select>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="footer-button">
        <div class="btn-group dropup float-end" role="group">
            <button type="button"  class="nsm-button success" id="save-and-close">
                Save and close
            </button>
            <div class="btn-group" role="group">
                <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-fw bx-chevron-up text-white"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" id="save-and-new">Save and new</a>
                </div>
            </div>
        </div>    
    </div>    
</div>

<!-- <div class="modal-footer position-fixed w-100 bottom-0 bg-white">
    <div class="btn-group dropup float-end" role="group">
        <button type="button"  class="nsm-button success" id="save-and-close">
            Save and close
        </button>
        <div class="btn-group" role="group">
            <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-fw bx-chevron-up text-white"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" id="save-and-new">Save and new</a>
            </div>
        </div>
    </div>
</div> -->
</form>
