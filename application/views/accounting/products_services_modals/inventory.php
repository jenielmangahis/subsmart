<!--    Modal for creating rules-->
<div class="modal-right-side">
    <div class="modal right fade" id="inventory-form-modal" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel2" >Product/Service information</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
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
                                            <h5><span>Inventory</span></h5> &nbsp;&nbsp; <a href="#" class="text-info" onclick="selectType('inventory')"><span>Change type</span></a>
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
                                                <label for="name">Name <span class="text-alert">*</span></label>
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
                                                    <li><a href="#" onclick="document.getElementById('icon').click()"><i class="fa fa-pencil"></i></li>
                                                    <li><a href="#" onclick="removeIcon()"><i class="fa fa-trash-o"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group" style="margin-bottom: 0 !important">
                                                <label for="category">Category</label>
                                                <select name="category" id="category" class="form-control">
                                                    <option value="">&nbsp;</option>
                                                    <?php foreach($this->items_model->getItemCategories() as $category) : ?>
                                                        <option value="<?=$category->item_categories_id?>"><?=$category->name?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group row" style="margin: 0 !important">
                                        <label for="initialQuantity" class="col-sm-6 col-form-label">Initial quantity on hand *</label>
                                        <div class="col-sm-6">
                                            <input type="number" class=" text-right form-control" id="initialQuantity" name="initial_quantity">
                                        </div>
                                    </div>
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
                                                <label for="invAssetAcc">Inventory asset account</label>
                                                <select name="inv_asset_acc" id="invAssetAcc" class="form-control" required>
                                                    <?php if(count($inventory_asset_accounts) > 0) : ?>
                                                        <?php foreach($inventory_asset_accounts as $invAssetAcc) : ?>
                                                            <option value="<?=$invAssetAcc->id?>"><?=$invAssetAcc->name?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
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
                                                <label for="incomeAccount">Income account</label>
                                                <select name="income_account" id="incomeAccount" class="form-control" required>
                                                    <?php if(count($income_accounts) > 0) : ?>
                                                        <?php foreach($income_accounts as $incomeAcc) : ?>
                                                            <option value="<?=$incomeAcc->id?>"><?=$incomeAcc->name?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
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
                                                <label for="salesTaxCat">Sales tax category</label>
                                                <select name="sales_tax_cat" id="salesTaxCat" class="form-control">
                                                    <?php if(count($tax_rates) > 0) : ?>
                                                        <?php foreach($tax_rates as $taxRate) : ?>
                                                            <option value="<?=$taxRate->id?>"><?=$taxRate->name?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>  
                                                </select>
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
                                                <label for="expenseAcc">Expense account</label>
                                                <select name="expense_account" id="expenseAcc" class="form-control">
                                                    <?php if(count($expense_accounts) > 0) : ?>
                                                        <?php foreach($expense_accounts as $expenseAcc) : ?>
                                                            <option value="<?=$expenseAcc->id?>"><?=$expenseAcc->name?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group" style="margin-bottom: 0 !important">
                                                <label for="vendor">Preferred vendor</label>
                                                <select name="vendor_id" id="vendor" class="form-control">
                                                    <?php if(count($vendors) > 0) : ?>
                                                        <?php foreach($vendors as $vendor) : ?>
                                                            <option value="<?=$vendor->id?>"><?=$vendor->f_name . ' ' . $vendor->l_name;?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
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
                        <button type="submit" class="btn btn-success">
                            Save and close
                        </button>
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Save and new</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--    end of modal-->