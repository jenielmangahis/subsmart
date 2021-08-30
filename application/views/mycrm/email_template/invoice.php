<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/font-awesome/css/font-awesome.min.css">
        <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $url->assets ?>dashboard/css/responsive.css" rel="stylesheet" type="text/css">
    </head>

<!-- add css for this page -->
<?php include viewPath('job/css/job_new'); ?>
<style>
    div[wrapper__section] {
        padding: 60px 10px !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 ) !important;
    }
    .card-body {
        padding: 0 !important;
    }
    .right-text{
        position: relative;
        float:right;
        right: 0;
        bottom: 10px;
    }
    #map{
        height: 190px;
    }
    .title-border{
        border-bottom: 2px solid rgba(0,0,0,.1);
        padding-bottom: 5px;
    }
    .icon_preview{
        font-size: 16px;
        color : #45a73c;
    }
    .table td, .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 0 !important;
    }
    hr{
        width: 90% !important;
    }
</style>
<body style="background:white !important;">

<div class="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <div class="card" style="padding:21px;">
                                <p style="font-size: 18px;margin-bottom: 10px;">Thank you for renewing your subscription. Below are the details.</p>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 style="font-size: 25px;margin-bottom: 37px;">Payment Details</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <table class="table table-no-border table-payment-details">
                                              <tr>
                                                <td colspan="2"><h4 style="font-size: 28px;margin-bottom: 37px;">Order # <?= $payment->order_number; ?></h4></td>
                                              </tr>
                                              <tr>
                                                <td style="width:200px;">Payment Date:</td>
                                                <td><?= date("d-M-Y H:i", strtotime($payment->payment_date)); ?></td>
                                              </tr>
                                              <tr>
                                                <td style="width:200px;">Customer:</td>
                                                <td><?= $company->business_name; ?></td>
                                              </tr>
                                            </table>
                                            <table class="table table-payment-details">
                                              <tr>
                                                <td style="width:100px;font-weight: bold;">Item</td>
                                                <td style="width:50px;font-weight: bold;">Qty</td>
                                                <td style="width:300px;font-weight: bold;">Details</td>
                                                <td style="width:50px;font-weight: bold;text-align: right;">Subtotal</td>
                                              </tr>
                                              <tr>
                                                <td>nSmarTrac Subscription</td>
                                                <td>1</td>
                                                <td>
                                                  <span><?= $payment->description; ?></span><br />                                  
                                                </td>
                                                <td style="text-align: right;">
                                                  $<?= number_format($payment->total_amount, 2); ?>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td colspan="3" style="text-align: right;"><b>TOTAL</b></td>
                                                <td colspan="3" style="text-align: right;"><b>$<?= number_format($payment->total_amount, 2); ?></b></td>
                                              </tr>
                                            </table>  


                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
