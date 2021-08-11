<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="expenseModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title"><a href="#"><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>Expense <span></span></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="payee">Payee</label>
                                                        <select name="payee" id="payee" class="form-control">
                                                            <option value="" disabled selected>&nbsp;</option>
                                                            <!-- <option value="add-new">&plus; Add new</option> -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="payment_account">Payment account</label>
                                                        <select name="payment_account" id="payment_account" class="form-control" required>
                                                            <?php foreach($dropdown['payment_accounts'] as $accType => $accounts) : ?>
                                                                <optgroup label="<?=$accType?>">
                                                                    <?php foreach($accounts as $account) : ?>
                                                                        <option value="<?=$account->id?>"><?=$account->name?></option>

                                                                        <?php if(count($account->childAccs) > 0) : ?>
                                                                            <optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                                                <?php foreach($account->childAccs as $childAcc) : ?>
                                                                                    <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                                <?php endforeach; ?>
                                                                            </optgroup>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </optgroup>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 d-flex ">
                                                    <p style="align-self: flex-end; margin-bottom: 30px">Balance <span id="account-balance"><?= $balance ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">AMOUNT</h6>
                                            <h2 class="text-right">$<span class="transaction-total-amount">0.00</span></h2>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment_date">Payment date</label>
                                                <input type="text" name="payment_date" id="payment_date" class="form-control date" value="<?=date("m/d/Y")?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment_method">Payment method</label>
                                                <select name="payment_method" id="payment_method" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="ref_no">Ref no.</label>
                                                <input type="text" name="ref_no" id="ref_no" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="permit_number">Permit no.</label>
                                                <input type="number" class="form-control" name="permit_number" id="permit_number"> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div id="label">
                                                    <label for="tags">Tags</label>
                                                    <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                                </div>
                                                <select name="tags[]" id="tags" class="form-control" multiple="multiple"></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="category-details">
                                                <button class="btn" type="button" data-toggle="collapse" data-target="#category-details" aria-expanded="true" aria-controls="category-details">
                                                    <i class="fa fa-caret-down"></i> Category details
                                                </button>
                                                <div class="collapse show" id="category-details">
                                                    <div class="category-details-table-container w-100">
                                                        <div class="category-details-table">
                                                            <table class="table table-bordered table-hover clickable" id="category-details-table">
                                                                <thead>
                                                                    <th></th>
                                                                    <th class="text-right">#</th>
                                                                    <th width="15%">EXPENSE NAME</th>
                                                                    <th width="10%">CATEGORY</th>
                                                                    <th>DESCRIPTION</th>
                                                                    <th width="10%">AMOUNT</th>
                                                                    <th width="3%">BILLABLE</th>
                                                                    <th width="10%">MARKUP %</th>
                                                                    <th width="3%">TAX</th>
                                                                    <th width="15%">CUSTOMER</th>
                                                                    <th></th>
                                                                </thead>
                                                                <tbody class="cursor-pointer">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>1</td>
                                                                        <td>
                                                                            <select name="expense_name[]" class="form-control" required>
                                                                                <option value="" selected disabled>&nbsp;</option>
                                                                                <?php foreach($dropdown['categories'] as $accType => $accounts) : ?>
                                                                                    <optgroup label="<?=$accType?>">
                                                                                        <?php foreach($accounts as $account) : ?>
                                                                                            <option value="<?=$account->id?>"><?=$account->name?></option>

                                                                                            <?php if(count($account->childAccs) > 0) : ?>
                                                                                                <optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of <?=$account->name?>">
                                                                                                    <?php foreach($account->childAccs as $childAcc) : ?>
                                                                                                        <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                                                    <?php endforeach; ?>
                                                                                                </optgroup>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; ?>
                                                                                    </optgroup>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="category[]" class="form-control">
                                                                                <option disabled selected>&nbsp;</option>
                                                                                <option value="fixed">Fixed Cost</option>
                                                                                <option value="variable">Variable Cost</option>
                                                                                <option value="periodic">Periodic Cost</option>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" name="description[]" class="form-control"></td>
                                                                        <td><input type="number" name="category_amount[]" onchange="convertToDecimal(this)" class="form-control text-right" step=".01"></td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <input type="checkbox" name="category_billable[]" class="form-check" value="1">
                                                                            </div>
                                                                        </td>
                                                                        <td><input type="number" name="category_markup[]" class="form-control" onchange="convertToDecimal(this)"></td>
                                                                        <td>
                                                                            <div class="d-flex align-items-center justify-content-center">
                                                                                <input type="checkbox" name="category_tax[]" class="form-check" value="1">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <select name="category_customer[]" class="form-control"></select>
                                                                        </td>
                                                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>2</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-footer">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button" class="btn btn-outline-secondary border" data-target="#category-details-table" onclick="addTableLines(event)">Add lines</button>
                                                                    <button type="button" class="btn btn-outline-secondary border" data-target="#category-details-table" onclick="clearTableLines(event)">Clear all lines</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-details">
                                                <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#item-details" aria-expanded="false" aria-controls="item-details">
                                                    <i class="fa fa-caret-right"></i> Item details
                                                </button>
                                                <div class="collapse" id="item-details">
                                                    <div class="item-details-table-container w-100">
                                                        <div class="item-details-table">
                                                            <table class="table table-bordered table-hover" id="item-details-table">
                                                                <thead>
                                                                    <th width="20%">PRODUCT/SERVICE</th>
                                                                    <th>TYPE</th>
                                                                    <th width="10%">LOCATION</th>
                                                                    <th width="10%">QUANTITY</th>
                                                                    <th width="10%">PRICE</th>
                                                                    <th width="10%">DISCOUNT</th>
                                                                    <th width="10%">TAX (CHANGE IN %)</th>
                                                                    <th>TOTAL</th>
                                                                    <th width="3%"></th>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                        <div class="item-details-table-footer">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a class="link-modal-open" href="#" id="add_another_items" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                                                    <!-- <button type="button" class="btn btn-outline-secondary border" data-target="#item-details-table" onclick="addTableLines(event)">Add lines</button>
                                                                    <button type="button" class="btn btn-outline-secondary border" data-target="#item-details-table" onclick="clearTableLines(event)">Clear all lines</button> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="memo">Memo</label>
                                                        <textarea name="memo" id="memo" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="attachments">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="expense-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                            <div class="dz-message" style="margin: 20px;border">
                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="m-0 text-right">Total : $<span class="transaction-total-amount">0.00</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4 d-flex">
                            <a href="#" class="text-white m-auto">Make Recurring</a>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" id="save-and-new">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="save-and-close">Save and close</a>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary btn-rounded border float-right mr-2" id="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>