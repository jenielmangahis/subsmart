<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
        .table{
            width: 100%;
        }
    </style>

</head>

<body>
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">

                <?php 
                if($has_logo){ 
                ?>
                <p style="text-align: left;"><img width="100" src="cid:company_logo" alt="" style="width:100px;"></p>
                <?php
                }else{
                ?>
                <h4 style="text-align:left;"><?=$business_name?></h4>
                <?php
                }
                ?>
                <h2 style="text-align:left;">Timesheet Report</h2>
                <h3 style="text-align:left;"><?= date("M d",strtotime($date_from)) ?> - <?= date("d",strtotime($date_to)) ?></h3>
                <p class="lead text-muted" style="text-align: left; margin-top:20px;"><label style="padding-bottom: 10px;">Hi <?= $FName ?>,</label><br>Below you'll find the timesheet report you requested for your team at <?= $business_name ?> for the pay period <?= date("M d",strtotime($date_from)) ?> - <?= date("d",strtotime($date_to)) ?>.</p>
                <p>
                    <a href="<?= base_url('/timesheet/timelogs/') . $file_info[0] ?>" class="btn btn-primary my-2">Download .CSV</a>
                    <a href="<?= base_url('/timesheet/timelogs/') . $file_info[3] ?>" class="btn btn-primary my-2">Download .PDF</a>
                </p>
            <table class="table" >
                <tbody>
                    <thead>
                        <tr style="font-weight: bold; border:solid 2px #E6E6E6;">
                            <th style="text-align:left;">Employee</th>
                            <th>Total Paid</th>
                            <th>Regular</th>
                            <th>Unpaid Breaks</th>
                            <th>OT</th>
                            <th>Est. Wages</th>
                        </tr>
                    </thead>
                    <?php
                    $timehseet_storage = $file_info[2];
                    $id_running;
                    $started = false;
                    $table = '';
                    $time_card_ctr = 0;
                    $act_dif_total = 0;
                    $total_paid = 0;
                    $total_regular = 0;
                    $total_overtime = 0;
                    $total_wage = 0;
                    $total_est_wage = 0;
                    $overall_act_dif_total = 0;
                    $overall_total_paid = 0;
                    $overall_total_regular = 0;
                    $overall_total_overtime = 0;
                    $overall_total_wage = 0;
                    $overall_total_est_wage = 0;
                    $overall_time_card_ctr = 0;
                    $overall_pto = 0;
                    for ($i = 0; $i < count($timehseet_storage); $i++) {

                        if ($id_running != $timehseet_storage[$i][0]) {
                            if (!$started) {
                                $started = true;
                            } else {
                                $table .= '<tr style="border:solid 2px #E6E6E6;">
                                                    <td style="text-align: left;">' . $timehseet_storage[$i - 1][1] . '</td>
                                                    <td >' . $total_paid . ' hours</td>
                                                    <td >' . $total_regular . ' hours</td>
                                                    <td >' . $total_overtime . '</td>
                                                    <td >$' . $total_est_wage . '</td>
                                                </tr>';
                                if ($i < count($timehseet_storage) - 1) {
                                    $table .= '';
                                }
                            }
                            $time_card_ctr = 0;
                            $act_dif_total = 0;
                            $total_paid = 0;
                            $total_regular = 0;
                            $total_overtime = 0;
                            $total_wage = 0;
                            $total_est_wage = 0;
                            $id_running = $timehseet_storage[$i][0];
                        }
                        $clockout = ($timehseet_storage[$i][7] == '' ? '' : date("M d h:i A", strtotime($timehseet_storage[$i][7])));
                        if ($timehseet_storage[$i][7] == '') {
                            $actual_vs_expected = '-';
                            $expected = 8;
                        } else {
                            $actual_vs_expected = $timehseet_storage[$i][10] == '' ?  8 - round($timehseet_storage[$i][18], 2) . "" : "0.00";
                        }
                        $regular_hours = ($timehseet_storage[$i][12] == '' ? 8 : $timehseet_storage[$i][12]);
                        $paid_hours = ($timehseet_storage[$i][17] == 'Approved' ? $timehseet_storage[$i][18] : round($regular_hours, 2));

                        $est_wage = 0;
                        if ($timehseet_storage[$i][21] == "hourly") {
                            $est_wage = round($paid_hours * $timehseet_storage[$i][20], 2);
                        } else {
                            $est_wage = round(($timehseet_storage[$i][20] / $regular_hours) * $paid_hours, 2);
                        }
                        $total_forked_hours =
                            $table .= '';
                        $time_card_ctr++;
                        $act_dif_total += $timehseet_storage[$i][7] == '' ? 0 : $actual_vs_expected;
                        $total_regular += ($timehseet_storage[$i][12] == '' ? 8 : $timehseet_storage[$i][12]);
                        $total_paid += $paid_hours;
                        $total_overtime += ($timehseet_storage[$i][17] == 'Approved' ? $timehseet_storage[$i][16] : 0.00);
                        $total_wage += $timehseet_storage[$i][20];
                        $total_est_wage += $est_wage;
                        $overall_act_dif_total += $timehseet_storage[$i][7] == '' ? 0 : $actual_vs_expected;
                        $overall_total_regular += ($timehseet_storage[$i][12] == '' ? 8 : $timehseet_storage[$i][12]);
                        $overall_total_paid += $paid_hours;
                        $overall_total_overtime += ($timehseet_storage[$i][17] == 'Approved' ? $timehseet_storage[$i][16] : 0.00);
                        $overall_total_wage += $timehseet_storage[$i][20];
                        $overall_total_est_wage += $est_wage;
                        $overall_time_card_ctr++;
                        if ($i == count($timehseet_storage) - 1) {
                            $table .= '<tr style="border:solid 2px #E6E6E6;">
                                                    <td style="text-align: left;">' . $timehseet_storage[$i][1] . '</td>
                                                    <td >' . $total_paid . ' hours</td>
                                                    <td >' . $total_regular . ' hours</td>
                                                    <td >' . $total_overtime . '</td>
                                                    <td >$' . $total_est_wage . '</td>
                                                </tr>';
                        }
                    }
                    echo $table;
                    ?>
                </tbody>
            </table>
            <div style="text-align:left; font-weight: bold; margin-top:20px;">Total Work Hours - <?= $overall_total_paid ?> hours</div>
            <table class="table">
                    <thead>
                        <tr style="font-weight: bold;  border:none;">
                            <th>Regular</th>
                            <th>OT</th>
                            <th>Est. Wages</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="font-weight: bold; border:none;">
                            <td style="color:#6c757d"><?= $overall_total_regular ?> hours</td>
                            <td style="color:#6c757d"><?= $overall_total_overtime ?></td>
                            <td style="color:#6c757d">$<?= $overall_total_est_wage ?></td>
                        </tr>
                    </tbody>
                </table>
                <p style="margin-top:20px;">
                    <a href="<?= base_url('/dashboard')?>" class="btn btn-success my-2">VISIT MY ACCOUNT</a>
                </p>
                <p class="lead text-muted" style="text-align: left; margin-top:20px;">
                    <label style="padding-bottom: 5px;">Thanks,<br><br> nSmarTrac Team<br>You are receiving this email because you signed up for nSmarTrac. If you'd rather not receive this type of email, please click here to <a href="<?=base_url('/timesheet/settings')?>">unsubscribe</a>
                
                </p>
                <p class="lead text-muted" style="text-align: left;">
                    6866 Pine Forest Road Suite C. Pensacola, Florida 32526
                </p>
                <p style="text-align: left; margin-top:20px;"><img width="100" src="cid:logo_2u" alt="" style="width:100px;"></p>
                    
            </div>
        </section>  
    </main>
</body>

</html>