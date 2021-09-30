<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/font-awesome/css/font-awesome.min.css">
        <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $url->assets ?>dashboard/css/responsive.css" rel="stylesheet" type="text/css">
    </head>

<body style="background:white !important;">

<div class="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <p style="margin: 0px;">From</p>
                    <p><?= $company->business_name; ?></p>
                    <p style="margin-top: 10px;margin-bottom: 50px;"><?= $email_body; ?></p>                    
                    <div style="text-align: center;margin-top: 100px;">
                        <span style="display: block;margin-bottom: 8px;">Powered By</span>
                        <img src="<?= base_url("assets/dashboard/images/logo.png"); ?>" style="width: 20%; margin: 0 auto;">
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
