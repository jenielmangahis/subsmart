<div id="vendor-modal" class="modal fade modal-fluid nsm-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <!-- Modal content-->
        <?php if(!isset($vendorDetails)) : ?>
        <form id="add-vendor-form">
        <?php else : ?>
        <form action="/accounting/vendors/<?=$vendorDetails->id?>/update" method="post" class="form-validate" novalidate="novalidate" enctype="multipart/form-data">
        <?php endif; ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Vendor Information</span>
                <button type="button" class="cancel-add-vendor" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body overflow-auto">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="row">
                            <div class="col-6 col-md-2">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->title : ''?>">
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="f_name">First name</label>
                                <input type="text" name="f_name" id="f_name" required class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->f_name : ''?>">
                            </div>
                            <div class="col-6 col-md-2">
                                <label for="m_name">Middle name</label>
                                <input type="text" name="m_name" id="m_name" required class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->m_name : ''?>">
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="l_name">Last name</label>
                                <input type="text" name="l_name" id="l_name" required class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->l_name : ''?>">
                            </div>
                            <div class="col-6 col-md-2">
                                <label for="suffix">Suffix</label>
                                <input type="text" name="suffix" id="suffix" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->suffix : ''?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="email">Email</label>
                        <input type="text" class="form-control nsm-field mb-2" name="email" id="email" placeholder="Separate multiple emails with commas" value="<?=isset($vendorDetails) ? $vendorDetails->email : ''?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="company">Company</label>
                        <input type="text" name="company" id="company" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->company : ''?>">
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->phone : ''?>">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->mobile : ''?>">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" id="fax" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->fax : ''?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="display_name"><span class="text-danger">*</span> Display name as</label>
                        <input type="text" name="display_name" id="display_name" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->display_name : ''?>" required>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="website">Website</label>
                        <input type="text" name="website" id="website" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->website : ''?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="print_on_check_name" class="mr-2">Print on check as </label>
                        <div class="form-check d-inline-block">
                            <input type="checkbox" value="1" name="use_display_name" id="use_display_name" class="form-check-input" <?=!isset($vendorDetails) || $vendorDetails->to_display === "1" ? "checked" : ""?>>
                            <label for="use_display_name" class="form-check-label">Use display name</label>
                        </div>
                        <input type="text" name="print_on_check_name" id="print_on_check_name" class="form-control nsm-field mb-2" <?=!isset($vendordetails) || $vendorDetails->to_display === "1" ? "disabled" : ""?> value="<?=isset($vendorDetails) ? $vendorDetails->print_on_check_name : ''?>">
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="billing_rate">Billing rate (/hr)</label>
                                <input type="text" name="billing_rate" id="billing_rate" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->billing_rate : ''?>">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="terms">Terms</label>
                                <select class="form-control nsm-field mb-2" name="terms" id="term">
                                    <?php if(isset($vendorDetials) && !in_array($vendorDetails->terms, [null, '', '0'])) : ?>
                                    <option value="<?=$vendorDetails->terms?>"><?=$this->accounting_terms_model->get_by_id($vendorDetails->terms, logged('company_id'))->name?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="street mr-2">Address</label>
                        <a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                        <textarea name="street" id="street" cols="30" rows="2" class="form-control nsm-field mb-2" placeholder="Street" required><?=isset($vendorDetails) ? $vendorDetails->street : ''?></textarea>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="opening_balance">Opening balance</label>
                                <input type="text" name="opening_balance" id="opening_balance" class="form-control nsm-field mb-2" <?=isset($vendorDetails) ? 'disabled' : ''?> value="<?=isset($vendorDetails) && $vendorDetails->opening_balance !== null && $vendorDetails->opening_balance !== "" ? number_format(floatval($vendorDetails->opening_balance), 2, '.', ',') : ""?>">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="opening_balance_as_of_date">as of</label>
                                <div class="nsm-field-group calendar">
                                    <input type="text" name="opening_balance_as_of_date" id="opening_balance_as_of_date" class="form-control nsm-field mb-2 date" <?=isset($vendorDetails) ? 'disabled' : ''?> value="<?=isset($vendorDetails) ? date("m/d/Y", strtotime($vendorDetails->opening_balance_as_of_date)) : date("m/d/Y")?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="row h-100 align-items-end">
                            <div class="col-12 col-md-6">
                                <input name="city" type="text" class="form-control nsm-field mb-2" placeholder="City/Town" value="<?=isset($vendorDetails) ? $vendorDetails->city : ''?>" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="state" type="text" class="form-control nsm-field mb-2" placeholder="State/Province" value="<?=isset($vendorDetails) ? $vendorDetails->state : ''?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="account_number">Account no.</label>
                        <input type="text" name="account_number" id="account_number" class="form-control nsm-field mb-2" placeholder="Appears in the memo of all payment" value="<?=isset($vendorDetails) ? $vendorDetails->account_number : ''?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="row h-100 align-items-end">
                            <div class="col-12 col-md-6">
                                <input name="zip" type="text" class="form-control nsm-field mb-2" placeholder="ZIP Code" value="<?=isset($vendorDetails) ? $vendorDetails->zip : ''?>" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="country" type="text" class="form-control nsm-field mb-2" placeholder="Country" value="<?=isset($vendorDetails) ? $vendorDetails->country : ''?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="tax_id">Business ID No. / Social Security No.</label>
                        <input type="text" name="tax_id" id="tax_id" class="form-control nsm-field mb-2" value="<?=isset($vendorDetails) ? $vendorDetails->tax_id : ''?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" cols="30" rows="2" class="form-control nsm-field mb-2"><?=isset($vendorDetails) ? $vendorDetails->notes : ''?></textarea>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="expense_account">Default expense account</label>
                        <select name="default_expense_account" id="expense_account" class="form-control nsm-field mb-2">
                            <?php if(isset($vendorDetails) && !in_array($vendorDetails->default_expense_account, [null, '', '0'])) : ?>
                            <option value="<?=$vendorDetails->default_expense_account?>"><?=$this->chart_of_accounts_model->getById($vendorDetails->default_expense_account)->name?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-7">
                        <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                        <span>Maximum size: 20MB</span>
                        <div id="vendAtt" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                            <div class="dz-message" style="margin: 20px;border">
                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                            </div>
                        </div>
                        <?php if(isset($attachments) && count($attachments) > 0) : ?>
                            <?php foreach($attachments as $attachment) : ?>
                                <input type="hidden" name="attachments[]" value="<?=$attachment->id?>">
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-12 col-md-6">
                        <button type="button" class="nsm-button cancel-add-vendor" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="nsm-button success float-end" name="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>