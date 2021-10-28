<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    tr.hide-table-padding td {
        padding: 0;
    }
    svg#svg-sprite-menu-close {
        position: relative;
        bottom: 178px !important;
    }
    .nav-close {
        margin-top: 52% !important;
    }
    .bank-img-container img{
        width:auto !important;
    }
    .btn {
        border-radius: 0 !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
    label>input {
        visibility: visible !important;
        position: inherit !important;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper" style="">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <div class="card">
                    <!-- <h3 style="font-family: Sarabun, sans-serif">&nbsp;Bank and Credit Cards</h3> -->
                    <div class="col-sm-12">
                        <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Payment Test</h3>
                    </div>
                    <div class="row" style="padding-bottom: 20px;">
                        <div class="col-md-12">
                            <?php if($accounts->stripe_publish_key !== NULL): ?>

                            <?php endif; ?>

                            <?php if($accounts->paypal_client_id !== NULL): ?>
                                <div id="paypal-button-container"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->

</div>
<?php include viewPath('includes/footer_accounting'); ?>

<script src="https://www.paypal.com/sdk/js?client-id=AR9qwimIa4-1uYwa5ySNmzFnfZOJ-RQ2LaGdnUsfqdLQDV-ldcniSVG9uNnlVqDSj_ckrKSDmMIIuL-M&currency=USD"></script>
<script>
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

                var tokenRequest = {
                    description: "Paypal Test",
                    payee: "nSmarTrac Tester",
                    amount: '0.01',
                    assign_to: 'Not yet'
                };
                //$("#payment-method").val('paypal');
                $.post("<?= base_url() ?>accounting/onSaveBakingPayment", tokenRequest, function( data ) {
                    alert('Nice!. Thank you for your payment!');
                });

            });
        }
    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
</script>
