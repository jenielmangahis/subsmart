<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Receive Payment</title>
    <link rel="shortcut icon" type="image/png"
        href="<?=base_url().'/assets/dashboard/images/logo.png'?>">
    <style>
        .section.receive_payment {
            position: relative;
        }

        .section.receive_payment .content {
            max-width: 900px;
            left: 50%;
            transform: translate(-50%, 0);
            padding: 30px;
            font-size: 12px;
            position: relative;
        }

        .section.receive_payment .total-receive-payment {
            text-align: right;
        }

        .text-right {
            text-align: right;
        }

        .data-value {
            font-size: 17px;
            font-weight: 600;
        }

        .total-receive-payment .amount {
            font-size: 30px;
            font-weight: 700;
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

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .w-100 {
            width: 100% !important;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        table {
            border-collapse: collapse;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 2px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        @media (min-width: 768px) {
            .col-md-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }

            .col-md-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }

            .col-md-5 {
                -ms-flex: 0 0 41.666667%;
                flex: 0 0 41.666667%;
                max-width: 41.666667%;
            }

            .col-md-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }
    </style>
</head>

<body>
    <div class="section receive_payment">
        <div class="content">
            <div class="header">
                <div class="company_logo">
                    <?php
                    if ($action_request == "email") {
                        if ($has_logo) {
                            ?>
                    <img width="100" src="cid:company_logo" alt="" style="width:100px;">
                    <?php
                        } else {
                            echo "<h3>".$company_name."</h3>";
                        }
                    } else {
                        echo '<img src="'.base_url().'/uploads/users/business_profile/'.$business_id.'/'.$business_image.'"
                        alt=""  style="width:100px;">';
                    }
                    ?>
                </div>
                <h1>Receive Payment</h1>
            </div>
            <div class="body">
                <div class="payment-field-part">
                    <div class="row no-margin">
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-5 no-padding">
                                    <div class="form-group" style="margin-bottom: 10!important;">
                                        <div class="label">Customer</div>
                                        <div class="data-value"><?=$customer_name?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-12 no-padding">
                                    <div class="total-receive-payment">
                                        <div class="label">AMOUNT RECEIVED</div>
                                        <div class="amount">$<?=$amount_received?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row no-margin">
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5!important;">
                                        <div class="label">Payment date</div>
                                        <div class="data-value">
                                            <?=date("M d, Y", strtotime($payement_date))?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6 no-padding">
                            <div class="row no-margin">
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label">Payment method</div>
                                        <div class="data-value">
                                            <?=$payment_method?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label">Reference no.</div>
                                        <div class="data-value">
                                            <?=$ref_no?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding">
                                    <div class="form-group" style="margin-bottom: 5px!important;">
                                        <div class="label">Deposit to</div>
                                        <div class="data-value">
                                            <?=$deposite_to?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoicing-part">
                    <div class="invoices">
                        <div class="outstanding-transactions" style="">
                            <div class="title">Outstanding Transactions</div>
                            <div class="customer-table-part">
                                <table id="customer_invoice_table" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>DESCRIPTION</th>
                                            <th>DUE DATE</th>
                                            <th class="text-right">ORIGINAL AMOUNT</th>
                                            <th class="text-right">OPEN BALANCE</th>
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
                                                <?=$invoice_info->due_date?>
                                            </td>
                                            <td class="text-right">
                                                <?=number_format($invoice_info->grand_total, 2)?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                $total_amount_received =0;
                                                $payment_received = $this->accounting_invoices_model->get_payements_by_invoice($this->input->post("inv_number_".$i));
                                                foreach ($payment_received as $received) {
                                                    $total_amount_received+=$received->amount;
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
                                <div class="total-amount text-right">
                                    <div class="amount-to-apply">
                                        <label class="label">Amount to Apply</label>
                                        <label class="amount" style="font-weight: bold;width:100px;">$<?=$amount_received?></label>
                                    </div>
                                    <div class="amount-to-credit">
                                        <label class="label">Amount to Credit</label>
                                        <label class="amount" style="font-weight: bold;width:100px;">$0.00</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="proof-part">
                            <div class="row no-margin">
                                <div class="col-md-12 no-padding">
                                    <div class="row no-margin">
                                        <div class="col-md-4 no-padding">
                                            <div class="form-group" style="margin-bottom: 5px!important;">
                                                <?php
                                                if ($memo !="") {
                                                    ?>
                                                <div class="label">Memo</div>
                                                <div class="data-value"><?=$memo?>
                                                    <?php
                                                }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="lead text-muted" style="text-align: left; margin-top:20px;font-size: 12px">
                    <label style="padding-bottom: 5px;">Thanks,<br><br> nSmarTrac Team
                </p>
                <p class="lead text-muted nsmartrac-address"
                    style="text-align:left;font-size: 10px!important;color: #6C757D!important;">
                    6866 Pine Forest Road Suite C &#8226; Pensacola, Florida 32526
                </p>
                <p style="text-align: left; margin-top:20px;">
                    <?php
                    if ($action_request == "email") {
                        ?>
                    <img width="100" src="cid:logo_2u" alt="" style="width:100px;">
                    <?php
                    } else {
                        echo '<img src="'.base_url().'/assets/dashboard/images/logo.png"
                        alt="" style="width:100px;">';
                    }
                    ?>
                </p>
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