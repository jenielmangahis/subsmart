<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<div class="management-report-cover-page" style="page-break-after: always;position:relative;">
    <div class="header">
        <div class="title">Lou Pinton</div>
        <div class="company-name">
            <?php
            if (strtolower($management_report->cover_subtitle) == "{company name}") {
                echo $management_report->business_name;
            } else {
                echo $management_report->cover_subtitle;
            }
            ?>
        </div>
        <div class="end-period">
            <?php
            $end_period = explode("{", $management_report->cover_report_period);
            $echo_text = "";
            for ($i = 0; $i < count($end_period); $i++) {
                if ("{" . strtolower($end_period[$i]) == "{report end date}") {
                    $echo_text .= " " . date("F d, Y", strtotime($management_report->report_end_period));
                } else {
                    $echo_text .= " " . $end_period[$i];
                }
            }
            echo $echo_text;
            ?>
        </div>
    </div>
    <div class="body">
        <div class="logo">
            <?php
            if ($management_report->cover_show_logo == 1) {
            ?><img src="<?= base_url("uploads/users/business_profile/1/Nsmart_logo.png") ?>" alt=""><?php
                                                                                                        }
                                                                                                            ?>

        </div>
        <div class="prepared-on">
            <label for="">Prepared on</label>
            <div class="the-date"><?= $management_report->cover_prepared_date ?></div>
        </div>
    </div>
    <div class="footer"><?= $management_report->cover_disclaimer ?></div>
</div>