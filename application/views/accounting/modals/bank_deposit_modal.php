<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="depositModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Bank Deposit</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row bank-account-details">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="bankAccount">Account</label>
                                                        <select name="bank_account" id="bankAccount" class="form-control" required>
                                                            <?php foreach($accounts as $key => $value) : ?>
                                                                <optgroup label="<?= $key ?>">
                                                                    <?php foreach($value as $account) : ?>
                                                                        <option value="<?= $account['value'] ?>" <?= $account['selected'] === true ? 'selected' : '' ?>><?= $account['text'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </optgroup>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 d-flex ">
                                                    <p style="align-self: flex-end; margin-bottom: 30px">Balance <span id="account-balance"><?= $balance ?></span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="date">Date</label>
                                                        <input type="text" class="form-control date" name="date" id="date" value="<?php echo date('m/d/Y') ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="text-right">AMOUNT</h6>
                                            <h2 class="text-right total-deposit-amount">$0.00</h2>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                        <div class="col-md-12 mb-5">
                                            <a href="#" class="text-info mb-3">Don't see the payments you want to deposit?</a>

                                            <div class="funds-table-container w-100">
                                                <div class="funds-table-header">
                                                    <h4>Add funds to this deposit</h4>
                                                </div>
                                                <div class="funds-table">
                                                    <table class="table table-bordered table-hover clickable" id="bank-deposit-table">
                                                        <thead>
                                                            <th></th>
                                                            <th>#</th>
                                                            <th width="20%">RECEIVED FROM</th>
                                                            <th width="20%">ACCOUNT</th>
                                                            <th>DESCRIPTION</th>
                                                            <th>PAYMENT METHOD</th>
                                                            <th>REF NO.</th>
                                                            <th width="10%">AMOUNT</th>
                                                            <th></th>
                                                        </thead>
                                                        <tbody class="cursor-pointer">
                                                            <tr>
                                                                <td></td>
                                                                <td>1</td>
                                                                <td>
                                                                    <select name="received_from[]" class="form-control">
                                                                        <option value="" disabled selected>&nbsp;</option>
                                                                        <?php if(count($dropdown['customers']) !== 0) : ?>
                                                                        <optgroup label="Customers">
                                                                            <?php foreach($dropdown['customers'] as $customer) :?>
                                                                                <option value="customer-<?php echo $customer->prof_id; ?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                                            <?php endforeach; ?>
                                                                        </optgroup>
                                                                        <?php endif; ?>
                                                                        <?php if(count($dropdown['vendors']) !== 0) : ?>
                                                                        <optgroup label="Vendors">
                                                                            <?php foreach($dropdown['vendors'] as $vendor):?>
                                                                                <option value="vendor-<?php echo $vendor->id;?>"><?php echo $vendor->f_name . ' ' . $vendor->l_name;?></option>
                                                                            <?php endforeach; ?> 
                                                                        </optgroup>
                                                                        <?php endif; ?>
                                                                        <?php if(count($dropdown['employees']) !== 0) : ?>
                                                                        <optgroup label="Employees">
                                                                            <?php foreach($dropdown['employees'] as $employee):?>
                                                                                <option value="employee-<?php echo $employee->id;?>"><?php echo $employee->FName . ' ' . $employee->LName;?></option>
                                                                            <?php endforeach; ?> 
                                                                        </optgroup>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="account[]" class="form-control" required>
                                                                        <option value="" disabled selected>&nbsp;</option>
                                                                        <?php foreach($accounts as $key => $value) : ?>
                                                                            <optgroup label="<?= $key ?>">
                                                                                <?php foreach($value as $account) : ?>
                                                                                    <option value="<?= $account['value'] ?>"><?= $account['text'] ?></option>
                                                                                    <?php $count++; ?>
                                                                                <?php endforeach; ?>
                                                                            </optgroup>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="description[]" class="form-control"></td>
                                                                <td>
                                                                    <select name="payment_method[]" class="form-control">
                                                                        <option value="" disabled selected>&nbsp;</option>
                                                                        <option value="1">Cash</option>
                                                                        <option value="2">Check</option>
                                                                        <option value="3">Credit Card</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="reference_no[]" class="form-control"></td>
                                                                <td><input type="number" name="amount[]" class="form-control text-right" step=".01" onchange="updateBankDepositTotal(this)" required></td>
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
                                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="funds-table-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-outline-secondary border" data-target="#bank-deposit-table" onclick="addTableLines(event)">Add lines</button>
                                                            <button type="button" class="btn btn-outline-secondary border" data-target="#bank-deposit-table" onclick="clearTableLines(event)">Clear all lines</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="other-funds-total">
                                                                <span class="float-right ml-5 other-funds-total">$0.00</span>
                                                                <span class="float-right">Other funds total</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" id="memo" class="form-control w-50"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="cashBackTarget">Cash back goes to</label>
                                                        <select name="cash_back_target" id="cashBackTarget" class="form-control" required>
                                                        <?php foreach($accounts as $key => $value) : ?>
                                                            <optgroup label="<?= $key ?>">
                                                                <?php foreach($value as $account) : ?>
                                                                    <option value="<?= $account['value'] ?>"><?= $account['text'] ?></option>
                                                                    <?php $count++; ?>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="cashBackMemo">Cash back memo</label>
                                                        <textarea name="cash_back_memo" id="cashBackMemo" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="cashBackAmount">Cash back amount</label>
                                                        <input type="number" name="cash_back_amount" id="cashBackAmount" step=".01" onchange="updateBankDepositTotal(this)" class="form-control text-right">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="cash-back-total">
                                                        <span class="float-right ml-5 total-cash-back">$0.00</span>
                                                        <span class="float-right">Total </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="bank-deposit-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                    <div class="dz-message" style="margin: 20px;border">
                                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                    </div>
                                                </div>
                                            </div>
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
                        <div class="col-md-4">
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" onclick="viewPrint(1, 'deposit-summary')" class="text-white">Print deposit summary</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" onclick="makeRecurring('bank_deposit')" class="text-white">Make recurring</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="submit" class="btn btn-success">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save and close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>
<!-- Modal for print -->
<div class="full-screen-modal">
    <div id="showPdfModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Print preview</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <iframe id="showPdf" src="/accounting/show-pdf" frameborder="0" style="width: 100%;    height: 700px;"></iframe>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success btn-rounded float-right" id="print-deposit-pdf">Print</button>
                            <a class="btn btn-secondary btn-rounded border float-right mr-3 text-white cursor-pointer" id="download-pdf" target="_blank">Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>