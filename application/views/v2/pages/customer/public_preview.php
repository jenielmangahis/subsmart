
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/accounting/accounting-modal-forms.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/main.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/esign-main.css") ?>">
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
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/sweetalert2.min.css") ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url("assets/plugins/select2/dist/css/select2.min.css") ?>" />
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap-datepicker.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap-tagsinput.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap-datetimepicker.min.css") ?>">

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
            
                <div class="row g-3 mb-3">
                   
                    <div class="col-12 col-md-12">

                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_customer_info'); ?>
                    </div>
                    <div class="col-12 col-md-4">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_office_info'); ?>
                    </div>
                    <div class="col-12 col-md-4">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_alarm_info'); ?>
                    </div>
                    <div class="col-12">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_notes_info'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url('assets/js/customer/components/FieldCustomName.js');?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#copyLink").on("click", function(){
            var copyText = document.getElementById("sharableLink");
            copyText.select();
            document.execCommand("copy");
        });

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>