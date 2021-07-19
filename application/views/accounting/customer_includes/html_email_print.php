<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet"
        href="<?=base_url('assets/dashboard/css/bootstrap.min.css')?>">
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 10px;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        .section.receive_payment .total-receive-payment {
            text-align: right;
        }

        .data-value {
            font-weight: bold;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        .text-right {
            text-align: right;
        }

        .total-receive-payment .amount {
            font-weight: 700;
            font-size: 13px;
        }

        .invoicing-part {
            margin-top: 15px;
        }

        .invoices .outstanding-transactions .title {
            margin-bottom: 5px;
        }

        .section.receive_payment .header h1 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .section.receive_payment .header .company_logo img {
            width: 100px;
        }

        #customer_invoice_table thead tr {
            background-color: #EBEDF4;
        }

        #customer_invoice_table thead tr th {
            color: #9AA5CB;
        }

        .receipt-title {
            color: #9AA5CB;
            font-size: 30px;
            font-weight: lighter;
        }

        p {
            margin: 0;
        }

        h1,
        h2 {
            margin: 0;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 75%;">
                    <div class="business-info">
                        <h2 class="business-name" style="margin: 0; font-size:15px;">
                            <?=$business_name?>
                        </h2>
                        <p class="address-strees" style="margin: 0;">
                            <?=$business_address_street?>
                        </p>
                        <p class="address-state">
                            <?=$business_address_state?>
                        </p>
                        <p class="contact-number">
                            <?=$business_contact_number?>
                        </p>
                        <p class="email">
                            <?=$business_email?>
                        </p>
                    </div>
                </td>
                <td style="width: 25%;">
                    <div class="business-logo">
                        <img src="<?=base_url()?>uploads/users/business_profile/<?=$business_logo?>"
                            alt="" style="width: 100px;">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 50%;">
                    <h2 class="receipt-title">Receipt</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 75%;">
                    <div class="customer-info">
                        <h2 style="font-size: 15px;">Receive From</h2>
                        <p class="customer-name data-value"><?=$customer_name?>
                        </p>
                        <p class="address-street"><?=$customer_adress_street?>
                        </p>
                        <p class="address-state"><?=$customer_address_state?>
                        </p>
                    </div>
                </td>
                <td style="width: 25%;">
                    <p class="customer-name"><b>Date: </b><?=date("M d, Y", strtotime($payement_date))?>
                    </p>
                    <p class="customer-name"><b>Reference No: </b> <?=$ref_no?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="section receive_payment">
        <div class="content">
            <div class="body">
                <div class="invoicing-part">
                    <div class="invoices">
                        <div class="outstanding-transactions" style="">
                            <div class="title">Outstanding Transactions</div>
                            <div class="customer-table-part">
                                <table id="customer_invoice_table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left;">DESCRIPTION</th>
                                            <th style="text-align: left;">INV. DATE</th>
                                            <th style="text-align: left;">DUE DATE</th>
                                            <th class="text-right">ORIGINAL AMOUNT</th>
                                            <th class="text-right">BALANCE</th>
                                            <th class="text-right">PAYMENT</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <?php
                                        $inv_count=$this->input->post("invoice_count");
                                        for ($i =0;$i<$inv_count;$i++) {
                                            if ($this->input->post("inv_cb_".$i) == "on") {
                                                $invoice_info = $this->accounting_invoices_model->get_invoice_by_invoice_no($this->input->post("inv_number_".$i)); ?>
                                        <tr>

                                            <td>
                                                <?=$this->input->post("inv_number_".$i)?>
                                            </td>
                                            <td>
                                                <?=$invoice_info->date_issued?>
                                            </td>
                                            <td>
                                                <?=$invoice_info->due_date?>
                                            </td>
                                            <td class="text-right">
                                                <?=number_format($invoice_info->grand_total, 2)?>
                                            </td>
                                            <td class="text-right data-value">
                                                <?php
                                                $invoice_payments = $this->accounting_receive_payment_model->get_invoice_receive_payment($invoice_info->id, $this->input->post("receive_payment_id"));
                                                $total_amount_received =0;
                                                foreach ($invoice_payments as $receive) {
                                                    $total_amount_received+=$receive->payment_amount;
                                                }
                                                echo number_format($invoice_info->grand_total-$total_amount_received, 2); ?>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="data-value text-right"><?=$this->input->post("inv_".$i)?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <table style="width: 100%; margin-top:20px;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 50%;">
                                                <div class="label">Memo:</div>
                                                <div class="data-value">
                                                    <?=$memo?>
                                                </div>
                                            </td>
                                            <td style="width: 50%;">
                                                <div class="total-amount text-right">
                                                    <table style="width: 100%;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 50%;">
                                                                    <label class="label">Amount to
                                                                        Credited</label>
                                                                </td>
                                                                <td style="width: 50%;">
                                                                    <label class="amount"
                                                                        style="font-weight: bold;width:100px;">$0.0</label>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 50%;">
                                                                    <label class="label">Total:</label>
                                                                </td>
                                                                <td style="width: 50%;">
                                                                    <label class="amount"
                                                                        style="font-weight: bold;width:100px;">
                                                                        $<?=$amount_received?></label>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;"></td>
                                            <td style="width: 50%;">
                                                <div style="margin-top: 30px;">
                                                    Singnature: _____________
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">

            </div>
        </div>
    </div>
    <script>
        <?php if ($action_request == "print") {
                                            echo "window.print();";
                                        }?>
    </script>
</body>

</html>