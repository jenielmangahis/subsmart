<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
));
?>

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
        .hgt-row{
            height: 120%;
        }

        .subs-payment-form-container .container-left .form_line {
            margin-bottom: 5px !important;
        }

        .subs-payment-form-container .container-right .form_line {
            margin-bottom: 5px !important;
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
                                Simply select the payment method and hit the button to save the new subscription plan.
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div class="row pl-0 pr-0 hgt-row">
                        <div class="col-md-12 pl-0 pr-0">
                            <div class="col-md-12 pr-3" style="padding-left: 15px;">
                                <div class="pl-3 pr-3 mt-1 row">
                                </div>
                                <div class="col-md-12">
                                    <input type="radio" name="method" class="payment_method" value="CC" checked id="CC">
                                    <span >Credit Card</span> &nbsp;&nbsp;

                                    <input type="radio" name="method" class="payment_method" value="CASH" id="CASH">
                                    <span >Cash</span> &nbsp;&nbsp;

                                    <input type="radio" name="method"  class="payment_method" value="CHECK" id="CHECK">
                                    <span >Check</span> &nbsp;&nbsp;

                                    <input type="radio" name="method" class="payment_method" value="ACH" id="ACH">
                                    <span >ACH</span> &nbsp;&nbsp;

                                    <input type="radio" name="method" class="payment_method" value="Invoicing" id="Invoicing">
                                    <span >Invoicing</span> &nbsp;&nbsp;

                                    <input type="radio" name="method" class="payment_method" value="VENMO" id="VENMO">
                                    <span >Venmo</span> &nbsp;&nbsp;

                                    <input type="radio" name="method" class="payment_method" value="PP" id="PP">
                                    <span >Paypal</span> &nbsp;&nbsp;

                                    <input type="radio" name="method" class="payment_method" value="SQ" id="SQ">
                                    <span >Square</span> &nbsp;&nbsp;

                                    <input type="radio" name="method" class="payment_method" value="OPT" id="OPT">
                                    <span>Others</span>
                                </div>
                                <br>
                                <div class="row g-3 subs-payment-form-container" id="subs-payment-form-container">
                                    <div class="col-md-7 container-left" id="container-left">
                                        <div class="nsm-card primary"> 
                                            <form id="subs_payment_cust_info_update_form" class="subs_payment_cust_info_update_form" method="post">
                                                <input type="hidden" name="prof_id" id="prof_id" value="<?php echo isset($profile_info->prof_id) ? $profile_info->prof_id : 0; ?>" />
                                             
                                                <div class="nsm-card-header">
                                                    <div class="nsm-card-title">
                                                        <span class="custom-ticket-header"><i class='bx bx-user'></i> Customer Information</span>
                                                    </div>                                                        
                                                </div>
                                                <div class="card-body">
                                                    <div class="row form_line">
                                                        <div class="col-md-2">
                                                            <label>First Name</label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <input type="text" readonly class="form-control" name="first_name" id="first_name" value="<?= $profile_info->first_name;  ?>" required/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-2">
                                                            <label for="">Last Name </label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <input type="text" readonly class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-2">
                                                            <label for="">Address </label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <input type="text" readonly class="form-control" name="mail_add" id="mail_add" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-2">
                                                            <label for="">City </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" readonly class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" />
                                                        </div>

                                                        <div class="col-md-2" style="text-align: right;">
                                                            <label for="">State </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" readonly class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->state; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-2">
                                                            <label for="">Zip </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" readonly class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->zip_code; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-2">
                                                            <label for="">Email </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="email" readonly class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-2">
                                                            <label for="">Phone </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <!-- <input type="text" readonly class="form-control" name="phone" id="phone" value="<?php //if(isset($profile_info)){ echo $profile_info->phone_m; } ?>" /> -->
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
                                    <div class="col-md-5 nsm-card-content container-right" id="container-right">
                                        <div class="nsm-card primary"> 
                                            <div class="nsm-card-header">
                                                <div class="nsm-card-title">
                                                    <span class="custom-ticket-header"><i class='bx bx-credit-card' ></i>Payment Information</span>
                                                </div>
                                            </div>                                            
                                            <div class="card-body">
                                                <form id="pay_billing" method="post">
                                                    <div class="row form_line">
                                                        <div class="col-md-4"> Billing Frequency </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <select id="frequency" name="frequency" data-customer-source="dropdown" class="input_select" >
                                                                        <option  value=""></option>
                                                                        <option <?php if(isset($billing_info)){ if($billing_info->frequency == 0){echo "selected";} }else{echo 'selected';} ?> value="0">One Time Only</option>
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
                                                        <!-- <div class="col-md-8">
                                                            <select id="invoice_term" name="invoice_term" data-customer-source="dropdown" class="input_select" >
                                                                <option  value="Due On Receipt">Due On Receipt</option>
                                                                <option  value="Net 5">Net 5</option>
                                                                <option  value="Net 10">Net 10</option>
                                                                <option  value="Net 15">Net 15</option>
                                                                <option  value="Net 30">Net 30</option>
                                                                <option  value="Net 60">Net 60</option>
                                                            </select>
                                                        </div> -->
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
                                                                <input type="text" class="form-control" name="card_number" id="card_number" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" required/>
                                                            </div>
                                                        </div>
                                                        <div class="row form_line">
                                                            <div class="col-md-4">
                                                                <label for="">Expiration
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
                                                            <label for="">Day of Month
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
                                                            <label for="">Account Credential
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="account_credential" id="account_credential" value="<?= isset($billing_info) ? $billing_info->account_credential : ''; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row form_line account_cred" >
                                                        <div class="col-md-4">
                                                            <label for="">Account Note
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="account_note" id="account_note" value="<?= isset($billing_info) ? $billing_info->account_note : ''; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line account_cred" id="confirmationPD">
                                                        <div class="col-md-4">
                                                            <label for="">Confirmation
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
                                                            <label for="">Total Amount
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                                </div>
                                                                <input type="number" step="0.01" class="form-control input_select" name="transaction_amount" placeholder="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-4">
                                                            <label for="">Transaction Category
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-7">
                                                                    <select id="transaction_category" name="transaction_category" data-customer-source="dropdown" class="input_select" >
                                                                        <option value=""></option>
                                                                        <?php
                                                                            //$transaction_category = transaction_categories();
                                                                            //foreach($transaction_category as $category):
                                                                        ?>
                                                                            <!-- <option <?php //echo $category['name'] == $billing_info->transaction_category ? 'selected' : ''; ?> value="<?php //echo $category['name']; ?>"><?php //echo $category['description']; ?></option> -->
                                                                        <?php //endforeach; ?>
                                                                        <?php foreach($financingCategories as $cat){ ?>
                                                                            <option <?= isset($billing_info) && $billing_info->transaction_category ==  $cat->value ? 'selected' : '';?> value="<?= $cat->value; ?>"><?= $cat->name; ?></option>    
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
                                                            <label for="">Notes</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <textarea type="text" style="width: 100%;" class="form-controls" rows="3" cols="50" name="notes" id="notes" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                    <div class="col-md-4">
                                                            <label for="">&nbsp;</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <button type="button" class="nsm-button primary"><span class="fa fa-times"></span> Cancel</button>
                                                            <button type="submit" class="nsm-button primary"><span class="fa fa-paper-plane-o"></span> Save Subcription</button>
                                                            <input type="hidden" name="customer_id" id="customer_id" value="<?= $this->uri->segment(3); ?>"/>
                                                            <input type="hidden" name="method" id="method" value="CC"/>                                                            
                                                        </div>                                                        
                                                    </div>
                                                    <div id="paypal-button-container" style="display: none;"></div>
                                                    <!-- <div style="position: absolute; margin: 0;right: 40px;display: block;" >
                                                        <button type="button" class="btn btn-primary"><span class="fa fa-times"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save Subcription</button>
                                                        <input type="hidden" name="customer_id" id="customer_id" value="<?= $this->uri->segment(3); ?>"/>
                                                        <input type="hidden" name="method" id="method" value="CC"/>
                                                    </div> -->
                                                </form>
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

<?php include viewPath('v2/pages/customer/advance_customer_forms/quick_add_modal_forms'); ?>

<?php
    // JS to add only Customer module
    add_footer_js(array(
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
        'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    ));
    ?>

<script>

$(function(){

});

</script>

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $(document).on("click", ".edit-item", function() {
            let id = $(this).attr("data-id");
            let name = $(this).attr("data-name");

            $("#edit_system_id").val(id);
            $("#edit_system_name").val(name);

            $("#edit_system_package_modal").modal("show");
        });

        $("#new_system_package_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>customer/add_spt_ajax";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    if (result === "Updated") {

                    } else {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "New System Package Type has been added successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }
                    $("#new_system_package_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#edit_system_package_form").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>customer/update_spt_ajax";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    if (result === "Updated") {

                    } else {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "System Package Type has been updated successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }
                    $("#edit_system_package_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", ".delete-item", function() {
            let id = $(this).attr("data-id");

            Swal.fire({
                title: 'Delete System Package Type',
                text: "Are you sure you want to delete this System Package Type?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>customer/delete_spt",
                        data: {
                            id: id
                        },
                        success: function(result) {
                            if (result === '1') {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });
    });
</script> -->
<?php include viewPath('includes/footer'); ?>
<style>
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
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>
    <?php include viewPath('customer/js/subscription_js'); ?>