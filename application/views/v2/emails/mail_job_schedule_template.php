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

        .tbl-header {
            background-color:#6a4a86;
        }
        .tbl-sub-header {
            background-color:#6a4a86;
        }        
    </style>
</head>
<body>
    <div style="width: 100%; text-align: center;">
        <div class="content">
            <table style="width: 80% !important; margin: 0 auto;">
                <tr>
                    <td>
                        <?php 
                            $company_logo = FCPATH . 'uploads/users/business_profile/' . $company->id . '/' . $company->business_image;                       
                        ?>
                        <?php if( file_exists($company_logo) ) {?>
                            <?php $company_logo = base_url('uploads/users/business_profile/' . $company->id . '/' . $company->business_image); ?>
                            <!-- <image src="<?php echo $company_logo; ?>" style="width:206px;margin-bottom:28px;" /> -->
                        <?php } else { ?>
                            <!-- <image src="https://nsmartrac.com/assets/frontend/images/logo.png" style="width:206px;margin-bottom:28px;" /> -->
                        <?php } ?>

                        <?php $default_company_logo = companyInvoiceLogo($jobs_data->company_id); ?>
                        <image src="<?php echo $default_company_logo; ?>" style="height:110px;margin-bottom:28px;" />
                        
                        <?php if($user_type = 'customer') { ?>
                            <p>Hi <?= $jobs_data->first_name .' '. $jobs_data->last_name; ?>, <br /><br />A job order number <?= $jobs_data->job_number; ?> has been created. Below are the details: </p>
                        <?php } elseif($user_type = 'sales_rep') { ?>
                            <p>Hi <?php echo userFullName($jobs_data->employee_id); ?>, <br /><br />You have been assigned to job number <?= $jobs_data->job_number; ?>. Below are the details: </p>
                        <?php } ?>                            
                    </td>
                </tr>
            </table>
            
            <table style="width: 80% !important; margin: 0 auto;">
                <tr class="tbl-header">
                    <td colspan="2"><div style="font-size: 18px; color: white;">CUSTOMER</div></td>
                </tr>
                <tr>
                    <td>
                        <b>Name</b><br />
                        <?= $jobs_data->first_name .' '. $jobs_data->last_name; ?>
                    </td>
                    <td>
                        <b>Address</b><br />
                        <?= $jobs_data->job_location; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Phone Number</b><br />
                        <?= $jobs_data->phone_m !="" || $jobs_data->phone_m !=null ? formatPhoneNumber($jobs_data->phone_m) : 'N/A'; ?>
                    </td>
                    <td>
                        <b>Email</b><br />
                        <?= $jobs_data->cust_email != "" ? $jobs_data->cust_email : "N/A"; ?>
                    </td>
                </tr>
            </table><br />  

            <div class="clear"></div>

            <table style="width: 80% !important; margin: 0 auto;">
                <tr class="tbl-header">
                    <td colspan="3"><div style="font-size: 18px; color: white;">JOB INFORMATION</div></td>
                </tr>
                <tr>
                    <td>
                        <b>JOB NUMBER</b><br />
                        <?= $jobs_data->job_number; ?><br />
                    </td>
                    <td>
                        <b>JOB TAGS</b><br />
                        <?= $jobs_data->tags != '' ? $jobs_data->tags : '---';  ?><br />
                    </td>
                    <td>
                        <b>JOB TYPE</b><br />
                        <?= $jobs_data->job_type != '' ? $jobs_data->job_type : '---';  ?><br />
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>JOB LOCATION</b><br />
                        <?= $jobs_data->job_location != '' ? $jobs_data->job_location : '---'; ?><br />
                    </td>
                    <td>
                        <b>AMOUNT</b><br />
                        <?= number_format($job_total_amount,2,'.',','); ?><br />
                    </td>
                    <td>
                        <b>ASSIGNED USERS</b><br />
                        <?php 
                            $assigned_employees = array();
                            if( $jobs_data->employee2_id > 0 ){
                                $assigned_employees[] = $jobs_data->employee2_id;
                            }
                            if( $jobs_data->employee3_id > 0 ){
                                $assigned_employees[] = $jobs_data->employee3_id;
                            }
                            if( $jobs_data->employee4_id > 0 ){
                                $assigned_employees[] = $jobs_data->employee4_id;
                            }
                            if( $jobs_data->employee5_id > 0 ){
                                $assigned_employees[] = $jobs_data->employee5_id;
                            }
                            if( $jobs_data->employee6_id > 0 ){
                                $assigned_employees[] = $jobs_data->employee6_id;
                            }
                        ?>
                        <div class="techs">
                            <?php foreach($assigned_employees as $eid){ ?>
                                <?php echo userFullName($eid); ?><br />
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-top: 20px;"><hr /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Subtotal:</td>
                    <td>$<?php echo number_format($job_sub_total_amount,2); ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Tax Rate:</td>
                    <td>$<?php echo number_format($jobs_data->tax_rate,2); ?></td>
                </tr>
                <?php if( $industrySpecificFields && array_key_exists('installation_cost', $industrySpecificFields) ){ ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>Installation Cost:</td>
                    <td>$<?php echo number_format($jobs_data->installation_cost,2); ?></td>
                </tr>
                <?php } ?>
                <?php if( $industrySpecificFields && array_key_exists('otps', $industrySpecificFields) ){ ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>One time (Program and Setup):</td>
                    <td>$<?php echo number_format($jobs_data->program_setup,2); ?></td>
                </tr>
                <?php } ?>
                <?php if( $industrySpecificFields && array_key_exists('monthly_monitoring_rate', $industrySpecificFields) ){ ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>Monthly Monitoring:</td>
                    <td>$<?php echo number_format($jobs_data->monthly_monitoring,2); ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><b>Total:</b></td>
                    <td>$<?php echo number_format($job_total_amount,2); ?></td>
                </tr>
            </table>
        </div>      
        
        <div class="content" style="width: 80% !important; margin: 0 auto !important;">
            <br /><br />
            <p>If you have any questions, feel free to email us at <a href="mailto:support@nsmartrac.com" class="text-rg-green-light">support@nsmartrac.com</a></p>
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
