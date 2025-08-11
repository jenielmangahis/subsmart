<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=Nunito-sans" rel="stylesheet">
    <style>
        /* Base */

        body,
        body *:not(html):not(style):not(br):not(tr):not(code) {
            box-sizing: border-box;
            font-family: 'Nunito Sans', sans-serif !important;
            position: relative;
        }

        body {
            -webkit-text-size-adjust: none;
            background-color: #ffffff;
            /* color: #718096; */
            height: 100%;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        p,
        ul,
        ol,
        blockquote {
            line-height: 1.4;
            text-align: left;
        }

        a {
            color: #3869d4;
        }

        a img {
            border: none;
        }

        /* Typography */

        h1 {
            color: #3d4852;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        h3 {
            font-size: 14px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        p {
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
        }

        p.sub {
            font-size: 12px;
        }

        img {
            max-width: 100%;
        }

        /* Layout */

        .wrapper {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            /* background-color: #edf2f7; */
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .content {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        /* Header */

        .header {
            padding: 25px 0;
            text-align: center;
        }

        .header a {
            color: #3d4852;
            font-size: 19px;
            font-weight: bold;
            text-decoration: none;
        }

        /* Logo */

        .logo {
            height: 75px;
            max-height: 75px;
            width: 75px;
        }

        /* Body */

        .body {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            /* background-color: #edf2f7; */
            border-bottom: 1px solid #edf2f7;
            border-top: 1px solid #edf2f7;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .inner-body {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 500px;
            background-color: #ffffff;
            border-color: #e8e5ef;
            border-radius: 2px;
            border-width: 1px;
            box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);
            margin: 0 auto;
            padding: 0;
            width: 500px;
        }

        .inner-body a {
            word-break: break-all;
        }

        /* Subcopy */

        .subcopy {
            border-top: 1px solid #e8e5ef;
            margin-top: 25px;
            padding-top: 25px;
        }

        .subcopy p {
            font-size: 14px;
        }

        /* Footer */

        .footer {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 500px;
            margin: 0 auto;
            padding: 0;
            text-align: center;
            width: 500px;
        }

        .footer p {
            color: #b0adc5;
            font-size: 14px;
            text-align: center;
        }

        .footer a {
            color: #b0adc5;
            text-decoration: underline;
        }

        /* Tables */

        .table table {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            margin: 30px auto;
            width: 100%;
        }

        .table th {
            border-bottom: 1px solid #edeff2;
            margin: 0;
            padding-bottom: 8px;
        }

        .table td {
            color: #74787e;
            font-size: 15px;
            line-height: 18px;
            margin: 0;
            padding: 10px 0;
        }

        .content-cell {
            max-width: 100vw;
            padding: 32px;
        }

        /* Buttons */

        .action {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
            margin: 30px auto;
            padding: 0;
            text-align: center;
            width: 100%;
            float: unset;
        }

        .button {
            -webkit-text-size-adjust: none;
            border-radius: 4px;
            color: #fff;
            display: inline-block;
            overflow: hidden;
            text-decoration: none;
        }

        .button-blue,
        .button-primary {
            background-color: #2d3748;
            border-bottom: 8px solid #2d3748;
            border-left: 18px solid #2d3748;
            border-right: 18px solid #2d3748;
            border-top: 8px solid #2d3748;
        }

        .button-green,
        .button-success {
            background-color: #48bb78;
            border-bottom: 8px solid #48bb78;
            border-left: 18px solid #48bb78;
            border-right: 18px solid #48bb78;
            border-top: 8px solid #48bb78;
        }

        .button-red,
        .button-error {
            background-color: #e53e3e;
            border-bottom: 8px solid #e53e3e;
            border-left: 18px solid #e53e3e;
            border-right: 18px solid #e53e3e;
            border-top: 8px solid #e53e3e;
        }

        /* Panels */

        .panel {
            border-left: #2d3748 solid 4px;
            margin: 21px 0;
        }

        .panel-content {
            background-color: #edf2f7;
            color: #718096;
            padding: 16px;
        }

        .panel-content p {
            color: #718096;
        }

        .panel-item {
            padding: 0;
        }

        .panel-item p:last-of-type {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        /* Utilities */

        .break-all {
            word-break: break-all;
        }


        .button-primary {
            background-color: #6a4a86 !important;
            border: none;
            color: #fff;
            padding: 10px 30px;
            font-size: 16px;
            /* font-weight: bold; */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .button-primary:hover {
            background-color: #6a4a86; /* Darker shade for hover */
            transform: translateY(-2px);
        }

        .button-primary:active {
            background-color: #6a4a86; /* Slightly darker when clicked */
            transform: translateY(1px);
        }

        .button-primary:focus {
            outline: none;
            box-shadow: 0 0 5px #6a4a86;
        }

        @media (max-width: 768px) {
            .responsive-svg {
            height: 150px;
            }
        }
    </style>
</head>
<body>
    
    <div style="width: 100%; text-align: center;">
        <div style="width: 500px; margin: 0 auto; text-align: center;">

            <!-- Greetings -->
            <div style="margin: auto; text-align: center; padding: 20px;">
                <h1 style="text-align: center; font-size: 36px; margin-bottom: 0;">
                    Hello, <span style="color: #6a4a86;"><?= ucwords(strtolower($name)); ?></span>!
                </h1>
            </div>

            <!-- Message Body -->
            <p style="font-size: 16px;">
                You are receiving this email because we received a password reset request for your account.
            </p>
            <div style="text-align: center; margin: 30px 0;">
                <a href="<?= $reset_url; ?>" class="button button-primary" style="color: white !important;">Reset Password</a>
            </div>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>If you're having trouble clicking the 'Reset Password' button, copy and paste the URL below into your web browser:</p>
            <p><a href="<?= $reset_url; ?>"><?= $reset_url; ?></a></p>
            <p>Or feel free to email us at <a href="mailto:support@nsmartrac.com" class="text-rg-green-light">support@nsmartrac.com</a></p>

            <!-- Closing Remarks -->
            <p>
                Regards,<br>
                <a href="https://nsmartrac.com" target="_blank" style="color: #6C70DC; font-weight: 500;">The nSmarTrac Team</a>
            </p>

            <div class="footer" style="border-top: 1px solid #eaeaea; padding-top: 20px; text-align: center; margin-top: 40px; font-size: 14px; color: #999;">
                <p>Copyright &copy; <?= date('Y'); ?> nSmarTrac. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
