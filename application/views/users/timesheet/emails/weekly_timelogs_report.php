<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
            background-color: #e9ecef;
            border-radius: .3rem;
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
            padding-right: 15px;
            padding-left: 15px;
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
    </style>
</head>

<body>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1><?= $company_name ?> Timesheet Logs</h1>
                <p class="lead text-muted">Click button below to download your employees attendance logs for week <?= $from ?>.</p>
                <p>
                    <a href="<?= $file_link ?>" class="btn btn-primary my-2">Download Timesheet logs</a>
                </p>
            </div>
        </section>

    </main>
</body>

</html>