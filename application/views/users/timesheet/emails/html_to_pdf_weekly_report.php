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

        .table td,
        .table th {
            border: none;
        }
    </style>

</head>

<body>
    <h2>Timesheet Report</h2>
    <p class="lead text-muted" style="text-align: left; font-size:10px; color:#212529;">Below you'll find the timesheet report you requested for your team at <b> <?= $business_name ?></b> for the pay period <b><?= date('M d', strtotime($date_from)) ?> - <?= date("d",strtotime($date_to)) ?></b>.</p>
    <table class="table">
        <tbody>
            <thead>
                <tr style="font-weight: bold; background-color:#E6E6E6; text-align:left;">
                    <th>Date <br>(<?= $timesheet_report_timezone ?>)</th>
                    <th>Role</th>
                    <th style=" text-align:center;">Wage</th>
                    <th>Time Card <br>(<?= $timesheet_report_timezone ?>)</th>
                    <th>Act.& Sched Diff.</th>
                    <th>Total Paid</th>
                    <th>Regular</th>
                    <th>OT</th>
                    <?php if($est_wage_privacy == 1){
                        echo '<th>Est. Wages</th>';
                    }
                    ?>
                    <th>Notes</th>
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
            for ($i = 0; $i < count($timehseet_storage); $i++) {

                if ($id_running != $timehseet_storage[$i][0]) {
                    if (!$started) {
                        $started = true;
                        $table .= '
                                        <tr>
                                            <th colspan="12" style="font-weight:bold;"> ' . $timehseet_storage[$i][1] . '</th>
                                        </tr>
                                    ';
                    } else {
                        if($est_wage_privacy == 1){
                            $est_wage_privacy_html = '<td style="font-weight:bold;">$' . $total_est_wage . '</td>';
                        }
                        $table .= '<tr style="background-color:#F2F2F2;font-weight:500;">
                                            <td colspan="2"> Total for ' . $timehseet_storage[$i - 1][1] . '</td>
                                            <td style="font-weight:bold; text-align:center;">$' . $total_wage . '</td>
                                            <td style="font-weight:bold;">' . $time_card_ctr . ($time_card_ctr > 1 ? ' Time cards' : ' Time card') . '</td>
                                            <td style="font-weight:bold;text-align:center;">' . $act_dif_total . '</td>
                                            <td style="font-weight:bold;">' . $total_paid . '</td>
                                            <td style="font-weight:bold;">' . $total_regular . '</td>
                                            <td style="font-weight:bold;">' . $total_overtime . '</td>
                                            '.$est_wage_privacy_html.'
                                            <td style="font-weight:bold;"></td>
                                    </tr>';
                        if ($i < count($timehseet_storage) - 1) {
                            $table .= '
                                        <tr>
                                            <th colspan="12" style="font-weight:bold;"> ' . $timehseet_storage[$i][1] . '</th>
                                        </tr>
                                    ';
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
                if($est_wage_privacy == 1){
                    $est_wage_privacy_html = '<td>$' . $est_wage . '</td>';
                }
                    $table .= '<tr>
                                    <td>' . date("D M d", strtotime($timehseet_storage[$i][3])) . '</td>
                                    <td>' . $timehseet_storage[$i][2] . '</td>
                                    <td style="text-align:center;">$' . $timehseet_storage[$i][20] . '</td>
                                    <td>' . date("h:i A", strtotime($timehseet_storage[$i][6])) . ' - ' . ($timehseet_storage[$i][7] == '' ? 'No clockout' : date("h:i A", strtotime($timehseet_storage[$i][7]))) . '</td>
                                    <td style="text-align:center;">' . $actual_vs_expected  . '</td>
                                    <td>' . $paid_hours . '</td>
                                    <td>' . $regular_hours . '</td>
                                    <td>'  . ($timehseet_storage[$i][17] == 'Approved' ? $timehseet_storage[$i][16] : 0.00) . '</td>
                                    '.$est_wage_privacy_html.'
                                    <td>' . $timehseet_storage[$i][19] . '</td>
                                </tr>';
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
                    
                if($est_wage_privacy == 1){
                    $est_wage_privacy_html = '<td style="font-weight:bold;">$' . $total_est_wage . '</td>';
                }
                    $table .= '<tr style="background-color:#F2F2F2; font-weight:500;">
                                            <td colspan="2"> Total for ' . $timehseet_storage[$i][1] . '</td>
                                            <td style="font-weight:bold; text-align:center;">$' . $total_wage . '</td>
                                            <td style="font-weight:bold;">' . $time_card_ctr . ($time_card_ctr > 1 ? ' Time cards' : ' Time card') . '</td>
                                            <td style="font-weight:bold;text-align:center;">' . $act_dif_total . '</td>
                                            <td style="font-weight:bold;">' . $total_paid . '</td>
                                            <td style="font-weight:bold;">' . $total_regular . '</td>
                                            <td style="font-weight:bold;">' . $total_overtime . '</td>
                                            '.$est_wage_privacy_html.'
                                            <td style="font-weight:bold;"></td>
                                        </tr>';
                }
            }
            echo $table;
            ?>
        <tfoot>
            <tr style="font-weight: bold; background-color:#E6E6E6; text-align:left;border:solid 2px #E6E6E6;">
                <th colspan="2">Total for this Pay Period</th>
                <th style="text-align:center;">$<?= $overall_total_wage ?></th>
                <th><?= $overall_time_card_ctr . ($overall_time_card_ctr > 1 ? ' Time cards' : ' Time card') ?></th>
                <th style="text-align:center;"><?= $overall_act_dif_total ?></th>
                <th><?= $overall_total_paid ?></th>
                <th><?= $overall_total_regular ?></th>
                <th><?= $overall_total_overtime ?></th>
                <?php if($est_wage_privacy == 1){
                    echo '<th>$'.$overall_total_est_wage .'</th>';
                } ?>
                <th></th>
            </tr>
        </tfoot>
        </tbody>
    </table>
</body>

</html>