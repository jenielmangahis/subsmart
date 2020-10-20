<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
	<title>Weekly Timesheet Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<style type="text/css">
    body{
        font-family: "Gill Sans", sans-serif;
    }
    .tile-container{
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 2px 8px 0 rgba(0,0,0,.2);
        -moz-box-shadow: 0 2px 8px 0 rgba(0,0,0,.2);
        box-shadow:0 2px 8px 0 rgba(0,0,0,.2);
        background-color: #fff;
        border: 1px solid #d4d7dc;
        -webkit-transition: all .3s ease;
        position:relative;
        top:20px;
        width: 60%;
        height: 90%;
        margin: 0 auto;
    }
    .inner-content{
        padding: 20px;
    }
    .email-container{
        padding: 50px;
    }
    .email-title{
        font-size: 22px;
        font-weight: bold;
    }
    .email-sub-title{
        font-weight: bold;
        color: #54b84b;
    }
    .email-body{
        margin-top: 50px;
    }
    .email-body-header{
        margin-top: 20px;
    }
    .email-recipient{
        font-weight: bold;
    }
    .email-attachment{
        margin: auto;
        width: 30%;
    }
    .btn-attachment{
        display: block;
        margin-bottom: 10px;
        border-radius: 0;
    }
    .email-details{
        margin-top: 50px;
    }
    .fa-stopwatch{
        display: inline-block;
        color: grey;
    }
    .email-details-body{
        padding-left: 35px;
    }
    .text{
        color: grey;
        font-size: 13px;
    }
    .time{
        font-weight: bold;
    }
</style>
<body style="font-family: "Gill Sans", sans-serif;">
<div class="tile-container" style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;height: 90%;margin: 0 auto;">
    <div class="inner-container">
        <div class="tileContent">
            <div class="clear">
                <div class="inner-content" style="padding: 20px;">
                    <div class="email-container" style="padding: 50px;">
                        <div class="email-header">
                            <h4>nSmartrac</h4>
                        </div>
                        <?php
                                $start_date = date('M d',strtotime('monday last week'));
                                $date = date('M d, Y',strtotime('monday last week'));
                                $date = strtotime($date);
                                $date = strtotime("+6 day", $date);
                                $end_date = date('M d', $date);
                        ?>
                        <div class="email-section">
                            <div class="email-title" style="font-size: 22px;font-weight: bold;">Your Weekly Timesheet Report</div>
                            <div class="email-sub-title" style="color: #54b84b; font-weight: bold;"><?php echo $start_date;?> - <?php echo $end_date;?></div>
                            <div class="email-body" style="margin-top: 50px;">
                                <div class="email-body-header" style="margin-top: 20px;">
                                    <span class="email-greetings">Hi,</span>
                                    <span class="email-recipient" style="font-weight: bold;">Tommy Nguyen</span>
                                </div>
                                <div class="email-body-content">
                                    <p>Below you'll find your <strong>Weekly Timesheet Report </strong>for your team at
                                        <strong>nSmartrac.</strong>
                                    </p>
                                </div>
                                <div class="email-attachment" style="margin: auto;width: 30%;">
                                    <a href="<?php echo site_url()?>timesheet/csvTimesheetReport" class="btn btn-success btn-attachment" style="
                                    text-decoration: none;
                                    display: block;
                                    margin-bottom: 10px;
                                    border-radius: 0;
                                    color: #fff;
                                    text-align: center;
                                    vertical-align: middle;
                                    user-select: none;
                                    background-color: #28a745;
                                    font-weight: 400;
                                    border: 1px solid transparent;
                                    padding: 10px 25px;
                                    line-height: 1.5;
                                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                                    font-size: 15px;">DOWNLOAD .CSV</a>
                                    <a href="<?php echo site_url()?>timesheet/pdfTimesheetReport" class="btn btn-success btn-attachment" target="_blank" style="
                                     text-decoration: none;
                                    display: block;
                                    margin-bottom: 10px;
                                    border-radius: 0;
                                    color: #fff;
                                    text-align: center;
                                    vertical-align: middle;
                                    user-select: none;
                                    background-color: #28a745;
                                    font-weight: 400;
                                    border: 1px solid transparent;
                                    padding: 10px 25px;
                                    line-height: 1.5;
                                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                                    font-size: 15px;"">DOWNLOAD .PDF</a>
                                </div>
                                <?php
                                    $week_of =  date('Y-m-d',strtotime('monday last week'));
                                    $total_shift = 0;
                                    $total_overtime = 0;
                                    $total_break = 0;
                                    $total_pto = 0;
                                    foreach ($last_week as $week){
                                            $total_shift += $week->shift_duration;
                                            $total_overtime += $week->overtime;
                                            $total_break += $week->break_duration;
                                            $total_pto += 0;
                                    }
                                    if ($total_overtime < 0){
                                        $total_overtime = 0;
                                    }
                                    $work_hours = $total_shift + $total_overtime + $total_break + $total_pto;
                                ?>
                                <div class="email-details" style="margin-top: 50px;">
                                    <div class="email-details-header">
                                        <i class="fa fa-stopwatch" style="display: inline-block;color: grey;"></i>
                                        <h5 style="display: inline-block">Total Work Hours - <?php echo round($work_hours,0)?>hrs</h5>
                                    </div>
                                    <div class="email-details-body" style="padding-left: 35px;">
                                        <div class="email-details-section">
                                            <div class="email-regular text" style="color: grey;font-size: 13px">Regular</div>
                                            <div class="email-regular time" style="font-weight: bold;"><?php echo round($total_shift,0)?>hrs</div>
                                        </div>
                                        <div class="email-details-section">
                                            <div class="email-overtime text" style="color: grey;font-size: 13px">Overtime</div>
                                            <div class="email-overtime time" style="font-weight: bold;"><?php echo round($total_overtime,0)?>hrs</div>
                                        </div>
                                        <div class="email-details-section">
                                            <div class="email-break text" style="color: grey;font-size: 13px">Break</div>
                                            <div class="email-break time" style="font-weight: bold;"><?php echo round($total_break,0)?>hrs</div>
                                        </div>
                                        <div class="email-details-section">
                                            <div class="email-pto text" style="color: grey;font-size: 13px">PTO</div>
                                            <div class="email-pto time" style="font-weight: bold;"><?php echo round($total_pto,0)?>hrs</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/3f1ebae80b.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</html>