<?php
defined('BASEPATH') or exit('No direct script access allowed');
if ($management_report->cover_style == 1) {
    $header_bg_color = "#1F497D";
} elseif ($management_report->cover_style == 2) {
    $header_bg_color = "#404040";
} elseif ($management_report->cover_style == 3) {
    $header_bg_color = "#1F497D";
} else {
    $header_bg_color = "#1F497D";
}

if($action=="preview"){

}else{
    $cover_leter=$management_report->cover_title;

    if (strtolower($management_report->cover_subtitle) == "{company name}") {
        $cover_subtitle=$management_report->business_name;
    } else {
        $cover_subtitle=$management_report->cover_subtitle;
    }
    $end_period = explode("{", $management_report->cover_report_period);
        $echo_text = "";
        for ($i = 0; $i < count($end_period); $i++) {
            if ("{" . strtolower($end_period[$i]) == "{report end date}") {
                $echo_text .= " " . date("F d, Y", strtotime($management_report->report_end_period));
            } else {
                $echo_text .= " " . $end_period[$i];
            }
        }
    $end_period_text=$echo_text;
    if ($management_report->cover_show_logo == 1) {
        $logo_html=' <img src="<?= base_url("uploads/users/business_profile/1/Nsmart_logo.png") ?>" alt="">';
                                                                                            }else{
                                                                                                $logo_html="";
                                                                                            }
    $cover_prepared_date=$management_report->cover_prepared_date;
    $cover_disclaimer=$management_report->cover_disclaimer;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        .management-report-cover-page {
            width: 100%;
            font-family: "Tahoma";
            height: 100%;
            position: relative;
        }

        .header {
            background: <?= $header_bg_color ?>;
            padding: 10px;
            color: #fff;
            font-size: 14px;
        }

        .header .title {
            font-size: 30px;
            padding-bottom: 10px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            background: #DCE5F1;
            padding: 10px;
            width: 100%;
            font-size: 12px;
        }

        .body .logo {
            width: 25%;
            margin-top: 10px;
        }

        .body .logo img {
            width: 100%;
        }

        .body .prepared-on {
            position: absolute;
            top: 50%;
        }

        .body .prepared-on label {
            font-size: 12px;
            color: #A3A3A3;
        }
    </style>
</head>

<body>
    <!-- <header>
            Our Code World
    </header>

    <footer>
            Copyright &copy; <?php echo date("Y"); ?> 
    </footer> -->
    <main>
        <div class="management-report-cover-page" style="page-break-after: always;position:relative;">
            <div class="header">
                <div class="title"><?= $management_report->cover_title ?></div>
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
        <?php
        if ($management_report->table_include_table_of_contents == 1) {
        ?>
            <div class="table-of-contents" style="page-break-after: always;">
                <h1 class="page-title">
                    <?= $management_report->table_page_title ?>
                </h1>
                <hr>
                <div class="reports-titles">
                    <?php
                    $ctr = 2;
                    $text_left = "";
                    $text_right = "";
                    foreach ($primary_pages as $page) {
                        if ($page->include_this_page == 1 && $page->page_title != "") {
                            $text_left .= "<div style='padding:10px 0;'>" . $page->page_title . " </div>";
                            $text_right .= "<div style='padding:10px 0;'>" . $ctr . "</div>";
                            $ctr++;
                        }
                    }

                    foreach ($report_pages as $report) {
                        $text_left .= "<div style='padding:10px 0;'>" . $report->report_page_title . " </div>";
                        $text_right .= "<div style='padding:10px 0;'>" . $ctr . "</div>";
                        $ctr++;
                    }

                    if ($management_report->endnotes_include_page == 1) {
                        $text_left .= "<div style='padding:10px 0;'>" . $management_report->endnote_page_title . " </div>";
                        $text_right .= "<div style='padding:10px 0;'>" . $ctr . "</div>";
                        $ctr++;
                    }
                    echo "<div style='width:50%;float:left;'>" . $text_left . "</div>";
                    echo "<div style='width:50%;float:right;text-align:right;'>" . $text_right . "</div>";
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
        <?php
        foreach ($primary_pages as $page) {
            if ($page->include_this_page == 1 && $page->page_title != "") {
        ?>
                <div class="preliminary-pages" style="page-break-after: always;">
                    <h1 class="page-title"><?= $page->page_title ?></h1>
                    <hr>
                    <div class="peliminary-data">
                        <?= $page->page_content ?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <?php
        foreach ($report_pages as $report) {
        ?>
            <div class="report-pages" style="page-break-after: always;">
                <h1 class="page-title"><?= $report->report_page_title ?></h1>
                <hr>
                <div class="reports-data">

                </div>
            </div>
        <?php
        }
        ?>

        <?php
        if ($management_report->endnotes_include_page == 1) {
        ?>
            <div class="end-note-pages">
                <h1 class="page-title"><?= $management_report->endnote_page_title ?></h1>
                <hr>
                <div class="reports-data">
                    <?= $management_report->endnote_page_content ?>
                </div>
            </div>
        <?php
        }
        ?>
    </main>
</body>

</html>