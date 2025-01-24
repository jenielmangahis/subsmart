<style>
.cc-expiry-month, .cc-expiry-year{
    display:inline-block;
    width:44% !important;
    border-radius:3px !important;
    height:33px;
    /* flex:none !important; */
}
.cc-separator{
    display: inline-block;
    padding: 6px;
    font-size: 16px;
}    
</style>
<div id="invoicing" style="<?= $tickets->payment_method != "Invoicing" ? 'display:none;' : ''; ?>">
    <!-- <input type="checkbox" id="same_as"> <b>Same as above Address</b> <br><br> -->
    <div class="row">                   
        <div class="col-md-6 form-group">
            <label for="monitored_location" class="label-element">Mail Address</label>
            <input type="text" class="form-control input-element" value="<?= $invoicePayment ? $invoicePayment->mail_address : ''; ?>" name="mail-address" id="mail-address" placeholder="Mail Address"/>
        </div>
        <div class="col-md-3 form-group">
            <label for="city" class="label-element">City</label>
            <input type="text" class="form-control input-element" value="<?= $invoicePayment ? $invoicePayment->mail_locality : ''; ?>" name="mail_locality" id="mail_locality" placeholder="Enter City" />
        </div>
    </div>
    <div class="row">        
        <div class="col-md-6 form-group">
            <label for="cross_street" class="label-element">Cross Street</label>
            <input type="text" class="form-control input-element" name="mail_cross_street" value="<?= $invoicePayment ? $invoicePayment->mail_cross_street : ''; ?>" id="mail_cross_street" placeholder="Cross Street"/>
        </div>            
    </div>
    <div class="row">        
        <div class="col-md-3 form-group">
            <label for="state" class="label-element">State</label>
            <input type="text" class="form-control input-element" name="mail_state" id="mail_state" value="<?= $invoicePayment ? $invoicePayment->mail_state : ''; ?>" placeholder="Enter State"/>
        </div>
        <div class="col-md-2 form-group">
            <label for="zip" class="label-element">ZIP</label> 
                <input type="text" id="mail_postcode" name="mail_postcode" class="form-control input-element" value="<?= $invoicePayment ? $invoicePayment->mail_postcode : ''; ?>"  placeholder="Enter Zip"/>
        </div>                           
    </div>
</div>
<div id="check_area" style="<?= $tickets->payment_method != "Check" ? 'display:none;' : ''; ?>">
    <div class="row">                   
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Check Number</label>
            <input type="text" class="form-control input-element" value="<?= $invoicePayment ? $invoicePayment->check_number : ''; ?>" name="check_number" id="check_number"/>
        </div>
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Routing Number</label>
            <input type="text" class="form-control input-element" name="routing_number" value="<?= $invoicePayment ? $invoicePayment->routing_number : ''; ?>" id="routing_number"/>
        </div>  
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Account Number</label>
            <input type="text" class="form-control input-element" name="account_number" value="<?= $invoicePayment ? $invoicePayment->account_number : ''; ?>" id="account_number"/>
        </div>                                              
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Bank Name</label>
            <input type="text" class="form-control input-element" name="bank_name" value="<?= $invoicePayment ? $invoicePayment->bank_name : ''; ?>" id="bank_name"/>
        </div>    
    </div>
</div>
<div id="credit_card" style="<?= $tickets->payment_method != "Credit Card" ? 'display:none;' : ''; ?>">
    <div class="row">                   
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Credit Card Number</label>
            <input type="text" class="form-control input-element" name="credit_number" value="<?= $invoicePayment ? $invoicePayment->credit_number : ''; ?>" id="credit_number" placeholder="0000 0000 0000 000" />
        </div>
        <div class="col-md-2 form-group">
            <label for="customer_cc_expiry_date_month">Expiry Date</label>
            <div class="input-group">
                <?php 
                    $exp_month = '';
                    $exp_year  = '';
                    if( $invoicePayment && $invoicePayment->credit_expiry != '' ){
                        $credit_expiry = explode("/", $invoicePayment->credit_expiry);

                        $exp_month = $credit_expiry[0];
                        $exp_year = $credit_expiry[1];
                    }
                ?>
                <input type="text" class="form-control cc-expiry-month" style="width:60px !important;" value="<?= $exp_month; ?>" maxlength="2" size="2" name="customer_cc_expiry_date_month" id="customer_cc_expiry_date_month" placeholder="MM"/>
                <span class="cc-separator">/</span>
                <input type="text" class="form-control cc-expiry-year" style="width:65px !important;" value="<?= $exp_year; ?>" maxlength="4" size="4" name="customer_cc_expiry_date_year" id="customer_cc_expiry_date_year" placeholder="YYYY"/>
            </div>
        </div>
        <div class="col-md-2 form-group">
            <label for="customer_cc_cvc">CVC</label>
            <div class="input-group" style="width:35%;">
                <input type="text" class="form-control cc-cvc" maxlength="4" size="4" value="<?= $invoicePayment ? $invoicePayment->credit_cvc : ''; ?>" name="customer_cc_cvc" placeholder="123" id="customer_cc_cvc"/>
            </div>
        </div>                                         
    </div>
</div>
<div id="debit_card" style="<?= $tickets->payment_method != "Debit Card" ? 'display:none;' : ''; ?>">
    <div class="row">                   
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Credit Card Number</label>
            <input type="text" class="form-control input-element" name="debit_credit_number" value="<?= $invoicePayment ? $invoicePayment->credit_number : ''; ?>" id="credit_number2" placeholder="0000 0000 0000 000" />
        </div>
        <div class="col-md-2 form-group">
            <?php 
                $exp_month = '';
                $exp_year  = '';
                if( $invoicePayment && $invoicePayment->credit_expiry != '' ){
                    $credit_expiry = explode("/", $invoicePayment->credit_expiry);

                    $exp_month = $credit_expiry[0];
                    $exp_year = $credit_expiry[1];
                }
            ?>
            <label for="customer_cc_expiry_date_month">Expiry Date</label>
            <div class="input-group">
                <input type="text" class="form-control cc-expiry-month" style="width:60px !important;" value="<?= $exp_month; ?>" maxlength="2" size="2" name="debit_credit_expiry_month" id="debit_credit_expiry_month" placeholder="MM"/>
                <span class="cc-separator">/</span>
                <input type="text" class="form-control cc-expiry-year" style="width:65px !important;" value="<?= $exp_year; ?>" maxlength="4" size="4" name="debit_credit_expiry_year" id="debit_credit_expiry_year" placeholder="YYYY"/>
            </div>
        </div>
        <div class="col-md-2 form-group">
            <label for="customer_cc_cvc">CVC</label>
            <div class="input-group" style="width:35%;">
                <input type="text" class="form-control cc-cvc" maxlength="4" size="4" name="credit_cvc" value="<?= $invoicePayment ? $invoicePayment->credit_cvc : ''; ?>" placeholder="123" id="credit_cvc"/>
            </div>
        </div>                                         
    </div>
</div>
<div id="ach_area" style="<?= $tickets->payment_method != "ACH" ? 'display:none;' : ''; ?>">
    <div class="row">                   
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Routing Number</label>
            <input type="text" class="form-control input-element" name="ach_routing_number" value="<?= $invoicePayment ? $invoicePayment->routing_number : ''; ?>" id="ach_routing_number" />
        </div>
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Account Number</label>
            <input type="text" class="form-control input-element" name="ach_account_number" value="<?= $invoicePayment ? $invoicePayment->account_number : ''; ?>" id="ach_account_number" />
        </div>  
    </div>
</div>
<div id="venmo_area" style="<?= $tickets->payment_method != "Venmo" ? 'display:none;' : ''; ?>">
    <div class="row">                   
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Account Credential</label>
            <input type="text" class="form-control input-element" name="account_credentials" value="<?= $invoicePayment ? $invoicePayment->account_credentials : ''; ?>" id="account_credentials"/>
        </div>
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Account Note</label>
            <input type="text" class="form-control input-element" name="account_note" value="<?= $invoicePayment ? $invoicePayment->account_note : ''; ?>" id="account_note"/>
        </div>  
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Confirmation</label>
            <input type="text" class="form-control input-element" name="confirmation" value="<?= $invoicePayment ? $invoicePayment->confirmation : ''; ?>" id="confirmation"/>
        </div>                                            
    </div>
</div>
<div id="paypal_area" style="display:none;">
    <div class="row">                   
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Account Credential</label>
            <input type="text" class="form-control input-element" name="paypal_account_credentials" value="<?= $invoicePayment ? $invoicePayment->account_credentials : ''; ?>"  id="paypal_account_credentials"/>
        </div>
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Account Note</label>
            <input type="text" class="form-control input-element" name="paypal_account_note" value="<?= $invoicePayment ? $invoicePayment->account_note : ''; ?>" id="paypal_account_note"/>
        </div>  
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Confirmation</label>
            <input type="text" class="form-control input-element" name="paypal_confirmation" value="<?= $invoicePayment ? $invoicePayment->confirmation : ''; ?>" id="paypal_confirmation"/>
        </div>                                            
    </div>
</div>
<div id="square_area" style="display:none;">
    <div class="row">                   
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Account Credential</label>
            <input type="text" class="form-control input-element" name="square_account_credentials" value="<?= $invoicePayment ? $invoicePayment->account_credentials : ''; ?>" id="square_account_credentials"/>
        </div>
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Account Note</label>
            <input type="text" class="form-control input-element" name="square_account_note" value="<?= $invoicePayment ? $invoicePayment->account_note : ''; ?>" id="square_account_note"/>
        </div>  
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Confirmation</label>
            <input type="text" class="form-control input-element" name="square_confirmation" value="<?= $invoicePayment ? $invoicePayment->confirmation : ''; ?>" id="square_confirmation"/>
        </div>                                            
    </div>
</div>
<div id="warranty_area" style="<?= $tickets->payment_method != "Warranty Work" ? 'display:none;' : ''; ?>">
    <div class="row">                   
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Account Credential</label>
            <input type="text" class="form-control input-element" name="warranty_account_credentials" value="<?= $invoicePayment ? $invoicePayment->account_credentials : ''; ?>" id="warranty_account_credentials"/>
        </div>
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Account Note</label>
            <input type="text" class="form-control input-element" name="warranty_account_note" value="<?= $invoicePayment ? $invoicePayment->account_note : ''; ?>"  id="warranty_account_note"/>
        </div>                                         
    </div>
</div>
<div id="home_area" style="<?= $tickets->payment_method != "Home Owner Financing" ? 'display:none;' : ''; ?>">
    <div class="row">                   
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Account Credential</label>
            <input type="text" class="form-control input-element" name="home_account_credentials" value="<?= $invoicePayment ? $invoicePayment->account_credentials : ''; ?>"  id="home_account_credentials"/>
        </div>
        <div class="form-group col-md-3">
            <label for="job_type" class="label-element">Account Note</label>
            <input type="text" class="form-control input-element" name="home_account_note" value="<?= $invoicePayment ? $invoicePayment->account_note : ''; ?>" id="home_account_note"/>
        </div>                                         
    </div>
</div>
<div id="e_area" style="display:none;">
    <div class="row">                   
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Account Credential</label>
            <input type="text" class="form-control input-element" name="e_account_credentials" value="<?= $invoicePayment ? $invoicePayment->account_credentials : ''; ?>" id="e_account_credentials"/>
        </div>
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Account Note</label>
            <input type="text" class="form-control input-element" name="e_account_note" value="<?= $invoicePayment ? $invoicePayment->account_note : ''; ?>" id="e_account_note"/>
        </div>                                         
    </div>
</div>
<div id="other_credit_card" style="display:none;">
    <div class="row">                   
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Credit Card Number</label>
            <input type="text" class="form-control input-element" name="other_credit_number" id="other_credit_number" placeholder="0000 0000 0000 000" />
        </div>
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">Credit Card Expiration</label>
            <input type="text" class="form-control input-element" name="other_credit_expiry" id="other_credit_expiry" placeholder="MM/YYYY"/>
        </div>  
        <div class="form-group col-md-6">
            <label for="job_type" class="label-element">CVC</label>
            <input type="text" class="form-control input-element" name="other_credit_cvc" id="other_credit_cvc" placeholder="CVC"/>
        </div>                                             
    </div>
</div>
<div id="other_payment_area" style="<?= $tickets->payment_method != "Other Payment Type" ? 'display:none;' : ''; ?>">
    <div class="row">                   
        <div class="form-group col-md-3">
            <label for="job_type">Account Credential</label>
            <input type="text" class="form-control input-element" name="other_payment_account_credentials" value="<?= $invoicePayment ? $invoicePayment->account_credentials : ''; ?>" id="other_payment_account_credentials"/>
        </div>
        <div class="form-group col-md-3">
            <label for="job_type">Account Note</label>
            <input type="text" class="form-control input-element" name="other_payment_account_note" value="<?= $invoicePayment ? $invoicePayment->account_note : ''; ?>" id="other_payment_account_note"/>
        </div>                                         
    </div>
</div>