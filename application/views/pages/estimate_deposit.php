<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header_front'); ?>
<?php if ($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != '') : ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
<?php endif; ?>
<?php if ($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '') : ?>
    <script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD"></script>
<?php endif; ?>
<?php include viewPath('job/css/job_new'); ?>
<style>
    .card {
        box-shadow: 0 0 13px 0 rgb(116 116 117) !important;
    }

    .card-body {
        padding: 0 !important;
    }

    .right-text {
        position: relative;
        float: right;
        right: 0;
        bottom: 10px;
    }

    #map {
        height: 190px;
    }

    .title-border {
        border-bottom: 2px solid rgba(0, 0, 0, .1);
        padding-bottom: 5px;
    }

    .icon_preview {
        font-size: 16px;
        color: #45a73c;
    }

    /**
   * The CSS shown here will not be introduced in the Quickstart guide, but shows
   * how you can use CSS to style your Element's container.
   */
    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    .stripe-btn,
    .stripe-cancel-btn {
        border: none;
        border-radius: 4px;
        outline: none;
        text-decoration: none;
        color: #fff;
        background: #32325d;
        white-space: nowrap;
        display: inline-block;
        height: 40px;
        line-height: 40px;
        padding: 0 14px;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
        border-radius: 4px;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.025em;
        text-decoration: none;
        -webkit-transition: all 150ms ease;
        transition: all 150ms ease;
        margin-left: 12px;
        margin-top: 28px;
    }

    .paypal-buttons-context-iframe {
        top: 19px;
    }
</style>
<?php if ($onlinePaymentAccount->converge_merchant_id != '' && $onlinePaymentAccount->converge_merchant_user_id != '') :  ?>
    <!-- Remove demo in url for production -->
    <script src="https://api.demo.convergepay.com/hosted-payments/Checkout.js"></script>
    <script src="https://demo.convergepay.com/hosted-payments/PayWithConverge.js"></script>
    <!-- <script src="https://api.convergepay.com/hosted-payments/PayWithConverge.js"></script> -->
<?php endif; ?>
<div>
    <!-- page wrapper start -->
    <div>
        <div class="container-fluid">
            <br class="clear" />
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="right-text">
                                <input type="hidden" id="estimate-id" value="<?= $estimate->id;  ?>">
                                <p class="page-title " style="font-weight: 700;font-size: 16px;"><?= $estimate->estimate_number;  ?> </p>
                            </div>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php if ($company_info->business_image != "") : ?>
                                        <!-- <img style="width: 100px" id="attachment-image" alt="Attachment" src="https://nsmartrac.com/uploads/users/business_profile/1/Nsmart_logo.png"> -->
                                        <img style="width: 100px" id="attachment-image" alt="Attachment" src="<?= base_url('/uploads/users/business_profile/' . $company_info->id . '/' . $company_info->business_image); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <table class="right-text">
                                        <tbody>
                                            <tr>
                                                <td align="right" width="45%">Estimate Date:</td>
                                            </tr>
                                            <tr>
                                                <td align="right">Expiry Date:</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="right-text">
                                        <tbody>
                                            <tr>
                                                <td align="right" width="65%"><?= date("F d, Y",strtotime($estimate->estimate_date)); ?></td>
                                            </tr>
                                            <tr>
                                                <td align="right"><?= date("F d, Y",strtotime($estimate->expiry_date)); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <h6 class="title-border">FROM :</h6>
                                    <b><?= $company_info->business_name; ?></b><br>
                                    <span><?= $company_info->street; ?></span><br>
                                    <span><?= $company_info->city . ', ' . $company_info->state . ' ' . $company_info->postal_code; ?></span><br>
                                    <span> Phone: <?= $company_info->business_phone; ?></span>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <h6 class="title-border">TO :</h6>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <b><?= $customer->first_name . ' ' . $customer->last_name; ?></b>
                                            </div>

                                            <div>
                                                <?= $customer->mail_add; ?></span>
                                            </div>

                                            <div>
                                                <?= $customer->city . ' ' . $customer->state . ' ' . $customer->zip_code; ?></span> <span class="fa fa-copy icon_preview"></span>
                                            </div>

                                            <div>
                                                <span>Email: <?= $customer->email; ?></span> <a href="mailto:<?= $customer->email; ?>"><span class="fa fa-envelope icon_preview"></span></a><br>
                                            </div>
                                            <?php if ($customer->phone_h != "" || $customer->phone_h != NULL) : ?>

                                            <?php else : ?>
                                                <div>
                                                    <span>Phone: </span>
                                                    <?php if ($customer->phone_h != "" || $customer->phone_h != NULL) : ?>
                                                        <?= $customer->phone_h;  ?>
                                                        <span class="fa fa-phone icon_preview"></span>
                                                        <span class="fa fa-envelope-open-text icon_preview"></span>
                                                    <?php else : echo 'N/A'; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($customer->phone_m != "" || $customer->phone_m != NULL) : ?>

                                            <?php else : ?>
                                                <div>
                                                    <span>Mobile: </span>
                                                    <?php if ($customer->phone_m != "" || $customer->phone_m != NULL) : ?>
                                                        <?= $customer->phone_h;  ?>
                                                        <?= $customer->phone_m;  ?>
                                                        <span class="fa fa-phone icon_preview"></span>
                                                        <span class="fa fa-envelope-open-text icon_preview"></span>
                                                    <?php else : echo 'N/A'; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <?php $grandTotal = 0; ?>
                                    <table class="table-print table-items" style="width: 100%; border-collapse: collapse;margin-top: 55px;">
                                        <thead>
                                            <tr>
                                                <!-- <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">#</th> -->
                                                <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Items</th>
                                                <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Item Type</th>
                                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Price</th>
                                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Qty</th>
                                                <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">Discount</th>
                                                <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;" class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>
                                            <?php if ($estimate_type == 'Option') : ?>
                                                <?php if (!empty($items_dataOP1)) : ?>
                                                    <tr>
                                                        <td colspan="7" style="padding:15px;"><b>Option 1</b></td>
                                                    </tr>
                                                    <?php foreach ($items_dataOP1 as $itemData1) : ?>
                                                        <tr class="table-items__tr">
                                                            <!-- <td valign="top" style="width:30px; text-align:center;"></td> -->
                                                            <td valign="top" style="width:40%;"><?= $itemData1->title; ?></td>
                                                            <td valign="top" style="width:18%;"><?= $itemData1->type; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: center;">$<?= number_format((float) $itemData1->costing, 2); ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;"><?= $itemData1->qty; ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;">$<?= $itemData1->discount; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: right;">$<?= number_format((float) $itemData1->total, 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <hr />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Subtotal</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $sub_total, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Taxes</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $tax1_total, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Total amount</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $option1_total, 2); ?></p>
                                                            <?php $grandTotal = (float) $option1_total; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                                <?php if (!empty($items_dataOP2)) : ?>
                                                    <tr>
                                                        <td colspan="7" style="padding:15px;"><b>Option 2</b></td>
                                                    </tr>
                                                    <?php foreach ($items_dataOP2 as $itemData2) : ?>
                                                        <tr class="table-items__tr">
                                                            <!-- <td valign="top" style="width:30px; text-align:center;"></td> -->
                                                            <td valign="top" style="width:40%;"><?= $itemData2->title; ?></td>
                                                            <td valign="top" style="width:18%;"><?= $itemData2->type; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: center;">$<?= number_format((float) $itemData2->costing, 2); ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;"><?= $itemData2->qty; ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;">$<?= $itemData2->discount; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: right;">$<?= number_format((float) $itemData2->total, 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <hr />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Subtotal</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $sub_total2, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Taxes</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $tax2_total, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Total amount</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $option2_total, 2); ?></p>
                                                            <?php $grandTotal = (float) $option2_total; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                            <?php elseif ($estimate_type == 'Bundle') : ?>
                                                <?php if (!empty($items_dataBD1)) : ?>
                                                    <tr>
                                                        <td colspan="7" style="padding:15px;"><b>Bundle 1</b></td>
                                                    </tr>
                                                    <?php foreach ($items_dataBD1 as $itemDatabd1) : ?>
                                                        <tr class="table-items__tr">
                                                            <!-- <td valign="top" style="width:30px; text-align:center;"></td> -->
                                                            <td valign="top" style="width:40%;"><?= $itemDatabd1->title; ?></td>
                                                            <td valign="top" style="width:18%;"><?= $itemDatabd1->type; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: center;">$<?= number_format((float) $itemDatabd1->costing, 2); ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;"><?= $itemDatabd1->qty; ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;">$<?= $itemDatabd1->discount; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: right;">$<?= number_format((float) $itemDatabd1->total, 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <hr />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Subtotal</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $sub_total, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Taxes</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $tax1_total, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Total amount</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $bundle1_total, 2); ?></p>
                                                            <?php $grandTotal = (float) $bundle1_total; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                                <?php if (!empty($items_dataBD2)) : ?>
                                                    <tr>
                                                        <td colspan="7" style="padding:15px;"><b>Bundle 2</b></td>
                                                    </tr>
                                                    <?php foreach ($items_dataBD2 as $itemDatabd2) : ?>
                                                        <tr class="table-items__tr">
                                                            <!-- <td valign="top" style="width:30px; text-align:center;"></td> -->
                                                            <td valign="top" style="width:40%;"><?= $itemDatabd2->title; ?></td>
                                                            <td valign="top" style="width:18%;"><?= $itemDatabd2->type; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: center;">$<?= number_format((float) $itemDatabd2->costing, 2); ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;"><?= $itemDatabd2->qty; ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;">$<?= $itemDatabd2->discount; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: right;">$<?= number_format((float) $itemDatabd2->total, 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="7">
                                                            <hr />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Subtotal</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $sub_total2, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Taxes</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $tax2_total, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Total amount</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $bundle2_total, 2); ?></p>
                                                            <?php $grandTotal = (float) $bundle2_total; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>


                                            <?php else : ?>
                                                <?php if (!empty($items)) : ?>
                                                    <?php foreach ($items as $itemData) : ?>
                                                        <tr class="table-items__tr">
                                                            <!-- <td valign="top" style="width:30px; text-align:center;"></td> -->
                                                            <td valign="top" style="width:40%;"><?= $itemData->title; ?></td>
                                                            <td valign="top" style="width:18%;"><?= $itemData->type; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: center;">$<?= number_format((float) $itemData->iCost, 2); ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;"><?= $itemData->qty; ?></td>
                                                            <td valign="top" style="width: 50px; text-align: center;">$<?= $itemData->discount; ?></td>
                                                            <td valign="top" style="width: 100px; text-align: right;">$<?= number_format((float) $itemData->iTotal, 2); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                    <tr>
                                                        <td colspan="7">
                                                            <hr />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Subtotal</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $sub_total, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Taxes</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $tax1_total, 2); ?></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right;">
                                                            <p>Total amount</p>
                                                        </td>
                                                        <td colspan="2" style="text-align: right;">
                                                            <p>$<?= number_format((float) $grand_total, 2); ?></p>
                                                            <?php $grandTotal = (float) $grand_total; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <tr style="font-size:1.2rem;">
                                                <td colspan="5" style="text-align: right;">
                                                    <p><b>DEPOSIT REQUEST</b></p>
                                                </td>
                                                <td colspan="2" style="text-align:right; padding-left: 1rem;">
                                                    <p style="display: flex; align-items:center; justify-content:flex-end;">
                                                        <?php
                                                        $depositAmount = 0;
                                                        $percentage = null;
                                                        $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                        if ($isPercentage) {
                                                            $percentage = (float) $deposit_amount;
                                                            $depositAmount = ($percentage / 100) * $grandTotal;
                                                        } else {
                                                            $depositAmount = (float) $deposit_amount;
                                                        }
                                                        ?>
                                                        <b>$<?= number_format((float) $depositAmount, 2); ?></b>
                                                        <?php if ($isPercentage) : ?>
                                                            &nbsp;<span>(<?= $percentage ?>%)</span>
                                                        <?php endif; ?>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="col-md-12">
                                    <h6 class="title-border"></h6>
                                    <span style="font-weight: 700;font-size: 20px;color: darkred;">Total : $<?= number_format((float) $grand_total - $depositAmount, 2, '.', ','); ?></span>
                                    <input type="hidden" id="estimate_id" value="<?= $estimate->id; ?>">
                                    <input type="hidden" id="total_amount" value="<?= $grand_total - $depositAmount; ?>">
                                    <br /><br />
                                    <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'payment-job-invoice', 'autocomplete' => 'off']); ?>
                                    <div class="payment-msg"></div>
                                    <div class="payment-api-container" <?= $depositAmount <= 0 ? 'style="display:none;"' : ''; ?>>
                                        <?php if ($onlinePaymentAccount) { ?>
                                            <a class="btn btn-primary btn-confirm-order btn-pay" href="javascript:void(0);">CONFIRM ORDER</a>

                                            <?php if ($onlinePaymentAccount->converge_merchant_user_id != '' && $onlinePaymentAccount->converge_merchant_pin != '') { ?>
                                                <input type="hidden" id="converge-token" name="converge_token" value="" />
                                                <a class="btn btn-primary btn-pay-converge btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA CONVERGE</a>
                                                <?php if (isApple()) { ?>
                                                    <div id="applepay-button" class="apple-pay-button" style="display:none;"></div>
                                                <?php } ?>
                                            <?php } ?>

                                            <?php if ($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != '') { ?>
                                                <a class="btn btn-primary btn-pay-stripe btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA STRIPE</a>
                                            <?php } ?>

                                            <?php if ($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '') { ?>
                                                <div id="paypal-button-container" style="display: inline-block;height: 44px;"></div>
                                            <?php } ?>
                                        <?php } ?>

                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>
<!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_pages'); ?>
<script>
    $(function() {
        function updateEstimateStatus() {
            var estimate_id = $("#estimate_id").val();
            var url = base_url + 'share_Link/update_estimate_status_accepted';
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {
                    estimate_id
                },
                success: function(o) {
                    $(".payment-api-container").hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Successful',
                        text: 'Payment process completed.'
                    });
                }
            });
        }

        //Converge payment
        $(".btn-pay-converge").click(function() {
            //initiateLightbox();
            var token = $('#converge-token').val();
            openLightbox(token);
        });

        $('.btn-confirm-order').click(function() {
            var estimate_id = $("#estimate_id").val();
            var total_amount = $("#total_amount").val();
            <?php if ($onlinePaymentAccount->converge_merchant_user_id != '' && $onlinePaymentAccount->converge_merchant_pin != '') { ?>
                var url = base_url + '_converge_request_token?is_estimate=1';
                $(".btn-confirm-order").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: "json",
                        data: {
                            estimate_id,
                            total_amount: total_amount
                        },
                        success: function(o) {
                            if (o.is_success) {
                                $('#converge-token').val(o.token);
                                <?php if (isApple()) { ?>
                                    initiateApplePay(o.token);
                                <?php } ?>

                                $(".btn-pay-converge").show();

                                <?php if ($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != '') { ?>
                                    $(".btn-pay-stripe").show();
                                <?php } ?>

                                <?php if ($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '') { ?>
                                    // Render the PayPal button into #paypal-button-container
                                    paypal.Buttons({
                                        style: {
                                            layout: 'horizontal',
                                            tagline: false,
                                            height: 45,
                                            color: 'blue'
                                        },
                                        // Set up the transaction
                                        createOrder: function(data, actions) {
                                            return actions.order.create({
                                                purchase_units: [{
                                                    amount: {
                                                        value: $("#total_amount").val()
                                                    }
                                                }],
                                                application_context: {
                                                    shipping_preference: 'NO_SHIPPING'
                                                }
                                            });
                                        },
                                        // Finalize the transaction
                                        onApprove: function(data, actions) {
                                            return actions.order.capture().then(function(details) {
                                                // Show a success message to the buyer
                                                //console.log(details);
                                                updateEstimateStatus();
                                            });
                                        }
                                    }).render('#paypal-button-container');
                                <?php } ?>
                                $(".btn-confirm-order").hide();

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Cannot Process Payment',
                                    text: o.msg
                                });

                                $(".btn-confirm-order").html('CONFIRM ORDER');
                            }
                        }
                    });
                }, 1000);
            <?php } else { ?>
                $(".btn-confirm-order").hide();

                <?php if ($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != '') { ?>
                    $(".btn-pay-stripe").show();
                <?php } ?>

                <?php if ($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '') { ?>
                    // Render the PayPal button into #paypal-button-container
                    paypal.Buttons({
                        style: {
                            layout: 'horizontal',
                            tagline: false,
                            height: 45,
                            color: 'blue'
                        },
                        // Set up the transaction
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: $("#total_amount").val()
                                    }
                                }],
                                application_context: {
                                    shipping_preference: 'NO_SHIPPING'
                                }
                            });
                        },
                        // Finalize the transaction
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                // Show a success message to the buyer
                                //console.log(details);
                                updateEstimateStatus();
                            });
                        }
                    }).render('#paypal-button-container');
                <?php } ?>

            <?php } ?>
        });

        //Converge
        function initiateLightbox() {
            var estimate_id = $("#jobid").val();
            var total_amount = $("#total_amount").val();

            var url = base_url + '_converge_request_token';
            $(".btn-pay-converge").html('<span class="spinner-border spinner-border-sm m-0"></span>');
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    data: {
                        estimate_id,
                        total_amount: total_amount
                    },
                    success: function(o) {
                        if (o.is_success) {
                            //initiateApplePay(o.token);
                            openLightbox(o.token);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cannot Process Payment',
                                text: o.msg
                            });
                        }

                        $(".btn-pay-converge").html('PAY NOW');
                    }
                });
            }, 1000);
        }

        function initiateApplePay(token) {
            var paymentFields = {
                ssl_txn_auth_token: token
            };
            var callback = {
                onError: function(error) {
                    //showResult("error", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Declined',
                        text: 'Apple Pay not available'
                    });
                },
                onCancelled: function() {
                    //showResult("cancelled", "");
                },
                onDeclined: function(response) {
                    //showResult("declined", JSON.stringify(response, null, '\t'));
                },
                onApproval: function(response) {
                    //showResult("approval", JSON.stringify(response, null, '\t'));
                }
            };
            ConvergeEmbeddedPayment.initApplePay('applepay-button', paymentFields, callback);
            return false;
        }

        function openLightbox(token) {
            var paymentFields = {
                ssl_txn_auth_token: token
            };
            var callback = {
                onError: function(error) {
                    //showResult("error", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error
                    });
                },
                onCancelled: function() {
                    //showResult("cancelled", "");
                },
                onDeclined: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Declined',
                        text: 'Cannot process payment'
                    });
                    //showResult("declined", JSON.stringify(response, null, '\t'));
                    //updateEstimateStatus();
                },
                onApproval: function(response) {
                    updateEstimateStatus();
                    //showResult("approval", JSON.stringify(response, null, '\t'));
                }
            };
            PayWithConverge.open(paymentFields, callback);

            return false;
        }
        /*End Converge*/

        //Stripe Payment
        <?php if ($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != '') { ?>
            var handler = StripeCheckout.configure({
                key: '<?= $onlinePaymentAccount->stripe_publish_key; ?>',
                image: '',
                token: function(token) {
                    updateEstimateStatus();
                }
            });

            $('.btn-pay-stripe').on('click', function(e) {
                var amountInCents = Math.floor($("#total_amount").val() * 100);
                var displayAmount = parseFloat(Math.floor($("#total_amount").val() * 100) / 100).toFixed(2);
                // Open Checkout with further options
                handler.open({
                    image: '<?= base_url('/uploads/users/business_profile/' . $company_info->id . '/' . $company_info->business_image); ?>',
                    name: $("#job-number").val(),
                    description: 'Total amount ($' + displayAmount + ')',
                    amount: amountInCents,
                });
                e.preventDefault();
            });

            // Close Checkout on page navigation
            $(window).on('popstate', function() {
                handler.close();
            });
        <?php } ?>
        /*End Stripe Payment*/

        //Paypal
        <?php if ($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '') { ?>

        <?php } ?>
        /*End paypal*/
    });
</script>