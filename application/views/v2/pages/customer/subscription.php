<?php defined('BASEPATH') or exit('No direct script access allowed');?>

<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
.input-group-prepend {
    height: 30px !important;
}
.table_head_customer{
    border-color: #999999;
    border-style: Solid;
    border-width: 1px;
}
.table_body_customer{
    border-color: #999999;
    border-style: Solid;
    border-width: 1px;
    background-color: #E5EBF2;
}

.subs-payment-form-container .container-left .form_line {
    margin-bottom: 5px !important;
}

.subs-payment-form-container .container-right .form_line {
    margin-bottom: 5px !important;
}
.material-switch > input[type="checkbox"] {
    display: none;
}

.material-switch > label {
    cursor: pointer;
    height: 0;
    position: relative;
    width: 40px;
}

.material-switch > label::before {
    background-color: #32243d;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background-color: #b7bdba;
    border-radius: 16px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
    background-color: #32243d;
}
#btn-quick-add-term{
    padding: 5px 10px;
    font-size: 12px;
    position: relative;
    top: 6px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_system_package_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                                Make it easy for your customers by offering additional ways to pay.  The payments landscape is ever-changing.
                                Simply select the payment method and hit the button to Pre-Auth Now or Capture Now  the payment.
                                Each transaction will be saved in each customer history.
                        </div>
                    </div>  
                </div>
                <div class="row">

                <div class="col-md-12">
                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="CC" checked id="CC">
                    <label class="form-check-label" for="CC" style="position: initial;">Credit Card</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="CASH" id="CASH">
                    <label class="form-check-label" for="CASH" style="position: initial;">Cash</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method"  class="form-check-input payment_method" value="CHECK" id="CHECK">
                    <label class="form-check-label" for="CHECK" style="position: initial;">Check</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="ACH" id="ACH">
                    <label class="form-check-label" for="ACH" style="position: initial;">ACH</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="Invoicing" id="Invoicing">
                    <label class="form-check-label" for="Invoicing" style="position: initial;">Invoicing</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="VENMO" id="VENMO">
                    <label class="form-check-label" for="VENMO" style="position: initial;">Venmo</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="PP" id="PP">
                    <label class="form-check-label" for="PP" style="position: initial;">Paypal</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="SQ" id="SQ">
                    <label class="form-check-label" for="SQ" style="position: initial;">Square</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="NMI" id="NMI">
                    <label class="form-check-label" for="NMI" style="position: initial;">NMI</label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" name="method" class="form-check-input payment_method" value="OPT" id="OPT">
                    <label class="form-check-label" for="OPT" style="position: initial;">Others</label>
                </div>
            </div>

            <div class="row g-3 subs-payment-form-container">
                <div class="col-md-7">
                    <div class="nsm-card primary">     
                        <div class="nsm-card-header">
                            <div class="nsm-card-title">
                                <span class="custom-ticket-header"><i class='bx bx-user'></i> Customer Information</span>
                            </div>
                        </div>                               

                        <div class="nsm-card-content container-left" id="subs-payment-form-container">     
                            <form id="subs_payment_cust_info_update_form" class="subs_payment_cust_info_update_form" method="post">
                                <input type="hidden" name="prof_id" id="prof_id" value="<?php echo isset($profile_info->prof_id) ? $profile_info->prof_id : 0; ?>" />
                                <div class="card-body">
                                    <div class="row form_line">
                                        <div class="col-md-2">
                                            <label>First Name
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" readonly class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
                                        </div>
                                    </div>
                                    <div class="row form_line">
                                        <div class="col-md-2">
                                            Last Name 
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" readonly class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
                                        </div>
                                    </div>
                                    <div class="row form_line">
                                        <div class="col-md-2">
                                            Address 
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" readonly class="form-control" name="mail_add" id="mail_add" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
                                        </div>
                                    </div>
                                    <div class="row form_line">
                                        <div class="col-md-2">
                                            City 
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" readonly class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" />
                                        </div>

                                        <div class="col-md-2" style="text-align: right;">
                                            State 
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" readonly class="form-control" name="state" id="state" value="<?php if(isset($profile_info->city)){ echo $profile_info->state; } ?>" />
                                        </div>
                                    </div>
                                    <div class="row form_line">
                                        <div class="col-md-2">
                                            Zip 
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" readonly class="form-control" name="zip_code" id="zip_code" value="<?php if(isset($profile_info->state)){ echo $profile_info->zip_code; } ?>" />
                                        </div>
                                    </div>
                                    <div class="row form_line">
                                        <div class="col-md-2">
                                            Email 
                                        </div>
                                        <div class="col-md-4">
                                            <input type="email" readonly class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" />
                                        </div>
                                    </div>
                                    <div class="row form_line">
                                        <div class="col-md-2">
                                            Phone 
                                        </div>
                                        <div class="col-md-4">
                                            <!-- <input type="text" readonly class="form-control phone_number" name="phone" id="phone" value="<?php //if(isset($profile_info)){ echo $profile_info->phone_m; } ?>" /> -->
                                            <input type="text" readonly class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone" id="phone" value="<?php if(isset($profile_info)){ echo $profile_info->phone_h; } ?>" />
                                        </div>
                                    </div>

                                    <div class="row form_line">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-10" style="text-align: right;">
                                            <button type="button" class="nsm-button primary" id="btn-edit-customer-information">Edit</button>
                                            <button type="button" class="nsm-button default" id="btn-cancel-customer-information" style="display:none;">Cancel</button>
                                            <button type="submit" class="nsm-button primary" id="btn-update-customer-information" style="display:none;">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-md-5">
                    <div class="nsm-card primary">     
                        <div class="nsm-card-header">
                            <div class="nsm-card-title">
                                <span class="custom-ticket-header"><i class='bx bx-credit-card' ></i>Payment Information</span>
                            </div>
                        </div>                               
                        <div class="nsm-card-content container-right">       
                            <form id="pay_billing" method="post">
                                <div class="row form_line">
                                    <div class="col-md-4"> Billing Frequency </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select id="frequency" name="frequency" data-customer-source="dropdown" class="input_select" >
                                                    <option  value=""></option>
                                                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == ""){echo "selected";} } ?> value="">- Select -</option>
                                                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == 0){echo "selected";} } ?> value="0">One Time Only</option>
                                                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == 1){echo "selected";} } ?> value="1">Monthly</option>
                                                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == 3){echo "selected";} } ?> value="3">Quarterly</option>
                                                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == 6){echo "selected";} } ?> value="6">Semi-Annual</option>
                                                    <option <?php if(isset($billing_info)){ if($billing_info->frequency == 12){echo "selected";} } ?> value="12">Anually</option>
                                                </select>
                                                <input type="hidden" class="form-control" name="num_frequency" id="num_frequency" value="<?= $billing_info->frequency; ?>" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row form_line invoicing_field">
                                        <div class="col-md-4">Term</div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <select id="invoice_term" name="invoice_term" data-customer-source="dropdown" class="input_select" style="display:inline-block;width:50%;">
                                                        <option value="0" selected="">Select Term</option>
                                                        <?php foreach($accountingTerms as $term){ ?>
                                                            <option value="<?= $term->net_due_days; ?>"><?= $term->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-term"><span class="fa fa-plus"></span> Add Term</a>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form_line invoicing_field">
                                        <div class="col-md-4">
                                            Invoice Date
                                        </div>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control" name="invoice_date" value="<?= date("Y-m-d"); ?>" id="invoice_date" />
                                        </div>
                                    </div>
                                    <div class="row form_line invoicing_field">
                                        <div class="col-md-4">
                                            Due Date
                                        </div>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control" value="<?= date("Y-m-d", strtotime("+5 days")); ?>" name="invoice_due_date" id="invoice_due_date" />
                                        </div>
                                    </div>
                                <div id="credit_card">
                                    <div class="row form_line">
                                        <div class="col-md-4">
                                            Card Number
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="card_number" id="card_number" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>"/>
                                        </div>
                                    </div>
                                    <div class="row form_line">
                                        <div class="col-md-4">
                                            Expiration 
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select id="exp_month" name="exp_month" data-customer-source="dropdown" class="input_select" required>
                                                        <option  value=""></option>
                                                        <option  value="1">01</option>
                                                        <option  value="2">02</option>
                                                        <option  value="3">03</option>
                                                        <option  value="4">04</option>
                                                        <option  value="5">05</option>
                                                        <option  value="6">06</option>
                                                        <option  value="7">07</option>
                                                        <option  value="8">08</option>
                                                        <option  value="9">09</option>
                                                        <option  value="10">10</option>
                                                        <option  value="11">11</option>
                                                        <option  value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select id="exp_year" name="exp_year" data-customer-source="dropdown" class="input_select" required>
                                                        <option  value=""></option>
                                                        <option  value="2021">2021</option>
                                                        <option  value="2022">2022</option>
                                                        <option  value="2023">2023</option>
                                                        <option  value="2024">2024</option>
                                                        <option  value="2025">2025</option>
                                                        <option  value="2026">2026</option>
                                                        <option  value="2027">2027</option>
                                                        <option  value="2028">2028</option>
                                                        <option  value="2029">2029</option>
                                                        <option  value="2030">2030</option>
                                                        <option  value="2031">2031</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" maxlength="3" class="form-control" name="cvc" id="cvc" value="" placeholder="CVC" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form_line" id="payment_collected">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <input type="checkbox" id="is_collected" name="is_collected" value="collected">
                                        <span >Payment has been collected.</span>
                                    </div>
                                </div>

                                <div class="row form_line" id="check_number">
                                    <div class="col-md-4">
                                        Check Number
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="check_number" id="check_number" value="" />
                                    </div>
                                </div>
                                <div class="row form_line CNRN">
                                    <div class="col-md-4">
                                        Routing Number
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="routing_number" id="routing_number" value="" />
                                    </div>
                                </div>

                                <div class="row form_line CNRN">
                                    <div class="col-md-4">
                                        Account Number
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="account_numbers" id="account_numbers"/>
                                    </div>
                                </div>
                                <div class="row form_line" id="day_of_month">
                                    <div class="col-md-4">
                                        Day of Month
                                    </div>
                                    <div class="col-md-8">
                                        <select id="day_of_month_ach" name="day_of_month" class="form-control">
                                            <option value="">Select Day of Month</option>
                                            <?php for($x=1;$x<=31;$x++){ ?>
                                                <option value="<?= $x; ?>"><?= $x; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row form_line account_cred" >
                                    <div class="col-md-4">
                                        Account Credential
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" name="account_credential" id="account_credential" value="<?= isset($billing_info) ? $billing_info->account_credential : ''; ?>" />
                                    </div>
                                </div>
                                <div class="row form_line account_cred" >
                                    <div class="col-md-4">
                                        Account Note
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" name="account_note" id="account_note" value="<?= isset($billing_info) ? $billing_info->account_note : ''; ?>"/>
                                    </div>
                                </div>
                                <div class="row form_line account_cred" id="confirmationPD">
                                    <div class="col-md-4">
                                        Confirmation
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" name="confirmation" id="confirmation" value="<?= isset($billing_info) ? $billing_info->confirmation : ''; ?>"/>
                                    </div>
                                </div>

                                <div class="row form_line" id="docu_signed">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <input type="checkbox" name="docu_signed" value="collected">
                                        <span >Document Signed.</span>
                                    </div>
                                </div>
                                <div class="row form_line">
                                    <div class="col-md-4">
                                        Total Amount 
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">$</span>
                                            </div>
                                            <!-- note: mmr -->
                                            <!-- <input type="number" step="0.01" class="form-control input_select" name="transaction_amount" value="<?php //echo $billing_info->transaction_amount != null ? number_format((float)$billing_info->transaction_amount ,2,'.',',') : '0.00'; ?>"> -->
                                            <input type="number" step="0.01" class="form-control input_select" name="transaction_amount" value="<?= isset($billing_info) ? $billing_info->mmr : '0.00'; ?>">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row form_line">
                                    <div class="col-md-4">
                                        Transaction Category
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <select id="transaction_category" name="transaction_category" data-customer-source="dropdown" class="input_select" >
                                                <option  value=""></option>
                                                    <?php
                                                        //$transaction_category = transaction_categories();
                                                        //foreach($transaction_category as $category):
                                                    ?>
                                                        <!-- <option <?php //echo $category['name'] == $billing_info->transaction_category ? 'selected' : ''; ?> value="<?php //echo $category['name']; ?>"><?php //echo $category['description']; ?></option> -->
                                                    <?php
                                                        //endforeach;
                                                    ?>
                                                    <?php foreach($financingCategories as $cat){ ?>
                                                        <option <?= isset($billing_info) && $billing_info->transaction_category == $cat->value ? 'selected' : '';?> value="<?= $cat->value; ?>"><?= $cat->name; ?></option>    
                                                    <?php } ?>                                                    
                                                </select>                                                
                                            </div>
                                            <div class="col-md-5 mt-1">
                                                <a href="javascript:void(0);" class="nsm-button btn-small" id="btn-quick-add-transaction-category"><span class="fa fa-plus"></span> Add Category</a>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form_line">
                                    <div class="col-md-4">
                                        Notes
                                    </div>
                                    <div class="col-md-8">
                                        <textarea type="text" style="width: 100%;" class="form-control" rows="3" cols="50" name="notes" id="notes" ></textarea>
                                    </div>
                                </div>
                                <div class="text-end mt-2">
                                    <button type="button" class="nsm-button primary" id="btn-add-subscription-plan"><span class="fa fa-plus"></span> Add New Subcription Plan</button>                                                    
                                    <div id="payment-button" style="display:inline-block;">
                                        <button type="submit" class="nsm-button primary" id="btn-pre-auth"><span class="fa fa-money"></span> Pre Auth Now</button>
                                        <button type="submit" class="nsm-button primary" id="btn-capture-now"><span class="fa fa-money"></span> Capture Now</button>
                                    </div>
                                    <div id="paypal-button-container" style="display: none;"></div>
                                    <input type="hidden" name="customer_id" id="customer_id" value="<?= $this->uri->segment(3); ?>"/>
                                    <input type="hidden" name="method" id="method" value="CC"/>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
                
                <div class="col-md-7">
                    <div class="nsm-card primary">     
                        <div class="nsm-card-header">
                            <div class="nsm-card-title">
                                <span class="custom-ticket-header"><i class='bx bx-money'></i> Subscription Invoice</span>
                            </div>
                            <div class="col-6 col-md-4 grid-mb">
                                <form action="<?php echo base_url('customer/subscription/' . $profile_info->prof_id) ?>" method="get">
                                    <div class="nsm-field-group search">
                                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Find By Invoice #" value="<?php echo (!empty($search)) ? $search : '' ?>">
                                    </div>
                                </form>
                            </div>                               
                        </div>                               

                        <div class="nsm-card-content container-left" id="subs-payment-form-container">   
                                                
                            <table class="nsm-table payment-subscription-history-list">
                                <thead>
                                    <tr>
                                        <td data-name="">Invoice #</td>    
                                        <td data-name="">Customer</td> 
                                        <td data-name="">Subscription Date</td>           
                                        <td data-name="">Invoice Date</td>           
                                        <td data-name="">Status</td>
                                        <td data-name="">Amount</td>
                                        <td data-name="Action"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($payment_subscrition_history as $psh) { ?>
                                <tr>
                                    <td><?php echo $psh->invoice_number; ?></td>
                                    <td><?php echo $psh->first_name . " " . $psh->last_name; ?></td>
                                    <td>
                                        <?php 
                                            $subscription_date = date("m/d/Y", strtotime($psh->recurring_start_date)) . ' to ' . date("m/d/Y", strtotime($psh->recurring_end_date));
                                            echo $subscription_date;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $recurring_date = "---";
                                            if($psh->recurring_date != NULL) {
                                                $recurring_date = date("m/d/Y", strtotime($psh->recurring_date));
                                            }
                                            echo $recurring_date;                                            
                                        ?>
                                    </td>
                                    <td><?php echo $psh->status; ?></td>
                                    <td><?php echo $psh->amount; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/genview/' . $psh->invoice_id) ?>">View Invoice</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item row-mark-as-paid" href="javascript:void(0);" data-id="<?= $psh->id; ?>">Mark as Paid</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/preview/'. $psh->invoice_id . '?format=pdf') ?>" target="_blank">Invoice PDF</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('invoice/preview/'. $psh->invoice_id . '?format=print') ?>" target="_blank">Print Invoice</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>                    
                </div>

                <div class="col-md-5">
                    &nbsp;
                </div>
                
            </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="quick_add_terms" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;">Create Accounting Terms</span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">
                        <form id="frm-quick-add-term">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="mb-2">Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="term_name" value="" class="form-control" required="" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="mb-2">Number of days due</label>
                                    <div class="input-group mb-3" style="width:40%;">
                                        <input type="number" step="any" name="term_number_days_due" value="0" class="form-control" required="" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">                        
                                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="nsm-button primary" id="btn-save-terms">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<?php include viewPath('v2/pages/customer/advance_customer_forms/quick_add_modal_forms'); ?>
<?php include viewPath('v2/includes/footer'); ?>
<?php include viewPath('customer/js/subscription_js'); ?>
<script src="https://www.paypal.com/sdk/js?client-id=AR9qwimIa4-1uYwa5ySNmzFnfZOJ-RQ2LaGdnUsfqdLQDV-ldcniSVG9uNnlVqDSj_ckrKSDmMIIuL-M&currency=USD"></script>

<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination({itemsPerPage:10});

        $("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");

            _form.submit();
        }, 1000));  

    });

    paypal.Buttons({
        style: {
            layout: 'horizontal',
            //tagline: false,
            //height:25,
            color:'blue'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                payer: {
                    name: {
                        given_name: 'Testing Paypal'
                    },
                },
                purchase_units: [{
                    amount: {
                        value: '0.01'
                    }
                }],
                application_context: {
                    shipping_preference: 'NO_SHIPPING'
                }
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Show a success message to the buyer
                console.log(details);
                //$("#payment-method").val('paypal');
                //$("#payment-method-status").val(details.status);
                //activate_registration();
            });
        }
    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
</script>
