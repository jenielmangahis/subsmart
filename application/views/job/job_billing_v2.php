<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
echo put_header_assets();
?>

<style>
    html {
        overflow-x: hidden;
    }

    .billing-checkboxes {
        display: flex;
        align-items: center;
        column-gap: 2rem;
    }

    .billing-checkboxes>label {
        display: flex;
        align-items: center;
        column-gap: 5px;
    }

    .form_line {
        margin-bottom: 4px;
        display: flex;
        align-items: center;
    }

    .onoffswitch {
        position: relative;
        display: inline-block;
        width: 54px;
        text-align: left;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    .onoffswitch-checkbox {
        display: none;
    }

    .onoffswitch-label {
        display: block;
        overflow: hidden;
        cursor: pointer;
        border-radius: 20px;
    }

    .onoffswitch-inner {
        display: block;
        width: 200%;
        margin-left: -100%;
        transition: margin 0.3s ease-in 0s;
    }

    .onoffswitch-inner:before,
    .onoffswitch-inner:after {
        display: block;
        float: left;
        width: 50%;
        height: 22px;
        padding: 0;
        line-height: 22px;
        font-size: 12px;
        color: white;
        font-weight: bold;
        box-sizing: border-box;
    }

    .onoffswitch-inner:before {
        content: "ON";
        padding-left: 10px;
        background-color: #2ab363;
        color: #FFFFFF;
    }

    .onoffswitch-inner:after {
        content: "OFF";
        padding-right: 10px;
        background-color: #EEEEEE;
        color: #999999;
        text-align: right;
    }

    .onoffswitch-switch {
        display: block;
        width: 16px;
        height: 16px;
        margin: 3px;
        background: #FFFFFF;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 32px;
        border-radius: 50%;
        transition: all 0.3s ease-in 0s;
    }

    .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
    }

    .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-switch {
        right: 0px;
    }
</style>

<div class="row page-content">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>

    <div class="col-12">
        <div class="nsm-callout primary" role="alert">
            <button><i class="bx bx-x"></i></button>
            Make it easy for your customers by offering additional ways to pay. The payments landscape is ever-changing. Simply select the payment method and hit the button to Save the payment. Each transaction will be saved in each customer history.
        </div>
    </div>

    <div class="col-md-12">
        <div class="billing-checkboxes">

            <?php
            $paymentMethods = [
                'CC' => 'Credit Card',
                'CASH' => 'Cash',
                'CHECK' => 'Check',
                'ACH' => 'ACH',
                'VENMO' => 'Venmo',
                'PP' => 'Paypal',
                'SQ' => 'Square',
                'Invoicing' => 'Invoicing',
                'WW' => 'Warranty Work',
                'HOF' => 'Home Owner Financing',
                'OCCP' => 'Other Credit Card Processor',
                'OPT' => 'Others'
            ];
            ?>

            <?php foreach ($paymentMethods as $value => $label) : ?>
                <label>
                    <input type="radio" name="method" class="payment_method" value="<?= $value; ?>" id="<?= $value; ?>" <?= $value === 'CC' ? 'checked' : '' ?>>
                    <span><?= $label; ?></span>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div style="height: 1rem;"></div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong class="d-flex align-items-center" style="column-gap: 8px;">
                    <span class="bx bx-user-circle"></span>
                    Customer Information
                </strong>
            </div>
            <div class="card-body">
                <div class="row form_line">
                    <div class="col-md-4">
                        First Name
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $profile_info->first_name; ?>" readonly />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Last Name
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $profile_info->last_name; ?>" readonly />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Address
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="mail_add" id="mail_add" value="<?= $profile_info->mail_add; ?>" readonly />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        City
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="city" id="city" value="<?= $profile_info->city; ?>" readonly />
                    </div>

                    <div class="col-md-2">
                        State
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="city" id="city" value="<?= $profile_info->state; ?>" readonly />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Zip
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="state" id="state" value="<?= $profile_info->zip_code; ?>" readonly />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Email
                    </div>
                    <div class="col-md-8">
                        <input type="email" class="form-control" name="email" id="email" value="<?= $profile_info->email; ?>" readonly />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Phone
                    </div>
                    <div class="col-md-8">
                        <input type="email" class="form-control" name="email" id="email" value="<?= $profile_info->phone_m; ?>" readonly />
                    </div>
                </div>

                <div class="row form_line">
                    <div class="col-md-4">
                        Job Number
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $jobs_data->job_number; ?>" readonly />
                    </div>
                </div>
                <div class="row form_line">
                    <div class="col-md-4">
                        Job Type
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $jobs_data->job_type; ?>" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <form id="payment_info" method="post">
            <div class="card">
                <div class="card-header">
                    <strong class="d-flex align-items-center" style="column-gap: 8px;">
                        <span class="bx bx-credit-card"></span>
                        Payment Information
                    </strong>
                </div>
                <div class="card-body">
                    <input type="hidden" id="pay_method" name="pay_method" value="CC" />
                    <input type="hidden" id="jobs_id" value="<?= $this->uri->segment(3); ?>" name="jobs_id" />
                    <div class="row form_line">
                        <div class="col-md-4">
                            Amount to Pay
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                </div>
                                <input readonly type="text" class="form-control input_select" name="amount" value="<?= number_format((float)$jobs_data->total_amount, 2, '.', ','); ?>">
                            </div>
                        </div>
                    </div>
                    <div id="credit_card">
                        <div class="row form_line">
                            <div class="col-md-4">
                                Account Holder Name
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="account_name" id="account_name" value="<?= isset($jobs_data) ?  $jobs_data->first_name . ' ' . $jobs_data->last_name : '' ?>" />
                            </div>
                        </div>
                        <div class="row form_line">
                            <div class="col-md-4">
                                Card Number
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="card_number" id="card_number" value="<?= isset($billing_info) && $billing_info->credit_card_num != 0 ? $billing_info->credit_card_num : '' ?>" />
                            </div>
                        </div>
                        <div class="row form_line">
                            <div class="col-md-4">
                                Expiration
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select id="exp_month" name="card_mmyy" data-customer-source="dropdown" class="input_select">
                                            <option value=""></option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="exp_year" name="exp_year" data-customer-source="dropdown" class="input_select">
                                            <option value=""></option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="card_cvc" id="card_cvc" value="" placeholder="CVC" />
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
                            <select id="invoice_term" name="invoice_term" data-customer-source="dropdown" class="input_select">
                                <option value="Due On Receipt">Due On Receipt</option>
                                <option value="Net 5">Net 5</option>
                                <option value="Net 10">Net 10</option>
                                <option value="Net 15">Net 15</option>
                                <option value="Net 30">Net 30</option>
                                <option value="Net 60">Net 60</option>
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
                            <span>Payment has been collected.</span>
                        </div>
                    </div>

                    <div class="row form_line" id="check_number">
                        <div class="col-md-4">
                            Check Number
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="check_number" id="check_number" value="<?= isset($billing_info) && $billing_info->credit_card_num != 0 ? $billing_info->credit_card_num : ''; ?>" />
                        </div>
                    </div>
                    <div class="row form_line CNRN">
                        <div class="col-md-4">
                            Routing Number
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="routing_number" id="routing_number" value="<?= isset($billing_info) && $billing_info->credit_card_num != 0 ? $billing_info->credit_card_num : ''; ?>" />
                        </div>
                    </div>

                    <div class="row form_line CNRN">
                        <div class="col-md-4">
                            Account Number
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="account_number" id="account_number" value="<?= isset($billing_info) && $billing_info->credit_card_num != 0 ? $billing_info->credit_card_num : ''; ?>" />
                        </div>
                    </div>

                    <div class="row form_line" id="day_of_month">
                        <div class="col-md-4">
                            Day of Month
                        </div>
                        <div class="col-md-8">
                            <select id="day_of_month_ach" name="day_of_month" class="form-controls">
                                <option value=""></option>
                                <?php for ($x = 1; $x <= 31; $x++) { ?>
                                    <option value="<?= $x; ?>"><?= $x; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form_line account_cred">
                        <div class="col-md-4">
                            Account Credential
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="account_credential" id="account_credential" value="<?= isset($billing_info) ? $billing_info->account_credential : ''; ?>" />
                        </div>
                    </div>
                    <div class="row form_line account_cred">
                        <div class="col-md-4">
                            Account Note
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="account_note" id="account_note" value="<?= isset($billing_info) ? $billing_info->account_note : ''; ?>" />
                        </div>
                    </div>
                    <div class="row form_line account_cred" id="confirmationPD">
                        <div class="col-md-4">
                            Confirmation
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="confirmation" id="confirmation" value="<?= isset($billing_info) ? $billing_info->confirmation : ''; ?>" />
                        </div>
                    </div>

                    <div class="row form_line" id="docu_signed">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <input type="checkbox" name="notify_by" value="collected">
                            <span>Document Signed.</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <div id="payment-button" style="margin-top: 1rem;">
                                <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="nsm-button" style="margin-left: 0;">
                                    Cancel
                                </a>

                                <button type="submit" class="nsm-button primary btn-save-payment" style="height: 35px;">
                                    Pay Invoice
                                </button>
                            </div>

                            <div id="paypal-button-container" style="display: none; padding-top: 1rem; max-width: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div style="height: 1rem;"></div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="d-flex align-items-center" style="column-gap: 8px;">
                    <span class="bx bx-history"></span>
                    Payment History
                </strong>
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const $nav = document.querySelector(".nsm-page-nav");
        const $jobLi = $($nav).find('li:contains("Job")').get(0);
        $jobLi.classList.add("active");
    })
</script>

<?php include viewPath('job/js/job_billing_js'); ?>

<script src="https://www.paypal.com/sdk/js?client-id=AR9qwimIa4-1uYwa5ySNmzFnfZOJ-RQ2LaGdnUsfqdLQDV-ldcniSVG9uNnlVqDSj_ckrKSDmMIIuL-M&currency=USD"></script>
<script>
    paypal.Buttons({
        style: {
            //layout: 'horizontal',
            //tagline: false,
            //height:25,
            shape: 'pill',
            color: 'blue'
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
                $.post("<?= base_url() ?>job/on_update_status", tokenRequest, function(data) {
                    paid('Nice!', 'Thank you for your payment!', 'success')
                });
                //$("#payment-method-status").val(details.status);
                //activate_registration();
            });
        }
    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.


    function paid($title, information, $icon) {
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
                window.location.href = "<?= base_url() ?>job/new_job1/<?= $this->uri->segment(3) ?>";
            }
        });
    }
</script>

<?php include viewPath('v2/includes/footer'); ?>