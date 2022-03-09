<?php
defined('BASEPATH') or exit('No direct script access allowed');
if ($management_report->cover_style == 1) {
    $header_bg_color = "#1F497D";
} elseif ($management_report->cover_style == 2) {
    $header_bg_color = "#404040";
}

$this_quesrter = ceil(date("n", strtotime("1995-11-13")) / 3);
if($this->input->post("template_report_period") == "All Dates"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Today"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="This Week "){
    $report_end_date = date("Y-m-d", strtotime('sunday this week'));
}elseif($this->input->post("template_report_period")=="This Week-to-date"){
    $report_end_date = date("Y-m-d");
}elseif ($this->input->post("template_report_period") == "This Month") {
    $report_end_date = date("Y-m-t");
}elseif($this->input->post("template_report_period")=="This Month-to-date"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="This Quarter"){
    if($this_quesrter == 1){
        $report_end_date = date("Y-m-t", strtotime(date("Y-03-t")));
    }elseif($this_quesrter == 2){
        $report_end_date = date("Y-m-t", strtotime(date("Y-06-t")));
    }elseif($this_quesrter == 3){
        $report_end_date = date("Y-m-t", strtotime(date("Y-09-t")));
    }elseif($this_quesrter == 4){
        $report_end_date = date("Y-m-t", strtotime(date("Y-12-t")));
    }
}elseif($this->input->post("template_report_period")=="This Quarter-to-date"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="This Year"){
    $report_end_date = date("Y-12-31");
}elseif($this->input->post("template_report_period")=="This Year-to-date"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="This Year-to-last-month"){
    $report_end_date = date("Y-m-d", strtotime("last day of previous month"));
}elseif($this->input->post("template_report_period")=="Yesterday"){
    $report_end_date = date('Y-m-d',strtotime("-1 days"));
}elseif($this->input->post("template_report_period")=="Recent"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Last Week"){
    $report_end_date = date('Y-m-d',strtotime('last Sunday'));
}elseif($this->input->post("template_report_period")=="Last Week-to-date"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Last Month"){
    $report_end_date = date("Y-m-d", strtotime("last day of previous month"));
}elseif($this->input->post("template_report_period")=="Last Month-to-date "){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Last Quarter"){
    $last_quarter=$this_quesrter-1;
    if($last_quarter == 0){
        $last_quarter = 4;
    }
    if($last_quarter == 1){
        $report_end_date = date("Y-m-t", strtotime(date("Y-03-t")));
    }elseif($last_quarter == 2){
        $report_end_date = date("Y-m-t", strtotime(date("Y-06-t")));
    }elseif($last_quarter == 3){
        $report_end_date = date("Y-m-t", strtotime(date("Y-09-t")));
    }elseif($last_quarter == 4){
        $report_end_date = date("Y-m-t", strtotime(date("Y-12-t")));
    }
}elseif($this->input->post("template_report_period")=="Last Quarter-to-date"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Last Year"){
    $report_end_date = (date("Y")-1)."-12-31" ;
}elseif($this->input->post("template_report_period")=="Last Year-to-date"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Since 30 Days Ago"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Since 60 Days Ago"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Since 90 Days Ago"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Since 365 Days Ago"){
    $report_end_date = date("Y-m-d");
}elseif($this->input->post("template_report_period")=="Next Week"){
    $report_end_date = date('Y-m-d',strtotime('next Monday'));
}elseif($this->input->post("template_report_period")=="Next 4 Weeks"){
    $report_end_date = date("Y-m-d",('+3 weeks'));
}elseif($this->input->post("template_report_period")=="Next Month"){
    $report_end_date = date('Y-m-t',strtotime('first day of +1 month'));
}elseif($this->input->post("template_report_period")=="Next Quarter"){
    $next_quarter=$this_quesrter+1;
    if($next_quarter > 4){
        $next_quarter = 1;
    }
    if($next_quarter == 1){
        $report_end_date = date("Y-m-t", strtotime(date("Y-03-t")));
    }elseif($next_quarter == 2){
        $report_end_date = date("Y-m-t", strtotime(date("Y-06-t")));
    }elseif($next_quarter == 3){
        $report_end_date = date("Y-m-t", strtotime(date("Y-09-t")));
    }elseif($next_quarter == 4){
        $report_end_date = date("Y-m-t", strtotime(date("Y-12-t")));
    }
}elseif($this->input->post("template_report_period")=="Next Year"){
    $report_end_date = (date("Y")+1)."-12-31";
}
if ($action == "preview") {
    if ($this->input->post("cover_style")  == 1) {
        $header_bg_color = "#1F497D";
    } elseif ($this->input->post("cover_style") == 2) {
        $header_bg_color = "#404040";
    }
    $cover_title = $this->input->post("cover_page_cover_title");
    if (strtolower($this->input->post("cover_page_subtitle")) == "{company name}") {
        $cover_subtitle = $this->input->post("af_company_name");
    } else {
        $cover_subtitle = $this->input->post("cover_page_subtitle");
    }
    $end_period = explode("{", $this->input->post("cover_page_report_period"));
    $echo_text = "";
    for ($i = 0; $i < count($end_period); $i++) {
        if ("{" . strtolower($end_period[$i]) == "{report end date}") {
            $echo_text .= " " . date("F d, Y", strtotime($report_end_date));
        } else {
            $echo_text .= " " . $end_period[$i];
        }
    }
    $end_period_text = $echo_text;
    if ($this->input->post("show-logo") == "on") {
        $logo_html = ' <img src="'.base_url("uploads/users/business_profile/1/Nsmart_logo.png").'" alt="">';
    } else {
        $logo_html = "";
    }
    $cover_prepared_date = $this->input->post("cover_page_prepared_date");
    $cover_disclaimer = $this->input->post("cover_page_disclaimer");
    $table_include_table_of_contents =0;
    if($this->input->post("include_table_of_contents") == "on"){
        $table_include_table_of_contents =1;
    }
    $table_page_title = $this->input->post("table_of_contents_page_title");
    $ctr = 2;
    $text_left = "";
    $text_right = "";
    $primary_page_titles = $this->input->post("preliminary_page_title");
    $primary_page_includes = $this->input->post("include_this_page");
    for($i=0; $i<count($primary_page_titles);$i++){
        if ($primary_page_titles[$i] == "on" && $primary_page_titles[$i] != "") {
            $text_left .= "<div style='padding:10px 0;'>" . $primary_page_titles[$i] . " </div>";
            $text_right .= "<div style='padding:10px 0; text-align:right;'>" . $ctr . "</div>";
            $ctr++;
        }
    }
    $report_page_titles=$this->input->post("report_title");
    for($i = 0; $i < count($report_page_titles);$i++){
        $text_left .= "<div style='padding:10px 0;'>" . $report_page_titles[$i] . " </div>";
        $text_right .= "<div style='padding:10px 0;text-align:right;'>" . $ctr . "</div>";
        $ctr++;
    }
    if ($this->input->post("end_notes_include_this_page") == "on") {
        $text_left .= "<div style='padding:10px 0;'>" . $this->input->post("end_notes_page_title") . " </div>";
        $text_right .= "<div style='padding:10px 0;text-align:right;'>" . $ctr . "</div>";
        $ctr++;
    }
    $report_title_left = "<div style='width:50%;float:left;'>" . $text_left . "</div>";
    $report_title_right = "<div style='width:50%;float:right;text-align:right;'>" . $text_right . "</div>";

    $preliminary_pages_html = "";
    $premilinary_page_contents=$this->input->post("prelimenary_page_content") ;
    for($i=0; $i<count($primary_page_titles);$i++){
        if ($primary_page_titles[$i] == "on" && $primary_page_titles[$i] != "") {
            $preliminary_pages_html .= '<div class="preliminary-pages" style="page-break-after: always;">
                <h1 class="page-title">'.$report_page_titles[$i] .'</h1>
                <hr>
                <div class="peliminary-data">
                    '.$premilinary_page_contents[$i].'
                </div>
            </div>';
        }
    }
    $report_pages_html = "";
    for($i = 0; $i < count($report_page_titles);$i++){
        $report_pages_html .= '<div class="report-pages" style="page-break-after: always;">
                <h1 class="page-title">'.$report_page_titles[$i].'</h1>
                <hr>
                <div class="reports-data">

                </div>
            </div>';
    }
    $end_note_pages_html = "";
    if ($this->input->post("end_notes_include_this_page") == "on") {
        $end_note_pages_html .= '<div class="end-note-pages">
                <h1 class="page-title">'.$this->input->post("end_notes_page_title").'</h1>
                <hr>
                <div class="reports-data">
                    '.$this->input->post("end_notes_page_content").'
                </div>
            </div>';
    }
} else {
    $cover_title = $management_report->cover_title;

    if (strtolower($management_report->cover_subtitle) == "{company name}") {
        $cover_subtitle = $management_report->business_name;
    } else {
        $cover_subtitle = $management_report->cover_subtitle;
    }
    $end_period = explode("{", $management_report->cover_report_period);
    $echo_text = "";
    for ($i = 0; $i < count($end_period); $i++) {
        if ("{" . strtolower($end_period[$i]) == "{report end date}") {
            $echo_text .= " " . date("F d, Y", strtotime($report_end_date));
        } else {
            $echo_text .= " " . $end_period[$i];
        }
    }
    $end_period_text = $echo_text;
    if ($management_report->cover_show_logo == 1) {
        $logo_html = ' <img src="'.base_url("uploads/users/business_profile/1/Nsmart_logo.png") .'" alt="">';
    } else {
        $logo_html = "";
    }
    $cover_prepared_date = $management_report->cover_prepared_date;
    $cover_disclaimer = $management_report->cover_disclaimer;
    $table_include_table_of_contents = $management_report->table_include_table_of_contents;
    $table_page_title = $management_report->table_page_title;
    $ctr = 2;
    $text_left = "";
    $text_right = "";
    foreach ($primary_pages as $page) {
        if ($page->include_this_page == 1 && $page->page_title != "") {
            $text_left .= "<div style='padding:10px 0;'>" . $page->page_title . " </div>";
            $text_right .= "<div style='padding:10px 0;text-align:right;'>" . $ctr . "</div>";
            $ctr++;
        }
    }

    foreach ($report_pages as $report) {
        $text_left .= "<div style='padding:10px 0;'>" . $report->report_page_title . " </div>";
        $text_right .= "<div style='padding:10px 0;text-align:right;'>" . $ctr . "</div>";
        $ctr++;
    }

    if ($management_report->endnotes_include_page == 1) {
        $text_left .= "<div style='padding:10px 0;'>" . $management_report->endnote_page_title . " </div>";
        $text_right .= "<div style='padding:10px 0;text-align:right;'>" . $ctr . "</div>";
        $ctr++;
    }
    $report_title_left = "<div style='width:50%;float:left;'>" . $text_left . "</div>";
    $report_title_right = "<div style='width:50%;float:right;text-align:right;'>" . $text_right . "</div>";
    $preliminary_pages_html = "";
    foreach ($primary_pages as $page) {
        if ($page->include_this_page == 1 && $page->page_title != "") {
            $preliminary_pages_html .= '<div class="preliminary-pages" style="page-break-after: always;">
                <h1 class="page-title">'.$page->page_title.'</h1>
                <hr>
                <div class="peliminary-data">
                    '.$page->page_content .'
                </div>
            </div>';
        }
    }
    $report_pages_html = "";
    foreach ($report_pages as $report) {
        $report_pages_html .= '<div class="report-pages" style="page-break-after: always;">
                <h1 class="page-title">'.$report->report_page_title.'</h1>
                <hr>
                <div class="reports-data">
                    
                </div>
            </div>';
    }
    $end_note_pages_html = "";
    if ($management_report->endnotes_include_page == 1) {
        $end_note_pages_html .= '<div class="end-note-pages">
                <h1 class="page-title">'.$management_report->endnote_page_title.'</h1>
                <hr>
                <div class="reports-data">
                    '.$management_report->endnote_page_content .'
                </div>
            </div>';
    }
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
                <div class="title"><?= $cover_title ?></div>
                <div class="company-name">
                    <?=$cover_subtitle?>
                </div>
                <div class="end-period">
                    <?=$end_period_text?>
                </div>
            </div>
            <div class="body">
                <div class="logo">
                   <?=$logo_html?>
                </div>
                <div class="prepared-on">
                    <label for="">Prepared on</label>
                    <div class="the-date"><?= $cover_prepared_date ?></div>
                </div>
            </div>
            <div class="footer"><?= $cover_disclaimer ?></div>
        </div>
        <?php
        if ($table_include_table_of_contents == 1) {
        ?>
            <div class="table-of-contents" style="page-break-after: always;">
                <h1 class="page-title">
                    <?= $table_page_titl?>
                </h1>
                <hr>
                <div class="reports-titles">
                    <?=$report_title_left?>
                    <?=$text_right?>
                </div>
            </div>
        <?php
        }
        ?>
        <?=$preliminary_pages_html?>
       
       <?=$report_pages_html?>

        <?=$end_note_pages_html?>
    </main>
</body>

</html>