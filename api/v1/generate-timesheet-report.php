<?php
include_once("includes.php");

// $_GET variables
$type       = $_GET['type'];
$company_id = $_GET['company_id'];
$user_id    = $_GET['user_id'];
$start_date = $_GET['start_date'];
$end_date   = $_GET['end_date'];


// create date
$startDate = date_create($start_date);
$endDate = date_create($end_date);

// format date
$formattedStartDate = date_format($startDate, "M j");
$formattedEndDate = date_format($endDate, "M j");

// explode
$startMonthDay = explode(" ", $formattedStartDate);
$endMonthDay = explode(" ", $formattedEndDate);

// get proper date range
$date = $formattedStartDate . " - " . $formattedEndDate;
// check
if ($startMonthDay[0] == $endMonthDay[0]) {
    $date = $formattedStartDate . " - " . $endMonthDay[1];
}

// get week
$myDate = new DateTime($start_date);
$week = $myDate->format("W");


// check type
if ($type == 'pdf') {
    //*********** GENERATE PDF REPORT **********//
    require_once '/home4/admintommy/public_html/vendor/autoload.php'; //__DIR__ . '/vendor/autoload.php';

    // init db handler
    $db = new database_handler();

    // check
    if (isset($company_id) == true) {
        // get company_name
        $row = $db->fetchRow("select * from business_profile where id = $company_id");
        $company_name = $row['business_name'];
    } else {
        // get user name
        $row = $db->fetchRow("select *, concat(FName, ' ', LName) as full_name from users where id = $user_id");
        $company_name = $row['full_name'];
    }


    // check
    if (isset($user_id) == true) {
        // get user
        $rows = $db->fetchAll("select * from timesheet_team_members where user_id = $user_id and status = 1");
    } else {
        // get all team members
        $rows = $db->fetchAll("select * from timesheet_team_members where company_id = $company_id and status = 1");
    }

    // init vars
    $total_hours = 0.0;
    $total_break = 0.0;
    $total_overtime = 0.0;
    $total_pto = 0.0;

    // iterate rows
    foreach ($rows as $row) {
        // get user_id
        $user_id = $row['user_id'];

        // get attendance between dates
        $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created between CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");

        // iterate rows
        foreach ($attendance as $item) {
            // get id
            $attendance_id = $item['id'];

            $total_hours += doubleval($item['shift_duration']);
            $total_break += doubleval($item['break_duration']);
            $total_overtime += doubleval($item['overtime']);
        }

        // get leave
        $leave = $db->fetchAll("select tl.*, tld.date, tp.name from timesheet_leave tl, timesheet_leave_date tld, timesheet_pto tp where tl.user_id = $user_id and tp.id = tl.pto_id and tl.id = tld.leave_id and tld.date between CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");
        // iterate rows
        foreach ($leave as $item) {
            // get total hours
            $total_pto += doubleval($item['total_hours']);
        }
    }

    // get formatted time
    $regularHours   = formatDecimalTime($total_hours);
    $overtimeHours  = formatDecimalTime($total_overtime);
    $breakHours     = formatDecimalTime($total_break);
    $ptoHours       = formatDecimalTime($total_pto);

    // create the html code
    $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <style type="text/css">
                        #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
                        body{width:100% !important; margin:0; font-family: roboto;}
                        body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */
                        body{margin:0; padding:0;}
                        img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
                        table td{border-collapse:collapse;}
                        #backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}
                        body, #backgroundTable{ background-color:#FFF; }
                        .TopbarLogo {
                            padding:10px;
                            text-align:left;
                            vertical-align:middle;
                        }
                        h1, .h1 {
                            color:#000;
                            display:block;
                            font-family:roboto;
                            font-size:35px;
                            font-weight: bold;
                            line-height:100%;
                            margin-top:2%;
                            margin-right:0;
                            margin-bottom:1%;
                            margin-left:0;
                            text-align:left;
                        }
                        h2, .h2 {
                            color:#000;
                            display:block;
                            font-family:roboto;
                            font-size:30px;
                            font-weight: bold;
                            line-height:100%;
                            margin-top:2%;
                            margin-right:0;
                            margin-bottom:1%;
                            margin-left:0;
                            text-align:left;
                        }
                        h3, .h3 {
                            color:#000;
                            display:block;
                            font-family:roboto;
                            font-size:24px;
                            font-weight:bold;
                            margin-top:2%;
                            margin-right:0;
                            margin-bottom:1%;
                            margin-left:0;
                            text-align:left;
                        }
                        h4, .h4 {
                            color:#000;
                            display:block;
                            font-family:roboto;
                            font-size:18px;
                            font-weight:bold;
                            line-height:100%;
                            margin-top:2%;
                            margin-right:0;
                            margin-bottom:1%;
                            margin-left:0;
                            text-align:left;
                        }
                        h5, .h5 {
                            color:#000;
                            display:block;
                            font-family:roboto;
                            font-size:14px;
                            font-weight:bold;
                            line-height:100%;
                            margin-top:2%;
                            margin-right:0;
                            margin-bottom:30%;
                            margin-left:0;
                            text-align:left;
                        }
                        .textdark {
                            color: #444444;
                            font-family: roboto;
                            font-size: 12px;
                            line-height: 150%;
                            text-align: left;
                        }
                        .textwhite {
                            color: #fff;
                            font-family: roboto;
                            font-size: 12px;
                            line-height: 150%;
                            text-align: left;
                        }
                        .fontwhite { color:#fff; }
                        .medium {
                            font-size: 16px;
                            font-weight: 400;
                        }
                        .small {
                            color: #444;
                            font-family: roboto;
                            font-size: 9px;
                            margin-bottom:30%;
                        }
                        p {
                            font-family: roboto;
                            font-size: 12px;
                        }
                        .border { border: 0.3px solid #ccc; }
                    </style>
                </head>
                <body style="width:100% !important; margin:0; -webkit-text-size-adjust:none;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#ffffff; height:64px;">
                        <tr>
                            <td align="left" valign="middle" width="50%">
                                <h3>Timesheet Report</h3>
                            </td>
                            <td align="right" valign="middle">
                                <h3>'.$date.' • '.$company_name.'</h3>
                            </td>
                        </tr>
					</table><br>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="left">
                                <h5>Overview</h5>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="10" cellspacing="0" width="100%" class="border">
                        <tr>
                            <td align="left" class="border">
                                <p class="small">TOTAL HOURS</p>
                                <p class="medium">'.$regularHours.'</p>
                            </td>
                            <td align="left" class="border">
                                <p class="small">REGULAR</p>
                                <p class="medium">'.$regularHours.'</p>
                            </td>
                            <td align="left" class="border">
                                <p class="small">OVERTIME</p>
                                <p class="medium">'.$overtimeHours.'</p>
                            </td>
                            <td align="left" class="border">
                                <p class="small">BREAK</p>
                                <p class="medium">'.$breakHours.'</p>
                            </td>
                            <td align="left" class="border">
                                <p class="small">PTO</p>
                                <p class="medium">'.$ptoHours.'</p>
                            </td>
                        </tr>
                    </table><br>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="left">
                                <h5>Job Codes</h5>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="10" cellspacing="0" width="50%" class="border">
                        <tr>
                            <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                <p class="small">JOB CODE</p>
                            </td>
                            <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                <p class="small">HOURS</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <p>No Job Code</p>
                            </td>
                            <td align="left">
                                <p>'.$regularHours.'</p>
                            </td>
                        </tr>
                    </table><br>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="left">
                                <h5>Timesheets</h5>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="10" cellspacing="0" width="100%" class="border">
                        <tr>
                            <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                <p class="small">NAME</p>
                            </td>
                            <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                <p class="small">REGULAR</p>
                            </td>
                            <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                <p class="small">OVERTIME</p>
                            </td>
                            <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                <p class="small">BREAK</p>
                            </td>
                            <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                <p class="small">PTO</p>
                            </td>
                            <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                <p class="small">TOTAL</p>
                            </td>
                        </tr>';
                        // iterate rows
                        foreach ($rows as $row) {
                            // get user_id
                            $user_id = $row['user_id'];

                            // get attendance between dates
                            $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created between CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");

                            // init vars
                            $total_hours = 0.0;
                            $total_break = 0.0;
                            $total_overtime = 0.0;
                            $total_pto = 0.0;

                            // iterate rows
                            foreach ($attendance as $item) {
                                // get id
                                $attendance_id = $item['id'];

                                $total_hours += doubleval($item['shift_duration']);
                                $total_break += doubleval($item['break_duration']);
                                $total_overtime += doubleval($item['overtime']);
                            }

                            // get leave
                            $leave = $db->fetchAll("select tl.*, tld.date, tp.name from timesheet_leave tl, timesheet_leave_date tld, timesheet_pto tp where tl.user_id = $user_id and tp.id = tl.pto_id and tl.id = tld.leave_id and tld.date between CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");
                            // iterate rows
                            foreach ($leave as $item) {
                                // get total hours
                                $total_pto += doubleval($item['total_hours']);
                            }

                            // get formatted time
                            $totalHours     = formatDecimalTime($total_hours);
                            $totalOvertime  = formatDecimalTime($total_overtime);
                            $totalBreak     = formatDecimalTime($total_break);
                            $totalPTO       = formatDecimalTime($total_pto);


                            // append
                            $html .= '<tr>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p><b>'.$row['name'].'</b></p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p>'.$totalHours.'</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p>'.$totalOvertime.'</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p>'.$totalBreak.'</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p>'.$totalPTO.'</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p>'.$totalHours.'</p>
                                </td>
                            </tr>';
                        }

                    $html .= '</table>
                </body>
            </html>';


    $footer = '<p class="small">'.strtoupper($date).' • '.strtoupper($company_name).' • PREPARED BY nSmarTrac ON '.date('m.d.Y h:i A').'</p>';

    $mpdf = new mPDF([
        'mode' => 'utf-8',
        'format' => [792, 612],
        'orientation' => 'L',
        'autoPageBreak' => true
    ]);
    $mpdf->WriteHTML($html);
    $mpdf->SetHTMLFooter($footer);



    // iterate rows
    foreach ($rows as $row) {
        // get user_id
        $user_id = $row['user_id'];

        // init vars
        $total_hours = 0.0;
        $total_break = 0.0;
        $total_overtime = 0.0;
        $total_pto = 0.0;

        // get attendance between dates
        $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created between CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");

        // iterate rows
        foreach ($attendance as $item) {
            // get id
            $attendance_id = $item['id'];

            $total_hours += doubleval($item['shift_duration']);
            $total_break += doubleval($item['break_duration']);
            $total_overtime += doubleval($item['overtime']);
        }

        // get leave
        $leave = $db->fetchAll("select tl.*, tld.date, tp.name from timesheet_leave tl, timesheet_leave_date tld, timesheet_pto tp where tl.user_id = $user_id and tp.id = tl.pto_id and tl.id = tld.leave_id and tld.date between CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");
        // iterate rows
        foreach ($leave as $item) {
            // get total hours
            $total_pto += doubleval($item['total_hours']);
        }

        // get formatted time
        $totalHours     = formatDecimalTime($total_hours);
        $totalOvertime  = formatDecimalTime($total_overtime);
        $totalBreak     = formatDecimalTime($total_break);
        $totalPTO       = formatDecimalTime($total_pto);


        // create the html code
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        <style type="text/css">
                            #outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
                            body{width:100% !important; margin:0; font-family: roboto;}
                            body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */
                            body{margin:0; padding:0;}
                            img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
                            table td{border-collapse:collapse;}
                            #backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}
                            body, #backgroundTable{ background-color:#FFF; }
                            .TopbarLogo {
                                padding:10px;
                                text-align:left;
                                vertical-align:middle;
                            }
                            h1, .h1 {
                                color:#000;
                                display:block;
                                font-family:roboto;
                                font-size:35px;
                                font-weight: bold;
                                line-height:100%;
                                margin-top:2%;
                                margin-right:0;
                                margin-bottom:1%;
                                margin-left:0;
                                text-align:left;
                            }
                            h2, .h2 {
                                color:#000;
                                display:block;
                                font-family:roboto;
                                font-size:30px;
                                font-weight: bold;
                                line-height:100%;
                                margin-top:2%;
                                margin-right:0;
                                margin-bottom:1%;
                                margin-left:0;
                                text-align:left;
                            }
                            h3, .h3 {
                                color:#000;
                                display:block;
                                font-family:roboto;
                                font-size:24px;
                                font-weight:bold;
                                margin-top:2%;
                                margin-right:0;
                                margin-bottom:1%;
                                margin-left:0;
                                text-align:left;
                            }
                            h4, .h4 {
                                color:#000;
                                display:block;
                                font-family:roboto;
                                font-size:18px;
                                font-weight:bold;
                                line-height:100%;
                                margin-top:2%;
                                margin-right:0;
                                margin-bottom:1%;
                                margin-left:0;
                                text-align:left;
                            }
                            h5, .h5 {
                                color:#000;
                                display:block;
                                font-family:roboto;
                                font-size:14px;
                                font-weight:bold;
                                line-height:100%;
                                margin-top:2%;
                                margin-right:0;
                                margin-bottom:30%;
                                margin-left:0;
                                text-align:left;
                            }
                            .textdark {
                                color: #444444;
                                font-family: roboto;
                                font-size: 12px;
                                line-height: 150%;
                                text-align: left;
                            }
                            .textwhite {
                                color: #fff;
                                font-family: roboto;
                                font-size: 12px;
                                line-height: 150%;
                                text-align: left;
                            }
                            .fontwhite { color:#fff; }
                            .medium {
                                font-size: 16px;
                                font-weight: 400;
                            }
                            .small {
                                color: #444;
                                font-family: roboto;
                                font-size: 9px;
                                margin-bottom:30%;
                            }
                            span.green {
                                color: #32CD32;
                                font-size: 20px;
                            }
                            span.red {
                                color: #DC143C;
                                font-size: 20px;
                            }
                            span.orange {
                                color: #FF7F50;
                                font-size: 20px;
                            }
                            span.time {
                                font-size: 12px;
                                vertical-align: middle;
                            }
                            span.location {
                                font-size: 10px;
                                color: #666;
                                padding-left: 30px;
                            }
                            span.break {
                                font-size: 10px;
                                vertical-align: middle;
                            }
                            p {
                                font-family: roboto;
                                font-size: 12px;
                                vertical-align: middle;
                            }
                            .border { border: 0.3px solid #ccc; }
                        </style>
                    </head>
                    <body style="width:100% !important; margin:0; -webkit-text-size-adjust:none;">
    					<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#ffffff; height:64px;">
                            <tr>
                                <td align="left" valign="middle" width="50%">
                                    <h3>'.$row['name'].'</h3>
                                </td>
                                <td align="right" valign="middle">
                                    <h3>'.$date.' • '.$company_name.'</h3>
                                </td>
                            </tr>
    					</table><br>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="left">
                                    <h5>Overview</h5>
                                </td>
                            </tr>
                        </table>
                        <table cellpadding="10" cellspacing="0" width="100%" class="border">
                            <tr>
                                <td align="left" class="border">
                                    <p class="small">TOTAL HOURS</p>
                                    <p class="medium">'.$totalHours.'</p>
                                </td>
                                <td align="left" class="border">
                                    <p class="small">REGULAR</p>
                                    <p class="medium">'.$totalHours.'</p>
                                </td>
                                <td align="left" class="border">
                                    <p class="small">OVERTIME</p>
                                    <p class="medium">'.$totalOvertime.'</p>
                                </td>
                                <td align="left" class="border">
                                    <p class="small">BREAK</p>
                                    <p class="medium">'.$totalBreak.'</p>
                                </td>
                                <td align="left" class="border">
                                    <p class="small">PTO</p>
                                    <p class="medium">'.$totalPTO.'</p>
                                </td>
                            </tr>
                        </table><br>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="left">
                                    <h5>Job Codes</h5>
                                </td>
                            </tr>
                        </table>
                        <table cellpadding="10" cellspacing="0" width="50%" class="border">
                            <tr>
                                <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                    <p class="small">JOB CODE</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                    <p class="small">HOURS</p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <p>No Job Code</p>
                                </td>
                                <td align="left">
                                    <p>'.$totalHours.'</p>
                                </td>
                            </tr>
                        </table><br>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="left">
                                    <h5>Timesheets</h5>
                                </td>
                            </tr>
                        </table>
                        <table cellpadding="10" cellspacing="0" width="100%" class="border">
                            <tr>
                                <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                    <p class="small">DATE</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                    <p class="small">REGULAR</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                    <p class="small">OVERTIME</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                    <p class="small">BREAK</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                    <p class="small">PTO</p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc; background: #f1f1f1;">
                                    <p class="small">TOTAL</p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p><b>W'.$week.' • '.$date.'</b></p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p><b>'.$totalHours.'</b></p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p><b>'.$totalOvertime.'</b></p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p><b>'.$totalBreak.'</b></p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p><b>'.$totalPTO.'</b></p>
                                </td>
                                <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                    <p><b>'.$totalHours.'</b></p>
                                </td>
                            </tr>';

                            // get dates between two dates
                            $dates = getDatesFromRange($start_date, $end_date);

                            // iterate dates
                            foreach ($dates as $mDate) {
                                // format date
                                $myDate = new DateTime($mDate);
                                $day = $myDate->format("D");
                                $monthDate = $myDate->format("F j");

                                // get attendance
                                $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created like '$mDate%' order by id asc");

                                // check
                                if (count($attendance) == 0) {
                                    $html .= '<tr>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p><b>'.$day.' • '.$monthDate.'</b></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p><b>Not Active!</b></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p></p>
                                        </td>
                                    </tr>';
                                } else {

                                    // get total entry
                                    // init vars
                                    $daily_total_hours = 0.0;
                                    $daily_overtime_hours = 0.0;
                                    $daily_break_hours = 0.0;
                                    $daily_pto_hours = 0.0;

                                    // iterate rows
                                    foreach ($attendance as $item) {
                                        // get total hours
                                        $daily_total_hours += doubleval($item['shift_duration']);
                                        $daily_overtime_hours += doubleval($item['overtime']);
                                        $daily_break_hours += doubleval($item['break_duration']);
                                    }

                                    // get pto
                                    $leave = $db->fetchAll("select tl.*, tld.date, tp.name from timesheet_leave tl, timesheet_leave_date tld, timesheet_pto tp where tl.user_id = $user_id and tp.id = tl.pto_id and tld.date = '$mDate%' order by id asc");
                                    // iterate rows
                                    foreach ($leave as $item) {
                                        // get total hours
                                        $daily_pto_hours += doubleval($item['total_hours']);
                                    }

                                    // convert minutes to $number or hours and minutes eg. 8h 30m
                                    $dailyTotalHours    = formatDecimalTime($daily_total_hours);
                                    $dailyOvertimeHours = formatDecimalTime($daily_overtime_hours);
                                    $dailyBreakHours    = formatDecimalTime($daily_break_hours);
                                    $dailyPTOHours      = formatDecimalTime($daily_pto_hours);


                                    $html .= '<tr>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p><b>'.$day.' • '.$monthDate.'</b></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p><b>'.$dailyTotalHours.'</b></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p><b>'.$dailyOvertimeHours.'</b></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p><b>'.$dailyBreakHours.'</b></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p><b>'.$dailyPTOHours.'</b></p>
                                        </td>
                                        <td align="left" style="border-bottom: 0.3px solid #ccc;">
                                            <p><b>'.$dailyTotalHours.'</b></p>
                                        </td>
                                    </tr>';

                                    // iterate rows
                                    foreach ($attendance as $item) {
                                        // get id
                                        $attendance_id = $item['id'];

                                        // init
                                        $clockInTime = "";
                                        $clockInLocation = "";
                                        $clockOutTime = "";
                                        $clockOutLocation = "";
                                        $breakInTime = "";
                                        $breakOutTime = "";
                                        $breakInDate = "";
                                        $breakOutDate = "";
                                        $breaks = array();

                                        // get logs
                                        $logs = $db->fetchAll("select * from timesheet_logs where attendance_id = $attendance_id order by id asc");

                                        // iterate logs
                                        foreach ($logs as $log) {
                                            // check
                                            if ($log['action'] == "Check in") {
                                                // create the date
                                                $date_created = date_create($log['date_created']);
                                                $clockInTime = date_format($date_created, "h:sa");

                                                // if if not manual
                                                if (!empty($log['user_location_address'])) {
                                                    $clockInLocation = $log['user_location_address'];
                                                } else {
                                                    // get approved_by
                                                    $user_id = $log['approved_by'];

                                                    // get name of approved_by
                                                    $user = $db->fetchRow("select *, concat(FName, ' ', LName) as full_name from users where id = $user_id");

                                                    $clockInLocation = "Manually Clocked In by " . $user['full_name'];
                                                }

                                            } else if ($log['action'] == "Check out") {
                                                // create the date
                                                $date_created = date_create($log['date_created']);
                                                $clockOutTime = date_format($date_created, "h:sa");

                                                // if if not manual
                                                if (!empty($log['user_location_address'])) {
                                                    $clockOutLocation = $log['user_location_address'];
                                                } else {
                                                    // get approved_by
                                                    $user_id = $log['approved_by'];

                                                    // get name of approved_by
                                                    $user = $db->fetchRow("select *, concat(FName, ' ', LName) as full_name from users where id = $user_id");

                                                    $clockOutLocation = "Manually Clocked In by " . $user['full_name'];
                                                }
                                            } else if ($log['action'] == "Break in") {
                                                // create the date
                                                $date_created = date_create($log['date_created']);
                                                $breakInTime = date_format($date_created, "h:sa");
                                                $breakInDate = $log['date_created'];

                                            } else if ($log['action'] == "Break out") {
                                                // create the date
                                                $date_created = date_create($log['date_created']);
                                                $breakOutTime = date_format($date_created, "h:sa");
                                                $breakOutDate = $log['date_created'];

                                                // get break time difference
                                                $diff = getTimeDifference($breakInDate, $breakOutDate);
                                                // get break time string
                                                $diff_string = $diff[4]."m";
                                                // check hour
                                                if ($diff[3] > 0) {
                                                    $diff_string = $diff[3]."h";

                                                    // check minutes
                                                    if ($diff[4] > 0) {
                                                        $diff_string .= " ".$diff[4]."m";
                                                    }
                                                }

                                                $break = $breakInTime." - ".$breakOutTime." • ".$diff_string;
                                                array_push($breaks, $break);
                                            }
                                        }

                                        $html .= '<tr>
                                            <td colspan="6" align="left" style="border-bottom: 0.3px solid #ccc; background-color: #f1f1f1;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td align="left" valign="top" width="30%">
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td width="10px;"><span class="green">&#8226;</span></td>
                                                                    <td><span class="time">'.$clockInTime.'</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><span class="location">'.substrWords($clockInLocation, 40).'</span></td>
                                                                </tr>
                                                            </table><br>
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td width="10px;"><span class="red">&#8226;</span></td>
                                                                    <td><span class="time">'.$clockOutTime.'</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><span class="location">'.substrWords($clockOutLocation, 40).'</span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td align="left" valign="top">
                                                            <p class="small">JOB CODE</p>
                                                            <p></p>
                                                        </td>
                                                        <td align="left" valign="top">
                                                            <p class="small">BREAK</p>
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">';
                                                            // iterate breaks
                                                            foreach ($breaks as $break) {
                                                                $html .= '<tr>
                                                                              <td width="10px;"><span class="orange">&#8226;</span></td>
                                                                              <td><span class="break">'.$break.'</span></td>
                                                                          </tr>';
                                                            }
                                                  $html .= '</table>
                                                        </td>
                                                        <td align="left" valign="top">
                                                            <p class="small">NOTES</p>
                                                            <p><span class="break">'.$item['notes'].'</span></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>';
                                    }
                                }
                            }


                        $html .= '</table>
                    </body>
                </html>';


        // create new page per member
        $mpdf->AddPage();
        $mpdf->WriteHTML($html);
        $mpdf->SetHTMLFooter($footer);

    }

    $mpdf->Output();

} else {
    //*********** GENERATE CSV REPORT **********//
    // init db handler
    $db = new database_handler();

    // check
    if (isset($company_id) == true) {
        // get company_name
        $row = $db->fetchRow("select * from business_profile where id = $company_id");
        $company_name = $row['business_name'];
    } else {
        // get user name
        $row = $db->fetchRow("select *, concat(FName, ' ', LName) as full_name from users where id = $user_id");
        $company_name = $row['full_name'];
    }

    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the csv headings
    fputcsv($output, array('', '', '', '', '', '', '', '', '', '', ''));
    fputcsv($output, array('Timesheet Report for ' . $company_name, '', '', '', '', '', '', '', '', '', ''));
    fputcsv($output, array($date, '', '', '', '', '', '', '', '', '', ''));
    fputcsv($output, array('', '', '', '', '', '', '', '', '', '', ''));

    // output the column headings for team summary
    fputcsv($output, array('TEAM SUMMARY', '', '', '', '', '', '', '', '', '', ''));
    fputcsv($output, array('User', 'Workweek', 'Regular', 'Overtime', 'Break', 'PTO', 'Total Hours', '', '', '', ''));


    // check
    if (isset($user_id) == true) {
        // get user
        $rows = $db->fetchAll("select * from timesheet_team_members where user_id = $user_id and status = 1");
    } else {
        // get all team members
        $rows = $db->fetchAll("select * from timesheet_team_members where company_id = $company_id and status = 1");
    }

    // iterate rows
    foreach ($rows as $row) {
        // get user_id
        $user_id = $row['user_id'];

        // init vars
        $total_hours = 0.0;
        $total_break = 0.0;
        $total_overtime = 0.0;
        $total_pto = 0.0;

        // get attendance between dates
        $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created between CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");

        // iterate rows
        foreach ($attendance as $item) {
            // get id
            $attendance_id = $item['id'];

            $total_hours += doubleval($item['shift_duration']);
            $total_break += doubleval($item['break_duration']);
            $total_overtime += doubleval($item['overtime']);
        }

        // get leave
        $leave = $db->fetchAll("select tl.*, tld.date, tp.name from timesheet_leave tl, timesheet_leave_date tld, timesheet_pto tp where tl.user_id = $user_id and tp.id = tl.pto_id and tl.id = tld.leave_id and tld.date between CAST('$start_date' AS DATE) AND CAST('$end_date' AS DATE)");
        // iterate rows
        foreach ($leave as $item) {
            // get total hours
            $total_pto += doubleval($item['total_hours']);
        }

        // get formatted time
        $totalHours     = formatDecimalTime($total_hours);
        $totalOvertime  = formatDecimalTime($total_overtime);
        $totalBreak     = formatDecimalTime($total_break);
        $totalPTO       = formatDecimalTime($total_pto);


        // write to csv
        fputcsv($output, array($row['name'], $date, $totalHours, $totalOvertime, $totalBreak, $totalPTO, $totalHours, '', '', '', ''));
        fputcsv($output, array('', 'Total', $totalHours, $totalOvertime, $totalBreak, $totalPTO, $totalHours, '', '', '', ''));
    }


    // output the column headings for daily time entry log
    fputcsv($output, array('', '', '', '', '', '', '', '', '', '', ''));
    fputcsv($output, array('DAILY TIME ENTRY LOG', '', '', '', '', '', '', '', '', '', ''));
    fputcsv($output, array('User', 'Date', 'Day Total', 'Clock In', 'In Location', 'Clock Out', 'Out Location', 'Entry Total', 'Breaks', 'Jobs', 'Notes'));


    // get dates between two dates
    $dates = getDatesFromRange($start_date, $end_date);


    // temp name
    $tempName = "";
    $mName = "";

    // iterate rows
    foreach ($rows as $row) {
        // get user_id
        $user_id = $row['user_id'];

        // assign
        $mName = $row['name'];

        // iterate dates
        foreach ($dates as $mDate) {
            // get attendance
            $attendance = $db->fetchAll("select * from timesheet_attendance where user_id = $user_id and date_created like '$mDate%' order by id asc");

            // check
            if (count($attendance) == 0) {
                // check tempName
                if ($mName != $tempName) {
                    fputcsv($output, array($row['name'], $mDate, 'Off', '', '', '', '', '', '', '', ''));
                    $tempName = $row['name'];
                } else {
                    fputcsv($output, array('', $mDate, 'Off', '', '', '', '', '', '', '', ''));
                }
            } else {

                // get total entry
                // init vars
                $daily_total_hours = 0.0;

                // iterate rows
                foreach ($attendance as $item) {
                    // get total hours
                    $daily_total_hours += doubleval($item['shift_duration']);
                }

                // convert minutes to $number or hours and minutes eg. 8h 30m
                $dailyTotalHours =  formatDecimalTime($daily_total_hours);



                // counter
                $counter = 0;
                // iterate rows
                foreach ($attendance as $item) {
                    // get id
                    $attendance_id = $item['id'];

                    // init
                    $regular_hours  = doubleval($item['shift_duration']);
                    $break_hours    = doubleval($item['break_duration']);

                    // get formatted time
                    $regularHours   = formatDecimalTime($regular_hours);
                    $breakHours  = formatDecimalTime($break_hours);


                    // init
                    $clockInTime = "";
                    $clockInLocation = "Manual Entry";
                    $clockOutTime = "";
                    $clockOutLocation = "Manual Entry";

                    // get logs
                    $logs = $db->fetchAll("select * from timesheet_logs where attendance_id = $attendance_id");

                    // iterate logs
                    foreach ($logs as $log) {
                        // check
                        if ($log['action'] == "Check in") {
                            // create the date
                            $date_created = date_create($log['date_created']);
                            $clockInTime = date_format($date_created, "h:sa");
                            $clockInLocation = $log['user_location_address'];

                        } else if ($log['action'] == "Check out") {
                            // create the date
                            $date_created = date_create($log['date_created']);
                            $clockOutTime = date_format($date_created, "h:sa");
                            $clockOutLocation = $log['user_location_address'];
                        }
                    }

                    $notes = empty($item['notes']) ? "-" : $item['notes'];
                    $breakHours = ($breakHours == '0m') ? "-" : $breakHours;

                    // check counter
                    if ($counter == 0) {
                        // check
                        if ($mName != $tempName) {
                            fputcsv($output, array($mName, $mDate, $dailyTotalHours, $clockInTime, $clockInLocation, $clockOutTime, $clockOutLocation, $regularHours, $breakHours, '-', $notes));
                        } else {
                            fputcsv($output, array('', $mDate, $dailyTotalHours, $clockInTime, $clockInLocation, $clockOutTime, $clockOutLocation, $regularHours, $breakHours, '-', $notes));
                        }
                    } else {
                        fputcsv($output, array('', '', '', $clockInTime, $clockInLocation, $clockOutTime, $clockOutLocation, $regularHours, $breakHours, '-', $notes));
                    }

                    $counter += 1;
                }

            }
        }
    }


    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$company_name.' Timesheet Report - '.$date);
}

?>
