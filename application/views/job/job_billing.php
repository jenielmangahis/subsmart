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
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">

            <div class="card">
                <div class="row pl-0 pr-0">
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="col-md-12 pr-3" style="padding-left: 15px;">
                            <h3 class="page-title mt-0">Jobs Billing</h3>
                            <div class="pl-3 pr-3 mt-1 row">
                                <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                      Make it easy for your customers by offering additional ways to pay.  The payments landscape is ever-changing.
                                      Simply select the payment method and hit the button to Save the payment.
                                      Each transaction will be saved in each customer history.
                                  </span>
                                </div>
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

                                <input type="radio" name="method" class="payment_method" value="VENMO" id="VENMO">
                                <span >Venmo</span> &nbsp;&nbsp;

                                <input type="radio" name="method" class="payment_method" value="PP" id="PP">
                                <span >Paypal</span> &nbsp;&nbsp;

                                <input type="radio" name="method" class="payment_method" value="SQ" id="SQ">
                                <span >Square</span> &nbsp;&nbsp;

                                <input type="radio" name="method" class="payment_method" value="Invoicing" id="Invoicing">
                                <span >Invoicing</span> &nbsp;&nbsp;

                                <input type="radio" name="method" class="payment_method" value="WW" id="WW">
                                <span >Warranty Work</span> &nbsp;&nbsp;

                                <input type="radio" name="method" class="payment_method" value="HOF" id="HOF">
                                <span >Home Owner Financing</span> &nbsp;&nbsp;

                                <input type="radio" name="method" class="payment_method" value="OCCP" id="OCCP">
                                <span>Other Credit Card Processor</span> &nbsp;&nbsp;

                                <input type="radio" name="method" class="payment_method" value="OPT" id="OPT">
                                <span>Others</span>
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
                                                    <div class="col-md-4">
                                                        First Name
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $profile_info->first_name; ?>" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Last Name 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?=$profile_info->last_name; ?>" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Address 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="mail_add" id="mail_add" value="<?=$profile_info->mail_add;?>" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        City 
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="city" id="city" value="<?=$profile_info->city;?>" readonly/>
                                                    </div>

                                                    <div class="col-md-2">
                                                        State 
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" name="city" id="city" value="<?=$profile_info->state;?>" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Zip 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="state" id="state" value="<?= $profile_info->zip_code;?>" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Email 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?=$profile_info->email; ?>" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Phone 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?= $profile_info->phone_m; ?>" readonly/>
                                                    </div>
                                                </div>

                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Job Number
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $jobs_data->job_number; ?>" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Job Type
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $jobs_data->job_type; ?>" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <form id="payment_info" method="post">
                                        <div class="card">
                                            <div class="card-header">
                                                <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                                <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Payment Information</h6>
                                            </div>
                                            <div class="card-body">
                                                <input type="hidden" id="pay_method" name="pay_method" value="CC" />
                                                <input type="hidden" id="jobs_id" value="<?= $this->uri->segment(3); ?>" name="jobs_id"/>
                                                <div class="row form_line">
                                                    <div class="col-md-4">
                                                        Amount to Pay 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">$</span>
                                                            </div>
                                                            <input readonly type="text" class="form-control input_select" name="amount" value="<?= number_format((float)$jobs_data->total_amount,2,'.',','); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="credit_card">
                                                    <div class="row form_line">
                                                        <div class="col-md-4">
                                                            Account Holder Name
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="account_name" id="account_name" value="<?= isset($jobs_data ) ?  $jobs_data->first_name .' '. $jobs_data->last_name : '' ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-4">
                                                            Card Number
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="card_number" id="card_number" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-4">
                                                            Expiration 
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select id="exp_month" name="card_mmyy" data-customer-source="dropdown" class="input_select" >
                                                                        <option  value=""></option>
                                                                        <option  value="01">01</option>
                                                                        <option  value="02">02</option>
                                                                        <option  value="03">03</option>
                                                                        <option  value="04">04</option>
                                                                        <option  value="05">05</option>
                                                                        <option  value="06">06</option>
                                                                        <option  value="07">07</option>
                                                                        <option  value="08">08</option>
                                                                        <option  value="09">09</option>
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
                                                                    <input type="text" class="form-control" name="card_cvc" id="card_cvc" value="" placeholder="CVC"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form_line">
                                                        <div class="col-md-4">
                                                            Save card to File 
                                                        </div>
                                                        <div class="col-md-8">
                                                        <div class="onoffswitch grid-onoffswitch" style="float: left;">
                                                            <input type="checkbox" name="is_save_file" class="onoffswitch-checkbox" value="1" data-customize="open" id="onoff-customize">
                                                            <label class="onoffswitch-label" for="onoff-customize">
                                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
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

                                                <div class="row form_line" id="payment_collected">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8">
                                                    <input type="checkbox" name="is_collected" value="1">
                                                    <span >Payment has been collected.</span>
                                                    </div>
                                                </div>

                                                <div class="row form_line" id="check_number">
                                                    <div class="col-md-4">
                                                        Check Number
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="check_number" id="check_number" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" />
                                                    </div>
                                                </div>
                                                <div class="row form_line CNRN">
                                                    <div class="col-md-4">
                                                        Routing Number
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="routing_number" id="routing_number" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" />
                                                    </div>
                                                </div>

                                                <div class="row form_line CNRN">
                                                    <div class="col-md-4">
                                                        Account Number
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="account_number" id="account_number" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" />
                                                    </div>
                                                </div>

                                                <div class="row form_line" id="day_of_month">
                                                    <div class="col-md-4">
                                                        Day of Month
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select id="day_of_month_ach" name="day_of_month" class="form-controls">
                                                            <option value=""></option>
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
                                                        <input type="checkbox" name="notify_by" value="collected">
                                                        <span >Document Signed.</span>
                                                    </div>
                                                </div>
                                                <div style="text-align: right;right: 0;position: relative;">
                                                    <br>
                                                    <div id="payment-button">
                                                        <button type="button" class="btn btn-primary"> <span class="fa fa-remove"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-primary btn-save-payment"> <span class="fa fa-money"></span> Pay</button>
                                                    </div>
                                                    <div id="paypal-button-container" style="display: none;"></div>
                                                </div>

                                            </div>
                                        </div>
                                        </form>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>
                                                <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Payment History</h6>
                                            </div>
                                            <div class="card-body">

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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>

        <?php include viewPath('job/js/job_billing_js'); ?>
        <script src="https://www.paypal.com/sdk/js?client-id=AR9qwimIa4-1uYwa5ySNmzFnfZOJ-RQ2LaGdnUsfqdLQDV-ldcniSVG9uNnlVqDSj_ckrKSDmMIIuL-M&currency=USD"></script>
        <script>
            paypal.Buttons({
                style: {
                    //layout: 'horizontal',
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
                        var tokenRequest = {
                            id: "<?= $this->uri->segment(3) ?>",
                            stat: 'Completed'
                        };
                        //$("#payment-method").val('paypal');
                        $.post("<?= base_url() ?>job/on_update_status", tokenRequest, function( data ) {
                            paid('Nice!','Thank you for your payment!','success')
                        });
                        //$("#payment-method-status").val(details.status);
                        //activate_registration();
                    });
                }
            }).render('#paypal-button-container');
            // This function displays Smart Payment Buttons on your web page.

            function paid($title,information,$icon){
                Swal.fire({
                    title: $title,
                    text: information,
                    icon: $icon,
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        window.location.href="<?= base_url() ?>job/new_job1/<?= $this->uri->segment(3) ?>";
                    }
                });
            }
        </script>
