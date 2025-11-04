<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-credit-card"></i>Payment Details</span>
        </div>
    </div>
    <div class="nsm-card-content" <?= isCustomerFieldEnabled($companyFormSetting, 'billing-information', 'bill_method') == 0 ? 'style="display:none;"' : ''; ?>>
        <hr>     
        <div class="row form_line">
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'billing-information', 'bill_method'); ?></div>
            <div class="col-md-6">
                <select id="bill_method" name="bill_method" data-customer-source="dropdown" class="input_select searchable-dropdown">
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'CC' ?  'selected' : '';?> value="CC">Credit Card</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'DC' ?  'selected' : '';?> value="DC">Debit Card</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'CHECK' ?  'selected' : '';?> value="CHECK">Check</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'CASH' ?  'selected' : '';?> value="CASH">Cash</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'ACH' ?  'selected' : '';?> value="ACH">ACH</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'VENMO' ?  'selected' : '';?> value="VENMO">Venmo</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'PP' ?  'selected' : '';?> value="PP">Paypal</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'SQ' ?  'selected' : '';?> value="SQ">Square</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'WW' ?  'selected' : '';?> value="WW">Warranty Work</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'HOF' ?  'selected' : '';?> value="HOF">Home Owner Financing</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'eT' ?  'selected' : '';?> value="eT">e-Transfer</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'Invoicing' ?  'selected' : '';?> value="Invoicing">Invoicing</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'APPLE PAY' ?  'selected' : '';?> value="APPLE PAY">Apple Pay</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'OCCP' ?  'selected' : '';?> value="OCCP">Other Credit Card Processor</option>
                    <option <?= isset($billing_info) && $billing_info->bill_method == 'OPT' ?  'selected' : '';?> value="OPT">Other Payment Type</option>                    
                </select>
            </div>
        </div>

        <div class="row form_line invoicing_field" <?= isCustomerFieldEnabled($companyFormSetting, 'payment-details', 'bill_method') == 0 ? 'style="display:none;"' : ''; ?>>
            <div class="col-md-6"><?= getCustomerFieldValue($companyFormSetting, 'payment-details', 'bill_method'); ?></div>
            <div class="col-md-6">
                <select id="invoice_term" name="invoice_term" data-customer-source="dropdown" class="input_select" >
                    <option  value="Due On Receipt">Due On Receipt</option>
                    <option  value="Net 5">Net 5</option>
                    <option  value="Net 10">Net 10</option>
                    <option  value="Net 15">Net 15</option>
                    <option  value="Net 30">Net 30</option>
                    <option  value="Net 60">Net 60</option>
                </select>
            </div>
        </div>

        <div class="row form_line invoicing_field">
            <div class="col-md-6">
                Invoice Date
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="invoice_date" id="invoice_date" />
            </div>
        </div>

        <div class="row form_line invoicing_field">
            <div class="col-md-6">
            Due Date
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="invoice_due_date" id="invoice_due_date" />
            </div>
        </div>

        <div class="row form_line" id="checkNumber">
            <div class="col-md-6">
                Check Number
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="check_num" id="check_num" value="<?php if(isset($billing_info)){ echo $billing_info->check_num; } ?>"/>
            </div>
        </div>
        <div class="row form_line" id="bankName">
            <div class="col-md-6">
                Bank Name
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="bank_name" id="bank_name" value="<?php if(isset($billing_info)){ echo $billing_info->bank_name; } ?>"/>
            </div>
        </div>
        <div class="row form_line" id="routingNumber">
            <div class="col-md-6">
                Routing Number
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="routing_num" id="routing_num" value="<?php if(isset($billing_info)){ echo $billing_info->routing_num; } ?>"/>
            </div>
        </div>
        <div class="row form_line" id="accountNumber">
            <div class="col-md-6">
                Account Number
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="acct_num" id="acct_num" value="<?php if(isset($billing_info)){ echo $billing_info->acct_num; } ?>"/>
            </div>
        </div>
        <div class="row form_line" id="CCN">
            <div class="col-md-6">
                Credit Card Number
            </div>
            <div class="col-md-6">
                <input type="number" placeholder="0000 0000 0000 0000" class="form-control" name="credit_card_num" id="credit_card_num" value="<?= isset($billing_info) &&  $billing_info->credit_card_num == 0 ? '' :  $billing_info->credit_card_num; ?>"/>
            </div>
        </div>
        <div class="row form_line" id="CCE">
            <div class="col-md-6">
                Credit Card Expiration
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" placeholder="MM/YYYY" class="form-control" name="credit_card_exp" id="credit_card_exp" value="<?php if(isset($billing_info)){ echo $billing_info->credit_card_exp; } ?>"/>
                    </div>
                    <div class="col-md-6">
                        <input type="text" placeholder="CVC" class="form-control" name="credit_card_exp_mm_yyyy" id="credit_card_exp_mm_yyyy" value="<?php if(isset($billing_info)){ echo $billing_info->credit_card_exp_mm_yyyy; } ?>"/>
                    </div> <small></small>
                </div>
            </div>
        </div>

        <div class="row form_line account_cred" >
            <div class="col-md-6">
                Account Credential
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="account_credential" id="account_credential" value="<?= isset($billing_info) ? $billing_info->account_credential : ''; ?>" />
            </div>
        </div>
        <div class="row form_line account_cred" >
            <div class="col-md-6">
                Account Note
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="account_note" id="account_note" value="<?= isset($billing_info) ? $billing_info->account_note : ''; ?>"/>
            </div>
        </div>
        <div class="row form_line account_cred" id="confirmationPD">
            <div class="col-md-6">
                Confirmation
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" name="confirmation" id="confirmation" value="<?= isset($billing_info) ? $billing_info->confirmation : ''; ?>"/>
            </div>
        </div>

    </div>

    <hr />
    
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-file"></i>Attachments</span>
            <a class="nsm-button btn-small" style="float:right;" id="btn-add-attachment-payment" href="javascript:void(0);"><strong>+ Add More</strong></a>
        </div>
    </div>    
    <div class="nsm-card-content">
        <div class="row">
            <div class="col-12 col-md-12">
                    <table class="table table-borderless" id="tbl-payment-attachments">
                    <tbody>
                    <tr>
                        <td><input class="form-control" type="file" name="payment_attachments[]" accept="image/*" /></td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>                                    
        </div>
    </div>       
    
    <hr />
    <div class="nsm-card-content">
        <table class="nsm-table tbl-attachments-list" id="tbl-attachments-list" style="">
            <thead>
                <tr style="">
                    <td data-name="Filename" style="width:90%;">Attachments List</td>
                    <td data-name="Action" style="width:10%;">&nbsp;</td>       
                </tr>
            </thead>
            <tbody>     
                <?php foreach($customer_attachments as $customer_attachment) { ?>
                <tr>
                    <td><a href="javascript:loadAttachImg('<?php echo $customer_attachment->customer_id; ?>', '<?php echo $customer_attachment->file_name; ?>');" id="preview-attached-file" data-company-id="<?php echo logged('company_id'); ?>" data-attach-filename="<?php echo $customer_attachment->file_name; ?>" class="preview-attached-file"><?php echo $customer_attachment->file_name; ?></a></td>
                    <td style="text-align: right;"><a href="javascript:void(0);" data-attached-id="<?php echo $customer_attachment->id; ?>" class="btn-remove-row-edit-attachment nsm-button danger" id="btn-remove-row-edit-attachment" style="line-height:35px;"><i class='bx bx-trash'></i></a></td>
                </tr>
                <?php } ?>
            </tbody>  
        </table>                         
    </div>    
</div>
<div class="modal fade nsm-modal fade" id="modal-customer-attachment" aria-labelledby="modal-customer-attachment-label" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">        
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Preview Attachment</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="workorder-customer-container" style="max-height: 800px; overflow: auto; text-align: center;">
                <img id="work-order-attach-img" class="work-order-attach-img" src="default.jpg" alt="Image" width="200">
            </div>
        </div>
    </div>
</div>