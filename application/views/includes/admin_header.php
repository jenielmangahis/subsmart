<?php
if ($this->session->userdata('usertimezone') == null) {
    $_SESSION['usertimezone'] = json_decode(get_cookie('logged'))->usertimezone;
    $_SESSION['offset_zone'] = json_decode(get_cookie('logged'))->offset_zone;
    if ($this->session->userdata('usertimezone') == null) {
        $_SESSION['usertimezone'] = "UTC";
        $_SESSION['offset_zone'] = "GMT";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Home</title>
    <meta content="Admin Dashboard" name="description">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet"
        href="<?php echo $url; ?>plugins/font-awesome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="<?php echo $url->assets ?>fa-5/css/all.min.css">
    -->
    <!--Morris Chart CSS -->
    <link rel="stylesheet"
        href="<?php echo $url; ?>plugins/morris.js/morris.css">
    <link
        href="<?php echo $url; ?>dashboard/css/bootstrap.min.css"
        rel="stylesheet" type="text/css">

    <link href="<?php echo $url; ?>dashboard/css/style.css"
        rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />-->
    <link rel="stylesheet"
        href="<?php echo $url; ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet"
        href="<?php echo $url; ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="<?php echo $url; ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet"
        href="<?php echo $url; ?>css/jquery.signaturepad.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <!--<script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
    <!-- <link href="<?php echo $url->assets ?>libs/jcanvas/global.css"
    rel="stylesheet"> -->

    <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
    <link
        href="<?php echo $url; ?>css/jquery.dataTables.min.css"
        rel="stylesheet" type="text/css">

    <script src="<?php echo $url; ?>push_notification/push.js"></script>
    <script
        src="<?php echo $url; ?>push_notification/serviceWorker.min.js">
    </script>


    <!-- taxes page -->
    <link
        href="<?php echo $url; ?>dashboard/css/responsive.css"
        rel="stylesheet" type="text/css">
    <link
        href="<?php echo $url; ?>dashboard/css/slick.min.css"
        rel="stylesheet" type="text/css">
    <link
        href="<?php echo $url; ?>dashboard/css/slick-theme.min.css"
        rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- taxes page -->
    <!--    Clock CSS-->
    <link href="<?php echo $url; ?>css/timesheet/clock.css"
        rel="stylesheet" type="text/css">
    <link
        href="<?php echo $url; ?>css/notification/notification.css"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons" type="text/css">
    <!--    ICONS CSS-->
    <link href="<?php echo $url; ?>css/icons/icon.navbar.css"
        rel="stylesheet" type="text/css">


    <script src="<?php echo $url; ?>dashboard/js/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <?php
    if ($this->uri->segment(2) != "tracklocation" && $this->uri->segment(1) != "trac360") {
        echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU" async></script>';
    }
    ?>

    <!-- dynamic assets goes  -->
    <?php echo put_header_assets(); ?>
    <style type="text/css">
        #signature {
            width: 100%;
            height: 200px;
            border: 1px solid black;
        }

        div#notificationList {
            height: auto !important;
        }

        button.swal2-close {
            display: block !important;
        }

        #topnav {
            font-family: "Ubuntu", "Trebuchet MS", sans-serif !important;
        }

        #division {
            padding: 20px !important;
            margin-right: 2%;
            border: solid black 2px;
        }

        .progress-bar-success {
            background-color: #5cb85c;
        }

        .clock {
            background: url("<?= base_url() ?>/assets/img/timesheet/clock-face-digital-clock-alarm-clocks-clock-png-clip-art.png");
            background-size: cover;
        }

        .progress-bar-info {
            background-color: rgb(0, 166, 164);
        }

        .modaldivision {
            padding: 10px;
            border: solid gray 2px;
            border-radius: 15px;
        }

        .card-pricing.popular {
            z-index: 1;
            border: 3px solid #007bff;
        }

        .card-pricing .list-unstyled li {
            padding: .5rem 0;
            color: #6c757d;
        }

        .file-upload {
            background-color: #ffffff;
            width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .file-upload-btn {
            /* width: 100%; */
            margin: 0;
            color: #000;
            background: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #15824B;
            transition: all .2s ease;
            outline: none;
            /* text-transform: uppercase; */
            font-weight: 10;
            text-align: left;

        }

        .file-upload-btn:hover {
            background: #1AA059;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #EAF3EE;
            position: relative;
            padding: 20px;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #EAF3EE;
            border: 4px dashed #ffffff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            color: #15824B;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 200px;
            max-width: 200px;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 200px;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

        label {
            display: inline-block
        }

        label>input {
            /* HIDE RADIO */
            visibility: hidden;
            /* Makes input not-clickable */
            position: absolute;
            /* Remove input from document flow */
        }

        label>input+img {
            /* IMAGE STYLES */
            cursor: pointer;
            border: 2px solid transparent;
        }

        label>input:checked+img {
            /* (RADIO CHECKED) IMAGE STYLES */
            border: 2px solid #f00;
        }
    </style>
</head>
<script>
    var baseURL = '<?= base_url() ?>';
</script>


<body style="background:white !important;">
    <!-- Navigation Bar-->
    <header id="topnav">
        <input type="hidden" id="siteurl"
            value="<?php echo url(); ?>"> <!-- for js programing -->
        <div
            style="background:white; box-shadow: 5px 0px 10px 4px rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12); padding: 7px 0;">
            <div class="container-fluid">
                <div class="row">
                    <!-- Logo container-->
                    <div class="logo col-lg-3"><a style="position:absolute; top:25%; margin-top:-20px; left:5%;"
                            href="<?php echo url('dashboard'); ?>">
                            <img width="200"
                                src="<?php echo $url->assets ?>dashboard/images/logo.png"
                                alt=""> </a>
                    </div><!-- End Logo container-->
                    <!-- MENU Start -->
                    <div class="col-lg-6">
                        <?php include viewPath('includes/nav'); ?>
                    </div>
                    <div class="menu-extras topbar-custom col-lg-3 justify-content-end">
                        <ul class="navbar-right list-inline float-right mb-0"
                            style="position:absolute; top:25%; margin-top:-10px; right:10px;left:0%;">
                            <li class="menu-item list-inline-item">
                                <a class="navbar-toggle nav-link">
                                    <div class="lines"><span></span> <span></span> <span></span></div>
                                </a>
                            </li>
                            <li class="menu-item list-inline-item d-inline-flex d-lg-none" style="color:#fff;"><img
                                    class="icon-logo-nav" width="100" height="25"
                                    style="height: 25px !important;width: 100px !important;"
                                    src="<?php echo $url->assets ?>dashboard/images/logo.png"
                                    alt=""> </a></li>

                <li title="Activity" class="dropdown notification-list list-inline-item ml-auto"
                    style="vertical-align: middle">
                    <div class="growth-icon-container dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <a href="javascript:void (0)">
                            <img class="growth-icon-static"
                                src="<?php echo $url->assets; ?>/css/icons/activity.svg"
                                alt="">
                            <img class="growth-icon-hover"
                                src="<?php echo $url->assets; ?>/css/icons/activity.svg"
                                alt="">
                        </a>
                    </div>
                </li>
                <li title="Settings" class="dropdown notification-list list-inline-item ml-auto"
                    style="vertical-align: middle">
                    <div class="settings-icon-container">
                        <a
                            href="<?php echo base_url('settings/email_templates') ?>">
                            <img class="settings-icon-static"
                                src="<?php echo $url->assets; ?>/css/icons/settings.svg"
                                alt="">
                            <img class="settings-icon-hover"
                                src="<?php echo $url->assets; ?>/css/icons/settings.svg"
                                alt="">
                        </a>
                    </div>
                </li>
                </ul>
            </div><!-- end menu-extras -->
            <div class="clearfix"></div>
        </div><!-- end container -->
        </div><!-- end container -->
        </div><!-- end topbar-main -->

    </header><!-- End Navigation Bar-->

    