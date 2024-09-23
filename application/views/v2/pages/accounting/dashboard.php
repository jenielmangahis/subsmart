<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/accounting_header'); 
?>
<link rel="stylesheet" href="<?= base_url("assets/css/accounting/accounting.css") ?>">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css" integrity="sha512-qc0GepkUB5ugt8LevOF/K2h2lLGIloDBcWX8yawu/5V8FXSxZLn3NVMZskeEyOhlc6RxKiEj6QpSrlAoL1D3TA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.js" integrity="sha512-mDe5mwqn4f61Fafj3rll7+89g6qu7/1fURxsWbbEkTmOuMebO9jf1C3Esw95oDfBLUycDza2uxAiPa4gdw/hfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<style>
    #exTab1 .tab-content {
    color : white;
    background-color: #428bca;
    padding : 5px 15px;
    }

    #exTab3 .tab-content {
        color : white;
        background-color: #428bca;
        padding : 5px 15px;
    }

    .project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #0062cc;
        background-color: transparent;
        border-color: transparent transparent #f3f3f3;
        font-size: 16px;
        font-weight: bold;
    }

    .project-tab thead{
        background: #f3f3f3;
        color: #333;
    }
    .project-tab a{
        text-decoration: none;
        color: #333;
        font-weight: 600;
    }

    .alert{
        width:60%;
        /* margin:20px auto; */
        padding:20px;
        position:relative;
        border-radius:5px;
        box-shadow:0 0 15px 5px #ccc;
        background-color: #FBF5FF;
        border-left:5px solid #7A08C8;
    }

    .close{
        position:absolute;
        width:30px;
        height:30px;
        opacity:0.5;
        border-width:1px;
        border-style:solid;
        border-radius:50%;
        right:15px;
        top:25px;
        text-align:center;
        font-size:1.5em;
        cursor:pointer;
        border-color: #7A08C8;
        color:#7A08C8;
    }


    #circle {
        background: white;
        border-radius: 50%;
        width: 80px;
        height: 80px;  
        display: flex;
        text-align: center;
        align-items: center;
        justify-content: center;
    }
    
    #circle:hover {
        background: #def3cc;
    }
    
    .arrow {
        width:88px;
        margin:40px auto;
    }
    
    .line {
        margin-top:7px;
        width:81px;
        background:#ffffff;
        height:2px;
        float:left;
    }

    .point {	
        width: 0; 
        height: 0; 
        border-top: 7px solid transparent;
        border-bottom: 7px solid transparent;
        border-left: 7px solid #ffffff;
        float:right;
        margin-top:1px;
    }
  
    .notification {
        /* background-color: #555; */
        color: white;
        text-decoration: none;
        /* padding: 15px 26px; */
        position: relative;
        display: inline-block;
        border-radius: 2px;
    }
    
    /* .notification:hover {
        background: red;
    } */
  
    .notification .badge {
        position: absolute;
        top: -1px;
        right: -1px;
        padding: 5px 10px;
        border-radius: 50%;
        background-color: red;
        color: white;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }
    
    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }
  
    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }
    
    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }
    
    /* Style the tab content */
    .tabcontent {
        /* display: none; */
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
    
    .canvasjs-chart-credit
    {
        display: none;
    }

    .area-chart {
        /* Reset */
        margin: 0;
        padding: 0;
        border: 0;
    
        /* Dimensions */
        width: 100%;
        max-width: var(--chart-width, 600px);
        height: var(--chart-height, 300px);
    
        /* Layout */
        display: flex;
        justify-content: stretch;
        align-items: stretch;
        flex-direction: row;
    }

    ul.area-chart,
    ol.area-chart {
        list-style: none;
    }
        
    .area-chart > * {
        /* Even size items */
        flex-grow: 1;
        flex-shrink: 1;
        flex-basis: 0;
    
        /* Color */
        background: var(--color, rgba(240, 50, 50, .75));
        clip-path: polygon(
        0% calc(100% * (1 - var(--start))),
        100% calc(100% * (1 - var(--end))),
        100% 100%,
        0% 100%
        );
    }

    .con-inner-container .con-bar .open-invoices {
        height: 129px;
        background-color: rgb(186, 190, 197);
    }

    .con-inner-container .con-bar .paid-invoices {
        margin-top: 2px;
        height: 82px;
        background-color: rgb(127, 208, 0);
    }

    .con-data-label {
        padding-left: 55px;
    }

    .con-data-label .con-label {
        color: rgb(57, 58, 61);
        font-size: 19px;
        font-weight: 700;
        line-height: 16px;
        padding-top: 20px;
    }

    .con-data-label .con-sub-label {
        color: rgb(57, 58, 61);
        font-weight: 400;
        line-height: 17px;
        padding-top: 8px;
        padding-bottom: 12px;
        text-transform: uppercase;
    }

    .box-invoices-bar {
        cursor: pointer;
    }

    .expenses-money-section {
        cursor: pointer;
    }

    .expenses-money-section .expenses-con-data {
        font-weight: 400;
        font-size: 14px;
        color: rgb(57, 58, 61);
    }

    .expenses-money-section .expenses-money-data {
        visibility: hidden;
        color: rgb(57, 58, 61);
        font-weight: 700;
        font-size: 19px;
        line-height: 1em;
        margin-bottom: 4px;
    }

    .expenses-donutchart-section {
        padding-top: 10px;
    }

    .expenses-donutchart-section .donut-chart-container {
        position: relative;
        height: 200px;
        overflow: hidden;
        padding-left: 0;
    }

    .expenses-donutchart-section #expensesChart {
        position: relative;
        float: left;
        right: 10px;
        display: inline-block;
    }

    .expenses-donutchart-section svg {
        /*left: -50px!important;*/
        padding: 0;
    }

    .expenses-donutchart-section #legendExpenses {
        display: inline-block;
        height: 200px;
        position: relative;
        width: 40%;
        float: right;
        z-index: 20;
    }

    .expenses-donutchart-section #legendExpenses .legendList {
        padding-top: 0;
        margin-left: -22px;
    }

    .expenses-donutchart-section #legendExpenses .legendList .box {
        width: 13px;
        height: 12px;
        background-color: #0b62a4;
        display: inline-block;
    }

    .expenses-donutchart-section #legendExpenses .legendList .amount {
        font-weight: bolder;
        display: inline-block;
    }

    .expenses-donutchart-section #legendExpenses .legendList .name {
        color: rgb(107, 108, 114);
        font-size: 12px;
        margin-bottom: 9px;
        margin-left: 17px;
        width: 110px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .nav-link.active {    
        background-color: #dad1e0 !important;    
        border-bottom: none !important;
    }

    .nav-link:hover {
    background-color: #88888829;
    }

    .nav-fill .nav-item{
        margin:5px;
        border-radius:5px;
        font-weight:600;
    }

    .nav-tabs{
        border:0px !important;
    }

    .horizontal-tab-label{
        background-color: #6a4a86;
        padding: 31px 0;
        border-radius: 15px 0 0 15px;
        color: #ffffff;
        font-size: 31px;
        height: 198px;
    }

    .horizontal-tab-group{
        background-color: #6a4a86;
        color: #ffffff;    
    }

    .horizontal-tab-label h6{
        margin: 50px -30px;
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);
        /* background-color: whitesmoke; */
        width: 183px;
        text-align: center;
        font-size: 28px;
    }

    .horizontal-tab-label h6.text-long{
        margin: 48px -34px;
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);
        /* background-color: whitesmoke; */
        width: 184px;
        text-align: center;
        font-size: 23px;
    }

    .horizontal-tab-label hr{    
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);    
        width: 183px;    
        font-size: 32px;
        position: relative;
        top: -72px;
    }

    .horizontal-tab-group p{
        width:100px;    
        display:grid;
        padding-top:11px;
    }

    .arrow-container{
        padding:4% 0;
        display: inline-block;
        padding-bottom:56px;
    }
</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <section id="tabs" class="project-tab" style="padding-left: 0px;padding-right: 0px;">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <nav>
                                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color:#666666;display: inline-block;">Get things done</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="color:#666666;display: inline-block;">Business overview</a> 
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <?php include viewPath('v2/pages/accounting/includes/_dashboard_get_things_done'); ?>
                                            </div>
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                <?php include viewPath('v2/pages/accounting/includes/_dashboard_overview'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".close").click(function() {
    $(this)
        .parent(".alert")
        .fadeOut();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>

