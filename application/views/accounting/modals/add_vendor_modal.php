<div id="new-vendor-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg m-auto">
        <!-- Modal content-->
        <form id="add-vendor-form">
        <div class="modal-content max-width">
            <div class="modal-header" style="border-bottom: 0">
                <div class="modal-title">Vendor Information</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body overflow-auto">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card p-0 m-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col-sm-2">
                                                    <div class="form-ib">
                                                        <label for="title">Title</label>
                                                        <input type="text" name="title" id="title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="f_name">First name</label>
                                                        <input type="text" name="f_name" id="f_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="m_name">Middle name</label>
                                                        <input type="text" name="m_name" id="m_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="l_name">Last name</label>
                                                        <input type="text" name="l_name" id="l_name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-ib">
                                                        <label for="suffix">Suffix</label>
                                                        <input type="text" name="suffix" id="suffix" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="company">Company</label>
                                                        <input type="text" name="company" id="company" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="display_name"><span class="text-danger">*</span> Display name as</label>
                                                        <input type="text" name="display_name" id="display_name" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="print_on_check_name" style="margin-right: 10px">Print on check as </label>
                                                        <input type="checkbox" value="1" name="use_display_name" id="use_display_name" checked><label for="use_display_name" class="ml-3">Use display name</label>
                                                        <input type="text" name="print_on_check_name" id="print_on_check_name" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col-12">
                                                    <div class="form-ib">
                                                        <label for="street" style="margin-right: 10px">Address</label>
                                                        <a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                                        <textarea name="street" id="street" cols="30" rows="2" class="form-control" placeholder="Street" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-ib mt-1">
                                                        <input name="city" type="text" class="form-control" placeholder="City/Town" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-ib mt-1">
                                                        <input name="state" type="text" class="form-control" placeholder="State/Province" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-ib mt-1">
                                                        <input name="zip" type="text" class="form-control" placeholder="ZIP Code" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-ib mt-1">
                                                        <input name="country" type="text" class="form-control" placeholder="Country" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="notes">Notes</label>
                                                        <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="vendAtt" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                            <div class="dz-message" style="margin: 20px;border">
                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <h4>Get custom fields with Advanced</h4>
                                            <p>Custom fields let you add more detailed info about your customers and transactions.
                                                Sort, track, and report info that's important to you.
                                            </p>
                                            <a href="#" style="color: #0b97c4;">Learn more</a>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control" name="email" id="email" placeholder="Separate multiple emails with commas">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" name="phone" id="phone" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="mobile">Mobile</label>
                                                        <input type="text" name="mobile" id="mobile" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="fax">Fax</label>
                                                        <input type="text" name="fax" id="fax" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="website">Website</label>
                                                        <input type="text" name="website" id="website" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="billing_rate">Billing rate (/hr)</label>
                                                        <input type="text" name="billing_rate" id="billing_rate" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="terms">Terms</label>
                                                        <select class="form-control" name="terms" id="terms">
                                                            <option value="" selected disabled>&nbsp;</option>
                                                            <option value="add-new">&plus; Add new</option>
                                                            <?php if(count($terms) > 0) : ?>
                                                            <?php foreach($terms as $term) : ?>
                                                                <option value="<?=$term->id?>"><?=$term->name?></option>
                                                            <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="opening_balance">Opening balance</label>
                                                        <input type="text" name="opening_balance" id="opening_balance" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="opening_balance_as_of_date">as of</label>
                                                        <input type="text" name="opening_balance_as_of_date" id="opening_balance_as_of_date" class="form-control datepicker" value="<?=date("m/d/Y")?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="account_number">Account no.</label>
                                                        <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Appears in the memo of all payment" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="">Business ID No. / Social Security No.</label>
                                                        <input type="text" name="tax_id" id="tax_id" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="expense_account">Default expense account</label>
                                                        <select name="default_expense_account" id="expense_account" class="form-control">
                                                            <option value="" selected disabled>Choose Account</option>
                                                            <?php if(count($expenseAccs) > 0) : ?>
                                                                <optgroup label="Expenses">
                                                                <?php foreach($expenseAccs as $expenseAcc) : ?>
                                                                    <option value="<?=$expenseAcc->id?>"><?=$expenseAcc->name?></option>

                                                                    <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($expenseAcc->id); ?>
                                                                    <?php if(count($childAccs) > 0) : ?>
                                                                        <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$expenseAcc->name?>">
                                                                        <?php foreach($childAccs as $childAcc) : ?>
                                                                            <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                        <?php endforeach; ?>
                                                                        </optgroup>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                </optgroup>
                                                            <?php endif; ?>
                                                            <?php if(count($otherExpenseAccs) > 0) : ?>
                                                                <optgroup label="Other Expenses">
                                                                <?php foreach($otherExpenseAccs as $otherExpenseAcc) : ?>
                                                                    <option value="<?=$otherExpenseAcc->id?>"><?=$otherExpenseAcc->name?></option>

                                                                    <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($otherExpenseAcc->id); ?>
                                                                    <?php if(count($childAccs) > 0) : ?>
                                                                        <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$otherExpenseAcc->name?>">
                                                                        <?php foreach($childAccs as $childAcc) : ?>
                                                                            <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                        <?php endforeach; ?>
                                                                        </optgroup>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                </optgroup>
                                                            <?php endif; ?>
                                                            <?php if(count($cogsAccs) > 0) : ?>
                                                                <optgroup label="Cost of Goods Sold">
                                                                <?php foreach($cogsAccs as $cogsAcc) : ?>
                                                                    <option value="<?=$cogsAcc->id?>">&nbsp;<?=$cogsAcc->name?></option>

                                                                    <?php $childAccs = $this->chart_of_accounts_model->getChildAccounts($cogsAcc->id); ?>
                                                                    <?php if(count($childAccs) > 0) : ?>
                                                                        <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Sub-accounts of <?=$cogsAcc->name?>">
                                                                        <?php foreach($childAccs as $childAcc) : ?>
                                                                            <option value="<?=$childAcc->id?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$childAcc->name?></option>
                                                                        <?php endforeach; ?>
                                                                        </optgroup>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                </optgroup>
                                                            <?php endif; ?>
                                                        </select>
                                                        <!-- <input type="text" name="default_expense_amount" id="expense_account" class="form-control" placeholder="Choose Account" required> -->
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
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-md-6"><button type="button" class="btn btn-transparent" id="cancel-add-vendor">Cancel</button></div>
                    <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>