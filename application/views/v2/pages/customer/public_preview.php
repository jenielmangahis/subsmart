<?php include viewPath('includes/header_front'); ?>
<style>
body{
    background:#ffffff !important;
}
</style>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/main.css") ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/media.css") ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/general-style.css") ?>">
<!-- Boxicons CSS-->
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/boxicons.min.css") ?>">
<!-- Bootstrap CSS-->
<link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap.min.css") ?>" crossorigin="anonymous">
<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="<?= base_url("assets/css/v2/google-font.css") ?>" rel="stylesheet">
<div class="container">
    <br class="clear"/>
    <div class="row">
        <div class="col-12">
            <div class="nsm-page">
                <div class="nsm-page-content">
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <?php include viewPath('v2/pages/customer/advance_customer_forms/front_view/preview_customer_info'); ?>
                        </div>
                        <div class="col-12 col-md-4">
                            <?php include viewPath('v2/pages/customer/advance_customer_forms/front_view/preview_billing_info'); ?>
                        </div>
                        <div class="col-12 col-md-4">
                            <?php include viewPath('v2/pages/customer/advance_customer_forms/front_view/preview_payment_details'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer_pages'); ?>