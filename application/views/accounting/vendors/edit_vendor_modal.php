<div id="edit-vendor-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg m-auto">
        <!-- Modal content-->
        <form action="/accounting/vendors/<?=$vendorDetails->id?>/update" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
        <div class="modal-content max-width">
            <div class="modal-header" style="border-bottom: 0">
                <div class="modal-title">Vendor Information</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
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
                                                        <input type="text" name="title" id="title" class="form-control" value="<?=$vendorDetails->title?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="f_name">First name</label>
                                                        <input type="text" name="f_name" id="f_name" class="form-control" value="<?=$vendorDetails->f_name?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="m_name">Middle name</label>
                                                        <input type="text" name="m_name" id="m_name" class="form-control" value="<?=$vendorDetails->m_name?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="l_name">Last name</label>
                                                        <input type="text" name="l_name" id="l_name" class="form-control" value="<?=$vendorDetails->l_name?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-ib">
                                                        <label for="suffix">Suffix</label>
                                                        <input type="text" name="suffix" id="suffix" class="form-control" value="<?=$vendorDetails->suffix?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="company">Company</label>
                                                        <input type="text" name="company" id="company" class="form-control" value="<?=$vendorDetails->company?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="display_name"><span class="text-danger">*</span> Display name as</label>
                                                        <input type="text" name="display_name" id="display_name" class="form-control" required value="<?=$vendorDetails->display_name?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="print_on_check_name" style="margin-right: 10px">Print on check as </label>
                                                        <input type="checkbox" value="1" name="use_display_name" id="use_display_name" <?=$vendorDetails->to_display === "1" ? "checked" : ""?>><label for="use_display_name" class="ml-3">Use display name</label>
                                                        <input type="text" name="print_on_check_name" id="print_on_check_name" class="form-control" <?=$vendorDetails->to_display === "1" ? "disabled" : ""?> value="<?=$vendorDetails->print_on_check_name?>">
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
                                                        <textarea name="street" id="street" cols="30" rows="2" class="form-control" placeholder="Street" required><?=$vendorDetails->street?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-ib mt-1">
                                                        <input name="city" type="text" class="form-control" placeholder="City/Town" required value="<?=$vendorDetails->city?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-ib mt-1">
                                                        <input name="state" type="text" class="form-control" placeholder="State/Province" required value="<?=$vendorDetails->state?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-ib mt-1">
                                                        <input name="zip" type="text" class="form-control" placeholder="ZIP Code" required value="<?=$vendorDetails->zip?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-ib mt-1">
                                                        <input name="country" type="text" class="form-control" placeholder="Country" required value="<?=$vendorDetails->country?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="notes">Notes</label>
                                                        <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"><?=$vendorDetails->notes?></textarea>
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
                                                        <div id="vendorAttachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                            <div class="dz-message" style="margin: 20px;border">
                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                            </div>
                                                        </div>
                                                        <?php if(count($attachments) > 0) : ?>
                                                            <?php foreach($attachments as $attachment) : ?>
                                                                <input type="hidden" name="attachments[]" value="<?=$attachment->id?>">
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
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
                                                        <input type="text" class="form-control" name="email" id="email" placeholder="Separate multiple emails with commas" value="<?=$vendorDetails->email?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" name="phone" id="phone" class="form-control" value="<?=$vendorDetails->phone?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="mobile">Mobile</label>
                                                        <input type="text" name="mobile" id="mobile" class="form-control" value="<?=$vendorDetails->mobile?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="fax">Fax</label>
                                                        <input type="text" name="fax" id="fax" class="form-control" value="<?=$vendorDetails->fax?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="website">Website</label>
                                                        <input type="text" name="website" id="website" class="form-control" value="<?=$vendorDetails->website?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="billing_rate">Billing rate (/hr)</label>
                                                        <input type="text" name="billing_rate" id="billing_rate" class="form-control" value="<?=$vendorDetails->billing_rate?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="terms">Terms</label>
                                                        <select class="form-control" name="terms" id="terms">
                                                            <?php if(!in_array($vendorDetails->terms, [null, '', '0'])) : ?>
                                                            <option value="<?=$vendorDetails->terms?>"><?=$this->accounting_terms_model->get_by_id($vendorDetails->terms, logged('company_id'))->name?></option>
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
                                                        <input type="text" name="opening_balance" id="opening_balance" class="form-control" value="<?=$vendorDetails->opening_balance !== null && $vendorDetails->opening_balance !== "" ? number_format(floatval($vendorDetails->opening_balance), 2, '.', ',') : ""?>">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="opening_balance_as_of_date">as of</label>
                                                        <input type="text" name="opening_balance_as_of_date" id="opening_balance_as_of_date" class="form-control datepicker" value="<?=date("m/d/Y", strtotime($vendorDetails->opening_balance_as_of_date))?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="account_number">Account no.</label>
                                                        <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Appears in the memo of all payment" value="<?=$vendorDetails->account_number?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ib-group">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-ib">
                                                        <label for="">Business ID No. / Social Security No.</label>
                                                        <input type="text" name="tax_id" id="tax_id" class="form-control" required value="<?=$vendorDetails->tax_id?>">
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
                                                            <?php if(!in_array($vendorDetails->default_expense_account)) : ?>
                                                                <option value="<?=$vendorDetails->default_expense_account?>"><?=$this->chart_of_accounts_model->getById($vendorDetails->default_expense_account)->name?></option>
                                                            <?php endif; ?>
                                                        </select>
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
                    <div class="col-md-6"><button type="button" class="btn btn-transparent" data-dismiss="modal">Cancel</button></div>
                    <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>