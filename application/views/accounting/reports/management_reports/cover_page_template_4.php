
<?php 
    $header_bg_color="transparent";


    $this_quesrter = ceil(date("n", strtotime("1995-11-13")) / 3);
    if ($this->input->post("template_report_period") == "All Dates") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Today") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "This Week ") {
        $report_end_date = date("Y-m-d", strtotime('sunday this week'));
    } elseif ($this->input->post("template_report_period") == "This Month") {
        $report_end_date = date("Y-m-t");
    } elseif ($this->input->post("template_report_period") == "This Week-to-date") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "This Month-to-date") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "This Quarter") {
        if ($this_quesrter == 1) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-03-t")));
        } elseif ($this_quesrter == 2) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-06-t")));
        } elseif ($this_quesrter == 3) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-09-t")));
        } elseif ($this_quesrter == 4) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-12-t")));
        }
    } elseif ($this->input->post("template_report_period") == "This Quarter-to-date") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "This Year") {
        $report_end_date = date("Y-12-31");
    } elseif ($this->input->post("template_report_period") == "This Year-to-date") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "This Year-to-last-month") {
        $report_end_date = date("Y-m-d", strtotime("last day of previous month"));
    } elseif ($this->input->post("template_report_period") == "Yesterday") {
        $report_end_date = date('Y-m-d', strtotime("-1 days"));
    } elseif ($this->input->post("template_report_period") == "Recent") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Last Week") {
        $report_end_date = date('Y-m-d', strtotime('last Sunday'));
    } elseif ($this->input->post("template_report_period") == "Last Week-to-date") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Last Month") {
        $report_end_date = date("Y-m-d", strtotime("last day of previous month"));
    } elseif ($this->input->post("template_report_period") == "Last Month-to-date ") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Last Quarter") {
        $last_quarter = $this_quesrter - 1;
        if ($last_quarter == 0) {
            $last_quarter = 4;
        }
        if ($last_quarter == 1) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-03-t")));
        } elseif ($last_quarter == 2) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-06-t")));
        } elseif ($last_quarter == 3) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-09-t")));
        } elseif ($last_quarter == 4) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-12-t")));
        }
    } elseif ($this->input->post("template_report_period") == "Last Quarter-to-date") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Last Year") {
        $report_end_date = (date("Y") - 1) . "-12-31";
    } elseif ($this->input->post("template_report_period") == "Last Year-to-date") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Since 30 Days Ago") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Since 60 Days Ago") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Since 90 Days Ago") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Since 365 Days Ago") {
        $report_end_date = date("Y-m-d");
    } elseif ($this->input->post("template_report_period") == "Next Week") {
        $report_end_date = date('Y-m-d', strtotime('next Monday'));
    } elseif ($this->input->post("template_report_period") == "Next 4 Weeks") {
        $report_end_date = date("Y-m-d", ('+3 weeks'));
    } elseif ($this->input->post("template_report_period") == "Next Month") {
        $report_end_date = date('Y-m-t', strtotime('first day of +1 month'));
    } elseif ($this->input->post("template_report_period") == "Next Quarter") {
        $next_quarter = $this_quesrter + 1;
        if ($next_quarter > 4) {
            $next_quarter = 1;
        }
        if ($next_quarter == 1) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-03-t")));
        } elseif ($next_quarter == 2) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-06-t")));
        } elseif ($next_quarter == 3) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-09-t")));
        } elseif ($next_quarter == 4) {
            $report_end_date = date("Y-m-t", strtotime(date("Y-12-t")));
        }
    } elseif ($this->input->post("template_report_period") == "Next Year") {
        $report_end_date = (date("Y") + 1) . "-12-31";
    }
?>
<style>
    .management-report-cover-page{
        width: 100%;
        font-family: "Tahoma";
        height: 100%;
        position: relative;
    }
    .header .title{
        font-size: 22px;
        padding-bottom: 10px;
    }
    .footer{
        position: absolute;
        bottom: 0;
        padding-top: 20px;
        padding-bottom: 10px;
        width: 100%;
        font-size: 12px;
        text-align: center;
    }
    .body .prepared-on{
        position: absolute;
        top: 75%;
    }
    .body .prepared-on label{
        font-size: 12px;
        color: #A3A3A3;
    }
    .cover-type-4  .body .logo{
        margin-top:20px;
        width: 25%;
    }
    .cover-type-4 .body .logo img{
        width: 100%;
    }
    .cover-type-4 .body .title{
        font-size: 30px;
        padding: 10px;
        text-align: left;
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 20px;
        border-top: solid 1px #ccc;
        border-bottom: solid 1px #ccc;
    }
    
</style>
<div class="management-report-cover-page cover-type-4">
    <div class="body">
        <div class="logo">
            <?php
                if($show_logo == "on"){
                    ?><center><img src="<?=base_url("uploads/users/business_profile/1/Nsmart_logo.png")?>" alt=""></center><?php
                }
            ?>
        </div>   
        <div class="text-details" style="width: 100%;">
            <div class="title"><?=$cover_page_cover_title?></div>
            <div class="company-name">
                <?php 
                $subtitles=explode("{",$cover_page_subtitle);
                $echo_text="";
                for($i=0;$i<count($subtitles);$i++){
                    if("{".strtolower($subtitles[$i]) == "{company name}"){
                        $echo_text.=" ". $management_report->business_name;
                    }else{
                        $echo_text.=" ".$subtitles[$i];
                    }
                }
                echo $echo_text;
                
                ?>
            </div>
            <div class="end-period">
                <?php 
                $end_period=explode("{",$cover_page_report_period);
                    $echo_text="";
                for($i=0;$i<count($end_period);$i++){
                    if("{".strtolower($end_period[$i]) == "{report end date}"){
                        $echo_text.=" ".date("F d, Y",strtotime($report_end_date));
                    }else{
                        $echo_text.=" ".$end_period[$i];
                    }
                }
                echo $echo_text;
                ?>   
            </div>
            <div class="prepared-on">
                <label for="">Prepared on</label>
                <div class="the-date"><?=$cover_page_prepared_date?></div>
            </div> 
        </div>
    </div>
    <div class="footer"><?=$cover_page_disclaimer?></div>
</div>