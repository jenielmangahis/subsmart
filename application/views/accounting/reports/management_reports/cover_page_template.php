
<?php 
if($cover_style == 1){
    $header_bg_color="#1F497D";
}elseif($cover_style == 2){
    $header_bg_color="#404040";
}elseif($cover_style == 3){
    $header_bg_color="#1F497D";
}else{
    $header_bg_color="#1F497D";
}

?>
<style>
    .management-report-cover-page{
        width: 100%;
        font-family: "Tahoma";
        height: 100%;
        position: relative;
    }
    .header{
        background: <?=$header_bg_color?>;
        padding: 10px;
        color: #fff;
        font-size: 14px;
    }
    .header .title{
        font-size: 30px;
        padding-bottom: 10px;
    }
    .footer{
        position: absolute;
        bottom: 0;
        background: #DCE5F1;
        padding: 10px;
        width: 100%;
        font-size: 12px;
    }
    .body .logo{
        width: 25%;
        margin-top: 10px;
    }
    .body .logo img{
        width: 100%;
    }
    .body .prepared-on{
        position: absolute;
        top: 50%;
    }
    .body .prepared-on label{
        font-size: 12px;
        color: #A3A3A3;
    }
</style>
<div class="management-report-cover-page">
    <div class="header">
        <div class="title"><?=$cover_page_cover_title?></div>
        <div class="company-name">
            <?php 
            if(strtolower($cover_page_subtitle) == "{company name}"){
                echo $management_report->business_name;
            }else{
                echo $cover_page_subtitle;
            }
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
    </div>
    <div class="body">
        <div class="logo">
            <?php
                if($show_logo == "on"){
                    ?><img src="<?=base_url("uploads/users/business_profile/1/Nsmart_logo.png")?>" alt=""><?php
                }
            ?>
            
        </div>   
        <div class="prepared-on">
            <label for="">Prepared on</label>
            <div class="the-date"><?=$cover_page_prepared_date?></div>
        </div> 
    </div>
    <div class="footer"><?=$cover_page_disclaimer?></div>
</div>