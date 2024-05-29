<?php
$invoice_date = date('m/d/Y', strtotime($invoice->date_issued));
$company_image = base_url('/uploads/users/business_profile/' . $company_info->id . '/' . $company_info->business_image);

$due_date = 'Due on receipt';
if ($invoice->due_date > date('Y-m-d')) {
    $due_date = date('m/d/Y', strtotime($invoice->due_date));
}
?>
<input type="hidden" name="invoice_id" id="pay-now-invoice-id" value="<?= $invoice->id; ?>" />
<input type="hidden" id="pay-now-total-amount" value="<?= $invoice->grand_total; ?>" />
<input type="hidden" id="pay-now-invoice-number" value="<?= $invoice->invoice_number; ?>" />

<div class="container" style="background-color:#ffffff;">
    <div class="main" style="width:1000px;">            
        <div class="container-left">
            <table style="margin-bottom: 50px;">
                <tr>
                    <div><b>TO:</b></div>                    
                    <div><?= strtoupper($customer->first_name . ' ' . $customer->last_name); ?></div>
                    <div><?= strtoupper($customer->mail_add); ?></div>
                    <div><?= strtoupper($customer->city . ' ' . $customer->state . ' ' . $customer->zip_code); ?></div>
                    <div>TEL: <?= $customer->phone_m; ?></div>
                </tr>
            </table>
        </div>
        <div class="container-right">
            <table style="margin-bottom: 50px;">
                <tr>
                    <div><b>FROM:</b></div>                    
                    <div><?= strtoupper(trim($company_info->business_name)); ?></div>
                    <div><?= strtoupper($company_info->street); ?></div>
                    <div><?= strtoupper($company_info->city . ', ' . $company_info->state . ' ' . $company_info->postal_code); ?></div>
                    <div>TEL: <?= $company_info->business_phone; ?></div>
                </tr>
            </table>  
        </div>
        <div class="clear"></div>
        <table>
            <tr>
                <td style="text-align: center; border-bottom: 2px dashed;">&nbsp;</td>
                <td style="text-align: center; border-bottom: 2px dashed;">&nbsp;</td>
            </tr>
        </table>

        <table style="padding: 16px;margin-top:5px;margin-bottom:5px;">
            <tr>
                <td>
                    <img alt="<?= $company_info->business_name; ?>" src="<?= $company_image; ?>" class="companyimage" />
                </td>
                <td style="text-align: center; width: 1%; white-space: nowrap; padding: 0 16px;">
                    <b>INVOICE NO#</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= $invoice->invoice_number; ?></div>
                </td>
                <td style="text-align: center; width: 1%; white-space: nowrap; padding: 0 16px;">
                    <b>Status</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= $invoice->status; ?></div>
                </td>
                <td style="text-align: center; width: 1%; white-space: nowrap; padding: 0 16px;">
                    <b>DATE</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= date("m/d/Y"); ?></div>
                </td>               
                <td></td>
            </tr>
        </table>

        <table style="border-collapse: collapse; margin-bottom: 50px;">
            <tr>
                <td style="border: 1px solid; text-align: center;">
                    <b>MATERIALS</b>
                </td>
                <td style="border: 1px solid; text-align: center;">
                    <b>QTY</b>
                </td>
                <td style="border: 1px solid; text-align: center;">
                    <b>UNIT PRICE</b>
                </td>
                <td style="border: 1px solid; text-align: center;">
                    <b>DISCOUNT</b>
                </td>
                <td style="border: 1px solid; text-align: center;">
                    <b>TAX</b>
                </td>
                <td style="border: 1px solid; text-align: center;">
                    <b>AMOUNT</b>
                </td>
            </tr>

            <?php foreach ($items as $item) : ?>
                <?php if ($item->items_id != 0) : ?>
                    <?php if($item->type == 'Service'){ ?>
                    <tr>
                        <td style="padding: 8px; border: 1px solid;"><?= $item->title; ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;"><?= $item->qty; ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->costing, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->discount, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->tax, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;">
                            <?php $a = (float) $item->qty * (float) $item->costing; ?>
                            <?php $b = $a + (float) $item->tax; ?>
                            $<?= number_format($item->total,2); //number_format((float) $b, 2);  ?>
                        </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                        <td style="padding: 8px; border: 1px solid;"><?= $item->title; ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;"><?= $item->qty; ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->costing, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->discount, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->tax, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid; text-align: center;">
                            <?php $a = (float) $item->qty * (float) $item->costing; ?>
                            <?php $b = ($a + (float) $item->tax) - $item->discount; ?>
                            $<?= number_format($item->total,2); //number_format((float) $b, 2);  ?>
                        </td>
                    </tr>
                    <?php } ?>                        
                <?php endif; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="3" rowspan="9">
                    <?php if( $invoice->status != 'Paid' ){ ?>
                    <a href="javascript:void(0);" class="payinvoice">
                        <b>PAY INVOICE</b>
                    </a>  
                    
                    <div class="online-payment-container" style="display:none;">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="payment_method" id="pay-now-payment-method" class="form-control" style="width:80%;">
                                    <option value="" selected="selected">- Select Payment Method -</option>
                                    <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
                                        <option value="stripe">Stripe</option>
                                    <?php } ?>
                                    <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
                                        <option value="paypal">Paypal</option>
                                    <?php } ?>
                                    <?php if($braintree_token != ''){ ?>
                                        <option value="braintree">Credit Card via Braintree</option>
                                    <?php } ?>
                                    <?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
                                        <option value="square">Credit Card via Square</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-10" style="min-height:50px;">
                                <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
                                    <a class="nsm nsm-button primary" id="btn-pay-stripe" href="javascript:void(0);" style="display:none;">PAY VIA STRIPE</a>
                                <?php } ?>
                                <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
                                    <div id="paypal-button-container" style="display: none;height: 44px;"></div>
                                <?php } ?>   
                                <?php if($braintree_token != ''){ ?>   
                                    <div id="braintree-container" style="display:none;">
                                        <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'payment-job-invoice', 'autocomplete' => 'off']); ?>
                                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                                            <div id="bt-dropin"></div>                  
                                            <button type="submit" class="nsm nsm-button primary" id="btn-braintree-pay-now">Pay Now</button> 
                                        <?php echo form_close(); ?>
                                    </div>
                                <?php } ?> 
                            </div>  
                        </div>
                    </div>
                    <?php } ?>
                </td>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>SUBTOTAL (WITHOUT TAX)</b>
                </td>
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->sub_total, 2, '.', ','); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>TAXES</b>
                </td>
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->taxes, 2, '.', ','); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>INSTALLATION COST</b>
                </td>
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->installation_cost , 2, '.', ','); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>ONE TIME (PROGRAM AND SETUP)</b>
                </td>
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->otp_setup, 2, '.', ','); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>MONTHLY MONITORING</b>
                </td>
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->monthly_monitoring, 2, '.', ','); ?></td>
            </tr>
            <?php if( $invoice->adjustment_value > 0 ){ ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;text-transform: uppercase;">
                        <b><?=  $invoice->adjustment_name != '' ? $invoice->adjustment_name : 'ADJUSTMENT' ?></b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->adjustment_value, 2, '.', ','); ?></td>
                </tr>
            <?php } ?>
            <?php if( $invoice->no_tax == 1 ){ ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>TAX EXEMPTED</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">YES</td>
                </tr>
            <?php } ?>

            <?php if( $invoice->late_fee > 0  ){ ?>
                    <tr>
                        <td colspan="2" style="padding: 8px; border: 1px solid;">
                            <b>LATE FEE</b>
                        </td>
                        <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->late_fee, 2, '.', ','); ?></td>
                    </tr>
                <?php } ?>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>GRAND TOTAL</b>
                </td>
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->grand_total, 2, '.', ','); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>DEPOSIT</b>
                </td>
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->deposit_request, 2); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid; font-size: 20px;">
                    <b>BALANCE DUE</b>
                </td>
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) ($invoice->grand_total - $invoice->deposit_request), 2); ?></td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <b style="font-size: 30px; color: red;">THANK YOU FOR YOUR ORDER</b>
                </td>
            </tr>
            <tr>
                <td>All claims must be made within 5 days after receipt of goods. Goods returned without our authorized return number on the carton will be
                    refused. The purchase of products and services are subject to and governed solely by the Terms and Conditions.</td>
            </tr>
            <tr>
                <td>
                    <a href="https://nsmartrac.com/terms-and-condition" style="color: blue;text-decoration:none;">https://nsmartrac.com/terms-and-condition</a>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="color: red;">Past due balances may be subject to a Late Charge not to exceed 1.5% per month.</div>
                </td>
            </tr>
        </table>
    </div>
</div>