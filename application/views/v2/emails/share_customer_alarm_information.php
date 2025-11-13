<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alarm Information</title>
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
        .tbl-header {
            background-color: #6a4a86;
            padding: 8px;
            text-align: center;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 13px;
            text-align: left;
            
        }
        .detail-row { margin-bottom: 10px; }
    </style>
</head>
<body>
    
    <div style="width: 100%; text-align: center;">
        <div style="width: 80%; margin: 0 auto; text-align: center;">
            <div class="content" style="margin-top:20px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td align="center">
                                <table role="presentation" class="container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <!-- Header -->
                                    <tr>
                                        <td class="tbl-header">
                                           <?= $customer->first_name . ' ' . $customer->last_name; ?> : Alarm Details 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br /></td>
                                    </tr>
                                    <!-- Content -->
                                    <tr>
                                        <td class="content">
                                            <div class="detail-row">
                                                <span class="detail-label">Dealer Number:</span> <?= $alarm_info && $alarm_info->dealer_number != '' ? $alarm_info->dealer_number : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Monitoring Company:</span> <?= $alarm_info && $alarm_info->monitor_comp != '' ? $alarm_info->monitor_comp : '---'; ?>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Contract Status:</span> <?= $alarm_info && $alarm_info->contract_status != '' ? $alarm_info->contract_status : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Monitoring ID:</span> <?= $alarm_info && $alarm_info->monitor_id != '' ? $alarm_info->monitor_id : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Account Type:</span> <?= $alarm_info && $alarm_info->acct_type != '' ? $alarm_info->acct_type : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Site Type:</span> <?= $alarm_info && $alarm_info->site_type != '' ? $alarm_info->site_type : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Online:</span> <?= $alarm_info && $alarm_info->online != '' ? $alarm_info->online : 'No'; ?>    
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">In Service:</span> <?= $alarm_info && $alarm_info->in_service != '' ? $alarm_info->in_service : '---'; ?>     
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Abort Code / Password:</span> <?= $alarm_info && $alarm_info->passcode != '' ? $alarm_info->passcode : '---'; ?>     
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Installer Code:</span> <?= $alarm_info && $alarm_info->installer_code != '' ? $alarm_info->installer_code : '---'; ?>     
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Master Code:</span> <?= $alarm_info && $alarm_info->master_code != '' ? $alarm_info->master_code : '---'; ?>        
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content"><hr /></td>
                                    </tr>
                                    <tr>
                                        <td class="content">
                                            <div class="detail-row">
                                                <span class="detail-label">Equipment:</span> <?= $profile_info->equipment != '' ? $profile_info->equipment : '---'; ?>
                                            </div>   
                                            <div class="detail-row">
                                                <span class="detail-label">Install Type:</span> <?= $alarm_info && $alarm_info->install_type != '' ? $alarm_info->install_type : '---'; ?>        
                                            </div>  
                                            <div class="detail-row">
                                                <span class="detail-label">Panel Type:</span> <?= $alarm_info && $alarm_info->panel_type != '' ? $alarm_info->panel_type : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Warranty Type:</span> <?= $alarm_info && $alarm_info->warranty_type != '' ? $alarm_info->warranty_type : '---'; ?>     
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Secondary System Type:</span> <?= $alarm_info && $alarm_info->secondary_system_type != '' ? $alarm_info->secondary_system_type : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Radio Serial Number:</span> <?= $alarm_info && $alarm_info->radio_serial_number != '' ? $alarm_info->radio_serial_number : '---'; ?>       
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Panel Location:</span> <?= $alarm_info && $alarm_info->panel_location != '' ? $alarm_info->panel_location : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Transformer Location:</span> <?= $alarm_info && $alarm_info->transformer_location != '' ? $alarm_info->transformer_location : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Connection Type:</span> <?= $alarm_info && $alarm_info->connection_type != '' ? $alarm_info->connection_type : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">CSID Number:</span> <?= $alarm_info && $alarm_info->csid_number != '' ? $alarm_info->csid_number : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Report Format:</span> <?= $alarm_info && $alarm_info->report_format != '' ? $alarm_info->report_format : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Receiver Phone Number:</span> <?= $alarm_info && $alarm_info->receiver_phone_number != '' ? $alarm_info->receiver_phone_number : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Panel Phone Number:</span> <?= $alarm_info && $alarm_info->panel_phone_number != '' ? $alarm_info->panel_phone_number : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">DSL Voip:</span> <?= $alarm_info && $alarm_info->dsl_voip != '' ? $alarm_info->dsl_voip : '---'; ?>        
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content"><hr /></td>
                                    </tr>
                                    <tr>
                                        <td class="content">
                                            <div class="detail-row">
                                                <span class="detail-label">Service Provider:</span> <?= $alarm_info && $alarm_info->install_type != '' ? $alarm_info->install_type : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Service Package:</span> <?= $alarm_info && $alarm_info->comm_type != '' ? $alarm_info->comm_type : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Add-on Feature Cost:</span> <?= $alarm_info && $alarm_info->addon_feature_cost != '' ? $alarm_info->addon_feature_cost : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Account Cost:</span> <?= $alarm_info && $alarm_info->account_cost != '' ? $alarm_info->account_cost : '0.00'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Pass Thru Cost:</span> <?= $alarm_info && $alarm_info->pass_thru_cost != '' ? $alarm_info->pass_thru_cost : '0.00'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Program and Setup:</span> <?= $alarm_info && $alarm_info->otps != '' ? $alarm_info->otps : '0.00'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Equipment Cost:</span> <?= $alarm_info && $alarm_info->equipment_cost != '' ? $alarm_info->equipment_cost : '0.00'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Gross Monitoring Rate:</span> <?= $alarm_info && $alarm_info->monthly_monitoring != '' ? $alarm_info->monthly_monitoring : '0.00'; ?>   
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content"><hr /></td>
                                    </tr>
                                    <tr>
                                        <td class="content">
                                            <div class="detail-row">
                                                <span class="detail-label">Dealer:</span> <?= $alarm_info && $alarm_info->dealer != '' ? $alarm_info->dealer : '---'; ?>   
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Customer ID:</span> <?= $alarm_info && $alarm_info->alarm_customer_id != '' ? $alarm_info->alarm_customer_id : '---'; ?>        
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Login:</span> <?= $alarm_info && $alarm_info->alarm_login != '' ? $alarm_info->alarm_login : '---'; ?>       
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <br /><br />
                    <p>If you have any questions, feel free to email us at <a href="mailto:websupport@nsmartrac.com" class="text-rg-green-light">websupport@nsmartrac.com</a></p>
                    <p>
                        Regards,<br>
                        <a href="https://nsmartrac.com" target="_blank" style="color: #6C70DC; font-weight: 500;">The nSmarTrac Team</a>
                    </p>
            </div>            

            <div class="footer" style="border-top: 1px solid #eaeaea; padding-top: 20px; text-align: center; margin-top: 40px; font-size: 14px; color: #999;">
                <p>Copyright &copy; <?= date('Y'); ?> nSmarTrac. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
