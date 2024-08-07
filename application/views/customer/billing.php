<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
));
?>

<?php include viewPath('includes/header'); ?>
<?php include viewPath('customer/css/add_advance_css'); ?>
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">

            <div class="card">
                <div class="row pl-0 pr-0">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="col-md-12 pr-3" style="padding-left: 15px;">
                            <h3 class="page-title mt-0">New Transaction/Account History</h3>
                            <div class="pl-3 pr-3 mt-1 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                      Make it easy for your customers by offering additional ways to pay.  The payments landscape is ever-changing.
                                      Simply select the payment method and hit the button to Pre-Auth Now or Capture Now  the payment.
                                      Each transaction will be saved in each customer history.
                                  </span>
                                </div>
                            </div>
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
                            <br>

                                <div class="row pl-0 pr-0">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                                <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Customer Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        First Name
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php if(isset($profile_info->first_name)){ echo $profile_info->first_name; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Last Name 
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if(isset($profile_info)){ echo $profile_info->last_name; } ?>" required/>
                                                    </div>
                                                </div>
                                               <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Address 
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="mail_add" id="mail_add" value="<?php if(isset($profile_info->mail_add)){ echo $profile_info->mail_add; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">City 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->city; } ?>" />
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label for="">State 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($profile_info->city)){ echo $profile_info->state; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Zip 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($profile_info->state)){ echo $profile_info->zip_code; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Email 
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->email; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Phone 
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->phone_m; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Date of Birth 
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" disabled class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->date_of_birth; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-2">
                                                        <label for="">Customer Type 
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input  disabled class="form-control" name="email" id="email" value="<?php if(isset($profile_info)){ echo $profile_info->customer_type; } ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                                <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Payment Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <form id="pay_billing" method="post">
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Billing Frequency
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="frequency" id="frequency" value="<?= $billing_info->bill_freq;  ?>" readonly/>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="bill_day" id="bill_day" value="Every <?= $billing_info->bill_day;  ?>" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="row form_line invoicing_field">
                                                        <div class="col-md-4">
                                                            Term
                                                        </div>
                                                        <div class="col-md-8">
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
                                                        <div class="col-md-4">
                                                            Invoice Date
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="invoice_date" id="invoice_date" />
                                                        </div>
                                                    </div>
                                                    <div class="row form_line invoicing_field">
                                                        <div class="col-md-4">
                                                            Due Date
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="invoice_due_date" id="invoice_due_date" />
                                                        </div>
                                                    </div>
                                                <div id="credit_card">
                                                    <div class="row form_line">
                                                        <div class="col-md-4">
                                                            Card Number
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="card_number" id="first_name" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" required/>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-4">
                                                            <label for="">Expiration 
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select id="exp_month" name="exp_month" data-customer-source="dropdown" class="input_select" >
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
                                                                    <select id="exp_year" name="exp_year" data-customer-source="dropdown" class="input_select" >
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
                                                                    <input type="text" maxlength="3" class="form-control" name="cvc" id="cvc" value="" placeholder="CVC"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form_line" id="payment_collected">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8">
                                                        <input type="checkbox" name="is_collected" value="collected">
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
                                                        <label for="">Transaction Subtotal 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="subtotal" id="subtotal"  required/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Tax Amount 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="tax" id="tax"/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Total Amount 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="transaction_amount" id="transaction_amount" />
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Transaction Category
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select id="transaction_category" name="transaction_category" data-customer-source="dropdown" class="input_select" >
                                                            <option  value=""></option>
                                                            <option  value="E">Equipment</option>
                                                            <option  value="MMR">MMR</option>
                                                            <option  value="RMR">RMR</option>
                                                            <option  value="MS">Monthly Subscription</option>
                                                            <option  value="AF">Activation Fee</option>
                                                            <option  value="FM">First Month</option>
                                                            <option  value="AFM">Activation + First Month</option>
                                                            <option  value="D">Deposit</option>
                                                            <option  value="O">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        <label for="">Notes
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea type="text" style="background-color: #fdeac3;" class="form-controls" rows="5" cols="50" name="notes" id="notes" ></textarea>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Pre Auth Now</button>
                                                <button type="submit" class="btn btn-primary">Capture Now</button>
                                                <button type="button" class="btn btn-primary" id="print_invoice">Print</button>
                                                <input type="hidden" name="customer_id" id="customer_id" value="<?= $this->uri->segment(3); ?>"/>
                                                <input type="hidden" name="method" id="method" value="CC"/>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                                <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Transaction History</h6>
                                            </div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <td>ID</td>
                                                        <td>Date</td>
                                                        <td>Subtotal</td>
                                                        <td>Tax</td>
                                                        <td>Total Amount</td>
                                                        <td>Category</td>
                                                        <td>Method</td>
                                                        <td>Type</td>
                                                        <td>Frequency</td>
                                                        <td>Status</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        foreach ($transaction_details as $detail):
                                                           ?>
                                                            <tr>
                                                                <td><?= $detail->id; ?></td>
                                                                <td><?= $detail->datetime; ?></td>
                                                                <td>$<?= number_format((float)$detail->subtotal,2,'.',','); ?></td>
                                                                <td>$<?= number_format((float)$detail->tax,2,'.',','); ?></td>
                                                                <td>$<?= number_format((float)$detail->subtotal + $detail->tax,2,'.',','); ?></td>
                                                                <td><?php $tt = transaction_categories($detail->category); echo $tt['description']; ?></td>
                                                                <td><?= $detail->method; ?></td>
                                                                <td><?= $detail->transaction_type; ?></td>
                                                                <td><?= $detail->frequency; ?></td>
                                                                <td><?= $detail->status; ?></td>
                                                            </tr>
                                                            <?php
                                                        endforeach;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!-- end container-fluid -->

        <?php
        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        ));
        ?>
        <?php include viewPath('includes/footer'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>

        <!-- Load Billing Page JS -->
        <?php include viewPath('customer/js/billing_js'); ?>
