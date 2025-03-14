<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>Billing Information</span>
        </div>
    </div>
    <div class="nsm-card-content"><hr>
        <div class="row form_line">
            <div class="col-md-6">
                Card First Name
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="card_fname" id="card_fname" value="<?= isset($billing_info) && !empty($billing_info->card_fname) ? $billing_info->card_fname : $profile_info->first_name;  ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Card Last Name
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="card_lname" id="card_lname" value="<?= isset($billing_info) && !empty($billing_info->card_lname) ? $billing_info->card_lname : $profile_info->last_name ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                <label for="use_customer_address"><span>Use Customer Address</span>
            </label></div>
            <div class="col-md-6">
                <input type="checkbox" name="use_customer_address" class="form-controls" id="use_customer_address">
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Card Address 
            </div>
            <div class="col-md-6">
                <input data-type="billing_address" type="text" class="form-control" name="card_address" id="card_address" value="<?php if(isset($billing_info)){ echo $billing_info->card_address; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                City
            </div>

            <div class="col-md-6">
                <input data-type="billing_address_city" type="text" class="form-control" name="billing_city" id="billing_city" value="<?php if(isset($billing_info)){ echo $billing_info->city != null ? $billing_info->city : $profile_info->city; } ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                State
            </div>
            <div class="col-md-6">
                <input data-type="billing_address_state" type="text" class="form-control" name="billing_state" id="billing_state" value="<?php if(isset($billing_info)){ echo $billing_info->state != null ? $billing_info->state : $profile_info->state; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                ZIP
            </div>
            <div class="col-md-6">
                <input data-type="billing_address_zip" type="text" class="form-control" name="billing_zip" id="billing_zip" value="<?php if(isset($billing_info)){ echo $billing_info->zip != null ? $billing_info->zip : $profile_info->zip_code; } ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Equipment
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="equipment" value="<?php if(isset($billing_info)){ echo $billing_info->equipment != null ? $billing_info->equipment : $profile_info->equipment; } ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Initial Dep
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" name="initial_dep" value="<?php if(isset($billing_info)){ echo $billing_info->initial_dep != null ? $billing_info->initial_dep : $profile_info->initial_dep; } ?>" >
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Rate Plan
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <select data-value="<?=$billing_info->mmr?>" id="mmr" name="mmr" data-type="billing_rate_plan" class="form-control" >
                            <?php if( isset($billing_info) ){ ?>
                                <option value="<?= $billing_info->mmr; ?>"><?= $billing_info->mmr; ?></option>
                            <?php } ?>
                            
                        </select>
                        <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-rate-plan"><span class="fa fa-plus"></span> Add Rate Plan</a>        
                    </div>
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Billing Frequency
            </div>
            <div class="col-md-6">
                <select data-type="billing_frequency" id="bill_freq" name="bill_freq" data-customer-source="dropdown" class="input_select searchable-dropdown">
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == ""){echo "selected";} } ?> value="">- Select -</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "One Time Only"){echo "selected";} } ?> value="One Time Only">One Time Only</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 1 Month"){echo "selected";} } ?> value="Every 1 Month">Every 1 Month</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 3 Months"){echo "selected";} } ?> value="Every 3 Months">Every 3 Months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 6 Months"){echo "selected";} } ?> value="Every 6 Months">Every 6 Months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->bill_freq == "Every 1 Year"){echo "selected";} } ?> value="Every 1 Year">Every 1 Year</option>
                </select>
            </div>
        </div>

        <div class="row form_line">
            <div class="col-md-6">
                Contract Term
            </div>
            <div class="col-md-6">
                <select data-type="billing_contract_term" id="contract_term" name="contract_term" data-customer-source="dropdown" class="input_select searchable-dropdown" >
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 0){echo "selected";} } ?> value="0"></option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 1){echo "selected";} } ?> value="1">1 month</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 6){echo "selected";} } ?> value="6">6 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 12){echo "selected";} } ?> value="12">12 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 18){echo "selected";} } ?> value="18">18 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 24){echo "selected";} } ?> value="24">24 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 36){echo "selected";} } ?> value="36">36 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 42){echo "selected";} } ?> value="42">42 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 48){echo "selected";} } ?> value="48">48 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 60){echo "selected";} } ?> value="60">60 months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->contract_term == 72){echo "selected";} } ?> value="72">72 months</option>
                </select>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Billing Start Date
            </div>
            <div class="col-md-6">
                <?php 
                    $bill_start_date = '';
                    if( $billing_info && strtotime($billing_info->bill_start_date) > 0 ){
                        $bill_start_date = date("m/d/Y", strtotime($billing_info->bill_start_date));
                    }
                ?>
                <input data-type="billing_start_date" type="text" class="form-control " name="bill_start_date" id="bill_start_date" value="<?= $bill_start_date; ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Billing End Date
            </div>
            <div class="col-md-6">
                <?php 
                    $bill_end_date = '';
                    if( $billing_info && strtotime($billing_info->bill_end_date) > 0 ){
                        $bill_end_date = date("m/d/Y", strtotime($billing_info->bill_end_date));
                    }
                ?>
                <!-- <input data-type="billing_end_date" type="text" class="form-control " name="bill_end_date" id="bill_end_date" value="<?php if(isset($billing_info)){ echo $billing_info->bill_end_date != null ? $billing_info->bill_end_date : date("m/d/Y", strtotime("$office_info->install_date +$billing_info->contract_term months"));; } ?>"/> -->
                <input data-type="billing_end_date" type="text" class="form-control " name="bill_end_date" id="bill_end_date" value="<?= $bill_end_date; ?>"/>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Billing Day of Month
            </div>
            <div class="col-md-6">
                <select data-type="billing_month_day" id="bill_day" name="bill_day" data-customer-source="dropdown" class="input_select searchable-dropdown">
                    <option selected value="0">Select Day</option>
                    <?php
                    if($billing_info->bill_day == null){
                        if($billing_info->billing_start_date == null){
                            $insdate = strtotime($office_info->install_date);
                            $day = date("d", $insdate);
                        }else{
                            $insdate = strtotime($billing_info->billing_start_date);
                            $day = date("d", $insdate);
                        }
                    }else{
                        $day = $billing_info->bill_day;
                    }
                    for ($days=0;$days<32;$days++){
                        ?>
                            <option <?php if(isset($billing_info)){ if($day == days_of_month($days)){ echo 'selected'; } } ?> value="<?= days_of_month($days); ?>"><?= days_of_month($days) < 1 ? '' : days_of_month($days) ; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>  
        <?php if( $billing_info && $billing_info->next_billing_date != '' ){ ?>
        <div class="row form_line">
            <div class="col-md-6">
                Next Billing Date
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" value="<?= date("m/d/Y", strtotime($billing_info->next_billing_date)); ?>" disabled="" />
            </div>
        </div> 
        <?php } ?>
        <div class="row form_line">
            <div class="col-md-6">
                Late Fee
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:35px;" id="">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" name="late_fee" value="<?= isset($billing_info) ? $billing_info->late_fee : '0.00'; ?>" >
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
            Payment Fee
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width:35px;" id="">%</span>
                    </div>
                    <input type="number" step="any" class="form-control" name="payment_fee" value="<?= isset($billing_info) ? $billing_info->payment_fee : '0.00'; ?>">
                </div>
            </div>
        </div>      
        <?php if(isset($billing_info)): ?>
            <!-- <a href="<?= base_url('customer/subscription_new/'.$this->uri->segment(3)) ?>">
                <button type="button" class="nsm-button primary"><span class="fa fa-plus"></span> Add Subscription</button>
            </a> -->
            <div class="mt-4 text-end">
                <button type="button" class="nsm-button primary btn-view-subscription"><span class="fa fa-list"></span> View Subscription</button>
            </div>
        <?php endif; ?>     
    </div>
</div>

<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-credit-card"></i>Payment Details</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>     
        <div class="row form_line">
            <div class="col-md-6">
                Billing Method
            </div>
            <div class="col-md-6">
                <select id="bill_method" name="bill_method" data-customer-source="dropdown" class="input_select searchable-dropdown">
                    <option  value="">Select Billing Method</option>
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

        <div class="row form_line invoicing_field">
            <div class="col-md-6">
                Term
            </div>
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
</div>

<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-credit-card"></i>Financing Payment Schedule</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row form_line">
            <div class="col-md-6">
                Finance Amount
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="any" class="form-control input_select" name="finance_amount"  value="<?= isset($billing_info) ? $billing_info->finance_amount : ''; ?>">
                </div>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Recurring Start Date
            </div>
            <div class="col-md-6">
                <?php 
                    $recurring_start_date = '';
                    if( $billing_info && strtotime($billing_info->recurring_start_date) > 0 ){
                        $recurring_start_date = date("m/d/Y", strtotime($billing_info->recurring_start_date));
                    }
                ?>
                <input data-type="subscription_start_date" type="text" class="form-control datepicker" name="recurring_start_date" id="recurring_start_date" value="<?= $recurring_start_date; ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Recurring End Date
            </div>
            <div class="col-md-6">
                <?php 
                    $recurring_end_date = '';
                    if( $billing_info && strtotime($billing_info->recurring_end_date) > 0 ){
                        $recurring_end_date = date("m/d/Y", strtotime($billing_info->recurring_end_date));
                    }
                ?>
                <input data-type="subscription_end_date" type="text" class="form-control datepicker" name="recurring_end_date" id="recurring_end_date" value="<?= $recurring_end_date; ?>" />
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Category
            </div>
            <div class="col-md-6">
                <select id="transaction_category" name="transaction_category" data-customer-source="dropdown" class="input_select" required="">
                    <option  value="">Select Category</option>
                    <?php foreach($financingCategories as $cat){ ?>
                        <option <?= isset($billing_info) && $billing_info->transaction_category ==  $cat->value ? 'selected' : '';?> value="<?= $cat->value; ?>"><?= $cat->name; ?></option>    
                    <?php } ?>
                </select>
                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-financing-category"><span class="fa fa-plus"></span> Add Category</a>
            </div>
        </div>
        <div class="row form_line">
            <div class="col-md-6">
                Billing Frequency
            </div>
            <div class="col-md-6">
                <select data-type="subscription_frequency" id="frequency" name="frequency" data-customer-source="dropdown" class="input_select" >
                    <option  value="">Select</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == ""){echo "selected";} } ?> value="">- Select -</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "0"){echo "selected";} } ?> value="0">One Time Only</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "1"){echo "selected";} } ?> value="1">Every 1 Month</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "3"){echo "selected";} } ?> value="3">Every 3 Months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "6"){echo "selected";} } ?> value="6">Every 6 Months</option>
                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == "12"){echo "selected";} } ?> value="12">Every 1 Year</option>
                </select>
            </div>
        </div>          
    </div>
</div>