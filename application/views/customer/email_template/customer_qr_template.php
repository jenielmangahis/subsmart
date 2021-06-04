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
                            <div class="card">
                                <br>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" style="text-align:center;">
                                            <span>Scan this QR to view customer details.</span>
                                            <br>
                                                <img width="200" src="https://nsmartrac.com/assets/img/customer/qr/<?= $customer_id['id'].".png"; ?>" alt="Customer Qr">
                                            <br>
                                            <b><?= $customer_id['firstname'].' '. $customer_id['lastname'] ; ?></b>
                                            <br><br><br>
                                            <center>
                                                <em>Powered By</em><br>
                                                <img width="200" src="http://nsmartrac.com/assets/dashboard/images/logo.png" alt="">
                                            </center>
                                        </div>
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

<?php
add_footer_js(array(
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
));
//include viewPath('includes/footer');
?>

</body>
</html>

