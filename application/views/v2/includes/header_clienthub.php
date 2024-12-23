<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="nSmarTrac Website">
    <title>nSmarTrac</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/accounting/accounting-modal-forms.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/esign-main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/media.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/general-style.css'); ?>">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/boxicons.min.css'); ?>">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/bootstrap.min.css'); ?>" crossorigin="anonymous">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo base_url('assets/css/v2/google-font.css'); ?>" rel="stylesheet">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/sweetalert2.min.css'); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/dist/css/select2.min.css'); ?>" />
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/bootstrap-datepicker.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-tagsinput.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/bootstrap-datetimepicker.min.css'); ?>">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="<?php echo $url->assets; ?>plugins/morris.js/morris.css">
    <link rel="stylesheet"
        href="<?php echo $url->assets; ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <?php if (isset($enable_tracklocation)) { ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/timesheet/tracklocation.css'); ?>">
    <?php } ?>

    <!-- Multi select -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/multiple-select.min.css'); ?>">

    <!-- Full Calendar -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/full-calendar-main.css'); ?>">

    <!-- Fancybox -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/fancybox.css'); ?>" />

    <!-- Jquery JS -->
    <script src="<?php echo base_url('assets/js/v2/jquery-3.6.0.min.js'); ?>"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- taxes page -->
    <link href="<?php echo $url->assets; ?>dashboard/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets; ?>dashboard/css/slick.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets; ?>dashboard/css/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- taxes page -->

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.css">

    <script>
        var base_url = '<?php echo base_url(); ?>';
        var baseURL = '<?php echo base_url(); ?>';
    </script>    

</head>

<body>
    <div class="nsm-container">
        <div class="nsm-sidebar-bg general-transition"></div>
        <div class="nsm-main general-transition">
            <div class="nsm-nav">
                <!-- <div class="nsm-nav-menu">
                    <a href="javascript:void(0);" class="sidebar-toggler">
                        <i class='bx bx-fw bx-menu-alt-left'></i>
                    </a>
                </div> -->
                <div class="nsm-page-title">
                    <h4><?php echo $page->title; ?></h4>
                </div>
            </div>
            <div class="nsm-content-container">
                <div class="nsm-content">

<script>   
    $(document).ready(function() {
        
    });
</script>