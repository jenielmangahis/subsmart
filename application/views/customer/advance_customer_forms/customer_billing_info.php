<div class="card-header">
    <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
    <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Billing Information</h6>
</div>
<div class="card-body">
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Card First Name</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" name="card_fname" id="card_fname" value="<?php if(isset($billing_info)){ echo $billing_info->card_fname; } ?>" />
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Card Last Name</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" name="card_lname" id="card_lname" value="<?php if(isset($billing_info)){ echo $billing_info->card_lname; } ?>"/>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Card Address </label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" name="card_address" id="card_address" value="<?php if(isset($billing_info)){ echo $billing_info->card_address; } ?>"/>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">City State ZIP</label>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="billing_city" id="billing_city" value="<?php if(isset($billing_info)){ echo $billing_info->city; } ?>" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="billing_state" id="billing_state" value="<?php if(isset($billing_info)){ echo $billing_info->state; } ?>"/>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="billing_zip" id="billing_zip" value="<?php if(isset($billing_info)){ echo $billing_info->zip; } ?>"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Equipment</label>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">$</span>
                </div>
                <input type="text" class="form-control input_select" name="equipment" >
            </div>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Initial Dep</label>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">$</span>
                </div>
                <input type="text" class="form-control input_select" name="initial_dep"  >
            </div>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Rate Plan $</label>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
                <select id="mmr" name="mmr" data-customer-source="dropdown" class="input_select searchable-dropdown" required>
                <?php if(isset($billing_info->mmr)){ ?>
                    <option selected value="<?= $billing_info->mmr ?>"><?= $billing_info->mmr ?></option>
                <?php } ?>
                <option value="0.00">0.00</option>
                <option value="20.00">20.00</option>
                <option value="24.99">24.99</option>
                <option value="25.00">25.00</option>
                <option value="26.99">26.99</option>
                <option value="27.99">27.99</option>
                <option value="29.99">29.99</option>
                <option value="31.00">31.00</option>
                <option value="31.99">31.99</option>
                <option value="32.99">32.99</option>
                <option value="34.99">34.99</option>
                <option value="35.00">35.00</option>
                <option value="35.99">35.99</option>
                <option value="36.99">36.99</option>
                <option value="37.99">37.99</option>
                <option value="38.99">38.99</option>
                <option value="39.99">39.99</option>
                <option value="40.99">40.99</option>
                <option value="41.15">41.15</option>
                <option value="41.99">41.99</option>
                <option value="42.99">42.99</option>
                <option value="43.99">43.99</option>
                <option value="44.95">44.95</option>
                <option value="44.99">44.99</option>
                <option value="45.99">45.99</option>
                <option value="46.99">46.99</option>
                <option value="47.95">47.95</option>
                <option value="47.99">47.99</option>
                <option value="48.99">48.99</option>
                <option value="49.95">49.95</option>
                <option value="49.99">49.99</option>
                <option value="50.99">50.99</option>
                <option value="51.95">51.95</option>
                <option value="51.99">51.99</option>
                <option value="52.99">52.99</option>
                <option value="53.95">53.95</option>
                <option value="53.99">53.99</option>
                <option value="54.49">54.49</option>
                <option value="54.99">54.99</option>
                <option value="55.99">55.99</option>
                <option value="56.99">56.99</option>
                <option value="57.99">57.99</option>
                <option value="58.99">58.99</option>
                <option value="59.99">59.99</option>
                <option value="60.99">60.99</option>
                <option value="61.99">61.99</option>
                <option value="62.99">62.99</option>
                <option value="63.99">63.99</option>
                <option value="64.99">64.99</option>
                <option value="65.99">65.99</option>
                <option value="67.99">67.99</option>
                <option value="69.99">69.99</option>
                <option value="70.99">70.99</option>
                <option value="71.99">71.99</option>
                <option value="72.98">72.98</option>
                <option value="73.99">73.99</option>
                <option value="74.99">74.99</option>
                <option value="75.99">75.99</option>
                <option value="77.99">77.99</option>
                <option value="85.99">85.99</option>
                <option value="89.99">89.99</option>
                <option value="95.00">95.00</option>
                <option value="97.85">97.85</option>
                <option value="129.00">129.00</option>
            </select>
        </div>
                <div class="col-md-4">
                    <a href="<?= base_url() ?>customer/settings" target="_blank"  style="color:#58bc4f;margin-top:10px;font-size: 10px;position: absolute;"><span class="fa fa-plus"></span>Manage Rate Plan </a>&nbsp;&nbsp;
                </div>
            </div>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Billing Frequency</label>
        </div>
        <div class="col-md-8">
            <select id="bill_freq" name="bill_freq" data-customer-source="dropdown" class="input_select searchable-dropdown">
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
        <div class="col-md-4">
            <label for="">Billing Day of Month</label>
        </div>
        <div class="col-md-8">
            <select id="bill_day" name="bill_day" data-customer-source="dropdown" class="input_select searchable-dropdown">
                <?php
                for ($days=0;$days<32;$days++){
                    ?>
                        <option <?php if(isset($billing_info)){ if($billing_info->bill_day == days_of_month($days)){ echo 'selected'; } } ?> value="<?= days_of_month($days); ?>"><?= days_of_month($days) < 1 ? '' : days_of_month($days) ; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Contract Term</label>
        </div>
        <div class="col-md-8">
            <select id="contract_term" name="contract_term" data-customer-source="dropdown" class="input_select searchable-dropdown" >
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
        <div class="col-md-4">
            <label for="">Billing Start Date</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control " name="bill_start_date" id="bill_start_date" value="<?php if(isset($billing_info)){ echo $billing_info->bill_start_date; } ?>" />
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Billing End Date</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control " name="bill_end_date" id="bill_end_date" value="<?php if(isset($billing_info)){ echo $billing_info->bill_end_date; } ?>"/>
        </div>
    </div>
</div>


    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
        <h6 ><span class="fa fa-credit-card"></span>&nbsp; &nbsp;Payment Details</h6>
    </div>
<div class="card-body">

    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Billing Method</label>
        </div>
        <div class="col-md-8">
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
                <option <?= isset($billing_info) && $billing_info->bill_method == 'OCCP' ?  'selected' : '';?> value="OCCP">Other Credit Card Processor</option>
                <option <?= isset($billing_info) && $billing_info->bill_method == 'OPT' ?  'selected' : '';?> value="OPT">Other Payment Type</option>
            </select>
        </div>
    </div>

    <div class="row form_line" id="checkNumber">
        <div class="col-md-4">
            <label for="">Check Number</label>
        </div>
        <div class="col-md-8">
            <input type="number" class="form-control" name="check_num" id="check_num" value="<?php if(isset($billing_info)){ echo $billing_info->check_num; } ?>"/>
        </div>
    </div>
    <div class="row form_line" id="routingNumber">
        <div class="col-md-4">
            <label for="">Routing Number</label>
        </div>
        <div class="col-md-8">
            <input type="number" class="form-control" name="routing_num" id="routing_num" value="<?php if(isset($billing_info)){ echo $billing_info->routing_num; } ?>"/>
        </div>
    </div>
    <div class="row form_line" id="accountNumber">
        <div class="col-md-4">
            <label for="">Account Number</label>
        </div>
        <div class="col-md-8">
            <input type="number" class="form-control" name="acct_num" id="acct_num" value="<?php if(isset($billing_info)){ echo $billing_info->acct_num; } ?>"/>
        </div>
    </div>
    <div class="row form_line" id="CCN">
        <div class="col-md-4">
            <label for="">Credit Card Number</label>
        </div>
        <div class="col-md-8">
            <input type="number" placeholder="0000 0000 0000 0000" class="form-control" name="credit_card_num" id="credit_card_num" value="<?= isset($billing_info) &&  $billing_info->credit_card_num == 0 ? '' :  $billing_info->credit_card_num; ?>"/>
        </div>
    </div>
    <div class="row form_line" id="CCE">
        <div class="col-md-4">
            <label for="">Credit Card Expiration</label>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" placeholder="MM/YYYY" class="form-control" name="credit_card_exp" id="credit_card_exp" value="<?php if(isset($billing_info)){ echo $billing_info->credit_card_exp; } ?>"/>
                </div>
                <div class="col-md-4">
                    <input type="text" placeholder="CVC" class="form-control" name="credit_card_exp_mm_yyyy" id="credit_card_exp_mm_yyyy" value="<?php if(isset($billing_info)){ echo $billing_info->credit_card_exp_mm_yyyy; } ?>"/>
                </div> <small></small>
            </div>
        </div>
    </div>

    <div class="row form_line account_cred" >
        <div class="col-md-4">
            <label for="">Account Credential</label>
        </div>
        <div class="col-md-8">
            <input type="number" class="form-control" name="account_credential" id="account_credential" value="<?= isset($billing_info) ? $billing_info->account_credential : ''; ?>" />
        </div>
    </div>
    <div class="row form_line account_cred" >
        <div class="col-md-4">
            <label for="">Account Note</label>
        </div>
        <div class="col-md-8">
            <input type="number" class="form-control" name="account_note" id="account_note" value="<?= isset($billing_info) ? $billing_info->account_note : ''; ?>"/>
        </div>
    </div>
    <div class="row form_line account_cred" id="confirmationPD">
        <div class="col-md-4">
            <label for="">Confirmation</label>
        </div>
        <div class="col-md-8">
            <input type="number" class="form-control" name="confirmation" id="confirmation" value="<?= isset($billing_info) ? $billing_info->confirmation : ''; ?>"/>
        </div>
    </div>

</div>
<div class="card-header">
    <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
    <h6 ><span class="fa fa-credit-card"></span>&nbsp; &nbsp;Subscription Pay Plan</h6>
</div>
<div class="card-body">
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Finance Amount</label>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">$</span>
                </div>
                <input type="text" class="form-control input_select" name="finance_amount"  value="<?= isset($billing_info) ? $billing_info->finance_amount : ''; ?> ">
            </div>
         </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Recurring Start Date</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control datepicker" name="recurring_start_date" id="recurring_start_date" value="<?= isset($billing_info) ? $billing_info->recurring_start_date : ''; ?>" />
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Recurring End Date</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control datepicker" name="recurring_end_date" id="recurring_end_date" value="<?= isset($billing_info) ? $billing_info->recurring_end_date : ''; ?>" />
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Transaction Amount</label>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">$</span>
                </div>
                <input type="text" class="form-control input_select" name="transaction_amount" value="<?= isset($billing_info) ? $billing_info->transaction_amount : ''; ?>">
            </div>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Transaction Category</label>
        </div>
        <div class="col-md-8">
            <select id="transaction_category" name="transaction_category" data-customer-source="dropdown" class="input_select" >
                <option  value=""></option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'E' ?  'selected' : '';?> value="E">Equipment</option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'MMR' ?  'selected' : '';?> value="MMR">MMR</option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'RMR' ?  'selected' : '';?> value="RMR">RMR</option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'MS' ?  'selected' : '';?> value="MS">Monthly Subscription</option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'AF' ?  'selected' : '';?> value="AF">Activation Fee</option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'FM' ?  'selected' : '';?> value="FM">First Month</option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'AFM' ?  'selected' : '';?> value="AFM">Activation + First Month</option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'D' ?  'selected' : '';?> value="D">Deposit</option>
                <option <?= isset($billing_info) && $billing_info->transaction_category == 'O' ?  'selected' : '';?> value="O">Other</option>
            </select>
        </div>
    </div>
    <div class="row form_line">
        <div class="col-md-4">
            <label for="">Frequency</label>
        </div>
        <div class="col-md-8">
            <select id="frequency" name="frequency" data-customer-source="dropdown" class="input_select" >
                <option  value=""></option>
                <option <?= isset($billing_info) && $billing_info->frequency == 1 ?  'selected' : '';?> value="1">1 month</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 2 ?  'selected' : '';?> value="2">2 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 3 ?  'selected' : '';?> value="3">3 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 4 ?  'selected' : '';?> value="4">4 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 5 ?  'selected' : '';?> value="5">5 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 6 ?  'selected' : '';?> value="6">6 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 7 ?  'selected' : '';?> value="7">7 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 8 ?  'selected' : '';?> value="8">8 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 9 ?  'selected' : '';?> value="8">9 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 10 ?  'selected' : '';?> value="10">10 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 11 ?  'selected' : '';?> value="11">11 months</option>
                <option <?= isset($billing_info) && $billing_info->frequency == 12 ?  'selected' : '';?> value="12">12 months</option>
            </select>
        </div>
    </div>

</div>