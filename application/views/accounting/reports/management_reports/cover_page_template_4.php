
<?php 
    $header_bg_color="transparent";


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
                        $echo_text.=" ".date("F d, Y",strtotime($management_report->report_end_period));
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