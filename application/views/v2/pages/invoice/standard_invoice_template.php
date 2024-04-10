<style>
    body {
        margin: 0;
        font-size: 14px;
        background-color: #ffffff !important;
    }

    .container {
        padding: 16px;
        background-color: #f5f5f5;
    }

    .main {
        width: 800px;
        margin: auto;
        padding: 16px;
        box-sizing: border-box;
        background-color: #fff;
    }

    table {
        width: 100%;
    }

    .payinvoice {
        display: block;
        height: 50px;
        line-height: 50px;
        font-size: 20px;
        text-decoration: none;
        width: 90%;
        margin: auto;
        border-radius: 8px;
        text-align: center;
        background-color: #64477d;
        color: #fff !important;
        box-shadow: 0px 15px 20px #64477d87;
        max-width: 200px;
    }

    .companyimage {
        width: 161px;
        height: 70px;
        min-width: 161px;
        min-height: 70px;
        background-color: #e2e2e2;
        display: block;
        /* margin:auto; */
    }

    .companyimage.companyimage-big {
        width: 265px;
        height: auto;
        min-width: 100px;
        min-height: 100px;
    }

    .container-left {
        width: 50%;
        float: left;
    }

    .container-right {
        width: 50%;
        float: right;
    }

    .clear {
        clear: both;
    }

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

    .gpay-card-info-container.black,
    .gpay-card-info-animation-container.black {
        height: 46px;
    }

    #google-pay-button {
        position: relative;
        top: 20px;
    }

    #apple-pay-button {
        height: 48px;
        width: 50%;
        display: inline-block;
        -webkit-appearance: -apple-pay-button;
        -apple-pay-button-type: plain;
        -apple-pay-button-style: black;
        vertical-align: top;
    }

    #google-pay-button,
    #apple-pay-button {
        display: inline-block;
    }

    .api-button {
        display: block !important;
        width: 90% !important;
        margin: 15px;
    }

    .vertical-alignment-helper {
        display: table;
        height: 100%;
        width: 100%;
        pointer-events: none;
    }

    .vertical-align-center {
        /* To center vertically */
        display: table-cell;
        vertical-align: middle;
        pointer-events: none;
    }

    .modal-content {
        /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
        width: inherit;
        max-width: inherit;
        /* For Bootstrap 4 - to avoid the modal window stretching full width */
        height: inherit;
        /* To center horizontally */
        margin: 0 auto;
        pointer-events: all;
    }

    #square-cancel-button {
        margin-left: 23px;
    }

    .payment-status-container {
        padding: 10px 0px;
    }

    .modal-total-amount {
        color: darkred;
        font-size: 19px;
        font-weight: bold;
        margin-bottom: 19px;
        display: block;
    }

    @media only screen and (max-width: 600px) {
        #square-payment-modal .modal-content {
            width: 100% !important;
        }

        #braintree-payment-modal .modal-content {
            width: 100% !important;
        }

        .square-pay-button {
            width: 100% !important;
        }

        .btn-braintree-pay-now,
        .cancel-braintree {
            width: 100% !important;
        }

        #google-pay-button {
            width: 100%;
            top: 3px !important;
        }

        #square-cancel-button {
            width: 100% !important;
            margin-left: 0px !important;
        }

        .gpay-card-info-container {
            width: 100% !important;
        }
    }

    #btn-pay-stripe {
        display: block;
        width: 95%;
        margin-left: 7px;
        text-align: center;
        margin-top: 10px;
        background-color: #6a4a86 !important;
        color: #fff;
        border: 1px solid #d3d3d3;
        border-radius: 5px;
        padding: 0.5em 0.7em;
        font-size: 14px;
        font-weight: 700;
    }

    #btn-braintree-pay-now,
    #card-button {
        width: 100%;
        margin-left: -1px;
        text-align: center;
    }
</style>

<?php
$invoice_date = date('m/d/Y', strtotime($invoice->date_issued));
$company_image = 'https://nsmartrac.com/uploads/users/business_profile/8/new_adi_logo.png';

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
            <div>
                <img alt="adi" src="<?= $company_image; ?>" class="companyimage" />
            </div>
            <table style="margin-bottom: 50px;">
                <tr>
                    <div><b>TO:</b></div>
                    <div>JANEAB DOE</div>
                    <div>janedo@gmail.com</div>
                    <div>6055 BORN COURT</div>
                    <div>TEL: 111-111-1111</div>
                </tr>
            </table>
        </div>
        <div class="container-right">
        
            <div style="display: flex; margin-bottom:30px">
           
                <table>
                         <tr>
                        <td><b>ORIGINAL INVOICE</b></td>
                         </tr>
                         <tr>
                         <td>   CUSTOMER NAME</td>
                         </tr>
                         <tr><td>PLEASE WRITE THIS NUMBER</td></tr>
                         <tr><td>ON THE ORDERS AND CHECKS</td></tr>
                         <tr>
                           <td style="border:1px solid black; text-align: center;">23</td>
                         </tr>
                         <tr>
                        <td style="text-align: end;"><b>PLEASE PAY THIS AMOUNT</b></td>
                         </tr>
                         <tr><td style="text-align: end;"><b>DUE DATE</b></td></tr>
                    </table>
 
                <table style=" border-collapse: collapse; white-space:nowrap;border:1px solid black; vertical-align:top; text-align: center;">
                        <tr>
                            <td style="border:1px solid black;">
                              <b>  PAGE</b>
                            </td >
                            <td  style="border:1px solid black;">
                                <b>INVOICE DATE</b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>12/23/23</td>
                        </tr>
                        <tr>
                            <td  style="border:1px solid black;" colspan="2" ><b>INVOICE NUMBER</b></td>
                        </tr>
                        <tr>
                         <td  style="border:1px solid black;" colspan="2">INV-2323232</td>
                        </tr>
                       <tr>
                       <td  style="border:1px solid black;" colspan="2"> 09</td>
                       </tr>
                       <tr>
                    <td  style="border:1px solid black; " colspan="2">    12/23/23</td>
                       </tr>
                    </table>
            </div>
            <table style="margin-bottom: 50px;">
                <tr>
                    <div><b>REMIT TO:</b></div>
                    <div>ADI SMART HOME</div>
                    <div>9175 KINGS COLONY ROAD</div>
                    <div>JACKSONVILLE, FL 32257</div>
                    <div>TEL: 8506960703</div>
                </tr>
            </table>
        </div>
        <div class="clear"></div>
        <table>
            <tr><td style="text-align: center;  white-space: nowrap;">Please detach and In veniam labore eu amet  .</td> <td style="text-align: center;  white-space: nowrap;"> incididunt nisi nostrud fugiat eu dolore aliquip adipis</td></tr>
            <tr>
                <td style="text-align: center; border-top: 2px dashed; ">&nbsp;</td>
                <td style="text-align: center; border-top: 2px dashed; ">&nbsp;</td>
            </tr>
        </table>

        <table style="padding: 0 16px 16px 16px;margin-top:5px;margin-bottom:5px;">
            <tr>
                <td>
                    <img alt="adi" src="<?= $company_image; ?>" class="companyimage" />
                </td>
                <td colspan="3" style="text-align: center;  white-space: nowrap; padding: 0 8px;">
                    <b>CUSTOMER NUMBER</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;">12312312</div>
                </td>
                <td style="text-align: center;  white-space: nowrap; padding: 0 8px;">
                    <b>INVOICE NO#</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;">INV-0000144</div>
                </td>
                <td style="text-align: center;  white-space: nowrap; padding: 0 8px;">
                    <b>Status</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;">Draft</div>
                </td>
                <td style="text-align: center;  white-space: nowrap; padding: 0 8px;">
                    <b>DATE</b>
                    <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= date("m/d/Y"); ?></div>
                </td>
                <td style="text-align: start;vertical-align:center;  white-space: nowrap; padding: 0 8px;">
                    <p style="margin-bottom: 0;">Aliqua dolor cillum eiu</p>
                    <p style="margin-top: 0;">incididunt sunt volup</p>

                </td>
                <td></td>
            </tr>
        </table>

        <table style="border-collapse: collapse;  margin-bottom: 50px;">
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

            <tr style="border-left: 1px solid;">
                <td style="padding: 8px; border-right: 1px solid;">Advertising ADi Magnets</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">2</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$100.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">
                    $100.00 </td>
            </tr>
            <tr style="border-left: 1px solid;">
                <td style="padding: 8px; border-right: 1px solid;">Advertising ADi Magnets</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">2</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$100.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">
                    $100.00 </td>
            </tr>
            <tr style="border-left: 1px solid;">
                <td style="padding: 8px; border-right: 1px solid;">Advertising ADi Magnets</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">2</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$100.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">
                    $100.00 </td>
            </tr>
            <tr style="border-left: 1px solid;">
                <td style="padding: 8px; border-right: 1px solid;">Advertising ADi Magnets</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">2</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$100.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">
                    $100.00 </td>
            </tr>
            <tr style="border-left: 1px solid;">
                <td style="padding: 8px; border-right: 1px solid;">Advertising ADi Magnets</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">2</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$100.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">
                    $100.00 </td>
            </tr>

            <tr style="border-left: 1px solid; border-bottom: 1px solid;">
                <td style="padding: 8px; border-right: 1px solid; ">Advertising ADi Magnets</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">2</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$100.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">$0.00</td>
                <td style="padding: 8px; border-right: 1px solid; text-align: center;">
                    $100.00 </td>
            </tr>
            

            <tr>
                <td colspan="3" rowspan="9" style="padding: 10px; vertical-align:top">
                   Dolore officia elit irure nisi.Adipisicing do sint eiusmod exercitation 
                   commodo commodo ad incididunt aliquip pariatur. Incididunt culpa Lorem laboris 
                   aliquip amet laborum culpa aliqua duis anim. Nostrud aliqua non dolore id sunt quis. 
                   Laborum adipisicing duis ad magna anim do ipsum nisi commodo excepteur nulla velit veniam aliquip.
                    Ad pariatur exercitation cupidatat veniam officia duis id irure id sit.
                   
                </td>
                <td colspan="2" style="padding: 8px;white-space:nowrap; border: 1px solid;">
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
                <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->installation_cost, 2, '.', ','); ?></td>
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
            <?php if ($invoice->adjustment_value > 0) { ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;text-transform: uppercase;">
                        <b><?= $invoice->adjustment_name != '' ? $invoice->adjustment_name : 'ADJUSTMENT' ?></b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->adjustment_value, 2, '.', ','); ?></td>
                </tr>
            <?php } ?>
            <?php if ($invoice->no_tax == 1) { ?>
                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>TAX EXEMPTED</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">YES</td>
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