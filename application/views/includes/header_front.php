<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Home</title>
    <meta content="Admin Dashboard" name="description">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="<?php echo $url->assets?>plugins/font-awesome/css/font-awesome.min.css">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/morris.js/morris.css">

    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>css/jquery.signaturepad.css" >
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <link href="<?php echo $url->assets ?>libs/jcanvas/global.css" rel="stylesheet"> -->
    

    <!-- taxes page -->
    <link href="<?php echo $url->assets ?>dashboard/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/slick.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- taxes page -->
    <!--    Clock CSS-->
    <link href="<?php echo $url->assets ?>css/timesheet/clock.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>css/notification/notification.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons" type="text/css">
    <!--    ICONS CSS-->
    <link href="<?php echo $url->assets ?>css/icons/icon.navbar.css" rel="stylesheet" type="text/css">
    <!-- dynamic assets goes  -->
    <?php echo put_header_assets(); ?>
    <style type="text/css">
        #signature{
            width: 100%;
            height: 200px;
            border: 1px solid black;
        }
        #topnav {
            font-family: "Ubuntu","Trebuchet MS",sans-serif !important;
        }
        
        #division{
            padding:20px !important;
            margin-right:2%;
            border: solid black 2px;
        }
        .progress-bar-success{
            background-color: #5cb85c;
        }
        .progress-bar-info{
            background-color: rgb(0, 166, 164);
        }
        .modaldivision{
            padding:10px;
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
        color: #00;
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
        padding:20px;
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
        label { display: inline-block }
        label > input { /* HIDE RADIO */
        visibility: hidden; /* Makes input not-clickable */
        position: absolute; /* Remove input from document flow */
        }
        label > input + img { /* IMAGE STYLES */
        cursor:pointer;
        border:2px solid transparent;
        }
        label > input:checked + img { /* (RADIO CHECKED) IMAGE STYLES */
        border:2px solid #f00;
        }
    </style>
</head>
<body>
