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
    <style>
        article,
        aside,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
            display: block;
        }

        .text-center {
            text-align: center !important;
        }

        .jumbotron {
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            background-color: #fff;
            border-radius: .3rem;
        }

        .jumbotron .data-section {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 10px;
        }

        article,
        aside,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        nav,
        section {
            display: block;
        }

        @media (min-width: 576px) {
            .jumbotron {
                padding: 4rem 2rem;
            }

            .nsmartrac-address {
                font-size: 10px !important;
            }
        }

        @media (min-width: 1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 1140px;
            }
        }

        @media (min-width: 992px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm {
                max-width: 960px;
            }
        }

        @media (min-width: 768px) {

            .container,
            .container-md,
            .container-sm {
                max-width: 720px;
            }
        }

        @media (min-width: 576px) {

            .container,
            .container-sm {
                max-width: 540px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        .container {
            width: 100%;
            padding-right: 0px;
            padding-left: 0px;
            margin-right: auto;
            margin-left: auto;
        }

        .h1,
        h1 {
            font-size: 2.5rem;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem;
        }

        .text-muted {
            color: #6c757d !important;
            font-size: 13px !important;
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 300;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .mb-2,
        .my-2 {
            margin-bottom: .5rem !important;
        }

        .mt-2,
        .my-2 {
            margin-top: .5rem !important;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-success {
            color: #fff !important;
            background-color: #28a745;
            border-color: #28a745;
        }

        .table {
            width: 100%;
        }

        .download-sales-receipt,
        .download-packaging-slip {
            background-color: #2CA01C;
            color: #fff;
            border: solid 2px #2CA01C;
            padding: 5px 15px;
            height: auto;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 100;
            text-transform: uppercase;
        }

        .download-buttons {
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">

                <?php
                if ($has_logo) {
                    ?>
                <p style="text-align: left;"><img width="100" src="cid:company_logo" alt="" style="width:100px;"></p>
                <?php
                } else {
                    ?>
                <h4 style="text-align:left;"><?=$company_name?>
                </h4>
                <?php
                }
                ?>
                <h2 style="text-align:left;">Sales Receipt #<?=$sales_receipt_id?>
                </h2>
                <!-- <h4 style="text-align:left;"><?=$subject?> -->
                </h4>
                <div class="data-section">
                    <p class="lead text-muted" style="text-align: left; margin-top:20px;"><label
                            style="padding-bottom: 10px;white-space: pre-wrap;"><?=$email_body?>
                    </p>



                    <!-- <p style="margin-top:20px;">
                        <a href="<?= base_url('/dashboard')?>"
                    class="btn btn-success my-2">VISIT MY ACCOUNT</a>
                    </p>
                    <p class="lead text-muted" style="text-align: left; margin-top:20px;">
                        <label style="padding-bottom: 5px;"> nSmarTrac Team<br>You are receiving this
                            email because you signed up for nSmarTrac.

                    </p> -->
                    <div class="download-buttons">
                        <a href="<?=$sales_receipt_file_name?>"
                            class="download-sales-receipt"
                            style="color: #fff;font-size: 15px;font-weight: 100;">Download Sales Receipt</a>
                        <a href="<?=$packaging_slip_file_name?>"
                            class="download-packaging-slip"
                            style="color: #fff;font-size: 15px;font-weight: 100;">Download Packing Slip</a>
                    </div>

                    <p class="lead text-muted nsmartrac-address"
                        style="text-align:left;font-size: 10px!important;color: #6C757D!important;">
                        6866 Pine Forest Road Suite C &#8226; Pensacola, Florida 32526
                    </p>
                    <p style="text-align: left; margin-top:20px;"><img width="100" src="cid:logo_2u" alt=""
                            style="width:100px;"></p>
                </div>
            </div>
        </section>
    </main>
</body>

</html>