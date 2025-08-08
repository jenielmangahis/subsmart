<?php
//$invoice_date = date('m/d/Y', strtotime($invoice->date_issued));
//$invoice_logo = companyInvoiceLogo($invoice->company_id);

$invoice_logo = "";
$due_date = 'Due on receipt';
?>

<div class="container">
    <div class="main" style="background-color:#ffffff;">            
        <div class="container-left">
            <table style="margin-bottom: 50px;">
                <tr>
                    <div><b>TO:</b></div>                    
                    <div>dfd</div>
                    <div>dfdf</div>
                    <div>dfdf</div>
                    <div>TEL: dfdf</div>
                </tr>
            </table>
        </div>
        <div class="container-right">
            <table style="margin-bottom: 50px;">
                <tr>
                    <div><b>FROM:</b></div>                    
                    <div><?= strtoupper('dfdfd'); ?></div>
                    <div><?= strtoupper('dfdfd'); ?></div>
                    <div><?= strtoupper('dfdfd' . ', ' .'dfdfd' . ' ' . 'dfdfd'); ?></div>
                    <div>TEL: <?= 'dfdfd'; ?></div>
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
                    <img alt="Invoice Logo" src="<?= $invoice_logo; ?>" class="companyimage" />
                </td>
                <td style="text-align: center; width: 1%; white-space: nowrap; padding: 0 16px;">
                    <b>INVOICE NO#</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= 'sfdfd'; ?></div>
                </td>
                <td style="text-align: center; width: 1%; white-space: nowrap; padding: 0 16px;">
                    <b>Status</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= 'dfdfd'; ?></div>
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

            <?php $items = []; ?>
            <!-- 
            <?php foreach ($items as $item) : ?>
                <?php if ($item->items_id != 0) : ?>
                    <?php if($item->type == 'Service'){ ?>
                    <tr>
                        <td style="padding: 8px; border: 1px solid;"><?= $item->title; ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align: center;"><?= $item->qty; ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align:center;">$<?= number_format((float) $item->costing, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align:center;">$<?= number_format((float) $item->discount, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align:center;">$<?= number_format((float) $item->tax, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align:right;">
                            <?php $a = (float) $item->qty * (float) $item->costing; ?>
                            <?php $b = $a + (float) $item->tax; ?>
                            $<?= number_format($item->total,2); //number_format((float) $b, 2);  ?>
                        </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                        <td style="padding: 8px; border: 1px solid;"><?= $item->title; ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align: center;"><?= $item->qty; ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align:center;">$<?= number_format((float) $item->costing, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align:center;">$<?= number_format((float) $item->discount, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align:center;">$<?= number_format((float) $item->tax, 2); ?></td>
                        <td style="padding: 8px; border: 1px solid;text-align:right;">
                            <?php $a = (float) $item->qty * (float) $item->costing; ?>
                            <?php $b = ($a + (float) $item->tax) - $item->discount; ?>
                            $<?= number_format($item->total,2); //number_format((float) $b, 2);  ?>
                        </td>
                    </tr>
                    <?php } ?>                        
                <?php endif; ?>
            <?php endforeach; ?>
            -->

            <?php $invoice = []; ?>

            <tr>
                <td colspan="3" rowspan="9">
                    <?php //if( $invoice->status != 'Paid' ){ ?>
                    <?php $payment_link = base_url('customer_invoice/'.'dsfddf'.'/' . 'dfdsfdfd'); ?>
                    <a href="javascript:void(0);" class="payinvoice">
                        <b>PAY INVOICE</b>
                    </a>  
                    
                    <div class="online-payment-container" style="display:none;margin-top:10px;">
                        <div class="row">
                            ssdss
                        </div>
                    </div>
                    <?php //} ?>
                </td>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>SUBTOTAL (WITHOUT TAX)</b>
                </td>
                <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 123123, 2, '.', ','); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>TAXES</b>
                </td>
                <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 343, 2, '.', ','); ?></td>
            </tr>

            <?php //if( $invoice->installation_cost > 0 ){ ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>INSTALLATION COST</b>
                </td>
                <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 34343 , 2, '.', ','); ?></td>
            </tr>
            <?php //} ?>

            <?php //if( $invoice->program_setup > 0 ){ ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>ONE TIME (PROGRAM AND SETUP)</b>
                </td>
                <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 4343, 2, '.', ','); ?></td>
            </tr>
            <?php //} ?>

            <?php //if( $invoice->monthly_monitoring > 0 ){ ?>
            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>MONTHLY MONITORING</b>
                </td>
                <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 33434, 2, '.', ','); ?></td>
            </tr>
            <?php //} ?>

            <?php //if( $invoice->adjustment_value > 0 ){ ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;text-transform: uppercase;">
                        <b>ADJUSTMENT</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 3434, 2, '.', ','); ?></td>
                </tr>
            <?php //} ?>
            <?php //if( $invoice->no_tax == 1 ){ ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>TAX EXEMPTED</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">YES</td>
                </tr>
            <?php //} ?>

            <?php //if( $invoice->payment_fee > 0 ){ ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>PAYMENT FEE</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 33434, 2, '.', ','); ?></td>
                </tr>
            <?php //} ?>

            <?php //if( $invoice->late_fee > 0  ){ ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">

                            <b>LATE FEE </b>
 
                    </td>
                    <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 112, 2, '.', ','); ?></td>
                </tr>
            <?php //} ?>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>GRAND TOTAL</b>
                </td>
                <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 1212, 2, '.', ','); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid;">
                    <b>DEPOSIT</b>
                </td>
                <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format((float) 1212, 2); ?></td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 8px; border: 1px solid; font-size: 20px;">
                    <b>BALANCE DUE</b>
                </td>
                <td style="padding: 8px; border: 1px solid;text-align:right;">$<?= number_format(3434, 2); ?></td>
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